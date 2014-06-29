<?php
class xheditor{
	private static $name, $width, $height;
	public static function getEditor($name, $width, $height, $e){
		$e = '_'.$e;
		if(!method_exists(xheditor, $e))$e = '_full';
		self::$name   = $name;
		self::$width  = $width;
		self::$height = $height;
		return self::$e();
	}
	public static function getEditorCode($name, $width, $height, $e){
		$code = self::getEditor($name, $width, $height, $e);
		$code = parse_php::parse($code);
		return '<?php '.$code.';?>';
	}
	public static function _bbs(){
		$html = '<style type="text/css">
<!--
.uploadIco {
	background:transparent url({$weburl2}css/uploadIco.gif) no-repeat 16px 16px;
	background-position:2px 2px;
}
-->
</style>{js_select jquery,xheditor,xheditor_ubb}
		<textarea name="'.self::$name.'" id="'.self::$name.'" style="width:'.self::$width.'px;height:'.self::$height.'px">{html $'.self::$name.'}</textarea>
<script language="javascript">
var editor;
$(function(){editor=$(\'#'.self::$name.'\').xheditor('.file::read(dirname(__FILE__).D.'_bbs.js').');});
</script>';
		return $html;
	}
	public static function _full(){
		$html = '{js_select jquery,xheditor,xheditor_ubb}
		<textarea name="'.self::$name.'" id="'.self::$name.'" style="width:'.self::$width.'px;height:'.self::$height.'px">{html $'.self::$name.'}</textarea>
<script language="javascript">
var editor;
$(function(){editor=$(\'#'.self::$name.'\').xheditor({tools:\'full\',emotPath:\'{$weburl2}img/e/\',emotMark:true,beforeSetSource:ubb2html,beforeGetSource:html2ubb,upImgUrl:\'{$weburl2}ajax/upload.php?action=image\',upImgExt:\'jpg,jpeg,gif,png\'});});
</script>';
		return $html;
	}
	public static function _simple(){
		$html = '{js_select jquery,xheditor,xheditor_ubb}
		<textarea name="'.self::$name.'" id="'.self::$name.'" style="width:'.self::$width.'px;height:'.self::$height.'px">{html $'.self::$name.'}</textarea>
<script language="javascript">
var editor;
$(function(){editor=$(\'#'.self::$name.'\').xheditor({tools:\'Bold,Italic,Underline,FontColor,BackColor,Align,Link\',emotPath:\'{$weburl2}img/e/\',beforeSetSource:ubb2html,beforeGetSource:html2ubb,upImgUrl:\'{$weburl2}ajax/upload.php?action=image\',upImgExt:\'jpg,jpeg,gif,png\'});});
</script>';
		return $html;
	}
	public static function _article(){
		$html = '{js_select jquery,xheditor,xheditor_ubb}
		<textarea name="'.self::$name.'" id="'.self::$name.'" style="width:'.self::$width.'px;height:'.self::$height.'px">{html $'.self::$name.'}</textarea>
<script language="javascript">
var editor;
$(function(){editor=$(\'#'.self::$name.'\').xheditor({tools:\'Bold,Italic,Underline,Align,List,Outdent,Indent,Blocktag,FontColor,BackColor,Align,Link,Unlink,Removeformat,Table,Img,Source\',emotPath:\'{$weburl2}img/e/\',beforeSetSource:ubb2html,beforeGetSource:html2ubb,upImgUrl:\'{$weburl2}ajax/upload.php?action=userImage\',upImgExt:\'jpg,jpeg,gif,png\'});});
</script>';
		return $html;
	}
}
?>