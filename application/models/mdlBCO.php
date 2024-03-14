<?php
class mdlBCO extends CI_Model   {

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
        $html="Country<br><select id='cboBCOFlag' name='BCOFlag' value='0' class='ui-widget-content ui-corner-all' style='padding:5px;width:95%'>";
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
                   
        $thesql = "SELECT bcoID, tblbco.countryID,bco, countryName, ownerName, address,contactNo, telNo FROM  tblref_country   right JOIN tblbco    ON (tblref_country.countryID = tblbco.countryID) $where ORDER BY $sidx $sord LIMIT $start, $limit";     
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
      
        $thesql="SELECT count(*) as 'count' FROM  tblref_country   right JOIN tblbco    ON (tblref_country.countryID = tblbco.countryID) $where";
    
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            $data=$row['count'];
            }
            
        return $data;
    }
    
		function save_record($countryID,$bco,$ownerName,$address,$contactNo,$telNo,$id,$piid)
    {
      if($id=="0")
          {
          $data = array(
  		        'bcoID' => $this->nextID("bcoID","tblbco"),
              'countryID' => $countryID ,
              'bco' => $bco,
              'ownerName' => $ownerName,
              'address' => $address,
              'contactNo' => $contactNo,
              'telNo' => $telNo,
              'createdBy' => $piid,
              'createdDt' => date('Y-m-d H:i:s', time()),
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
    		  $this->db->insert('tblbco', $data); 
    		  return true;          
          }
      else
          {
          $data = array(
              'countryID' => $countryID ,
              'bco' => $bco,
              'ownerName' => $ownerName,
              'address' => $address,
              'contactNo' => $contactNo,
              'telNo' => $telNo,
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
          $this->db->where('bcoID', $id);       
      		$this->db->update('tblbco',$data);           
          }

    }
    
    function delete_record($id)
  	{
  		$this->db->where('bcoID', $id);
  		$this->db->delete('tblbco'); 
  		return true;
  	} 

}
?>
