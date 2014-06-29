<?php
class multi_page{
	public static function parse($pagecount,$pagesize,$page,$url_list,$style,$ppagesize=10, $saveName = ''){
		$style=preg_replace("/\\/\*(.*?)\*\\//s","",$style);
		if(is_array($url_list)){
			$url=$url_list[0];
			$url_default=$url_list[1];
		} else {
			$url=$url_list;
			$url_default='';
		}
		$urls=explode('{page}',$url);
		$useppage=true;
		$tmp=$pagecount;
		--$tmp<0&&$tmp=0;
		$minpage=1;
		$maxpage=floor($tmp/$pagesize)+1;
		$tmp=$maxpage;
		--$tmp<0&&$tmp=0;
		$minppage=1;
		//$ppagesize=10;
		$maxppage=floor($tmp/$ppagesize)+1;
		if($useppage){
			$tmp=$page;
			//--$tmp<0&&$tmp=0;
			$atpage=floor($tmp/$ppagesize)+1;
			$pagestart=($atpage-1)*$ppagesize+1;
			//
			
			$pagestart>$page&&$pagestart=$page;
			$pagestart>$minpage&&$page==$pagestart&&($pagestart-=1);
			$pageend=$atpage*$ppagesize;
			$pageend>$maxpage&&$pageend=$maxpage;
			$pageend-$pagestart+1>$ppagesize&&($pageend=$pagestart+$ppagesize-1);//控制页数长度为固定长度
		} else {
			$pagestart=1;
			$pageend=$pagecount;
		}
		$saveName || $saveName = md5($style);
		$cache_file=WROOT.'./cache/multi_page/'.$saveName.'.php';
		if(!file_exists($cache_file)){
			$style=str_replace('"','\"',$style);
			$style=preg_replace("/{pages}\s*(.*?)\s*{\\/pages}/es","'\";'.self::multi_loop('$1').'\$html.=\"'",$style);
			$style=preg_replace('/({.*?)minpage(.*?})/','$1$minpage$2',$style);
			$style=preg_replace('/({.*?)maxpage(.*?})/','$1$maxpage$2',$style);
			//$style=preg_replace('/({.*?)page(.*?})/','$1$page$2',$style);
			$style=str_replace('{$minpage}','".$minpage."',$style);
			$style=str_replace('{$maxpage}','".$maxpage."',$style);
			$style=str_replace('{page}','".$page."',$style);
			$style=str_replace('{count}','".$pagecount."',$style);
			//$style=str_replace('$min$page','".$minpage."',$style);
			//$style=str_replace('$max$page','".$maxpage."',$style);
			$style=preg_replace("/({url.*?)page(.*?})/",'$1$page$2',$style);
			$style=str_replace('$min$page','$minpage',$style);
			$style=str_replace('$max$page','$maxpage',$style);
			$style=preg_replace("/{page(>|<|=)(.+?)}(.*?){\\/page}/s",'";if($page$1$2){$html.="$3";};$html.="',$style);
			$style=preg_replace("/{url\s(.+?)}/",'".(($1)==$minpage&&$url_default?$url_default:($urls[0].($1).$urls[1]))."',$style);
			$style=preg_replace("/(\"|')\{else\}(\"|')/","\\1\\1;}else{\$html.=\\2\\2",$style);
			$style=preg_replace("/\{else\}/",'";}else{$html.="',$style);
			$style='$html="'.$style.'";';
			file_put_contents($cache_file,'<?php '.$style.'?>');
		}
		@include $cache_file;
		return $html;
	}
	public static function multi_loop($s){
		$s=str_replace('\\\"','\"',$s);
		//$url=str_replace('{page}','".$i."',$url);
		$s=str_replace('{page}','".$i."',$s);
		$s=str_replace('{url}','".$url."',$s);
		$s=str_replace('{select}','";if($i==$page){$html.="',$s);
		$s=str_replace('{else}','";}else{$html.="',$s);
		$s=str_replace('{/select}','";};$html.="',$s);
		//$s='for($i=$pagestart;$i<=$pageend;$i++){$url=$urls[0].$i.$urls[1];$html.="'.$s.'";}';
		$s='for($i=$pagestart;$i<=$pageend;$i++){if($i==1&&$url_default)$url=$url_default;else $url=$urls[0].$i.$urls[1];$html.="'.$s.'";}';
		return $s;
	}
	public static function multi_url($page,$url){
		return str_replace('{page}',$page,$url);
	}
	public static function multi_url_replace($s,$page,$minpage,$maxpage){
		$s=str_replace("minpage",$minpage,$s);
		$s=str_replace("maxpage",$maxpage,$s);
		$s=str_replace("page",$page,$s);
		if(preg_match("/^(\d+)(\+|-)(\d+)$/",$s,$matches)){
			switch($matches[2]){
				case '+':
					$rs=(int)$matches[1]+(int)$matches[3];
				break;
				case '-':
					$rs=(int)$matches[1]-(int)$matches[3];
				break;
			}
		} else $rs=(int)$s;
		return $rs;
	}
}
?>