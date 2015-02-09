<?php
include("header.php");

$cultures = Culture::all();
?>
	<div class="guide guide-culture"></div>
	<section class="culture">
		<div class="bullets">
			<div class="center">
				<ul>
					<?php
					foreach ($cultures as $item)
					{
						?>
						<li><a href="#item<?php echo $item->index; ?>"><span></span></a></li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>
		<?php
		foreach ($cultures as $item)
		{
			?>
			<div class="item">
				<div class="parallax">
					<?php
					foreach ($item->parallaxElements() as $element)
					{
						?><div class="parallax-item" data-z="<?php echo $element->z; ?>" data-depth="<?php echo $element->depth; ?>" data-anchor-x="<?php echo $element->anchorX; ?>" data-anchor-y="<?php echo $element->anchorY; ?>" data-image="<?php echo $element->path(); ?>"></div><?php
					}
					?>
				</div>
				<a name="item<?php echo $item->index; ?>"></a>
				<h2><?php echo $item->title; ?></h2>
				<p class="main"><?php echo $item->text; ?></p>
				<p class="quote">“<?php echo $item->quote; ?>”</p>
				<p class="author"><?php echo $item->author; ?></p>
			</div>
			<?php
		}
		?>
	</section>

	<footer>
		<div class="spacer"></div>
	</footer>

	<!-- <footer>
		<div class="links">
			<a href="#" class="arrow prev">PUMA</a>
			<a href="#" class="arrow next">DAVID YURMAN</a>
		</div>
	</footer> -->
<?php include("footer.php"); ?>
