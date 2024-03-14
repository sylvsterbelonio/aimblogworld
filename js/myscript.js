// Get the modal
$(function(){

var modal = document.getElementById('myModal');
// Get the button that opens the modal
var btn = document.getElementById("myBtn");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


$("#cmdLogIn").click(function(){
  if($("#txtusername").val()!="" && $("#txtpassword").val()!="")
    {  
      $.post("admin",{username:$("#txtusername").val(), password:$("#txtpassword").val()}, function(data){
      if (data=="ok")
          {
          $("#core").fadeOut(1000);
         
         window.setTimeout(function() {
          $("#core").empty().html("sadasd").fadeIn(1000);
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

$("#ui-dialog-ok").click(function(){modal.style.display = "none";});

//////////////////////////////////////////////////////
//THIS IS FOR WATERMARK TEXTBOX///////////////////////
$.fn.selectRange = function (start, end) {      return this.each(function () {     var self = this;          if (self.setSelectionRange) {              self.focus();    self.setSelectionRange(start, end);        } else if (self.createTextRange) {    var range = self.createTextRange();   range.collapse(true);   range.moveEnd('character', end);   range.moveStart('character', start);   range.select();   }     });};
//sample format -> $('your id').selectRange(0, 1);

$('#txtfirstname,#txtlastname,#txtemail,#txtremail,#txtnpassword,#txtaccountid,#txtsecuritycode').blur(function(){if ($(this).val().length == 0)$(this).val($(this).attr('title')).addClass('watermark');}).focus(function(){
$(this).selectRange(0, $(this).length);if ($(this).val() == $(this).attr('title'))$(this).val('').removeClass('watermark');})

$('#txtfirstname').val($('#txtfirstname').attr('title')).addClass('watermark');
$('#txtlastname').val($('#txtlastname').attr('title')).addClass('watermark');
$('#txtemail').val($('#txtemail').attr('title')).addClass('watermark');
$('#txtremail').val($('#txtremail').attr('title')).addClass('watermark');
$('#txtnpassword').val($('#txtnpassword').attr('title')).addClass('watermark');
$('#txtaccountid').val($('#txtaccountid').attr('title')).addClass('watermark');
$('#txtsecuritycode').val($('#txtsecuritycode').attr('title')).addClass('watermark');
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


