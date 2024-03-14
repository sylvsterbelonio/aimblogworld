<?php
$this->load->model("mdlPages");
$data = $this->mdlPages->load("home");

 $this->load->model("blog/mdlAttributes");
 $attr = $this->mdlAttributes->getSliceBoxAttr(0);
//if($data!='false') echo $data;
//else $this->load->view("errors/html/error_route");



$this->load->model("mdlGeneral");
$this->load->library("Color");
$this->load->model("mdlSlideShow");
$slideshows = $this->mdlSlideShow->getSlideShow();  
$theme = $this->mdlGeneral->getTheme();
$rgb = $this->color->string_to_rgb($theme["nBackColor"]);
?>


 
 
 

        <?=$data?>
  
