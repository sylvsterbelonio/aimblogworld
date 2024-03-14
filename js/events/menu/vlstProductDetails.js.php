////////////JQGRID LIST/////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

$("#priceList").jqGrid({     
url:'productdetails/price',        
datatype: 'xml',        
mtype: 'POST',              
altRows:true,        
colNames:['countryID','COUNTRY','PRICE SYMBOL','PRICE DESCRIPTION','DISTRIBUTORS PRICE','RETAIL PRICE'],        
colModel :[            
  {name:'countryID', index:'countryID',width:'100',align:'center',hidden:false}, 
  {name:'countryName', index:'countryName',width:'130',align:'left',hidden:false},  
  {name:'priceSymbol', index:'priceSymbol',width:'100',align:'center',hidden:false}, 
  {name:'priceDescription', index:'priceDescription',width:'140',align:'left',hidden:false}, 
  {name:'distributorPrice', index:'distributorPrice',width:'140',align:'right',hidden:false},    
  {name:'retailPrice', index:'retailPrice',width:'100',align:'right',hidden:false}                            
  ],        
postData:{type:'',searchValue:''},        
height: 150,        
pager: $('#price_pager'),        
rowNum:10,        
rowList:[5,10,20,30,50],        
sortname: '`countryName`',        
sortorder: "asc",        
viewrecords: true,        
imgpath: 'css/images',        
caption: 'List of Product Prices',        
shrink: true,        
ondblClickRow: function(id){           
 var ret = $("#priceList").getRowData(id);                              
$( "#cmdPriceEdit" ).trigger( "click" );
},
onSelectRow: function(id){  
 var ret = $("#priceList").getRowData(id);  
priceID = id;
}    
}); 


$( "#tabs_details" ).tabs();

