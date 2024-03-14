var allowViewMedia = "0";
var mediaID="0";
var source="";

function setMediaMouseOver(element)
{
      $(element).addClass("ui-state-highlight").css("cursor","pointer");
      $(element).find("img").css("opacity","0.7");
}

function setMediaMouseOut(element)
{
      $(element).removeClass("ui-state-highlight").css("cursor","");
      $(element).find("img").css("opacity","1");
}

function clickMedia(element)
{

if (allowViewMedia=="0")
{

mediaID = $(element).find("img").attr("src");
source = $(element).find("img").attr("src");






$.post("ctrlMedia/openMedia/1",{ mediaID:"12",page:1,order:"uploadedDt desc"}, function(value)
{
var col = value.split("~");


$("#lblFileName").empty().append(col[3]);
$("#lblType").empty().append(col[1]);
$("#lblCategory").empty().append(col[2]);
$("#lblDateCreated").empty().append(col[6]);
$("#lblUploadedBy").empty().append(col[5]);
$("#txtSourceFile").val(col[4]);
$("#txtSourceImgFile").val("<img border='1' title='"+col[3]+"' alt='"+col[3]+"' style='width:100%' src='"+col[4]+"'>");

$("#imgMediaDetails").attr("src",source);
$( "#dialog-open-media" ).dialog("open");
});

}




}

function setMediaMouseOverClose(element)
{
      $(element).addClass("ui-state-error").css("cursor","pointer");
}
function setMediaMouseOutClose(element)
{
      $(element).removeClass("ui-state-error").css("cursor","");
      allowViewMedia="0";
}

function MediaDelete(mediaIDs,sources)
{
      mediaID = mediaIDs;
      source = sources;
      allowViewMedia="1";
      
      $( "#media-dialog-confirm" ).dialog("open");
}


$("#mediaWait").show();
$.post("ctrlMedia/getMediaPhotos/"+$("#Mediausr").attr("alt"),{ categoryName:"",page:1,order:"uploadedDt desc"}, function(value)
{
$("#mediaContainer").empty().html(value).fadeIn(500);
$("#mediaWait").hide();
});


///////////////////NAVIGATION BUTTON////////////////////////////
////////////////////////////////////////////////////////////////
function setNavigationHover(element)
{
      $(element).addClass("ui-state-hover").css("cursor","pointer");
}

function setNavigationOut(element)
{
      $(element).removeClass("ui-state-hover").css("cursor","");
      allowViewMedua="0";
}

function clickNavigation(element)
{
      var orders = $("#cboSMediaOrder").val();
      var pages = $(element).attr("alt");
      var categoryNames = $("#cboMediaCategorFolder").val();
      
      $("#mediaWait").show();
      $("#mediaContainer").hide();
      $.post("ctrlMedia/getMediaPhotos/"+$("#Mediausr").attr("alt"),{ categoryName:categoryNames,page:pages,order:orders}, function(value)
      {
      $("#mediaContainer").empty().html(value).fadeIn(500);
      $("#mediaWait").hide();
      });

}


//////////////DIALOG BOX FOR CONFIRMATION OF DELETE RECORD//////////////////////
////////////////////////////////////////////////////////////////////////////////
    $( "#media-dialog-confirm" ).dialog({
      resizable: false,
      
    autoOpen:false,
    height:'auto',
    width:'auto',
    modal:true,
    buttons:{
    "Yes":function(){
                $.post("ctrlMedia/deleteMedia/1",{mediaID:mediaID,source:source}, function(data){
               $( "#cboMediaCategorFolder" ).trigger( "change" );
                $(this).dialog("close"); 
                
                });          

    $(this).dialog("close");
    },
    "No":function(){
    $( this ).dialog("close");
    }
    }
    });

$(function() {

////////////CHANGE EVENT OF COMBOBOX TYPE///////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#cboMediaCategorFolder,#cboSMediaOrder").change(function() {
var orders = $("#cboSMediaOrder").val();
var categoryNames = $("#cboMediaCategorFolder").val();
$("#mediaWait").show();
$("#mediaContainer").hide();
$.post("ctrlMedia/getMediaPhotos/"+$("#Mediausr").attr("alt"),{ categoryName:categoryNames,page:1,order:orders}, function(value)
{
$("#mediaContainer").empty().html(value).fadeIn(500);
$("#mediaWait").hide();
});
});


////////////UPLOAD BUTTON///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
var GenExt="";
$(document).ready(function(){
		new AjaxUpload('#cmdAddMedia', 
    {
		action: 'ctrlMedia/uploadMedia/'+$("#Mediausr").attr("alt"),	
		onSubmit : function(file , ext)
      {
			if (ext && /^(jpg|png|jpeg|gif)$/.test(ext))
          {
          
          if($("#cboMediaCategorFolder").val()!="" && $("#cboMediaCategorFolder").val()!="x" )
          {
          GenExt = ext;
          $("#loadingUpload,#progressbar").show();
          this.setData({countryFlag: file,ext:ext[0],folder:$("#cboMediaCategorFolder").val()});          
          }
          else
          {
           alert('Ooops! Please Select Category Folder first before you upload!');
          return false;
          }
    
			    } 
      else 
          {				
			    alert('Error: Only images are allowed');
				  return false;				
			    }
		  },
		  onProgress: function(progress)
      {
          var percentage = Math.floor((progress.total / progress.totalSize) * 100);
          $( "#progressbar" ).progressbar({value: percentage});
          $( "#loadingUpload" ).empty().append(percentage+"%");
      },
		  onComplete : function(file)
      {
      
      $.post("ctrlMedia/addMedia/1",{source:'images/data/countries/' ,extension:GenExt[0],folder:$("#cboMediaCategorFolder").val(),usr:$("#Mediausr").attr("alt")}, function(data){

      $( "#cboMediaCategorFolder" ).trigger( "change" );
      
      });                   
	
		  }		
	  });
});


///////////////////OPEN DETAILS BOX/////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$(function() {
    $( "#dialog-open-media" ).dialog({
      autoOpen: false,
      resizable: false,
      modal: true,
      closeOnEscape: false,
      height:'auto',
      width:'auto',
      beforeclose: function (event, ui) { return false; }
    });

});

////////////////////COPY PASTE CLIPBOARD/////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
var clipboard = new Clipboard('#cmdSourceFile,#cmdSourceImgFile');
clipboard.on('success', function(e) {
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);
    $( "#dialog-open-media" ).dialog("close");
    e.clearSelection();
});

clipboard.on('error', function(e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);
});







});
