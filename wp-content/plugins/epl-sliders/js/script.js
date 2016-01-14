var jssor_epl_slider = [];

//responsive code begin
//you can remove responsive code if you don't want the slider scales while window resizes
function epl_Slider_ScaleSlider() {

    jQuery.each(jssor_epl_slider, function( index, $slideElem ) {
      var parentWidth = $slideElem.$Elmt.parentNode.clientWidth;
      console.log(parentWidth);
        if (parentWidth)
            $slideElem.$ScaleWidth(Math.max(Math.min(parentWidth, 1920), 150));
        else
            window.setTimeout(epl_Slider_ScaleSlider, 30);
    });
    
    epl_slider_fix_grid();
}

/** fix slider width , height when grid is default view **/
function epl_slider_fix_grid() {
	if( jQuery('.epl-listing-grid-view').length ) {
	 	if(epl_frontend_vars.epl_default_view_type == 'grid' || eplGetCookie('preferredView') == 'grid') {
	 	
			jQuery.each(jssor_epl_slider, function( index, $slideElem ) {
			   $slideElem.$ScaleWidth( jQuery('.epl-listing-grid-view div').width() );
			});
		} else {
			jQuery.each(jssor_epl_slider, function( index, $slideElem ) {
			   $slideElem.$ScaleWidth( jQuery('.epl-slider-archive-wrapper').width() );
			});
		}
	}
	else if( jQuery('.property-featured-image-wrapper').length ) {
	 	if(epl_frontend_vars.epl_default_view_type != 'grid' || eplGetCookie('preferredView') != 'grid') {
	 	
			jQuery.each(jssor_epl_slider, function( index, $slideElem ) {
			   $slideElem.$ScaleWidth( jQuery('.property-featured-image-wrapper').width() );
			});
		} 
	}
}
 jQuery(document).ready(function ($) {
 
 	
 	/* adjust slider in grid & list view */
	jQuery('.epl-switch-view ul li').click(function(){
		
		var view = jQuery(this).data('view');
		if(view == 'grid'){
			jQuery.each(jssor_epl_slider, function( index, $slideElem ) {
			   $slideElem.$ScaleWidth( jQuery('.epl-listing-grid-view div').width() );
			});
		} else {
			jQuery.each(jssor_epl_slider, function( index, $slideElem ) {
			   $slideElem.$ScaleWidth( jQuery('.epl-slider-archive-wrapper').width() );
			});
		}
		
	});
 
 	// fancybox on slider images //
 	if($('.epl_slider_popup_image').length > 0) {
 		$('.epl_slider_popup_image').fancybox({
 			beforeLoad : function() {
 				jQuery.each(jssor_epl_slider, function( index, $slideElem ) {
					 $slideElem.$Pause(); 
				});
 			},
 			afterClose : function() {
 				jQuery.each(jssor_epl_slider, function( index, $slideElem ) {
					 $slideElem.$Play(); 
				});
 			}
 		});
 	}
    var $_SlideshowTransitionsOpts = {
     //Fade in R
       fade_in_l : {$Duration: 1200, x: -0.3, $During: { $Left: [0.3, 0.7] }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 } ,
        //Fade out L
    fade_in_r : { $Duration: 1200, x: 0.3, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 },
    //Zoom- in
    zoom_in : {$Duration: 1200, $Zoom: 1, $Easing: { $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseOutQuad }, $Opacity: 2 },
    //Zoom+ out
   zoom_out : {$Duration: 1000, $Zoom: 11, $SlideOut: true, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 },
    //Rotate Zoom- in
    rotate_zoom_in : {$Duration: 1200, $Zoom: 1, $Rotate: 1, $During: { $Zoom: [0.2, 0.8], $Rotate: [0.2, 0.8] }, $Easing: { $Zoom: $JssorEasing$.$EaseSwing, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseSwing }, $Opacity: 2, $Round: { $Rotate: 0.5} },
    //Rotate Zoom+ out
   rotate_zoom_out : {$Duration: 1000, $Zoom: 11, $Rotate: 1, $SlideOut: true, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} },

    //Zoom HDouble- in
   hdouble_zoom_in :  {$Duration: 1200, x: 0.5, $Cols: 2, $Zoom: 1, $Assembly: 2049, $ChessMode: { $Column: 15 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 },
    //Zoom HDouble+ out
   hdouble_zoom_out : {$Duration: 1200, x: 4, $Cols: 2, $Zoom: 11, $SlideOut: true, $Assembly: 2049, $ChessMode: { $Column: 15 }, $Easing: { $Left: $JssorEasing$.$EaseInExpo, $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 },

    //Rotate Zoom- in L
    rotate_zoom_in_left : {$Duration: 1200, x: 0.6, $Zoom: 1, $Rotate: 1, $During: { $Left: [0.2, 0.8], $Zoom: [0.2, 0.8], $Rotate: [0.2, 0.8] }, $Easing: { $Left: $JssorEasing$.$EaseSwing, $Zoom: $JssorEasing$.$EaseSwing, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseSwing }, $Opacity: 2, $Round: { $Rotate: 0.5} },
    //Rotate Zoom+ out R
   rotate_zoom_out_right :  {$Duration: 1000, x: -4, $Zoom: 11, $Rotate: 1, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInExpo, $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} },
    //Rotate Zoom- in R
    rotate_zoom_in_right : {$Duration: 1200, x: -0.6, $Zoom: 1, $Rotate: 1, $During: { $Left: [0.2, 0.8], $Zoom: [0.2, 0.8], $Rotate: [0.2, 0.8] }, $Easing: { $Left: $JssorEasing$.$EaseSwing, $Zoom: $JssorEasing$.$EaseSwing, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseSwing }, $Opacity: 2, $Round: { $Rotate: 0.5} },
    //Rotate Zoom+ out L
   rotate_zoom_out_left : {$Duration: 1000, x: 4, $Zoom: 11, $Rotate: 1, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInExpo, $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} },

    //Rotate HDouble- in
   rotate_hdouble_in :   {$Duration: 1200, x: 0.5, y: 0.3, $Cols: 2, $Zoom: 1, $Rotate: 1, $Assembly: 2049, $ChessMode: { $Column: 15 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseOutQuad, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.7} },
    //Rotate HDouble- out
    rotate_hdouble_out :  {$Duration: 1000, x: 0.5, y: 0.3, $Cols: 2, $Zoom: 1, $Rotate: 1, $SlideOut: true, $Assembly: 2049, $ChessMode: { $Column: 15 }, $Easing: { $Left: $JssorEasing$.$EaseInExpo, $Top: $JssorEasing$.$EaseInExpo, $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.7} },
    //Rotate VFork in
    rotate_vfork : {$Duration: 1200, x: -4, y: 2, $Rows: 2, $Zoom: 11, $Rotate: 1, $Assembly: 2049, $ChessMode: { $Row: 28 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseOutQuad, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.7} },
    //Rotate HFork in
    rotate_vfork : {$Duration: 1200, x: 1, y: 2, $Cols: 2, $Zoom: 11, $Rotate: 1, $Assembly: 2049, $ChessMode: { $Column: 19 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseOutQuad, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.8} }
    };
    
     var $_SlideshowTransitions = [];
     for(var transKey in $_SlideshowTransitionsOpts ) {
     	if( transKey == $_transitionChosen ) {
     		$_SlideshowTransitions.push($_SlideshowTransitionsOpts[transKey]);
     	}
     }
    /** add default fields **/
    
    eplSliderOptions['$SlideshowOptions']['$Class'] 				= $JssorSlideshowRunner$;
    eplSliderOptions['$SlideshowOptions']['$Transitions'] 			= $_SlideshowTransitions;
    eplSliderOptions['$ArrowNavigatorOptions']['$Class'] 			= $JssorArrowNavigator$;
    eplSliderOptions['$ThumbnailNavigatorOptions']['$Class'] 		= $JssorThumbnailNavigator$;
    
    $( ".epl_slider_container" ).each(function( index ) {
      jssor_epl_slider.push(new $JssorSlider$($(this).attr('id'), eplSliderOptions));
       
    });
    

    epl_Slider_ScaleSlider();
   

    $(window).bind("load", epl_Slider_ScaleSlider);
    $(window).bind("resize", epl_Slider_ScaleSlider);
    $(window).bind("orientationchange", epl_Slider_ScaleSlider);
    //responsive code end
});
