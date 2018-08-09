<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); 

//$postType = $_GET['post_type'];

?>

<div class="page-content">
<?php 

if(isset($_GET['post_type'])) {
	
	$type = $_GET['post_type'];
	
	if($type == 'post') { 
	
		get_sidebar(); 

	} else { ?>
		<div class="searchpage">
			<form role="search" id="searchform" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
			    <label>
			        <span class="screen-reader-text"><?php echo _x( 'Search Pages:', 'label' ) ?></span>
			        <input type="search" class="search-field"
			            placeholder="<?php echo esc_attr_x( 'Search Pages', 'placeholder' ) ?>"
			            value="<?php echo get_search_query() ?>" name="s"
			            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
			    </label>
			    <input type="hidden" name="post_type" value="page" />
			    <input type="submit" class="search-submit"
			        value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
			</form>
		</div>
	<?php }
}


?>
	<div class="page-left">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>

			<?php //twentytwelve_content_nav( 'nav-above' ); ?>

			<?php /* Start the Loop */ ?>
							
            <?php while (have_posts()) : the_post(); 



if(isset($_GET['post_type'])) {
	
	$type = $_GET['post_type'];
	if($type == 'page') { ?>
	<!--Your Code for this post_type-->  

<div class="post-container">         
	<div class="entry-content">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php
		global $more;
		$more = 0;
		?>
		<?php the_excerpt(); ?>
		<div class="readmore-blog"><a href="<?php the_permalink(); ?>">Read More &raquo;</a></div>
	</div><!-- entry-content -->
</div><!-- post container -->

	<?php    
	} elseif($type == 'post') { ?>
	<!--Your Code for this post_type-->

<div class="post-container">         
	<div class="entry-content">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php
		global $more;
		$more = 0;
		?>
		<?php the_excerpt(); ?>
		<div class="readmore-blog"><a href="<?php the_permalink(); ?>">Read More &raquo;</a></div>
	</div><!-- entry-content -->
</div><!-- post container -->
	<?php }
} // end post type check

            ?>
         
                

            
            
			<?php endwhile; ?>
            <div class="clear"></div>
               <?php bellaworks_pagi_nav(); ?>
			<?php //twentytwelve_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

		</div><!-- .page-left -->
	</div><!-- .page-content -->


<?php get_footer(); ?>