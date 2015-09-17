

$(document).ready(function() {
	$("a[href='#hide']").on('click', function() {
		$(".menubar").toggleClass("col-sm-3 col-sm-1");
		$(".contentPane").toggleClass("col-sm-9 col-sm-11");
	});
}); 
