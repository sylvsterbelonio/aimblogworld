<?php
class mdlPackage extends CI_Model   {

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

    function getPackage()
        {
        $html="";
        $sql = "SELECT tblpackage.packageID, countryName, packageName FROM   tblref_country right JOIN tblpackage      ON (tblref_country.countryID = tblpackage.countryID) order by countryName, packagename";
        $query = $this->db->query($sql);
        $html="<select id='cboselPackageItem' name='selPackageItem' value='0' class='ui-widget-content ui-corner-all' style='padding:5px;width:100%'>";
        $html.="<option value='0'>Select Package</option>";
        foreach ($query->result_array() as $row) 
            {
            if($row["countryName"]!="" && $row["packageName"]!="")  $html.="<option value='".$row["packageID"]."'>".$row["countryName"]."-".$row["packageName"]."</option>";
            else $html.="<option value='".$row["packageID"]."'>".$row["packageName"]."</option>";
            }
        $html.="</select>";
        return $html;
        }
        
    function getProduct()
        {
        $html="";
        $sql = "select PID, productName from tblproduct order by productName";
        $query = $this->db->query($sql);
        $html="<select id='cboselPackageProduct' name='selPackageProduct' value='0' class='ui-widget-content ui-corner-left' style='padding:5px;width:100%'>";
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
        $html="Country<br><select id='cboPackageFlag' name='PackageFlag' value='0' class='ui-widget-content ui-corner-all' style='padding:5px;width:97%'>";
        $html.="<option value='0'>Select Country</option>";
        foreach ($query->result_array() as $row) 
            {
            $source="images/system/noflag.png";
            if($row["mediaID"]!=0) $source = $row["source"];
            $html.="<option value='".$row["countryID"]."'><img src='".$source."' height=20 width=30>".$row["countryName"]."</option>";
            }
        $html.="</select>";
        return $html;
        }
    
    function searchList($type,$searchValue,$sidx,$sord,$start,$limit) {
    
        $data = array();
        $where="";
        
        if($type!="")  $where = " WHERE $type LIKE '$searchValue%' ";
                   
        $thesql = "SELECT packageID, tblpackage.countryID, countryName, tblpackage.mediaID, source, packageName, price, priceSymbol, priceDescription, weight FROM   tblmedia   right JOIN tblpackage     ON (tblmedia.mediaID = tblpackage.mediaID)    left JOIN aimworld.tblref_country    ON (tblref_country.countryID = tblpackage.countryID) $where ORDER BY $sidx $sord LIMIT $start, $limit";     
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            $data[]=$row;
            }
            
        return $data;
    }	

    function searchList_item($type,$searchValue,$sidx,$sord,$start,$limit) {
    
        $data = array();
        $where="";
        
        if($type!="")  $where = " WHERE $type = $searchValue ";
                   
        $thesql = "SELECT itemID, tblpackage_item.PID, productName, quantity FROM   tblpackage   INNER JOIN tblpackage_item     ON (tblpackage.packageID = tblpackage_item.packageID)   INNER JOIN aimworld.tblproduct    ON (tblproduct.PID = tblpackage_item.PID) $where ORDER BY $sidx $sord LIMIT $start, $limit";     
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            $data[]=$row;
            }
            
        return $data;
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
              'categoryFolder' => 'packages',
              'source' => $source,
              'uploadedBy' => $piid,
              'uploadedDt' => date('Y-m-d H:i:s', time())
          );    
    		  $this->db->insert('tblmedia', $data); 
    		  return $mediaID.'~'.$source;       
    }
    
    function searchListCount($type,$searchValue) {
        $data = 0;
        $where="";
        if($type!="")  $where = " WHERE $type LIKE '$searchValue%'' ";
      
        $thesql="SELECT count(*) as 'count' FROM   tblmedia   right JOIN tblpackage     ON (tblmedia.mediaID = tblpackage.mediaID)    left JOIN aimworld.tblref_country    ON (tblref_country.countryID = tblpackage.countryID) $where";
    
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            $data=$row['count'];
            }
            
        return $data;
    }

    function searchListCount_item($type,$searchValue) {
        $data = 0;
        $where="";
        if($type!="")  $where = " WHERE $type = $searchValue ";
      
        $thesql="SELECT count(*) as 'count' FROM   tblpackage   INNER JOIN tblpackage_item     ON (tblpackage.packageID = tblpackage_item.packageID)   INNER JOIN aimworld.tblproduct    ON (tblproduct.PID = tblpackage_item.PID) $where";
    
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            $data=$row['count'];
            }
            
        return $data;
    }

		function add_item($packageID,$PID,$quantity,$piid)
    {
          $itemID = $this->nextID("itemID","tblpackage_item");    
          $data = array(
              'itemID' => $itemID,
              'packageID' => $packageID,
              'PID' => $PID ,              
              '`quantity`' => $quantity,
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
    		  $this->db->insert('tblpackage_item', $data); 
    		  return true;          
    }

    function delete_item($id)
  	{
  		$this->db->where('itemID', $id);
  		$this->db->delete('tblpackage_item'); 
  		return true;
  	} 
        
		function save_record($countryID,$mediaID,$packageName,$price, $priceSymbol,$priceDescription,$weight,$id,$piid)
    {
      if($id=="0")
          {
          $packageID = $this->nextID("packageID","tblpackage");    
          $data = array(
              'packageID' => $packageID,
              'countryID' => $countryID ,              
              'mediaID' => $mediaID,
              '`packageName`' => $packageName,
              'price' => $price,
              'priceSymbol' => $priceSymbol,
              'priceDescription' => $priceDescription,
              'weight' => $weight,
              'createdBy' => $piid,
              'createdDt' => date('Y-m-d H:i:s', time()),
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
    		  $this->db->insert('tblpackage', $data); 
    		  return true;          
          }
      else
          {
          $data = array(
              'countryID' => $countryID ,              
              'mediaID' => $mediaID,
              '`packageName`' => $packageName,
              'price' => $price,
              'priceSymbol' => $priceSymbol,
              'priceDescription' => $priceDescription,
              'weight' => $weight,
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
          $this->db->where('packageID', $id);       
      		$this->db->update('tblpackage',$data);           
          }

    }
    
    function delete_record($id)
  	{
  		$this->db->where('packageID', $id);
  		$this->db->delete('tblpackage'); 
  		return true;
  	} 

}
?>
