<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}
li {
    float: left;
    margin-bottom:5px;
}
</style>
<div id="jqgridContainer_Package" style='width:99%;overflow:auto;padding:5px;display:non' class="ui-widget-content ui-corner-all">

<div style="margin-bottom:5px;padding-top:7px;padding-left:5px" class="ui-state-active ui-corner-top">
<ul>
<li><?=form_dropdown($fcboSPackagetype,$fcbolstSPackagetype,'packageName')?>

</li>
<li><?=form_input($ftxtSPackagesearch)?></li>
<li><button id="cmdPackageSearch"  class="ui-widget-content ui-corner-right" style="padding:5px 10px;display:inline-block"><span class="ui-icon ui-icon-search" style="float:left;margin-right:5px"></span><span style="float:right">Search</span></button></li>
</ul>
</div>

<ul>
<li><button id="cmdPackageAdd" class="ui-state-default ui-corner-all" style="padding-bottom:4px"><span class="ui-icon ui-icon-plus" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Add</span></button></li>
<li><button id="cmdPackageEdit" class="ui-state-default ui-corner-all" style="padding:3px 10px;padding-bottom:6px;margin-right:1px"><span class="ui-icon ui-icon-pencil" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Edit</span></button></li>
<li><button id="cmdPackageDelete" class="ui-state-default ui-corner-all" style="padding:3px 10px;padding-bottom:6px"><span class="ui-icon ui-icon-closethick" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Delete</span></button></li>
</ul>

<table id="packageList" class="scroll"></table> 
  <div id="package_pager" class="scroll" style="text-align:center;height:50px">
</div>	

</div>

<input id="Packageusr" type="text" alt="<?php echo $PIID;?>">
 
<div id="package-dialog-form" title="Package Details" style="display:none">
  <p class="validateTips_package">All form fields are required.</p> 
  
<table>
<tr>
<td align="center"><img id="imgPackage" src="images/system/noimage.jpg" border=1 width="250" style="margin:5px"></td>
<td>
     <?=$fcboPackageFlag;?><br>
     <label>Package Name</label><br>
     <?=form_input($ftxtPackageName)?><br>
     <label>Price</label><br>
     <?=form_input($ftxtPackagePrice)?><br>
     <label>Price Symbol</label><br>
     <?=form_input($ftxtPackageSymbol)?><br>
     <label>Price Description</label><br>
     <?=form_input($ftxtPackageDescription)?><br>
     <label>Weight</label><br>
     <?=form_input($ftxtPackageWeight)?><br>
</td>
</tr>
<tr>
<td>
    <div id="progressbar_package" class="ui-widget-content ui-corner-all" style="margin:5px;height:15px;width:95%;display:none">
</td><td></td>
</tr>
<tr>
<td align="center" valign="top">
<ul>
    <li><button id="cmdPackageRemove"  title="Remove Package Image" class="ui-state-default ui-corner-left" style="margin-left:5px;padding:5px ;display:inline-block"><span class="ui-icon ui-icon-closethick" style="float:left;margin-right:"></span><span style="float:right"></span>Remove</button></li>
    <li><button id="cmdPackageUpload"  title="Upload Package Image" class="ui-state-default ui-corner-right" style="padding:5px ;display:inline-block"><span class="ui-icon ui-icon-arrowthickstop-1-n" style="float:left;margin-right:"></span><span style="float:right"></span>Upload</button></li>
</ul>
</td>
<td>

</td>
</tr>
</table>



  
</div>

<div id="package-dialog-confirm" title="Delete Confirm" style="display:none">
<p><span class="ui-icon ui-icon-alert" style="float:left;margin:0 7px 20px 0px;"></span> Are you sure you want to delete this record?</p>
</div>

<script>
$(function(){
$.getScript('js/events/menu/vlstPackage.js.php');
});
</script> 
