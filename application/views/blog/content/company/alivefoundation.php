<?php
$this->load->model("blog/mdlPages");
$page = $this->mdlPages->load("alive-foundation");
?>
<div class="ui-widget-content" >
<?=$page?>  
</div>
<style>.text-wrapper-header,.bxslider li h1,.text-wrapper-paragraph{font-size:130%;}</style>

