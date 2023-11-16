<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



// Get the current post ID
$post_ID = get_the_ID();

// Get all terms (categories) associated with the current post
$terms = get_the_terms($post_ID, 'lt_virtuelles_kulturhaus');

if (is_singular('leuchttuerme') && is_array($terms)) {
    // Get the first term in the array
    $first_term = reset($terms);

    // Get the term name and ID
    $term_name = $first_term->name;
    $term_ID = $first_term->term_id;

    // Output all categories for debugging
    $current_categories = wp_list_pluck($terms, 'name');
   // echo 'All Categories for the Post: ' . implode(', ', $current_categories) . '<br>';

    // Check if the "c_termname" cookie exists
    $cookie_term_name = $_COOKIE['c_termname'];
   // echo "Cookie Term Name: " . $cookie_term_name . '<br>';

    // Check if the "c_termID" cookie exists
    $cookie_term_ID = $_COOKIE['c_termID'];
   // echo "Cookie Term ID: " . $cookie_term_ID . '<br>';

    // Check if the term name from the cookie is not in the current categories
    if (!in_array($cookie_term_name, $current_categories) ) {
        echo "Not in Array: " . $cookie_term_name . '<br>';

        // Set the "c_termname" and "c_termID" cookies to the values of the first term
        setcookie('c_termname', $term_name, 0, '/', 'qualitaetsoffensive-teilhabe.de');
        setcookie('c_termID', $term_ID, 0, '/', 'qualitaetsoffensive-teilhabe.de');

       echo "// Cookie : " . $_COOKIE['c_termname'] . '<br>';

    }
}






/*  Check the Cookies and display
 */ 
/*
if (isset($_COOKIE['c_termname'])) {
    $term_name_f_cookie = $_COOKIE['c_termname'];
    $term_ID_f_cookie = $_COOKIE['c_termID'];
    // Use $term_name in your other functions
    echo "// Cookie : " . $term_name_f_cookie;
    echo "// Cookie ID : " . $term_ID_f_cookie;
}
*/
/*
*/

/*

error_reporting(E_ALL);
ini_set('display_errors', 1);

*/


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

