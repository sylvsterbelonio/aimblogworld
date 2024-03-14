<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Wrapper {

  function setListStyle($title,$value)
      {
      $CI =& get_instance();
      $CI->load->model("blog/mdlGeneral");    
      $theme = $CI->mdlGeneral->getTheme();      
      $h1 = $CI->mdlGeneral->getStyle("h1");      
      
      $html="";
      if($title!="") $html.="<style>.li-b b{color:".$theme["nBackColor"]."}</style><h1 style='".$h1."color:".$theme["nBackColor"]."'>".$title."</h1>";
                
      
      
      $col = explode("~",$value);
      $html.="<ul style='list-style:none'>";
      for($i=0;$i<count($col);$i++)
        {
        $html.="<li class='li-b'>".$col[$i]."</li>";
        }
      return $html."</ul>";
      }
      
  function setTableStyle($value)
      {
      $CI =& get_instance();
      $CI->load->model("blog/mdlGeneral");    
      $theme = $CI->mdlGeneral->getTheme();
      $td = $CI->mdlGeneral->getStyle("td");
      $row = explode("~",$value);
      $html="<style>.table-wrapper-cell tr td{} .table-wrapper-cell tr td b{color:".$theme["nBackColor"]."}</style>";
      $html.="<table class='table-wrapper-cell' style='width:100%'>";
      for($i=0;$i<count($row);$i++)
            {
            $html.="<tr>";
            $col = explode(":",$row[$i]);
            for($ii=0;$ii<count($col);$ii++)
                  {
                  $html.='<td valign=top style="padding:10px;" class="select-disabled">'.$col[$ii].'</td>';      
                  }
            $html.="</tr>";
            }
      return $html.'</table>';
      }    
  
  function setBxSlider($contentID,$title,$value,$order)
      {
      $CI =& get_instance();
      $CI->load->model("blog/mdlGeneral");      
      $CI->load->library("Url");
      $CI->load->library("Color");
      $CI->load->library("Youtube");
      
      $theme = $CI->mdlGeneral->getTheme();
      
      $rgb = $CI->color->string_to_rgb($theme["nBackColor"]);
      $html="";
      
      $html.='<link rel="stylesheet" href="'.base_url().'/controls/bxslider/css/jquery.bxslider.css" type="text/css" /><script src="'.base_url().'/controls/bxslider/js/jquery.min.js"></script><script src="'.base_url().'/controls/bxslider/js/jquery.bxslider.js"></script><script type="text/javascript" src="'.base_url().'js/scrolltop/jquery.easing.1.3.js"></script>';     
      $html.='<style>.bx-wrapper .bx-prev:hover {background:rgba('.$rgb.',1) url('.base_url().'controls/bxslider/css/images/controls.png) no-repeat 0 -32px;}.bx-wrapper .bx-next:hover {background:rgba('.$rgb.',1) url('.base_url().'controls/bxslider/css/images/controls.png) no-repeat -43px -32px;}.bx-wrapper .bx-caption {background: '.$theme["nBackColor"].';background: rgba('.$rgb.', 0.75);}.bx-wrapper .bx-pager.bx-default-pager a:hover,.bx-wrapper .bx-pager.bx-default-pager a.active {background: '.$theme["nBackColor"].';}.bx-wrapper .bx-pager.bx-default-pager a {background: '.$theme["container2"].';}.bx-wrapper .bx-loading {margin-top:50%;border: 4px solid '.$theme["container"].'; /* Light grey */border-top: 4px solid '.$theme["nBackColor"].'; /* Blue */}#bx-pager a:hover img,#bx-pager a.active img {border: solid '.$theme["nBackColor"].' 1px;}</style>';      
      
      $count=0;
      $col = explode(",",$value);
      
      $html.="<ul id='bxslider".$order."' class='bxslider'>";
      
      for($i=0;$i<count($col);$i++)
          {
              if (strpos($col[$i], '[') !== false) 
              {
              
              $caption = explode("[",$col[$i]);
              $mcol = str_replace("]","",$caption[1]);
              $src=$CI->url->getimgURL($mcol);
                            
              if($title=="youtube") $html.="<li><h1 style='line-height:45px;color:".$theme["nBackColor"]."' align=center class='select-disabled'>$caption[0]</h1>".$CI->youtube->getVideo($mcol)."</li>";
              else $html.="<li><img src='$src' title='".$caption[0]."' style='width:100%'></li>";
    
              }
              else
              {
              
              $src=$CI->url->getimgURL($col[$i]);
              if($title=="youtube") $html.="<li>".$CI->youtube->getVideo($mcol)."</li>"; 
              else $html.="<li><img src='$src' title='' style='width:100%'></li>"; 
              
              }
          
          }      
      $html.="</ul>";
      
      $CI->load->model("blog/mdlAttributes");
      $attrB = $CI->mdlAttributes->getBxSliderAttr($contentID);
      
      
      
      $html.='<script>$("img").bind("contextmenu",function(e) {return false;});$(document).ready(function(){$( "#bxslider'.$order.'" ).hover(function() {$(".bx-next,.bx-prev").show();$(".bx-caption").fadeIn(500);}, function() {if ($(".bx-controls-direction:hover").length != 0) {}else{$(".bx-next,.bx-prev").hide();$(".bx-caption").fadeOut(500);}   });$("#bxslider'.$order.'").bxSlider({'.$attrB.' onSliderLoad: function(){$(".bx-next,.bx-prev,.bx-caption").hide();},onSlideAfter: function(){}});});</script>';


      return $html;
      }
  
  function setSliceBox($contentID,$value)
      {
      $CI =& get_instance();
      $CI->load->model("blog/mdlGeneral");
      
      $CI->load->library("Url");
      $CI->load->model("mdlPages");
      $theme = $CI->mdlGeneral->getTheme();

      $html=' <script type="text/javascript" src="'.base_url().'controls/slicebox/js/jquery.slicebox.js"></script><link rel="stylesheet" type="text/css" href="'.base_url().'controls/slicebox/css/slicebox.css" /><div class="slicebox-mother-container"><div class="slicebox-wait"><div class="slicebox-loader"></div></div>';
       
      $html.='<div class="slicebox-container"><div class="wrapper"><ul id="sb-slider" class="sb-slider">';      
      $count=0;
      $col = explode(",",$value);
      for($i=0;$i<count($col);$i++)
          {
          
          $count++;
          
              if (strpos($col[$i], '[') !== false) 
              {
              $pageURL = explode("[",$col[$i]);
              //$mcol = str_replace("[","",$col[$i]);
              $mcol = str_replace("]","",$pageURL[1]);
              $src=$CI->url->getimgURL($mcol);
            
            $pageURL = $CI->mdlPages->getPageURL($pageURL[0]);
            if($pageURL!="")
                {
                 $html.='<li><a href="'.$pageURL.'" target="_blank"><img src="'.$src.'" alt=""/></a><div class="sb-description"><h3></h3></div></li>';                
                }
              }
          else
              {
              $src=$CI->url->getimgURL($col[$i]);
                 $html.='<li><img src="'.$src.'" alt=""/><div class="sb-description"><h3></h3></div></li>';                 
              }
          
          }
      
        $html.='</ul>			    <div id="nav-arrows" class="nav-arrows"><a href="#">Next</a><a href="#">Previous</a></div> <div id="nav-dots" class="nav-dots" style="z-index:1">
            ';
         for($i=0;$i<$count;$i++)
            {
            if($i==0) $html.='<span class="nav-dot-current"></span>';
            else $html.='<span></span>';
            }
         $html.='</div>
			   </div><!-- /wrapper -->';
			   
         $CI->load->model("blog/mdlAttributes");
         $attrB = $CI->mdlAttributes->getSliceBoxAttr($contentID);
         
             $html.='</div>';  
             $html.='
                <script type="text/javascript">
                $("img").bind("contextmenu",function(e) {return false;});
                $(function() {$( ".slicebox-container" ).hover(function() {   $(".nav-arrows").fadeIn(500);  }, function() {     $(".nav-arrows").fadeOut(500); });	var Page = (function() {					var $navArrows = $( "#nav-arrows" ).hide(),						$navDots = $( "#nav-dots" ).hide(),						$nav = $navDots.children( "span" ),						$shadow = $( "#shadow" ).hide(),						slicebox = $( "#sb-slider" ).slicebox( {							onReady : function() {	
                $(".slicebox-wait").hide();  
                $navArrows.show();								
                $navDots.show();								
                $shadow.show();           
                $(".nav-arrows").hide();},							
                onBeforeChange : function( pos ) {								
                $nav.removeClass( "nav-dot-current" );								
                $nav.eq( pos ).addClass( "nav-dot-current" );							
                },onAfterChange : function (pos) {},						
                colorHiddenSides : \''.$theme["nBorderColor"].'\',		
                '.$attrB.'		
                } )      ,											  	init = function() {							    initEvents();													    },						    initEvents = function() {							    $navArrows.children( ":first" ).on( "click", function() {								    slicebox.next();															    } );							        $navArrows.children( ":last" ).on( "click", function() {																        slicebox.previous();								return false;							    } );							$nav.each( function( i )     {															    $( this ).on( "click", function( event ) {																	    	var $dot = $( this );																	      	if( !slicebox.isActive() ) {										        $nav.removeClass( "nav-dot-current" );										        $dot.addClass("nav-dot-current" );																	        	}																	          	slicebox.jump( i + 1 );									           return false;														            		} );															} );					                	};						return { init : init };				                  })();				Page.init(); 			});		                </script>
              ';                   
                       
      return $html;
				       
      }
  
  function setText($title,$content)
      {
      $CI =& get_instance();
      $CI->load->model("blog/mdlGeneral");
      $theme = $CI->mdlGeneral->getTheme();   
      
      $h1 = $CI->mdlGeneral->getStyle("h1");
      $p = $CI->mdlGeneral->getStyle("p");
       
      $html="<style>
      .text-wrapper-header{
      ".$h1."
      color: ".$theme["nBackColor"]."
      }
      .text-wrapper-paragraph{
      ".$p."
      }
      .text-wrapper-paragraph b{
      color:".$theme["nBackColor"]."}
      </style>";
      
                if($title!="") $html.="<h1 class='text-wrapper-header select-disabled'>".$title."</h1>";
                if(isset($content)) $html.="<p class='text-wrapper-paragraph select-disabled'>".$content."</p>";            
      
      return $html; 
      }
  
  function setPDFViewer($title,$content)
      {
      $CI =& get_instance();
      $CI->load->model("blog/mdlGeneral");
      $theme = $CI->mdlGeneral->getTheme();   
      $h1 = $CI->mdlGeneral->getStyle("h1");
      $pdf = $CI->mdlGeneral->getStyle("pdf");
      $html="<style>
      .text-wrapper-header{
      ".$h1."
      color: ".$theme["nBackColor"]."
      }
      </style>";
      $h1 = $CI->mdlGeneral->getStyle("h1");
      $src=$CI->url->getpdfURL($content);
      
                if($title!="") $html.="<div><h1 class='text-wrapper-header select-disabled' align=center>".$title."</h1>";
                if(isset($content)) $html.='<embed  src="'.$src.'#toolbar=0" type="application/pdf" style="width:100%;'.$pdf.';border:1px solid '.$theme["container2"].'"/></div>';        
      return $html;      
      }  
      
  function setFlashPlayer($title,$content)
      {
      $CI =& get_instance();
      $CI->load->model("blog/mdlGeneral");
      $theme = $CI->mdlGeneral->getTheme();   
      $obj = $CI->mdlGeneral->getStyle("flash");      
      $html='<style>#swf-holder {height:100%;}#swf-holder object {display:block;width:100%;height:100%;'.$obj.'}</style>'; 
      $col=explode("?",$content);
      $height="100%";
      $width="100%";
      $src=$CI->url->getpdfURL($col[0]);
      if(count($col)>1) 
            {
            $rw = explode(",",$col[1]);
            for($i=0;$i<count($rw);$i++)
                {
                    if (strpos($rw[$i], 'width') !== false) 
                          {
                          $cl = explode(":",$rw[$i]);
                          $width=$cl[1];
                          }                
                    else if (strpos($rw[$i], 'height') !== false) 
                          {
                          $cl = explode(":",$rw[$i]);
                          $height=$cl[1];                          
                          }
                }
            }
      $html.='<div id="swf-holder"><object data="'.$src.'" type="application/x-shockwave-flash" style=";width:'.$width.';height:'.$height.'" ><param name="wmode" value="transparent"><param name="movie" value="'.$src.' /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="quality" value="high" /><param name="menu" value="false" /><param name="quality" value="high"/><p>You need Adobe Flash Player to view this content!</p></object></div>';
      return $html;
      }    
        
  function setElement($type,$content)
      {
          if (strpos($content, '[') !== false) 
          {
           $data = explode("[",$content);
           $style = str_replace("]","",$data[1]);   
           return "<$type style='$style'>$data[0]</$type>";       
          }
      else
          {
           return "<$type>$content</$type>";
          } 
      }
      
      
  function setData($contentID, $type,$title,$content,$order)
      {
      
      $CI =& get_instance();
      $CI->load->library("Youtube");
      $CI->load->library("Youtube");
      $CI->load->library("Server");
      
      $html="";
       if($type=="text")
                {
                $html.=$this->setText($title,$content);          
                }
      else if($type=="image")
                {
                if($title!="" && $title!="lightbox" && $title!="disabled") $html.="<h1>".$title."</h1>";
                if(isset($content)) 
                {
                    if ($title=="lightbox") $html.="
                    <link rel='stylesheet' type='text/css' href='".base_url()."controls/lightbox/css/lightbox.min.css' /> 
                    <script src='".base_url()."controls/lightbox/js/lightbox-plus-jquery.js'></script>		
                    <script type='text/javascript' src='".base_url()."js/scrolltop/modernizr.custom.11333.js'></script>
                    <script type='text/javascript' src='".base_url()."js/scrolltop/jquery.easing.1.3.js'></script>     
                    <style>.lightbox{display:none;}</style>         
                    <a href='".$CI->server->base_url().$content."' data-lightbox='loader-".$order."'><img oncontextmenu='return false;' src='".$CI->server->base_url().$content."' class='mydetails-image'></a>";           
                    else
                    $html.="<img oncontextmenu='return false;' src='".$CI->server->base_url().$content."' class='mydetails-image'>";         
                    
                }
                }
      else if($type=="youtube")
                {
                if($title!="") $html.="<h1>".$title."</h1>";
                if(isset($content))
                    {
                    $html.=$CI->youtube->getVideo($content);
                    }
                }
      else if($type=="pdf")
                {
                $html.=$this->setPDFViewer($title,$content); 
                }
      else if($type=="flash")
                {
                $html.=$this->setFlashPlayer($title,$content); 
                }                
      else if($type=="list")
                {
                $html.=$this->setListStyle($title,$content); 
                }      
      else if($type=="table")
                {
                if($title!="") $html.="<h1>".$title."</h1>";
                if(isset($content)) $html.=$this->setTableStyle($content); 
                }
      else if($type=="slicebox")
                {
                if(isset($content)) $html.=$this->setSliceBox($contentID,$content); 
                }   
      else if ($type=="bxslider")
                {
                if(isset($content)) $html.=$this->setBxSlider($contentID,$title,$content,$order); 
                }                 
      else
                {
                if($this->checkElement($type))
                    {
                    $html.=$this->setElement($type,$content); 
                    }
                else
                    {
                if($title!="") $html.="<h1>".$title."</h1>";
                if(isset($content)) $html.=$content;                     
                    }               
                }
      return $html;
      }
      
   private function checkElement($type)
      {
      $data = array('h1','h2','h3','h4','h5','h6','img','div','b','span','table');
      for($i=0;$i<count($data);$i++)
          {
          if($type==$data[$i]) return true;
          }
      return false;
      }   

}

?>
