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

<?php get_sidebar(); ?>

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