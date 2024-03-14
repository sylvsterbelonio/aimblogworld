<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlBlog_Admin extends CI_Controller {

     function __construct() 
        { 
        parent::__construct();
        
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));    
        $this->load->model('blog/mdlMetaProperties');  
        $this->load->database();        
        
        }
        
     function index()
     {
     $this->load->view("blog/admin/header");
      //$this->load->view("blog/admin/login");
     $this->load->view("blog/admin/panel");
     $this->load->view("blog/admin/footer");
     }
}
?>
