//alert ('This is a event page');
var $j = jQuery.noConflict();
$j('#superevents_rsvp_submit').click (function($){
   var rsvp_value = $j('input:radio[name=superevents_rsvp]:checked').val();
   var event_id = $j('#superevents_event_id').val();
   var data = { 
      action : 'superevents_update_rsvp', 
      rsvp : rsvp_value, 
      event_id : event_id,
      postCommentNonce : superevents.postCommentNonce
   }
   var message = $j('#superevents_rsvp_message');
	message.hide();
   jQuery.post(superevents.ajaxurl, data, function(response) {
   		//alert('Got this from the server: ' + response);
   		var JSONResponse = JSON.parse(response);
   		//alert(JSONResponse.response);
   		if(JSONResponse.response == 'success')
   		{
   		   message.html('Thank you. Your RSVP has been updated to : '+ rsvp_value.toUpperCase());
   		}else
   		{
   		   message.html('There was some error. Plz try later.');
   		}
   		message.show();
   		message.flash();
   	});
});