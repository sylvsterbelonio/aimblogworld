<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlBlog_Learnmore extends CI_Controller {

     function __construct() 
        { 
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('blog/mdlGeneral');
        $this->load->library(array('form_validation','session'));        
        $this->load->model('blog/mdlMetaProperties');  
        $this->load->model('blog/mdlShopProducts');
        $this->load->model('blog/mdlMenu');     
        $this->load->model("blog/mdlVideoSearch");
        $this->load->model("blog/mdlPages");
         $this->load->model("mdlSystemuser");
        $this->load->model('mdlProduct');
        $this->load->library('Validator');
        $this->load->library('Number');
        $this->load->library('Navhead');
        $this->load->model("blog/mdlLearnMore");
        $this->load->library('Core');
        $this->load->library("Language");       
        $this->load->library("Url"); 
        
        $this->load->database();
        }
        
      function index()
        {
        
        //IMPORTANT TO UPDATE SITES NAME URL//
        $Sitename = $this->uri->segment(1);$this->core->init();if($Sitename!=""){$PIID=$this->mdlAccounts->getAccountPIID($Sitename);           $this->core->setData($PIID,$Sitename);}
        //////////////////////////////////////
        
        $this->load->view('blog/cssGlobal');
        $this->load->view('controls/share/share');   
        $this->load->view('blog/header/header2'); 
        $this->load->view('controls/scrolltop/autoscrolltop');
        $this->load->view('blog/header/topbar');     
        $this->load->view('controls/menu/menu');   
        
        $data["category"]="Learn More";
        $this->load->view('blog/content/learnmore/navheading',$data); 
        $this->load->view('blog/content/learnmore/learnmore');
        $this->load->view('blog/footer/footer'); 
        
        }
        
      function productPresentation()
        {
        //IMPORTANT TO UPDATE SITES NAME URL//
        $Sitename = $this->uri->segment(1);$this->core->init();if($Sitename!=""){$PIID=$this->mdlAccounts->getAccountPIID($Sitename);           $this->core->setData($PIID,$Sitename);}
        //////////////////////////////////////
                   
        $this->load->view('blog/cssGlobal');
        $this->load->view('controls/share/share');   
        $this->load->view('blog/header/header2'); 
        $this->load->view('controls/scrolltop/autoscrolltop');
        $this->load->view('blog/header/topbar');     
        $this->load->view('controls/menu/menu');   
        
        $data["category"]="Learn More[learnmore]";
        $data["division"]="Product Presentation";
        $this->load->view('blog/content/learnmore/navheading',$data); 
        $this->load->view('blog/content/learnmore/videoSearch');
        $this->load->view('blog/footer/footer');              
        
        }  
        
      function aim_trainings()
        {

        //IMPORTANT TO UPDATE SITES NAME URL//
        $Sitename = $this->uri->segment(1);$this->core->init();if($Sitename!=""){$PIID=$this->mdlAccounts->getAccountPIID($Sitename);           $this->core->setData($PIID,$Sitename);}
        //////////////////////////////////////        
        
        $this->load->view('blog/cssGlobal');
        $this->load->view('controls/share/share');   
        $this->load->view('blog/header/header2'); 
        $this->load->view('controls/scrolltop/autoscrolltop');
        $this->load->view('blog/header/topbar');     
        $this->load->view('controls/menu/menu');   
        
        $data["category"]="Learn More[learnmore]";
        $data["division"]="Aim Global Trainings";
        $this->load->view('blog/content/learnmore/navheading',$data); 
        $this->load->view('blog/content/learnmore/videoSearch_trainings');
        $this->load->view('blog/footer/footer');       
            
        }
        
      function getRightListMore()
        {
        //echo $_POST["videoVersion"];
        if(isset($_POST["data"]) && isset($_POST["type"]) && isset($_POST["videoVersion"])) 
        echo $this->mdlVideoSearch->getRightListVideos($this->crypt->encrypt($_POST["type"]),$_POST["data"],$this->crypt->encrypt($_POST["videoVersion"]),$this->crypt->encrypt($_POST["postID"]),$_POST["searchTag"]);
        else $this->load->view('errors/html/error_route'); 
        }          
      function getListMore()
        {
        if(isset($_POST["data"]) && isset($_POST["type"]) && isset($_POST["videoVersion"])) echo $this->mdlVideoSearch->getListVideos($this->crypt->encrypt($_POST["type"]),$_POST["data"],$_POST["videoVersion"]);
        else $this->load->view('errors/html/error_route'); 
        }  
        
      function searchRightListMore()
        {
        if(isset($_POST["tag"]) && isset($_POST["data"]) && isset($_POST["type"]) && isset($_POST["search"]) && isset($_POST["videoVersion"])) 
        echo $this->mdlVideoSearch->searchRightListVideos($this->crypt->encrypt($_POST["type"]),$_POST["data"],$_POST["tag"],$_POST["videoVersion"],$_POST["postID"],$_POST["search"]);
        else 
        $this->load->view('errors/html/error_route'); 
        }         
        
      function searchListMore()
        {
        if(isset($_POST["type"]) && isset($_POST["search"]) && isset($_POST["videoVersion"])) echo $this->mdlVideoSearch->searchListVideos($this->crypt->encrypt($_POST["type"]),$_POST["search"],$_POST["videoVersion"]);
        else $this->load->view('errors/html/error_route'); 
        // echo $this->mdlVideoSearch->searchListVideos($this->crypt->encrypt("Product Info"),"");
        }          


                
      function companypolicy()
        {

        //IMPORTANT TO UPDATE SITES NAME URL//
        $Sitename = $this->uri->segment(1);$this->core->init();if($Sitename!=""){$PIID=$this->mdlAccounts->getAccountPIID($Sitename);           $this->core->setData($PIID,$Sitename);}
        //////////////////////////////////////
                   
        $this->load->view('blog/cssGlobal');
        $this->load->view('controls/share/share');   
        $this->load->view('blog/header/header2'); 
        $this->load->view('controls/scrolltop/autoscrolltop');
        $this->load->view('blog/header/topbar');     
        $this->load->view('controls/menu/menu');   
        

        $data["category"]="Learn More[learnmore]";
        $data["division"]="Company Policies";
        $this->load->view('blog/content/learnmore/navheading',$data); 
        $this->load->view('blog/content/learnmore/companypolicy');
        $this->load->view('blog/footer/footer');         
        }
        
}

?>
