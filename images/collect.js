    function function_set_adv(){
		var set_adv=$('#set_adv').css('display');
		var province = document.getElementsByName('province[]');
		if(set_adv=='none'){
		    
			$('#set_adv').css({'display':'table'});
			$('#need_adv').attr('value','1');
			$('#span_days').hide();
			$('#open_adv').html('关闭高级流量');
			get_total_price();
			}else{
			$("#adv_seting_1").attr("checked", false);
			$("#adv_seting_2").attr("checked", false);
			$("#adv_seting_3").attr("checked", false);
			$("#adv_seting_4").attr("checked", false);
			$("#pvs").val('1');
			$('#set_adv').css({'display':'none'});
			$('#need_adv').attr('value','0');
			$('#open_adv').html('设置高级流量');
			$('#span_days').show();
			get_total_price();
			}
		}
	function function_need_adv(){
		var need_adv = $('#need_adv').attr('value');
	    $('#span_adv_seting').show();
		$('#span_cut_time').hide();
		$('#span_cut_pvs').hide();
		$('#span_cut_location').hide();
		$('#span_cut_everyday').hide();
		$('#span_cut_referer').hide();

		if (need_adv=="0"){
			$('#span_adv_seting').hide();
			$('#span_cut_time').hide();
			$('#span_cut_pvs').hide();
			$('#span_cut_location').hide();
			$('#span_cut_referer').hide();
		}else{
			if ($('#adv_seting_1').is(":checked")){
				$('#span_cut_time').show();				
			}
			if ($('#adv_seting_2').is(":checked")){
				$('#span_cut_pvs').show();				
			}
			if ($('#adv_seting_3').is(":checked")){
				//$("input[name=province]:checkbox").attr("checked", true);
				$('#span_cut_location').show();				
			}
			if ($('#adv_seting_5').is(":checked")){
				$('#span_cut_referer').show();				
			}
		}
		get_total_price();
		
	}

	function get_total_price(){
		var ips_arr= new Array(new Array('200','3'),new Array('500','4'),new Array('1000','6.8'),new Array('2000','13'),new Array('3000','19.5'),new Array('4000','27'),new Array('5000','33.4'),new Array('6000','40.4'),new Array('7000','47.2'),new Array('8000','53.9'),new Array('9000','60.6'),new Array('10000','74'));
        
        var maxlocalbuy='50000'; 
		var ips = $('#ips option:selected').val();
		//地区购买有量限制
		if ($('#adv_seting_3').is(":checked") && parseInt(ips)>parseInt(maxlocalbuy)){
			alert("自定义投放地区的量有限，最大是"+maxlocalbuy+" IP每天!");
			return ;
		}
		var price=0;
		for (i=0;i<ips_arr.length ;i++ ){
			if (ips_arr[i][0]==ips) price=ips_arr[i][1];
		}
		if (price=='0'){
			alert("系统内部错误，请联系管理员!");	
			return false;
		}
		//得到时间
		var need_adv = $('#need_adv').attr('value');
		var times    = $('input[name=days]:checked').val();
		var days=0;
		if (need_adv=="1" && $('#adv_seting_1').is(":checked")){
			days = GetDiff();
		}else{
			days= times;
			GetEndTime(times);
		}
		if (days=='0'){
			alert("购买时间不能为0!");	
			return false;
		}
		
		//根据高级购买条件来重新调整价格
		var price_offset=1;
		
		//pv
		if (need_adv==1 && $('#adv_seting_2').is(":checked")){
			var pvs = $('#pvs').val();
			if (pvs<1) pvs=1;
			
			if (pvs>50){
				alert("PV倍数过高，请提高IP标准等级,这样也可以得到更多的PV!");	
				return;
			}
			
			//pv 3倍内的每次加10%
			if (pvs==2) price_offset=1.1;
			if (pvs==3) price_offset=1.3;
			var ptime0=0;
			var ptime1=0;
			if (pvs>3){
				//超过3后就是每3的倍数*2，不是时就再加25%
				ptime0=(pvs-1)%3;
				ptime1=parseInt(pvs*10/3);
				if (ptime1%10!=0){
					ptime1=parseInt(ptime1/10)+1;
				}else{
					ptime1=parseInt(ptime1/10);
				}
				if (ptime1<1) ptime1 = 1;
				price_offset = price_offset*(ptime1+(ptime0/4));				
			}
			//$('#debug_text').text("s:"+ptime0+","+ptime1+",倍数："+price_offset);
						
		}
		
		//地区
		if (need_adv==1 && $('#adv_seting_3').is(":checked")){
			var is_checked=0;
			for (var i=1;i<35;i++){
				if ($('#pprov'+i).is(":checked")){
					is_checked++;
				}
			}

			if (is_checked){
				price_offset = price_offset*3;
				//$('#debug_text').text("地区: 倍数："+price_offset);
			}else{
				$('#pprov1').is(":checked");	
			}
			
		}
		
		//分时,加 20%
		if (need_adv==1 && $('#adv_seting_1').is(":checked")){
			price_offset = price_offset*1.2;			
		}		

		//自定义访问来源,加 100%
		if (need_adv==1 && $('#adv_seting_5').is(":checked")){
			price_offset = price_offset*2;			
		}		

		//价格倍数不能小于1
		if (price_offset<1){
			alert("PV倍数过高，请提高IP标准等级,这样也可以得到更多的PV!");	
			return false;
		}
		
		var discount=1;
		/*if (days>=30){
			discount=0.9;
		}
		if (days>=300){
			discount=0.8;
		}*/
		var keywords= $('#keywords').val();
		if (keywords == ''){
			
				keynums = 1;		
		}
		else
		{
			
			if(keywords == '关键字来路流量 X2淘点')
			{
					keynums = 1;	
			}
			else
			{
				keynums = 2;	
			}

			
		}
			
			


		var total_discount = format_money(price*days*price_offset)-format_money(price*days*price_offset*discount);
		var total_discount = format_money(total_discount);
		var total_price_old = format_money(price*days*price_offset);
		//得到总价格
		
		var total_price = format_money(price*days*price_offset*discount*keynums);
		
		$('#total_price').val(total_price);
		$('#total_price_show').text(total_price);
		if (total_discount){
			$('#txt_total_discount').text("(原价："+total_price_old+"个淘点，已优惠："+total_discount+"个淘点)");
		}else{
			$('#txt_total_discount').text("");
		}
		
		
		return total_price;
	}
	
	function check_buyip(){
		var url = $('#url').val();
		var nums =0;
		var pnums =0;
		var urls = document.getElementsByName('url_referer[]');
		var province = document.getElementsByName('province[]');
		var $ipsvalue = $('#ips option:selected').val();
        var strRegex = /^http:\/\/([0-9a-z'()-]+\.)*((taobao)|(tmall)|(alibaba)|(paipai))\.com\/*/i;
        var re=new RegExp(strRegex);  
		var need_adv = $('#need_adv').attr('value');
		var times    = $('input[name=days]:checked').val();
		var days=0;
		if (need_adv=="1" && $('#adv_seting_1').is(":checked")){
			days = GetDiff();
		}else{
			days= times;
			GetEndTime(times);
		}
		$('#day').val(days);
		if (days=='0'){
			alert("购买时间不能为0!");	
			return false;
		}
		if (!re.test(url)){
			$("#url").focus();
			alert("请输入正确的\"IP流量地址\"!");
			return false;	
		}
		value=get_total_price();
		if(value===false || isNaN(value)){return false;}
		var s = '请确认购买流量信息：\n\n';
		s += '需要流量的网址：'+ $('#url').val() + '\n';
		s += 'IP标准：'+ $ipsvalue + 'IP/天\n';
		s += '开始时间：'+ $('#start_time').val() + '\n';
		s += '结束时间：'+ $('#end_time').val() + '\n';
		if (need_adv==1 && $('#adv_seting_3').is(":checked")){
		if(urls.length>0){
		for (var i=0; i<urls.length; i++) {
		if (urls[i].value.length > 0) {
	        nums++;
		}
		}
		}
		}
		if (need_adv==1 && $('#adv_seting_4').is(":checked")){
		for (var i=0; i<34; i++) {
		if (province[i].checked) {
	        pnums++;
		}
		}
		}
		if($('#pvs').val()>0){
		s += '自定义PV：'+ $('#pvs').val() + '\n';
		}
		if(nums>0){
		s += '自定义访问来源：'+ nums + '个\n';
		}
		if(pnums>0){
		s += '自定义地区：'+ pnums + '个\n';
		}
		s += '购买价格：'+ value + '个淘点\n';
		
		if (confirm(s)){
			return true;
		}
		return false;
	}
	function format_money(price){
    return ForDight(price,2);
	return price;
	return  parseInt(price*100)/100;
   }
   function  ForDight(Dight,How)  
{  
	Dight  =  Math.round  (Dight*Math.pow(10,How))/Math.pow(10,How);  
	return  Dight;  
} 
	function renew_ip_check(){
		var days = $('#days').val();
		var price = $('#price').val();
		days = parseInt(days);
		if (!days){
			alert("请输入一个正确的天数！");
			$('#days').val(1);
			return false;
		}

		var discount=1;
		var total_discount = format_money(price*days)-format_money(price*days*discount);
		var total_discount = format_money(total_discount);
		var total_price_old = format_money(price*days);
		
		//得到总价格
		var total_price = format_money(price*days*discount);
		
		$('#total_price').val(total_price);
		$('#total_price_show').text(total_price);
		if (total_discount){
			$('#txt_total_discount').text("(原价："+total_price_old+"元，已优惠："+total_discount+"元)");
		}else{
			$('#txt_total_discount').text("");
		}

		return true;
	}

	function GetEndTime(days){
		var Date1=$('#start_time').val().substr(0,10);
		obj1=Date1.split("-");
		var unixtime1 = new Date(obj1[0], obj1[1]-1, obj1[2]).getTime()/1000;
		var unixtime2 = unixtime1 + 60*60*24*days;
		var unixTimestamp = new Date(unixtime2 * 1000);
		
		var year = unixTimestamp.getFullYear();
		var month = parseInt(unixTimestamp.getMonth())+1;
		if (month<10)
			month = '0'+month;
		
		var day = parseInt(unixTimestamp.getDate());
		if (day<10)
			day = '0'+day;

		var hour = parseInt(unixTimestamp.getHours());
		if (hour<10)
			hour = '0'+hour;

		var minute = parseInt(unixTimestamp.getMinutes());
		if (minute<10)
			minute = '0'+minute;

		var sec = parseInt(unixTimestamp.getSeconds());
		if (sec<10)
			sec = '0'+sec;

		var dateymdhis = year+'-'+month+'-'+day+' '+hour+':'+minute+':'+sec;
		$('#end_time').val(dateymdhis);
	}

	function GetDiff()
	{
		var Date1,Date2;
		Date1=$('#start_time').val().substr(0,10);
		Date2=$('#end_time').val().substr(0,10);
		obj1=Date1.split("-");
		objDate1=new Date(obj1[0], obj1[1]-1, obj1[2]);
		cdate1=objDate1.getTime();		
		obj2=Date2.split("-");
		objDate2=new Date(obj2[0], obj2[1]-1, obj2[2]);
		cdate2=objDate2.getTime();
		if (cdate1>cdate2)
		{
			return 0;
		}
		else
		{
			return DateDiff(Date1,Date2);
		}
	}	

	function DateDiff(sDate1, sDate2){  //sDate1和sDate2是2002-12-18格式
		var aDate, oDate1, oDate2, iDays;
		aDate = sDate1.split("-");
		oDate1 = new Date(aDate[0],aDate[1]-1,aDate[2]);  //转换为12-18-2002格式
		aDate = sDate2.split("-");
		oDate2 = new Date(aDate[0],aDate[1]-1,aDate[2]);
		iDays = parseInt(Math.abs(oDate1 - oDate2) / 1000 / 60 / 60 /24*10) ; //把相差的毫秒数转换为天数
		if ((iDays/10) == parseInt(iDays/10)){
			return parseInt(iDays/10);
		}else{
			return parseInt(iDays/10+1);
		}
	}
    function cs_check_collect(){
		var nums= $('#nums').val();
		if (!isMatch(/^\d+$/, nums)){
			$('#nums').val('');
		}
		}
		
		
	 function cs_check_keywords(){
		var keywords= $('#keywords').val();
		if (!isMatch(/^\d+$/, keywords)){
			$('#keywords').val('');
		}
		}
		
		
	
		
	function cs_count_collect(){
		var nums= $('#nums').val();
		if (!isMatch(/^\d+$/, nums)){
			$('#nums').val('');
		}
		else{
			total_price=format_money(nums*0.1);
			$('#collect_price').text(total_price);
			}
		}
	function check_cs(){
		var url = $('#cs_url').val();
		var nums= $('#nums').val();
		var cs_mark= $('#cs_mark').val();
		var strRegex = /^http:\/\/([0-9a-z'()-]+\.)*((taobao)|(tmall)|(alibaba)|(paipai))\.com\/*/i;
        var re=new RegExp(strRegex);  
		if (!re.test(url)){
			$("#cs_url").focus();
			alert("请输入正确的\"宝贝或店铺地址\"!");
			
			return false;	
		}
		
		if (!isMatch(/^\d+$/, nums)) {
			alert('购买数量必须为整数');
			$('#nums').focus();
			return false;
		}
		if(nums<10){
			alert('购买收藏10个起购买，24小时内到达');
			$('#nums').focus();
			return false;
			}
		var s = '请确认购买收藏信息：\n\n';
		s += '需要收藏的网址：'+ url + '\n';
		s += '收藏标签：'+ cs_mark + '\n';
		s += '购买数量：'+ nums + '\n';
		if (confirm(s)){
			return true;
		}
		return false;
    }
	    
	   