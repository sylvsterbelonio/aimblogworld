<style>

.col1, .col2, .col3{background:red;min-width:300px;margin:0 10px 0 10px;}
</style>

<div class="container2" style="display:grid;grid-auto-flow: row dense;width:100%">

  <div class="col1" style="grid-row: 1; grid-column: 2;">Column1</div>
  <div class="col2" style="grid-column: span 2;">Column2</div>
  <div class="col3">Column3</div>

</div>
