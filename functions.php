<?php
/**
 * ACStarter functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ACStarter
 */

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/theme-setup.php';

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/scripts.php';

/**
 * Custom Post Types.
 */
//require get_template_directory() . '/inc/post-types.php';

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
//require get_template_directory() . '/inc/extras.php';

/**
 * Post Pagination
 */
//require get_template_directory() . '/inc/pagination.php';

/**
 * Social
 */
//require get_template_directory() . '/inc/social-media-links.php';

/**
 * Theme Specific additions.
 */
//require get_template_directory() . '/inc/theme.php';

/**
 * Block & Disable All New User Registrations & Comments Completely.
 * Description:  This simple plugin blocks all users from being able to register no matter what, 
 *				 this also blocks comments from being able to be inserted into the database.
 */
// require get_template_directory() . '/inc/block-all-registration-and-comments.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';


// Enqueueing all the java script in a no conflict mode
 function ineedmyjava() {
	if (!is_admin()) {
 
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', false, '1.8.3', true);
		wp_enqueue_script('jquery');
		
		// other scripts...
		wp_register_script(
			'vendors',
			get_bloginfo('template_directory') . '/assets/js/vendors.js',
			array('jquery'),'20120206', 
			true  );
		wp_enqueue_script('vendors');


		// other scripts...
		wp_register_script(
			'custom',
			get_bloginfo('template_directory') . '/assets/js/custom.js',
			array('jquery'), '20120206', 
			true );
		wp_enqueue_script('custom');
		
	}
}
add_action('wp_enqueue_scripts', 'ineedmyjava');



/*

	Custom client login, link and title.

*/
function custom_login_logo() {
        echo '<style type="text/css">h1 a { background: url('.get_bloginfo('template_directory').'/images/login-logo.png) 50% 50% no-repeat !important; }</style>';
}
add_action('login_head', 'custom_login_logo'); 

function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

// search only posts
// function SearchFilter($query) {
// if ($query->is_search) {
// $query->set('post_type', array('post', 'page'));
// }
// return $query;
// }

// add_filter('pre_get_posts','SearchFilter');
function searchfilter($query) {
    if ($query->is_search && !is_admin() ) {
        if(isset($_GET['post_type'])) {
            $type = $_GET['post_type'];
                if($type == 'page') {
                    $query->set('post_type',array('page'));
                } elseif($type == 'post') {
                    $query->set('post_type',array('post'));
                }
        }       
    }
return $query;
}
add_filter('pre_get_posts','searchfilter');


// add a favicon from your themes images folder
function mytheme_favicon() { ?> <link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory') ?>/images/favicon.png" > <?php } add_action('wp_head', 'mytheme_favicon');



/* Custom Post Types */

add_action('init', 'js_custom_init');
function js_custom_init() 
{

  // Register the Optima University
  
     $labels = array(
	'name' => _x('Courses', 'post type general name'),
    'singular_name' => _x('Courses', 'post type singular name'),
    'add_new' => _x('Add New', 'Courses'),
    'add_new_item' => __('Add New Courses'),
    'edit_item' => __('Edit Courses'),
    'new_item' => __('New Courses'),
    'view_item' => __('View Courses'),
    'search_items' => __('Search Courses'),
    'not_found' =>  __('No Courses found'),
    'not_found_in_trash' => __('No Courses found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Courses'
  );
  $args = array(
	'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false,
    'menu_position' => 20,
    'supports' => array('title','editor','custom-fields','thumbnail'),
	
  ); 
  register_post_type('courses',$args);

} // close custom post type

/*
##############################################
	Custom Taxonomies
*/
add_action( 'init', 'build_taxonomies', 0 );
 
function build_taxonomies() {
// cusotm tax
    register_taxonomy( 'visibility', 'courses',
	 array( 
	'hierarchical' => true, // true = acts like categories false = acts like tags
	'label' => 'Course List', 
	'query_var' => true, 
	'rewrite' => true ,
	'show_admin_column' => true,
	'public' => true,
	'rewrite' => array( 'slug' => 'visibility' ),
	'_builtin' => true
	) );
	
} // End build taxonomies

/*-------------------------------------------------------------------------------
	Sortable Columns
-------------------------------------------------------------------------------*/

add_filter( 'manage_edit-courses_columns', 'my_edit_movie_columns' ) ;

function my_edit_movie_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Courses Name' ),
		'startdate' => __( 'Course Start Date' ),
		'courselist' => __( 'Course List' ),
		'courselocation' => __( 'Course Location' ),
		//'date' => __( 'Date' )
	);

	return $columns;
}



