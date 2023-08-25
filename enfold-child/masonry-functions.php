<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



/* 
RE  	   Before footer do the av masonry Gallerie
**************************************************************************** Enfold - CPT UI */
function ava_before_footer_mod() {
    if( !is_page(1445) ):
         echo '
               ' .
                    do_shortcode( " [av_masonry_entries link='kategorien_tg,208' query_orderby='menu_order' query_order='ASC' caption_elements='title' caption_styling='overlay' caption_display='always' size='fixed' orientation='av-orientation-square' gap='no' columns='6' av-medium-columns='4' av-small-columns='2' av-mini-columns='2' items='-1' paginate='load_more' overlay_fx='active' animation='' lazy_loading='enabled' id='tg_masonry' custom_class='masonrynav masonryit' av_uid='av-khm0jlr2']  " )
                 . '
           '; // END echo
    endif;
    if( !is_page(9707) ):
         echo '
               ' .
                    do_shortcode( " [av_masonry_entries link='op_kategorie,162,163,164,186'   date_filter_end='' date_filter_format='yy/mm/dd' sort='yes' query_orderby='menu_order' query_order='ASC' caption_elements='title' caption_styling='overlay' caption_display='always' size='fixed' orientation='av-orientation-square' gap='no' columns='6' av-medium-columns='4' av-small-columns='2' av-mini-columns='2' items='-1' paginate='load_more' color='custom' custom_bg='' overlay_fx='active' animation='' lazy_loading='enabled' id='op_masonry' custom_class='spec_sort_masonry masonrynav masonryit'  av_uid='av-k0jr2'] " )
                 . '
           '; // END echo
    endif;
    if( !is_page(17244) ):
         echo '
               ' .
                    do_shortcode( " [av_masonry_entries id='extras' link='extras_kategorie,364' wc_prod_visible='' wc_prod_hidden='hide' date_filter_format='yy/mm/dd' sort='yes' query_orderby='menu_order' query_order='ASC' caption_elements='title' caption_styling='overlay' caption_display='always' size='fixed' orientation='av-orientation-square' gap='no' columns='6' av-medium-columns='4' av-small-columns='3' av-mini-columns='2' items='-1' paginate='load_more' color='custom'  overlay_fx='active' animation='' lazy_loading='enabled'  custom_class='spec_sort_masonry seven_col masonrynav' av_uid='av-0jlr2'] " )
                 . '
           '; // END echo
    endif;
	if( !is_page(55966) ):
         echo '
               ' .
                    do_shortcode( " [av_masonry_entries id='vertief_masonry' link='kategorien_vertiefungen,613' wc_prod_visible='' wc_prod_hidden='hide' sort='no' query_orderby='menu_order' query_order='ASC' caption_elements='title' caption_styling='overlay' caption_display='always' size='fixed' orientation='av-orientation-square' gap='no' columns='6' av-medium-columns='4' av-small-columns='3' av-mini-columns='2' items='-1' paginate='load_more' color='custom'  overlay_fx='active' animation='' lazy_loading='enabled'  custom_class='spec_sort_masonry masonrynav' av_uid='av-0jlr2'] " )
                 . '
           '; // END echo
    endif;
    
}
add_action('ava_before_footer', 'ava_before_footer_mod', 999);

 
/*   	     		  jQuery in to the Footer     
********************************************************  */

