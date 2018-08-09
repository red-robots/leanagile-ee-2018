<?php
/**
 * The main template file.
 */

get_header(); ?>


<div class="home-page-content">
    <?php 

    //    Pull the loop on the homepage a little early so it pulls our email address.

    $args = array(
        'post_type' => 'page', // Query
        'page_id' => '132' // Query "Homepage Content"
    );
    $the_query = new WP_Query( $args ); ?>
        <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); 

            $emailAd = get_field('email_address');
            $antispam = antispambot($emailAd);

        ?>
        <div class="page-left-home">
            <?php if(get_field('boxes')) : ?> 
                <?php while(has_sub_field('boxes')) : ?>   
                    <div class="home-box">
                        <a href="<?php the_sub_field('link_to_page'); ?>">
                            <div class="home-box-pic">
                                <?php if(get_sub_field('image')!="") { ?>
                                    <img src="<?php the_sub_field('image'); ?>" />
                                <?php } ?>
                            </div><!-- home box pic -->
                        <div class="home-box-bottom">
                            <div class="bot-title">
                                <?php if(get_sub_field('page_title')!="") {the_sub_field('page_title');} else {the_title();} ?>
                            </div><!-- bot-title -->
                            <div class="bot-excerpt">
                                <?php if(get_sub_field('excerpt')!="") {the_sub_field('excerpt');} ?>
                            </div><!-- bot-title -->
                        </div><!-- home box bottom -->
                        </a>
                    </div><!-- home box -->
                <?php endwhile; ?>
            <?php endif; // end the repeater ?>

        <div class="clear"></div>

            <div class="entry-content">
                <h2 class="homepagetitle"><?php the_field('home_content_title');?></h2>
                <div class="tagline">
                    <?php if(get_field('tag_line')!="") { ?>
                    <?php the_field('tag_line'); } ?>
                </div><!-- tagline -->
                <?php the_field('home_content');?>
                <div class="home-readmore">
                    <a href="<?php the_field('read_more_link');?>">Read More</a>
                </div><!-- home readmore -->
            </div><!-- entry-content -->

        </div><!-- page-left -->
        <?php endwhile; ?>
    <?php endif; // end have_posts() check ?>
    <?php wp_reset_postdata();  // reset   ?>  

    
<div class="page-right-home">
<?php
//$thedate = date("Y/m/d h:i A"); 
$thedate = date("Ymd"); 
$args = array(
	'post_type' => 'courses',
	'posts_per_page' => -1,
	'meta_key' => 'start_date',
    'meta_value' => $thedate,
    'meta_compare' => '>',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'tax_query' => array(
        array(
          'taxonomy' => 'visibility',
          'field'    => 'slug',
          'terms'    => 'hidden',
          'operator' => 'NOT IN'
        ),
      )
);
$the_query = new WP_Query( $args ); ?>
<?php if ( $the_query->have_posts() ) : ?>
    <div class="sidebar-home-upcoming">Upcoming Courses</div>
    
    <div class="sidebar-courselist-cont">
    <?php  while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <?php 
    		// Set some variables to set how to show the dates.
    $startdate = DateTime::createFromFormat('Ymd', get_field('start_date'));
    $enddate = DateTime::createFromFormat('Ymd', get_field('end_date'));
     ?>

        <div class="sidebar-courselist">
            <a href="<?php the_permalink(); ?>">
                <div class="sidebar-courselist-date">
                    <?php echo $startdate->format('M d'); ?>
                    <?php if(get_field('end_date')!="") { 
                        echo " " . "-" . " " . $enddate->format('M d'); 
                    } ?>
                </div>
                <div class="sidebar-courselist-location">
                    <?php the_field('location'); ?>
                </div>
                <div class="sidebar-courselist-title">
                    <?php the_title(); ?>
                </div>
            </a>
        </div><!-- sidebar courselist -->


    <?php endwhile; ?>
    </div><!-- sidebar courselist cont -->
<?php endif;  // end query courses ?>

    

            <div class="clear"></div>

            <div class="sidebar-home-connect">Connect With Us</div>

            <a class="twitter-timeline" href="https://twitter.com/jhlittle" data-widget-id="438340873932128256">Tweets by @jhlittle</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

            <div class="clear"></div>

            <div class="seemoretweets">
                <a href="https://twitter.com/jhlittle" target="_blank">See more Tweets</a>
            </div>

            <div class="clear"></div>
            <div class="sidebar-home-send">Send Us an Email</div>
            <div class="sidebar-home-send-email">
                <a href="mailto:<?php echo $antispam; ?>">
                <?php echo $antispam; ?>
                </a>
            </div>
        </div><!-- page right -->




                 
        
    


</div><!-- page-content -->
            

<?php get_footer(); ?>