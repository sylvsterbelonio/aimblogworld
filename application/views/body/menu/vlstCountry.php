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

li a {
    display: inline-block;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
   #progressbar {

  }
 
  .progress-label {
    font-weight: bold;
    text-shadow: 1px 1px 0 #fff;
  }
 
</style>


<div id="jqgridContainer" style='width:99%;overflow:auto;padding:5px' class="ui-widget-content ui-corner-all">

<div style="margin-bottom:5px;padding-top:7px;padding-left:5px" class="ui-state-active ui-corner-top">
<ul>
<li><?=form_input($ftxtScountryName)?></li>
<li><button id="cmdCountrySearch"  class="ui-widget-content ui-corner-right" style="padding:4px 10px;display:inline-block"><span class="ui-icon ui-icon-search" style="float:left;margin-right:5px"></span><span style="float:right">Search</span></button></li>
</ul>
</div>

<ul>
<li><button id="cmdCountryAdd" class="ui-state-default ui-corner-left" style="padding-bottom:4px"><span class="ui-icon ui-icon-plus" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Add</span></button></li>
<li><button id="cmdCountryEdit" class="ui-state-default ui-corner-all" style="padding:3px 10px;padding-bottom:6px;margin-right:1px"><span class="ui-icon ui-icon-pencil" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Edit</span></button></li>
<li><button id="cmdCountryDelete" class="ui-state-default ui-corner-all" style="padding:3px 10px;padding-bottom:6px"><span class="ui-icon ui-icon-closethick" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Delete</span></button></li>
</ul>

<table id="countryList" class="scroll"></table> 
  <div id="pager" class="scroll" style="text-align:center;height:50px">
</div>	

</div> 
<input id="Cusr" type="text" alt="<?php echo $PIID;?>">



 
<div id="country-dialog-form" title="Country Details" style="display:none">
  <p class="validateTips">All form fields are required.</p>
     <ul>
    <li><img id="imgFlag" border=1 src="images/system/noflag.png"  height=30 width=50></li>
    <li><?=form_input($ftxtctrFlag)?></li>
    <li><button id="cmdCtyUpload"  title="Upload Flag Image" class="ui-state-default ui-corner-right" style="padding:5px ;display:inline-block"><span class="ui-icon ui-icon-arrowthickstop-1-n" style="float:left;margin-right:"></span><span style="float:right"></span>Upload</button></li>
    <li><div id="progressbar" class="ui-widget-content ui-corner-all" style="height:15px;width:300px;display:none"></div></li>
    <li valign="top"><span id="loadingUpload" style="font-size:10px;padding-bottom:5px;display:none">56%</span></li>    
    </ul>
    <ul>
    <li>Country Name<br>
    <?=form_input($ftxtDcountryName)?></li>

    </ul>
</div>

<div id="country-dialog-confirm" title="Delete Confirm" style="display:none">
<p><span class="ui-icon ui-icon-alert" style="float:left;margin:0 7px 20px 0px;"></span> Are you sure you want to delete this record?</p>
</div>

<script>
$(function(){
$.getScript('js/events/menu/vlstCountry.js.php');
});
</script>
   
