<form method="get" id="searchform" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s" class="assistive-text hidden"><?php _e( 'Search', 'tubman' ); ?></label>
	<div class="input-append">
		<input id="s" class="col-sm-6 col-sm-offset-3 form-control" type="search" name="s" placeholder="Search" size="50"><!--
	 --><button class="btn btn-default" name="submit" id="searchsubmit" type="submit"><i class="glyphicon glyphicon-search"></i></button>
   	</div>
</form>

