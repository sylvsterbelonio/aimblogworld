<?php
class mdlLearnMore extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
                $this->load->library('Crypt');
                $this->load->library('Url');
                $this->load->library('Wrapper');
        }
 
 public function getLearnMore($url)
        {
        $data = array();
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
                                  if($row->category=="product-presentation" && $row->type=="image" ) $data["product-presentation-img"] = $this->wrapper->setData($row->contentID,$row->type,$row->title,$row->content,$row->order);
                                  if($row->category=="product-presentation" && $row->type=="h3" ) $data["product-presentation-h3"] = $this->wrapper->setData($row->contentID,$row->type,$row->title,$row->content,$row->order);

                                  if($row->category=="company-policy" && $row->type=="image" ) $data["company-policy-img"] = $this->wrapper->setData($row->contentID,$row->type,$row->title,$row->content,$row->order);
                                  if($row->category=="company-policy" && $row->type=="h3" ) $data["company-policy-h3"] = $this->wrapper->setData($row->contentID,$row->type,$row->title,$row->content,$row->order);

                                  if($row->category=="aim-global-trainings" && $row->type=="image" ) $data["aim-global-trainings-img"] = $this->wrapper->setData($row->contentID,$row->type,$row->title,$row->content,$row->order);
                                  if($row->category=="aim-global-trainings" && $row->type=="h3" ) $data["aim-global-trainings-h3"] = $this->wrapper->setData($row->contentID,$row->type,$row->title,$row->content,$row->order);
                                                   
                              }
                        }              
            }
        else
            {
            $data["product-presentation-img"]=base_url()."images/system/noimage.jpg";
            $data["product-presentation-h3"]="";
            $data["company-policy-img"]=base_url()."images/system/noimage.jpg";
            $data["company-policy-h3"]="";
            $data["aim-global-trainings-img"] = base_url()."images/system/noimage.jpg";
            $data["aim-global-trainings-h3"]="";
            }        
        return $data;
        }
        
}
?>
