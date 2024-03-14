<?php
$this->load->model("blog/mdlGeneral");
 $this->load->library('Color');
$theme = $this->mdlGeneral->getTheme();
$rgb = $this->color->string_to_rgb($theme["container"]);
$red = $this->color->string_to_rgb($theme["nBorderColor"]);
?>
  <link rel="stylesheet" href="<?=base_url()?>/controls/bxslider/css/jquery.bxslider.css" type="text/css" />


<style>
.menu-blog-summary{
background:<?=$theme["container"]?>;
}
.menu-blog-summary table{
margin-left:0px;
}
.menu-blog-summary table tr td span{
padding:5px 0px 5px 0px;
font-size:200%;
line-height:1;
display:block;
width:100%;
}

.menu-blog-summary table tr td{
width:33%;
} 

.menu-blog-summary table{


}



.postlist table{
width:100%;
}
.postlist:hover{
background:<?=$theme["nBackColor"]?>;
cursor:pointer;
color:<?=$theme["hForeColor"]?>;
}
.postlist table tr td:nth-of-type(1){
width:1%;
}
.postlist table tr td:nth-of-type(1) img{
width:100x;
height:100px;
}
.postlist table tr td:nth-of-type(2){
position:relative
}
.postlist table tr td:nth-of-type(2) span:nth-of-type(1){
font-size:200%;
}
.postlist table tr td:nth-of-type(2) span:nth-of-type(2){
font-size:180%;
margin-bottom:30px;
}
.postlist table tr td:nth-of-type(2) div:nth-of-type(1){
float:right;font-size:150%;position:absolute;bottom:0px
}
.postlist table tr td:nth-of-type(2) div:nth-of-type(2){
float:left;font-size:150%;position:absolute;bottom:0px;right:0px
}

@media only screen and (max-width: 760px),(min-device-width: 768px) and (max-device-width: 1024px)  {
.menu-blog-summary table tr td{
width:100%;
} 

.postlist table tr td:nth-of-type(2) div:nth-of-type(1){
position:relative;
}
.postlist table tr td:nth-of-type(2) div:nth-of-type(2){
position:relative;
}
}

.postlist button:hover{
background:<?=$theme["container2"]?>;
color:<?=$theme["nBackColor"]?>;
border:1px solid <?=$theme["nBackColor"]?>;
}

.postlist{


		background-color: <?=$theme["nBackColor"]?>;
		background-image: -moz-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["nBackColor"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["nBorderColor"]?>), to(<?=$theme["nBackColor"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["nBackColor"]?>);	
		background-image: -o-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["nBackColor"]?>);
		background-image: -ms-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["nBackColor"]?>);
		background-image: linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["nBackColor"]?>);
		-moz-box-shadow: 0 1px 1px <?=$theme["nBorderColor"]?>, 0 1px 0 <?=$theme["nBackColor"]?> inset;
		-webkit-box-shadow: 0 1px 1px <?=$theme["nBorderColor"]?>, 0 1px 0 <?=$theme["nBackColor"]?> inset;
}

</style>  

