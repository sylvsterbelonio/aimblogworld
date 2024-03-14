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

#preview
{
color:#cc0000;
font-size:12px
}
.imgList 
{
max-height:150px;
margin-left:5px;
border:1px solid #dedede;
padding:4px; 
float:left; 
}

</style>


<div id="dialog-open-media" title="Media Details">

<table id="tableE" border=0 style="width:100%">

<tr>
<td align=center>
<img id="imgMediaDetails" src="" width="280">
</td>

<td valign="top">
<p><b>Filename: </b><br><span id="lblFileName" style="text-indent:10px"></span></p>
<p><b>Type: </b><br><span id="lblType"></span></p>
<p><b>Category: </b><br><span id="lblCategory"></span></p>
<p><b>Date Created: </b><br><span id="lblDateCreated"></span></p>
<p><b>Uploaded By: </b><br><span id="lblUploadedBy"></span></p>
</td>



<tr>
<td colspan=2>
<p><b>Source File:</b><br>
<input id="txtSourceFile" type="text" style="width:100%">
<button id="cmdSourceFile" OnMouseOver="setMediaMouseOver(this);" OnMouseOut="setMediaMouseOut(this);" class="ui-state-default ui-corner-all" data-clipboard-action="copy" data-clipboard-target="#txtSourceFile" style="padding-bottom:4px;margin-right:5px;float:right"><span class="ui-icon ui-icon-document-b" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Copy Link</span></button></li>
</p>
</td>
</tr>

<tr>
<td colspan=2>
<p><b>Embeded Image Tag:</b><br>
<input id="txtSourceImgFile" type="text" style="width:100%">
<button id="cmdSourceImgFile" OnMouseOver="setMediaMouseOver(this);" OnMouseOut="setMediaMouseOut(this);" class="ui-state-default ui-corner-all" data-clipboard-action="copy" data-clipboard-target="#txtSourceImgFile" style="padding-bottom:4px;margin-right:5px;float:right"><span class="ui-icon ui-icon-document-b" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Copy Link</span></button></li>
</p>
</td>
</tr>

</table>


</div>



<div id="jqgridContainer_media" style='width:99%;overflow:auto;padding:5px;display:non' class="ui-widget-content ui-corner-all">


<div style="margin-bottom:5px;padding-top:7px;padding-left:5px" class="ui-state-active ui-corner-top">
<ul>
<li><?=($fcboMediaCategorFolder)?></li>
<li><?=form_dropdown($fcboSMediaOrder,$fcbolstSMediaOrder,'uploadedDt_desc')?></li>
<li style="float:right">
<button id="cmdAddMedia" class="ui-state-default ui-corner-all" style="padding-bottom:4px;margin-right:5px"><span class="ui-icon ui-icon-plus" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Add Media</span></button></li>
</ul>
<input id="Mediausr" type="hidden" alt="<?php echo $PIID;?>">
</div>

<table id="mediaWait" style="width:100%" align=center>
<tr>
<td align=center>
<img src="images/gif/waiting.gif">
</td>
</tr>
</table>

<div id="mediaContainer" class="ui-widget-content ui-corner-all" style="">
</div>

</div>

<div id="media-dialog-confirm" title="Delete Confirm">
<p><span class="ui-icon ui-icon-alert" style="float:left;margin:0 7px 20px 0px;"></span> Are you sure you want to delete this photo?</p>
</div>


<script>
$(function(){
$.getScript('js/events/menu/vlstMedia.js.php');
});
</script> 
