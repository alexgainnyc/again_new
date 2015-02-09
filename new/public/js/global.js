$(function () {
	var resize = function () {
		var $body = $("body").removeClass("phone");

		if ($(window).width() <= 767)
		{
			$body.addClass("phone");
		}
	};

	$(window).resize(resize);
	resize();

	if (Modernizr.touch)
	{
		$("html").removeClass("cantouch");
	}

	Logo.init();
	Menu.init();
	Clock.init();
	Gallery.init();
	ModalGallery.init();
	All.init();
	Culture.init();
	Parallax.init();
});