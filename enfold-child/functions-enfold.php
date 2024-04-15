<?php
/*
 * Functions for Enfold
 * Version 1.0
 * Author: R.Ehm
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



/*
RE  2021 01                Image Generation
---------------------------------------------------------------------------------------   ENFOLD und Base */
function remove_default_image_sizes( $sizes) {
    unset( $sizes['thumbnail']);
    unset( $sizes['medium']);
    unset( $sizes['large']);

    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'remove_default_image_sizes');


function image_generation_0_killsit() {
    //
    add_image_size( 'magazine', 0, 0 );	remove_image_size('magazine');
    add_image_size( 'widget', 0, 0 );	remove_image_size('widget');
    add_image_size( 'gallery', 0, 0 );   remove_image_size('gallery');
    add_image_size( 'extra_large', 0, 0 );  remove_image_size('extra_large');
    add_image_size( 'featured_thin', 0, 0 );   remove_image_size('featured_thin');
    add_image_size( 'featured', 0, 0 );   remove_image_size('featured');

    add_image_size( 'portfolio_small', 0, 0 );  remove_image_size('portfolio_small');
    add_image_size( 'entry_without_sidebar', 0, 0 );  remove_image_size('entry_without_sidebar');
    add_image_size( 'entry_with_sidebar', 0, 0 ); remove_image_size('entry_with_sidebar');
    add_image_size( 'portfolio', 0, 0 );  remove_image_size('portfolio');
    //

    // add_image_size( 'widget', 50, 40, true);
    add_image_size( 'square', 300, 300, array( 'center', 'center' )  );
    //  add_image_size( 'large', 1500, 430,  array( 'left', 'center', true ) );
    add_image_size( 'large', 1600, 854 );
    add_image_size( 'extra_large', 1500, 430 );
    add_image_size( 'featured_large', 1500, 430,  array( 'left', 'center' ) );
    //
}
add_action( 'after_setup_theme', 'image_generation_0_killsit', 1 );



/*
RE	 				Load child theme avia sticky snippet for height correction
************************************************************************************* ENFOLD */
function wp_change_sticky_header_script() {
    wp_deregister_script( 'avia-sticky-header' );
    wp_enqueue_script( 'avia-sticky-header-child', get_stylesheet_directory_uri().'/js/avia-snippet-sticky-header.js', array('avia-default'),  true);
}
add_action( 'wp_enqueue_scripts', 'wp_change_sticky_header_script', 41100 );



/*
RE  						load custom elements for ALB
******************************************************************************************** WP Core */

function avia_include_shortcode_template($paths) {
    $template_url = get_stylesheet_directory();
    array_unshift($paths, $template_url.'/config-templatebuilder/');
    return $paths;
}
add_filter('avia_load_shortcodes', 'avia_include_shortcode_template', 15, 1);



/*
RE  2022 02              Auto Resize for Portfolio
------------------------------------------------------------------------------   Enfold  */
function ava_auto_resize(){
    ?>
    <script>
        (function($){
            var int = window.setInterval(function(){
                // console.log('tick');
                $(window).trigger('resize');
                $(window).trigger('av-content-el-height-changed');
            }, 1000);

            $(window).on('load', function() {
                setTimeout(clearInterval(int), 5000);
            });
        })(jQuery);
    </script>
    <?php
}
add_action('wp_footer', 'ava_auto_resize');




 





/* ***************************************************************************
RE  					         Backend CSS - Enfold
******************************************************************************  */
function backend_css_enfold() { ?>
    <style>
        .avia-template-save-button-inner ul{
            max-height:60vh !important;
        }
        .avia-template-save-button-inner {
            width: 30vw !important;
            left: -20vw !important;
        }
    </style>
<?php }
add_action( 'admin_enqueue_scripts', 'backend_css_enfold' );

