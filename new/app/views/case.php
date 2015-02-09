<?php include("header.php");

$case = Cases::detail();

if (!$case)
{
	return Response::redirect("/");
}
?>
	<div class="guide guide-case"></div>
	<section class="case">
		<div class="title">
			<div class="cover modal-gallery-item" style="background-image: url('<?php echo $case->cover(); ?>');"></div>
			<div class="text">
				<div class="wrap">
					<h2><?php echo $case->client; ?></h2>
					<p><?php echo $case->name; ?></p>
				</div>
			</div>
		</div>
		<?php
		$content = $case->contents();
		foreach ($content as $item)
		{
			if ($item->type == 1)
			{
				?>
				<div class="paragraph">
					<div class="text">
						<?php echo $item->text; ?>
					</div>
					<div class="keywords">
						<ul>
							<li><?php echo str_replace("<br>", "</li><li>", nl2br($item->tags)); ?></li>
						</ul>
					</div>
				</div>
				<?php
			}
			else if ($item->type == 2)
			{
				?>
				<div class="photos">
					<div class="photo">
						<img src="<?php echo $item->leftAsset(); ?>" class="modal-gallery-item" />
					</div>
					<div class="photo">
						<img src="<?php echo $item->rightAsset(); ?>" class="modal-gallery-item" />
					</div>
				</div>
				<?php
			}
			else if ($item->type == 4)
			{
				?>
				<div class="photo-caption">
					<div class="photo">
						<img src="<?php echo $item->leftAsset(); ?>" class="modal-gallery-item" />
					</div>
					<div class="text">
						<?php echo $item->caption; ?>
					</div>
				</div>
				<?php
			}
			else if ($item->type == 3)
			{
				?>
				<div class="photo-caption right">
					<div class="text">
						<?php echo $item->caption; ?>
					</div>
					<div class="photo">
						<img src="<?php echo $item->rightAsset(); ?>" class="modal-gallery-item" />
					</div>
				</div>
				<?php
			}
			else if ($item->type == 5)
			{
				?>
				<div class="photo-full">
					<div class="photo">
						<img style="width: <?php echo $item->size(); ?>%; min-width: <?php echo $item->size(); ?>%; margin-left: auto; margin-right: auto; position: relative; display: block;" src="<?php echo $item->leftAsset(); ?>" class="modal-gallery-item" />
					</div>
				</div>
				<?php
			}
			else if ($item->type == 6)
			{
				?>
				<style>
				.paragraph.item-<?php echo $item->id; ?> {
					font-size: <?php echo $item->fontSize; ?>px;
				}

				@media (max-width: 767px) {
					.paragraph.item-<?php echo $item->id; ?> {
						font-size: <?php echo ((int)$item->fontSize / 2); ?>px;
					}
				}
				</style>
				<div class="paragraph paragraph-full item-<?php echo $item->id; ?>">
					<div class="text">
						<?php echo $item->text; ?>
					</div>
				</div>
				<?php
			}
			else if ($item->type == 7)
			{
				?>
				<div class="video">
					<div class="frame">
						<video controls="" poster="<?php echo $item->leftAsset(); ?>" class="vjs-tech" src="<?php echo $item->videoMp4(); ?>" style="width: <?php echo $item->size(); ?>%; margin-left: auto; margin-right: auto; position: relative; display: block; height: 100%">
							<source src="<?php echo $item->videoMp4(); ?>" type="video/mp4">
							<source src="<?php echo $item->videoWebm(); ?>" type="video/webm">
						</video>
					</div>
				</div>
				<?php
			}
			else if ($item->type == 8)
			{
				$gallery = $case->gallery();

				if (count($gallery) > 0)
				{
					?>
					<div class="gallery">
						<div class="bxslider timer">
							<?php
							foreach ($gallery as $item)
							{
								?>
								<div class="slide"><img src="<?php echo $item->path(); ?>" class="modal-gallery-item"></div>
								<?php
							}
							?>
						</div>
					</div>
					<?php
				}
			}
			?><?php
		}
		?>
	</section>

	<footer>
		<div class="links">
			<?php
			$previous = $case->previous();
			$next = $case->next();
			?>
			<a href="<?php echo $previous ? $previous->url() : "#"; ?>" class="arrow prev" style="<?php echo $previous ? "" : "visibility: hidden;"; ?>">
				<?php
				if ($previous)
				{
					?>
					<span class="icon"></span>
					<span><?php echo $previous->client; ?></span>
					<?php
				}
				?>
				
			</a>
			<a href="<?php echo $next ? $next->url() : "#"; ?>" class="arrow next" style="<?php echo $next ? "" : "visibility: hidden;"; ?>">
				<?php
				if ($next)
				{
					?>

					<span><?php echo $next->client; ?></span>
					<span class="icon"></span>
					<?php
				}
				?>
			</a>
		</div>
	</footer>
<?php include("footer.php"); ?>
