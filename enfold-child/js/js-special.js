(function($) {	
//
    $(document).ready(function() {
        // console.log("doc ready js-specials.js in footer");          
                //
                $('#form_in_cookie').fadeOut();
                // this function shows in the cookies the content below 
                if( $('#cook_nutz_id').prop('checked')) {
						$('#n_formen').fadeIn();
                }
                if( $('#commercial').prop('checked')     ) {   
                    $(' .avia-cookie-consent-modal-buttons-wrap').fadeOut();
                    $('#form_in_cookie').fadeIn();
                }
                //
                //
                $( ".nutzungsbedingungen_acc" ).click (function(){
                    //
                    setTimeout(function() {
                        //    
                        if( $('#cook_nutz_id').prop('checked')) {
                            $('#n_formen').fadeIn();
                           // console.log("propperty checked");  
                        } 
                        else{  
                            // console.log("propperty else than checked");  
                            $('#n_formen').fadeOut();
                        }
                    }, 200);
                }); // End Nutzbedingungen  Click
                // 
                // Buttons non commercial and commercial function
                // non Commercial
				$( ".non_commercial" ).click (function(){
                    $('#commercial').prop('checked', false);
                    setTimeout(function() {
                        if( $('#commercial.ckies').prop('checked')) {
                            $('.avia-cookie-consent-modal-buttons-wrap').hide();
							// $('#non_commercial').fadeOut(); 
                        // something when checked
                        }
                        if( $('#non_commercial').prop('checked')) {
                            $('.avia-cookie-consent-modal-buttons-wrap').fadeIn(); 
                           //  $('.commercial.ckies').fadeOut(); 
                            $('#commercial').prop('checked', false);
                        }else {
                            $(' .avia-cookie-consent-modal-buttons-wrap').fadeOut(); 
							// $('.commercial.ckies').fadeIn(); 
                            
                        }
                    }, 200); // milliseconds
				});// End Function a click 
				//  commercial
				$( ".commercial" ).click (function(){
                    $('#non_commercial').prop('checked', false);
                    setTimeout(function() { 
                        if( $('#commercial').prop('checked')     ) {  
                            $('#non_commercial').prop('checked', false);
                            $(' .avia-cookie-consent-modal-buttons-wrap').fadeOut();

                             $('#form_in_cookie').fadeIn();
                        } 
                    }, 200); // milliseconds
				});// End Function a click
                // 
                //
                //  The Timeframed 
                // 
                //
                //
                //
                // av-sending-button
                $( "#av-consent-extra-info .form_element .button" ).mouseup (function(){
                    setTimeout(function() {
						
                       if( $('#av-consent-extra-info  .ajaxresponse').is(":visible")    ) {
                            // dann zeige schließen Button 
                            $('.avia-cookie-consent-modal-buttons-wrap').fadeIn(400); 
                        } 
                       
                    }, 1500);  // milliseconds
                });
		//
		//
		//
		// Video verzögert hinzu laden.
		// Einzelfragen Videos 
		// $( ".videoaccordeon .entry-content-wrapper ul li" ).css(" list-style: "+ " !important;");  //   list-style: "+ " !important;
		//foreach{ }  .videoaccordeon .a - remove attr href and save in variable     // and find the .avia-video  wich is next to it
		//
		var closeallvideos = function(){
			//
			$(".videoaccordeon .avia-video").fadeOut();
			$(".videoaccordeon li").css('list-style','"+ "');
		};
		closeallvideos();
		//
		$( ".videoaccordeon li" ).each(function(  ) {
			//
			//
			$(this).find("a").removeAttr("href");
		}); // END each
		
		$(".videoaccordeon li a").click(function(){
			//
			closeallvideos(); 
            // if the child video is visible
            // var thevideo = $(this).parent().find(".avia-video");
				$(this).parent().find(".avia-video").fadeToggle();
				// bei Click auf einen Link werden alle Vdeoplayer pausiert.
				$("video").each(function(){
					this.player.pause() 
				}); //  $(this).parent().find("video").player.play();
				//
				$(this).parent().css('list-style','"- "');
		}); // END on Click
		// 
		

	}); // End Docready
         
    
//        
})(jQuery); 
//