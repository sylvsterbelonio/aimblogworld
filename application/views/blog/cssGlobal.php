<?php
$this->load->library("Validator");
$this->load->model("mdlGeneral");
$this->load->model("blogs/mdlAccounts");
      $theme = $this->mdlGeneral->getTheme();
      
      $rgb = $this->color->string_to_rgb($theme["nBackColor"]);
      $photos = $this->mdlAccounts->getPhoto_Header();
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/template.css" /> 
<style>

   
  body{
      margin:0px;
      padding:0px;
      background-image:url(<?=$this->validator->validateSource($theme["backgroundImage"])?>);
      min-width:600px;
      font-size:200%;
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
  font-size:150%;
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
  
  select{
  border:1px solid <?=$theme["hForeColor"]?>;
  padding:5px;
  border-radius:5px;
  outline:none;
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
  
.sb-description {	background: rgba(<?=$rgb?>, 0.4);	border-left: 4px solid rgba(<?=$rgb?>,0.7);	}
.sb-slider li.sb-current .sb-description {color:<?=$theme["nForeColor"]?>}
.sb-slider li.sb-current .sb-description:hover {background: rgba(<?=$rgb?>, 0.7);	color:<?=$theme["hForeColor"]?>}
.nav-dots span.nav-dot-current {	box-shadow: 		0 1px 1px rgba(255,255,255,0.6), 		inset 0 1px 1px rgba(0,0,0,0.1), 		inset 0 0 0 3px <?=$theme["pBackColor"]?>,		inset 0 0 0 8px <?=$theme["nBackColor"]?>;}
.slicebox-loader {  border-top: 1.1em solid rgba(<?=$rgb?>, 0.2);  border-right: 1.1em solid rgba(<?=$rgb?>, 0.2);  border-bottom: 1.1em solid rgba(<?=$rgb?>, 0.2);  border-left: 1.1em solid <?=$theme["nBackColor"]?>;}
.slicebox-container{background:<?=$theme["nBackColor"]?>;}
.slicebox-mother-container{max-width:<?=$theme["maxWidth"]?>px;}
.slicebox-wait{background:<?=$theme["container"]?>}




.ui-widget-content{
background: <?=$theme["container"]?>;
padding:30px 15px 30px 25px;
}
p,div{
font-family: 'Open Sans Condensed','Arial Narrow', serif;

}
span{
font-size:110%;
}
.align-center{
text-align:center;
}

.ui-state-error{
    border: 1px solid <?=$theme["errorBorder"]?>;
    background: <?=$theme["errorBackground"]?>;
    color:<?=$theme["errorBorder"]?>;
    display:block;
    margin:0px auto;
}

.ui-widget-header{color:<?=$theme["nForeColor"]?>;border: 1px solid <?=$theme["nBorderColor"]?>;background-color: <?=$theme["nBackColor"]?>;background-image: -moz-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>); background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["nBorderColor"]?>), to(<?=$theme["pBackColor"]?>));	background-image: -webkit-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);	background-image: -o-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);background-image: -ms-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);background-image: linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);-moz-box-shadow: 0 1px 1px <?=$theme["pBackColor"]?>, 0 1px 0 <?=$theme["nBackColor"]?> inset;-webkit-box-shadow: 0 1px 1px <?=$theme["pBackColor"]?>, 0 1px 0 <?=$theme["nBackColor"]?> inset;}

.ui-widget-content{<?=$this->mdlGeneral->getStyle("div")?>border-color:4px solid <?=$theme["container2"]?>;background:<?=$theme["container"]?>;}

.ui-corner-all{<?=$this->mdlGeneral->getStyle("corner-all")?>}
.ui-corner-top{<?=$this->mdlGeneral->getStyle("corner-top")?>}



