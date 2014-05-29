<?php
//define('ImageMagick',true);
class image{
	public static function getImage($name, $dir, $width = 0, $height = 0, $saveName = ''){
		$upload = new upload();
		$rs = $upload->toupload($name, 'image');
		if ($rs['count'] == 1) {
			!file_exists($dir) && common::create_folder($dir);
			if ($rs = $upload->move2($rs['info'][$name]['db_id'], $dir)) {
				$saveName || $saveName = $rs['filename'].'1';
				$saveBasename = $saveName.'.'.$rs['suffix'];
				$save = $dir.$saveBasename;
				self::thumb($rs['source'], $save, array('width' => $width, 'height' => $height));
				@unlink($rs['source']);
				return $saveBasename;
			}
		}
		return false;
	}
	public static function thumb($s,$d,$flag,$type='cutout'){
		if(file_exists($s)){
			$s_info=pathinfo($s);
			$s_info['extension'] && ($s_info['extension']=strtolower($s_info['extension'])) && $s_info['extension']=='jpg' && $s_info['extension']='jpeg';
			$img_func='imagecreatefrom'.$s_info['extension'];
			$img_func2='image'.$s_info['extension'];
				if($type=='cutout'){
					$width=$flag['width'];
					$height=$flag['height'];
					$width||($width=$height);
					$width||($width=$flag['maxwidth']);
					$height||($height=$width);
					if(ImageMagick===true){
						self::ImagickResizeImage($s,$d,$width,$height,true);
					} else {
						@$im=$img_func($s);
						$im || ($img_func != 'imagecreatefromjpeg' && $im=imagecreatefromjpeg($s));
						if($im) {
							$pic_width = imagesx($im);
							$pic_height = imagesy($im);
							$maxwidth = $width;
							$maxwidth < $height && ($maxwidth = $height);
							$pic_minwidth = $pic_width;
							$pic_minwidth > $pic_height && ($pic_minwidth = $pic_height);
							$percent = floor(($maxwidth / $pic_minwidth) * 100 + 0.5) / 100;
							if ($percent < 1) {
								$create_width = $pic_width * $percent;
								$create_width < $width && ($create_width=$width);
								$create_height=$pic_height*$percent;
								$create_height<$height&&($create_width=$height);
							} else {
								$create_width  = $pic_width;
								$create_height = $pic_height;
							}
							$result = imagecreatetruecolor($create_width, $create_height);
							$result1 = imagecreatetruecolor($width, $height);
							imagecopyresampled($result, $im, 0, 0, 0, 0, $create_width, $create_height, $pic_width, $pic_height);
							imagecopy($result1, $result, 0, 0, 0, 0, $create_width, $create_height);
							//eval("image{$s_info[suffix]}(\$result1,\$d);");
							$img_func2($result1,$d);
							imagedestroy($result);
							imagedestroy($result1);
							return true;
						}
						return false;
					}
					
				} elseif($type=='zoom') {
					$width=$flag['width'];
					$height=$flag['height'];
					if(ImageMagick===true){
						self::ImagickResizeImage($s,$d,$width,$height,false);
					} else {
						@$im=$img_func($s);
						$im || ($img_func != 'imagecreatefromjpeg' && $im=imagecreatefromjpeg($s));
						if($im) {
							$pic_width=imagesx($im);
							$pic_height=imagesy($im);
							$pic_minwidth=$pic_width;
							$pic_maxwidth=$pic_height;
							if($pic_minwidth>$pic_maxwidth){
								$pic_tmpwidth=$pic_minwidth;
								$pic_minwidth=$pic_maxwidth;
								$pic_maxwidth=$pic_tmpwidth;
							}
							$minwidth=$flag['minwidth'];
							$maxwidth=$flag['maxwidth'];
							if($minwidth){
								$percent=floor(($minwidth/$pic_minwidth)*100+0.5)/100;
								$width=$pic_width*$percent;
								$height=$pic_height*$percent;
							} elseif($maxwidth){
								$percent=floor(($maxwidth/$pic_maxwidth)*100+0.5)/100;
								$width=$pic_width*$percent;
								$height=$pic_height*$percent;
							}
							$result=imagecreatetruecolor($width,$height);
							imagecopyresampled($result,$im,0,0,0,0,$width,$height,$pic_width,$pic_height);
							//eval("image{$s_info[suffix]}(\$d);");
							$img_func2($result,$d);
							imagedestroy($result);
							return true;
						}
						return false;
					}
				}
			}
			//return true;
		//}
		return false;
	}
	public static function ImagickResizeImage($srcFile,$destFile,$new_w,$new_h, $trim=false){
		if($new_w <= 0 || $new_h <= 0 || !file_exists($srcFile))return false;
		$src = new Imagick($srcFile);
		$image_format = strtolower($src->getImageFormat()); 
		if($image_format != 'jpeg' && $image_format != 'gif' && $image_format != 'png' && $image_format != 'jpg') return false; 
		$src_page = $src->getImagePage(); 
		//如果是 bbsposts 目录里的图片文件，这加入水印 
		if(strpos($destFile, 'bbsposts') !== false){ 
			//先算出最终缩略图的尺寸 
			$src_w = $src_page['width']; 
			$src_h = $src_page['height']; 
			$rate_w  = $new_w / $src_w; 
			$rate_h  = $new_h / $src_h; 
			$rate    = (!$trim && $rate_w < $rate_h) || ($trim && $rate_w > $rate_h) ? $rate_w : $rate_h; 
			$rate = $rate > 1 ? 1 : $rate; 
			$thumb_w = round($src_w * $rate); 
			$thumb_h = round($src_h * $rate); 
			//确定使用对应尺寸的水印图片 
			$watermask = true; 
			if($thumb_w >= 300 && $thumb_h >= 300){ 
				$watermaskfile = "images/watermask/1.png"; 
			}else if($thumb_w >= 100 && $thumb_h >= 100){ 
				$watermaskfile = "images/watermask/2.png"; 
			}else{ 
				$watermask = false; 
				$watermaskfile = ''; 
			} 
			if($watermask){ 
				$water = new Imagick($watermaskfile); 
				$water_page = $water->getImagePage(); 
				$water_w = $water_page['width']; 
				$water_h = $water_page['height']; 
			}
		}
		  
		//如果是 jpg jpeg gif 
		if($image_format != 'gif'){ 
			$dest = $src; 
			if(!$trim){ 
			$dest->thumbnailImage($new_w, $new_h, true); 
			}else{ 
			$dest->cropthumbnailImage($new_w, $new_h); 
			} 
			if($watermask) $dest->compositeImage($water, Imagick::COMPOSITE_OVER, $dest->getImageWidth() - $water_w, $dest->getImageHeight() - $water_h); 
			  
			$dest->writeImage($destFile); 
			$dest->clear(); 
			//gif需要以帧一帧的处理 
		}else{ 
			$dest = new Imagick(); 
			$color_transparent = new ImagickPixel("transparent"); //透明色 
			foreach($src as $img){ 
				$page = $img->getImagePage(); 
				$tmp = new Imagick(); 
				$tmp->newImage($page['width'], $page['height'], $color_transparent, 'gif'); 
				$tmp->compositeImage($img, Imagick::COMPOSITE_OVER, $page['x'], $page['y']); 
				if(!$trim){ 
					$tmp->thumbnailImage($new_w, $new_h, true); 
				}else{ 
					$tmp->cropthumbnailImage($new_w, $new_h); 
				} 
				if($watermask) $tmp->compositeImage($water, Imagick::COMPOSITE_OVER, $tmp->getImageWidth() - $water_w, $tmp->getImageHeight() - $water_h); 
				$dest->addImage($tmp); 
				$dest->setImagePage($tmp->getImageWidth(), $tmp->getImageHeight(), 0, 0); 
				$dest->setImageDelay($img->getImageDelay()); 
				$dest->setImageDispose($img->getImageDispose()); 
				  
			} 
			$dest->coalesceImages(); 
			$dest->writeImages($destFile, true); 
			  
			$dest->clear(); 
		}
	}
	public static function watermark($img_file,$water_file='',$pos=''){
		$water_file=='' && $water_file=d($GLOBALS['web_watermark_img']);
		$pos=='' && $pos=$GLOBALS['web_watermark_position'];
		$padding=2;
		$img_info=@getimagesize($img_file);
		$water_info=@getimagesize($water_file);
		if($img_info && $water_info){
			if(substr($img_info['mime'],0,5)=='image' && substr($water_info['mime'],0,5)=='image'){
				if($img_info[0]-$padding>=$water_info[0] && $img_info[1]-$padding>=$water_info[1]){
					$img_type=substr($img_info['mime'],6);
					$water_type=substr($water_info['mime'],6);
					$img_c='imagecreatefrom'.$img_type;
					$img_s='image'.$img_type;
					$water_c='imagecreatefrom'.$water_type;
					$pos || $pos=9;
					switch($pos){
						case 1:
							$pos=array($padding,$padding);
						break;
						case 2:
							$pos=array(floor($img_info[0]/2)-floor($water_info[0]/2),$padding);
						break;
						case 3:
							$pos=array($img_info[0]-$water_info[0]-$padding,$padding);
						break;
						case 4:
							$pos=array($padding,floor($img_info[1]/2)-floor($water_info[1]/2));
						break;
						case 5:
							$pos=array(floor($img_info[0]/2)-floor($water_info[0]/2),floor($img_info[1]/2)-floor($water_info[1]/2));
						break;
						case 6:
							$pos=array($img_info[0]-$water_info[0]-$padding,floor($img_info[1]/2)-floor($water_info[1]/2));
						break;
						case 7:
							$pos=array($padding,$img_info[1]-$water_info[1]-$padding);
						break;
						case 8:
							$pos=array(floor($img_info[0]/2)-floor($water_info[0]/2),$img_info[1]-$water_info[1]-$padding);
						break;
						case 9:
							$pos=array($img_info[0]-$water_info[0]-$padding,$img_info[1]-$water_info[1]-$padding);
						break;
					}
					$img_im=$img_c($img_file);
					$water_im=$water_c($water_file);
					imagecopy($img_im,$water_im,$pos[0],$pos[1],0,0,$water_info[0],$water_info[1]);
					$img_s($img_im,$img_file);
					imagedestroy($img_im);
					imagedestroy($water_im);
					return true;
				} else return array('status'=>false,'info'=>'图片尺寸小于水印图片尺寸');
			} else return array('status'=>false,'info'=>'图片类型错误');
		}
	}
}
?>