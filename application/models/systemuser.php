<?php

class systemuser extends CI_Model   {

   public function __construct()
        {
                parent::__construct();
        }
        
	function retrieve_user($username)
	{
		$query = $this->db->get_where('tblsystemuser', array('username' => $username));
		if ($query->num_rows() > 0)
		{
		   	return $query->row();
		} else {
			return false;
		}
	}	  
        
	function validate_user($username, $password)
	{
	$data="";
	
  $thesql = "SELECT *  FROM tblsystemuser where username = '" . $username . "' and password = md5('" . $password . "')";
  $query = $this->db->query($thesql);
  foreach ($query->result_array() as $row) {
            $data=$row;
        }
        return $data;    
	}
	
	function get_current_user_info($username, $password)
	{
	$sql = "SELECT tblpersonalinfo.PIID, concat(firstName,' ' ,middleName,' ',lastName) as 'name',tblsystemuser_level.userLevelID, tblsystemuser_level.name as 'desc',emailAddress FROM   tblsystemuser_level   INNER JOIN tblsystemuser    ON (tblsystemuser_level.userLevelID = tblsystemuser.userLevel)  INNER JOIN tblpersonalinfo     ON (tblpersonalinfo.PIID = tblsystemuser.PIID) where username = '" . $username . "' and password = md5('" . $password . "')";
	$query = $this->db->query($sql);
  foreach ($query->result_array() as $row) {
            $data=$row['PIID'].'~'.$row['name'].'~'.$row['userLevelID'].'~'.$row['emailAddress'].'~'.$row['desc'];
        }
        return $data;    
	}
		

}
?>
