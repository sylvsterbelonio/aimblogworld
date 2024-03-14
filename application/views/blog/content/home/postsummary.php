<style>
@import url(http://fonts.googleapis.com/css?family=Open+Sans);



/* STRUCTURE */

@media screen and (min-width: 720px){ 
	#middle,#content,#sidebar {
		display:block;
		width: 100%;
	}

#pagewrap {
	padding: 5px;
	width: <?=$maxWidth?>px;
	margin: 20px auto;
}
header {
	height: 100px;
	padding: 0 15px;
}
#content {
	width: 32%;
	float: left;
	padding: 5px 15px;
}

#middle {
	width: 32%; /* Account for margins + border values */
	float: left;
	padding: 5px 15px;
	margin: 0px 5px 5px 5px;
}

#sidebar {
	width: 32%;
	padding: 5px 15px;
	float: left;
}
footer {
	clear: both;
	padding: 0 15px;
}
</style>

<div id="pagewrap">

	<header>
		<h1>3 Column Responsive Layout</h1>
	</header>
		
	<section id="content">
		<h2>1st Content Area</h2>
		<p>This page demonstrates a 3 column responsive layout, complete with responsive images and jquery slideshow.</p>
	</section>
	
	<section id="middle">
		<h2>2nd Content Area</h2>
		<p>At full width all three columns will be displayed side by side. As the page is resized the third column will collapse under the first and second. At the smallest screen size all three columns will be stacked on top of one another.</p>
		<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
	</section>

	<aside id="sidebar">
		<h2>3rd Content Area</h2>
		<p>Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
		<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
		<p>Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
	</aside>
	
	<footer>
		<h4>Footer</h4>
		<p>Footer text</p>
	</footer>

</div>
