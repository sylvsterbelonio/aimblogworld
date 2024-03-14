<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlMedia extends CI_Controller {

 function __construct() 
        { 
        parent::__construct();
	      $config['upload_path'] = './images/data';
                      		$config['allowed_types'] = 'gif|jpg|png';
                      		$config['max_size']	= '500';
                      		$config['max_width']  = '100';
                      		$config['max_height']  = '100';
                      		$this->load->library('upload', $config);
                      		$this->upload->do_upload();	                  		
        $this->load->model('mdlMedia');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));
        $this->load->database();
        }

    function index() 
        {
        //none
        
        $this->load->view('body/multiUpload'); 
        }
        
    function getListForm($PIID)
        { 
        
        $data["PIID"]=$PIID;
        
        $data['fcboMediaCategorFolder'] = $this->mdlMedia->getCategory();
        
        $data['fcbolstSMediaOrder'] = array(
            'uploadedDt desc'      => 'Ordered By Current Date',
            'uploadedDt'         => 'Ordered By Old Date',
            'fileName'         => 'Ordered By Name'
            );
            
        $data['fcboSMediaOrder']=array(
            'name'=>'SMediaOrder',
            'id'=>'cboSMediaOrder',
            'style'=>'padding:5px',
            'class'=> 'ui-widget-content ui-corner-right'
            );
        
        
        $this->load->view('body/menu/vlstMedia',$data); 
        }     
    
    function getMediaPhotos($piid)
        {
        echo  $this->mdlMedia->getMediaList($_POST["categoryName"],$piid,$_POST["page"],$_POST["order"]);   
        } 
        
    function uploadMedia()
        {
        $curDate = date("Ymd");
        $PIID = $this->uri->segment(3); 
        $nextID = $this->mdlMedia->nextID("mediaID","tblmedia"); 
        $folderName = $_POST["folder"];  
        $uploaddir = "./images/data/$folderName/";
        $fileNamex = $PIID.$nextID."_picture".".".$_POST["ext"];
        $uploadfile = $uploaddir . basename("picture".$PIID.$nextID.$curDate.".".$_POST["ext"]);
        //echo $_POST['products'];
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            echo "success";
        } else {
        // WARNING! DO NOT USE "FALSE" STRING AS A RESPONSE!
        // Otherwise onSubmit event will not be fired
            echo "error";
        }
        }

    function addMedia()
        {       
        echo $this->mdlMedia->add_media($_POST["extension"],$_POST["folder"], $_POST["source"],$_POST["usr"]);        
        }
                
    function deleteMedia()
        {
        $source = $_POST["source"];
        echo $source;
            if (file_exists($source)) {
                unlink($source);
              }
        echo  $this->mdlMedia->deleteMedia($_POST["mediaID"]);       
        }
    
    function openMedia()
        {
        echo $this->mdlMedia->open_media($_POST["mediaID"]);     
        }
         
         
         
         
         
         
         
         
         
                
     
}       
        
?>
