<?php
//Code By Safe3 
function customError($errno, $errstr, $errfile, $errline)
{ 
 echo "<b>Error number:</b> [$errno],error on line $errline in $errfile<br />";
 die();
}
set_error_handler("customError",E_ERROR);
$getfilter="'|(and|or)\\b.+?(>|<|=|in|like)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$postfilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$cookiefilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
function StopAttack($StrFiltKey,$StrFiltValue,$ArrFiltReq){  

if(is_array($StrFiltValue))
{
    $StrFiltValue=implode($StrFiltValue);
}  
if (preg_match("/".$ArrFiltReq."/is",$StrFiltValue)==1){   
        //slog("<br><br>����IP: ".$_SERVER["REMOTE_ADDR"]."<br>����ʱ��: ".strftime("%Y-%m-%d %H:%M:%S")."<br>����ҳ��:".$_SERVER["PHP_SELF"]."<br>�ύ��ʽ: ".$_SERVER["REQUEST_METHOD"]."<br>�ύ����: ".$StrFiltKey."<br>�ύ����: ".$StrFiltValue);
        print "360websec notice:Illegal operation!";
        exit();
}      
}  
//$ArrPGC=array_merge($_GET,$_POST,$_COOKIE);
foreach($_GET as $key=>$value){ 
	StopAttack($key,$value,$getfilter);
}
foreach($_POST as $key=>$value){ 
	StopAttack($key,$value,$postfilter);
}
foreach($_COOKIE as $key=>$value){ 
	StopAttack($key,$value,$cookiefilter);
}
if (file_exists('update360.php')) {
	echo "���������ļ�update360.php����ֹ�ڿ�����<br/>";
    die();
}
function slog($logs)
{
  $toppath=$_SERVER["DOCUMENT_ROOT"]."/log.htm";
  $Ts=fopen($toppath,"a+");
  fputs($Ts,$logs."\r\n");
  fclose($Ts);
}
?>