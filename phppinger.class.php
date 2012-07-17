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
	 * @throws NotAStringException
	 * @throws NotAnIntegerException
	 * @throws ConnectionFailedException - If ping failed
	 * @return boolean - If ping succeeded
	 */
	public function ping($host,$port=80,$supressWarning=true) {
		if(!is_string($host))
			throw new NotAStringException('First parameter $host is not a string');
		
		if(!is_int($port))
			throw new NotAnIntegerException('Second parameter $port is not an integer');
		
		if(!is_bool($supressWarning))
			throw NotABooleanException('Third parameter $supressWarning is not a boolean');
		
		if($supressWarning) {
			$connection = @fsockopen($host,$port);
		} else {
			$connection = fsockopen($host,$port);
		}

		if(!$connection)
			throw new ConnectionFailedException('Connection to host failed');
		
		fclose($connection);
		
		return true;
	}	
}
?>