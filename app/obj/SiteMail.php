<?php
/*
 * Dependencies: Database
 */
class SiteMail extends DatabaseObject
{
	protected static $tableName = "siteMail";
	protected static $tableFields = ['id', 'name', 'email', 'message', 'datetime'];
	public $id;
	public $name;
	public $email;
	public $message;
	public $datetime;

	public static function write($name, $email, $message)
	{
		$mail = new SiteMail();
		$mail->name = $name;
		$mail->email = $email;
		$mail->message = $message;
		$mail->datetime = date("Y-m-d H:i:s");

		return $mail;
	}
}