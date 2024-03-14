var listType="grid"
var page="0";
var limit="12";
var customerID=$("#cusID").val();
var openModalDialog;
var PIID ="0";
var autoPlay = true;
var sectionType="";
var refID="";
var buttonElement;
function limits()
{
  page=0;
  limit = $("#cboNavigation").val();
  $("#cboView").trigger("change");
}

function nav(id)
{
  var col = id.split("_");
  page=col[1];
  limit = $("#cboNavigation").val();
  $("#cboView").trigger("change");
}

function checkContainsValue(elField,elErrors){       if($(elField).val()!="")     {    return true;    }  else      {  $(elField).addClass("ui-state-text-error");      $(elErrors).empty().append("<i>*" + $(elField).attr("title") + " is required.</i>").show(400);           return false;     }}

function checkRegexp( elField, regexp, elErrors ) 
{   
 
if ( !( regexp.test( elField.val() ) ) ) {     
elField.addClass( "ui-state-text-error" );      
 $(elErrors).empty().append("<i>*" + $(elField).attr("title") + " is not valid. Your email must be like this (eg. emailname@address.com)</i>").show(400);          
 return false;     
 } else 
 {       
 return true;   }   
 }



function openDialog(piid,value,type,element)
{
refID=value;
sectionType=type;
buttonElement=element;
$("#cmdOpenDialog").trigger("click");
}



var ModalEffects = (function() {

	function init() {

		var overlay = document.querySelector( '.md-overlay' );

		[].slice.call( document.querySelectorAll( '.md-trigger' ) ).forEach( function( el, i ) {

			var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) ),
				close = modal.querySelector( '.md-close' ),
				login = modal.querySelector( '#cmdLogIn' ),
				register = modal.querySelector( '#cmdRegister' );

			function removeModal( hasPerspective ) {
				classie.remove( modal, 'md-show' );

				if( hasPerspective ) {
					classie.remove( document.documentElement, 'md-perspective' );
				}
			}

			function removeModalHandler() {
				removeModal( classie.has( el, 'md-setperspective' ) ); 
			}

			el.addEventListener( 'click', function( ev ) {
			  if(customerID==0)
			  {
				classie.add( modal, 'md-show' );
				overlay.removeEventListener( 'click', removeModalHandler );
				overlay.addEventListener( 'click', removeModalHandler );

				if( classie.has( el, 'md-setperspective' ) ) {
					setTimeout( function() {
						classie.add( document.documentElement, 'md-perspective' );
					}, 25 );
				}          
        }
        else
        {
        ///THIS IS TO ADD NEW LIKES HERE///
     
        $.post($("#burl").val()+"hit/lovelike",
              {
              refID:refID,
              sectionType:sectionType
              }, function(data)
                  {
                     var col = data.split("~");       
                     if(col[0]=="1") {
                        if(sectionType=="like") $(buttonElement).empty().append(col[1]).addClass("like-active");
                        else $(buttonElement).empty().append(col[1]).addClass("love-active");
                     }
                     else
                     {
                        if(sectionType=="like") $(buttonElement).empty().append(col[1]).removeClass("like-active");
                        else $(buttonElement).empty().append(col[1]).removeClass("love-active");                  
                     }
                     
        });
        
        }

			});

			close.addEventListener( 'click', function( ev ) {
        $("input,textarea").val("");			
				ev.stopPropagation();
				removeModalHandler();
			});
			login.addEventListener( 'click', function( ev ) {

  			$("input,textarea").removeClass("ui-state-text-error");	
  			$(".error-caption").hide(500);
  			
  			var emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
  			var valid=true;			
        valid = valid && checkContainsValue($("#txtusername"),$("#etxtusername"));
			  valid = valid && checkContainsValue($("#txtpassword"),$("#etxtpassword"));
			
  			 if(valid)
  			 {  			 
			       $.post($("#burl").val()+"account/signin",
              {
              username:$("#txtusername").val(),
              password:$("#txtpassword").val()
              }, function(data)
                  {
                  if(data!="")
                    {
                    window.location.href = data;
                    ev.stopPropagation();
  				          removeModalHandler();  
                    }
                  else
                    {
                    $("#txtusername,#txtpassword").addClass("ui-state-text-error").val("");
                    $("#etxtusername").empty().append("<i>*Your email and password does not match!</i>").show(400);                      
                    }
                  });  			 
  			 
			 
  			 }
  			 
  			 

       

      });
			register.addEventListener( 'click', function( ev ) {
			
			$("input,textarea").removeClass("ui-state-text-error");	
			$(".error-caption").hide(500);
			
			var emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
			var valid=true;
			valid = valid && checkContainsValue($("#txtfname"),$("#etxtfname"));
			valid = valid && checkContainsValue($("#txtlname"),$("#etxtlname"));
			valid = valid && checkContainsValue($("#txtcontactNo"),$("#etxtcontactNo"));
      valid = valid && checkContainsValue($("#txtemail"),$("#etxtemail"));
      valid = valid && checkContainsValue($("#txtrpassword"),$("#etxtrpassword"));
      valid = valid && checkRegexp($("#txtemail"),emailRegex,$("#etxtemail"));
      
      
      
			if(valid)
			 {
			       $.post($("#burl").val()+"/customer/register",
              {
              piid:$("#txtID").val(),
              fname:$("#txtfname").val(),
              mname:$("#txtmname").val(),
              lname:$("#txtlname").val(),
              address:$("#txtaddress").val(),
              contactNo:$("#txtcontactNo").val(),
              email:$("#txtemail").val(),
              password:$("#txtrpassword").val()
              }, function(data)
                  {
                  //alert(data);
                  var href = $('#lnkHomePage').attr('href');
                  window.location.href = href;
                  customerID=data;
                  ev.stopPropagation();
    				      removeModalHandler();	 
    				    
                  });
			 
		 
			 }
			
			

			});			
			
			
		} );

	}

	init();

})();		



