<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Language {

    public function __construct()
    {
     $this->CI =& get_instance();
     $this->CI->load->database();
    }
    
    public function lang($langID)
    {
    $this->CI->load->helper(array('form', 'url'));
    $this->CI->load->model('blog/mdlAccounts');
    $sql = "select * from tblblogs_language_lang where langID=$langID and languageID=".$this->CI->config->item("glanguageID");
        $query = $this->CI->db->query($sql);
        if($query->num_rows()>0)
          {
          foreach ($query->result() as $row) 
              {
              return $row->value;
              }   
          }
        else
          {
          $sql = "select * from tblblogs_language_lang where langID=$langID and langID=1";  
          $query = $this->CI->db->query($sql);   
              foreach ($query->result() as $row) 
              {
              return $row->value;
              } 
          }
    return "Not Encoded!";
    }
    
    public function topbar($category)
    {
    $data=array();
    $sql="select * from tblblogs_language_lang where category='$category' and languageID=".$this->CI->config->item("glanguageID");
    $query = $this->CI->db->query($sql);
    //CHECK IF THERE IS AVAILABLE LANGUAGE TO CONVERT
      if($query->num_rows()>0)
          {
          foreach ($query->result() as $row) 
              {
                  if($row->type=="aimglobal") $data["aimglobal"]=$row->value;
                  else if($row->type=="dtc") $data["dtc"]=$row->value;
                  else if($row->type=="aimcademy") $data["aimcademy"]=$row->value;
                  else if($row->type=="aimworld") $data["aimworld"]=$row->value;
                  else if($row->type=="register") $data["register"]=$row->value;
                  else if($row->type=="signout") $data["signout"]=$row->value;
                  else if($row->type=="signin") $data["signin"]=$row->value;
                  else if($row->type=="welcome") $data["welcome"]=$row->value;
                  else if($row->type=="guest") $data["guest"]=$row->value;
                  else if($row->type=="powered") $data["powered"]=$row->value;
                  else if($row->type=="contact") $data["contact"]=$row->value;     
                  else if($row->type=="wishlist") $data["wishlist"]=$row->value;               
              }

          }
      else
          {
          //THE DEFAULT LANGUAGE TO LOAD IF EVER NO MORE OTHER LANGUAGE
          $sql="select * from tblblogs_language_lang where category='$category' and languageID=1";
          $query = $this->CI->db->query($sql);  
          //CHECK IF THERE IS A DEFAULT LANGUAGE
          if($query->num_rows()>0)
          {
              foreach ($query->result() as $row) 
              {
                  if($row->type=="aimglobal") $data["aimglobal"]=$row->value;
                  else if($row->type=="dtc") $data["dtc"]=$row->value;
                  else if($row->type=="aimcademy") $data["aimcademy"]=$row->value;
                  else if($row->type=="aimworld") $data["aimworld"]=$row->value;
                  else if($row->type=="register") $data["register"]=$row->value;
                  else if($row->type=="signout") $data["signout"]=$row->value;
                  else if($row->type=="signin") $data["signin"]=$row->value;
                  else if($row->type=="welcome") $data["welcome"]=$row->value;
                  else if($row->type=="guest") $data["guest"]=$row->value;
                  else if($row->type=="powered") $data["powered"]=$row->value;  
                  else if($row->type=="contact") $data["contact"]=$row->value;     
                  else if($row->type=="wishlist") $data["wishlist"]=$row->value;                              
              }            
          }
          else
          {
          
         
          }
        
      
          }    
     return $data;    
    }
    
    public function slidingtext($category)
    {
    $data=array();
    $sql="select * from tblblogs_language_lang where category='$category' and languageID=".$this->CI->config->item("glanguageID");
    $query = $this->CI->db->query($sql);    
    //CHECK IF THERE IS AVAILABLE LANGUAGE TO CONVERT
      if($query->num_rows()>0)
          {
          foreach ($query->result() as $row) 
              {
                  if($row->type=="1st") $data["1st"]=$row->value;
                  else if($row->type=="2nd") $data["2nd"]=$row->value;
                  else if($row->type=="3rd") $data["3rd"]=$row->value;
                  else if($row->type=="4th") $data["4th"]=$row->value;            
              }

          }
      else
          {
          //THE DEFAULT LANGUAGE TO LOAD IF EVER NO MORE OTHER LANGUAGE
          $sql="select * from tblblogs_language_lang where category='$category' and languageID=1";
          $query = $this->CI->db->query($sql);  
          //CHECK IF THERE IS A DEFAULT LANGUAGE
          if($query->num_rows()>0)
          {
              foreach ($query->result() as $row) 
              {
                  if($row->type=="1st") $data["1st"]=$row->value;
                  else if($row->type=="2nd") $data["2nd"]=$row->value;
                  else if($row->type=="3rd") $data["3rd"]=$row->value;
                  else if($row->type=="4th") $data["4th"]=$row->value;                                
              }            
          }
          else
          {

          }          
          }    
    return $data;    
    }


}

?>
