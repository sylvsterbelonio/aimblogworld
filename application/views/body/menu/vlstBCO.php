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

<div id="jqgridContainer_BCO" style='width:99%;overflow:auto;padding:5px;display:non' class="ui-widget-content ui-corner-all">

<div style="margin-bottom:5px;padding-top:7px;padding-left:5px" class="ui-state-active ui-corner-top">
<ul>
<li><?=form_dropdown($fcboSBCOtype,$fcbolstSBCOtype,'ownerName')?>



</li>
<li><?=form_input($ftxtSBCOsearch)?></li>
<li><button id="cmdBCOSearch"  class="ui-widget-content ui-corner-right" style="padding:4px 10px;display:inline-block"><span class="ui-icon ui-icon-search" style="float:left;margin-right:5px"></span><span style="float:right">Search</span></button></li>
</ul>
</div>

<ul>
<li><button id="cmdBCOAdd" class="ui-state-default ui-corner-all" style="padding-bottom:4px"><span class="ui-icon ui-icon-plus" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Add</span></button></li>
<li><button id="cmdBCOEdit" class="ui-state-default ui-corner-all" style="padding:3px 10px;padding-bottom:6px;margin-right:1px"><span class="ui-icon ui-icon-pencil" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Edit</span></button></li>
<li><button id="cmdBCODelete" class="ui-state-default ui-corner-all" style="padding:3px 10px;padding-bottom:6px"><span class="ui-icon ui-icon-closethick" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Delete</span></button></li>
</ul>

<table id="bcoList" class="scroll"></table> 
  <div id="bco_pager" class="scroll" style="text-align:center;height:50px">
</div>	

</div> 
<input id="BCOusr" type="text" alt="<?php echo $PIID;?>">

 
<div id="bco-dialog-form" title="BCO Details" style="display:none">
  <p class="validateTips_bco">All form fields are required.</p>
    
     <?=$fcboBCOFlag;?><br>
     <label>BCO</label><br>
     <?=form_input($ftxtbcoBCO)?><br>
     <label>Ownername</label><br>
     <?=form_input($ftxtbcoOwnername)?><br>
     <label>Address</label><br>
     <?=form_textarea($ftxtbcoAddress)?><br>
     <label>Contact No</label><br>
     <?=form_input($ftxtbcoContactNo)?><br>
     <label>Tel No</label><br>
     <?=form_input($ftxtbcoTelNo)?><br>
  
</div>

<div id="bco-dialog-confirm" title="Delete Confirm" style="display:none">
<p><span class="ui-icon ui-icon-alert" style="float:left;margin:0 7px 20px 0px;"></span> Are you sure you want to delete this record?</p>
</div>

<script>
$(function(){
$.getScript('js/events/menu/vlstBCO.js.php');
});
</script>
