$(function() {
var PIID;
var operationID="0";
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
      txtOperationName = $( "#txtOperationName" ),
      //email = $( "#email" ),
      //password = $( "#password" ),
      allFields = $( [] ).add( txtOperationName ),
      tips = $( ".validateTips" );
 
      function formEvent_operation() 
        {
          var valid = true;
          allFields.removeClass( "ui-state-error" );
     
          valid = valid && checkLength( txtOperationName, "Name", 1, 255 );
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
                    var countryIDs = $("#cboOperationFlag").find('option:selected').attr("value");
                        $.post("ctrlOperation/saveRecord/"+$("#Operationusr").attr("alt"),{countryID:countryIDs, 
                        name:$("#txtOperationName").val(),
                        position:$("#txtOperationPosition").val(),
                        address:$("#txtOperationAddress").val(),
                        contactNo:$("#txtOperationContactNo").val(),
                        telNo:$("#txtOperationTelNo").val(),
                        id:0}, function(data){
                         $("#operationList").trigger("reloadGrid");
                        });                    
                    }
                else
                    {
                    var countryIDs = $("#cboOperationFlag").find('option:selected').attr("value");
                        $.post("ctrlOperation/saveRecord/"+$("#Operationusr").attr("alt"),{countryID:countryIDs, 
                        name:$("#txtOperationName").val(),
                        position:$("#txtOperationPosition").val(),
                        address:$("#txtOperationAddress").val(),
                        contactNo:$("#txtOperationContactNo").val(),
                        telNo:$("#txtOperationTelNo").val(),
                        id:operationID}, function(data){
                         $("#operationList").trigger("reloadGrid");
                        });                     
                    }
                ///////////////////////////
                dialog.dialog( "close" );
              }
          return valid;
        }
 
    dialog = $( "#operation-dialog-form" ).dialog({
      autoOpen: false,
      resizable: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
        "Save": formEvent_operation,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {   
      allFields.removeClass( "ui-state-error" );
      }
    });


                 
    $( "#cmdOperationAdd" ).button().on( "click", function() {
      action="add";
      if(action=="add")
          {     
          operationID="0";
          countryID="0";
          $("#txtOperationName,#txtOperationAddress,#txtOperationPosition,#txtOperationContactNo,#txtOperationTelNo").val("");
          $("#cboOperationFlag").val("2");
          }
      dialog.dialog( "open" );
    });