///////////////DIALOG BOX FORM DETAILS//////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
var priceID="0";
var actionPrice="";
var countryID="0";
var PID="";


      function updateTipsPrice( t ) {    tips      .text( t )      .addClass( "ui-state-highlight" );     setTimeout(function() {       tips.removeClass( "ui-state-highlight", 1500 );    }, 500 );    }
      function checkLengthPrice( o, n, min, max ) {    if ( o.val().length > max || o.val().length < min ) {      o.addClass( "ui-state-error" );      updateTipsPrice( "Length of " + n + " must be between " +      min + " and " + max + "." );     return false;    } else {      return true;     }  }
      function checkRegexpPrice( o, regexp, n ) {    if ( !( regexp.test( o.val() ) ) ) {     o.addClass( "ui-state-error" );       updateTipsPrice( n );      return false;     } else {       return true;   }   }
      function checkNumberPrice(o)
        {
        if($.isNumeric(o))
          {return true;}
        else  {   
        o.addClass( "ui-state-error" );       
         updateTipsPrice( "The value must be decimal only." );    
         return false;  }
        }
        
      var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      //emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      txtRPrice = $( "#txtRPrice" ),txtDPrice = $( "#txtDPrice" ),
      allFields = $( [] ).add( txtDPrice ).add( txtRPrice ),
      tips = $( ".validateTipsPrice" );
 
      function formEvent_price() 
        {
          var valid = true;
          allFields.removeClass( "ui-state-error" );
     
          valid = valid && checkLengthPrice( txtRPrice, "Retail Price", 1, 255 );
          valid = valid && checkLengthPrice( txtDPrice, "Distributor Price", 1, 255 );
          //alert(txtRPrice.val());
          //valid = valid && checkNumber(txtRPrice);
          //valid = valid && checkNumber(txtDPrice);
          //valid = valid && checkLength( email, "email", 6, 80 );
          //valid = valid && checkLength( password, "password", 5, 16 );
     
          //valid = valid && checkRegexp( name, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
          //valid = valid && checkRegexp( email, emailRegex, "eg. emailname@address.com" );
          //valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
 
          if (valid) 
              {
             
                if(actionPrice=="add")
                    {                      
                    var pids = $("#cboselPDetails").val();
                    var countryids = $("#cboPriceFlag").val();
                        $.post("ctrlProductDetails/saveRecord_price/"+$("#ProductDetailsnusr").attr("alt"),{
                        priceSymbol:$("#txtPriceSymbol").val(),
                        PID:$("#cboselPDetails").val(),
                        priceDescription:$("#txtPriceDesc").val(),
                        distributorPrice:$("#txtDPrice").val(),
                        retailPrice:$("#txtRPrice").val(),
                        countryID:countryids,
                        id:0}, function(data){
                         $("#priceList").trigger("reloadGrid");
                        });                    
                    }
                else
                    {
                    var countryIDs = $("#cboPriceFlag").find('option:selected').attr("value");
                        $.post("ctrlProductDetails/saveRecord_price/"+$("#ProductDetailsnusr").attr("alt"),{
                        countryID:countryIDs, 
                        priceSymbol:$("#txtPriceSymbol").val(),
                        PID:$("#cboselPDetails").val(),
                        priceDescription:$("#txtPriceDesc").val(),
                        distributorPrice:$("#txtDPrice").val(),
                        retailPrice:$("#txtRPrice").val(),
                        id:priceID}, function(data){
                         $("#priceList").trigger("reloadGrid");
                        });                     
                    }
                dialog.dialog( "close" );
              }
          return valid;
        }
 
    dialog = $( "#price-dialog-form" ).dialog({
      autoOpen: false,
      resizable: false,
      height: 'auto',
      width: 350,
      modal: true,
      buttons: {
        "Save": formEvent_price,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {   
      allFields.removeClass( "ui-state-error" );
      }
    });
                 
    $( "#cmdPriceAdd" ).button().on( "click", function() {
      actionPrice="add";
      if(actionPrice=="add")
          {     
          PID="0";
          countryID="0";
          $("input").val("");
          }
      dialog.dialog( "open" );
    });
    
//////////////DIALOG BOX FOR CONFIRMATION OF DELETE RECORD//////////////////////
////////////////////////////////////////////////////////////////////////////////
    $( "#price-dialog-confirm" ).dialog({
      resizable: false,
    autoOpen:false,
    height:'auto',
    width:'auto',
    modal:true,
    buttons:{
    "Yes":function(){
        if(priceID!=0)
        {
                $.post("ctrlProductDetails/deleteRecord_price/1",{id:priceID}, function(data){
                $("#priceList").trigger("reloadGrid");
                 priceID=0;
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
        case "cmdPDetailsUpdate":
                    var pids = $("#cboselPDetails").val();
                        $.post("ctrlProductDetails/saveRecord_pdetails/"+$("#ProductDetailsnusr").attr("alt"),{
                        pid:pids,
                        details:$("#txtProductDetails").val(),
                        contents:$("#txtProductContents").val(),
                        manufactured:$("#txtManufacturedCompany").val()
                        }, function(data){
                         $("#gtestimonyList").trigger("reloadGrid");
                        });   
             break; 
        case "cmdPriceEdit":
        
            if(priceID!=0)
              {
             
              var id = $("#priceList").jqGrid("getGridParam","selrow");
              var ret = $("#priceList").getRowData(id);
              countryID = ret.countryID;

              $("#cboPriceFlag").val(ret.countryID);
              $("#txtPriceSymbol").val(ret.priceSymbol);
              $("#txtPriceDesc").val(ret.priceDescription);
              $("#txtDPrice").val(ret.distributorPrice);
              $("#txtRPrice").val(ret.retailPrice);
              actionPrice="edit";
             
              $( "#price-dialog-form" ).dialog("open");              
              }
             break;
        case "cmdPriceDelete":
             $( "#price-dialog-confirm" ).dialog("open");
             break;
        default:
             break;
    }
});

$("#cboselPDetails").change(function() {
  if($("#cboselPDetails").val()=="0")
  {$("#tabs_details").fadeOut(700);}
  else
  {
  
  var value = $("#cboselPDetails").val();
 
  $("#priceList").setGridParam({postData:{type:'PID',searchValue:value}});
  $("#priceList").trigger("reloadGrid");
               
  $("#pdetails_waiting").fadeIn(500);
  $("#tabs_details").hide();  
  }  
    window.setTimeout(function() {
    
    if($("#cboselPDetails").val()=="0") 
    {
    $("#tabs_details").fadeOut(700);
    }
    else 
    {
    $("#tabs_details").fadeIn(700);
            
            var pids = $("#cboselPDetails").val();
                        $.post("ctrlProductDetails/getRecordDetails/"+$("#ProductDetailsnusr").attr("alt"),{
                        pid:pids
                        }, function(data){                        
                        var obj = $.evalJSON(data);     
                               $("#txtProductDetails").val(obj.details);
                               $("#txtProductContents").val(obj.contents);
                               $("#txtManufacturedCompany").val(obj.manufactured);
                        });   

    }
    $("#pdetails_waiting").hide();
    }, 400);    
    });
    
/////////////BUTTON HOVER///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

$("button").hover(function(){	$(this).addClass("ui-state-hover").css("cursor","pointer"); 	
},function(){$(this).removeClass("ui-state-hover").css("cursor","");});

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


            
