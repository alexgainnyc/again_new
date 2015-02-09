var Gallery = {
	init: function () {
		$(".bxslider").each(function () {
			var $this = $(this);

			if (!$this.data("initialized"))
			{
				var slider = $this.bxSlider({
					minSlides: 1,
					maxSlides: 1,
					slideWidth: 1440,
					easing: "cubic-bezier(0.190, 1.000, 0.220, 1.000)",
					controls: !$this.hasClass("no-arrows"),
					speed: 500,
					hideControlOnEnd: true,
					responsive: !$this.hasClass("all-height"),
					pager: !$this.hasClass("no-pager"),
					startSlide: $this.data("start-index") || 0
				});
				$this.data("initialized", true);
				$this.data("bxslider", slider);
			}
		});
	}
}