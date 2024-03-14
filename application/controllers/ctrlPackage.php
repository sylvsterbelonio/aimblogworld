<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlPackage extends CI_Controller {

 function __construct() 
        { 
        parent::__construct();
                 		
        $this->load->model('mdlPackage');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));
        $this->load->database();
        }

    function index() 
        {
        //none
        }

    function uploadPackage()
       {
        $curDate = date("Ymd");
        $PIID = $this->uri->segment(3); 
        $nextID = $this->mdlPackage->nextID("mediaID","tblmedia");   
        $uploaddir = './images/data/packages/';
        $fileNamex = $PIID.$nextID."_picture".".".$_POST["ext"];
        $uploadfile = $uploaddir . basename("picture".$PIID.$nextID.$curDate.".".$_POST["ext"]);
        echo $_POST['packages'];
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
        echo $this->mdlPackage->add_media($_POST["extension"],$_POST["source"],$_POST["usr"]);         
        }
    function getListFormItem($PIID)
        {
            $data["PIID"]=$PIID;  
            $data['fcboPackageItem'] = $this->mdlPackage->getPackage();
            $data['fcboselPackageProduct'] = $this->mdlPackage->getProduct(); 

            $data['ftxtItemQuantity'] = array(
            'name' => 'ItemQuantity',
            'id' => 'txtItemQuantity',
            'alt'=>'Quantity',
            'size' => '10',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;text-align:right',
            'class'=> 'ui-widget-content ui-corner-'
            );          
            $this->load->view('body/menu/vlstPackageItem',$data); 
      
        }
        
    function getListForm($PIID)
        {   
        
            //$this->uri->segment(1); // controller
            //$this->uri->segment(2); // action
            //$this->uri->segment(3); // 1stsegment
            //$this->uri->segment(4); // 2ndsegment
            
            $data["PIID"]=$PIID;

            $data['fcbolstSPackagetype'] = array(
            'countryName'      => 'COUNTRY',
            'packageName'         => 'PACKAGE NAME'
            );
            $data['fcboSPackagetype']=array(
            'name'=>'SPackagetype',
            'id'=>'cboSPackagetype',
            'style'=>'padding:5px 8px',
            'class'=> 'ui-widget-content ui-corner-left'
            );
                        
            $data['ftxtSPackagesearch'] = array(
            'name' => 'SPackagesearch',
            'id' => 'txtSPackagesearch',
            'alt'=>'Search Value',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px',
            'class'=> 'ui-widget-content ui-corner-'
            );       
            
            $data['fcboPackageFlag'] = $this->mdlPackage->getFlags();
            
            $data['ftxtPackageName'] = array(
            'name' => 'PackageName',
            'id' => 'txtPackageName',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );   

            $data['ftxtPackagePrice'] = array(
            'name' => 'PackagePrice',
            'id' => 'txtPackagePrice',
            'alt'=>'',
            'value'=>'0.00',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%;text-align:right',
            'class'=> 'ui-widget-content ui-corner-all'
            ); 
            
            $data['ftxtPackageSymbol'] = array(
            'name' => 'PackageSymbol',
            'id' => 'txtPackageSymbol',
            'alt'=>'',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );              

            $data['ftxtPackageDescription'] = array(
            'name' => 'PackageDescription',
            'id' => 'txtPackageDescription',
            'alt'=>'',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );   
            
            $data['ftxtPackageWeight'] = array(
            'name' => 'PackageWeight',
            'id' => 'txtPackageWeight',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%;text-align:right',
            'class'=> 'ui-widget-content ui-corner-all'
            );
            

                                                           
        $this->load->view('body/menu/vlstPackage',$data); 
        //$this->load->view('body/menu/sampleisnotatable');//
        }
    
    function saveRecord()
        {
        $usr = $this->uri->segment(3); 
        echo $this->mdlPackage->save_record($_POST["countryID"],$_POST["mediaID"],$_POST["packageName"],$_POST["price"], $_POST["priceSymbol"],$_POST["priceDescription"],$_POST["weight"],$_POST["id"],$usr);
        }  
   
    function deleteRecord()
        {
        echo $this->mdlPackage->delete_record($_POST["id"]); 
        }  
   
    function add_item()
        {
        $usr = $this->uri->segment(3); 
        echo $this->mdlPackage->add_item($_POST["packageID"],$_POST["PID"],$_POST["quantity"],$usr);       
        }
   
    function remove_item()
        {
        echo $this->mdlPackage->delete_item($_POST["id"]);         
        }
   
    function getListPackage_item()
        {
        
        $page = $_POST['page'];
        $limit = $_POST['rows'];
        $sidx = $_POST['sidx'];
        $sord = $_POST['sord'];
                
        $type=$_POST['type'];
        //$searchValue=$_REQUEST['searchValue'];
        $searchValue=$_POST['searchValue'];
        
        if(!$sidx) $sidx =1;
        
        $count=$this->mdlPackage->searchListCount_item($type,$searchValue);

        if( $count > 0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }

        if ($page > $total_pages) $page=$total_pages;        
        $start = $limit*$page - $limit;
        if($start <0) $start = 0;

        $result=$this->mdlPackage->searchList_item($type,$searchValue,$sidx,$sord,$start,$limit);

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
    echo "<row id='". $row['itemID']."'>";
    echo "<cell><![CDATA[".utf8_encode($row['PID'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['productName'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['quantity'])."]]></cell>";
    echo "</row>";
}
echo "</rows>";


     
}
    
    function getListPackage()
        {
        
        $page = $_POST['page'];
        $limit = $_POST['rows'];
        $sidx = $_POST['sidx'];
        $sord = $_POST['sord'];
                
        $type=$_POST['type'];
        //$searchValue=$_REQUEST['searchValue'];
        $searchValue=$_POST['searchValue'];
        
        if(!$sidx) $sidx =1;
        
        $count=$this->mdlPackage->searchListCount($type,$searchValue);

        if( $count > 0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }

        if ($page > $total_pages) $page=$total_pages;        
        $start = $limit*$page - $limit;
        if($start <0) $start = 0;

                
        $result=$this->mdlPackage->searchList($type,$searchValue,$sidx,$sord,$start,$limit);


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
    echo "<row id='". $row['packageID']."'>";
    echo "<cell><![CDATA[".utf8_encode($row['countryID'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['countryName'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['mediaID'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['source'])."]]></cell>";	  
	  echo "<cell><![CDATA[".utf8_encode($row['packageName'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['price'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['priceSymbol'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['priceDescription'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['weight'])."]]></cell>";
    echo "</row>";
}
echo "</rows>";


     
}



}
?>
