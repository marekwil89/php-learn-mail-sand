<?php 


/**
* Logs
*
* txt('logs_lead.txt', 'treść');
*
*/

class Logs
{
	public function txt( $file, $data){
		date_default_timezone_set('Europe/Warsaw');

		if(!file_exists($file)){
			$create = fopen($file, "w"); 
			fclose($create); 
		}
		
		$current = file_get_contents($file);
		$current .= $data."\n"; 
		
		file_put_contents($file, $current);
	}
}
