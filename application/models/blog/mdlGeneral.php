<?php
class mdlGeneral extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
        }

    function getTheme()
        {
        $data   =   array();
        $themeID=1;
        $sql = "select * from tblthemes where PIID=".$this->config->item("gpiid");
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) 
            {        
            $themeID = $row->themeID;
            }
        
        $query = $this->db->get_where('tblthemes_general', array('themeID' => $themeID));
        //CHECK IF THE THEMES ARE EXIST IN THE tblthemes_general
        if ($query->num_rows() == 1)
        { 
            foreach ($query->result() as $row)
            {
               // echo $row->name; # THIS WORKS
                $data['backgroundImage'] = $row->backgroundImage;
                $data['BackColor'] = $row->BackColor;
                $data['nBackColor'] = $row->nBackColor;
                $data['nBorderColor'] = $row->nBorderColor;
                $data['hBackColor'] = $row->hBackColor;
                $data['pBackColor'] = $row->pBackColor;
                $data['bBackColor'] = $row->bBackColor;
                $data['dBackColor'] = $row->dBackColor;
                $data['nForeColor'] = $row->nForeColor;
                $data['hForeColor'] = $row->hForeColor;
                $data['nlinkColor'] = $row->nlinkColor;
                $data['hlinkColor'] = $row->hlinkColor;
                $data['maxWidth'] = $row->maxWidth;
                $data['container'] = $row->container;
                $data['container2'] = $row->container2;
                $data['errorBorder'] = $row->errorBorder;
                $data['errorBackground'] = $row->errorBackground;
            }
        }
        else
        {
        //IF NOT THEN THE DEFAULT THEME WILL BE LOADED.
        $query = $this->db->get_where('tblthemes_general', array('themeID' => 1));
        if ($query->num_rows() == 1)
        { 
            foreach ($query->result() as $row)
            {
               // echo $row->name; # THIS WORKS
                $data['backgroundImage'] = $row->backgroundImage;
                $data['BackColor'] = $row->BackColor;
                $data['nBackColor'] = $row->nBackColor;
                $data['nBorderColor'] = $row->nBorderColor;
                $data['hBackColor'] = $row->hBackColor;
                $data['pBackColor'] = $row->pBackColor;
                $data['bBackColor'] = $row->bBackColor;
                $data['dBackColor'] = $row->dBackColor;
                $data['nForeColor'] = $row->nForeColor;
                $data['hForeColor'] = $row->hForeColor;
                $data['nlinkColor'] = $row->nlinkColor;
                $data['hlinkColor'] = $row->hlinkColor;
                $data['maxWidth'] = $row->maxWidth;
                $data['container'] = $row->container;
                $data['container2'] = $row->container2;
                $data['errorBorder'] = $row->errorBorder;
                $data['errorBackground'] = $row->errorBackground;                
                
            }
        }        
        
        }
        
               
        
        return $data;
        }
    
    function getStyle($type)
        {
        $html="";
        $query = $this->db->get_where('tblthemes_style', array('themeID' => $this->config->item('gthemeID'),'element'=>$type));
        if ($query->num_rows() == 1)
        { 
            foreach ($query->result() as $row)
            {
                $html.=$row->property.":".$row->value.";";               
            }
        }
        else
        {
        $query = $this->db->get_where('tblthemes_style', array('themeID' => 1,'element'=>$type));        
            foreach ($query->result() as $row)
            {
                $html.=$row->property.":".$row->value.";";               
            }
        }
        return $html;        
        }             
}        
?>