add_action( 'manage_courses_posts_custom_column', 'my_manage_movie_columns', 10, 2 );

function my_manage_movie_columns( $column ) {
	global $post;

	
	if($column == 'startdate')
	{
		// Set some variables to set how to show the dates.
		$startdate = DateTime::createFromFormat('Ymd', get_field('start_date'));

		if($startdate !='') {
			echo $startdate->format('n - d') . " &raquo; " . $startdate->format('M d');
		}
		
		
		//echo 'ho';
	}
	elseif($column == 'courselocation')
	{
		$location = get_field('location');
		echo $location;
	}
	elseif($column == 'courselist')
	{
		$term = get_term( '72', 'visibility' );
		//$term = get_term( '366' 'visibility' );
		$visibility = $term->name;
		if( has_term( 'hidden', 'visibility' ) ) {
			echo $visibility;
		}
		
	}
}


/*-------------------------------------------------------------------------------
	Sortable Columns
-------------------------------------------------------------------------------*/

function my_column_register_sortable( $columns )
{
	$columns['startdate'] = 'startdate';
	return $columns;
}

add_filter("manage_edit-courses_sortable_columns", "my_column_register_sortable" );


/* Only run our customization on the 'edit.php' page in the admin. */
add_action( 'load-edit.php', 'my_edit_movie_load' );

function my_edit_movie_load() {
	add_filter( 'request', 'my_sort_movies' );
}

/* Sorts the movies. */
function my_sort_movies( $vars ) {

	/* Check if we're viewing the 'movie' post type. */
	if ( isset( $vars['post_type'] ) && 'courses' == $vars['post_type'] ) {

		/* Check if 'orderby' is set to 'duration'. */
		if ( isset( $vars['orderby'] ) && 'startdate' == $vars['orderby'] ) {

			/* Merge the query vars with our custom variables. */
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => 'start_date',
					'orderby' => 'meta_value_num'
				)
			);
		}
	}

	return $vars;
}



// add additional image sizes
	add_image_size( 'recipe', 200, 9999 ); //300 pixels wide (and unlimited height)
	
	// Navigation Menus.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );
	register_nav_menu( 'mobile', __( 'Mobile Menu', 'twentytwelve' ) );


	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
	
/**
 * Enqueue styles
 */
function agile_style() {
	wp_enqueue_style( 'agile-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'agile_style' );
	
	


/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name' => 'Main sidebar',
		'id' => 'main_sidebar',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );


/**
 * Add support for a custom header image.
 */
//require( get_template_directory() . '/inc/custom-header.php' );





/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );



if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 *
 * @return void
 */
function twentytwelve_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'twentytwelve' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

// Pagination

function bellaworks_pagi_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="pagination"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";

}
// end pagination


