/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */
/*====================================
=            Map function            =
====================================*/
var property_json = [];
(function($) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type  function
*  @date  8/11/2013
*  @since 4.3.0
*
*  @param $el (jQuery element)
*  @return  n/a
*/

function new_map( $el ) {
  
  // var
  var $markers = $el.find('.marker');
  
  
  // vars
  var args = {
    zoom    : 16,
    center    : new google.maps.LatLng(0, 0),
    mapTypeId : google.maps.MapTypeId.ROADMAP,
    scrollwheel : false
  };
  
  
  // create map           
  var map = new google.maps.Map( $el[0], args);
  
  
  // add a markers reference
  map.markers = [];
  
  
  // add markers
  $markers.each(function(){
    
      add_marker( $(this), map );
    
  });
  
  
  // center map
  center_map( map );
  
  
  // return
  return map;
  
}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type  function
*  @date  8/11/2013
*  @since 4.3.0
*
*  @param $marker (jQuery element)
*  @param map (Google Map object)
*  @return  n/a
*/

function add_marker( $marker, map ) {

  // var
  var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

  // create marker
  var marker = new google.maps.Marker({
    position  : latlng,
    map     : map
  });

  // add to array
  map.markers.push( marker );

  // if marker contains HTML, add it to an infoWindow
  if( $marker.html() )
  {
    // create info window
    var infowindow = new google.maps.InfoWindow({
      content   : $marker.html()
    });

    // show info window when marker is clicked
    google.maps.event.addListener(marker, 'click', function() {

      infowindow.open( map, marker );

    });
  }

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type  function
*  @date  8/11/2013
*  @since 4.3.0
*
*  @param map (Google Map object)
*  @return  n/a
*/

function center_map( map ) {

  // vars
  var bounds = new google.maps.LatLngBounds();

  // loop through all markers and create bounds
  $.each( map.markers, function( i, marker ){

    var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

    bounds.extend( latlng );

  });

  // only 1 marker?
  if( map.markers.length === 1 )
  {
    // set center of map
      map.setCenter( bounds.getCenter() );
      map.setZoom( 16 );
  }
  else
  {
    // fit to bounds
    map.fitBounds( bounds );
  }

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type  function
*  @date  8/11/2013
*  @since 5.0.0
*
*  @param n/a
*  @return  n/a
*/
// global var
var map = null;

$(document).ready(function(){

  $('.acf-map').each(function(){

    // create map
    map = new_map( $(this) );

  });

});

})(jQuery);

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events 
  $(document).ready(UTIL.loadEvents);

/*========================================
=            Filter Prototype            =
========================================*/
if (!Array.prototype.filter) {
  Array.prototype.filter = function (fn, context) {
    var i,
        value,
        result = [],
        length;
        if (!this || typeof fn !== 'function' || (fn instanceof RegExp)) {
          throw new TypeError();
        }
        length = this.length;
        for (i = 0; i < length; i++) {
          if (this.hasOwnProperty(i)) {
            value = this[i];
            if (fn.call(context, value, i, this)) {
              result.push(value);
            }
          }
        }
    return result;
  };
}

/*======================================
=            Alt text Icons            =
======================================*/
$('[data-toggle="tooltip"]').tooltip();



  /*==========================================
=            Youtube background            =
==========================================*/
// $('#main-content').YTPlayer({
//   videoId: $('#main-content').data('video-id'),
//    playerVars: {
//     modestbranding: 0,
//     autoplay: 1,
//     controls: 0,
//     showinfo: 0,
//     wmode: 'transparent',
//     branding: 0,
//     rel: 0,
//     autohide: 0
//   },
//   callback: function() {
//     // console.log($('#video-bg').data('video-id'));
//   }

//   });  

  /*======================================
  =            Choosen Select            =
  ======================================*/
  $("select").chosen({disable_search_threshold: 10});

  /*=============================================
  = Enabling multi-level navigation =
  ===============================================*/
  $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
      event.preventDefault(); 
      event.stopPropagation(); 
      $(this).parent().siblings().removeClass('open');
      $(this).parent().toggleClass('open');
  });

  

/*=============================================
=            Scrolling Menu Mobile            =
=============================================*/

var menuScroll = {
  setBackground : function(elem){
    $(window).scroll(function(event) {
     var st = $(this).scrollTop();

        
      if (st > 4){
             // downscroll code
            $(elem).addClass('solid');
            
       } else {
          // upscroll code
          $(elem).removeClass('solid');
       }
       
     
    });
  } 
};
menuScroll.setBackground('.banner');

/*===================================
  =            Owl Carousel           =
  ====================================*/
  var owl = jQuery(".owl-carousel");

  owl.owlCarousel({
    
    center:true,
    items:2,
    loop:true,
    margin:0,
    dots:false,
    navText:["NEXT","PREVIOUS"],
    responsive:{
        0:{
            items:1,
            nav:false
        },
        900:{
            items:2,
            nav:false
        },
        1200:{
            items:2,
            nav:false
        }
    }

  });
