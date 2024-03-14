<?php
class mdlErrors extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
                $this->load->library('Language');
        }
        
 public function invalidURL()
        {
        $data   =   array();
        $sql="select * from tblblogs_language_lang where category='errors-invalid url' and languageID=".$this->config->item("glanguageID");
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) 
            {
            if($row->type=="headers") $data["headers"] = $row->value;
            else if ($row->type=="content") $data["content"] = $row->value;
            else if ($row->type=="click") $data["click"] = $row->value;
            else if ($row->type=="home") $data["home"] = $row->value;
            }
        return $data;        
        }       
        
}        
?>
