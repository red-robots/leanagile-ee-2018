<?php
/**
 * Template Name: Blog
 */

get_header(); ?>


<div class="page-content">



<div class="page-left">
<?php  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args= array(
	//'cat' => 1,
	'paged' => $paged,
	'posts_per_page'=> 10,
);
query_posts($args); ?>
<?php if (have_posts()) : ?>

    <header class="page-header">
     <h1 class="page-title">
    <?php if(get_field('alternate_title')!="") {
         the_field('alternate_title'); 
        } else {
        the_title(); }?>
    </h1>
  </header><!-- page header -->
  
<?php while (have_posts()) : the_post(); ?>  	
				
				
               

                
       <div class="post-container">         
            <div class="entry-content">
            
           <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="post-date"><?php the_time('F j, Y'); ?></div> 
            <?php
				global $more;
				$more = 0;
			  ?>
				<?php the_excerpt(); ?>
                
                <div class="readmore-blog"><a href="<?php the_permalink(); ?>">Read More &raquo;</a></div>
                
                
            </div><!-- entry-content -->
            </div><!-- post container -->
            
            
            
            <?php endwhile; // end of the loop. ?>
            <div class="clear"></div>
            <?php bellaworks_pagi_nav(); ?>
            
            
            
            
            <?php endif; // end of the loop. ?>
            
  </div><!-- page right -->          
            <?php get_sidebar(); ?>
            
            </div><!-- page-content -->
                
                
                
				
			



<?php get_footer(); ?>