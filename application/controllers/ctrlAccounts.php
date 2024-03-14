<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlAccounts extends CI_Controller {

        function __construct() { 
        parent::__construct();
        
        $this->load->model('mdlSystemuser');
        $this->load->model('mdlAdmin');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));	
        $this->load->database();
        }
        
        

        
}
?>
