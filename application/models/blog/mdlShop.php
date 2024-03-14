<?php
class mdlShop extends CI_Model   {

 public function __construct()
        {
                parent::__construct();
                $this->load->library('Crypt');
                $this->load->library('Url');
                $this->load->library('Server');
                $this->load->model('blog/mdlGeneral');
        }
 private function encrypt_url($string) 
        {
        $key = "MAL_979805"; //key to encrypt and decrypts.
        $result = '';
        $test = "";
         for($i=0; $i<strlen($string); $i++) {
           $char = substr($string, $i, 1);
           $keychar = substr($key, ($i % strlen($key))-1, 1);
           $char = chr(ord($char)+ord($keychar));
      
           $test[$char]= ord($char)+ord($keychar);
           $result.=$char;
         }
      
         return urlencode(base64_encode($result));
        }

 public function getCountries()
        {
        $html="";
        $sql="select * from tblref_country order by countryName";
        $query = $this->db->query($sql);
        $html="<select id='cboselCountry' name='selCountry' value='".$this->config->item("gcountryID")."' style=';margin-top:5px;margin-bottom:5px;'>";
        $html.="<option value='0'>-SELECT COUNTRY-</option>";
        foreach ($query->result_array() as $row) 
            {
            if($row["countryID"]==1) $html.="<option value='".$row["countryID"]."' selected='selected'>".$row["countryName"]."</option>";
            else $html.="<option value='".$row["countryID"]."'>".$row["countryName"]."</option>";
            }
        $html.="</select>";
        return $html;
        }
 
 public function getCategories()
        {
        $html="";
        $sql = "SELECT categoryName, url FROM  tblproduct_category   left JOIN tblblog_pages    ON (tblproduct_category.pageID = tblblog_pages.pageID) order by categoryName";
        $query = $this->db->query($sql);   
        
        foreach ($query->result() as $row)
            {
            $encrypted = $this->crypt->encrypt($row->categoryName);        
        
            if($this->config->item("sitename")!="shop") $html.="<li><b><a href='".$this->server->base_url().$row->url."'>".$row->categoryName."</a></b></li>";
            else $html.="<li><a href='".$this->server->base_url().$row->url."'>".$row->categoryName."</a></li>";
            } 
        return $html;     
        }
 
 public function countRank($piid,$section, $type,$refID)
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
        
 public function countProducts($piid,$type,$refID)
        {
        $where="";
        if($piid!=0) $where = " and PIID= $piid";
        $sql="select count(*) as count from tblblogs_likes where `type`=$type and refID=$refID $where";
        $query = $this->db->query($sql);   
        foreach ($query->result() as $row)
            {
            return $row->count;
            }
        return 0;        
        }
 
 public function checkifImageExist($source)
        {
        $col = explode(",",$source);
        
        if(count($col)>1)
          {
              if($source!=NULL && $source!="") return base_url().$col[0].'" ';
              else return base_url()."images/system/noproduct.png".'" ';          
          }
        
        if($source!=NULL && $source!="") return base_url().$source.'" ';
        else return base_url()."images/system/noproduct.png".'" ';
        
        }
        
 public function pageSource($pageID)
        {
        if($pageID=="") $pageID=0;
        $sql="select * from tblblog_pages where pageID=$pageID";
        $query = $this->db->query($sql);   
        foreach ($query->result() as $row)
            {
            return $row->url;
            }
        return "";
        }
        
 public function getPrice($pid,$countryID)
        {
        $where="";
        if($countryID!=0) $where=" and tblproduct_price.countryID = '$countryID'";
        $sql = "SELECT countryName, productName, priceSymbol, retailPrice FROM  tblref_country   INNER JOIN tblproduct_price       ON (tblref_country.countryID = tblproduct_price.countryID)  INNER JOIN tblproduct WHERE tblproduct_price.PID=$pid $where";
        $query = $this->db->query($sql); 
        if ($query->num_rows() >= 1)
          {
          foreach ($query->result() as $row)
              {
              return $row->priceSymbol." ".number_format($row->retailPrice,2);
              }
          return "???.??";          
          }
        else
          {
          $sql = "SELECT countryName, productName, priceSymbol, retailPrice FROM  tblref_country   INNER JOIN tblproduct_price       ON (tblref_country.countryID = tblproduct_price.countryID)  INNER JOIN tblproduct WHERE tblproduct_price.PID=$pid and tblproduct_price.countryID=1";
          $query = $this->db->query($sql); 
          foreach ($query->result() as $row)
              {
              return $row->priceSymbol." ".number_format($row->retailPrice,2);
              }          
          return "???.??";
          }
         return "???.??";         
        }       
 
