
<style>
.left-panel{
width:250px;
height:100vh;
overflow-y:auto;
background:black;
color:white;
min-height: 100%;
overflow-x:hidden;
margin:0px;
}
.top-panel{
background:white;
height:60px;
}

ul{
display:inline-block;
list-style:none;
margin: 0;
overflow: hidden;
    padding: 0;
    float:right
}
li{
display:inline;
float: left;
margin:10px 10px 0px 0px;

}
li img{
display: block;
}

.menu-list{
width:100%;
background:#1e1e1e;
border-top:2px solid #343434;
text-align:center;
padding:10px 20px 10px 0px;
font-size:80%;

}
.menu-list:hover{
background:#2d2d2d;
cursor:pointer;
}

.menu-list span{
}
.arrow {
width: 0;
height: 0;
border-style: solid;
border-width: 11px 15.3px 10px 0;
border-color: transparent #666666 transparent transparent;
line-height: 0px;
_border-color: #000000 #666666 #000000 #000000;
_filter: progid:DXImageTransform.Microsoft.Chroma(color='#000000');
}


</style>


<div class="header ui-content">
<img src="images/system/smalllogo.png" height=30 width=35 style="margin:5px;">

<ul>
<li style="position:relative">
<img src="images/system/friend.png" height=24 width=24><span style="position:absolute;right:-5px;top:-8px;background:red;color:white;font-size:10px;padding:1px 5px 2px 5px;border-radius:5px">25</span>
</li>
<li style="position:relative">
<img src="images/system/message_active.png" height=24 width=24><span style="position:absolute;right:-5px;top:-8px;background:red;color:white;font-size:10px;padding:1px 5px 2px 5px;border-radius:5px">99+</span>
</li>
<li style="position:relative">
<img src="images/system/notification.png" height=24 width=24><span style="position:absolute;right:-5px;top:-8px;background:red;color:white;font-size:10px;padding:1px 5px 2px 5px;border-radius:5px">26</span>
</li>
<li>
<img src="images/system/menu.png" height=24 width=24 style="margin-left:50px">
</li>
</ul>
</div>









<div class="left-panel">
<div class="menu-list">Settings <span class="arrow" style="float:right"></span></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
<div class="menu-list">Settings<span class="" style="float:right"></span></div>
</div>


<script>


$('.menu-list').click(function(event){
$('.menu-list').find('span').removeClass("arrow");
$(this).children('span').addClass("arrow");
});

</script>
