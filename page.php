<?php get_header() ?>
<?php the_post() ?>

<div class="container-wrapper standard-container-wrapper ">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<?php the_content() ?>
			</div>
		</div>
	</div>
</div>
	
<?php if( have_rows('template_blocks') ): ?>
	<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>

<?php get_footer() ?> 