 public function getTopRatedSource($PID)
        {
        
        $sql="SELECT  tblproduct_category.pageID as 'catpageID', categoryName,tblproduct.pageID as 'pgID', productName, source FROM   tblproduct_category  INNER JOIN tblproduct   ON (tblproduct_category.PCID = tblproduct.PCID)   left JOIN tblmedia    ON (tblmedia.mediaID = tblproduct.mediaID) where PID=$PID";
        $query = $this->db->query($sql);   
        foreach ($query->result() as $row)
            {
            return '<td rowspan=3 align=center class="right_item2" style="width:70px"><a href="'.$this->setURLProducts($row->pgID).'"><img src="'.$this->checkifImageExist($row->source).'" width=70 height=70 class="loading-img-small" style="border-radius:50%;"></a></td>
                <td style="font-size:14px" class="right_item"><a href="'.$this->setURLProducts($row->pgID).'">';
            }
        }
 
 public function getNewArrivals($countryID)
        {
        $theme = $this->mdlGeneral->getTheme();
        
        
        $html='<div class="right-side-container">  <div class="right-category">NEW ARRIVALS</div>';
        $sql="SELECT tblproduct.PID,tblproduct_category.pageID as 'catpageID', categoryName, tblproduct.pageID as 'pgID', productName, source,tblproduct.createdDt FROM  tblproduct_category  INNER JOIN tblproduct      ON (tblproduct_category.PCID = tblproduct.PCID) left JOIN tblmedia     ON (tblmedia.mediaID = tblproduct.mediaID) order by tblproduct.createdDt desc limit 0,5";
        $query = $this->db->query($sql);   
        $count=0;
        foreach ($query->result() as $row)
              {        
              
        if($count==1) $html.="<hr class='ui-hr'>";      
        $html.='  <table style="margin-left:5px;width:95%">
                  <tr>
                  <td rowspan=3 align=center class="right_item2" style="width:70px"><a href="'.$this->setURLProducts($row->pgID).'"><img src="'.$this->checkifImageExist($row->source).'" width=70 height=70 style="border-radius:50%;"></a></td>
                  <td style="font-size:14px;"  class="right_item"><a href="'.$this->setURLProducts($row->pgID).'">'.$row->productName.'</a></td>  
                  </tr>
                  <tr>
                  <td style="font-size:10px;color:green" valign="top"><b>Date Arrived:</b> '.date_format(date_create($row->createdDt),"m/d/Y").'</td>
                  </tr>
                  <tr>
                  <td><b style="font-size:200%;color:'.$theme["pBackColor"].'">'.$this->getPrice($row->PID,$countryID).'</b></td>
                  </tr>
                  </table>';
        $count=1;     
              }
        $html.="</div>"; 
        return $html;
        }
 
 public function getTopRatedProducts($PIID,$countryID,$type)
        {
        $where="";
        $react="";
        $reactColor="";
        
        if($PIID!=0) $where = " and PIID=$PIID and sectionType='$type'";
        
        if($type=="like") {$react="Liked This";$reactColor="#377aff";}
        else {$react="Loved This";$reactColor="#fc5656";}
         
        $html='<div class="right-side-container">  
               <div class="right-category">';
               
        if($type=="like") $html.="TOP RATED";
        else  $html.="MOST POPULAR";
               
        $html.='</div>';       
               
        $count=0;
        $sql="SELECT tblproduct.PID, productName,count(likeID) as 'likes' FROM  tblproduct left JOIN tblblogs_rankhits      ON (tblproduct.PID = tblblogs_rankhits.refID) where PIID=3 $where group by productName order by count(likeID) desc limit 0,3";
        $query = $this->db->query($sql);   
        foreach ($query->result() as $row)
              {
        if($count==1) $html.="<hr class='ui-hr'>";                   
        $html.='<table border=0 style="margin-left:5px;width:95%">
                <tr>'.$this->getTopRatedSource($row->PID).$row->productName.'</a></td>  
                </tr>
                <tr>
                <td style="font-size:10px;color:'.$reactColor.'" valign="top"><i>'.number_format($row->likes,0).' '.$react.'</i></td>
                </tr>
                <tr>
                <td><b style="font-size:200%;">'.$this->getPrice($row->PID,$countryID).'</b></td>
                </tr>
                </table>';
              $count=1;      
              }
        $html.="</div>";                   
        return $html;
        }
 
