$(document).load(function(){
	window.requestFullscreen();
});;
(function () {
  if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
	var body = document.getElementsByTagName('body')[0];
	body.className = body.className + ' sidebar-collapse';
  }
})();

$(".datatable").DataTable({
	scrollX : true
});

function notif(params) {
	swal({
		position: 'center',
		showConfirmButton: false,
		timer: 3200,
		type: params.type,
		title: params.title
	});
}