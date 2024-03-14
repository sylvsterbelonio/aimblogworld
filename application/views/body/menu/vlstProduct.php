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
<div id="jqgridContainer_Operation" style='width:99%;overflow:auto;padding:5px;display:non' class="ui-widget-content ui-corner-all">

<div style="margin-bottom:5px;padding-top:7px;padding-left:5px" class="ui-state-active ui-corner-top">
<ul>
<li><?=form_input($ftxtSProductsearch)?></li>
<li><button id="cmdProductSearch"  class="ui-widget-content ui-corner-right" style="padding:4px 10px;display:inline-block"><span class="ui-icon ui-icon-search" style="float:left;margin-right:5px"></span><span style="float:right">Search</span></button></li>
</ul>
</div>

<ul>
<li><button id="cmdProductAdd" class="ui-state-default ui-corner-all" style="padding-bottom:4px"><span class="ui-icon ui-icon-plus" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Add</span></button></li>
<li><button id="cmdProductEdit" class="ui-state-default ui-corner-all" style="padding:3px 10px;padding-bottom:6px;margin-right:1px"><span class="ui-icon ui-icon-pencil" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Edit</span></button></li>
<li><button id="cmdProductDelete" class="ui-state-default ui-corner-all" style="padding:3px 10px;padding-bottom:6px"><span class="ui-icon ui-icon-closethick" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Delete</span></button></li>
</ul>

<table id="productList" class="scroll"></table> 
  <div id="product_pager" class="scroll" style="text-align:center;height:50px">
</div>	

</div>

<input id="Productusr" type="text" alt="<?php echo $PIID;?>">

<div id="product-dialog-form" title="Product Details" style="display:none">
  <p class="validateTips_product">All form fields are required.</p> 

<table border=0 style="width:100%" align=center>
<tr>
<td   align=left><img id="imgProduct" border=1 src="images/system/noproduct.png"  height=150 width=150><br>
</td>
</tr>
<tr>
<td align=left>
<ul>
<li><button id="cmdProductRemove"  title="Remove Product Image" class="ui-state-default ui-corner-left" style="padding:5px ;display:inline-block"><span class="ui-icon ui-icon-closethick" style="float:left;margin-right:"></span><span style="float:right"></span>Remove</button></li>
<li><button id="cmdProductUpload"  title="Upload Product Image" class="ui-state-default ui-corner-right" style="padding:5px ;display:inline-block"><span class="ui-icon ui-icon-arrowthickstop-1-n" style="float:left;margin-right:"></span><span style="float:right"></span>Upload</button></li>
</ul>
<div id="progressbar_product" class="ui-widget-content ui-corner-all" style="height:15px;width:100%;display:none"><br>

<br>
</td>
</tr>
<tr>
<td>
<?=$fcboProductCategory?>
</td>
</tr>
<tr>
<td>
<label>Product Name<br>
<?=form_input($ftxtProductName)?>
</td>
</tr>
<tr>
<td>
<label>Brief Description<br>
<?=form_textarea($ftxtProductDescription)?>
</td>
</tr>
<tr>
<td>
<label>Units<br>
<?=form_input($ftxtProductUnits)?>
</td>
</tr>
<tr>
<td>
<label>Binary Points<br>
<?=form_input($ftxtProductBinaryPoints)?>
</td>
</tr>
<td>
<label>Commissional Points<br>
<?=form_input($ftxtProductCommissionalPoints)?>
</td>
</tr>
<tr>
<td>
<label>Positional Points<br>
<?=form_input($ftxtProductPositionalPoints)?>
</td>
</tr>
<tr>
<td>
<label>Weight<br>
<?=form_input($ftxtProductWeight)?>
</td>
</tr>
</table>
</div>

<div id="product-dialog-confirm" title="Delete Confirm" style="display:none">
<p><span class="ui-icon ui-icon-alert" style="float:left;margin:0 7px 20px 0px;"></span> Are you sure you want to delete this record?</p>
</div>

<script>
$(function(){
$.getScript('js/events/menu/vlstProduct.js.php');
});
</script> 
