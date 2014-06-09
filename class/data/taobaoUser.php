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
	    $dom=file_get_html('http://sy.tertw.net/getMember/username/'.urlencode($nick).".html");
        return trim($dom->find('ul.u',1)->find('li',1)->find('span',0)->find('b',0)->plaintext);
    }
	public static function realname($nick)
    {
        $u=$nick;
        $dom=file_get_html('http://sy.tertw.net/getMember/username/'.urlencode($nick).".html");
        $renzheng=trim($dom->find('.r-c ul',0)->find('li',0)->find('font',0)->plaintext);
		if($renzheng=='支付宝认证'){
		    return '1';
		}elseif($renzheng=='未认证'){
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
        $dom=file_get_html('http://sy.tertw.net/getMember/username/'.urlencode($nick).".html");
        return $xinyu=trim($dom->find('ul.u',0)->find('li',1)->find('span',0)->find('b',0)->plaintext);
    }
}

?>