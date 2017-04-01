<?php 
/*
Widget Name: Slick Widget
Version: 0.1
Description: Enables you to add slick slider img, captions, links
Author: Grant Hutchinson
Text Domain: slick_widget
*/

add_action( 'widgets_init', 'sw_init' );

function sw_init() {
	register_widget( 'sw_widget' );
}

class sw_widget extends WP_Widget
{

    public function __construct()
    {
        $widget_details = array(
            'classname' => 'sw_widget',
            'description' => 'Enables you to add slick slider img, captions, links'
        );

        parent::__construct( 'sw_widget', 'Slick Slider Widget', $widget_details );

        add_action('admin_enqueue_scripts', array($this, 'sw_assets'));
    }


	public function sw_assets()
	{
	    wp_enqueue_script('media-upload');
	    wp_enqueue_script('thickbox');
	    wp_enqueue_script('sw-media-upload', get_template_directory_uri() . '/js/jw-media-upload.js', array('jquery'));
	    wp_enqueue_style('thickbox');
	}


    public function widget( $args, $instance )
    {	?>

		<div class="slick-slider">
			<?php foreach($instance['images'] as $key => $value){
				$slides .= '<div>'
						. '<a href="'.$instance['urls'][$key].'">'
						. '<img src="'.$instance['images'][$key].'" />'
						. '<p class="text-center">'.$instance['captions'][$key].'</p>'
						. '</a>'
						. '</div>';

			} 
			echo $slides
			?>
		</div>
	<?php
    }

	public function update( $new_instance, $old_instance ) {  
	    $instance = $old_instance;
	    $instance['images'] = array();
	    $instance['urls'] = array();
	    $instance['captions'] = array();
	    if (isset($new_instance['images'])) {
	        foreach ($new_instance['images'] as $key => $value) {
                $tmpvalue = trim($value);
	            if (!empty($tmpvalue)) {
	                $instance['images'][$key] = $value;
	                $instance['urls'][$key] = $new_instance['urls'][$key];
	                $instance['captions'][$key] = $new_instance['captions'][$key];
	            }
	        }
	    }

	    return $instance;
	}

    public function form( $instance )
    {

	    $images = isset($instance['images']) ? $instance['images'] : array();
	    $urls = isset($instance['urls']) ? $instance['urls'] : array();
	    $captions = isset($instance['captions']) ? $instance['captions'] : array();
	    $images[] = '';
	    $form = '';

        echo '<h4>Slides</h4>';
        foreach ($images as $idx => $value) {
        $image = isset($images[$idx]) ? $images[$idx] : '';
        $url = isset($urls[$idx]) ? $urls[$idx] : '';
        $caption = isset($captions[$idx]) ? $captions[$idx] : '';

        $form .= '<p>'
            . '<label>Slide: '.$idx.'</label>'
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
                '<input type="text" name="%1$s[%2$s]" value="%3$s" class="widefat" placeholder="Captions">',
                $this->get_field_name('captions'),
                $idx,
                esc_attr($caption))
            . '</p>';
    	}
		echo $form;
    }
}
