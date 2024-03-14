// Get the modal

$(function(){

//////////////////////////////////////////////////////
//THIS IS FOR WATERMARK TEXTBOX///////////////////////
$.fn.selectRange = function (start, end) {      return this.each(function () {     var self = this;          if (self.setSelectionRange) {              self.focus();    self.setSelectionRange(start, end);        } else if (self.createTextRange) {    var range = self.createTextRange();   range.collapse(true);   range.moveEnd('character', end);   range.moveStart('character', start);   range.select();   }     });};
//sample format -> $('your id').selectRange(0, 1);


///THIS IS HOVER
$("#cmdLogIn,#cmdCreate").hover(function(){	$(this).addClass("ui-state-hover").css("cursor","pointer"); 	
},function(){
$(this).removeClass("ui-state-hover").css("cursor","");});

$("#cboMonth,#cboDay,#cboYear").hover(function(){	$(this).addClass("ui-state-active").css("cursor","pointer"); 	
},function(){
$(this).removeClass("ui-state-active").css("cursor","");});

$('#txtusername,#txtpassword,#txtsecuritycode,#txtaccountid,#txtnpassword,#txtremail,#txtlastname,#txtfirstname,#txtemail').blur(function(){
$(this).removeClass("ui-state-highlight").css("cursor","");
if ($(this).val().length == 0)$(this).val($(this).attr('title')).addClass('watermark');


}).focus(function(){
$(this).addClass("ui-state-highlight").css("cursor","");
$(this).selectRange(0, $(this).length);if ($(this).val() == $(this).attr('title'))$(this).val('').removeClass('watermark');
})

$('#txtfirstname').val($('#txtfirstname').attr('title')).addClass('watermark').css("color","gray");
$('#txtlastname').val($('#txtlastname').attr('title')).addClass('watermark').css("color","gray");
$('#txtemail').val($('#txtemail').attr('title')).addClass('watermark').css("color","gray");
$('#txtremail').val($('#txtremail').attr('title')).addClass('watermark').css("color","gray");
$('#txtnpassword').val($('#txtnpassword').attr('title')).addClass('watermark').css("color","gray");
$('#txtaccountid').val($('#txtaccountid').attr('title')).addClass('watermark').css("color","gray");
$('#txtsecuritycode').val($('#txtsecuritycode').attr('title')).addClass('watermark').css("color","gray");




$("#cmdLogInx").click(function(){
  if($("#txtusername").val()!="" && $("#txtpassword").val()!="")
    {  
      $.post("admin",{username:$("#txtusername").val(), password:$("#txtpassword").val()}, function(data){
      //alert(data);
      if (data=="ok")
          {
          //$("#core").fadeOut(1000);
         
         window.setTimeout(function() {
          //$("#core").empty().load("admin/access").fadeIn(1000);
         }, 1000);
         
         
          }
      else if(data=="error")
          {
          $("#ui-dialog-yes,#ui-dialog-no").css("display","none");
          $("#ui-dialog-header").empty().append("Unable to Log In Account!");
          $("#ui-dialog-message").empty().append("<table><tr><td><img height=100 width=100 src='images/dialog-warning.png'></td><td>Invalid Username/Password! Please try again.</td></tr></table>")
          modal.style.display = "block";      
          $("#txtusername").val("").focus();
          $("#txtpassword").val("");
          }
      else
          {
          $("#ui-dialog-yes,#ui-dialog-no").css("display","none");
          $("#ui-dialog-header").empty().append("Unable to Log In Account!");
          $("#ui-dialog-message").empty().append("<table><tr><td><img height=100 width=100 src='images/dialog-warning.png'></td><td>Sorry, Your account does not exist.</td></tr></table>")
          modal.style.display = "block";      
          $("#txtusername").val("").focus();
          $("#txtpassword").val("");          
          }
      });	  
    }
  else
    {
    $("#ui-dialog-yes,#ui-dialog-no").css("display","none");
    $("#ui-dialog-header").empty().append("Unable to Log In Account!");
    $("#ui-dialog-message").empty().append("<table><tr><td><img height=100 width=100 src='images/dialog-warning.png'></td><td>Please input username and password.</td></tr></table>")
    modal.style.display = "block";
    }
});













//////////////////////////////////////////////////////
//////////////////////////////////////////////////////



$("#soptM,#soptF").hover(function(){	$(this).css("cursor","pointer"); 	
},function(){
$(this).css("cursor","");});

$("#soptM").click(function(){
$("#optM").prop('checked',true);
});
$("#soptF").click(function(){
$("#optF").prop('checked',true);
});











});


