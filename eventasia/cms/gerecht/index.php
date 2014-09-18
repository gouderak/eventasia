<?php 
	include('../paginaopbouw/head.php'); 
 	include('../functies.php'); 
 	include('../paginaopbouw/sidebar.php');
 ?>
 	
 	<?php  	
 		if($_POST){
 			
 			$item = $_POST["item"];
 			
	 		foreach($item as $key => $value){
	 			if(!empty($value)){
	 				$value = $database->strip($value);
	 			} else {
	 				$message = array("type" => "warning", "text" => "Vul " . ucfirst($key) . " in alstublieft!");
	 				break;
	 			}
	 		}
	 		
	 		if(!$message){
	 			if($_GET["id"] > 0):
	 				if($database->update("dish", array("data" => $item, "dish_id" => $_GET["id"]))){
	 					$message = array("type" => "success", "text" => "Item succesvol aangepast.");
	 				} else {
	 					$message = array("type" => "danger", "text" => "Er is iets misgegaan.");
	 				}
	 			else:
	 				 if($database->insert("dish", $item)){
	 				 	 $message = array("type" => "success", "text" => "Item succesvol aangemaakt.");	
	 				 	 echo $database->getLatestId();
	 				 } else {
	 				 	$message = array("type" => "danger", "text" => "Er is iets misgegaan.");
	 				 }
	 			endif;
	 		}
	 		
 		}
 	?>
	<section id="main-content">
  		<section class="wrapper">  
  			<?php if($message): ?>
 				<div class="alert alert-<?php echo $message["type"]; ?> alert-dismissable"><?php echo $message["text"]; ?></div>
 			<?php endif; ?>
 			<?php 
		 		if($_GET["id"] > 0):
		 			$item = $database->getItem("dish", $_GET["id"]);
		 			?><h3>Wijzig <?php echo $item["dish_title"]; ?></h3><?php	
		 		else:
		 			?><h3>Nieuw gerecht aanmaken</h3><?php	
			 	endif;
 				?>
  				<form action="" method="post" role="form" width="50%">
					 <div class="form-group">
						  <label>Titel</label>
						  <input type="text" name="item[dish_title]" class="form-control" value="<?php echo $item["dish_title"]; ?>"/>
				  </div>
				  <div class="form-group">
					  <label>Gerecht type</label>
					  <select class="form-control"  name="item[dish_type]" value="<?php echo empty($item["dish_type"]) ? empty($_GET["type"]) ? '' : $_GET["type"] : ''; ?>">
						  <option value="bijgerecht">Bijgerecht</option>
						  <option value="voorgerecht">Voorgerecht</option>
						  <option value="hoofdgerecht">Hoofdgerecht</option>
						  <option value="nagerecht">Nagerecht</option>
					  </select>
			      </div>
			      <div class="form-group">
					  <label>Warm of koud?</label>
					  <select class="form-control"  name="item[dish_hotcold]" value="<?php echo $item["dish_hotcold"]; ?>">
					 	 <option value="Warm">Warm</option>
					  	 <option value="Koud">Koud</option>
					  </select>
				  </div>
				  <div class="form-group">
				   	 	<label>Bereiding</label>
				    	<textarea class="form-control" name="item[dish_preperation]" ><?php echo $item["dish_preperation"]; ?></textarea>
				  </div>
				  <div class="form-group">
				    	<label>Ingredi&euml;nten</label>
				    	<textarea class="form-control" name="item[dish_ingredients]"><?php echo $item["dish_ingredients"]; ?></textarea>
				  </div>
			  	<input type="submit" class="btn btn-default" value="Opslaan" />
			</form>
			</section>	
		</section>
	</body>
</html>
  				
  				
  				
  				
  				
  				
  			