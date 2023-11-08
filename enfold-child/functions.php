<?php
/*
 * Functions for Wordpress – QUOT
 * Version 1.2
 * Author: R.Ehm
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 

// INCLUDE
// include the functions for CPT - ACF filter and relationships   
//
require_once "functions-enfold.php";
//
require_once "masonry-functions.php";
//
require_once "js-functions.php";
//
require_once "reg_cpt-functions.php";
//
require_once "cpt_acf-functions.php";
//
function load_leuchttuerme_functions() {
    if ( is_singular(array('leuchttuerme') ) ) {
        require_once "leuchttuerme-functions.php";
    }
}
add_action('template_redirect', 'load_leuchttuerme_functions');
function custom_archive_logic() {
    $idpost = get_the_ID();
    if (is_archive() && get_post_type() == "leuchttuerme"  ) {
        get_template_part('archive', 'leuchttuerme');		
    }
}
add_action('template_redirect', 'custom_archive_logic');




/* END include */




/*
RE			    Set all materialien to publish   (kurzfristig )
******************************************************************************** */
/**/ 

function set_materialien_to_published_once() {
    if (isset($_GET['post_type']) && $_GET['post_type'] === 'materialien') {
        // Beiträge des Post-Typs 'materialien' abrufen
        $args = array(
            'post_type' => 'materialien',
            'post_status' => 'draft', // Nur Beiträge im Entwurfsstatus auswählen
            'posts_per_page' => -1, // Alle Beiträge abrufen
        );

        $posts = new WP_Query($args);

        if ($posts->have_posts()) :
            while ($posts->have_posts()) : $posts->the_post();

                // Beitragsstatus aktualisieren
                $post_id = get_the_ID();
                wp_update_post(array(
                    'ID' => $post_id,
                    'post_status' => 'publish',
                ));

            endwhile;
            wp_reset_postdata();
        endif;
    }
}
add_action('admin_init', 'set_materialien_to_published_once');












/*
RE			     Remove Blockstyles (Gutenberg) and SVG in Wordpress header
******************************************************************************** */
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
function remove_block_css() {
    wp_dequeue_style( 'wp-block-library' ); // Wordpress core
    wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
    wp_dequeue_style( 'wc-block-style' ); // WooCommerce
}
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );






/*
RE			    remove type='text/javascript'  for less warnings
******************************************************************************** */
add_action(
    'after_setup_theme',
    function() {
        add_theme_support( 'html5', [ 'script', 'style' ] );
    }
);
/* END remove Basic */




/* 
RE  				Remove Enfold CSS aus Plugins (Theme)
**************************************************************************** */
function remove_plugin_css(){  
    // wp_dequeue_style('avia-custom');    
       wp_dequeue_style('open-sans');     
	   wp_dequeue_style('avia-woocommerce-css'); 
	   wp_dequeue_style('sdm-styles');
	//
	  wp_dequeue_style('avia-style');  
}
add_action('wp_print_styles','remove_plugin_css', 39000);



function wpdocs_theme_name_scripts() {
  // wp_enqueue_style( 'style-name', get_stylesheet_uri() );
  // wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
  // wp_enqueue_style( 'style',  'https://dl.dropboxusercontent.com/s/glx6yt42a78yiff/style.css', array(), '1.3.0' );
     wp_enqueue_style( 'style',  get_stylesheet_uri()  , array(), time() );
}
add_action( 'wp_print_styles', 'wpdocs_theme_name_scripts', 10, 999 );




/*
RE				Remove Enfold Debugging
----------------------------------------------------------- */
remove_action('wp_head','avia_debugging_info',1000);

// set builder mode to debug
 
function builder_set_debug(){
  return "debug";
}
add_action('avia_builder_mode', "builder_set_debug"); 

/**/



/*  
RE  2022-11             add categories to pages
---------------------------------------------------------------------------  WP Base  */
function myplugin_settings() {  
    // Add tag metabox to page
    register_taxonomy_for_object_type('post_tag', 'page'); 
    // Add category metabox to page
    register_taxonomy_for_object_type('category', 'page');  
}
 // Add to the admin_init hook of your theme functions.php file 
add_action( 'init', 'myplugin_settings' );

 


/*  
RE  2022-03             deactivate Mailpoet Google Fonts
-----------------------------------------------------------------------------  WP Base  */
add_filter('mailpoet_display_custom_fonts', function () {return false;});





/*
RE  2022-03              Author Page deactivation
-----------------------------------------------------------------------  WP Base  */
function my_custom_disable_author_page() {
    global $wp_query;

    if ( is_author() ) {
        // Redirect to homepage, set status to 301 permenant redirect.
        // Function defaults to 302 temporary redirect.
        wp_redirect(get_option('home'), 301);
        exit;
    }
}
add_action('template_redirect', 'my_custom_disable_author_page');



