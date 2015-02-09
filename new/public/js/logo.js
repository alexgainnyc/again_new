var Logo = {
	fixed: false,
	elLogo: "header .title a.logo",
	init: function () {
		$(this.elLogo).addClass("original");

		var $clone = $(this.elLogo).clone().addClass("fixed");
		$clone.removeClass("original");
		$clone.insertBefore($(this.elLogo));

		$(window).scroll($.proxy(this.scroll, this));
		this.scroll();
	},
	scroll: function () {
		var sy = $(window).scrollTop();
		var $el = $(this.elLogo + ".original");
		var elbottom = $el.offset().top + $el.height();
		var $elfixed = $(this.elLogo + ".fixed");

		if (sy >= elbottom && !this.fixed)
		{
			this.fixed = true;
			$elfixed.addClass("show")
		}
		else if (sy < elbottom && this.fixed)
		{
			this.fixed = false;
			$elfixed.removeClass("show");
		}

		if (this.fixed)
		{
			$elfixed.css("marginTop", -100 + Math.min(120, (sy - elbottom) * 0.5));
		}
	}
};