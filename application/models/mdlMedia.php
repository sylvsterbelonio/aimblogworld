<?php
class mdlMedia extends CI_Model   {

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
     
    function open_media($mediaID)
        {
        $data="";
        $sql = "SELECT mediaID, `type`, categoryFolder, fileName, source, CONCAT(firstName,' ',lastName) as 'name',uploadedDt FROM  tblpersonalinfo INNER JOIN tblmedia    ON (tblpersonalinfo.PIID = tblmedia.uploadedBy) where mediaID=$mediaID";
        $query = $this->db->query($sql);
        
        
        
        foreach ($query->result_array() as $row) 
            {
            $baseSource = base_url().$row["source"];
            
            $data = $row["mediaID"]."~".$row["type"]."~".$row["categoryFolder"]."~".$row["fileName"]."~".$baseSource."~".$row["name"]."~".$row["uploadedDt"];
            }       
         return $data; 
        }    
           
    function getCategory()
        {
        $html="";
        $sql = "select distinct categoryFolder from tblmedia order by categoryFolder";
        $query = $this->db->query($sql);
        $html="<select id='cboMediaCategorFolder' name='MediaCategorFolder' value='0' class='ui-widget-content ui-corner-left' style='padding:5px;width:100%'>";
        $html.="<option value=''>Select Category Folder</option>";
        foreach ($query->result_array() as $row) 
            {
            $html.="<option value='".$row["categoryFolder"]."'>".$row["categoryFolder"]."</option>";
            }
        $html.="<option value='x'>-Select All-</option>";
        $html.="</select>";
        return $html;
        }
        
    function add_media($ext,$folder, $source,$piid)
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
    
