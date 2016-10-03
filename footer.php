<?php //get_template_blocks(get_field('footer_template_block', 'option')) ?>

	</div><!-- main content end -->



	<footer class="footer">
		<div class="container">
    		<?php
				wp_nav_menu( array(
					'theme_location' => 'footer-menu',
					//'menu' => 'Top Menu',
					'menu_class' => 'upper-footer-nav',
					'container' => '',
					//'container_class' => 'top-nav-zone',
					'fallback_cb'    => false
				) );
			?>

			<ul class="lower-footer-nav">
				<li>
					<span>&copy; Worldwide Clinical Trials 2016</span>
				</li>
				<li>
					<a href="<?php echo site_url('privacy-statement') ?>" >Privacy Statement</a>
				</li>
			</ul>

		</div>
	</footer>

<?php wp_footer() ?>

</body>
</html>