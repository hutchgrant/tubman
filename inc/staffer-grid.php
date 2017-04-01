<?php // staffer grid template
$stafferoptions = get_option('staffer');
?>	
<div class="row">	
<?php if (have_posts() ) : ?>

<!--	<ul class="staffer-archive-grid"> -->

<?php while ( have_posts() ) : ?>

<?php the_post(); ?>

<div class="col-md-4 col-sm-6 col-xs-12">
	<header class="staffer-staff-header text-center">
	<h3 class="staffer-staff-title"><a href="<?php the_permalink(); ?>">
		<?php echo the_title(); ?>
		</a>
	</h3>
	<?php
	if ( get_post_meta ($post->ID,'staffer_staff_title', true) != '' ) {
		echo '<em>';
		echo get_post_meta ($post->ID,'staffer_staff_title', true) . '</em><br>';
		}
		?>
	
	</header>
		<div class="staff-content">
		<?php
			if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail ( 'medium', array ('class' => 'aligncenter') ); ?>
				</a>
				<?php
			}
			if ($stafferoptions['estyle'] == null or $stafferoptions['estyle'] == 'excerpt' ) {
				the_excerpt();
			} elseif ($stafferoptions['estyle'] == 'full' ) {
				the_content();
			} elseif ($stafferoptions['estyle'] == 'none' ) {
				// nothing to see here
			} 
			?>
		</div>
	</div>
<?php endwhile;
endif; ?>
<!-- </ul> -->
</div>