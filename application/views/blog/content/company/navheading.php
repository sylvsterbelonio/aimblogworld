<?php
$this->load->model("blogs/mdlGeneral");
$theme=$this->mdlGeneral->getTheme();  
?>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/navheading.css" /> 
<style>
.category_content{
max-width:<?=$theme["maxWidth"]?>px;
}
.category_content div{
color:<?=$theme["nForeColor"]?>;
}

.category_content a{
color:<?=$theme["nForeColor"]?>;

}
.category_content a:hover{
color:<?=$theme["hForeColor"]?>;
}
.category_content{
padding-top:10px;
background:rgba(0,0,0,0.7);
border-radius:0px;
}
</style>
<div class="category_content">
  <div>
  <a href="<?=base_url()?><?php if ($this->config->item("sitename")!="") echo $this->config->item("sitename");?>"><span class="nav-text">Home</span></a><span>
  </div>
  
  <?php 
  if(isset($searchValue))
  {   
      echo "<style>.category_content{padding-top:5px;}</style>";
      
      if($this->config->item("sitename")!="shop") echo '<div><img src="'.base_url().'images/system/arrowright.png" style="float:left"><a href="'.base_url().$this->config->item("sitename").'/"><span class="nav-text">'.$caption.'</span></a></div>';
      else   echo '<div><img src="'.base_url().'images/system/arrowright.png" style="float:left"><a href="'.base_url().$this->config->item("sitename").'/"><span class="nav-text">'.$caption.'</span></a></div>';
      
      
      if(isset($searchValueProduct))
          {
          echo "<style>.category_content{padding-top:20px;}</style>";
          echo "<div><img src='".base_url()."images/system/arrowright.png' style='float:left'><span class='nav-text'>".$searchValue."</span></div>";
          echo "<div><img src='".base_url()."images/system/arrowright.png' style='float:left'><span class='nav-text'>".$searchValueProduct."</span></div>";
          
          
          }
      else
          {
      echo "<div><img src='".base_url()."images/system/arrowright.png' style='float:left'><span class='nav-text'>".$searchValue."</span></div>";
          }
  }
  else
  {
  echo '<div><img src="'.base_url().'images/system/arrowright.png" style="float:left"><span class="nav-text">'.$caption.'</span></div>';
  }
  ?>
     
</div>
