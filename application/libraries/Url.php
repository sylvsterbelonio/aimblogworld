<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Url {

          function checkCharExist($content,$filter)
          {
          if (strpos($content, $filter) !== false) return true;
          else return false;
          }

          function getURL()
          {
              $CI =& get_instance();
          
              $url = $CI->config->site_url($CI->uri->uri_string());
              return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
          }
          
          function setAccountURL($preSite)
          {   
              $CI =& get_instance();
              if($CI->config->item("sitename")!="shop") return $CI->config->item("sitename").'/'.$preSite;
              else return $preSite;
          }
          
          function getimgURL($value)
          {
          $CI =& get_instance();
          $CI->load->library('Core');
          
          if (strpos($value, 'http') !== false) 
              {
              return $value;
              }
          else
              {
              
              return $CI->server->base_url().$value;
              }
          }

          function getpdfURL($value)
          {
          $CI =& get_instance();
          $CI->load->library('Core');
          
          if (strpos($value, 'http') !== false) 
              {
              return $value;
              }
          else
              {
              
              return $CI->server->base_url().$value;
              }
          }

          function getSiteSource_Category($category,$filter,$site)
              {
              $CI =& get_instance();
              $CI->load->library("Server");
              $url = $CI->server->base_url();
              $col = explode(",",$filter);
              
              $blnFound=true;
              $value="";
              for($i=0;$i<count($col);$i++)
                  {
                  if($site==$col[$i]) 
                  {$blnFound=false;$value=$col[$i];}
                  }
               
              if($blnFound==true) {return $url.$category.'/'.$CI->config->item("sitename")."/$site";}
              else
              {
              if($CI->config->item("sitename")!=$site) return $category.'/'.$site;
              else return $url.$category.'/'.$site;
              }
  
              }
                                  
          function getSiteSource($filter,$site)
              {
              $CI =& get_instance();
              $CI->load->library("Server");
              $url = $CI->server->base_url();
              $col = explode(",",$filter);
              
              $blnFound=true;
              $value="";
              for($i=0;$i<count($col);$i++)
                  {
                  if($site==$col[$i]) 
                  {$blnFound=false;$value=$col[$i];}
                  }
               
              if($blnFound==true) {return $url.$CI->config->item("sitename")."/$site";}
              else
              {
              if($CI->config->item("sitename")!=$site) return $site;
              else return $url.$site;
          
              }
               
              
              }
              
          function getSiteSourcePost($filter,$site)
              {
              $CI =& get_instance();
              $CI->load->library("Server");
              $url = $CI->server->base_url();
      
              if($filter!=$CI->config->item("sitename")) return $url.$CI->config->item("sitename")."/".$site;
              else return $url.$site;

              }   
        
        function getNavSource($filter)
              {
              $CI =& get_instance();          
              $sitename = $this->getURL();            
              return  $this->getSegmentURL($filter);      
              }
      
       private function getSegmentURL($filter)
              {
              //0 = homepage url
              //1 = 1st segment
              //2 = 2nd method
              $CI =& get_instance();
              $CI->load->library("Server");
              $url = $CI->server->base_url();
              
              $sitename = $this->getURL();
              $col = explode("/",$sitename);
              $sitename2="";
              for($i=count($col)-1;$i>=0;$i--)
                  {
                  if($i==count($col)-1) $sitename2=$col[$i];
                  else $sitename2.="~".$col[$i];
                  }                 
          
              $col = explode("~",$sitename2);
              
              if($col[1]!=$filter) return $url.$CI->config->item("sitename")."/".$col[1];
              else return $url.$col[1];
              
              }      

}
?>
