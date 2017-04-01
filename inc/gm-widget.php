<?php 
/*
Widget Name: Grid Menu Widget
Version: 0.1
Description: Enables you to add multiple rows of 2 images,titles,descriptions,links
Author: Grant Hutchinson
Text Domain: grid_menu_widget
*/

add_action( 'widgets_init', 'gm_init' );

function gm_init() {
	register_widget( 'gm_widget' );
}

class gm_widget extends WP_Widget
{

    public function __construct()
    {
        $widget_details = array(
            'classname' => 'gm_widget',
            'description' => 'Enables you to add slider img, captions, links'
        );

        parent::__construct( 'gm_widget', 'Grid Menu Widget', $widget_details );

        add_action('admin_enqueue_scripts', array($this, 'gm_assets'));
    }


    public function gm_assets()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('mfc-media-upload', get_template_directory_uri() . '/js/jw-media-upload.js', array('jquery'));
        wp_enqueue_style('thickbox');
    }


    public function widget( $args, $instance )
    {	?>
        <div class="row">
		<?php foreach($instance['images'] as $key => $value){

            if(intval($key) %3 == 0){
                $menus .= '</div><br>'
                        . '<div class="row">';
            }
			$menus .= '<div class="col-md-4 col-sm-12 block-menu">'
                    . '<div class="col-md-6 col-sm-6 col-xs-12 text-center"><p><a href="'.$instance['urls'][$key].'">'
                    . '<img src="'.$instance['images'][$key].'" width="150px" height="150px">'
                    . '</a></p></div>'
                    . '<div class="col-md-6 col-sm-6 grid-title">'
					. '<a href="'.$instance['urls'][$key].'">'
                    . '<h3 class="text-center">'.$instance['titles'][$key].'</h3>'
					. '</a></div>'
                    . '<p>'.$instance['descs'][$key].'</p>'
					. '</div>';
			} 
			echo $menus ?>
            </div>
	<?php
    }

    public function update( $new_instance, $old_instance ) {  

	    $instance = $old_instance;
        $instance['titles'] = array();
	    $instance['images'] = array();
	    $instance['urls'] = array();
	    $instance['descs'] = array();

	    if (isset($new_instance['images'])) {
	        foreach ($new_instance['images'] as $key => $value) {
                $tmpvalue = trim($value);
	            if (!empty($tmpvalue)) {
	                $instance['images'][$key] = $value;
                    $instance['titles'][$key] = $new_instance['titles'][$key];
	                $instance['urls'][$key] = $new_instance['urls'][$key];
	                $instance['descs'][$key] = $new_instance['descs'][$key];
	            }
	        }
	    }

	    return $instance;
	}

    public function form( $instance )
    {
        $titles = isset($instance['titles']) ? $instance['titles'] : array();
	    $images = isset($instance['images']) ? $instance['images'] : array();
	    $urls = isset($instance['urls']) ? $instance['urls'] : array();
	    $descs = isset($instance['descs']) ? $instance['descs'] : array();
	    $images[] = '';
	    $form = ''; 
	    
        echo '<h4>Menu Items</h4>';
        foreach ($images as $idx => $value) {
        $title = isset($titles[$idx]) ? $titles[$idx] : '';
        $image = isset($images[$idx]) ? $images[$idx] : '';
        $url = isset($urls[$idx]) ? $urls[$idx] : '';
        $desc = isset($descs[$idx]) ? $descs[$idx] : '';

        $form .= '<p>'
           . '<label>Item: '.$idx.'</label>'
            . sprintf(
                '<input type="text" name="%1$s[%2$s]" value="%3$s" class="widefat" placeholder="Title">',
                $this->get_field_name('titles'),
                $idx,
                esc_attr($title))
            . '</p>'
            . '<p>'
            . sprintf(
                '<input type="text" name="%1$s[%2$s]" value="%3$s" class="widefat" placeholder="Image ID">',
                $this->get_field_name('images'),
                $idx,
                esc_attr($image))
            . '<input class="upload_image_button" type="button" value="Upload Image" />'
            . '</p>'
            . '<p>'
            . sprintf(
                '<input type="text" name="%1$s[%2$s]" value="%3$s" class="widefat" placeholder="Url">',
                $this->get_field_name('urls'),
                $idx,
                esc_attr($url))
            . '</p>'
            . sprintf(
                '<textarea rows="16" cols="10" name="%1$s[%2$s]" value="%3$s" class="widefat" placeholder="Description">%3$s</textarea>',
                $this->get_field_name('descs'),
                $idx,
                esc_attr($desc))
            . '</p>';
    	}
		echo $form;
    }
}
