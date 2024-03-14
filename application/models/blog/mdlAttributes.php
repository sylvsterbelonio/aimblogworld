<?php
class mdlAttributes extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
        }

    function validateValue($value,$valValue)
        {
        if($valValue=="string") return "'$value'";
        else return $value;
        }

    function getSliceBoxAttr($contentID)
        {
        $html   =   "";
        $query = $this->db->get_where('tblblog_pages_content_attributes', array('type'=>'slicebox', 'contentID' => $contentID,'PIID' => $this->config->item('gpiid')));
        if ($query->num_rows() >= 1)
            { 
                foreach ($query->result() as $row)
                {        
                $html.= $row->attrName.":".$this->validateValue($row->attrValue,$row->attrValueType).",";
                }                
            }
        else
            {
            $query = $this->db->get_where('tblblog_pages_content_attributes', array('type'=>'slicebox', 'contentID' => 0,'PIID' => 0));
                foreach ($query->result() as $row)
                {        
                $html.= $row->attrName.":".$this->validateValue($row->attrValue,$row->attrValueType).",";
                }              
            }        
        return $html;
        }
   function getBxSliderAttr($contentID)
        {
        $html   =   "";
        $query = $this->db->get_where('tblblog_pages_content_attributes', array('type'=>'bxslider', 'contentID' => $contentID,'PIID' => $this->config->item('gpiid')));
        if ($query->num_rows() >= 1)
            { 
                foreach ($query->result() as $row)
                {        
                $html.= $row->attrName.":".$this->validateValue($row->attrValue,$row->attrValueType).",";
                }                
            }
        else
            {
            $query = $this->db->get_where('tblblog_pages_content_attributes', array('type'=>'bxslider', 'contentID' => 0,'PIID' => 0));
                foreach ($query->result() as $row)
                {        
                $html.= $row->attrName.":".$this->validateValue($row->attrValue,$row->attrValueType).",";
                }              
            }        
        return $html;
        }        
       
}
?>
