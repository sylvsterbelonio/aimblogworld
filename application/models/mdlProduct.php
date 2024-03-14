<?php
class mdlProduct extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
                $this->load->model("blog/mdlShop");
                $this->load->model("blob/mdlAccounts");
                $this->load->library("Date");
                $this->load->library("Url");
                $this->load->library("Wrapper");
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

    function getCategory()
        {
        $html="";
        $sql = "SELECT *  FROM  tblproduct_category order by categoryName";
        $query = $this->db->query($sql);
        $html="Category Name<br><select id='cboProductsCategoryName' name='ProductsCategoryName' value='0' class='ui-widget-content ui-corner-all' style='padding:5px;width:100%'>";
        $html.="<option value='0'>Select Category</option>";
        foreach ($query->result_array() as $row) 
            {
            $html.="<option value='".$row["PCID"]."'>".$row["categoryName"]."</option>";
            }
        $html.="</select>";
        return $html;
        }
                
    function searchList($type,$searchValue,$sidx,$sord,$start,$limit) {
    
        $data = array();
        $where="";
        
        if($type!="")  $where = " WHERE $type LIKE '$searchValue%' ";
               
        $thesql = "SELECT PID, tblproduct.PCID, tblproduct_category.categoryName, tblproduct.mediaID, tblmedia.source, productName,description, units, binaryPoints, commissionalPoints, positionalPoints,weight  FROM    tblproduct_category   right JOIN  tblproduct       ON (tblproduct_category.PCID = tblproduct.PCID)  left JOIN  tblmedia     ON (tblmedia.mediaID = tblproduct.mediaID) $where ORDER BY $sidx $sord LIMIT $start, $limit";     
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
      
        $thesql="SELECT count(*) as 'count' FROM    tblproduct_category   right JOIN  tblproduct       ON (tblproduct_category.PCID = tblproduct.PCID)  left JOIN  tblmedia     ON (tblmedia.mediaID = tblproduct.mediaID) $where";
    
        $query = $this->db->query($thesql);
        foreach ($query->result_array() as $row) 
            {
            $data=$row['count'];
            }
            
        return $data;
    }
    
		function save_record($PCID,$mediaID,$productName,$description, $units,$binaryPoints,$commissionalPoints,$positionalPoints,$weight,$id,$piid)
    {
      if($id=="0")
          {
          $PID = $this->nextID("PID","tblproduct");
          
          $data = array(
              'PID' => $PID ,
              'PCID' => $PCID ,              
              'mediaID' => $mediaID,
              'productName' => $productName,
              'description' =>$description,
              'units' => $units,
              'binaryPoints' => $binaryPoints,
              'commissionalPoints' => $commissionalPoints,
              'positionalPoints' => $positionalPoints,
              'weight' => $weight,
              'createdBy' => $piid,
              'createdDt' => date('Y-m-d H:i:s', time()),
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
    		  $this->db->insert('tblproduct', $data); 
    		  return true;          
          }
      else
          {
          $data = array(
              'PCID' => $PCID ,              
              'mediaID' => $mediaID,
              'productName' => $productName,
              'units' => $units,
              'binaryPoints' => $binaryPoints,
              'commissionalPoints' => $commissionalPoints,
              'positionalPoints' => $positionalPoints,
              'weight' => $weight,
              'updatedBy' => $piid,
              'updatedDt' => date('Y-m-d H:i:s', time())
          );
          $this->db->where('PID', $id);       
      		$this->db->update('tblproduct',$data);           
          }

    }
    
    function delete_record($id)
  	{
  		$this->db->where('PID', $id);
  		$this->db->delete('tblproduct'); 
  		return true;
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
              'categoryFolder' => 'products',
              'source' => $source,
              'uploadedBy' => $piid,
              'uploadedDt' => date('Y-m-d H:i:s', time())
          );    
    		  $this->db->insert('tblmedia', $data); 
    		  return $mediaID.'~'.$source;       
    }
    
    //THIS IS FOR PRODUCT DETAILS FULL EQUIPPTED//
    
    function setListStyle($value)
    {
    $col = explode("~",$value);
    $html="<ul>";
    for($i=0;$i<count($col);$i++)
        {
        $html.="<li>".$col[$i]."</li>";
        }
    return $html."</ul>";
    }
    
    function openFullProductDetails($PID)
    {
    $data=array();
    
    $sql="SELECT tblproduct.PID,productName,details,tblproduct.pageID,imageURL FROM  tblproduct_details  INNER JOIN tblproduct    ON (tblproduct_details.PID = tblproduct.PID) where tblproduct.PID=$PID ";
    $query = $this->db->query($sql);
        foreach ($query->result() as $row) 
            {
            $data["PID"] = $row->PID;
            $data["pageID"] = $row->pageID;
            $data["productName"] = $row->productName;
            $data["details"]= $this->mdlShop->getDetailProdutcs_arrangeParagraph($row->details);
            
            $col = explode("~",$row->imageURL);
            if(count($col)>1)
            {
            $data["imgBackground"]=base_url().$col[0]; 
            $data["imgFeatures"]=base_url().$col[1];            
            }
            else
            {
            $data["imgBackground"]=""; 
            $data["imgFeatures"]="";            
            }

             
            $data["price"] = $this->mdlShop->getPrice($PID,$this->config->item("gcountryID"));
            }
    
    //FULL DETAILS DATA HERE//
    $html="";
    $sql = "SELECT * FROM   tblblog_pages   INNER JOIN tblblog_pages_content     ON (tblblog_pages.pageID = tblblog_pages_content.pageID) where tblblog_pages.PIID=".$this->config->item("gpiid")." and tblblog_pages_content.pageID=".$data["pageID"]." and tblblog_pages_content.category='full-details' group by tblblog_pages_content.contentID order by tblblog_pages_content.order";
    $query = $this->db->query($sql);
        foreach ($query->result() as $row) 
            {
            $html.=$this->wrapper->setData($row->contentID,$row->type,$row->title,$row->content,$row->order);
            }
    $data["fulldetails"]=$html;        
    
    //CONTENTS HERE//
    $html="";
    $sql = "SELECT * FROM   tblblog_pages   INNER JOIN tblblog_pages_content     ON (tblblog_pages.pageID = tblblog_pages_content.pageID) where tblblog_pages.PIID=".$this->config->item("gpiid")." and tblblog_pages_content.pageID=".$data["pageID"]." and tblblog_pages_content.category='content' group by tblblog_pages_content.contentID order by tblblog_pages_content.order";
    $query = $this->db->query($sql);
        foreach ($query->result() as $row) 
            {
            $html.=$this->wrapper->setData($row->contentID,$row->type,$row->title,$row->content,$row->order);
            }
    $data["content"]=$html;     

    //BENEFITS HERE//
    $html="";
    $sql = "SELECT * FROM   tblblog_pages   INNER JOIN tblblog_pages_content     ON (tblblog_pages.pageID = tblblog_pages_content.pageID) where tblblog_pages.PIID=".$this->config->item("gpiid")." and tblblog_pages_content.pageID=".$data["pageID"]." and tblblog_pages_content.category='benefits' group by tblblog_pages_content.contentID order by tblblog_pages_content.order";
    $query = $this->db->query($sql);
        foreach ($query->result() as $row) 
            {
            $html.=$this->wrapper->setData($row->contentID,$row->type,$row->title,$row->content,$row->order);
            }
    $data["benefit"]=$html;   
    
    //LOAD TESTIMONIES
    $html="";
    $count=0;
    $data["ytTitle"] = "";$data["ytSubTitle"] ="";$data["ytContent"] = "";$data["ytCategory"] = "";$data["ytTag"] = "";$data["ytData"] = "";$data["ytAuthor"] =  "";$data["ytSharedDt"] = "";
                    
    $sql="SELECT url,source,title,tblproduct_globaltestimony.createdDt as 'sharedDt',category,tagname,subtitle,content,tblproduct_globaltestimony.createdBy as 'sharedBy' FROM  tblmedia  INNER JOIN tblproduct_globaltestimony      ON (tblmedia.mediaID = tblproduct_globaltestimony.mediaID)  INNER JOIN tblpersonalinfo       ON (tblpersonalinfo.PIID = tblproduct_globaltestimony.createdBy) where tblproduct_globaltestimony.PID=$PID limit 0,6";
    $query = $this->db->query($sql);
        foreach ($query->result() as $row) 
            {
                if($count==0)
                    {
                    $data["ytTitle"] = $row->title;
                    $data["ytSubTitle"] =$row->subtitle;
                    $data["ytContent"] = $row->content;
                    $data["ytCategory"] = $row->category;
                    $data["ytTag"] = $row->tagname;
                    $data["ytData"] = $row->url;
                    $data["ytAuthor"] =  $this->mdlAccounts->getAuthorShort($row->sharedBy);
                    $data["ytSharedDt"] = $this->date->convertFullDateTime($row->sharedDt);
                    }
            
            
            $html.='<div class="list-testimony" onclick="openYoutube(\''.$row->url.'\');">
                    <table >
                    <tr>
                    <td rowspan=4 valign=top><img oncontextmenu="return false" draggable="false" src="'.base_url().$row->source.'" height=85 width=100></td>
                    <td valign=top><span class="testimony-header">'.$row->title.'</span ><span style="font-size:10px;font-style:italic">- '.$this->date->convertFullDateTime($row->sharedDt).'</span></td>
                    </tr>
                    <tr>
                    <td valign=bottom><span style="font-size:10px;"><b>Categories:</b> '.$row->category.'</span>
                    <br>
                    <span style="font-size:10px;"><b>Shared By:</b> '.$this->mdlAccounts->getAuthorShort($row->sharedBy).'</span>
                    </td>
                    </tr>                        
                    <tr>
                    <td valign=top></td>
                    </tr>
                    </table>                            
              </div>';
            
            }    
    
    $data["listYoutube"]=$html;
       
    //GET RELATED PRODUCTS HERE//
    $sql="SELECT tblproduct.pageID, tblproduct_category.categoryName,  tblproduct.productName,tblmedia.source,tblblog_pages.url FROM  tblproduct_category   INNER JOIN tblproduct    ON (tblproduct_category.PCID = tblproduct.PCID)  INNER JOIN tblmedia   ON (tblmedia.mediaID = tblproduct.mediaID)  INNER JOIN tblblog_pages   ON (tblblog_pages.pageID = tblproduct.pageID)  where tblproduct.PID!= ".$data["PID"]." and tblproduct_category.categoryName like '".$this->getCategoryName($data["PID"])."%'";
    $query = $this->db->query($sql);
    $data["relatedProduct"]="<ul class='bxslider'>";
    foreach ($query->result() as $row)
            {
            $data["relatedProduct"].="<li class='ui-widget-animate-6s'><a href='".$this->setURLProducts($row->pageID)."'><img style='width:100%' class='unselectable' src='".base_url().$this->getOneImage($row->source)."' title='".$row->productName."'></a></li>";
            }
    $data["relatedProduct"].="</ul>";
        
    return $data;
    }
    
        private function setURLProducts($pageID)
                {
                $sql = "SELECT * FROM tblblog_pages where pageID=$pageID";
                $query = $this->db->query($sql);   
                foreach ($query->result() as $row)  
                    {
                      if($this->config->item("sitename")!="shop")
                          return $this->server->base_url().$this->config->item("sitename")."/".$row->url;

                      else
                        {
                          return $this->server->base_url().$row->url;
                        }                        
                    }              
                }     
    
        private function getCategoryName($pid)
              {
                  $sql="SELECT tblproduct_category.categoryName FROM  tblproduct_category  INNER JOIN tblproduct    ON (tblproduct_category.PCID = tblproduct.PCID) where tblproduct.PID=$pid";
                  $query = $this->db->query($sql);
                  foreach ($query->result() as $row)
                        {
                        return $row->categoryName;
                        }     
              }
         private function getOneImage($source)
              {
              $col = explode(",",$source);
              return $col[0];
              }
    
    
    function searchYoutube($pid,$search)
    {
        $html="";
        
        $sql="SELECT url,source,title,tblproduct_globaltestimony.createdDt as 'sharedDt',category,tagname,subtitle,content,tblproduct_globaltestimony.createdBy as 'sharedBy' FROM  tblmedia  INNER JOIN tblproduct_globaltestimony      ON (tblmedia.mediaID = tblproduct_globaltestimony.mediaID)  INNER JOIN tblpersonalinfo       ON (tblpersonalinfo.PIID = tblproduct_globaltestimony.createdBy) where tblproduct_globaltestimony.PID=$pid and tagname like '%$search%' limit 0,6";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            {
        foreach ($query->result() as $row) 
                {
                $html.='<div class="list-testimony" onclick="openYoutube(\''.$row->url.'\');">
                        <table >
                        <tr>
                        <td rowspan=4 valign=top><img oncontextmenu=\'return false\' draggable=\'false\' src="'.base_url().$row->source.'" height=85 width=100></td>
                        <td valign=top><span class="testimony-header">'.$row->title.'</span ><span style="font-size:10px;font-style:italic">- '.$this->date->convertFullDateTime($row->sharedDt).'</span></td>
                        </tr>
                        <tr>
                        <td valign=bottom><span style="font-size:10px;"><b>Categories:</b> '.$row->category.'</span>
                        <br>
                        <span style="font-size:10px;"><b>Shared By:</b> '.$this->mdlAccounts->getAuthorShort($row->sharedBy).'</span>
                        </td>
                        </tr>                        
                        <tr>
                        <td valign=top></td>
                        </tr>
                        </table>                            
                  </div>';            
                }           
            }
        else
            {
            $html="<h5 align=center style='color:red'>-No Results Found-</h5>";
            }
            
        return $html;
    }
    
    function getProductfromSite()
        {
        $col = explode("/", $this->url->getURL());
        $col[count($col)-1];
        $data = array();
        $buildSite="";
        for($i=count($col)-1;$i>=count($col)-3;$i--)
            {
            if($i==count($col)-1) $buildSite=$col[$i]."/";
            else $buildSite .= $col[$i]."/";
            }
        //REVERSE THE SEQUNCE
        $col=explode("/",$buildSite);
        for($i=count($col)-1;$i>=0;$i--)
            {
            if($i==count($col)-1) $buildSite=$col[$i]."/";
            else $buildSite .= $col[$i]."/";            
            }     
        //REMOVE THE FIRST AND LAST SLASH//
        $buildSite = substr($buildSite,1,strlen($buildSite)); //first SLASH
        $buildSite = substr($buildSite,0,strlen($buildSite)-1); //last SLASH
        

  
        //GET PRODUCT INFO
        $sql= "SELECT tblproduct.PID,tblblog_pages.pageID FROM  tblproduct   INNER JOIN aimworld.tblblog_pages   ON (tblproduct.pageID = tblblog_pages.pageID) where url ='".$buildSite."'";
                             
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            {
                foreach ($query->result() as $row) 
                {
                $data["PID"]=$row->PID;
                $data["pageID"]=$row->pageID;
                }                
            }
        $sql = "SELECT categoryName,productName,tblproduct_category.pageID as 'pgIDc' FROM  tblproduct_category  INNER JOIN tblproduct     ON (tblproduct_category.PCID = tblproduct.PCID) where tblproduct.PID=".$data["PID"];
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) 
            {   
                $data["category_url"] = $this->getCategoryURL($row->pgIDc);  
                $data["category"]=$row->categoryName;
                $data["product"]=$row->productName; 
            }
                
        return $data;
        }
        
        private function getCategoryURL($categoryID)
              {
              $sql = "SELECT * FROM tblblog_pages where pageID=$categoryID";
              $query = $this->db->query($sql);
              foreach ($query->result() as $row)
                    {
                    return $row->url;
                    }               
              }
    
}
?>
