<?php



function ee_print_available_tickets( $EVT_ID, $event ) {
  if ( $event instanceof EE_Event ) {
    if ( ! $event->is_sold_out() && $event->is_upcoming() ) {
      //get total approved registrations count
      $spots_taken = EEM_Registration::instance()->count(array(
        array(
          'EVT_ID' => $EVT_ID,
          'STS_ID' => EEM_Registration::status_id_approved,
        ),
      ), 'REG_ID', true);
      $total = $event->total_available_spaces();
      if( ! is_int($total) ) {
        return; // get out, no limit set
      }
      $available = $total - $spots_taken;
      // output some html 
      $html = '<div class="total-tickets">';
      $html .= 'Number of available tickets: ';
      $html .= $available . '</div>';
      echo $html;
    }
  }
}
//add_action( 'AHEE__ticket_selector_chart__template__after_ticket_selector', 'ee_print_available_tickets', 10, 2 );


function lat_add_inline_script_ts_show_sale_info(   ) { 
    global $post;

    if ( espresso_display_ticket_selector( $post->ID ) && ( is_single() || ( is_archive() && espresso_display_ticket_selector_in_event_list() ))) :   

      $EVT_ID = get_the_ID();

      //var_dump($EVT_ID );

      $remaining_value = 0;
      $remain = get_remaining_ticket( $EVT_ID );
      //$remain_arr = ($remain) ? json_encode($remain) : '';
      //var_dump($remain);
      $i = 0;
      $custom_js = '
      jQuery(document).ready(function($){
          var j = 0;
          var $datetime_options = $(".datetime-selector-option");
          $.each($datetime_options, function () {
              $(this).prop("checked", true);
          });
          if( $(".checkbox-dropdown-selector")[0] ){
            $(".tckt-slctr-tbl-tr").addClass("ee-hidden-ticket-tr");
          }          
          var remain_arr  = '. json_encode($remain)  .';          
          $("table.tkt-slctr-tbl thead th:last").after("<th class=\'ee-ticket-selector-ticket-remaining-th cntr \' scope=\'col\'> Remaining</th>");
          $("table.tkt-slctr-tbl tbody tr").each(function() { 
            $(this).find("td:last").after("<td class=\' cntr \'>"+remain_arr[j]+"</td>"); 
            j++;             
          });
          $("select.ticket-selector-tbl-qty-slct:first option[value=\"1\"]").prop("selected", true);

          //  ********** Ticket display ***************

          $(".checkbox-dropdown-selector").on("click",".datetime-selector-option",              
              function () {
                  var $datetime_selector_option = $(this);
                  var event_id = $datetime_selector_option.data("tkt_slctr_evt");
                  var $submit_button = $("#ticket-selector-submit-" + event_id + "-btn");
                  // track how many ticket selector rows are active ? ie: being displayed
                  var active_rows = 0;
                  var datetimes = [];
                  var $ticket_selector = $("#tkt-slctr-tbl-" + event_id);
                  if (object_exists($ticket_selector, "$ticket_selector")) {                      
                      $datetime_options = $datetime_selector_option.parents("ul").find(".datetime-selector-option");
                      if (object_exists($datetime_options, "$datetime_options")) {
                          // add each datetime options to our array of datetimes
                          $.each($datetime_options, function (index) {
                              // if checked, then display row and increment active_rows count
                              if ($(this).prop("checked")) {
                                  datetimes.push("ee-ticket-datetimes-" + $(this).val());
                              }
                          });
                      }
                      // find all ticket rows for this event
                      var $ticket_selector_rows = $ticket_selector.find(".tckt-slctr-tbl-tr");
                      $.each($ticket_selector_rows, function () {
                          var $ticket_selector_row = $(this);
                          // get all of the specific datetime related classes assigned to this ticket row
                          var ticket_row_datetime_classes = $ticket_selector_row.attr("class").split(" ").filter(
                              function(element) {
                                  return element.indexOf("ee-ticket-datetimes-") !== -1;
                              }
                          );                         
                          var display = false;
                          $.each(ticket_row_datetime_classes, function (index, element) {
                              if ($.inArray(element, datetimes) !== -1) {
                                  display = true;
                              }
                          });
                          if (display) {
                              $ticket_selector_row.removeClass("ee-hidden-ticket-tr");
                              active_rows++;
                          } else {
                              $ticket_selector_row.addClass("ee-hidden-ticket-tr").find(".ticket-selector-tbl-qty-slct").val(0);
                          }
                      });
                  }
                  
              }
          );

          // *********** ticket display  **********
           

      });';
      wp_add_inline_script('ticket_selector', $custom_js);

    endif; // espresso page    
}
add_action('wp_enqueue_scripts', 'lat_add_inline_script_ts_show_sale_info', 20);

function get_remaining_ticket( $EVT_ID )
{
  $remain = array();

  $event = EEM_Event::instance()->get_one_by_ID( $EVT_ID );

  //var_dump($event);

  // Pull the required tickets for the event.
  /*$required_tickets = $event->tickets( array(
    array('TKT_required' => true)
  )
);*/

  $required_tickets = $event->tickets();

  // Initialize $remaining_spaces as 0.
  $remaining_spaces = 0;

  if($required_tickets) {
    // Loop over all of the required tickets for the event.
    foreach($required_tickets as $required_ticket) {
      // Sanity check to make sure we have an EE_Ticket.
      if($required_ticket instanceof EE_Ticket) {
        // Add the spaces remaining for each required ticket to $spaces_remaining.
        $remaining_spaces += $required_ticket->remaining();
        $remain[] = $required_ticket->remaining();
      }
    }
  }

  //Output the number of remaining spaces.
  return $remain;
}

