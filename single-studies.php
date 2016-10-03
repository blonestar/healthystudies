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

<div class="light-container-wrapper study-detail-bottom">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<span class="hs-icons hs-money"></span>
				<h4>Compensation</h4>
				<?php the_field('study_compensation') ?>
			</div>
			<div class="col-sm-3">
				<span class="hs-icons hs-people"></span>
				<h4>Needed</h4>
				<?php the_field('study_needed') ?>
			</div>
			<div class="col-sm-3">
				<span class="hs-icons hs-blue-calendar"></span>
				<h4>Dates</h4>
				<?php the_field('study_dates') ?>
			</div>
			<div class="col-sm-3">
				<span class="hs-icons hs-location"></span>
				<h4>Location</h4>
				<?php the_field('study_location') ?>
			</div>
		</div>
	</div>
</div>

<div class="gradient-container-wrapper back-to-studies">
  <div class="container">
    <a href="<?php echo site_url('current-studies'); ?>">Back to Studies <span class="fa fa-angle-down"></span></a>
  </div>
</div>

<?php if( have_rows('template_blocks', $page_id) ): ?>
		<?php get_template_blocks(get_the_ID()) ?>
<?php endif; ?>
	

<?php get_footer() ?> 