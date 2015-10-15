

$(document).ready(function() {
	$("a[href='#hide']").on('click', function() {
		$(".menubar").toggleClass("col-sm-3 col-sm-1");
		$(".contentPane").toggleClass("col-sm-9 col-sm-11");
	});
	//add dropdown code
	//do initial hide
	$("#addDropdown").hide(0);
	//event handler for add button
	$("#addButton").on('click', function() {
		$("#addDropdown").slideDown(200);
	});
	//event handler for submit button
	$("#nothingSubmit").on('click', function() {
		$("#contentTable").append(
			"<tr><td>" + $("#inputFood").val() + "</td>" +
			"<td>" + $("#inputDate").val() + "</td>" +
			"<td>" + $("#inputCalories").val() + "</td></tr>"
		);
		$("#inputFood").val('');
		$("#inputDate").val('');
		$("#inputCalories").val('');
		return false;
	});
}); 
