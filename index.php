<?php get_header(); ?>

  <div class="row">

    <div class="col-sm-9 blog-main">

      <?php 
      if (have_posts()) : while (have_posts()) : the_post();
    
        get_template_part( 'content');
      endwhile; ?>
      <nav>
        <ul class="pager">
          <li><?php next_posts_link( 'Previous' ); ?></li>
          <li><?php previous_posts_link( 'Next' ); ?></li>
        </ul>
      </nav> 
      <?php else : ?>
      <header class="page-header text-center">
        <h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'tubman' ); ?></h1>
      </header><!-- .page-header -->

      <div class="entry-content">
        <p class="text-center"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links on the right, can help.', 'tubman' ); ?></p>

        <?php get_search_form(); ?>
        </div>
      <?php endif; ?>

    </div> <!-- /.blog-main -->

    <?php get_sidebar(); ?>

  </div> <!-- /.row -->

<?php get_footer(); ?>