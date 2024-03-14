
<img  src="<?=base_url()?>images/loginheader.png" style="width:100%;min-width:600px;line-height: 0;">

<script type="text/javascript">



    $(function(){
        $.getScript('<?=base_url()?>js/myscript.js.php');
        
     $( "#dialog" ).dialog({
      autoOpen: false,
      modal: true,
      width:350,
      show: {
        effect: "fade",
        duration: 300
      },
      hide: {
        effect: "fade",
        duration: 300
      },
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
 
    $( "#cmdLogInx" ).click(function() {
      $( "#dialog" ).dialog( "open" );
    });
       
    });




</script> 

<div id="dialog" title="Download complete">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
    Your files have downloaded successfully into the My Downloads folder.
  </p>
  <p>
    Currently using <b>36% of your storage space</b>.
  </p>
</div>
 
<div style=";clear:both: 0;margin:auto">
<?php echo set_value('Username'); ?>
<?php echo form_open(base_url()."admin"); ?>
<table border=0 align=center >

<tr >
<td colspan=2>
<table border=0 style="min-width:400px;line-height: 0;" align=right>
<tr>

<td style="padding:3px"><?=form_label('Username')?></label>

</td><td><?=form_input($ftxtusername)?></td>
<td><?=form_label('Password')?></td><td><?=form_password($ftxtpassword)?></td>
<td><button id="cmdLogIn" class="ui-state-default ui-corner-all" style="padding:5px 10px"><span class="ui-icon ui-icon-circle-check" style="float:left;margin-right:5px"></span><span style="float:right">Log In</span></button></td>
</tr>

<tr>
<td colspan=2 align=right>
<?=form_checkbox($fchkKeepLoggedIn)?>
<label for="chkKeepLoggedIn" style="font-size:12px">Keep me logged in</label></td>
<td colspan=2 align=right><a href="<?php echo base_url('admin'); ?>" style="font-size:12px;">Forgot Password</a></td>
</tr>
<tr>
<td colspan=5  align=center><div class="ui-state-error ui-corner-all" style="display:inline-block;padding:5px;<?php if(validation_errors()=="" && $errorLogIn=="") {echo 'display:none';}else{echo 'display:n';}?>">
<table ><tr><td ><span class="ui-icon ui-icon-alert"></td><td><?php echo validation_errors(); ?><?php echo $errorLogIn; ?></td></tr></table>
</div></td>
</tr>
</table>
</td>

</tr>

<tr>
<td style="wdith:50%"><img style="width:450px;height:350px" src="<?=base_url()?>images/content_img1.png" ></td>
<td style="wdith:50%" valign="top"><h3 align=center>Become A new Blog Member</h3>

<table border=0 style="width:100%">
<tr>
<td><?=form_input($ftxtfirstname)?></td><td><?=form_input($ftxtlastname)?></td>
</tr>
<tr>
<td colspan=2><?=form_input($ftxtemail)?></td>
</tr>
<tr>
<td colspan=2><?=form_input($ftxtremail)?></td>
</tr>
<tr>
<td colspan=2 style="height:10px"><?=form_password($ftxtnpassword)?>&nbsp;</td>
</tr>
<tr>
<td colspan=2><hr style="width:1px"><?=form_label('Birthday')?><hr></td>
</tr>
<tr>
<td colspan=2>
<?=form_dropdown($fcboMonth,$fcbolstMonth,'Month')?>
<?=form_dropdown($fcboDay,$fcbolstDay,'Day')?>
<?=form_dropdown($fcboYear,$fcbolstYear,'Year')?></td>
</tr>
<tr>
<td>
<?=form_radio($foptM, '', TRUE)?><span id="soptM">Male</span>
<?=form_radio($foptF, '', FALSE)?><span id="soptF">Female</span>
</td>
</tr>
<tr>
<td colspan=2><hr style="width:1px"><?=form_label('Registration Code')?><hr></td>
</tr>
<tr>
<td colspan=2><?=form_input($ftxtaccountID)?></td>
</tr>
<tr>
<td colspan=2><?=form_input($ftxtsecuritycode)?></td>
</tr>
<tr>
<td colspan=2 align=right>
<button id="cmdCreate" class="ui-state-default ui-corner-all" style="padding:5px 10px"><span class="ui-icon ui-icon-circle-plus" style="float:left;margin-right:5px"></span><span style="float:right">Create</span></button>

</td>
</tr>
</table>

</td>
</tr>
</table>

</div>
