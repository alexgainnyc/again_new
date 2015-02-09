var ModalGallery = {
	init: function () {
		var self = this;

		// var i = 0;
		// $(".modal-gallery-item").each(function () {
		// 	var $this = $(this);
		// 	var that = self;

		// 	$this
		// 		.data("index", i++)
		// 		.click(function () {
		// 			that.open($(this));
		// 		});
		// });

		$(".modal-gallery-item").click(function () {
			self.open($(this));
		});

		$(".modal-gallery-item-all").click(function (e) {
			self.open($(this).find(".img"));

			e.preventDefault();
			return false;
		});
	},
	open: function ($source) {
		var self = this;
		/*var index = $source.data("index");

		var html = '<div class="modal-gallery">';
		html += '<a class="close"><img src="img/gallery-close.png" /></a>';
		html += '<div class="frame">';
		html += '<div class="bxslider no-pager all-height" data-start-index="' + index + '">';

		$(".modal-gallery-item").each(function () {
			var $this = $(this);

			var src = $this.attr("src");

			if (!src)
			{
				src = $this.css("background-image");
				src = /^url\((['"]?)(.*)\1\)$/.exec(src);
				src = src ? src[2] : "";
			}

			if (!src)
			{
				return;
			}

			if ($this.parent().hasClass("bx-clone"))
			{
				return;
			}

			html += '<div class="slide" style="background-image: url(\'' + src + '\');"></div>';
		});

		html += '</div></div></div>';

		$("body").append(html);

		$(".modal-gallery .close").click(function () {
			self.close();
		});

		Gallery.toggleAuto(false);
		Gallery.init();*/

		var src = $source.attr("src");

		if (!src)
		{
			src = $source.css("background-image");
			src = /^url\((['"]?)(.*)\1\)$/.exec(src);
			src = src ? src[2] : "";
		}

		if (!src)
		{
			return;
		}

		var html = '<div class="modal-gallery">';
		html += '	<a class="close"><img src="img/gallery-close.png" /></a>';
		html += '	<div class="frame">';
		html += '		<div class="full-image" style="background-image: url(\'' + src + '\');">';

		html += '		</div></div></div>';

		$("body").append(html);

		$(".modal-gallery .close").click(function () {
			self.close();
		});

		$(".modal-gallery").css({ opacity: 0 }).animate({ opacity: 1 }, 600, "easeOutExpo");

		// var index = $source.data("index");
		// var slider = $(".modal-gallery .bxslider").data("bxslider");
		// slider.goToSlide(index);
	},
	close: function () {
		$(".modal-gallery").stop(true).animate({ opacity: 0 }, 600, "easeOutExpo", function () {
			$(this).remove();
		});

		// Gallery.toggleAuto(true);
	}
};