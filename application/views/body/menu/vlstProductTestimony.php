<div id="jqgridContainer_GTestimony" style='width:99%;overflow:auto;padding:5px;display:non' class="ui-widget-content ui-corner-all">

<div style="margin-bottom:5px;padding-top:7px;padding-left:5px" class="ui-state-active ui-corner-top">
<ul>
<li><?=$fcboselPDetailsTestimony?></li>
<li><?=form_input($ftxtSGTestimonysearch)?></li>
<li><button id="cmdGTestimonySearch"  class="ui-widget-content ui-corner-right" style="padding:4px 10px;display:inline-block"><span class="ui-icon ui-icon-search" style="float:left;margin-right:5px"></span><span style="float:right">Search</span></button></li>
</ul>
</div>

<table  id="pdetailsTestimony_waiting" style="width:100%;display:none" align=center>
<tr>
<td align=center >
<img src="images/gif/waiting.gif">
</td>
</tr>
</table>
<input id="ProductDetailtTestimonysnusr" type="text" alt="<?php echo $PIID;?>">
<div id="gtestimony_container" style="display:none">
<ul>
<li><button id="cmdGTestimonyAdd" class="ui-state-default ui-corner-all" style="padding-bottom:4px"><span class="ui-icon ui-icon-plus" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Add</span></button></li>
<li><button id="cmdGTestimonyEdit" class="ui-state-default ui-corner-all" style="padding:3px 10px;padding-bottom:6px;margin-right:1px"><span class="ui-icon ui-icon-pencil" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Edit</span></button></li>
<li><button id="cmdGTestimonyDelete" class="ui-state-default ui-corner-all" style="padding:3px 10px;padding-bottom:6px"><span class="ui-icon ui-icon-closethick" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Delete</span></button></li>
</ul>

<table id="gtestimonyList" class="scroll"></table> 
  <div id="gtestimony_pager" class="scroll" style="text-align:center;height:50px">
</div>	
</div>
<div id="gtestimony-dialog-confirm" title="Delete Confirm" style="display:none">
  <p><span class="ui-icon ui-icon-alert" style="float:left;margin:0 7px 20px 0px;"></span> Are you sure you want to delete this record?</p>
</div>  
<div id="gtestimony-dialog-form" title="Testimony Details" style="display:none">
  <p class="validateTipsGTestimony">All form fields are required.</p> 
     
     <table align=center><tr><td>
     <h3 align="center">Cover Photo</h3>
     <img id="imgCoverPhoto" src="images/system/noimage.jpg" style="width:100%;height:150px">
<br>
<div id="progressbar_testimony" class="ui-widget-content ui-corner-all" style="height:15px;width:100%;display:none"><br>
     
     </td></tr>
     <tr><td align="right">
<ul>
<li><button id="cmdGtestimonyRemove"  title="Remove Product Image" class="ui-state-default ui-corner-left" style="padding:5px ;display:inline-block"><span class="ui-icon ui-icon-closethick" style="float:left;margin-right:"></span><span style="float:right"></span>Remove</button></li>
<li><button id="cmdGtestimonyUpload"  title="Upload Product Image" class="ui-state-default ui-corner-right" style="padding:5px ;display:inline-block"><span class="ui-icon ui-icon-arrowthickstop-1-n" style="float:left;margin-right:"></span><span style="float:right"></span>Upload</button></li>
</ul>  
   </td></tr>
     </table>
     
     <label>Category Name</label><br>
     <?=form_input($ftxtGTestimonyCategory)?><br>
     <label>Title</label><br>
     <?=form_input($ftxtGTestimonyTitle)?><br>
     <label>Sub Title</label><br>
     <?=form_input($ftxtGTestimonySubTitle)?><br>
     <label>Content</label><br>
     <?=form_textarea($ftxtGTestimonyContent)?><br>
     <label>URL</label><br>
     <?=form_input($ftxtGTestimonyURL)?><br>
     <label>Tag Name</label><br>
     <?=form_textarea($ftxtGTestimonyTagName)?><br>
</div>

</div>   


<script>
$(function(){
$.getScript('js/events/menu/vlstProductDetailsGlobalTestimony.js.php');

});
</script> 
