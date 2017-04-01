<?php

/*
Walker Name: Research Navigation Walker
Version: 0.1
Description: Create dynamic menus with sub items in a grid
Author: Grant Hutchinson
Text Domain: nav_research_walker
*/

class Nav_Research_Walker extends Walker_Nav_Menu {
    private $circles = 0;
    private $rows = 0;
    private $subitems = 0;

   public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $this->subitems++;
        if(floor($this->circles % 2) != 0){
            $output .= '<div class="col-lg-2 col-md-6 col-sm-12 col-xs-12" id="rspaceR' . $this->rows.'">';
        }else{
            $output .= '<div class="col-lg-2 col-md-6 col-sm-12 col-xs-12" id="rspaceM' . $this->rows.'">';
        }
        $output .= '<canvas class="RBLines" id="RBLines'. $this->circles. '"></canvas>';

            $this->circles++;
        $output .= '<ul class="RBList">';
   }
   public function end_lvl( &$output, $depth = 0, $args = array() ) {
      if(floor($this->circles % 2) == 0){
            $output .= "</ul></div></div><br>";
            $this->rows++;

      }else{
            $output .= "</ul></div>";
      }
   }
   public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
       $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

       $classes = empty( $item->classes ) ? array() : (array) $item->classes;
       $classes[] = 'menu-item-' . $item->ID;

       $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
       $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

       $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
       $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

     //  $output .= $indent . '<li' . $id . $class_names .'>';

       $atts = array();
       $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
       $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
       $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
       $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

       $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

       $attributes = '';
       foreach ( $atts as $attr => $value ) {
          if ( ! empty( $value ) ) {
             $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
             $attributes .= ' ' . $attr . '="' . $value . '"';
          }
       }

       $item_output = $args->before;
       if($depth == 0){
            if(floor($this->circles % 2) != 0){
                $item_output .= '<div class="col-md-12 seperator" ><br></div>';
                $item_output .= '<div class="col-md-3 mobSpacer" ></div>';
                $item_output .= '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center RB" id="RB' . $this->circles . '">';
                $item_output .= '<a href="#'. $item->title .'" name="'. $item->title .'">';
                $item_output .= '<div class="circle">';
                $item_output .= '<h2>' . $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after. '</h2>';
                $item_output .= '</div></a>'; // end circle
                $item_output .= '</div>'; // End col
            }else{
                $item_output .= '<div class="row">';
                $item_output .=  '<div class="col-lg-2 col-md-3 col-xs-3" id="rspaceL' . $this->rows. '"></div> ';
                $item_output .= '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center RB" id="RB' . $this->circles  . '">';
                $item_output .= '<a href="#'. $item->title .'" name="'. $item->title .'">';
                $item_output .= '<div class="circle">';
                $item_output .= '<h2>' . $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after. '</h2>';
                $item_output .= '</div></a></div>'; // end circle, col
            }
        }else{
            $item_output .= '<a'. $attributes .'>';
            $item_output .=  '<li' . $id . $class_names .'>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        }
       $item_output .= $args->after;
       $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
    public function end_el( &$output, $category, $depth = 0, $args = array() ) {
        if($depth == 0){
            // $output .= "</a>\n";
        }else{
            $output .= "</li></a>\n";
        }
    }
   public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
      
      // add 'not-click' class to the list item
      $element->classes[] = 'not-click';

      // if element is current or is an ancestor of the current element, add 'active' class to the list item
      $element->classes[] = ( $element->current || $element->current_item_ancestor ) ? 'active' : '';

      // if it is a root element and the menu is not flat, add 'has-dropdown' class 
      // from https://core.trac.wordpress.org/browser/trunk/src/wp-includes/class-wp-walker.php#L140
      $element->has_children = ! empty( $children_elements[ $element->ID ] );
      $element->classes[] = ( $element->has_children && 1 !== $max_depth ) ? 'has-dropdown' : '';

      // call parent method
      parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
   }
}