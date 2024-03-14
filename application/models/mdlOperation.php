<?php
class mdlOperation extends CI_Model   {

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
    
    function getFlags()
        {
        $html="";
        $sql = "SELECT countryID,tblref_country.mediaID, source, countryName  FROM  tblmedia   right JOIN tblref_country     ON (tblmedia.mediaID = tblref_country.mediaID) order by countryName";
        $query = $this->db->query($sql);
        $html="Country<br><select id='cboOperationFlag' name='BCOFlag' value='0' class='ui-widget-content ui-corner-all' style='padding:5px;width:95%'>";
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
                   
        $thesql = "SELECT operationID, tbloperation.countryID, countryName, `name`, `position`, address, telNo,contactNo FROM    tblref_country   right JOIN  tbloperation    ON (tblref_country.countryID = tbloperation.countryID) $where ORDER BY $sidx $sord LIMIT $start, $limit";     
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            $data[]=$row;
            }
            
        return $data;
    }	

    function searchListCount($type,$searchValue) {
        $data = 0;
        $where="";
        if($type!="")  $where = " WHERE $type LIKE '$searchValue%' ";
      
        $thesql="SELECT count(*) as 'count' FROM    tblref_country   right JOIN  tbloperation    ON (tblref_country.countryID = tbloperation.countryID) $where";
    
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            $data=$row['count'];
            }
            
        return $data;
    }
    
		function save_record($countryID,$name,$position, $address,$contactNo,$telNo,$id,$piid)
    {
      if($id=="0")
          {
          $positionID = $this->nextID("operationID","tbloperation");
          
          $data = array(
              'operationID' => $positionID ,
              'countryID' => $countryID ,              
              '`name`' => $name,
              '`position`' => $position,
              'address' => $address,
              'contactNo' => $contactNo,
              'telNo' => $telNo,
              'createdBy' => $piid,
              'createdDt' => date('Y-m-d H:i:s', time()),
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
    		  $this->db->insert('tbloperation', $data); 
    		  return true;          
          }
      else
          {
          $data = array(
              'countryID' => $countryID ,
              '`name`' => $name,
              '`position`' => $position,
              'address' => $address,
              'contactNo' => $contactNo,
              'telNo' => $telNo,
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
          $this->db->where('operationID', $id);       
      		$this->db->update('tbloperation',$data);           
          }

    }
    
    function delete_record($id)
  	{
  		$this->db->where('operationID', $id);
  		$this->db->delete('tbloperation'); 
  		return true;
  	} 

}
?>
