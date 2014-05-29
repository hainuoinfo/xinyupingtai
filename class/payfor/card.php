<?php
class payfor_card{
	public $status, $name;
	public function __construct(){
		//global $db, $pre;
		if ($info = db::one('payfor_interface', '*', "ename='card'")) {
			$this->name   = $info['name'];
			$this->status = $info['status'];
		} else {
			$this->status = false;
			$this->name   = '未知充值方式';
		}
	}
	public function createCard($money, $count, &$cardList = false){
		global $db, $pre, $timestamp;
		$c = 0;
		$return = $cardList !== false;
		if ($return) $cardList = array();
		$db->query("lock table `{$pre}rcard` write");
		for ($i = 0; $i < $count; $i++) {
			do {
				$id = $this->createId();
			} while(db::exists('rcard', array('id' => $id)));
			$key = $this->createKey();
			$cardList[] = array('id' => $id, 'key' => $key);
			if (db::insert('rcard', array(
				'id'         => $id,
				'money'      => $money,
				'pwd'        => $key,
				'ctimestamp' => $timestamp,
				'status'     => 0
			))) $c++;
		}
		$db->query("unlock tables");
		return $c;
	}
	private function createId(){
		list($millisecond, $second)=explode(' ', microtime());
		$millisecond  = (float)$millisecond;
		$second       = (int)$second;
		$millisecond *= 1000000;
		$millisecond  = sprintf('%06d', floor($millisecond));
		//$salt = substr(uniqid(rand()), -5);
		$id = date('YmdHis', $second).$millisecond;
		return $id;
	}
	private function createKey(){
		$key = uniqid(rand());
		$key = common::authcode($key);
		$salt = common::salt();
		$key = md5(md5($key).$salt);
		return strtoupper($key);
	}
	public function useCard($id, $pwd){
		global $timestamp;
		if ($card = db::one('rcard', '*', "id='$id'")) {
			if ($card['pwd'] == $pwd) {
				if (!$card['status']) {
					db::update('rcard', array('status' => 1, 'utimestamp' => $timestamp), "id='$id'");
					return $card['money'];
				}
				return 'rcard_is_used';
			}
			return 'rcard_pwd_error';
		}
		return 'rcard_not_exists';
	}
}
?>