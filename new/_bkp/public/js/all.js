var All = {
	init: function () {
		if (!$("section.all").length) {
			return;
		}

		$("img.lazy").css({ opacity: 0 }).lazyload({
			effect: "fadeIn"
		}).bind("loaded", function () {
			$(this).css({ opacity: 1 }).parent().find(".loading").hide();
		});

		// var msnr = new Masonry($("section.all")[0], {
		// 	columnWidth: ".sizer",
		// 	itemSelector: ".item"
		// });
	}
}