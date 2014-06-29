<?php
class member_client{
	public static function getUid($cId){
		if ($cId) {
			return db::one_one('members', 'id', "clientId='$cId'");
		}
		return 0;
	}
}
?>