<?php

class Classloader {

	public static function load(array $classmap) {

		foreach ($classmap as $classdir) {
			if(!file_exists($classdir)) {
				throw new \Exception('Class directory '. $classdir .' does not exists.');
			}
		}

		spl_autoload_register(function($class_name) use ($classmap) {
			// $class_path = str_replace('\\', '/', $class_name);

			foreach ($classmap as $classdir) {
				if(file_exists($classdir.$class_name.'.php')){
					require_once($classdir.$class_name.'.php');
					return;
				}
			}
		});
	}
}
