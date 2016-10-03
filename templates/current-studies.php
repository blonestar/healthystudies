<?php
/*
 * Template name: Current Studies
 */
?><?php get_header() ?>
<?php the_post() ?>

<div class="container-wrapper light-container-wrapper ">
	<div class="container">
		<?php the_content() ?>

		<div class="container-wrapper light-container-wrapper ">
			<div class="container">

				<?php
					$query = new WP_Query(array(
										'post_type'			=> 'studies',
										'posts_per_page'	=> -1,
										'meta_key'			=> 'study_active',
										'meta_value'		=> '1'
									));
					while($query->have_posts()) {
						$query->the_post();
				?>
				<div class="col-sm-4 study-wrap">
					<div class="current-study">
						<h2><?php the_title() ?></h2>
						
						<div class="study-summary"><?php if (has_excerpt()) the_excerpt() ?></div>
						
						<div class="study-info">
							<span class="text-left">Compensation</span>
							<span class="text-right"><?php the_field('study_compensation') ?></span>
						</div>
						<div class="study-info">
							<span class="text-left">Needed</span>
							<span class="text-right"><?php the_field('study_needed') ?></span>
						</div>
						<div class="study-info">
							<span class="text-left">Dates</span>
							<span class="text-right"><?php the_field('study_dates') ?></span>
						</div>
						<div class="study-info">
							<span class="text-left">Location</span>
							<span class="text-right"><?php the_field('study_location') ?></span>
						</div>
							
						<div class="study-btns">
							<a href="<?php the_permalink() ?>" class="btn btn-small btn-default block">View Details</a>
							<a href="<?php echo site_url('join-a-study') . '?id=' . get_the_ID() . '#sign-up-study'; ?>" class="btn btn-small btn-default block study-sign-up">Sign Up</a>
						</div>

					</div>
				</div>
				<?php } ?>


			</div>
		</div>
	</div>
</div>
	
<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?> 