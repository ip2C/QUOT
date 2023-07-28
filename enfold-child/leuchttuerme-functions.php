<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * This file is only loaded when the singular
 * Version  1.2.1
 * if ( is_singular( array('leuchttuerme') )  {}
 * 
 * */






// https://kriesi.at/documentation/enfold/hooks-and-filters/
/*	ava_main_header
	ava_main_header_sidebar
	ava_after_main_title
	ava_before_bottom_main_menu
	ava_inside_main_menu
	ava_after_main_menu
	ava_after_main_container
	ava_after_content
	ava_add_custom_default_sidebars
	ava_frontend_search_form
	ava_search_after_get_header
	ava_before_footer
	ava_mailchimp_contact_form_elements
*/


/* _________________  Leuchttuerme Virtuelles Kulturkaus   Function  ________________ */

/* _______________________________________________________________________  
     leuchttuerme_vk_navi  Navigation on the Top of Leuchttuerme
	 
	 taxonomy = lt_virtuelles_kulturhaus 
	 post_type = leuchttuerme
   _______________________________________________________________________  
*/
function  leuchttuerme_vk_navi( )  {  
	
	// if ( is_singular( array('leuchttuerme') )  ){ 
	
	// hier wird der toggle umrandet und die Headline gesetzt
	// 
		echo" 
		<div class='container av-section-cont-open  leuchttuerme_headernav'>
			<div class='flex_column av_one_third  avia-builder-el-0  el_before_av_two_third  avia-builder-el-first  first flex_column_div '>
			<section class='av_textblock_section' itemscope='itemscope' itemtype='https://schema.org/CreativeWork'><div class='avia_textblock megrim' itemprop='text'>
			<a class=' ' href='/vertiefungen/virtuelles-kulturhaus/' style='text-decoration:none'><h2>Virtuelles Kulturhaus</h2>
			</div></section></div><div class='flex_column av_two_third  avia-builder-el-2  el_after_av_one_third  el_before_av_one_half  flex_column_div '>
			<div class='avia-buttonrow-wrap avia-buttonrow-right  avia-builder-el-3  avia-builder-el-no-sibling  megrim'> 
		";
		//					
	   // Get the current post ID
		$post_ID = get_the_ID();

		// Get the current term ID for the post
		$current_term_id = wp_get_post_terms( $post_ID, 'lt_virtuelles_kulturhaus', array( 'fields' => 'ids' ) );
		
		// Get all terms for the taxonomy
		$terms = get_terms( 'lt_virtuelles_kulturhaus', array(
			'hide_empty' => false,
		) );
		
		// Output the terms as a navigation
		if ( $terms ) {
			// echo $term->ID;
			
			foreach ( $terms as $term ) {
				$class = '';
				if ( is_array( $current_term_id ) && in_array( $term->term_id, $current_term_id ) ) {
					$class = 'active';
										
				} // END if current term
 				echo '<a class=" ' . $class .  ' avia-button avia-icon_select-yes-left-icon avia-size-small av-button-notext 
				avia-color-theme-color" href="' . get_term_link( $term ) . '">' . esc_html( $term->name ) . '</a>
												
			  ';
			} // END foreach
		} // END if terms
	
		echo "
			 <a href='' class='lt_popup avia-button  avia-icon_select-yes-left-icon avia-size-small av-button-notext avia-color-theme-color'>
						<span class=' avia_button_icon avia_button_icon_left ' aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'></span>
					<span class='avia_iconbox_title'></span>
				</a>
			</div>
		</div><!-- End Navigation area-->
	</div><!-- End wrapper-->
		";
	// } //END if singular
	
} // End function
add_action( 'ava_after_main_container', 'leuchttuerme_vk_navi' );
///////////////////////////  https://kriesi.at/documentation/enfold/hooks-and-filters/



/* ----------------------------------------------------------------------
 			leuchttuerme_postnavigation < pref and next posts >
   _______________________________________________________________________  
*/
// 
function  leuchttuerme_postnav( )  {   
			/*
			 * here we check the previous and next post in term
			 * previous_post_link('%link', ' name ', $in_same_term = true, $excluded_terms = '', $taxonomy = 'taxonomy_name') ;
			*/
			echo  "  <div class='post-links'><div class='pref'> ";
			echo  	previous_post_link('%link', '', $in_same_term = true, $excluded_terms = '', $taxonomy = 'lt_virtuelles_kulturhaus') ;
		    echo  "  </div> <div class='next'>";
			echo  	next_post_link('%link', '', $in_same_term = true, $excluded_terms = '', $taxonomy = 'lt_virtuelles_kulturhaus')  ;
			echo  "  </div></div> ";
			
			// END the Navigation
		
		// } // END if $leuchttuerme->have_posts();			 
} // END leuchttuerme_postnav
//
add_action( 'ava_before_footer', 'leuchttuerme_postnav' );


/* _______________________________________________________________________  
 
 		leuchtturm_masonry  on the bottom we have a masonry gallery
   _______________________________________________________________________  
*/

function  leuchttuerme_masonry( )  {  
	
	 // Initialize the active term ID as null
    $active_term_id = null;

    // Get the current term ID for the post
    $current_term_id = wp_get_post_terms(get_the_ID(), 'lt_virtuelles_kulturhaus', array('fields' => 'ids'));

    // Output the terms as navigation
    if ($terms = get_terms('lt_virtuelles_kulturhaus', array('hide_empty' => false))) {
        foreach ($terms as $term) {
            if (is_array($current_term_id) && in_array($term->term_id, $current_term_id)) {
                // Store the ID of the active term
                $active_term_id = $term->term_id; 
				$active_term_name = $term->name; 
            }
        } // END  foreach
    } // END terms

    // Return the active term ID
    // echo $active_term_id;
	
	
echo 
	do_shortcode( "
		[av_section min_height='' min_height_pc='25' min_height_px='500px' shadow='no-border-styling' bottom_border='no-border-styling' padding='' margin='' color='footer_color' background='bg_color' custom_bg=''  position='top left' repeat='no-repeat'overlay_opacity='0.5' overlay_color='' overlay_pattern='' overlay_custom_pattern='' custom_arrow_bg='' size-btn-text='' av-desktop-font-size-btn-text='' av-medium-font-size-btn-text='' av-small-font-size-btn-text='' av-mini-font-size-btn-text='' fold_timer='' z_index_fold='' css_position_z_index='' av-desktop-css_position_z_index='' av-medium-css_position_z_index='' av-small-css_position_z_index='' av-mini-css_position_z_index='' id='' custom_class='' template_class='' aria_label='' element_template='' one_element_template='' av_element_hidden_in_editor='1' sc_version='1.0'] 
		
		 <span class='floatleft' style='margin-bottom:18px'>
			<h5 style='margin-top:0px'><em>WEITERE ANGEBOTE AUS DEM THEMENBEREICH</em></h5>
			<h2><span style='color:#fff; margin-bottom:30px'> " . $active_term_name ."</span></h2>
			
		</span> 
			 <a href='' class='lt_popup avia-button  avia-icon_select-yes-left-icon avia-size-small av-button-notext floatright'  style='background-color:transparent; box-shadow:none; border:none; font-size: 18px;'>
						 Alle anzeigen &nbsp;<span class=' avia_button_icon avia_button_icon_left ' aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'></span>
					<span class='avia_iconbox_title'></span>
				</a> 

		[av_masonry_entries link='lt_virtuelles_kulturhaus,".$active_term_id."' wc_prod_visible='' wc_prod_hidden='hide' wc_prod_featured='' prod_order_by='' prod_order='' date_filter='' date_filter_start='' date_filter_end='' date_filter_format='yy/mm/dd' period_filter_unit_1='1' period_filter_unit_2='year' sort='no' query_orderby='menu_order' query_order='ASC' caption_elements='title' caption_styling='overlay' caption_display='always' size='fixed' orientation='av-orientation-square' image_size='masonry' gap='no' columns='6' av-desktop-columns='' av-medium-columns='3' av-small-columns='2' av-mini-columns='2' items='-1' paginate='load_more' color='custom' custom_bg='' animation='active' animation_duration='' animation_custom_bg_color='' animation_custom_bg_color_multi_list='' animation_z_index_curtain='100' overlay_fx='grayscale' img_scrset='' lazy_loading='enabled' id='' custom_class='' template_class='' av_uid='av-lg9t7w89' sc_version='1.0']		

		[/av_section]

")// END do_shortcode
; // END echo
   				
		
echo  "   
	
";
			
} // END leuchtturm_masonry
//
//  
add_action( 'ava_before_footer', 'leuchttuerme_masonry' );
/* _______________________________________________________________________  
 
 			leuchttuerme custom popup in the footer
   _______________________________________________________________________  
*/

 function do_shortcode_masonry() {
    ob_start(); // Start output buffering to capture the shortcode content

    // Render the shortcode and capture the output
     echo do_shortcode("[av_masonry_entries link='lt_virtuelles_kulturhaus,636,635,633,638,637,634' term_rel='' wc_prod_visible='' wc_prod_hidden='hide' wc_prod_featured='' prod_order_by='' prod_order='' date_filter='' date_filter_start='' date_filter_end='' date_filter_format='yy/mm/dd' period_filter_unit_1='1' period_filter_unit_2='year' page_element_filter='' sort='yes-tax' query_orderby='menu_order' query_order='ASC' caption_elements='title' caption_styling='overlay' caption_display='always' img_copyright='right' size='fixed' orientation='av-orientation-square' image_size='masonry' gap='no' columns='5' av-desktop-columns='' av-medium-columns='3' av-small-columns='2' av-mini-columns='2' items='-1' paginate='load_more' color='custom' custom_bg='transparent' img_copyright_font='' av-desktop-font-img_copyright_font='' av-medium-font-img_copyright_font='' av-small-font-img_copyright_font='' av-mini-font-img_copyright_font='' img_copyright_color='' img_copyright_bg='' animation='' animation_duration='' animation_custom_bg_color='' animation_custom_bg_color_multi_list='' animation_z_index_curtain='100' overlay_fx='grayscale' img_scrset='' lazy_loading='disabled' alb_description='' id='lt_masonry_gallerie' custom_class='' sc_version='1.0']");
	 
    $output = ob_get_clean(); // Get the captured output

    // Return the shortcode output
    echo $output;
}
add_action('ava_before_footer', 'do_shortcode_masonry', 9);


function footer_script_lt() {
    	?>
         <script>
             jQuery(document).ready( function ($) {

                 // 2023 - Added for Lightbox more_text
                 $('#more_btn').click(function () {
                     if ($('#extra_text').is(':visible')) {
                         jQuery(this).text("Weiter lesen ...");
                     }
                     if ($('#extra_text').is(':hidden')) {
                         jQuery(this).text('... Text ausblenden');
                     }
                     $('#extra_text').slideToggle('slow');
                     return false;
                 });
             }); // END JQuery Doc ready

			jQuery(document).one('mousedown', '.lt_popup', function() {
				
				var $source = jQuery('#lt_masonry_gallerie');
				var $destination = jQuery('.lt_shortcode_output');
				
				jQuery($source).prependTo($destination);
				jQuery($source).show();
	 			//jQuery("#lt_masonry_gallerie").prependTo('.lt_shortcode_output')
				
			});
        </script>
        <?php
}

// Hook the popmake_custom function to run when the wp_footer action is fired
add_action('wp_footer', 'footer_script_lt', 999);





