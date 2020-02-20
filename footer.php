<?php
/**
 * The template for displaying the footer.
 *
 */
?>
	</div><!-- #main .wrapper -->
	<div id="footer">
		<div class="site-info">
            <p>&copy; <?php echo date("Y"); ?> LeanAgileTraining (part of Kitty Hawk Consulting, Inc.) | <a href='mailt&#111;&#58;inf&#111;&#64;l&#101;anag&#105;le%7&#52;raini&#110;&#103;&#46;%&#54;3o&#37;&#54;D'>inf&#111;&#64;&#108;eana&#103;&#105;&#108;etra&#105;n&#105;ng&#46;com</a> | <!-- 704.376.8881 -->(800) 209-1280<br>
              <br>
            <a href="<?php bloginfo ('url');?>/sitemap/">sitemap</a>  | site by <a href="https://bellaworksweb.com/" target="_blank">Bellaworks</a></p>
           
		</div><!-- .site-info -->
	</div><!-- #footer -->


<?php wp_footer(); ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29037282-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

jQuery( document ).ajaxComplete( function() {
         $('#paypal-pro-billing-form-country>option[value=CA]').insertBefore('#paypal-pro-billing-form-country>option[value=AR]');
          $('#paypal-pro-billing-form-country>option[value=US]').insertBefore('#paypal-pro-billing-form-country>option[value=CA]');
});

<?php 
 
//global $event_checkbox_text_notification;
$event_checkbox_text = event_change_checkbox_info();  ?>

jQuery(document).ready(function($){
  
    var id = "datetime-selector-" + <?php echo get_the_ID(); ?> + "-date-time-filter-notice-pg";
    var checkbox_value = "<?php echo esc_html__(strip_tags($event_checkbox_text)); ?>";
    $('#' + id).html(checkbox_value);



  var checks = $('.checkbox-dropdown-selector ul li');
    $.each(checks, function(){
        var labelBox = $(this).find('.datetime-selector-option');
        labelBox.prop('checked', false);        
    });

    $('.checkbox-dropdown-selector').css('display', 'block');

    <?php if ( is_page('4') ) { ?>
      $('#courses').DataTable({
        "order": []
      });
      $('#courses').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
      } );
    <?php } ?>
    
    
});


</script>
<!-- liquid web -->
</body>
</html>