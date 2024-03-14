<?php
$this->load->model("blog/mdlCompany");
$this->load->model("blog/mdlGeneral");
$theme=$this->mdlGeneral->getTheme();
?>

<style>.menu-wrapper-content{background:<?=$theme["container2"]?>;}.list-right-menus{list-style:none;}.list-right-menus li button{width:100%;border-radius:0px;padding:15px 5px 15px 5px;}.ui-state-active{background:<?=$theme["pBackColor"]?>;color:<?=$theme["hForeColor"]?>;}
.li-b{font-size:200%;}.left-menu-content{}.left-menu-content p{text-align:justify;}.left-menu-content h1{}.left-menu-content ul{line-height:30px;}.left-menu-content ul li{margin-left:45px;}.floatRight{position:fixed;top:10%;}.list-right-menus{-webkit-transition: all .3s ease-in-out;-moz-transition: all .8s ease-in-out;-ms-transition: all .8s ease-in-out;-o-transition: all .8s ease-in-out;transition: all .8s ease-in-out;  }</style>
<div class="menu-wrapper-content" style="position:relative">
<table style="width:100%" >
<tr>
<td>
<div id="menu-content" class="left-menu-content">
<img oncontextmenu="return false;" src="<?=base_url()?>images/system/companyinfo.jpg" style="width:100%;border-radius:10px">
</div>
</td>
<td valign=top style="width:25%;">

<ul id="list-right-menus" class="list-right-menus">

<li><button id="cmdCProfile" title="Company Profile">Company Profile</button></li>
<li><button id="cmdRightBusiness" title="The Right Business">The Right Business</button></li>
<li><button id="cmdCPresentation" title="Company Presentation">Company Presentation</button></li>
<li><button id="cmdvision" title="Vision, Mission and Objectives">Vision, Mission and Objectives</button></li>
</ul>

</td>
</tr>
</table>

</div>
<script><?php if(isset($link)){if($link=="Company Profile") echo '$("#cmdCProfile").addClass("ui-state-active"); $.post("'.base_url().'company/event/getData",      {    title:$("#cmdCProfile").attr("title")    }, function(data)   {   $("#menu-content").empty().append(data).fadeIn(1000);  });';if($link=="The Right Business") echo '$("#cmdRightBusiness").addClass("ui-state-active"); $.post("'.base_url().'company/event/getData",      {    title:$("#cmdRightBusiness").attr("title")    }, function(data)   {   $("#menu-content").empty().append(data).fadeIn(1000);  });';if($link=="Company Presentation") echo '$("#cmdCPresentation").addClass("ui-state-active"); $.post("'.base_url().'company/event/getData",      {    title:$("#cmdCPresentation").attr("title")    }, function(data)   {   $("#menu-content").empty().append(data).fadeIn(1000);  });';if($link=="Vision, Mission and Objectives") echo '$("#cmdvision").addClass("ui-state-active"); $.post("'.base_url().'company/event/getData",      {    title:$("#cmdvision").attr("title")    }, function(data)   {   $("#menu-content").empty().append(data).fadeIn(1000);  });';}?>$('img').contextmenu( function() {return false;});$( window ).scroll(function() {if($(this).scrollTop() > 350) {$("#list-right-menus").addClass("floatRight");} else {$("#list-right-menus").removeClass("floatRight");}});$('button').click(function(event){$('button').removeClass("ui-state-active");$(this).addClass("ui-state-active");var type="";var section = $(this).attr("title");$("#menu-content").fadeOut(300);$.post("<?=base_url()?>company/event/getData",      {    title:$(this).attr("title")    }, function(data)   {   $("#menu-content").empty().append(data).fadeIn(1000);  });});</script>