/////////////////DIALOG DETAILS////////////////////////////
var ModalEffectsDetails = (function() {

	function init2() {

		var overlaydetails = document.querySelector( '.md-overlay-details' );

		[].slice.call( document.querySelectorAll( '.md-trigger-details' ) ).forEach( function( el, i ) {

			var modaldetails = document.querySelector( '#' + el.getAttribute( 'data-modal-details' ) ),
				closedetails = modaldetails.querySelector( '.md-close-details' );

			function removeModal( hasPerspective ) {
				classie.remove( modaldetails, 'md-show-details' );

				if( hasPerspective ) {
					classie.remove( document.documentElement, 'md-perspective' );
				}
			}

			function removeModalHandler() {
			autoplay=false;
				removeModal( classie.has( el, 'md-setperspective' ) ); 
			}

			el.addEventListener( 'click', function( ev ) {
				classie.add( modaldetails, 'md-show-details' );
				overlaydetails.removeEventListener( 'click', removeModalHandler );
				overlaydetails.addEventListener( 'click', removeModalHandler );

				if( classie.has( el, 'md-setperspective' ) ) {
					setTimeout( function() {
						classie.add( document.documentElement, 'md-perspective' );
					}, 25 );
				}
			});

			closedetails.addEventListener( 'click', function( ev ) {
				ev.stopPropagation();
				removeModalHandler();
			});

		} );

	}

	init2();

})();




$(function() {


$("#lnkLogIn").click(function() {
            $("#dialog-header").empty().append("Log In Here");
            $("#dialog-register").hide();
            $("#dialog-login").fadeIn(1000);
});
$("#lnkRegister").click(function() {
            $("#dialog-header").empty().append("Register Here");
            $("#dialog-login").hide();
            $("#dialog-register").fadeIn(1000);
});

$("#cboSort,#cboView,#cboselCountry").change(function() {
      $("#imgWait").fadeIn(500).css("height","100%");
      $("#lstProducts,#lstDetailProducts").hide();

      $.post($("#burl").val()+"shop/event/typeview",
              {
              piid:$("#txtID").val(),
              typeview:$("#cboView").val(),
              countryID:$("#cboselCountry").val(),
              sort:$("#cboSort").val(),
              page:page,
              limit:$("#cboNavigation").val()
              }, function(data)
                  {
                   if($("#cboView").val()=="grid") $("#lstProducts").empty().append(data).fadeIn(500);
                   else $("#lstDetailProducts").empty().append(data).fadeIn(500);       
                   $("#imgWait").hide();      
         
      $.post($("#burl").val()+"shop/event/navigationFooter",
              {
              piid:$("#txtID").val(),
              typeview:$("#cboView").val(),
              countryID:$("#cboselCountry").val(),
              sort:$("#cboSort").val(),
              page:page,
              limit:$("#cboNavigation").val()
              }, function(data)
                  {
                   $("#lstNavigation").empty().append(data);  
                  });
                  });

      });




});





function openDetails(pid,countryID)
{                 
                  $("#dialog-quickview").load($("#burl").val()+"product/form/details?pid="+pid+"&countryID="+countryID+"&home="+$("#burl").val()+"&segments="+$("#txtsegment").val());  
    				      $("#cmdOpenDialog2").trigger("click");         
}

function openFullProductDetails(url)
{
window.location.href=url;
}




function quantityAction(element,type){if(type=="+") {if($(element).val()!=""){var newVal = parseInt($(element).val())+1;if(newVal>99) $(element).val(1);else $(element).val(newVal);}else{$(element).val("1");}}else{if($(element).val()!=""){var newVal = $(element).val()-1;if(newVal<0) $(element).val(99);else $(element).val(newVal);}else{$(element).val("99");}}}
function quantity(element){if(!isNaN($(element).val()))  {     if($(element).val()>99) $(element).val("99");   }else  {  $(element).val("0");  }}