/* ______________________________________________________________________________________
        leuchttuerme_vk_navi  Navigation on the Top of Leuchttuerme
	    taxonomy = lt_virtuelles_kulturhaus
	    post_type = leuchttuerme
   ______________________________________________________________________________________
*/
function  leuchttuerme_vk_navi( )  {  

	// hier wird der toggle umrandet und die Headline gesetzt
	// 
		echo" 
		<div class='container av-section-cont-open  leuchttuerme_headernav'>
			<div class='flex_column av_one_half avia-builder-el-0  avia-builder-el-first  first flex_column_div '>
			<section class='av_textblock_section' itemscope='itemscope' itemtype='https://schema.org/CreativeWork'><div class='avia_textblock megrim' itemprop='text'>
			<a class=' ' href='/vertiefungen/virtuelles-kulturhaus/' style='text-decoration:none'><h2> ". __('Virtuelles Kulturhaus', 'A_translate') . "</h2>
			</div></section></div><div class='flex_column av_one_half  avia-builder-el-2  el_after_av_one_third  el_before_av_one_half  flex_column_div '>
			<div class='avia-buttonrow-wrap avia-buttonrow-right  avia-builder-el-3  avia-builder-el-no-sibling  megrim'> 
		";
		//					
	    // Get the current post ID
		$post_ID = get_the_ID();

		// Get the current term ID for the post
        $current_term_id = wp_get_post_terms( $post_ID, 'lt_virtuelles_kulturhaus', array( 'fields' => 'ids' ) );

		// Output the terms as a navigation
        //
        //  case  SINGLE
         if ( is_singular(array('leuchttuerme') ) ) {

            // Get all terms for the taxonomy
            $terms = get_terms('lt_virtuelles_kulturhaus', array('hide_empty' => false));

            // Check if the cookie is set and get its value
            $cookie_name = 'c_termname'; // Change to your cookie name
            $cookie_value = isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : '';

           // echo $cookie_value;

            if ($terms) {
                foreach ($terms as $term) {
                    $class = '';

                   // Check if the cookie value matches the term name
                    if ($cookie_value == $term->name) { // Use '==' for loose comparison
                        $class = 'active';
                    }

                    // Add an id attribute with the term ID to the anchor element
                    echo '<a id="term-' . $term->term_id . '" class="' . $class . ' avia-button avia-icon_select-yes-left-icon avia-size-small av-button-notext avia-color-theme-color" href="' . get_term_link($term) . '">' . $term->name . '</a> ';
                }
            } // END if terms
        } // END if singular
        //
        //  case  ARCHIVE
        if (is_archive() && get_post_type() == "leuchttuerme") {
            // Check if we are on an archive page for the taxonomy "lt_virtuelles_kulturhaus"
            if (is_tax('lt_virtuelles_kulturhaus')) {
                // Get the current term object
                $current_term = get_queried_object();

                // Get all terms for the taxonomy
                $terms = get_terms('lt_virtuelles_kulturhaus', array('hide_empty' => false));
                // Output the terms as navigation
                if ($terms) {
                    foreach ($terms as $term) {
                        $class = ($current_term && $current_term->term_id === $term->term_id) ? 'active' : '';
                        echo '<a class="' . $class . ' avia-button avia-icon_select-yes-left-icon avia-size-small av-button-notext avia-color-theme-color" href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                        } // END foreach
                    } // END if term
                } // END if is tax
        } // END if archive

		echo "
			 <a href='' class='lt_popup avia-button  avia-icon_select-yes-left-icon avia-size-small av-button-notext avia-color-theme-color'>
						<span class=' avia_button_icon avia_button_icon_left ' aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'></span>
					<span class='avia_iconbox_title'></span>
				</a>
			</div>
		</div><!-- End Navigation area-->
	</div><!-- End wrapper-->
		";
} // End function
add_action( 'ava_after_main_container', 'leuchttuerme_vk_navi' );
///////////////////////////  https://kriesi.at/documentation/enfold/hooks-and-filters/
















/* ------------------------------------------------------------------------------------
 		    	leuchttuerme_postnavigation < pref and next posts >
   _____________________________________________________________________________________
*/
if ( !is_archive() ):
    //
    function leuchttuerme_postnav(){
        // Check if the cookie for term ID is set and get its value
        $cookie_name = 'c_termID'; // Change to your cookie name for term ID
        $term_ID_f_cookie = isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : '';

        // Get the current post
        global $post;

        // Get the terms for the current post
        $terms = get_the_terms($post->ID, 'lt_virtuelles_kulturhaus');

        if (isset($term_ID_f_cookie) && !empty($term_ID_f_cookie)) {
            // Use the term ID from the cookie to navigate posts
            $term_id_to_use = $term_ID_f_cookie;
        } elseif ($terms) {
            // Use the term ID from the current post's terms if the cookie is not set
            $term_id_to_use = $terms[0]->term_id;
        } else {
            // Default to a fallback term ID or handle this case as needed
            $term_id_to_use = 0; // Change this to your desired fallback behavior
        }

        // Get the posts based on the selected term ID
        $args = array(
            'post_type' => 'leuchttuerme', // Replace with your post type
            'posts_per_page' => -1, // Retrieve all posts
            'tax_query' => array(
                array(
                    'taxonomy' => 'lt_virtuelles_kulturhaus',
                    'field' => 'id',
                    'terms' => $term_id_to_use, // Use the selected term ID
                ),
            ),
        );

        $posts_query = new WP_Query($args);

        // Find the current post's position in the posts array
        $current_post_index = array_search($post->ID, wp_list_pluck($posts_query->posts, 'ID'));

        // Output navigation links based on the retrieved posts
        echo '<div class="post-links"><div class="prev">';

        $prev_post = isset($posts_query->posts[$current_post_index - 1]) ? $posts_query->posts[$current_post_index - 1] : null;
        if ($prev_post) {
            echo '<a href="' . get_permalink($prev_post) . '"></a>';
        }

        echo '</div> <div class="next">';

        $next_post = isset($posts_query->posts[$current_post_index + 1]) ? $posts_query->posts[$current_post_index + 1] : null;
        if ($next_post) {
            echo '<a href="' . get_permalink($next_post) . '"></a>';
        }

        echo '</div></div>';
    }

    // Add the function to the appropriate action hook
    add_action('ava_before_footer', 'leuchttuerme_postnav', 9);

endif;














/* _______________________________________________________________________

 		leuchtturm_masonry on the bottom we have a masonry gallery
   _______________________________________________________________________  
*/

if ( !is_archive() ):
        function  leuchttuerme_masonry( )  {


        if (isset($_COOKIE['c_termname'])) {
            $term_name_f_cookie = $_COOKIE['c_termname'];
            $term_ID_f_cookie = $_COOKIE['c_termID']; 
        } // END if	


       echo
            do_shortcode( "
                [av_section min_height='' min_height_pc='25' min_height_px='500px' shadow='no-border-styling' bottom_border='no-border-styling' padding='' margin='' color='footer_color' background='bg_color' custom_bg=''  position='top left' repeat='no-repeat'overlay_opacity='0.5' overlay_color='' overlay_pattern='' av-small-css_position_z_index='' av-mini-css_position_z_index='' id='lt_footer_masonry' custom_class='' template_class='' aria_label='' element_template='' one_element_template='' av_element_hidden_in_editor='1' sc_version='1.0'] 
                
                 <span class='floatleft' style='margin-bottom:18px'> 
                    <h2><span style='color:#fff; margin-bottom:30px'> " .$term_name_f_cookie."  </span></h2>
                    
                </span> 
                     <a href='' class='lt_popup avia-button  avia-icon_select-yes-left-icon avia-size-small av-button-notext floatright'  style='background-color:transparent; box-shadow:none; border:none; font-size: 18px;'>
                                 Alle anzeigen &nbsp;<span class=' avia_button_icon avia_button_icon_left ' aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'></span>
                            <span class='avia_iconbox_title'></span>
                        </a> 
        
                [av_masonry_entries link='lt_virtuelles_kulturhaus,".$term_ID_f_cookie."' wc_prod_visible='' wc_prod_hidden='hide'  wc_prod_featured='' prod_order_by='' prod_order='' date_filter='' date_filter_start='' date_filter_end='' date_filter_format='yy/mm/dd' period_filter_unit_1='1' period_filter_unit_2='year' sort='no' query_orderby='menu_order' query_order='ASC' caption_elements='title' caption_styling='overlay' caption_display='always' size='fixed' orientation='av-orientation-square' image_size='masonry' gap='no' columns='6' av-desktop-columns='' av-medium-columns='3' av-small-columns='2' av-mini-columns='2' items='-1' paginate='load_more' color='custom' custom_bg='' animation='active' animation_duration='' animation_custom_bg_color='' animation_custom_bg_color_multi_list='' animation_z_index_curtain='100' overlay_fx='grayscale' img_scrset='' lazy_loading='enabled' id='' custom_class='' template_class='' av_uid='av-lg9t7w89' sc_version='1.0']		
        
                [/av_section]
        
            ")// END do_shortcode
        ; // END echo

        }// END leuchtturm_masonry
        //
        add_action( 'ava_before_footer', 'leuchttuerme_masonry' , 9  );

endif;
















/* _______________________________________________________________________________________

 			leuchttuerme custom popup in the footer  for archive and fo single
   ____________________________________________________________________________________
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

			});
        </script>
        <?php
}

// Hook the popmake_custom function to run when the wp_footer action is fired
add_action('wp_footer', 'footer_script_lt', 9);






