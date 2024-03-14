<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Validator {

  function validatePage($page)
      {
      $CI =& get_instance();
      $CI->load->view("errors/html/error_route");
      
      if($page!='false')
          {
          return $page;
          }
      else
          {
          return $CI->load->view("errors/html/error_route");
          }
      }
  
   function validateSource($value)
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
  
   function checkCharExist($content,$filter)
          {
          if (strpos($content, $filter) !== false) return true;
          else return false;
          }
      
}
?>
