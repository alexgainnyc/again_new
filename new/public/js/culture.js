var Culture = {
	init: function () {
		if (!$("section.culture").length)
		{
			return;
		}

		var self = this;

		$(".culture .bullets a").click(function (e) {
			var anchor = $(this).attr("href").split("#").join("");
			var top = $("a[name='" + anchor + "']").offset().top;

			var scrollTop = $(window).scrollTop();
			var diff = Math.abs(top - scrollTop);

			$("html, body").stop(true).animate({ scrollTop: top }, Math.min(1200, diff / (1000 / 300)), "easeInOutExpo");

			e.preventDefault();
			return false;
		});

		$(".culture .bullets a:eq(0)").addClass("selected");

		$(".culture .item").each(function (index) {
			var that = self;
			$(this).waypoint(function (direction) {
				that.active(direction === "down" ? index : index - 1);
			}, { offset: 100 });
		});

		$(window).resize(this.resize);
		this.resize();

		// $(window).scroll($.proxy(this.update, this));
		// this.update();
	},
	// update: function () {

	// },
	active: function (index) {
		var $all = $(".culture .bullets a").removeClass("selected");

		index = Math.max(0, Math.min($all.length - 1, index));

		$($all.eq(index)).addClass("selected");
	},
	resize: function () {
		var $tags = $("section.culture .bullets .center");

		$tags.css("marginTop", ($(window).height() - $tags.height()) / 2);
	}
}