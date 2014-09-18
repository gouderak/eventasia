<?php
	
	/*$insertArray = array(
		"id" => 4,
		"username" => "henk",
		"password" => "hallo",
	);
	
	$updateArray = array(
		"data" => array(
			"password" => "harrie"
		),
		"id" => 4
	);*/

	class database{
		
		private $host, $user, $password, $database;
		public static $_mysqli;
		public static $_instance;
		
		public function __construct($host, $user, $password, $database){
			self::$_mysqli = new mysqli($host, $user, $password, $database);
			if(self::$_mysqli->connect_errno) {
				echo self::$_mysqli->connect_error;
			}
		}
		
		public function delete($table, $param){
			$query = "DELETE FROM " . $table . " WHERE id = " . $param;
			if(!$this->setQuery($query)){
				echo self::$_mysqli->error;
			}
		}
		
		public function update($table, array $params){
			
			$keys = array_keys($params["data"]);
			$query = "UPDATE " . $table . " SET ";
			
			foreach($params["data"] as $key => $value){
				$position = array_search($key, $keys);
				if(!isset($keys[$position+1])){
					$query .= $key .  " = ";
					$query .= is_string($value) ? "'" . $value . "'" : $value;
				} else {
					$query .= $key .  " = ";
					$query .= is_string($value) ? "'" . $value . "', " : $value . ", ";
				}
			}
			
			$value = end($params);
			$column = key($params);
			
			$query .= " WHERE " . $column . " = ";
			$query .= is_string($value) ? "'" . $value . "'" : $value;
			
			if(!$this->setQuery($query)){
				die(self::$_mysqli->error);
			}
			
			return true;
			
		}
		
		public function fullList($table, array $columns, $where = false){
			$query = "SELECT " . implode(", ", $columns) . " FROM " . $table;
		if($where){
   $query .= " WHERE dish_type = '" . $where . "'";
}
			if(!$result = $this->setQuery($query)){
				echo self::$_mysqli->error;
			} else {
				$rows = array();
				while($row = $result->fetch_row()){
				   $rows[] = $row;
				}

return $rows;
			}
		}
		
		public function query($query)
		{
			if(!$result = $this->setQuery($query)){
				echo self::$_mysqli->error;
			} else {
				return $result;
			}
		}
			
		public function insert($table, array $data){
			
			$keys = array_keys($data);
			
			$query = "INSERT INTO " . $table;
			$columnData = "";
			$insertData = "";
			
			foreach($data as $key => $value){
				
				$position = array_search($key, $keys);
				
				if(!isset($keys[$position+1])){
					$columnData .= $key;
				} else {
					$columnData .= $key . ", ";
				}
				
				// Als het een integer is
				
				if(is_int($value)){
					if(!isset($keys[$position+1])){
						$insertData .= $value;
					} else {
						$insertData .= $value . ", ";
					}
					
				// Als het een string is
				
				} else {
					if(!isset($keys[$position+1])){
						$insertData .= "'" . $value . "'";
					} else {
						$insertData .= "'" . $value . "', ";
					}
				}
			}
			
			$query .= " (" . $columnData . ")";
			$query .= " VALUES(" . $insertData . ")";
			
			if(!$this->setQuery($query)){
				echo self::$_mysqli->error;
			} 
			
			return true;
		}
		
		public function getItem($table, $id){
			$query = "SELECT * FROM " . $table . " WHERE dish_id = " . (int)$id;
			if(!$result = $this->setQuery($query)){
				echo self::$_mysqli->error;
			} else {
				return $result->fetch_assoc();
			}
		}
		
		public function dataExists($table, $data){
			
		}
		
		public function getLatestId(){
		}
		
		public function getInstance(){
			if(!self::$_instance){
				self::$_instance = new self;
			}
			
			return self::$_instance;
		}
		
		public function strip($val){
			return self::$_mysqli->escape_string($val);
		}
		
		protected function setQuery($query){
			
			if(is_object(self::$_mysqli)){
				return self::$_mysqli->query($query);
			} else {
				die("Er is geen connectie!");
			}
		}
	}
	
?>