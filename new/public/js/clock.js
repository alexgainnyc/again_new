var Clock = {
	$canvas: null,
	context: null,
	color: "",
	width: 0,
	height: 0,
	init: function () {
		this.$canvas = $("header .clock canvas");
		this.context = this.$canvas[0].getContext("2d");

		this.width = this.$canvas.width();
		this.height = this.$canvas.height();
		this.color = this.$canvas.css("color");

		this.update();
		setInterval($.proxy(this.update, this), 1000);
	},
	update: function () {
		var ctx = this.context;
		var w = this.width;
		var h = this.height;

		var offset = Math.PI / 6;

		ctx.clearRect(0, 0, w, h);
		ctx.beginPath();

		for (var i = 0; i < 12; i++)
		{
			var a = offset * i;

			ctx.moveTo(w / 2 + Math.cos(a) * w * 0.43, h / 2 + Math.sin(a) * w  * 0.43);
			ctx.lineTo(w / 2 + Math.cos(a) * w / 2, h / 2 + Math.sin(a) * w / 2);
		}

		var date = new Date();
		var mn = date.getMinutes() / 60;
		var hr = (((date.getHours() + mn) / 12) - 0.25) * (Math.PI * 2);
		mn -= 0.25;
		mn *= (Math.PI * 2);

		ctx.moveTo(w / 2, h / 2);
		ctx.lineTo(w / 2 + Math.cos(hr) * w * 0.22, h / 2 + Math.sin(hr) * h * 0.22);

		ctx.moveTo(w / 2, h / 2);
		ctx.lineTo(w / 2 + Math.cos(mn) * w * 0.26, h / 2 + Math.sin(mn) * h * 0.26);

		ctx.strokeStyle = this.color;
		ctx.lineWidth = 2;
		ctx.stroke();


		// ctx.fillRect(0, 0, w, h);
	}
};