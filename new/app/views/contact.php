<?php include("header.php");

$about = About::entry();
?>
	<div class="guide guide-contact"></div>
	<section class="contact">
		<div class="parallax">
			<?php
			foreach ($about->parallaxElements() as $element)
			{
				?><div class="parallax-item" data-z="<?php echo $element->z; ?>" data-depth="<?php echo $element->depth; ?>" data-anchor-x="<?php echo $element->anchorX; ?>" data-anchor-y="<?php echo $element->anchorY; ?>" data-image="<?php echo $element->path(); ?>"></div><?php
			}
			?>
		</div>
		<div class="video">
			<div class="frame">
				<video preload="none" autoplay poster="img/tmp/cover.jpg" class="vjs-tech" src="<?php echo $about->videoMp4(); ?>" style="width: 100%; height: 100%">
					<source src="<?php echo $about->videoMp4(); ?>" type="video/mp4">
					<source src="<?php echo $about->videoWebm(); ?>" type="video/webm">
				</video>
			</div>
		</div>

		<div class="quote">
			<?php echo $about->text; ?>
		</div>
		

		<div class="people">
			<?php
			$people = People::all();
			foreach ($people as $item)
			{
				?>
				<div class="item">
					<h2><?php echo $item->name; ?></h2>
					<span><?php echo $item->country; ?></span>
					<?php if ($item->picture()) { ?><img src="<?php echo $item->picture(); ?>" /><?php } ?>
					<?php echo $item->text; ?>
				</div>
				<?php
			}
			?>
		</div>

		<div class="category">
			<h2>Services</h2>
			<?php
			$services = Services::all();
			foreach ($services as $service)
			{
				?>
				<div class="item">
					<h3><?php echo $service->name; ?></h3>
					<?php echo $service->text; ?>
					<p class="keywords">
						<?php echo implode(" / ", $service->tagsAsArray()); ?>
					</p>
				</div>
				<?php
			}
			?>
		</div>
		<div class="category">
			<h2>Process</h2>
			<div class="item">
				<?php echo $about->process; ?>
			</div>
		</div>
	</section>

	<footer>
		<div class="spacer"></div>
	</footer>
<?php include("footer.php"); ?>
