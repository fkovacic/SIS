<?php 
	function wlog($getdata) {
		$log = "intruder_handling/log.csv";
		$file = fopen($log, 'a+');
		$date = date('Y-m-d;H:i:s;');
		$user = $_SERVER['REMOTE_ADDR'].";".$_SERVER['HTTP_USER_AGENT'].";";
		$data = $date.$user.$getdata."\n";
		fwrite($file, $data);
		fclose($file);
	}
?>