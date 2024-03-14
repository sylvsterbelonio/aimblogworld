<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Core{
      
    public function __construct()
    {
     $this->CI =& get_instance();
    }
    
    public function init()
    {
    $this->CI->load->model('blog/mdlAccounts');
    $this->CI->load->library(array('form_validation','session'));
    $this->CI->load->helper(array('form', 'url'));
         if($this->CI->session->has_userdata('customerID') && $this->CI->session->has_userdata('PIID'))
        {
         //INIATIALIZE GLOBAL VARIABLES IF SESSION IS EXIST
         $this->CI->config->set_item('gthemeID',$this->CI->mdlAccounts->getThemeID($this->CI->session->userdata('PIID')));
         $this->CI->config->set_item('gcustomerID',$this->CI->session->userdata('customerID')); 
         $this->CI->config->set_item('gpiid',$this->CI->session->userdata('PIID'));
         $this->CI->config->set_item("gsitename",$this->CI->mdlAccounts->getSiteName($this->CI->session->userdata('PIID')));
        }        
        else
        {
         //IF SESSION HAS BEEN EXPIRED, THEN BACK TO DEFAULT SETTINGS
         $this->CI->config->set_item('gthemeID',1);
         $this->CI->config->set_item('gcustomerID',0);
         $this->CI->config->set_item('gpiid',0);
         $this->CI->config->set_item('gsitename',"");
        }    
    }
    
    public function setData($piid,$sitename)
        {
          $this->CI->load->model('blog/mdlAccounts');
          $this->CI->config->set_item("sitename",$sitename);
          $this->CI->config->set_item("gpiid",$piid);
          $this->CI->config->set_item("gthemeID",$this->CI->mdlAccounts->getThemeID($piid));
        }
    
    public function setPIID($piid)
        {
        $this->CI->config->set_item('gpiid',$piid);
        }
    
    public function setSitename($sitename)
        {
        $this->CI->config->set_item('gsitename',$sitename);
        }
        
}

?>
