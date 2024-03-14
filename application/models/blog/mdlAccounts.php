<?php
class mdlAccounts extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
        }

 public function getUserLevel($PIID)
        {
        $data   =  "";
        $query = $this->db->get_where('tblpersonalinfo', array('siteURL' => $site));
        if ($query->num_rows() == 1)
        { 
            foreach ($query->result() as $row)
            {
            return $row->PIID;
            }
        }
        return "0";
        }

 public function getThemeID($PIID)
        {
        $data   =  "";
        $query = $this->db->get_where('tblthemes', array('PIID' => $PIID));
        if ($query->num_rows() == 1)
        { 
            foreach ($query->result() as $row)
            {
            return $row->themeID;
            }
        }
        return "1";       
        }
        
 public function checkAccountSite($site)
        {
        $data   =  "";
        $query = $this->db->get_where('tblpersonalinfo', array('siteURL' => $site));
        if ($query->num_rows() == 1)
        { 
            foreach ($query->result() as $row)
            {
            return true;
            }
        }
        return false;
        }
                 
 public function getAccountPIID($site)
        {
        $data   =  "";
        $query = $this->db->get_where('tblpersonalinfo', array('siteURL' => $site));
        if ($query->num_rows() == 1)
        { 
            foreach ($query->result() as $row)
            {
            return $row->PIID;
            }
        }
        return "0";
        }   
 public function getSiteName($piid)
        {
        $data   =  "";
        $query = $this->db->get_where('tblpersonalinfo', array('PIID' => $piid));
        if ($query->num_rows() == 1)
        { 
            foreach ($query->result() as $row)
            {
            return $row->siteURL;
            }
        }
        return "";        
        }      
 public function getPhoto_Header()
        {
        $sql = "SELECT source FROM tblmedia INNER JOIN tblpersonalinfo   ON (tblmedia.mediaID = tblpersonalinfo.mediaID) where PIID=".$this->config->item("gpiid");
        $query = $this->db->query($sql); 
        foreach ($query->result() as $row)
        {
        return base_url().$row->source;
        }
        return base_url().'images/system/nophoto.jpg';
        }
 public function getContactsInfo_Header()
        {
        $html='<div class="contact">
        <p>';
        $query = $this->db->get_where('tblpersonalinfo', array('PIID' => $this->config->item("gpiid")));
        if ($query->num_rows() == 1)
        { 
            foreach ($query->result() as $row)
            {
              $html.='<b class="yourName">'.$row->firstName.' '.$row->middleName.' '.$row->lastName.'</b></p><hr class="ui-hr">';
              $sql = "SELECT  tblpersonalinfo_contacts.type, tblpersonalinfo_contactlist.value,source,`mode`,siteurl FROM   tblpersonalinfo_contactlist  INNER JOIN tblpersonalinfo_contacts    ON (tblpersonalinfo_contactlist.contactID = tblpersonalinfo_contacts.contactID) where PIID=".$this->config->item("gpiid");
              $query2 = $this->db->query($sql); 
              foreach ($query2->result() as $row)
                {
                if ($row->mode=="View")
                  {
                  $html.='<div class="listcontacts" >
                        <img src="'.base_url().$row->source.'" width=30 height=30 style="float:left">
                        <span>'.$row->value.'</span>
                        </div>';                  
                  }
                else
                  {
                  $html.='<div class="listcontacts" >
                        <a class="person" href="'.$row->siteurl.'" target="_blank"><img src="'.base_url().$row->source.'" width=30 height=30 style="float:left">
                        <span>'.$row->value.'</span>
                        </a></div>';                     
                  }
                }
            }
        }
        else
        {
        //DEFAULT CONTACT INFO FROM HUMMER
        $query = $this->db->get_where('tblpersonalinfo', array('PIID' => 0));
        foreach ($query->result() as $row)
            {
              $html.='<b class="yourName">'.$row->firstName.' '.$row->middleName.' '.$row->lastName.'</b></p><hr class="ui-hr">';
              $sql = "SELECT  tblpersonalinfo_contacts.type, tblpersonalinfo_contactlist.value,source,`mode`,siteurl FROM   tblpersonalinfo_contactlist  INNER JOIN tblpersonalinfo_contacts    ON (tblpersonalinfo_contactlist.contactID = tblpersonalinfo_contacts.contactID) where PIID=0";
              $query2 = $this->db->query($sql); 
              foreach ($query2->result() as $row)
                {
                if ($row->mode=="View")
                  {
                  $html.='<div class="listcontacts" >
                        <img src="'.base_url().$row->source.'" width=30 height=30 style="float:left">
                        <span>'.$row->value.'</span>
                        </div>';                  
                  }
                else
                  {
                  $html.='<div class="listcontacts" >
                        <a class="person" href="'.$row->siteurl.'" target="_blank"><img src="'.base_url().$row->source.'" width=30 height=30 style="float:left">
                        <span>'.$row->value.'</span>
                        </a></div>';                     
                  }
                }            
            }
        }
        return $html;
        }
        
 public function getAuthorShort($piid)
        {
        $query = $this->db->get_where('tblpersonalinfo', array('PIID' => $piid));
        foreach ($query->result() as $row)
            {
            return substr($row->firstName,0,1).". ".$row->lastName;
            }
        return "Unknown";
        }       
        
        
}
?>
