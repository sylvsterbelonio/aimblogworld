<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlPCategory extends CI_Controller {

 function __construct() 
        { 
        parent::__construct();
                 		
        $this->load->model('mdlPCategory');
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
                        
            $data['ftxtSPCagetorysearch'] = array(
            'name' => 'SPCagetorysearch',
            'id' => 'txtSPCagetorysearch',
            'alt'=>'Category Name',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px',
            'class'=> 'ui-widget-content ui-corner-left'
            );       
            
            
            $data['ftxtPCagetoryName'] = array(
            'name' => 'PCagetoryName',
            'id' => 'txtPCagetoryName',
            'alt'=>'',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px;width:93%',
            'class'=> 'ui-widget-content ui-corner-all'
            );   
                                               
        $this->load->view('body/menu/vlstPCategory',$data); 
        }
    
    function saveRecord()
        {
        $usr = $this->uri->segment(3); 
        echo $this->mdlPCategory->save_record($_POST["categoryName"],$_POST["id"],$usr);
        }  
    function deleteRecord()
        {
        echo $this->mdlPCategory->delete_record($_POST["id"]); 
        }  
    
    function getListPCategory()
        {
        
        $page = $_POST['page'];
        $limit = $_POST['rows'];
        $sidx = $_POST['sidx'];
        $sord = $_POST['sord'];
                
        $type=$_POST['type'];
        //$searchValue=$_REQUEST['searchValue'];
        $searchValue=$_POST['searchValue'];
        
        if(!$sidx) $sidx =1;
        
        $count=$this->mdlPCategory->searchListCount($type,$searchValue);

        if( $count > 0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }

        if ($page > $total_pages) $page=$total_pages;        
        $start = $limit*$page - $limit;
        if($start <0) $start = 0;

                
        $result=$this->mdlPCategory->searchList($type,$searchValue,$sidx,$sord,$start,$limit);


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
    echo "<row id='". $row['PCID']."'>";
    echo "<cell><![CDATA[".utf8_encode($row['categoryName'])."]]></cell>";
    echo "</row>";
}
echo "</rows>";
}



}
?>
