<div class="col-sm-3 col-xs-12 blog-sidebar" id="primary-sidebar">
	<?php if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>
	<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'primary-sidebar' ); ?>
	</div>
<?php endif; ?>
</div>