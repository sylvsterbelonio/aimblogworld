////////////JQGRID LIST/////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
var GTID="0";
var PID="";
var actionGTestimony="add";
var mediaID="0";

$("#gtestimonyList").jqGrid({     
url:'globalTestimony/gtestimony',        
datatype: 'xml',        
mtype: 'POST',              
altRows:true,        
colNames:['mediaID','source','CATEGORY','TITLE','SUBTITLE','CONTENT','URL','TAGNAME'],        
colModel :[
  {name:'mediaID', index:'mediaID',width:'120',align:'left',hidden:true},   
  {name:'source', index:'source',width:'120',align:'left',hidden:true},          
  {name:'category', index:'category',width:'120',align:'left',hidden:false},      
  {name:'title', index:'title',width:'150',align:'center',hidden:false}, 
  {name:'subtitle', index:'subtitle',width:'150',align:'left',hidden:false},  
  {name:'content', index:'content',width:'200',align:'left',hidden:false}, 
  {name:'url', index:'url',width:'150',align:'left',hidden:false},
  {name:'tagname', index:'tagname',width:'150',align:'left',hidden:false}                         
  ],        
postData:{type:'',searchValue:''},        
height: 150,        
pager: $('#gtestimony_pager'),        
rowNum:10,        
rowList:[5,10,20,30,50],        
sortname: '`title`',        
sortorder: "asc",        
viewrecords: true,        
imgpath: 'css/images',        
caption: 'List of Global Testimonies',        
shrink: true,        
ondblClickRow: function(id){           
 var ret = $("#gtestimonyList").getRowData(id);                              
$( "#cmdGTestimonyEdit" ).trigger( "click" );
},
onSelectRow: function(id){  
 var ret = $("#gtestimonyList").getRowData(id);  
 GTID = id;
}    
}); 


