<?php get_header() ?>
<?php the_post() ?>


<div class="standard-container-wrapper study-detail">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h1><?php the_title() ?></h1>
        <?php the_content() ?>      
      </div>
      <div class="col-md-3 study-cta">
          <span class="hs-icons hs-notepad"></span>
        <h3>Interested in Joining this Study?</h3>
        <a class="btn btn-sm btn-default" href="<?php echo site_url('join-a-study?id=97'); ?>">Apply Now</a>
      </div>
    </div>
  </div>
</div>
<?php if (have_rows('study_details')) { ?>
<div class="light-container-wrapper study-detail-bottom">
	<div class="container">
		<div class="row">
			<?php while(have_rows('study_details')) { the_row(); ?>
			<div class="col-sm-3">
				<span class="<?php the_sub_field('icon_class') ?>"></span>
				<h4><?php the_sub_field('label') ?></h4>
				<?php the_sub_field('content') ?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>

<div class="gradient-container-wrapper back-to-studies">
  <div class="container">
    <a href="<?php echo site_url('current-studies'); ?>">Back to Studies <span class="fa fa-angle-down"></span></a>
  </div>
</div>

<?php if( have_rows('template_blocks', $page_id) ): ?>
		<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>
	

<?php get_footer() ?> 