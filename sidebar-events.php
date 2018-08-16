<div class="page-right">
<?php if ( is_active_sidebar( 'event_sidebar' ) ) : ?>
		
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

			<?php dynamic_sidebar( 'event_sidebar' ); ?>
		</div><!-- #secondary -->
        
	<?php endif; // if sidebar 1 is active ?>


</div><!-- page right -->