///////////////DIALOG BOX FORM DETAILS//////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

      function updateTipsGTestimony( t ) {    tips      .text( t )      .addClass( "ui-state-highlight" );     setTimeout(function() {       tips.removeClass( "ui-state-highlight", 1500 );    }, 500 );    }
      function checkLengthGTestimony( o, n, min, max ) {    if ( o.val().length > max || o.val().length < min ) {      o.addClass( "ui-state-error" );      updateTipsPrice( "Length of " + n + " must be between " +      min + " and " + max + "." );     return false;    } else {      return true;     }  }
      function checkRegexpGTestimony( o, regexp, n ) {    if ( !( regexp.test( o.val() ) ) ) {     o.addClass( "ui-state-error" );       updateTipsPrice( n );      return false;     } else {       return true;   }   }
      function checkNumberGTestimony(o)
        {
        if($.isNumeric(o))
          {return true;}
        else  {   
        o.addClass( "ui-state-error" );       
         updateTipsGTestimony( "The value must be decimal only." );    
         return false;  }
        }
        
      var dialog, form,
 
      txtGTestimonyCategory = $( "#txtGTestimonyCategory" ),txtGTestimonyTitle = $( "#txtGTestimonyTitle" ),
      allFields = $( [] ).add( txtGTestimonyCategory ).add( txtGTestimonyTitle ),
      tips = $( ".validateTipsGTestimony" );
 
      function formEvent_GTestimony() 
        {
          var valid = true;
          allFields.removeClass( "ui-state-error" );
     
          valid = valid && checkLengthGTestimony( txtGTestimonyCategory, "Category", 1, 255 );
      
          if (valid) 
              {
            
                if(actionGTestimony=="add")
                    {                      
                    var pids = $("#cboselProductTestimony").val();
                        $.post("ctrlProductDetails/saveRecord_gtestimony/"+$("#ProductDetailtTestimonysnusr").attr("alt"),{
                        pid:pids,
                        mediaID:mediaID,
                        category:$("#txtGTestimonyCategory").val(),
                        title:$("#txtGTestimonyTitle").val(),
                        subtitle:$("#txtGTestimonySubTitle").val(),
                        content:$("#txtGTestimonyContent").val(),
                        url:$("#txtGTestimonyURL").val(),
                        tagname:$("#txtGTestimonyTagName").val(),
                        id:0}, function(data){
                         $("#gtestimonyList").trigger("reloadGrid");
                        });                    
                    }
                else
                    {
                    var pids = $("#cboselProductTestimony").val();
                        $.post("ctrlProductDetails/saveRecord_gtestimony/"+$("#ProductDetailtTestimonysnusr").attr("alt"),{
                        pid:pids,
                        mediaID:mediaID,
                        category:$("#txtGTestimonyCategory").val(),
                        title:$("#txtGTestimonyTitle").val(),
                        subtitle:$("#txtGTestimonySubTitle").val(),
                        content:$("#txtGTestimonyContent").val(),
                        url:$("#txtGTestimonyURL").val(),
                        tagname:$("#txtGTestimonyTagName").val(),
                        id:GTID}, function(data){
                         $("#gtestimonyList").trigger("reloadGrid");
                        });                     
                    }
                dialog.dialog( "close" );
              }
          return valid;
        }
 
    dialog = $( "#gtestimony-dialog-form" ).dialog({
      autoOpen: false,
      resizable: false,
      height: 'auto',
      width: 400,
      modal: true,
      buttons: {
        "Save": formEvent_GTestimony,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {   
      allFields.removeClass( "ui-state-error" );
      }
    });
                 
    $( "#cmdGTestimonyAdd" ).button().on( "click", function() {
      actionGTestimony="add";
      if(actionGTestimony=="add")
          {     
          PID="0";
          GTID="0";
          $("input,textarea").val("");
          $("#imgCoverPhoto").attr("src","images/system/noimage.jpg");
          }
      dialog.dialog( "open" );
    });


//////////////DIALOG BOX FOR CONFIRMATION OF DELETE RECORD//////////////////////
////////////////////////////////////////////////////////////////////////////////
    $( "#gtestimony-dialog-confirm" ).dialog({
      resizable: false,
    autoOpen:false,
    height:'auto',
    width:'auto',
    modal:true,
    buttons:{
    "Yes":function(){
        if(GTID!=0)
        {
                $.post("ctrlProductDetails/deleteRecord_gtestimony/1",{id:GTID}, function(data){
                $("#gtestimonyList").trigger("reloadGrid");
                 GTID=0;
                $(this).dialog("close"); 
                });          
        }
    $(this).dialog("close");
    },
    "No":function(){
    $( this ).dialog("close");
    }
    }
    });    


////////////BUTTON CLICK////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("button").click(function(){
switch($(this).attr("id"))
    {
           
        case "cmdGTestimonySearch":
             var typed = "title";
             $("#gtestimonyList").setGridParam({postData:{type:typed,searchValue:$('#txtGTestimony').val()}});
             $("#gtestimonyList").trigger("reloadGrid");
             $("#txtGTestimony").val("");
             break;             
        case "cmdGTestimonyEdit":
        
            if(GTID!=0)
              {
              var id = $("#gtestimonyList").jqGrid("getGridParam","selrow");
              var ret = $("#gtestimonyList").getRowData(id);
              //countryID = ret.countryID;
              mediaID=ret.mediaID;
              $("#imgCoverPhoto").attr('src',ret.source);	
              $("#txtGTestimonyCategory").val(ret.category);
              $("#txtGTestimonyTitle").val(ret.title);
              $("#txtGTestimonySubTitle").val(ret.subtitle);
              $("#txtGTestimonyContent").val(ret.content);
              $("#txtGTestimonyURL").val(ret.url);
              $("#txtGTestimonyTagName").val(ret.tagname);
              actionGTestimony="edit";
             
              $( "#gtestimony-dialog-form" ).dialog("open");              
              }
             break;
        case "cmdGTestimonyDelete":
             $( "#gtestimony-dialog-confirm" ).dialog("open");
             break;
        default:
             break;
    }
});

