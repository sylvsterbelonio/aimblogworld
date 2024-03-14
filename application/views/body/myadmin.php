          
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

li {
    float: left;
}

li a {
    display: inline-block;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover { 
}

.accordion .h3{ height:1px }

img.imgProfile:hover{
cursor:pointer;
}

.ui-jqgrid {font-size:0.8em}
.ui-jqgrid tr.jqgrow th { font-size: 18px; }
.ui-jqgrid tr.jqgrow td { height: 18px; }


.arrow-up {
	width: 0; 
	height: 0; 

	border-left: 5px solid transparent;
	border-right: 5px solid transparent;
	position:absolute;
	border-bottom: 5px solid black;
}
</style>
<style>
.arrow_box {
	position: absolute;
	background: #ffffff;
	border: 1px solid #5f9ebc;
        border-radius: 5px;
        top:10;
padding:5px;
}
.arrow_box:after, .arrow_box:before {
	bottom: 100%;
	left: 86%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
}

.arrow_box:after {
	border-color: rgba(255, 255, 255, 0);
	border-bottom-color: #ffffff;
	border-width: 10px;
	margin-left: -10px;
}
.arrow_box:before {
	border-color: rgba(59, 216, 255, 0);
	border-bottom-color: #5f9ebc;
	border-width: 11px;
	margin-left: -11px;
}
</style>


 <script>
 
  $(function() {
    $( "#dialog-loading" ).dialog({
      autoOpen: false,
      resizable: false,
      modal: true,
      closeOnEscape: false,
      height:100,
      beforeclose: function (event, ui) { return false; }
    });

  });
  </script>
<div id="myProfile" style="display:none;padding:5px;with:100px;position:absolute;z-index:111;box-shadow:  3px 3px 3px #dbdbdb;" class='arrow_box'>
<table  border=0 style="width:100%">
<tr>
<td rowspan=3>
<img src="<?=base_url()?>images/user.png">
</td>
</tr>
<tr>
<td valign=top>
<b><?=$name?></b><br>
<i><?=$emailAddress?></i><br>
<?=$desc?>
</td>
</tr>
<tr>
<td>
<div  style="background-color:#dfdfdf">
<ul style="padding:4px;width:100%">
 <li id="lstMyProfile">
 <span class="ui-icon ui-icon-person
 " style="float:left"></span>My Profile
 </li>
 <li id="lstViewBlog">
 <span class="ui-icon ui-icon-home" style="float:left"></span>View Blog
 </li>
 <li id="lstSignOut">
 <span class="ui-icon ui-icon-power" style="float:left"></span>Sign Out
 </li> 
</ul>
</div>
</td>
</tr>
</table>
          </div>
<div id="dialog-loading" title="Please Wait...">
<table align=center>
<tr>
<td><div style="background-image: url('<?=base_url()?>mages/gif/pbar-ani.gif');width:100%')">
<ul>
<li><img style="border-top-left-radius:5px;border-bottom-left-radius:5px" src="<?=base_url()?>images/gif/pbar-ani.gif"></li>
<li><img src="<?=base_url()?>images/gif/pbar-ani.gif"></li>
<li><img src="<?=base_url()?>images/gif/pbar-ani.gif"></li>
<li><img src="<?=base_url()?>images/gif/pbar-ani.gif"></li>
<li><img style="border-top-right-radius:5px;border-bottom-right-radius:5px" src="<?=base_url()?>images/gif/pbar-ani.gif"></li>
</ul>
</tr>
</table>

</div>
</div>

<div id="myProfile" style="display:none;padding:5px;with:100px;position:absolute;z-index:111;box-shadow:  3px 3px 3px #dbdbdb;" class="ui-widget-content">




</div>


<ul style="padding:4px;width:100%">
  <li style="float:right;padding:5px" >
  <a style="padding:5px">
<table border=0 style="width:100%;">
<tr>
<td>
<img src="<?=base_url()?>images/aimglobal.png">
</td>
<td  style="width:100%;" align=right>
<h3>Advanced Personal Blog Website!</h3>
</td>
<td >
<img id="imgProfile" class="imgProfile" src="<?=base_url()?>images/user.png" style="border-radius: 50%" width=60 height=60>
</td>
</tr>

</table>
  
  </a>
  </li>
</ul>
<ul class="ui-widget-header">
  <li><a class="active" href="#home">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
</ul>



<ul class="">
  <li style="width:20%;min-width:250px">
<input id="idf" type="hidden" alt="<?php echo $PIID;?>">
<input id="usr" type="hidden" alt="<?php echo $userLevel;?>">
<div id="accordionMenu" class="ui-widget-content ui-corner-all">
<table id="wait_accordionMenu" style="height:300px;display:none" align=center><tr><td><img src="<?=base_url()?>images/gif/waiting.gif"</td></tr></table>
  <div id="accordion" style="display:none">
  </div>             
</div>     
  
  </li>
  <li style="width:80%;min-width:550px">
  

 <style>
  #dialog label, #dialog input { display:block; }
  #dialog input, #dialog textarea { width: 95%; }
  #tabs li .ui-icon-close { float: right; margin: 0.7em 0.4em 0 0; cursor: pointer; }
  #add_tab { cursor: pointer; }
  
  .ui-jqgrid {font-size:0.8em}
  .ui-jqgrid tr.jqgrow th { font-size: 30px; }
  .ui-jqgrid tr.jqgrow td { height: 25px; }
  </style>
 
<div id="tabs">
  <ul id="alltab">
    <li><a href="#tabs-1">Home</a></li>
  </ul>
  <div id="tabs-1">
  </div>
</div>

</li>
</ul>

<script>
$(function(){
$.getScript('<?=base_url()?>js/events/myadmin.js.php');
$.getScript('<?=base_url()?>js/events/dynamictabcontrol.js.php');
$.getScript('<?=base_url()?>js/events/accordioncontrol.js.php');
});
</script>
