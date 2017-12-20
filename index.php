<?php
session_start();

require 'config.php';

spl_autoload_register(function($class){
	
	if (file_exists('Controllers/'.$class.'.php'))
		{
			require 'Controllers/'.$class.'.php';	
		}
	else if (file_exists('Model/'.$class.'.php'))
		{
			require 'Model/'.$class.'.php';
		}
	else if (file_exists('Core/'.$class.'.php'))
		{
			require 'Core/'.$class.'.php';
		}
});

$core = new Core();
$core->run();

?>