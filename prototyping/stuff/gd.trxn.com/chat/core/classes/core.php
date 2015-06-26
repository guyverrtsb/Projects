<?php

class core {
	protected $db, $result;
	private $rows;
	
	public function __construct() {
		$this->db = new mysqli('gddbzanderplay.db.6047355.hostedresource.com', 'gddbzanderplay', 'Z@dbander3', 'gddbzanderplay');
	}
	
	public function query($sql) {
		$this->result = $this->db->query($sql);
	}
	
	public function rows() {
		for($x = 1; $x <= $this->db->affected_rows; $x++) {
			$this->rows[] = $this->result->fetch_assoc();
		}
		return $this->rows;
	}
}

?>