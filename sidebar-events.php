<div class="page-right">
<?php if ( is_active_sidebar( 'event_sidebar' ) ) : ?>
		
       <div id="secondary" class="widget-area" role="complementary">

        <!-- <div class="widget">
          <form role="search" id="searchform" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
              <label>
                  <span class="screen-reader-text"><?php echo _x( 'Search Blog:', 'label' ) ?></span>
                  <input type="search" class="search-field"
                      placeholder="<?php echo esc_attr_x( 'Search the Blog', 'placeholder' ) ?>"
                      value="<?php echo get_search_query() ?>" name="s"
                      title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
              </label>
              <input type="hidden" name="post_type" value="post" />
              <input type="submit" class="search-submit"
                  value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
          </form>
        </div> -->

			<?php //dynamic_sidebar( 'event_sidebar' ); ?>
		</div><!-- #secondary -->
        
	<?php endif; // if sidebar 1 is active ?>


<?php //echo '<h1>' . __FILE__ . '</h1>'; ?>
<?php global $post; 

  // echo '<pre>';
  // print_r($post);
  // echo '</pre>';

?>
<div class="venue-content">

  
  <h3 class="event-venues-h3 ee-event-h3">
    <?php _e( 'Details', 'event_espresso' ); ?>
  </h3>

  <?php if ( $venue_phone = espresso_venue_phone( $post->ID, FALSE )) : ?>
  <p>
    <span class="small-text"><strong><?php _e( 'Venue Phone:', 'event_espresso' ); ?> </strong></span><?php echo $venue_phone; ?>
  </p>
  <?php endif; ?>
  <?php if ( $venue_website = espresso_venue_website( $post->ID, FALSE )) : ?>
  <p>
    <span class="small-text"><strong><?php _e( 'Venue Website:', 'event_espresso' ); ?> </strong></span><?php echo $venue_website; ?>
  </p>
  <?php endif; ?>

</div>
<!-- .venue-content -->


<?php  global $post; 
if ( espresso_venue_has_address( $post->ID )) :
?>
  <div class="additional-courses">
    <strong>Course Location: </strong>
    <br>
    <?php _e( 'Address:', 'event_espresso' ); ?></strong></span><?php espresso_venue_address( 'inline', $post->ID ); ?>
    <br>
    <?php
    //$location = espresso_venue_address( 'inline', $post->ID );
    $location = espresso_venue_id();
    ?>
      <div class="mapit">
        <a href="<?php bloginfo('url'); ?>/map/?map=<?php echo $location; ?>" target="_blank">Map it &raquo;</a>
      </div>

      <?php espresso_venue_gmap($post->ID); ?>
    <?php //} ?>
  </div>
<?php endif; ?>






</div><!-- page right -->