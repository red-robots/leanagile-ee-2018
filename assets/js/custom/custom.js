/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	
	


	/*
	*
	*	Choose Credit card by default on registration checkout page.
	*
	------------------------------------*/
	$('#ee-available-payment-method-inputs-paypal_pro').attr('checked',true);


	//$('#paypal-pro-billing-form-country>option:contains(Canada)').insertAfter('#paypal-pro-billing-form-country>option[value=1]');
	$('#paypal-pro-billing-form-country>option[value=CA]').insertBefore('#paypal-pro-billing-form-country>option[value=AR]');
	$('#paypal-pro-billing-form-country>option[value=US]').insertBefore('#paypal-pro-billing-form-country>option[value=CA]');
	/*
	*
	*	Current Page Active
	*
	------------------------------------*/
	// $("[href]").each(function() {
 //    if (this.href == window.location.href) {
 //        $(this).addClass("active");
 //        }
	// });

	/*
	*
	*	Responsive iFrames
	*
	------------------------------------*/
	// var $all_oembed_videos = $("iframe[src*='youtube']");
	
	// $all_oembed_videos.each(function() {
	
	// 	$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
 	
 // 	});
	
	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	// $('.flexslider').flexslider({
	// 	animation: "slide",
	// }); 
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	// $('a.gallery').colorbox({
	// 	rel:'gal',
	// 	width: '80%', 
	// 	height: '80%'
	// });
	
	/*
	*
	*	Isotope with Images Loaded
	*
	------------------------------------*/
	// var $container = $('#container').imagesLoaded( function() {
 //  	$container.isotope({
 //    // options
	//  itemSelector: '.item',
	// 	  masonry: {
	// 		gutter: 15
	// 		}
 // 		 });
	// });

	/*
	*
	*	Smooth Scroll to Anchor
	*
	------------------------------------*/
	//  $('a').click(function(){
	//     $('html, body').animate({
	//         scrollTop: $('[name="' + $.attr(this, 'href').substr(1) + '"]').offset().top
	//     }, 500);
	//     return false;
	// });


	
	
	
	/*
	*
	*	Equal Heights Divs
	*
	------------------------------------*/
	// $('.js-blocks').matchHeight();

	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	// new WOW().init();

});// END #####################################    END