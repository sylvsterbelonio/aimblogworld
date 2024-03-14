<?php
class mdlMetaProperties extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
        }
 
 public function getMeta($pageID)
        {
        $data=array();
        $query = $this->db->get_where('tblblog_pages', array('pageID' => $pageID));
        //CHECK IF THERE IS A PAGE EXIST IN THE tblblog_pages
        if ($query->num_rows() == 1)
        { 
            //CHECK IF THE PAGE IS EXIST IN THE tblblogs_language_lang
            //where [type] = "page".$pageID
            $query = $this->db->get_where('tblblogs_language_lang', array('type' => "page".$pageID));
            if ($query->num_rows() == 1)
                {
                    foreach ($query->result() as $row)
                    {
                    $data["title"]=$row->title;
                    $data["meta_image"]=$row->meta_image;
                    $data["meta_description"]=$row->meta_description;
                    $data["meta_keywords"]=$row->meta_keywords;
                    }
                    

                        $query2 = $this->db->get_where('tblpersonalinfo', array('PIID' => $this->config->item("gpiid")));
                         if ($query2->num_rows() == 1)
                            {
                            foreach ($query2->result() as $row)
                                {
                                $data["meta_author"] = $row->firstName." ".$row->middleName." ".$row->lastName;
                                }                   
                            }
                          else
                            {
                            $data["meta_author"]="Hummer~HUMMER The Solution Partner in Life";   
                            }
                        
                         
                
                
                }
            else
                {
                //LOAD THE DEFAULT META DATA!
                $query = $this->db->get_where('tblblogs_language_lang', array('category' => "meta", 'type' => "reset",'languageID'=>$this->config->item("glanguageID")));        
                //CHECK IF THERE IS A LANGUAGE AVAILABLE 
                if($query->num_rows()>0)
                {
                foreach ($query->result() as $row)
                  {

                    if($row->subtype=="title") $data["title"]=$row->value;
                    else if ($row->subtype=="image") $data["meta_image"]=$row->value;
                    else if ($row->subtype=="description") $data["meta_description"]=$row->value;
                    else if ($row->subtype=="keywords") $data["meta_keywords"]=$row->value;       
                    else if ($row->subtype=="author") $data["meta_author"]=$row->value;   
                    else if ($row->subtype=="icon") $data["icon"]=$row->value;              
                  }
                  
                  
                $query2 = $this->db->get_where('tblpersonalinfo', array('PIID' => $this->config->item("gpiid")));
                         if ($query2->num_rows() == 1)
                            {
                            foreach ($query2->result() as $row)
                                {
                                $data["meta_author"] = $row->firstName." ".$row->middleName." ".$row->lastName;
                                }                   
                            }
                          else
                            {
                            $data["meta_author"]=$data["meta_author"]=trim($row->value);  
                            }
                              
                  return $data;                       
                }
                else
                {
                //USE THE DEFAULT ENGLISH LANGUAGE//
                $query = $this->db->get_where('tblblogs_language_lang', array('category' => "meta", 'type' => "reset",'languageID'=>1));
                foreach ($query->result() as $row)
                  {
                    if($row->subtype=="title") $data["title"]=$row->value;
                    else if ($row->subtype=="image") $data["meta_image"]=$row->value;
                    else if ($row->subtype=="description") $data["meta_description"]=$row->value;
                    else if ($row->subtype=="keywords") $data["meta_keywords"]=$row->value;   
                    else if ($row->subtype=="author") $data["meta_author"]=$row->value;   
                    else if ($row->subtype=="icon") $data["icon"]=$row->value;              
                  }              
                    return $data;         
                }  
                }
        }     
        else
        {
        //LOAD THE DEFAULT META DATA!
        $query = $this->db->get_where('tblblogs_language_lang', array('category' => "meta", 'type' => "reset",'languageID'=>$this->config->item("glanguageID")));
                        //CHECK IF THERE IS A LANGUAGE AVAILABLE 
            if($query->num_rows()>0)
            {
                foreach ($query->result() as $row)
                  {
                    if($row->subtype=="title") $data["title"]=$row->value;
                    else if ($row->subtype=="image") $data["meta_image"]=$row->value;
                    else if ($row->subtype=="description") $data["meta_description"]=$row->value;
                    else if ($row->subtype=="keywords") $data["meta_keywords"]=$row->value;   
                    else if ($row->subtype=="author") $data["meta_author"]=$row->value;  
                    else if ($row->subtype=="icon") $data["icon"]=$row->value;              
                  }                   
             return $data;           
            }
            else
            {
                //USE THE DEFAULT ENGLISH LANGUAGE//
                $query = $this->db->get_where('tblblogs_language_lang', array('category' => "meta", 'type' => "reset",'languageID'=>1));
                foreach ($query->result() as $row)
                  {
                    if($row->subtype=="title") $data["title"]=$row->value;
                    else if ($row->subtype=="image") $data["meta_image"]=$row->value;
                    else if ($row->subtype=="description") $data["meta_description"]=$row->value;
                    else if ($row->subtype=="keywords") $data["meta_keywords"]=$row->value;   
                    else if ($row->subtype=="author") $data["meta_author"]=$row->value;   
                    else if ($row->subtype=="icon") $data["icon"]=$row->value;              
                  }              
                    return $data;              
            }
        }
        return $data;       
        }
}
?>
