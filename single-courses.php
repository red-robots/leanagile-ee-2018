<?php
/**
 * The Template for displaying all single "Courses" posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<div class="page-content">
<?php get_template_part('inc/top-page-message'); ?>
<div class="page-right">
<?php 

// Set some variables to set how to show the dates.
$startdate = DateTime::createFromFormat('Ymd', get_field('start_date'));
$enddate = DateTime::createFromFormat('Ymd', get_field('end_date'));
$enddd = get_field('end_date');
$textAboveButn = get_field('text_above_button');
$startMonthLetter = $startdate->format('M');
// set month if you have an enddate.
if($enddate != '') {
  $endMonthLetter = $enddate->format('M');
}
?>
            
            	<div class="additional-courses">
                	
                 <div class="add-title"><?php the_title(); ?></div>
                 <div class="add-start-date"><strong>Dates:</strong> 
                  <?php // if months match, do like this
                      if( $startMonthLetter == $endMonthLetter ) {
                        echo $startdate->format('M d'); 
                        if($enddd != '') {
                          echo " - " . $enddate->format('d'); 
                        } 
                        // else do like this
                      } else {
                        echo $startdate->format('M d');
                        if($enddd != '') {
                          echo " - " . $enddate->format('M d');
                        }
                        
                      } ?>


              </div>
                 <div class="add-location"><strong>Location:</strong> <?php the_field('location'); ?></div>
                
              </div><!-- additional courses -->
              
              
              <div class="additional-courses">
                <strong>Course Location: </strong>
                <br>
				 		         <?php the_field('course_location_address'); ?>
                 
                 <br>
                 
                 <?php
						// Build the google map
						$location = get_field('google_maps_link');

            if($location != '') {
					?>
                 <div class="mapit"><a href="<?php echo $location; ?>" target="_blank">Map it &raquo;</a></div>

                 <?php } 

                 $hLink = get_field('location_link');
                 if($hLink != '') {
                 ?>
                   <div class="hotel-link">
                    <a href="<?php  ?>" target="_blank"></a>
                  </div>
                <?php } ?>
                
              </div><!-- hotel link -->
            <?php if($textAboveButn) { ?>
      <div class="text-above-btn"><?php echo $textAboveButn; ?></div>
      <?php } ?>

      <?php 
      // old paypal link

      if(get_field('register')!="") { ?>
        <div class="register">
           <?php the_field('register'); ?>
        </div>
       <?php } ?>
    
       	<?php 
        // new event espresso linker

        if(get_field('event_picker')!="") { ?>
        <div class="register">
           <a class="button" href="<?php the_field('event_picker'); ?>">REGISTER NOW</a>
        </div>
        <?php } ?>

        
    
</div>

<div class="page-left">
			<?php while ( have_posts() ) : the_post(); ?>
            
          <div class="entry-content">  
           <h1>
					<?php if(get_field('alternate_title')!="") {
                        the_field('alternate_title'); 
                            } else {
                        the_title(); }?>
            </h1>  
			<?php the_content(); ?>
            
            <?php /*next_post_link_plus( array(
				'order_by' => 'numeric', 
				'meta_key' => 'start_date', 
				'link' => 'Next Course:  %title', 
				'format' => '%link'
				) );*/ ?>
            
			</div><!-- #content -->	

			<?php endwhile; // end of the loop. ?>
            
            
</div><!-- page-left -->
</div><!-- #content -->



<?php get_footer(); ?>