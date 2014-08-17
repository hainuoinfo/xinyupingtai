	<?php //$uinfo[0]['uimg']
		$type=getimagesize('http://static.blog.csdn.net/skin/ink/images/body_bg.jpg');//取得图片的大小，类型等
		$content=file_get_contents('http://static.blog.csdn.net/skin/ink/images/body_bg.jpg');
		$file_content=chunk_split(base64_encode($content));//base64编码
		switch($type[2]){//判读图片类型
			case 1:$img_type="gif";break;
			case 2:$img_type="jpg";break;
			case 3:$img_type="png";break;
		}
		$img='data:image/'.$img_type.';base64,'.$file_content;//合成图片的base64编码
		echo "<img src='".$img."'>";
	?>