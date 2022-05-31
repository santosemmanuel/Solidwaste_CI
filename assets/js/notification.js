$(document).ready(function(){

	function notificationConcern(){
		$.get(base_url+"concerns/getNotifyConcern", function(data){
			$('.notifConcern').html(data[0].notification);
		},'json');
	}

	setInterval(notificationConcern, 2000);

})
