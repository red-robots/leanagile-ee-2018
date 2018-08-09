<div class="searchpage">
	<form role="search" id="searchform" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
	    <label>
	        <span class="screen-reader-text"><?php echo _x( 'Search Pages:', 'label' ) ?></span>
	        <input type="search" class="search-field"
	            placeholder="<?php echo esc_attr_x( 'Search Pages', 'placeholder' ) ?>"
	            value="<?php echo get_search_query() ?>" name="s"
	            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
	    </label>
	    <input type="hidden" name="post_type" value="page" />
	    <input type="submit" class="search-submit"
	        value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
	</form>
</div>