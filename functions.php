<?php 
// Register Custom Navigation Walker
require_once(__DIR__.'/inc/wp_bootstrap_navwalker.php');
require_once(__DIR__.'/inc/jw-widget.php');
require_once(__DIR__.'/inc/sw-widget.php');
require_once(__DIR__.'/inc/gm-widget.php');
require_once(__DIR__.'/inc/promo-widget.php');
require_once(__DIR__.'/inc/settings.php');


/* 
* Overwrite staffer plugin templates
* Regular members page can be themed, but default department page cannot be themed otherwise.
* No documentation for this, had to manually override filter then guess which template based on uri
* Had no choice, the staffer grid layout was unresponsive
*/
 function tubman_staffer_staff_templates( $template ) {
// determine what staffer page we're on
$current_uri = add_query_arg( NULL, NULL );
$current = substr($current_uri, 0, strlen($current_uri)-1);
$slashpos = strrpos($current, "/");
$current_page = substr($current, $slashpos+1, strlen($current_uri));
$subdirs = substr($current_uri, 0, $slashpos);
$subslash = strrpos($subdirs, "/");
$subdir = substr($subdirs, $subslash+1, $slashpos);

// check if we're on a different page number (multiple pages of members)
if($subdir == "page"){
	// check members pages
	$nesteddirs = substr($subdirs, 0, $subslash);
	$nestslash = strrpos($nesteddirs, "/");
	$nestedpage = substr($nesteddirs, $nestslash+1, $subslash);
	// check departments
	$finalnest = substr($nesteddirs, 0, $nestslash);
	$finslash = strrpos($finalnest, "/");
	$finpage = substr($finalnest, $finslash+1, $nestslash);
}
if($current_page == "members" || $nestedpage == "members"){
	if($subdir == "department"){
		$template = plugin_dir_path (__FILE__) . './inc/taxonomy-staffer-department.php';
	}else{
		$template = plugin_dir_path (__FILE__) . './inc/archive-staff.php';;
	}
}
if($subdir == "department"){
	$template = plugin_dir_path (__FILE__) . './inc/taxonomy-staffer-department.php';
}
if($subdir == "page" && $finpage == "department" ){
	$template = plugin_dir_path (__FILE__) . './inc/taxonomy-staffer-department.php';
}

return $template;  
}
// remove_filter('template_include', 'staffer_staff_templates', 99)
 add_filter( 'template_include', 'tubman_staffer_staff_templates', 99 ); 
 
/*
*  widget for pulling and displaying posts by category name
*  Displays featured image, title, links both to the post
*/ 
function wpb_postsbycategory($type) {

$posts_per_page = 3;
if(get_option('block_posts_per_page')){
	$posts_per_page = get_option('block_posts_per_page');
}

$the_query = new WP_Query( array( 'category_name' => $type, 'posts_per_page' => $posts_per_page ) ); 

if ( $the_query->have_posts() ) {
	$string .= '<ul class="postsbycategory widget_recent_entries">';
	while ( $the_query->have_posts() ) {

		$the_query->the_post();

		$thetitle = get_the_title(); /* or you can use get_the_title() */
		$getlength = strlen($thetitle);
		$thelength = 160;
		$finTitle = substr($thetitle, 0, $thelength);
		if ($getlength > $thelength){ $finTitle .= "..."; }

			if ( has_post_thumbnail() ) {
			$string .= '<li><div class="row blog_block"><div class="col-sm-3 blog_block_img">';
			$string .= '<a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_post_thumbnail($post_id, array( 100, 100) ) . ' </a></div>' ;
			$string .=  '<div class="col-sm-9 text-left"><a href="' . get_the_permalink() .'" rel="bookmark">' .'<p class="blog_block_text">'. $finTitle .'</p></a></div></div></li>';
			} else {  
			// if no featured image is found
			$string .= '<li><a href="' . get_the_permalink() .'" rel="bookmark">' . $finTitle .'</a></li><br>';
			}
		}
} else {
		echo "<p>no posts found</p>";
} 
$string .= '</ul>';
return $string;
wp_reset_postdata();
}

