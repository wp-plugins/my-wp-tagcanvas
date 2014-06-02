<?php
/*
Plugin Name: My WP-TagCanvas
Plugin URI: http://peter.bg/archives/7373
Description: My WP-TagCanvas draws and animates a HTML5 canvas based tag cloud. The plugin gets a 3D Tag cloud from Graham Breach's TagCanvas (http://www.goat1000.com/tagcanvas.php). TagCanvas is a Javascript class that draws and animates a HTML5 canvas based tag cloud. It supports following shapes: sphere, hcylinder for a cylinder that starts off horizontal, vcylinder for a cylinder that starts off vertical, hring for a horizontal circle and vring for a vertical circle. My WP-TagCanvas is derivative of Harry Xu's WP-TagCanvas v. 1.3.1 plugin and is based on TagCanvas v. 2.4.
Version: 1.0.0
Author: Peter Petrov, Harry Xu
Author URI: http://peter.bg
Update Server: http://peter.bg/
License: LGPL v3
*/

add_action('wp_head', 'wpTagCanvasHead');
function wpTagCanvasPage(){
	echo '<form method="post">';
	echo "<div class=\"wrap\"><h2>My WP-TagCloud</h2>";
	echo "</div>";
	echo '</form>';
}
function wpTagCanvasInstall(){
	$tag_option = get_option('tag_Canvas_options');
	$tag_option['title'] ='My Tag Cloud';
	$tag_option['width'] ='260';
	$tag_option['height'] ='260';
	$tag_option['splitWidth'] ='120';
	$tag_option['textColour'] ='666666';
	$tag_option['outlineColour'] ='369d88';
	$tag_option['weight_colour'] ='cccccc';
	$tag_option['reverse'] ='true';
	$tag_option['maxspeed'] ='0.05';
	$tag_option['decel'] ='0.98';
	$tag_option['initial'] ='[0, 0.3]';
	$tag_option['shape'] ='sphere';
	$tag_option['outlineMethod'] ='block';
	$tag_option['padding'] ='0';
	$tag_option['outlineRadius'] ='15';
	$tag_option['textHeight'] ='15';
	$tag_option['textFont'] ='Arial';
	$tag_option['weight_mode'] ='both';
	$tag_option['weight_size'] ='1.0';
	$tag_option['zoom'] ='1.0';
	$tag_option['pulsateTo'] ='0.1';
	$tag_option['pulsateTime'] ='1';
	$tag_option['fadeIn'] ='6000';
	$tag_option['frontSelect'] ='false';
	$tag_option['clickToFront'] ='1000';
	$tag_option['shadowOffset'] ='[1, 1]';
	$tag_option['shadow'] ='000000';
	$tag_option['shadowBlur'] ='0';
	$tag_option['depth'] ='0.5';
	$tag_option['dragControl'] ='false';

	add_option('tag_Canvas_options',$tag_option);
}
function wpTagCanvasUninstall(){
	delete_option('tag_Canvas_options');
}
function wpTagCanvasHead(){
	$nowoption = get_option('tag_Canvas_options');
	$swidth = attribute_escape($nowoption['splitWidth']);
	$tcolor = attribute_escape($nowoption['textColour']);
	$olcolor = attribute_escape($nowoption['outlineColour']);
	$reverse = attribute_escape($nowoption['reverse']);
	$speed = attribute_escape($nowoption['maxspeed']);
	$decel = attribute_escape($nowoption['decel']);
	$initial = attribute_escape($nowoption['initial']);
	$shape = attribute_escape($nowoption['shape']);
	$olmethod = attribute_escape($nowoption['outlineMethod']);
	$padding = attribute_escape($nowoption['padding']);
	$olradius = attribute_escape($nowoption['outlineRadius']);
	$texth = attribute_escape($nowoption['textHeight']);
	$textf = attribute_escape($nowoption['textFont']);
	$weight_mode = attribute_escape($nowoption['weight_mode']);
	$weight_size = attribute_escape($nowoption['weight_size']);
	$zoom = attribute_escape($nowoption['zoom']);
	$pulsateto = attribute_escape($nowoption['pulsateTo']);
	$pulsatetime = attribute_escape($nowoption['pulsateTime']);
	$fadein = attribute_escape($nowoption['fadeIn']);
	$clicktof = attribute_escape($nowoption['clickToFront']);
	$front_select = attribute_escape($nowoption['frontSelect']);
	$shadow_offset = attribute_escape($nowoption['shadowOffset']);
	$shadow = attribute_escape($nowoption['shadow']);
	$shadow_blur = attribute_escape($nowoption['shadowBlur']);
	$drag_ctrl = attribute_escape($nowoption['dragControl']);
	$depth = attribute_escape($nowoption['depth']);
	$weight_colour = attribute_escape($nowoption['weight_colour']);
	$wcolor_1=sprintf("%06x",((base_convert($tcolor,16,10)-base_convert($weight_colour,16,10))/3)+base_convert($weight_colour,16,10));
	$wcolor_2=sprintf("%06x",((base_convert($tcolor,16,10)-base_convert($weight_colour,16,10))*2/3)+base_convert($weight_colour,16,10));
	?>
<script
	src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/my-wp-tagcanvas/jquery.tagcanvas.js"
	type="text/javascript"></script>


	<?php echo '<script type="text/javascript">'; ?>
	<?php echo 'var swidth='.$swidth.';'; ?>
	<?php echo 'var tcolor=\'#'.$tcolor.'\';'; ?>
	<?php echo 'var olcolor=\'#'.$olcolor.'\';'; ?>
	<?php echo 'var reverse='.$reverse.';'; ?>
	<?php echo 'var speed='.$speed.';'; ?>
	<?php echo 'var decel='.$decel.';'; ?>
	<?php echo 'var initial='.$initial.';'; ?>
	<?php echo 'var shape=\''.$shape.'\';'; ?>
	<?php echo 'var olmethod=\''.$olmethod.'\';'; ?>
	<?php echo 'var padding=\''.$padding.'\';'; ?>
	<?php echo 'var olradius=\''.$olradius.'\';'; ?>
	<?php echo 'var texth=\''.$texth.'\';'; ?>
	<?php echo 'var textf=\''.$textf.'\';'; ?>
	<?php echo 'var weight_mode=\''.$weight_mode.'\';'; ?>
	<?php echo 'var weight_size='.$weight_size.';'; ?>
	<?php echo 'var zoom='.$zoom.';'; ?>
	<?php echo 'var pulsateto='.$pulsateto.';'; ?>
	<?php echo 'var pulsatetime='.$pulsatetime.';'; ?>
	<?php echo 'var fadein='.$fadein.';'; ?>
	<?php echo 'var clicktof='.$clicktof.';'; ?>
	<?php echo 'var front_select='.$front_select.';'; ?>
	<?php echo 'var shadow_offset='.$shadow_offset.';'; ?>
	<?php echo 'var shadow=\'#'.$shadow.'\';'; ?>
	<?php echo 'var shadow_blur='.$shadow_blur.';'; ?>
	<?php echo 'var drag_ctrl='.$drag_ctrl.';'; ?>
	<?php echo 'var depth='.$depth.';'; ?>
	<?php echo 'var wcolor=\'#'.$weight_colour.'\';'; ?>
	<?php echo 'var weight_colour={0:\'#'.$weight_colour.'\', 0.33:\'#'.$wcolor_2.'\',0.66:\'#'.$wcolor_1.'\', 1:\'#'.$tcolor.'\'}'; ?>

function addLoadEvent(your_function) { if (window.attachEvent)
{window.attachEvent('onload', your_function);} else if
(window.addEventListener) {window.addEventListener('load',
your_function, false);} else {document.addEventListener('load',
your_function, false);} } function tagcloud_load() { try {
TagCanvas.maxSpeed = speed; 
TagCanvas.decel = decel; 
TagCanvas.initial = initial; 
TagCanvas.textColour = tcolor;
TagCanvas.outlineColour = olcolor; 
TagCanvas.reverse=reverse;
TagCanvas.shape=shape;
TagCanvas.outlineMethod=olmethod;
TagCanvas.outlineRadius=olradius;
TagCanvas.splitWidth=swidth;
TagCanvas.textHeight=texth;
TagCanvas.textFont=textf;
if((weight_mode=="size")||(weight_mode=="colour")||(weight_mode=="both")){
TagCanvas.weight=true; 
TagCanvas.weightMode=weight_mode;
TagCanvas.weightSize=weight_size;
TagCanvas.zoom=zoom;
TagCanvas.pulsateTo=pulsateto;
TagCanvas.pulsateTime=pulsatetime;
TagCanvas.fadeIn=fadein;
TagCanvas.clickToFront=clicktof;
TagCanvas.frontSelect=front_select;
TagCanvas.shadowOffset=shadow_offset;
TagCanvas.shadow=shadow;
TagCanvas.shadowBlur=shadow_blur;
TagCanvas.dragControl=drag_ctrl;
TagCanvas.depth=depth;
TagCanvas.weightGradient=weight_colour; }
TagCanvas.Start('tag_canvas','tag_html5'); } catch(err) { } }

addLoadEvent(tagcloud_load);

</script>


<?php
}

