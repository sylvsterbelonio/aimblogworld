<?php
$this->load->model("blog/mdlGeneral");
$this->load->model("blog/mdlAccounts");
$this->load->library("Url");
$theme=$this->mdlGeneral->getTheme();


$Sitename = $this->uri->segment(1);
        $this->core->init();
        if($Sitename!="")
          {
          $PIID=$this->mdlAccounts->getAccountPIID($Sitename);           
          $this->core->setData($PIID,$Sitename);             
          }
          
?>
<style>
.ul-company{
display:inline-block;
list-style:none;
margin: 0;
overflow: hidden;
padding: 0;
text-align:center;
color:white;

}
.ul-company li{
display:inline;
float: left;
margin:0px 0px 0px 0px;
    font-family: 'Open Sans Condensed','Arial Narrow', serif;
    font-size:170%;
width:140px;
height:100px;
  
color: <?=$theme["nForeColor"]?>;
font-weight:500%;
padding:10px;
}

.ul-company li div{
    width:70px;
    margin:0px auto;
		border: 1px solid <?=$theme["nBorderColor"]?>;
		background-color: <?=$theme["nBackColor"]?>;
		background-image: -moz-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["nBorderColor"]?>), to(<?=$theme["pBackColor"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);	
		background-image: -o-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: -ms-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		-moz-box-shadow: 0 1px 1px <?=$theme["pBackColor"]?>, 0 1px 0 <?=$theme["nBackColor"]?> inset;
		-webkit-box-shadow: 0 1px 1px <?=$theme["pBackColor"]?>, 0 1px 0 <?=$theme["nBackColor"]?> inset;
		box-shadow: 0 1px 1px <?=$theme["pBackColor"]?>, 0 1px 0 <?=$theme["nBackColor"]?> inset;border-radius:50%;
padding:10px 15px 10px 15px;
				-webkit-transition: all .3s ease-in-out;
		-moz-transition: all .3s ease-in-out;
		-ms-transition: all .3s ease-in-out;
		-o-transition: all .3s ease-in-out;
		transition: all .3s ease-in-out;  
		
}
.ul-company li div:hover{
  cursor:pointer;
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
.menu-wrapper{
  background: rgba(0,0,0,0.5) 
}


</style>


<div class="menu-wrapper">
<h5 align=center>
    <ul class="ul-company">
        <li>
        <div  id="ourcompany" style="padding-left:17px;padding-right:17px;"><img src="<?=base_url()?>images/system/ourcompany.png">
        </div>
        <span  style="line-height:30px" title="Our Company">Our Company</span>
        </li>
        <li>
        <div id="boardofdirectors"><img src="<?=base_url()?>images/system/board.png">
        </div>
        <span style="line-height:30px" title="Board of Directors">Board of Directors</span>
        </li>
        <li>
        <div id="partners"><img src="<?=base_url()?>images/system/partners.png">
        </div>
        <span style="line-height:30px" title="Our Partners">Our Partners</span>
        </li>
        <li>
        <div id="alive"><img src="<?=base_url()?>images/system/alive.png">
        </div>
        <span style="line-height:30px" title="Alive Foundation">Alive Foundation</span>
        </li>
        <li>
        <div id="tieups"><img src="<?=base_url()?>images/system/tieups.png">
        </div>
        <span style="line-height:30px" title="Tie Ups">Tie Ups</span>
        </li>
        <li>
        <div id="shop"><img src="<?=base_url()?>images/system/products.png">
        </div>
        <span style="line-height:30px" title="Our Products">Our Products</span>
        </li>
    </ul>
    </h5>
    <div style="clear:both"></div>
</div>



<script>

$("#ourcompany,#boardofdirectors,#partners,#tieups,#alive,#shop").click(function() {
if($(this).attr("id")=="ourcompany") window.location.href="<?=$this->url->getSiteSource("company,shop,tie-ups,alive-foundation,board-of-directors,business-partners#business-partners","company")?>";
if($(this).attr("id")=="boardofdirectors") window.location.href="<?=$this->url->getSiteSource("company,tie-ups,shop,alive-foundation,board-of-directors,business-partners#business-partners","board-of-directors")?>";
if($(this).attr("id")=="partners") window.location.href="<?=$this->url->getSiteSource("company,shop,tie-ups,alive-foundation,board-of-directors,business-partners#business-partners","business-partners#business-partners")?>";
if($(this).attr("id")=="alive") window.location.href="<?=$this->url->getSiteSource("company,shop,tie-ups,alive-foundation,board-of-directors,business-partners#business-partners","alive-foundation")?>";
if($(this).attr("id")=="tieups") window.location.href="<?=$this->url->getSiteSource("company,tie-ups,shop,alive-foundation,board-of-directors,business-partners#business-partners","tie-ups")?>";
if($(this).attr("id")=="shop") window.location.href="<?=$this->url->getSiteSource("company,tie-ups,shop,alive-foundation,board-of-directors,business-partners#business-partners","shop")?>";
});


</script>
