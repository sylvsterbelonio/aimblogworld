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
<div id="jqgridContainer_PCategory" style='width:99%;overflow:auto;padding:5px;display:non' class="ui-widget-content ui-corner-all">

<div style="margin-bottom:5px;padding-top:7px;padding-left:5px" class="ui-state-active ui-corner-top">
<ul>
<li><?=form_input($ftxtSPCagetorysearch)?></li>
<li><button id="cmdPCategorySearch"  class="ui-widget-content ui-corner-right" style="padding:4px 10px;display:inline-block"><span class="ui-icon ui-icon-search" style="float:left;margin-right:5px"></span><span style="float:right">Search</span></button></li>
</ul>
</div>

<ul>
<li><button id="cmdPCategoryAdd" class="ui-state-default ui-corner-all" style="padding-bottom:4px"><span class="ui-icon ui-icon-plus" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Add</span></button></li>
<li><button id="cmdPCategoryEdit" class="ui-state-default ui-corner-all" style="padding:3px 10px;padding-bottom:6px;margin-right:1px"><span class="ui-icon ui-icon-pencil" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Edit</span></button></li>
</ul>

<table id="pcategoryList" class="scroll"></table> 
  <div id="pcategory_pager" class="scroll" style="text-align:center;height:50px">
</div>	

</div>

<input id="PCategoryusr" type="text" alt="<?php echo $PIID;?>">
 
<div id="pcategory-dialog-form" title="Operation Details">
  <p class="validateTips_pcategory">All form fields are required.</p> 
     <label>Category Name</label><br>
     <?=form_input($ftxtPCagetoryName)?><br>
</div>




<script>
$(function(){
$.getScript('js/events/menu/vlstPCategory.js.php');
});
</script> 
