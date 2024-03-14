<?php
class mdlAdmin extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
        }
       
 function getAccordionSubMenu($CID,$userLevel,$PIID)
        {
        $html="";
      	$sql = "SELECT tbladmin_menu.SID, tbladmin_menu.CID, tbladmin_menu_type.categoryMenuName, menuName,imgsrc,route,tooltip FROM    tbladmin_menu_access  INNER JOIN  tbladmin_menu      ON (tbladmin_menu_access.SID = tbladmin_menu.SID)  INNER JOIN  tbladmin_menu_type    ON (tbladmin_menu_type.CID = tbladmin_menu.CID) where tbladmin_menu_access.userLevelD=$userLevel and tbladmin_menu.CID=$CID order by tbladmin_menu_type.order,tbladmin_menu.order";
      	$query = $this->db->query($sql);   
      	
      	$html="<table border=0  align=center style='padding:5;width:100%'>";
      	$html.='<tr>';
      	$section=0;
      	
        foreach ($query->result_array() as $row) 
              {
              if($section % 3 ==0){$html.='</tr><tr>';}
              $html.='<td align=center style="padding-bottom:15px">';
              $html.='<button  id="id'.$row["SID"].'-'.$row["SID"].'x" onclick="setMenuClick(\'id'.$row["SID"].'\',\''.$row["menuName"].'\',\''.$row["route"].'\',\''.$PIID.'\')" onmouseover="setMenuMouseOver(this)" onmouseout="setMenuMouseOut(this)"  alt="'.$PIID.'" title="'.$row["tooltip"].'" class="ui-state-default ui-corner-all" style="width:55px;height:55px;padding:4px;margin:auto ">';
              $html.='<img onmouseover="setMenuMouseOver(document.getElementById(\'id'.$row["SID"].'-'.$row["SID"].'x\'))" onmouseout="setMenuMouseOut(document.getElementById(\'id'.$row["SID"].'-'.$row["SID"].'x\'))" src="'.base_url().$row["imgsrc"].'" width=40 height=40>';
              $html.='</button></td>';
              $section++;      
              }
        $html.="</tr></table>";
        return $html;   
        }      
        
 function getAccordionMenu($userLevel,$PIID)
        {
      	$sql = "SELECT tbladmin_menu.SID, tbladmin_menu.CID, tbladmin_menu_type.categoryMenuName, menuName,imgsrc,route,tooltip FROM    tbladmin_menu_access  INNER JOIN  tbladmin_menu      ON (tbladmin_menu_access.SID = tbladmin_menu.SID)  INNER JOIN  tbladmin_menu_type    ON (tbladmin_menu_type.CID = tbladmin_menu.CID) where tbladmin_menu_access.userLevelD=$userLevel order by tbladmin_menu_type.order,tbladmin_menu.order";
      	$query = $this->db->query($sql);
      	
      	$groupName="";
      	$html="";
        foreach ($query->result_array() as $row) 
              {
              if($groupName=="")
                {
                $html.="<h3>".$row['categoryMenuName']."</h3>";
                $html.="<div>".$this->getAccordionSubMenu($row["CID"],$userLevel,$PIID)."</div>";
                $groupName = $row['categoryMenuName'];
                }
              else if($groupName!=$row['categoryMenuName'])
                {
                $html.="<h3>".$row['categoryMenuName']."</h3>";
                $html.="<div>".$this->getAccordionSubMenu($row["CID"],$userLevel,$PIID)."</div>";
                $groupName = $row['categoryMenuName'];                
                }
              }
        return $html;  
        }

}


?>