    function getMediaList($categoryName,$piid,$page,$order)
        {
        
        if($categoryName=="x") $categoryName="";
        $html="";  
        $count=0;
        $total_pages=0;
        $totalRecords=0;
        $sql = "SELECT count(*) as 'count'  FROM   tblpersonalinfo   INNER JOIN tblmedia     ON (tblpersonalinfo.PIID = tblmedia.uploadedBy) where categoryFolder like '$categoryName%' and piid=$piid order by $order";
        $query = $this->db->query($sql); 
        
        $section=0;
        foreach ($query->result_array() as $row) 
          {
          $count = $row["count"];
          }


        if( $count > 0 ) {
            $total_pages = ceil($count/15);
        } else {
            $total_pages = 0;
        }

        if ($page > $total_pages) $page=$total_pages;        
        $start = 15*$page - 15;
        if($start <0) $start = 0;  
        
        $startTot = $start+15;
        if ($startTot>$count) $startTot = $count;
        
          $html.='
          <table border=0 style="width:100%">
          <tr>
          <td colspan=5 style="padding:5px">
          <div class="ui-widget-header ui-corner-all">
          <h4 align=center>'.$startTot.' of '.$count.' Views</h4>
          </div>
          </td>
          </tr>
          <tr>';  
        
                             
          $sql = "SELECT mediaID, categoryFolder, fileName, source, concat(firstName,' ', lastName) as 'uploadedBy', uploadedDt  FROM   tblpersonalinfo   INNER JOIN tblmedia     ON (tblpersonalinfo.PIID = tblmedia.uploadedBy) where categoryFolder like '$categoryName%' and piid=$piid order by $order LIMIT $start, 15";
          $query = $this->db->query($sql);        
          foreach ($query->result_array() as $row) 
            {
            if($section % 5 ==0){$html.='</tr><tr>';}
            
            $html.='
                  <td style="width:10%;padding:5px" valign="top">
                  <div alt="" OnMouseOver="setMediaMouseOver(this);" OnMouseOut="setMediaMouseOut(this);" OnClick="clickMedia(this);" class="ui-widget-content ui-corner-all" style="width:94%;padding:5px;background-image: url(\'images/gif/load.gif\');background-repeat:no-repeat;background-position: center;">
                  <span OnMouseOver="setMediaMouseOverClose(this);" OnMouseOut="setMediaMouseOutClose(this);" OnClick="MediaDelete(\''.$row["mediaID"].'\',\''.$row["source"].'\');" class="ui-widget-header ui-corner-all" style="float:right;margin-bottom:5px;"><span  class="ui-icon ui-icon-closethick"></span></span>
                  
                  <table style="width:100%" align=center><tr><td align=center>
                  <img title="'.$row["fileName"].'" class="ui-corner-all" src="'.$row["source"].'"  width=150>
                  </td></tr></table>
                  
                  <table style="width:100%" align=center>
                  <tr><td align=center>
                  <span style="font-size:10px;word-wrap: break-word;">'.$row["fileName"].'</span><br>
                  <span style="font-size:9px">'.$row["uploadedDt"].'</span><br>
                  <span style="font-size:9px"><i>'.$row["uploadedBy"].'</li></span>
                  </td></tr>
                  </table>
                  </div>
                  </td>';
            $section++;
            }
             
       
            if ($page > $total_pages) $page=$total_pages;  
                       
            $html.='
                        </tr>
                        <tr>
                        <td colspan=5 style="padding:5px">';
                        
            if($page==1 && $count<=15)
              {
            $html.= '
                        <button id="cmdMediaPrev" OnMouseOver="setNavigationHover(this);" OnMouseOut="setNavigationOut(this);" OnClick="clickNavigation(this);" id="cmdPrevMedia" class="ui-state-disabled ui-corner-all " disabled="disabled" style="padding-bottom:4px;float:left"><span class="ui-icon ui-icon-seek-prev" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Prev</span></button>
                        <button id="cmdMediaNext" alt="" OnMouseOver="setNavigationHover(this);" OnMouseOut="setNavigationOut(this);" OnClick="clickNavigation(this);" id="cmdNextMedia" class="ui-state-disabled ui-corner-all" disabled="disabled" style="padding-bottom:4px;float:right"><span class="ui-icon ui-icon-seek-next" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Next</span></button>
                    '; 
              }
            else if($page==1 && $count>15)
              {
              $page+=1;
              $html.= '
                        <button id="cmdMediaPrev"  OnMouseOver="setNavigationHover(this);" OnMouseOut="setNavigationOut(this);" OnClick="clickNavigation(this);"  class="ui-state-disabled ui-corner-all " disabled="disabled" style="padding-bottom:4px;float:left"><span class="ui-icon ui-icon-seek-prev" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Prev</span></button>
                        <button id="cmdMediaNext"  alt="'.$page.'" OnMouseOver="setNavigationHover(this);" OnMouseOut="setNavigationOut(this);" OnClick="clickNavigation(this);"  class="ui-state-default ui-corner-all"  style="padding-bottom:4px;float:right"><span class="ui-icon ui-icon-seek-next" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Next</span></button>
                    ';           
              }
            else if($page>1)
              {
                $test_page = $page+1;
                if($test_page<=$total_pages)
                  {
                  $prevPage = $page-1;
                  $nextPage = $page+1;  
                  $html.= '
                          <button id="cmdMediaPrev" alt="'.$prevPage.'" OnMouseOver="setNavigationHover(this);" OnMouseOut="setNavigationOut(this);" OnClick="clickNavigation(this);"  class="ui-state-default ui-corner-all "  style="padding-bottom:4px;float:left"><span class="ui-icon ui-icon-seek-prev" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Prev</span></button>
                          <button id="cmdMediaNext" alt="'.$nextPage.'" OnMouseOver="setNavigationHover(this);" OnMouseOut="setNavigationOut(this);" OnClick="clickNavigation(this);"  class="ui-state-default ui-corner-all"  style="padding-bottom:4px;float:right"><span class="ui-icon ui-icon-seek-next" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Next</span></button>
                           ';               
                  }
                else
                  {
                  $prevPage = $page-1;
                  $html.= '
                          <button id="cmdMediaPrev" alt="'.$prevPage.'" OnMouseOver="setNavigationHover(this);" OnMouseOut="setNavigationOut(this);" OnClick="clickNavigation(this);"  class="ui-state-default ui-corner-all "  style="padding-bottom:4px;float:left"><span class="ui-icon ui-icon-seek-prev" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Prev</span></button>
                          <button id="cmdMediaNext"  OnMouseOver="setNavigationHover(this);" OnMouseOut="setNavigationOut(this);" OnClick="clickNavigation(this);"  class="ui-state-disabled ui-corner-all" disabled="disabled" style="padding-bottom:4px;float:right"><span class="ui-icon ui-icon-seek-next" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Next</span></button>
                           ';               
                  } 
              }
            else 
              {
              $html.= '
                          <button id="cmdMediaPrev" OnMouseOver="setNavigationHover(this);" OnMouseOut="setNavigationOut(this);" OnClick="clickNavigation(this);"  class="ui-state-disabeld ui-corner-all " disabled="disabled" style="padding-bottom:4px;float:left"><span class="ui-icon ui-icon-seek-prev" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Prev</span></button>
                          <button id="cmdMediaNext" alt="'.$page.'" OnMouseOver="setNavigationHover(this);" OnMouseOut="setNavigationOut(this);" OnClick="clickNavigation(this);"  class="ui-state-disabled ui-corner-all" disabled="disabled" style="padding-bottom:4px;float:right"><span class="ui-icon ui-icon-seek-next" style="float:left;margin-right:5px;margin-top:0px"></span><span style="float:right">Next</span></button>
                      ';             
              }
            
            
            $html.='
                        </td>
                        </tr>
                  </table>      
                  ';
            
            return $html;
        }
    
    function deleteMedia($mediaID)
  	{
  		$this->db->where('mediaID', $mediaID);
  		$this->db->delete('tblmedia'); 
  		return true;
  	}          

}

?>
