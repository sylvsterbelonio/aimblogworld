<?php
$this->load->model("blog/mdlGeneral");
$this->load->library("Language");
$theme=$this->mdlGeneral->getTheme();  
$lang = $this->language->slidingtext("slidingtext");
$rgb = $this->color->string_to_rgb($theme["nBackColor"]);

?>

<link type="text/css" href="<?=base_url()?>css/slidingtext.css" rel="stylesheet" />		
<style>
		
section{
	background: #fff url(<?=base_url()?>images/aim-world.jpg) no-repeat top right;
	background-attachment: fixed;
	background-size: cover;
}

.rw-sentence span{
	color: <?=$theme["nBackColor"]?>;
}

.rw-words-1 span{  /* Second LINE */
	color: <?=$theme["nBorderColor"]?>;	
	text-shadow: 4px 4px 4px <?=$theme["pBackColor"]?>;
	-webkit-text-stroke: 2px <?=$theme["hForeColor"]?>;
}

.rw-words-2 span{ /*FOURTH LINE */
	color: <?=$theme["nBorderColor"]?>;	
	text-shadow: 4px 4px 4px <?=$theme["pBackColor"]?>;
	-webkit-text-stroke: 2px <?=$theme["hForeColor"]?>;
}

</style>
			<section class="rw-wrapper">
			<img class="sliding-image" src="<?=base_url()?>images/system/aim-world-logo-trans.png">
				<h2 class="rw-sentence">
					<span class="turning">"<?=$lang["1st"]?></span>
					<div class="rw-words rw-words-1">
					<?php  $col1 = explode("~",$lang["2nd"]);?>
						<span><?=$col1[0]?></span>
						<span><?=$col1[1]?></span>
						<span><?=$col1[2]?></span>
						<span><?=$col1[3]?></span>
						<span><?=$col1[4]?></span>
						<span><?=$col1[5]?></span>
					</div>
					<span class="rw-extra" style=""><?=$lang["3rd"]?></Span>
					<div class="rw-words rw-words-2">
					<?php  $col2 = explode("~",$lang["4th"]);?>
						<span><?=$col2[0]?>"</span>
						<span><?=$col2[1]?>"</span>
						<span><?=$col2[2]?>"</span>
						<span><?=$col2[3]?>"</span>
            <span><?=$col2[4]?>"</span> 
						<span><?=$col2[5]?>"</span>
					</div>
				</h2>
			</section>
