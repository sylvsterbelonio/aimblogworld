<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrlCountry extends CI_Controller {

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
        $this->load->model('mdlCountry');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));
        $this->load->database();
        }

    function index() 
        {
        //none
        }
        
    function uploadFlag()
       {
        $curDate = date("Ymd");
        $PIID = $this->uri->segment(3); 
        $nextID = $this->mdlCountry->nextID("mediaID","tblmedia");        
        $uploaddir = './images/data/countries/';
        $fileNamex = $PIID.$nextID."_picture".".".$_POST["ext"];
        $uploadfile = $uploaddir . basename("picture".$PIID.$nextID.$curDate.".".$_POST["ext"]);

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            //echo $fileNamex;
        } else {
        // WARNING! DO NOT USE "FALSE" STRING AS A RESPONSE!
        // Otherwise onSubmit event will not be fired
            echo "error upload";
        }
       }

    function getListForm($PIID)
        {   
        
            //$this->uri->segment(1); // controller
            //$this->uri->segment(2); // action
            //$this->uri->segment(3); // 1stsegment
            //$this->uri->segment(4); // 2ndsegment
            
            $data["PIID"]=$PIID;
            
            $param1 = $this->uri->segment(3); 
            $data['ftxtScountryName'] = array(
            'name' => 'ScountryName',
            'id' => 'txtScountryName',
            'alt'=>'Country Name',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px',
            'class'=> 'ui-widget-content ui-corner-left'
            );      

            $data['ftxtctrFlag'] = array(
            'name' => 'ctrFlag',
            'id' => 'txtctrFlag',
            'alt'=>'Flag',
            'size' => '30',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px',
            'class'=> 'ui-widget-content ui-corner-all'
            );   

            $data['ftxtDcountryName'] = array(
            'name' => 'DcountryName',
            'id' => 'txtDcountryName',
            'alt'=>'',
            'size' => '47',
            'value'=>'',
            'style'=>'padding:5px 10px;margin-bottom:5px',
            'class'=> 'ui-widget-content ui-corner-all'
            );   
            
                       
        $this->load->view('body/menu/vlstCountry',$data); 
        }
    
    function addMedia()
        {       
        echo $this->mdlCountry->add_media($_POST["extension"],$_POST["source"],$_POST["usr"]);        
        }
    
    function saveRecord()
        {
        $usr = $this->uri->segment(3); 
        echo $this->mdlCountry->save_record($_POST["imgSrc"],$_POST["countryName"],$_POST["id"],$usr);
        }  
    function deleteRecord()
        {
        echo $this->mdlCountry->delete_record($_POST["id"]); 
        }  
    
    function getFlag($source)
        {
        if($source=="") return "images/system/noflag.png";
        return $source;
        }
    
    function getListCountries()
        {
        
        $page = $_POST['page'];
        $limit = $_POST['rows'];
        $sidx = $_POST['sidx'];
        $sord = $_POST['sord'];
                
        $type=$_POST['type'];
        //$searchValue=$_REQUEST['searchValue'];
        $searchValue=$_POST['searchValue'];
        
        if(!$sidx) $sidx =1;
        
        $count=$this->mdlCountry->searchListCount($type,$searchValue);

        if( $count > 0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }

        if ($page > $total_pages) $page=$total_pages;        
        $start = $limit*$page - $limit;
        if($start <0) $start = 0;

                
        $result=$this->mdlCountry->searchList($type,$searchValue,$sidx,$sord,$start,$limit);


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
    echo "<row id='". $row['countryID']."'>";
    echo "<cell><![CDATA[".utf8_encode($row['mediaID'])."]]></cell>";
    echo "<cell><![CDATA[".utf8_encode($row['source'])."]]></cell>";
    echo "<cell><![CDATA["."<img height=20 width=30 src='".$this->getFlag($row["source"])."'>"."]]></cell>";
    //echo "<cell><![CDATA[".utf8_encode($row['mediaID'])."]]></cell>";
	  echo "<cell><![CDATA[".utf8_encode($row['countryName'])."]]></cell>";
    echo "</row>";
}
echo "</rows>";


        //$start = $limit*$page - $limit;
        //$responce->page = $page;
        //$responce->total = $total_pages;
        //$responce->records = $count;
        //$i=0;
        //foreach($result as $row) {
        //    $responce->rows[$i]['id']=$row['countryID'];
        //    $responce->rows[$i]['cell']=array($row['imgSrc'],$row['countryName']);
        //    $i++;
       // }
        
        //echo json_encode($responce);        
        }

}
?>
