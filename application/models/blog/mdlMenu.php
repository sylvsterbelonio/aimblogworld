<?php
class mdlMenu extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
                $this->load->library('Crypt');
                $this->load->library('Server');
        }

     function getProducts($pcid,$html)
        {
        $html.='<ul>'; 
        $sql = "SELECT PID, productName, tblproduct.pageID, url FROM  tblblog_pages  right JOIN  tblproduct    ON (tblblog_pages.pageID = tblproduct.pageID)  where pcid=$pcid order by productName";  
        $query = $this->db->query($sql);  
        foreach ($query->result_array() as $row) 
              { 
              $html.='<li><a href="'.$this->setSiteName($row["url"]).'">'.$row["productName"].'</a></li>';
              }                      
        $html.='</ul></li>';
        return $html;        
        }
     
     function getProductCategory($html)
        {
         
        $html.='<ul>';        
        $sql = "select PCID,categoryName,url FROM  tblblog_pages  right JOIN  tblproduct_category   ON (tblblog_pages.pageID = tblproduct_category.pageID)";  
        $query = $this->db->query($sql);          
        foreach ($query->result_array() as $row) 
              {  
              $encrypted = $this->crypt->encrypt($row["categoryName"]); 
              
              $sql = "select * from  tblproduct where pcid=".$row["PCID"]." order by productName";  
              $query = $this->db->query($sql);  
              if ($query->num_rows()>0)
                  {
                  
                  if($this->server->validateSiteName())  $html.='<li><a href="'.$this->server->base_url().$this->config->item("sitename").'/shop/'.$row["url"].'?search='.$encrypted.'">'.$row["categoryName"].'</a>';
                  else  $html.='<li><a href="'.$this->server->base_url().'shop/'.$row["url"].'?search='.$encrypted.'">'.$row["categoryName"].'</a>';
                           
                  $html=$this->getProducts($row["PCID"],$html);                  
                  }
              else
                  {
                  
                  if($this->server->validateSiteName()) $html.='<li><a href="'.$this->server->base_url().$this->config->item("sitename").'shop/'.$row["url"].'?search='.$encrypted.'">'.$row["categoryName"].'</a></li>';
                  else $html.='<li><a href="'.$this->server->base_url().'shop/'.$row["url"].'?search='.$encrypted.'">'.$row["categoryName"].'</a></li>';
                  
                  }
              }        
        $html.='</ul></li>';
        return $html;
        }
     
     function getSubMenus($parents, $html)
        {
        $html.='<ul>';
        $sql = "select * from tblblog_pages where parents = ".$parents." and PIID=".$this->config->item("gpiid")." order by `order`";  
        $query = $this->db->query($sql);  

        foreach ($query->result_array() as $row) 
              {
              $sql = "select * from tblblog_pages where parents = ".$row["pageID"]." and PIID=".$this->config->item("gpiid")." order by `order`";  
              $query = $this->db->query($sql); 
              if ($query->num_rows()>0)
                {
                $html.='<li><a href="'.$this->setSiteName($row["url"]).'">'.$row["title"].'</a>';   
                $html=$this->getSubMenus($row["pageID"],$html);
                }
              else
                {
                $html.='<li><a href="'.$this->setSiteName($row["url"]).'">'.$row["title"].'</a></li>';                
                }                            
              }   
         $html.='</ul>';     
         $html.='</li>';
         
         return $html;    
        }
     
     function setSiteName($url)
        {
        
        if($this->config->item("sitename")!="company" && $this->config->item("sitename")!="learnmore")
            {
            if($this->server->validateSiteName()) return $this->server->base_url().$this->config->item("sitename").'/'.$url;
            else return $this->server->base_url().$url;               
            }
        else
            {
            return $this->server->base_url().$url;     
            }
        
         
        }
     
     function getMenu()
        {
        
        $Sitename=$this->config->item("sitename");
        $userLevelID=0; //this is default data
        
        $html='<nav id="menu-wrap">';
        $html.='<ul id="menu">';
     
        
        $sql = "select * from tblblog_pages where parents=0 and PIID=".$this->config->item("gpiid")." order by `order`";  
      	$query = $this->db->query($sql); 
      	
        foreach ($query->result_array() as $row) 
              {
              $sql = "select * from tblblog_pages where parents = ".$row["pageID"]." and PIID=".$this->config->item("gpiid")." order by `order`";  
              $query = $this->db->query($sql); 
              if ($query->num_rows()>0)
                {
                $html.='<li><a href="'.$this->setSiteName($row["url"]).'">'.$row["title"].'</a>';   
                $html=$this->getSubMenus($row["pageID"],$html);
                }
              else
                {
                $html.='<li><a href="'.$this->setSiteName($row["url"]).'">'.$row["title"].'</a></li>';                
                }
              }        
        
        $html.='	</ul>';
        $html.='</nav>';   
        
        return $html;       
        }
             
        
}
?>
