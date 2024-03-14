<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlBCO extends CI_Controller {

 function __construct() 
        { 
        parent::__construct();
                 		
        $this->load->model('mdlBCO');
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

            $data['fcbolstSBCOtype'] = array(
            'countryName'      => 'COUNTRY',
            'ownerName'         => 'OWNERNAME',
            'address'           => 'ADDRESS',
            'contactNo'         => 'CONTACT NO.',
            'telNo'        => 'TEL NO.'
            );
            $data['fcboSBCOtype']=array(
            'name'=>'SBCOtype',
            'id'=>'cboSBCOtype',
            'style'=>'padding:4px 8px',
            'class'=> 'ui-widget-content ui-corner-left'
            );
                        
            $data['ftxtSBCOsearch'] = array(
            'name' => 'SBCOsearch',
            'id' => 'txtSBCOsearch',
            'alt'=>'Search Value',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px',
            'class'=> 'ui-widget-content ui-corner-'
            );       
            
            $data['fcboBCOFlag'] = $this->mdlBCO->getFlags();

            $data['ftxtbcoBCO'] = array(
            'name' => 'bcoBCO',
            'id' => 'txtbcoBCO',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );  
                        
            $data['ftxtbcoOwnername'] = array(
            'name' => 'bcoOwnername',
            'id' => 'txtbcoOwnername',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );   

            $data['ftxtbcoAddress'] = array(
            'name' => 'bcoAddress',
            'id' => 'txtbcoAddress',
            'alt'=>'',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );              

            $data['ftxtbcoContactNo'] = array(
            'name' => 'bcoContactNo',
            'id' => 'txtbcoContactNo',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );

            $data['ftxtbcoTelNo'] = array(
            'name' => 'bcoTelNo',
            'id' => 'txtbcoTelNo',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );
                                               
        $this->load->view('body/menu/vlstBCO',$data); 
        }
    
    function saveRecord()
        {
        $usr = $this->uri->segment(3); 
        echo $this->mdlBCO->save_record($_POST["countryID"],$_POST["bco"],$_POST["ownerName"],$_POST["address"],$_POST["contactNo"],$_POST["telNo"],$_POST["id"],$usr);
        }  
    function deleteRecord()
        {
        echo $this->mdlBCO->delete_record($_POST["id"]); 
        }  
    
    function getListBCO()
        {
        
        $page = $_POST['page'];
        $limit = $_POST['rows'];
        $sidx = $_POST['sidx'];
        $sord = $_POST['sord'];
                
        $type=$_POST['type'];
        //$searchValue=$_REQUEST['searchValue'];
        $searchValue=$_POST['searchValue'];
        
        if(!$sidx) $sidx =1;
        
        $count=$this->mdlBCO->searchListCount($type,$searchValue);

        if( $count > 0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }

        if ($page > $total_pages) $page=$total_pages;        
        $start = $limit*$page - $limit;
        if($start <0) $start = 0;

                
        $result=$this->mdlBCO->searchList($type,$searchValue,$sidx,$sord,$start,$limit);


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
    echo "<row id='". $row['bcoID']."'>";
    echo "<cell><![CDATA[".utf8_encode($row['countryID'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['countryName'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['bco'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['ownerName'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['address'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['contactNo'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['telNo'])."]]></cell>";
    echo "</row>";
}
echo "</rows>";


     
}



}
?>
