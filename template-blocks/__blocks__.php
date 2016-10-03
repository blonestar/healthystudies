<?php

function get_template_blocks($page_id) {
	
	if( have_rows('template_blocks', $page_id) ):

		while ( have_rows('template_blocks', $page_id) ) : the_row();

			if (get_row_layout() == "template_block") {

				$templ = get_sub_field('template_block' );
				
				// recursive
				get_template_blocks($templ->ID);
				
			} else {
				
				include (get_row_layout() . ".php");
				
			}
			
		endwhile;

	endif;

}
