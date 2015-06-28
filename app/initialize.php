<?php
$root = $GLOBALS['root'];
defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

// Core directories
defined("HOME") ? null :
	define("HOME", DS . 'var' . DS . 'www' . DS . 'html' . DS . 'RNK-Redesign');

defined("APP") ? null :
	define("APP", HOME . DS . 'app');

defined("OBJ") ? null :
	define("OBJ", APP . DS . 'obj');

defined("PUBLIC_HTML") ? null :
	define("PUBLIC_HTML", HOME . DS . 'html');

// Resource directories
defined("RES") ? null :
	define("RES", $root . DS . 'res');

defined("CSS") ? null :
	define("CSS", RES . DS . 'css');

defined("IMG") ? null :
	define("IMG", RES . DS . 'img');

defined("JS") ? null :
	define("JS", RES . DS . 'js');

// Load config and functions files first
require APP . DS . 'config.php';
require APP . DS . 'functions.php';

// Load core objects
require OBJ . DS . 'Session.php';
require OBJ . DS . 'Database.php';

// Database-driven objects
require OBJ . DS . 'User.php';
require OBJ . DS . 'SiteMail.php';