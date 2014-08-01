<?php
if (defined("DEFAULT_LOG") == FALSE) {
	define("DEFAULT_LOG","app/addons/mcs_child_shop/error_log.log");
}

function read_log($logfile='') {
	$result=0;
	// Determine log file
	if($logfile == '') {
		// checking if the constant for the log file is defined
		if (defined("DEFAULT_LOG") == TRUE) {
			$logfile = DEFAULT_LOG;
		}
		// the constant is not defined and there is no log file given as input
		else {
			error_log('No log file defined!',0);
			return array(status => false, message => 'No log file defined!');
			}
	}
		
	// Append to the log file
	if($fd = @fopen($logfile, "r")) {
		if(filesize($logfile)!=0){
			$result=fread($fd, filesize($logfile));
		}
		fclose($fd);	
		if($result){
			return $result; 
		}else{
			return array('status' => false, 'message' => 'Log file is empty.');
		}
	}else{
		return array('status' => false, 'message' => 'Unable to open log '.$logfile.'!');
	}
}