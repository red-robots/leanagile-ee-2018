<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); 


$event_footer_notification = get_field('event_notification_footer');


?>

<div class="page-content">
<?php get_template_part('inc/top-page-message'); ?>
<div class="entry-content">  
           <h1><?php the_title(); ?></h1>

           <?php if( class_exists('TicketSelectorRowStandard')){
                echo "Class TicketSelectorRowStandard exists!";
            } ?>
</div>



<div class="page-left">
			<?php while ( have_posts() ) : the_post(); ?>
            
          <div class="post-container">
          <div class="entry-content">  
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
global $post;
if ( espresso_display_ticket_selector( $post->ID ) && ( is_single() || ( is_archive() && espresso_display_ticket_selector_in_event_list() ))) :
?>
<div class="event-tickets" style="clear: both;">
	<?php espresso_ticket_selector( $post ); ?>
</div>
<!-- .event-tickets -->
<?php elseif ( ! is_single() ) : ?>
<?php espresso_view_details_btn( $post ); ?>
<?php endif; ?>

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



        
         
            
            
           </div><!-- post container --> 
			</div><!-- #content -->	

			<?php endwhile; // end of the loop. ?>

</div><!-- #page left -->

<?php get_sidebar('events');  ?>

<?php if( $event_footer_notification ): ?>
    <div class="top-page-message">
        <?php echo $event_footer_notification; ?>
    </div>
<?php endif; ?>

</div><!-- #content -->



<?php get_footer(); ?>