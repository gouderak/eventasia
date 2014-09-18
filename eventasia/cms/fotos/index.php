<?php include('../paginaopbouw/head.php'); ?>
<?php include('../functies.php'); ?>
<?php include('../paginaopbouw/sidebar.php');?>
  			<section id="main-content">
  				<section class="wrapper">  
  					<h3>Koken met Oma - Voorgerechten</h3>					
					<?php 
					switch($_GET['view']):
						case "list":
							$options = array(
								"view" => "voorgerechten",
								"type" => "voorgerecht",
								"columns" => array(
									"dish_title" => "Titel",
									"dish_hotcold" => "Warm/Koud"
								)
							);
							
							new Overview($database, $options);
						break;
						default:
							echo "Lijst met alle voorgerechten.";
						break;
					endswitch;
					?>
  				</section>
  			</section>
  		</section>	
     </body>
</html>					
  