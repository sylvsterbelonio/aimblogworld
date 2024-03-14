<?php
$this->load->model("mdlProduct");
$this->load->model('blog/mdlGeneral');
$this->load->library("Color");

$theme = $this->mdlGeneral->getTheme();
$rgb = $this->color->string_to_rgb($theme["nBackColor"]);
$datax = $this->mdlProduct->openFullProductDetails($PID); //PRODUCT ids

?>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/productfulldetails.css" /> 

<style>

.container-tab{
max-width:<?=$theme["maxWidth"]?>;
background:<?=$theme["container"]?>;
border:1px solid <?=$theme["nBorderColor"]?>;
}

.tabs label {
	color: <?=$theme["nForeColor"]?>;
		border: 1px solid <?=$theme["nBorderColor"]?>;
		background-color: <?=$theme["nBackColor"]?>;
		background-image: -moz-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["nBorderColor"]?>), to(<?=$theme["pBackColor"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);	
		background-image: -o-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: -ms-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		-moz-box-shadow: 0 1px 1px <?=$theme["pBackColor"]?>, 0 1px 0 <?=$theme["nBackColor"]?> inset;
		-webkit-box-shadow: 0 1px 1px <?=$theme["pBackColor"]?>, 0 1px 0 <?=$theme["nBackColor"]?> inset;
		box-shadow: 0 1px 1px <?=$theme["pBackColor"]?>, 0 1px 0 <?=$theme["nBackColor"]?> inset;
}

.tabs input:hover + label {
    background-color: <?=$theme["pBackColor"]?>;
		background-image: -moz-linear-gradient(blue,  yellow);	
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["nBackColor"]?>), to(<?=$theme["pBackColor"]?>));
		background-image: -webkit-linear-gradient(<?=$theme["nBackColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: -o-linear-gradient(<?=$theme["nBackColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: -ms-linear-gradient(<?=$theme["nBackColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: linear-gradient(<?=$theme["nBackColor"]?>, <?=$theme["pBackColor"]?>);
		color:<?=$theme["hForeColor"]?>;
}

.tabs label:after {
	background: <?=$theme["nBackColor"]?>;
	color:<?=$theme["nBackColor"]?>;
}

.tabs input:checked + label {
  background: <?=$theme["hBackColor"]?>;
  color: <?=$theme["hForeColor"]?>;
  border: 1px solid <?=$theme["hForeColor"]?>;
		background-image: -moz-linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["hBackColor"]?>), to(<?=$theme["nBorderColor"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>);	
		background-image: -o-linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>);
		background-image: -ms-linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>);
		background-image: linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>);  
}
.content div h1{color:<?=$theme["nBackColor"]?>;}
.content div p {border-left: 8px solid rgba(<?=$rgb?> 0.8);}
.list-ul{border-left: 8px solid rgba(<?=$rgb?> 0.8);}

</style>

            
<div class="container-tab">
    <div class="right-header">
        <span onclick="" class="like"><img src="<?=base_url()?>images/system/like.png" height=9 width=10><span>1</span></span>
        <span onclick="" class="love"><img src="<?=base_url()?>images/system/love.png" height=9 width=11 ><span>2</span></span>
        <span onclick="" class="share"><img src="<?=base_url()?>images/system/love.png" height=9 width=11 ><span>2</span></span>
        <button id="cmdMinus">-</button>    
        <input id="txtQuantity" type="text" size=3>
        <button id="cmdPlus">+</button>  
        <button id="cmdCard"><img src="<?=base_url()?>images/system/cart.png" ><span class="button-text">Add to Cart</span></button>
    </div>                   

<style>
.nav-tabs{
background:<?=$theme["pBackColor"]?>;
}

