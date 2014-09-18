<?php 
	
	class Overview{
		
		protected $database;
		
		public function __construct($database, $options){
			
			$this->database = $database;
			$this->options = $options;
			
			foreach($this->options["columns"] as $key => $value){
				$cols[] = $key;
			}
			
			$query = "SELECT event_id AS id, " . implode(",", $cols) . " FROM dish WHERE event_type = '" . $options["type"] . "'";			
			$items = $this->database->query($query);
			
			//var_dump($items); die;
			
			echo $this->returnTable($items);
		}
		
		public function returnTable($result){
			$html .= "<table class='table table-striped'>";
				$html .= "<tr>";
					$html .= "<th>ID</th>";
					foreach($this->options["columns"] as $key => $value):
						$html .= "<th>" . $value . "</th>";
					endforeach;
				$html .= "</tr>";
				while($item = $result->fetch_assoc()):
					$html .= "<tr>";
						$html .= "<td>" . $item["id"] . "</td>";
						$html .= "<td><a href='/cms/gerecht/?id=" . $item["id"] . "'>" . $item["dish_title"] . "</a>";
						$html .= "<td>" . $item["dish_hotcold"] . "</td>";
					$html .= "</tr>";
				endwhile;
			$html .= "</table>";
			
			return $html;
		}
		
	}