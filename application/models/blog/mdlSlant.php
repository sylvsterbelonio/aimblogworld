<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class mdlSlant extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
        }
        
 public function getSlant()
        {
        $html="";
        $count=0;
        $sql="select * from tblthemes_slantslideshow order by `order`";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row)
            {
            if($count==0) 
            {
            $html.='
            <li class="current">
						<div class="description">
							<h2>'.$row->header1.'</h2>
							<p>'.$row->content1.'</p>
							<h2>'.$row->header2.'</h2>
							<p>'.$row->content2.'</p>
						</div>
						<div class="tiltview col">
						<a href="http://grovemade.com/"><img src="'.base_url().$row->imgUrl1.'"/></a>
						<a href="http://grovemade.com/"><img src="'.base_url().$row->imgUrl2.'"/></a>
						</div>
					  </li>
            ';
            }
            else
            {
            $html.='
            <li>
						<div class="description">
							<h2>'.$row->header1.'</h2>
							<p>'.$row->content1.'</p>
							<h2>'.$row->header2.'</h2>
							<p>'.$row->content2.'</p>
						</div>
						<div class="tiltview col">
						<a href="http://grovemade.com/"><img src="'.base_url().$row->imgUrl1.'"/></a>
						<a href="http://grovemade.com/"><img src="'.base_url().$row->imgUrl2.'"/></a>
						</div>
					  </li>
            ';            
            }
            
            $count=1;
            }
        return $html;
        }
    
        
}
?>
