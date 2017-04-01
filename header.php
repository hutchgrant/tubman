<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php wp_title('|',1,'right'); ?> <?php bloginfo('name'); ?></title>
	<link href="<?php bloginfo('template_directory');?>/style.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_enqueue_scripts("jquery"); ?>
    <?php wp_head(); ?>
</head>
  <body>

    <div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
				$image = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>
				<a href="<?php echo get_site_url(); ?>"><img class="logo_head" src="<?php echo $image[0]; ?>" /></a>
			</div>
			<div class="col-lg-4 col-md-4 headerR">
				<form class="navbar-form navbar-right" role="search" action="<?php echo get_site_url(); ?>" method="get">
				    <div class="form-group">
				       <input name="s" type="text" class="form-control" placeholder="Search" size="20">
				    </div>
				       <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
				</form>				
			</div>
		</div>
		<div class="row">
	      	<nav class="navbar navbar-inverse navbar-default">
		        <div class="container-fluid">
		          	<div class="navbar-header">
			            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			              <span class="sr-only">Toggle navigation</span>
			              <span class="icon-bar"></span>
			              <span class="icon-bar"></span>
			              <span class="icon-bar"></span>
			            </button>
		        	</div>
		       		<div id="navbar" class="navbar-collapse collapse">
	            		<ul class="nav navbar-nav">
							 <?php
					            wp_nav_menu( array(
					                'menu'              => 'primary',
					                'theme_location'    => 'primary',
					                'depth'             => 2,
					                'container'         => 'div',
					                'menu_class'        => 'nav navbar-nav',
					                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
					                'walker'            => new wp_bootstrap_navwalker())
					            );
					        ?>
						</ul>
						<form class="navbar-form navbar-right navsearch" role="search" action="<?php echo get_site_url(); ?>" method="get">
						    <div class="form-group">
						       <input name="s" type="text" class="form-control" placeholder="Search" size="20">
						    </div>
						       <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
						</form>
				 	</div><!--/.nav-collapse -->
				</div>
			</nav>
		</div>
	</div> <!-- close container -->
	<div class="main-container container">