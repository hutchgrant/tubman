<?php 
/*
Widget Name: JSSOR Widget
Version: 0.1
Description: Enables you to add jssor slider img, captions, links
Author: Grant Hutchinson
Text Domain: jssor_widget
*/

add_action( 'widgets_init', 'jw_init' );

function jw_init() {
	register_widget( 'jw_widget' );
}

class jw_widget extends WP_Widget
{

    public function __construct()
    {
        $widget_details = array(
            'classname' => 'jw_widget',
            'description' => 'Enables you to add slider img, captions, links'
        );

        parent::__construct( 'jw_widget', 'JSSOR Widget', $widget_details );

        add_action('admin_enqueue_scripts', array($this, 'jw_assets'));
    }


	public function jw_assets()
	{
	    wp_enqueue_script('media-upload');
	    wp_enqueue_script('thickbox');
	    wp_enqueue_script('mfc-media-upload', get_template_directory_uri() . '/js/jw-media-upload.js', array('jquery'));
	    wp_enqueue_style('thickbox');
	}


    public function widget( $args, $instance )
    {	?>
		<div id="slider1_container" >
		<div style="position: absolute; top: 0px; left: 0px;" data-u="loading">
		 <div style="position:absolute;display:block;background:url('<?php get_template_directory_uri() . "/img/loading.gif" ?>') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
		</div>

		<div style="cursor: default; position: relative; top: -10px; left: 0px; width: 1100px; height: 400px; overflow: hidden;" data-u="slides">
			<?php foreach($instance['images'] as $key => $value){
				$slides .= '<div style="display: none;" data-p="225.00">'
						. '<a href="'.$instance['urls'][$key].'" data-u="image">'
						. '<img src="'.$instance['images'][$key].'" />';
						if($instance['captions'][$key] != ""){
							$slides .= '<div class="jssor_caption" data-u="caption" data-t="0">'.$instance['captions'][$key].'</div>' ;
						}
				$slides .=  '</a>'
						. '</div>';

			} 
			echo $slides
			?>
		</div>
		<!-- Arrow Navigator -->
		    <span data-u="arrowleft" class="jssora22l"></span>
		    <span data-u="arrowright" class="jssora22r"></span>
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
