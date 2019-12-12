<?php

/*
 * Start a new session.
 */
session_start();

/* 
 * Set a global variable array of arrays to key -> value pair, where can access this information from all classes.
 */
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'entry',
		'password' => 'D6Af8Yxbua8b1FaP',
		'db' => 'entry'
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
	)
);

/*
 * Loading required classes from "classes" folder.
 */
spl_autoload_register(function($class) {
require_once 'core/' . $class . '.php';
});

/*
 * Pull out the functions from file "sanitize.php".
 */
require_once 'functions/sanitize.php';