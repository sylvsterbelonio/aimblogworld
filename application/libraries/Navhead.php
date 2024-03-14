<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Navhead {

      function checkCharExist($content,$filter)
          {
          if (strpos($content, $filter) !== false) return true;
          else return false;
          }
          
      function setData($category,$division,$section)
            {
              $CI =& get_instance();
              $CI->load->library("Url");
              $CI->load->library("Server");
              $CI->load->model("blog/mdlAccounts");
              
              if($category!="" && $division!="" && $section!=""){
              $html="";
              $category_link = $CI->server->base_url();
              
                  if($this->checkCharExist($category,"["))
                      {
                       $col = explode("[",$category);
                       $mcol = str_replace("]","",$col[1]);
                       $src=$CI->url->getimgURL($mcol);    
                       
                       if($CI->config->item("sitename")!=$mcol && $CI->config->item("sitename")!="")
                          {
                           $category_link = base_url().$CI->config->item("sitename").'/'.$mcol;
                           $html='<div><a href="'.base_url().$CI->config->item("sitename").'"><span class="nav-text">Home</span></a><span></div>';   
                           $html.='<div><img oncontextmenu="return false;" src=\''.base_url().'images/system/arrowright.png\' style="float:left"><a href="'.$CI->server->base_url().$CI->config->item("sitename").'/'.$mcol.'"><span class="nav-text">'.$col[0].'</span></a></div>';  
                          }
                       else 
                          {
                           $category_link = $src;
                           $html='<div><a href="'.$CI->server->base_url().'"><span class="nav-text">Home</span></a><span></div>';  
                           $html.='<div><img oncontextmenu="return false;" src=\''.$CI->server->base_url().'images/system/arrowright.png\' style="float:left"><a href="'.$src.'"><span class="nav-text">'.$col[0].'</span></a></div>'; 
                          }   
                      }
                  else
                      {
                      $html='<div><a href="'.$CI->server->base_url().$CI->config->item("sitename").'"><span class="nav-text">Home</span></a><span></div>'; 
                      $html.= '<div><img oncontextmenu="return false;" src=\''.$CI->server->base_url().'images/system/arrowright.png\' style="float:left"><span class="nav-text">'.$category.'</span></div>';  
                      }              
              
              $division_link = $CI->server->base_url();
              $division_url="";
                  if($this->checkCharExist($division,"["))
                      {
                       $col = explode("[",$division);
                       $mcol = str_replace("]","",$col[1]);
                       $division_url = $mcol;
                       $src=$CI->url->getimgURL($mcol);    
                       
                       if($CI->config->item("sitename")!=$mcol)
                          {
                           $division_link = base_url().$CI->config->item("sitename").'/'.$mcol;  
                           $html.='<div><img oncontextmenu="return false;" src=\''.base_url().'images/system/arrowright.png\' style="float:left"><a href="'.$category_link.'/'.$mcol.'"><span class="nav-text">'.$col[0].'</span></a></div>';  
                          }
                       else 
                          {
                           $division_link = $src;
                          
                          $html.='<div><img oncontextmenu="return false;" src=\''.$CI->base_url().'images/system/arrowright.png\' style="float:left"><a href="'.$src.'"><span class="nav-text">'.$col[0].'</span></a></div>'; 
                          }   
                      }
                  else
                      {
                      $html.= '<div><img oncontextmenu="return false;" src=\''.base_url().'images/system/arrowright.png\' style="float:left"><span class="nav-text">'.$division.'</span></div>';  
                      }                 
              
              
              $section_link = $CI->server->base_url();
              
                  if($this->checkCharExist($section,"["))
                      {
                       $col = explode("[",$section);
                       $mcol = str_replace("]","",$col[1]);
 
                       
                       if($CI->config->item("sitename")!=$mcol)
                          {
                           $section_link = $category_link.'/'.$division_url.'/'.$mcol;  
                           $html.='<div><img oncontextmenu="return false;" src=\''.base_url().'images/system/arrowright.png\' style="float:left"><a href="'.$section_link.'"><span class="nav-text">'.$col[0].'</span></a></div>';  
                          }
                       else 
                          {
                          $section_link = base_url().$CI->config->item("sitename").'/'.$division_link.'/'.$mcol; 
                          
                          //$html.='<div><img oncontextmenu="return false;" src=\''.$CI->base_url().'images/system/arrowright.png\' style="float:left"><a href="'.$section_link.'"><span class="nav-text">'.$col[0].'</span></a></div>'; 
                          }   
                      }
                  else
                      {
                      $html.= '<div><img oncontextmenu="return false;" src=\''.base_url().'images/system/arrowright.png\' style="float:left"><span class="nav-text">'.$section.'</span></div>';  
                      }               
              

              
                 return $html;
              } 
              else if($category!="" && $division!="") 
              {
              $html="";
              $category_link = $CI->server->base_url();
              
                  if($this->checkCharExist($category,"["))
                      {
                       $col = explode("[",$category);
                       $mcol = str_replace("]","",$col[1]);
                       $src=$CI->url->getimgURL($mcol);    
                       
                       if($CI->config->item("sitename")!=$mcol && $CI->config->item("sitename")!="")
                          {
                           $category_link = base_url().$CI->config->item("sitename").'/'.$mcol;
                           $html='<div><a href="'.base_url().$CI->config->item("sitename").'"><span class="nav-text">Home</span></a><span></div>';   
                           $html.='<div><img oncontextmenu="return false;" src=\''.base_url().'images/system/arrowright.png\' style="float:left"><a href="'.$CI->server->base_url().$CI->config->item("sitename").'/'.$mcol.'"><span class="nav-text">'.$col[0].'</span></a></div>';  
                          }
                       else 
                          {
                           $category_link = $src;
                           $html='<div><a href="'.$CI->server->base_url().'"><span class="nav-text">Home</span></a><span></div>';  
                           $html.='<div><img oncontextmenu="return false;" src=\''.$CI->server->base_url().'images/system/arrowright.png\' style="float:left"><a href="'.$src.'"><span class="nav-text">'.$col[0].'</span></a></div>'; 
                          }   
                      }
                  else
                      {
                      $html.= '<div><img oncontextmenu="return false;" src=\''.$CI->server->base_url().'images/system/arrowright.png\' style="float:left"><span class="nav-text">'.$category.'</span></div>';  
                      }              
              
              $division_link = $CI->server->base_url();
              
                  if($this->checkCharExist($division,"["))
                      {
                       $col = explode("[",$division);
                       $mcol = str_replace("]","",$col[1]);
                       $src=$CI->url->getimgURL($mcol);    
                       
                       if($CI->config->item("sitename")!=$mcol)
                          {
                           $division_link = base_url().$CI->config->item("sitename").'/'.$mcol;  
                           $html.='<div><img oncontextmenu="return false;" src=\''.base_url().'images/system/arrowright.png\' style="float:left"><a href="'.$category_link.'/'.$mcol.'"><span class="nav-text">'.$col[0].'</span></a></div>';  
                          }
                       else 
                          {
                           $division_link = $src;
                          
                          $html.='<div><img oncontextmenu="return false;" src=\''.$CI->base_url().'images/system/arrowright.png\' style="float:left"><a href="'.$src.'"><span class="nav-text">'.$col[0].'</span></a></div>'; 
                          }   
                      }
                  else
                      {
                      $html.= '<div><img oncontextmenu="return false;" src=\''.base_url().'images/system/arrowright.png\' style="float:left"><span class="nav-text">'.$division.'</span></div>';  
                      }                 
                 
                 return $html;
              
              }
                    
              else if($category!="")
              {
                  if($this->checkCharExist($category,"["))
                      {
                       $col = explode("[",$category);
                       $mcol = str_replace("]","",$col[1]);
                       $src=$CI->url->getimgURL($mcol);    
                       
                       if($CI->config->item("sitename")!=$mcol && $CI->config->item("sitename")!="")
                       {
                       $html='<div><a href="'.$CI->server->base_url().$CI->config->item("sitename").'"><span class="nav-text">Home</span></a><span></div>';   
                       return $html.'<div><img src=\''.$CI->server->base_url().'images/system/arrowright.png\' style="float:left"><a href="'.base_url().$CI->config->item("sitename").'/'.$mcol.'"><span class="nav-text">'.$col[0].'</span></a></div>';  
                       }
                       else 
                       {
                       $html='<div><a href="'.$CI->server->base_url().'"><span class="nav-text">Home</span></a><span></div>';  
                       return $html.'<div><img src=\''.$CI->server->base_url().'images/system/arrowright.png\' style="float:left"><a href="'.$src.'"><span class="nav-text">'.$col[0].'</span></a></div>'; 
                       } 
                      }
                  else
                      {
                      
                       $html="";

                        
                       if($CI->mdlAccounts->checkAccountSite($CI->config->item("sitename")))
                       {
                       $html='<div><a href="'.$CI->server->base_url().$CI->config->item("sitename").'"><span class="nav-text">Home</span></a><span></div>';  
                       }
                       else 
                       {
                       $html='<div><a href="'.$CI->server->base_url().'"><span class="nav-text">Home</span></a><span></div>';  
                       }                       
                      
              
                      return $html.'<div><img src=\''.$CI->server->base_url().'images/system/arrowright.png\' style="float:left"><span class="nav-text">'.$category.'</span></div>';  
                      }
            
              }

              
              else return '<div><img src=\''.base_url().'images/system/arrowright.png\' style="float:left"><span class="nav-text">'.$category.'</span></div>';            
            
            }


}


?>
