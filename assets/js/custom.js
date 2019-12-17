/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	
     //if($('body').hasClass('postid-8836')){       
        //page_right = $('.page-right .venue-content');        
        //page_right.html('<div class="custom_right_side" style="background-color:#ededed;padding:5px 5px 10px 10px;border-left:10px solid #047fc5;margin:10px 0"><h4>Please choose 3 days or 2 days.</h4><div><p>The 3 days includes the Agile Release Planning workshop. People who have attended it feel this day is essential.</p><p>The learning regarding planning and many specific skill sets is very useful in doing agile-scrum well.</p><p>Scrum Alliance does not require you to take a third day, so you can choose 2 days if your main concern is certification.</p><small>It is also possible to take the 3rd day at another time.<br>(The price is $50 less if you buy it today.)</small></div></div>');
     //}  



     //$('.date-time-filter-notice-pg').html(event_checkbox_text); 	


	/*
	*
	*	Choose Credit card by default on registration checkout page.
	*
	------------------------------------*/
	$('#ee-available-payment-method-inputs-paypal_pro').attr('checked',true);


	//$('#paypal-pro-billing-form-country>option:contains(Canada)').insertAfter('#paypal-pro-billing-form-country>option[value=1]');
	// $('#paypal-pro-billing-form-country>option[value=CA]').insertBefore('#paypal-pro-billing-form-country>option[value=AR]');
	// $('#paypal-pro-billing-form-country>option[value=US]').insertBefore('#paypal-pro-billing-form-country>option[value=CA]');
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

	/*
	*
	*	EE Day Filter
	*
	-------------------------e-----------*/
	// 

	/*
	*
	*	EE Day Filter
	*
	-------------------------e-----------*/
	// collection of ALL datetime selectors for ALL Events on the page
    var $datetime_options = $('.datetime-selector-option'),
        $ticket_selector_submit_btn = $('.ticket-selector-submit-btn');
	
    // reset by unchecking everything
	$.each( $datetime_options, function() {
		$(this).prop( 'checked', true );  
        $(this).next('.datetime-selector-option-text-spn').html(convert_to_days($(this).val()));     
	} );

    $('.checkbox-dropdown-selector-selected-spn').html('Choose One');
    // add error notices to the DOM
    
    /*
    $ticket_selector_submit_btn.before(
        '<span class="ticket-selector-disabled-submit-btn-msg important-notice">'+ eei18n.please_select_date_filter_notice+'</span>'        
    );
    */
    // update ticket selector if datetime is chosen
    
    
    
    

    $('.checkbox-dropdown-selector').on('click','.datetime-selector-option', function () {

            var $datetime_selector_option = $(this);
            var event_id = $datetime_selector_option.data('tkt_slctr_evt');
            var $submit_button = $('#ticket-selector-submit-' + event_id + '-btn');
            // track how many ticket selector rows are active ? ie: being displayed
            var active_rows = 0;
            var datetimes = [];
            var $ticket_selector = $('#tkt-slctr-tbl-' + event_id);

            

            if (object_exists($ticket_selector, '$ticket_selector')) {
                // first let's put together an array of ALL checked datetime options for this event
                $datetime_options = $datetime_selector_option.parents('ul').find('.datetime-selector-option');
                if (object_exists($datetime_options, '$datetime_options')) {
                    // add each datetime options to our array of datetimes.
                    $.each($datetime_options, function (index) {                	
                    	
                        // if checked, then display row and increment active_rows count
                        if ($(this).prop('checked')) {
                            datetimes.push('ee-ticket-datetimes-' + $(this).val()); 
                        }
                    });
                }
                // find all ticket rows for this event
                var $ticket_selector_rows = $ticket_selector.find('.tckt-slctr-tbl-tr');
                var x = 0;
                $.each($ticket_selector_rows, function () {
                    var $ticket_selector_row = $(this);
                    // get all of the specific datetime related classes assigned to this ticket row
                    var ticket_row_datetime_classes = $ticket_selector_row.attr('class').split(' ').filter(
                        function(element) {
                            return element.indexOf('ee-ticket-datetimes-') !== -1;
                        }
                    );
                    // because a ticket can have multiple datetimes,
                    // we need to compare ALL of the ticket's datetimes to see if it will be displayed
                    var display = false;
                    $.each(ticket_row_datetime_classes, function (index, element) {
                        if ($.inArray(element, datetimes) !== -1) {
                            display = true;
                        }
                    });

                    var $qty_input = $ticket_selector_row.find(
                            '.ticket-selector-tbl-qty-slct'
                        );

                    if ( ($qty_input.attr( 'type' ) !== 'radio') && (x == 0) ) {
                            $qty_input.val( 1 );
                        } else {
                            $qty_input.val( 0 );
                        }

                    x++;    


                    if (display) {
                        $ticket_selector_row.removeClass('ee-hidden-ticket-tr');
                        active_rows++;

                    } else {
						$ticket_selector_row.addClass( 'ee-hidden-ticket-tr' );
						//var $qty_input = $ticket_selector_row.find(
						//	'.ticket-selector-tbl-qty-slct'
						//);
						// set qty to zero for non-radio inputs
						//if ( $qty_input.attr( 'type' ) !== 'radio' ) {
						//	$qty_input.val( 1 );
						//}
                    }
                });
            }
            // enable or disable submit button based on active_rows count
            if (object_exists($submit_button, '$submit_button')) {
                if (active_rows > 0) {
                    $submit_button.removeClass('ee-disabled-btn');
                } else {
                    $submit_button.addClass('ee-disabled-btn');
                }
            }

            $('.ticket-selector-disabled-submit-btn-msg').stop().hide();

            $('.checkbox-dropdown-selector').hide();
        }
    );

    /*$checkboxes = $('.checkbox-dropdown-selector .datetime-selector-option');
    $.each($checkboxes, function(){
        if($(this).prop('checked') == true){
            $(this).prop('checked', false);
        }        
        //console.log($(this).attr('checked'));
    });*/

    $ticket_selector_submit_btn.on('click', function (e) {
		if( $( this ).hasClass( 'ee-disabled-btn' ) ) {
			e.preventDefault();
			e.stopPropagation();
			$(this).prev('.ticket-selector-disabled-submit-btn-msg').stop().fadeIn(100).delay(6000).fadeOut();
		}
	});

   

	var maxChecked = typeof eeDTS !== 'undefined' && eeDTS.maxChecked ?
		eeDTS.maxChecked :
		10;
	var counter = 0;
	var prevCounter = 0;
	var dtsEvent = 0;
	var thisEvent = 0;
	var prevEvent = 0;
	var noticeID = '';
	var $notice;
	
    $.each( $datetime_options, function() {
		// need to track previous state
		prevEvent = thisEvent;
		prevCounter = counter;
		thisEvent = $( this ).data( 'tkt_slctr_evt' );
		// reset counter when input changes, which is tracked by Event ID
		counter = thisEvent !== dtsEvent ? 1 : counter + 1;
		// new DTS for next Event?
		if ( thisEvent !== dtsEvent ) {
			// if the previous Event counter was less than the max checked
			if ( prevCounter > 1 && prevCounter <= maxChecked ) {
				// then hide the notice re: extra dates cuz there are none
				noticeID = '#datetime-selector-' + prevEvent;
				noticeID += '-date-time-filter-notice-pg';
				$notice = $( noticeID );
				if ( $notice.length ) {
					$notice.hide();
				}
			}
			dtsEvent = thisEvent;
		}
		if ( maxChecked > 0 && counter > maxChecked ) {
			return;
		}
		$( this ).click();
        //$(this).closest('checkbox', false);
	} );

    
	// Added functions to convert the value into proper date
	function convert_to_days(date_range)
	{
		var dates 	= date_range.split("-");
		var begin 	= date_clean_format(dates[0]);
		var end 	= date_clean_format(dates[1]);
		begin 		= new Date(begin);
		end 		= new Date(end);
		var output 	= '';
		var numdays	= Math.floor((Date.UTC(end.getFullYear(), end.getMonth(), end.getDate()) - Date.UTC(begin.getFullYear(), begin.getMonth(), begin.getDate()) ) /(1000 * 60 * 60 * 24)) + 1;
		if(numdays > 0){
			output = numdays + " Day Courses";
		}
        //console.log(output);
		return output;
	
	}

	function date_clean_format(date_raw){
		var date = date_raw.split("_");		
		return date[1] + '/' + date[2] + '/' + date[0];
	}

    $('.checkbox-dropdown-selector').css('display', 'block').css('background-color', 'white');


});// END #####################################    END

