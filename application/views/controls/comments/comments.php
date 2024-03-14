<?php
$this->load->model("mdlProduct");
$theme = $this->mdlGeneral->getTheme();
?>


<style>
.comments{
max-width:<?=$theme["maxWidth"]?>;
margin:0px auto;
border:1px solid <?=$theme["container2"]?>;
background: <?=$theme["container"]?>;
padding:20px;
}
.comments span{
font-size:400%;
}
.list-comments
{
width:100%;
margin:5px;
border: <?=$theme["nBorderColor"]?>;
background:white;
}
</style>



<div class="comments">
<span style="color:<?=$theme["nBackColor"]?>">Comments</span>
  <div class="list-comments">
  <textarea style="width:100%;height:100px"></textarea>
  </div>
  <div style="font-size:200%;padding:10px 20px 10px 20px;float:right;background:<?=$theme["nBackColor"]?>;color:<?=$theme["nForeColor"]?>">
  Post
  </div>
  <div style="clear:both"></div>

</div>
