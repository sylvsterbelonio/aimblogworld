<?php
$this->load->model('blog/mdlGeneral');
$this->load->library('Color');
$theme=$this->mdlGeneral->getTheme();
$rgb = $this->color->string_to_rgb($theme["nBackColor"]);

?>

  <link rel="stylesheet" href="<?=base_url()?>/controls/bxslider/css/jquery.bxslider.css" type="text/css" />
  <script src="<?=base_url()?>/controls/bxslider/js/jquery.bxslider.js"></script>

<style>

.clearfix:before, .clearfix:after { content: " "; display: table; }
.clearfix:after { clear: both; }
.main{
	margin: 0 auto;
}
.column {
	float: left;
	width: 50%;
	padding: 0px 5px;
	min-height: 300px;
	position: relative;
	overflow-y:hidden;
}
.main clearfix{
overflow-y:hidden;

}
.column:nth-child(2) {
	box-shadow: -1px 0 0 rgba(180,180,180,0.5);
}

@media screen and (max-width: 50.0625em) {	.column {		overflow-y:auto; width: 100%;		min-width: auto;		min-height: auto;		padding: 1em; 	}	.column:nth-child(2) {		box-shadow: 0 -1px 0 rgba(<?=$rgb?>,0.5);	}}
.img-dialog-preview {width:100%;border-radius:5px;display:none;}
.column h2 {color:<?=$theme["nBackColor"]?>;}

.quantity-action{
border:1px solid <?=$theme["bBackColor"]?>;
background:<?=$theme["nBackColor"]?>;
color:<?=$theme["nForeColor"]?>;
width:20px;
font-size:200%;
border-radius:5px
}
.quantity-action:hover{
cursor:pointer;
border:1px solid <?=$theme["hForeColor"]?>;
background:<?=$theme["hBackColor"]?>;
color:<?=$theme["hForeColor"]?>;
}
.quantity-action:active{
border:1px solid <?=$theme["nBackColor"]?>;
background:<?=$theme["pBackColor"]?>;
color:<?=$theme["nForeColor"]?>;
}
.dialog-right-header{
background:<?=$theme["pBackColor"]?>;
width:100%;
border:1px solid <?=$theme["bBackColor"]?>;
height:60px;border-radius:5px;
overflow:hidden;
}

.share-btn-wrp {	list-style: none;	display: block;	margin: 5px;	padding: 5px;	width: 32px;	left: 0px;	position: fixed;	z-index:999999999999;	opacity:0.8;}
.share-btn-wrp .button-wrap{	text-indent:-100000px;	width:32px;	height: 32px;	cursor:pointer;		z-index:1000000000000000000;	transition: width 0.1s ease-in-out;}
.share-btn-wrp > .facebook{	background: url(<?=base_url()?>images/system/share-icons.png) no-repeat -42px 0px;}.share-btn-wrp > .facebook:hover{	opacity:1;background: url(<?=base_url()?>images/system/share-icons.png) no-repeat -4px -0px;	width:38px;}.share-btn-wrp > .twitter{	background: url(<?=base_url()?>images/system/share-icons.png) no-repeat -42px -34px;}.share-btn-wrp > .twitter:hover{opacity:1;	background: url(<?=base_url()?>images/system/share-icons.png) no-repeat -4px -34px;	width:38px;}.share-btn-wrp > .digg{	background: url(<?=base_url()?>images/system/share-icons.png) no-repeat -42px -68px;}.share-btn-wrp > .digg:hover{	opacity:1; background: url(<?=base_url()?>images/system/share-icons.png) no-repeat -4px -68px;	width:38px;}.share-btn-wrp > .stumbleupon{	background: url(<?=base_url()?>images/system/share-icons.png) no-repeat -42px -102px;}.share-btn-wrp > .stumbleupon:hover{opacity:1;	background: url(<?=base_url()?>images/system/share-icons.png) no-repeat -4px -102px;	width:38px;}.share-btn-wrp > .delicious{	background: url(<?=base_url()?>images/system/share-icons.png) no-repeat -42px -136px;}.share-btn-wrp > .delicious:hover{opacity:1;	background: url(<?=base_url()?>images/system/share-icons.png) no-repeat -4px -136px;	width:38px;}.share-btn-wrp > .gplus{	background: url(<?=base_url()?>images/system/share-icons.png) no-repeat -42px -170px;}.share-btn-wrp > .gplus:hover{opacity:1;	background: url(<?=base_url()?>images/system/share-icons.png) no-repeat -4px -170px;	width:38px;}.share-btn-wrp > .email{	background: url(<?=base_url()?>images/system/share-icons.png) no-repeat -42px -408px;}.share-btn-wrp > .email:hover{opacity:1;	background: url(<?=base_url()?>images/system/share-icons.png) no-repeat -4px -408px;	width:38px;}
@media all and (max-width: 699px) {	.share-btn-wrp{		width: 100%;		text-align: center;		position: fixed;		bottom: 1px;	}	.share-btn-wrp .button-wrap {		display: inline-block;		margin-left: -2px;		margin-right: -2px;	}}


.bx-wrapper .bx-prev:hover {
	background:rgba(<?=$rgb?>,1) url(<?=base_url()?>controls/bxslider/css/images/controls.png) no-repeat 0 -32px;
}

