<?php
/**
 * Template Name: Map
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); 

if (isset($_GET['map'])) {
	$postID = $_GET['map'];
} else {
    // Fallback behaviour goes here
}


while ( have_posts() ) : the_post(); ?>
<div class="page-content">
	<div class="entry-content">

		<h1>
			<?php 
			if(get_field('alternate_title')!="") {
				the_field('alternate_title'); 
			} else {
				the_title();
			} ?>
		</h1>
		<?php echo 'venue ID:'. $postID; ?>
		<?php the_content(); ?>
		<div class="venue-gmap"><?php espresso_venue_gmap($postID); ?></div>
		
		<!-- <iframe
		  width="600"
		  height="450"
		  frameborder="0" style="border:0"
		  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD2TonSn0rjKa9eLkmJZveZnqx6Ni2tBPg
		    &q=Space+Needle,Seattle+WA" allowfullscreen>

		    old key AIzaSyAQ3wWBhuvwzIZT22PSNqLFuaPx52Z_UVg
		</iframe> -->

<?php endwhile; // end of the loop. ?>
<?php 
$args = array(
		'p'=>$postID,
		'post_type'=> 'espresso_events'
	);
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
the_title();
// echo '<pre>';
// print_r($post);
// echo '</pre>';
		?>
 
	
 
<?php endwhile; endif;

?>

		


	</div><!-- entry-content -->
</div><!-- page-content -->

<?php get_footer(); ?>