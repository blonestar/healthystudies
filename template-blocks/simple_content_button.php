<?php if (get_sub_field('style') == 'blue') { ?>
<div class="container-wrapper gradient-container-wrapper ">
	<div class="container">
		<?php the_sub_field('content') ?>
		<?php if (have_rows('buttons')) { ?>
		<div style="text-align: center;">
			<?php while(have_rows('buttons')) { the_row(); ?>
			<a class="btn btn-hollow btn-lg no-top-margin _gt" href="<?php the_sub_field('link_to') ?>" data-label="" data-category="" data-action=""><?php the_sub_field('label') ?></a>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
</div>
<?php } else if (get_sub_field('style') == 'darkgray') { ?>
<div style=" width: 100%;">
<div style="text-align:center;">
<div class="container-wrapper dark-container-wrapper ">
	<div class="container">
		<div class="container-xs">
			<div style="text-align: center;">
				<span class="hs-icons hs-mobile" style="color: rgb(255, 255, 255); text-align: center; background-color: rgb(31, 43, 53);">&nbsp;</span>
			</div>

			<h4 style="font-family: 'Gotham Narrow SSm A', 'Gotham Narrow SSm B', san-serif; color: rgb(255, 255, 255); text-align: center; background-color: rgb(31, 43, 53);">Study Notifications via Text</h4>
			<p style="color: rgb(255, 255, 255); text-align: center; background-color: rgb(31, 43, 53);">Text STUDY to 210-775-4900. You can also enter your mobile phone number and click &ldquo;submit.&rdquo;</p>
			<a href="CMSWebParts/HealthyStudies/#" id="p_lt_ctl05_pageplaceholder_p_lt_ctl05_SMSJoinModal_aModalButton" class="btn btn-default btn-lg btn-blue _gt" data-category="Home Page" data-action="Join Now SMS" data-label="Home Page - Join Now" data-toggle="modal" data-target=".join-sms">Join Now</a>
			
			<div class="modal fade join-sms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
							<h2>Study Notifications</h2>
						</div>
						<div class="modal-body">
							<!-- iframe -->
							<iframe src="https://api.mosio.com/par/c/optin/wctmb" name="tpraframe" height="450" width="320" marginheight="0" marginheight="0" allowtransparency="yes" frameborder="0" scrolling="no"></iframe>
						</div>
					</div>
				</div>
			</div>
		
		</div>
	</div>
</div>
</div>
</div>
<?php } ?>
