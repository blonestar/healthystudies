<div class="container-wrapper standard-container-wrapper how-it-works-callout">
	<div class="container">
		<div class="row">
			<h2 class="h1" style="text-align: center;"><?php the_sub_field('title') ?></h2>
		</div>
		<div class="row">
			<div>
				<?php 
				
					$posts = get_sub_field('boxes');
					foreach($posts as $post) {
						//$img = get_field('image', $post->ID);
						//print_r($post);
				?>
					<div class="col-sm-3 ">
					<?php //$img = get_sub_field('image');
					//print_r($img);
					?>
					<?php echo wp_get_attachment_image($post['image'], array(234, 329))  ?>
						<h5><?php echo $post['title'] ?></h5>
						<?php echo $post['text'] ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="row">
			<div style="text-align: center;">
				<a class="btn btn-default btn-lg _gt" data-action="Learn More" data-category="Home Page" data-label="How It Works - Learn More" href="/how-it-works/">Learn More</a>
			</div>
		</div>
	</div>
</div>