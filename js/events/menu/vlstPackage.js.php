var packageID="0";
var countryId = "0";
var mediaID = "0";
var source="";
var action="add";
var itemID="0";

////////////JQGRID LIST/////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

$("#packageList").jqGrid({     
url:'package/list',        
datatype: 'xml',        
mtype: 'POST',              
altRows:true,        
colNames:['countryID','COUNTRY','mediaID','source','PACKAGE NAME','PRICE','PRICE SYMBOL','PRICE DESCRIPTION','WEIGHT'],        
colModel :[            
  {name:'countryID', index:'countryID',width:'100',align:'center',hidden:true}, 
  {name:'flag', index:'flag',width:'70',align:'left',hidden:false},  
  {name:'mediaID', index:'mediaID',width:'70',align:'left',hidden:false},  
  {name:'source', index:'source',width:'70',align:'left',hidden:false},  
  {name:'packageName', index:'packageName',width:'200',align:'left',hidden:false}, 
  {name:'price', index:'price',width:'200',align:'right',hidden:false}, 
  {name:'priceSymbol', index:'priceSymbol',width:'300',align:'left',hidden:false},    
  {name:'priceDescription', index:'priceDescription',width:'100',align:'center',hidden:false},                    
  {name:'weight', index:'weight',width:'100',align:'right'}           
  ],        
postData:{type:'',searchValue:''},        
height: 150,        
pager: $('#package_pager'),        
rowNum:10,        
rowList:[5,10,20,30,50],        
sortname: '`packageName`',        
sortorder: "asc",        
viewrecords: true,        
imgpath: 'css/images',        
caption: 'List of Packages',        
shrink: true,        
ondblClickRow: function(id){           
 var ret = $("#packageList").getRowData(id);                              
$( "#cmdPackageEdit" ).trigger( "click" );
},
onSelectRow: function(id){  
 var ret = $("#packageList").getRowData(id);  
packageID = id;
}    
}); 


///////////////DIALOG BOX FORM DETAILS//////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
 
      function updateTips_package( t ) {    tips      .text( t )      .addClass( "ui-state-highlight" );     setTimeout(function() {       tips.removeClass( "ui-state-highlight", 1500 );    }, 500 );    }
      function checkLength_package( o, n, min, max ) {    if ( o.val().length > max || o.val().length < min ) {      o.addClass( "ui-state-error" );      updateTips( "Length of " + n + " must be between " +      min + " and " + max + "." );     return false;    } else {      return true;     }  }
      function checkRegexp_package( o, regexp, n ) {    if ( !( regexp.test( o.val() ) ) ) {     o.addClass( "ui-state-error" );       updateTips( n );      return false;     } else {       return true;   }   }

      var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      txtPackageName = $( "#txtPackageName" ),
      //email = $( "#email" ),
      //password = $( "#password" ),
      allFields = $( [] ).add( txtPackageName ),
      tips = $( ".validateTips" );
 
      function formEvent_package() 
        {
          var valid = true;
          allFields.removeClass( "ui-state-error" );
     
          valid = valid && checkLength_package( txtPackageName, "Package Name", 1, 255 );
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
                  
                    var countryIDs = $("#cboPackageFlag").val();
                      alert(countryIDs);
                        $.post("ctrlPackage/saveRecord/"+$("#Packageusr").attr("alt"),{countryID:countryIDs, 
                        mediaID:mediaID,
                        packageName:$("#txtPackageName").val(),
                        price:$("#txtPackagePrice").val(),
                        priceSymbol:$("#txtPackageSymbol").val(),
                        priceDescription:$("#txtPackageDescription").val(),
                        weight:$("#txtPackageWeight").val(),
                        id:0}, function(data){
                         $("#packageList").trigger("reloadGrid");
                        });                    
                    }
                else
                    {
                    var countryIDs = $("#cboPackageFlag").find('option:selected').attr("value");
                        $.post("ctrlPackage/saveRecord/"+$("#Packageusr").attr("alt"),{countryID:countryIDs, 
                        mediaID:mediaID,
                        packageName:$("#txtPackageName").val(),
                        price:$("#txtPackagePrice").val(),
                        priceSymbol:$("#txtPackageSymbol").val(),
                        priceDescription:$("#txtPackageDescription").val(),
                        weight:$("#txtPackageWeight").val(),
                        id:packageID}, function(data){
                         $("#packageList").trigger("reloadGrid");
                        });                     
                    }
                ///////////////////////////
                dialog.dialog( "close" );
              }
          return valid;
        }
 
    dialog = $( "#package-dialog-form" ).dialog({
      autoOpen: false,
      resizable: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
        "Save": formEvent_package,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {   
      allFields.removeClass( "ui-state-error" );
      }
    });


                 
    $( "#cmdPackageAdd" ).button().on( "click", function() {
      action="add";
   
      if(action=="add")
          {     
          $("#containerList,#progressbar_product").hide();
          packageID="0";
          countryID="0";
          $("input").val("");
          $("#imgPackage").attr("src","images/system/noimage.jpg");
          $("#cboPackageFlag").val("0");
        
          }
     
      dialog.dialog( "open" );
    });


