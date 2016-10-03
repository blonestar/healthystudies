<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
<header class="header">
	<div class="container">
		<div class="row">
			<div class="col-xs-4 col-sm-3 logo-zone-wrapper">
				<a href="<?php echo home_url() ?>" class="logo">
					<?php

						$args = array(
						   'post_type' => 'attachment',
						   'numberposts' => 1,
						   'post_status' => null,
						   'include' => get_field('logo', 'option'),
						   'orderby' => 'menu_order',
						   'order' => 'ASC',
						  );

						$logo_attachment = get_posts( $args );
					?>
					<?php echo wp_get_attachment_image($logo_attachment[0]->ID, array('', ''), false, array('title' => apply_filters('the_title', $logo_attachment[0]->post_title) )) ?>
				</a>
			</div>
			<div class="col-xs-8 col-sm-9 nav-zones-wrapper">
				<div class="nav-icon fa fa-bars"></div>
				<div class="top-nav-zone">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'top-menu',
						//'menu' => 'Top Menu',
						'menu_class' => 'top-nav',
						'container' => '',
						//'container_class' => 'top-nav-zone',
						'walker'	=> new Walker_healthystudies_Menu(),
						'fallback_cb'    => false
					) );
				?>
				</div>
				<div class="primary-nav-zone">
					<div class="nav-extras"><a href="tel:2106351515" class="btn btn-default btn-sm call-us">
							<span class="fa fa-phone"></span>
							210 - 635 - 1515
						</a>
					</div>
					<div class="header-search">
						<span class="fa fa-times search-close"></span>
						<div id="p_lt_ctl03_SmartSearchBox_pnlSearch" class="searchBox" onkeypress="javascript:return WebForm_FireDefaultButton(event, &#39;p_lt_ctl03_SmartSearchBox_btnSearch&#39;)">

							<label for="p_lt_ctl03_SmartSearchBox_txtWord" id="p_lt_ctl03_SmartSearchBox_lblSearch" style="display:none;">Search for:</label>
							<input type="hidden" name="p$lt$ctl03$SmartSearchBox$txtWord_exWatermark_ClientState" id="p_lt_ctl03_SmartSearchBox_txtWord_exWatermark_ClientState" /><input name="p$lt$ctl03$SmartSearchBox$txtWord" type="text" maxlength="1000" id="p_lt_ctl03_SmartSearchBox_txtWord" class="form-control" />
							<input type="submit" name="p$lt$ctl03$SmartSearchBox$btnSearch" value="Search" id="p_lt_ctl03_SmartSearchBox_btnSearch" class="btn btn-default" />

							<div id="p_lt_ctl03_SmartSearchBox_pnlPredictiveResultsHolder" class="predictiveSearchHolder">

							</div>

						</div>
					</div>
					<?php
						wp_nav_menu( array(
							'theme_location' => 'main-menu',
							//'menu' => 'Main Menu',
							'container' => 'nav',
							'container_class' => 'primary-nav',
							'walker' => new Walker_healthystudies_Menu()
							
						) );
						wp_nav_menu( array(
							'theme_location' => 'mobile-menu',
							//'menu' => 'Mobile Menu',
							'container' => 'nav',
							'container_class' => 'mobile-nav',
							'walker' => new Walker_healthystudies_Menu(),
							'fallback_cb'    => false
							
						) );
					?>
				</div>
			</div>
		</div>
	</div>

</header>

<div class="main-content">

	<?php 

	$hero_type = get_field('hero_type');

	if ($hero_type != 'without' && !is_null($hero_type)) {
		$hero_image = get_field('hero_image');
		$hero_image_mobile = $hero_image;
		if (get_field('hero_image_mobile'))
			$hero_image_mobile = get_field('hero_image_mobile');
	?>
	<div id="divHero" class="hero-image-webpart has-mobile-img<?php echo ($hero_type=='image') ? ' image-only' : ''; echo (get_field('hero_dark_image')) ? ' dark-image' : ''; ?>" style="background-color:transparent">
		
		<div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_HeroImageWithContent_divImg" class="img-bg" style="background-image:url(<?php echo $hero_image['url'] ?>);background-repeat:no-repeat;"></div>
		<div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_HeroImageWithContent_divMobileImg" class="img-bg mobile-img-bg" style="background-image:url(<?php echo $hero_image_mobile['url'] ?>);background-repeat:no-repeat;"></div>
		<?php if (get_field('hero_text')) { ?>
		<div class="container">
			<div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_HeroImageWithContent_divContentRow" class="row hero-content textInMiddle">
				<div class="col-xs-10 col-xs-push-1">
					<div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_HeroImageWithContent_divCopy" class=" centerText" style="width:60%;">
						<?php the_field('hero_text') ?>
						<?php if (strpos($hero_type,'btn') !== false) { ?>
							<?php while(have_rows('hero_buttons')) { the_row() ?>
								<a class="btn btn-hollow btn-lg _gt" href="<?php echo get_sub_field('url') ?>"><?php echo get_sub_field('label') ?></a> &nbsp;
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if (strpos($hero_type,'scroll') !== false) { ?>
		<div id="p_lt_ctl05_pageplaceholder_p_lt_ctl00_HeroImageWithContent_divDownArrow" class="down-arrow"><?php if (get_field('hero_scroll_label')) { ?><span class="scroll-text"><?php echo get_field('hero_scroll_label') ?></span><?php } ?><span class="icon-down-arrow"></span></div>
		<?php } ?>
	</div>

	<?php } ?>
