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
<div id="jqgridContainer_ProductDetails" style='width:99%;overflow:auto;padding:5px;display:non' class="ui-widget-content ui-corner-all">

<div style="margin-bottom:5px;padding-top:7px;padding-left:5px" class="ui-state-active ui-corner-top">
<ul>
<li><?=$fcboselPDetails?></li>
<li style="float:right"><button id="cmdPDetailsUpdate"  title="Update Product Details"  class="ui-state-default ui-corner-all" style="margin-right:5px;padding:5px ;display:inline-block"><span class="ui-icon ui-icon-disk" style="float:left;margin-right:"></span>Update</button></li>
</ul>
</div>

<input id="ProductDetailsnusr" type="text" alt="<?php echo $PIID;?>">

<table id="pdetails_waiting" style="width:100%;display:none" align=center>
<tr>
<td align=center>
<img src="images/gif/waiting.gif">
</td>
</tr>
</table>

<div style='width:99%;overflow:auto;margin-right:0px;display:none' id="tabs_details" style="display:none">
  <ul>
    <li><a href="#tabs_pdetails-1">Product Details</a></li>
    <li><a href="#tabs_pdetails-2">Product Contents</a></li>
    <li><a href="#tabs_pdetails-3">Manufactured Company</a></li>
    <li><a href="#tabs_pdetails-5">Price</a></li>
  </ul>
  <div id="tabs_pdetails-1">
  <?=form_textarea($ftxtProductDetails)?>
  </div>
  <div id="tabs_pdetails-2">
  <?=form_textarea($ftxtProductContents)?>
  </div>
  <div id="tabs_pdetails-3">
  <?=form_textarea($ftxtManufacturedCompany)?>  
  </div>
  <div id="tabs_pdetails-5">


<div id="price-dialog-form" title="Price Details">
  <p class="validateTipsPrice">All form fields are required.</p> 
     <?=$fcboPriceFlag;?><br>
     <label>Price Symbol</label><br>
     <?=form_input($ftxtPriceSymbol)?><br>
     <label>Price Description</label><br>
     <?=form_input($ftxtPriceDesc)?><br>
     <label>Distributors Price</label><br>
     <?=form_input($ftxtDPrice)?><br>
     <label>Retail Price</label><br>
     <?=form_input($ftxtRPrice)?><br>
</div>
      <div id="price-dialog-confirm" title="Delete Confirm">
          <p><span class="ui-icon ui-icon-alert" style="float:left;margin:0 7px 20px 0px;"></span> Are you sure you want to delete this record?</p>
      </div>   
      
      <div id="jqgridContainer_Price" style='width:99%;overflow:auto;padding:5px;display:non' class="ui-widget-content ui-corner-all">
      
      <div style="margin-bottom:5px;padding-top:7px;padding-left:5px;height:20px" class="ui-state-active ui-corner-top">
      </div>
      
      <ul>
          <li><button id="cmdPriceAdd" class="ui-state-default ui-corner-all" style="padding-bottom:4px"><span class="ui-icon ui-icon-plus" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Add</span></button></li>
          <li><button id="cmdPriceEdit" class="ui-state-default ui-corner-all" style="padding:3px 10px;padding-bottom:6px;margin-right:1px"><span class="ui-icon ui-icon-pencil" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Edit</span></button></li>
          <li><button id="cmdPriceDelete" class="ui-state-default ui-corner-all" style="padding:3px 10px;padding-bottom:6px"><span class="ui-icon ui-icon-closethick" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Delete</span></button></li>
      </ul>
      
      <table id="priceList" class="scroll"></table> 
        <div id="price_pager" class="scroll" style="text-align:center;height:50px">
      </div>
       	

   
          
      </div>






  </div>
</div>
 
</div>



<script>
$(function(){
$.getScript('js/events/menu/vlstProductDetails.js.php');

});
</script> 
