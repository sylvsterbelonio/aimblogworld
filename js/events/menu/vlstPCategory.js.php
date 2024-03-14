$(function() {
var PIID;
var PCID="0";
var action="add";


///////////////DIALOG BOX FORM DETAILS//////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
 
      function updateTips( t ) {    tips      .text( t )      .addClass( "ui-state-highlight" );     setTimeout(function() {       tips.removeClass( "ui-state-highlight", 1500 );    }, 500 );    }
      function checkLength( o, n, min, max ) {    if ( o.val().length > max || o.val().length < min ) {      o.addClass( "ui-state-error" );      updateTips( "Length of " + n + " must be between " +      min + " and " + max + "." );     return false;    } else {      return true;     }  }
      function checkRegexp( o, regexp, n ) {    if ( !( regexp.test( o.val() ) ) ) {     o.addClass( "ui-state-error" );       updateTips( n );      return false;     } else {       return true;   }   }

      var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      txtPCagetoryName = $( "#txtPCagetoryName" ),
      //email = $( "#email" ),
      //password = $( "#password" ),
      allFields = $( [] ).add( txtPCagetoryName ),
      tips = $( ".validateTips" );
 
      function formEvent_pcategory() 
        {
          var valid = true;
          allFields.removeClass( "ui-state-error" );
     
          valid = valid && checkLength( txtPCagetoryName, "Category Name", 1, 255 );
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
                        $.post("ctrlPCategory/saveRecord/"+$("#PCategoryusr").attr("alt"),{
                        categoryName:$("#txtPCagetoryName").val(),
                        id:0}, function(data){
                         $("#pcategoryList").trigger("reloadGrid");
                        });                    
                    }
                else
                    {
                        $.post("ctrlPCategory/saveRecord/"+$("#PCategoryusr").attr("alt"),{
                        categoryName:$("#txtPCagetoryName").val(),
                        id:PCID}, function(data){
                         $("#pcategoryList").trigger("reloadGrid");
                        });                     
                    }
                ///////////////////////////
                dialog.dialog( "close" );
              }
          return valid;
        }
 
    dialog = $( "#pcategory-dialog-form" ).dialog({
      autoOpen: false,
      resizable: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
        "Save": formEvent_pcategory,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {   
      allFields.removeClass( "ui-state-error" );
      }
    });


                 
    $( "#cmdPCategoryAdd" ).button().on( "click", function() {
      action="add";
      if(action=="add")
          {     
          PCID="0";
          $("#txtPCagetoryName").val("");
          }
      dialog.dialog( "open" );
    });
    
    
////////////JQGRID LIST/////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

$("#pcategoryList").jqGrid({     
url:'pcategory/list',        
datatype: 'xml',        
mtype: 'POST',              
altRows:true,        
colNames:['CATEGORY NAME'],        
colModel :[                               
  {name:'categoryName', index:'telNo',width:'450',align:'left'}           
  ],        
postData:{type:'',searchValue:''},        
height: 150,        
pager: $('#pcategory_pager'),        
rowNum:10,        
rowList:[5,10,20,30,50],        
sortname: 'categoryName',        
sortorder: "asc",        
viewrecords: true,        
imgpath: 'css/images',        
caption: 'List of Product Category',        
shrink: true,        
ondblClickRow: function(id){           
 var ret = $("#pcategoryList").getRowData(id);                              
$( "#cmdPCategoryEdit" ).trigger( "click" );
},
onSelectRow: function(id){  
 var ret = $("#pcategoryList").getRowData(id);  
PCID = id;
}    
}); 

////////////////////////////////////////////////////////////////////////////////
///////////////THIS IS FOR WATERMARK TEXTBOX////////////////////////////////////
$.fn.selectRange = function (start, end) {      return this.each(function () {     var self = this;          if (self.setSelectionRange) {              self.focus();    self.setSelectionRange(start, end);        } else if (self.createTextRange) {    var range = self.createTextRange();   range.collapse(true);   range.moveEnd('character', end);   range.moveStart('character', start);   range.select();   }     });};
//sample format -> $('your id').selectRange(0, 1);

$('#txtSPCagetorysearch,#txtPCagetoryName').blur(function(){
$(this).removeClass("ui-state-highlight").css("cursor","");
if ($(this).val().length == 0){$(this).val($(this).attr('alt')).addClass('watermark');}else{$(this).css("color","black")}
}).focus(function(){
$(this).addClass("ui-state-highlight").css("cursor","");
$(this).selectRange(0, $(this).length);if ($(this).val() == $(this).attr('alt'))$(this).val('').removeClass('watermark');
})
$('#txtSPCagetorysearch').val($('#txtSPCagetorysearch').attr('alt')).addClass('watermark').css("color","gray");

/////////////BUTTON HOVER///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#cmdPCategoryAdd,#cmdPCategoryEdit,#cmdPCategorySearch").hover(function(){	$(this).addClass("ui-state-hover").css("cursor","pointer"); 	
},function(){$(this).removeClass("ui-state-hover").css("cursor","");});

////////////BUTTON CLICK////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#cmdPCategorySearch,#cmdPCategoryEdit").click(function(){
switch($(this).attr("id"))
    {
        case "cmdPCategorySearch":     
             var typed = 'categoryName';
             $("#pcategoryList").setGridParam({postData:{type:typed,searchValue:$('#txtSPCagetorysearch').val()}});
             $("#pcategoryList").trigger("reloadGrid");
             $("#txtSPCagetorysearch").val("");
             break;
        case "cmdPCategoryEdit":
            if(PCID!=0)
              {
              var id = $("#pcategoryList").jqGrid("getGridParam","selrow");
              var ret = $("#pcategoryList").getRowData(id);
              PCID=id;
              $("#txtPCagetoryName").val(ret.categoryName);
              action="edit";
              dialog.dialog("open");              
              }
             break;
        default:
             break;
    }
});

 $('#txtSPCagetorysearch').keypress(function(e){
            if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                $( "#cmdPCategorySearch" ).trigger( "click" );
            }
        });

});
