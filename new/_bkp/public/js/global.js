$(function () {
	var script = document.createElement("script");
	var firstScript = document.getElementsByTagName("script")[0];
	script.async = 1;
	script.src = "http://localhost:35729/livereload.js?ext=Chrome&extver=2.0.9";
	firstScript.parentNode.insertBefore(script, firstScript);
});

$(function () {
	Menu.init();
	Clock.init();
	Gallery.init();
	ModalGallery.init();
	All.init();
	Culture.init();
});