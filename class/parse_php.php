<?php
class parse_php{
	private static $replace=array();
	private static $m1,$m2;
	public static function start(){
		self::$m1='{';
		self::$m2='}';
		$replace=$r=$re=array();
		/*marker start*/$replace[]=array('{++ 0}','<?php echo 0+1;?>',false,array(1=>'1'));$replace[]=array('{stripslashes 0}','<?php echo stripslashes(0);?>',false,array());$replace[]=array('{clear}','<?php common::ob_clean();?>',false,array());$replace[]=array('{end_clear}','<?php ob_end_clean();?>',false,array());$replace[]=array('{exit}','<?php exit();?>',false,array());$replace[]=array('{eval\s+0}','<?php 0?>',false,array());$replace[]=array('{if 0}','<?php if(0){?>',false,array());$replace[]=array('{else}','<?php } else {?>',false,array());$replace[]=array('{elseif 0}','<?php } elseif(0) {?>',false,array());$replace[]=array('{/if}','<?php }?>',false,array());$replace[]=array('{loop 0 1 2}','<?php if(0){foreach(0 as 1[=>2?]){?>',false,array());$replace[]=array('{/loop}','<?php }}?>',false,array());$replace[]=array('{js_select 0}','echo template::js_select(\'0\');',true,array());$replace[]=array('{css_select 0}','echo template::css_select(\'0\');',true,array());$replace[]=array('{date 0}','<?php echo date(\'Y-m-d H:i:s\',0);?>',false,array());$replace[]=array('{teval 0}','0',true,array());$replace[]=array('{template 0}','<?php include(template::load(\'0\'));?>',false,array());$replace[]=array('{subtemplate 0}','echo template::loadsubtemplate(\'0\');',true,array());$replace[]=array('{tpl_eval 0}','0',true,array());$replace[]=array('{switch 0 1}','<?php switch(0){case 1:?>',false,array());$replace[]=array('{case 0}','<?php break;case 0:?>',false,array());$replace[]=array('{case_else}','<?php break;default:?>',false,array());$replace[]=array('{/switch}','<?php break;}?>',false,array());$replace[]=array('{html 0}','<?php echo htmlspecialchars(0);?>',false,array());$replace[]=array('{block 0}','echo template::stripblock(\'0\');',true,array());$replace[]=array('{lang 0}','echo language::get(\'0\',\'index\',\'default\');',true,array());$replace[]=array('{lang2 0}','<?=language::get(0)?>',false,array());$replace[]=array('{ip 0}','<?php echo common::intip(0);?>',false,array());$replace[]=array('{rewrite}','<?php
if(!$web_rewrite)echo $weburl2.\'rewrite.php?rewrite=\';
?>',false,array());$replace[]=array('{cut 0,1}','<?php
echo common::cutstr(0,1);
?>',false,array());$replace[]=array('{url 0}','<?php
echo urlencode(0);
?>',false,array());$replace[]=array('{adminForm\s+0}','echo admin::form(\'0\');',true,array());$replace[]=array('{adminList\s+0}','echo admin::getTplList(\'0\');',true,array());$replace[]=array('{echo 0}','<?php
 echo 0;
?>',false,array());$replace[]=array('{sub 0}','echo template::loadsubtemplate(\'0\');',true,array());$replace[]=array('{pa 0}','if($data=db::one_one(\'page_article\',\'content\',"marker=\'0\'")){
echo string::ubbDecode($data);
}',true,array());$replace[]=array('{ad 0}','echo background::getAd(\'0\');',true,array());$replace[]=array('{ad2 0}','echo background::getAd2(\'0\');',true,array(2=>'2'));$replace[]=array('{cutstr 0,1}','<?php echo common::cutstr(0,1);?>',false,array());$replace[]=array('{xheditor 0,1,2,3}','echo xheditor::getEditorCode(\'1\', 2, 3, \'0\');',true,array());$replace[]=array('{for 0 1}','<?php for($i=0;$i<=1;$i++){?>',false,array());$replace[]=array('{/for}','<?php }?>',false,array());$replace[]=array('{sql\s+0}','echo \'<?php
$query=$db->query("\'.trim(\'0\').\'");
$_sqlList=array();
while($line=$db->fetch_array($query))$_sqlList[]=$line;
foreach($_sqlList as $k=>$v){
?>\';',true,array());$replace[]=array('{/sql}','<?php }?>',false,array());$replace[]=array('{plugin 0}','<?php plugins::callName(\'0\');?>',false,array());$replace[]=array('{r}','<?php
if(!$web_rewrite)echo $weburl2.\'rewrite.php?rewrite=\';
?>',false,array());$replace[]=array('{u}','<?php echo $weburl2;?>',false,array());$replace[]=array('{?}','<?php echo $web_rewrite?\'?\':\'&\';?>',false,array());$replace[]=array('{cache 0,1,2}','<?php
if (cacheData::cacheStart(__FILE__, 0[,1?][,2?])){
?>',false,array());$replace[]=array('{/cache}','<?php
}
cacheData::cacheEnd(__FILE__);
?>',false,array());$replace[]=array('{nocache}','<?php
}
cacheData::nocacheStart(__FILE__);
?>',false,array());$replace[]=array('{/nocache}','<?php
if (cacheData::nocacheEnd(__FILE__)){
?>',false,array());$replace[]=array('{cfg 0,1}','<?php
echo cfg::get(\'0\', \'1\');
?>',false,array());$replace[]=array('{date2 0}','<?php echo 0>1?date(\'Y-m-d H:i:s\',0):\'\';?>',false,array(1=>'0'));/*marker end*/
		foreach($replace as $k=>$v){
			$v[0]=str_replace('{',self::$m1,$v[0]);
			$v[0]=str_replace('}',self::$m2,$v[0]);
			$name=self::marker_name($v[0]);
			$re['name']=$name;
			$re['s']=$v[0];
			$re['d']=$v[1];
			$re['r0']=self::$m1.$re['name'].self::$m2==$re['s'];
			!$re['r0']&&$re['s1']=substr($re['s'],strlen($re['name'])+1,-1);
			$re['r1']=strpos($v[0],self::$m1.'/'.$name.self::$m2)!==false?true:false;
			$re['output']=$v[2]===true?true:false;
			$re['args']=$v[3]?$v[3]:array();
			$r[$re['name']]=$re;
		}
		self::$replace=$r;
	}
	private static function marker_name($m){
		$len=strlen($m);
		$name='';
		$at_marker=false;
		for($i=0;$i<$len;$i++)	{
			$s=substr($m,$i,1);
			$len2=$len-$i-1;
			if($at_marker) {
				if($s==self::$m2 || in_array($s,array(" ","\r","\n","\t","\\"))) {
					break;
				} else $name.=$s;
			} else {
				if($s==self::$m1) $at_marker=true;
			}
		}
		return $name;
	}
	private static function get_vars($s,$d) {
		$len1=strlen($d);
		$len2=strlen($s);
		$c='';
		$k=-1;
		$rn=array();
		for($i=0;$i<$len1;$i++){
			$l=$k==-1?$i:$k;
				$s1=substr($d,$i,1);
				$s2=substr($s,$l,1);
				if($s1!=$s2 || is_numeric($s1)) {
					if(is_numeric($s1)) {
						$n='';
						$next=-1;
						$end='';
						for($j=$i;$j<$len1;$j++){
							$s3=substr($d,$j,1);
							if(!is_numeric($s3)){
								$next=$j-1;
								$end=$s3;
								break;
							} else $n.=$s3;
						}
						$str='';
						for($j=$l;$j<$len2;$j++){
							$s3=substr($s,$j,1);
							if($end) {
								if($s3==$end)break;
								else $str.=$s3;
							} else $str.=$s3;
						}
						$rn[$n]=$str;
						if($j==$len2)break;
						else $k=$j;
						if($next==-1)$i=$len1;
						else $i=$next;
					} else {
						if($s1=='\\') {
							$c=substr($d,$i+1,1);
							switch($c) {
								case 's':
									$m=substr($d,$i+2,1);
									if($m=='+')$c.=$m;
								break;
								case 'd':
									$m=substr($d,$i+2,1);
									if($m=='+')$c.=$m;
								break;
							}
							$c='\\'.$c;
							for($j=$l;$j<$len2;$j++) {
								$s3=substr($s,$j,1);;
								switch($c) {
									case '\s':
										if(!in_array($s3,array(" ","\r","\n","\t")))break 3;
										else {
											$k=$j+1;
											break 2;
										}
									break;
									case '\s+':
										if(!in_array($s3,array(" ","\r","\n","\t"))) {
											if($j!=$l) {
												$k=$j;
												break 2;
											} else break 3;
										}
									break;
									case '\d':
										if(!is_numeric($s3))break 3;
										else {
											$k=$j+1;
											break 2;
										}
									break;
									case '\d+':
										if(!is_numeric($s3)) {
											if($j!=$l) {
												$k=$j;
												break 2;
											} else break 3;
										}
									break;
								}
							}
							$i+=strlen($c)-1;
							//echo $s1,'|',$s2,'|',$k,'<br />';
						}
					}
				} else {
					if($k!=-1)$k++;
				}
		}
		return $rn;
	}
	private static function replace_marker($str,$k,$arr){
		if($arr[$k])return $str.$k;
		else return '';
	}
	private static function addquote($var) {
		return str_replace("\\\"", "\"", preg_replace("/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $var));
	}
	private static function css_select($css_list){
		$css_list=explode(',',$css_list);
		foreach($css_list as $css)css::select_lib($css);
		return css::output(true);
	}
	private static function js_select($js_list){
		$js_list=explode(',',$js_list);
		foreach($js_list as $js)javascript::select_lib($js);
		return javascript::output(true);
	}
	private static function replace_vars($var, $vars){
		$var = stripslashes($var);
		switch (substr($var, 0, 1)) {
			case '\'':
				$i = substr($var, 1, -1);
				return '\''.addcslashes($vars[$i], '\'\\').'\'';
			break;
			case '"':
				$i = substr($var, 1, -1);
				return '"'.addcslashes($vars[$i], '"\\').'"';
			break;
			default:
				$i = $var;
				return $vars[$i];
			break;
		}
	}
	public static function parse($code){
		$len=strlen($code);
		$at_marker=$at_str=$at_php=$at_var=$at_m2=$var_end=false;
		$code2=$phpcode=$m='';
		$m1=$m2=$m2A=$m2B=0;
		$var='';
		for($i=0;$i<$len;$i++){
			$s=substr($code,$i,1);
			$len2=$len-$i-1;
			if($at_php) {
				if($at_str) {
					if($s=='\\' && $len2>0 && substr($code,$i+1,1)==$m) {
						$phpcode.=$s.$m;
						$i++;
					} elseif($s==$m) {
						$phpcode.=$s;
						$at_str=false;
					} else $phpcode.=$s;
				} else {
					if(s=='\'' || $s=='"'){
						$at_str=true;
						$m=$s;
						$phpcode.=$s;
					} elseif($s=='?' && $len2>0 && substr($code,$i+1,1)=='>') {
						$i++;
						$at_php=false;
						//$phpcode=self::phpcode_trim($phpcode);
						if(!$phpcode || substr($phpcode,0,1)!='=')$phpcode=' '.$phpcode;
						$code2.=$phpcode.'?>';
					} else $phpcode.=$s;
				}
			} else {
				if($at_marker) {
					if($s==self::$m1){
						$m1++;
						$m.=$s;
					} elseif($s==self::$m2) {
						$m2++;
						if($m2==77){
							echo $m;
							exit;
						}
						if($m1==$m2) {
							$name=self::marker_name(self::$m1.$m.self::$m2);
							if($re=self::$replace[$name]) {
								$rs='';
								$vars=array();
								if($re['r0'])$rs=$re['d'];
								elseif($re['r1']) {
									
								} else {
									if($vars=self::get_vars(substr($m,strlen($re['name'])),$re['s1'])){
										$rs=$re['d'];
										//$re['args']&&$vars=array_merge($vars,$re['args']);
										$re['args'] && $vars += $re['args'];
										$rs=preg_replace("/\[(.*?)(\d+)\?\]/e","self::replace_marker('\\1','\\2',\$vars)",$rs);
										//$rs=preg_replace('/\'(\d+)\'/e', '\'\\\'\'.addcslashes(\$vars[\'$1\'], \'\\\'\\\\\\\\\').\'\\\'\'', $rs);
										//$rs=preg_replace("/(\d+)/e",'\$vars[\'$1\']',$rs);
										$rs = preg_replace('/(\'\d+\'|\d+|"\d+")/e', 'self::replace_vars(\'$1\', \$vars)', $rs);
										if($re['output']){
											//eval('$rs='.$rs.';');
											$rs=common::get_eval($rs);
										}
										//foreach($vars as $k=>$v){
										//	$rs=str_replace($k,$v,$rs);
										//}
									}
								}
								$code2.=$rs;
							} else {
								if($m==$name && substr($m,0,1)=='$' && strlen($m)>1 && (($ord=ord(substr($m,1,1)))>0 && ($ord==0x5f || ($ord>=0x41 and $ord<=0x5a) || ($ord>=0x61 and $ord<=0x7a) || ($ord>=0x7f and $ord<=0xff))))$code2.='<?='.$m.'?>';
								else $code2.=self::$m1.'<?php '.self::parse($m).'?>'.self::$m2;
							}
							$at_marker=false;
						} else $m.=$s;
					} else $m.=$s;
				} else {
					if($at_var){
						$ord=ord($s);
						if(!$var_end && ($ord==0x5f || ($ord>=0x30 and $ord<=0x39) || ($ord>=0x41 and $ord<=0x5a) || ($ord>=0x61 and $ord<=0x7a) || ($ord>=0x7f and $ord<=0xff))){
							$var.=$s;
							if($len2==0)$code2.='<?=$'.$var.'?>';
						} else {
							if($at_m2) {
								$var.=$s;
								if ($s == ']'){
									$m2B++;
									if($m2A == $m2B){
										$at_m2=false;
										if($len2==0){
											$code2.='<?=$'.$var.'?>';
										}
									}
								} elseif ($s == '[') {
									$m2A++;
								}
								
							} else {
								if($s=='[') {
									$var_end = true;
									$at_m2 = true;
									$var.=$s;
									$m2A = 1;
									$m2B = 0;
								} else {
									$code2.='<?=$'.$var.'?>';
									$at_var=$at_m2=false;
									$i--;
								}
							}
						}
					} else {
						if($len2>3 && $s=='<' && substr($code,$i+1,1)=='?') {
							$at_php=true;
							$phpcode='';
							$code2.='<?';
							$i++;
							if(substr($code,$i+1,3)=='php'){
								$code2.='php';
								$i+=3;
							}
						} elseif($s==self::$m1) {
							$m1=1;
							$m2=0;
							$m='';
							$at_marker=true;
						} elseif($s=='$') {
							if($len2>0) {
								$ord=ord(substr($code,$i+1,1));
								if($ord==0x5f || ($ord>=0x41 and $ord<=0x5a) || ($ord>=0x61 and $ord<=0x7a) || ($ord>=0x7f and $ord<=0xff)){
									$at_var=true;
									$var='';
									$var_end=false;
								} else $code2.=$s;
							} else $code2.=$s;
						} else $code2.=$s;
					}
				}
			}
		}
		$code2=preg_replace("/<\?\=(.+?)\?>/",'<?php echo $1;?>',$code2);
		$code2=preg_replace('/\?>(\s*)<\?php/','echo \'$1\';',$code2);
		$code2=self::format_phpcode($code2);
		return $code2;
	}
	public static function format_phpcode($code,$start=0){
		$rn='';
		$code=str_replace("\r\n","\n",$code);
		if(($fa=strpos($code,'<?',$start))!==false){
			if($fa>$start) {
				//$rn.='echo \''.str_replace('\\\\\'','\\\\\\\'',str_replace('\'','\\\'',substr($code,$start,$fa-$start))).'\';';
				$rn.='echo \''.addcslashes(substr($code,$start,$fa-$start),'\'\\').'\';';
			}
			$len=strlen($code);
			$ignore=false;
			$atstr=false;
			$s_m='';//标记
			$str1=$str2=0;
			$is_echo=substr($code,$fa+2,1)=='='?true:false;
			$phpcode='';
			for($i=$fa;$i<$len;$i++){
				if(!$atstr){
					$s=substr($code,$i,1);
					if($s=='\''||$s=='"') {
						$s_m=$s;
						$atstr=true;
						$str1=$i;
						$phpcode.=$s;
					} elseif($s=='/') {
						if($i+1<$len){
							$s=substr($code,$i+1,1);
							if($s=='/') {
								if(($fb=strpos($code,"\n",$i+2))!==false){
									//echo substr($code,$i,$fb-$i),'<br />';//斜杠注释
									$i=$fb;
								}
							} elseif($s=='*') {
								if(($fb=strpos($code,"*/",$i+2))!==false){
									//echo substr($code,$i,$fb+2-$i),'<br />';//星号注释
									$i=$fb+1;
								}
							} else $phpcode.='/';
						}
					} elseif($s=='?' && $i+1<$len && substr($code,$i+1,1)=='>') {
						$phpcode.='?>';
						//echo $phpcode;exit;
						//$phpcode=substr($code,$fa,$i+2-$fa);
						$phpcode=substr($phpcode,2,strlen($phpcode)-4);
						if($is_echo){
							$phpcode='echo '.substr($phpcode,1).';';
						} else {
							if(substr($phpcode,0,3)=='php')$phpcode=substr($phpcode,3);
							//$phpcode=preg_replace('/\/\*.*?\*\//s','',$phpcode);
							//$phpcode=preg_replace("/\/\/.*?\n/",'',$phpcode);
						}
						$phpcode=self::phpcode_trim($phpcode);
						$rn.=$phpcode;
						if($i+2<$len)$rn.=self::format_phpcode($code,$i+2);
						break;
					} else {
						$phpcode.=$s;
						/*if(!$ignore||!in_array($s,array(' ',"\t","\r","\n"))) {
							$phpcode.=$s;
							$ignore=false;
							if(in_array($s,array(';','{','}',',','+','-','*','/','?','|','&','=')))$ignore=true;
						} else {
							if(!$ignore)$phpcode.=$s;
						}*/
					}
				} else {
					$s=substr($code,$i,1);
					$phpcode.=$s;
					/*if($s=='\\'){
						if($i+1<$len) {
							$s2=substr($code,$i+1,1);
							if($s2==$s_m) {
								$phpcode.=$s_m;
								$i++;
							}
						}
					} elseif($s==$s_m) {
						$str2=$i;
						$atstr=false;
					}*/
					if($s=='\\'&& $i+1<$len && in_array(substr($code,$i+1,1),array($s_m,'\\'))==$s_m) {
						$phpcode.=substr($code,$i+1,1);
						$i++;
					} elseif($s==$s_m) {
						$str2=$i;
						$atstr=false;
						//echo substr($code,$str1,$str2-$str1+1),'<br />';
					}
				}
			}
		} else $rn.='echo \''.addcslashes(substr($code,$start),'\'\\').'\';';
		return $rn;
	}
	public static function phpcode_trim($code){
		$code=str_replace("\r\n","\n",$code);
		$len=strlen($code);
		$atstr=false;
		$ignore=false;
		$s_m='';//标记
		$phpcode='';
		for($i=0;$i<$len;$i++){
			if(!$atstr){
				$s=substr($code,$i,1);
				if($s=='\''||$s=='"') {
					$s_m=$s;
					$atstr=true;
					$phpcode.=$s;
					$ignore=false;
				} else {
					if(!$ignore||!in_array($s,array(' ',"\t","\r","\n"))) {
						if($s=='/' && $i+1!=$len) {
							switch(substr($code,$i+1,1)){
								case '/':
									if(($fa=strpos($code,"\n",$i+2))!==false) {
										$i=$fa;
									} else $i = $len - 1;//这里新增如果有错误请删除
								break;
								case '*':
									if(($fa=strpos($code,"*/",$i+2))!==false) {
										$i=$fa+1;
									}
								break;
								default :
									$phpcode.=$s;
									$ignore = true;
								break;
							}
						} else {
							$phpcode.=$s;
							$ignore=false;
							if(in_array($s,array(';','{','}',',','+','-','*','/','?',':','|','&','=','>','<','(',')')))$ignore=true;
						}
					} else {
						if(!$ignore)$phpcode.=$s;
					}
				}
			} else {
				$s=substr($code,$i,1);
				$phpcode.=$s;
				$s2=substr($code,$i+1,1);
				if($s=='\\'&& $i+1<$len && ($s2=='\\' || $s2==$s_m)) {
					$phpcode.=$s2;
					$i++;
				} elseif($s==$s_m) {
					$atstr=false;
				}
			}
		}
		$code=strrev($phpcode);
		$phpcode='';
		$len=strlen($code);
		$atstr=false;
		$ignore=false;
		$s_m='';//标记
		$phpcode='';
		for($i=0;$i<$len;$i++){
			if(!$atstr){
				$s=substr($code,$i,1);
				if($s=='\''||$s=='"') {
					$s_m=$s;
					$atstr=true;
					$phpcode.=$s;
					$ignore=false;
				} else {
					if(!$ignore||!in_array($s,array(' ',"\t","\r","\n"))) {
						$phpcode.=$s;
						$ignore=false;
						if(in_array($s,array(';','{','}',',','+','-','*','/','?',':','|','&','=','>','<','(',')')))$ignore=true;
					} else {
						if(!$ignore)$phpcode.=$s;
					}
				}
			} else {
				$s=substr($code,$i,1);
				$phpcode.=$s;
				if($s==$s_m && $i+1<$len && substr($code,$i+1,1)=='\\') {
					$phpcode.='\\';
					$i++;
				} elseif($s==$s_m) {
					$atstr=false;
				}
			}
		}
		$phpcode=trim(strrev($phpcode));
		return $phpcode;
	}
	private static function replaceArray($str){
		$str = stripslashes($str);
		if (substr($str, 0, 1) == '\'' && substr($str, -1, 1) == '\'') return $str;
		if (substr($str, 0, 1) == '"' && substr($str, -1, 1) == '"') return $str;
		if (substr($str, 0, 1) == '$') return $str;
		if (preg_match('/^[1-9]\d*$/', $str)) return $str;
		if (strpos($str, '\'.$') !== false) return $str;
		if (strpos($str, '".$') !==false) return $str;
		return '\''.common::bf_addcslashes($str).'\'';
	}
	public static function formatArray($code){
		if ( ($FA = strpos($code, '<?')) !==false ) {
			$rn = '';
			$offset = 0;
			$len = strlen($code);
			while ( (($FA = strpos($code, '<?', $offset)) !==false) ) {
				$rn .= substr($code, $offset, $FA - $offset);//获取HTML代码
				$FA += 2;
				if (substr($code, $FA, 3) == 'php') {
					$rn.='<?php';
					$FA += 3;
				} else {
					$rn.='<?';
				}
				$inStr = $inVar = $inArr = $varEnd = $end = false;
				$lastChar = $char = $strQuote = $var = '';
				$i = $m1 = $m2 = 0;
				for ($i = $FA; $i < $len; $i++) {
					$char = substr($code, $i, 1);
					if ($i + 1 == $len) $end = true;
					if ($inStr) {
						$rn .= $char;
						if ($char == $strQuote && $lastChar != '\\') $inStr = false;
					} elseif ($inVar) {
						$ord = ord($char);
						if(!$varEnd && ($ord==0x5f || ($ord>=0x30 and $ord<=0x39) || ($ord>=0x41 and $ord<=0x5a) || ($ord>=0x61 and $ord<=0x7a) || ($ord>=0x7f and $ord<=0xff))){
							$var .= $char;
							if($end) $rn .= '$'.$var;
						} else {
							if($inArr) {
								$var .= $char;
								if ($char == ']'){
									$m2++;
									if($m1 == $m2){
										$inArr = false;
										if ($end) {
											$var = preg_replace('/\[([^\[\]]+)\]/e', '\'[\'.self::replaceArray(\'$1\').\']\'', $var);
											$rn .= '$'.$var;
										}
									}
								} elseif ($char == '[') {
									$m1++;
								}
								
							} else {
								if($char == '[') {
									$varEnd = true;
									$inArr = true;
									$var .= $char;
									$m1 = 1;
									$m2 = 0;
								} else {
									$var = preg_replace('/\[([^\[\]]+)\]/e', '\'[\'.self::replaceArray(\'$1\').\']\'', $var);
									$rn .= '$'.$var;
									$inVar = $inArr = false;
									$i--;
								}
							}
						}
					} else {
						if (in_array($char, array('\'', '"'))) {
							$inStr = true;
							$strQuote = $char;
							$rn .= $char;
						} elseif ($char == '$') {
							if(!$end) {
								$ord = ord(substr($code, $i + 1, 1));
								if($ord == 0x5f || ($ord>=0x41 and $ord<=0x5a) || ($ord>=0x61 and $ord<=0x7a) || ($ord>=0x7f and $ord<=0xff)){
									$inVar = true;
									$varEnd = false;
									$var = '';
								} else $rn .= $char;
							} else $rn .= $char;
						} elseif ($char == '?') {
							$rn .= $char;
							if (!$end) {
								if (substr($code, $i + 1, 1) == '>') {
									$i += 2;
									$rn .= '>';
									break;
								}
							}
						} else $rn .= $char;
					}
					$lastChar = $char;
				}
				$offset = $i;
				//$FB = strpos($code, '? >', $offset);
				//$offset = $FB + 2;
				
			}
			$rn .= substr($code, $offset);
			return $rn;
		} else {
			return $code;
		}
	}
}
parse_php::start();
?>