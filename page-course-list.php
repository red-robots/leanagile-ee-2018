<?php
/**
 * Template Name: Course Lists
 */

get_header(); ?>


<div class="course-page-content">

  <?php get_template_part('search-page-form'); ?>

<div class="entry-content">

 <h1>
	<?php if(get_field('alternate_title')!="") {
       the_field('alternate_title'); 
      } else {
      the_title(); }?>
  </h1>

<?php  // pull the Custom Field Content Above on the Course page
		the_field('content_above_course_list'); ?>
        
        <div class="clear"></div>

<?php // Set up arguments to sort by Start Date from the custom fields.
$thedate = date("Ymd"); 
$args = array(
	'post_type' => 'courses',
	'posts_per_page' => -1,
	'meta_key' => 'start_date',
    'meta_value' => $thedate,
    'meta_compare' => '>=',
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

<div class="course-date course-header desktop">Date</div>
<div class="course-title course-header desktop">Course</div>
<div class="course-instructor course-header desktop">Instructor</div>
<div class="course-location course-header desktop">Location</div>
<div class="course-register course-header desktop">Register</div>

<?php  while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				

<?php 
		// Set some variables to set how to show the dates.
$startdate = DateTime::createFromFormat('Ymd', get_field('start_date'));
$enddate = DateTime::createFromFormat('Ymd', get_field('end_date'));
$enddd = get_field('end_date');
$startMonthLetter = $startdate->format('M');
// set month if you have an enddate.
if($enddate != '') {
  $endMonthLetter = $enddate->format('M');
}

 ?>

<div class="course-row">
	<a href="<?php the_permalink(); ?>">	
		<div class="course-date">
			<?php 
      // if months match, do like this
      if( $startMonthLetter == $endMonthLetter ) {
        echo $startdate->format('M d'); 
        if($enddd != '') {
          echo " - " . $enddate->format('d'); 
        } 
        // else do like this
      } else {
        echo $startdate->format('M d');
        if($enddd != '') {
          echo " - " . $enddate->format('M d');
        }
        
      }

      ?>
       </div><!-- course date -->
        
        <div class="course-title">
			<div class="course-title course-header mobile">Course</div><?php the_title(); ?>
       </div><!-- course title -->
		 
   		<div class="course-instructor">
			 <div class="course-instructor course-header mobile">Instructor</div><?php the_field('instructor'); ?>
       </div><!-- course instructor -->
       
       <div class="course-location">
	   		  <div class="course-location course-header mobile">Location</div><?php the_field('location'); ?>
       </div><!-- course location -->
       
       <div class="course-register">
      		<?php //the_field('register'); ?>
            Register
       </div><!-- course register -->
    </a>   
</div><!-- course row -->
       
<?php endwhile;  ?>
<?php endif;  ?>

<div class="clear"></div>


<?php // Set up arguments to sort by Start Date from the custom fields.
$args = array(
	'post_type' => 'page',
	'page_id'   => '4',
);
$the_query = new WP_Query( $args ); ?>
<?php if ( $the_query->have_posts() ) : ?>
<?php  while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<br><br>
<?php  // pull the Custom Field Content Above on the Course page
		the_field('content_below_course_list'); ?>
        
<?php endwhile; ?>
<?php endif; ?>

</div><!-- entry-content -->
</div><!-- page-content -->


<?php get_footer(); ?>