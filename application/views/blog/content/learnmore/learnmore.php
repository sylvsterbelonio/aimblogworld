<?php
 $this->load->helper(array('form', 'url'));
$this->load->model("blog/mdlGeneral");
$this->load->model("blog/mdlLearnMore");
$this->load->library("Url");
$theme = $this->mdlGeneral->getTheme();
$data = $this->mdlLearnMore->getLearnMore("learnmore");
?>

<style>
.learnmore-cell{
width:33%;
}

.leanrmore-column{
  width:100%;
  color:<?=$theme["nBackColor"]?>;
  padding-bottom:10px

}

.leanrmore-column:hover{
cursor:pointer;
background:<?=$theme["nBackColor"]?>;
color:<?=$theme["nForeColor"]?>;
width:90%;

}

.leanrmore-column img{
width:100%;
border-radius:5px;
padding:5px;
}
.leanrmore-column h3{

}

	@media 
	only screen and (max-width: 760px),
	(min-device-width: 768px) and (max-device-width: 1024px)  {
	.learnmore-cell{
  width:100%;
  }
	}

</style>

<div class="ui-widget-content">
	<table class="ui-widget-table">
		<tr>
			<td class="learnmore-cell">
      <div id="product-presentation" class="leanrmore-column ui-state-animate-6s">
              <?=$data["product-presentation-img"]?>
              <?=$data["product-presentation-h3"]?>
      </div>
      </td>
			<td class="learnmore-cell">
      <div id="company-policy" class="leanrmore-column ui-state-animate-6s">
              <?=$data["company-policy-img"]?>
              <?=$data["company-policy-h3"]?>
      </div>      
      </td>
			<td class="learnmore-cell">
      <div id="aim-global-trainings" class="leanrmore-column ui-state-animate-6s">
              <?=$data["aim-global-trainings-img"]?>
              <?=$data["aim-global-trainings-h3"]?>
      </div>      
      </td>
		</tr>
	</table>
</div>


<script>

$("#product-presentation,#company-policy,#aim-global-trainings").click(function() {
if($(this).attr("id")=="company-policy") window.location.href="<?=$this->url->getSiteSource_Category("learnmore","product-presentation,company-policies,aim-trainings","company-policies")?>";
else if($(this).attr("id")=="product-presentation") window.location.href="<?=$this->url->getSiteSource_Category("learnmore","product-presentation,company-policies,aim-trainings","product-presentation")?>";
else if($(this).attr("id")=="aim-global-trainings") window.location.href="<?=$this->url->getSiteSource_Category("learnmore","product-presentation,company-policies,aim-trainings","aim-trainings")?>";

});


</script>

