<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/*   	     		   	jQuery in to the HEADER     
*************************************************************************************** */

//  Dies liegt jetzt in 2022 jeweils in der Seite oberhalb des Downloadbuttons.  und nicht mehr hier:
/**/
/*
function head_j() { 
?>
<script>
      function vgwPixelCall() {
document.getElementById("div_vgwpixel").innerHTML="<img src='https://vg08.met.vgwort.de/na/18c39dcaf73240778bc8d451f22befb8' width='1' height='1' alt=''>";
      }
</script>
<?php   }
add_action( 'wp_head', 'head_j', 10 , 1000 );
*/
// END in footer some jQuery  



/*   	     		   	jQuery in to the Footer     
*************************************************************************************** */
function footer_j() { 
?>
<script type='text/javascript' src='https://qualitaetsoffensive-teilhabe.de/wp-content/themes/enfold-child/js/js-special.js' id='js-special'></script>	 
 
<script>	

 jQuery( document ).ready( function ($) {

       //  sdm_download_button
       var hrefle = $('.sdm_download_button').find('a').attr('href');
       //  console.log( hrefle  );
       $('.sdm_download_thumbnail img').wrap('<a href="' + hrefle +'" target="_blank"></a>'); // And wrap the image
    
       // END Dowonload button

		// Video no contextmenu 
		$('video').bind('contextmenu',function() { return false; });
		//  zusätzliches verhindern des Downloads in der .htaccess Datei
		//			
		//	av-icon-char mfp-iframe
		//		
		// $('.av-icon-char.mfp-iframe').removeClass('lightbox-added');			
		// $('.av-icon-char.mfp-iframe').addClass('noLightbox');	
		// $('.av-icon-char.mfp-iframe').removeClass('mfp-iframe');
		// 
		// 
		// 
		// 
		// lightboxadded  for videos in Überblickvideos
		// 
	   /* 	setTimeout(function() { 
  			$('#lightboxadded').find('.attachment').addClass('lightbox');
   		 }, 500);
	  */
		
     /* 
     $('#menu-item-9705').on('mouseover', function() { 
     });// END mouseover*/
     
        var width_li = $('a.av-masonry-entry').width();
        var height_li = $(' .menu-item-top-level-1 ul li.units').width()
        //
        // $(' .menu-item-top-level-1 ul li.units').width(width_li);
		//
		//
		//  $(' .menu-item-top-level-1 ul li.units').height( height_li  );
		//  
		//  
		//  
		//  
          //  header inner-container   Append Book Cover
       /* $('header .inner-container').append("<span class='book_ad'><a href='https://qualitaetsoffensive-teilhabe.de/#publikation' class='' rel='noopener noreferrer'><img class='imgbook' src='https://qualitaetsoffensive-teilhabe.de/wp-content/uploads/2021/04/QualitaetsoffensiveTeilhabe_Cover.jpg' alt='Qualitätsoffensive Teilhabe Buch' title='Qualitätsoffensive – Teilhabe von erwachsenen Menschen mit schwerer Behinderung – Grundlagen für die Arbeit in Praxis Aus- und Weiterbildung – Erhältlich als Buch'  itemprop='thumbnailUrl' width='100' height='142'></a> </span> "); */
      //
    
    /* */ 
     //
     // 
     //
}); // END Doc ready
</script>
<?php   }
add_action( 'wp_footer', 'footer_j', 10 , 1000 );
// END Scroll ////
// END in fooer sme jQuery  



/*   	     		   	jQuery in to the Footer     
************************************************************************************** */

function footer_jdsf2() { 

if( is_singular( array('orientierungsplan','theor_grundlagen','vertiefungen' ) )   ):   ?> <script>	
 
    jQuery( document ).ready( function ($) {
 
                 var Scroll = false; 
                if(jQuery('.av-submenu-container')  ){
                    var pos_y = jQuery('.av-submenu-container').position();
                    // console.log("pos_y "  +  pos_y);
                };
                /* Scrolling */
            $(window).on('scroll', function() {   
                     setTimeout(function() {
                          if( jQuery(window).scrollTop()  > pos_y.top ){ 
                            jQuery('.av-submenu-container').addClass('fixed');
                          }
                         else{
                            jQuery('.av-submenu-container').removeClass('fixed');
                          }
                    }, 400); /*set setTimeout END */
                
            });// END Scroll new 
                //
                //
                //
                //
        }); // END Doc ready
    //
    //
 </script> <?php  endif; }