// Go to the next item
jQuery('.customNextBtn').click(function() {
    owl.trigger('next.owl.carousel');
});
// Go to the previous item
jQuery('.customPrevBtn').click(function() {
    // With optional speed parameter
    // Parameters has to be in square bracket '[]'
    owl.trigger('prev.owl.carousel', [300]);
});
/*====================================================
=           Social Networking Share Modal            =
====================================================*/

 
function appendShareLinks() {
    var fbLink = 'https://www.facebook.com/sharer/sharer.php?u='+location.href,
    twLink = 'https://twitter.com/home?status='+location.href,
    gpLink = 'https://plus.google.com/share?url='+location.href,
    ldLink = 'https://www.linkedin.com/shareArticle?mini=true&url='+location.href+'&title=Maxconnect&summary=&source=',
    mailLink= 'mailto:?Subject= Pinnacle Properties&Body=Hi look at this oportunity at '+location.href;
    if($("a.mailLink").length>0) {
        $("a.mailLink").attr('href',mailLink);
    }
    if($("a.fbLink").length>0) {
        $("a.fbLink").attr('href',fbLink);
    }
    if($("a.twLink").length>0) {
        $("a.twLink").attr('href',twLink);
    }
    if($("a.gpLink").length>0) {
        $("a.gpLink").attr('href',gpLink);
    }
    if($("a.ldLink").length>0) {
        $("a.ldLink").attr('href',ldLink);
    }
}
$('#shareBtn').on('click',function(){
    appendShareLinks();
    $('#myShareModal').modal();
});
appendShareLinks();


/*===================================
=            Menu Active            =
===================================*/

function menuActive(navTag){
    
    
    $(".menu-item-has-children > a").click(function(event){
      event.preventDefault();
      jQuery(this).toggleClass("active");
      jQuery(this).parent().siblings(".menu-item-has-children").children("a").removeClass("active");
    });

}

menuActive("nav");
/*===========================================
=            Toggle Active Class            =
===========================================*/
var toggleActiveClass = {
   toggle : function(container){
    jQuery(container+" span").click(function(){
      jQuery(this).toggleClass("active");
      jQuery(this).siblings().removeClass("active");
    });
   }

};


//toggleActiveClass.toggle();

/*=============================================
=            Get Suburbs from file            =
=============================================*/
/*$.getJSON( "script/post-codes.json", function( data ) {
  var items = [];
  $.each( data, function( key, val ) {
    items.push( "<li id='" + key + "'>" + val + "</li>" );
  });
 
  $( "<ul/>", {
    "class": "my-new-list",
    html: items.join( "" )
  }).appendTo( "body" );
});
*/

})(jQuery); // Fully reference jQuery after this point.

/*===================================
=            Clean Array            =
===================================*/
function cleanArray(actual) {
  var newArray = new Array();
  for (var i = 0; i < actual.length; i++) {
    // console.log(actual[i]);
    if (actual[i] != '') {
      newArray.push(actual[i]);
    }
  }
  return newArray;
}






/*=============================================================
=            Search Property (Defiant/Wp-Rest-API)            =
=============================================================*/
function toRad(number) { return number * Math.PI / 180; }

function getDistance(lat1,lon1,lat2,lon2){

var R = 6371; // km 
//has a problem with the .toRad() method below.
var x1 = lat2-lat1;
var dLat = toRad(x1);  
var x2 = lon2-lon1;
var dLon = toRad(x2);  
var a = Math.sin(dLat/2) * Math.sin(dLat/2) + 
                Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) * 
                Math.sin(dLon/2) * Math.sin(dLon/2);  
var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
var d = R * c; 
  return d
}

function tag_property(json){
  var arr = [];


jQuery.each(json, function (i, jsonSingle) {
          arr.push({
              property: jsonSingle
          });
    });           

 return arr; 

}



function load(callback,status,property_type){
    jQuery.ajax({  
        type: "get",  
        url: "http://www.pinnacleproperties.com.au/wp-json/wp/v2/json-"+property_type,  
        contentType: "application/json; charset=utf-8",  
        dataType: "json",  
        success: function (json) {
            // Call our callback with the message
           property_json = callback(json);
            
            var filter_current = '//property[property_meta/property_status = "'+status+'" ]';
            temp_json = JSON.search(property_json, filter_current );
            property_json = temp_json;
            var htm = Defiant.render('property', callback(temp_json));
            document.getElementById('output').innerHTML = htm;
        },  
        failure: function () {
           console.log("fail");
        }
     }); 

}


