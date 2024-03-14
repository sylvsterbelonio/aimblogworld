<?php
$this->load->model("blogs/mdlGeneral");
$theme=$this->mdlGeneral->getTheme();  
$board = $this->mdlCompany->getBoardOfDirectors();
?>


<style>
.container{
max-width:<?=$theme['maxWidth']?>;
margin:0px auto;
background:<?=$theme['container']?>;
}


.list-board{
margin:0;
display:inline-block;
list-style:none;
margin: 0;
overflow: hidden;
padding: 0;
text-align:center;
}

.list-board li{
display:inline;
float: left;
margin:0px 0px 0px 0px;
font-family: 'Open Sans Condensed','Arial Narrow', serif;
font-size:100%;
width:300px;
color: black;
font-weight:500%;
padding:10px;
}

.list-board li span{
font-style:italic;
line-height:25px;
font-weight:0px;
padding-bottom:10px;
font-size:200%;
}

.list-board li p{
margin-top:20px;
color:<?=$theme["nBackColor"]?>;

}

.list-board li p p{
font-size:200%;
color:<?=$theme["nForeColor"]?>;
}
.list-board li p b{
font-size:200%;
}
.ui-hr{
margin:10px;
}

.text-wrapper-paragraph
{
font-size:200%;

}

</style>

<div class="container">
<table align=center style="width:100%">
<tr><td align=center>
    <ul class="list-board">
          <?=$board?>
    </ul>
</td></tr>
</table> 
<div style="clear:both"></div>
