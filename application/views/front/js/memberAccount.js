


$('a[data-toggle="pill"]').on('change', function (e) {
	var target = $(e.target).attr("href") // activated tab
	alert(target);
});