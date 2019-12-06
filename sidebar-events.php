<div class="page-right">
<?php if ( is_active_sidebar( 'event-sidebar' ) ) : ?>
		
       <div id="secondary" class="widget-area" role="complementary">        

			<?php //dynamic_sidebar( 'event-sidebar' ); ?>
		</div><!-- #secondary -->
        
	<?php endif; // if sidebar 1 is active ?>


<?php //echo '<h1>' . __FILE__ . '</h1>'; ?>
<?php global $post; 

  // echo '<pre>';
  // print_r($post);
  // echo '</pre>';

?>
<div class="venue-content">

  <?php 
    $sidebar_title    = get_field('sidebar_title');
    $sidebar_content  = get_field('sidebar_content');
    $sidebar_footer   = get_field('sidebar_footer');
   ?>
  <?php if( $sidebar_title || $sidebar_content || $sidebar_footer): ?>
  <div class="custom_right_side" style="background-color:#ededed;padding:5px 5px 10px 10px;border-left:10px solid #047fc5;margin:10px 0">
    <h4><?php echo ($sidebar_title) ? $sidebar_title : '';  ?></h4>
    <div>
      <div>
        <?php echo ($sidebar_content) ? $sidebar_content : '';  ?>
      </div>
      <div>
        <small><?php echo ($sidebar_footer) ? $sidebar_footer : ''; ?></small>
      </div>
      
      
    </div>
  </div>
  <?php endif; ?>
  
 <!--  <h3 class="event-venues-h3 ee-event-h3">
    <?php _e( 'Details', 'event_espresso' ); ?>
  </h3> -->

  <?php if ( $venue_phone = espresso_venue_phone( $post->ID, FALSE )) : ?>
  <p>
    <span class="small-text"><strong><?php _e( 'Venue Phone:', 'event_espresso' ); ?> </strong></span><?php echo $venue_phone; ?>
  </p>
  <?php endif; ?>
  <?php if ( $venue_website = espresso_venue_website( $post->ID, FALSE )) : ?>
 <!--  <p>
    <span class="small-text"><strong><?php _e( 'Venue Website:', 'event_espresso' ); ?> </strong></span><?php echo $venue_website; ?>
  </p> -->
  <?php endif; ?>

</div>
<!-- .venue-content -->


<?php  global $post; 
if ( espresso_venue_has_address( $post->ID )) :
?>
  <!-- <div class="additional-courses">
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

      <?php //espresso_venue_gmap($post->ID); ?>
    <?php //} ?>
  </div> -->
<?php endif; ?>






</div><!-- page right -->