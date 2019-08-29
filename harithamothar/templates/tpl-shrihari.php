<?php /* Template Name: Shrihari */
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage PixelsDen
 * @since 1.0
 * @version 1.0
 */
?>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/normalize.css?v=<?php echo $version; ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/fonts/fonts.css?v=<?php echo $version; ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/owl.carousel.min.css?v=<?php echo $version; ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/shrihari.css?v=<?php echo $version; ?>" />
	<title><?php the_field('title',$page_id); ?></title>
	<?php //wp_head(); ?>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="<?php bloginfo( 'template_directory' ); ?>/images/shrihari.svg" />
            </div>
        </div>
    </header>
	<div class="main">
		<div class="container">
			<div class="textcontent">
				<?php $shrihari_id = get_option( 'shrihari' ); ?>
				<h1><?php echo get_field("title",$shrihari_id); ?></h1>
				<?php
					wp_reset_query(); // necessary to reset query
					while ( have_posts() ) : the_post();
						the_content();
					endwhile; // End of the loop.
				?>
			</div>
			<div class="address-block">
			<?php
				
				$rows = get_field('addresses',$shrihari_id);
				if($rows)
				{ ?>
					<div class="address">
					<?php
					foreach($rows as $row)
					{ ?>
						<div class="item"><?php echo $row['address']; ?></div>
					<?php }  ?>
					</div>
				<?php } ?>
			</div>
			<h2>Ongoing Projects</h2>	
			<div class="projects">	
				
				<?php $rows = get_field('projects',$shrihari_id); 
				if($rows)
				{ ?>	
				<div class="project-slider owl-carousel">					
				<?php
					foreach($rows as $row)
					{ ?>
					<div class="item">
						<div class="project-name"><?php echo $row['project_name']; ?></div>
						<div class="project-address"><?php echo $row['project_address']; ?></div>
						<?php $imagerow = $row['project_images']; 
							if($imagerow) { ?>
								<div class="project-image-slider owl-carousel">	
								<?php foreach($imagerow as $row) { ?>
									<img src="<?php echo $row["image"]; ?>" />
								<?php } ?>
								</div>
								<?php
							} ?>						
					</div>
					<?php }  ?>								
				</div>
				<?php } ?>		
			</div>
			
		</div>
	</div>
</body>
<?php $version = "1.0.5"; ?>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jquery-3.3.1.min.js?v=<?php echo $version; ?>"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/owl.carousel.min.js?v=<?php echo $version; ?>"></script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQdch5IcgcQaKNG76sbMQv1MEBEKLeQ-8&callback=initMap"
      async
      defer
    ></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/shrihari.js?v=<?php echo $version; ?>"></script>
</body>
</html>