

function getData(element,data,url,type)
{



var col = data.split("-");
var from = parseInt(col[0])+1;
var to = parseInt(col[1]);

$.post(url+"learnmore/product-presentation/more",{type:type,data:from,videoVersion:$("#cboVideoVersion").val()}, function(data){

$(element).parent().empty();
$("#wp-all-wrapper").append(data);

});


}

function getRightData(element,data,url,postID,searchTag,type)
{

var col = data.split("-");
var from = parseInt(col[0])+1;
var to = parseInt(col[1]);

$.post(url+"learnmore/product-presentation/rightmore",{type:type,data:from,videoVersion:'',postID:postID,searchTag:searchTag}, function(data){

$(element).parent().empty();
$("#left-wp-data-list").append(data);

});





}
