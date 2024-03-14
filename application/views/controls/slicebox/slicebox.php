<?php 
$this->load->model("mdlGeneral");
$this->load->library("Color");
$this->load->model("mdlSlideShow");
$slideshows = $this->mdlSlideShow->getSlideShow();  
$theme = $this->mdlGeneral->getTheme();
$rgb = $this->color->string_to_rgb($theme["nBackColor"]);
?>
<script type="text/javascript" src="<?=base_url()?>controls/slicebox/js/jquery.slicebox.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>controls/slicebox/css/slicebox.css" />
  <div class="slicebox-mother-container">
      <div id="slicebox-wait">
          <div class="slicebox-loader"></div>
      </div>
        <?=$slideshows?>
  </div>  
<script type="text/javascript">$(function() {$( ".slicebox-container" ).hover(function() {   $(".nav-arrows").fadeIn(500);  }, function() {     $(".nav-arrows").fadeOut(500); });	var Page = (function() {					var $navArrows = $( '#nav-arrows' ).hide(),						$navDots = $( '#nav-dots' ).hide(),						$nav = $navDots.children( 'span' ),						$shadow = $( '#shadow' ).hide(),						slicebox = $( '#sb-slider' ).slicebox( {							onReady : function() {								$navArrows.show();								$navDots.show();								$shadow.show();         $("#slicebox-wait").hide();    $(".nav-arrows").hide();},							onBeforeChange : function( pos ) {								$nav.removeClass( 'nav-dot-current' );								$nav.eq( pos ).addClass( 'nav-dot-current' );							},onAfterChange : function (pos) {},							
colorHiddenSides : '<?=$theme["nBorderColor"]?>',		
orientation : 'r',							
cuboidsRandom : false,		
disperseFactor : 30,							
autoplay : true,							
interval: 5000,						

} )      ,											  	init = function() {							    initEvents();													    },						    initEvents = function() {							    $navArrows.children( ':first' ).on( 'click', function() {								    slicebox.next();								slicebox.slicebox( {autoplay:true});							    } );							        $navArrows.children( ':last' ).on( 'click', function() {																        slicebox.previous();								return false;							    } );							$nav.each( function( i )     {															    $( this ).on( 'click', function( event ) {																	    	var $dot = $( this );																	      	if( !slicebox.isActive() ) {										        $nav.removeClass( 'nav-dot-current' );										        $dot.addClass( 'nav-dot-current' );																	        	}																	          	slicebox.jump( i + 1 );									           return false;														            		} );															} );					                	};						return { init : init };				                  })();				Page.init(); 			});		                </script>
