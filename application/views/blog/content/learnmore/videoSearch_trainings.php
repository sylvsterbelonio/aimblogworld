<?php
$this->load->model("blog/mdlGeneral");
$this->load->library("Color");

$this->load->model("blog/mdlVideoSearch");
$theme = $this->mdlGeneral->getTheme();
$rgb = $this->color->string_to_rgb($theme["container2"]);
$search="";
$videoVersion="All";
if(isset($_GET["videoVersion"])) $videoVersion = $_GET["videoVersion"];
if(isset($_GET["post"])) $search = $_GET["post"];


?>

<style>
.upper-wrapper-container{width:100%;position:relative;padding:5px;}
.upper-wrapper-container button{font-size:100%;}
.upper-left-wrapper-container {float:left;}
.upper-right-wrapper-container {float:right;}
.video-container {position:relative;padding-bottom:56.25%;padding-top:30px;height:0;overflow:hidden;}.video-container iframe, .video-container object, .video-container embed {position:absolute;top:0;left:0;width:100%;height:100%;}
.list-wrapper{width:25%;}
.right-pane{width:30%;}
.list-wrapper:hover{cursor:pointer;background:<?=$theme["nBackColor"]?>;color:<?=$theme["nForeColor"]?>;} 
.upper-left-wrapper-container button{padding:3px 0px 3px 3px;border-radius:0px;border-top-left-radius:5px;border-bottom-left-radius:5px;}
.upper-left-wrapper-container select{padding:6px 0px 6px 3px;float:right;border-radius:0px;border-top-right-radius:5px;border-bottom-right-radius:5px;}
</style>

<div class="ui-widget-content">
      <table class="ui-widget-table">
          <tr>
              <td colspan=2>
                  <div class="upper-wrapper-container ui-widget-header">
                      <div class="upper-left-wrapper-container">
                          <button id="list-general-area"><img oncontextmenu='return false;' src="<?=base_url()?>images/system/companyprofile.png"></button>
                            <?php if(!isset($_GET["post"])){ ?>
                            <select id="cboVideoVersion"><?=$this->mdlVideoSearch->getVideoVersion((isset($_GET["videoVersion"])) ? $_GET["videoVersion"] : '')?></select>    
                            <?php } else { ?>
                            <style>.upper-left-wrapper-container button{border-radius:5px;}</style>
                            <?php } ?>
                      </div>
                      <div class="upper-right-wrapper-container">
                          <input id="txtsearch" type="text">
                          <button id="cmdsearch">Search</button>
                      </div>
                      <div style="clear:both"></div>
                  </div>
              </td>
          </tr>
          <tr>
<?php

