$(document).ready(function(){ 
	$('#dp_start').datetimepicker({
	    format: 'yyyy/MM/dd hh:mm:ss',  //format: 'yyyy-MM-dd hh:mm:ss' either one works     
	    language: 'vi',
	    pick12HourFormat: true
	  });

	$('#dp_end').datetimepicker({
	    format: 'yyyy/MM/dd hh:mm:ss',  //format: 'yyyy-MM-dd hh:mm:ss' either one works     
	    language: 'vi',
	    pick12HourFormat: true
	  });
});