.nav-tabs>li>a{
font-size:12px;
margin-right:2px;line-height:1.42857143;border:1px solid transparent;border-radius:4px 4px 0 0;
	color: <?=$theme["nForeColor"]?>;
font-family: "PT Sans Narrow", Arial, sans-serif;
		border: 1px solid <?=$theme["nBorderColor"]?>;
		background-color: <?=$theme["nBackColor"]?>;
		background-image: -moz-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["nBorderColor"]?>), to(<?=$theme["pBackColor"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);	
		background-image: -o-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: -ms-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		-moz-box-shadow: 0 1px 1px <?=$theme["pBackColor"]?>, 0 1px 0 <?=$theme["nBackColor"]?> inset;
		-webkit-box-shadow: 0 1px 1px <?=$theme["pBackColor"]?>, 0 1px 0 <?=$theme["nBackColor"]?> inset;
		box-shadow: 0 1px 1px <?=$theme["pBackColor"]?>, 0 1px 0 <?=$theme["nBackColor"]?> inset;
    border-top-left-radius:5px;		
    border-top-right-radius:5px;	
}

.nav-tabs{border-bottom:1px solid <?=$theme["nBorderColor"]?>;}
.nav-tabs>li>a:hover{
cursor:pointer;
  background: <?=$theme["hBackColor"]?>;
  color: <?=$theme["hForeColor"]?>;
  border: 1px solid <?=$theme["hForeColor"]?>;
		background-image: -moz-linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["hBackColor"]?>), to(<?=$theme["nBorderColor"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>);	
		background-image: -o-linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>);
		background-image: -ms-linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>);
		background-image: linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>);  

}
.nav-tabs>li.active>a,.nav-tabs>li.active>a:focus,.nav-tabs>li.active>a:hover{
cursor:default;
  background: <?=$theme["hBackColor"]?>;
  color: <?=$theme["hForeColor"]?>;
  border: 1px solid <?=$theme["hForeColor"]?>;
		background-image: -moz-linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["hBackColor"]?>), to(<?=$theme["nBorderColor"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>);	
		background-image: -o-linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>);
		background-image: -ms-linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>);
		background-image: linear-gradient(<?=$theme["hBackColor"]?>, <?=$theme["nBorderColor"]?>);  
border-bottom-color:transparent
}

.image_description{
font-size:14px;
color:white;
padding:10px 20px 10px 20px;
position:absolute;
background:rgba(0,0,0,.5);
border-radius:5px;
width:400px;
margin-top:10px;
z-index:1;
}

@media only screen and (max-width: 620px) {
  .image_description{
  width:90%;
  }

}


.image_description p{
font-size:14px;
text-indent:45px;
text-align:justify;
line-height:25px;
}


.image_header{
width:100%;padding:10px 10px 20px 20px;
}



.mydetails{
width:500px;margin:0px auto;

}
.mydetails p{
font-family: "PT Sans Narrow", Arial, sans-serif;
line-height:30px;
font-size:14px;
text-align:justify;
text-indent:45px;
}

.mydetails h1{
color:<?=$theme["nBackColor"]?>;
font-size:18px;
line-height:55px;
font-weight:500px;
}

.mydetails ul{
font-size:14px;
line-height:30px;
margin-left:10px;

}
.mydetails ul li{
margin-left:40px;

}


@media (max-width:568px){
.image_description{
width:90%;
}
.mydetails{
width:100%;
}

}


.mytestimonies{
width:650px;
padding:5px;
}
.mytestimonies h1{
color:<?=$theme["nBackColor"]?>;
font-size:22px;
margin-left:5px;
line-height:-10px;
margin-top: 0px;
font-weight:500px;
}
.mytestimonies h3{
font-size:18px;
margin-left:5px;
margin-top: 0px;
font-weight:500px;
}
.mytestimonies p{
font-family: "PT Sans Narrow", Arial, sans-serif;
line-height:30px;
font-size:14px;
text-align:justify;
text-indent:45px;
}
.mytestimonies-footer{
font-family: "PT Sans Narrow", Arial, sans-serif;
line-height:30px;
font-size:14px;
}
.highlight{
font-size:11px;
color:<?=$theme["nBackColor"]?>
}


.mydetails img{
width:100%;border-radius:15px;margin:5px;
border:1px solid <?=$theme["container2"]?>;
  -moz-transition: all 0.6s;  
  -webkit-transition: all 0.6s;  
  -ms-transition: all 0.6s;
  transition: all 0.6s;
}

