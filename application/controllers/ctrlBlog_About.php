<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlBlog_About extends CI_Controller {

     function __construct() 
        { 
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session')); 
        $this->load->model('blog/mdlMetaProperties');          
        $this->load->model('blog/mdlAccounts');   
        $this->load->model('blog/mdlGeneral');
        $this->load->model('blog/mdlMenu');
        $this->load->model('blog/mdlCompany');
        $this->load->model("blog/mdlPages");
        $this->load->library("Language");
        $this->load->library("Validator");
        $this->load->library("Core");
        $this->load->database();
        }
        
     function company()
        {
        
        
        $Sitename = $this->uri->segment(1); // action
        $this->core->init();
        if($Sitename!="")
          {
          $PIID=$this->mdlAccounts->getAccountPIID($Sitename);           
          $this->core->setData($PIID,$Sitename);             
          }
        
        
        $this->load->view('blog/cssGlobal');
        $this->load->view('blog/header/header2'); 
        $this->load->view('controls/scrolltop/autoscrolltop');
        $this->load->view('blog/header/topbar');     
        $this->load->view('controls/menu/menu');   
        $this->load->view('controls/share/share');   
  
        $data["caption"]="Our Company";
        $this->load->view('blog/content/company/navheading',$data); 
        $data["link"]="";
        
        $this->load->view('blog/content/company/company_toolstrip');
        if(isset($_GET["link"])) $data["link"] = $_GET["link"]; 
        $this->load->view('blog/content/company/company',$data);  
        
        $this->load->view('blog/footer/footer');         
        }
        
     
     function board_of_directors()
        {
        
        
        
        
        $this->load->view('blog/cssGlobal');
        $this->load->view('blog/header/header2'); 
        $this->load->view('controls/scrolltop/autoscrolltop');
        $this->load->view('blog/header/topbar');     
        $this->load->view('controls/menu/menu');   
        
        $this->load->view('controls/share/share');   
        
        $data["caption"]="Board of Directors";
        $this->load->view('blog/content/company/navheading',$data);
        $this->load->view('blog/content/company/company_toolstrip');      
        $this->load->view('blog/content/company/boardofdirectors');
       
        $this->load->view('blog/footer/footer');         
        }   
        
     function company_partners()
        {
        $this->load->view('blog/cssGlobal');
        $this->load->view('controls/share/share');   
        $this->load->view('blog/header/header2'); 
        $this->load->view('controls/scrolltop/autoscrolltop');
        $this->load->view('blog/header/topbar');     
        $this->load->view('controls/menu/menu');   
        
      
        
        $data["caption"]="Business Partners";
        $this->load->view('blog/content/company/navheading',$data);           
        $this->load->view('blog/content/company/company_toolstrip');
        $this->load->view('blog/content/company/companypartners');
        
        $this->load->view('blog/footer/footer');  
        }   
        
     function alive_foundation()
        {
        //PERFECT CODE - BY GOD'S POWER!! JESUS CHRIST
        $this->load->view('blog/cssGlobal');
        $this->load->view('controls/share/share');   
        $this->load->view('blog/header/header2'); 
        $this->load->view('controls/scrolltop/autoscrolltop');
        $this->load->view('blog/header/topbar');     
        $this->load->view('controls/menu/menu');   
        
        $data["caption"]="Alive Foundation";
        $this->load->view('blog/content/company/navheading',$data);             
        $this->load->view('blog/content/company/company_toolstrip');
        $this->load->view('blog/content/company/alivefoundation');   
        $this->load->view('blog/footer/footer');
             
        }   
        
     function tie_ups()
        {
        $this->load->view('blog/cssGlobal');
        $this->load->view('controls/share/share');   
        $this->load->view('blog/header/header2'); 
        $this->load->view('controls/scrolltop/autoscrolltop');
        $this->load->view('blog/header/topbar');     
        $this->load->view('controls/menu/menu');   
        
        $data["caption"]="Alive Foundation";
        $this->load->view('blog/content/company/navheading',$data);             
        $this->load->view('blog/content/company/company_toolstrip');        
        $this->load->view("blog/content/company/tieups");
        }   
        
     function getData()
        {
        if(isset($_POST["title"]))
            {
            
               $type = $_POST["title"];
               if($type=="Company Profile") echo $this->mdlCompany->getData("company?link=Company%20Profile");
               else if($type=="The Right Business") echo  $this->mdlCompany->getData("company?link=The%20Right%20Business");
               else if($type=="Company Presentation") echo  $this->mdlCompany->getData("company?link=Company%20Presentation");
               else if($type=="Vision, Mission and Objectives") echo  $this->mdlCompany->getData("company?link=Vision,%20Mission%20and%20Objectives");
            }
        else
            {
                $this->load->view("errors/html/error_route");
            }
      
        }      
        
}        
?>
