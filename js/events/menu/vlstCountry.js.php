

$(function() {
var PIID;
var countryID="0";
var action="add";
var mediaID="0";
///////////////DIALOG BOX FORM DETAILS//////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
 
      function updateTips( t ) {    tips      .text( t )      .addClass( "ui-state-highlight" );     setTimeout(function() {       tips.removeClass( "ui-state-highlight", 1500 );    }, 500 );    }
      function checkLength( o, n, min, max ) {    if ( o.val().length > max || o.val().length < min ) {      o.addClass( "ui-state-error" );      updateTips( "Length of " + n + " must be between " +      min + " and " + max + "." );     return false;    } else {      return true;     }  }
      function checkRegexp( o, regexp, n ) {    if ( !( regexp.test( o.val() ) ) ) {     o.addClass( "ui-state-error" );       updateTips( n );      return false;     } else {       return true;   }   }

      var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      DcountryName = $( "#txtDcountryName" ),
      //email = $( "#email" ),
      //password = $( "#password" ),
      allFields = $( [] ).add( DcountryName ),
      tips = $( ".validateTips" );
 
      function formEvent() 
        {
          var valid = true;
          allFields.removeClass( "ui-state-error" );
     
          valid = valid && checkLength( DcountryName, "Country Name", 1, 255 );
          //valid = valid && checkLength( email, "email", 6, 80 );
          //valid = valid && checkLength( password, "password", 5, 16 );
     
          //valid = valid && checkRegexp( name, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
          //valid = valid && checkRegexp( email, emailRegex, "eg. emailname@address.com" );
          //valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
     
          if (valid) 
              {
                ///////////////////////////
                if(action=="add")
                    {   
                        $.post("ctrlCountry/saveRecord/"+$("#Cusr").attr("alt"),{imgSrc:mediaID, countryName:$("#txtDcountryName").val(),id:0}, function(data){
                         countryID="0";
                         $("#txtctrFlag").val("");
                         $("#txtDcountryName").val("");
                         mediaID="0";
                         $("#countryList").trigger("reloadGrid");
                        });                    
                    }
                else
                    {
                        $.post("ctrlCountry/saveRecord/"+$("#Cusr").attr("alt"),{imgSrc:mediaID, countryName:$("#txtDcountryName").val(),id:countryID}, function(data){
                         countryID="0";
                         $("#txtctrFlag").val("");
                         $("#txtDcountryName").val("");
                         $("#countryList").trigger("reloadGrid");
                        });                     
                    }
                ///////////////////////////
                dialog.dialog( "close" );
              }
          return valid;
        }
 
    dialog = $( "#country-dialog-form" ).dialog({
      autoOpen: false,
      resizable: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
        "Save": formEvent,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {   
      allFields.removeClass( "ui-state-error" );
      }
    });
 
    $( "#cmdCountryAdd" ).button().on( "click", function() {
      action="add";
    if(action=="add")
      {     
      countryID="0";
      $("#imgFlag").attr('src','images/system/noflag.png');
      $("#txtDcountryName,#txtctrFlag").val("");
      $("#progressbar").progressbar({value: 2});
      //$("#txtctrFlag").attr("disabled","disabled").addClass("ui-state-disabled"); 
      }
      dialog.dialog( "open" );
    });


//////////////DIALOG BOX FOR CONFIRMATION OF DELETE RECORD//////////////////////
////////////////////////////////////////////////////////////////////////////////
    $( "#country-dialog-confirm" ).dialog({
      resizable: false,
    autoOpen:false,
      height: 'auto',
      width: 'auto',
    modal:true,
    buttons:{
    "Yes":function(){
        if(countryID!=0)
        {
                $.post("ctrlCountry/deleteRecord/1",{id:countryID}, function(data){
                 $("#countryList").trigger("reloadGrid");
                 countryID=0;
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


////////////JQGRID LIST/////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

$("#countryList").jqGrid({     
url:'country/list',        
datatype: 'xml',        
mtype: 'POST',              
altRows:true,        
colNames:['mediaID','sources','FLAG','COUNTRY NAME'],        
colModel :[            
  {name:'mediaID', index:'mediaID',width:'100',align:'center',hidden:true}, 
  {name:'sources', index:'sources',width:'100',align:'left',hidden:true},  
  {name:'imgSrc', index:'imgSrc',width:'50',align:'center',hidden:false},                       
  {name:'Country', index:'Country',width:'470',align:'left'}           
  ],        
postData:{type:'',searchValue:''},        
height: 150,        
pager: $('#pager'),        
rowNum:10,        
rowList:[5,10,20,30,50],        
sortname: 'countryName',        
sortorder: "asc",        
viewrecords: true,        
imgpath: 'css/images',        
caption: 'List of Countries',        
shrink: true,        
ondblClickRow: function(id){           
 var ret = $("#countryList").getRowData(id);                              
$( "#cmdCountryEdit" ).trigger( "click" );
},
onSelectRow: function(id){  
 var ret = $("#countryList").getRowData(id);  
countryID = id;
}    
}); 


////////////////////////////////////////////////////////////////////////////////
///////////////THIS IS FOR WATERMARK TEXTBOX////////////////////////////////////
$.fn.selectRange = function (start, end) {      return this.each(function () {     var self = this;          if (self.setSelectionRange) {              self.focus();    self.setSelectionRange(start, end);        } else if (self.createTextRange) {    var range = self.createTextRange();   range.collapse(true);   range.moveEnd('character', end);   range.moveStart('character', start);   range.select();   }     });};
//sample format -> $('your id').selectRange(0, 1);

$('#txtScountryName,#txtDcountryName').blur(function(){
$(this).removeClass("ui-state-highlight").css("cursor","");
if ($(this).val().length == 0){$(this).val($(this).attr('alt')).addClass('watermark');}else{$(this).css("color","black")}
}).focus(function(){
$(this).addClass("ui-state-highlight").css("cursor","");
$(this).selectRange(0, $(this).length);if ($(this).val() == $(this).attr('alt'))$(this).val('').removeClass('watermark');
})
$('#txtScountryName').val($('#txtScountryName').attr('alt')).addClass('watermark').css("color","gray");


/////////////BUTTON HOVER///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#cmdCountryAdd,#cmdCountryEdit,#cmdCountryView,#cmdCountryDelete,#cmdCountrySearch").hover(function(){	$(this).addClass("ui-state-hover").css("cursor","pointer"); 	
},function(){$(this).removeClass("ui-state-hover").css("cursor","");});


////////////BUTTON CLICK////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#cmdCountrySearch,#cmdCountryEdit,#cmdCountryView,#cmdCountryDelete").click(function(){
switch($(this).attr("id"))
    {
        case "cmdCountrySearch":      
             $("#countryList").setGridParam({postData:{type:"countryName",searchValue:$('#txtScountryName').val()}});
             $("#countryList").trigger("reloadGrid");
             $("#txtScountryName").val("");
             break;
        case "cmdCountryEdit":
            if(countryID!=0)
              {
              var id = $("#countryList").jqGrid("getGridParam","selrow");
              var ret = $("#countryList").getRowData(id);
              var img = ret.sources;
              var country = ret.Country;
              mediaID = ret.mediaID;
              $("#imgFlag").attr('src',img);
              $("#txtctrFlag").val(ret.imgSrc);
              $("#txtDcountryName").val(ret.Country);
              action="edit";
              dialog.dialog("open");              
              }
             break;
        case "cmdCountryDelete":
             $( "#country-dialog-confirm" ).dialog("open");
             break;
        default:
             break;
    }
});

 $('#txtScountryName').keypress(function(e){
            if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                $( "#cmdCountrySearch" ).trigger( "click" );
            }
        });

////////////UPLOAD BUTTON///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
var GenExt="";
$(document).ready(function(){
		new AjaxUpload('#cmdCtyUpload', 
    {
		action: 'ctrlCountry/uploadFlag/'+$("#Cusr").attr("alt"),	
		onSubmit : function(file , ext)
      {
			if (ext && /^(jpg|png|jpeg|gif)$/.test(ext))
          {
          alert($("#Cusr").attr("alt"));
          GenExt = ext;
          $("#loadingUpload,#progressbar").show();
          this.setData({countryFlag: file,ext:ext[0]});
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
          $( "#progressbar" ).progressbar({value: percentage});
          $( "#loadingUpload" ).empty().append(percentage+"%");
      },
		  onComplete : function(file)
      {
      

      $.post("ctrlCountry/addMedia/1",{source:'images/data/countries/' ,extension:GenExt[0],usr:$("#Cusr").attr("alt")}, function(data){

      var col = data.split("~");
      mediaID = col[0];       

      $('#txtctrFlag').text('Uploaded ' + file);	
      $("#loadingUpload,#progressbar").hide();	
      $('#txtctrFlag').val(col[1]);
      $("#imgFlag").attr('src',col[1]);	
      
      });                   
	
		  }		
	  });
});
	  






});





