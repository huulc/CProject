$(document).ready(function(){ 
	$('#dp_start').datetimepicker({
	    format: 'yyyy-mm-dd hh:mm:ss',  //format: 'yyyy-MM-dd hh:mm:ss' either one works     
	    language: 'vi',
	    pick12HourFormat: true
	  });

	$('#dp_end').datetimepicker({
	    format: 'yyyy-mm-dd hh:mm:ss',  //format: 'yyyy-MM-dd hh:mm:ss' either one works     
	    language: 'vi',
	    pick12HourFormat: true
	  });


	//ajax load user
	var listUserAssige = $(".user-assige");
	listUserAssige.each(function(){
		var $this = $(this);
		var taskId = $(this).attr("ref");
		$.get(
			home+"tasks/task_get_user/"+taskId,
			function(data){
				console.log(data);
				$this.html(data);
			}
		);
	});


	CKEDITOR.replace('textarea');
});