var Menu = {
	open: false,
	// resizeProxy: null,
	init: function () {
		var self = this;

		// this.resizeProxy = $.proxy(this.resize, this);

		$(".menu-icon").click(function (e) {
			self.toggle();

			e.preventDefault();
			return false;
		});
	},
	toggle: function () {
		this.open = !this.open;

		if (this.open)
		{
			$("body").addClass("menu-open");
			// $(window).resize(this.resizeProxy);
			$(".menu-content").width(320).css("transform", "translate(0px, 0px)");

			$(".site-wrapper").css("transform", "translate(-320px, 0px)");

			this.resize();
		}
		else
		{
			$("body").removeClass("menu-open");
			// $(window).unbind("resize", this.resizeProxy);
			$(".menu-content").width(100).css("transform", "translate(320px, 0px)");
			$(".site-wrapper").css("transform", "translate(0px, 0px)");
		}
	},
	resize: function () {

	}
};