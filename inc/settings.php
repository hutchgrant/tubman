<?php
function display_twitter_element()
{
	?>
    	<input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" size="50" />
    <?php
}

function display_facebook_element()
{
	?>
    	<input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" size="50"  />
    <?php
}
function display_googleplus_element()
{
	?>
    	<input type="text" name="googleplus_url" id="googleplus_url" value="<?php echo get_option('googleplus_url'); ?>" size="50" />
    <?php
}
function display_linkedin_element()
{
	?>
    	<input type="text" name="linkedin_url" id="linkedin_url" value="<?php echo get_option('linkedin_url'); ?>" size="50" />
    <?php
}
function display_youtube_element()
{
	?>
    	<input type="text" name="youtube_url" id="youtube_url" value="<?php echo get_option('youtube_url'); ?>" size="50" />
    <?php
}
function display_front_left_block()
{
	?>
    	<input type="text" name="front_left_block" id="front_left_block" value="<?php echo get_option('front_left_block'); ?>" size="10"  />
    <?php
}
function display_front_right_block()
{
	?>
    	<input type="text" name="front_right_block" id="front_right_block" value="<?php echo get_option('front_right_block'); ?>" size="10" />
    <?php
}
function display_block_posts_per_page()
{
	?>
    	<input type="text" name="block_posts_per_page" id="block_posts_per_page" value="<?php echo get_option('block_posts_per_page'); ?>" size="4" />
    <?php
}
function display_copyright()
{
	?>
    	<input type="text" name="copyright" id="copyright" value="<?php echo get_option('copyright'); ?>" size="50" />
    <?php
}
function display_style_sheet()
{
	?>
	<link href="<?php echo bloginfo('template_directory').'/css/style-'.get_option('style_sheet').'.css'; ?>" rel="stylesheet">
		<h3 class="">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo get_option('style_sheet'); ?> style selected </h3>
    	<div class="row">
    		<div class="col-md-2 text-center">
    		    <input type="radio" name="style_sheet" id="style_sheet" value="blue" <?php if(get_option('style_sheet') == "blue"){ echo "checked"; } ?> />Default Blue
    			<img src="<?php echo get_template_directory_uri() . '/img/screen/default_screen.png'; ?>" />
    		</div>
    		<div class="col-md-2 text-center">
    		    <input type="radio" name="style_sheet" id="style_sheet" value="teal" <?php if(get_option('style_sheet') == "teal"){ echo "checked"; } ?> />Teal
    			<img src="<?php echo get_template_directory_uri() . '/img/screen/teal_screen.png'; ?>" />
    		</div>
    		<div class="col-md-2 text-center">
    		    <input type="radio" name="style_sheet" id="style_sheet" value="teal2" <?php if(get_option('style_sheet') == "teal2"){ echo "checked"; } ?> />Teal 2
    			<img src="<?php echo get_template_directory_uri() . '/img/screen/teal2_screen.png'; ?>" />
    		</div>
    		<div class="col-md-2 text-center">
    		     <input type="radio" name="style_sheet" id="style_sheet" value="black" <?php if(get_option('style_sheet') == "black"){ echo "checked"; } ?> />Black
    			<img src="<?php echo get_template_directory_uri() . '/img/screen/black_screen.png'; ?>" />
    		</div>
    		<div class="col-md-2 text-center">
    		     <input type="radio" name="style_sheet" id="style_sheet" value="red" <?php if(get_option('style_sheet') == "red"){ echo "checked"; } ?> />Red
    			<img src="<?php echo get_template_directory_uri() . '/img/screen/red_screen.png'; ?>" />
    		</div>
    	</div>
    <?php
}
function display_theme_panel_fields()
{
	add_settings_section("style-section", "Style Settings", null, "theme-options");
	add_settings_field("style_sheet", "Site Style", "display_style_sheet", "theme-options", "style-section");

	add_settings_section("social-section", "Social Settings", null, "theme-options");

	add_settings_field("twitter_url", "Twitter Profile Url", "display_twitter_element", "theme-options", "social-section");
    add_settings_field("facebook_url", "Facebook Profile Url", "display_facebook_element", "theme-options", "social-section");
	add_settings_field("googleplus_url", "Google+ Profile Url", "display_googleplus_element", "theme-options", "social-section");
	add_settings_field("linkedin_url", "LinkedIn Profile Url", "display_linkedin_element", "theme-options", "social-section");
	add_settings_field("youtube_url", "Youtube Profile Url", "display_youtube_element", "theme-options", "social-section");

	add_settings_section("front-section", "Front Page Settings", null, "theme-options");

	add_settings_field("front_left_block", "Front Page Bottom Left Block Category", "display_front_left_block", "theme-options", "front-section");
	add_settings_field("front_right_block", "Front Page Bottom Right Block Category", "display_front_right_block", "theme-options", "front-section");
	add_settings_field("block_posts_per_page", "The number of blog postings in front page blocks(default 3)", "display_block_posts_per_page", "theme-options", "front-section");

	add_settings_section("footer-section", "Footer Settings", null, "theme-options");

	add_settings_field("copyright", "Copyright in footer, beginning with the year, then person/organization/company", "display_copyright", "theme-options", "footer-section");

    register_setting("theme-settings", "style_sheet");
    register_setting("theme-settings", "twitter_url");
    register_setting("theme-settings", "googleplus_url");
    register_setting("theme-settings", "facebook_url");
    register_setting("theme-settings", "linkedin_url");
    register_setting("theme-settings", "youtube_url");
    register_setting("theme-settings", "front_left_block");
    register_setting("theme-settings", "front_right_block");
    register_setting("theme-settings", "block_posts_per_page");
    register_setting("theme-settings", "copyright");

}
function theme_settings_page()
{
	?>
	    <div class="wrap">
	    <h1>Theme Panel</h1>
		<form method="post" action="options.php"> 
	        <?php
	            settings_fields("theme-settings");
	            do_settings_sections("theme-options");
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}

function add_theme_menu_item()
{
	add_theme_page("Tubman Settings", "Tubman Settings", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

add_action("admin_menu", "add_theme_menu_item");
add_action("admin_init", "display_theme_panel_fields");