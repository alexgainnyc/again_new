var Menu = {
	open: false,
	toggleProxy: null,
	init: function () {
		var self = this;

		this.toggleProxy = $.proxy(this.toggle, this);

		$(".menu-icon").click(function (e) {
			self.toggle();

			e.preventDefault();
			return false;
		});
	},
	toggle: function (e) {
		this.open = !this.open;

		if (this.open)
		{
			$("body").addClass("menu-open");

			$(".site-wrapper").click(this.toggleProxy);
		}
		else
		{
			$("body").removeClass("menu-open");
			$(".site-wrapper").unbind("click", this.preventDefault);
		}

		if (e)
		{
			e.stopPropagation();
			e.preventDefault();
			return false;
		}
	}
};