<?php
$theme = $this->mdlGeneral->getTheme();


?>

<style>
.footer
{
clear:both;
background:<?=$theme["nBackColor"]?>;
padding:10px 0px 10px 0px;
}
.footer table tr td{
color:white;
font-size:200%;
padding-left:50px;
width:25%;
}
.footer table tr td h4{
line-height:2;
}
.footer table tr td p{
line-height:1.5;
font-size:80%;
}
.last-footer{
width:100%;
background:black;
color:white;
padding:10px 0px 10px 0px;
text-align:center;
font-size:150%;
}
</style>

<div class="footer">

<table class="ui-widget-table">
<tr>
<td valign=top>
<h4>User Guide</h4>
<p>How to Register</p>
<p>Basic Shopping Information</p>
</td>

<td valign=top>
<h4>Store Policies</h4>
<p>Privacy & Order Policy</p>
<p>Return Policy</p>
<p>Terms and Conditions</p>
<p>Shipment & Delivery</p>
</td>

<td valign=top>
<h4 >Modes of Payment</h4>
<p>Payment Methods</p>
<p>GCash and Smart Money</p>

</td>

<td valign=top>
<h4 >About Aim Hammer Blog</h4>
<p>About Us</p>
<p>Contact Us</p>
</td>
</tr>

<tr>
<td valign=top>
<h4>Payment Method</h4>
<img src="<?=base_url()?>images/system/payment_method.png">
</td>
<td valign=top>
<h4>Delivery Method</h4>
<img src="<?=base_url()?>images/system/deliveryservice.png">
</td>
<td valign=top>
<h4>Follow Us</h4>
<img src="<?=base_url()?>images/system/fb.png">
<img src="<?=base_url()?>images/system/youtube.ico" height=60>
</td>
<td valign=top>
<h4>Earn Php1,000</h4>
<input type="text" value="Your email address">
<button style="font-size:80%;margin-top:10px">Subscribe Here</button>
</td>
</tr>

</table>



</div>
<div class="last-footer">
Disclaimer: This site is not an official page of Alliance in Motion Global Inc. Copyright Notice 2016. Powered by Aim Hammers.
</div>
