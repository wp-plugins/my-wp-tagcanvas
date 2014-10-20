<?php 
/*
3D WP Tag Cloud-S: Tips
*/
?>
<h3>General Tips</h3>
<div class="section_content">
	<p><span>1. </span>Keep <span>Settings Tooltips</span> ON while you get familiar with plugin options.</p>
	<p><span>2. </span>If after installation of a new plugin's version your existing clouds disappear, just open already created widget instances and save them again without any changes.</p>
	<p><span>3. </span>Get clue for plugin abilities from these <a style="color:#1e8cbe; font-weight: bold;" href="http://peter.bg/archives/7373" target="_blank">Single Cloud</a> and <a style="color:#1e8cbe; font-weight: bold;" href="http://peter.bg/archives/7720" target="_blank">All in One</a> cloud examples.</p>
</div>
<h3>Cloud Content Tips</h3>
<div class="section_content">
	<p><span>1. </span>Through WP <span>Links</span> panel you can create content for your cloud that consists of images instead of text. The URLs may be those of menu options, post categories, pages, archives, selected posts or even post authors. For "how to do it" look in <span>How to... Tips</span> section below.</p>
	<p><span>2. </span>If you want to use <span>Recent Posts</span> option bare in mind that post titles are much longer than a single word.
	So you have to apply it with <span>Split Width</span> option, giving a value of around 80-100px to the latter. 
	In addition keep the <span>Number of Posts</span> around 10.</p>
	<p><span>3. </span>Be aware that any post without title will make your <span>Recent Posts</span> Cloud Disappear.
	<p><span>4. </span>When you create a menu in WP through <span>Appearance > Menus</span> panel you may not use it in the Header of your WP Theme.
	Instead add it into a cloud via <span>Content > Menu</span> option and locate the widget instance in preferred place of your Home Page. 
	You may not use even WP <span>Menus</span> panel, because you can put menu's options in the WP <span>Links</span> section and create category of hidden links that will be used only by the cloud and presented as rotating 3D Menu.</p>
	<p><span>5. </span>Be aware that subject to weighting could be all types of Cloud's content except <span>Menu</span> and <span>Pages</span>.</p>
</div>
<h3>Coloring Tips</h3>
<div class="section_content">
	<p><span>1. </span>If you want to apply <span>Multiple Colors</span> don't forget to empty <span>Tags</span> Color field. If you want to apply <span>Multiple Backgrounds</span> type in <span>Background</span> field <span>tag</span>. Otherwise even if <span>Multiple Colors</span> and <span>Multiple Backgrounds</span> are specified they will not take effect.
	<p><span>2. </span>In addition to he above be known that <span>Gradient</span> Colors that <span>color</span> and <span>size & color</span> options of <span>Weight Mode</span> use, override <span>Multiple Colors</span>. 
	In the same way they override <span>Multiple Backgrounds</span> when <span>Weight Mode</span> is <span>bgcolor</span>. In other words <span>Multiple Colors</span> and <span>Multiple Backgrounds</span> may work when <span>Weight Mode</span> is <span>size</span>.
	<p><span>3. </span>You have to insert 4 colors for using <span>Gradient</span>, but you don't have to insert 4 different values! For example you may choose: color at 0: <span>#ff0</span>; color at 0.33: <span>#33ff00</span>; color at 0.67: <span>#33ff00</span> and color at 1: <span>#006633</span>. In this case the #33ff00 color will take longer part of the <span>Gradient</span> and it will become more greenish.
</div>
<h3>Sizing Tips</h3>
<div class="section_content">
	<p><span>1. </span>In order to fit your Cloud into widget's frame you can use not only <span>Radius X</span>, <span>Radius Y</span> and <span>Radius Z</span> but widget's <span>Height</span> or <span>Width</span>. 
	This is because clouds are calculated for square space. So when one of widget's sizes is smaller than the other it determines the space for the cloud.
	<p><span>2. </span>By changing one or two of <span>Radius X</span>, <span>Radius Y</span> and <span>Radius Z</span> you can modify the <span>shape</span> of the Cloud. 
	<p><span>3. </span>When you use <span>Archives</span> or <span>Authors</span> for Cloud Content, there might be a big difference between number of posts in the months or between authors' publications. 
	Since those numbers are base for weighting that will lead to extremely big size of some tags and extremely small for others. That is why you have to put limits using <span>Weight Size Max</span> and <span>Weight Size Min</span>. 
	Good practise is to limit maximal font height to around 24px and minimal to around 9px.</p>
</div>
<h3>Speed Tips</h3>
<div class="section_content">
	<p><span>1. </span>The best <span>Initial Speed</span> is between 0.1-0.4.</p>
	<p><span>2. </span>Reduce <span>Max Speed</span> to 0.2 for nice results with <span>Drag Control</span>.</p>
	<p><span>3. </span>Do not get confused by units of <span>Max Speed</span>. Think about it as a multiplier of speed.</p>
