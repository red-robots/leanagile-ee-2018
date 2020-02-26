<?php
/**
 * Template Name: Course Lists
 */

get_header(); ?>


<div class="course-page-content">

  <?php //get_template_part('search-page-form'); ?>

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
	   'post_type'       => 'courses',
	   'posts_per_page'  => -1,
	   'meta_key'        => 'start_date',
      'meta_value'      => $thedate,
      'meta_compare'    => '>=',
      'orderby'         => 'meta_value',
      'order'           => 'ASC',
      'tax_query'       => array(
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

  <table id="courses" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Course</th>
                <th>Instructor</th>
                <th>Location</th>               
                <th>Register</th>
            </tr>
        </thead>
        <tbody>


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

 


			<?php 

      $date = '';
      // if months match, do like this
      if( $startMonthLetter == $endMonthLetter ) {
        $date = $startdate->format('M d'); 
        if($enddd != '') {
          $date .= " - " . $enddate->format('d'); 
        } 
        // else do like this
      } else {
        $date = $startdate->format('M d');
        if($enddd != '') {
          $date .= " - " . $enddate->format('M d');
        }
        
      }

      ?>
       

<tr href="<?php echo get_the_permalink(); ?>">
    <td><?php echo $date; ?></td>
    <td><?php the_title(); ?></td>
    <td><?php the_field('instructor'); ?></td>
    <td><?php the_field('location'); ?></td>
    <td>Register</td>
 </tr>
       
<?php endwhile;  ?>

  </tbody>
</table>

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