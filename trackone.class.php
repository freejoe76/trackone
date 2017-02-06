<?php
include('sqlite.class.php');

class TrackOne
{
    public function __construct($name)
	{
		$name = strtolower($name);
		$this->db_name = $name . '.db';
		$this->table = $name;
		$this->db = new SQLite($this->db_name);
	}

	public function create_table()
	{
		$sql = "CREATE TABLE IF NOT EXISTS $this->table (id INTEGER PRIMARY KEY AUTOINCREMENT, date DATE);";
		$this->db->prepare($this->db_name, $sql);
		$this->db->execute($this->db_name);
		return true;
	}

	public function add_record()
	{
		$sql = "INSERT INTO $this->table(date) VALUES (date('now'));";
		$this->db->prepare($this->db_name, $sql);
		$this->db->execute($this->db_name);
		return true;
	}

	public function query_table()
	{
		$sql = "SELECT * FROM $this->table;";
		$this->db->prepare($this->db_name, $sql);
		$this->db->execute($this->db_name);
		return $this->db->fetch($this->db_name);
	}
}

function make_name($input)
{
	return ucwords(str_replace('_', ' ', $input));
}