$("#cboselProductTestimony").change(function() {
  if($("#cboselProductTestimony").val()=="0")
  {$("#gtestimony_container").fadeOut(700);}
  else
  {
  
  var value = $("#cboselProductTestimony").val();
 
  $("#gtestimonyList").setGridParam({postData:{type:'PID',searchValue:value}});
  $("#gtestimonyList").trigger("reloadGrid");
               
  $("#pdetailsTestimony_waiting").fadeIn(500);
  $("#gtestimony_container").hide();  
  }  
    window.setTimeout(function() {
    if($("#cboselProductTestimony").val()=="0") $("#gtestimony_container").fadeOut(700);
    else $("#gtestimony_container").fadeIn(700);
    $("#pdetailsTestimony_waiting").hide();
    }, 400);    
    });

/////////////BUTTON HOVER///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

$("button").hover(function(){	$(this).addClass("ui-state-hover").css("cursor","pointer"); 	
},function(){$(this).removeClass("ui-state-hover").css("cursor","");});


$("img").hover(function(){	$(this).css("cursor","pointer"); 	
},function(){$(this).css("cursor","");});
////////////////////////////////////////////////////////////////////////////////
///////////////THIS IS FOR WATERMARK TEXTBOX////////////////////////////////////
$.fn.selectRange = function (start, end) {      return this.each(function () {     var self = this;          if (self.setSelectionRange) {              self.focus();    self.setSelectionRange(start, end);        } else if (self.createTextRange) {    var range = self.createTextRange();   range.collapse(true);   range.moveEnd('character', end);   range.moveStart('character', start);   range.select();   }     });};
//sample format -> $('your id').selectRange(0, 1);

$('input,textarea,select').blur(function(){
$(this).removeClass("ui-state-highlight").css("cursor","");
if ($(this).val().length == 0){$(this).val($(this).attr('alt')).addClass('watermark');}else{$(this).css("color","black")}
}).focus(function(){
$(this).addClass("ui-state-highlight").css("cursor","");
$(this).selectRange(0, $(this).length);if ($(this).val() == $(this).attr('alt'))$(this).val('').removeClass('watermark');
})
$('#txtGTestimony').val($('#txtGTestimony').attr('alt')).addClass('watermark').css("color","gray");

 $('#txtGTestimony').keypress(function(e){
            if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                $( "#cmdGTestimonySearch" ).trigger( "click" );
            }
        });

////////////UPLOAD BUTTON///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
var GenExt="";
$(document).ready(function(){
		new AjaxUpload('#cmdGtestimonyUpload', 
    {
		action: 'ctrlProductDetails/uploadTestimony/'+$("#ProductDetailtTestimonysnusr").attr("alt"),		
		onSubmit : function(file , ext)
      {
			if (ext && /^(jpg|png|jpeg|gif)$/.test(ext))
          {
          GenExt = ext;
          $("#progressbar_testimony").show();
          this.setData({testimonies: file,ext:ext});
			    } 
      else 
          {				
			    alert('Error: only images are allowed');
				  return false;				
			    }
		  },
		  onProgress: function(progress)
      {
          var percentage = Math.floor((progress.total / progress.totalSize) * 100);
          $( "#progressbar_testimony" ).progressbar({value: percentage});
          //$( "#loadingUpload" ).empty().append(percentage+"%");
      },
		  onComplete : function(file)
      {

      $.post("ctrlProductDetails/addMedia/1",{source:'images/data/testimonies/',extension:GenExt[0],usr:$("#ProductDetailtTestimonysnusr").attr("alt")}, function(data){

      var col = data.split("~");
      mediaID = col[0];    
      
      $("#progressbar_testimony").hide();	
      source = col[1];
      $("#imgCoverPhoto").attr('src',col[1]);	
      });                   
	
		  }		
	  });
});
