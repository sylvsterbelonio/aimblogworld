$(function(){


$("#wait_accordionMenu").fadeIn(500);
$.post("admin/accordionMenu",{ usr: $("#usr").attr("alt"),idf:$("#idf").attr("alt")}, function(value)
{
$("#accordion").fadeIn(500);
$("#accordion").empty().html(value);
$("#wait_accordionMenu").hide();
$("#accordion").height($(window).height()-200).accordion( "refresh" );
});



var tabs = $( "#tabs" ).tabs();
$( "#tabs" ).height($( $(window).height()))


$("#myProfile").css("left",$(window).width()-$("#myProfile").width()-20);
$("#myProfile").css("top",$("#myProfile").height()-5);
$("#arrowup").css("left",$(window).width()-$("#arrowup").width()-70);
$("#arrowup").css("top",$("#arrowup").height()+100);

$( window ).resize(function() {
$("#myProfile").css("left",$(window).width()-$("#myProfile").width()-20);
$("#myProfile").css("top",$("#myProfile").height()-15);
});

var toggleProf ="";
$("#imgProfile").click(function(){if(toggleProf=="")   {    $("#myProfile").fadeIn(300);    toggleProf="x";    }else    {     $("#myProfile").fadeOut(300);     toggleProf="";   }});



$(document).mouseup(function (e)
{
    var container = $("#myProfile");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.fadeOut(300);  
    }

});


$("#lstMyProfile,#lstViewBlog,#lstSignOut").hover(function(){	
$(this).css("cursor","pointer").addClass("ui-state-active"); 	
},function(){
$(this).css("cursor","").removeClass("ui-state-active");});


$(function() {
    $( document ).tooltip();
  });


});

function setMenuMouseOver(element)
{
$(element).addClass("ui-state-hover").css("cursor","pointer");
}
function setMenuMouseOut(element)
{
$(element).removeClass("ui-state-hover").css("cursor","");
}


 

