<!doctype html>
<html lang="en-US cantouch">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		
		<base href="<?=Url::root()?>" />

		<title>Again</title>

		<meta name="google-site-verification" content="" />

		<!-- Facebook OpenGraph Tags -->
		<meta property="og:title" content="Again" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="<?php echo URL::full(); ?>" />
		<meta property="og:image" content="<?php echo URL::root() ?>img/thumb-facebook.png" />
		<meta property="og:description" content="" />
		<!-- -->

		<!-- Twitter Card -->
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:url" content="<?php echo URL::full(); ?>" />
		<meta name="twitter:title" content="Again" />
		<meta name="twitter:image" content="<?php echo URL::root() ?>img/thumb-facebook.png" />
		<meta name="twitter:description" content="" />
		<!-- -->

		<meta name="description" content="" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="author" content="Again"/>

		<link rel="icon" href="<?php echo URL::root() ?>img/favicon.ico" sizes="16x16 24x24 32x32 48x48 64x64" type="icon"/>
		<link rel="shortcut icon" href="<?php echo URL::root() ?>img/favicon.ico" sizes="16x16 24x24 32x32 48x48 64x64" type="icon"/>
		<!-- <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/touch-icon.png"/> -->

		<?php if(!Config::item('usedist')){ ?>
		<!-- build:css css/global.min.css -->
			<link href="css/stylesheet.css" rel="stylesheet">
			<link href="css/vendor/jquery.bxslider.css" rel="stylesheet">
			<link href="css/vendor/video-js.css" rel="stylesheet">
			<link href="css/global.css" rel="stylesheet">
		<!-- endbuild -->
		<?php } else { ?>
			<link href="<?php echo URL::to(Config::item('publicDist') . "css/global.min.css"); ?>" rel="stylesheet">
		<?php } ?>

		<!--[if lt IE 9]>
		<script src="js/vendor/html5shiv.min.js"></script>
		<script src="js/vendor/respond.min.js"></script>
		<![endif]-->

		<?php if (Request::isLocal()) {
			/*?>
			<style>
			.guide {
				pointer-events: none;
				position: absolute;
				left: 0;
				right: 0;
				top: 0;
				height: 5000px;
				background: transparent top center no-repeat;
				z-index: 999999;
				opacity: 0.7;
				margin-top: 40px;
			}

			.guide-index {
				height: 3940px;
				background-image: url('/img/tmp/guide-1.jpg');
			}

			.guide-case {
				height: 3852px;
				background-image: url('/img/tmp/guide-2.jpg');
			}

			.guide-all {
				height: 3924px;
				background-image: url('/img/tmp/guide-4.jpg');
			}

			.guide-culture {
				height: 3028px;
				background-image: url('/img/tmp/guide-6.jpg');
			}

			.guide-contact {
				height: 3214px;
				background-image: url('/img/tmp/guide-8.jpg');
			}
			</style>
			<script>
			setTimeout(function () {
				$(function () {
					$(".guide").data("shown", true);

					$(window).keydown(function (e) {
						var g = $(".guide");
						if (e.keyCode == 71)
						{
							if (g.data("shown"))
							{
								g.hide();
								g.data("shown", false);
							}
							else
							{
								g.show();
								g.data("shown", true);
							}
						}
					})
				});
			}, 200);
			</script>
			<?php*/
		}
		else
		{
			?>
			<style>
			.guide { display: none; }
			</style>
			<?php
		}
		?>
	</head>
	<body>
		<div class="menu-wrapper">
			<div class="menu-content">
				<ul class="sections">
					<li><a class="<?= SiteMenu::link("/", "selected"); ?>" <?= SiteMenu::link("/"); ?>>Home</a></li>
					<li><a class="<?= SiteMenu::link("work/", "selected"); ?>" <?= SiteMenu::link("work/"); ?>>Gallery</a></li>
					<li><a class="<?= SiteMenu::link("about/", "selected"); ?>" <?= SiteMenu::link("about/"); ?>>About</a></li>
					<li><a class="<?= SiteMenu::link("culture/", "selected"); ?>" <?= SiteMenu::link("culture/"); ?>>Culture</a></li>
				</ul>
				<div class="social">
					<?php
					$social = Social::all()->asArray(false);
					$social = array_reverse($social);
					foreach ($social as $item)
					{
						?><a href="<?php echo $item->url; ?>" target="_blank" class="<?php echo $item->network; ?>"><?php echo $item->network; ?></a><?php
					}
					?>
				</div>
				<div class="info">
					<p>34th Street 6th floor<br>
					Brooklyn NY 11232</p>
					<p><a href="mailto:info@againnewyork.com" target="_blank">info@againnewyork.com</a></p>
					<p>p: 718.249.7283</p>
				</div>
			</div>
		</div>
		<div class="menu-icon">
			<a href="">
				<span></span>
				<span></span>
				<span></span>
			</a>
		</div>
		<div class="site-wrapper">
			<header>
				<div class="clock">
					<canvas width="78" height="78"></canvas>
					<span>NY</span>
				</div>
				<div class="title">
					<p class="top">A Creative Corporation</p>
					<a <?= SiteMenu::link("/"); ?> class="logo <?= SiteMenu::link("/", "no-link"); ?>"><h1>, again.</h1></a>
					<p>Since<br>MMXIV,<br>New York City</p>
				</div>
			</header>