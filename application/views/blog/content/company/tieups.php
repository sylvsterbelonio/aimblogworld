<?php
$this->load->model("blog/mdlPages");
$page = $this->mdlPages->load("tie-ups");
?>
<div class="ui-widget-content" ><?=$page?></div>
<style>.text-wrapper-header{font-size:130%;}</style>
