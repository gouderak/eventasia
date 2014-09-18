<aside>
	<div id="sidebar">
  		<ul class="sidebar-menu nav-collapse">
		<?php 
			
			/* MOGELIJKE SUBMENUS */
			$submenu = array(
				"list" => array(
					"text" => "Volledige lijst",
					"icon" => "fa fa-list"
				),
				"new" => array(
					"text" => "Aanmaken",
					"icon" => "fa fa-plus"
				),
			);
		
			$menu = array(
				"Home" => array(
					"url" => "/eventasia/cms/",
					"icon" => "fa fa-home",
				),
				"Evenementen" => array(
					"url" => "/eventasia/cms/evenementen/",
					"icon" => "fa fa-key",
					"submenu" => array(
						"list",
						"new"
					)
				),
				"Leden" => array(
					"url" => "/eventasia/cms/leden/",
					"icon" => "fa fa-home",
					"submenu" => array(
						"list",
						"new"
					)
				),
				"Fotos" => array(
					"url" => "/eventasia/cms/fotos/",
					"icon" => "fa fa-home",
					"submenu" => array(
						"list",
						"new"
					)
				),
				//"Nieuwsbrief" => array(
			//		"url" => "/eventasia/cms/nieuwsbrief/",
			//		"icon" => "fa fa-mail",
				//	"submenu" => array(
				//		"list",
				//		"new"
				//	)
			//	),
				"Uitloggen" => array(
					"url" => "/eventasia/cms/uitloggen/",
					"icon" => "fa fa-lock"
				),
			);
			
			$paths = explode("/", $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
			$activeMenu = $paths[2];
			
			foreach($menu as $key => $item):
				
				$activeMenu == strtolower($key) ? $class = 'active' : $class = '';
				isset($item["submenu"]) ? $mainClass = "has-submenu" : $mainclass = "";
				
  				if($key == "Home"):
  					empty($activeMenu) ? $class = 'active' : $class = '';
  				?>
					<li class="<?php echo $class; ?>">
  						<a class="<?php echo $class; ?>" href="<?php echo $item["url"]; ?>">
  							<i class="<?php echo $item["icon"]; ?>"></i>
  							<span><?php echo $key; ?></span>
  						</a>
  					</li>  	
	  			<?php elseif($key == "Uitloggen"): ?>
  					<li>
  						<a class="<?php echo $class; ?>" href="<?php echo $item[$key]; ?>">
  							<i class="<?php echo $item["icon"]; ?>"></i>
  							<span><?php echo $key; ?></span>
	  						</a>
  						</li>
  				<?php else: ?>
  						<li class="<?php echo $mainClass . " " . $class; ?>" >
  							<a href="<?php echo $item["url"]; ?>">
  								<i class="fa fa-plus"></i>
  								<span><?php echo $key; ?></span>
  								<span class="arrow"></span>
  							</a>
  							<?php if(count($item["submenu"])): ?>
  								<ul class="submenu">
  								<?php foreach($item["submenu"] as $subitem): ?>
  									<?php $link = explode("en", $key); ?>
  									<?php $subitem == "new" ? $url = "/eventasia/cms/gerecht/?type=" . strtolower($link[0]) : $url = $item["url"] . "?view=" . $subitem; ?>
  									<?php strtolower($key) == $activeMenu && $subitem == $_GET["view"] ? $subclass = "active" : $subclass = ""; ?>
		  							<li class="<?php echo $subclass; ?>">
		  								<a href="<?php echo $url; ?>">
		  									<i class="<?php echo $submenu[$subitem]["icon"]; ?>"></i>
		  									<span><?php echo $submenu[$subitem]["text"]; ?></span>
		  								</a>
		  							</li>
	  							<?php endforeach; ?>
	  							</ul>
	  						<?php endif; ?>
	  					</li>
	  			<?php endif; ?> 	
	  		<?php endforeach; ?> 	
  			</ul>
  		</div>
</aside>