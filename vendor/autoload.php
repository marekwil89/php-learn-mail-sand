<?php 


require_once 'config.php';


function __autoload($className)
{
    $path = $className. '.php';
    
	//if( file_exists( $path ) ){
    	require_once $path;
    //}
}


require_once 'functions.php';
