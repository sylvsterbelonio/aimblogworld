<?php
$this->load->model("blogs/mdlAccounts");
$this->load->model("blogs/mdlGeneral");
$this->load->library("Language");
$contacts = $this->mdlAccounts->getContactsInfo_Header();
$theme=$this->mdlGeneral->getTheme();  
$lang = $this->language->topbar("topbar");
?>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/topbar.css" />
<style>
.top-header a.toplinks{ color: <?=$theme["nForeColor"]?>;}
.top-header a.toplinks:hover{background: <?=$theme["nBackColor"]?>;	color:<?=$theme["hForeColor"]?>}
.arrow_box,.arrow_box2 {	border: 1px solid <?=$theme["nBackColor"]?>;}
.arrow_box:before,.arrow_box2:before {	border-bottom-color: <?=$theme["nBackColor"]?>;	}
.yourName{color:<?=$theme["nBackColor"]?>;}
.welcome{color:<?=$theme["nForeColor"]?>;
}
</style>

<div class="top-header">
      <a class="toplinks" href="http://tympanus.net/Tutorials/CSSButtonsPseudoElements/"><?=$lang["powered"]?></a>
      <span class="right">
            <a class="toplinks" href="http://www.allianceinmotion.com/" target="_blank"><?=$lang["aimglobal"]?></a> 
            <a class="toplinks" href="http://dtc.aimglobalinc.com/login" target="_blank"><?=$lang["dtc"]?></a>        
            <a class="toplinks" href="http://aimcademy.com/" target="_blank"><?=$lang["aimcademy"]?></a>      
          	<a class="toplinks" href="http://www.aimworld.today/" target="_blank"><?=$lang["aimworld"]?></a>
          	<a class="toplinks" href="#register" target="_blank"><?=$lang["register"]?></a>
            <?php
            if($this->session->has_userdata('customerID'))
              {echo '<a  class="toplinks" href="'.base_url().'account/signout"><strong>'.$lang["signout"].'</strong></a>';}
            else
              {echo '<a  class="toplinks" href="account/signout"><strong>'.$lang["signin"].'</strong></a>' ; }
            ?>
      </span>
      
      <div class="clr"></div>
      <div class="top-bar-right"      
      <a id="lnkHomePage" href="<?php  if($this->config->item("gsitename")!="") echo base_url().$sitename;else echo base_url();?>"><img src="<?=base_url()?>images/system/aimglobal.png"></a>
        <div>
            <table>
            <tr>
                <td  class="welcome" colspan=2 align="right">
                    <b><?=$lang["welcome"]?></b>
                    <br>
                    <span id="spnCustomerInfo">
                    <i>
                        <?php 
                        if($this->session->has_userdata('customerID')) {echo $this->mdlCustomer->get_CustomerName($this->session->customerID);}
                        else {echo $lang["guest"];}
                        ?>
                    </i>
                    </span>
                </td>
                <td  colspan=2 rowspan=3 valign="top">
                    <div class="primaryPhoto">
                    </div>
                </td>
            </tr>
            <tr>
            </tr>
            <tr>
                <td colspan=2 align=right>
                    <button id="cmdMyContact" title="View My Contact List"><img src="<?=base_url()?>images/system/info.png"  height=17 ><?=$lang["contact"]?></button>
                    <button id="cmdWishList" title="Your Wish List"><img src="<?=base_url()?>images/system/cart.png" ><?=$lang["wishlist"]?></button>
                </td>
            </tr>
            <tr>
                <td style="position:relative">
                    <div id="myinfo" class='arrow_box'>
                        <?=$contacts?>
                    </div>
                </td>
                <td style="position:relative">
                    <div id="myinfo2" class='arrow_box2'>
                          <div class="contact">
                          <img src="images/system/viber.png" width=30 height=30><br>
                          <img src="images/system/viber.png" width=30 height=30><br>
                          </div>
                    </div>
                </td>
                <td>
                </td>
            </tr>
        </table>
      </div>
</div>
                   
<script>
$(function(){$("#cmdMyContact").click(function(){var position = $(this).position(); $("#myinfo").fadeIn(500);});$("#cmdWishList").click(function(){$("#myinfo2").fadeIn(500);});$(document).mouseup(function (e){  var container = $("#myinfo,#myinfo2");  if (!container.is(e.target)       && container.has(e.target).length === 0)   {  container.fadeOut(300);    }});});
</script>            
