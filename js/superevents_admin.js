alert ('This is a event admin page');
var $j = jQuery.noConflict();
$j(document).ready(function(){
    alert ('This is a event admin page. Doc is now ready');
   $j('.datepicker').datepicker();
});
