<?php
$this->load->model("blog/mdlGeneral");
$theme = $this->mdlGeneral->getTheme();

?>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/shop.css" /> 
<style>
.spanD{
font-size:12px;
}
.shop-menu{
max-width:<?=$theme["maxWidth"]?>px;

}


.left-side-menu{
border: 1px solid <?=$theme["nBackColor"]?>;
		background-color: <?=$theme["container"]?>;
		background-image: -moz-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["container"]?>), to(<?=$theme["container2"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);	
		background-image: -o-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
		background-image: -ms-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
		background-image: linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
		-moz-box-shadow: 0 1px 1px <?=$theme["container"]?>, 0 1px 0 <?=$theme["container2"]?> inset;
		-webkit-box-shadow: 0 1px 1px <?=$theme["container"]?>, 0 1px 0 <?=$theme["container2"]?> inset;
		box-shadow: 0 1px 1px <?=$theme["container"]?>, 0 1px 0 <?=$theme["container2"]?> inset;
}
.right-category{
color:<?=$theme["nForeColor"]?>;
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
.right-side-menu ul li a{
color:<?=$theme["nBackColor"]?>;
font-weight:200px;
}
.right-side-menu ul li a:hover{
background:<?=$theme["nBackColor"]?>;
color:<?=$theme["hForeColor"]?>;
}
.right-category{
font-size:14px;
}

.right-side-container{
border:1px solid <?=$theme["nBackColor"]?>;
		background-color: <?=$theme["container"]?>;
		background-image: -moz-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["container"]?>), to(<?=$theme["container2"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);	
		background-image: -o-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
		background-image: -ms-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
		background-image: linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
		-moz-box-shadow: 0 1px 1px <?=$theme["container"]?>, 0 1px 0 <?=$theme["container2"]?> inset;
		-webkit-box-shadow: 0 1px 1px <?=$theme["container"]?>, 0 1px 0 <?=$theme["container2"]?> inset;
		box-shadow: 0 1px 1px <?=$theme["container"]?>, 0 1px 0 <?=$theme["container2"]?> inset;
}
.right_item{
color:<?=$theme["nBackColor"]?>;
}
.right_item2{
border:1px solid <?=$theme["nBackColor"]?>;
}
.right_item2:hover{
-webkit-box-shadow: 0px 10px 1px <?=$theme["nBackColor"]?>;
box-shadow: 0px 0px 10px 1px <?=$theme["nBackColor"]?>;
}
.left-side-header{
color:<?=$theme["nForeColor"]?>;
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
.lst-item-container div div{
border:1px solid <?=$theme["container2"]?>;
}
.lst-item-container div p span:first-child{
color:<?=$theme["nBackColor"]?>;
}
.cart-items{
background:<?=$theme["nBackColor"]?>;
color:<?=$theme["nForeColor"]?>;
}
#lstNavigation{
padding-bottom:20px;
}
.cart-items:hover{
background:<?=$theme["pBackColor"]?>;
color:<?=$theme["hForeColor"]?>;
}
.lst-item-container div div:hover{
background:<?=$theme["hForeColor"]?>;
}
.price{color:<?=$theme["nBackColor"]?>;}
a{text-decoration:none;color:<?=$theme["nBackColor"]?>;}a:hover{color:<?=$theme["hBackColor"]?>;}

.navigation-shop-items:hover{
border:1px solid <?=$theme["hBackColor"]?>;
background:<?=$theme["pBackColor"]?>;
color:<?=$theme["hForeColor"]?>;
}
.navigation-shop-items-active{
border:1px solid <?=$theme["hBackColor"]?>;
background:<?=$theme["pBackColor"]?>;
color:<?=$theme["hForeColor"]?>;
}
.loading-img{
background-image:url(<?=base_url()?>images/gif/circlemedium.gif);
}
.loading-img-small{
background-image:url(<?=base_url()?>images/gif/smallcircle.gif);
}
.font-color{
color:<?=$nBackColor?>;
}
.dialog-background-wait{
background-image:url(<?=base_url()?>images/gif/load.gif);
}
.left-details-item-container h2{
color:<?=$theme["nBackColor"]?>;
}
.right-details-item-container h2,.right-details-item-container h3{
color:<?=$theme["nBackColor"]?>;
}
.gallery-picture{
border:1px solid <?=$theme["container2"]?>;
}
.gallery-picture:hover{
background:<?=$theme["hForeColor"]?>;
}

</style>

<div class="shop-menu" style="">
  <div class="left-side-menu">
    <div class="left-side-header">
    <span style="margin-left:5px" class="left-box-label" >Country:</span> <?=$cboCountries?> <span class="left-box-label">Sort By:</span> <?=form_dropdown($fcboSort,$fcbolstSort,'productName')?><span class="left-box-label">Type of View:</span><?=form_dropdown($fcboView,$fcbolstView,'grid')?>
    </div>
    <div id="imgWait" style="margin:0px auto;width:50px;display:none"><img src="<?=base_url()?>images/gif/search.gif" > Searching...</div>
    <div id="lstProducts" class="lst-item-container">
      <?=$listProducts?>
    </div>
    <div id="lstDetailProducts"></div>
    <div id="lstNavigation">
      <?=$navProducts?>
    </div>
  </div>

  <div class="right-side-menu">
    <div class="right-side-container">
    <div class="right-category">CATEGORIES</div>
    <ul >
    <?=$side_categories?>
    </ul>
    </div>
    <?=$listTopRatedProducts?>  
    <?=$listPopularProducts?>
    <?=$listNewProducts?>
  </div>
</div>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/slidepanel.css" /> 
<script src="<?=base_url()?>js/slidepanel/modernizr_slide.js"></script> <!-- Modernizr -->
<style>
.cd-main-content .cd-btn {
  background-color: <?=$theme["nBackColor"]?>;
}
.no-touch .cd-main-content .cd-btn:hover {
  background-color: <?=$theme["hBackColor"]?>;
}
.cd-panel-close::before, .cd-panel-close::after {
  background-color:<?=$theme["nBackColor"]?>;
}
.cd-panel-container {
  background: <?=$theme["container"]?>;
}
.cd-panel-header h1 {
  color: <?=$theme["nBackColor"]?>;
}
.no-touch .cd-panel-close:hover {  
background-color: <?=$theme["nBackColor"]?>;
}
</style>

	<main class="cd-main-content">
		<a href="#0" class="cd-btn"><img src="<?=base_url()?>images/system/arrowleft_small.png" height=16 style="margin-top:6px" ></a>
	</main>
	<div class="cd-panel from-right">
		<header class="cd-panel-header">
			<h1>MENU</h1>
			<a href="#0" class="cd-panel-close">Close</a>
		</header>

		<div class="cd-panel-container">
			<div class="cd-panel-content">
  <div class="right-side-container">
  <div class="right-category">CATEGORIES</div>
  <ul class="panel-ul">
  <?=$side_categories?>
  </ul>
  </div>
				  <?=$listTopRatedProducts?>  
          <?=$listPopularProducts?>
          <?=$listNewProducts?>
			</div> <!-- cd-panel-content -->
		</div> <!-- cd-panel-container -->
	</div> <!-- cd-panel -->
	
<input id="txtSitename" type="hidden" value="<?=base_url()?>">	
<input id="txtID" type="hidden" value="<?=$PIID?>">	
<input id="cusID" type="hidden" value="<?=$this->session->userdata("customerID")?>">
<input id="burl" type="hidden" value="<?=base_url()?>">
<input id="txtsegment" type="hidden" value="<?=$this->uri->segment(1)?>">


<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/modalDialog.css" /> 
<style>
.md-content {
	background: <?=$theme["container"]?>;
}
.md-content-details {
	background: <?=$theme["container"]?>;
}
.md-content h6 {
	color:<?=$theme["nForeColor"]?>;
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
.md-content-details h6 {
	color:<?=$theme["nForeColor"]?>;
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
.md-close{
border:1px solid <?=$theme["hBackColor"]?>;
}
.md-close:hover{
border:1px solid <?=$theme["hForeColor"]?>;
color:<?=$theme["hForeColor"]?>;
background:<?$theme["hBackColor"]?>;
}
.md-close-details{
border:1px solid <?=$theme["nBackColor"]?>;
color:<?=$theme["nBackColor"]?>;
padding-left:5px;padding-right:5px;
}
.md-close-details:hover{
color:<?=$theme["nForeColor"]?>;
background:<?=$theme["nBackColor"]?>;
}
</style>
		<div class="md-modal md-effect-16" id="modal-16">
			<div class="md-content">
				<h6 ><span id="dialog-header">Register Here!</span><span style="float:right" class="md-close">x</span></h6>
				<div id="dialog-login" style="display:none">
					<p class="text-dialog">Not yet registered? Please sign up or log in to your account</p>
					<br>
            <div  class="dialog-content">
						<span>Username <span>*</span></span> <input class="dialog-input-field" id="txtusername" title="Username" type="text">
						     <span id="etxtusername" class="error-caption"></span><br>
            <span>Password <span>*</span></span> <input class="dialog-input-field" id="txtpassword" title="Password" type="password">
                 <span id="etxtpassword" class="error-caption"></span>
            </div>
          <br>  
					<button id="cmdLogIn"><img src="<?=base_url()?>images/system/login.png" height=19>Sign In</button><a id="lnkRegister" href="#register" style="float:right">Not Yet A Member?</a>
				</div>
				<div id="dialog-register">
					<p class="text-dialog">Can't hit like,love or share? Register Your Info First!</p>
					  <br>
            <div class="dialog-content">
						<span>FirstName <span>*</span></span> <input class="dialog-input-field" id="txtfname" title="First Name" type="text" >
						    <span id="etxtfname" class="error-caption"></span><br>
						<span>MiddleName</span> <input id="txtmname" title="Middle Name" type="text" class="dialog-input-field">
						<span>LastName <span>*</span></span> <input id="txtlname" title="Last Name" type="text" class="dialog-input-field">
						    <span id="etxtlname" class="error-caption"></span><br>
						<span>Address</span> <textarea id="txtaddress" type="text" title="Address" class="dialog-input-field"></textarea>
						    <span id="etxtaddress" class="error-caption"></span><br>
						<span>Contact No. <span>*</span></span> <input id="txtcontactNo" title="Contact Number" type="text" class="dialog-input-field">
						    <span id="etxtcontactNo" class="error-caption"></span><br>
						<span>Email <span>*</span></span> <input id="txtemail" type="text" title="Email Address"class="dialog-input-field">
						    <span id="etxtemail" class="error-caption"></span><br>
						<span>Password <span>*</span></span> <input id="txtrpassword" title="Password" type="password" class="dialog-input-field">
						    <span id="etxtrpassword" class="error-caption"></span><br>
            </div>
          <br>  
					<button id="cmdRegister" class="register"><img src="<?=base_url()?>images/system/register.png" height=19>Register</button><a id="lnkLogIn" href="#login" style="float:right">Member Already? Log In Here</a>
				</div>				
			</div>
		</div>
    <div class="md-modal-details md-effect-17" id="modal-17" style="width:200px;">
    <div class="md-content-details">
    <span style="float:right;" class="md-close-details">x</span>
				<div id="dialog-quickview" style="overflow:auto">
				</div>    
    </div>
    </div>
    

		<button id="cmdOpenDialog" class="md-trigger" data-modal="modal-16" style="display:none">Blur</button>
		<div class="md-overlay"></div>
    <button id="cmdOpenDialog2" class="md-trigger-details" data-modal-details="modal-17" style="display:none">2nd</button>
    <div class="md-overlay-details dialog-background-wait" ></div>
    

<script src="<?=base_url()?>js/signDialog/classie.js"></script>
<script>

$(document).ready(function(){
  //$('.bxslider').bxSlider();
});

var polyfilter_scriptpath = '/js/';
$.getScript("<?=base_url()?>js/blog/shop.js.php");
jQuery(document).ready(function($){	$('.cd-btn').on('click', function(event){		event.preventDefault();		$('.cd-panel').addClass('is-visible');	});	$('.cd-panel').on('click', function(event){		if( $(event.target).is('.cd-panel') || $(event.target).is('.cd-panel-close') ) { 			$('.cd-panel').removeClass('is-visible');			event.preventDefault();		}	});});</script> 
