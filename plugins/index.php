<?php
include(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'index.php');
if ($type && $name) {
	isset($m) || $m = 'run';
	time::timer_start();
	loadFunc('global');
	plugins::call($type, $name, $m);
}
?>