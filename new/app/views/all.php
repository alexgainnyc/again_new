<?php include("header.php");

// $info = Cases::publicAssets();
$info = Assets::publicAssets();
?>
	<div class="guide guide-all"></div>
	<section class="all">
		<div class="tags">
			<div class="center">
				<ul>
					<li style="display: none;" class="view-all"><a href="#">View All</a></li>
					<?php
					foreach ($info["tags"] as $tag)
					{
						?><li><a href="#<?php echo $tag["id"]; ?>"><?php echo $tag["name"]; ?></a></li><?php
					}
					?>
				</ul>
			</div>
		</div>
		<div class="sizer"></div>
		<?php
		$i = 0;
		foreach ($info["assets"] as $asset)
		{
			$classes = array();

			foreach ($asset->tags() as $tag)
			{
				$classes[] = "tag-" . $tag->id;
			}

			?>
			<?php /*echo $info["cases"][$asset->id]->url();*/ ?>
			<a class="item <?php echo implode(" ", $classes); ?> modal-gallery-item-all" href="<?php echo $asset->path(); ?>" target="_blank">
				<div class="frame"><img class='loading' src='img/loading-small.gif' /><img class="img lazy" data-original="<?php echo $asset->path(); ?>" /></div>
			</a>
			<?php
			$i++;
		}
		?>
	</section>

	<footer>
		<div class="links">
			<!-- <a href="#">LOAD MORE</a> -->
		</div>
	</footer>
<?php include("footer.php"); ?>