/*
RE                               Remove Comments completely
******************************************************************************************************  WP Base */
// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'df_disable_comments_post_types_support');
// Close comments on the front-end
function df_disable_comments_status() {
    return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);
// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);
// Remove comments page in menu
function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');
// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url()); exit;
    }
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');
// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');
// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'df_disable_comments_admin_bar');
/*RE     Kill comments-reply
 *** Wordpress */
function clean_header(){
        wp_deregister_script( 'comment-reply' );
         }
add_action('init','clean_header');

/* END Comments deactivation */






/* 
 							 Disable feed
****************************************************************************** */
/*
 * Redirect to the homepage all users trying to access feeds.
 */
function disable_feeds() {
	wp_redirect( home_url() );
	die;
}

// Disable global RSS, RDF & Atom feeds.
add_action( 'do_feed',      'disable_feeds', -1 );
add_action( 'do_feed_rdf',  'disable_feeds', -1 );
add_action( 'do_feed_rss',  'disable_feeds', -1 );
add_action( 'do_feed_rss2', 'disable_feeds', -1 );
add_action( 'do_feed_atom', 'disable_feeds', -1 );

// Disable comment feeds.
add_action( 'do_feed_rss2_comments', 'disable_feeds', -1 );
add_action( 'do_feed_atom_comments', 'disable_feeds', -1 );

// Prevent feed links from being inserted in the <head> of the page.
add_action( 'feed_links_show_posts_feed',    '__return_false', -1 );
add_action( 'feed_links_show_comments_feed', '__return_false', -1 );
remove_action( 'wp_head', 'feed_links',       2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );

/* remove RSS */





/* 			Automatically set the image Title, Alt-Text, Caption & Description upon upload
----------------------------------------------------------------------------------------------------  */
add_action( 'add_attachment', 'my_set_image_meta_upon_image_upload' );
function my_set_image_meta_upon_image_upload( $post_ID ) {

	// Check if uploaded file is an image, else do nothing

	if ( wp_attachment_is_image( $post_ID ) ) {

		$my_image_title = get_post( $post_ID )->post_title;

		// Sanitize the title:  remove hyphens, underscores & extra spaces:
		$my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $my_image_title );

		// Sanitize the title:  capitalize first letter of every word (other letters lower case):
		$my_image_title = ucwords( strtolower( $my_image_title ) );

		// Create an array with the image meta (Title, Caption, Description) to be updated
		// Note:  comment out the Excerpt/Caption or Content/Description lines if not needed
		$my_image_meta = array(
			'ID'		=> $post_ID,			// Specify the image (ID) to be updated
			'post_title'	=> $my_image_title,		// Set image Title to sanitized title
			'post_excerpt'	=> $my_image_title,		// Set image Caption (Excerpt) to sanitized title
			'post_content'	=> $my_image_title,		// Set image Description (Content) to sanitized title
		);
		// Set the image Alt-Text
		update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );
		// Set the image meta (e.g. Title, Excerpt, Content)
		wp_update_post( $my_image_meta );

	} 
}

/* END automatic set for images */





/* 
RE  						stop_update_emails
******************************************************************************************** WP Core */
function stop_update_emails( $send, $type, $core_update, $result ) {
if ( ! empty( $type ) && $type == 'success' ) {
	return false;
	}
return true;
}
add_filter( 'auto_core_update_send_email', 'stop_auto_update_emails', 10, 4 );
 



