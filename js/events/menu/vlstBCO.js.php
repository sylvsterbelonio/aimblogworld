$(function() {
var PIID;
var bcoID="0";
var countryID="0";
var action="add";

///////////////DIALOG BOX FORM DETAILS//////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
 
      function updateTips( t ) {    tips      .text( t )      .addClass( "ui-state-highlight" );     setTimeout(function() {       tips.removeClass( "ui-state-highlight", 1500 );    }, 500 );    }
      function checkLength( o, n, min, max ) {    if ( o.val().length > max || o.val().length < min ) {      o.addClass( "ui-state-error" );      updateTips( "Length of " + n + " must be between " +      min + " and " + max + "." );     return false;    } else {      return true;     }  }
      function checkRegexp( o, regexp, n ) {    if ( !( regexp.test( o.val() ) ) ) {     o.addClass( "ui-state-error" );       updateTips( n );      return false;     } else {       return true;   }   }

      var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      txtbcoOwnername = $( "#txtbcoOwnername" ),
      //email = $( "#email" ),
      //password = $( "#password" ),
      allFields = $( [] ).add( txtbcoOwnername ),
      tips = $( ".validateTips" );
 
      function formEvent_bco() 
        {
          var valid = true;
          allFields.removeClass( "ui-state-error" );
     
          valid = valid && checkLength( txtbcoOwnername, "Ownername", 1, 255 );
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
                    var countryIDs = $("#cboBCOFlag").find('option:selected').attr("value");
                        $.post("ctrlBCO/saveRecord/"+$("#BCOusr").attr("alt"),{countryID:countryIDs, 
                        bco: $("#txtbcoBCO").val(),
                        ownerName:$("#txtbcoOwnername").val(),
                        address:$("#txtbcoAddress").val(),
                        contactNo:$("#txtbcoContactNo").val(),
                        telNo:$("#txtbcoTelNo").val(),
                        id:0}, function(data){
                         $("#bcoList").trigger("reloadGrid");
                        });                    
                    }
                else
                    {
                    var countryIDs = $("#cboBCOFlag").find('option:selected').attr("value");
                        $.post("ctrlBCO/saveRecord/"+$("#BCOusr").attr("alt"),{countryID:countryIDs, 
                        bco: $("#txtbcoBCO").val(),
                        ownerName:$("#txtbcoOwnername").val(),
                        address:$("#txtbcoAddress").val(),
                        contactNo:$("#txtbcoContactNo").val(),
                        telNo:$("#txtbcoTelNo").val(),
                        id:bcoID}, function(data){
                         $("#bcoList").trigger("reloadGrid");
                        });                     
                    }
                ///////////////////////////
                dialog.dialog( "close" );
              }
          return valid;
        }
 
    dialog = $( "#bco-dialog-form" ).dialog({
      autoOpen: false,
      resizable: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
        "Save": formEvent_bco,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {   
      allFields.removeClass( "ui-state-error" );
      }
    });


                 
    $( "#cmdBCOAdd" ).button().on( "click", function() {
      action="add";
      if(action=="add")
          {     
          bcoID="0";
          countryID="0";
          $("#txtbcoOwnername,#txtbcoAddress,#txtbcoContactNo,#txtbcoTelNo,#txtbcoBCO").val("");
          $("#cboBCOFlag").val("2");
          }
      dialog.dialog( "open" );
    });