<div class="menu-blog-summary ui-state-animate-6s">
      <table border=0 class="ui-widget-table  " >
      <tr>
            <td valign=top>
                    <span align=center class="ui-widget-header">CURRENT ACTIVITIES</span>
                    
                    <div class="postlist ui-widget-header">
                    <table  class="ui-state-animate-6s">
                    <tr>
                          <td valign=top >
                                <img src="<?=base_url()?>images/system/noproduct.png">
                          </td>
                          <td valign=top>
                                <span><b>YOUR TITLE HERE</b></span>
                                <span>
                                You paragraph here. You paragraph here. You paragraph here. You paragraph h...
                                </span>
                              
                                <div>
                                <b>Date Published:</b> <i>2015/2/2</i>
                                </div>
                                <div>
                                <b>By:</b> <i>Sylvster</i>
                                </div>
                          </td>
                    
                    </tr>
                    
                    </table>
                    </div>

                    <div class="postlist ui-widget-header">
                    <table  class="ui-state-animate-6s">
                    <tr>
                          <td valign=top >
                                <img src="<?=base_url()?>images/system/noproduct.png">
                          </td>
                          <td valign=top>
                                <span><b>YOUR TITLE HERE</b></span>
                                <span>
                                You paragraph here. You paragraph here. You paragraph here. You paragraph h...
                                </span>
                              
                                <div>
                                <b>Date Published:</b> <i>2015/2/2</i>
                                </div>
                                <div>
                                <b>By:</b> <i>Sylvster</i>
                                </div>
                          </td>
                    
                    </tr>
                    
                    </table>
                    </div>

                    <div class="postlist ui-widget-header">
                    <table  class="ui-state-animate-6s">
                    <tr>
                          <td valign=top >
                                <img src="<?=base_url()?>images/system/noproduct.png">
                          </td>
                          <td valign=top>
                                <span><b>YOUR TITLE HERE</b></span>
                                <span>
                                You paragraph here. You paragraph here. You paragraph here. You paragraph h...
                                </span>
                              
                                <div>
                                <b>Date Published:</b> <i>2015/2/2</i>
                                </div>
                                <div>
                                <b>By:</b> <i>Sylvster</i>
                                </div>
                          </td>
                    
                    </tr>
                    
                    </table>
                    </div>
                    

                    
  
                    <div class="postlist" style="position:relative;display:block;background:<?=$theme["container2"]?>;margin:0 auto;width:120px;margin-top:5px;margin-bottom:5px">
                 
                    <button style="font-size:200%;border-radius:0px"><b><</b></button>
                       <button style="font-size:200%;border-radius:0px;"><b>More</b></button>
                    <button style="font-size:200%;border-radius:0px"><b>></b></button>
                    
                    </div>
                      
                    <div style="clear:both"></div>                                                               
            </td>
      
      
      
      
      
      
      
      
      
      

      
      <td valign=top>
      <span align=center class="ui-widget-header">HEALTH & EDUCATION</span>
          
                    
                    <div class="postlist ui-widget-header">
                    <table  class="ui-state-animate-6s">
                    <tr>
                          <td valign=top >
                                <img src="<?=base_url()?>images/system/noproduct.png">
                          </td>
                          <td valign=top>
                                <span><b>YOUR TITLE HERE</b></span>
                                <span>
                                You paragraph here. You paragraph here. You paragraph here. You paragraph h...
                                </span>
                              
                                <div>
                                <b>Date Published:</b> <i>2015/2/2</i>
                                </div>
                                <div>
                                <b>By:</b> <i>Sylvster</i>
                                </div>
                          </td>
                    
                    </tr>
                    
                    </table>
                    </div>

                    <div class="postlist ui-widget-header">
                    <table  class="ui-state-animate-6s">
                    <tr>
                          <td valign=top >
                                <img src="<?=base_url()?>images/system/noproduct.png">
                          </td>
                          <td valign=top>
                                <span><b>YOUR TITLE HERE</b></span>
                                <span>
                                You paragraph here. You paragraph here. You paragraph here. You paragraph h...
                                </span>
                              
                                <div>
                                <b>Date Published:</b> <i>2015/2/2</i>
                                </div>
                                <div>
                                <b>By:</b> <i>Sylvster</i>
                                </div>
                          </td>
                    
                    </tr>
                    
                    </table>
                    </div>

                    <div class="postlist ui-widget-header">
                    <table  class="ui-state-animate-6s">
                    <tr>
                          <td valign=top >
                                <img src="<?=base_url()?>images/system/noproduct.png">
                          </td>
                          <td valign=top>
                                <span><b>YOUR TITLE HERE</b></span>
                                <span>
                                You paragraph here. You paragraph here. You paragraph here. You paragraph h...
                                </span>
                              
                                <div>
                                <b>Date Published:</b> <i>2015/2/2</i>
                                </div>
                                <div>
                                <b>By:</b> <i>Sylvster</i>
                                </div>
                          </td>
                    
                    </tr>
                    
                    </table>
                    </div>
                    

                    
  
                    <div class="postlist" style="position:relative;display:block;background:<?=$theme["container2"]?>;margin:0 auto;width:120px;margin-top:5px;margin-bottom:5px">
                 
                    <button style="font-size:200%;border-radius:0px"><b><</b></button>
                       <button style="font-size:200%;border-radius:0px;"><b>More</b></button>
                    <button style="font-size:200%;border-radius:0px"><b>></b></button>
                    
                    </div>
                      
                    <div style="clear:both"></div>                                                               
       
      </td>
      <td valign=top>
      <span align=center class="ui-widget-header">BUSINESS LEARNINGS</span>

                    
                    <div class="postlist ui-widget-header">
                    <table  class="ui-state-animate-6s">
                    <tr>
                          <td valign=top >
                                <img src="<?=base_url()?>images/system/noproduct.png">
                          </td>
                          <td valign=top>
                                <span><b>YOUR TITLE HERE</b></span>
                                <span>
                                You paragraph here. You paragraph here. You paragraph here. You paragraph h...
                                </span>
                              
                                <div>
                                <b>Date Published:</b> <i>2015/2/2</i>
                                </div>
                                <div>
                                <b>By:</b> <i>Sylvster</i>
                                </div>
                          </td>
                    
                    </tr>
                    
                    </table>
                    </div>

                    <div class="postlist ui-widget-header">
                    <table  class="ui-state-animate-6s">
                    <tr>
                          <td valign=top >
                                <img src="<?=base_url()?>images/system/noproduct.png">
                          </td>
                          <td valign=top>
                                <span><b>YOUR TITLE HERE</b></span>
                                <span>
                                You paragraph here. You paragraph here. You paragraph here. You paragraph h...
                                </span>
                              
                                <div>
                                <b>Date Published:</b> <i>2015/2/2</i>
                                </div>
                                <div>
                                <b>By:</b> <i>Sylvster</i>
                                </div>
                          </td>
                    
                    </tr>
                    
                    </table>
                    </div>

                    <div class="postlist ui-widget-header">
                    <table  class="ui-state-animate-6s">
                    <tr>
                          <td valign=top >
                                <img src="<?=base_url()?>images/system/noproduct.png">
                          </td>
                          <td valign=top>
                                <span><b>YOUR TITLE HERE</b></span>
                                <span>
                                You paragraph here. You paragraph here. You paragraph here. You paragraph h...
                                </span>
                              
                                <div>
                                <b>Date Published:</b> <i>2015/2/2</i>
                                </div>
                                <div>
                                <b>By:</b> <i>Sylvster</i>
                                </div>
                          </td>
                    
                    </tr>
                    
                    </table>
                    </div>
                    

                    
  
                    <div class="postlist" style="position:relative;display:block;background:<?=$theme["container2"]?>;margin:0 auto;width:120px;margin-top:5px;margin-bottom:5px">
                 
                    <button style="font-size:200%;border-radius:0px"><b><</b></button>
                       <button style="font-size:200%;border-radius:0px;"><b>More</b></button>
                    <button style="font-size:200%;border-radius:0px"><b>></b></button>
                    
                    </div>
                      
                    <div style="clear:both"></div>                                                               
       
      </td>
      
      </tr>
      </table>
