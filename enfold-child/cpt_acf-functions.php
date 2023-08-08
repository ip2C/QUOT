<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/* 
 *  Relationships (Weit. Materialien) über 
 *  WP-All-import hochgeladenen Datenbank die in verschiedenen 
 *  Post-Typen ausgegeben wird.
 *  
 */
// 
function  related_relationship_literatur( $outputHTML  )  {  
	//
	// check the arguments of the post_type, orderby
				$args1 =array( 
							'post_type' => 'materialien',			// the CPT 
								'meta_query' => array(  			// the meta_query is important to list only the related posts of the key
									  'relation' => 'OR',  
										array(	
											'key' => 'post-relationship-tg', 
											// name of custom field Relationship in: https://qualitaetsoffensive-teilhabe.de/wp-admin/post.php?post=12067&action=edit&classic-editor=1
											'value' => '"' . get_the_ID() . '"',  
											'compare' => 'LIKE'
										),
										array(							
											'key' => 'post-relationship-gp', 			// name of custom field 2
											'value' => '"' . get_the_ID() . '"',     
											'compare' => 'LIKE'
										),
										array(							
											'key' => 'post-relationship-vertiefungen', 	// name of custom field 2
											'value' => '"' . get_the_ID() . '"',     
											'compare' => 'LIKE'
										),
										array(							
											'key' => 'post-relationship-op', 			// name of custom field 3
											'value' => '"' . get_the_ID() . '"',    
											'compare' => 'LIKE'
										)
								)
						);  
				// 
				// make an own WP_Query from the $args
				$materials_1 = new WP_Query( $args1 ); 
				// 
				if ($materials_1->have_posts() ) { 
					//  
					$outputHTML .= "<div id='materialen_wrapper' class='avia-section main_color avia-section-default avia-no-border-styling  avia-builder-el-233  el_after_av_section  avia-builder-el-last  avia-bg-style-scroll container_wrap fullsize' ><div class='container av-section-cont-open'>

<div class='flex_column av_one_fifth  flex_column_div first  el_after_av_four_fifth ' style='margin-top:0px; padding:20px 0px 0px 0px; border-radius:0px; '><div class='avia-image-container  av-styling-    avia-builder-el-140  avia-builder-el-no-sibling  avia-align-right ' itemprop='image' itemscope='itemscope' itemtype='https://schema.org/ImageObject'><div class='avia-image-container-inner'> <div class='avia-image-overlay-wrap'><img style='float:right;' class='avia-img-lazy-loading avia_image icon_materials' src='https://qualitaetsoffensive-teilhabe.de/wp-content/uploads/2020/07/Icon_Literatur.png' alt='Icon für Materialien' width='120' height='120'></div></div></div></div>";
					// 
					$outputHTML .= "<div id='materialien' class='flex_column av_four_fifth  flex_column_div av-zero-column-padding   avia-builder-el-19  el_after_av_one_fifth  el_before_av_one_fifth' style='margin-top:20px; margin-bottom:0px; border-radius:0px; ' >
					<section class='av_textblock_section ' itemscope='itemscope' itemtype='https://schema.org/CreativeWork'><div class='avia_textblock' itemprop='text'></div></section><h3 class='w_materialien_headline'><span style='color:#a5382f;'>(weiterführende) <b>MATERIALIEN</b></span></h3>";

					$outputHTML .= "<div id='literatur-materialien' class='togglecontainer av-elegant-toggle toggle_close_all avia-builder-el-23 el_after_av_toggle_container avia-builder-el-last my-custom-tabs kacheln enable_toggles'>";

					//				
					// get the taxonomy medienform
					$cat_taxonomies = get_terms( 'medienform');  
					// foreach category as $form_category  -  medienform
					foreach ( $cat_taxonomies as $form_category ):
							// check the arguments of the post_type, orderby
							$args =array(
										'posts_per_page' => -1,
										'post_type' => 'materialien',	// the CPT
										'orderby' => 'excerpt',    		// menu_order       'orderby' => 'title',
										'order' => 'ASC',  		 		// DESC                               
										'tax_query' => array( 			// the tax_query is important to list the posttypes to its taxonomies
											'relation' => 'AND',  
													array(  
														'taxonomy' => 'medienform',
														'field' => 'slug',
														'terms' => $form_category->slug  
													)  
										),
										'meta_query' => array(  // the meta_query is important to list only the related posts of the key
											 'relation' => 'OR',  
												array(							
														'key' => 'post-relationship-tg', 		// name of custom field Relationship 
														'value' => '"' . get_the_ID() . '"',   // matches exactly "123", not just 123. This prevents a match for "1234"
														'compare' => 'LIKE'
													),
													array(							
														'key' => 'post-relationship-gp', 		// name of custom field 1
														'value' => '"' . get_the_ID() . '"', 
														'compare' => 'LIKE'
													),
													array(							
														'key' => 'post-relationship-vertiefungen', 	// name of custom field 2
														'value' => '"' . get_the_ID() . '"', 		
														'compare' => 'LIKE'
													),
													array(							
														'key' => 'post-relationship-op', 	 // name of custom field 3
														'value' => '"' . get_the_ID() . '"',
														'compare' => 'LIKE'
													)
											),
										);  
							// 
							// make an own WP_Query from the $args
							$materials = new WP_Query( $args ); 
							// 
							if ($materials->have_posts() ) {
							// hier wird der toggle umrandet  
							//
							$outputHTML .=  "<section class='av_toggle_section toggle-$form_category->slug'><div role='tablist' class='single_toggle' data-tags='{Alle} '><p data-fake-id='#toggle-id-$form_category->slug' class='toggle-id-$form_category->slug toggler  hasCustomColor av-inherit-font-color' itemprop='headline' style='color: #efbb20; ' role='tab' tabindex='0' aria-controls='toggle-id-$form_category->slug'> $form_category->name<span class='toggle_icon' style='border-color:#efbb20;'><span class='vert_icon'></span><span class='hor_icon'></span></span></p><div id='toggle-id-$form_category->slug' class='toggle_wrap '><div class='toggle_content invers-color  av-inherit-font-color ' itemprop='text' style='color: #efbb20; '>";
							//
							//  while materials in if Schleife
							while ( $materials->have_posts() ) {  
									//
									$materials->the_post();
										// get_template_part( 'XXX', 'xxx-page' );
										// 
										$url = get_field("url");
										$author = get_field("author");
										$title = get_the_title();
										if(!$author){
											$fontbigger = "fontbigger";
										}
										else{ $fontbigger = "fontsmaller";}

										// $moretitle = the_title( '<h3>', '</h3>' ); 
										
										if( $form_category->slug == 'weiterfuehrende-literatur' || $form_category->slug == 'literatur'  ){   // !!!  Dies muss dann mit der neuen Datenbank korrigiert werden. 
											$outputHTML .= "<div class='literaturansicht' title='".$title."'> ";
											
											if ( $url ){
												$outputHTML .= "<a class='extlink' href='".$url."' target='_blank' rel='noopener'><span class='author'>".$author.": ".$title."</span></a><br>";
											}
											else{
												$outputHTML .= "<span class='author'>".$author.": ".$title."</span><br>";
											}
											
											$outputHTML .= "</div>";
											
										} // END if  $form_category->slug == 'weiterfuehrende-literatur'
										//
								 		else if( $form_category->slug != 'literatur' ) {
											$outputHTML .= "<section class='gridkachel' title='".$title."'><a class='imgurl' href='".$url."' target='_blank' rel='noopener'><span class='text'><span class='author'>$author</span><span class='titleurl ". $fontbigger." '>$title</span></span><img loading='lazy' class='alignleft' src='https://qualitaetsoffensive-teilhabe.de/wp-content/themes/enfold-child/images/Icon_".$form_category->slug.".jpg' alt='".$title."' width='215' height='175'></a><a class='copyright_material' style='color:#ffffff;' href='https://qualitaetsoffensive-teilhabe.de/wp-content/uploads/2021/01/Bildrechte.pdf#page=141&view=fitH' target='_blank'>©</a></section>";
										//  
										}
										else{
											// do nothing
										}
								
								}  // endwhile;
								//
										$outputHTML .= "</div> <!-- 1  toggle_content --></div><!-- 2  toggle-id --></div><!-- 3 single_toggle --></section>";
								//
								}; // endif something in the taxonomy
								wp_reset_query();
						//
						//	
						
						endforeach;
			// hier wird der toggle geschlossen 
			$outputHTML .= "</div><!-- close the toggle container --></div> <!-- close av_four_fifth --></div>  <!-- close container --></div>  <!-- close materialien_wrapper -->
			<p></p>
			";
			//
			// close all	
			}; // endif something in posttyp
	    // 
       echo $outputHTML;
	
} // End function related_relationship() 

add_action('ava_before_footer', 'related_relationship_literatur', 100 );





 