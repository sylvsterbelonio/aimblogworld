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
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/mystyle.css" /> 
        
        <script src="<?=base_url()?>controls/tabcontrol/jquery.min.js"></script>
        <script src="<?=base_url()?>controls/tabcontrol/bootstrap.min.js"></script>
        
		    <script type="text/javascript" src="<?=base_url()?>js/modernizr.custom.46884.js"></script>           
        <script type="text/javascript" src="<?=base_url()?>js/jquery.min.1.8.2.js"></script>
        

        
        <script type="text/javascript" src="<?=base_url()?>js/signDialog/modernizr.custom.dialog.js"></script>

        <script src="<?=base_url()?>js/jquery.json-2.2.min.js" type="text/javascript"></script>     

<style>

    
  body{
    background-image:url(<?=base_url()?>images/system/24953-2560x1600.jpg);
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
  
    input,textarea{
  -moz-transition: all 0.3s;  
-webkit-transition: all 0.3s;  
-ms-transition: all 0.3s;
transition: all 0.3s;
  border:1px solid <?=$theme["hForeColor"]?>;
  border-radius:5px;
  clear:left;
  padding:5px;
  }
  input:focus,textarea:focus{
  border:1px solid #999696;
  color:black;
    -webkit-box-shadow: 0px 8px 1px #a5a5a5;
    box-shadow: 0px 0px 8px 1px #a5a5a5;
  background:<?=$theme["hForeColor"]?>;
  outline:none;
  }
  .ui-state-text-error{
  border:1px solid red;
  background:#ffc8c8;
  color:#ff0000;
  }  
  button:hover{
  background: <?=$theme["hBackColor"]?>;
  color: <?=$theme["hForeColor"]?>;
  border: 1px solid <?=$theme["hForeColor"]?>;
  animation-name: buttonHover;
  animation-duration: .3s;	
  cursor:pointer;
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

