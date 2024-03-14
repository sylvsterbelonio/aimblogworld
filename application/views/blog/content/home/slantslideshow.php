<?php
$this->load->model("blog/mdlGeneral");
$this->load->library("Color");
$this->load->model("blog/mdlSlant"); 
$slant = $this->mdlSlant->getSlant();
$theme=$this->mdlGeneral->getTheme();
$rgb=$this->color->string_to_rgb($theme["nBackColor"]);

?>


<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/slantslide.css" />

<style>

.slides {
			border: 1px solid <?=$theme["container2"]?>;
		background-color: <?=$theme["container"]?>;
		background-image: -moz-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["container"]?>), to(<?=$theme["container2"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);	
		background-image: -o-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
		background-image: -ms-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
		background-image: linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
	color: <?=$theme["nForeColor"]?>;
}

.mi-slider nav {
	max-width: <?=$theme["maxWidth"]?>;
	border-top: 5px solid <?=$theme["nBackColor"]?>;
}

.slideshow > nav span {
	background-color: <?=$theme["nForeColor"]?>;
}
.slideshow > nav span:hover {
	background-color: <?=$theme["nBorderColor"]?>;
}

.slideshow > nav span.current {
border:1px solid <?=$theme["hForeColor"]?>;
	background-color: <?=$theme["hForeColor"]?>;
}

.description h2{
color:<?=$theme["hForeColor"]?>;
}
.description p{
color:<?=$theme["nForeColor"]?>;
}

.description{
background:rgba(<?=$rgb?>,0.6);
border-top-right-radius:10px;
border-bottom-right-radius:10px;
margin-top:30px;
}
</style>
<head>

</head>
		<div class="container">
			<div class="slideshow" id="slideshow">
				<ol class="slides">
					 <?=$slant?>
				</ol>
			</div><!-- /slideshow -->

		</div><!-- /container -->
		<script src="js/slantslideshow/classie.js"></script>
		<script src="js/slantslideshow/tiltSlider.js"></script>
		
<script>
new TiltSlider( document.getElementById( 'slideshow' ) );		
autoplaymode();		
	var index=1;	
	$("#slideshow").find("nav").css("background",'<?=$theme["pBackColor"]?>');
	function autoplaymode()
	{
  window.setInterval(function() {
      $("#slideshow").find("nav > :nth-child("+index+")").trigger("click");
      index+=1;
      if(index>$("#slideshow").find("nav span").length) {index=0;}
      }, 8000);
  }						
</script>

