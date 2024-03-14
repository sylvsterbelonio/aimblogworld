<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlTheme extends CI_Controller {

 function __construct() 
        { 
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));
        $this->load->database();
        }

    function index() 
        {
        //none
        
        $this->load->view('body/multiUpload'); 
        }
        
    function getForm()
        { 
        $this->load->view('body/menu/vThemes'); 
        }     

         
         
         
         
         
         
         
         
                
     
}       
        
?>
