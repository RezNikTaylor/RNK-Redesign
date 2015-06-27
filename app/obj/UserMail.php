<?php
/*
 * Dependencies: Database
*/
class UserMail extends DatabaseObject
{
	protected static $tableName = "userMail";
	protected static $tableFields = ['id', 'fromID', 'toID', 'message', 'datetime'];
	public $id;
	public $fromID;
	public $toID;
	public $message;
	public $datetime;

	public static function getInbox($userID)
	{
		if (!User::IDExists($userID)) {
			return false;
		}

		return static::findBySQL("SELECT * FROM " . static::$tableName . " WHERE toID={$userID}");
	}

	public static function write($toID, $message)
	{
		$mail = new UserMail();
		$mail->fromID = $_SESSION['userID'];
		$mail->toID = $toID;
		$mail->message = $message;
		$mail->datetime = date("Y-m-d H:i:s");

		return $mail;
	}
}