/*	Changing and hiding fields in Backend
********************************************* */
function admin_print_scripts_change() {

    echo "<style>";
    echo ".row-title, td.column-title strong, .row-actions,  .widefat td, .widefat td ol, .widefat td p, .widefat td ul {
					font-size: 11px !important; 
				}";
    echo "a.av-shortcode-disabled, a.av-shortcode-disabled, .avia-flex-element , .av_codeblock .avia_inner_shortcode > *{
				display: none !important; opacity: 0 !important;
			}";

    echo "div .avia_sortable_element .avia_hidden_bg_box img {
             width: 30%;
            }
            .avia_textblock p{
               margin:0;
            }
            .avia_sortable_element .avia_textblock{
              background:none!important; padding: 2px !important;
            }
            #wpwrap .avia_textblock_style h1, #wpwrap .avia_textblock_style h2, #wpwrap .avia_textblock_style h3, #wpwrap .avia_textblock_style h4, #wpwrap .avia_textblock_style h5, #wpwrap .avia_textblock_style h6 {
                margin: 2px 0 0.1em;
            }
            ";
    echo "</style>";
    //}
}
add_action( 'admin_print_scripts', 'admin_print_scripts_change', 1 );










/*
RE  		Disable Pages in Searchresults Ajax Search
*****************************************************************+*********** Search   */
// Use search just for certain post-types and exclude posts by id
if ( ! function_exists( 'bb_filter_search_results' ) ) {
    add_action( 'pre_get_posts', 'bb_filter_search_results' );
    function bb_filter_search_results( $query )   {
        if ( ! $query->is_admin && $query->is_search ){
            $query->set( 'post_type', array( 'page', 'post', 'theor_grundlagen', 'vertiefungen', 'orientierungsplan', 'grundlagen_planung'  ) );
        }
        return $query;
    }
}

if ( ! function_exists( 'bb_filter_ajax_search_results' ) )
{
    add_filter('avf_ajax_search_query', 'bb_filter_ajax_search_results', 10, 1);
    function bb_filter_ajax_search_results( $search_parameters )
    {
        $defaults = array('numberposts' => 7, 'post_type' => array( 'page', 'post', 'vertiefungen', 'grundlagen_planung', 'theor_grundlagen', 'orientierungsplan' ),  'post_status' => 'publish', 'post_password' => '', 'suppress_filters' => false);
        $_REQUEST['s'] = apply_filters( 'get_search_query', $_REQUEST['s']);
        $search_parameters = array_merge( $defaults, $_REQUEST );
        return $search_parameters;
    }
}
/* END Ajax Search  */




/*
RE  	   Use Popupmaker with Layoutbuilder
**************************************************************************** Enfold - CPT UI */

function my_custom_exec_sc_only( $exec_sc_only, $obj_sc, $atts, $content, $shortcodename, $fake ){
    /**
     * Return if true - Enfold already requested an execution because of preview in backend
     * Otherwise this is likley to be false.
     */
    if( true === $exec_sc_only ){
        return $exec_sc_only;
    }
    return true;
    /**
     * Make your checks here - make sure to return boolean true if you want to force execution
     * Following is an example to allow it for all ajax calls.
     */
    if( defined( 'DOING_AJAX' ) && DOING_AJAX )	{
        return true;
    }
    return $exec_sc_only;
}

add_filter( 'avf_alb_exec_sc_only', 'my_custom_exec_sc_only', 10, 6 );






/*
RE  	   Layouteditor for CPT´s - CPT UI auch Layouteditor verwenden
**************************************************************************** Enfold - CPT UI */
function avf_alb_supported_post_types_mod( array $supported_post_types )
{
    $supported_post_types[] = 'theor_grundlagen';
    $supported_post_types[] = 'grundlagen_planung';
    $supported_post_types[] = 'orientierungsplan';
    $supported_post_types[] = 'vertiefungen';
    $supported_post_types[] = 'extras';
    $supported_post_types[] = 'popup';
    $supported_post_types[] = 'leuchttuerme';

    return $supported_post_types;
}
add_filter('avf_alb_supported_post_types', 'avf_alb_supported_post_types_mod', 10, 1);
/**/





/*
 RE	 					Google map Standard deaktivieren
*************************************************************************** ENFOLD */
/*
function disable_google_map_api($load_google_map_api) {
    $load_google_map_api = false;
    return $load_google_map_api;
}
add_filter('avf_load_google_map_api', 'disable_google_map_api', 10, 1);
*/
