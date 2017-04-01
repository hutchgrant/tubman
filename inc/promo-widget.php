<?php 
/*
Widget Name: Promotion Widget
Version: 0.1
Description: Enables you to add multiple rows of 3 images,titles,descriptions,links
Author: Grant Hutchinson
Text Domain: promo_widget
*/

add_action( 'widgets_init', 'promo_init' );

function promo_init() {
	register_widget( 'promo_widget' );
}

class promo_widget extends WP_Widget
{

    public function __construct()
    {
        $widget_details = array(
            'classname' => 'promo_widget',
            'description' => 'Promote your top 3 categories in a block with images, button links, descriptions'
        );

        parent::__construct( 'promo_widget', 'Promo Widget', $widget_details );

        add_action('admin_enqueue_scripts', array($this, 'promo_assets'));
    }


    public function promo_assets()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('mfc-media-upload', get_template_directory_uri() . '/js/jw-media-upload.js', array('jquery'));
        wp_enqueue_style('thickbox');
    }


    public function widget( $args, $instance )
    {	?>
        <div class="marketing">
        <div class="row">
		<?php foreach($instance['images'] as $key => $value){

            if(intval($key) %3 == 0){
                $menus .= '</div><br>'
                        . '<div class="row">';
            }
            $menus .= '<div class="col-sm-4 text-center">'
                    . '<img class="img-square" src="'.$instance['images'][$key].'" height="150" />'
                    . '<h2>'.$instance['titles'][$key].'</h2>'
                    . '<p>'.$instance['descs'][$key].'</p>'
                    . '<a class="btn btn-default" href="'.$instance['urls'][$key].'">View</a>'
                    . '</div>';
			} 
			echo $menus ?>
        </div>
    </div>
	<?php
    }

    public function update( $new_instance, $old_instance ) {  

	    $instance = $old_instance;
	    $instance['images'] = array();
        $instance['titles'] = array();
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
	    $images = isset($instance['images']) ? $instance['images'] : array();
        $titles = isset($instance['titles']) ? $instance['titles'] : array();
	    $urls = isset($instance['urls']) ? $instance['urls'] : array();
	    $descs = isset($instance['descs']) ? $instance['descs'] : array();
	    $images[] = '';
	    $form = ''; 
	    
        foreach ($images as $idx => $value) {
        $title = isset($titles[$idx]) ? $titles[$idx] : '';
        $image = isset($images[$idx]) ? $images[$idx] : '';
        $url = isset($urls[$idx]) ? $urls[$idx] : '';
        $desc = isset($descs[$idx]) ? $descs[$idx] : '';

        $form .= '<p>'
            . sprintf(
                '<input type="text" name="%1$s[%2$s]" value="%3$s" class="widefat" placeholder="Title">',
                $this->get_field_name('titles'),
                $idx,
                esc_attr($title))
            . '</p>'
            . '<p>'
            . '<label>Promo Items:</label>'
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
                '<input type="text" name="%1$s[%2$s]" value="%3$s" class="widefat" placeholder="Description">',
                $this->get_field_name('descs'),
                $idx,
                esc_attr($desc))
            . '</p>';
    	}
		echo $form;
    }
}
