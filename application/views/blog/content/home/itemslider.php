<?php
$this->load->model("blog/mdlItemSlider");
$this->load->model("blog/mdlGeneral");

$cit = $this->mdlItemSlider->getData("citations");
$awards = $this->mdlItemSlider->getData("awards");
$theme = $this->mdlGeneral->getTheme();

?>
<link rel="stylesheet" type="text/css" href="css/itemslider.css" />
<script src="js/modernizr.custom.63321.js"></script>
<style>

*,
*:after,
*:before {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	padding: 0;
	margin: 0;
}



.mi-slider nav a.mi-selected:after {
	border-color: transparent;
	border-top-color: transparent;
	border-width: 20px;
	left: 50%;
	margin-left: -20px;
	font-size:100px;

}

.mi-slider nav a.mi-selected:before {
	border-color: transparent;
	border-width: 27px;
	left: 50%;
	margin-left: -27px;
}


.mi-slider nav a.mi-selected{
				-webkit-transition: all .2s ease-in-out;
		-moz-transition: all .2s ease-in-out;
		-ms-transition: all .2s ease-in-out;
		-o-transition: all .2s ease-in-out;
		transition: all .2s ease-in-out;  
}

.mi-slider nav a,
.mi-slider nav a.mi{
	color: <?=$theme["container2"]?>;
	text-decoration:none;
	font-size:150%;
	line-spacing:0px;
}
.mi-slider nav a:hover,
.mi-slider nav a.mi-selected {
	color: <?=$theme["hForeColor"]?>;
	
	
	
	
}

.mi-slider nav {
	border-top: 1px solid transparent;
}


</style>
		    <script type="text/javascript" src="<?=base_url()?>js/modernizr.custom.63321.js"></script>	
		    <script type="text/javascript" src="<?=base_url()?>js/jquery.catslider.js"></script>
        <div align=center style="background:rgba(0,0,0,0.5);margin:0px auto"> 
				<div id="mi-slider" class="mi-slider" style="margin:0px auto" >
					<?=$cit?>
				</div>
				<br>
				<div id="mi-slider2" class="mi-slider" style="margin:0px auto" >
			<?=$awards?>
				</div>				
</div>	

	
		<script>
			$(function() {

				$( '#mi-slider' ).catslider();
	$( '#mi-slider2' ).catslider();
$(".mi-slider nav").css("top",110);

var index=1;	
var index2=1;	
autoplaymode();		
autoplaymode2();

	function autoplaymode()
	{
  window.setInterval(function() {
      $("#mi-slider").find("nav > :nth-child("+index+")").trigger("click");
      index+=1;
      if(index>$("#mi-slider").find("nav a").length) {index=0;}
      }, 3000);
  }		

	function autoplaymode2()
	{
  window.setInterval(function() {
      $("#mi-slider2").find("nav > :nth-child("+index2+")").trigger("click");
      index2+=1;
      if(index2>$("#mi-slider2").find("nav a").length) {index2=0;}
      }, 5000);
  }	





			});
		</script>

