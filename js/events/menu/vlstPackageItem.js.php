var itemID="0";

$("#itemList").jqGrid({     
url:'itempackage/list',        
datatype: 'xml',        
mtype: 'POST',              
altRows:true,        
colNames:['productD','PRODUCT NAME','QUANTITY'],        
colModel :[            
  {name:'PIC', index:'countryID',width:'250',align:'center',hidden:false}, 
  {name:'productName', index:'productName',width:'70',align:'left',hidden:false},                     
  {name:'quantity', index:'quantity',width:'250',align:'right'}           
  ],        
postData:{type:'',searchValue:''},        
height: 150,        
pager: $('#item_pager'),        
rowNum:10,        
rowList:[5,10,20,30,50],        
sortname: '`productName`',        
sortorder: "asc",        
viewrecords: true,        
imgpath: 'css/images',        
caption: 'List of Packages',        
shrink: true,        
ondblClickRow: function(id){           
 var ret = $("#itemList").getRowData(id);                              
$( "#itemList" ).trigger( "click" );
},
onSelectRow: function(id){  
 var ret = $("#itemList").getRowData(id);  
itemID = id;
}    
}); 


 $('#txtItemQuantity').keypress(function(e){
            if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                $( "#cmdItemAdd" ).trigger( "click" );
            }
        });
////////////BUTTON CLICK////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("button").click(function(){
switch($(this).attr("id"))
    {
        case "cmdItemAdd":
              var PIDs = $("#cboselPackageProduct").val();
              var packageID = $("#cboselPackageItem").val();
              var quantity = $("#txtItemQuantity").val();
              $.post("ctrlPackage/add_item/"+$("#Packageusr").attr("alt"),{packageID:$("#cboselPackageItem").val(),PID:PIDs,quantity:quantity}, function(data){
                 $("#itemList").setGridParam({postData:{type:'tblpackage.packageID',searchValue:packageID}});
                 $("#itemList").trigger("reloadGrid");
                 $("#cboselPackageProduct").val(0).focus();
                 $("#txtItemQuantity").val("");
                });           
             break;
        case "cmdItemDelete":
              $.post("ctrlPackage/remove_item/1",{id:itemID}, function(data){
                $("#itemList").trigger("reloadGrid");
                }); 
            break;
        default:
             break;
    }
});

////////////////////////////////////////////////////////////////////////////////
///////////////THIS IS FOR WATERMARK TEXTBOX////////////////////////////////////
$.fn.selectRange = function (start, end) {      return this.each(function () {     var self = this;          if (self.setSelectionRange) {              self.focus();    self.setSelectionRange(start, end);        } else if (self.createTextRange) {    var range = self.createTextRange();   range.collapse(true);   range.moveEnd('character', end);   range.moveStart('character', start);   range.select();   }     });};
//sample format -> $('your id').selectRange(0, 1);

$('input,select').blur(function(){
$(this).removeClass("ui-state-highlight").css("cursor","");
if ($(this).val().length == 0){$(this).val($(this).attr('alt')).addClass('watermark');}else{$(this).css("color","black")}
}).focus(function(){
$(this).addClass("ui-state-highlight").css("cursor","");
$(this).selectRange(0, $(this).length);if ($(this).val() == $(this).attr('alt'))$(this).val('').removeClass('watermark');
})
$('#txtItemQuantity').val($('#txtItemQuantity').attr('alt')).addClass('watermark').css("color","gray");

/////////////BUTTON HOVER///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("button").hover(function(){	$(this).addClass("ui-state-hover").css("cursor","pointer"); 	
},function(){$(this).removeClass("ui-state-hover").css("cursor","");});

////////////CHANGE EVENT OF COMBOBOX TYPE///////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#cboselPackageItem").change(function() {

$("#containerList").fadeIn(400);
                 $("#itemList").setGridParam({postData:{type:'tblpackage.packageID',searchValue:$("#cboselPackageItem").val()}});
                 $("#itemList").trigger("reloadGrid");
});

$("#cboselPackageProduct").change(function() {
$("#txtItemQuantity").val("").focus();
});