//
//
add_action( 'wp_footer', 'footer_jdsf2', 10 , 10 );
// END Scroll ////
// END in fooer sme jQuery  
// 






/*   	     		   	jQuery Footer     
************************************************************************************** */

function footer_scrollscript() { 
 
  if( is_single( '46046' ) || is_page('9707')  || is_single('55423') ):   ?> <script>	
	
 	console.log('sticky menu page ' );
	//
    (function($) {

		$(window).on( 'resize', function(){ 
				 clearTimeout(window.Finished);
					window.Finished = setTimeout(function(){
						// console.log('Resized finished.');
						// ausführen der Funktion  
						checkplace();
					}, 10); 
			});
			$(window).on( 'scroll',  function(){
				 clearTimeout(window.Finished);
					window.Finished = setTimeout(function(){
						// ausführen der Funktion
						checkplace();
						// console.log('Scroll finished ' + scrollPos );

					}, 10); 
			});
			// 
			 function checkplace( scrollPos ){
				 	var menu_pos = $(".av-masonry-entries").offset().top - $("header").height()  + 2 ;
				 if( $("body").hasClass('admin-bar') ){
						var menu_pos = $(".av-masonry-entries").offset().top - $("header").height() - $("#wpadminbar").height()  + 2 ;		
					}
				 
				 //console.log("menu_pos  " + menu_pos );		
					 var scrollPos = $(document).scrollTop(); 

				 if ( menu_pos <= scrollPos  ){
					$(".av-masonry-entries .av-masonry-sort").addClass("sticky");
				 }
				 else {
				   $('.av-masonry-entries .av-masonry-sort').removeClass("sticky");
				 }
			}	
	//        
	})(jQuery);     
 </script> 



<?php  endif; }
//
add_action( 'wp_footer', 'footer_scrollscript', 10 , 10 );

 





/*   	     		   	jQuery   Post  Table Pro   
************************************************************************************** */

function footer_ptp() { 

if( is_single( 18697 )   ):   
  
?> <script>	
    //
    // on init data Table 
    //  https://datatables.net/manual/events
    //  
    
    function seturl( table_id ){
        //
        console.log(table_id);  
         //
         jQuery( ".col-url" ).each(function( index ) {
             var pt_href = jQuery( this ).find('a').attr('href');
             //
             if(  pt_href ) {
                //     console.log( "pt_href  " + pt_href  );
                jQuery(this).parent('.post-row').find('.col-title').wrapInner('<a href="' + pt_href +'" target="_blank"></a>'); // And wrap the image
            }  
         }); // END each
    }; // END seturl
    //
    //
    //
    //
  /*  jQuery(document).on( 'init.dt', function ( e, settings ) {
        var api = new jQuery.fn.dataTable.Api( settings );
     
          // alert( 'Table redrawn' );
            jQuery( ".col-url" ).hide();
            //
              var table_id = jQuery('table').attr('id'); 
             // var table = jQuery('table').DataTable(); 
        
            setTimeout(function() {
                    seturl( table_id );
            }, 100); //set setTimeout END   
        
        
      //    console.log( 'New DataTable created:', api.table().node() );
    });
    */
    // on change data table 
   jQuery( document ).ready( function ( table_id ) {
       //
       jQuery( table_id ).on( 'draw.dt', function () {
                console.log('Table redrawn');   
                seturl( table_id );
        });
       
      /*    setTimeout(function() {
              var table_id = jQuery( 'table' ).attr('id'); 
             var table_id = '#' + jQuery( 'table' ).attr('id');
            console.log(table_id);  
             
                    seturl( table_id );
        */ 
            /* 
              jQuery( table_id ).on( 'draw.dt', function () {
                 console.log('redrawn');    
            });
             jQuery( table_id ).on( 'length.dt', function ( e, settings, len ) {
                console.log( 'New page length: '+len );
            });
             */
      //   }, 1700); /*set setTimeout END */ 
        
        // var table_id = jQuery( 'table' ).attr('id');
         
       
        // var table = jQuery( 'table' ).DataTable(); 
             
       /* */
     }); // END Doc ready
  
    //
    //
 </script> <?php  endif;  

}
//
// add_action( 'posts_table_after_get_table', 'footer_ptp', 10 , 10 );
//add_action('posts_table_args_updated', 'footer_ptp', 10 , 10 );
add_action( 'wp_footer', 'footer_ptp', 10 , 10000 );
// END Scroll ////
// END in Footer some jQuery  

