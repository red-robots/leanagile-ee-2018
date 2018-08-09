<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	 <div class="page-content">
			<article id="post-0" class="post error404 no-results not-found">
				<div class="entry-content">
                	<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Page Not Found', 'twentytwelve' ); ?></h1>
				</header>

				<?php
					$wp_query = new WP_Query();
					$wp_query->query(array(
					'post_type'=>'page',
					'page_id' => 6825
				));
					if ($wp_query->have_posts()) : ?>
				    <?php while ($wp_query->have_posts()) :  $wp_query->the_post(); 


				    	the_content();

				    	endwhile;
				    	endif;

				    ?>
			
					<?php //_e( 'We&rsquo;re sorry. The page you are looking for cannot be found. Please try navigating our sitemap below:', 'twentytwelve' ); ?>
					   
                     <?php wp_nav_menu( array( 'theme_location' => 'sitemap') ); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
     </div><!-- .page-content -->

<?php get_footer(); ?>