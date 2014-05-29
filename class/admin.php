<?php
class admin{
	public static function show_message($message,$goto='',$parent=false){
		template::initialize('./templates/default/founder/', './cache/default/founder/');
		common::ob_clean();
		if(!$goto)$goto='javascript:history.back(-1);';
		include(template::load('show_message'));
		exit;
	}
	public static function post_start($url=''){
		echo '<form method="post" enctype="application/x-www-form-urlencoded"'.($url?' action="'.$url.'"':'').'>
	<input type="hidden" name="hash" value="'.$GLOBALS['sys_hash'].'" />';
	}
	public static function post_end(){
		echo '</form>';
	}
	public static function login(){
		global $config,$cookie;
		if($_POST){
			extract($_POST);
			if($founder_name&&$founder_password&&$vcode){
				if($vcode==common::authcode($cookie['vcode'],0)){
					if($config['sys_user']==$founder_name){
						if(common::salt_pwd_check($config['sys_pwd'],$founder_password,$config['sys_salt'])){
							common::setcookie('founder_login',true,600);
							return true;
						}
						else return '创始人密码错误';
					} else {
						//登陆数据库用户
						$rs = self::loginUser($founder_name, $founder_password);
						if (is_numeric($rs)) {
							//登陆成功
							common::setcookie('admin_login', $rs, 600);
							return true;
						} elseif ($rs === false) {
							return '创始人不存在';
						} else return $rs;
					}
				} else return '验证码错误';
			} else return '参数错误';
		}
	}
	public static function logout(){
		if (IN_ADMIN === true) {
			common::unsetcookie('backAdmin');
			/*if (IN_FOUNDER === true) {
				common::unsetcookie('founder_login');
			} else {
				common::unsetcookie('admin_login');
			}*/
		}
	}
	public static function loginUser($username, $password, $isCookie = false) {
		global $timestamp;
		if ($user = db::one('admins', 'id,username,salt,password', "username='$username'")) {
			if (!$isCookie) {
				if ($user['password'] == common::salt_pwd($user['salt'], $password)) {
					db::update('admins',"lastLoginTimestamp='$timestamp',loginTimes=loginTimes+1", "id='$user[id]'");
					return $user['id'];
				}
			} else {
				if ($user['password'] == $password) return $user['id'];
			}
			return '管理员密码错误';
		}
		return false;
	}
	public static function loginCookie(){
		global $config, $cookie, $admin;
		if (isset($cookie['backAdmin'])) {
			$admin = array();
			list($username, $password) = explode('|', $cookie['backAdmin']);d;
			if ($username == $config['sys_user']) {
				//创始人
				if ($password == $config['sys_pwd']) {
					//密码正确
					$admin = array(
						'username' => $username,
						'password' => $password,
						'type'     => 'founder'
					);
					self::updateLogin();
					return true;
				}
			} else {
				$rs = self::loginUser($username, $password, true);
				if (is_numeric($rs)) {
					$admin = self::get($rs);
					$admin['type'] = 'admin';
				}
				return $rs;
			}
		}
		return false;
	}
	public static function get($uid){
		if ($user = db::one('admins', 'id,username,password', "id='$uid'")) {
			$user['authority'] = array();
			if ($line = db::get_list('admin_authority', '`key`,value', "aid='$user[id]'", '', 0)) {
				foreach ($line as $v) {
					$user['authority'][$v['key']] = (int)$v['value'];
				}
			}
			return $user;
		}
		return false;
	}
	public static function updateLogin(){
		global $adminId;
		$time = 13600;
		if (IN_ADMIN === true) {
			if (IN_FOUNDER === true) {
				common::setcookie("founder_login", true, $time);//刷新登录时间 10分钟
			} else {
				common::setcookie('admin_login', $adminId, $time);
			}
		}
	}
	public static function confirm($message, $title = SYSTEM_NAME){
		if(form::is_form_hash()){
			return true;
		}
		global $menu_name, $menu_sub_name, $sys_hash_code;
		//common::ob_clean();
		include(template::load('confirm'));
	}
	public static function form($data){
		global $sys_hash_code, $weburl2;
		$rn = $tip = '';
		$isTip = false;
		$maxTitle = 0;
		$isUpload = false;
		if($data = trim($data)){
			$tags = array();
			$sp = common::trimExplode("\n", $data);//分割表单标记
			foreach ($sp as $str) {
				if($str = trim($str)) {
					if ($str=='upload') {//如果是上传标记
						$isUpload = true;
						continue;
					}
					if ($str == 'preg') {//正则表达式
						$isTip = true;
						continue;
					}
					$sp2 = common::trimExplode('|', $str);
					if ($sp2[1] == 'tip' && count($sp2) == 2) {//判断是否为标题
						$tip = $sp2[0];
					} else {
						$sp3 = common::trimExplode(',', $sp2[0]);//分割标题项
						array_shift($sp2);//移除标题
						$tag = array();
						$tag['title'] = $sp3[0];//元素标题
						$len = mb_strlen($tag['title']);
						if ($len>$maxTitle)$maxTitle = $len;
						array_shift($sp3);//移除标题
						if (count($sp3)>0) {//有正则表达式
							$tag['tip'] = implode(',', $sp3);
							$isTip = true;
						} else {
							$tag['tip'] = '';
						}
						$tag['varName'] = $sp2[0];//元素ID
						array_shift($sp2);//移除元素ID
						$sp3 = common::trimExplode(',', $sp2[0]);//分割元素类型
						$tag['type'] = $sp3[0];//元素类型
						array_shift($sp3);//移除类型
						array_shift($sp2);//移除标记元素类型
						if(count($sp3)>0)$tag['other'] = $sp3;//元素类型处 其它标记
						else $tag['other'] = array();
						if(count($sp2)>0)$tag['other2'] = $sp2;
						else $tag['other2'] = array();
					}
					$tags[] = $tag;
				}
			}
			$titleWidth = ($maxTitle + 1 ) * 12;
			foreach($tags as $tag){
				switch($tag['type']){
					case 'text':
						$emptyRunReg = true;
						if ($tag['tip']) {
							$sp = common::trimExplode(',', $tag['tip']);
							$tag['tip'] = $sp[0];
							if ($sp[1] == 'false') $emptyRunReg = false;
						}
						$html = '<input type="text" name="'.$tag['varName'].'" id="'.$tag['varName'].'" value="$'.$tag['varName'].'" class="txt"'.($tag['other2'][0]?' style="width:'.$tag['other2'][0].'px"':'').($tag['other2'][1]?' maxlength="'.$tag['other2'][1].'"':'').($tag['tip']?' preg="'.$tag['tip'].'"'.($emptyRunReg ? '' : ' emptyRunReg="false"'):'').' />';
					break;
					case 'file':
						$html = '<input type="file" name="'.$tag['varName'].'" id="'.$tag['varName'].' class="file"'.($tag['other2'][0]?' style="width:'.$tag['other2'][0].'px"':'').($tag['other2'][1]?' maxlength="'.$tag['other2'][1].'"':'').($tag['tip']?' preg="'.$tag['tip'].'"':'').' />{if $'.$tag['varName'].'}<br /><img src="$'.$tag['varName'].'" />{/if}';
					break;
					break;
					case 'textarea':
						$emptyRunReg = true;
						if ($tag['tip']) {
							$sp = common::trimExplode(',', $tag['tip']);
							$tag['tip'] = $sp[0];
							if ($sp[1] == 'false') $emptyRunReg = false;
						}
						$html = '<textarea name="'.$tag['varName'].'" id="'.$tag['varName'].'" class="tarea"'.($tag['tip']?' preg="'.$tag['tip'].'"'.($emptyRunReg ? '' : ' emptyRunReg="false"'):'').'>{html $'.$tag['varName'].'}</textarea>';
					break;
					case 'radio':
						if($tag['other']){
							if (substr($tag['other'][0], 0, 1)=='$') {
								$varName = $tag['other'][0];
								$html = '<ul>{eval $i=0;}{loop '.$varName.' $k $v}{eval $i++;}';
								$html.= '<li{if $i==1 && !isset($'.$tag['varName'].')} class="checked"{/if}><input type="radio" name="'.$tag['varName'].'" id="'.$tag['varName'].'$i" value="$v" class="radio"{if $'.$tag['varName'].'==$v || ($i==1 && !isset($'.$tag['varName'].'))} checked{/if} />{if $k}&nbsp<label for="'.$tag['varName'].'$i">$k</label>{/if}</li>';
								$html.= '{/loop}</ul>';
							} else {
								$html = '';
								$i = 0;
								foreach ($tag['other'] as $v) {
									if($v = trim($v)) {
										$i++;
										$sp = common::trimExplode('=', $v);
										$html.= '<li{if $'.$tag['varName'].'==\''.$sp[0].'\''.($i==1?' || !isset($'.$tag['varName'].')':'').'} class="checked"{/if}><input type="radio" name="'.$tag['varName'].'" id="'.$tag['varName'].$i.'" value="'.$sp[0].'" class="radio"{if $'.$tag['varName'].'==\''.$sp[0].'\''.($i==1?' || !isset($'.$tag['varName'].')':'').'} checked{/if} />';
										if (count($sp) == 2 && $sp[1]) {
											$html.='&nbsp<label for="'.$tag['varName'].$i.'">'.$sp[1].'</label>';
										}
										$html.='</li>';
									}
								}
								$html = '<ul>'.$html.'</ul>';
							}
						} else {
							$html = '';
						}
					break;
					case 'check':
						if($tag['other']){
							if (substr($tag['other'][0], 0, 1)=='$') {
								$varName = $tag['other'][0];
								$html = '<ul>{eval $i=0;}{loop '.$varName.' $k $v}{eval $i++;}';
								$html.= '<li><input type="checkbox" name="'.$tag['varName'].'" id="'.$tag['varName'].'$i" value="$v" class="radio"{if $'.$tag['varName'].'==$v} checked{/if} />{if $k}&nbsp<label for="'.$tag['varName'].'$i">$k</label>{/if}</li>';
								$html.= '{/loop}</ul>';
							} else {
								$html = '';
								$i = 0;
								foreach ($tag['other'] as $v) {
									if($v = trim($v)) {
										$i++;
										$sp = common::trimExplode('=', $v);
										$html.= '<li{if $'.$tag['varName'].'==\''.$sp[0].'\''.($i==1?' || !isset($'.$tag['varName'].')':'').'} class="checked"{/if}><input type="checkbox" name="'.$tag['varName'].'" id="'.$tag['varName'].$i.'" value="'.$sp[0].'" class="radio"{if $'.$tag['varName'].'==\''.$sp[0].'\'} checked{/if} />';
										if (count($sp) == 2 && $sp[1]) {
											$html.='&nbsp<label for="'.$tag['varName'].$i.'">'.$sp[1].'</label>';
										}
										$html.='</li>';
									}
								}
								$html = '<ul>'.$html.'</ul>';
							}
						} else {
							$html = '';
						}
					break;
					case 'checkbox':
						if($tag['other']){
							if (substr($tag['other'][0], 0, 1)=='$') {
								$varName = $tag['other'][0];
								$html = '<ul>{eval $i=0;}{loop '.$varName.' $k $v}';
								$html.= '<li><input type="checkbox" name="'.$tag['varName'].'['.$i.']" id="'.$tag['varName'].'$i" value="$v" class="radio"{if $'.$tag['varName'].'['.$i.']'.'==$v} checked{/if} />{if $k}&nbsp<label for="'.$tag['varName'].'$i">$k</label>{/if}</li>';
								$html.= '{eval $i++;}{/loop}</ul>';
							} else {
								$html = '';
								$i = 0;
								foreach ($tag['other'] as $v) {
									if($v = trim($v)) {
										$sp = common::trimExplode('=', $v);
										$html.= '<li{if $'.$tag['varName'].'==\''.$sp[0].'\''.($i==1?' || !isset($'.$tag['varName'].')':'').'} class="checked"{/if}><input type="checkbox" name="'.$tag['varName'].'['.$i.']" id="'.$tag['varName'].$i.'" value="'.$sp[0].'" class="radio"{if $'.$tag['varName'].'['.$i.']'.'==\''.$sp[0].'\'} checked{/if} />';
										if (count($sp) == 2 && $sp[1]) {
											$html.='&nbsp<label for="'.$tag['varName'].$i.'">'.$sp[1].'</label>';
										}
										$html.='</li>';
										$i++;
									}
								}
								$html = '<ul>'.$html.'</ul>';
							}
						} else {
							$html = '';
						}
					break;
					case 'select':
						if($tag['other']){
							if (substr($tag['other'][0], 0, 1)=='$') {
								$varName = $tag['other'][0];
								$html = '<select name="'.$tag['varName'].'" id="'.$tag['varName'].'"'.($tag['tip']?' preg="'.$tag['tip'].'"':'').'>{eval $__group=false;}{loop '.$varName.' $k $v}{if is_array($v) && $v[type] == \'-\'}';
								$html.= '{if $__group}</optgroup>{/if}{eval $__group=true;}<optgroup label="$v[name]">';
								$html.= '{else}<option value="$v"{if $v==$'.$tag['varName'].'} selected{/if}>$k</option>';
								$html.= '{/if}{/loop}{if $__group}</optgroup>{/if}</select>';
							} else {
								$html = '';
								foreach ($tag['other'] as $v) {
									if($v = trim($v)) {
										$sp = common::trimExplode('=', $v);
										if (count($sp) == 2) {
											$html .= '<option value="'.$sp[0].'"{if $'.$tag['varName'].'==\''.$sp[0].'\'} selected{/if}>'.$sp[1].'</option>';
										}
									}
								}
								$html = '<select name="'.$tag['varName'].'" id="'.$tag['varName'].'"'.($tag['tip']?' preg="'.$tag['tip'].'"':'').'>'.$html.'</select>';
							}
						} else {
							$html = '';
						}
					break;
					case 'xheditor':
						$tag['other'][0] && $xheditorName   = $tag['other'][0];
						$tag['other'][1] && $xheditorWidth  = $tag['other'][1];
						$tag['other'][2] && $xheditorHeight = $tag['other'][2];
						$xheditorName   || $xheditorName   = 'full';
						$xheditorWidth  || $xheditorWidth  = '800';
						$xheditorHeight || $xheditorHeight = '600';
						$html = xheditor::getEditor($tag['varName'], $xheditorWidth, $xheditorHeight, $xheditorName);
					break;
					case 'fckeditor':
						$tag['other'][0] && $fckeditorWidth  = $tag['other'][0];
						$tag['other'][1] && $fckeditorHeight = $tag['other'][1];
						$fckeditorWidth  || $fckeditorWidth  = '800';
						$fckeditorHeight || $fckeditorHeight = '600';
						$html = '<?php include(d(\'./js_lib/ckeditor/ckeditor.php\'));
		include(d(\'./js_lib/ckfinder/ckfinder.php\'));
		$CKEditor=new CKEditor();
		$CKEditor->basePath=\''.$weburl2.'js_lib/ckeditor/\';
		$CKEditor->config[\'width\']='.$fckeditorWidth.';
		$CKEditor->config[\'height\']='.$fckeditorHeight.';
		$CKEditor->config[\'skin\']=\'office2003\';
		$CKEditor->returnOutput=true;
		CKFinder::SetupCKeditor($CKEditor,\''.$weburl2.'js_lib/ckfinder/\');
		$editor_html=$CKEditor->editor(\''.$tag['varName'].'\',$'.$tag['varName'].');
		echo $editor_html;
		?>';
					break;
					case 'var':
						$html = '$'.$tag['varName'];
					break;
					case 'code':
						$_code = array_merge(array(implode(',', $tag['other'])), $tag['other2']);
						$html = implode('|', $_code);//implode(',', $tag['other']);//$tag['other'][0];
					break;
				}
				$rn .= '<tr class="hover"><td width="'.$titleWidth.'" align="right" valign="top">'.$tag['title'].'</td><td'.(in_array($tag['type'],array('radio','checkbox'))?' class="vtop rowform"':'').' width="450">'.$html.'</td>'.($isTip?'<td id="'.$tag['varName'].'_tip"></td>':'').'</tr>';
			}
		}
		$rn = '<form method="post" enctype="'.($isUpload?'multipart/form-data':'application/x-www-form-urlencoded').'">$sys_hash_code{if $update}<input type="hidden" name="isEdit" value="yes" />{/if}
	<table class="tb tb2 fixpadding">'.($tip?'<tr><td class="partition" colspan="'.($isTip?3:2).'">'.$tip.'</td></tr>':'').$rn.'<tr><td></td><td'.($tip?' colspan="2"':'').'><input type="submit" value="{if $update}编辑{else}提交{/if}" class="btn" /></td></tr></table></form>';
		$rn = '<?php '.parse_php::parse($rn).'?>';
		return $rn;
	}
	public static function getList($tbName, $f = '*', $where = '', $order = '', $changeReturn = false){
		global $page, $pagesize, $pagestyle, $list, $multipage, $base_url, $method, $multipageUrlAdd;
		if(form::is_form_hash()){
			extract($_POST);
			if($del || $sort){
				if($del){
					db::del_ids($tbName, $del);
					if(!$changeReturn){
						admin::show_message('删除成功', $base_url);
					} else {
						return 2;
					}
				} elseif($sort && $ids) {
					if($count = form::array_equal($ids, $sort)){
						for($i=0; $i<$count; $i++){
							$id  = $ids[$i];
							$sid = $sort[$i];
							db::update($tbName, array('sort'=>$sid),"id='$id'");
						}
						if(!$changeReturn){
							admin::show_message('更新成功', $base_url.'&page='.$page);
						} else {
							return 3;
						}
					}
				}
			}
		}
		if($total=db::data_count($tbName, $where)){
			$list = db::get_list2($tbName, $f, $where, $order, $page, $pagesize);
			$multipage = multi_page::parse($total, $pagesize, $page, $base_url.($method?'&method='.$method:'').(empty($multipageUrlAdd)?'':$multipageUrlAdd).'&page={page}', $pagestyle);
		}
		return 1;
	}
	public static function updateVars(){
		if($list = db::get_list2('vars', '`key`,`val`', '', '', 0)){
			$vars = array();
			foreach($list as $v){
				$vars[$v['key']] = $v['val'];
			}
			cache::write_array('vars', $vars);
		}
	}
	public static function updateUserGroups(){
		if($list = db::get_list2('user_groups', 'id,sort,name,`key`')){
			$userGroups = array();
			foreach($list as $v){
				$userGroups[$v['key']] = array('id' => $v['id'], 'sort' => $v['sort'], 'name' => $v['name'], 'key' => $v['key']);
			}
			cache::write_array('userGroups', $userGroups);
		}
	}
	public static function updateQuestions(){
		if($list = db::get_list2('member_questions', 'id,question', 'sort')){
			$questions = array();
			foreach($list as $v){
				$questions[$v['id']] = $v['question'];
			}
			cache::write_array('questions', $questions);
		}
	}
	public static function getTplList($data){
		$rn = '';
		if($data=trim($data)){
			$sp = common::trimExplode("\n", $data);
			$tags = array();
			$isDel = false;
			$delId = '';
			foreach($sp as $v){
				if($v){//每一元素的规则
					$sp2 = common::trimExplode('|',$v);//分割元素
					$tag = array();
					$tag['title'] = $sp2[0];//字段标题
					$tag['key']   = $sp2[1];//数组的字段KEY
					if ($sp2[2]) {//特殊类型
						$tmpSp = explode(',', $sp2[2]);
						switch ($tmpSp[0]){
							case 'code':
								$tag['type'] = $tmpSp[0];
								array_shift($tmpSp);
								array_shift($sp2);
								array_shift($sp2);
								array_shift($sp2);
								array_unshift($sp2, implode(',', $tmpSp));
								$tag['code'] = implode('|', $sp2);
							break;
							default:
								$types = common::trimExplode(';', $sp2[2]);//分割元素
								foreach($types as $typeIndex => $type){
									$sp3 = common::trimExplode(',', $type);//分割特殊类型
									$tag['type'][$typeIndex] = $sp3[0];//元素类型
									switch($tag['type'][$typeIndex]){
										case 'link'://超链接
											$sp4 = common::trimExplode('=', $sp3[1]);//分割超链接属性
											$tag['linkName'][$typeIndex] = $sp4[1];
											$tag['linkUrl'][$typeIndex]  = '$base_url&'.$sp4[0].'=$v['.$tag['key'].']';
										break;
										case 'link2':
											$tag['linkName'][$typeIndex] = $sp3[1];
											$tag['linkUrl'][$typeIndex]  = '$base_url&'.$sp3[2];
										break;
										case 'link3':
											$sp4 = common::trimExplode('=', $sp3[1]);//分割超链接属性
											$tag['linkName'][$typeIndex] = $sp4[1];
											$tag['linkUrl'][$typeIndex]  = '$base_url&'.$sp4[0].'=$v['.$tag['key'].']';
											$tag['linkId'][$typeIndex] = $sp4[0];
										break;
										default:
											array_shift($sp3);
											if (count($sp3) > 0) $tag['attach'][$typeIndex] = $sp3;
										break;
									}
								}
							break;
						}
						
					}
					if($tag['type']){
						$html = '';
						if (is_array($tag['type'])) {
							foreach($tag['type'] as $tId => $t){
								switch($t){
									case 'del':
										$html .= '<input type="checkbox" name="del[]" value="$v[\''.$tag['key'].'\']" class="checkbox" />';
										$isDel = true;
										$delId = $tag['key'];
									break;
									case 'sort':
										$idId = ($delId?$delId:'id');
										$html .= '<input type="text" name="sort[]" value="$v[\''.$tag['key'].'\']" class="txt" style="width:48px" /><input type="hidden" name="ids[]" value="$v[\''.$idId.'\']" />';
									break;
									case 'link':
										$html .= '[<a href="'.$tag['linkUrl'][$tId].'">'.$tag['linkName'][$tId].'</a>]';
									break;
									case 'link2':
										$html .= '[<a href="'.$tag['linkUrl'][$tId].'">'.$tag['linkName'][$tId].'</a>]';
									break;
									case 'link3':
										$_sp = explode('/', $tag['linkName'][$tId]);
										$html .= '[<a href="'.$tag['linkUrl'][$tId].'">{if $v['.$tag['linkId'][$tId].']}'.$_sp[1].'{else}'.$_sp[0].'{/if}</a>]';
									break;
									case 'datetime':
										$html .= '{date $v[\''.$tag['key'].'\']}';
									break;
									case 'flag':
										$html .= '{'.$tag['attach'][$tId][0].' $v[\''.$tag['key'].'\']}';
									break;
									case 'var':
										$html .= $tag['attach'][$tId][0];
									break;
									case 'code':
										$html .= implode(',', $tag['attach'][$tId]);//$tag['attach'][$tId][0];
									break;
									case 'style':
										$html = '<div style="'.implode(';', $tag['attach'][$tId]).'">$v['.$tag['key'].']</div>';
									break;
									default:
										$html .= '$v['.$tag['key'].']';
									break;
								}
							}
						} else {
							switch ($tag['type']) {
								case 'code':
									$html .= $tag['code'];
								break;
							}
						}
					} else {
						$html = '$v['.$tag['key'].']';
					}
					$tag['html'] = $html;
					$tags[] = $tag;
				}
			}
			$tagCount = count($tags);
			$head = $body = '';
			$titles = common::arrid($tags, 'title');
			$htmls  = common::arrid($tags, 'html');
			foreach($titles as $title){
				$head.='<th>'.$title.'</th>';
			}
			$head = '<tr class="header">'.$head.'</tr>';
			foreach($htmls as $html){
				$body .= '<td>'.$html.'</td>';
			}
			$body  = '<tr class="hover">'.$body.'</tr>';
			$body = '{loop $list $k $v}'.$body.'{/loop}';
			$isDel && $body .= '<tr><td colspan="'.$tagCount.'"><input type="checkbox" id="checkDel" onclick="check_all(this,\'del[]\')" class="checkbox" /><label for="checkDel">全选</label></td></tr>';
			$body .= '<tr><td colspan="'.$tagCount.'">$multipage</td></tr>';
			$body .= '<tr><td colspan="'.$tagCount.'"><input type="submit" value="提交" class="btn" /></td></tr>';
			$rn = '<form method="post" enctype="application/x-www-form-urlencoded" onsubmit="return confirm(\'确定提交吗？\')">$sys_hash_code
	<table class="tb tb2 fixpadding">'.$head.$body.'</table></form>';
			$rn = '<?php '.parse_php::parse($rn).'?>';
			return $rn;
		}
	}
	public static function insert($tbName, $vars, $returnId = false){
		if(form::is_form_hash()){
			$datas = array();
			foreach($vars as $k=>$v){
				if(is_array($v)){
					$k2   = $v['name'];
					$must = $v['must'];
				} else {
					$k2   = $v;
					$must = true;
				}
				$v2 = $_POST[$k2];
				if($v2==='' && $must)return -1;//有字段为必填，找到有没有填写的
				$datas[$k] = $v2;
			}
			if($datas){
				return db::insert($tbName, $datas, $returnId);
			} else return -2;//没有数据可以插入
		}
		return 0;//没有提交
	}
	public static function update($tbName, $vars, $id, $idKey = 'id'){
		if(form::is_form_hash()){
			if($_POST['isEdit']){
				$datas = array();
				foreach($vars as $k=>$v){
					if(is_array($v)){
						$k2   = $v['name'];
						$must = $v['must'];
					} else {
						$k2   = $v;
						$must = true;
					}
					$v2 = $_POST[$k2];
					if($v2 === '' && $must)return -1;//有字段为必填，找到有没有填写的
					$datas[$k] = $v2;
				}
				if($datas){
					$where = $idKey.'=\''.$id.'\'';
					return db::update($tbName, $datas, $where);
				} else return -2;//没有数据可以插入
			} else return -3;//非法操作，没有编辑的属性
		} else {
			if($item = db::one($tbName, '*', $idKey.'=\''.$id.'\'')){
				$GLOBALS['update'] = true;
				foreach($vars as $k=>$v)$GLOBALS[$v]=$item[$k];
			} else {
				$GLOBALS['update'] = false;
			}
		}
	}
	public static function parseTxt($txt){
		$txt = preg_replace('/\s+/s', '', $txt);
		$rn = array();
		$f1 = 0;
		$i = 0;
		do {
			$i ++;
			$f2 = strpos($txt, '{', $f1);
			if ($f2 === false) {
				$t = substr($txt, $f1);
				if ($t) {
					$sp = explode(';', $t);
					foreach ($sp as $v){
						$rn[] = array('name' => $v);
					}
					//$rn[] = array('name' => $t);
				}
			} else {
				$t = string::dg_string($txt, '{', '}', $f2);
				if ($t) $rn[] = array('name' => substr($txt, $f1, $f2 - $f1), 'sub' => self::parseTxt(substr($t, 1, -1)));
				else $rn[] = array('name' => substr($txt, $f1, $f2 - $f1));
				$f1 = $f2 + strlen($t);
			}
			if ($i == 50) break;
		} while($f2 !== false);
		return $rn;
	}
	public static function updateExpress($id) {
		if ($e = db::one('express', '*', "id='$id'")) {
			$arr = self::parseTxt($e['city1']);
			if (is_array($arr)) {
				cache::write_text('citys_'.$id.'_city1', string::json_encode($arr));
			}
			$arr = self::parseTxt($e['city2']);
			if (is_array($arr)) {
				cache::write_text('citys_'.$id.'_city2', string::json_encode($arr));
			}
			$arr = self::parseTxt($e['city3']);
			if (is_array($arr)) {
				cache::write_text('citys_'.$id.'_city3', string::json_encode($arr));
			}
		}
	}
}
?>