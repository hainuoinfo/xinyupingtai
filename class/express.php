<?php
set_time_limit(0);
class express{
	private $status, $ename, $name, $cfgList, $cfgCount, $markers;
	public function __construct($type){
		$this->status = false;
		if ($item = db::one('cms_epcfg_cate', 'id,name,ename', "ename='$type'")) {
			$this->ename = $item['ename'];
			$this->name  = $item['name'];
			foreach (db::select('cms_epcfg', 'marker,length,start,end', "cid='$item[id]'") as $v) {
				$v['length']    = intval($v['length']);
				$v['start']     = intval($v['start']);
				$v['end']       = intval($v['end']);
				$v['markerLen'] = strlen($v['marker']);
				$v['idLen']     = $v['length'] - $v['markerLen'];
				$this->cfgList[$v['marker']] = $v;
			}
			$this->cfgCount = count($this->cfgList);
			if ($this->cfgCount > 0) {
				$this->status = true;
				$this->markers = array_keys($this->cfgList);
			}
		}
	}
	public function getRandMarker(){
		if ($this->status) {
			return $this->markers[rand(0, $this->cfgCount - 1)];
		}
		return '';
	}
	public function getRandList($marker, $count){
		$list = array();
		if ($this->status) {
			if (!empty($this->cfgList[$marker])) {
				$cfg = $this->cfgList[$marker];
				for ($i = 0; $i < $count; $i++) {
					$id = rand($cfg['start'], $cfg['end']);
					$id = $marker.str_repeat('0', $cfg['idLen'] - strlen($id)).$id;
					$list[] = $id;
				}
			}
		}
		return $list;
	}
	public function getRandOne($marker){
		$list = $this->getRandList($marker, 1);
		if ($list) return $list[0];
	}
	public function getInfo($id){
		$rs = array();
		if ($this->status) {
			$html = winsock::get_html('http://www.kuaidi100.com/query?type='.$this->ename.'&postid='.$id.'&id=1', array('Referer' => 'http://www.kuaidi100.com/'));
			$rs = array();
			if ($html) {
				$rs = string::json_decode($html);
			}
			if (!$rs || $rs['status'] != '200') {
				$rs = array('status' => false, 'message' => $this->name.' 单号'.$id.'，没有查到相关信息。单号暂未收录或已过期');
			} else {
				$rs['status'] = true;
			}
		}
		return $rs;
	}
	public function getIdInfo($id){
		$rs = $this->getInfo($id);
		$item = array();
		$item['id'] = $id;
		$item['info'] = $rs;
		return $item;
	}
	public function getRandListFull($marker, $count){
		$ids = $this->getRandList($marker, $count);
		$list = array();
		foreach ($ids as $id) {
			$list[] = $this->getIdInfo($id);
		}
		return $list;
	}
	public function getRandOneFull($marker){
		$list = $this->getRandListFull($marker, 1);
		if ($list) return $list[0];
	}
	public function getCusList($id, $count){
		$list = array();
		if ($this->status) {
			$len = strlen($id);
			$cfg = array();
			foreach ($this->cfgList as $v) {
				if (substr($id, 0, $v['markerLen']) == $v['marker']) {
					$cfg = $v;
					break;
				}
			}
			if ($cfg) {
				if ($len == $cfg['length']) {
					$list[] = $id;
				} elseif ($len < $cfg['length']) {
					$len2 = $cfg['length'] - $len;
					$count2 = pow(10, $len2);
					$count2 < $count && $count = $count2;
					for ($i = 0; $i < $count; $i++) {
						$id2 = rand(0, $count2 - 1);
						$len3 = strlen($id2);
						$list[] = $id.str_repeat('0', $len2 - $len3).$id2;
					}
				}
			}
		}
		return $list;
	}
	public function getCusOne($id){
		$list = $this->getCusList($id, 1);
		if ($list) return $list[0];
		return false;
	}
	public function getCusListFull($id, $count){
		$ids = $this->getCusList($id, $count);
		$list = array();
		foreach ($ids as $id) {
			$rs = $this->getInfo($id);
			$item = array();
			$item['id'] = $id;
			$item['info'] = $rs;
			$list[] = $item;
		}
		return $list;
	}
	public function getCusOneFull($id){
		$list = $this->getCusListFull($id, 1);
		if ($list) return $list[0];
		return false;
	}
}
?>