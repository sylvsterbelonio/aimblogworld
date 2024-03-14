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
<div id="jqgridContainer_PackageItems" style='width:99%;overflow:auto;padding:5px;display:non' class="ui-widget-content ui-corner-all">

<div style="margin-bottom:5px;padding-top:7px;padding-left:5px" class="ui-state-active ui-corner-top">
<ul>
<li><?=$fcboPackageItem?></li>
</ul>
</div>
<ul>

<input id="Packageusr" type="hidden" alt="<?php echo $PIID;?>">

<div id="containerList" style="display:none">
<ul style="margin-left:5px">
<li><?=$fcboselPackageProduct?></li>
<li><?=form_input($ftxtItemQuantity)?></li>
<li><button id="cmdItemAdd"  title="Add Items" class="ui-state-default ui-corner-" style="padding:5px ;display:inline-block"><span class="ui-icon ui-icon-plusthick" style="float:left;margin-right:"></span><span style="float:right"></span>Add</button></li>
<li><button id="cmdItemDelete"  title="Remove Items" class="ui-state-default ui-corner-right" style="padding:5px ;display:inline-block"><span class="ui-icon ui-icon-closethick" style="float:left;margin-right:"></span><span style="float:right"></span>Delete</button></li>
</ul>

<table id="itemList" class="scroll"></table> 
  <div id="item_pager" class="scroll" style="text-align:center;height:50px">
</div>	

</div>




</div>



<script>
$(function(){
$.getScript('js/events/menu/vlstPackageItem.js.php');
});
</script> 
