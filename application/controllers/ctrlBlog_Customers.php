<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlBlog_Customers extends CI_Controller {

     function __construct() 
        { 
        parent::__construct();
        
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));
        $this->load->model('blog/mdlCustomer');
        $this->load->model('blog/mdlAccounts');
        
        $this->load->model('blog/mdlItemSlider');
        $this->load->library("Language");
        
        $this->load->database();        
        }
                   
    function signOut()
        {
        
        if($this->session->has_userdata('PIID'))
        {
                $piid = $this->session->userdata('PIID');
                        
                if($piid!=""){
                $sitename = $this->mdlAccounts->getSiteName($piid);
                
                $this->session->unset_userdata('PIID');
                $this->session->unset_userdata('customerID');
                
                redirect(base_url().$sitename.'/shop','refresh');
                }
                else
                {
                redirect(base_url().'shop', 'refresh');
                }
        }

        
          
        //echo $pageURL;      

        //echo $this->someclass->some_function();
        } 
    
    function signIn()
        {
        $customerID =  $this->mdlCustomer->log_in_Customer($_POST["username"],$_POST["password"]);   
        
        if($customerID!="")
          {
          $col = explode("~",$customerID);
          
          //REGISTERING THE SESSION DATA OF THE CUSTOMERS//
          $this->session->set_userdata("customerID",$col[0]);
          $this->session->set_userdata("PIID",$col[1]);
            $sitename = $this->mdlAccounts->getSiteName($col[1]);
            //if($sitename!="")  redirect(base_url().$sitename.'/shop','refresh');
            //else redirect(base_url().'/shop','refresh');
          
          echo base_url().$sitename.'/shop';
          }
        else
          {
          echo $this->mdlCustomer->log_in_Customer($_POST["username"],$_POST["password"]);
          }
        
        }    
    
    function checkEmailExist()
        {
        echo $this->mdlCustomer->checkEmailDuplication($_POST["emailAddress"]);
        }
        
    function registerCustomer()
        {        
        $customerID = $this->mdlCustomer->add_Customer($_POST["piid"],0,$_POST["fname"],$_POST["mname"],$_POST["lname"],$_POST["address"],$_POST["contactNo"],$_POST["email"],$_POST["password"]);
        
        //REGISTERING THE SESSION DATA OF THE CUSTOMERS//
        $this->session->set_userdata("PIID",$_POST["piid"]);
        $this->session->set_userdata("customerID",$customerID);
               
        $sitename = $this->mdlAccounts->getSiteName($_POST["piid"]);
        if($sitename!="")  redirect(base_url().$sitename.'/shop','refresh');
        else redirect(base_url().'/shop','refresh');
 
        }
    
    function addLoveLike()
        {
        
        if($this->session->has_userdata("customerID"))
        {
        echo $this->mdlCustomer->hit_lovelike($_POST["refID"],"products",$_POST["sectionType"],$this->session->customerID,$this->session->PIID);
        }
        else
        {
        echo "no customer id";
        }
        
        
        }
    
    
    function form_registerCustomer()
        {
        
        
        }
        
   function errors()
   {
   $lang= $this->language->topbar("topbar");
   
   echo $lang["aimworld"];
   }
        
}
?>
