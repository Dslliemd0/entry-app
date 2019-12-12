<?php

/*
 * Simple method which prevent input to being affected from SQL query injection.
 */ 
function escape($input) {
	return htmlentities($input, ENT_QUOTES, 'UTF-8');
}