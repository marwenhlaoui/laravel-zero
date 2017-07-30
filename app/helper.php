<?php


/**
 * find all models in system
 *
 */
if (!function_exists("all_models")) {
	
	function all_models(){
		$path = app_path('Models/');
		$out = [];
	    $results = scandir($path);
	    foreach ($results as $filename) { 
	        if ((($filename != '.') && ($filename != '..')) && (!empty(explode('.', $filename)[1])&&(explode('.', $filename)[1] == 'php'))) {
	        	$out[] = explode('.', $filename)[0];
	        }
	    }
	    return $out;

	}

}