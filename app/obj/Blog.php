<?php
/*
 *
 */
class Blog extends DatabaseObject
{
	public static $tableName = 'blog';
	public static $tableFields = ['id', 'title', 'datetime', 'article', 'keywords'];
	public $id;
	public $title;
	public $datetime;
	public $article;
	public $keywords;

	public static function post($title, $article, $keywords = "")
	{
		$blog = new Blog();
		$blog->title = $title;
		$blog->datetime = date('Y-m-d H:i:s');
		$blog->article = $article;
		$blog->keywords = $keywords;

		return $blog;
	}
}