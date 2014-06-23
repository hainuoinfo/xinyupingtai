<?php

	header('Content-type: text/html; charset=utf-8');
	date_default_timezone_set("Asia/Shanghai");

	//include("../config.php");
	//include("../inc/common.php");

	class RunTime{

		public $StartTime = 0; 
		public $StopTime = 0; 

		function get_microtime(){ 
			list($usec, $sec) = explode(' ', microtime()); 
			return ((float)$usec + (float)$sec); 
		} 

		function start(){ 
			$this->StartTime = $this->get_microtime(); 
		} 

		function stop() { 
			$this->StopTime = $this->get_microtime(); 
		} 

		function spent() { 
			return round(($this->StopTime - $this->StartTime), 1); 
		} 

	}
	$runtime= new RunTime();
	$runtime->start();


	$username = $_GET['username'];

	$agent = $_SERVER['HTTP_USER_AGENT']; 
 
	if(!strpos($agent,"MSIE") && !strpos($agent,"Chrome")) 
	  $username = iconv("utf-8","gb2312",$username);

	//if (inject_check ( $username )) {
	//	die ( '查询的账号不合法' );
	//}
	
	/*
	$fh = fopen('http://member1.taobao.com/member/userProfile.jhtml?userID='. $username,'r'); 

	$pageContent = array();

	if($fh){
		while(!feof($fh)) {
			array_push($pageContent,fgets($fh));
		}
	}
	*/
	
	$sContent = file_get_contents('http://member1.taobao.com/member/userProfile.jhtml?userID='. $username);

	$re_nullity = '/查封/';
	$a_nullity = array();
	$s_nullity = '';

	if(preg_match($re_nullity, $sContent, $a_nullity)){
		$s_nullity = $a_nullity[0];
	}

	if($s_nullity == '查封'){
		echo '該用戶已經被查封！';
		exit;
	}

	$re_noexists = '/error\-info/';
	$a_noexists = array();
	$s_noexists = '';

	if(preg_match($re_noexists, $sContent, $a_noexists)){
		$s_noexists = $a_noexists[0];
	}

	if($s_noexists == 'error-info'){
		echo '淘宝正在对该店铺盘点，请稍后再试.';
		exit;
	}
	
	$regex = '/(http\:\/\/rate.+)\".+信用评价/i';
	$matches = array();
	$rateUrl = '';

	$re_date = '/注册时间：[^|]+?(\d+年\d+月\d+日)/';
	$a_date = array();
	$s_regdate = '';

	$re_shop_userid = '/shopId\=(\d+)\;\s*user[I|i]d\=(\d+)/';
	$a_shop_userid = array();
	$i_shop_shopid = 0;
	$i_shop_userid = 0;
	
	$re_shop_title = '/淘宝店铺\：\s*\<a.+\>(.+)\<\/a\>/';
	$a_shop_title = array();
	$s_shop_title = 0;

	if(preg_match($re_shop_userid, $sContent, $a_shop_userid)){
		$i_shop_shopid = $a_shop_userid[1];
		$i_shop_userid = $a_shop_userid[2];
	}

	if(!is_numeric($i_shop_userid)){$i_shop_userid = 0;}

	/*shop title*/
	if(preg_match($re_shop_title, $sContent, $a_shop_title)){
		$s_shop_title = $a_shop_title[1];
	}
	
	if ($s_shop_title == '0'){
		$re_shop_title = '/\<title\>[^|]*?首页\-\s*(.+)\s*\-.*\s*\<\/title\>/';
		if(preg_match($re_shop_title, $sContent, $a_shop_title)){
			$s_shop_title = $a_shop_title[1];
		}
	}

	if(preg_match('/创建时间：[^|]+?(\d+年\d+月\d+日)/', $sContent, $a_date)){
		$s_regdate = $a_date[1];
	}

	if($s_regdate == ''){
		if(preg_match($re_date, $sContent, $a_date)){
			$s_regdate = $a_date[1];
		}
	}
	
	if($i_shop_userid == 0){
		if(preg_match($regex, $sContent, $matches)){
			$rateUrl = $matches[1];
		}
	} else {
		$rateUrl = 'http://rate.taobao.com/user-rate-'.$i_shop_userid.'.htm';
	}

	$sc = file_get_contents($rateUrl);

	//echo $sc;
	//exit;

	$reseller = '/卖家信息/';
	$seller = array();
	$rseller = '';
	if(preg_match($reseller, $sc, $seller)){
		$rseller = $seller[0];
	}

	$reshoptitle = '/\<a\shref\=\"http\:\/\/store\.taobao\.com[^$]+?\<\/a\>/';
	$ashoptitle = array();
	$shoptitle = '';

	if(preg_match($reshoptitle, $sc, $ashoptitle)){
		$shoptitle = $ashoptitle[0];
	}

	$normal_rater = 0;
	$bad_rater = 0;

	$buy_rater = 0;
	$sell_rater = 0;
	
	$re_taobao_userid = '/(?:user-rate-)(\d+)\-/';
	$a_taobao_userid = array();
	$i_taobao_userid = 0;

	if(preg_match($re_taobao_userid, $sc, $a_taobao_userid)){
		$i_taobao_userid = $a_taobao_userid[1];
	}
	if(!is_numeric($i_taobao_userid)){$i_taobao_userid = 0;}

	echo '<div style="line-height:24px;width:780px;position:relative;">';

	$i_type = 0;

	$s_area = '';
	$s_auth = '';
	
	$s_goodrate = '';
	$s_seller_rater_img = '';
	$s_buyer_rater_img = '';

	$i_7rater_good = 0;
	$i_7rater_normal = 0;
	$i_7rater_bad = 0;

	$i_30rater_good = 0;
	$i_30rater_normal = 0;
	$i_30rater_bad = 0;

	$i_210rater_good = 0;
	$i_210rater_normal = 0;
	$i_210rater_bad = 0;

	$i_historyrater_good = 0;
	$i_historyrater_normal = 0;
	$i_historyrater_bad = 0;

	$i_7rater = 0;
	$i_30rater = 0;
	$i_210rater = 0;
	$i_historyrater = 0;

	if(trim($rseller) == '卖家信息'){//seller
		$i_type = 1;

		/*
		卖家shopid
		*/
		if($i_shop_userid == 0){
			$re_shop_userid = '/shopId(\d+)/';
			$a_shop_userid = array();

			if(preg_match($re_shop_userid, $sc, $a_shop_userid)){
				$i_shop_userid = $a_shop_userid[1];
			}

			if(!is_numeric($i_shop_userid)){$i_shop_userid = 0;}
		}
		
		/*
		卖家信用
		*/
		$re_seller_rate = '/卖家信用\：[^|]+?(\d+)[^|]+?\<img\ssrc\=\"(.+s_.+\.gif)\"/';
		$a_seller_rate = array();
		$s_seller_rate = '';
		if(preg_match($re_seller_rate, $sc, $a_seller_rate)){
			$s_seller_rater_img = $a_seller_rate[2];
			$sell_rater = $a_seller_rate[1];
		}
		if($sell_rater == ''){
			if(preg_match('/卖家信用\：[^|]+?(\d+)/', $sc, $a_seller_rate)){
				$s_seller_rater_img = '/images/blank.jpg';
				$sell_rater = $a_seller_rate[1];
			}
		}

		/*
		好评率
		*/
		$re_seller_goodrate = '/好评率\：(\d+\.\d+)/';
		$a_seller_goodrate = array();
		if(preg_match($re_seller_goodrate, $sc, $a_seller_goodrate)){
			$s_goodrate = $a_seller_goodrate[1];
		}
		
		/*
		买家信用
		*/
		$re_seller_buyrate = '/买家信用\：[^|]+?(\d+)[^|]+?\<img\ssrc\=\"(.+b_.+\.gif)\"/';
		$a_seller_buyrate = array();
		if(preg_match($re_seller_buyrate, $sc, $a_seller_buyrate)){
			$s_buyer_rater_img = $a_seller_buyrate[2];
			$buy_rater = $a_seller_buyrate[1];
		}
		/*
		创建时间
		*/
		$re_seller_createshopdate = '/\<span\>创店时间\：\<\/span\>(\d+\-\d+\-\d+)/';
		$a_seller_createshopdate = array();
		if(preg_match($re_seller_createshopdate, $sc, $a_seller_createshopdate)){
			$s_regdate = $a_seller_createshopdate[1];
		}
		if($s_regdate == ''){
			$re_seller_createshopdate = '/创建时间[^|]+?\<span\sclass\=\"text"\>(.+)\<\/span/';
			if(preg_match($re_seller_createshopdate, $sc, $a_seller_createshopdate)){
				$s_regdate = $a_seller_createshopdate[1];
			}
		}
		
		/*
		所在地区
		*/
		if($i_shop_userid == 0){
			$re_seller_area = '/所在地区\：[^|]+?\s+(.+)\<\/li\>/';
		} else {
			$re_seller_area = '/所在地区\：[^|]+?class\=\"text\"\>(.+)\<\/span\>\<\/dd\>/';
		}
		$a_seller_area = array();
		if(preg_match($re_seller_area, $sc, $a_seller_area)){
			$s_area = $a_seller_area[1];
		}
		
		/*
		最近一周
		*/
		$re_seller_7rater = '/timeLine\=\-7\&result\=1\'\>(\d+)[^|]+?timeLine\=\-7\&result\=0\'\>(\d+)[^|]+?timeLine\=\-7\&result\=\-1\'\>(\d+)/';
		$a_seller_7rater = array();
		if(preg_match($re_seller_7rater, $sc, $a_seller_7rater)){
			$i_7rater_good = $a_seller_7rater[1];
			$i_7rater_normal = $a_seller_7rater[2];
			$i_7rater_bad = $a_seller_7rater[3];
		}

		/*
		最近一月
		*/
		$re_seller_30rater = '/timeLine\=\-30\&result\=1\'\>(\d+)[^|]+?timeLine\=\-30\&result\=0\'\>(\d+)[^|]+?timeLine\=\-30\&result\=\-1\'\>(\d+)/';
		$a_seller_30rater = array();
		if(preg_match($re_seller_30rater, $sc, $a_seller_30rater)){
			$i_30rater_good = $a_seller_30rater[1];
			$i_30rater_normal = $a_seller_30rater[2];
			$i_30rater_bad = $a_seller_30rater[3];
		}
		
		/*
		最近半年
		*/
		$re_seller_210rater = '/timeLine\=\-210\&result\=1\'\>(\d+)[^|]+?timeLine\=\-210\&result\=0\'\>(\d+)[^|]+?timeLine\=\-210\&result\=\-1\'\>(\d+)/';
		$a_seller_210rater = array();
		if(preg_match($re_seller_210rater, $sc, $a_seller_210rater)){
			$i_210rater_good = $a_seller_210rater[1];
			$i_210rater_normal = $a_seller_210rater[2];
			$i_210rater_bad = $a_seller_210rater[3];
		}
		
		/*
		半年以前
		*/
		$re_seller_historyrater = '/data\-point-val\=\"tbrate\.2\.5\.1\"\>(\d+)[^$]+?data\-point-val\=\"tbrate\.2\.5\.2\"\>(\d+)[^$]+?data\-point-val\=\"tbrate\.2\.5\.3\"\>(\d+)/';
		$a_seller_historyrater = array();
		if(preg_match($re_seller_historyrater, $sc, $a_seller_historyrater)){
			$i_historyrater_good = $a_seller_historyrater[1];
			$i_historyrater_normal = $a_seller_historyrater[2];
			$i_historyrater_bad = $a_seller_historyrater[3];
		}

		$normal_rater = $i_7rater_normal + $i_30rater_normal + $i_210rater_normal + $i_historyrater_normal;
		$bad_rater = $i_7rater_bad + $i_30rater_bad + $i_210rater_bad + $i_historyrater_bad;

		/*
		认证信息
		*/
		$re_seller_auth = '/认证信息[^|]+?title\=\"(.+)\"\>/';
		$a_seller_auth = array();
		if(preg_match($re_seller_auth, $sc, $a_seller_auth)){
			$s_auth = $a_seller_auth[1];
		}
		
		$badnormal_rater = 0;

		if($total_rater == 0){
			$badnormal_rater = 0 . '%';
		}else{
			$badnormal_rater = ($bad_rater + $normal_rater) / $total_rater . '%';
		}

		/*
		输出显示
		*/
		echo '<div style="position:absolute;right:220px;height:60px;width:165px;"><img src="/images/DJ_1.gif" /></div>';
		echo '<span style="font-size:24px;">淘宝卖家：' . $shoptitle . '</span>&nbsp;<a target="_blank" href="http://amos1.taobao.com/msg.ww?v=2&uid='. $username .'&s=2" ><img border="0" src="http://amos1.taobao.com/online.ww?v=2&uid='. $username .'&s=2" alt="点击这里给我发消息" /></a>';
		echo '<br /><br />注册时间：' . $s_regdate;
		echo '<br />认证信息：<font color="#00CC33">' . $s_auth .'</font>';
		echo '<br />所在地区：' . $s_area;
		echo '<br /> <font color="#990000">给出评价：</font><img src="/images/normal.gif" /> 中评 (<font color="#ff0000"><b>' . $normal_rater . '</b></font>)&nbsp;&nbsp;<img src="/images/bad.gif" /> 差评 (<font color="#ff0000"><b>' . $bad_rater . '</b></font>)&nbsp;&nbsp;中差评比例：(<font color="#ff0000"><b>' . $badnormal_rater .'</b></font>)&nbsp;<a href="/html/rank_1_1.html" style="color:#F60;" class="rank">中差评榜单</a>';
		echo '<br />详细信息：<a href="/result/tb'.$i_taobao_userid.'.html" target="_blank">http://'.$_SERVER['HTTP_HOST'].'/result/tb'.$i_taobao_userid . '.html</a>';

		echo '<br /><div style="float:left;width:365px;">买家信用：<font color="blue"><b>'.$buy_rater.'</b></font>&nbsp;<img src="' . $s_buyer_rater_img . '" />';
		echo '<br />最近一周：<font color="blue"><b>0</b></font>&nbsp;（<font color="#ff0000">此帐号已开通淘宝店，买家信用明细无法查询!</font>）';
		echo '<br />最近一月：<font color="blue"><b>0</b></font>';
		echo '<br />最近半年：<font color="blue"><b>0</b></font>';
		echo '<br />半年以前：<font color="blue"><b>0</b></font>';
		echo '</div>';
		
		$i_7rater = $i_7rater_good + $i_7rater_normal + $i_7rater_bad;
		$i_30rater = $i_30rater_good + $i_30rater_normal + $i_30rater_bad;
		$i_210rater = $i_210rater_good + $i_210rater_normal + $i_210rater_bad;
		$i_historyrater = $i_historyrater_good + $i_historyrater_normal + $i_historyrater_bad;

		echo '<div style="float:left;width:365px;">卖家信用：<font color="blue"><b>'.$sell_rater.'</b></font>&nbsp;<img src="' . $s_seller_rater_img . '" />&nbsp;&nbsp;好评率：' . $s_goodrate . '%';
		echo '<br />最近一周：<font color="blue"><b>'. $i_7rater.'</b></font>';
		echo '<br />最近一月：<font color="blue"><b>'. $i_30rater.'</b></font>';
		echo '<br />最近半年：<font color="blue"><b>'. $i_210rater.'</b></font>';
		echo '<br />半年以前：<font color="blue"><b>'. $i_historyrater.'</b></font>';
		echo '</div>';
		//echo '<br /> 最近一周（好、中、差）' . $s_seller_7rater_good . ',' . $s_seller_7rater_normal . ',' . $s_seller_7rater_bad;
		//echo '<br /> 最近一月（好、中、差）' . $s_seller_30rater_good . ',' . $s_seller_30rater_normal . ',' . $s_seller_30rater_bad;
		//echo '<br /> 最近半年（好、中、差）' . $s_seller_210rater_good . ',' . $s_seller_210rater_normal . ',' . $s_seller_210rater_bad;
		//echo '<br /> 半年以前（好、中、差）' . $s_seller_historyrater_good . ',' . $s_seller_historyrater_normal . ',' . $s_seller_historyrater_bad;
	}else{//buy
		$i_type = 0;

		/*
		买家信用
		*/
		$re_buyer_rate = '/买家信用\：[^|]+?\(0\)\"\>(\d+)\<\/a\>/';
		$a_buyer_buyrate = array();
		$s_buyer_buyrate = '';
		if(preg_match($re_buyer_rate, $sc, $a_buyer_buyrate)){
			//$s_buyer_buyrate = $a_buyer_buyrate[0];
			$buy_rater = $a_buyer_buyrate[1];
		}
		
		$re_buyer_rate_img = '/买家信用\：[^|]+?src\=\"(.+)\"\stitle[^|]+\<\/a\>/';
		$a_buyer_buyrate_img = array();
		if(preg_match($re_buyer_rate_img, $sc, $a_buyer_buyrate_img)){
			$s_buyer_rater_img = $a_buyer_buyrate_img[1];
		}

		$rater_img_src = '';
		if($s_buyer_rater_img != ''){
			$rater_img_src = '&nbsp;<img src="'.$s_buyer_rater_img.'" />';
		}
		
		/*
		好评率
		*/
		$re_buyer_goodrate = '/好评率\：(\d+\.\d+)/';
		$a_buyer_goodrate = array();
		if(preg_match($re_buyer_goodrate, $sc, $a_buyer_goodrate)){
			$s_goodrate = $a_buyer_goodrate[1];
		}
		
		/*
		所在地区
		*/
		$re_buyer_area = '/所在地区\：[^|]+?\<dd\>\s*(.+)\s*\<\/dd\>/';
		$a_buyer_area = array();
		$a_crlf = array("\r\n", "\n", "\r"," ","</dt><dd>","</dd>");  
		if(preg_match($re_buyer_area, $sc, $a_buyer_area)){
			$s_area = $a_buyer_area[1];
		}
		
		/*
		最近一周
		*/
		$re_buyer_7rater = '/timeLine\=\-7\&amp;result\=1\'\>(\d+)[^|]+?timeLine\=\-7\&amp;result\=0\'\>(\d+)[^|]+?timeLine\=\-7\&amp;result\=\-1\'\>(\d+)/';
		$a_buyer_7rater = array();
		if(preg_match($re_buyer_7rater, $sc, $a_buyer_7rater)){
			$i_7rater_good = $a_buyer_7rater[1];
			$i_7rater_normal = $a_buyer_7rater[2];
			$i_7rater_bad = $a_buyer_7rater[3];
		}
		
		/*
		最近一月
		*/
		$re_buyer_30rater = '/timeLine\=\-30\&amp;result\=1\'\>(\d+)[^|]+?timeLine\=\-30\&amp;result\=0\'\>(\d+)[^|]+?timeLine\=\-30\&amp;result\=\-1\'\>(\d+)/';
		$a_buyer_30rater = array();
		if(preg_match($re_buyer_30rater, $sc, $a_buyer_30rater)){
			$i_30rater_good = $a_buyer_30rater[1];
			$i_30rater_normal = $a_buyer_30rater[2];
			$i_30rater_bad = $a_buyer_30rater[3];
		}
		
		/*
		最近半年
		*/
		$re_buyer_210rater = '/timeLine\=\-210\&amp;result\=1\'\>(\d+)[^|]+?timeLine\=\-210\&amp;result\=0\'\>(\d+)[^|]+?timeLine\=\-210\&amp;result\=\-1\'\>(\d+)/';
		$a_buyer_210rater = array();
		if(preg_match($re_buyer_210rater, $sc, $a_buyer_210rater)){
			$i_210rater_good = $a_buyer_210rater[1];
			$i_210rater_normal = $a_buyer_210rater[2];
			$i_210rater_bad = $a_buyer_210rater[3];
		}
		
		/*
		半年以前
		*/
		$re_buyer_historyrater = '/data\-point-val\=\"tbrate\.2\.5\.1\"\>(\d+)[^$]+?data\-point-val\=\"tbrate\.2\.5\.2\"\>(\d+)[^$]+?data\-point-val\=\"tbrate\.2\.5\.3\"\>(\d+)/';
		$a_buyer_historyrater = array();
		if(preg_match($re_buyer_historyrater, $sc, $a_buyer_historyrater)){
			$i_historyrater_good = $a_buyer_historyrater[1];
			$i_historyrater_normal = $a_buyer_historyrater[2];
			$i_historyrater_bad = $a_buyer_historyrater[3];
		}
		
		/*
		认证信息
		*/
		$re_buyer_auth = '/认证信息\：[^|]+?title\=\"(.+)\"[^|]+?\<\/dd\>/';
		$a_buyer_auth = array();
		if(preg_match($re_buyer_auth, $sc, $a_buyer_auth)){
			$s_auth = $a_buyer_auth[1];
		}

		$normal_rater = $i_7rater_normal + $i_30rater_normal + $i_210rater_normal + $i_historyrater_normal;
		$bad_rater = $i_7rater_bad + $i_30rater_bad + $i_210rater_bad + $i_historyrater_bad;
		$good_rater = $i_7rater_good + $i_30rater_good + $i_210rater_good + $i_historyrater_good;
		$total_rater = $normal_rater + $bad_rater + $good_rater;

		$i_7rater = $i_7rater_good + $i_7rater_normal + $i_7rater_bad;
		$i_30rater = $i_30rater_good + $i_30rater_normal + $i_30rater_bad;
		$i_210rater = $i_210rater_good + $i_210rater_normal + $i_210rater_bad;
		$i_historyrater = $i_historyrater_good + $i_historyrater_normal + $i_historyrater_bad;
		
		$badnormal_rater = 0;

		if($total_rater == 0){
			$badnormal_rater = 0 . '%';
		}else{
			$badnormal_rater = ($bad_rater + $normal_rater) / $total_rater . '%';
		}
		
		/*
		输出显示
		*/
		echo '<div style="position:absolute;right:220px;height:60px;width:165px;">';
		if($i_30rater < 20){
			echo '<img src="/images/DJ_1.gif" />';
		} else if($i_30rater >= 20 && $i_30rater < 30){
			echo '<img src="/images/DJ_2.gif" />';
		} else if($i_30rater > 30){
			echo '<img src="/images/DJ_3.gif" />';
		} else {
			echo '<img src="/images/DJ_1.gif" />';
		}
		echo '</div>';

		echo '<span style="font-size:24px;">淘宝买家：' . $shoptitle . '</span>&nbsp;<a target="_blank" href="http://amos1.taobao.com/msg.ww?v=2&uid='. $username .'&s=2" ><img border="0" src="http://amos1.taobao.com/online.ww?v=2&uid='. $username .'&s=2" alt="点击这里给我发消息" /></a>';

		$re_buyer_regdate = '/(\d+)年(\d+)月(\d+)日/';
		$a_buyer_regdate = array();
		$s_buyer_regdate_Y = '';
		$s_buyer_regdate_m = '';
		$s_buyer_regdate_d = '';

		if(preg_match($re_buyer_regdate, $s_regdate, $a_buyer_regdate)){
			$s_buyer_regdate_Y = $a_buyer_regdate[1];
			$s_buyer_regdate_m = $a_buyer_regdate[2];
			$s_buyer_regdate_d = $a_buyer_regdate[3];
		}
		
		if(is_numeric($s_buyer_regdate_Y)){
			$startdate=mktime("0","0","0",$s_buyer_regdate_m,$s_buyer_regdate_d,$s_buyer_regdate_Y); 
			$enddate=mktime("0","0","0",date('m'),date('d'),date('Y')); 
			$days=round(($enddate-$startdate)/3600/24); 
			if(!is_numeric($days)){$days = 31;}
			
			if($days < 31){
				echo '<br /><br />注册时间：' .$s_regdate.'<font color="#ff0000"><b>（注意：此账号注册时间小于30天，请谨慎交易！）</b></font>';
			} else {
				echo '<br /><br />注册时间：' .$s_regdate;
			}
		}
		
		echo '<br />认证信息：<font color="#00CC33">' . $s_auth .'</font>';
		echo '<br />所在地区：' . $s_area;
		echo '<br /> <font color="#990000">给出评价：</font><img src="/images/normal.gif" /> 中评 (<font color="#ff0000"><b>' . $normal_rater . '</b></font>)&nbsp;&nbsp;<img src="/images/bad.gif" /> 差评 (<font color="#ff0000"><b>' . $bad_rater . '</b></font>)&nbsp;&nbsp;中差评比例：(<font color="#ff0000"><b>' . $badnormal_rater .'</b></font>)&nbsp;<a href="/html/rank_1_1.html" style="color:#F60;" class="rank">中差评榜单</a>';
		//echo '<br />详细信息：<a href="http://rate.taobao.com/user-rate-'.$i_taobao_userid.'.htm" target="_blank">' . $rateUrl . '</a>';
		echo '<br />详细信息：<a href="/result/tb'.$i_taobao_userid.'.html" target="_blank">http://'.$_SERVER['HTTP_HOST'].'/result/tb'. $i_taobao_userid . '.html</a>';

		echo '<br /><div style="float:left;width:365px;">买家信用：<font color="blue"><b>' . $buy_rater. '</b></font>'.$rater_img_src.'&nbsp;(好评率' . $s_goodrate . '%)';
		echo '<br /><font color="#990000">最近一周：</font><font color="blue"><b>'.$i_7rater. '</b></font>';
		echo '<br />最近一月：<font color="blue"><b>'.$i_30rater. '</b></font>';
		echo '<br />最近半年：<font color="blue"><b>'.$i_210rater. '</b></font>';
		echo '<br />半年以前：<font color="blue"><b>'.$i_historyrater. '</b></font>';
		echo '</div>';

		echo '<div style="float:left;width:365px;">卖家信用：<font color="blue"><b>0</b></font>';
		echo '<br /><font color="#990000">最近一周：</font><font color="blue"><b>0</b></font>';
		echo '<br />最近一月：<font color="blue"><b>0</b></font>';
		echo '<br />最近半年：<font color="blue"><b>0</b></font>';
		echo '<br />半年以前：<font color="blue"><b>0</b></font>';
		echo '</div>';
		/*表格形式展示
		echo '<br /><table border="0" style="width:440px;text-align:center;background-color:#fff;padding:0px;margin:0px;background-color:#C0D6E7;line-height:18px;"><tr style="background-color:#E8F4FC;"><td>&nbsp;</td><td ><img src="images/good.gif" /> 好评</td><td align="center"><img src="images/normal.gif" /> 中评</td><td><img src="images/bad.gif" /> 差评</td></tr><tr style="background-color:#fff;"><td align="center">最近一周</td><td>' . $s_buyer_7rater_good .'</td><td>'.$s_buyer_7rater_normal.'</td><td>'.$s_buyer_7rater_bad.'</td></tr><tr style="background-color:#fff;"><td>最近一月</td><td>'.$s_buyer_30rater_good.'</td><td>'.$s_buyer_30rater_normal.'</td><td>'.$s_buyer_30rater_bad.'</td></tr><tr style="background-color:#fff;"><td >最近半年</td><td>'.$s_buyer_210rater_good.'</td><td>'.$s_buyer_210rater_normal.'</td><td>'.$s_buyer_210rater_bad.'</td></tr><tr style="background-color:#fff;"><td>半年以前</td><td>'.$s_buyer_historyrater_good.'</td><td>'.$s_buyer_historyrater_normal.'</td><td>'.$s_buyer_historyrater_bad.'</td></tr></table>';
		*/
	}

	echo '</div>';

?>