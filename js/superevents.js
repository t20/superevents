//alert ('This is a event page');
var $j = jQuery.noConflict();
$j(document).ready(function($) {
   alert ('This is a event page');
   var rsvp_value = $('input:radio[name=superevents_rsvp]:checked').val();
   alert ('processing ' + rsvp_value);
   
});
$j('#superevents_rsvp_submit').click (function($){
   alert ('Submitting form');
   return false;
});
// $j('#superevents_rsvp_form').submit( function(){
//   //alert ('RSVP is ' + jQuery('#superevents_rsvp').val());
//   alert ('Processing RSVP');
//   return false;
// });