//////////////DIALOG BOX FOR CONFIRMATION OF DELETE RECORD//////////////////////
////////////////////////////////////////////////////////////////////////////////
    $( "#operation-dialog-confirm" ).dialog({
      resizable: false,
    autoOpen:false,
      height: 'auto',
      width: 'auto',
    modal:true,
    buttons:{
    "Yes":function(){
        if(operationID!=0)
        {
                $.post("ctrlOperation/deleteRecord/1",{id:operationID}, function(data){
                 $("#operationList").trigger("reloadGrid");
                 operationID=0;
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

$("#operationList").jqGrid({     
url:'operation/list',        
datatype: 'xml',        
mtype: 'POST',              
altRows:true,        
colNames:['countryID','COUNTRY','NAME','POSITION','ADDRESS','CONTACT NO','TEL NO'],        
colModel :[            
  {name:'countryID', index:'countryID',width:'100',align:'center',hidden:true}, 
  {name:'flag', index:'flag',width:'70',align:'left',hidden:false},  
  {name:'ownerName', index:'ownerName',width:'200',align:'left',hidden:false}, 
  {name:'position', index:'position',width:'200',align:'left',hidden:false}, 
  {name:'address', index:'address',width:'300',align:'left',hidden:false},    
  {name:'contactNo', index:'contactNo',width:'100',align:'center',hidden:false},                    
  {name:'telNo', index:'telNo',width:'100',align:'center'}           
  ],        
postData:{type:'',searchValue:''},        
height: 150,        
pager: $('#operation_pager'),        
rowNum:10,        
rowList:[5,10,20,30,50],        
sortname: '`name`',        
sortorder: "asc",        
viewrecords: true,        
imgpath: 'css/images',        
caption: 'List of Operational Person',        
shrink: true,        
ondblClickRow: function(id){           
 var ret = $("#operationList").getRowData(id);                              
$( "#cmdOperationEdit" ).trigger( "click" );
},
onSelectRow: function(id){  
 var ret = $("#operationList").getRowData(id);  
operationID = id;
}    
}); 

////////////////////////////////////////////////////////////////////////////////
///////////////THIS IS FOR WATERMARK TEXTBOX////////////////////////////////////
$.fn.selectRange = function (start, end) {      return this.each(function () {     var self = this;          if (self.setSelectionRange) {              self.focus();    self.setSelectionRange(start, end);        } else if (self.createTextRange) {    var range = self.createTextRange();   range.collapse(true);   range.moveEnd('character', end);   range.moveStart('character', start);   range.select();   }     });};
//sample format -> $('your id').selectRange(0, 1);

$('#cboOperationFlag,#cboSOperationtype,#txtSOperationsearch,#cboOperationFlag,#txtOperationName,#txtOperationAddress,#txtOperationPosition,#txtOperationContactNo,#txtOperationAddress,#txtOperationContactNo,#txtOperationTelNo').blur(function(){
$(this).removeClass("ui-state-highlight").css("cursor","");
if ($(this).val().length == 0){$(this).val($(this).attr('alt')).addClass('watermark');}else{$(this).css("color","black")}
}).focus(function(){
$(this).addClass("ui-state-highlight").css("cursor","");
$(this).selectRange(0, $(this).length);if ($(this).val() == $(this).attr('alt'))$(this).val('').removeClass('watermark');
})
$('#txtSOperationsearch').val($('#txtSOperationsearch').attr('alt')).addClass('watermark').css("color","gray");

/////////////BUTTON HOVER///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#cmdOperationAdd,#cmdOperationEdit,#cmdOperationDelete,#cmdOperationSearch").hover(function(){	$(this).addClass("ui-state-hover").css("cursor","pointer"); 	
},function(){$(this).removeClass("ui-state-hover").css("cursor","");});

/////////////BUTTON HOVER FOR TYPE SEARCH///////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#cboSOperationtype").hover(function(){	$(this).addClass("ui-state-highlight").css("cursor","pointer"); 	
},function(){$(this).removeClass("ui-state-highlight").css("cursor","");});

////////////CHANGE EVENT OF COMBOBOX TYPE///////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#cboSOperationtype").change(function() {
    $("#txtSOperationsearch").val("").focus();
});

////////////BUTTON CLICK////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#cmdOperationSearch,#cmdOperationEdit,#cmdOperationDelete").click(function(){
switch($(this).attr("id"))
    {
        case "cmdOperationSearch":      
             var typed = $("#cboSOperationtype").find('option:selected').attr("value");
             $("#operationList").setGridParam({postData:{type:typed,searchValue:$('#txtSOperationsearch').val()}});
             $("#operationList").trigger("reloadGrid");
             $("#txtSOperationsearch").val("");
             break;
        case "cmdOperationEdit":
            if(operationID!=0)
              {
              var id = $("#operationList").jqGrid("getGridParam","selrow");
              var ret = $("#operationList").getRowData(id);
              countryID = ret.countryID;
              $("#cboOperationFlag").val(ret.countryID);
              $("#txtOperationName").val(ret.ownerName);
              $("#txtOperationPosition").val(ret.position);
              $("#txtOperationAddress").val(ret.address);
              $("#txtOperationContactNo").val(ret.contactNo);
              $("#txtOperationTelNo").val(ret.telNo);
              action="edit";
              dialog.dialog("open");              
              }
             break;
        case "cmdOperationDelete":
             $( "#operation-dialog-confirm" ).dialog("open");
             break;
        default:
             break;
    }
});

 $('#txtSOperationsearch').keypress(function(e){
            if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                $( "#cmdOperationSearch" ).trigger( "click" );
            }
        });

});
