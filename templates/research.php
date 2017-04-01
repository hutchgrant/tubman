<?php /* Template Name: Research */ 
get_header(); ?>
<?php require(__DIR__.'/../inc/wp_research_walker.php'); ?>
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<?php if ( is_active_sidebar( 'research-top' ) ) : ?>
	            <div id="secondary" class="widget-area" role="complementary">
	              <?php dynamic_sidebar( 'research-top' ); ?>
	            </div>
            <?php endif; ?>
            <hr>
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					 the_content();
				endwhile;  else: ?>
				<p><?php _e('Sorry, this page does not exist.'); ?></p>
			<?php endif; ?>
			<hr>		
		</div> 
	</div>
	<br><br>
<?php wp_nav_menu(
    array(
    	'menu'              	=> 'research',
		'theme_location'    	=> 'research',
		'depth'            		=> 2,
        'container'             => 'div',
        'container_class'       => 'research',
        'menu_class'            => 'research-menu',
        'fallback_cb'           => 'false',
        'walker'            => new Nav_Research_Walker()
    ));
?>
	<br><br>
<?php get_footer(); ?>