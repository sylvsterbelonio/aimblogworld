<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlProductDetails extends CI_Controller {

 function __construct() 
        { 
        parent::__construct();              
        $config['upload_path'] = './images/data/testimonies';
                      		$config['allowed_types'] = 'gif|jpg|png';
                      		$config['max_size']	= '500';
                      		$config['max_width']  = '100';
                      		$config['max_height']  = '100';
                      		$this->load->library('upload', $config);
                      		$this->upload->do_upload();  		
        $this->load->model('mdlProductDetails');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));
        $this->load->database();
        }

    function index() 
        {
        //none
        
        }

    function uploadTestimony()
       {
        $curDate = date("Ymd");
        $PIID = $this->uri->segment(3); 
        $nextID = $this->mdlProductDetails->nextID("mediaID","tblmedia");   
        $uploaddir = './images/data/testimonies/';
        $fileNamex = $PIID.$nextID."_picture".".".$_POST["ext"];
        $uploadfile = $uploaddir . basename("picture".$PIID.$nextID.$curDate.".".$_POST["ext"]);
        echo $_POST['testimonies'];
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
        echo $this->mdlProductDetails->add_media($_POST["extension"],$_POST["source"],$_POST["usr"]);         
        }
            
    function getListFormTestimony($PIID)
        {
        $data['PIID'] = $PIID;        
        //////////////GLOBAL TESTIMONEY/////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        
        $data['fcboselPDetailsTestimony'] = $this->mdlProductDetails->getProductTestimony(); 
        
        $data['ftxtSGTestimonysearch'] = array(
            'name' => 'GTestimony',
            'id' => 'txtGTestimony',
            'alt'=>'Search Title',
            'size' => '30',
            'value'=>'',
            'style'=>';padding:5px 10px;margin-bottom:5px;text-align:left',
            'class'=> 'ui-widget-content ui-corner-'
        ); 

        $data['ftxtGTestimonyCategory'] = array(
            'name' => 'GTestimonyCategory',
            'id' => 'txtGTestimonyCategory',
            'alt'=>'',
            'value'=>'',
            'style'=>';padding:5px 10px;margin-bottom:5px;text-align:left;width:94%',
            'class'=> 'ui-widget-content ui-corner-all'
        );                   

        $data['ftxtGTestimonyTitle'] = array(
            'name' => 'GTestimonyTitle',
            'id' => 'txtGTestimonyTitle',
            'alt'=>'',
            'value'=>'',
            'style'=>';padding:5px 10px;margin-bottom:5px;text-align:left;width:94%',
            'class'=> 'ui-widget-content ui-corner-all'
        );   

        $data['ftxtGTestimonySubTitle'] = array(
            'name' => 'GTestimonySubTitle',
            'id' => 'txtGTestimonySubTitle',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>';padding:5px 10px;margin-bottom:5px;text-align:left;width:94%',
            'class'=> 'ui-widget-content ui-corner-all'
        );  

        $data['ftxtGTestimonyContent'] = array(
            'name' => 'GTestimonyContent',
            'id' => 'txtGTestimonyContent',
            'alt'=>'',
            'value'=>'',
            'style'=>';padding:5px 10px;margin-bottom:5px;text-align:left;width:94%',
            'class'=> 'ui-widget-content ui-corner-all'
        ); 

        $data['ftxtGTestimonyURL'] = array(
            'name' => 'GTestimonyURL',
            'id' => 'txtGTestimonyURL',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>';padding:5px 10px;margin-bottom:5px;text-align:left;width:94%',
            'class'=> 'ui-widget-content ui-corner-all'
        );  

        $data['ftxtGTestimonyTagName'] = array(
            'name' => 'GTestimonyTagName',
            'id' => 'txtGTestimonyTagName',
            'alt'=>'',
            'value'=>'',
            'style'=>';padding:5px 10px;margin-bottom:5px;text-align:left;width:94%',
            'class'=> 'ui-widget-content ui-corner-all'
        );     

        $data['fcboSelProductTestimony'] = $this->mdlProductDetails->getProductTestimony(); 
        
        $this->load->view('body/menu/vlstProductTestimony',$data); 
                    
        }
           
    function getListForm($PIID)
        {   
        
        $data['PIID'] = $PIID;
            //$this->uri->segment(1); // controller
            //$this->uri->segment(2); // action
            //$this->uri->segment(3); // 1stsegment
            //$this->uri->segment(4); // 2ndsegment
        $data['fcboPriceFlag'] = $this->mdlProductDetails->getFlags();
        
        $data['ftxtPriceSymbol'] = array(
            'name' => 'PriceSymbol',
            'id' => 'txtPriceSymbol',
            'alt'=>'',
            'size' => '',
            'value'=>'',
            'style'=>'width:94%;padding:5px 10px;margin-bottom:5px',
            'class'=> 'ui-widget-content ui-corner-all'
        );     

        $data['ftxtPriceDesc'] = array(
            'name' => 'PriceDesc',
            'id' => 'txtPriceDesc',
            'alt'=>'',
            'size' => '',
            'value'=>'',
            'style'=>'width:94%;padding:5px 10px;margin-bottom:5px',
            'class'=> 'ui-widget-content ui-corner-all'
        );               

        $data['ftxtDPrice'] = array(
            'name' => 'DPrice',
            'id' => 'txtDPrice',
            'alt'=>'',
            'size' => '',
            'value'=>'',
            'style'=>'width:94%;padding:5px 10px;margin-bottom:5px;text-align:right',
            'class'=> 'ui-widget-content ui-corner-all'
        ); 

        $data['ftxtRPrice'] = array(
            'name' => 'RPrice',
            'id' => 'txtRPrice',
            'alt'=>'',
            'size' => '',
            'value'=>'',
            'style'=>'width:94%;padding:5px 10px;margin-bottom:5px;text-align:right',
            'class'=> 'ui-widget-content ui-corner-all'
        ); 

        $data['ftxtProductDetails'] = array(
            'name' => 'ProductDetails',
            'id' => 'txtProductDetails',
            'alt'=>'',
            'size' => '',
            'value'=>'',
            'style'=>'width:98%;height:750px;padding:5px 10px;margin-bottom:5px;text-align:',
            'class'=> 'ui-widget-content ui-corner-all'
        ); 
        
        $data['ftxtProductContents'] = array(
            'name' => 'ProductContents',
            'id' => 'txtProductContents',
            'alt'=>'',
            'size' => '',
            'value'=>'',
            'style'=>'width:98%;height:750px;padding:5px 10px;margin-bottom:5px;text-align:',
            'class'=> 'ui-widget-content ui-corner-all'
        ); 
        
        $data['ftxtManufacturedCompany'] = array(
            'name' => 'ManufacturedCompany',
            'id' => 'txtManufacturedCompany',
            'alt'=>'',
            'size' => '',
            'value'=>'',
            'style'=>'width:98%;height:750px;padding:5px 10px;margin-bottom:5px;text-align:',
            'class'=> 'ui-widget-content ui-corner-all'
        ); 
                        
        $data['fcboselPDetails'] = $this->mdlProductDetails->getProduct();   


                                                                                
        $this->load->view('body/menu/vlstProductDetails',$data); 
        }
      
    function deleteRecord_price()
        {
        echo $this->mdlProductDetails->delete_record_price($_POST["id"]);         
        }

    function deleteRecord_gtestimony()
        {
        echo $this->mdlProductDetails->delete_record_gtestimony($_POST["id"]);         
        }
        
    function saveRecord_price()
        {
        $usr = $this->uri->segment(3); 
        echo $this->mdlProductDetails->saveRecord_price($_POST["countryID"],$_POST["PID"],$_POST["priceSymbol"],$_POST["priceDescription"], $_POST["distributorPrice"],$_POST["retailPrice"],$_POST["id"],$usr);
        } 

    function saveRecord_gtestimony()
        {
        $usr = $this->uri->segment(3); 
        echo $this->mdlProductDetails->saveRecord_gtestimony($_POST["pid"],$_POST["mediaID"],$_POST["category"],$_POST["title"], $_POST["subtitle"],$_POST["content"],$_POST["url"],$_POST["tagname"],$_POST["id"],$usr);
        } 
    
    function getRecordDetails()
        {
        $usr = $this->uri->segment(3); 
        $result = $this->mdlProductDetails->getRecordDetails($_POST["pid"],$usr);        
        echo json_encode($result);
        }

    function saveRecord_pdetails()
        {
        $usr = $this->uri->segment(3); 
        echo $this->mdlProductDetails->saveRecord_details($_POST["pid"],$_POST["details"],$_POST["contents"], $_POST["manufactured"],$usr);
        } 


                    
    function getListGTestimony()
        {
        
        $page = $_POST['page'];
        $limit = $_POST['rows'];
        $sidx = $_POST['sidx'];
        $sord = $_POST['sord'];
                
        $type=$_POST['type'];
        //$searchValue=$_REQUEST['searchValue'];
        $searchValue=$_POST['searchValue'];
        
        if(!$sidx) $sidx =1;
        
        $count=$this->mdlProductDetails->searchListCount_GTestimony($type,$searchValue);

        if( $count > 0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }

        if ($page > $total_pages) $page=$total_pages;        
        $start = $limit*$page - $limit;
        if($start <0) $start = 0;

                
        $result=$this->mdlProductDetails->searchList_GTestimony($type,$searchValue,$sidx,$sord,$start,$limit);


        if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
                      header("Content-type: application/xhtml+xml;charset=utf-8");
        } else {
                  header("Content-type: text/xml;charset=utf-8");
        }
               
        echo "<?xml version='1.0' encoding='utf-8'?>";
        echo "<rows>";
        echo "<page>".$page."</page>";
        echo "<total>".$total_pages."</total>";
        echo "<records>".$count."</records>";
        
        // be sure to put text data in CDATA
        foreach($result as $row) {
            echo "<row id='". $row['GTID']."'>";
            echo "<cell><![CDATA[".utf8_encode($row['mediaID'])."]]></cell>";
            echo "<cell><![CDATA[".utf8_encode($row['source'])."]]></cell>";            
            echo "<cell><![CDATA[".utf8_encode($row['category'])."]]></cell>";
            echo "<cell><![CDATA[".utf8_encode($row['title'])."]]></cell>";
        	  echo "<cell><![CDATA[".utf8_encode($row['subtitle'])."]]></cell>";
        	  echo "<cell><![CDATA[".utf8_encode($row['content'])."]]></cell>";	  
        	  echo "<cell><![CDATA[".utf8_encode($row['url'])."]]></cell>";
        	  echo "<cell><![CDATA[".utf8_encode($row['tagname'])."]]></cell>";
            echo "</row>";
        }
        echo "</rows>";
 
        }
             
    function getListPrice()
        {
        
        $page = $_POST['page'];
        $limit = $_POST['rows'];
        $sidx = $_POST['sidx'];
        $sord = $_POST['sord'];
                
        $type=$_POST['type'];
        //$searchValue=$_REQUEST['searchValue'];
        $searchValue=$_POST['searchValue'];
        
        if(!$sidx) $sidx =1;
        
        $count=$this->mdlProductDetails->searchListCount_Price($type,$searchValue);

        if( $count > 0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }

        if ($page > $total_pages) $page=$total_pages;        
        $start = $limit*$page - $limit;
        if($start <0) $start = 0;

                
        $result=$this->mdlProductDetails->searchList_Price($type,$searchValue,$sidx,$sord,$start,$limit);


if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
              header("Content-type: application/xhtml+xml;charset=utf-8");
} else {
          header("Content-type: text/xml;charset=utf-8");
}


echo "<?xml version='1.0' encoding='utf-8'?>";
echo "<rows>";
echo "<page>".$page."</page>";
echo "<total>".$total_pages."</total>";
echo "<records>".$count."</records>";

// be sure to put text data in CDATA
foreach($result as $row) {
    echo "<row id='". $row['priceID']."'>";
    echo "<cell><![CDATA[".utf8_encode($row['countryID'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['countryName'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['priceSymbol'])."]]></cell>";	  
	  echo "<cell><![CDATA[".utf8_encode($row['priceDescription'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['distributorPrice'])."]]></cell>";	  
	  echo "<cell><![CDATA[".utf8_encode($row['retailPrice'])."]]></cell>";
    echo "</row>";
}
echo "</rows>";
 
}



}
?>
