<?php

function debug($var) {
	echo "<pre>";
//	var_dump($var);
	print_r($var);
	echo "</pre>";
}

function redirect($location) {
	header("Location: {$location}");
}

function validString($var) {
	if (is_string($var)) {
		if (!empty($var) && is_string($var)) {
			return true;
		}
	}

	if (is_array($var)) {
		foreach ($var as $data) {;
			if (empty($data) || !is_string($data)) {
				return false;
			}
		}

		return true;
	}

	return false;
}

function setMessage($message, $error = false) {
	if (!isset($GLOBALS['message'])) {
		$GLOBALS['message'][] = [$message, $error];
	} else {
		$GLOBALS['message'][] = [$message, $error];
	}
}

function getMessage() {
	// die(debug($GLOBALS['message']));

	if (isset($GLOBALS['message'])) {
		foreach ($GLOBALS['message'] as $message) {
			if ($message[1]) {
				echo "<p style='color: #dd0000; font-weight: bold'>{$message[0]}</p>";
			} else {
				echo "<p style='color: #00dd00; font-weight: bold'>{$message[0]}</p>";
			}
		}
	}
}

function shiftArray($array, $index, $direction)
{
	if (is_array($array) && is_int($index) && is_string($direction)) {
		if ($index < count($array)) {
			$item = $array[$index];

			if ($direction == 'up' && $index) {
				$array[$index] = $array[$index-1];
				$array[$index-1] = $item;
			} else if ($direction == 'down' && $index !== count($array) - 1) {
				$array[$index] = $array[$index+1];
				$array[$index+1] = $item;
			}
		}
	}

	return $array;
}

function logAction($action, $message = "")
{
	$logfile = APP . DS . 'log.txt';
	$new = file_exists($logfile) ? false : true;

	if ($fp = fopen($logfile, 'a')) {
		$timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
		$log = "{$timestamp} | {$action}: {$message}\n";
		fwrite($fp, $log);
		fclose($fp);
		if ($new) chmod($logfile, 0775);
	}
}

function datetimeToText($datetime = "")
{
	$unixdatetime = strtotime($datetime);
	return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

spl_autoload_register(function ($class) {
	$file = OBJ . DS . "{$class}.php";

	if (file_exists($file)) {
		require $file;
	} else {
		die("The file {$class}.php could not be found.");
	}
});

function includeFile($file) {
	$path = APP . DS . 'inc' . DS . $file;
	if (file_exists($path)) {
		require($path);
	}
}

function getGlobal($varAsString)
{
	return (isset($GLOBALS[$varAsString])) ? $GLOBALS[$varAsString] : "";
}

function getAlerts()
{
	global $message, $error;

	if (validString($message)) {
		echo "<p><span class='glyphicon glyphicon-ok-circle message-color' aria-hidden='true'></span> " . $message . "</p>";
	}

	if (validString($error)) {
		echo "<p><span class='glyphicon glyphicon-remove-circle error-color' aria-hidden='true'></span> " . $error . "</p>";
	}
}