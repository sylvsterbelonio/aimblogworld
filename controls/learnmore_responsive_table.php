<?php
$this->load->model("blog/mdlGeneral");
$theme = $this->mdlGeneral->getTheme();


?>


	

	<style>

	/* 
	Generic Styling, for Desktops/Laptops 
	*/
	.ui-widget-table { 
		width: 100%; 
		border-collapse: collapse; 
	}
	/* Zebra striping */
	.ui-widget-table-skin tr:nth-of-type(even) { 
		border: 1px solid white;
		background-color: <?=$theme["nForeColor"]?>;
		background-image: -moz-linear-gradient($theme["nForeColor"]?>, <?=$theme["nForeColor"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from($theme["nForeColor"]?>), to(<?=$theme["nForeColor"]?>));	
		background-image: -webkit-linear-gradient($theme["nForeColor"]?>, <?=$theme["nForeColor"]?>);	
		background-image: -o-linear-gradient($theme["nForeColor"]?>, <?=$theme["nForeColor"]?>);
		background-image: -ms-linear-gradient($theme["nForeColor"]?>, <?=$theme["nForeColor"]?>);
		background-image: linear-gradient($theme["nForeColor"]?>, <?=$theme["nForeColor"]?>);
		
	}
  	
	.ui-widget-table-skin tr:nth-of-type(odd) { 
		border: 1px solid <?=$theme["container2"]?>;
		background-color: <?=$theme["nBackColor"]?>;
		background-image: -moz-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["container"]?>), to(<?=$theme["container2"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);	
		background-image: -o-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
		background-image: -ms-linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
		background-image: linear-gradient(<?=$theme["container"]?>, <?=$theme["container2"]?>);
	}
	.ui-widget-table-skin th { 
		max-width: <?=$theme["maxWidth"]?>px;
		border: 1px solid <?=$theme["nBorderColor"]?>;
		background-color: <?=$theme["nBackColor"]?>;
		background-image: -moz-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>); 
		background-image: -webkit-gradient(linear, left top, left bottom, from(<?=$theme["nBorderColor"]?>), to(<?=$theme["pBackColor"]?>));	
		background-image: -webkit-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);	
		background-image: -o-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: -ms-linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		background-image: linear-gradient(<?=$theme["nBorderColor"]?>, <?=$theme["pBackColor"]?>);
		color: <?=$theme["nForeColor"]?>; 
		font-weight: bold; 
	}
	.ui-widget-table tr td, .ui-widget-table th { 
		padding: 6px; 
		text-align: left; 
	}
	
	.ui-widget-table-skin tr td, ui-widget-table-skin th{
  		border: 1px solid <?=$theme["container2"]?>; 
  }
	</style>
	<!--[if !IE]><!-->
	<style>
	
	/* 
	Max width before this PARTICULAR table gets nasty
	This query will take effect for any screen smaller than 760px
	and also iPads specifically.
	*/
	@media 
	only screen and (max-width: 760px),
	(min-device-width: 768px) and (max-device-width: 1024px)  {
	
		/* Force table to not be like tables anymore */
		.ui-widget-table, .ui-widget-table thead, .ui-widget-table tbody, .ui-widget-table th, .ui-widget-table tr td, .ui-widget-table tr { 
			display: block; 
		}
		
		/* Hide table headers (but not display: none;, for accessibility) */
		.ui-widget-table thead tr { 
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
		
		.ui-widget-table-skin tr { border: 1px solid #ccc; }
		
		.ui-widget-table tr td { 
			/* Behave  like a "row" */
			border: none;
			position: relative;
			padding-left: 50%; 
		}

		.ui-widget-table-skin tr td { 
			/* Behave  like a "row" */
			border-bottom: 1px solid #eee; 
		}
    		
		.ui-widget-table tr td:before { 
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 6px;
			left: 6px;
			width: 45%; 
			padding-right: 10px; 
			white-space: nowrap;
		}
		
		/*
		Label the data
		*/
		.ui-widget-table tr td:nth-of-type(1):before { content: "First Name"; }
		.ui-widget-table tr td:nth-of-type(2):before { content: "Last Name"; }
		.ui-widget-table tr td:nth-of-type(3):before { content: "Job Title"; }
		.ui-widget-table tr td:nth-of-type(4):before { content: "Favorite Color"; }
		.ui-widget-table tr td:nth-of-type(5):before { content: "Wars of Trek?"; }
		.ui-widget-table tr td:nth-of-type(6):before { content: "Porn Name"; }
		.ui-widget-table tr td:nth-of-type(7):before { content: "Date of Birth"; }
		.ui-widget-table tr td:nth-of-type(8):before { content: "Dream Vacation City"; }
		.ui-widget-table tr td:nth-of-type(9):before { content: "GPA"; }
		.ui-widget-table tr td:nth-of-type(10):before { content: "Arbitrary Data"; }
	}
\
	</style>
	<!--<![endif]-->

	<table class="ui-widget-table ui-widget-table-skin">
		<thead>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Job Title</th>
			<th>Favorite Color</th>
			<th>Wars or Trek?</th>
			<th>Porn Name</th>
			<th>Date of Birth</th>
			<th>Dream Vacation City</th>
			<th>GPA</th>
			<th>Arbitrary Data</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>James</td>
			<td>Matman</td>
			<td>Chief Sandwich Eater</td>
			<td>Lettuce Green</td>
			<td>Trek</td>
			<td>Digby Green</td>
			<td>January 13, 1979</td>
			<td>Gotham City</td>
			<td>3.1</td>
			<td>RBX-12</td>
		</tr>
		<tr>
		  <td>The</td>
		  <td>Tick</td>
		  <td>Crimefighter Sorta</td>
		  <td>Blue</td>
		  <td>Wars</td>
		  <td>John Smith</td>
		  <td>July 19, 1968</td>
		  <td>Athens</td>
		  <td>N/A</td>
		  <td>Edlund, Ben (July 1996).</td>
		</tr>
		<tr>
		  <td>Jokey</td>
		  <td>Smurf</td>
		  <td>Giving Exploding Presents</td>
		  <td>Smurflow</td>
		  <td>Smurf</td>
		  <td>Smurflane Smurfmutt</td>
		  <td>Smurfuary Smurfteenth, 1945</td>
		  <td>New Smurf City</td>
		  <td>4.Smurf</td>
		  <td>One</td>
		</tr>
		<tr>
		  <td>Cindy</td>
		  <td>Beyler</td>
		  <td>Sales Representative</td>
		  <td>Red</td>
		  <td>Wars</td>
		  <td>Lori Quivey</td>
		  <td>July 5, 1956</td>
		  <td>Paris</td>
		  <td>3.4</td>
		  <td>3451</td>
		</tr>
		<tr>
		  <td>Captain</td>
		  <td>Cool</td>
		  <td>Tree Crusher</td>
		  <td>Blue</td>
		  <td>Wars</td>
		  <td>Steve 42nd</td>
		  <td>December 13, 1982</td>
		  <td>Las Vegas</td>
		  <td>1.9</td>
		  <td>Under the couch</td>
		</tr>
		</tbody>
	</table>
	



