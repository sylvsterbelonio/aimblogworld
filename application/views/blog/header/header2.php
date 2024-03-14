<?php
$this->load->model("blogs/mdlMetaProperties");
$this->load->model("blogs/mdlAccounts");
$this->load->model("blogs/mdlGeneral");
$this->load->library("Color");

$meta = $this->mdlMetaProperties->getMeta(0); //DEFAULT META
$photos = $this->mdlAccounts->getPhoto_Header();
$theme=$this->mdlGeneral->getTheme();  
$rgb = $this->color->string_to_rgb($theme["nBackColor"]);


?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      
		    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="<?=$meta["meta_description"]?>" />
        <meta name="keywords" content="<?=$meta["meta_keywords"]?>" />
		    <meta name="author" content="<?=$meta["meta_author"]?>" />

        <link rel="shortcut icon" href="<?=base_url()?><?=$meta["icon"]?>">		 
        
        <link rel="image_src" href="<?=$meta["meta_image"]?>/">
       
        
        <script src="<?=base_url()?>controls/tabcontrol/jquery.min.js"></script>
        <script src="<?=base_url()?>controls/tabcontrol/bootstrap.min.js"></script>
        
		    <script type="text/javascript" src="<?=base_url()?>controls/slicebox/js/modernizr.custom.46884.js"></script>           
        <script type="text/javascript" src="<?=base_url()?>js/jquery.min.1.8.2.js"></script>
        
        <script type="text/javascript" src="<?=base_url()?>js/scrolltop/modernizr.custom.11333.js"></script>
        
        <script type="text/javascript" src="<?=base_url()?>js/scrolltop/jquery.easing.1.3.js"></script>
        
        <script type="text/javascript" src="<?=base_url()?>js/signDialog/modernizr.custom.dialog.js"></script>

        <script src="<?=base_url()?>js/jquery.json-2.2.min.js" type="text/javascript"></script>     



</head>
<title><?php echo $meta["title"];?></title>
</head>
<body style="margin:0px">
<div class="top-container"></div>


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

</style>


