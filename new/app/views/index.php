<?php include("header.php");

$home = Home::entry();
$cases = Cases::allForHome();

$cases1 = array();
$cases2 = array();

if ($cases)
{
	$cases = $cases->asArray(false);
	$cases1 = array_splice($cases, 0, min(count($cases), 3));
	$cases2 = $cases;
}


?>
	<div class="guide guide-index"></div>
	<section class="cases">
		<div class="parallax">
			<?php
			foreach ($home->parallaxElements() as $element)
			{
				?><div class="parallax-item" data-z="<?php echo $element->z; ?>" data-depth="<?php echo $element->depth; ?>" data-anchor-x="<?php echo $element->anchorX; ?>" data-anchor-y="<?php echo $element->anchorY; ?>" data-image="<?php echo $element->path(); ?>"></div><?php
			}
			?>
		</div>
		<?php
		foreach ($cases1 as $case)
		{
			?>
			<div class="item <?php echo $case->featured == 1 ? "highlight" : ""; ?>">
				<a class="wrap" href="<?php echo $case->url(); ?>">
					<span class="cover" style="background-image: url('<?php echo $case->cover(); ?>');"></span>
					<h2><?php echo $case->client; ?></h2>
					<span><?php echo $case->name; ?></span>
				</a>
			</div>
			<?php
		}
		?>

		<div class="quote">
			<?php echo $home->quote; ?>
			<p class="author"><?php echo $home->author; ?></p>
		</div>

		<?php
		foreach ($cases2 as $case)
		{
			?>
			<div class="item <?php echo $case->featured == 1 ? "highlight" : ""; ?>">
				<a class="wrap" href="<?php echo URL::to("case/" . $case->id . "/"); ?>">
					<span class="cover" style="background-image: url('<?php echo $case->cover(); ?>');"></span>
					<h2><?php echo $case->client; ?></h2>
					<span><?php echo $case->name; ?></span>
				</a>
			</div>
			<?php
		}
		?>
	</section>

	<footer>
		<div class="links">
			<a href="<?php echo URL::to("work/"); ?>">VIEW ALL WORK</a>
		</div>
		<div class="logo">,a.</div>
	</footer>
<?php include("footer.php"); ?>
