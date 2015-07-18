<?php

require_once __DIR__ . '/Database.php';

abstract class TableAbstract {

	protected $name;
	protected $primaryKey = 'id', $dbh, $db;

	public function __construct() {
		$this->db = Database::getInstance();
		$this->dbh = $this->db->getDbh();
	}

	public function fetchAll() {
		$sql = 'SELECT * FROM ' . $this->name;
		$results = $this->dbh->prepare($sql);
		$results->execute();
		return $results;
	}

	public function fetchByPrimaryKey($key) {
		$sql = 'SELECT * FROM ' . $this->name . ' WHERE ' . $this->primaryKey . ' = :id LIMIT 1';
		$results = $this->dbh->prepare($sql);
		$results->execute(array(':id' => $key));
		return $results->fetch();
	}

}