.mydetails img:hover{
 box-shadow: 0px 0px 15px <?=$theme["nBorderColor"]?>;
 opacity:0.8;
}
</style>





 
  <link rel="stylesheet" href="<?=base_url()?>controls/tabcontrol/bootstrap.min.css">
  
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">PRODUCT</a></li>
    <li><a data-toggle="tab" href="#menu1">DETAILS</a></li>
    <li><a data-toggle="tab" href="#menu2">CONTENT</a></li>
    <li><a data-toggle="tab" href="#menu3">HEALTH BENEFITS</a></li>
    <li><a data-toggle="tab" href="#menu4">TESTIMONIES</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <div class="image_header" style="position:relative;">
            <div class="image_description" >
                <h3><?=$datax["productName"]?></h3>
                <p>
                    <?=$datax["details"]?>
                </p>
                <h1 align=right><?=$datax["price"]?></h1>
            </div>
            <img oncontextmenu="return false;" src="<?=$datax["imgBackground"]?>" style="width:100%">
            <img oncontextmenu="return false;" src="<?=$datax["imgFeatures"]?>" style="position:absolute;bottom:25px;right:25px;">
        </div>
    </div>
    <div id="menu1" class="tab-pane fade" > 
        <div class="mydetails" >
                <?=$datax["fulldetails"]?> 
        </div>   
    </div>
    <div id="menu2" class="tab-pane fade">
        <div class="mydetails">
                <?=$datax["content"]?> 
        </div> 
    </div>
    <div id="menu3" class="tab-pane fade">
        <div class="mydetails">
                <?=$datax["benefit"]?> 
        </div> 	
    </div>    
    <div id="menu4" class="tab-pane fade">
					<div class="container-testimony">
    					<div class="search-testimony">
    					     <table align=right style="margin:5px;"><tr><td valign=top><input id="txtSearch" type="text" style="border-top-right-radius:0px;border-bottom-right-radius:0px;"></td><td><button id="cmdSearch" style="border-bottom-left-radius:0px;border-top-left-radius:0px;">Search</button></td></tr></table>
    					</div>	
    				  <div class="left-testimony">
                  <div class="mytestimonies" style="border-right:1px solid <?=$theme["container2"]?>;margin-left:10px">
                      <iframe id="youtubeLoader" class="ui-state-animate-wait-method-b"  width="630" height="400" src="https://www.youtube.com/embed/<?=$datax["ytData"]?>?modestbranding=1&amp;rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                      <h1 align=center><?=$datax["ytTitle"]?></h1>
                      <hr class="ui-hr">
                      <h3 align=center><i><?=$datax["ytSubTitle"]?></i></h3>
                      <p><?=$datax["ytContent"]?> - <i style="font-size:11px;">(<b>Date Shared:</b> <?=$datax["ytSharedDt"]?>)</i></p>
                      <table style="width:100%"><tr><td align=left><span class="mytestimonies-footer"><span class="highlight">Category:</span> <?=$datax["ytCategory"]?> <span class="highlight">Tags:</span> <?=$datax["ytTag"]?> </span></td><td align=right><span class="mytestimonies-footer"><span class="highlight">By:</span> <?=$datax["ytAuthor"]?></span></td></tr></table>
                  </div>
              </div>
    				  <div class="right-testimony">
    				       <div id="lstyoutube">
                      <?=$datax["listYoutube"]?>
                   </div>
              </div> 
              <div style="clear:both">
              </div>
					</div>
    </div>
    
  </div>
</div>


<div class="ui-widget-content" style="">
<span style="font-size:150%;color:<?=$theme["nBackColor"]?>">RELATED PRODUCTS</span>


  <link rel="stylesheet" href="<?=base_url()?>/controls/bxslider/css/jquery.bxslider.css" type="text/css" />
  <script src="<?=base_url()?>/controls/bxslider/js/jquery.min.js"></script>
  <script src="<?=base_url()?>/controls/bxslider/js/jquery.bxslider.js"></script>
  
<style>
.bx-wrapper{
width:100%;
}

.bx-wrapper .bx-prev:hover {
	background:rgba(<?=$rgb?>,1) url(<?=base_url()?>controls/bxslider/css/images/controls.png) no-repeat 0 -32px;
}

.bx-wrapper .bx-next:hover {
	background:rgba(<?=$rgb?>,1) url(<?=base_url()?>controls/bxslider/css/images/controls.png) no-repeat -43px -32px;
}


.bx-wrapper .bx-caption {
	background: <?=$theme["nBackColor"]?>;
	background: rgba(<?=$rgb?>, 0.75);
	margin-bottom: -10px;
}

