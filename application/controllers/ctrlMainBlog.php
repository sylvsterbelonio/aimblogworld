<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlMainBlog extends CI_Controller {

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
        $this->load->model("blog/mdlSlant");            		
        $this->load->model('blog/mdlAccounts');
        $this->load->model('blog/mdlGeneral');
        $this->load->model('blog/mdlSlideShow');
        $this->load->model('blog/mdlAttributes');
        $this->load->model('blog/mdlMenu');
        $this->load->model('blog/mdlShop');
        $this->load->model('blog/mdlPages');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));
        $this->load->library('Color');
        $this->load->library('Crypt');
        $this->load->library('Core');
        $this->load->library('Url');
        $this->load->library('Language');
        $this->load->library('Validator');
        $this->load->model("blog/mdlShopProducts");
        $this->load->model("blog/mdlItemSlider");
        $this->load->model("mdlErrors");
        $this->load->database();
        }
        
/*

        function index(){
        
        //$this->config->item('paypaltest')="5";
         //$this->config->set_item("delete_confirm","Yeah");
        $this->core->setData("hahaha");
        $this->core->setData("-");
        $this->core->setData("hahaha");
        
        $this->session->unset_userdata("PIID","3");
        $this->session->unset_userdata("customerID","7");
         $this->session->userdata('PIID');
        
        
        
        
        echo $this->config->item("gcustomerID");
        
        
        $data["srcData"]="<ul class='bxslider'><li><img src='".base_url()."images/data/products/burn/Liven-Burn1-600x600.jpg' title='Funky roots'></li>";
        $data["srcData"].="<li><img src='".base_url()."images/data/products/burn/Liven-Burn-600x600.jpg' title='Funky roots'></li>";
        $data["srcData"].="<li><img src='".base_url()."images/data/products/burn/Liven-Burn-600x600.jpg' title='Funky roots'></li>";
        $data["srcData"].="<li><img src='".base_url()."images/system/noproduct.png'></li></ul>";
        
        
         $data["srcData"].='<div id="bx-pager">';
         $data["srcData"].='<a data-slide-index="0" href=""><img src="'.base_url().'images/data/products/burn/Liven-Burn1-600x600.jpg" height=50 width=50 /></a>';
         $data["srcData"].='<a data-slide-index="1" href=""><img src="'.base_url().'images/data/products/burn/Liven-Burn-600x600.jpg" height=50 width=50 /></a>';
         $data["srcData"].='<a data-slide-index="2" href=""><img src="'.base_url().'images/system/noproduct.png" height=50 width=50 /></a>';
         $data["srcData"].='<a data-slide-index="3" href=""><img src="'.base_url().'images/system/noproduct.png" height=50 width=50 /></a>';         
         $data["srcData"].='</div>';
        
        
        $data["settings"]='
        auto:true,
        captions: true,
        pagerCustom: "#bx-pager",
        ';
        $this->load->view("controls/bxslider/bxslider",$data);
        
        }
        
        */
        
        
    function index() 
        {

                    //$this->uri->segment(1); // controller
        $Sitename = $this->uri->segment(1); // action
            //$this->uri->segment(3); // 1stsegment
            //$this->uri->segment(4); // 2ndsegment

        $this->core->init();
      
        if($Sitename!="")
          {
          
          $PIID=$this->mdlAccounts->getAccountPIID($Sitename);           
          $this->core->setData($PIID,$Sitename);

              if($PIID==0)
                {
                if($Sitename=='shop')
                  {return false;}
                elseif($Sitename=='account')
                  {return false;}
                elseif($Sitename=='admin')
                  {return false;}
                elseif($Sitename=='product')
                  {return false;}
                elseif($Sitename=='home')
                  {
                  redirect(base_url());
                  }
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
        
        
        $this->load->view('blog/header/header'); 
        $this->load->view('blog/cssGlobal');
        
        $this->load->view('controls/scrolltop/autoscrolltop');
        $this->load->view('blog/header/topbar');          
        $this->load->view('controls/menu/menu'); 
        
        ///THIS for HOME///
       // $themeID=1;
        $data = $this->mdlGeneral->getTheme();  
              //$data['rgb'] = $this->color->string_to_rgb($data["nBackColor"]);
              //$data['rgbh'] = $this->color->string_to_rgb($data["hBackColor"]);
              $data["user"]=$Sitename;
         
         
        //$this->load->view('controls/slicebox/slicebox'); 
        $this->load->view('blog/content/home/home');
        $this->load->view('controls/slidingtext/slidingtext');
        $this->load->view('blog/content/home/PostBlogSummary');  
          
        $this->load->view('blog/content/home/slantslideshow'); 
        
        
        $data["citations"] = $this->mdlItemSlider->getData("citations");
        $this->load->view('blog/content/home/itemslider',$data); 
        
        
        $this->load->view('blog/footer/footer',$data); 
        }  
    

      
        

        



}

?>