if(isset($_GET["post"]))
{

    $details = $this->mdlVideoSearch->getFullPostDetails($_GET["post"],(isset($_GET["videoVersion"])) ? $_GET["videoVersion"] : '');

?>
<style>
.left-wp-data{padding-top:10px;}
.left-wp-data h3{margin:10px 0px 10px 0px;color:<?=$theme["nBackColor"]?>}     
.left-wp-data p{margin:10px 0px 10px 0px}    
.left-wp-data table{float:left}      
.left-wp-data table tr td:nth-of-type(1) img{ width:100px;height:100px;} 
.left-wp-data table tr td:nth-of-type(2) p:nth-of-type(1){margin-top:10px} 
.left-wp-data table tr td:nth-of-type(2) p:nth-of-type(1) b{color:<?=$theme["nBackColor"]?>} 
.left-wp-data table tr td:nth-of-type(2) p:nth-of-type(2){line-height:1}
.left-wp-data div:nth-of-type(2){float:right;}    
.left-wp-data div:nth-of-type(2) p{margin-top:10px}
.left-wp-data div:nth-of-type(2) p b{color:<?=$theme["nBackColor"]?>}
</style>
                
              <td  valign=top>
              
                  <div class="left-wp-data" >           
                      <div class="video-container"><iframe id="youtubeLoader"  src="https://www.youtube.com/embed/<?=$details["data"]?>?modestbranding=1&amp;rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe></div>
                      <h3><?=$details["title"]?></h3>
                      <p>
                      <?=$details["subtitle"]?>
                      </p>
                      <hr>
                      <table>
                          <tr>
                              <td valign=top>
                                  <img oncontextmenu="return false;" src=" <?=$details["pheader"]?>">
                              </td>
                              <td valign=top>
                                  <p>
                                      <b>
                                      Shared by:</b> <?=$details["by"]?>
                                  </p>
                                  <p>
                                      <i><?=$details["position"]?></i>
                                  </p>
                              </td>
                          </tr>
                      </table>                  
                      <div>
                          <p>
                              <b>
                                  VIEWS:
                              </b> 
                              <?=$details["views"]?>
                          </p>
                          
                                                    <p>
                          <b>TAGNAME:</b> <span id="spnTag"><?=$details["searchTag"]?></span>
                          </p>
                          <p>
                              <i><?=$details["gapDate"]?></i>
                          </p>

                      </div>
                  </div>  
                            
              </td>
              
              
<style>             
.header-wrapper-box{line-height:2;color:<?=$theme["nBackColor"]?>;}
.footer-wrapper-box:hover{cursor:pointer;border:1px solid <?=$theme["hForeColor"]?>;background:<?=$theme["nBorderColor"]?>;}
.footer-wrapper-box{padding:5px;color:<?=$theme["nForeColor"]?>;font-size:100%}
.right-wp-list{padding-left:10px;margin-top:0px;}              
.right-wp-list:nth-of-type(1){padding-left:10px;margin-top:10px;}
.right-wp-list a{text-decoration:none;color:black;}
.right-wp-list a:hover{text-decoration:underline;color:<?=$theme["nBackColor"]?>;}              
.right-wp-list div{width:100%;clear:both}
.right-wp-list div table{width:100%;border:1px solid <?=$theme["container2"]?>;background: rgba(<?=$rgb?>,.3);}     
.right-wp-list div table tr td:nth-of-type(1){width:40%;height:80px}                 
.right-wp-list div table tr td:nth-of-type(1) img{width:100%;max-width:130px;height:100%}    
.right-wp-list div table tr td:nth-of-type(2) {position:relative;}
.right-wp-list div table tr td:nth-of-type(2) div:nth-of-type(1) span{text-decoration:none;font-size:80%;}  
.right-wp-list div table tr td:nth-of-type(2) div:nth-of-type(3){clear:both;font-size:70%}  
.right-wp-list div table tr td:nth-of-type(2) div:nth-of-type(4){position:absolute;bottom:0px;}                              
.right-wp-list div table tr td:nth-of-type(2) div:nth-of-type(4) span:nth-of-type(1){float:left;font-size:70%}    
.right-wp-list div table tr td:nth-of-type(2) div:nth-of-type(4) span:nth-of-type(2){float:right;font-size:70% }                                              
@media only screen and (max-width: 760px),(min-device-width: 768px) and (max-device-width: 1024px)  {
  .right-wp-list{padding-left:0px;}          
  .right-wp-list:nth-of-type(1){padding-left:0px;}
  .right-wp-list div table tr td:nth-of-type(2) div:nth-of-type(3){margin:0 auto;width:140px;}  }
</style>
              
              <td id="left-wp-data-list" class="right-pane" valign=top>
                  <?=$this->mdlVideoSearch->getRightListVideos($this->crypt->encrypt("Training Event"),1,$videoVersion,$_GET["post"],$details["searchTag"])?>      
              </div>               
                        
              </td>

      <?php } else { ?>
              <td>
                  <style>
                  .header-wrapper-box{line-height:2;color:<?=$theme["nBackColor"]?>;}
                  .footer-wrapper-box:hover{cursor:pointer;border:1px solid <?=$theme["hForeColor"]?>;background:<?=$theme["nBorderColor"]?>;}
                  .footer-wrapper-box{padding:5px;color:<?=$theme["nForeColor"]?>;font-size:100%}
                  .list-wrapper-box a{text-decoration:none;color:black;}
                  .list-wrapper-box a:hover{text-decoration:underline;color:<?=$theme["nBackColor"]?>;}  
                  .list-wrapper-box:hover{cursor:pointer;text-decoration:underline;color:<?=$theme["nBackColor"]?>;}
                  .list-wrapper-box img{width:100%;}
                  .list-wrapper-box span:nth-of-type(1){display:block}
                  .list-wrapper-box span:nth-of-type(1) b{font-size:70%;} 
                  .list-wrapper-box span:nth-of-type(2) {float:left;font-size:80%;}
                  .list-wrapper-box span:nth-of-type(3) {float:right;font-size:80%;}  
                  .list-wrapper-box{width:25%;padding:0px 5px 0px 0px;}
                  @media only screen and (max-width: 760px),(min-device-width: 768px) and (max-device-width: 1024px)  {
                	.right-pane{width:100%;}
                  .list-wrapper-box img{border:0px solid <?=$theme["nBackColor"]?>;-moz-transition: all 0.3s;  -webkit-transition: all 0.3s;  -ms-transition: all 0.3s;transition: all 0.3s;}
                  .list-wrapper-box img:hover{border:5px solid <?=$theme["nBackColor"]?>;}
                  .list-wrapper-box{width:100%;padding:0px;}
                	}
                  </style>
                  <table id="wp-all-wrapper" border=0 class="ui-widget-table"><?=$this->mdlVideoSearch->getListVideos($this->crypt->encrypt("Training Event"),1,$videoVersion)?></table>      
              </td>
      <?php } ?>
          </tr>
      </table>
</div>

<script>



$("#cmdsearch").click(function(e) {
         $(function(){
         
         
         <?php if(isset($_GET["post"])) { ?>
  
            var tag = $("#spnTag").text();
            
             $.post("<?=base_url()?>learnmore/product-presentation/rightsearch",{postID:<?=$details["postID"]?>,tag:tag,data:1,type:"Training Event",search:$("#txtsearch").val(),videoVersion:"All"}, function(data){
             $("#left-wp-data-list").empty().append(data);
             $("#txtsearch").val("").focus();
             }); 
         
         <?php 
         }
         else
         {
         
         ?>
        
             $.post("<?=base_url()?>learnmore/product-presentation/search",{type:"Training Event",search:$("#txtsearch").val(),videoVersion:$("#cboVideoVersion").val()}, function(data){
             $("#wp-all-wrapper").empty().append(data);
             $("#txtsearch").val("").focus();
             }); 
         
         
         <?php
         
         }
         ?>

             
                     
         });
});

$("#txtsearch").keypress(function(e) {
    if(e.which == 13) {
    $("#cmdsearch").trigger("click");
    }
});

$("#cboVideoVersion").change(function() {

<?php if($search=="") {?>
window.location.href="<?=base_url()?>learnmore/product-presentation?videoVersion="+$("#cboVideoVersion").val();
<?php 
} 
else 
{ 
?>
window.location.href="<?=base_url()?>learnmore/product-presentation?videoVersion="+$("#cboVideoVersion").val()+"&post=<?=$search?>";
<?php
}
?>


});


$("#list-general-area").click(function() {window.location.href="<?=base_url()?>learnmore/aim-trainings";});
$(function(){$.getScript("<?=base_url()?>js/product-presentation.js.php");});</script>
