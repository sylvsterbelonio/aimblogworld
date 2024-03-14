<?php
class mdlShopProducts extends CI_Model   {

 public $PIID="0";
 
  
  
 public function __construct()
        {
                parent::__construct();
                $this->load->library('Crypt');
                $this->load->model('blog/mdlShop');
                $this->load->model('blog/mdlAccounts');
                
        }
 
 function getPID()
        {

        return $PIID;
        }
        
 function getUrl($pageID)
        {
        $query = $this->db->get_where('tblblog_pages', array('pageID' => $pageID));
        if ($query->num_rows() == 1)
        { 
            foreach ($query->result() as $row)
            {
            return $row->url;
            }
        }
        return "";
        }
        
 function openDetails($piid,$pid,$countryID,$home,$segment)
        {

        
        $sql="SELECT tblproduct_category.pageID as 'catpgID',categoryName,tblproduct.PID, tblproduct.pageID as 'pgID',productName,source,details FROM   tblproduct_category   INNER JOIN tblproduct        ON (tblproduct_category.PCID = tblproduct.PCID)  INNER JOIN tblmedia       ON (tblmedia.mediaID = tblproduct.mediaID)  INNER JOIN tblproduct_details      ON (tblproduct_details.PID = tblproduct.PID)  INNER JOIN tblproduct_price    ON (tblproduct_price.PID = tblproduct.PID) where tblproduct.PID=$pid";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) 
            {
            $data["productName"] = $row->productName;
            $data["content"] = $this->mdlShop->getDetailProdutcs_arrangeParagraph($row->details);
            $data["price"] = $this->mdlShop->getPrice($row->PID,$countryID);            
            
            $data["srcData"]=""; //element,max gallery image
            
            $sql="SELECT tblblogs_gallery.mediaID, source FROM  tblmedia INNER JOIN  tblblogs_gallery   ON (tblmedia.mediaID = tblblogs_gallery.mediaID) where PID=".$pid;
            $query2 = $this->db->query($sql);
            $count=0;
            
            $data["srcData"]="<li><img src=".base_url()."images/system/noproduct.png></li>";
            
            foreach ($query2->result() as $row2) 
            {
            if($count==0) $data["srcData"]= '<li><img src="'.base_url().$row2->source.'"></li>';
            else $src[$count]=  $data["srcData"].= '<li><img src="'.base_url().$row2->source.'"></li>';
            $count++;
            }
            
            

           
            $encrypted = $this->crypt->encrypt($row->categoryName);  
            $data["categoryLinks"]="Category: ";
            
            
            //ALL PRODUCTS
            if($segment!="shop") $data["categoryLinks"] .= '<a href="'.base_url().$segment.'/shop/?'.'search='.$encrypted.'">ALL PRODUCTS</a>, ';
            else $data["categoryLinks"] .= '<a href="'.base_url().'shop/?'.'search='.$encrypted.'">ALL PRODUCTS</a>, ';
            
            //CATEGORY AREA//
            if($segment!="shop") $data["categoryLinks"] .= '<a href="'.base_url().$segment.'/shop/'.$this->getUrl($row->catpgID).'?'.'search='.$encrypted.'">'.$row->categoryName.'</a>';
            else $data["categoryLinks"] .= '<a href="'.base_url().'shop/'.$this->getUrl($row->catpgID).'?'.'search='.$encrypted.'">'.$row->categoryName.'</a>';
                  
            
            $data['likelove']='                     
                     <span onclick="openDialog('.$piid.',\''.$row->PID.'\',\'like\',this)" class="'.$this->mdlShop->retrieveCustomerHits("like",$row->PID).'"><img src="'.base_url().'images/system/like.png" height=9 width=10><span>'.$this->mdlShop->countRank($piid,"like","products",$row->PID).'</span></span>
                     <span onclick="openDialog('.$piid.',\''.$row->PID.'\',\'love\',this)" class="'.$this->mdlShop->retrieveCustomerHits("love",$row->PID).'"><img src="'.base_url().'images/system/love.png" height=9 width=11 ><span>'.$this->mdlShop->countRank($piid,"love","products",$row->PID).'</span></span>';
            
            
                        
            return $data["productName"]."~".$data["content"]."~".$data["price"]."~".$data["srcData"]."~".$data["categoryLinks"]."~".$data["likelove"];
            
            }        

        

        }
}
?>
