$(function(){
var PIID;
var PID="0";
var mediaID="0";
var source="images/system/noproduct.png";
var action="add";

///////////////VALIDATION///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
var validation = {
    isEmailAddress:function(str) {
        var pattern =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return pattern.test(str);  // returns a boolean
    },
    isNotEmpty:function (str) {
        var pattern =/\S+/;
        return pattern.test(str);  // returns a boolean
    },
    isNumber:function(str) {
        var pattern = /^\d+$/;
        return pattern.test(str);  // returns a boolean
    },
    isSame:function(str1,str2){
        return str1 === str2;
    }
};   



///////////////DIALOG BOX FORM DETAILS//////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
 
      function updateTips( t ) {    tips      .text( t )      .addClass( "ui-state-highlight" );     setTimeout(function() {       tips.removeClass( "ui-state-highlight", 1500 );    }, 500 );    }
      function checkLength( o, n, min, max ) {    if ( o.val().length > max || o.val().length < min ) {
            o.addClass( "ui-state-error" );      
            updateTips( "Length of " + n + " must be between " +      min + " and " + max + "." );     
            return false;    
            } else 
            {      return true;     
            }  
            }
      function checkNumber(o)
        {
        if($.isNumeric(o))
          {return true;}
        else  {   o.addClass( "ui-state-error" );        updateTips( "The value must be decimal only." );    return false;  }
        }
      function checkRegexp( o, regexp, n ) {    if ( !( regexp.test( o.val() ) ) ) {     o.addClass( "ui-state-error" );       updateTips( n );      return false;     } else {       return true;   }   }

      var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      txtProductName = $( "#txtProductName" ),
      txtProductBinaryPoints = $('#txtProductBinaryPoints'),
      txtProductCommissionalPoints = $('#txtProductCommissionalPoints'),
      txtProductPositionalPoints = $('#txtProductPositionalPoints'),
      //email = $( "#email" ),
      //password = $( "#password" ),
      allFields = $( [] ).add( txtProductName ).add(txtProductBinaryPoints).add(txtProductCommissionalPoints).add(txtProductPositionalPoints),
      tips = $( ".validateTips_product" );
 
      function formEvent_product() 
        {
          var valid = true;
          allFields.removeClass( "ui-state-error" );
     
          valid = valid && checkLength( txtProductName, "Product Name", 1, 255 );
          valid = valid && checkRegexp( txtProductBinaryPoints, /^\d+$/, "Binary Points field only allow : 0-9" );
          //valid = valid && checkNumber(txtProductCommissionalPoints);
          //valid = valid && checkNumber(txtProductPositionalPoints);
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
                    var PCIDs = $("#cboProductsCategoryName").find('option:selected').attr("value");

                        $.post("ctrlProduct/saveRecord/"+$("#Productusr").attr("alt"),{PCID:PCIDs, 
                        mediaID:mediaID,
                        productName:$("#txtProductName").val(),
                        description:$("#txtProductDescription").val(),
                        units:$("#txtProductUnits").val(),
                        binaryPoints:$("#txtProductBinaryPoints").val(),
                        commissionalPoints:$("#txtProductCommissionalPoints").val(),
                        positionalPoints:$("#txtProductPositionalPoints").val(),
                        weight:$("#txtProductWeight").val(),
                        id:0}, function(data){
                         $("#productList").trigger("reloadGrid");
                        });                    
                    }
                else
                    {
                    var PCIDs = $("#cboProductsCategoryName").find('option:selected').attr("value");
                        $.post("ctrlProduct/saveRecord/"+$("#Productusr").attr("alt"),{PCID:PCIDs, 
                        mediaID:mediaID,
                        productName:$("#txtProductName").val(),
                        description:$("#txtProductDescription").val(),
                        units:$("#txtProductUnits").val(),
                        binaryPoints:$("#txtProductBinaryPoints").val(),
                        commissionalPoints:$("#txtProductCommissionalPoints").val(),
                        positionalPoints:$("#txtProductPositionalPoints").val(),
                        weight:$("#txtProductWeight").val(),
                        id:PID}, function(data){
                         $("#productList").trigger("reloadGrid");
                        });                     
                    }
                ///////////////////////////
                dialog.dialog( "close" );
              }
          return valid;
        }
 
    dialog = $( "#product-dialog-form" ).dialog({
      autoOpen: false,
      resizable: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
        "Save": formEvent_product,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {   
      allFields.removeClass( "ui-state-error" );
      }
    });
          
    $( "#cmdProductAdd" ).button().on( "click", function() {
      action="add";
      if(action=="add")
          {     
          PCID="0";
          mediaID="0";
          PID="0";
          $("input,select,textarea").val("");
          $("#imgProduct").attr("src","images/system/noproduct.png");
          $("select").val("0");
          }
      dialog.dialog( "open" );
    });


