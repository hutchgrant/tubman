	</div> <!-- /container -->

    <footer class="footer container">
    
        <div class="row">
      		<div class="col-md-4 col-sm-12" id="footbar-1">
            <?php if ( is_active_sidebar( 'footbar-1' ) ) : ?>
            <div id="secondary" class="widget-area" role="complementary">
              <?php dynamic_sidebar( 'footbar-1' ); ?>
            </div>
            <?php endif; ?>
      		</div>
      		<div class="col-md-4 col-sm-12 text-center">
      			<h4 class="text-center">Follow Us</h4>
      			<div class="social">
            <ul>
            <?php 

            if(get_option('facebook_url')){ ?>
              <a href="<?php echo get_option('facebook_url'); ?>"><li id="facebook_icon"></li></a>
              <?php
            } 
            if(get_option('twitter_url')){ ?>
              <a href="<?php echo get_option('twitter_url'); ?>"><li id="twitter_icon"></li></a>
              <?php
            }
            if(get_option('googleplus_url')){ ?>
              <a href="<?php echo get_option('googleplus_url'); ?>"><li id="googleplus_icon"></li></a>
              <?php
            } 
            if(get_option('youtube_url')){ ?>
              <a href="<?php echo get_option('youtube_url'); ?>"><li id="youtube_icon"></li></a>
              <?php
            }
            if(get_option('linkedin_url')){ ?>
              <a href="<?php echo get_option('linkedin_url'); ?>"><li id="linkedin_icon"></li></a>
              <?php
            } ?>
            <a href="<?php echo get_option( 'siteurl' )."/feed"; ?>"><li id="rss_icon"></li></a>
            </ul>
      			</div>
      			<br>
      			<p class="site-copyright">Copyright © <?php echo get_option('copyright'); ?></p>
      			<p class="site-author">Site theme by hutchgrant</p>
      		</div>
      		<div class="col-md-4 col-sm-12" id="footbar-2">
            <?php if ( is_active_sidebar( 'footbar-2' ) ) : ?>
            <div id="secondary" class="widget-area" role="complementary">
              <?php dynamic_sidebar( 'footbar-2' ); ?>
            </div>
            <?php endif; ?>
      		</div>
    	</div>

    </footer>

<?php wp_footer(); ?> 
  </body>
</html>