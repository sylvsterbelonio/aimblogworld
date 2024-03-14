<?php
class mdlCustomer extends CI_Model   {

    public function __construct()
        {
                parent::__construct();
                
        $this->load->library('encrypt');
        $this->load->library('Crypt');
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

    function checkEmailDuplication($emailAddress)
        {
        $query = $this->db->get_where('tblcustomers', array('emailAddress' => $emailAddress));
        if ($query->num_rows() == 1)
        { 
            return true;
        }
        return false;
        } 
            
    function log_in_Customer($emailAddress,$password)
        {
        $password = $this->crypt->encrypt($password);
        $query = $this->db->get_where('tblcustomers', array('emailAddress' => $emailAddress,'password' => $password));
        if ($query->num_rows() == 1)
        { 
            foreach ($query->result() as $row)
            {
            return $row->customerID.'~'.$row->customerBy;
            }
        }
        return "";
        } 
        
    function get_CustomerName($customerID)
        {
        $query = $this->db->get_where('tblcustomers', array('customerID' => $customerID));
        if ($query->num_rows() == 1)
        { 
            foreach ($query->result() as $row)
            {
            return $row->firstName." ".$row->middleName." ".$row->lastName;
            }
        }
        return "Guest";        
        }    

    function countRank($piid,$section, $type,$refID)
        {
        $where="";
        if($piid!=0) $where = " and PIID= $piid";
        $sql="select count(*) as count from tblblogs_rankhits where sectionType='$section' and `type`='$type' and refID=$refID $where";
        $query = $this->db->query($sql);   
        foreach ($query->result() as $row)
            {
            return $row->count;
            }
        return 0;           
        }
               
    function hit_lovelike($refID,$type,$sectionType,$customerID,$piid)
        {
        $query = $this->db->get_where('tblblogs_rankhits', array('customerID' => $customerID, 'refID' => $refID,'sectionType'=>$sectionType ));
        if ($query->num_rows() == 0)
        { 
              $likeID = $this->nextID("likeID","tblblogs_rankhits");
              $data = array(
      		        'likeID' => $likeID,
      		        'PIID' => $piid,
                  'customerID' => $customerID ,
                  'sectionType' => $sectionType,
                  'type' => $type,
                  'refID' => $refID,
                  'dateLiked' => date('Y-m-d H:i:s', time()),
                  'ipaddress' => $this->input->ip_address()
              );
        		  $this->db->insert('tblblogs_rankhits', $data);        
              
              return '1~<img src="'.base_url().'images/system/'.$sectionType.'.png" height=9 width=10><span>'.$this->countRank($piid,"like","products",$refID).'</span>';
              }        
        
        else
        {
            foreach ($query->result() as $row)
            {
              		$this->db->where('likeID', $row->likeID);
  	             	$this->db->delete('tblblogs_rankhits'); 
  	          return '0~<img src="'.base_url().'images/system/'.$sectionType.'.png" height=9 width=10><span>'.$this->countRank($piid,"love","products",$refID).'</span>';

            }        
        }
                
        
        }
    
    function add_Customer($piid,$id,$fname,$mname,$lname,$address,$contactNo,$email,$password)
        {     
          $curDate = date("Ymd");
          $customerID = $id;
          if($id=="0")
              {
              $customerID = $this->nextID("customerID","tblcustomers");
              $data = array(
      		        'customerID' => $customerID,
                  'firstName' => $fname ,
                  'middleName' => $mname,
                  'lastName' => $lname,
                  'address' => $address,
                  'contactNo' => $contactNo,
                  'emailAddress' => $email,
                  'password' => $this->crypt->encrypt($password),
                  'customerBy' => $piid,
                  'createdBy' => $customerID,
                  'createdDt' => date('Y-m-d H:i:s', time()),
                  'updatedBy' => $customerID,
                  'updatedDt' => date('Y-m-d H:i:s', time())
              );
        		  $this->db->insert('tblcustomers', $data);        
              }
          else
              {
              $data = array(
                  'firstName' => $fname ,
                  'middleName' => $mname,
                  'lastName' => $lname,
                  'address' => $address,
                  'contactNo' => $contactNo,
                  'emailAddress' => $email,
                  'password' => $this->encrypt->encode($password),
                  'updatedBy' => $customerID,
                  'updatedDt' => date('Y-m-d H:i:s', time())
              );
              $this->db->where('customerID', $customerID);       
          		$this->db->update('tblcustomers',$data);           
              }
         return $customerID;    
        }          
}
?>
