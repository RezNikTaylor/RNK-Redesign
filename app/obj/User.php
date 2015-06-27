<?php
/*
 * Dependencies: Database, Session
*/
class User extends DatabaseObject
{
	protected static $tableName = 'users';
	protected static $tableFields = ['id', 'username', 'password', 'firstName', 'lastName', 'email', 'type'];
	public $id;
	public $username;
	public $password;
	public $firstName;
	public $lastName;
	public $email;
	public $type;

	public static function get($onlyTypes = "all")
	{
		global $root, $session;

		if ($session->loggedIn()) {
			$user = self::findByID($session->userID);

			if ($onlyTypes !== 'all') {
				if (is_string($onlyTypes)) {
					if ($user->type !== $onlyTypes) {
						$session->error("Sorry, you don't have the privileges to view that page.");
						redirect($root . DS . 'account' . DS . $user->type);
					}
				} else if (is_array($onlyTypes)) {
					if (!in_array($user->type, $onlyTypes)) {
						$session->error("Sorry, you don't have the privileges to view that page.");
						redirect($root . DS . 'account' . DS . $user->type);
					}
				}
			}
		} else {
			$session->message("Please login first.");
			redirect($root . DS . 'account' . DS . 'login.php');
		}

		return isset($user) ? $user : false;
	}

	public function fullName()
	{
		if (isset($this->firstName) && isset($this->lastName)) {
			return $this->firstName . ' ' . $this->lastName;
		}

		return "";
	}

	public static function authenticate($username = "", $password = "")
	{
		global $db;

		$username = $db->real_escape_string($username);
		$password = $db->real_escape_string($password);
		$sql = "SELECT * FROM " . self::$tableName . " ";
		$sql .= "WHERE username='{$username}' ";
		$sql .= "AND password='{$password}' ";
		$sql .= "LIMIT 1";
		$result = self::findBySQL($sql);

		return !empty($result) ? array_shift($result) : false;
	}

	public static function register($username, $password, $firstName, $lastName, $email)
	{
		global $db;

		$username = $db->real_escape_string($username);
		$password = $db->real_escape_string($password);
		$firstName = $db->real_escape_string($firstName);
		$lastName = $db->real_escape_string($lastName);
		$email = $db->real_escape_string($email);

		if (validString([$username, $password, $firstName, $lastName, $email])) {
			if (!self::fieldValueExists('username', $username)) {
				$newUser = new User();
				$newUser->username = $username;
				$newUser->password = $password;
				$newUser->firstName = $firstName;
				$newUser->lastName = $lastName;
				$newUser->email = $email;
				$newUser->type = 'user';

				return $newUser;
			}
		}

		return false;
	}

	public static function IDExists($id)
	{
		$user = static::fieldValueExists('id', $id);

		return ($user) ? $user->username : false;
	}
}