 public function navigationFooter($loadType,$categoryType,$PIID,$countryID,$order,$page,$limit)
        {
        $where="";
        if($categoryType!="") $where=" where categoryName like '$categoryType'";
        $sql="";
        $html='';
        
        $count=0;      
        $total_pages=0;
        $totalRecords=0;
          
        if($order=="like"||$order=="love") $sql="SELECT tblproduct.PID,tblproduct.pageID as 'pgID',tblproduct_category.pageID as 'catpageID', categoryname, productName,source,retailPrice,count(likeID) as 'likes' FROM  tblproduct_category  INNER JOIN  tblproduct    ON (tblproduct_category.PCID = tblproduct.PCID)  INNER JOIN tblmedia   ON (tblmedia.mediaID = tblproduct.mediaID)  INNER JOIN tblproduct_price    ON (tblproduct_price.PID = tblproduct.PID)  INNER JOIN tblblogs_rankhits   ON (tblproduct.PID = tblblogs_rankhits.refID) $where and tblblogs_rankhits.type='products' and sectionType='$order' group by productName order by count(likeID) desc limit $page,$limit";
        else $sql="SELECT count(*) as 'count' FROM  tblproduct_category  INNER JOIN tblproduct      ON (tblproduct_category.PCID = tblproduct.PCID)  INNER JOIN tblmedia      ON (tblmedia.mediaID = tblproduct.mediaID)  INNER JOIN tblproduct_price    ON (tblproduct_price.PID = tblproduct.PID) $where";
        $query = $this->db->query($sql);   
        foreach ($query->result() as $row)
            {
            if($order=="like"||$order=="love") $count=$query->num_rows();
            else  $count=$row->count;
           
            if( $count > 0 ) {
                $total_pages = ceil($count/$limit);
            } else {
                $total_pages = 0;
            }                    
            
            if ($page > $total_pages) $page=$total_pages;        
            $start = $limit*$page - $limit;
            if($start <0) $start = 0;  
            
            $startTot = $start+$limit;
            if ($startTot>$count) $startTot = $count;
          
          $html.='
                <div style="padding:5px">
                <table style="width:100%;margin-bottom:5px">
                <tr><td align=center>';
                
                $html.='<select id="cboNavigation" onchange="limits();"';
                
                if($total_pages>1) $html.=' style="">';
                else $html.=' style="display:none" >';
                
                    $limitVal=array(8,12,24,36);
                    for($i=0;$i<4;$i++)
                        {
                        if($limitVal[$i]==$limit) $html.='<option value="'.$limitVal[$i].'" selected="selected">'.$limitVal[$i].'</option>';
                        else $html.='<option value="'.$limitVal[$i].'">'.$limitVal[$i].'</option>';
                        }
                $html.='</select>';
                
                $navValue=$page-1;
                if($page!=0) $html.='<span id="cmdPrev_'.$navValue.'" onclick="nav(\'cmdPrev_'.$navValue.'\');" class="navigation-shop-items"><</span>';
                $navValue=$page+1;
                
                for($i=0;$i<$total_pages;$i++)
                    {  
                    if($total_pages>1)
                    {
                    $navValue=$i+1;
                    if($i==$page) $html.='<span onclick="nav(\'cmdPage_'.$i.'\');" class="navigation-shop-items-active">'.$navValue.'</span>';
                    else $html.=' <span onclick="nav(\'cmdPage_'.$i.'\');" id="cmdPage_'.$i.'" alt="nav" class="navigation-shop-items">'.$navValue.'</span>';
                    }                  
                    }
                $navValue=$page+1;
                if($navValue<$total_pages) $html.='<span id="cmdNext_'.$navValue.'" onclick="nav(\'cmdNext_'.$navValue.'\');" class="navigation-shop-items">></span>';
                     
                $html.='
                </td>
                </tr>
                </table>
                </div>
                ';          
        
            }
        return $html;
        }    
 
