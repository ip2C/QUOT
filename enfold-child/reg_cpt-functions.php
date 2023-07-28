<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*   	
		Post type: 			+	    Taxanomy	
	_____________________________________________________
	 	Weit. Materialien 	+	    Medienformen	
	 	Theor. Grundlagen 	+	    Kategorien_TG	
 	   	Orientierungsplan	+	    Kategorien_OP	 
   	   	Extras   			+       Kategorien_Extras   
  	 	Vertiefungen   	 	+       Kategorie_Vertiefungen   
  	  	Leuchttuerme - 
		Virtuelles Kulturhaus    	+       Kategorie_LT_VK   
 */



/*RE ******************************		Post Type:  	Weit. Materialien 	+	Tax     Medienformen
*************************************************************************************************************** */
 function cptui_register_my_cpts_materialien() {

	/**
	 * Post Type: Weit. Materialien.
	 */

	$labels = [
		"name" => esc_html__( "Weit. Materialien", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Weit. Material", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Weit. Materialien", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => true,
		"rewrite" => [ "slug" => "materialien", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 2,
		"menu_icon" => "dashicons-list-view",
		"supports" => [ "title", "thumbnail", "excerpt" ],
		"taxonomies" => [ "medienform" ],
		"show_in_graphql" => false,
	];

	register_post_type( "materialien", $args );
}
add_action( 'init', 'cptui_register_my_cpts_materialien' );



function cptui_register_my_taxes_medienform() {

	/**
	 * Taxonomy: Medienformen.
	 */

	$labels = [
		"name" => esc_html__( "Medienformen", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Medienform", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Medienformen", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => false,
		"publicly_queryable" => false,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'medienform', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"show_tagcloud" => false,
		"rest_base" => "medienformen",
		"rest_controller_class" => "medienformen",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "medienform", [ "materialien" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_medienform' );





/*RE ******************************		Post Type:  	Theor. Grundlagen 	+	Tax     Kategorien_TG
*************************************************************************************************************** */


function cptui_register_my_cpts_theor_grundlagen() {
	/**
	 * Post Type: Theor. Grundlagen.
	 */

	$labels = [
		"name" => esc_html__( "Theor. Grundlagen", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Theor. Grundlage", "custom-post-type-ui" ),
		"menu_name" => esc_html__( "Theor. Grundlagen", "custom-post-type-ui" ),
		"all_items" => esc_html__( "Seiten", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Theor. Grundlagen", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"can_export" => false,
		"rewrite" => [ "slug" => "theor_grundlagen", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 4,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "page-attributes" ],
		"taxonomies" => [ "category", "post_tag", "kategorien_tg" ],
		"show_in_graphql" => false,
	];

	register_post_type( "theor_grundlagen", $args );
}

add_action( 'init', 'cptui_register_my_cpts_theor_grundlagen' );



function cptui_register_my_taxes_kategorien_tg() {

	/**
	 * Taxonomy: Kategorien_TG.
	 */

	$labels = [
		"name" => esc_html__( "Kategorien_TG", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Kategorien_TG", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => esc_html__( "Kategorien_TG", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'kategorien_tg', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"show_tagcloud" => true,
		"rest_base" => "kategorien_tg",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "kategorien_tg", [ "theor_grundlagen" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_kategorien_tg' );






/*RE ******************************		Post Type:    	Orientierungsplan	+	Tax     Kategorien_OP
******************************************************************************************************+******** */


	function cptui_register_my_cpts_orientierungsplan() {

		/**
		 * Post Type: Orientierungsplan.
		 */
	
		$labels = [
			"name" => esc_html__( "Orientierungsplan", "custom-post-type-ui" ),
			"singular_name" => esc_html__( "Orientierungsplan", "custom-post-type-ui" ),
			"menu_name" => esc_html__( "Orientierungsplan", "custom-post-type-ui" ),
			"all_items" => esc_html__( "Seiten", "custom-post-type-ui" ),
		];
	
		$args = [
			"label" => esc_html__( "Orientierungsplan", "custom-post-type-ui" ),
			"labels" => $labels,
			"description" => "Orientierungsplan",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"rest_namespace" => "wp/v2",
			"has_archive" => false,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"delete_with_user" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => true,
			"can_export" => false,
			"rewrite" => [ "slug" => "orientierungsplan", "with_front" => true ],
			"query_var" => true,
			"menu_position" => 4,
			"supports" => [ "title", "editor", "thumbnail", "excerpt",  "page-attributes" ],
			"taxonomies" => [ "category", "post_tag" ],
			"show_in_graphql" => false,
		];
	
		register_post_type( "orientierungsplan", $args );
	}
	add_action( 'init', 'cptui_register_my_cpts_orientierungsplan' );
	//
	function cptui_register_my_taxes_op_kategorie() {
	
		/**
		 * Taxonomy: Kategorien_OP.
		 */
	
		$labels = [
			"name" => esc_html__( "Kategorien_OP", "custom-post-type-ui" ),
			"singular_name" => esc_html__( "Kategorien_OP", "custom-post-type-ui" ),
		];
	
		$args = [
			"label" => esc_html__( "Kategorien_OP", "custom-post-type-ui" ),
			"labels" => $labels,
			"public" => false,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'op_kategorie', 'with_front' => true,  'hierarchical' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => false,
			"show_tagcloud" => false,
			"rest_base" => "op_categ",
			"rest_controller_class" => "op_categ",
			"rest_namespace" => "wp/v2",
			"show_in_quick_edit" => true,
			"sort" => false,
			"show_in_graphql" => false,
		];
		register_taxonomy( "op_kategorie", [ "orientierungsplan" ], $args );
	}
	add_action( 'init', 'cptui_register_my_taxes_op_kategorie' );
	
	
	

/* RE *****************************     Post Type:   Extras   +   Tax      Kategorien_Extras  
************************************************************************************************** */
function cptui_register_my_cpts_extras() {

	/**
	 * Post Type: Extras.
	 */

	$labels = [
		"name" => esc_html__( "Extras", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Extras", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Extras", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"can_export" => false,
		"rewrite" => [ "slug" => "extras", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 4,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "trackbacks", "page-attributes" ],
		"taxonomies" => [ "category", "post_tag", "extras_kategorie" ],
		"show_in_graphql" => false,
	];

	register_post_type( "extras", $args );
}
add_action( 'init', 'cptui_register_my_cpts_extras' );


function cptui_register_my_taxes_extras_kategorie() {

	/**
	 * Taxonomy: Kategorien_Extras.
	 */

	$labels = [
		"name" => esc_html__( "Kategorien_Extras", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Kategorie_Extras", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => esc_html__( "Kategorien_Extras", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'extras_kategorie', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "extras_kategorie",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "extras_kategorie", [ "extras" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_extras_kategorie' );


/* RE *****************************    Post Type:  Vertiefungen    +   Tax    Kategorie_Vertiefungen  
*********************************************************************************************************** */

function cptui_register_my_cpts_vertiefungen() {

	/**
	 * Post Type: Vertiefungen.
	 */

	$labels = [
		"name" => esc_html__( "Vertiefungen", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Vertiefungen", "custom-post-type-ui" ),
		"menu_name" => esc_html__( "Vertiefungen", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Vertiefungen", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "Vertiefungen",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"can_export" => true,
		"rewrite" => [ "slug" => "vertiefungen", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 4,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "trackbacks", "author", "revisions", "page-attributes" ],
		"taxonomies" => [ "category", "post_tag", "kategorien_vertiefungen" ],
		"show_in_graphql" => false,
	];

	register_post_type( "vertiefungen", $args );
}

add_action( 'init', 'cptui_register_my_cpts_vertiefungen' );


function cptui_register_my_taxes_kategorien_vertiefungen() {

	/**
	 * Taxonomy: Kategorie_Vertiefungen.
	 */

	$labels = [
		"name" => esc_html__( "Kategorie_Vertiefungen", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Kategorie_Vertiefungen", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => esc_html__( "Kategorie_Vertiefungen", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'kategorien_vertiefungen', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "kategorien_vertiefungen",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "kategorien_vertiefungen", [ "vertiefungen" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_kategorien_vertiefungen' );





/* RE *****************************    Post Type:    Leuchttürme    +   Tax    Kategorie_LT  
************************************************************************************************** */


function cptui_register_my_cpts_leuchttuerme() {
	/**
	 * Post Type: Leuchttürme.
	 */
	$labels = [
		"name" => esc_html__( "Leuchttürme Seiten", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Leuchtturm Seiten", "custom-post-type-ui" ),
		"menu_name" => esc_html__( "Leuchttürme", "custom-post-type-ui" ),
	];
	$args = [
		"label" => esc_html__( "Leuchttürme Seiten", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"menu_position" => 4,
		"hierarchical" => true,
		"can_export" => true,
		"rewrite" => [ "slug" => "leuchttuerme", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "trackbacks", "page-attributes" ],
		"taxonomies" => [ "post_tag", "lt_vk_kategorien" ],
		"show_in_graphql" => true,
	];
	register_post_type( "leuchttuerme", $args );
}

add_action( 'init', 'cptui_register_my_cpts_leuchttuerme' );

// LT VK Kategorie
function cptui_register_my_taxes_leuchtturm_kategorien() {
	/**
	 * Taxonomy: LT VK Kategorien.
	 */
	$labels = [
		"name" => esc_html__( "Virtuelles Kulturhaus", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Virtuelles Kulturhaus", "custom-post-type-ui" ),
	];
	
	$args = [
		"label" => esc_html__( "Virtuelles Kulturhaus", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'leuchttuerme-virtuelles_kulturhaus', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "lt_vk_kategorien",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => false,
		"show_in_graphql" => true,
	];
	register_taxonomy( "lt_virtuelles_kulturhaus", [ "leuchttuerme" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_leuchtturm_kategorien' );

 

/* END Leuchttuerme */ 