//////////////DIALOG BOX FOR CONFIRMATION OF DELETE RECORD//////////////////////
////////////////////////////////////////////////////////////////////////////////
    $( "#bco-dialog-confirm" ).dialog({
      resizable: false,
    autoOpen:false,
      height: 'auto',
      width: 'auto',
    modal:true,
    buttons:{
    "Yes":function(){
        if(bcoID!=0)
        {
                $.post("ctrlBCO/deleteRecord/1",{id:bcoID}, function(data){
                 $("#bcoList").trigger("reloadGrid");
                 bcoID=0;
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

$("#bcoList").jqGrid({     
url:'bco/list',        
datatype: 'xml',        
mtype: 'POST',              
altRows:true,        
colNames:['countryID','COUNTRY','BCO','OWNERNAME','ADDRESS','CONTACT NO','TEL NO'],        
colModel :[            
  {name:'countryID', index:'countryID',width:'100',align:'center',hidden:true}, 
  {name:'flag', index:'flag',width:'70',align:'left',hidden:false},  
  {name:'bco', index:'bco',width:'200',align:'left',hidden:false}, 
  {name:'ownerName', index:'ownerName',width:'200',align:'left',hidden:false}, 
  {name:'address', index:'address',width:'300',align:'left',hidden:false},    
  {name:'contactNo', index:'contactNo',width:'100',align:'center',hidden:false},                    
  {name:'telNo', index:'telNo',width:'100',align:'center'}           
  ],        
postData:{type:'',searchValue:''},        
height: 150,        
pager: $('#bco_pager'),        
rowNum:10,        
rowList:[5,10,20,30,50],        
sortname: 'ownerName',        
sortorder: "asc",        
viewrecords: true,        
imgpath: 'css/images',        
caption: 'List of Business Center Office Around The World',        
shrink: true,        
ondblClickRow: function(id){           
 var ret = $("#bcoList").getRowData(id);                              
$( "#cmdBCOEdit" ).trigger( "click" );
},
onSelectRow: function(id){  
 var ret = $("#bcoList").getRowData(id);  
bcoID = id;
}    
}); 


////////////////////////////////////////////////////////////////////////////////
///////////////THIS IS FOR WATERMARK TEXTBOX////////////////////////////////////
$.fn.selectRange = function (start, end) {      return this.each(function () {     var self = this;          if (self.setSelectionRange) {              self.focus();    self.setSelectionRange(start, end);        } else if (self.createTextRange) {    var range = self.createTextRange();   range.collapse(true);   range.moveEnd('character', end);   range.moveStart('character', start);   range.select();   }     });};
//sample format -> $('your id').selectRange(0, 1);

$('#txtbcoBCO,#txtSBCOsearch,#cboBCOFlag,#txtbcoOwnername,#txtbcoAddress,#txtbcoContactNo,#txtbcoAddress,#txtbcoContactNo,#txtbcoTelNo').blur(function(){
$(this).removeClass("ui-state-highlight").css("cursor","");
if ($(this).val().length == 0){$(this).val($(this).attr('alt')).addClass('watermark');}else{$(this).css("color","black")}
}).focus(function(){
$(this).addClass("ui-state-highlight").css("cursor","");
$(this).selectRange(0, $(this).length);if ($(this).val() == $(this).attr('alt'))$(this).val('').removeClass('watermark');
})
$('#txtSBCOsearch').val($('#txtSBCOsearch').attr('alt')).addClass('watermark').css("color","gray");

/////////////BUTTON HOVER///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#cmdBCOAdd,#cmdCountryEdit,#cmdBCOEdit,#cmdBCODelete,#cmdBCOSearch").hover(function(){	$(this).addClass("ui-state-hover").css("cursor","pointer"); 	
},function(){$(this).removeClass("ui-state-hover").css("cursor","");});

/////////////BUTTON HOVER FOR TYPE SEARCH///////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#cboSBCOtype").hover(function(){	$(this).addClass("ui-state-highlight").css("cursor","pointer"); 	
},function(){$(this).removeClass("ui-state-highlight").css("cursor","");});

////////////CHANGE EVENT OF COMBOBOX TYPE///////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#cboSBCOtype").change(function() {
    $("#txtSBCOsearch").val("").focus();
});

////////////BUTTON CLICK////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#cmdBCOSearch,#cmdBCOEdit,#cmdBCODelete").click(function(){
switch($(this).attr("id"))
    {
        case "cmdBCOSearch":      
             var typed = $("#cboSBCOtype").find('option:selected').attr("value");
             $("#bcoList").setGridParam({postData:{type:typed,searchValue:$('#txtSBCOsearch').val()}});
             $("#bcoList").trigger("reloadGrid");
             $("#txtSBCOsearch").val("");
             break;
        case "cmdBCOEdit":
            if(bcoID!=0)
              {
              var id = $("#bcoList").jqGrid("getGridParam","selrow");
              var ret = $("#bcoList").getRowData(id);
              countryID = ret.countryID;
              $("#cboBCOFlag").val(ret.countryID);
              $("#txtbcoOwnername").val(ret.ownerName);
              $("#txtbcoAddress").val(ret.address);
              $("#txtbcoContactNo").val(ret.contactNo);
              $("#txtbcoTelNo").val(ret.telNo);
              action="edit";
              dialog.dialog("open");              
              }
             break;
        case "cmdBCODelete":
             $( "#bco-dialog-confirm" ).dialog("open");
             break;
        default:
             break;
    }
});

 $('#txtSBCOsearch').keypress(function(e){
            if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                $( "#cmdBCOSearch" ).trigger( "click" );
            }
        });












});
