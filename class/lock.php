<?php
class lock{
	private $num,$lock_marker,$lock_file,$timeout;
	public $islock;
	private function file_timeout(){
		if(file_exists($this->lock_file)){
			if(time()-filemtime($this->lock_file)>=$this->timeout){
				@unlink($this->lock_file);
				return true;
			}
			return false;
		} else return true;
	}
	function __construct($num=1, $timeout=3, $wait=false, $wait_time=0, $marker = ''){
		$this->num=$num;
		$marker || $marker = $_SERVER['SCRIPT_FILENAME'];
		$marker = md5($marker);
		$this->lock_marker = $marker;
		$this->timeout=$timeout;
		$this->lock_file=d('./cache/lock/'.$this->lock_marker.$this->num.'.lock');
		if(file_exists($this->lock_file)){
			$this->islock=!$this->file_timeout();
		} else $this->islock=false;
		if(!$this->islock)touch($this->lock_file);
		else {
			if($wait){
				$wait_start=0;
				while(!$this->file_timeout()){
					if($wait_time>0){
						$wait_start+=100000;
						if($wait_start>$wait_time)break;
					}
				}
				file_exists($this->lock_file)&&@unlink($this->lock_file);
				touch($this->lock_file);
				$this->islock=false;
			}
		}
	}
	function __destruct(){
		$this->close();
	}
	public function close(){
		!$this->islock&&file_exists($this->lock_file)&&@unlink($this->lock_file);
	}
}
?>