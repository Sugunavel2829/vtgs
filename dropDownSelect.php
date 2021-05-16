<?php
	
	include_once '../config/config.php';
	extract($_REQUEST);
	drop_down($table, $value, $autoId, explode(';', $cond), 0);