<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ACStarter
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function acstarter_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'acstarter_body_classes' );


// 'standard_ticket_selector.template.php'

/*add_filter ('FHEE__EE_Ticket_Selector__display_ticket_selector__template_path', 'my_custom_ticket_selector_template_location');

function my_custom_ticket_selector_template_location( $event ){
    require get_template_directory() . '/template-parts/standard_ticket_selector.template.php';
}*/


