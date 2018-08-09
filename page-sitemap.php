<?php
/**
 * Template Name: Sitemap
 */

get_header(); ?>



			<?php while ( have_posts() ) : the_post(); ?>
				
                
              <div class="page-content">
            	
				
				
               
              
 
                
                
            <div class="entry-content">
            
            <h1>
					<?php if(get_field('alternate_title')!="") {
                        the_field('alternate_title'); 
                            } else {
                        the_title(); }?>
              </h1>
            
            
				<?php the_content(); ?>
               <?php wp_nav_menu( array( 'theme_location' => 'sitemap') ); ?>
            </div><!-- entry-content -->
            
            </div><!-- page-content -->
                
                
                
				<?php // comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>



<?php get_footer(); ?>