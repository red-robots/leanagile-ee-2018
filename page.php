<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>



			<?php while ( have_posts() ) : the_post(); ?>
				
                
              <div class="page-content">
            	<?php if(is_page('registration checkout')){ get_template_part('inc/top-page-message');} ?>
				
				<?php //get_template_part('search-page-form'); ?>
               
              
 
                
                
            <div class="entry-content">
            
            <h1>
					<?php if(get_field('alternate_title')!="") {
                        the_field('alternate_title'); 
                            } else {
                        the_title(); }?>
              </h1>
            
            
				<?php the_content(); ?>
            </div><!-- entry-content -->
            
            </div><!-- page-content -->
                
                
                
				<?php // comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>



<?php get_footer(); ?>