(function($) {	
//
    $(document).ready(function() {
        //
        //
        // Kommerzielles Nutzungsformular beim Start der Seite.
        //
      // Initialize the form's visibility based on the 'commercial' checkbox's state
            if ($('#commercial').prop('checked')) {
                $('.avia-cookie-consent-modal-buttons-wrap').fadeOut();
                $('#form_in_cookie').fadeIn();
            }

            // Event listener for .non_commercial click
            $(".non_commercial").click(function() {
                $('#commercial').prop('checked', false);
                
                setTimeout(function() {
                    if ($('#commercial.ckies').prop('checked')) {
                        $('.avia-cookie-consent-modal-buttons-wrap').hide();
                    }
                    if ($('#non_commercial').prop('checked')) {
                        $('.avia-cookie-consent-modal-buttons-wrap').fadeIn();
                        $('.commercial.ckies').fadeOut();
                        $('#commercial').prop('checked', false);
                    } else {
                        $('.avia-cookie-consent-modal-buttons-wrap').fadeOut();
                        $('.commercial.ckies').fadeIn();
                    }
                }, 200);
            });

            // Event listener for .commercial click
            $(".commercial").click(function() {
                $('#non_commercial').prop('checked', false);
                
                setTimeout(function() {
                    if ($('#commercial').prop('checked')) {
                        $('#non_commercial').prop('checked', false);
                        $('.avia-cookie-consent-modal-buttons-wrap').fadeOut();
                        switchToTab();
                    }
                }, 200);
            }); 
           // Function to simulate a click on the link to #tab-id-3
                function switchToTab() {
                    setTimeout(function() {
                        $("#link-to-tab3").trigger('click');
                    }, 500);
                }
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