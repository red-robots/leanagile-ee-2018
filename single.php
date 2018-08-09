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
			<?php the_content(); ?>
            
         <p><?php previous_post('&laquo; &laquo; %', '', 'yes'); ?>  ||  <?php next_post('% &raquo; &raquo; ', '', 'yes'); ?></p>
            
           <div class="single-meta">
           
           <div class="category-list">Posted in: <?php the_category(', '); ?></div>
           	<div class="clear"></div>
           <div class="tag-list">Tagged: <?php the_tags(); ?></div>
           
           
           </div><!-- signlemeta --> 
            
            <div class="comments">
            	<?php comments_template(  ); ?>
            </div>
            
            
            
           </div><!-- post container --> 
			</div><!-- #content -->	

			<?php endwhile; // end of the loop. ?>

</div><!-- #page left -->

<?php get_sidebar(); ?>


</div><!-- #content -->



<?php get_footer(); ?>