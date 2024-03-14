<?php

class mdlSlideShow extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
                
        }
        
    function getURL($url)
        {
        return base_url().$url;
        }    
        
    function getSlideShow()
        {
        $count=0;
        
        $html='<div class="slicebox-container">
			         <div class="wrapper">
				       <ul id="sb-slider" class="sb-slider">';
				       
        $query = $this->db->get_where('tblthemes_slideshow', array('themeID' => $this->config->item("gthemeID")));
            foreach ($query->result() as $row)
            {
            $html.='<li>
						      <a href="'.$row->urlSite.'" target="_blank"><img src="'.$this->getURL($row->imageURL).'" alt="'.$row->title.'"/></a>
						      <div class="sb-description">
							    <h3>'.$row->description.'</h3>
						      </div>
					        </li>';
					  $count++;
            }
        $html.='</ul>			    
				    <div id="nav-arrows" class="nav-arrows">
					  <a href="#">Next</a>
					  <a href="#">Previous</a>
				    </div> 
				    <div id="nav-dots" class="nav-dots" style="z-index:1">
            ';
         for($i=0;$i<$count;$i++)
            {
            if($i==0) $html.='<span class="nav-dot-current"></span>';
            else $html.='<span></span>';
            }
         $html.='</div>
			   </div><!-- /wrapper -->';
			  return $html;
        }
 }
?>