//////////////DIALOG BOX FOR CONFIRMATION OF DELETE RECORD//////////////////////
////////////////////////////////////////////////////////////////////////////////
    $( "#package-dialog-confirm" ).dialog({
      resizable: false,
    autoOpen:false,
      height: 'auto',
      width: 'auto',
    modal:true,
    buttons:{
    "Yes":function(){
    alert(packageID);
        if(packageID!=0)
        {
                $.post("ctrlPackage/deleteRecord/1",{id:packageID}, function(data){
                 $("#packageList").trigger("reloadGrid");
                 packageID=0;
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
        case "cmdPackageSearch":      
             var typed = $("#cboSPackagetype").find('option:selected').attr("value");
             $("#packageList").setGridParam({postData:{type:typed,searchValue:$('#txtSPackagesearch').val()}});
             $("#packageList").trigger("reloadGrid");
             $("#txtSPackagesearch").val("");
             break;
        case "cmdItemAdd":
        alert("Asd");
              var PIDs = $("#cboselPackageProduct").val();
              var quantity = $("#txtItemQuantity").val();
              
              $.post("ctrlPackage/add_item/"+$("#Packageusr").attr("alt"),{packageID:packageID,PID:PIDs,quantity:quantity}, function(data){
                 $("#itemList").setGridParam({postData:{type:'packageID',searchValue:packageID}});
                 $("#itemList").trigger("reloadGrid");
                });           
             break;
        case "cmdPackageEdit":
        
        
        
            if(packageID!=0)
              {
              
              var id = $("#packageList").jqGrid("getGridParam","selrow");
              var ret = $("#packageList").getRowData(id);
              countryID = ret.countryID;

              $("#cboPackageFlag").val(ret.countryID);
              mediaID = ret.mediaID;
             
              if(ret.source!="")  $("#imgPackage").attr("src",ret.source);
              else  $("#imgPackage").attr("src","images/system/noimage.jpg");
              
              $("#containerList").show();
               
              $("#txtPackageName").val(ret.packageName);
              $("#txtPackagePrice").val(ret.price);
              $("#txtPackageSymbol").val(ret.priceSymbol);
              $("#txtPackageDescription").val(ret.priceDescription);
              $("#txtPackageWeight").val(ret.weight);
              action="edit";
              
              
             $("#itemList").setGridParam({postData:{type:'packageID',searchValue:packageID}});
             $("#itemList").trigger("reloadGrid");
              dialog.dialog("open");              
              }
             break;
        case "cmdPackageDelete":
             $( "#package-dialog-confirm" ).dialog("open");
             break;
        case "cmdPackageRemove":
              $.post("ctrlMedia/deleteMedia/1",{mediaID:mediaID,source:source}, function(data){
                $("#imgPackage").attr("src","images/system/noimage.jpg"); 
                });   
            break;
        case "cmdItemDelete":
              $.post("ctrlPackage/remove_item/1",{itemID:itemID}, function(data){
                $("#itemList").trigger("reloadGrid");
                }); 
            break;
        default:
             break;
    }
});

 $('#txtSPackagesearch').keypress(function(e){
            if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                $( "#cmdPackageSearch" ).trigger( "click" );
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
$('#txtSPackagesearch').val($('#txtSPackagesearch').attr('alt')).addClass('watermark').css("color","gray");

/////////////BUTTON HOVER///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("button").hover(function(){	$(this).addClass("ui-state-hover").css("cursor","pointer"); 	
},function(){$(this).removeClass("ui-state-hover").css("cursor","");});





////////////UPLOAD BUTTON///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
var GenExt="";
$(document).ready(function(){
		new AjaxUpload('#cmdPackageUpload', 
    {
		action: 'ctrlPackage/uploadPackage/'+$("#Packageusr").attr("alt"),		
		onSubmit : function(file , ext)
      {
			if (ext && /^(jpg|png|jpeg|gif)$/.test(ext))
          {
          GenExt = ext;
          $("#progressbar_package").show();
          this.setData({packages: file,ext:ext});
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
          $( "#progressbar_package" ).progressbar({value: percentage});
          //$( "#loadingUpload" ).empty().append(percentage+"%");
      },
		  onComplete : function(file)
      {
      $.post("ctrlPackage/addMedia/1",{source:'images/data/packages/',extension:GenExt[0],usr:$("#Packageusr").attr("alt")}, function(data){

      var col = data.split("~");
      mediaID = col[0];    
      
      $("#progressbar_package").hide();	
      source = col[1];
      $("#imgPackage").attr('src',col[1]);	
      });                   
	
		  }		
	  });
});
