<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlProduct extends CI_Controller {

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
        $this->load->model('mdlProduct');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));
        $this->load->database();
        }

    function index() 
        {
        //none
        }
        
    function uploadProduct()
       {
        $curDate = date("Ymd");
        $PIID = $this->uri->segment(3); 
        $nextID = $this->mdlProduct->nextID("mediaID","tblmedia");   
        $uploaddir = './images/data/products/';
        $fileNamex = $PIID.$nextID."_picture".".".$_POST["ext"];
        $uploadfile = $uploaddir . basename("picture".$PIID.$nextID.$curDate.".".$_POST["ext"]);
        echo $_POST['products'];
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
        echo $this->mdlProduct->add_media($_POST["extension"],$_POST["source"],$_POST["usr"]);         
        }
        
    function getListForm($PIID)
        {   
        
            //$this->uri->segment(1); // controller
            //$this->uri->segment(2); // action
            //$this->uri->segment(3); // 1stsegment
            //$this->uri->segment(4); // 2ndsegment
            
            $data["PIID"]=$PIID;
                        
            $data['ftxtSProductsearch'] = array(
            'name' => 'SProductsearch',
            'id' => 'txtSProductsearch',
            'alt'=>'Product Name',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px',
            'class'=> 'ui-widget-content ui-corner-left'
            );       
            
            $data['fcboProductCategory'] = $this->mdlProduct->getCategory();
            
            $data['ftxtProductName'] = array(
            'name' => 'ProductName',
            'id' => 'txtProductName',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );   

            $data['ftxtProductDescription'] = array(
            'name' => 'ProductDescription',
            'id' => 'txtProductDescription',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );  
            
            $data['ftxtProductUnits'] = array(
            'name' => 'ProductUnits',
            'id' => 'txtProductUnits',
            'alt'=>'',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            ); 
            
            $data['ftxtProductBinaryPoints'] = array(
            'name' => 'ProductBinaryPoints',
            'id' => 'txtProductBinaryPoints',
            'alt'=>'',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%;text-align:right',
            'class'=> 'ui-widget-content ui-corner-all'
            );              

            $data['ftxtProductCommissionalPoints'] = array(
            'name' => 'ProductCommissionalPoints',
            'id' => 'txtProductCommissionalPoints',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%;text-align:right',
            'class'=> 'ui-widget-content ui-corner-all'
            );

            $data['ftxtProductPositionalPoints'] = array(
            'name' => 'ProductPositionalPoints',
            'id' => 'txtProductPositionalPoints',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%;text-align:right',
            'class'=> 'ui-widget-content ui-corner-all'
            );

            $data['ftxtProductWeight'] = array(
            'name' => 'ProductWeight',
            'id' => 'txtProductWeight',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%;',
            'class'=> 'ui-widget-content ui-corner-all'
            );
                                                                       
        $this->load->view('body/menu/vlstProduct',$data); 
        }
    
    function saveRecord()
        {
        $usr = $this->uri->segment(3); 
        echo $this->mdlProduct->save_record($_POST["PCID"],$_POST["mediaID"],$_POST["description"],$_POST["productName"], $_POST["units"],$_POST["binaryPoints"],$_POST["commissionalPoints"],$_POST["positionalPoints"],$_POST["weight"],$_POST["id"],$usr);
        }  
    function deleteRecord()
        {
        echo $this->mdlProduct->delete_record($_POST["id"]); 
        }  
        
    function getProduct($source)
        {
        if($source=="") return "images/system/noproduct.png";
        return $source;
        }   
         
    function getListProduct()
        {
        
        $page = $_POST['page'];
        $limit = $_POST['rows'];
        $sidx = $_POST['sidx'];
        $sord = $_POST['sord'];
                
        $type=$_POST['type'];
        //$searchValue=$_REQUEST['searchValue'];
        $searchValue=$_POST['searchValue'];
        
        if(!$sidx) $sidx =1;
        
        $count=$this->mdlProduct->searchListCount($type,$searchValue);

        if( $count > 0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }

        if ($page > $total_pages) $page=$total_pages;        
        $start = $limit*$page - $limit;
        if($start <0) $start = 0;

                
        $result=$this->mdlProduct->searchList($type,$searchValue,$sidx,$sord,$start,$limit);


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
    echo "<row id='". $row['PID']."'>";
    echo "<cell><![CDATA[".utf8_encode($row['PCID'])."]]></cell>";
    echo "<cell><![CDATA["."<img height=35 width=35 src='".$this->getProduct($row["source"])."'>"."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['mediaID'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['categoryName'])."]]></cell>";	  
	  echo "<cell><![CDATA[".utf8_encode($row['productName'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['description'])."]]></cell>";	  
	  echo "<cell><![CDATA[".utf8_encode($row['units'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['binaryPoints'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['commissionalPoints'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['positionalPoints'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['weight'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['source'])."]]></cell>";
    echo "</row>";
}
echo "</rows>";


     
}



}
?>