/*
*  enqueue bootstap.js, custom.js, jssor-slider, slick-slider, slider-slick.js
*/
function wpbootstrap_scripts_with_jquery()
{
	wp_register_script( 'custom-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.js', array( 'jquery' ) );
	wp_enqueue_script( 'custom-script' );
}
function wpcustom_script(){
	wp_register_script( 'extra-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ));
	wp_enqueue_script( 'extra-custom' );
}
function wpslider_script(){
	wp_register_script( 'slider-jssor', get_template_directory_uri() . '/js/jssor-slider/js/jssor.slider.mini.js');
	wp_enqueue_script( 'slider-jssor' );
	wp_register_script( 'slider-custom', get_template_directory_uri() . '/js/slider.js');
	wp_enqueue_script( 'slider-custom' );
}
function wpslick_script(){
	wp_register_script( 'slider-slick', get_template_directory_uri() . '/js/slick/slick.min.js');
	wp_enqueue_script( 'slider-slick' );
	wp_register_script( 'slick-custom', get_template_directory_uri() . '/js/slider-slick.js');
	wp_enqueue_script( 'slick-custom' );
} 
function style_selection(){
	$style = get_option('style_sheet');
	wp_enqueue_style( 'style-sheet', get_template_directory_uri() . '/css/style-'.$style.'.css' ); 
}
/* Style Selection */
add_action( 'wp_enqueue_scripts', 'style_selection');
/* Bootstrap script */
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );
/* Research Script */
add_action( 'wp_enqueue_scripts', 'wpcustom_script' );
/* Slider scripts */
add_action( 'wp_enqueue_scripts', 'wpslider_script' );
add_action( 'wp_enqueue_scripts', 'wpslick_script' );


/* Featured image enable */
add_theme_support( 'post-thumbnails' ); 
/* Enable header logo upload */
add_theme_support( 'custom-logo' );
/* Enable header logo upload */
add_theme_support( 'association-logo' );
// Add a shortcode
add_shortcode('categoryposts', 'wpb_postsbycategory');
// Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');

/* Research Nav setup*/
/* Theme setup */
add_action( 'after_setup_theme', 'wpt_setup' );
if ( ! function_exists( 'wpt_setup' ) ):
    function wpt_setup() {  
    register_nav_menu( 'primary', 'Primary navigation' );
    register_nav_menu( 'research', 'Research Menu' );
    register_nav_menu( 'footer_york', 'YorkU Footer Menu' );
} endif;

/* Register sidebars for front top, footer left + right, primary sidebar, research top,
*  community top and bottom, arts top and bottom 
*/ 
add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
    register_sidebar( array(
    	'name'          => 'Primary Sidebar',
        'id'            => 'primary-sidebar',
        'description'   => 'A short description of the sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s sidebar-module">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-center">',
        'after_title'   => '</h3><hr>',
        ) );
    register_sidebar( array(
		'name' => 'Footer Left',
		'id' => 'footbar-1',
		'description' => 'Appears in the footer area on the left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s foot-nav-lt">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title text-center">',
		'after_title' => '</h4>',
		) );
	register_sidebar( array(
		'name' => 'Footer Right',
		'id' => 'footbar-2',
		'description' => 'Appears in the footer area on the right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s foot-nav-rt">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title text-center">',
		'after_title' => '</h4>',
		) );
	register_sidebar( array(
		'name' => 'Front Page Top',
		'id' => 'front-top',
		'description' => 'Appears on Front page at the top',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title text-center">',
		'after_title' => '</h4>',
		) );	
	register_sidebar( array(
		'name' => 'Research Top',
		'id' => 'research-top',
		'description' => 'Appears on Research page at the top',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title text-center">',
		'after_title' => '</h4>',
		) );
	register_sidebar( array(
		'name' => 'Arts Top',
		'id' => 'arts-top',
		'description' => 'Appears on Arts page at the top',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title text-center">',
		'after_title' => '</h4>',
		) );
	register_sidebar( array(
		'name' => 'Arts Bottom',
		'id' => 'arts-btm',
		'description' => 'Appears on Arts page at the bottom',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title text-center">',
		'after_title' => '</h4>',
		) );
	register_sidebar( array(
		'name' => 'Community Top',
		'id' => 'community-top',
		'description' => 'Appears on Community page at the top',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title text-center">',
		'after_title' => '</h4>',
		) );
	register_sidebar( array(
		'name' => 'Community Bottom',
		'id' => 'community-btm',
		'description' => 'Appears on Community page at the bottom',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title text-center">',
		'after_title' => '</h4>',
		) );
}
?>