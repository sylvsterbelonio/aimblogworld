<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlBlog_Products extends CI_Controller {

     function __construct() 
        { 
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('blog/mdlGeneral');
        $this->load->library(array('form_validation','session'));        
        $this->load->model('blog/mdlMetaProperties');  
        $this->load->model('blog/mdlShopProducts');
        $this->load->model('blog/mdlMenu');     
        $this->load->model('mdlProduct');
        $this->load->library('Validator');
        $this->load->library('Core');
        $this->load->library("Language");  
        $this->load->library("Navhead");          
        $this->load->library("Url"); 
        $this->load->database();
        }

    function index() 
        {
        $data["heading"]="INVALID URL SITE";
        $data["message"]="<p>The host address you are trying to access does not exist or the account has been deactivated, please try to visit our web page link.</p> 
        <h3 align=center><a href=''>Click Here</a></h3>";
        $this->load->view('errors/html/error_general',$data); 
        }
        
    function loadDialogDetails()
        {
        
        $data=$this->mdlGeneral->getTheme();  
        $PIID="0";
        
        if($_GET["segments"]!="shop")
          {
           $PIID=$this->mdlAccounts->getAccountPIID($_GET["segments"]); 
          }


        $openDetails = $this->mdlShopProducts->openDetails($PIID,$_GET["pid"],$_GET["countryID"],$_GET["home"],$_GET["segments"]);
        $col = explode("~",$openDetails);
        
        $data["productName"] = $col[0]; //productname
        $data["content"] = $col[1]; //content
        $data["price"] = $col[2];
        $data["srcData"] = $col[3];
        $data["categories"] = $col[4];
        $data["likelove"] = $col[5];
        

        $this->load->view('blog/content/products/dialogdetails',$data); 
        }    
        
    function quickview()
        {
        $result= $this->mdlShopProducts->openDetails($_POST["pid"],$_POST["countryID"]);
        echo json_encode($result);
        }
        
    function productFullDetails()
        {
        

        $PIID="0";
        //IMPORTANT TO UPDATE SITES NAME URL//
        $Sitename = $this->uri->segment(1);$this->core->init();if($Sitename!=""){$PIID=$this->mdlAccounts->getAccountPIID($Sitename);           $this->core->setData($PIID,$Sitename);}
        //////////////////////////////////////

        $ProductInfo = $this->mdlProduct->getProductfromSite();
        
        $data["pageID"]=$ProductInfo["pageID"];
        
        $this->load->view('blog/cssGlobal');        
        $this->load->view('controls/share/share');   
        $this->load->view('blog/header/header2',$data); 
        $this->load->view('controls/scrolltop/autoscrolltop');
        
        $data["lang"] = $this->language->topbar("topbar");
        
        $this->load->view('blog/header/topbar');     
             
        $this->load->view('controls/menu/menu'); 
        
        
        $data["PID"] = $ProductInfo["PID"];


        
        $data["category"]="Online Shopping Area[shop]";
        $col = explode("/",$ProductInfo["category_url"]);
        $data["division"] = $ProductInfo["category"]."[".$col[1]."]";
        $data["section"] = $ProductInfo["product"];
        $this->load->view('blog/content/learnmore/navheading',$data);         
        
        $this->load->view('blog/content/products/productfulldetails',$data);
        $this->load->view('controls/comments/comments');
        $this->load->view('blog/footer/footer');
        }    
    
    function searchYoutube()
        {
        echo $this->mdlProduct->searchYoutube($_POST["pid"],$_POST["search"]);
        }

}
?>
