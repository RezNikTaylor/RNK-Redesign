<?php
/*
 * Dependencies: Database
 */
class DatabaseObject
{
	// Common Database Methods
	public static function findAll($extraSQL = "")
	{
		global $db;

		$extraSQL = trim($db->real_escape_string($extraSQL));

		return static::findBySQL("SELECT * FROM " . static::$tableName . " {$extraSQL}");
	}

	public static function findByID($id = 0)
	{
		global $db;

		$sql = "SELECT * FROM " . static::$tableName . " WHERE id={$id} LIMIT 1";
		$result = self::findBySQL($sql);

		return !empty($result) ? array_shift($result) : false;
	}

	public static function fieldValueExists($field, $value)
	{
		global $db;

		$field = $db->real_escape_string($field);
		$value = $db->real_escape_string($value);
		$sql = "SELECT * FROM " . static::$tableName . " WHERE {$field}='{$value}' LIMIT 1";
		$result = self::findBySQL($sql);

		return !empty($result) ? array_shift($result) : false;
	}

	public static function findBySQL($sql = "")
	{
		global $db;

		if (!empty($sql)) {
			$result = $db->query($sql);
			$object = [];

			while ($row = $db->fetch_array($result)) {
				$object[] = static::instantiate($row);
			}

			return $object;
		}

		return [];
	}

	public static function countAll()
	{
		global $db;
		$sql = "SELECT COUNT(*) FROM " . static::$tableName;
		$result = $db->query($sql);
		$row = $db->fetch_array($result);

		return array_shift($row);
	}

	public function save()
	{
		// A new record won't have an id yet.
		return isset($this->id) ? $this->update() : $this->create();
	}

	public function delete()
	{
		global $db;
		/*
		 * Don't forget your SQL syntax and good habits:
		 * - DELETE FROM table WHERE condition LIMIT 1
		 * - single-quotes around all values
		 * - escape all values to prevent SQL injection
		 * use LIMIT 1
		 */
		$sql = "DELETE FROM " . static::$tableName . " ";
		$sql .= "WHERE id=" . $db->real_escape_string($this->id) . " ";
		$sql .= "LIMIT 1";
		$db->query($sql);

		return ($db->affected_rows() == 1) ? true : false;
	}

	private static function instantiate($record)
	{
		$className = get_called_class();
		$object = new $className;

		foreach ($record as $attribute => $value) {
			if ($object->hasAttribute($attribute)) {
				$object->$attribute = $value;
			}
		}

		return $object;
	}

	private function hasAttribute($attribute)
	{
		// get_object_vars returns an associative array with all attributes
		// (inc. private ones!) as the keys and their current values
		$objectVars = $this->attributes();
		// We don't care about the value, we just want to know if the key exists
		// Will return true or false
		return array_key_exists($attribute, $objectVars);
	}

	protected function attributes()
	{
		// Return an array of attribute keys and their values
		$attributes = [];

		foreach (static::$tableFields as $field) {
			if (property_exists($this, $field)) {
				$attributes[$field] = $this->$field;
			}
		}

		return $attributes;
	}

	protected function sanitizedAttributes()
	{
		global $db;
		$cleanAttributes = [];
		/*
		 * sanitize the values before submitting
		 * Note: does not alter the actual value of each attribute
		 */
		foreach ($this->attributes() as $key => $value) {
			$cleanAttributes[$key] = $db->real_escape_string($value);
		}

		return $cleanAttributes;
	}

	protected function create()
	{
		global $db;
		/*
		 * Don't forget your SQL syntax and good habits:
		 * - INSERT INTO table (key, key) VALUES ('value', 'value')
		 * - single-quotes around all values
		 * - escape all values to prevent SQL injection
		 */
		$attributes = $this->sanitizedAttributes();
		$sql = "INSERT INTO " . static::$tableName . " (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";

		if ($db->query($sql)) {
			$this->id = $db->insert_id();

			return true;
		} else {
			return false;
		}
	}

	protected function update()
	{
		global $db;
		/*
		 * Don't forget your SQL syntax and good habits:
		 * - UPDATE table SET key='value', key='value' WHERE condition
		 * - single-quotes around all values
		 * - escape all values to prevent SQL injection
		 */
		$attributes = $this->sanitizedAttributes();
		$attributePairs = [];

		foreach ($attributes as $key => $value) {
			$attributePairs[] = "{$key}='{$value}'";
		}

		$sql = "UPDATE " . static::$tableName . " SET ";
		$sql .= join(", ", $attributePairs);
		$sql .= " WHERE id=" . $db->real_escape_string($this->id);
		$db->query($sql);

		return ($db->affected_rows() == 1) ? true : false;
	}
}