<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdlItemSlider extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
        }
 
 private function setSection($inc)
        {
        if($inc==0) return "I";
        else if($inc==1) return "II";
        else if($inc==2) return "III";
        else if($inc==3) return "IV";
        else "V";
        }      
        
 private function setFooter($inc,$type)
        {
        if($inc==0)
          {
           if($type=="citations") return "Citations & Accreditations - ";
          else return "Awards & Recognitions - ";          
          }
        } 
        
 public function getData($type)
        {
        
        $count=0;
        $sql="select * from tblthemes_itemslider where `type` = '$type' order by `order`";
        $query = $this->db->query($sql);
        
        $count=1;
        
        
        $notyetFill=0;
        $title="";
        $inc=0;
        
        
        $html="<ul>";
        $nav="";
        $i=0;
        foreach ($query->result() as $row)        
          {
            if($count % 5 ==0 && $count>0)
                {
                $html.='
              					<li><img src="'.base_url().$row->imageUrl.'" alt="img'.$row->order.'"><h4>'.$row->name.'</h4></a></li>
              					</ul>
                        <ul>
                        ';
                $nav.='<a href="#">'.$this->setFooter($inc,$type).' '.$this->setSection($inc).'</a>';
                $notyetFill=0;
                $inc++;
                }
            else
                {
                $html.='<li><img src="'.base_url().$row->imageUrl.'" alt="img'.$row->order.'"><h4>'.$row->name.'</h4></a>';
                $notyetFill=1;
                }
                
          $count++;
          
          }
          $html.='</ul>';
          
          
          if($notyetFill) $html.='<nav>'.$nav.'<a href="#">'.$this->setFooter($inc,$type).' '.$this->setSection($inc).'</a></nav>';
          else $html.='<nav>'.$nav.'</nav>';
        
        return $html;
        }      
      
}        
