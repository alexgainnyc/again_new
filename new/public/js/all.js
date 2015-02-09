var All = {
	init: function () {
		if (!$("section.all").length) {
			return;
		}

		var self = this;

		$("img.lazy").css({ opacity: 0 }).lazyload({
			effect: "fadeIn"
		}).bind("loaded", function () {
			$(this).css({ opacity: 1 }).parent().find(".loading").hide();
		});

		$(window).resize(this.resize);
		this.resize();

		// var msnr = new Masonry($("section.all")[0], {
		// 	columnWidth: ".sizer",
		// 	itemSelector: ".item"
		// });

		$(".all .tags a").click(function (e) {
			self.filterTag($(this).attr("href").split("#").join(""));

			e.preventDefault();
			return false;
		});

		this.filterTag("");
	},
	resize: function () {
		var $tags = $("section.all .tags .center");
		var margin = 0;

		if (!$("body.phone").length)
		{
			margin = ($(window).height() - $tags.height()) / 2;
		}

		$tags.css("marginTop", margin);
	},
	filterTag: function (tagID)
	{
		tagID = parseInt(tagID);

		if (tagID > 0)
		{
			$(".all .item").hide();

			$(".all .item.tag-" + tagID).show();

			$(".all .tags .view-all").show();
		}
		else
		{
			$(".all .item").show();

			$(".all .tags .view-all").hide();
		}

		var allPosClasses = [];
		for (var i = 1; i < 14; i++)
		{
			allPosClasses.push("pos" + i);
		}
		allPosClasses = allPosClasses.join(" ");

		var i = 0;
		$(".all .item").each(function () {
			var $this = $(this);

			$this.removeClass(allPosClasses);

			if (!$this.is(":hidden"))
			{
				$this.addClass("pos" + ((i % 13) + 1));

				i++;
			}
		});
	}
}