function custom_post_nav($post_type = 'courses', $meta_key = 'start_date', $meta_value = '$startdate') {

$pages = array();
$startdate = DateTime::createFromFormat('Ymd', get_field('start_date'));
$args = array(
'post_type' => $post_type,
'meta_key' => $meta_key,
'orderby' => 'date',
'order' => 'DESC',
'posts_per_page' => -1,
'meta_value' => $startdate
);
$nav_posts = get_posts($args);

foreach($nav_posts as $nav_post) {
$pages[] += $nav_post->ID;
}

$id = get_the_id();

$current = array_search($id, $pages);
$prevID = $pages[$current-1];
$nextID = $pages[$current+1];

$total = count($pages);
foreach ($pages as $mykey => $myval) {
if ($myval== $id) {
$key = ($mykey + 1);
}
}

$output .= '<ul class="post-nav">';

if (!empty($prevID)) {
$output .= '<li class="previous"><a href="'.get_permalink($prevID).'" title="'.get_the_title($prevID).'">Previous</a></li>';
} else {
$output .= '<li class="previous"><a href="'.get_permalink(end($pages)).'" title="'.get_the_title(end($pages)).'">Previous</a></li>';
}

$output .= '<li class="count">'.$key.' / '.$total.'</li>';

if (!empty($nextID)) {
$output .= '<li class="next"><a href="'.get_permalink($nextID).'" title="'.get_the_title($nextID).'">Next</a></li>';
} else {
$output .= '<li class="next"><a href="'.get_permalink(array_shift($pages)).'" title="'.get_the_title(array_shift($pages)).'">Next</a></li>';
}}

/*-------------------------------------------------------------------------------
	Custom Columns For Posts
-------------------------------------------------------------------------------*/
 
function acc_columns($columns)
{
	$columns = array(
		'cb' 	=> '<input type="checkbox" />',
        'title' 	=> 'Title',
		'proofread' 	=> 'Proofread',
		'edited'	=> 'Edited',
		'author' => 'Author',
		'categories' => 'Categories',
		'date' => 'Published',
		'tags' => 'Tags'
		//'seo_title'=> 'seo'
	);
	return $columns;
}
 
function acc_custom_columns($column)
{
	global $post;
	if($column == 'proofread')
	{
	   $date = DateTime::createFromFormat('Ymd', get_field('proofread'));
	   if( empty( $date ) ) :
	     echo 'No Date';
	   else:
	     echo $date->format('Y-m-d');
	   endif;
 
	} elseif ($column == 'edited'){
	  
	  $date = DateTime::createFromFormat('Ymd', get_field('edited'));
	   if( empty( $date ) ) :
	     echo 'No Date';
	   else:
	     echo $date->format('Y-m-d');
	   endif;
	}
}
 
add_action("manage_post_posts_custom_column", "acc_custom_columns");
add_filter("manage_edit-post_columns", "acc_columns");

function acc_column_register_sortable( $columns )
{
	
	$columns['proofread'] = 'proofread';
	$columns['edited'] = 'edited';
	return $columns;
}
 
add_filter("manage_edit-post_sortable_columns", "acc_column_register_sortable" );

add_action( 'pre_get_posts', 'manage_wp_posts_be_qe_pre_get_posts', 1 );
function manage_wp_posts_be_qe_pre_get_posts( $query ) {

   /**
    * We only want our code to run in the main WP query
    * AND if an orderby query variable is designated.
    */
   if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {

      switch( $orderby ) {

         // If we're ordering by 'proofread'
         case 'proofread':

            // set our query's meta_key, which is used for custom fields
            $query->set( 'meta_key', 'proofread' );
				
             // order by our custom field/ proofread
            $query->set( 'orderby', 'meta_value' );
				
            break;
			
			// If we're ordering by 'Edited'
         case 'edited':

            // set our query's meta_key, which is used for custom fields
            $query->set( 'meta_key', 'edited' );
				
            // order by our custom field/ editied
            $query->set( 'orderby', 'meta_value' );
				
            break;

      }

   }

}

// Filter based on Course Date

add_filter('query_vars', 'wpse57344_register_query_vars' );
function wpse57344_register_query_vars( $qvars ){
    //Add these query variables
    $qvars[] = 'custom_month';
    return $qvars;
}

