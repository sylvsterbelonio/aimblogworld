<?php
class mdlPages extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
                $this->load->library('Language');
                $this->load->library('Wrapper');
                $this->load->model("blog/mdlGeneral");
        }
        
 public function load($url)
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
        else
            {
            $sql="select * from tblblog_pages where url='$url' and PIID=0";
             $query = $this->db->query($sql);
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
        
   public function getPageURL($pageID)
        {
         $sql="select * from tblblog_pages where pageID=$pageID";
         $query = $this->db->query($sql);
          if($query->num_rows()>0)
              {
               foreach ($query->result() as $row)
                    {
                    return $row->url;
                    }
              }
          else
              {
              return "";
              }
        }     
   
}
?>
