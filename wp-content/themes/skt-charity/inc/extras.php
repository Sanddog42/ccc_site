<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package SKT Charity
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function skt_charity_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'skt_charity_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 */
function skt_charity_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'skt_charity_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function skt_charity_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'skt_charity_enhanced_image_navigation', 10, 2 );



function increment5c1Class($params) {

    $sidebar_id = $params[0]['id'];

    error_log("sidebar params are: " . print_r($params, true));

	static $colCounter = array(5 => array(0, 0), 3 => array(0,0), 1 => array (0,0));

	$columns = 1;
	$container = 1;

	switch($sidebar_id){
		case "five-column-widget-container-1":
		$columns = 5;
    	$container = 0;
		break;
		case "five-column-widget-container-2":
		$columns = 5;
    	$container = 1;
		break;
		case "three-column-widget-container-1":
		$columns = 3;
    	$container = 0;
		break;
		case "three-column-widget-container-2":
		$columns = 3;
    	$container = 1;
		break;
		case "one-column-widget-container-1":
		$columns = 1;
    	$container = 0;
		break;
		case "one-column-widget-container-2":
		$columns = 1;
    	$container = 1;
		break;
		case "carousel-widget-container-1":
		$container = 1;
		$colCounter[$columns][$container] += 1;
		return buildSingleCarousel($params, $colCounter, $columns, $container);
		break;

		case "carousel-widget-container-2":
		$container = 2;
		$colCounter[$columns][$container] += 1;
		return buildSingleCarousel($params, $colCounter, $columns, $container);
		break;


	}




//error_log("incrementing 5c1, params is: " . print_r($params, true));

        $total_widgets = wp_get_sidebars_widgets();
        $sidebar_widgets = count($total_widgets[$sidebar_id]);

        $params[0]['before_widget'] = str_replace('class="', 'class="col_' . $columns . ' ' , $params[0]['before_widget']);

        // if the mod of the counter is 0 then it's a new row
        if(($colCounter[$columns][$container] % $columns) == 0){

       		$params[0]['before_widget'] = str_replace('<div', '<div class="col_row"><div', $params[0]['before_widget']);
        }

        // if the mod counter is equal to the number of columns, then you have to close the row
        if(($colCounter[$columns][$container] % $columns) == ($columns-1)){
        	$params[0]['after_widget'] = str_replace('</div', '</div></div', $params[0]['after_widget']);
        }

        // or if it's the last widget
        else if($colCounter[$columns][$container] == ($sidebar_widgets-1)){
        	$params[0]['after_widget'] = str_replace('</div', '</div></div', $params[0]['after_widget']);
        }


        $colCounter[$columns][$container] += 1;


    return $params;
}
function buildSingleCarousel($params, $colCounter, $columns, $container){
	if($colCounter[$columns][$container] == 1)
		$params[0]['before_widget'] = str_replace('class="', 'class="active ' , $params[0]['before_widget']);
	return $params;    

}
add_filter('dynamic_sidebar_params','increment5c1Class');