.bx-wrapper .bx-pager.bx-default-pager a:hover,
.bx-wrapper .bx-pager.bx-default-pager a.active {
	background: <?=$theme["nBackColor"]?>;
}
.bx-wrapper .bx-pager.bx-default-pager a {
	background: <?=$theme["container2"]?>;
	}

.bx-wrapper .bx-loading {
    margin-top:2%;
    border: 4px solid <?=$theme["container"]?>; /* Light grey */
    border-top: 4px solid <?=$theme["nBackColor"]?>; /* Blue */
}

#bx-pager{
	text-align: center;
	margin-top: -25px;

}

#bx-pager a {
	margin: 0 3px;
}

#bx-pager a img {
	padding: 3px;
	border: solid #ccc 1px;
}

#bx-pager a:hover img,
#bx-pager a.active img {
	border: solid <?=$theme["nBackColor"]?> 1px;
}

.bx-wrapper{
margin:0 auto 15px;
}

.bxslider li:hover{
border:1px solid <?=$theme["nBackColor"]?>;
}

</style>
<br><br>

<?=$datax["relatedProduct"]?>


</div>

<script>
$(document).ready(function(){
  $('.bxslider').bxSlider({
  auto: true,
  mode: 'horizontal',
  hideControlOnEnd: true,
  moveSlides: 1,
  minSlides: 1,
  maxSlides: 4,
  slideMargin: 5,
  slideWidth: 230,
  onSliderLoad: function(){
  $(".bx-next,.bx-prev").hide();
  },
  onSlideAfter: function(){
  }
});
});

$( ".bxslider" ).hover(function() {$(".bx-next,.bx-prev").show();$(".bx-caption").fadeIn(500);}, function() {if ($(".bx-controls-direction:hover").length != 0) {}else{$(".bx-next,.bx-prev").hide();$(".bx-caption").fadeOut(500);}   });

$('img').bind("contextmenu", function (e) { e.preventDefault(); });  
$('img').mousedown(function(){return false});

</script>

 <style>
 
 
 @media (max-width:1050px){ 
 .mytestimonies{
 width:550px;
 }
  #youtubeLoader{
  width:540px;
  height:400px;
  } 
}

 @media (max-width:890px){ 
 .mytestimonies{
 width:450px;
 }
  #youtubeLoader{
  width:440px;
  height:300px;
  } 
}


 
 @media (max-width:568px){
#youtubeLoader{
width:100%;
}
}


 .testimony-header{
 color:<?=$theme["nBackColor"]?>;
 font-size:14px;
 }


 .list-testimony{
 background:#e3e3e3;
 cursor:pointer;
 margin-bottom:5px;
 }
  
 .list-testimony:hover{
 background:<?=$theme["container2"]?>;
 cursor:pointer;
 
 
 }
 
 
 .container-testimony{
 width:100%;
 display:block;
 border:1px solid <?=$theme["container2"]?>;

 }
 .search-testimony{
 width:100%;
 background:<?=$theme["container2"]?>;
 border:1px solid <?=$theme["container2"]?>;
 height:40px;
 
 }
 .left-testimony{
float:left;

 }
 .right-testimony{

 width:34%;
 min-width:300px;
 padding:5px;
 float:left;right:0px;top:270px;font-size:14px;overflow-y:auto; 
 }
 
 button{font-size:12px;}
 </style>  


	
<script type="text/javascript" src="<?=base_url()?>js/scrolltop/modernizr.custom.11333.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/scrolltop/jquery.easing.1.3.js"></script>

<script>

function openYoutube(data){
  $("#youtubeLoader").attr("src","https://www.youtube.com/embed/"+data+"?modestbranding=1&amp;rel=0&amp;showinfo=0");
}

$("#cmdSearch").click(function(e) {
         $(function(){
             $.post("<?=base_url()?>shop/event/searchYoutube",{search:$("#txtSearch").val(),pid:<?=$PID?>}, function(data){
             $("#lstyoutube").empty().append(data);
             $("#txtSearch").val("");
             });         
         });
});

$("#txtSearch").keypress(function(e) {
    if(e.which == 13) {
    $("#cmdSearch").trigger("click");
    }
});
</script>












