<?php

include_once 'exceptions.phppinger.class.php';
/**
 * PHPPinger class is useful to check a server's reachability.
 * @author gehaxelt
 * @version 1.0
 */
class PHPPinger {
	
	/**
	 * Function to ping a server.
	 * @param string $host - Domain or IP address
	 * @param int $port - Port to connect to. Default value: 80
	 * @param boolean $supressWarning - Supress the warning of fsockopen? Default value: true
	 * @param int $timeout - Timeout for the fsockopen function. Default value: 30 secs
	 * @throws NotAStringException
	 * @throws NotAnIntegerException
	 * @throws ConnectionFailedException - If ping failed
	 * @return boolean - If ping succeeded
	 */
	public function ping($host,$port=80,$supressWarning=true,$timeout=30) {
		
		if(!is_string($host))
			throw new NotAStringException('First parameter $host is not a string');
		
		if(!is_int($port))
			throw new NotAnIntegerException('Second parameter $port is not an integer');
		
		if(!is_bool($supressWarning))
			throw new NotABooleanException('Third parameter $supressWarning is not a boolean');
		
		if(!is_int($timeout))
			throw new NotAnIntegerException('Fourth paramter $timeout is not a integer');
		
		if($supressWarning) {
			$connection = @fsockopen($host,$port, $errno, $errstr,$timeout);
		} else {
			$connection = fsockopen($host,$port, $errno, $errstr,$timeout);
		}

		if(!$connection)
			throw new ConnectionFailedException('Connection to host failed');
		
		fclose($connection);
		
		return true;
	}	
}
?>