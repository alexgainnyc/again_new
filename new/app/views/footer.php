	<script>
	window.J_ROOT = "<?php echo URL::to(""); ?>";
	</script>

	<?php if(!Config::item('usedist')){ ?>
	<!-- build:js js/global.min.js -->
		<script src="js/vendor/jquery-2.1.1.min.js"></script>
		<script src="js/vendor/jquery.easing.1.3.js"></script>
		<script src="js/vendor/jquery.bxslider.js"></script>
		<script src="js/vendor/jquery.lazyload.js"></script>
		<script src="js/vendor/jquery.waypoints.js"></script>
		<script src="js/vendor/modernizr.custom.14762.js"></script>
		<script src="js/vendor/masonry.min.js"></script>
		<script src="js/vendor/video.dev.js"></script>
		<script src="js/logo.js"></script>
		<script src="js/menu.js"></script>
		<script src="js/clock.js"></script>
		<script src="js/modal-gallery.js"></script>
		<script src="js/gallery.js"></script>
		<script src="js/culture.js"></script>
		<script src="js/all.js"></script>
		<script src="js/parallax.js"></script>
		<script src="js/global.js"></script>
	<!-- endbuild -->
	<?php } else { ?>
		<script src="<?php echo URL::to(Config::item('publicDist') . "js/global.min.js"); ?>"></script>
	<?php } ?>

	<?php
	if (Request::isLocal())
	{
		?>
		<script>
		$(function () {
			var script = document.createElement("script");
			var firstScript = document.getElementsByTagName("script")[0];
			script.async = 1;
			script.src = "http://localhost:35729/livereload.js?ext=Chrome&extver=2.0.9";
			firstScript.parentNode.insertBefore(script, firstScript);
		});
		</script>
		<?
	}
	?>
</body>
</html>