function search(){
  var bed   = jQuery("#bed").val().trim()!==""?jQuery("#bed").val():0,
      car   = jQuery("#car").val().trim()!==""?jQuery("#car").val(): 0,
      bath  = jQuery("#bath").val().trim()!==""?jQuery("#bath").val(): 0,
      type  = jQuery("#type").val(),
      suburb = jQuery("#suburb").val(),
      surrounding = jQuery("#surrounding").is(':checked');
      // console.log(surrounding);
      setCookie(bed, car, bath, type, suburb, surrounding);
/*=====================================================
=       Search Suburb(Unless Surrounding           =
=====================================================*/
var search_json;
var suburbSearch="";
var filter_suburb; 
    if (null !== suburb  && false == surrounding){
      for (var i = suburb.length - 1; i >= 0; i--) {
        if (i === 0){
          suburbSearch+="contains(property_term,'"+suburb[i]+"')";
        }else{
          suburbSearch+="contains(property_term,'"+suburb[i]+"') or ";
        }
      }
      filter_suburb = "//property["+suburbSearch+"]";
      search_json = JSON.search(tag_property(property_json), filter_suburb );
    } else {
      search_json = property_json;
    }
/*=======================================================
=            Filter by Bath,Bed,Type and Car            =
=======================================================*/
var filter_type = "//property[contains(property_meta/property_category,'"+type+"')]",
    filter_bed = "//property[property_meta/property_bedrooms >= "+bed+"]",
    filter_bath = "//property[property_meta/property_bathrooms >= "+bath+"]",
    filter_car = "//property[property_meta/property_garage >= "+car+"]";

    search_json = JSON.search(tag_property(search_json), filter_bath );
    search_json = JSON.search(tag_property(search_json), filter_car );
    search_json = JSON.search(tag_property(search_json), filter_bed );
    search_json = JSON.search(tag_property(search_json), filter_type );

/*=====================================================
=            Search Surrounding properties            =
=====================================================*/
    var closeProperies = [];
    if(null != suburb && true == surrounding){
    jQuery.getJSON('http://www.pinnacleproperties.com.au/wp-content/themes/Basetheme/dist/scripts/post-codes.json', function( data ) {
      var suburbPostcode="";
      if (null !== suburb ){
      for (var i = suburb.length - 1; i >= 0; i--) {
        if (0 === i){
          suburbPostcode+="name='"+suburb[i].toUpperCase()+"'";
        }else{
          suburbPostcode+="name='"+suburb[i].toUpperCase()+"' or ";
            }
        }
      }
      var filter_suburbPostcode = "//*["+suburbPostcode+"][state = 1]";

      var suburb_data = JSON.search(data,filter_suburbPostcode);
      // console.log(suburb_data);

      if (null != suburb_data  ){
      for (var i = suburb_data.length - 1; i >= 0; i--) {
            var subLat = suburb_data[i].lat;
            var subLng = suburb_data[i].lng;
        for(var j = search_json.length - 1; j >= 0; j--){
          var explodable = search_json[j].property.property_meta.property_address_coordinates[0];
          var propLat = explodable.split(',')[0];
          var propLng = explodable.split(',')[1];
              if(10 >= getDistance(subLat,subLng,propLat,propLng) && jQuery.inArray(search_json[j].property.slug,closeProperies != -1) ){
                closeProperies.push(search_json[j]);      
              }
          }
        
        }

      }
    
      var final_props = closeProperies;
      var htm = Defiant.render('property', final_props);
      if("" != htm ){
      document.getElementById('output').innerHTML = htm;
    } else {
      // warning = "<div id='no-results' class='text-center'><h3>Sorry, there isn't any results for that search</h3><p>try including surrounding properties</p></div>";
      // document.getElementById('output').innerHTML = warning;
      // var htm = Defiant.render('property', property_json);
    }
     });
  }
/*=============================================================
=            Returning Search JSON for Tempalting             =
=============================================================*/
if( 0 <= closeProperies.length ){
  search_json=tag_property(search_json);
  var htm = Defiant.render('property', search_json);
  document.getElementById('output').innerHTML = htm;
  }
}
/*=======================================
=            Call Properties            =
=======================================*/
if(saleType && property_type){
  switch(saleType) {
    case 'current':
      load(tag_property,'current',property_type); 
      break;
    case 'sold': 
      load(tag_property,'sold',property_type);
      break;
  
  case 'leased': 
      load(tag_property,'sold',property_type);
      break;
  }
}

/*===============================
=            Cookies            =
===============================*/

function setCookie(bed, car, bath, type, suburb, surrounding) {
    document.cookie = "bed="+bed+";";
    document.cookie = "car="+car+";";
    document.cookie = "bath="+bath+";";
    document.cookie = "type="+type+";";
    document.cookie = "suburb="+suburb+";";
    document.cookie = "surrounding="+surrounding+";";

}

function getCookie(cname) {
      jQuery("#bed").val(document.cookie("bed"));
      jQuery("#car").val(document.cookie("car"));
      jQuery("#bath").val(document.cookie("bath"));
      jQuery("#type").val(document.cookie("type"));
      jQuery("#suburb").val(document.cookie("suburb"));
      if(!document.cookie("surrounding")){
        jQuery("#surrounding").removeProp( "checked" );
      }

}

function cleanCookie() {
    document.cookie = "bed="";";
    document.cookie = "car="";";
    document.cookie = "bath="";";
    document.cookie = "type="";";
    document.cookie = "suburb="";";
    document.cookie = "surrounding="";";
}




