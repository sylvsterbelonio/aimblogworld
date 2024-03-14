<?php
$this->load->library("Color");
$this->load->model("blogs/mdlGeneral");
$this->load->model("blogs/mdlCompany");
$data = $this->mdlCompany->getBusinessPartners();
$this->load->model("blog/mdlPages");
$page = $this->mdlPages->load("business-partners");
$theme=$this->mdlGeneral->getTheme();  
$colorblur = $this->color->string_to_rgb($theme["nForeColor"]);
?>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>controls/navigator/css/demo.css" /><link rel="stylesheet" type="text/css" href="<?=base_url()?>controls/navigator/css/style1.css" /><style>.content{maxWidth:<?=$theme["maxWidth"]?>;background:<?=$theme["container"]?>;height:700px;padding:20px;}.cn-container h2{color: <?=$nBackColor?>;}.cn-back {background:<?=$theme["nBackColor"]?> url(<?=base_url()?>controls/navigator/css/images/arrow.png);padding:20px 20px 25px 30px;border-radius:50%;}.cn-back:hover {background:<?=$theme["nBorderColor"]?> url(<?=base_url()?>controls/navigator/css/images/arrow.png);padding:20px 20px 25px 30px;border-radius:50%;}.cn-slide nav a {border: 8px solid <?=$theme["nForeColor"]?>;color: rgba(<?=$$colorblur?>,0.1);text-shadow: 0px 0px 10px rgba(255,255,255,0.9);border-radius:10px;}.cn-slide nav a:hover {color:<?=$theme["nForeColor"]?>;border: 8px solid <?=$theme["nBackColor"]?>;}.cn-content{height:570px;overflow:auto;background:<?=$theme["container2"]?>;}.cn-content img{  border-radius:10px;	padding: 15px 20px;	color: <?=$theme["nForeColor"]?>;	width:100%;	border-radius: 35px;}.cn-content table{	color: black;	margin-left:35px;}.cn-content ul{  text-indent:45px;	padding: 15px 20px;	line-height: 24px;  font-size:130%;}.cn-content ul li{margin-left:23px;font-size:130%;}</style><div class="content"><!--[if lte IE 9]><p style="font-size: 20px; padding: 50px;">Sorry, this only works in modern browsers...</p><![endif]--><section class="cn-container">		<?=$data?></section><div style="clear:both"></div></div>
<style>
.cn-content table tr td{
font-size:200%;
}
</style>
