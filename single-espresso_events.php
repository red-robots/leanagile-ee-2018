<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<div class="page-content">



<div class="page-left">
			<?php while ( have_posts() ) : the_post(); ?>
            
          <div class="post-container">
          <div class="entry-content">  
           <h1><?php the_title(); ?></h1>
            <div class="post-date">
            <?php 

            if( is_singular() == 'events' ) {
              // echo 'yes';
              $date_format = 'M d, Y';
              $time_format = 'h a';
              $EVT_ID = FALSE;
             echo EEH_Event_View::the_event_date( $date_format, $time_format, $EVT_ID );
      // return '';
            } else {
              the_time('F j, Y');
            }
             ?>
            </div> 
			<?php //the_content(); ?>
            <?php
//echo '<br/><h6 style="color:#2EA2CC;">'. __FILE__ . ' &nbsp; <span style="font-weight:normal;color:#E76700"> Line #: ' . __LINE__ . '</span></h6>';
global $post;
?>
<div class="event-content">
<?php if ( apply_filters( 'FHEE__content_espresso_events_details_template__display_entry_meta', TRUE )): ?>
	<div class="entry-meta">
		<span class="tags-links"><?php espresso_event_categories( $post->ID, TRUE, TRUE ); ?></span>
	<?php
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
	?>
	<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'event_espresso' ), __( '1 Comment', 'event_espresso' ), __( '% Comments', 'event_espresso' ) ); ?></span>
	<?php
		endif;
		edit_post_link( __( 'Edit', 'event_espresso' ), '<span class="edit-link">', '</span>' );
	?>
	</div>
<?php endif;
	$event_phone = espresso_event_phone( $post->ID, FALSE );
	if ( $event_phone != '' ) : ?>
	<p class="event-phone">
		<span class="small-text"><strong><?php esc_html_e( 'Event Phone:', 'event_espresso' ); ?> </strong></span> <?php echo $event_phone; ?>
	</p>
<?php endif;  ?>
<?php
	if ( apply_filters( 'FHEE__content_espresso_events_details_template__display_the_content', true ) ) {
		do_action( 'AHEE_event_details_before_the_content', $post );
		echo apply_filters(
			'FHEE__content_espresso_events_details_template__the_content',
			espresso_event_content_or_excerpt( 55, null, false ) 
		);
		do_action( 'AHEE_event_details_after_the_content', $post );
	}
 ?>
</div>
<!-- .event-content -->
       
            
           <div class="single-meta">
           
           <div class="category-list">Posted in: <?php the_category(', '); ?></div>
           	<div class="clear"></div>
           <div class="tag-list">Tagged: <?php the_tags(); ?></div>
           
           
           </div><!-- signlemeta --> 
         
            
            
           </div><!-- post container --> 
			</div><!-- #content -->	

			<?php endwhile; // end of the loop. ?>

</div><!-- #page left -->

<?php get_sidebar('events');  ?>


</div><!-- #content -->



<?php get_footer(); ?>