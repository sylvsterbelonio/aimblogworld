<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlBlog_Shop extends CI_Controller {

     function __construct() 
        { 
        parent::__construct();
        
	      $config['upload_path'] = './images/data/countries';
                      		$config['allowed_types'] = 'gif|jpg|png';
                      		$config['max_size']	= '500';
                      		$config['max_width']  = '100';
                      		$config['max_height']  = '100';
                      		$this->load->library('upload', $config);
                      		$this->upload->do_upload();	  
        $this->load->model('blog/mdlMetaProperties');                              		
        $this->load->model('blog/mdlAccounts');
        $this->load->model('blog/mdlGeneral');
        $this->load->model('blog/mdlSlideShow');
        $this->load->model('blog/mdlMenu');
        $this->load->model('blog/mdlCustomer');
        $this->load->model('blog/mdlShop');
        $this->load->library('Navhead');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));
        $this->load->library('Color');
        $this->load->library('Crypt');
        $this->load->library('encrypt');
        $this->load->library('Core');
        $this->load->library("Language");
        $this->load->library("Validator");
        $this->load->library("Url");
        $this->load->model("mdlErrors"); 
        $this->load->model("blog/mdlAttributes");
        $this->load->database();
        
        }


        function shop()
        {

        //IMPORTANT TO UPDATE SITES NAME URL//
        $Sitename = $this->uri->segment(1);$this->core->init();if($Sitename!=""){$PIID=$this->mdlAccounts->getAccountPIID($Sitename);           $this->core->setData($PIID,$Sitename);}
        //////////////////////////////////////


                   
        $this->load->view('blog/cssGlobal');
    
        $this->load->view('blog/header/header2'); 
        $this->load->view('controls/scrolltop/autoscrolltop');
        
        //$data["lang"] = $this->language->topbar("topbar");
        $this->load->view('blog/header/topbar');     
             
        $this->load->view('controls/menu/menu'); 
        
        $data["category"]="Online Shopping Area";
        $this->load->view('blog/content/learnmore/navheading',$data); 
        //$this->load->view('blog/content/shop/navheading');
        
        //variables HERE//
        $data["side_categories"]=$this->mdlShop->getCategories(); 
        $data["cboCountries"] =  $this->mdlShop->getCountries(1); 
        $data['fcbolstSort'] = array(
            'productName'         => 'Product Name',
            'productName desc'   => 'Product Name Desc',
            'retailPrice'           => 'Price',
            'retailPrice desc' =>'Price Desc',
            'love'         => 'Popularity',
            'like'        => 'Top Rated'
            );
            $data['fcboSort']=array(
            'name'=>'cboSort',
            'id'=>'cboSort',
            'style'=>'padding:5px 10px;',
            );        
        $data['fcbolstView'] = array(
            'grid'         => 'Grid View',
            'list'           => 'List View'
            );
            $data['fcboView']=array(
            'name'=>'cboView',
            'id'=>'cboView',
            'style'=>'padding:5px 10px',
            );         
        
        $data["listProducts"] = $this->mdlShop->getProducts("",$this->config->item("gpiid"),$this->config->item("gcountryID"),"productName",0,12);
        $data["navProducts"] = $this->mdlShop->navigationFooter("grid","",$this->config->item("gpiid"),$this->config->item("gcountryID"),"productName",0,12);
        
        $data["listDetailsProducts"] =$this->mdlShop->getDetailProdutcs("",$this->config->item("gpiid"),$this->config->item("gcountryID"),"productName",0,12);
        //THIS IS FOR RIGHT CATEGORY DISPLAY//
        $data["listTopRatedProducts"] = $this->mdlShop->getTopRatedProducts($this->config->item("gpiid"),$this->config->item("gcountryID"),"like");
        $data["listPopularProducts"] = $this->mdlShop->getTopRatedProducts($this->config->item("gpiid"),$this->config->item("gcountryID"),"love");
        $data["listNewProducts"]=$this->mdlShop->getNewArrivals($this->config->item("gcountryID"));
        

        $data["PIID"]=$this->config->item("gpiid");
        $this->load->view('blog/content/shop/shop',$data);
        $this->load->view('blog/footer/footer');

        }
        
        function setViewType()
        {
        
        //IMPORTANT TO UPDATE SITES NAME URL//
        $Sitename = $this->uri->segment(1);$this->core->init();if($Sitename!=""){$PIID=$this->mdlAccounts->getAccountPIID($Sitename);           $this->core->setData($PIID,$Sitename);}
        //////////////////////////////////////
        
        
            $PIID = $_POST["piid"];
            $typeView = $_POST["typeview"];
            $countryID = $_POST["countryID"];
            $order = $_POST["sort"];
            $page = $_POST["page"];
            $limit = $_POST["limit"];
            $themeID = $this->mdlAccounts->getThemeID($PIID); 
            $html="";
            
            if($typeView=="grid") $html = $this->mdlShop->getProducts("",$PIID,$countryID,$order,$page,$limit);
            else $html = $this->mdlShop->getDetailProdutcs("",$PIID,$countryID,$order,$page,$limit);
            
            echo $html;
        }
        
        function setNavigationFooter()
        {
            $PIID = $_POST["piid"];
            $typeView = $_POST["typeview"];
            $countryID = $_POST["countryID"];
            $order = $_POST["sort"];
            $page = $_POST["page"];
            $limit = $_POST["limit"];
            echo $this->mdlShop->navigationFooter($typeView,"",$PIID,$countryID,$order,$page,$limit);        
        }

        function link_categories()
        {
        $PIID="0";
        //IMPORTANT TO UPDATE SITES NAME URL//
        $Sitename = $this->uri->segment(1);$this->core->init();if($Sitename!=""){$PIID=$this->mdlAccounts->getAccountPIID($Sitename);           $this->core->setData($PIID,$Sitename);}
        //////////////////////////////////////
                   
        $this->load->view('blog/cssGlobal');
        $searchValue="";
        if(isset($_GET["search"])) $searchValue = $this->crypt->decrypt($_GET["search"]);


      
        if($Sitename!="")
          {
          
          $PIID=$this->mdlAccounts->getAccountPIID($Sitename);           
          $this->core->setData($PIID,$Sitename);
              if($PIID==0)
                {
                if($Sitename=='shop')
                  {}
                elseif($Sitename=='account')
                  {return false;}
                elseif($Sitename=='admin')
                  {return false;}
                elseif($Sitename=='product')
                  {return false;}
                else
                  {
                  $this->load->view('errors/html/error_general'); 
                  return false;                  
                  }
                }
              else
                {

                }              
          }
        
             
        $this->load->view('blog/header/header2'); 
        $this->load->view('blog/header/autoscrolltop');
        $this->load->view('blog/header/topbar'); 
        $this->load->view('controls/menu/menu'); 

        //$data['searchValue']=$searchValue;
        //$this->load->view('blog/content/shop/navheading',$data);

        $data["category"]="Online Shopping Area[shop]";
        $data["division"] = $searchValue;
        $this->load->view('blog/content/learnmore/navheading',$data); 
       
        //variables HERE//
        $data["side_categories"]=$this->mdlShop->getCategories(); 
        $data["cboCountries"] =  $this->mdlShop->getCountries(1); 
        $data['fcbolstSort'] = array(
            'productName'         => 'Product Name',
            'productName desc'   => 'Product Name Desc',
            'retailPrice'           => 'Price',
            'retailPrice desc' =>'Price Desc',
            'love'         => 'Popularity',
            'like'        => 'Top Rated'
            );
            $data['fcboSort']=array(
            'name'=>'cboSort',
            'id'=>'cboSort',
            'style'=>'padding:5px 10px',
            );        
        $data['fcbolstView'] = array(
            'grid'         => 'Grid View',
            'list'           => 'List View'
            );
            $data['fcboView']=array(
            'name'=>'cboView',
            'id'=>'cboView',
            'style'=>'padding:5px 10px',
            );         


        $catCol = explode("/",$this->url->getURL());
        $catCol = explode("?",$catCol[count($catCol)-1]);
        $typeMode = $catCol[0];
        
        if($typeMode!="globalpackages")
          {
          
          $data["listProducts"] = $this->mdlShop->getProducts($searchValue,$this->config->item("gpiid"),$this->config->item("gcountryID"),"productName",0,12);
          $data["navProducts"] = $this->mdlShop->navigationFooter("grid",$_GET["search"],$this->config->item("gpiid"),$this->config->item("gcountryID"),"productName",0,12);          
          }
        else
          {
          $search = "";
          if(isset($_GET["search"]))  $search = $_GET["search"];
          $data["listProducts"] = $this->mdlShop->getPackages($searchValue,$this->config->item("gpiid"),$this->config->item("gcountryID"),"packageName",0,12);
          $data["navProducts"] = $this->mdlShop->navigationFooter("grid",$search,$this->config->item("gpiid"),$this->config->item("gcountryID"),"productName",0,12);          
          
          }
        
        
        
        //$data["listDetailsProducts"] =$this->mdlShop->getDetailProdutcs("",$PIID,$countryID,"productName");
        //THIS IS FOR RIGHT CATEGORY DISPLAY//
        $data["listTopRatedProducts"] = $this->mdlShop->getTopRatedProducts($this->config->item("gpiid"),$this->config->item("gcountryID"),"like");
        $data["listPopularProducts"] = $this->mdlShop->getTopRatedProducts($this->config->item("gpiid"),$this->config->item("gcountryID"),"love");
        $data["listNewProducts"]=$this->mdlShop->getNewArrivals($this->config->item("gcountryID"));
        
        //
        
        $data["PIID"]=$this->config->item("gpiid");
        $this->load->view('blog/content/shop/shop',$data);
        
        $this->load->view('blog/footer/footer');

        }
        
        
}

?>