//////////////DIALOG BOX FOR CONFIRMATION OF DELETE RECORD//////////////////////
////////////////////////////////////////////////////////////////////////////////
    $( "#product-dialog-confirm" ).dialog({
      resizable: false,
    autoOpen:false,
      height: 'auto',
      width: 'auto',
    modal:true,
    buttons:{
    "Yes":function(){
        if(PID!=0)
        {
                $.post("ctrlProduct/deleteRecord/1",{id:PID}, function(data){
                 $("#productList").trigger("reloadGrid");
                 PID=0;
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

$("#productList").jqGrid({     
url:'product/list',        
datatype: 'xml',        
mtype: 'POST',              
altRows:true,        
colNames:['PCID','','mediaID','CATEGORY NAME','PRODUCT NAME','DESCRIPTION','UNITS','BINARY POINTS','COMMISSIONAL POINTS','POSITIONAL POINTS','WEIGHT','mysource'],        
colModel :[            
  {name:'PCID', index:'PCID',width:'100',align:'center',hidden:true}, 
  {name:'source', index:'source',width:'40',align:'center',hidden:false},  
  {name:'mediaID', index:'mediaID',width:'200',align:'left',hidden:true}, 
  {name:'categoryName', index:'categoryName',width:'150',align:'left',hidden:false}, 
  {name:'productName', index:'productName',width:'150',align:'left',hidden:false}, 
  {name:'description', index:'description',width:'150',align:'left',hidden:true},     
  {name:'units', index:'units',width:'50',align:'center',hidden:false},   
  {name:'binaryPoints', index:'binaryPoints',width:'100',align:'center',hidden:false}, 
  {name:'commissionalPoints', index:'commissionalPoints',width:'150',align:'center',hidden:false},  
  {name:'positionalPoints', index:'positionalPoints',width:'130',align:'center',hidden:false},                             
  {name:'weight', index:'weight',width:'80',align:'center'},
  {name:'mysource', index:'mysource',width:'80',align:'center',hidden:true}         
  ],        
postData:{type:'',searchValue:''},        
height: 150,        
pager: $('#product_pager'),        
rowNum:10,        
rowList:[5,10,20,30,50],        
sortname: 'productName',        
sortorder: "asc",        
viewrecords: true,        
imgpath: 'css/images',        
caption: 'List of Products',        
shrink: true,        
ondblClickRow: function(id){           
 var ret = $("#productList").getRowData(id);                              
$( "#cmdProductEdit" ).trigger( "click" );
},
onSelectRow: function(id){  
 var ret = $("#productList").getRowData(id);  
PID = id;
}    
}); 

////////////////////////////////////////////////////////////////////////////////
///////////////THIS IS FOR WATERMARK TEXTBOX////////////////////////////////////
$.fn.selectRange = function (start, end) {      return this.each(function () {     var self = this;          if (self.setSelectionRange) {              self.focus();    self.setSelectionRange(start, end);        } else if (self.createTextRange) {    var range = self.createTextRange();   range.collapse(true);   range.moveEnd('character', end);   range.moveStart('character', start);   range.select();   }     });};
//sample format -> $('your id').selectRange(0, 1);

$('input,select,textarea').blur(function(){
$(this).removeClass("ui-state-highlight").css("cursor","");
if ($(this).val().length == 0){$(this).val($(this).attr('alt')).addClass('watermark');}else{$(this).css("color","black")}
}).focus(function(){
$(this).addClass("ui-state-highlight").css("cursor","");
$(this).selectRange(0, $(this).length);if ($(this).val() == $(this).attr('alt'))$(this).val('').removeClass('watermark');
})
$('#txtSProductsearch').val($('#txtSProductsearch').attr('alt')).addClass('watermark').css("color","gray");

/////////////BUTTON HOVER///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("button").hover(function(){	$(this).addClass("ui-state-hover").css("cursor","pointer"); 	
},function(){$(this).removeClass("ui-state-hover").css("cursor","");});

////////////BUTTON CLICK////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("button").click(function(){
switch($(this).attr("id"))
    {
        case "cmdProductSearch":      
             var typed = "productName";
             $("#productList").setGridParam({postData:{type:typed,searchValue:$('#txtSProductsearch').val()}});
             $("#productList").trigger("reloadGrid");
             $("#txtSProductsearch").val("");
             break;
        case "cmdProductEdit":
            if(PID!=0)
              {
              var id = $("#productList").jqGrid("getGridParam","selrow");
              var ret = $("#productList").getRowData(id);
              PCID = ret.PCID;
              mediaID = ret.mediaID;
              source = ret.source;
              $("#cboProductsCategoryName").val(PCID);
              $("#txtProductName").val(ret.productName);
              $("#txtProductDescription").val(ret.description);
              $("#txtProductUnits").val(ret.units);
              $("#txtProductBinaryPoints").val(ret.binaryPoints);
              $("#txtProductCommissionalPoints").val(ret.commissionalPoints);
              $("#txtProductPositionalPoints").val(ret.positionalPoints);
              $("#txtProductWeight").val(ret.weight);
              
              if(mediaID!=0)
                {
                $("#imgProduct").attr('src',ret.mysource);
                }
              else
                {
                $("#imgProduct").attr('src','images/system/noproduct.png');
                }
              
              
              action="edit";
              dialog.dialog("open");              
              }
             break;
        case "cmdProductDelete":
             $( "#product-dialog-confirm" ).dialog("open");
             break;
        case "cmdProductRemove":
             $("#imgProduct").attr('src','images/system/noproduct.png');
             mediaID="0";	
             break;
        default:
             break;
    }
});

 $('#txtSProductsearch').keypress(function(e){
            if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                $( "#cmdProductSearch" ).trigger( "click" );
            }
        });

////////////UPLOAD BUTTON///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
var GenExt="";
$(document).ready(function(){
		new AjaxUpload('#cmdProductUpload', 
    {
		action: 'ctrlProduct/uploadProduct/'+$("#Productusr").attr("alt"),		
		onSubmit : function(file , ext)
      {
			if (ext && /^(jpg|png|jpeg|gif)$/.test(ext))
          {
          GenExt = ext;
          $("#progressbar_product").show();
          this.setData({products: file,ext:ext});
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
          $( "#progressbar_product" ).progressbar({value: percentage});
          //$( "#loadingUpload" ).empty().append(percentage+"%");
      },
		  onComplete : function(file)
      {
      $.post("ctrlProduct/addMedia/1",{source:'images/data/products/',extension:GenExt[0],usr:$("#Productusr").attr("alt")}, function(data){

      var col = data.split("~");
      mediaID = col[0];    
      
      $("#progressbar_product").hide();	
      source = col[1];
      $("#imgProduct").attr('src',col[1]);	
      });                   
	
		  }		
	  });
});
});
