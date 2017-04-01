<?php get_header(); ?>
	<div class= "row">
		<div class="col-sm-9 col-xs-12">
			<?php if (have_posts()) :  ?>
			<h1 class="page-title text-center"><?php echo ucfirst(single_cat_title( '', false )); ?></h1>
			<hr>
			<?php endif; ?>
		</div>
	</div>
  	<div class="row">

	    <div class="col-sm-9 blog-main">
		  <?php if (have_posts()) : 
	      while (have_posts()) : the_post();
	    
	        get_template_part( 'content', get_post_format() );
	      endwhile; ?>
	      <nav>
	        <ul class="pager">
	          <li><?php next_posts_link( 'Previous' ); ?></li>
	          <li><?php previous_posts_link( 'Next' ); ?></li>
	        </ul>
	      </nav> 
	      <?php else : ?>
	        <h1>Not Found</h1>
	      <?php endif; ?>

	    </div> <!-- /.blog-main -->

    	<?php get_sidebar(); ?>

  	</div> <!-- /.row -->

<?php get_footer(); ?>

