<?php
include_once 'phppinger.class.php';

$pinger = new PHPPinger();

try {
	if($pinger->ping("www.google.com"))
		echo "google.com pinged successfully";
	
} catch (ConnectionFailedException $err) {
	echo "no connection to google.com";
}

unset($pinger);
?>