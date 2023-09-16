<?php
if( ! defined( 'ABSPATH' ) ) { die(); }



$term = get_queried_object(); 

// Output the current archive name 


$current_archive_name = $term->name;
$current_archive_id = $term->term_id;

// Set session cookies for c_termname and c_termID
setcookie('c_termname', $current_archive_name, 0, '/', 'qualitaetsoffensive-teilhabe.de');
setcookie('c_termID', $current_archive_id, 0, '/', 'qualitaetsoffensive-teilhabe.de');



//  we need some functions of the single page functions as well
require_once "leuchttuerme-functions.php";



//  We add the same body class to the header
function custom_bodyclass($classes) {
    $classes[] = 'leuchttuerme-template-default';
    return $classes;
}
add_filter('body_class', 'custom_bodyclass');



/*
 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
 */
get_header();





?>


 <div class='leuchttuerme-template-default container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>

        <div class='container template-blog '>

            <main class='content <?php avia_layout_class( 'content' ); ?> units' <?php avia_markup_helper( array( 'context' => 'content', 'post_type' => 'post' ) );?>>

                <?php
                // Get the current archive object
                // get the current taxonomy term
                $term = get_queried_object();
                $current_archive = get_queried_object();
                //
                // Output the current archive name
                if ($current_archive) {
                    $archive_name = $current_archive->name;
                    // ACF Fields
                    $text_left = get_field('text_links', $term);
                    $imageurl = get_field('bild_der_kategorie', $term);
                    $text_right = get_field('text_rechts', $term);
                }
                ?>

                <div class='post-entry post-entry-type-page'><div class='entry-content-wrapper clearfix'><div class='flex_column_table sc-av_one_half av-equal-height-column-flextable'>
                            <div class='flex_column av_one_half  avia-builder-el-0  el_before_av_one_half  avia-builder-el-first  first flex_column_table_cell av-equal-height-column av-align-bottom  '>
                                <section class='av_textblock_section av-tqp6df-4e0257704317ae9076522a1a6e78c3df ' itemscope='itemscope' itemtype='https://schema.org/CreativeWork'><div class='avia_textblock av_inherit_color' itemprop='text'>
                                        <h2 style='text-align: right;'>
                                            <span style='color: #a1382f;'>
                                                <?php echo esc_html($archive_name) ?>
                                            </span>
                                        </h2>
                                    </div></section></div>
                            <div class='av-flex-placeholder'></div><div class='flex_column av_one_half  avia-builder-el-2  el_after_av_one_half  el_before_av_one_half  flex_column_table_cell av-equal-height-column av-align-bottom  '>
                                <section class='av_textblock_section av-sdi ' itemscope='itemscope' itemtype='https://schema.org/CreativeWork'><div class='avia_textblock' itemprop='text'>
                                        <p>
                                            <img decoding='async' class='size-full' src='<?php echo esc_html($imageurl) ?>' alt='image für Einstiegsseite der Leuchttürme' width='600' height='133'>
                                        </p>
                                    </div></section></div></div><!--close column table wrapper. Autoclose: 1 -->
                        <div class='flex_column av_one_half  avia-builder-el-4  el_after_av_one_half  el_before_av_one_half  first flex_column_div  column-top-margin'>
                            <section class='av_textblock_section' itemscope='itemscope' itemtype='https://schema.org/CreativeWork'>
                                <div class='avia_textblock' itemprop='text'>
                                    <p>
                                        <?php  $tds = term_description();
                                            if( $tds ) {
                                                echo "<span class='category-term-description'>{$tds}</span>";
                                            }
                                            echo "<span class='text'>{$text_left}</span>";
                                        ?>
                                    </p>
                                </div>
                            </section>
                        </div>
                        <div class='flex_column av_one_half  avia-builder-el-7  el_after_av_one_half  avia-builder-el-last  flex_column_div  column-top-margin'><section class='av_textblock_section' itemscope='itemscope' itemtype='https://schema.org/CreativeWork'>
                                <div class='avia_textblock' itemprop='text'><p>

                                        <?php echo $text_right ?>
                                    </p>
                                </div></section>
                            <div class='avia-button-wrap avia-button-right  avia-builder-el-9  el_after_av_textblock  avia-builder-el-last '>
                                <?php
                                    $term = get_queried_object(); // Get the current taxonomy term
                                    $args = array(
                                        'post_type' => 'leuchttuerme', // Your custom post type
                                        'posts_per_page' => 1,
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => $term->taxonomy,
                                                'field' => 'id',
                                                'terms' => $term->term_id,
                                                'include_children' => false,
                                            ),
                                        ),
                                    );

                                    $query = new WP_Query($args);

                                    if ($query->have_posts()) {
                                        $query->the_post();
                                        $first_post_link = get_permalink();
                                        wp_reset_postdata(); // Reset the post data to the main query
                                    }
                                ?>
                                <a href='<?php echo esc_url($first_post_link); ?>' class='avia-button avia-icon_select-yes-right-icon avia-size-medium avia-position-right avia-color-theme-color' target='_self' rel='noopener noreferrer'>
                                        Mehr
                                    <span class='avia_button_icon avia_button_icon_right' aria-hidden='true' data-av_icon='' data-av_iconfont='entypo-fontello'> </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    // Initialize the active term ID and name as null
                    $archive_page_id = get_queried_object_id();
                    $archive_name = $current_archive->name;
                    //
                    // Output the section content
                ?>

                </div> <!-- close main container -->
                     <div id="lt_footer_masonry" class="avia-section footer_color avia-section- avia-no-border-styling avia-bg-style-scroll container_wrap fullsize">
                         <div class="container av-section-cont-open">
                             <div class="template-page content  av-content-full alpha units">
                                 <div class="post-entry post-entry-type-page">
                                     <div class="entry-content-wrapper clearfix">
                                 <span class="floatleft" style="margin-bottom:18px">
                                    <h2><span style="color:#fff; margin-bottom:30px">  <?php echo $archive_name . "  : " . $archive_page_id ?> </span></h2>
                                </span>
                                     <a href="" class="lt_popup avia-button avia-icon_select-yes-left-icon avia-size-small av-button-notext floatright pum-trigger" style="background-color: transparent; color: #fff;  box-shadow: none; border: medium; font-size: 18px; cursor: pointer;">
                                                 Alle anzeigen &nbsp;<span class=" avia_button_icon avia_button_icon_left " aria-hidden="true" data-av_icon="" data-av_iconfont="entypo-fontello"></span>
                                            <span class="avia_iconbox_title"></span>
                                        </a>

                                         <?php
                                            echo do_shortcode( "
                                         [av_masonry_entries link='lt_virtuelles_kulturhaus,".$archive_page_id."' wc_prod_visible='' wc_prod_hidden='hide' wc_prod_featured='' prod_order_by='' prod_order='' date_filter='' date_filter_start='' date_filter_end='' date_filter_format='yy/mm/dd' period_filter_unit_1='1' period_filter_unit_2='year' sort='no' query_orderby='menu_order' query_order='ASC' caption_elements='title' caption_styling='overlay' caption_display='always' size='fixed' orientation='av-orientation-square' image_size='masonry' gap='no' columns='6' av-desktop-columns='' av-medium-columns='3' av-small-columns='2' av-mini-columns='2' items='-1' paginate='load_more' color='custom' custom_bg='' animation='active' animation_duration='' animation_custom_bg_color='' animation_custom_bg_color_multi_list='' animation_z_index_curtain='100' overlay_fx='grayscale' img_scrset='' lazy_loading='enabled' id='' custom_class='' template_class='' av_uid='av-lg9t7w89' sc_version='1.0']
                                         ")  ; // END echo
                                         ?>

                                  </div>
                               </div>
                             </div><!-- close content main div -->
                         </div>


                  </div> <!--end content-->
            </main>

        </div><!--end container-->

    </div><!-- close default .container_wrap element -->

<?php






/*
* RE
* Function to go navigate in to the first Posts  
* Dies ist eine abgepeckte Version der Navigation innerhalb von: leuchttuerme-functions.php 
/Users/iMacUser/Dropbox (Privat)/_2023__Qualitaetsoffensive/_git_QUOT/enfold-child/leuchttuerme-functions.php   Zeile 148
*/ 
function leuchttuerme_postnav_archive()
{
    if (is_archive()) {
        // Get the current archive term ID
        $term_id_to_use = get_queried_object()->term_id;

        // Get the first post in the archive term
        $args = array(
            'post_type' => 'leuchttuerme', // Replace with your post type
            'posts_per_page' => 1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'lt_virtuelles_kulturhaus',
                    'field' => 'id',
                    'terms' => $term_id_to_use,
                ),
            ),
        );

        $posts_query = new WP_Query($args);

        // Output navigation link to the first post in the archive term
        if ($posts_query->have_posts()) {
            $first_post = $posts_query->posts[0];
            echo '<div class="post-links"><div class="next">';
            echo '<a href="' . get_permalink($first_post) . '"></a>';
            echo '</div></div>';
        }
    }
}

// Add the function to the appropriate action hook
add_action('ava_before_footer', 'leuchttuerme_postnav_archive', 9);











//  Basic Wordpress function
get_footer();
