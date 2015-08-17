<?php
	//set_include_path(__DIR__.'/models');
	//spl_autoload_extensions('.php');
	//spl_autoload_register();

	spl_autoload_register(function($class)
	{
		include __DIR__.'/models/'.$class.'.php';
	});