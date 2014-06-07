<?php

!defined('IN_JB') && exit('error');
loadLib($libP . 'taobaoBase');

class data_taobaoUser extends data_taobaoBase
{

    public static function getApiUser($nick)
    {
        $args = array(
            'method' => 'taobao.user.get',
            'fields' => 'uid,nick,sex,buyer_credit,seller_credit,type,promoted_type,consumer_protection',
            'nick' => $nick
        );
        if (($rs = parent::get($args)) && $rs['user'])
        {
            $rs = $rs['user'];
            if (!$rs['promoted_type'])
            {
                $html = winsock::get_html('http://rate.taobao.com/user-rate-' . $rs['uid'] . '.htm');
                if (strpos($html, '支付宝实名认证') !== false)
                    $rs['promoted_type'] = 'authentication';
                else
                    $rs['promoted_type'] = 'not authentication';
                if (preg_match('/<li class="join-status">(.+?)<\/li>/is', $html, $matches))
                {
                    if (strpos($matches[1], '未加入') !== false)
                        $rs['consumer_protection'] = false;
                    else
                        $rs['consumer_protection'] = true;
                }else
                    $rs['consumer_protection'] = false;
            }
            return $rs;
        }else
        {
            return false;
        }
    }

    public static function userExists($nick)
    {
        $args = array(
            'method' => 'taobao.shop.get',
            'fields' => 'sid',
            'nick' => $nick
        );
        if (($rs = parent::get($args)) && $rs['shop']['sid'])
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function getUser($nick)
    {
        return self::getApiUser($nick);
    }

	public static function usercheck($nick)
    {
        $sContent = file_get_contents('http://member1.taobao.com/member/userProfile.jhtml?userID='. $nick);
		$re_shop_title = '/淘宝店铺\：\s*\<a.+\>(.+)\<\/a\>/';
	    $a_shop_title = array();
	    $s_shop_title = 0;
		    if(preg_match($re_shop_title, $sContent, $a_shop_title)){
		        $s_shop_title = $a_shop_title[1];
	        }
            if ($s_shop_title>0)
            {
			print_r($s_shop_title);
            //return true;
            }
            else
            {
			print_r($s_shop_title);
           // return false;
            }
    }
	public static function nickname($nick)
    {
        $u=$nick;
	    $agent = $_SERVER['HTTP_USER_AGENT']; 
	    if(!strpos($agent,"MSIE") && !strpos($agent,"Chrome")) 
	      $u = iconv("utf-8","gbk",$u);
	 
        $sc = file_get_contents('http://www.yaodamai.com/look?q='.$u);
        preg_match('/color:#333;">[0-9]\d*([\s\S]*)>查看店铺/is', $sc, $seller_rate);
        $bs=$seller_rate[0];
	
        preg_match('/>[0-9]\d*<\/b>/', $bs, $seller);
        print_r($seller[0]);
    }
	public static function realname($nick)
    {
        $u=$nick;
	    $agent = $_SERVER['HTTP_USER_AGENT']; 
	    if(!strpos($agent,"MSIE") && !strpos($agent,"Chrome")) 
	      $u = iconv("utf-8","gbk",$u);
        $sc = file_get_contents('http://www.yaodamai.com/look?q='.$u);
        preg_match('/<li>[^|]+?实名认证：[^|]+?>(.+)<\/[^|]+?<\/li>/', $sc, $seller);
        $seller[1];
		if($seller[1]=='支付宝认证'){
		    return '1';
		}elseif($seller[1]=='未认证'){
		    return '2';
		}else{
		    return '0';
		}
    }
	public static function credit($nick)
    {
        $u=$nick;
	    $agent = $_SERVER['HTTP_USER_AGENT']; 
	    if(!strpos($agent,"MSIE") && !strpos($agent,"Chrome")) 
	      $u = iconv("utf-8","gbk",$u);
        $sc = file_get_contents('http://www.yaodamai.com/look?q='.$u);
        $sc = file_get_contents('http://www.yaodamai.com/look?q='.$u);
        a='/out\svalue="(\d+)"\/>/';
        preg_match('/<ul class="u">[^|]+?买家信用[^|]+?#333;">(.+)<\/b>[^|]+?<\/ul>/', $sc, $buyer);

		return $buyer[1];
		
    }
}

?>