function footer_jquery() { 
		
	?>

	<script>jQuery( document ).ready( function ($) {

		//   ____________________   Einblendung der TG Masonry
		//
		var topoffset =  $('#header').height();
		//
		function  FadeIn( $thisis, topoffset){
						//$param.hide();  
					$thisis.css({  "z-index": '400'  });
					$thisis.css({  "display": 'block'  }); 
					$thisis.animate({ 
								top: topoffset,
								opacity: '1' 
							}, 200, function() { // Code to call upon
					//  $thisis.addClass('fullvisible'); 
					$thisis.find('.av-masonry').css({  "top":  0 });
				//    
				}); 
		};// END FadeIn

		function FadeOut($thisis){
			$thisis.animate({
						top: '30',
						opacity: '0'  
							},100, function() { // Code to call upon 
					$thisis.css({  "display": 'none'  });
					$thisis.find('.av-masonry').css({  "top":  0 });


			}); 

		}; // END FadeOut
			
		// ____________________  Moussessions for masonry Header Navigation
		var timer; 
			/* **********************  Theoretische Grundlagen */	
			$('.tg').hover(function() {
				topoffset =  $('#header').height() ;
				// on mouse in, start a timeout
				timer = setTimeout(function() {
					FadeOut( $('#op_masonry') );   
					FadeOut( $('#extras') );
					FadeOut( $('#vertief_masonry') ); 
						FadeIn( $('#tg_masonry'), topoffset );   
					//  to reload masonry items
					$(window).trigger('resize');    
				}, 600);
			}, function() {
				// on mouse out, cancel the timer
				clearTimeout(timer);
			});	
			/* **********************  Orientierungsplan */	
			$('.op').hover(function() {
				topoffset =  $('#header').height() ;
				// on mouse in, start a timeout
				timer = setTimeout(function() {
					FadeOut( $('#tg_masonry') );   
					FadeOut( $('#extras') ); 
					FadeOut( $('#vertief_masonry') ); 
						FadeIn( $('#op_masonry'), topoffset );  
					// to reload masonry items
					$(window).trigger('resize');   
				}, 600);
			}, function() {
				// on mouse out, cancel the timer
				clearTimeout(timer);
			});		
			/* **********************  Extras */			
			$('.extras.hiddenmega').hover(function() {
				topoffset =  $('#header').height() ;
				// on mouse in, start a timeout
				timer = setTimeout(function() {
				FadeOut( $('#tg_masonry') );  
				FadeOut( $('#op_masonry')   ); 
				FadeOut( $('#vertief_masonry') ); 
					FadeIn( $('#extras'), topoffset ); 
					// to reload masonry items
					$(window).trigger('resize');  
				}, 600);
			}, function() {
				// on mouse out, cancel the timer
				clearTimeout(timer);
			});
			/* **********************  Vertiefungen */			
			$('.vertief.hiddenmega').hover(function() {
				topoffset =  $('#header').height() ;
				console.log(topoffset);
				// on mouse in, start a timeout
				timer = setTimeout(function() {
				FadeOut( $('#tg_masonry') );  
				FadeOut( $('#op_masonry') );  
				FadeOut( $('#extras') ); 
					FadeIn( $('#vertief_masonry'), topoffset ); 
					// to reload masonry items
					$(window).trigger('resize');  
				}, 600);
			}, function() {
				// on mouse out, cancel the timer
				clearTimeout(timer);
			});


			//
			/*
			$( '#tg_masonry .av-masonry' ).on('mouseover', function() {  
				Showin( $('#tg_masonry'), topoffset );   
			}); 
			*/
			//    
				$(document).mouseleave(function() {
				// console.log('out');
					FadeOut( $('#tg_masonry') );  
					FadeOut( $('#op_masonry') );  
					FadeOut( $('#extras') );
					FadeOut( $('#vertief_masonry') ); 

				});
				$('.av-logo-container').on('mouseover ', function() {  
						FadeOut( $('#tg_masonry') );  
						FadeOut( $('#op_masonry') );  
						FadeOut( $('#extras') );  
						FadeOut( $('#vertief_masonry') ); 

				}); // END deactivate
			//   
							$('#tg_masonry').on('mouseleave ', function() {  
								setTimeout(function() {
										FadeOut( $('#tg_masonry')  ); 
									}, 200);
							}); // END deactivate
							$('#op_masonry').on('mouseleave ', function() {  
								setTimeout(function() {
										FadeOut( $('#op_masonry')  ); 
									}, 200);
							}); // END deactivate    
							$('#extras').on('mouseleave ', function() {  
								setTimeout(function() {
										FadeOut( $('#extras')  ); 
									}, 200);
							}); // END deactivate    
							$('#vertief_masonry').on('mouseleave ', function() {  
								setTimeout(function() {
										FadeOut( $('#vertief_masonry')  ); 
									}, 200);
							}); // END deactivate    


			
	//    
	// on resize and scroll
		var lastScrollTop = 0, delta = 5;

			$(window).on('resize scroll', function() { 
			/*
				var currentpos1 = 0; 
				var currentpos2 = 0; 
				//
				
				if ( $('#tg_masonry').hasClass('masonrynav')  ) {
					var currentpos1 = $('#tg_masonry .av-masonry ').position().top;
				}; 
				// END if
				if ( $('#op_masonry').hasClass('masonrynav')  ) { 
				var currentpos2 = $('#op_masonry .av-masonry ').position().top; 
				}; // END if
				//
				*/
				
				topoffset =  $('#header').height(); 
				$('#tg_masonry, #op_masonry, #extras, #vertief_masonry ').css({  "top":  topoffset  });
				//  console.log(currentpos); 
				// 
				if( $(window).scrollTop() < 30 ) {
					
				//  console.log(' Oben isnull')
					topoffset =  $('#header').height(); 
					//
					currentpos1 = 0;
					currentpos2 = 0;
					//
					$('#tg_masonry, #op_masonry, #extras, #vertief_masonry ').css({  "top":  topoffset  });
					$('#tg_masonry .av-masonry, #op_masonry .av-masonry' , '#vertief_masonry .av-masonry' ).css({  "top":  $('.av-main-nav').height() });   // 
				
				}
				else{
					$('#tg_masonry', '#op_masonry', '#vertief_masonry'  ).css({  "top": topoffset  });
		
						var nowScrollTop = $(this).scrollTop();
						// console.log("nowScrollTop " + nowScrollTop ); 
					
					
				} // end else 
			
			});

			// scroll / resize the masonry 
		//
		
	//
	//
	//
	}); // END Doc ready
	//
	</script>
	<?php   
}
add_action( 'wp_footer', 'footer_jquery', 10 , 10 );
// END Scroll ////


//
/* RE           
masonry sort to make a link
https://kriesi.at/support/topic/linking-to-filtered-portfolio-ajax/#post-430830
https://kriesi.at/support/topic/direct-link-to-masonry-category/
****************************************************************************  ENFOLD  */


function ava_auto_click() {
	if (isset($_GET["psort"]) && $_GET["psort"] === "kultur" ) { 
?>
		<script> 
             jQuery(window).on('load', function () {
                jQuery('.teilhabe-an-kultur_sort_button').trigger('mouseover');
            });	 
        </script>
<?php
	} elseif ( isset($_GET["psort"]) && $_GET["psort"] === "arbeit" ) {
?>
		<script>
         jQuery(window).on('load', function () {
                jQuery('.teilhabe-an-arbeit_sort_button').trigger('mouseover');
            });	 
        </script>
<?php
	} elseif ( isset($_GET["psort"]) && $_GET["psort"] === "alltag" ) {
?>
		<script> 
            jQuery(window).on('load', function () {
                jQuery('.teilhabe-an-alltag_sort_button').trigger('mouseover');
            });	 
        </script>
<?php
	}
    
} // ava auto click
add_action('wp_footer', 'ava_auto_click');
/**/