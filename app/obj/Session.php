<?php
/*
 * A class to help work with Sessions
 * In our case, primarily to manage logging account in and out
 *
 * Keep in mind when working with sessions that it is generally
 * inadvisable to store database related objects in sessions
*/
class Session
{
	private $loggedIn = false;
	public $userID;
	public $message;
	public $error;

	public function __construct()
	{
		session_start();
		$this->checkMessage();
		$this->checkError();
		$this->checkLogin();

		if ($this->loggedIn) {
			// Actions to take right away if the account is logged in
		} else {
			// Actions to take right away if account is not logged in
		}
	}

	public function login($user)
	{
		// Database should find account based on username/password
		if ($user) {
			$this->userID = $_SESSION['userID'] = $user->id;
			$this->loggedIn = true;
		}
	}

	public function logout()
	{
		unset($_SESSION['userID']);
		unset($this->userID);
		$this->loggedIn = false;
	}

	public function loggedIn()
	{
		return $this->loggedIn;
	}

	public function message($message = "")
	{
		if (!empty($message)) {
			// Then this is "set message"
			// Understand that $this->message = $message wouldn't work
			$_SESSION['message'] = $message;
		} else {
			// Then this is "get message"
			return $this->message;
		}

		return null;
	}

	public function error($error = "")
	{
		if (!empty($error)) {
			// Then this is "set error"
			// Understand that $this->error = $error wouldn't work
			$_SESSION['error'] = $error;
		} else {
			// Then this is "get error"
			return $this->error;
		}

		return null;
	}

	private function checkLogin()
	{
		if (isset($_SESSION['userID'])) {
			$this->userID = $_SESSION['userID'];
			$this->loggedIn = true;
		} else {
			unset($this->userID);
			$this->loggedIn = false;
		}
	}

	private function checkMessage()
	{
		// Is there a message stored in the session?
		if (isset($_SESSION['message'])) {
			// Add it as an attribute
			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);
		} else {
			$this->message = "";
		}
	}

	private function checkError()
	{
		// Is there an error stored in the session?
		if (isset($_SESSION['error'])) {
			// Add it as an attribute
			$this->error = $_SESSION['error'];
			unset($_SESSION['error']);
		} else {
			$this->error = "";
		}
	}
}

$session = new Session();
$message = $session->message();
$error = $session->error();