.bx-wrapper .bx-next:hover {
	background:rgba(<?=$rgb?>,1) url(<?=base_url()?>controls/bxslider/css/images/controls.png) no-repeat -43px -32px;
}


.md-close-details{
color:<?=$theme["nBackColor"]?>;
}
.md-close-details:hover{
cursor:pointer;
}

#dialog-right-header-product{
font-size:20px;
line-height:25px;
margin:15px;
}


.bx-wrapper .bx-pager.bx-default-pager a:hover,
.bx-wrapper .bx-pager.bx-default-pager a.active {
	background: <?=$theme["nBackColor"]?>;
}
.bx-wrapper .bx-pager.bx-default-pager a {
	background: <?=$theme["container2"]?>;
	}

.bx-wrapper .bx-loading {
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

.share-btn-wrp{
font-size:150%;
}
</style>

          <div class="main clearfix">
            <div id="dialog-background-wait" class="column">
               <ul  class="share-btn-wrp">
                     <li class="facebook button-wrap">Facebook</li>
                     <li class="twitter button-wrap">Tweet</li>
                     <li class="gplus button-wrap">Google Share</li>
                     <li class="email button-wrap">Email</li>
               </ul>  
  					   <div   style="width:100%">
                  <ul id="dialog-left-slideshow" class="bxslider">
                      <?=$srcData?>
                  </ul>
               </div>
  			   	</div>
  				  <div class="column" style="overflow-y:hidden">
              <h2 id="dialog-right-header-product" align=center><?=$productName?></h2>
              <hr class="ui-hr"><br>
              <?=$likelove?>
              <button style="margin-bottom:5px;float:right"><img src="<?=base_url()?>images/system/details.png" height=17 width=15><span class="button-text">View Details</span></button>
              <br><br>
              <div class="dialog-right-header" > 
                  <table align=right   style="width:100%">
                      <tr>
                          <td rowspan=2 style="color:<?=$nForeColor?>;border-radius:5px" valign=center><span id="dialog-price" style="color:white;font-size:450%;margin-top:5px;padding-left:10px;display:block"><?=$price?></span></td>
                          <td rowspan=2 style="color:<?=$nForeColor?>;font-size:200%;" align=right>Quantity</td>
                          <td rowspan=2 align=right style="width:25px;"><input id="txtquantity" onblur="quantity(this);" type="text" size=1 style="text-align:center;height:40px;width:100%"></td> 
                          <td class="quantity-action" align=center onclick="quantityAction(document.getElementById('txtquantity'),'+')">+</td>
                          <td rowspan=2 align=center><button style="padding:5px 5px"><img src="<?=base_url()?>images/system/cart.png" style="margin-top:5px;" ><span style="line-height:30px"><span class="cart-details-text">Cart</span></span></button></td>
                      </tr>
                      <tr>
                          <td align=center valign="top" class="quantity-action" style="" align=center onclick="quantityAction(document.getElementById('txtquantity'),'-')">-</td>
                      </tr>
                  </table>
              </div>
              <div id="dialog-content" style="width:100%;border-radius:5px;overflow:auto;line-height:25px;padding-top:20px;font-size:12px;">
                  <?=$content?>
              </div>
              <br>
              <div id="dialog-bottom-footer" style="background: white;padding:15px;line-height:30px;font-size:14px;">
                  <?=$categories?>
              </div>    
  				  </div>
          </div>
          
<script>



$(document).ready(function(){
    var pageTitle	= document.title; //HTML page title
    var pageUrl		= location.href; //Location of this page
	

  $('.bxslider').bxSlider({
  
  auto: true
  });

	
	
	$('.share-btn-wrp li').click(function(event){
		var shareName = $(this).attr('class').split(' ')[0]; //get the first class name of clicked element
		switch(shareName) //switch to different links based on different social name
		{
			case 'facebook':
				OpenShareUrl('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
				break;
			case 'twitter':
				OpenShareUrl('http://twitter.com/home?status=' + encodeURIComponent(pageTitle + ' ' + pageUrl));
				break;
			case 'digg':
				OpenShareUrl('http://www.digg.com/submit?phase=2&amp;url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
				break;
			case 'stumbleupon':
				OpenShareUrl('http://www.stumbleupon.com/submit?url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
				break;
			case 'delicious':
				OpenShareUrl('http://del.icio.us/post?url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
				break;
			case 'gplus':
				OpenShareUrl('https://plus.google.com/share?url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
				break;
			case 'email':
				OpenShareUrl('mailto:?subject=' + pageTitle + '&body=Found this useful link for you : ' + pageUrl);
				break;
		}
		
	});
		
	function OpenShareUrl(openLink){
		//Parameters for the Popup window
        winWidth    = 650; 
        winHeight   = 450;
        winLeft     = ($(window).width()  - winWidth)  / 2,
        winTop      = ($(window).height() - winHeight) / 2,
        winOptions   = 'width='  + winWidth  + ',height=' + winHeight + ',top='    + winTop    + ',left='   + winLeft;
        window.open(openLink,'Share This Link',winOptions); //open Popup window to share website.
        return false;
	}
});
 
  
</script>          
