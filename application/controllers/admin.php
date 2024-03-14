<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

        function __construct() { 
        parent::__construct();
        
        $this->load->model('mdlSystemuser');
        $this->load->model('mdlAdmin');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));	
        $this->load->database();
        }
	
        public function index()
        {
        
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];
        
        $data['title'] = 'Aim Global Alliance Personal Blog Site';   
        $this->load->view('header/header',$data);
        $this->load->view('body/myadmin');
        $this->load->view('footer/footer');
        }
        
        
        public function getAccordionMenu()
        {
        $ret = $this->mdlAdmin->getAccordionMenu($_POST['usr'],$_POST['idf']); 
        echo $ret;
        }
       
}

?>
