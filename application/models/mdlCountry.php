<?php
class mdlCountry extends CI_Model   {

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
        
    function searchList($type,$searchValue,$sidx,$sord,$start,$limit) {
    
        $data = array();
        $where="";
        
        if ($type == "countryName") 
            {
            $where=" WHERE countryName LIKE '".$searchValue."%' ";
            }
            
        $thesql = "SELECT countryID,tblref_country.mediaID,source,countryName FROM  tblmedia  right JOIN  tblref_country    ON (tblmedia.mediaID = tblref_country.mediaID) $where ORDER BY $sidx $sord LIMIT $start, $limit";     
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            $data[]=$row;
            }
            
        return $data;
    }	

    function searchListCount($type,$searchValue) {
    
        $data = 0;
        
        if ($type == "countryName") 
            {
            $thesql="SELECT count(*) as 'count' FROM  tblmedia  right JOIN  tblref_country    ON (tblmedia.mediaID = tblref_country.mediaID) WHERE countryName LIKE '".$searchValue."%'";
            }
        else
            {
            $thesql = "SELECT count(*) as 'count' FROM  tblmedia  right JOIN  tblref_country    ON (tblmedia.mediaID = tblref_country.mediaID)";                 
            }
            
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            $data=$row['count'];
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
              'categoryFolder' => 'countries',
              'source' => $source,
              'uploadedBy' => $piid,
              'uploadedDt' => date('Y-m-d H:i:s', time())
          );    
    		  $this->db->insert('tblmedia', $data); 
    		  return $mediaID.'~'.$source;       
    }
    
    
		function save_record($imgSrc,$countryName,$id,$piid)
    {    
      
      if($id=="0")
          {
          $data = array(
  		        'countryID' => $this->nextID("countryID","tblref_country"),
              'mediaID' => $imgSrc ,
              'countryName' => $countryName,
              'createdBy' => $piid,
              'createdDt' => date('Y-m-d H:i:s', time()),
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
    		  $this->db->insert('tblref_country', $data); 
    		  return true;          
          }
      else
          {
          $data = array(
              'mediaID' => $imgSrc ,
              'countryName' => $countryName ,
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
          $this->db->where('countryID', $id);       
      		$this->db->update('tblref_country',$data);           
          }
    }
    
    function delete_record($id)
  	{
  		$this->db->where('countryID', $id);
  		$this->db->delete('tblref_country'); 
  		return true;
  	} 

}
?>