 public function retrieveCustomerHits($sectionType,$refID)
        {
        if($this->session->has_userdata("customerID"))
            {
            $query = $this->db->get_where('tblblogs_rankhits', array('customerID' => $this->session->customerID,'PIID' =>$this->session->PIID, 'sectionType' => $sectionType,'refID' => $refID));
            if ($query->num_rows() == 1)
                { 
                  if($sectionType=="like") return "like like-active";
                  else return "love love-active";                
                }
            
            }
        else
            {
            if($sectionType=="like") return "like";
            else return "love";
            }
            if($sectionType=="like") return "like";
            else return "love";        
        }

 public function getPackages($categoryType,$PIID,$countryID,$order,$page,$limit)
        {
        $where="";
        if($categoryType!="") $where=" where categoryName like '$categoryType'";
        $sql="";
        $html='';
        $count=0;
        if($page>0) $page = ($page*$limit);
        
        if($order=="like"||$order=="love") $sql="SELECT tblproduct.PID,tblproduct.pageID as 'pgID',tblproduct_category.pageID as 'catpageID', categoryname, productName,source,retailPrice,count(likeID) as 'likes' FROM  tblproduct_category  INNER JOIN  tblproduct    ON (tblproduct_category.PCID = tblproduct.PCID)  INNER JOIN tblmedia   ON (tblmedia.mediaID = tblproduct.mediaID)  INNER JOIN tblproduct_price    ON (tblproduct_price.PID = tblproduct.PID)  INNER JOIN tblblogs_rankhits   ON (tblproduct.PID = tblblogs_rankhits.refID) $where and tblblogs_rankhits.type='products' and sectionType='$order' group by packageName order by count(likeID) desc limit $page,$limit";
        else $sql="SELECT packageID as 'PID',priceSymbol, tblpackage.pageID as 'pgID',tblproduct_category.pageID as 'catpageID',price, packagename as 'productName', categoryname,source FROM  tblmedia  INNER JOIN  tblpackage   ON (tblmedia.mediaID = tblpackage.mediaID)  INNER JOIN aimworld.tblproduct_category    ON (tblproduct_category.PCID = tblpackage.PCID) $where order by $order limit $page,$limit";
                        
        $query = $this->db->query($sql);   
        foreach ($query->result() as $row)
            {
            if($count==0)
                {              
                $html='   
                <div   >
                  <div onclick="openDetails(\''.$row->PID.'\',\''.$this->config->item("gcountryID").'\')" class="focus cart-items"><img src="'.$this->checkifImageExist($row->source).' class="loading-img" ></div>
                  <p>       
                     <span  style="width:100%;padding:5px;"><a href="'.base_url().$this->pageSource($row->catpageID).'/'.$this->pageSource($row->pgID).'" class="item-list-header">'.$row->productName.'</a></span>
                     <span onclick="openDialog('.$PIID.',\''.$row->PID.'\',\'like\',this)" class="'.$this->retrieveCustomerHits("like",$row->PID).'"><img src="'.base_url().'images/system/like.png" height=9 width=10><span>'.$this->countRank($PIID,"like","products",$row->PID).'</span></span>
                     <span onclick="openDialog('.$PIID.',\''.$row->PID.'\',\'love\',this)" class="'.$this->retrieveCustomerHits("love",$row->PID).'"><img src="'.base_url().'images/system/love.png" height=9 width=11 ><span>'.$this->countRank($PIID,"love","products",$row->PID).'</span></span>
                     <span class="price item-list-price">'.$row->priceSymbol.' '.number_format($row->price,2).'</span>
                     <span class="cart-items"><img src="'.base_url().'images/system/cart.png" height=13 width=15 style="margin-right:10px"><span>Add to Cart</span></span>
                  </p>
                </div>';       
                }
            else
                {
                $html.='   
                <div   >
                  <div class="focus cart-items"><img onclick="openDetails(\''.$row->PID.'\',\''.$this->config->item("gcountryID").'\')" src="'.$this->checkifImageExist($row->source).' class="loading-img"></div>
                  <p>       
                     <span  style="width:100%;padding:5px;"><a href="'.base_url().$this->pageSource($row->catpageID).'/'.$this->pageSource($row->pgID).'" class="item-list-header">'.$row->productName.'</a></span>
                     <span onclick="openDialog('.$PIID.',\''.$row->PID.'\',\'like\',this)" class="'.$this->retrieveCustomerHits("like",$row->PID).'"><img src="'.base_url().'images/system/like.png" height=9 width=10><span>'.$this->countRank($PIID,"like","products",$row->PID).'</span></span>
                     <span onclick="openDialog('.$PIID.',\''.$row->PID.'\',\'love\',this)" class="'.$this->retrieveCustomerHits("love",$row->PID).'"><img src="'.base_url().'images/system/love.png" height=9 width=11 ><span>'.$this->countRank($PIID,"love","products",$row->PID).'</span></span>
                     <span class="price item-list-price" style="display:block;font-size:25px;font-weight: 900;line-height:50px">'.$row->priceSymbol.' '.number_format($row->price,2).'</span>
                     <span class="cart-items"><img src="'.base_url().'images/system/cart.png" height=13 width=15 style="margin-right:10px"><span>Add to Cart</span></span>
                  </p>
                </div>';                     
                }             
            $count=1;
            }        
            
            
            
        return $html;
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
        
         private function setURLFullDetailedProducts($pageID)
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
                
 public function getProducts($categoryType,$PIID,$countryID,$order,$page,$limit)
        {
        $where="";
        if($categoryType!="") $where=" where categoryName like '$categoryType'";
        $sql="";
        $html='';
        $count=0;
        if($page>0) $page = ($page*$limit);
        
        if($order=="like"||$order=="love") $sql="SELECT tblproduct.PID,tblproduct.pageID as 'pgID',tblproduct_category.pageID as 'catpageID', categoryname, productName,source,retailPrice,count(likeID) as 'likes' FROM  tblproduct_category  INNER JOIN  tblproduct    ON (tblproduct_category.PCID = tblproduct.PCID)  INNER JOIN tblmedia   ON (tblmedia.mediaID = tblproduct.mediaID)  INNER JOIN tblproduct_price    ON (tblproduct_price.PID = tblproduct.PID)  INNER JOIN tblblogs_rankhits   ON (tblproduct.PID = tblblogs_rankhits.refID) $where and tblblogs_rankhits.type='products' and sectionType='$order' group by productName order by count(likeID) desc limit $page,$limit";
        else $sql="SELECT tblproduct.PID,tblproduct.pageID as 'pgID',tblproduct_category.pageID as 'catpageID', categoryname, productName,source FROM  tblproduct_category  INNER JOIN tblproduct      ON (tblproduct_category.PCID = tblproduct.PCID)  INNER JOIN tblmedia      ON (tblmedia.mediaID = tblproduct.mediaID)  INNER JOIN tblproduct_price    ON (tblproduct_price.PID = tblproduct.PID) $where order by $order limit $page,$limit";
                        
        $query = $this->db->query($sql);   
        foreach ($query->result() as $row)
            {
            if($count==0)
                {              
                $html='   
                <div   >
                  <div onclick="openDetails(\''.$row->PID.'\',\''.$this->config->item("gcountryID").'\')" class="focus cart-items"><img src="'.$this->checkifImageExist($row->source).' class="loading-img" ></div>
                  <p>       
                     <span  style="width:100%;padding:5px;"><a href="'.$this->setURLProducts($row->pgID).'" class="item-list-header">'.$row->productName.'</a></span>
                     <span onclick="openDialog('.$PIID.',\''.$row->PID.'\',\'like\',this)" class="'.$this->retrieveCustomerHits("like",$row->PID).'"><img src="'.base_url().'images/system/like.png" height=9 width=10><span>'.$this->countRank($PIID,"like","products",$row->PID).'</span></span>
                     <span onclick="openDialog('.$PIID.',\''.$row->PID.'\',\'love\',this)" class="'.$this->retrieveCustomerHits("love",$row->PID).'"><img src="'.base_url().'images/system/love.png" height=9 width=11 ><span>'.$this->countRank($PIID,"love","products",$row->PID).'</span></span>
                     <span class="price item-list-price style="font-size:200%;">'.$this->getPrice($row->PID,$countryID).'</span>
                     <span class="cart-items"><img src="'.base_url().'images/system/cart.png" height=13 width=15 style="margin-right:10px"><span>Add to Cart</span></span>
                  </p>
                </div>';       
                }
            else
                {
                $html.='   
                <div   >
                  <div class="focus cart-items"><img onclick="openDetails(\''.$row->PID.'\',\''.$this->config->item("gcountryID").'\')" src="'.$this->checkifImageExist($row->source).' class="loading-img"></div>
                  <p>       
                     <span  style="width:100%;padding:5px;"><a href="'.$this->setURLProducts($row->pgID).'" class="item-list-header">'.$row->productName.'</a></span>
                     <span onclick="openDialog('.$PIID.',\''.$row->PID.'\',\'like\',this)" class="'.$this->retrieveCustomerHits("like",$row->PID).'"><img src="'.base_url().'images/system/like.png" height=9 width=10><span>'.$this->countRank($PIID,"like","products",$row->PID).'</span></span>
                     <span onclick="openDialog('.$PIID.',\''.$row->PID.'\',\'love\',this)" class="'.$this->retrieveCustomerHits("love",$row->PID).'"><img src="'.base_url().'images/system/love.png" height=9 width=11 ><span>'.$this->countRank($PIID,"love","products",$row->PID).'</span></span>
                     <span class="price item-list-price" style="display:block;font-size:25px;font-weight: 900;line-height:50px">'.$this->getPrice($row->PID,$countryID).'</span>
                     <span class="cart-items"><img src="'.base_url().'images/system/cart.png" height=13 width=15 style="margin-right:10px"><span>Add to Cart</span></span>
                  </p>
                </div>';                     
                }             
            $count=1;
            }        
            
            
            
        return $html;
        }
          
  public function getDetailProdutcs($categoryType,$PIID,$countryID,$order,$page,$limit)
        {
        $html="";
        $count=0;
        if($page>0) $page = ($page*$limit);
        $sql="SELECT tblproduct_category.pageID as 'catpgID',categoryName,tblproduct.PID, tblproduct.pageID as 'pgID',productName,source,details FROM   tblproduct_category   INNER JOIN tblproduct        ON (tblproduct_category.PCID = tblproduct.PCID)  INNER JOIN tblmedia       ON (tblmedia.mediaID = tblproduct.mediaID)  INNER JOIN tblproduct_details      ON (tblproduct_details.PID = tblproduct.PID)  INNER JOIN tblproduct_price    ON (tblproduct_price.PID = tblproduct.PID) order by $order limit $page,$limit";
        $query = $this->db->query($sql);   
        foreach ($query->result() as $row)
            {
            if($count==0)
                { 
                $html='
                      <div class="dtl-item-container" >
                        <div class="left-details-item-container">
                          <div class="gallery-picture" onclick="openDetails(\''.$row->PID.'\','.$countryID.')" ><img src="'.$this->checkifImageExist($row->source).'></div>
                          <table style="width:100%">
                            <tr><td align="center">
                            <span onclick="openDialog('.$PIID.',\''.$row->PID.'\',\'like\',this)" class="'.$this->retrieveCustomerHits("like",$row->PID).'" style="display:inline-block" ><img src="'.base_url().'images/system/like.png" height=9 width=10><span >'.$this->countRank($PIID,"like","products",$row->PID).'</span></span>
                            <span onclick="openDialog('.$PIID.',\''.$row->PID.'\',\'love\',this)" class="'.$this->retrieveCustomerHits("love",$row->PID).'" style="display:inline-block" ><img src="'.base_url().'images/system/love.png" height=9 width=10><span >'.$this->countRank($PIID,"love","products",$row->PID).'</span></span>
                            <span class="share" style="display:inline-block"><img src="'.base_url().'images/system/share.png" height=9 width=10 style=""><span>0</span></span>
                        <h2 align=center class="item-price-fordetails">'.$this->getPrice($row->PID,$countryID).'</h2>
                            </td></tr>
                          </table>
                        </div>
                        <div class="right-details-item-container">
                          <h3 class="item-list-header-details"><a href='.$this->setURLProducts($row->pgID).'>'.$row->productName.'</a></h3><br>
                          <hr class="ui-hr"><br>
                          '.$this->getDetailProdutcs_arrangeParagraph($row->details).'<br>
                          <button><img src="'.base_url().'images/system/cart.png"><span class="button-text">Add to Cart</span></button>
                          <button onclick="openDetails(\''.$row->PID.'\')"><img src="'.base_url().'images/system/quickview.png" height=17 width=18><span class="button-text">Qick View</span></button>
                          <button onclick="openFullProductDetails(\''.$this->setURLProducts($row->pgID).'\')"><img src="'.base_url().'images/system/details.png" height=17 width=15><span class="button-text">View Details</span></button>
                        </div>
                      </div>';                
                }
            else
                {
                $html.='
                      <div style="clear:both" class="dtl-item-container" >
                      <div class="dtl-item-container" >
                        <div class="left-details-item-container">
                          <div class="gallery-picture" onclick="openDetails(\''.$row->PID.'\','.$countryID.')" ><img src="'.$this->checkifImageExist($row->source).'></div>
                          <table style="width:100%">
                            <tr><td align="center">
                            <span onclick="openDialog('.$PIID.',\''.$row->PID.'\',\'like\',this)" class="'.$this->retrieveCustomerHits("like",$row->PID).'" style="display:inline-block" ><img src="'.base_url().'images/system/like.png" height=9 width=10><span >'.$this->countRank($PIID,"like","products",$row->PID).'</span></span>
                            <span onclick="openDialog('.$PIID.',\''.$row->PID.'\',\'love\',this)" class="'.$this->retrieveCustomerHits("love",$row->PID).'" style="display:inline-block" ><img src="'.base_url().'images/system/love.png" height=9 width=10><span >'.$this->countRank($PIID,"love","products",$row->PID).'</span></span>
                            <span class="share" style="display:inline-block"><img src="'.base_url().'images/system/share.png" height=9 width=10 style=""><span>0</span></span>
                        <h2 align=center class="item-price-fordetails">'.$this->getPrice($row->PID,$countryID).'</h2>
                            </td></tr>
                          </table>
                        </div>
                        <div class="right-details-item-container">
                          <h3 class="item-list-header-details"><a href='.$this->setURLProducts($row->pgID).'>'.$row->productName.'</a></h3><br>
                          <hr class="ui-hr"><br>
                          '.$this->getDetailProdutcs_arrangeParagraph($row->details).'<br>
                          <button><img src="'.base_url().'images/system/cart.png"><span class="button-text">Add to Cart</span></button>
                          <button onclick="openDetails(\''.$row->PID.'\')"><img src="'.base_url().'images/system/quickview.png" height=17 width=18><span class="button-text">Qick View</span></button>
                          <button onclick="openFullProductDetails(\''.$this->setURLProducts($row->pgID).'\')"><img src="'.base_url().'images/system/details.png" height=17 width=15><span class="button-text">View Details</span></button>
                        </div>
                      </div>';                    
                }
            $count=1;
            }        
        return $html;
        }
        
        //~ = Next Paragraph
        //^ = No Indent Paragraph
        //&#39; = single qoutes HTML codes
        //&#34; = double qoutes for HTML codes
        private function setSingleDoubleQoutes($data)
            {
            $data = str_replace("\'" , "&#39;" , ($data));
            $data = str_replace("\"" , "&#34;" , ($data));
            $data = str_replace("®","&reg;",$data);
            return $data;
            }
        public function getDetailProdutcs_arrangeParagraph($content)
            {
            $html="";
            $col = explode("~",$content);
            for($i=0;$i<=count($col)-1;$i++)
                {
                if($i==0)
                    {
                    if(strpos($col[$i],'^')!== false) $html='<p class="tdetails-content">'.str_replace("^","",$this->setSingleDoubleQoutes($col[$i]));
                    else $html='<p class="tdetails-content-indent" >'.$this->setSingleDoubleQoutes($col[$i]);
                    $html.="</p>";
                    }
                else
                    {
                    if(strpos($col[$i],'^')!== false) $html.='<p class="tdetails-content">'.str_replace("^","",$this->setSingleDoubleQoutes($col[$i]));
                    else $html.='<p class="tdetails-content-indent">'.$this->setSingleDoubleQoutes($col[$i]);
                    $html.="</p>";                    
                    }
                }
            return $html;      
            }    

}
?>
