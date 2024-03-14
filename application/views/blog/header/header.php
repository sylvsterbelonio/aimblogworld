<?php
$this->load->model("blogs/mdlMetaProperties");
$this->load->model("blogs/mdlAccounts");
$this->load->model("blogs/mdlGeneral");
$this->load->library("Color");

$meta = $this->mdlMetaProperties->getMeta(0); //DEFAULT META
$photos= $this->mdlAccounts->getPhoto_Header();
$theme=$this->mdlGeneral->getTheme();  
$rgb = $this->color->string_to_rgb($theme["nBackColor"]);
?>
<!DOCTYPE html>
<html lang="en-US" xmlns:fb="http://ogp.me/ns/fb#" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">


<head>



        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="http://www.benjiebaluran.com/xmlrpc.php" />

        <link rel="shortcut icon" href="//www.benjiebaluran.com/wp-content/uploads/2015/12/favicon_leaf.ico" type="image/x-icon" />
        <link rel="apple-touch-icon-precomposed" href="//www.benjiebaluran.com/wp-content/uploads/2015/12/57px_new.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="//www.benjiebaluran.com/wp-content/uploads/2015/12/114px_new.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="//www.benjiebaluran.com/wp-content/uploads/2015/12/72px_new.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="//www.benjiebaluran.com/wp-content/uploads/2015/12/144px_new.png">

      
		    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="<?=$meta["meta_description"]?>" />
        <meta name="keywords" content="<?=$meta["meta_keywords"]?>" />
		    <meta name="author" content="<?=$meta["meta_author"]?>" />

        <link rel="shortcut icon" href="<?=base_url()?><?=$meta["icon"]?>">		   
		    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/mystyle.css" />
	    
		    <script type="text/javascript" src="<?=base_url()?>js/slantslideshow/modernizr.custom.js"></script>
		    <script type="text/javascript" src="<?=base_url()?>controls/slicebox/js/modernizr.custom.46884.js"></script>          
        <script type="text/javascript" src="<?=base_url()?>js/jquery.min.1.8.2.js"></script>
        <script type="text/javascript" src="<?=base_url()?>js/jquery.min.1.7.1.js"></script>	

		    <script type="text/javascript" src="<?=base_url()?>js/modernizr.custom.63321.js"></script>	
		    <script type="text/javascript" src="<?=base_url()?>js/jquery.catslider.js"></script>
		    <script type="text/javascript" src="<?=base_url()?>controls/slicebox/js/modernizr.custom.46884.js"></script> 
		
<style>

  body{
    background-image:url(<?=base_url()?>images/system/24953-2560x1600.jpg);
    overflow-x:hidden;
  }

  .ui-hr {
    border: 0; height: 1px; 
    background-image: -webkit-linear-gradient(left, rgba(<?=$rgb?>,0), rgba(<?=$rgb?>,0.75), rgba(<?=$rgb?>,0));       
    background-image: -moz-linear-gradient(left, rgba(<?=$rgb?>,0), rgba(<?=$rgb?>,0.75), rgba(<?=$rgb?>,0)); 
    background-image: -ms-linear-gradient(left, rgba(<?=$rgb?>,0), rgba(<?=$rgb?>,0.75), rgba(<?=$rgb?>,0)); 
    background-image: -o-linear-gradient(left, rgba(<?=$rgb?>,0), rgba(<?=$rgb?>,0.75), rgba(<?=$rgb?>,0));
    background-image: linear-gradient(left, rgba(<?=$rgb?>,0), rgba(<?=$rgb?>,0.75), rgba(<?=$rgb?>,0));
    width:100%; 
  }

  button{
  background: <?=$theme["nBackColor"]?>;
  color:<?=$theme["nForeColor"]?>;
  border: 1px solid <?=$theme["nBorderColor"]?>;
		background-color: <?=$theme["nBackColor"]?>;
		background-image: -moz-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["nBorderColor"]?>), to(<?=$theme["pBackColor"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);	
		background-image: -o-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: -ms-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
  }
  button:hover{
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
  
  button:active {
  color: <?=$theme["nForeColor"]?>;
  background: <?=$theme["pBackColor"]?>;
  border: 1px solid <?=$theme["nBackColor"]?>;
  }
  
  @keyframes buttonHover{
    from {background: <?=$theme["nBackColor"]?>;
    }
    to {background: <?=$theme["hBackColor"]?>;
    }
  }
	@keyframes buttonOut {
    from {background: <?=$theme["hBackColor"]?>;}
    to {background: <?=$theme["BackColor"]?>;}
  }  
    
  .primaryPhoto{
   background-image:url(<?=$photos?>);
  }
  .primaryPhoto:hover{
   background-image:url('<?=base_url()?>images/data/profilepicture/aimworld.png'); 
  }

</style>
<title><?php echo $meta["title"];?></title>
</head>

<body>

<div class="top-container">
</div>
