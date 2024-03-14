<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Server {
    
    function base_url()
        {
        $CI =& get_instance();
        $CI->load->database();
        $sql = "SELECT * from tblservername";  
        $query = $CI->db->query($sql);  
        foreach ($query->result() as $row) 
              {
              return $row->base_url;
              }
        }
    
    function validateSiteName()
        {
        $CI =& get_instance();
        if($CI->config->item("sitename")!="")
            {
            if($CI->config->item("sitename")!="shop") return true;
            else false;            
            }
        else
            {
            return false;
            }
        }          
}

?>