add_action( 'restrict_manage_posts', 'wpse57344_restrict_posts_by_metavalue' );
function wpse57344_restrict_posts_by_metavalue() {
    global $typenow;
    $months = wpse57344_get_months();
    if ($typenow == 'courses') {
        $selected = get_query_var('custom_month');
        $output = "<select style='width:150px' name='custom_month' class='postform'>\n";
        $output .= '<option '.selected($selected,0,false).' value="">'.__('Filter by Start Date','wpse57344_plugin').'</option>';
        if ( ! empty( $months ) ) {
            foreach ($months as $month):
                $value =esc_attr($month->year.''.$month->month);
                $month_dt = new DateTime($month->year.'-'.$month->month.'-01');
                $output .= "<option value='{$value}' ".selected($selected,$value,false).'>'.$month_dt->format('F Y').'</option>';
            endforeach; 
        }
        $output .= "</select>\n";       
    echo $output;
    }
}

add_action( 'pre_get_posts', 'wpse57351_pre_get_posts' );
function wpse57351_pre_get_posts( $query ) {

    //Only alter query if custom variable is set.
    $month_str = $query->get('custom_month');
    if( !empty($month_str) ){

            //For debugging, uncomment following line
            //  echo '<pre>';
            // var_dump($query);
            // echo '</pre>';

        //Be careful not override any existing meta queries.
        $meta_query = $query->get('meta_query');
        if( empty($meta_query) )
            $meta_query = array();

        //Convert 2012/05 into a datetime object get the first and last days of that month in yyyy/mm/dd format
        $month = new DateTime($month_str.'01');

        //Get posts with date between the first and last of given month
        $meta_query[] = array(
            'key' => 'start_date',
            'value' => array($month->format('Ymd'),$month->format('Ymt')),
            'compare' => 'BETWEEN',
        );
        $query->set('meta_query',$meta_query);

            //For debugging, uncomment following line
            // echo '<pre>';
            // var_dump($query);
            // echo '</pre>';
    }
}

function wpse57344_get_months(){
    global $wpdb;
        $months = wp_cache_get( 'wpse57344_months' );
        if ( false === $months ) {
            $query = "SELECT YEAR(meta_value) AS `year`, DATE_FORMAT(meta_value,'%m') AS `month`, count(post_id) as posts 
                FROM $wpdb->postmeta WHERE meta_key ='start_date'           
                GROUP BY YEAR(meta_value), MONTH(meta_value) ORDER BY meta_value DESC";
            $months = $wpdb->get_results($query);
            wp_cache_set( 'wpse57344_months', $months );
        }
        return $months;
}

	



/*
Admin Filter BY Custom Fields


*/

add_action( 'restrict_manage_posts', 'wpse45436_admin_posts_filter_restrict_manage_posts' );
/**
 * First create the dropdown
 * make sure to change POST_TYPE to the name of your custom post type
 * 
 * @author Ohad Raz
 * 
 * @return void
 */
function wpse45436_admin_posts_filter_restrict_manage_posts(){
    $type = 'courses';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    //only add filter to post type you want
    if ('courses' == $type){
        //change this to the list of values you want to show
        //in 'label' => 'value' format
        $values = array(
            'Scrum' => 'scrum', 
            'Other' => 'other',
            'label2' => 'value2',
        );
        ?>
        <select name="ADMIN_FILTER_FIELD_VALUE">
        <option value=""><?php _e('Filter By Course Type ', 'wose45436'); ?></option>
        <?php
            $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';
            foreach ($values as $label => $value) {
                printf
                    (
                        '<option value="%s"%s>%s</option>',
                        $value,
                        $value == $current_v? ' selected="selected"':'',
                        $label
                    );
                }
        ?>
        </select>
        <?php
    }
}


add_filter( 'parse_query', 'wpse45436_posts_filter' );
/**
 * if submitted filter by post meta
 * 
 * make sure to change META_KEY to the actual meta key
 * and POST_TYPE to the name of your custom post type
 * @author Ohad Raz
 * @param  (wp_query object) $query
 * 
 * @return Void
 */
function wpse45436_posts_filter( $query ){
    global $pagenow;
    $type = 'courses';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    if ( 'courses' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != '') {
        $query->query_vars['meta_key'] = 'course_type';
        $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
    }
}
 /*-------------------------------------
  Move Yoast to the Bottom
---------------------------------------*/
function yoasttobottom() {
  return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');
