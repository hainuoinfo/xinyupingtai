<?php
/**
 * 文件名(add.php)
 * 
 * 通过一组关键词给文章做链接
 * 
 * @package   links_add
 * @author    liujiang <373718549@qq.com>
 * @copyright Copyright (C) 2011 www.100fu.com. All rights reserved.
 */
 
class links_add{
	/**
	 * 函数union
	 *
	 * 匹配文章关键词，做内链，不重复
	 *
	 * @link   union
	 * @access public
	 * @param  string $str
	 * @param  array $links
	 * @return string
	 */
	 
	public static function union($str, $links) {
		if (is_array($links) && count($links) > 0) {
			/**
			 * $str0 最终结果
			 */
			 
			$str0 = $s = $ls = $key = '';
			$strLen = mb_strlen($str);
			$atA = $atA1 = $atA2 = $atM = false;
			$keysInfo = $ids0 = $ids = $ids2 = array();
			$l = $addCount = 0;
			foreach ($links as $k => $v) {
				$v['len'] = mb_strlen($v['key']);
				if ($v['len'] > $l) $l = $v['len'];
				$keysInfo[$k] = $v;
				$ids0[$k] = $k;
			}
			$ids = $ids0;
			$j = 0;
			for ($i = 0; $i < $strLen; $i++) {
				$s = mb_substr($str, $i, 1);
				if ($atA) {
					$str0 .= $s;
					if ($atA1) {
						if ($s == '>') $atA1 = false;
					} elseif ($atA2) {
						if ($s == '>' && in_array(mb_substr($str0, -4), array('</a>', '</A>'))) {
							$atA = $atA2 = false;
						}
					} else {
						if ($s == '<') $atA2 = true;
					}
				} elseif ($atM) {
					if ($s == '>') $atM = false;
					$str0 .= $s;
					if (in_array($s, array('a', 'A')) && $ls == '<') {
						$atM = false;
						$atA = $atA1 = true;
						$key = '';
						$j = 0;
						$ids = $ids0;
					}
				} else {
					if (in_array($s, array('a', 'A')) && $ls == '<') {
						$str0 .= $s;
						$atA = $atA1 = true;
						$key = '';
						$j = 0;
						$ids = $ids0;
					} else {
						if (!in_array($s, array('<', '>'))) {
							$thisIds = $thisIds2 = array();
							$count = 0;
							foreach ($ids as $id) {
								if (mb_substr($keysInfo[$id]['key'], $j, 1) == $s) {
									$j++;
									$key .= $s;
									$thisIds[] = $id;
									if ($j == $keysInfo[$id]['len']) $thisIds2[] = $id;
									$count++;
								}
							}
							if ($count > 0) {
								/**
								 * 如果我查到有关键词
								 */
								 
								$ids  = $thisIds;
								$ids2 = $thisIds2;
							} else {
								if ($j > 0) {
									/**
									 * 如果之前查到有关键词
									 */
									 
									if ($ids2) {
										$id = $ids2[0];
										unset($ids0[$id], $ids2);
										$ids = $ids0;
										$str0 .= '<a href="'.$keysInfo[$id]['url'].'" target="_blank">'.$key.'</a>';
										$key = '';
										$j = 0;
										$str0 .= $s;
										$addCount++;
									} else {
										$str0 .= $key.$s;
										$key = '';
										$j = 0;
										$ids = $ids0;
									}
								} else {
									$str0 .= $s;
								}
							}
						} else {
							if ($j > 0) {
								/**
								 * 如果之前查到有关键词
								 */
								 
								if ($ids2) {
									$id = $ids2[0];
									unset($ids0[$id], $ids2);
									$ids = $ids0;
									$str0 .= '<a href="'.$keysInfo[$id]['url'].'" target="_blank">'.$key.'</a>';
									$key = '';
									$j = 0;
									$str0 .= $s;
									$addCount++;
								} else {
									$str0 .= $key.$s;
									$key = '';
									$j = 0;
									$ids = $ids0;
								}
							} else {
								$str0 .= $s;
								$key = '';
								$j = 0;
								$ids = $ids0;
							}
							if ($s == '<') $atM = true;
						}
					}
				}
				$ls = $s;
			}
			if ($j > 0) {
				/**
				 * 如果之前查到有关键词
				 */
				 
				if ($ids2) {
					$id = $ids2[0];
					unset($ids0[$id], $ids2);
					$ids = $ids0;
					$str0 .= '<a href="'.$keysInfo[$id]['url'].'" target="_blank">'.$key.'</a>';
					$key = '';
					$j = 0;
					$addCount++;
				} else {
					$str0 .= $key;
					$key = '';
					$j = 0;
					$ids = $ids0;
				}
			}
			$str  = $str0;
			$str0 = '';
		}
		return $str;
	}
}
?>