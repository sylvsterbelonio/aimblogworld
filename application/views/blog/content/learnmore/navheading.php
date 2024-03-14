<?php
$this->load->library("Url");
$this->load->library("Navhead");
$this->load->model("blogs/mdlGeneral");
$theme=$this->mdlGeneral->getTheme();  
///////////////////////////////////////////////////////
///////////YOU CAN SET VARIABLE HERE///////////////////
//                  $category
//                  $division
//                  $section
///////////////////////////////////////////////////////
///////////////////////////////////////April 25, 2016//
?>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/navheading.css" /> 
<style>.category_content{max-width:<?=$theme["maxWidth"]?>px;}.category_content div{color:<?=$theme["nForeColor"]?>;}.category_content a{color:<?=$theme["nForeColor"]?>;}.category_content a:hover{color:<?=$theme["hForeColor"]?>;}.category_content{padding-top:10px;background:rgba(0,0,0,0.7);border-radius:0px;}</style>
<div class="category_content">
<?=$this->navhead->setData((isset($category)) ? $category : '',(isset($division)) ? $division : '',(isset($section)) ? $section : '');?>   
</div>
