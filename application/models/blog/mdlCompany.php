<?php
class mdlCompany extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
                $this->load->library('Crypt');
                $this->load->library('Url');
                $this->load->library('Wrapper');
        }
        
 public function getData($url)
        {
        $html="";
        $sql="select * from tblblog_pages where url='$url' and PIID=".$this->config->item("gpiid");
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            {
                    foreach ($query->result() as $row)
                        {
                              $sql = "SELECT * FROM   tblblog_pages   INNER JOIN tblblog_pages_content     ON (tblblog_pages.pageID = tblblog_pages_content.pageID) where tblblog_pages.PIID=".$row->PIID." and tblblog_pages_content.pageID=".$row->pageID." group by tblblog_pages_content.contentID order by tblblog_pages_content.order";
                              $query = $this->db->query($sql);   
                              foreach ($query->result() as $row) 
                              { 
                               $html.=$this->wrapper->setData($row->contentID,$row->type,$row->title,$row->content,$row->order);                          
                              }
                        }          
            }
        return $html;
        }

 public function getRightBusiness()
        {
        $html="";
        $sql = "SELECT * FROM tblcompany_list_rightbusiness order by `order`";
        $query = $this->db->query($sql);   
        foreach ($query->result() as $row) 
            {
            $html.=$this->wrapper->setData($row->type,$row->title,$row->content,$row->order);
            }
        return $html;
        }        
 
 public function getCompanyPresentation()
        {
         $html="";
        $sql = "SELECT * FROM tblcompany_list_companypresentation order by `order`";
        $query = $this->db->query($sql);   
        foreach ($query->result() as $row) 
            {
            $html.=$this->wrapper->setData($row->type,$row->title,$row->content,$row->order);
            }
        return $html;       
        }

 public function getMissionVision()
        {
        $html="";
        $sql = "SELECT * FROM tblcompany_list_visionmission order by `order`";
        $query = $this->db->query($sql);   
        foreach ($query->result() as $row) 
            {
            $html.=$this->wrapper->setData($row->type,$row->title,$row->content,$row->order);
            }
        return $html;       
        }
        
 public function getBoardOfDirectors()
        {
        $html="";
        $sql = "SELECT * FROM tblcompany_list_boardofdirectors order by `order`";
        $query = $this->db->query($sql);   
        foreach ($query->result() as $row) 
            {
            $html.='  
                  <li>    
                  <img oncontextmenu="return false;" src="'.base_url().$row->imgURL.'" width=250>
                  <hr class="ui-hr">
                  <span>
                  '.$row->qoutes.'
                  </span>
                  <p>
                  <b>'.$row->name.'</b>
                  <p style="color:black;margin-top:0px;font-size:10px" class="select-disabled">
                  '.$row->position.'
                  </p>
                  </p>
                  </li>';
            }
        return $html;        
        } 
        
 public function getBusinessPartners()
        {
        $style='<style>';
        $content='';
        $html='				
          <div class="cn-slide" id="business-partners">
					<h2>Business Partners</h2>
					<nav>';
					
        $sql = "select * from tblcompany_list_businesspartners order by `order`";
        $query = $this->db->query($sql);           
        foreach ($query->result() as $row) 
            {
            $style.='
            .cn-slide nav a[href="#'.$row->id.'"]{
	          background-image: url('.base_url().$row->imgUrl.')}';
            $html.='<a href="#'.$row->id.'">'.strtoupper($row->title).'</a>';
            
                   $content.='
                   <div class="cn-slide" id="'.$row->id.'">
      					   <h2>'.$row->title.'</h2>
      					   <a href="#business-partners" class="cn-back">Back</a>
      					   <div class="cn-content">';
            
            
            $sql="select * from tblblog_pages where url='business-partners#business-partners' and PIID=".$this->config->item("gpiid");
            $query_page = $this->db->query($sql);

            if($query_page->num_rows()>0)
                {
                
                    foreach ($query_page->result() as $row_page)
                    {

                        $sql="SELECT * FROM   tblblog_pages   INNER JOIN tblblog_pages_content     ON (tblblog_pages.pageID = tblblog_pages_content.pageID) where tblblog_pages.PIID=".$row_page->PIID." and tblblog_pages_content.pageID=".$row_page->pageID." and tblblog_pages_content.category='".$row->id."' group by tblblog_pages_content.contentID order by tblblog_pages_content.order";
                        $query2 = $this->db->query($sql);     
                        foreach ($query2->result() as $row2) 
                              {                
                              $content.=$this->wrapper->setData($row2->contentID,$row2->type,$row2->title,$row2->content,$row2->order);           
                              } 

                    }
                
                
                
                }

            $content.='</div></div>';   
            }
            
        
        return $style.'</style> '.$html.'</nav></div>'.$content;
        
        }
        
                             
}
?>
