<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<div class="page-content">

<?php get_sidebar(); ?>

<div class="page-left">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>
            
            
            
            <div class="post-container">         
            <div class="entry-content">
            
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            
            <?php
				global $more;
				$more = 0;
			  ?>
				<?php the_excerpt(); ?>
                
                <div class="readmore-blog"><a href="<?php the_permalink(); ?>">Read More &raquo;</a></div>
                
                
            </div><!-- entry-content -->
            </div><!-- post container -->
            
            

	
			<?php endwhile;

			
			?>
			<div class="clear"></div>
            <?php bellaworks_pagi_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #page left -->
	</div><!-- #content -->


<?php get_footer(); ?>