/*
RE                                   Change Colors in Tiny MCE
********************************************************************************************* WP Base  */
function my_mce4_options($init) {
  $default_colours = '"efbb20", "Gelb", 
  					  "a1382f", "Rot", 
                      "41464B", "Blaugrau",
					  "587aa6", "Hellblau",
					  "295f8f", "Blueheadline" 
					  ';

  // build colour grid default+custom colors
 // $init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';<br><br>
	 $init['textcolor_map'] = '['.$default_colours.']';
  // enable 6th row for custom colours in grid
  $init['textcolor_rows'] = 4;
  //
  return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');




/* ***********************************************************************************
RE    					Shortcodes for post title and postdate
*************************************************************************************** */
function post_meta_shortcode(){
	ob_start();
	echo "<span class='post-meta-infos'>";
	$markup = avia_markup_helper(array('context' => 'entry_time','echo'=>false));
	echo "<time class='date-container minor-meta updated' $markup>".get_the_time(get_option('date_format'))."</time>";
	echo "<span class='text-sep text-sep-date'>/</span>";

    $taxonomies  = get_object_taxonomies(get_post_type($the_id));
	    $cats = '';
	    $excluded_taxonomies =  apply_filters('avf_exclude_taxonomies', array('post_tag','post_format'), get_post_type($the_id), $the_id);

	    if(!empty($taxonomies))
	    {
	        foreach($taxonomies as $taxonomy)
	        {
	            if(!in_array($taxonomy, $excluded_taxonomies))
	            {
					  $cats .= get_the_term_list($the_id, $taxonomy, '', ', ','').' ';
	            }
	        }
	    }
	    if(!empty($cats))
	    {
	        echo '<span class="blog-categories minor-meta">'.__('in','avia_framework')." ";
	        echo $cats;
	        echo '</span><span class="text-sep text-sep-cat">/</span>';
	    }
 
	    echo '</span></span>';
	    echo '</span>';
	    echo '</span>';
	echo '</span>';
	return ob_get_clean();
}
add_shortcode( 'sc_post_meta', 'post_meta_shortcode' );



/*  post title to insert */
function post_title_shortcode(){
	global $post;
	return get_the_title($post->ID);
}
add_shortcode( 'sc_post_title', 'post_title_shortcode' );




/* 
Add Shortcode for Thumbnail
-----------------------------------------------------------------------------  
WP Core 
*/

function post_thumbnail_shortcode($atts, $content = '') {
    // Check if the function exists, this check may not be necessary
    // You can remove this if condition
    if (!function_exists('post_thumbnail_shortcode')) {
        return '';
    }

    // Use the "isset" function to check if the 'size' attribute is set
    if (!isset($atts['size'])) {
        $atts['size'] = 'large';
    }

    // Initialize the $output variable
    $output = '<span class="post_thumbnail ' . esc_attr($atts['class']) . '">' . get_the_post_thumbnail(null, $atts['size']) . '</span>';

    return $output;
}

function post_thumbnail($str) {
    $args = wp_parse_args($str);
    // Call the post_thumbnail_shortcode function and store the result in a variable
    $thumbnail_output = post_thumbnail_shortcode($args);

    // Output the result using "return" instead of "echo"
    return $thumbnail_output;
}

add_shortcode('post_thumbnail', 'post_thumbnail');

/* 
END Shortcodes
*/





/* 
 RE	 				  ajax search Correction
***************************************************************** ENFOLD SEARCH */
/* 
function avf_modify_ajax_search_query($search_parameters){
	parse_str($search_parameters, $params);
	$params['numberposts'] = 18;
	$search_parameters = http_build_query($params);
	return $search_parameters;
	//  

}
add_filter('avf_ajax_search_query', 'avf_modify_ajax_search_query', 10, 1);
*/






/* END JD . Disable results */

 /*
function avf_modify_ajax_search_query($search_parameters){
	parse_str($search_parameters, $params);
	$params['numberposts'] = 28;
	$search_parameters = http_build_query($params);
	return $search_parameters;
	//  

}
add_filter('avf_ajax_search_query', 'avf_modify_ajax_search_query', 10, 1);

*/




 







/*RE    ACF field group post type in Blog posts elements
 * https://kriesi.at/support/topic/acf-field-group-post-type-in-blog-posts-elements/     */
/*
function avia_blog_post_query_mod($query, $params) {	
    foreach($query['post_type'] as $key => $value) {
        if( $value == 'acf-field-group' ) {
            unset($query['post_type'][$key]);
        }      
    }
    return $query;
}
add_filter('avia_post_slide_query', 'avia_blog_post_query_mod', 10, 2);

*/


	
/* 
 RE	 				Archivseiten deaktivieren 
*************************************************************************************  WP Base */
/*function redirect_to_home( $query ){
    if( is_date() || is_archive() ) { 
         wp_redirect( home_url() );
         exit;
     }
}
add_action( 'parse_query', 'redirect_to_home' );
*/



/* 
 RE	 Jan 2021			  All Sort Button aus Masonry entfernen
*************************************************************************************  Enfold */
/*  Use the "avf_masonry_sort_first_label" filter changes the first label (All) in Masonry element   */
 
/*
function new_masonry_first_label() {
$first_item_name = "";
return $first_item_name;
}

add_filter('avf_masonry_sort_first_label','new_masonry_first_label');

*/







// GS		    Custom Tooltip
// //////////////////////////////////////////////////
function add_custom_tooltip(){
?>
<script>
(function($) {
			$(document).ready(function() {
		 setTimeout(function() {
			$('a[data-tag="{All}"]').removeClass('activeFilter');
			$('a[data-tag="{ex}"]').addClass('activeFilter');
			
		}, 1500);
		});
	});// END Doc ready
</script>
<?php
}
add_action('wp_footer', 'add_custom_tooltip');

// 
// 