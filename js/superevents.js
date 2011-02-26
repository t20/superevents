//alert ('This is a event page');
var $j = jQuery.noConflict();
$j('#superevents_rsvp_submit').click (function($){
   alert ('This is a event page');
   var rsvp_value = $j('input:radio[name=superevents_rsvp]:checked').val();
   var event_id = $j('#superevents_event_id').val();
   var data = { 
      action : 'superevents_update_rsvp', 
      rsvp : rsvp_value, 
      event_id : event_id
   }
   jQuery.post(superevents.ajaxurl, data, function(response) {
   		alert('Got this from the server: ' + response);
   	});
});