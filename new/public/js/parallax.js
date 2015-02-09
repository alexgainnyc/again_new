var Parallax = {
	items: [],
	scrollTop: 0,
	windowHeight: 0,
	init: function () {
		var self = this;

		$(".parallax .parallax-item").each(function () {
			self.items.push(new ParallaxItem($(this), self));
		});

		$(window).resize($.proxy(this.resize, this));
		$(window).scroll($.proxy(this.scroll, this));
		
		this.resize();
	},
	resize: function () {
		this.windowHeight = $(window).height();

		for (var k in this.items)
		{
			this.items[k].resize();
		}

		this.scroll();
	},
	scroll: function () {
		this.scrollTop = $(window).scrollTop();

		for (var k in this.items)
		{
			this.items[k].scroll();
		}
	}
};

var ParallaxItem = function (elm, parallax) {
	var self = this;

	this.$elm = elm;
	this.$parent = this.$elm.parent().parent();
	this.parallax = parallax;
	this.parentHeight = 0;
	this.parentOffsetY = 0;
	this.height = 0;
	this.depth = +this.$elm.data("depth");
	this.anchorY = +this.$elm.data("anchor-y") / 100;

	if (+this.$elm.data("z") == 2)
	{
		this.$elm.css("z-index", -1);
	}

	this.$elm.hide();

	this.$elm.html("<img />");
	var $img = this.$elm.find("img");
	$img.load(function () {
		self.$elm.show();

		self.height = $(this).outerHeight();

		$(this).css({
			marginLeft: -$(this).width() * 0.5,
			marginTop: -self.height * 0.5,
		})

		self.scroll();
	});

	$img.attr("src", this.$elm.data("image"));

	this.$elm.css("left", Math.round(+Math.max(0, Math.min(100, this.$elm.data("anchor-x")))) + "%");

	this.resize = function () {
		this.parentHeight = this.$parent.outerHeight();
		this.parentOffsetY = this.$parent.offset().top;
	};

	this.scroll = function () {
		if (this.height == 0)
		{
			return;
		}

		var middle = 1 - this.anchorY;

		var ratio = 1 - ((this.parallax.scrollTop + this.parallax.windowHeight - this.parentOffsetY) / (this.parentHeight + this.parallax.windowHeight));
		ratio = (ratio - middle) * (0.5 + 2.5 * (1 - (this.depth / 21))) + middle;

		var top = -(this.height * 0.5) + ratio * (this.parallax.windowHeight + this.height);

		this.$elm.css("top", top);
	};
}