/*			WIDGET			*/

function wpTagCanvasLoad(){
	//Check for required functions
	if (!function_exists('register_sidebar_widget'))
	return;

	function wpTagCanvasCtrl(){
		$tag_option = get_option('tag_Canvas_options');
		if ( $_POST["wpTagCanvas_widget_submit"] ) {
			$tag_option['title'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_title"]));
			$tag_option['width'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_width"]));
			$tag_option['height'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_height"]));
			$tag_option['splitWidth'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_swidth"]));
			$tag_option['textColour'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_tcolor"]));
			$tag_option['outlineColour'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_olcolor"]));
			$tag_option['reverse'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_reverse"]));
			$tag_option['maxspeed'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_speed"]));
			$tag_option['decel'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_decel"]));
			$tag_option['initial'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_initial"]));
			$tag_option['shape'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_shape"]));
			$tag_option['outlineMethod'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_olmethod"]));
			$tag_option['padding'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_padding"]));
			$tag_option['outlineRadius'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_olradius"]));
			$tag_option['textHeight'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_texth"]));
			$tag_option['textFont'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_textf"]));
			$tag_option['weight_mode'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_weight_mode"]));
			$tag_option['weight_size'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_weight_size"]));
			$tag_option['zoom'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_zoom"]));
			$tag_option['pulsateTo'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_pulsateto"]));
			$tag_option['pulsateTime'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_pulsatetime"]));
			$tag_option['fadeIn'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_fadein"]));
			$tag_option['clickToFront'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_clicktof"]));
			$tag_option['frontSelect'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_front_select"]));
			$tag_option['shadowOffset'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_shadow_offset"]));
			$tag_option['shadow'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_shadow"]));
			$tag_option['shadowBlur'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_shadow_blur"]));
			$tag_option['dragControl'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_drag_ctrl"]));
			$tag_option['depth'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_depth"]));
			$tag_option['weight_colour'] =strip_tags(stripslashes($_POST["wpTagCanvas_widget_weight_colour"]));
			update_option('tag_Canvas_options',$tag_option);
		}
		$title = attribute_escape($tag_option['title']);
		$width = attribute_escape($tag_option['width']);
		$height = attribute_escape($tag_option['height']);
		$swidth = attribute_escape($tag_option['splitWidth']);
		$tcolor = attribute_escape($tag_option['textColour']);
		$olcolor = attribute_escape($tag_option['outlineColour']);
		$speed = attribute_escape($tag_option['maxspeed']);
		$reverse = attribute_escape($tag_option['reverse']);
		$decel = attribute_escape($tag_option['decel']);
		$initial = attribute_escape($tag_option['initial']);
		$shape = attribute_escape($tag_option['shape']);
		$olmethod = attribute_escape($tag_option['outlineMethod']);
		$padding = attribute_escape($tag_option['padding']);
		$olradius = attribute_escape($tag_option['outlineRadius']);
		$texth = attribute_escape($tag_option['textHeight']);
		$textf = attribute_escape($tag_option['textFont']);		
		$weight_mode = attribute_escape($tag_option['weight_mode']);
		$weight_size = attribute_escape($tag_option['weight_size']);
		$zoom = attribute_escape($tag_option['zoom']);
		$pulsateto = attribute_escape($tag_option['pulsateTo']);
		$pulsatetime = attribute_escape($tag_option['pulsateTime']);
		$fadein = attribute_escape($tag_option['fadeIn']);
		$clicktof = attribute_escape($tag_option['clickToFront']);
		$front_select = attribute_escape($tag_option['frontSelect']);
		$shadow_offset = attribute_escape($tag_option['shadowOffset']);
		$shadow = attribute_escape($tag_option['shadow']);
		$shadow_blur = attribute_escape($tag_option['shadowBlur']);
		$drag_ctrl = attribute_escape($tag_option['dragControl']);
		$depth = attribute_escape($tag_option['depth']);
		$weight_colour = attribute_escape($tag_option['weight_colour']);

		?>
<div  style="border-bottom: 1px solid #444; text-align: justify; padding: 10px 0;">All TagCanvas Options are described <a href="http://www.goat1000.com/tagcanvas-options.php" target="_blank"><strong>here</strong></a>. Those not included below can be tuned directly in <strong>jquery.tagcanvas.js <a href="/wp-admin/plugin-editor.php?file=my-wp-tagcanvas%2Fjquery.tagcanvas.js&plugin=my-wp-tagcanvas%2FMy-WP-TagCanvas.php" target="_blank">here</a>.<p style="margin: 10px 0 0 0;"><u>Tip:</u></strong> Type Option Values carefully. Wrong values make TagCloud disappear until you correct them.</p></div>

<p>
	<label for="wpTagCanvas_widget_title"><?php _e('Title'); ?> <input
		class="widefat" id="wpTagCanvas_widget_title"
		name="wpTagCanvas_widget_title" type="text"
		value="<?php echo $title; ?>" /> </label>
</p>
<p style="clear: both"></p>
<p>
	<label for="wpTagCanvas_widget_width" style="width: 33%; float: left; margin-bottom: 20px;"><?php _e('Width'); ?> <input
		class="widefat" id="wpTagCanvas_widget_width"
		name="wpTagCanvas_widget_width" type="text"
		value="<?php echo $width; ?>" /> </label>
	<label for="wpTagCanvas_widget_height" style="width: 33%; float: left; margin-bottom: 20px;"><?php _e('Height'); ?> <input
		class="widefat" id="wpTagCanvas_widget_height"
		name="wpTagCanvas_widget_height" type="text"
		value="<?php echo $height; ?>" /> </label>
	<label for="wpTagCanvas_widget_swidth" style="width: 34%; float: left; margin-bottom: 20px;"><?php _e('Split Width'); ?> <input
		class="widefat" id="wpTagCanvas_widget_swidth"
		name="wpTagCanvas_widget_swidth" type="text"
		value="<?php echo $swidth; ?>" /> </label>
</p>
<p style="clear: both"></p>
<p>
	<label for="wpTagCanvas_widget_tcolor" style="width: 33%; float: left;"><?php _e('Text Color'); ?> <input
		class="widefat" id="wpTagCanvas_widget_tcolor"
		name="wpTagCanvas_widget_tcolor" type="text"
		value="<?php echo $tcolor; ?>" /> </label>

	<label for="wpTagCanvas_widget_olcolor" style="width: 33%; float: left;"><?php _e('Outline Color'); ?>
		<input class="widefat" id="wpTagCanvas_widget_olcolor"
		name="wpTagCanvas_widget_olcolor" type="text"
		value="<?php echo $olcolor; ?>" /> </label>

	<label for="wpTagCanvas_widget_weight_colour" style="width: 34%; float: left;"><?php _e('Popular Tag Color'); ?>
		<input class="widefat" id="wpTagCanvas_widget_weight_colour"
		name="wpTagCanvas_widget_weight_colour" type="text"
		value="<?php echo $weight_colour; ?>" /> </label>
</p>
<p style="clear: both"></p>
<p style="float: left; margin: 0;">
	<label style="width: 25%; float: left;" for="wpTagCanvas_widget_initial"><?php _e('Initial Speed'); ?> <input
		class="widefat" id="wpTagCanvas_widget_initial"
		name="wpTagCanvas_widget_initial" type="text"
		value="<?php echo $initial; ?>" /> </label>
		
	<label style="width: 25%; float: left;" for="wpTagCanvas_widget_speed"><?php _e('Max Speed'); ?> <input
		class="widefat" id="wpTagCanvas_widget_speed"
		name="wpTagCanvas_widget_speed" type="text"
		value="<?php echo $speed; ?>" /> </label>

	<label style="width: 25%; float: left; margin: 0 10px 0 0;" for="wpTagCanvas_widget_decel"><?php _e('Deceleration'); ?> <input
		class="widefat" id="wpTagCanvas_widget_decel"
		name="wpTagCanvas_widget_decel" type="text"
		value="<?php echo $decel; ?>" /> </label>

<u><?php _e('Reverse'); ?></u>
	<br /> <input class="radio" id="wpTagCanvas_widget_reverse"
		name="wpTagCanvas_widget_reverse" type="radio" value="false"

		<?php if( $reverse == "false" ){ echo ' checked="checked"'; } ?>>
	false<br /> <input class="radio" id="wpTagCanvas_widget_reverse"
		name="wpTagCanvas_widget_reverse" type="radio" value="true"

		<?php if( $reverse == "true" ){ echo ' checked="checked"'; } ?>>
	true 
</p>
<p style="clear: both"></p>
<p style="float: left; margin: 0 20px 20px 0; whdth: 33%;">
<u><?php _e('Shape'); ?></u>
	<br /> <input class="radio" id="wpTagCanvas_widget_shape"
		name="wpTagCanvas_widget_shape" type="radio" value="sphere"

		<?php if( $shape == "sphere" ){ echo ' checked="checked"'; } ?>>
	sphere<br /> <input class="radio" id="wpTagCanvas_widget_shape"
		name="wpTagCanvas_widget_shape" type="radio" value="hcylinder"

		<?php if( $shape == "hcylinder" ){ echo ' checked="checked"'; } ?>>
	hcylinder<br /> <input class="radio" id="wpTagCanvas_widget_shape"
		name="wpTagCanvas_widget_shape" type="radio" value="vcylinder"

		<?php if( $shape == "vcylinder" ){ echo ' checked="checked"'; } ?>>
	vcylinder<br /> <input class="radio" id="wpTagCanvas_widget_shape"
		name="wpTagCanvas_widget_shape" type="radio" value="hring"
		
				<?php if( $shape == "hring" ){ echo ' checked="checked"'; } ?>>
	hring<br /> <input class="radio" id="wpTagCanvas_widget_shape"
		name="wpTagCanvas_widget_shape" type="radio" value="vring"

		<?php if( $shape == "vring" ){ echo ' checked="checked"'; } ?>>
	vring
</p>
<p style="float: left; margin: 0 20px 20px 0; whdth: 33%;">
<u><?php _e('Outline Method'); ?></u>
	<br /> <input class="radio" id="wpTagCanvas_widget_olmethod"
		name="wpTagCanvas_widget_olmethod" type="radio" value="outline"

		<?php if( $olmethod == "outline" ){ echo ' checked="checked"'; } ?>>
	outline<br /> <input class="radio" id="wpTagCanvas_widget_olmethod"
		name="wpTagCanvas_widget_olmethod" type="radio" value="classic"

		<?php if( $olmethod == "classic" ){ echo ' checked="checked"'; } ?>>
	classic<br /> <input class="radio" id="wpTagCanvas_widget_olmethod"
		name="wpTagCanvas_widget_olmethod" type="radio" value="block"

		<?php if( $olmethod == "block" ){ echo ' checked="checked"'; } ?>>
	block<br /> <input class="radio" id="wpTagCanvas_widget_olmethod"
		name="wpTagCanvas_widget_olmethod" type="radio" value="colour"

		<?php if( $olmethod == "colour" ){ echo ' checked="checked"'; } ?>>
	colour<br /> <input class="radio" id="wpTagCanvas_widget_olmethod"
		name="wpTagCanvas_widget_olmethod" type="radio" value="none"
		
		<?php if( $olmethod == "none" ){ echo ' checked="checked"'; } ?>>
	none
</p>
<p style="float: left; margin: 0 0 20px 0; whdth: 34%;">
<u><?php _e('Weight Mode'); ?></u>
	<br /> <input class="radio" id="wpTagCanvas_widget_weight_mode"
		name="wpTagCanvas_widget_weight_mode" type="radio" value="off"

		<?php if( $weight_mode == "off" ){ echo ' checked="checked"'; } ?>>
	off<br /> <input class="radio" id="wpTagCanvas_widget_weight_mode"
		name="wpTagCanvas_widget_weight_mode" type="radio" value="size"

		<?php if( $weight_mode == "size" ){ echo ' checked="checked"'; } ?>>
	size<br /> <input class="radio" id="wpTagCanvas_widget_weight_mode"
		name="wpTagCanvas_widget_weight_mode" type="radio" value="colour"

		<?php if( $weight_mode == "colour" ){ echo ' checked="checked"'; } ?>>
	colour<br /> <input class="radio" id="wpTagCanvas_widget_weight_mode"
		name="wpTagCanvas_widget_weight_mode" type="radio" value="both"

		<?php if( $weight_mode == "both" ){ echo ' checked="checked"'; } ?>>
	both
</p>
<p style="clear: both"></p>
<p>
	<label style="width: 33%; float: left;" for="wpTagCanvas_widget_pulsateto"><?php _e('Pulsate2Opacity'); ?> <input
		class="widefat" id="wpTagCanvas_widget_pulsateto"
		name="wpTagCanvas_widget_pulsateto" type="text"
		value="<?php echo $pulsateto; ?>" /> </label>

	<label style="width: 33%; float: left;" for="wpTagCanvas_widget_pulsatetime"><?php _e('Pulsate Time'); ?>
		<input class="widefat" id="wpTagCanvas_widget_pulsatetime"
		name="wpTagCanvas_widget_pulsatetime" type="text"
		value="<?php echo $pulsatetime; ?>" /> </label>

	<label style="width: 34%; float: left;" for="wpTagCanvas_widget_fadein"><?php _e('Fade in Time'); ?>
		<input class="widefat" id="wpTagCanvas_widget_fadein"
		name="wpTagCanvas_widget_fadein" type="text"
		value="<?php echo $fadein; ?>" /> </label>
</p>
<p style="clear: both"></p>
<p style="float: left; width: 33%; margin: 0">
<u><?php _e('Drag Control'); ?></u>
	<br /> <input class="radio" id="wpTagCanvas_widget_drag_ctrl"
		name="wpTagCanvas_widget_drag_ctrl" type="radio" value="false"

		<?php if( $drag_ctrl == "false" ){ echo ' checked="checked"'; } ?>>
	false<br /> <input class="radio" id="wpTagCanvas_widget_drag_ctrl"
		name="wpTagCanvas_widget_drag_ctrl" type="radio" value="true"

		<?php if( $drag_ctrl == "true" ){ echo ' checked="checked"'; } ?>>
	true 
</p>
<p style="float: left; width: 33%; margin: 0">
<u><?php _e('Front Select'); ?></u>
	<br /> <input class="radio" id="wpTagCanvas_widget_front_select"
		name="wpTagCanvas_widget_front_select" type="radio" value="false"

		<?php if( $front_select == "false" ){ echo ' checked="checked"'; } ?>>
	false<br /> <input class="radio" id="wpTagCanvas_widget_front_select"
		name="wpTagCanvas_widget_front_select" type="radio" value="true"

		<?php if( $front_select == "true" ){ echo ' checked="checked"'; } ?>>
	true 
</p>
<div style="display: inline">
	<label style="width: 34%; float: left; margin-bottom: 20px;" for="wpTagCanvas_widget_clicktof"><?php _e('Click2Front Time'); ?> <input
		class="widefat" id="wpTagCanvas_widget_clicktof"
		name="wpTagCanvas_widget_clicktof" type="text"
		value="<?php echo $clicktof; ?>" /> </label>
</div>
<p style="clear: both"></p>
<p>
	<label style="width: 33%; float: left; margin-bottom: 20px;" for="wpTagCanvas_widget_zoom"><?php _e('Zoom'); ?>
		<input class="widefat" id="wpTagCanvas_widget_zoom"
		name="wpTagCanvas_widget_zoom" type="text"
		value="<?php echo $zoom; ?>" /> </label>

	<label style="width: 33%; float: left; margin-bottom: 20px;" for="wpTagCanvas_widget_weight_size"><?php _e('Size Weight'); ?>
		<input class="widefat" id="wpTagCanvas_widget_weight_size"
		name="wpTagCanvas_widget_weight_size" type="text"
		value="<?php echo $weight_size; ?>" /> </label>
		
	<label style="width: 34%; float: left; margin-bottom: 20px;" for="wpTagCanvas_widget_depth"><?php _e('Depth'); ?> <input
		class="widefat" id="wpTagCanvas_widget_depth"
		name="wpTagCanvas_widget_depth" type="text"
		value="<?php echo $depth; ?>" /> </label>
</p>
<p style="clear: both"></p>
<p>
	<label style="width: 24%; float: left; margin-bottom: 20px;" for="wpTagCanvas_widget_texth"><?php _e('Text Height'); ?> <input
		class="widefat" id="wpTagCanvas_widget_texth"
		name="wpTagCanvas_widget_texth" type="text"
		value="<?php echo $texth; ?>" /> </label>
		
	<label style="width: 24%; float: left; margin-bottom: 20px;" for="wpTagCanvas_widget_textf"><?php _e('Font'); ?> <input
		class="widefat" id="wpTagCanvas_widget_textf"
		name="wpTagCanvas_widget_textf" type="text"
		value="<?php echo $textf; ?>" /> </label>

	<label style="width: 24%; float: left; margin-bottom: 20px;" for="wpTagCanvas_widget_padding"><?php _e('Padding'); ?> <input
		class="widefat" id="wpTagCanvas_widget_padding"
		name="wpTagCanvas_widget_padding" type="text"
		value="<?php echo $padding; ?>" /> </label>
	
	<label style="width: 28%; float: left; margin-bottom: 20px;" for="wpTagCanvas_widget_olradius"><?php _e('Outline Radius'); ?> <input
		class="widefat" id="wpTagCanvas_widget_olradius"
		name="wpTagCanvas_widget_olradius" type="text"
		value="<?php echo $olradius; ?>" /> </label>
</p>
<p style="clear: both"></p>
<p>
	<label style="width: 33%; float: left; margin-bottom: 20px;" for="wpTagCanvas_widget_shadow"><?php _e('Shadow Color'); ?> <input
		class="widefat" id="wpTagCanvas_widget_shadow"
		name="wpTagCanvas_widget_shadow" type="text"
		value="<?php echo $shadow; ?>" /> </label>

	<label style="width: 33%; float: left; margin-bottom: 20px;" for="wpTagCanvas_widget_shadow_blur"><?php _e('Shadow Blur'); ?> <input
		class="widefat" id="wpTagCanvas_widget_shadow_blur"
		name="wpTagCanvas_widget_shadow_blur" type="text"
		value="<?php echo $shadow_blur; ?>" /> </label>
		
	<label style="width: 34%; float: left; margin-bottom: 20px;" for="wpTagCanvas_widget_shadow_offset"><?php _e('Shadow Offset'); ?> <input
		class="widefat" id="wpTagCanvas_widget_shadow_offset"
		name="wpTagCanvas_widget_shadow_offset" type="text"
		value="<?php echo $shadow_offset; ?>" /> </label>
</p>

<p style="clear: both"></p>
<input
	type="hidden" id="wpTagCanvas_widget_submit"
	name="wpTagCanvas_widget_submit" value="1" />

	<?php
	}

	function wpTagCanvasWidget($args){
		extract($args);
		$options=get_option('tag_Canvas_options');
		$title = attribute_escape($options['title']);
		$width = attribute_escape($options['width']);
		$height = attribute_escape($options['height']);
		echo $before_widget;
		if( $title )
		echo $before_title . $title . $after_title;?>
<div id="tag_html5" width="<?php echo $width;?>"
	height="<?php echo $height;?>" hidden>


	<?php wp_tag_cloud(); ?>
</div>
<canvas width="<?php echo $width;?>" height="<?php echo $height;?>"
	id="tag_canvas">
					</canvas>


					<?php
					echo $after_widget;
	}

	register_sidebar_widget('My WP-TagCanvas', 'wpTagCanvasWidget');
	register_widget_control( "My WP-TagCanvas", "wpTagCanvasCtrl" );
}

// Delay plugin execution until sidebar is loaded
add_action('widgets_init', 'wpTagCanvasLoad');

// add the actions
register_activation_hook( __FILE__, 'wpTagCanvasInstall' );
register_deactivation_hook( __FILE__, 'wpTagCanvasUninstall' );
?>