</div>
<h3>How to... Tips</h3>
<div class="section_content" style="padding-bottom: 0;">
	<div id="accordion-6" style="padding: 0 0 3px;">
		<h3 style="margin-top: 5px;">1. How to create a Tag Cloud of images</h3>
		<div class="section_content"> 
			<p>
				3D WP Tag Cloud can show images if it consists of <span>Links</span> or <span>Recent Posts</span>. 
				In the case of <span>Recent Posts</span> you have to provide them with a Featured Image (preferably thumbnail size). 
				But generally speaking for making cloud of images you'd better use the other option - Links. In other words you create a rotating blogroll.  
			</p>
			<p>
				So first create a Link Category in the <span>Links</span> Section of WP Admin Panel. Fill it up with some links. 
				Do not forget to attach images to them. Its good to use one size for all. 80x80px would do fine. Make all links hidden. 
				By this they will not appear elsewhere but in your widget instance. The text of the link does not matter - it will not be shown. 
				(The option for showing both - the image and the text of the links is envisaged for the future.)
			</p>
			<p>
				As a matter of fact, this is another way to create a cloud of Post Titles, Menu Options, Pages, Archives, List of Authors and/or Post Categories but this time presenting them by images.  
			</p>
			</div>
		<h3>2. How to create a Slideshow Imitation</h3>
		<div class="section_content">
			<p>
				Usually Slideshows are like a ribbon - short and wide. So how to create a short and wide widget instance that imitates slideshow?<br><br>
				1. Make sure you have enough wide sidebar for the widget;<br>
				2. Choose <span>Single Cloud</span> mode;<br>
				2. Create list of Image Links in the Links Section of WP Admin Panel <i>(See above "How to create Tag Cloud of images".)</i>;<br>
				3. Create a widget instance with following option values:<br>
					- <span>Widget Height</span>: ... <i>(We assume that it must be short, so start with the shortest value plugin offers: 160px.)</i>;<br>
					- <span>Shape</span>: vring;<br>
					- <span>Content</span>: links;<br>
					- <span>Links Category</span>: ... <i>(the category you created for the purpose above)</i>;<br>
					- <span>Radius X, Radius Z</span>: ... (Set equal values about 6.5 or above for both, assuming that images are around 140x140px. If images are wider increase Radiuses. No need to play with Radius Y.)<br>
					- <span>Drag Control</span>: on;<br>
					- <span>Widget Tooltip</span>: Drag and Click;<br>
					- <span>Lock Rotation</span>: y;<br>
					- <span>Min Opacity</span>: 0;<br>
					- <span>Initial Speed [x,y]</span>: 0.15, 0 <i>(or [-0.15, 0] depending on initial direction of rotation you prefer)</i>;<br>
					- <span>Min Speed</span>: 0.005<br>
					- <span>Max Speed</span>: 0.01
			</p>
			</div>
		<h3>3. How to put your logo in the center of the cloud</h3>
		<div class="section_content">
			<p>
				Use <span>Center Function</span> option in <span>BG IMG, TOOLTIPS, CURSOR, CENTER FN</span> section. Choose function 
				<span>image_cf()</span> and enter <span>URL</span> of your image (<span>http://your-site.com/your-folder/your-image.png</span>). 
				It is advisable to use png format images due to advantage of transparency. It is good if image sizes are equal to widget's 
				<span class='green'>Width,</span> and <span class='green'>Height</span> or bigger but in same proportion. 
				Opaque part of it should look compact and be in the center. Plugin will resize image so that tags pass along without "bumping" in it.
				For creating your own functions you need to be fluent in HTML5 and particularly in <span>&#60;canvas&#62;</span> drawing. If you are not - learning is easy. 
				Here are two useful tutorials:<br>
				<a style="color:#1e8cbe; font-weight: bold;" href="http://diveintohtml5.info/canvas.html" target="_blank">LET'S CALL IT A DRAW(ING SURFACE)</a><br>
				and<br>
				<a style="color:#1e8cbe; font-weight: bold;" href="http://www.w3schools.com/html/html5_canvas.asp" target="_blank">HTML5 Canvas</a>.<br>
				For time being now you can use and modify following ready made samples that give you the three basic possibilities: to add image, to add text and to rotate created object: 
				<a style="color:#1e8cbe; font-weight: bold;" href="http://peter.bg/archives/7840" title="Go there and get one!" target="_blank">Samples of Center Function</a>
			</p>
		</div>
		<h3>4. How to stop tag outline pulsation?</h3>
		<div class="section_content">
			<p>
				Set <span>Pulsate to Opacity</span> option value to 1.
			</p>
		</div>
		<h3>5. How to ask a question or make a suggestion</h3>
		<div class="section_content">
			<p>
				<a style="color:#1e8cbe; font-weight: bold;" href="mailto:peter.m.petrov@gmail.com">Email me</a>.
			</p>
		</div>
	</div>
</div>	