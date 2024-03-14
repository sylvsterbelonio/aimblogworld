<?php
class mdlProductDetails extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
        }
    
    function nextID($field,$table)
        {
        $data=0;
        $sql = "select max($field) as 'max' from $table";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) 
            {
            $data=($row["max"]);
            }
        $data = $data + 1;
        return $data++;
        }


    function getProduct()
        {
        $html="";
        $sql = "select PID, productName from tblproduct order by productName";
        $query = $this->db->query($sql);
        $html="<select id='cboselPDetails' name='selPDetails' value='0' class='ui-widget-content ui-corner-all' style='padding:5px;width:100%'>";
        $html.="<option value='0'>Select Country</option>";
        foreach ($query->result_array() as $row) 
            {
            $html.="<option value='".$row["PID"]."'>".$row["productName"]."</option>";
            }
        $html.="</select>";
        return $html;
        }
    
    function getRecordDetails($pid)
        {
        $html='';
        $sql = "select * from tblproduct_details where PID=".$pid;   
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        }     
        }
        
    function getProductTestimony()
        {
        $html="";
        $sql = "select PID, productName from tblproduct order by productName";
        $query = $this->db->query($sql);
        $html="<select id='cboselProductTestimony' name='selProductTestimony' value='0' class='ui-widget-content ui-corner-left' style='padding:5px;width:100%'>";
        $html.="<option value='0'>Select Product</option>";
        foreach ($query->result_array() as $row) 
            {
            $html.="<option value='".$row["PID"]."'>".$row["productName"]."</option>";
            }
        $html.="</select>";
        return $html;
        }
        
    function getFlags()
        {
        $html="";
        $sql = "SELECT countryID,tblref_country.mediaID, source, countryName  FROM  tblmedia   right JOIN tblref_country     ON (tblmedia.mediaID = tblref_country.mediaID) order by countryName";
        $query = $this->db->query($sql);
        $html="Country<br><select id='cboPriceFlag' name='PriceFlag' value='0' class='ui-widget-content ui-corner-all' style='padding:5px;width:95%'>";
        $html.="<option value='0'>Select Country</option>";
        foreach ($query->result_array() as $row) 
            {
            $source="images/system/noflag.png";
            if($row["mediaID"]!=0) $source = $row["source"];
            $html.="<option value='".$row["countryID"]."'>".$row["countryName"]."</option>";
            }
        $html.="</select>";
        return $html;
        }
        
    function searchListCount_Price($type,$searchValue) {
        $data = 0;
        $where="";
        if($type!="")  $where = " WHERE $type LIKE '$searchValue%' ";
      
        $thesql="SELECT count(*) as 'count' FROM  tblref_country  right JOIN aimworld.tblproduct_price   ON (tblref_country.countryID = tblproduct_price.countryID) $where";
    
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            $data=$row['count'];
            }
            
        return $data;
    }

    function searchListCount_GTestimony($type,$searchValue) {
        $data = 0;
        $where="";
        if($type!="")  $where = " WHERE $type LIKE '$searchValue%' ";
      
        $thesql="SELECT count(*) as 'count' FROM  tblmedia  right JOIN aimworld.tblproduct_globaltestimony   ON (tblmedia.mediaID = tblproduct_globaltestimony.mediaID)  $where";
    
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            $data=$row['count'];
            }
            
        return $data;
    }
                    
    function searchList_Price($type,$searchValue,$sidx,$sord,$start,$limit) {
    
        $data = array();
        $where="";
        
        if($type!="")  $where = " WHERE $type LIKE '$searchValue%' ";
               
        $thesql = "SELECT priceID, tblproduct_price.countryID, countryName, priceSymbol,priceDescription, distributorPrice, retailPrice  FROM  tblref_country  right JOIN aimworld.tblproduct_price   ON (tblref_country.countryID = tblproduct_price.countryID) $where ORDER BY $sidx $sord LIMIT $start, $limit";     
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            $data[]=$row;
            }
            
        return $data;
    }	

    function searchList_GTestimony($type,$searchValue,$sidx,$sord,$start,$limit) {
    
        $data = array();
        $where="";
        
        if($type!="")  $where = " WHERE $type LIKE '$searchValue%' ";
               
        $thesql = "SELECT *  FROM  tblmedia  right JOIN aimworld.tblproduct_globaltestimony   ON (tblmedia.mediaID = tblproduct_globaltestimony.mediaID)  $where ORDER BY $sidx $sord LIMIT $start, $limit";     
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            $data[]=$row;
            }
            
        return $data;
    }	

    function checkDetailsExist($pid)
    {
        $thesql = "SELECT * from tblproduct_details where PID=".$pid;     
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            return true;
            }
        return false;    
    }

		function saveRecord_details($pid,$details,$contents, $manufactured,$piid)
    {
      if(!$this->checkDetailsExist($pid))
          {          
          $data = array(
              'PID' => $pid , 
              'details' => $details ,
              'contents' => $contents,
              'manufactured' => $manufactured,
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
    		  $this->db->insert('tblproduct_details', $data); 
    		  return true;          
          }
      else
          {
          $data = array(
              'PID' => $pid , 
              'details' => $details ,
              'contents' => $contents,
              'manufactured' => $manufactured,
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
          $this->db->where('PID', $pid);       
      		$this->db->update('tblproduct_details',$data);           
          }
    }


    
		function saveRecord_price($countryID,$pid,$priceSymbol,$priceDescription, $distributorPrice,$retailPrice,$id,$piid)
    {
      if($id=="0")
          {
          $priceID = $this->nextID("priceID","tblproduct_price");
          
          $data = array(
              'priceID' => $priceID ,
              'PID' => $pid ,              
              'countryID' => $countryID,
              'priceSymbol' => $priceSymbol,
              'priceDescription' =>$priceDescription,
              'distributorPrice' => $distributorPrice,
              'retailPrice' => $retailPrice,
              'createdBy' => $piid,
              'createdDt' => date('Y-m-d H:i:s', time()),
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
    		  $this->db->insert('tblproduct_price', $data); 
    		  return true;          
          }
      else
          {
          $data = array(
              'PID' => $pid ,              
              'countryID' => $countryID,
              'priceSymbol' => $priceSymbol,
              'priceDescription' =>$priceDescription,
              'distributorPrice' => $distributorPrice,
              'retailPrice' => $retailPrice,
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
          $this->db->where('priceID', $id);       
      		$this->db->update('tblproduct_price',$data);           
          }

    }

		function saveRecord_gtestimony($pid,$mediaID,$category,$title, $subtitle,$content,$url,$tagname,$id,$piid)
    {
      if($id=="0")
          {
          $GTID = $this->nextID("GTID","tblproduct_globaltestimony");
          
          $data = array(
              'GTID' => $GTID ,
              'PID' => $pid ,    
              'mediaID' => $mediaID,          
              'category' => $category,
              'title' => $title,
              'subtitle' =>$subtitle,
              'content' => $content,
              'url' => $url,
              'tagname' => $tagname,
              'createdBy' => $piid,
              'createdDt' => date('Y-m-d H:i:s', time()),
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
    		  $this->db->insert('tblproduct_globaltestimony', $data); 
    		  return true;          
          }
      else
          {
          $data = array(           
              'PID' => $pid ,              
              'mediaID' => $mediaID,    
              'category' => $category,
              'title' => $title,
              'subtitle' =>$subtitle,
              'content' => $content,
              'url' => $url,
              'tagname' => $tagname,
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
          $this->db->where('GTID', $id);       
      		$this->db->update('tblproduct_globaltestimony',$data);           
          }

    }
        
    function delete_record_price($id)
  	{
  		$this->db->where('priceID', $id);
  		$this->db->delete('tblproduct_price'); 
  		return true;
  	} 

    function delete_record_gtestimony($id)
  	{
  		$this->db->where('GTID', $id);
  		$this->db->delete('tblproduct_globaltestimony'); 
  		return true;
  	} 
  	
    function add_media($ext, $source,$piid)
    {     
    $curDate = date("Ymd");
          $mediaID = $this->nextID("mediaID","tblmedia");
          $fileNamex = "picture".$piid.$mediaID.$curDate.".".$ext;
          $source = $source.$fileNamex;
          $data = array(
  		        'mediaID' => $mediaID,
              'type' => 'upload' ,
              'fileName' =>$fileNamex,
              'categoryFolder' => 'countries',
              'source' => $source,
              'uploadedBy' => $piid,
              'uploadedDt' => date('Y-m-d H:i:s', time())
          );    
    		  $this->db->insert('tblmedia', $data); 
    		  return $mediaID.'~'.$source;       
    }
    
}
?>
