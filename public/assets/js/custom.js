$(document).load(function(){
	window.requestFullscreen();
});
$(document).ready(function(){
	// $(".alert").fadeOut(7000);	
});
(function () {
  if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
	var body = document.getElementsByTagName('body')[0];
	body.className = body.className + ' sidebar-collapse';
  }
})();

$(".datatable").DataTable({
	scrollX : true,
});

function notif(params) {
	swal({
		toast: true,
		position: 'top',
		showConfirmButton: false,
		timer: 4000,
		type: params.type,
		title: params.title
	});
}