</div>



<script>
$(document).ready(function(){
  $('#bxslider1').bxSlider({
  height:500,
  auto: true, //set automatic slides
  //mode: 'vertical|horizontal|fade',
  //captions: true,
  pause: 5000,
  //infiniteLoop: false,
  //hideControlOnEnd: true,
  //startSlide: 2, //the start of slide when first loaded
  //moveSlides: 1,
  minSlides: 1, //minimum slides if zoom in
  //maxSlides: 3, //max slides to display in one container
  //slideMargin: 10, //margin of each side of every slides
  slideWidth: 100 //the width of all slides
  //ticker: true,
  //speed:6000,  
  onSliderLoad: function(){
    // do funky JS stuff here
    //alert('Slider has finished loading. Click OK to continue!');
    $(".bx-viewport").css("height",450).css("margin-left",5);


  },
  onSlideAfter: function(){
    // do mind-blowing JS stuff here
    //alert('A slide has finished transitioning. Bravo. Click OK to continue!');
  }
});

  $('#bxslider2').bxSlider({
  height:500,
  auto: true, //set automatic slides
  pause: 7000,
  minSlides: 1, //minimum slides if zoom in
  onSliderLoad: function(){
     $(".bx-viewport").css("height",450).css("margin-left",5);
  },
  onSlideAfter: function(){
    // do mind-blowing JS stuff here
    //alert('A slide has finished transitioning. Bravo. Click OK to continue!');
  }
});

  

  $('#bxslider3').bxSlider({
  height:500,
  auto: true, //set automatic slides
  pause: 9000,
  adaptiveHeight: false,
  minSlides: 1, //minimum slides if zoom in
  onSliderLoad: function(){
     $(".bx-viewport").css("height",450).css("margin-left",5);
  },
  onSlideAfter: function(){
    // do mind-blowing JS stuff here
    //alert('A slide has finished transitioning. Bravo. Click OK to continue!');
  }
});
});
</script>
