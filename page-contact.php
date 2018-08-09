<?php
/**
 * Template Name: Contact Email Signup
 */

get_header(); ?>

    <?php while ( have_posts() ) : the_post(); ?>
        <div class="page-content">
            <?php get_template_part('search-page-form'); ?>

            <div class="contact-left">
                <div class="entry-content">

                    <h1>
                    <?php if(get_field('alternate_title')!="") {
                    the_field('alternate_title'); 
                    } else {
                    the_title(); }?>
                    </h1>

                    <div class="anchor-but">
                        <a href="#leanagile">Subscribe to LeanAgileTraining ⬇</a>
                    </div>
                    <div class="anchor-but">
                        <a href="#agilecaro">Subscribe to Agile Carolinas ⬇</a>
                    </div>

                 <?php the_content(); ?>
                 
                </div><!-- entry-content -->
            </div>
            <!-- contact left -->


            <div class="contact-right">

            </div>

            <section class="newsletter-sec">
                <div class="contact-left">
                <a id="leanagile"></a>
                    <div class="entry-content">
                        <?php the_field('leanagile'); ?>
                    </div>
                </div>
                <div class="contact-right">
                    <?php get_template_part('inc/mailchimp-la'); ?>
                </div>
            </section>
<?php //get_template_part('inc/icontact'); ?>
            


            <section class="newsletter-sec">
                <div class="contact-left">
                    <div class="entry-content">
                    
                        <?php the_field('agile_carolinas'); ?>
                    </div><!-- entry-content -->
                </div>
                <!-- contact left -->

            <div class="contact-right">
                <div id="">

                <?php //get_template_part('inc/icontact'); ?>
                <a id="agilecaro"></a>
                <?php get_template_part('inc/mailchimp-ac'); ?>
                    
                   
                   
               </div>
            </div>
            <!-- contact right -->
            </section>

            
            
        </div><!-- page-content -->
    <?php // comments_template( '', true ); ?>
    <?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>