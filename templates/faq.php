<?php
/*
 * Template name: FAQ
 */
?><?php get_header() ?>
<?php the_post() ?>

<div class="container-wrapper standard-container-wrapper ">
	<div class="container">

		<?php the_content() ?>

		<?php
			$query = new WP_Query(array(
								'post_type'			=> 'faq',
								'posts_per_page'	=> -1,
								'orderby'			=> 'menu_order',
								'order'				=> 'asc'
							));
							
			if ($query->have_posts()) {
		?>
			<ul class="accordian">	
				<?php while($query->have_posts()) { $query->the_post(); ?>
				<li>
					<span class="icon icon-plus"></span>
					<h3 class="accordian-header"><?php the_title() ?></h3>
					<div class="accordian-content">
						<?php the_content() ?>
					</div>
				</li>
				<?php } ?>
			</ul>
		<?php } ?>
		<?php wp_reset_query(); ?>

	</div>
</div>
	
<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?> 