<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>


<div class="page-right">






	<?php if ( 'courses' == get_post_type() ) { ?>
    
    	
     
            
<?php 

// Set some variables to set how to show the dates.
$startdate = DateTime::createFromFormat('Ymd', get_field('start_date'));
$enddate = DateTime::createFromFormat('Ymd', get_field('end_date'));
$enddd = get_field('end_date');
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
            
      
    
       	<?php if(get_field('register')!="") { ?>
        <div class="register">
           <?php the_field('register'); ?>
        </div>
       <?php } ?>
    <?php } else { //end if is "courses" post type ?>


	<?php if ( is_active_sidebar( 'main_sidebar' ) ) : ?>
		
       <div id="secondary" class="widget-area" role="complementary">

        <div class="widget">
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
        </div>

			<?php dynamic_sidebar( 'main_sidebar' ); ?>
		</div><!-- #secondary -->
        
	<?php endif; // if sidebar 1 is active ?>
    
    <?php } ?>

</div><!-- page right -->