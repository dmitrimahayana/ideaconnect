function fixedPosition() { 
	var dialogHeight = $(".login .content").height();
	var dialogWidth = $(".login .content").width();
	$(".login .content").css({
		"position" : "absolute",
		"left" : - dialogWidth / 2,
		"top" : - dialogHeight / 2
	});
}

$(document).ready(function() {
	fixedPosition();
});
