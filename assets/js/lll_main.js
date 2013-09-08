$(document).ready(function () {
	resizeshit();
});

$(window).resize(resizeshit);

function resizeshit() {
	/*
var newh = 0;
	$(".navcell").each(function (ix, ell) {
		($(ell).outerHeight() > newh) ? newh = $(ell).outerHeight() : newh = newh;
	});
	
	$(".navcell").css({
		"height" : newh + "px"
	});
*/

	$("#content").css({
		"height" : $(window).height() - $("table.nav").outerHeight() + "px",
		"top": $("table.nav").outerHeight() + "px"
	});
	
	if ($(".titlebox").length) {
		$(".titlebox").css({
			"height" : $(window).height() - $("table.nav").outerHeight() + "px",
			"padding-top" : (($(window).height() - $("table.nav").outerHeight())/2 - $(".titlebox p").outerHeight()/2) + "px"
		});
	}
}