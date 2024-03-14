<?php 
//$homepage = $this->config->item("ghomepage");
$this->load->model('blog/mdlGeneral');
$data = $this->mdlGeneral->getTheme();
$rgb = $this->color->string_to_rgb($data["nBackColor"]);
?>

  <link rel="stylesheet" href="<?=base_url()?>/controls/bxslider/css/jquery.bxslider.css" type="text/css" />
  <script src="<?=base_url()?>/controls/bxslider/js/jquery.min.js"></script>
  <script src="<?=base_url()?>/controls/bxslider/js/jquery.bxslider.js"></script>
  
<style>


.bx-wrapper .bx-prev:hover {
	background:rgba(<?=$rgb?>,1) url(<?=base_url()?>controls/bxslider/css/images/controls.png) no-repeat 0 -32px;
}

.bx-wrapper .bx-next:hover {
	background:rgba(<?=$rgb?>,1) url(<?=base_url()?>controls/bxslider/css/images/controls.png) no-repeat -43px -32px;
}


.bx-wrapper .bx-caption {
	background: <?=$data["nBackColor"]?>;
	background: rgba(<?=$rgb?>, 0.75);
	margin-bottom: -10px;
}

.bx-wrapper .bx-pager.bx-default-pager a:hover,
.bx-wrapper .bx-pager.bx-default-pager a.active {
	background: <?=$data["nBackColor"]?>;
}
.bx-wrapper .bx-pager.bx-default-pager a {
	background: <?=$data["container2"]?>;
	}

.bx-wrapper .bx-loading {
    border: 4px solid <?=$data["container"]?>; /* Light grey */
    border-top: 4px solid <?=$data["nBackColor"]?>; /* Blue */
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
	border: solid <?=$data["nBackColor"]?> 1px;
}

.bx-wrapper{
background:black;
}
</style>
    <?php
    
    
         $srcData="<ul class='bxslider'><li><img src='".base_url()."images/data/products/burn/Liven-Burn1-600x600.jpg' title='Funky roots'></li>";
        $srcData.="<li><img src='".base_url()."images/data/products/burn/Liven-Burn-600x600.jpg' title='Funky roots'></li>";
        $srcData.="<li><img src='".base_url()."images/data/products/burn/Liven-Burn-600x600.jpg' title='Funky roots'></li>";
        $srcData.="<li><img src='".base_url()."images/system/noproduct.png'></li></ul>";
        
        
         $srcData.='<div id="bx-pager">';
         $srcData.='<a data-slide-index="0" href=""><img src="'.base_url().'images/data/products/burn/Liven-Burn1-600x600.jpg" height=50 width=50 /></a>';
         $srcData.='<a data-slide-index="1" href=""><img src="'.base_url().'images/data/products/burn/Liven-Burn-600x600.jpg" height=50 width=50 /></a>';
         $srcData.='<a data-slide-index="2" href=""><img src="'.base_url().'images/system/noproduct.png" height=50 width=50 /></a>';
         $srcData.='<a data-slide-index="3" href=""><img src="'.base_url().'images/system/noproduct.png" height=50 width=50 /></a>';         
         $srcData.='</div>';
        
        
        $settings='
        auto:true,
        captions: true,
        pagerCustom: "#bx-pager",
        ';
    
    $srcData
    
    
    ?>
<script>
$(document).ready(function(){
  $('.bxslider').bxSlider({

  <?php if(isset($settings)){echo $settings;}?>
  //auto: true, //set automatic slides
  //autoControls: true, //add Additional Pause/Play Effect 
  //mode: 'vertical|horizontal|fade',
  //captions: true,
  //pause: 2000,
  //infiniteLoop: false,
  hideControlOnEnd: true,
  //adaptiveHeight: true,
  //startSlide: 2, //the start of slide when first loaded
  //moveSlides: 1,
  //minSlides: 2, //minimum slides if zoom in
  //maxSlides: 3, //max slides to display in one container
  //slideMargin: 10, //margin of each side of every slides
  //slideWidth: 100 //the width of all slides
  //ticker: true,
  //speed:6000,  
  onSliderLoad: function(){
    // do funky JS stuff here
    //alert('Slider has finished loading. Click OK to continue!');
  },
  onSlideAfter: function(){
    // do mind-blowing JS stuff here
    //alert('A slide has finished transitioning. Bravo. Click OK to continue!');
  }
});
});
</script>
