<?php

if (!function_exists('loader')) {
	function loader($class) {
		$file = "". $class . '.class.php';
		if (file_exists($file)) {
			require $file;
		}	else if (file_exists("../". $file)) {
			require "../". $file;
		} else if(file_exists("./test/" . $class .".class.php")) {
			$file = "./test/" . $class .".class.php";
			require $file;
		} else if(file_exists("./src/php/" . $class .".class.php")) {
			$file = "./src/php/" . $class .".class.php";
			require $file;
		} else if(file_exists("./ext/php/libs/" . $class .".class.php")) {
			$file = "./ext/php/libs/" . $class .".class.php";
			require $file;
		} else if(file_exists("../../ext/php/libs/" . $class .".class.php")) {
			$file = "../../ext/php/libs/" . $class .".class.php";
			require $file;
		} else if(file_exists("./ext/php/lib/" . $class .".class.php")) {
			$file = "./ext/php/lib/" . $class .".class.php";
			require $file;
		} else if(file_exists("../../ext/php/lib/" . $class .".class.php")) {
			$file = "../../ext/php/lib/" . $class .".class.php";
			require $file;
		}
	}
}

spl_autoload_register('loader');