.slicebox-wait{height:200px;}






	/* 
	Generic Styling, for Desktops/Laptops 
	*/
	.ui-widget-table { 
		width: 100%; 
		border-collapse: collapse; 
	}
	/* Zebra striping */
	.ui-widget-table-skin tr:nth-of-type(even) { 
		border: 1px solid white;
		background-color: <?=$theme["nForeColor"]?>;
		background-image: -moz-linear-gradient($theme["nForeColor"]?>, <?=$theme["nForeColor"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from($theme["nForeColor"]?>), to(<?=$theme["nForeColor"]?>));	
		background-image: -webkit-linear-gradient($theme["nForeColor"]?>, <?=$theme["nForeColor"]?>);	
		background-image: -o-linear-gradient($theme["nForeColor"]?>, <?=$theme["nForeColor"]?>);
		background-image: -ms-linear-gradient($theme["nForeColor"]?>, <?=$theme["nForeColor"]?>);
		background-image: linear-gradient($theme["nForeColor"]?>, <?=$theme["nForeColor"]?>);
		
	}
  	
	.ui-widget-table-skin tr:nth-of-type(odd) { 
		border: 1px solid <?=$theme["container2"]?>;
		background-color: <?=$theme["nBackColor"]?>;
		background-image: -moz-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["container"]?>), to(<?=$theme["container2"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);	
		background-image: -o-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
		background-image: -ms-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
		background-image: linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
	}
	.ui-widget-table-skin th { 
		max-width: <?=$theme["maxWidth"]?>px;
		border: 1px solid <?=$theme["nBorderColor"]?>;
		background-color: <?=$theme["nBackColor"]?>;
		background-image: -moz-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["nBorderColor"]?>), to(<?=$theme["pBackColor"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);	
		background-image: -o-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: -ms-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		color: <?=$theme["nForeColor"]?>; 
		font-weight: bold; 
	}
	.ui-widget-table tr td, .ui-widget-table th { 
		padding: 0px; /* set to zero margin both sides*/
		text-align: left; 
	}
	
	.ui-widget-table-skin tr td, ui-widget-table-skin th{
  		border: 1px solid <?=$theme["container2"]?>; 
  }
  
</style>

	<!--[if !IE]><!-->
	<style>
	/* 
	Max width before this PARTICULAR table gets nasty
	This query will take effect for any screen smaller than 760px
	and also iPads specifically.
	*/
	@media 
	only screen and (max-width: 760px),
	(min-device-width: 768px) and (max-device-width: 1024px)  {
	
		/* Force table to not be like tables anymore */
		.ui-widget-table, .ui-widget-table thead, .ui-widget-table tbody, .ui-widget-table th, .ui-widget-table tr td, .ui-widget-table tr { 
			display: block; 
		}
		
		/* Hide table headers (but not display: none;, for accessibility) */
		.ui-widget-table thead tr { 
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
		
		.ui-widget-table-skin tr { border: 1px solid #ccc; }
		
		.ui-widget-table tr td { 
			/* Behave  like a "row" */
			border: none;
			position: relative;
      width:100%;
		}

		.ui-widget-table-skin tr td { 
			/* Behave  like a "row" */
			border-bottom: 1px solid <?=$theme["container"]?>; 
		}
    		
		.ui-widget-table tr td:before { 
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 6px;
			left: 6px;
			width: 45%; 
			padding-right: 10px; 
			white-space: nowrap;
		}
		/*
		Label the data
		*/
		.ui-widget-table tr td:nth-of-type(1):before { content: ""; }
		.ui-widget-table tr td:nth-of-type(2):before { content: ""; }
		.ui-widget-table tr td:nth-of-type(3):before { content: ""; }
		.ui-widget-table tr td:nth-of-type(4):before { content: ""; }
		.ui-widget-table tr td:nth-of-type(5):before { content: ""; }
		.ui-widget-table tr td:nth-of-type(6):before { content: ""; }
		.ui-widget-table tr td:nth-of-type(7):before { content: ""; }
		.ui-widget-table tr td:nth-of-type(8):before { content: ""; }
		.ui-widget-table tr td:nth-of-type(9):before { content: ""; }
		.ui-widget-table tr td:nth-of-type(10):before { content: ""; }
	}

.unselectable {
   -moz-user-select: -moz-none;
   -khtml-user-select: none;
   -webkit-user-select: none;

   /*
     Introduced in IE 10.
     See http://ie.microsoft.com/testdrive/HTML5/msUserSelect/
   */
   -ms-user-select: none;
   user-select: none;
}







/* THIS IS THE SAMPLE OF ALL LOADING ICONS HERE YOU CAN JUST LOAD IN HERE */
.ui-state-animate-wait-method-a{
background-image:url(<?=base_url()?>images/gif/ajax-loader@2x.gif);
background-repeat:no-repeat;
background-position:center;
}
.ui-state-animate-wait-method-b{
background-image:url(<?=base_url()?>images/gif/b53Ajb4ihCP.gif);
background-repeat:no-repeat;
background-position:center;
}










	</style>
	<!--<![endif]-->
