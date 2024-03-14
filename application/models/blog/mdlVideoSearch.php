<?php
class mdlVideoSearch extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
                $this->load->library("Date");
                $this->load->library("Number");
                $this->load->library("Url");
                $this->load->library("Crypt");
                $this->load->model("blog/mdlGeneral");
                $this->load->model("mdlSystemuser");
                $this->load->model("blog/mdlAccounts");
        }
 
 private function getFormat($value)
        {
        return number_format($value);
        }      
 
 private function setImage($loc)
        {
        if($loc!="") return base_url().$loc;
        else return base_url()."images/system/video.png";
        }
 
 private function text($value)
        {
        if(strlen($value)<=25) return $value.'<br>';
        else return $value;
        }

 public function searchListVideos($type,$search,$videoVersion)
        {
        $theme = $this->mdlGeneral->getTheme();
        $html="";
        $allrecords=0;
        
        $page=1;
        
        $type = $this->crypt->decrypt($type);
        
        $start = 12*$page - 12;
        
        if($videoVersion=="All") $videoVersion="";
        
        $sql = "SELECT count(*) as 'tot' FROM  tblblog_post_content INNER JOIN tblblog_post  ON (tblblog_post_content.postID = tblblog_post.postID) INNER JOIN tblpersonalinfo   ON (tblpersonalinfo.PIID = tblblog_post.postBy) where privacy='public' and tblblog_post.type='Video' and tblblog_post.category like '".$type."%' and tblblog_post.title like '%".$search."%' and tblblog_post.languageVersion LIKE '".$videoVersion."%' order by datePublished desc";
        $query = $this->db->query($sql); 
        foreach ($query->result() as $row){$allrecords = $row->tot;}
        
        
        $sql = "SELECT featuredImage,tblblog_post.postID,tblblog_post.title,concat(firstName,' ', lastname) as 'by',views,datepublished FROM  tblblog_post_content INNER JOIN tblblog_post  ON (tblblog_post_content.postID = tblblog_post.postID) INNER JOIN tblpersonalinfo   ON (tblpersonalinfo.PIID = tblblog_post.postBy) where privacy='public' and tblblog_post.type='Video' and tblblog_post.category like '".$type."%' and tblblog_post.title like '%".$search."%' and tblblog_post.languageVersion LIKE '".$videoVersion."%' order by datePublished desc limit $start,12";
        $query = $this->db->query($sql); 
        
        $count=0;
        foreach ($query->result() as $row)
            {
            if($count==0) $html.='<tr>';
            else if($count%4==0 && $count>0) $html.="</tr><tr>";
            $html.='            
            <td valign=top class="list-wrapper-box" style="padding:5px">
              <a href="'.$this->getListVideosURL($type,$row->postID).'">
               <img oncontextmenu="return false;" src="'.$this->setImage($row->featuredImage).'" >
               <span>'.$this->text($row->title).' - <b><i>'.$this->date->getTimeGap($row->datepublished).'</i></b></span>
               <span ><b>By:</b><i>'.$row->by.'</i></span>
               <span ><b>Views:</b><i>'.$this->number->formatNumber($row->views).'</i></span>
              </a>
            </td>
            ';
   
            $count++;
            }
                     
            for($i=$count;$i<4;$i++)
                {
                $html.="<td></td>";
                }
                   
        $total_pages=0;
        //count the all records and get the sub divide//
        if( $allrecords > 12 ) $total_pages = ceil($allrecords/12);
            
      
        if($total_pages>1 && $page<$total_pages)
          {
        $html.='
        <tr id="row-'.$start.'">
        <td valign=top colspan=4 onclick="getData(this,\''.$page.'-'.$total_pages.'\',\''.base_url().'\');">
        <h2 align=center class="ui-widget-header footer-wrapper-box" >More ...</h2>
        </td>
        </tr>  
        ';          
          
          }
          
        if($allrecords==0) $html="<h3 align=center style='line-height:5'>-No Record Found-</h3>" ;    
        
        return $html."</tr>";           
        } 

 public function searchRightListVideos($type,$page,$searchTag,$videoVersion,$postID,$search)
        {
        
        $theme = $this->mdlGeneral->getTheme();
        $html="";
        $allrecords=0;        
        
        $type = $this->crypt->decrypt($type);
        if($videoVersion=="All") $videoVersion="";

        $start = 5*$page - 5;

        $sql = "SELECT count(*) as 'tot' FROM  tblblog_post_content INNER JOIN tblblog_post  ON (tblblog_post_content.postID = tblblog_post.postID) INNER JOIN tblpersonalinfo   ON (tblpersonalinfo.PIID = tblblog_post.postBy) where privacy='public' and tblblog_post.type='Video' and tblblog_post.category like '".$type."%' and tblblog_post.languageVersion LIKE '".$videoVersion."%' and tblblog_post.postID != $postID and searchTag like '%$searchTag%' and tblblog_post.title like '%".$search."%' order by datePublished desc";
        $query = $this->db->query($sql); 
        foreach ($query->result() as $row){$allrecords = $row->tot;}
          
        $sql= "SELECT featuredImage,tblblog_post.postID,tblblog_post.title,concat(firstName,' ', lastname) as 'by',views,datepublished FROM  tblblog_post_content INNER JOIN tblblog_post  ON (tblblog_post_content.postID = tblblog_post.postID) INNER JOIN tblpersonalinfo   ON (tblpersonalinfo.PIID = tblblog_post.postBy) where privacy='public' and tblblog_post.type='Video' and tblblog_post.category like '".$type."%' and tblblog_post.languageVersion LIKE '".$videoVersion."%' and tblblog_post.postID != $postID and searchTag like '%$searchTag%' and tblblog_post.title like '%".$search."%' order by datePublished desc limit $start,5";
        $query = $this->db->query($sql); 
        
        $count=0;
        foreach ($query->result() as $row)
            {
            $html.='
              <div class="right-wp-list">
              <a href="'.$this->getListVideosURL($type,$row->postID).'">
                  <div>
                      <table>
                          <tr>
                              <td valign=top><img oncontextmenu="return false;" src="'.$this->setImage($row->featuredImage).'"></td>
                              <td valign=top style="position:relative">
                                  <div><span><b>'.$this->text($row->title).'</b></span></div>
                                  <div></div>
                                  <div><i><b></b></i> '.$this->date->getTimeGap($row->datepublished).'</div>
                                  <div><span><i><b>By:</b> '.$row->by.'</i></span><span><i><b>Views:</b>'.$this->number->formatNumber($row->views).'</i></span>
                                  </div>
                              </td>
                          </tr>
                      </table>
                  </div>
              </a>
              </div> 
              ';     
            $count++;        
            }
            
          $total_pages=0;   
                 //count the all records and get the sub divide//
        if( $allrecords > 5 ) $total_pages = ceil($allrecords/5);
            
      
        if($total_pages>1 && $page<$total_pages)
          {   
         $html.='
                   <div class="right-wp-list" >
                   <h2 id="right-row-'.$start.'" onclick="getRightData(this,\''.$page.'-'.$total_pages.'\',\''.base_url().'\','.$postID.',\''.$searchTag.'\');" align=center class="ui-widget-header footer-wrapper-box">More ...</h2>
                   </div>
         ';
         }
         
         if($count==0)
            {
            $html.='<div class="right-wp-list" >
            <h3 align=center>-No Other Videos Found-</h3>
            </div>';
            }
            
         return $html;            
        
        }
 
 

 public function getRightListVideos($type,$page,$videoVersion,$postID,$searchTag)
        {
        $theme = $this->mdlGeneral->getTheme();
        $html="";
        $allrecords=0;        
        
        
        $postID = $this->crypt->decrypt($postID);
        $type = $this->crypt->decrypt($type);
        if($videoVersion=="All") $videoVersion="";
        if($videoVersion!="") $videoVersion = $this->crypt->decrypt($videoVersion);
        if($videoVersion=="All") $videoVersion="";
        
        $start = 5*$page - 5;

        $sql = "SELECT count(*) as 'tot' FROM  tblblog_post_content INNER JOIN tblblog_post  ON (tblblog_post_content.postID = tblblog_post.postID) INNER JOIN tblpersonalinfo   ON (tblpersonalinfo.PIID = tblblog_post.postBy) where privacy='public' and tblblog_post.type='Video' and tblblog_post.category like '".$type."%' and tblblog_post.languageVersion LIKE '".$videoVersion."%' and tblblog_post.postID != $postID and searchTag like '%$searchTag%' order by datePublished desc";
        $query = $this->db->query($sql); 
        foreach ($query->result() as $row){$allrecords = $row->tot;}
          
        $sql= "SELECT featuredImage,tblblog_post.postID,tblblog_post.title,concat(firstName,' ', lastname) as 'by',views,datepublished FROM  tblblog_post_content INNER JOIN tblblog_post  ON (tblblog_post_content.postID = tblblog_post.postID) INNER JOIN tblpersonalinfo   ON (tblpersonalinfo.PIID = tblblog_post.postBy) where privacy='public' and tblblog_post.type='Video' and tblblog_post.category like '".$type."%' and tblblog_post.languageVersion LIKE '".$videoVersion."%' and tblblog_post.postID != $postID and searchTag like '%$searchTag%' order by datePublished desc limit $start,5";
        $query = $this->db->query($sql); 
        
        $count=0;
        foreach ($query->result() as $row)
            {
            $html.='
              <div class="right-wp-list">
              <a href="'.$this->getListVideosURL($type,$row->postID).'">
                  <div>
                      <table>
                          <tr>
                              <td valign=top><img oncontextmenu="return false;" src="'.$this->setImage($row->featuredImage).'"></td>
                              <td valign=top style="position:relative">
                                  <div><span><b>'.$this->text($row->title).'</b></span></div>
                                  <div></div>
                                  <div><i><b></b></i> '.$this->date->getTimeGap($row->datepublished).'</div>
                                  <div><span><i><b>By:</b> '.$row->by.'</i></span><span><i><b>Views:</b>'.$this->number->formatNumber($row->views).'</i></span>
                                  </div>
                              </td>
                          </tr>
                      </table>
                  </div>
              </a>
              </div> 
              ';     
            $count++;        
            }
            
          $total_pages=0;   
                 //count the all records and get the sub divide//
        if( $allrecords > 5 ) $total_pages = ceil($allrecords/5);
            
      
        if($total_pages>1 && $page<$total_pages)
          {   
         $html.='
                   <div class="right-wp-list" >
                   <h2 id="right-row-'.$start.'" onclick="getRightData(this,\''.$page.'-'.$total_pages.'\',\''.base_url().'\','.$postID.',\''.$searchTag.'\',\''.$type.'\');" align=center class="ui-widget-header footer-wrapper-box">More ...</h2>
                   </div>
                ';
         }
         
         if($count==0)
            {
            $html.='<div class="right-wp-list" >
            <h3 align=center>-No Other Videos Found-</h3>
            </div>';
            }
            
         return $html;                           
        }
      
        private function getListVideosURL($type,$postID)
            {
            if($type=="Product Info")
                return $this->url->getSiteSourcePost("learnmore","learnmore/product-presentation?post=".$this->crypt->encrypt($postID));
            else if ($type=="Training Event")
                return $this->url->getSiteSourcePost("learnmore","learnmore/aim-trainings?post=".$this->crypt->encrypt($postID));
            }
        
        
 public function getListVideos($type,$page,$videoVersion)
        {
        $theme = $this->mdlGeneral->getTheme();
        $html="";
        $allrecords=0;
        

        $type = $this->crypt->decrypt($type);
        if($videoVersion=="All") $videoVersion="";
        if($videoVersion!="") $videoVersion = $this->crypt->decrypt($videoVersion);
        
        
        $start = 12*$page - 12;
        
        
        $sql = "SELECT count(*) as 'tot' FROM  tblblog_post_content INNER JOIN tblblog_post  ON (tblblog_post_content.postID = tblblog_post.postID) INNER JOIN tblpersonalinfo   ON (tblpersonalinfo.PIID = tblblog_post.postBy) where privacy='public' and tblblog_post.type='Video' and tblblog_post.category like '".$type."%' and tblblog_post.languageVersion LIKE '".$videoVersion."%' order by datePublished desc";
        $query = $this->db->query($sql); 
        foreach ($query->result() as $row){$allrecords = $row->tot;}
        
        
        $sql = "SELECT featuredImage,tblblog_post.postID,tblblog_post.title,concat(firstName,' ', lastname) as 'by',views,datepublished FROM  tblblog_post_content INNER JOIN tblblog_post  ON (tblblog_post_content.postID = tblblog_post.postID) INNER JOIN tblpersonalinfo   ON (tblpersonalinfo.PIID = tblblog_post.postBy) where privacy='public' and tblblog_post.type='Video' and tblblog_post.category like '".$type."%' and tblblog_post.languageVersion LIKE '".$videoVersion."%' order by datePublished desc limit $start,12";
        $query = $this->db->query($sql); 
        

        $count=0;
        foreach ($query->result() as $row)
            {
            if($count==0) $html.='<tr>';
            else if($count%4==0 && $count>0) $html.="</tr><tr>";
            $html.='            
            <td valign=top class="list-wrapper-box" style="padding:5px">
              <a href="'.$this->getListVideosURL($type,$row->postID).'">
               <img oncontextmenu="return false;" src="'.$this->setImage($row->featuredImage).'" >
               <span>'.$this->text($row->title).' - <b><i>'.$this->date->getTimeGap($row->datepublished).'</i></b></span>
               <span ><b>By:</b><i>'.$row->by.'</i></span>
               <span ><b>Views:</b><i>'.$this->number->formatNumber($row->views).'</i></span>
              </a>
            </td>
            ';
              
            $count++;
            }
            
        $total_pages=0;
        //count the all records and get the sub divide//
        if( $allrecords > 12 ) $total_pages = ceil($allrecords/12);
            
      
        if($total_pages>1 && $page<$total_pages)
          {
        $html.='
        <tr id="row-'.$start.'">
        <td valign=top colspan=4 onclick="getData(this,\''.$page.'-'.$total_pages.'\',\''.base_url().'\',\''.$type.'\');">
        <h2 align=center class="ui-widget-header footer-wrapper-box" >More ...</h2>
        </td>
        </tr>  
        
        ';          
          
          }
     
        return $html."</tr>";           
        } 
        
   function getVideoVersion($currentSelected)
        {
        $html='';
        if($currentSelected!="") $currentSelected = $this->crypt->decrypt($currentSelected);
        
        $sql="select distinct languageVersion from tblblog_post where languageVersion!='' order by languageVersion";
        $query = $this->db->query($sql); 
        $count=0;
        foreach ($query->result() as $row)
              {   
                  if($count==0) $html.="<option value='All'>All</option>";
                  if($currentSelected==$row->languageVersion) $html.="<option value='".$row->languageVersion."' selected='selected'>".$row->languageVersion."</option>";
                  else $html.="<option value='".$this->crypt->encrypt($row->languageVersion)."' >".$row->languageVersion."</option>";
                  $count++;
              }
        return $html;     
        } 
   
  function addViews($postID,$views)
        {
          $views++;   
          $data = array(
              'views' => $views 
          );
          $this->db->where('postID', $postID);       
      		$this->db->update('tblblog_post',$data);          
        }     
   function getFullPostDetails($postID,$videoVersion)
        {
        $data = array();
        $videoVersion = $this->crypt->decrypt($videoVersion);
        if($videoVersion=='All') $videoVersion="";
        $postID = $this->crypt->decrypt($postID);
        $sql="select searchTag, tblblog_post.postID,tblblog_post.title,tblblog_post.postBy,tblblog_post.subtitle, tblblog_post_content.content,concat(firstName,' ', lastname) as 'by',views,datepublished  FROM  tblblog_post_content  INNER JOIN  tblblog_post   ON (tblblog_post_content.postID = tblblog_post.postID) INNER JOIN  tblpersonalinfo   ON (tblpersonalinfo.PIID = tblblog_post.postBy)  where privacy='public' and tblblog_post.type='Video' and tblblog_post.postID=$postID and languageVersion like '$videoVersion%'";
        $query = $this->db->query($sql); 
        foreach ($query->result() as $row)
              {         
              $data["postID"] = $row->postID;  
              $data["title"]=$row->title;
              $data["subtitle"]=$row->subtitle;
              $data["by"]=$row->by;
              $data["position"] = $this->mdlSystemuser->getUserLevelName($row->postBy);
              $this->addViews($row->postID,$row->views);
              $data["views"] = $this->number->formatNumber($row->views);
              $data["gapDate"] = $this->date->getTimeGap($row->datepublished);
              $data["data"] = $row->content;
              $data["searchTag"] = $row->searchTag;
              $data["pheader"] = $this->mdlAccounts->getPhoto_Header();
              }
        return $data;
        }         

}
?>
