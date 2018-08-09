<?php
/**
 * Template Name: Resources
 */

get_header(); ?>



			<?php while ( have_posts() ) : the_post(); ?>
				
                
              <div class="page-content">
            	
				
				
               <?php get_template_part('search-page-form'); ?>
              
 
                
                
            <div class="entry-content">
            
            <h1>
					<?php if(get_field('alternate_title')!="") {
                        the_field('alternate_title'); 
                            } else {
                        the_title(); }?>
              </h1>
           <div class="resources-column1">
         <div class="resource"><?php the_field('top_5_books'); ?></div>
        <div class="resource"><?php the_field('top_5_articles'); ?></div>
           <?php the_field('top_5_blogs'); ?></div>
            <div class="resources-column2">
          <div class="resource"> <?php the_field('top_5_forums'); ?></div>
          <div class="resource"> <?php the_field('top_5_videos'); ?></div>
           <?php the_field('top_5_websites'); ?></div>

            </div><!-- entry-content -->
            
            </div><!-- page-content -->
                
                
                
				<?php // comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>



<?php get_footer(); ?>