<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlOperation extends CI_Controller {

 function __construct() 
        { 
        parent::__construct();
                 		
        $this->load->model('mdlOperation');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));
        $this->load->database();
        }

    function index() 
        {
        //none
        }

    function getListForm($PIID)
        {   
        
            //$this->uri->segment(1); // controller
            //$this->uri->segment(2); // action
            //$this->uri->segment(3); // 1stsegment
            //$this->uri->segment(4); // 2ndsegment
            
            $data["PIID"]=$PIID;

            $data['fcbolstSOperationtype'] = array(
            'countryName'      => 'COUNTRY',
            'name'         => 'NAME',
            'position'         => 'POSITION',
            'address'           => 'ADDRESS',
            'contactNo'         => 'CONTACT NO.',
            'telNo'        => 'TEL NO.'
            );
            $data['fcboSOperationtype']=array(
            'name'=>'SOperationtype',
            'id'=>'cboSOperationtype',
            'style'=>'padding:4px 8px',
            'class'=> 'ui-widget-content ui-corner-left'
            );
                        
            $data['ftxtSOperationsearch'] = array(
            'name' => 'SOperationsearch',
            'id' => 'txtSOperationsearch',
            'alt'=>'Search Value',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px',
            'class'=> 'ui-widget-content ui-corner-'
            );       
            
            $data['fcboOperationFlag'] = $this->mdlOperation->getFlags();
            
            $data['ftxtOperationName'] = array(
            'name' => 'OperationName',
            'id' => 'txtOperationName',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );   

            $data['ftxtOperationPosition'] = array(
            'name' => 'bcoOperationPosition',
            'id' => 'txtOperationPosition',
            'alt'=>'',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            ); 
            
            $data['ftxtOperationAddress'] = array(
            'name' => 'OperationAddress',
            'id' => 'txtOperationAddress',
            'alt'=>'',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );              

            $data['ftxtOperationContactNo'] = array(
            'name' => 'OperationContactNo',
            'id' => 'txtOperationContactNo',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );

            $data['ftxtOperationTelNo'] = array(
            'name' => 'OperationTelNo',
            'id' => 'txtOperationTelNo',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );
                                               
        $this->load->view('body/menu/vlstOperation',$data); 
        }
    
    function saveRecord()
        {
        $usr = $this->uri->segment(3); 
        echo $this->mdlOperation->save_record($_POST["countryID"],$_POST["name"],$_POST["position"], $_POST["address"],$_POST["contactNo"],$_POST["telNo"],$_POST["id"],$usr);
        }  
    function deleteRecord()
        {
        echo $this->mdlOperation->delete_record($_POST["id"]); 
        }  
    
    function getListOperation()
        {
        
        $page = $_POST['page'];
        $limit = $_POST['rows'];
        $sidx = $_POST['sidx'];
        $sord = $_POST['sord'];
                
        $type=$_POST['type'];
        //$searchValue=$_REQUEST['searchValue'];
        $searchValue=$_POST['searchValue'];
        
        if(!$sidx) $sidx =1;
        
        $count=$this->mdlOperation->searchListCount($type,$searchValue);

        if( $count > 0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }

        if ($page > $total_pages) $page=$total_pages;        
        $start = $limit*$page - $limit;
        if($start <0) $start = 0;

                
        $result=$this->mdlOperation->searchList($type,$searchValue,$sidx,$sord,$start,$limit);


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
    echo "<row id='". $row['operationID']."'>";
    echo "<cell><![CDATA[".utf8_encode($row['countryID'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['countryName'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['name'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['position'])."]]></cell>";	  
	  echo "<cell><![CDATA[".utf8_encode($row['address'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['contactNo'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['telNo'])."]]></cell>";
    echo "</row>";
}
echo "</rows>";


     
}



}
?>
