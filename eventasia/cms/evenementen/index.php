<?php include('../paginaopbouw/head.php'); ?>
<?php include('../functies.php'); ?>
<?php include('../paginaopbouw/sidebar.php');?>
  			<section id="main-content">
  				<section class="wrapper">  
  					<h3>Koken met Oma - Bijgerechten</h3>					
					<?php 
					switch($_GET['view']):
						case "list":
							$options = array(
								"view" => "bijgerechten",
								"type" => "bijgerecht",
								"columns" => array(
									"dish_title" => "Titel",
									"dish_hotcold" => "Warm/Koud"
								)
							);
							
							new Overview($database, $options);
						break;
						default:
							echo "Lijst met alle bijgerechten.";
						break;
					endswitch;
					?>
  				</section>
  			</section>
  		</section>	
     </body>
</html>					
  