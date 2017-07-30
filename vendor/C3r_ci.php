<?php 

/**
* Autoload Codeigniter
*/
class C3r_ci
{

	function __construct()
	{
		require_once 'functions.php';
		
		// require_once 'Csv.php';
	
		function __autoload($className)
		{
		    $path = $className. '.php';
		    
		    require_once $path;
		}
	}

}
