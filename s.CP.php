<?php 
/*
3D WP Tag Cloud-S: HTML Control Panel Template
*/
// Important variables for redirecting to WP Admin panel > Appearance > Widgets page
	$admin_url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	$look_4_string_1 = "editwidget";
	$look_4_string_2 = "customize";
	$check_widget_1 = strpos($admin_url, $look_4_string_1);
	$check_widget_2 = strpos($admin_url, $look_4_string_2);
// Registering scripts and CSS file	
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-tooltip');
    wp_register_style('tag-cloud-css', plugin_dir_url( __FILE__ ) . 'css/3D.WP.Tag.Cloud.S.css');
    wp_enqueue_style('tag-cloud-css');
// ===
?>
<style>.widget-inside {padding:0!important; border-radius: 5px; border:1px solid #bbb; background: #f1f1f1;};</style>
<script type="text/javascript">
//------- Initialisation of jQuery widgets for CP page -------
	jQuery(window).load(function() {
		var check = '<?= $check_widget_1; ?>';
		if(check != ''){
		jQuery('#accordion-1, #wihead').tooltip({content: function() {var element = jQuery( this ); var html_text=element.attr('title'); return html_text;}, position: {  my: 'left top+20',  at: 'left bottom'}}); 
		jQuery(function() {jQuery( "#accordion-1" ).accordion({heightStyle: "content", collapsible: true, active: false}); jQuery( "#accordion-3, #accordion-6" ).accordion({heightStyle: "content", collapsible: true, active: false});});
		};
	 });
// Check for 2d shape selection and hiding Radius Z 
	function check43d(vis){
		var raze;
		if(vis == 'hidden'){raze = 0} else{raze = 1};
		jQuery('#<?=$this->get_field_id('radius_z'); ?>').val(raze);
		jQuery('#cont_<?=$this->get_field_id('radius_z'); ?>').css('visibility', vis);
	}
// Center Function Text check
	function qutes_check(e,s){
		if(/"/g.test(s) == true){
			jQuery(e).tooltip({ content: 'Use <span style="font-weight: bold; color: red;">single quotes</span> (<span style="font-weight: bold; color: red;">&#39;</span>) please!', tooltipClass: 'custom-tooltip-styling', position: { my: 'center top', at: 'center bottom+15' } }); 
			jQuery(e).focus(); 
			jQuery(e).tooltip({content: function(){
				var element = jQuery( this ); 
				var html_text=element.attr('title'); return html_text;}
			});
		}
	};
	
// HEX check for entered colors	
	function hex_val_check(e,s){
		if(s == 'tag' && (e.id.search('bg_color') > -1 || e.id.search('bg_outline') > -1 )){
			jQuery(e).parent().find('.color').remove(); 
			jQuery(e).parent().append('<span class="color" style="background: #fff; padding: 0 0 0 1px; letter-spacing: 0;">original color</span>');
			}
		else{
			hex_check = /(^[0-9A-F]{6}$)|(^[0-9A-F]{3}$)/i.test(s);
			if (hex_check == true){
				jQuery(e).parent().find('.color').remove();
				jQuery(e).parent().append('<span class="color" style="color: #'+s+';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>');
			}
			else { 
				if(s!=''){
					jQuery(e).tooltip({ content: 'Wrong Color Value: <span style="font-weight: bold; color: red;">'+s+'</span><br>Please enter a valid one!', tooltipClass: 'custom-tooltip-styling', position: { my: 'center top', at: 'center bottom+15' } }); 
					jQuery(e).parent().find('.color').remove();
					jQuery(e).parent().append('<span class="color" style="background: #fff; position: relative; top: 0; margin: 0 0 0 8px; letter-spacing: 0; font-size: 11px;">Oops!</span>');
					jQuery(e).focus(); 
					jQuery(e).tooltip({content: function(){
						var element = jQuery( this ); 
						var html_text=element.attr('title'); return html_text;}
					});
				}
				else{jQuery(e).parent().find('.color').remove();};
			}
		}
	}

// HEX check for entered multiple colors		
	var poscal = 0;
	function multi_colors_check(e,s,d){
		var multiple_colors = s.replace(/ /gi, '');
		var mcl = multiple_colors.length;
		var multiple_colors = multiple_colors.replace(/,,/gi, ',');
		while(mcl > multiple_colors.length){
			multiple_colors = multiple_colors.replace(/,,/gi, ',');
			mcl = mcl - 1;
		};
		jQuery(e).val(multiple_colors);
		while(multiple_colors.charAt(multiple_colors.length-1) == ',') {
			multiple_colors = multiple_colors.substr(0, multiple_colors.length-1)	
		};
		jQuery(e).val(multiple_colors);	
		var mc_array = multiple_colors.split(',');
		jQuery(d).empty();
		if(multiple_colors != ''){
			for (var i = 0; i < mc_array.length; i++) {
				var hex_check = /(^[0-9A-F]{6}$)|(^[0-9A-F]{3}$)/i.test(mc_array[i]);
				poscal = poscal + mc_array[i].length +1;
				if (hex_check == false){
					jQuery(e).tooltip({ content: 'Wrong Color Value: <span style="font-weight: bold; color: red;">'+mc_array[i]+'</span><br>Please enter a valid one!', tooltipClass: 'custom-tooltip-styling', position: { my: 'center bottom', at: 'center top-15' } }); 
					jQuery(e).focus(); 
					jQuery(e).setCursorPosition(poscal-1);
					jQuery(e).tooltip({content: function(){
						var element = jQuery( this ); 
						var html_text=element.attr('title'); return html_text;}
					});	
					jQuery(d).append('<span class="multi-colors" style="border-radius: 3px; border: 1px solid #000; font-size: 10px; padding: 0 15px; margin: 0 5px 0 0; line-height: 11px;"><span style="background: #fff; padding: 0 3px;">?</span></span>');
					poscal = 0;
					break;
				}
				else {
					jQuery(d).append('<span class="multi-colors" style="color: #'+mc_array[i]+';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>');
				};
			}
		}
	}
	jQuery.fn.setCursorPosition = function(pos) {
	  this.each(function(index, elem) {
		if (elem.setSelectionRange) {
		  elem.setSelectionRange(pos, pos);
		} else if (elem.createTextRange) {
		  var range = elem.createTextRange();
		  range.collapse(true);
		  range.moveEnd('character', pos);
		  range.moveStart('character', pos);
		  range.select();
		}
	  });
	  return this;
	};
	</script>
<!-- Check for proper entrance to widget's Control Panel -->
<?php if( $check_widget_1 == "" && $check_widget_2!= "" ){
			echo '<p id="warning" style="margin: 10px 5px 5px; font-size: 14px; text-align: justify;">This widget can be customized only through <span style="font-weight: bold;">WP Admin panel > Appearance > Widgets</span> page, where Accessibility mode in <span style="font-weight: bold;">Screen Options</span> (top right corner of the page) has to be enabled.</p>'; 
		} 
		else {if( $check_widget_1 == ""){
				echo '<p id="warning" style="margin: 10px 5px 5px; font-size: 14px; text-align: justify;">Since this plugin uses jQuery Accordion and Tooltip you need to enable accessibility mode in <span style="font-weight: bold;">Screen Options</span> (right top corner of this page) for creating/editing cloud instances.</p>'; 
			}
		}
?>
<!-- CP Template -->
<div id="wihead" style="visibility: hidden;">
	<div style="float: left;">
		<span>WIDGET OPTIONS</span>
	</div>
	<div id="toti" onmouseout="jQuery(this).css({'color':'#dc143c'});" onmouseover="jQuery(this).css({'color':'#b01030'});">
		Tooltips
		<br>
		<input style="margin: 0;" title="Turn on Option Tooltips." class="radio" id="<?=$this->get_field_id('tooltip_status'); ?>"
		name="<?=$this->get_field_name('tooltip_status'); ?>" type="radio" value="on" 
		<?php if( $tooltip_status == "on" ){ echo ' checked="checked"'; } ?> onclick="jQuery('#accordion-1, #wihead').tooltip({content: function() {var element = $( this ); var html_text=element.attr('title'); return html_text;}, position: {  my: 'left top+20',  at: 'left bottom'}}); ">on
		
		<input style="margin: 0;" title="Turn off Option tooltips." class="radio" id="<?=$this->get_field_id('tooltip_status'); ?>"						
		name="<?=$this->get_field_name('tooltip_status'); ?>" type="radio" value="off"
		<?php if( $tooltip_status == "off" ){ echo ' checked="checked"'; } ?> onclick="jQuery('#accordion-1, #wihead').tooltip({position: { my: 'left-300 top', at: 'left bottom',  of: 'body'}});">off
	</div>
	<div class="thin-spacer"></div>
	<label title="Title of the widget instance" for="<?=$this->get_field_id('title'); ?>" style="display: inline-block; float: left;">
		<span style="font-weight: normal;">Title
		<br> 
		<input style="width: 180px; margin: 0 4px 0 0;"
		id="<?=$this->get_field_id('title'); ?>"
		name="<?=$this->get_field_name('title'); ?>" type="text"
		value="<?php echo $title; ?>" />
	</label>
	<label title="Widget's height" for="<?=$this->get_field_id('height'); ?>" style="display: inline-block; float: right;">
		<span style="font-weight: normal;">
		Height
		<br>
		<select id="<?=$this->get_field_id('height'); ?>" name="<?=$this->get_field_name('height'); ?>">
			<?php for($i=90; $i<961; $i++){echo '<option id="ho_' . $i . '" value="' . $i . '"'; if($height==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>				
		</select>px
	</label>
	<label title="Widget's width" for="<?=$this->get_field_id('width'); ?>" style="display: inline-block; float: right; margin: 0 4px 0 0">
		<span style="font-weight: normal;">
		Width
		<br>
		<select id="<?=$this->get_field_id('width'); ?>" name="<?=$this->get_field_name('width'); ?>">
			<?php for($i=90; $i<961; $i++){echo '<option id="wo_' . $i . '" value="' . $i . '"'; if($width==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>		
		</select>px
	</label>
</div>
<div id="accordion-1" style="background: #fff; padding: 2px 0 1px; visibility: hidden; " <?php if( $check_widget_1 == "" ){ echo ' hidden'; } ?>>
	<h3><span class="front-title">cloud:</span> SHAPE, CONTENT, WEIGHT, OUTLINE</h3>
	<div class="section_content" style="padding-bottom: 0;">
		<div title="The shape of the cloud">
			<span>SHAPE</span>
		</div>
		<div class="section_content" style="margin: 0 0 5px; padding: 0 0 5px; border-bottom: 1px solid #aaa;">
			<input title="Sphere" class="radio" id="<?=$this->get_field_id('shape'); ?>"
			name="<?=$this->get_field_name('shape'); ?>" type="radio" value="sphere"   
			<?php if( $shape == "sphere" ){ echo ' checked="checked"'; } ?> onclick="check43d('visible')";>sphere
			
			<input style="margin: 0 2px 0 3px;" title="Cylinder that starts off horizontal" class="radio" id="<?=$this->get_field_id('shape'); ?>"
			name="<?=$this->get_field_name('shape'); ?>" type="radio" value="hcylinder"
			<?php if( $shape == "hcylinder" ){ echo ' checked="checked"'; } ?> onclick="check43d('visible')";>hcylinder
			
			<input style="margin: 0 2px 0 3px;" title="Cylinder that starts off vertical" class="radio" id="<?=$this->get_field_id('shape'); ?>"
			name="<?=$this->get_field_name('shape'); ?>" type="radio" value="vcylinder"
			<?php if( $shape == "vcylinder" ){ echo ' checked="checked"'; } ?> onclick="check43d('visible')";>vcylinder
			
			<input style="margin: 0 2px 0 3px;" title="Horizontal circle" class="radio" id="<?=$this->get_field_id('shape'); ?>"
			name="<?=$this->get_field_name('shape'); ?>" type="radio" value="hring"
			<?php if( $shape == "hring" ){ echo ' checked="checked"'; } ?> onclick="check43d('visible')";>hring
			
			<input style="margin: 0 2px 0 3px;" title="Vertical circle" class="radio" id="<?=$this->get_field_id('shape'); ?>"
			name="<?=$this->get_field_name('shape'); ?>" type="radio" value="vring"
			<?php if( $shape == "vring" ){ echo ' checked="checked"'; } ?> onclick="check43d('visible')";>vring
			<br>
			<div class="thin-spacer" style="margin-bottom: 5px; border-bottom: 1px dotted #aaa;"></div>	
			<input style="margin: 0 2px 0 0;" title="2D Spiral" class="radio" id="<?=$this->get_field_id('shape'); ?>"
			name="<?=$this->get_field_name('shape'); ?>" type="radio" value="spiral"
			<?php if( $shape == "spiral" ){ echo ' checked="checked"'; } ?> onclick="check43d('hidden')";>spiral

			<input style="margin: 0 2px 0 3px;" title="2D Hexagon" class="radio" id="<?=$this->get_field_id('shape'); ?>"
			name="<?=$this->get_field_name('shape'); ?>" type="radio" value="hexagon"
			<?php if( $shape == "hexagon" ){ echo ' checked="checked"'; } ?> onclick="check43d('hidden')";>hexagon
		</div>
		<table>
			<tr>
				<td style="width: 110px; padding: 0; vertical-align: top;">
					<div style="width: 100%;">
						<span>CONTENT</span>
						<div style="padding: 15px 0 0 0;">
							<div class="nishka" style="margin-top: 0;">
								<input  class="radio" style="margin: 4px 1px 4px 0;" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays most recent posts. Font Size weighting is provided for all <span class='green'>Weight Mode</span> options except for <span class='green'>none</span>. As older a post is, as smaller its title font is. Combine with the <span class='green'>Posts' Categories</span> and <span class='green'>Number</span> of Posts options on the right."
								name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="recent_posts"
								<?php if( $taxonomy == "recent_posts" ){ echo ' checked="checked"'; } ?>>Recent Posts
								<span style="font-size: 18px; line-height: 12px; float: right; padding: 3px 0 0 0;">&#8594;</span>
							</div>
							<div class="nishka">								
								<input  class="radio" style="margin: 4px 1px 4px 0;" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays bookmarks found in the WP Admin Panel: <span class='green'>Links</span>. Font Size weighting is provided for all  <span class='green'>Weight Mode</span> options except for <span class='green'>none</span>. Font size of the Links is calculated in accordance with their position in the list: The last in it has the smallest font size. Combine with the <span class='green'>Links' Categories</span> and <span class='green'>Number</span> of Links options on the right."
								name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="links"									
								<?php if( $taxonomy == "links" ){ echo ' checked="checked"'; } ?>>Links
								<span style="font-size: 18px; line-height: 12px; float: right; padding: 3px 0 0 0;">&#8594;</span>
							</div>
							<div class="nishka">									
								<input style="margin: 4px 1px 4px 0;" class="radio" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays a navigation menu created via WP Admin Panel:  <span class='green'>Appearance</span> <span style='font-size: 18px;'>&#8594;</span>  <span class='green'>Menus</span>. <span class='green'>Weight Mode</span> is not applicable to this option. Combine with the <span class='green'>Menu</span> option on the right."
								name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="menu"
								<?php if( $taxonomy == "menu" ){ echo ' checked="checked"'; } ?>>Menu
								<span style="font-size: 18px; line-height: 12px; float: right; padding: 3px 0 0 0;">&#8594;</span>
							</div>
							<div class="nishka" style="border-radius: 0; border-top-right-radius: 50px; border-bottom: 0; margin: 10px 0 0 0;">
								<input style="margin: 4px 1px 4px 0;" class="radio" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays a list of categories created in the WP Admin Panel: <span class='green'>Posts</span> <span style='font-size: 18px;'>&#8594;</span>  <span class='green'>Categories</span>."
								name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="category"
								<?php if( $taxonomy == "category" ){ echo ' checked="checked"'; } ?>>Categories
							</div>
							<div class="nishka" style="border-radius: 0; height: 10px; margin: 0; border: 0; border-right: 1px dotted #aaa;"><span style="font-size: 18px; line-height: 10px; float: right;">&#8594;</span></div>
							<div class="nishka" style="border-radius: 0; border-bottom-right-radius: 50px; border-top: 0; margin: 0 0 10px 0;">
								<input style="margin: 4px 1px 4px 0;" class="radio" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays a list of post tags. Combine with the <span class='green'>Number</span> of Post Tags option on the right."
								name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="post_tag"
								<?php if( $taxonomy == "post_tag" ){ echo ' checked="checked"'; } ?>>Post Tags
							</div>
							<div class="nishka">
							<input style="margin: 4px 1px 4px 0;" class="radio" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays a list of archives. Combine with the <span class='green'>Number</span> of Archives option on the right."
							name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="archives"
							<?php if( $taxonomy == "archives" ){ echo ' checked="checked"'; } ?>>Archives
							<span style="font-size: 18px; line-height: 12px; float: right; padding: 3px 0 0 0;">&#8594;</span>
							</div>
							<div class="nishka">							
							<input style="margin: 4px 1px 4px 0 ;" class="radio" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays a list of pages. <span class='green'>Weight Mode</span> is not applicable to this option."
							name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="pages"
							<?php if( $taxonomy == "pages" ){ echo ' checked="checked"'; } ?>>Pages
							<span style="font-size: 18px; line-height: 12px;  float: right; padding: 3px 0 0 0;">&#8594;</span>								
							</div>							
							<div class="nishka" style="margin-bottom: 5px;">
							<input style="margin: 4px 1px 4px 0;" class="radio" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays a list of authors. Combine with the <span class='green'>Number</span> of Authors and <span class='green'>Exclude</span> options on the right."
							name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="authors"
							<?php if( $taxonomy == "authors" ){ echo ' checked="checked"'; } ?>>Authors
							<span style="font-size: 18px; line-height: 12px;  float: right; padding: 3px 0 0 0;">&#8594;</span>	
							</div>
						</div>
					</div>
				</td >
				<td style="vertical-align: top;">
						<label style="margin: 18px 5px 0 0; line-height: 13px;" title="Post Category to be displayed." for="<?=$this->get_field_id('rp_category_id'); ?>">
							Post Category
							<br>
							<select style="width: auto; max-width: 175px;" id="<?=$this->get_field_id('rp_category_id'); ?>" name="<?=$this->get_field_name('rp_category_id'); ?>">
								<option value="" <?php if( $rp_category_id == ""){ echo ' selected'; } ?>>all</option>
								<?php
									$terms_category = get_terms("category");
									 if ( !empty( $terms_category ) && !is_wp_error( $terms_category ) ){
										 foreach ( $terms_category as $term ) {
											echo "<option value='" . $term->term_id . "'";
											if( $rp_category_id == $term->term_id ) { echo " selected" ; };
											echo ">" . $term->name . "</option>";
										 }
									 }
								?>						
							</select>
						</label>
						<label style="width: 45px; display: block; line-height: 13px; margin: 18px 0 0 0;" title="Number of recent posts to display"for="<?=$this->get_field_id('recent_posts'); ?>">
							Number
							<br>
							<select id="<?=$this->get_field_id('recent_posts'); ?>" name="<?=$this->get_field_name('recent_posts'); ?>">
								<?php for($i=5; $i<26; $i++){echo '<option id="rp_' . $i . '" value="' . $i . '"'; if($recent_posts==$i){echo ' selected';}; echo '>' . $i . '</option>'; }	?>
							</select>
						</label>  									
						<label style="margin: 2px 5px 0 0; line-height: 13px;" title="Links Category to be displayed." for="<?=$this->get_field_id('links_category_id'); ?>">
						Links Category
						<br>
						<select style="width: auto; max-width: 175px;" id="<?=$this->get_field_id('links_category_id'); ?>" name="<?=$this->get_field_name('links_category_id'); ?>">
							<option value="" <?php if( $links_category_id == ""){ echo ' selected'; } ?>>all</option>
							<?php
								$terms_link = get_terms("link_category");
								 if ( !empty( $terms_link ) && !is_wp_error( $terms_link ) ){
									 foreach ( $terms_link as $term ) {
										echo "<option value='" . $term->term_id . "'";
										if( $links_category_id == $term->term_id ) { echo " selected" ; };
										echo ">" . $term->name . "</option>";
									 }
								 }
							?>						
						</select>
						</label>
						<label style="margin: 2px 0 0 0; width: 45px; display: block; line-height: 13px;" title="Number of links to display" for="<?=$this->get_field_id('links'); ?>">
							Number
							<br>
							<select id="<?=$this->get_field_id('links'); ?>" name="<?=$this->get_field_name('links'); ?>">
								<?php 
									for($i=5; $i<100; $i+=5){
										echo '<option id="l_' . $i . '" value="' . $i . '"'; if($inks==$i){echo ' selected';}; echo '>' . $i . '</option>'; 
									} 
									echo '<option id="l_100"'; if($links=='-1'){echo ' selected';}; echo ' value="-1">all</option>';
								?>
							</select>
						</label>  																	
						<label style="margin: 2px 0 0 0; clear: both; width: 175px; line-height: 13px;" title="The menu to be displayed" for="<?=$this->get_field_id('menu'); ?>">
							Menu
							<br>
							<select style="width: auto; max-width: 175px;" id="<?=$this->get_field_id('menu'); ?>" name="<?=$this->get_field_name('menu'); ?>">
							<?php
								$terms_menu = get_terms("nav_menu");
								 if ( !empty( $terms_menu ) && !is_wp_error( $terms_menu ) ){
									 foreach ( $terms_menu as $term ) {
										echo "<option value='" . $term->term_id . "'";
										if( $menu == $term->term_id ) { echo " selected" ; };
										echo ">" . $term->name . "</option>";
									 }
								 }
							?>						
							</select>
						</label>  							
						<br style="clear: both" />
					<label style="margin: 19px 0 0 0; width: 220px; line-height: 13px;" title="Number of tags to display" for="<?=$this->get_field_id('tags'); ?>">
						Number
						<br>
						<select id="<?=$this->get_field_id('tags'); ?>" name="<?=$this->get_field_name('tags'); ?>">
							<?php 
								for($i=10; $i<125; $i+=5){
									echo '<option id="t_' . $i . '" value="' . $i . '"'; if($tags==$i){echo ' selected';}; echo '>' . $i . '</option>'; 
								} 
								echo '<option id="t_125"'; if($tags=='0'){echo ' selected';}; echo ' value="0">all</option>';
							?>
						</select>
					</label> 
					<label style="width: 220px; line-height: 13px; margin: 16px 0 0 0;" title="Number of archives to display" for="<?=$this->get_field_id('archives_limit'); ?>">
						<span style="margin-right: 5px; font-weight: normal;">Number</span>
						<br> 							
						<select id="<?=$this->get_field_id('archives_limit'); ?>" name="<?=$this->get_field_name('archives_limit'); ?>">
						<?php 
							for($i=6; $i<66; $i+=6){
								echo '<option id="arli_' . $i . '" value="' . $i . '"'; if($archives_limit==$i){echo ' selected';}; echo '>' . $i . '</option>'; 
							} 
							echo '<option id="arli_66"'; if($archives_limit==''){echo ' selected';}; echo ' value="">all</option>';
						?>
						</select>
					</label>
					<label style="width: 220px; line-height: 13px; margin: 2px 0 0 0;" title="Number of pages to display" for="<?=$this->get_field_id('pages_limit'); ?>">
						<span style="margin-right: 5px; font-weight: normal;">Number</span>
						<br> 							
						<select id="<?=$this->get_field_id('pages_limit'); ?>" name="<?=$this->get_field_name('pages_limit'); ?>">
						<?php 
							for($i=5; $i<55; $i+=5){
								echo '<option id="pali_' . $i . '" value="' . $i . '"'; if($pages_limit==$i){echo ' selected';}; echo '>' . $i . '</option>'; 
							} 
							echo '<option id="pali_55"'; if($pages_limit==''){echo ' selected';}; echo ' value="">all</option>';
						?>
						</select>
					</label>  	
					<label style="margin: 2px 5px 0 0; width: 45px; line-height: 13px;" title="Number of authors to display" for="<?=$this->get_field_id('authors_limit'); ?>">
						<span style="margin-right: 5px; font-weight: normal;">Number</span> 
						<br> 							
						<select id="<?=$this->get_field_id('authors_limit'); ?>" name="<?=$this->get_field_name('authors_limit'); ?>">
							<?php 
								for($i=5; $i<55; $i+=5){
									echo '<option id="auli_' . $i . '" value="' . $i . '"'; if($authors_limit==$i){echo ' selected';}; echo '>' . $i . '</option>'; 
								} 
								echo '<option id="auli_55"'; if($authors_limit==''){echo ' selected';}; echo ' value="">all</option>';
							?>
						</select>
					</label>  	
					<label style="width: 173px; margin: 2px 0 0 0; line-height: 13px;" title="Exclude one or more authors from the results. Enter a comma-separated list of authors IDs." for="<?=$this->get_field_id('exclude'); ?>">
						Exclude 
						<input style="margin-top: 0; width: 173px;"
						style="padding: 2px" id="<?=$this->get_field_id('exclude'); ?>"
						name="<?=$this->get_field_name('exclude'); ?>" type="text"
						value="<?php echo $exclude; ?>" />
					</label>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="border-bottom: 1px solid #aaa;">
					<div class="thin-spacer"></div>
					<div style="text-align: center;" title="Displays “No tags” instead of an empty canvas when there are no tags available.">
						No Tags Message
						<br>
						<input style="margin: 0 1px 0 0;" class="radio" id="<?=$this->get_field_id('no_tags_msg'); ?>"
						name="<?=$this->get_field_name('no_tags_msg'); ?>" type="radio" value="true"
						<?php if( $no_tags_msg == "true" ){ echo ' checked="checked"'; } ?>>on
						
						<input style="margin: 0 1px 0 0;" class="radio" id="<?=$this->get_field_id('no_tags_msg'); ?>"
						name="<?=$this->get_field_name('no_tags_msg'); ?>" type="radio" value="false"
						<?php if( $no_tags_msg == "false" ){ echo ' checked="checked"'; } ?>>off
					</div>
					<div class="thin-spacer"></div>
				</td>
			</tr>
		</table>	
		<span>WEIGHT</span>
		<br>
		<div style="float: left; margin: 20px 7px 0 0;">
			<input style="margin: 3px 1px 0 0;" title="Switches on tag weighting. Subject to weighting could be all types of Cloud's content except Menu and Pages." class="radio" id="<?=$this->get_field_id('weight'); ?>"
			name="<?=$this->get_field_name('weight'); ?>" type="radio" value="true"
			<?php if( $weight == "true" ){ echo ' checked="checked"'; } ?>>on
			<br>
			<input style="margin: 0 1px 0 0;" title="Switches off tag weighting." class="radio" id="<?=$this->get_field_id('weight'); ?>"
			name="<?=$this->get_field_name('weight'); ?>" type="radio" value="false"
			<?php if( $weight == "false" ){ echo ' checked="checked"'; } ?>>off
		</div>
		<label style="margin: 0 7px 0 0; float: left;" title="Method to use for displaying tag weights" for="<?=$this->get_field_id('weight_mode'); ?>">
			<br>
			Weight Mode
			<br>
			<select id="<?=$this->get_field_id('weight_mode'); ?>" name="<?=$this->get_field_name('weight_mode'); ?>">
				<option value="size" <?php if( $weight_mode == "size" ){ echo ' selected'; } ?>>size</option>
				<option value="color" <?php if( $weight_mode == "color" ){ echo ' selected'; } ?>>color</option>
				<option value="both" <?php if( $weight_mode == "both" ){ echo ' selected'; } ?>>size&color</option>
				<option value="bgcolor" <?php if( $weight_mode == "hring" ){ echo ' selected'; } ?>>bgcolor</option>
				<option value="bgoutline" <?php if( $weight_mode == "bgoutline" ){ echo ' selected'; } ?>>bgoutline</option>
			</select>
		</label>		
		<label style="margin: 0 7px 0 0; float: left;" title="Multiplier for adjusting the size of tags when using a weight mode of <span class='green'>size</span> or <span class='green'>size & color</span>." for="<?=$this->get_field_id('weight_size'); ?>">
			Weight<br>Factor
			<br>
			<select id="<?=$this->get_field_id('weight_size'); ?>" name="<?=$this->get_field_name('weight_size'); ?>">
				<?php for($i=50; $i<505; $i+=5){echo '<option id="ws_' . $i . '" value="' . $i/100 . '"'; if($weight_size==$i/100){echo ' selected';}; echo '>' . $i/100 . '</option>'; } ?>		
			</select>
		</label>
		<label style="margin: 0 7px 0 0; float: left;" title="Minimal font size when weighted sizing is enabled." for="<?=$this->get_field_id('weight_size_min'); ?>">
			Weight<br>Size Min
			<br>
			<select id="<?=$this->get_field_id('weight_size_min'); ?>" name="<?=$this->get_field_name('weight_size_min'); ?>">
				<?php for($i=6; $i<17; $i++){echo '<option id="wsmi_' . $i . '" value="' . $i . '"'; if($weight_size_min==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>					
			</select>px
		</label>		
		<label title="Maximal font size when weighted sizing is enabled." for="<?=$this->get_field_id('weight_size_max'); ?>">
			Weight<br>Size Max
			<br>
			<select id="<?=$this->get_field_id('weight_size_max'); ?>" name="<?=$this->get_field_name('weight_size_max'); ?>">
				<?php for($i=18; $i<33; $i++){echo '<option id="wsm_' . $i . '" value="' . $i . '"'; if($weight_size_max==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>								
			</select>px
		</label>
		<div class="thin-spacer"></div>				
		<div style="float: left;" title="This is the link attribute to take the tag weight from. Create your links with <span class='green'>data-weight</span> to embed custom data. If this option is <span class='green'>off</span> the weight will be taken from the calculated link font size.">
			Weight from 'data-weight' attribute
			<br>
			<input style="margin: 0 1px 0 0;" class="radio" id="<?=$this->get_field_id('weight_from'); ?>"
			name="<?=$this->get_field_name('weight_from'); ?>" type="radio" value="data-weight"
			<?php if( $weight_from == "data-weight" ){ echo ' checked="checked"'; } ?>>on
			
			<input style="margin: 0 1px 0 0;" class="radio" id="<?=$this->get_field_id('weight_from'); ?>"
			name="<?=$this->get_field_name('weight_from'); ?>" type="radio" value=""
			<?php if( $weight_from == "" ){ echo ' checked="checked"'; } ?>>off
		</div>	
		<div class="divider"></div>	
		<div style="float: left; margin: 0; height: 40px;" title="Type of highlight to use">
			<span>OUTLINE METHOD</span>
			<br>
			<div class="thin-spacer"></div>
			<input title="An outline at the same depth as the active tag" class="radio" id="<?=$this->get_field_id('outline_method'); ?>"
			name="<?=$this->get_field_name('outline_method'); ?>" type="radio" value="outline"
			<?php if( $outline_method == "outline" ){ echo ' checked="checked"'; } ?>>outline							
				
			<input title="Old-style outline on top of all tags" class="radio" id="<?=$this->get_field_id('outline_method'); ?>"
			name="<?=$this->get_field_name('outline_method'); ?>" type="radio" value="classic"
			<?php if( $outline_method == "classic" ){ echo ' checked="checked"'; } ?>>classic
				
			<input title="Solid block of color around the active tag" class="radio" id="<?=$this->get_field_id('outline_method'); ?>"
			name="<?=$this->get_field_name('outline_method'); ?>" type="radio" value="block"
			<?php if( $outline_method == "block" ){ echo ' checked="checked"'; } ?>>block
				
			<input title="Changes the color of the text or image of the current tag to the <span class='green'>outlineColour</span> value." class="radio" id="<?=$this->get_field_id('outline_method'); ?>"
			name="<?=$this->get_field_name('outline_method'); ?>" type="radio" value="colour"
			<?php if( $outline_method == "colour" ){ echo ' checked="checked"'; } ?>>color
				
			<input title="Increases the size of the tag, using the <span class='green'>outlineIncrease</span> option for the amount." class="radio" id="<?=$this->get_field_id('outline_method'); ?>"
			name="<?=$this->get_field_name('outline_method'); ?>" type="radio" value="size"	
			<?php if( $outline_method == "size" ){ echo ' checked="checked"'; } ?>>size
			
			<input title="Increases the size of the tag, using the <span class='green'>outlineIncrease</span> option for the amount." class="radio" id="<?=$this->get_field_id('outline_method'); ?>"
			name="<?=$this->get_field_name('outline_method'); ?>" type="radio" value="none"	
			<?php if( $outline_method == "none" ){ echo ' checked="checked"'; } ?>>none
		</div>
	</div>
	<h3><span class="front-title">cloud:</span> SIZES & ZOOM</h3>
	<div class="section_content">
		<span>SIZES</span>
		<br>
		<div class="thin-spacer"></div>
		<label style="width: 90px;" title="Initial size of cloud from center to sides." for="<?=$this->get_field_id('radius_x'); ?>">
			Radius X 
			<br>
			<select id="<?=$this->get_field_id('radius_x'); ?>" name="<?=$this->get_field_name('radius_x'); ?>">
				<?php for($i=0; $i<1005; $i+=5){echo '<option id="rx_' . $i . '" value="' . $i/100 . '"'; if($radius_x==$i/100){echo ' selected';}; echo '>' . $i/100 . '</option>'; } ?>
			</select>
		</label>				
		<label style="width: 90px;" title="Initial size of cloud from center to top and bottom." for="<?=$this->get_field_id('radius_y'); ?>">
			Radius Y 
			<br>
			<select id="<?=$this->get_field_id('radius_y'); ?>" name="<?=$this->get_field_name('radius_y'); ?>">
				<?php for($i=0; $i<1005; $i+=5){echo '<option id="ry_' . $i . '" value="' . $i/100 . '"'; if($radius_y==$i/100){echo ' selected';}; echo '>' . $i/100 . '</option>'; } ?>
			</select>
		</label>				
		<div style="width: 90px; float: left;<?php if($shape == 'spiral'||$shape == 'hexagon') {echo ' visibility: hidden;';}; ?>" title="Initial size of cloud from center to front and back." id="cont_<?=$this->get_field_id('radius_z'); ?>" <?php if($shape == 'spiral'||$shape == 'hexagon') {echo '; visibility: hidden;';}; ?>>
			Radius Z 
			<br>
			<select id="<?=$this->get_field_id('radius_z'); ?>" name="<?=$this->get_field_name('radius_z'); ?>">
				<?php for($i=0; $i<1005; $i+=5){echo '<option id="rz_' . $i . '" value="' . $i/100 . '"'; if($radius_z==$i/100){echo ' selected';}; echo '>' . $i/100 . '</option>'; } ?>
			</select>
		</div> 
		<label title="Controls the perspective." style="width: 58px;" for="<?=$this->get_field_id('depth'); ?>">
			Depth 
			<br>
			<select id="<?=$this->get_field_id('depth'); ?>" name="<?=$this->get_field_name('depth'); ?>">
				<option id="dep_0" value="0.001" <?php if($depth==0.001){echo ' selected';} ?>>0</option>
				<?php for($i=5; $i<105; $i+=5){echo '<option id="dep_' . $i . '" value="' . $i/100 . '"'; if($depth==$i/100){echo ' selected';}; echo '>' . $i/100 . '</option>'; } ?>
			</select>
		</label>
		<div class="thin-spacer"></div>
		<label style="width: 90px;" title="Offsets the centre of the cloud horizontally." for="<?=$this->get_field_id('offset_x'); ?>">
			Offset X 
			<br>
			<select id="<?=$this->get_field_id('offset_x'); ?>" name="<?=$this->get_field_name('offset_x'); ?>">
				<?php for($i=-50; $i<51; $i++){echo '<option id="ofx_' . $i . '" value="' . $i . '"'; if($offset_x==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>
			</select>px
		</label>
		<label style="width: 90px;" title="Offsets the centre of the cloud vertically." for="<?=$this->get_field_id('offset_y'); ?>">
			Offset Y
			<br>
			<select id="<?=$this->get_field_id('offset_y'); ?>" name="<?=$this->get_field_name('offset_y'); ?>">
				<?php for($i=-50; $i<51; $i++){echo '<option id="ofy_' . $i . '" value="' . $i . '"'; if($offset_y==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>
			</select>px
		</label>
		<label style="width: 90px;" title="Stretch or compress the cloud horizontally." for="<?=$this->get_field_id('stretch_x'); ?>">
			Stretch X
			<br>
			<select id="<?=$this->get_field_id('stretch_x'); ?>" name="<?=$this->get_field_name('stretch_x'); ?>">
				<?php for($i=5; $i<21; $i++){echo '<option id="sx_' . $i . '" value="' . $i/10 . '"'; if($stretch_x==$i/10){echo ' selected';}; echo '>' . $i/10 . '</option>'; } ?>
			</select>
		</label>
		<label style="width: 58px;" title="Stretch or compress the cloud vertically." for="<?=$this->get_field_id('stretch_y'); ?>">
			Stretch Y 
			<br>
			<select id="<?=$this->get_field_id('stretch_y'); ?>" name="<?=$this->get_field_name('stretch_y'); ?>">
				<?php for($i=5; $i<21; $i++){echo '<option id="sy_' . $i . '" value="' . $i/10 . '"'; if($stretch_y==$i/10){echo ' selected';}; echo '>' . $i/10 . '</option>'; } ?>
			</select>
		</label> 
		<div style="font-weight: bold; padding: 5px 0 0 0; margin: 5px 0 0 0; border-top: 1px solid #aaa; width: 100%; display: inline-block;">ZOOM</div>
		<div style="float: left; margin: 5px 11px 0 0;" title="Enables zooming the cloud in and out using the mouse wheel or scroll gesture">
			<div>
				Wheel Zoom
			</div>
			<div  style="float: left;">
				<input class="radio" id="<?=$this->get_field_id('wheel_zoom'); ?>"
				name="<?=$this->get_field_name('wheel_zoom'); ?>" type="radio" value="true"
				<?php if( $wheel_zoom == "true" ){ echo ' checked="checked"'; } ?>>on
				<input class="radio" id="<?=$this->get_field_id('wheel_zoom'); ?>"
				name="<?=$this->get_field_name('wheel_zoom'); ?>" type="radio" value="false"
				<?php if( $wheel_zoom == "false" ){ echo ' checked="checked"'; } ?>>off
			</div>
		</div>
		<label title="Minimal zoom value" style="margin: 5px 7px 0 0;" for="<?=$this->get_field_id('zoom_min'); ?>">
			Zoom Min
			<br>
			<select id="<?=$this->get_field_id('zoom_min'); ?>" name="<?=$this->get_field_name('zoom_min'); ?>">
				<?php for($i=3; $i<11; $i++){echo '<option id="zomi_' . $i . '" value="' . $i/10 . '"'; if($zoom_min==$i/10){echo ' selected';}; echo '>' . $i/10 . '</option>'; } ?>
			</select>
		</label>  
		<label title="Maximal zoom value" style="margin: 5px 7px 0 0;" for="<?=$this->get_field_id('zoom_max'); ?>">
			Zoom Max
			<br>
			<select id="<?=$this->get_field_id('zoom_max'); ?>" name="<?=$this->get_field_name('zoom_max'); ?>">
				<?php for($i=20; $i<41; $i++){echo '<option id="zoma_' . $i . '" value="' . $i/10 . '"'; if($zoom_max==$i/10){echo ' selected';}; echo '>' . $i/10 . '</option>'; } ?>
			</select>
		</label>
		<label style="margin: 5px 7px 0 0;" title="The amount that the zoom is changed by with each movement of the mouse wheel." for="<?=$this->get_field_id('zoom_step'); ?>">
			Zoom Step
			<br>
			<select id="<?=$this->get_field_id('zoom_step'); ?>" name="<?=$this->get_field_name('zoom_step'); ?>">
				<?php for($i=1; $i<11; $i++){echo '<option id="zos_' . $i . '" value="' . $i/100 . '"'; if($zoom_step==$i/100){echo ' selected';}; echo '>' . $i/100 . '</option>'; } ?>
			</select>
		</label>
		<label style="margin: 5px 0 0;" title="Adjusts the relative size of the tag cloud in the canvas. Larger values will zoom into the cloud, smaller values will zoom out." for="<?=$this->get_field_id('zoom'); ?>">
			Zoom
			<br>
			<select id="<?=$this->get_field_id('zoom'); ?>" name="<?=$this->get_field_name('zoom'); ?>">
				<?php for($i=10; $i<755; $i+=5){echo '<option id="zo_' . $i . '" value="' . $i/100 . '"'; if($zoom==$i/100){echo ' selected';}; echo '>' . $i/100 . '</option>'; } ?>
			</select>
		</label>

	</div>
	<h3><span class="front-title">cloud:</span> SPEED & OPACITY</h3>
	<div class="section_content" style="padding: 0 2px 5px;">
		<div style="width: 128px; float: left;" title="Starting rotation speed, with horizontal and vertical values as an array, e.g. <span class='green'>[0.5,-0.3]</span>. Values are multiplied by <span class='green'>maxSpeed</span>.">
			<div style="font-weight: bold; padding: 5px 0 0;">SPEED</div>
			<div class="thin-spacer"></div>
			<div style="float: left; padding: 0 1px 1px 1px; border: 1px dotted #aaa; border-radius: 5px;">
				Initial Speed [x, y]
				<br>
				<select id="<?=$this->get_field_id('initial_x'); ?>" name="<?=$this->get_field_name('initial_x'); ?>">		
					<?php for($i=-100; $i<101; $i++){echo '<option id="inx_' . $i . '" value="' . $i/100 . '"'; if($initial_x==$i/100){echo ' selected';}; echo '>' . $i/100 . '</option>'; } ?>							
				</select><select id="<?=$this->get_field_id('initial_y'); ?>" name="<?=$this->get_field_name('initial_y'); ?>">	
					<?php for($i=-100; $i<101; $i++){echo '<option id="iny_' . $i . '" value="' . $i/100 . '"'; if($initial_y==$i/100){echo ' selected';}; echo '>' . $i/100 . '</option>'; } ?>							
				</select>
			</div>
		</div>
		<label style="width: 68px; padding: 25px 0 0;" title="Minimal speed of rotation when mouse leaves canvas." for="<?=$this->get_field_id('min_speed'); ?>">
			Min Speed
			<br>
			<select id="<?=$this->get_field_id('min_speed'); ?>" name="<?=$this->get_field_name('min_speed'); ?>">
				<?php for($i=0; $i<55; $i+=5){echo '<option id="mis_' . $i . '" value="' . $i/1000 . '"'; if($min_speed==$i/1000){echo ' selected';}; echo '>' . $i/1000 . '</option>'; } ?>
			</select>
		</label>	
		<label style="width: 68px; padding: 25px 0 0;" title="Maximum speed of rotation: This setting is just a multiplier of speed." for="<?=$this->get_field_id('max_speed'); ?>">
			Max Speed
			<br>
			<select id="<?=$this->get_field_id('max_speed'); ?>" name="<?=$this->get_field_name('max_speed'); ?>">
				<?php for($i=5; $i<105; $i+=5){echo '<option id="mas_' . $i . '" value="' . $i/1000 . '"'; if($max_speed==$i/1000){echo ' selected';}; echo '>' . $i/1000 . '</option>'; } ?>
			</select>
		</label>
		<label style="padding: 25px 0 0;" title="Deceleration rate when mouse leaves canvas" for="<?=$this->get_field_id('deceleration'); ?>">
			Deceleration
			<br>
			<select id="<?=$this->get_field_id('deceleration'); ?>" name="<?=$this->get_field_name('deceleration'); ?>">
				<?php for($i=75; $i<100; $i++){echo '<option id="de_' . $i . '" value="' . $i/100 . '"'; if($deceleration==$i/100){echo ' selected';}; echo '>' . $i/100 . '</option>'; } ?>
			</select>
		</label>
		<div class="divider"></div>
		<span style="float: left;">OPACITY</span>
		<div class="thin-spacer"></div>
		<label style="width: 80px;" title="Minimal opacity of tags at back of cloud." for="<?=$this->get_field_id('min_brightness'); ?>">
			Min Opacity
			<br>
			<select id="<?=$this->get_field_id('min_brightness'); ?>" name="<?=$this->get_field_name('min_brightness'); ?>">
				<?php for($i=0; $i<105; $i+=5){echo '<option id="mib_' . $i . '" value="' . $i/100 . '"'; if($min_brightness==$i/100){echo ' selected';}; echo '>' . $i/100 . '</option>'; } ?>					
			</select>
		</label> 
		<label title="Maximal opacity of tags at front of cloud." for="<?=$this->get_field_id('max_brightness'); ?>">
			Max Opacity
			<br>
			<select id="<?=$this->get_field_id('max_brightness'); ?>" name="<?=$this->get_field_name('max_brightness'); ?>">
				<?php for($i=0; $i<105; $i+=5){echo '<option id="mab_' . $i . '" value="' . $i/100 . '"'; if($max_brightness==$i/100){echo ' selected';}; echo '>' . $i/100 . '</option>'; } ?>					
			</select>
		</label>
	</div>
	<h3><span class="front-title">cloud:</span> TIME & FUNCTIONS</h3>
	<div class="section_content">
		<div style="display: inline-block; padding-bottom: 2px;">
			<span>TIME</span>
			<br>
			<div class="thin-spacer"></div>
			<label title="Time to fade in tags at start" style="margin: 0 141px 0 0;" for="<?=$this->get_field_id('fadein'); ?>">
				FadeIn Time
				<br>
				<select id="<?=$this->get_field_id('fadein'); ?>" name="<?=$this->get_field_name('fadein'); ?>">
						<?php for($i=0; $i<7500; $i+=500){echo '<option id="fi_' . $i . '" value="' . $i . '"'; if($fadein==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>
				</select>msec
			</label>	
			<label title="Interval between animation frames" for="<?=$this->get_field_id('interval'); ?>">
				Frame Interval
				<br>
				<select id="<?=$this->get_field_id('interval'); ?>" name="<?=$this->get_field_name('interval'); ?>">
					<?php for($i=10; $i<35; $i+=5){echo '<option id="int_' . $i . '" value="' . $i . '"'; if($interval==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>
				</select>msec
			</label>
			<div class="thin-spacer"></div>
			<label style="margin: 1px 122px 0 0;" title="If set to a number, the selected tag will move to the front in this many milliseconds before activating." for="<?=$this->get_field_id('click_to_front'); ?>">
				Click to Front Time
				<br>
				<select id="<?=$this->get_field_id('click_to_front'); ?>" name="<?=$this->get_field_name('click_to_front'); ?>">
					<option id="ctf_0" value="null" <?php if( $click_to_front == "null" ){ echo ' selected'; } ?>>off</option>
					<?php for($i=500; $i<2500; $i+=500){echo '<option id="ctf_' . $i . '" value="' . $i . '"'; if($click_to_front==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>
				</select>msec
			</label>
			<div style="margin: -3px 0 0 0; padding: 2px 0 0 4px; border: 1px dotted #bbb; border-radius: 10px; display: inline-block; height: 85px; ">
				<label title="Pulse rate (in seconds per beat): Combine with <span class='green'>Pulsate to Opacity</span> option below." for="<?=$this->get_field_id('pulsate_time'); ?>">
					Pulsate Time
					<br>
					<select id="<?=$this->get_field_id('pulsate_time'); ?>" name="<?=$this->get_field_name('pulsate_time'); ?>">
						<?php for($i=0; $i<6; $i++){echo '<option id="put_' . $i . '" value="' . $i . '"'; if($pulsate_time==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>
					</select>sec/beat
					<br>
					<span style="font-size: 18px; line-height: 10px; padding: 0 0 0 18px;">&#8595;</span>
				</label>
				<br>
				<label style="width: 101px; margin: 0 0 -36px 0;" title="Pulsate outline to this opacity. Combine with <span class='green'>Pulsate Time</span> option above. Set to 1 for no pulsation." for="<?=$this->get_field_id('pulsate_to'); ?>">
					Pulsate to Opacity
					<br>
					<select id="<?=$this->get_field_id('pulsate_to'); ?>" name="<?=$this->get_field_name('pulsate_to'); ?>">
						<?php for($i=0; $i<11; $i++){echo '<option id="pus_' . $i . '" value="' . $i/10 . '"'; if($pulsate_to==$i/10){echo ' selected';}; echo '>' . $i/10 . '</option>'; } ?>
					</select>
				</label>
			</div>
		</div>
		<div style="margin: -51px 1px 0; background: #ddd; border-top: 1px solid #bbb;";>	
			<div style="font-weight: bold; padding-top: 5px;">FUNCTIONS</div>
			<br>
			<div class="thick-spacer"></div>
			<div class="thick-spacer"></div>
			<div style="margin: 0 20px 0 0; float: left;">
				<br>
				Reverse
				<div title="Set to <span class='green'>on</span> to reverse direction of movement relative to mouse position.">
					<input class="radio" id="<?=$this->get_field_id('reverse'); ?>"
					name="<?=$this->get_field_name('reverse'); ?>" type="radio" value="true"
					<?php if( $reverse == "true" ){ echo ' checked="checked"'; } ?>>on
					<br>
					<input class="radio" id="<?=$this->get_field_id('reverse'); ?>"
					name="<?=$this->get_field_name('reverse'); ?>" type="radio" value="false"
					<?php if( $reverse == "false" ){ echo ' checked="checked"'; } ?>>off
				</div> 
			</div>
			<div style="margin: 0 20px 0 0; float: left;">
				Front<br>Select
				<div title="Set to <span class='green'>on</span> to prevent selection of tags at back of cloud.">
					<input class="radio" id="<?=$this->get_field_id('front_select'); ?>"
					name="<?=$this->get_field_name('front_select'); ?>" type="radio" value="true"
					<?php if( $front_select == "true" ){ echo ' checked="checked"'; } ?>>on 
					<br>
					<input class="radio" id="<?=$this->get_field_id('front_select'); ?>"
					name="<?=$this->get_field_name('front_select'); ?>" type="radio" value="false"
					<?php if( $front_select == "false" ){ echo ' checked="checked"'; } ?>>off
				</div>
			</div>
			<div style="float: left; margin: 0 20px 0 0;">
				Freeze<br>Active
				<div title="Set to <span class='green'>on</span> to pause movement when a tag is highlighted. For using this function <span class='green'>Drag Control</span> must be <span class='green'>off</span>.">
					<input class="radio" id="<?=$this->get_field_id('freeze_active'); ?>"
					name="<?=$this->get_field_name('freeze_active'); ?>" type="radio" value="true"
					<?php if( $freeze_active == "true" ){ echo ' checked="checked"'; } ?>>on 
					<br>
					<input class="radio" id="<?=$this->get_field_id('freeze_active'); ?>"
					name="<?=$this->get_field_name('freeze_active'); ?>" type="radio" value="false"
					<?php if( $freeze_active == "false" ){ echo ' checked="checked"'; } ?>>off
				</div>
			</div>	
			<div style="margin: 1px 20px 0 0; float: left;">
				Freeze<br>Deceleration
				<div title="Set to <span class='green'>on</span> to decelerate when highlighted tags freeze instead of stopping suddenly. This function depends on <span class='green'>Deceleration</span> and <span class='green'>Minimal Speed</span>. Set small values for both and choose <span class='green'>none</span> for <span class='green'>Lock Rotation</span>.">
					<input class="radio" id="<?=$this->get_field_id('freeze_decel'); ?>"
					name="<?=$this->get_field_name('freeze_decel'); ?>" type="radio" value="true"
					<?php if( $freeze_decel == "true" ){ echo ' checked="checked"'; } ?>>on 
					<br>
					<input class="radio" id="<?=$this->get_field_id('freeze_decel'); ?>"
					name="<?=$this->get_field_name('freeze_decel'); ?>" type="radio" value="false"
					<?php if( $freeze_decel == "false" ){ echo ' checked="checked"'; } ?>>off						
				</div>
			</div>
			<label for="<?=$this->get_field_id('lock'); ?>" title="Limits rotation of the cloud using the mouse:<br><span class='green'>x-axis</span> - limits rotation to the x-axis;<br><span class='green'>y-axis</span> - limits rotation to the y-axis;<br><span class='green'>both</span> - prevents the cloud rotating in response to the mouse - the cloud will only move if the <span class='green'>initial</span> option is used to give it a starting speed;<br><span class='green'>none</span> - leaves the cloud unlocked.">
				Lock
				<br>
				Rotation
				<br>
				<select id="<?=$this->get_field_id('lock'); ?>" name="<?=$this->get_field_name('lock'); ?>">
					<option value="x" <?php if( $lock == "x" ){ echo ' selected'; } ?>>x-axis</option>
					<option value="y" <?php if( $lock == "y" ){ echo ' selected'; } ?>>y-axis</option>
					<option value="xy" <?php if( $lock == "xy" ){ echo ' selected'; } ?>>both</option>
					<option value="none" <?php if( $lock == "none" ){ echo ' selected'; } ?>>none</option>
				</select>
			</label>
			<div class="thick-spacer"></div>
			<div style="border: 1px dotted #aaa; border-radius: 10px; display: block; float: left; padding: 2px 0 2px 2px; margin: 0 15px 0 0;">	
				<div style="float: left;">
					Drag<br>Control
					<div title="When enabled, cloud moves when dragged instead of based on mouse position. Combine with the  <span class='green'>Drag Threshold</span> option on the right."">
						<input class="radio" id="<?=$this->get_field_id('drag_ctrl'); ?>"
						name="<?=$this->get_field_name('drag_ctrl'); ?>" type="radio" value="true"
						<?php if( $drag_ctrl == "true" ){ echo ' checked="checked"'; } ?>>on
						<br>
						<input class="radio" id="<?=$this->get_field_id('drag_ctrl'); ?>"
						name="<?=$this->get_field_name('drag_ctrl'); ?>" type="radio" value="false"
						<?php if( $drag_ctrl == "false" ){ echo ' checked="checked"'; } ?>>off
					</div>
				</div>
				<span style="margin: 28px 0 0 0; float: left; font-size: 18px;">&#8594;</span>
				<label style="width: 58px;" title="The number of pixels that the cursor must move to count as a drag instead of a click. Combine with the  <span class='green'>Drag Control</span> option on the left." for="<?=$this->get_field_id('drag_threshold'); ?>">
					Drag<br>Threshold
					<br>
					<select id="<?=$this->get_field_id('drag_threshold'); ?>" name="<?=$this->get_field_name('drag_threshold'); ?>">	
						<option value="3" <?php if( $drag_threshold == "3" ){ echo ' selected'; } ?>>3</option>
						<option value="4" <?php if( $drag_threshold == "4" ){ echo ' selected'; } ?>>4</option>
						<option value="5" <?php if( $drag_threshold == "5" ){ echo ' selected'; } ?>>5</option>
					</select>px
				</label>
			</div>					
			<div style="border: 1px dotted #aaa; border-radius: 10px; display: block; float: left; padding: 2px;">
				<div style="float: left;">
					Text<br>Optimisation
					<div title="Text optimisation, converts text tags to images for better performance. Combine with the  <span class='green'>Text Scale</span> option on the right.">
						<input class="radio" id="<?=$this->get_field_id('text_optimisation'); ?>"
						name="<?=$this->get_field_name('text_optimisation'); ?>" type="radio" value="true"
						<?php if( $text_optimisation == "true" ){ echo ' checked="checked"'; } ?>>on 
						<br>
						<input class="radio" id="<?=$this->get_field_id('text_optimisation'); ?>"
						name="<?=$this->get_field_name('text_optimisation'); ?>" type="radio" value="false"
						<?php if( $text_optimisation == "false" ){ echo ' checked="checked"'; } ?>>off
					</div>
				</div>
				<span style="margin: 28px 0 0 0; float: left; font-size: 18px;">&#8594;</span>
				<div style="float: left;">
					<label title="Scaling factor of text when converting to image in <span class='green'>txtOpt</span> mode. Combine with the  <span class='green'>Text Optimisation</span> option on the left." for="<?=$this->get_field_id('text_scale'); ?>">
						Text<br>Scale
						<br>
						<select id="<?=$this->get_field_id('text_scale'); ?>" name="<?=$this->get_field_name('text_scale'); ?>">	
							<?php for($i=1; $i<3.5; $i+=0.5){echo '<option id="txts_' . $i . '" value="' . $i . '"'; if($text_scale==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>
						</select>
					</label>
				</div>
			</div>	
			<div class="thick-spacer"></div>
			<div style="float: left; height: 48px;">
				<div style="float: left; width: 55px;" title="Set to <span class='green'>on</span> to prevent selection of tags.">
					No Select
					<div style="float: left;">
						<input class="radio" id="<?=$this->get_field_id('no_select'); ?>"
						name="<?=$this->get_field_name('no_select'); ?>" type="radio" value="true"
						<?php if( $no_select == "true" ){ echo ' checked="checked"'; } ?>>on 
						<br>
						<input class="radio" id="<?=$this->get_field_id('no_select'); ?>"
						name="<?=$this->get_field_name('no_select'); ?>" type="radio" value="false"
						<?php if( $no_select == "false" ){ echo ' checked="checked"'; } ?>>off 
					</div>
				</div>  	
				<div style="float: left; margin: 0 20px;" title="Set to <span class='green'>on</span> to prevent any mouse interaction. The <span class='green'>Initial Speed</span> option must be used to animate the cloud, otherwise it will be motionless.">
					No Mouse
					<br>
					<input class="radio" id="<?=$this->get_field_id('no_mouse'); ?>"
					name="<?=$this->get_field_name('no_mouse'); ?>" type="radio" value="true"
					<?php if( $no_mouse == "true" ){ echo ' checked="checked"'; } ?>>on 
					<br>
					<input class="radio" id="<?=$this->get_field_id('no_mouse'); ?>"
					name="<?=$this->get_field_name('no_mouse'); ?>" type="radio" value="false"
					<?php if( $no_mouse == "false" ){ echo ' checked="checked"'; } ?>>off
				</div>	
				<div style="float: left;" title="Set to <span class='green'>on</span> to randomize the order of the tags.">
					<div>
						Shuffle Tags
					</div>
					<div  style="float: left;">
						<input class="radio" id="<?=$this->get_field_id('shuffle_tags'); ?>"
						name="<?=$this->get_field_name('shuffle_tags'); ?>" type="radio" value="true"
						<?php if( $shuffle_tags == "true" ){ echo ' checked="checked"'; } ?>>on 
						<br>
						<input class="radio" id="<?=$this->get_field_id('shuffle_tags'); ?>"
						name="<?=$this->get_field_name('shuffle_tags'); ?>" type="radio" value="false"
						<?php if( $shuffle_tags == "false" ){ echo ' checked="checked"'; } ?>>off
					</div>
				</div>			
				<div style="float: left; margin: 0 0 0 20px;" title="Set to <span class='green'>on</span> to automatically hide the list of cloud elements if TagCanvas is started successfully.">
					Hide List
					<div>
						<input class="radio" id="<?=$this->get_field_id('hide_tags'); ?>"
						name="<?=$this->get_field_name('hide_tags'); ?>" type="radio" value="true"
						<?php if( $hide_tags == "true" ){ echo ' checked="checked"'; } ?>>on 
						<br>
						<input class="radio" id="<?=$this->get_field_id('hide_tags'); ?>"
						name="<?=$this->get_field_name('hide_tags'); ?>" type="radio" value="false"
						<?php if( $hide_tags == "false" ){ echo ' checked="checked"'; } ?>>off
					</div>
				</div>
	<!-- Not Applicable option in WP Plugin -->
				<span style="display: none;">
					<div style="width: 110px; float: left; margin-top: 10px;">
						Animation Timing
						<div title="The animation timing function for use with the <span class='green'>RotateTag</span> and <span class='green'>TagToFront</span> functions.">
							<input style="width: 45px" class="radio" id="<?=$this->get_field_id('animation_timing'); ?>"
							name="<?=$this->get_field_name('animation_timing'); ?>" type="radio" value="Smooth" 
							<?php if( $animation_timing == "Smooth" ){ echo ' checked="checked"'; } ?>>Smooth
							
							<input class="radio" id="<?=$this->get_field_id('animation_timing'); ?>"
							name="<?=$this->get_field_name('animation_timing'); ?>" type="radio" value="Linear"
							<?php if( $animation_timing == "Linear" ){ echo ' checked="checked"'; } ?>>Linear
						</div>
					</div>
				</span>
			</div>
<!-- ********************************** --> 
		</div>	
	</div>
	<h3 style="padding-right: 0;"><span class="front-title">attributes:</span> BG IMG, TOOLTIPS, CURSOR, CENTER FN</h3>
	<div class="section_content">
		<label style="float: left; width: 100%; padding: 0 0 5px 0 ; border-bottom: 1px solid #aaa; margin: 0 0 5px 0;" title="URL of an image to be used for Cloud Background. Consider Widget's <span class='green'>Width</span> and <span class='green'>Height</span>." for="<?=$this->get_field_id('bg_img_url'); ?>">
			<span>BACKGROUND IMAGE</span> 
			<input style="width: 100%;"
			id="<?=$this->get_field_id('bg_img_url'); ?>"
			name="<?=$this->get_field_name('bg_img_url'); ?>" type="text"
			value="<?php echo $bg_img_url; ?>" /> 
		</label>
		<span>TOOLTIPS</span>
		<br>
		The plugin uses title attribute of your tags & canvas for tooltips.
		<div class="thin-spacer"></div>
		<label style="margin: 0 30px 5px 0;" for="<?=$this->get_field_id('tooltip'); ?>" title="<br><span class='green'>none</span> - for no tooltips;<br><span class='green'>native</span> - for operating system tooltips;<br><span class='green'>div</span> - for div-based.">
			Display Method
			<br>
			<select id="<?=$this->get_field_id('tooltip'); ?>" name="<?=$this->get_field_name('tooltip'); ?>">
				<option value="" <?php if( $tooltip == "" ){ echo ' selected'; } ?>>none</option>
				<option value="native" <?php if( $tooltip == "native" ){ echo ' selected'; } ?>>native</option>
				<option value="div" <?php if( $tooltip == "div" ){ echo ' selected'; } ?>>div</option>
			</select>
		</label>
		<div style="float: left; margin: 0 30px 5px 0;">
			<label title="Class of tooltip div" for="<?=$this->get_field_id('tooltip_class'); ?>">
				Tooltip Class 
				<div>
					<input style="width: 86px;" id="<?=$this->get_field_id('tooltip_class'); ?>"
					name="<?=$this->get_field_name('tooltip_class'); ?>" type="text"
					value="<?php echo $tooltip_class; ?>" />
				</div> 
			</label>
		</div>
		<div style="float: left; margin: 0 0 5px 0;">
			<label title="Time to pause while mouse is not moving before displaying tooltip. Refers to <span class='green'>div</span> type tooltip." for="<?=$this->get_field_id('tooltip_delay'); ?>">
				Tooltip Delay 
			<br>
			<select id="<?=$this->get_field_id('tooltip_delay'); ?>" name="<?=$this->get_field_name('tooltip_delay'); ?>">
				<?php for($i=0; $i<350; $i+=50){echo '<option id="ttd_' . $i . '" value="' . $i . '"'; if($tooltip_delay==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>
			</select>msec
			</label>
		</div>
		<label style="width: 100%; margin: 0 0 5px;" for="<?=$this->get_field_id('canvas_tooltip'); ?>" title="Sets your canvas tooltip. For instance if the cloud allows <span class='green'>Drag Control</span> you can suggest your site visitors to 'Drag or Click'. It is advisable to set it only if your tags have no title attribute. This is to avoid a mess of pop-up tooltips over your cloud. In other words do not use it when content is <span class='green'>Categories</span> or <span class='green'>Post Tags</span>.">
			Text for canvas tooltip
			<div>
				<input style="width: 100%;" id="<?=$this->get_field_id('canvas_tooltip'); ?>"
				name="<?=$this->get_field_name('canvas_tooltip'); ?>" type="text"
				value="<?php echo $canvas_tooltip; ?>" />
			</div> 
		</label>
		<div style="border-top: 1px solid #aaa; font-weight: bold; display: inline-block; width: 100%; padding: 5px 0 0 0;" title="The CSS cursor type to use when the mouse is over a tag.">CURSOR</div>
		<div class="thin-spacer"></div>
		<div style="display: inline-block; width: 100%;">
			<div style="float: left; padding: 0 16px 0 0;">
				<input title="The UA determines the cursor to display based on the current context." class="radio" id="<?=$this->get_field_id('active_cursor'); ?>"
				name="<?=$this->get_field_name('active_cursor'); ?>" type="radio" value="auto"
				<?php if( $active_cursor == "auto" ){ echo ' checked="checked"'; } ?>>auto
				<br> 
				
				<input title="A simple crosshair (e.g., short line segments resembling a &#34;+&#34; sign)." class="radio" id="<?=$this->get_field_id('active_cursor'); ?>"
				name="<?=$this->get_field_name('active_cursor'); ?>" type="radio" value="crosshair"
				<?php if( $active_cursor == "crosshair" ){ echo ' checked="checked"'; } ?>>crosshair
				<br> 
				
				<input title="The platform-dependent default cursor. Often rendered as an arrow." class="radio" id="<?=$this->get_field_id('active_cursor'); ?>"
				name="<?=$this->get_field_name('active_cursor'); ?>" type="radio" value="default"
				<?php if( $active_cursor == "default" ){ echo ' checked="checked"'; } ?>>default
			</div>
			<div style="float: left; padding: 0 16px 0 0;">
				<input title="Help is available for the object under the cursor. Often rendered as a question mark or a balloon." class="radio" id="<?=$this->get_field_id('active_cursor'); ?>"
				name="<?=$this->get_field_name('active_cursor'); ?>" type="radio" value="help"	
				<?php if( $active_cursor == "help" ){ echo ' checked="checked"'; } ?>>help
				<br>
				
				<input title="Indicates something is to be moved." class="radio" id="<?=$this->get_field_id('active_cursor'); ?>"
				name="<?=$this->get_field_name('active_cursor'); ?>" type="radio" value="move"	
				<?php if( $active_cursor == "move" ){ echo ' checked="checked"'; } ?>>move
				<br> 
				
				<input title="No cursor is rendered for the element." class="radio" id="<?=$this->get_field_id('active_cursor'); ?>"
				name="<?=$this->get_field_name('active_cursor'); ?>" type="radio" value="none"
				<?php if( $active_cursor == "none" ){ echo ' checked="checked"'; } ?>>none
			</div>
			<div style="float: left; padding: 0 16px 0 0;">
				<input title="The cursor indicates that the requested action will not be executed." class="radio" id="<?=$this->get_field_id('active_cursor'); ?>"
				name="<?=$this->get_field_name('active_cursor'); ?>" type="radio" value="not-allowed"		
				<?php if( $active_cursor == "not-allowed" ){ echo ' checked="checked"'; } ?>>not-allowed
				<br> 
				
				<input title="The cursor is a pointer that indicates a link (default)." class="radio" id="<?=$this->get_field_id('active_cursor'); ?>"
				name="<?=$this->get_field_name('active_cursor'); ?>" type="radio" value="pointer"
				<?php if( $active_cursor == "pointer" ){ echo ' checked="checked"'; } ?>>pointer
				<br>	
				
				<input title="A progress indicator. The program is performing some processing, but is different from 'wait' in that the user may still interact with the program. Often rendered as a spinning beach ball, or an arrow with a watch or hourglass." class="radio" id="<?=$this->get_field_id('active_cursor'); ?>"
				name="<?=$this->get_field_name('active_cursor'); ?>" type="radio" value="progress"
				<?php if( $active_cursor == "progress" ){ echo ' checked="checked"'; } ?>>progress
			</div>
			<div style="float: left;">
				<input title="Indicates text that may be selected. Often rendered as an I-beam." class="radio" id="<?=$this->get_field_id('active_cursor'); ?>"
				name="<?=$this->get_field_name('active_cursor'); ?>" type="radio" value="text"	
				<?php if( $active_cursor == "text" ){ echo ' checked="checked"'; } ?>>text
				<br> 
				
				<input title="Indicates that the program is busy and the user should wait. Often rendered as a watch or hourglass." class="radio" id="<?=$this->get_field_id('active_cursor'); ?>"
				name="<?=$this->get_field_name('active_cursor'); ?>" type="radio" value="wait"
				<?php if( $active_cursor == "wait" ){ echo ' checked="checked"'; } ?>>wait
				<br>
				
				<input title="The cursor indicates that something can be zoomed in." class="radio" id="<?=$this->get_field_id('active_cursor'); ?>"
				name="<?=$this->get_field_name('active_cursor'); ?>" type="radio" value="zoom-in"
				<?php if( $active_cursor == "zoom-in" ){ echo ' checked="checked"'; } ?>>zoom-in
			</div>
		</div>
		<div style="width: 100%; float: left; padding: 5px 0; border-top: 1px solid #aaa;" title="Function for drawing in the center of the cloud. You can use two ready made functions or create yours.">
			<span style="font-weight: bold;">CENTER FUNCTION</span>
		</div>
		<span title="Put an image in the center of your cloud.">General Settings</span>
		<br>
		<label style="margin: 0 10px 0 0;" for="<?=$this->get_field_id('cf_name'); ?>" title="<span class='green'>none</span> - no Center Function;<br><span class='green'>image_cf()</span> - for an image in cloud's center;<br><span class='green'>text_cf()</span> - for text in cloud's center and<br><span class='green'>my_cf()</span> - for your own code.">
			Function
			<br>
			<select id="<?=$this->get_field_id('cf_name'); ?>" name="<?=$this->get_field_name('cf_name'); ?>">
				<option value="" <?php if( $cf_name == "" ){ echo ' selected'; } ?>>none</option>
				<option value="image_cf" <?php if( $cf_name == "image_cf" ){ echo ' selected'; } ?>>image_cf()</option>
				<option value="text_cf" <?php if( $cf_name == "text_cf" ){ echo ' selected'; } ?>>text_cf()</option>
				<option value="my_cf" <?php if( $cf_name == "my_cf" ){ echo ' selected'; } ?>>my_cf()</option>
			</select>
		</label>
		<div style="float: left;" title="Rotation of Center <span class='green'>Function</span> image/text. Suitable for <span class='green'>square</span> sized image/text.<br><span class='green'>off</span> - no rotation;<br><span class='green'>&#8635;</span> - clockwise rotation (<span class='green'>image_cf()</span> & <span class='green'>text_cf()</span>);<br><span class='green'>&#8634;</span> - counterclockwise rotation (<span class='green'>image_cf()</span> & <span class='green'>text_cf()</span>).">
			Rotation
			<br>
			<input class="radio" id="<?=$this->get_field_id('cf_rotation'); ?>"
			name="<?=$this->get_field_name('cf_rotation'); ?>" type="radio" value="0"
			<?php if( $cf_rotation == "0" ){ echo ' checked="checked"'; } ?>>off
			
			<span style="position:relative; top: 6px; left: 7px; font-size: 30px; line-height: 4px; font-weight: normal;">&#8635;</span>
			<input style="margin: 0 0 0 7px; position: relative; left: -24px; top: 0px;" class="radio" id="<?=$this->get_field_id('cf_rotation'); ?>"
			name="<?=$this->get_field_name('cf_rotation'); ?>" type="radio" value="1"
			<?php if( $cf_rotation == "1" ){ echo ' checked="checked"'; } ?>>
			
			<span style="position:relative; top: 6px; left: -14px; font-size: 30px; line-height: 4px; font-weight: normal;">&#8634;</span>
			<input style="margin: 0 0 0 10px; position: relative; left: -48px; top: 0px;" class="radio" id="<?=$this->get_field_id('cf_rotation'); ?>"
			name="<?=$this->get_field_name('cf_rotation'); ?>" type="radio" value="-1"
			<?php if( $cf_rotation == "-1" ){ echo ' checked="checked"'; } ?>>
		</div>
		<label style="margin-left: -30px;" title="Opacity of Center <span class='green'>Function</span> image/text" for="<?=$this->get_field_id('cf_opacity'); ?>">
			Opacity
			<br>
			<select id="<?=$this->get_field_id('cf_opacity'); ?>" name="<?=$this->get_field_name('cf_opacity'); ?>">
				<?php for($i=5; $i<105; $i+=5){echo '<option id="cfo_' . $i . '" value="' . $i/100 . '"'; if($cf_opacity==$i/100){echo ' selected';}; echo '>' . $i/100 . '</option>'; } ?>					
			</select>
		</label>
		<label style="padding: 15px 0 0 8px; text-align: center;">
			<a style="color:#1e8cbe; font-weight: bold;" title="...of Center Function" href="http://peter.bg/archives/7840" target="_blank">Examples</a>
		</label>		
		<div class="thick-spacer" style="float: none; border-bottom: 1px dotted #bbb;"></div>
		<span title="Put an image in the center of your cloud.">Image Center Function</span>
		<br>
		<label style="clear: both; width: 200px; margin: 0 25px 0 0;" title="Enter location of your image:<br><span class='green'>http://your-site/your-folder/your-image.png</span><br>Image size (width & height) is good to be bigger or equal to widget's one. Plugin will resize it to a proper value. Preferably use png format due to advantage of transparency." for="<?=$this->get_field_id('cf_image_loc'); ?>">
			URL
			<input style="width: 100%;"
			id="<?=$this->get_field_id('cf_image_loc'); ?>"
			name="<?=$this->get_field_name('cf_image_loc'); ?>" type="text"
			value="<?php echo $cf_image_loc; ?>" /> 
		</label>
		<div style="float: left;" title="Turn <span class='green'>on</span> if Center Function creates too big image.">
		Image Reduction
		<br>
		<input class="radio" id="<?=$this->get_field_id('img_reduction'); ?>"
			name="<?=$this->get_field_name('img_reduction'); ?>" type="radio" value="0"
			<?php if( $img_reduction == "0" ){ echo ' checked="checked"'; } ?>>on
			
			<input style="margin: 0 0 0 8px;" class="radio" id="<?=$this->get_field_id('img_reduction'); ?>"
			name="<?=$this->get_field_name('img_reduction'); ?>" type="radio" value="0.25"
			<?php if( $img_reduction == "0.25" ){ echo ' checked="checked"'; } ?>>off
		</div>
		<div class="thin-spacer" style="border-bottom: 1px dotted #bbb;"></div>
		<div style="clear: both; padding-top: 5px;">
			<span title="Put a text object in the center of your cloud.">Text Center Function</span>
			<br>
			<label style="margin: 0 4px 0 0;" for="<?=$this->get_field_id('text_cont'); ?>" title="Choose shape of container for your text: <span class='green'>square</span> (suitable for all types of cloud <span class='green'>shape</span>), <span class='green'>landscape</span> rectangle (suitable for shape <span class='green'>hring</span> and <span class='green'>hcylinder</span> when <span class='green'>x-axis</span> rotation is locked) or <span class='green'>portrait</span> rectangle (suitable for <span class='green'>vring</span> and <span class='green'>vcylinder</span> when <span class='green'>y-axis</span> rotation is locked).">
				Text Container
				<br>
				<select id="<?=$this->get_field_id('text_cont'); ?>" name="<?=$this->get_field_name('text_cont'); ?>">
					<option value="square" <?php if( $text_cont == "square" ){ echo ' selected'; } ?>>square</option>
					<option value="landscape" <?php if( $text_cont == "landscape" ){ echo ' selected'; } ?>>landscape</option>
					<option value="portrait" <?php if( $text_cont == "portrait" ){ echo ' selected'; } ?>>portrait</option>
				</select>
			</label>
			<label style="margin: 0 4px 0 0;" for="<?=$this->get_field_id('text_zoom'); ?>" title="Zooms your text object">
				Zoom
				<br>
				<select id="<?=$this->get_field_id('text_zoom'); ?>" name="<?=$this->get_field_name('text_zoom'); ?>">
					<?php for($i=2; $i<21; $i++){echo '<option id="txtzoom_' . $i . '" value="' . $i/10 . '"'; if($text_zoom==$i/10){echo ' selected';}; echo '>' . $i/10 . '</option>'; } ?>
				</select>
			</label>
			<label style="margin: 0 4px 0 0;" title="Border width of text object: 0 for no border." for="<?=$this->get_field_id('cont_border'); ?>">
				Border
				<br>
				<select id="<?=$this->get_field_id('cont_border'); ?>" name="<?=$this->get_field_name('cont_border'); ?>">	
					<?php for($i=0; $i<4; $i++){echo '<option id="cntb_' . $i . '" value="' . $i . '"'; if($cont_border==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>	
				</select>px
			</label>
			<label style="margin: 0 4px 0 0;" title="Height of the font" for="<?=$this->get_field_id('font_h'); ?>">
				Font Size
				<br>
				<select id="<?=$this->get_field_id('font_h'); ?>" name="<?=$this->get_field_name('font_h'); ?>">	
					<?php for($i=10; $i<25; $i++){echo '<option id="fnth_' . $i . '" value="' . $i . '"'; if($font_h==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>	
				</select>px
			</label>
			<div style="float: left;" title="Choose weight of text.">
			Font Weight
			<br>
				<input class="radio" id="<?=$this->get_field_id('font_w'); ?>"
				name="<?=$this->get_field_name('font_w'); ?>" type="radio" value="normal"
				<?php if( $font_w == "normal" ){ echo ' checked="checked"'; } ?>>normal
				<br>
				<input class="radio" id="<?=$this->get_field_id('font_w'); ?>"
				name="<?=$this->get_field_name('font_w'); ?>" type="radio" value="bold"
				<?php if( $font_w == "bold" ){ echo ' checked="checked"'; } ?>>bold
			</div>
			<div class="thin-spacer"></div>		
			<div style="display: inline-block; width: 127px; float: left;">
				<span style="font-weight: normal; padding: 0 0 0 40px;">Text</span>
				<br>
				<label style="clear: both; padding: 0 4px 0 0;" title="Enter short text (2-3 words)." for="<?=$this->get_field_id('text_line_1'); ?>">
					<div style="display: inline-block;">Line 1</div>
					<input style="width: 84px;" id="<?=$this->get_field_id('text_line_1'); ?>"
					name="<?=$this->get_field_name('text_line_1'); ?>" type="text"
					value="<?php echo $text_line_1; ?>" onblur="qutes_check(this, this.value)"  />
				</label>
				<label style="padding: 0 4px 0 0;" title="Enter short text (2-3 words)." for="<?=$this->get_field_id('text_line_2'); ?>">
					<div style="display: inline-block;">Line 2</div>
					<input	style="width: 84px;" id="<?=$this->get_field_id('text_line_2'); ?>"
					name="<?=$this->get_field_name('text_line_2'); ?>" type="text"
					value="<?php echo $text_line_2; ?>" onblur="qutes_check(this, this.value)" /> 
				</label>
				<label style="padding: 0 4px 0 0;" title="Enter short text (2-3 words)." for="<?=$this->get_field_id('text_line_3'); ?>">
					<div style="display: inline-block;">Line 3</div>
					<input	style="width: 84px;" id="<?=$this->get_field_id('text_line_3'); ?>"
					name="<?=$this->get_field_name('text_line_3'); ?>" type="text"
					value="<?php echo $text_line_3; ?>" onblur="qutes_check(this, this.value)" /> 
				</label>
				<label style="padding: 0 4px 0 0;" title="Enter short text (2-3 words)." for="<?=$this->get_field_id('text_line_4'); ?>">
					<div style="display: inline-block;">Line 4</div>
					<input	style="width: 84px;" id="<?=$this->get_field_id('text_line_4'); ?>"
					name="<?=$this->get_field_name('text_line_4'); ?>" type="text"
					value="<?php echo $text_line_4; ?>" onblur="qutes_check(this, this.value)" /> 
				</label>
				<label style="padding: 0 4px 0 0;" title="Enter short text (2-3 words)." for="<?=$this->get_field_id('text_line_5'); ?>">
					<div style="display: inline-block;">Line 5</div>
					<input style="width: 84px;" id="<?=$this->get_field_id('text_line_5'); ?>"
					name="<?=$this->get_field_name('text_line_5'); ?>" type="text"
					value="<?php echo $text_line_5; ?>" onblur="qutes_check(this, this.value)" /> 
				</label>
			</div>
			<div style="display: inline-block;">
				<label style="height: 55px;" for="<?=$this->get_field_id('text_color_cf'); ?>">
					Text Color
					<br>
					<span class="hash">#</span>
					<div class="siwraper">
						<input title="Color of the text"
						class="colors" id="<?=$this->get_field_id('text_color_cf'); ?>"
						name="<?=$this->get_field_name('text_color_cf'); ?>" type="text"
						value="<?php echo $text_color_cf; ?>" onblur="hex_val_check(this, this.value)" />
						<?php 
							if($text_color_cf != '') {echo '<span class="color" style="color: #' . $text_color_cf . ';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>';}; 
						?>
					</div>
				</label>
				<label style="height: 55px;" for="<?=$this->get_field_id('bg_colour_cf'); ?>">
					Background
					<br>
					<span class="hash">#</span>
					<div class="siwraper">
						<input title="Background color of the text - empty option means no background."
						class="colors" id="<?=$this->get_field_id('bg_colour_cf'); ?>"
						name="<?=$this->get_field_name('bg_colour_cf'); ?>" type="text"
						value="<?php echo $bg_colour_cf; ?>" onblur="hex_val_check(this, this.value)" />
						<br>
						<?php 
							if($bg_colour_cf != '') {echo '<span class="color" style="color: #' . $bg_colour_cf . ';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>';}
						?>
					</div>
				</label>
				<label style="height: 55px;" for="<?=$this->get_field_id('border_cf'); ?>">
					Border Color
					<br>
					<span class="hash">#</span>
					<div class="siwraper">
						<input title="Border color of text container. Empty for no border."
						class="colors" id="<?=$this->get_field_id('border_cf'); ?>"
						name="<?=$this->get_field_name('border_cf'); ?>" type="text"
						value="<?php echo $border_cf; ?>" onblur="hex_val_check(this, this.value)" />
						<br>
						<?php 
							if($border_cf != '') {echo '<span class="color" style="color: #' . $border_cf . ';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>';}; 
						?>
					</div>
				</label>
				<br>
				<label title="36 Google Fonts for your text" style="float: left; margin-right: 5px;" for="<?=$this->get_field_id('font_cf'); ?>">
					Font
					<br>
					<select id="<?=$this->get_field_id('font_cf'); ?>" name="<?=$this->get_field_name('font_cf'); ?>">
						<option value="Allan" <?php if( $font_cf == "Allan" ){ echo ' selected'; } ?>>Allan</option>
						<option value="Alex Brush" <?php if( $font_cf == "Alex Brush" ){ echo ' selected'; } ?>>Alex Brush</option> 
						<option value="Audiowide" <?php if( $font_cf == "Audiowide" ){ echo ' selected'; } ?>>Audiowide</option>
						<option value="Autour One" <?php if( $font_cf == "Autour One" ){ echo ' selected'; } ?>>Autour One</option>
						<option value="Bad Script" <?php if( $font_cf == "Bad Script" ){ echo ' selected'; } ?>>Bad Script</option>
						<option value="Black Ops One" <?php if( $font_cf == "Black Ops One" ){ echo ' selected'; } ?>>Black Ops One</option>
						<option value="Bonbon" <?php if( $font_cf == "Bonbon" ){ echo ' selected'; } ?>>Bonbon</option>
						<option value="Caesar Dressing" <?php if( $font_cf == "Caesar Dressing" ){ echo ' selected'; } ?>>Caesar Dressing</option>
						<option value="Courgette" <?php if( $font_cf == "Courgette" ){ echo ' selected'; } ?>>Courgette</option>
						<option value="Dancing Script" <?php if( $font_cf == "Dancing Script" ){ echo ' selected'; } ?>>Dancing Script</option>
						<option value="Fira Mono" <?php if( $font_cf == "Fira Mono" ){ echo ' selected'; } ?>>Fira Mono</option>
						<option value="Inconsolata" <?php if( $font_cf == "Inconsolata" ){ echo ' selected'; } ?>>Inconsolata</option>
						<option value="Indie Flower" <?php if( $font_cf == "Indie Flower" ){ echo ' selected'; } ?>>Indie Flower</option>
						<option value="Lobster" <?php if( $font_cf == "Lobster" ){ echo ' selected'; } ?>>Lobster</option>
						<option value="Monoton" <?php if( $font_cf == "Monoton" ){ echo ' selected'; } ?>>Monoton</option>
						<option value="Nova Cut" <?php if( $font_cf == "Nova Cut" ){ echo ' selected'; } ?>>Nova Cut</option>
						<option value="Offside" <?php if( $font_cf == "Offside" ){ echo ' selected'; } ?>>Offside</option>
						<option value="Orbitron" <?php if( $font_cf == "Orbitron" ){ echo ' selected'; } ?>>Orbitron</option>
						<option value="Oxygen Mono" <?php if( $font_cf == "Oxygen Mono" ){ echo ' selected'; } ?>>Oxygen Mono</option>
						<option value="Permanent Marker" <?php if( $font_cf == "Permanent Marker" ){ echo ' selected'; } ?>>Permanent Marker</option>
						<option value="Pinyon Script" <?php if( $font_cf == "Pinyon Script" ){ echo ' selected'; } ?>>Pinyon Script</option>
						<option value="Pirata One" <?php if( $font_cf == "Pirata One" ){ echo ' selected'; } ?>>Pirata One</option>
						<option value="Poiret One" <?php if( $font_cf == "Poiret One" ){ echo ' selected'; } ?>>Poiret One</option>
						<option value="Rock Salt" <?php if( $font_cf == "Rock Salt" ){ echo ' selected'; } ?>>Rock Salt</option>
						<option value="Sancreek" <?php if( $font_cf == "Sancreek" ){ echo ' selected'; } ?>>Sancreek</option>
						<option value="Shadows Into Light" <?php if( $font_cf == "Shadows Into Light" ){ echo ' selected'; } ?>>Shadows Into Light</option>
						<option value="Share Tech Mono" <?php if( $font_cf == "Share Tech Mono" ){ echo ' selected'; } ?>>Share Tech Mono</option>
						<option value="Smokum" <?php if( $font_cf == "Smokum" ){ echo ' selected'; } ?>>Smokum</option>
						<option value="Snowburst One" <?php if( $font_cf == "Snowburst One" ){ echo ' selected'; } ?>>Snowburst One</option>
						<option value="Special Elite" <?php if( $font_cf == "Special Elite" ){ echo ' selected'; } ?>>Special Elite</option>
						<option value="Syncopate" <?php if( $font_cf == "Syncopate" ){ echo ' selected'; } ?>>Syncopate</option>
						<option value="Tangerine" <?php if( $font_cf == "Tangerine" ){ echo ' selected'; } ?>>Tangerine</option>
						<option value="Unkempt" <?php if( $font_cf == "Unkempt" ){ echo ' selected'; } ?>>Unkempt</option>
						<option value="Warnes" <?php if( $font_cf == "Warnes" ){ echo ' selected'; } ?>>Warnes</option>
						<option value="Wire One" <?php if( $font_cf == "Wire One" ){ echo ' selected'; } ?>>Wire One</option>
						<option value="Yellowtail" <?php if( $font_cf == "Yellowtail" ){ echo ' selected'; } ?>>Yellowtail</option>
					</select>
				</label>
			</div>
		</div>
		<div class="thin-spacer"></div>
		<div style="clear: both; border-top: 1px dotted #bbb; padding-top: 5px;">
			<span>My Center Function</span>
			<br>
			Create a js file and put in it your function named <span>my_cf</span>:
			<label style="float: left; border-radius: 10px; border: 1px dotted #bbb;" for="<?=$this->get_field_id('cf_name'); ?>">
				<div style="width: 92px; display: inline-block; margin: 5px 0 0 5px;">
					<i>function my_cf(){<br>
					&nbsp; &nbsp;...<br>
					}</i><br>
				</div>
			</label>
			<label style="margin: 5px 0 0 35px; width: 200px;" title="URL of a js file containing your <span class='green'>my_cf()</span> function. For example:<br><span>http://your-domain.com/your-js-folder/your-file.js</span>. <span>IMPORTANT</span>: You can include it in as many widget instances as you want, but you can have ONLY ONE <span class='green'>my_cf()</span> function." for="<?=$this->get_field_id('cf_url'); ?>" style="float: left; width: 255px;">
				URL 
				<input style="width: 100%;"
				id="<?=$this->get_field_id('cf_url'); ?>"
				name="<?=$this->get_field_name('cf_url'); ?>" type="text"
				value="<?php echo $cf_url; ?>" /> 
			</label>
		</div>
	</div>
	<h3><span class="front-title">tags:</span> COLORS</h3>
	<div class="section_content" style="padding: 0 1px 5px;">
		<div style="padding-top: 5px;">
			<label style="height: 55px;" for="<?=$this->get_field_id('text_color'); ?>">
				Tag Color
				<br>
				<span class="hash">#</span>
				<div class="siwraper">
					<input title="Color of the tag text - empty string to use the color of the original link"
					class="colors" id="<?=$this->get_field_id('text_color'); ?>"
					name="<?=$this->get_field_name('text_color'); ?>" type="text"
					value="<?php echo $text_color; ?>" onblur="hex_val_check(this, this.value)" />
					<?php 
						if($text_color != '') {echo '<span class="color" style="color: #' . $text_color . ';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>';}; 
					?>
				</div>
			</label>
			<label style="height: 55px;" for="<?=$this->get_field_id('bg_color'); ?>">
				Background
				<br>
				<span class="hash">#</span>
				<div class="siwraper">
					<input title="Background color of tags - empty option means no background. The string <span class='green'>'tag'</span> means use the original link background color."
					class="colors" id="<?=$this->get_field_id('bg_color'); ?>"
					name="<?=$this->get_field_name('bg_color'); ?>" type="text"
					value="<?php echo $bg_color; ?>" onblur="hex_val_check(this, this.value)" />
					<br>
					<?php 
						if($bg_color != '' && $bg_color != 'tag') {echo '<span class="color" style="color: #' . $bg_color . ';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>';}
						else {if($bg_color == 'tag'){echo '<span class="color" style="padding: 0 0 0 1px; letter-spacing: 0;">original color</span>';}};
					?>
				</div>
			</label>
			<label style="height: 55px;" for="<?=$this->get_field_id('bg_outline'); ?>">
				Border
				<br>
				<span class="hash">#</span>
				<div class="siwraper">
					<input title="Color of tag border. Use empty option for the same as the text color, use <span class='green'>'tag'</span> for the original link text color."
					class="colors" id="<?=$this->get_field_id('bg_outline'); ?>"
					name="<?=$this->get_field_name('bg_outline'); ?>" type="text"
					value="<?php echo $bg_outline; ?>" onblur="hex_val_check(this, this.value)" />
					<br>
					<?php 
						if($bg_outline != '') {echo '<span class="color" style="color: #' . $bg_outline . ';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>';}; 
					?>
				</div>
			</label>
			<label style="height: 55px;" for="<?=$this->get_field_id('shadow'); ?>">
				Shadow
				<br>
				<span class="hash">#</span>
				<div class="siwraper">
					<input title="Color of the shadow behind each tag"
					class="colors" id="<?=$this->get_field_id('shadow'); ?>"
					name="<?=$this->get_field_name('shadow'); ?>" type="text"
					value="<?php echo $shadow; ?>" onblur="hex_val_check(this, this.value)" />
					<br>
					<?php 
						if($shadow != '') {echo '<span class="color" style="color: #' . $shadow . ';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>';}; 
					?>
				</div>
			</label>								
			<label style="height: 55px;" for="<?=$this->get_field_id('outline_color'); ?>">
				Outline
				<br>
				<span class="hash">#</span>
				<div class="siwraper" style="margin: 0;">
					<input title="Color of the active tag highlight"
					class="colors" id="<?=$this->get_field_id('outline_color'); ?>"
					name="<?=$this->get_field_name('outline_color'); ?>" type="text"
					value="<?php echo $outline_color; ?>" onblur="hex_val_check(this, this.value)" />
					<br>
					<?php 
						if($outline_color != '') {echo '<span class="color" style="color: #' . $outline_color . ';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>';}; 
					?>
				</div>
			</label>
			<div style="display: inline-block; height: 60px;">	
				<label for="<?=$this->get_field_id('weight_gradient_1'); ?>">
					Gradient<br>Color: 0
					<br>
					<span class="hash">#</span>
					<div class="siwraper">
						<input title="The color gradient applied for colouring tags when using a <span class='green'>Weight Mode</span> of <span class='green'>color</span> or <span class='green'>size & color</span>. Start with the color for the &#34;heaviest&#34; tag at 0, and ending at 1 with the least weighty tag color. All 4 Gradient values must be entered to take effect." 
						class="colors" id="<?=$this->get_field_id('weight_gradient_1'); ?>"
						name="<?=$this->get_field_name('weight_gradient_1'); ?>" type="text"
						value="<?php echo $weight_gradient_1 ?>" onblur="hex_val_check(this, this.value)" />
						<br>
						<?php 
							if($weight_gradient_1 != '') {echo '<span class="color" style="color: #' . $weight_gradient_1 . ';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>';}; 
						?>
					</div>
				</label>
				<label for="<?=$this->get_field_id('weight_gradient_2'); ?>">
					Gradient<br>Color: 0.33
					<br>
					<span class="hash">#</span>
					<div class="siwraper">
						<input title="The color gradient applied for colouring tags when using a <span class='green'>Weight Mode</span> of <span class='green'>color</span> or <span class='green'>size & color</span>. Start with the color for the &#34;heaviest&#34; tag at 0, and ending at 1 with the least weighty tag color. All 4 Gradient values must be entered to take effect." 
						class="colors" id="<?=$this->get_field_id('weight_gradient_2'); ?>"
						name="<?=$this->get_field_name('weight_gradient_2'); ?>" type="text"
						value="<?php echo $weight_gradient_2 ?>" onblur="hex_val_check(this, this.value)" />
						<br>
						<?php 
							if($weight_gradient_2 != '') {echo '<span class="color" style="color: #' . $weight_gradient_2 . ';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>';}; 
						?>
					</div>
				</label>
				<label for="<?=$this->get_field_id('weight_gradient_3'); ?>">
					Gradient<br>Color: 0.67
					<br>
					<span class="hash">#</span>
					<div class="siwraper">
						<input title="The color gradient applied for colouring tags when using a <span class='green'>Weight Mode</span> of <span class='green'>color</span> or <span class='green'>size & color</span>. Start with the color for the &#34;heaviest&#34; tag at 0, and ending at 1 with the least weighty tag color. All 4 Gradient values must be entered to take effect." 
						class="colors" id="<?=$this->get_field_id('weight_gradient_3'); ?>"
						name="<?=$this->get_field_name('weight_gradient_3'); ?>" type="text"
						value="<?php echo $weight_gradient_3 ?>" onblur="hex_val_check(this, this.value)" />
						<br>
						<?php 
							if($weight_gradient_3 != '') {echo '<span class="color" style="color: #' . $weight_gradient_3 . ';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>';}; 
						?>
					</div>
				</label>
				<label for="<?=$this->get_field_id('weight_gradient_4'); ?>">
					Gradient<br>Color: 1
					<br>
					<span class="hash">#</span>
					<div class="siwraper" style="margin: 0;">
						<input title="The color gradient applied for colouring tags when using a <span class='green'>Weight Mode</span> of <span class='green'>color</span> or <span class='green'>size & color</span>. Start with the color for the &#34;heaviest&#34; tag at 0, and ending at 1 with the least weighty tag color. All 4 Gradient values must be entered to take effect." 
						class="colors" id="<?=$this->get_field_id('weight_gradient_4'); ?>"
						name="<?=$this->get_field_name('weight_gradient_4'); ?>" type="text"
						value="<?php echo $weight_gradient_4 ?>" onblur="hex_val_check(this, this.value)" />
						<br>
						<?php 
							if($weight_gradient_4 != '') {echo '<span class="color" style="color: #' . $weight_gradient_4 . ';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>';}; 
						?>
					</div>
				</label>
				<label style="padding: 15px 0 0 8px; text-align: center;">
					<a style="color:#1e8cbe; font-weight: bold;" href="http://www.goat1000.com/tagcanvas-weighted.php" target="_blank">Gradient<br>Examples</a>
				</label>
			</div>
			<label style="margin-top: 5px; width: 100%;" for="<?=$this->get_field_id('multiple_colors'); ?>">
				Multiple Colors (hex, no #)
				<br>
				<div class="muwraper" style="margin: 0;">
					<input id="muco" class="colors" title="Colors that will be distributed randomly to your cloud content. Enter hex values without #, separated by coma. To use this function you have to empty the above <span class='green'>Tag Color</span> field and switch off <span class='green'>Weight</span> or set <span class='green'>Weight Mode</span> to <span class='green'>size</span>."
					id="<?=$this->get_field_id('multiple_colors'); ?>"
					name="<?=$this->get_field_name('multiple_colors'); ?>" type="text"
					value="<?php echo $multiple_colors; ?>" onblur="multi_colors_check(this, this.value, '#mucodiv')" /> 
					<div id="mucodiv" class="colors multi-wraper">
						<?php
							if($multiple_colors != '') {
								$str = str_replace(' ','',$multiple_colors);
								$mu_co_array = explode(',',$str);
								for($i=0;$i<=count($mu_co_array)-1;$i++){
								echo '<span class="multi-colors" style="color: #' . $mu_co_array[$i] . ';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>';
								}
							}
						?>
					</div>
				</div> 
			</label> 
			<label style="margin: 5px 0 0; width: 100%;" for="<?=$this->get_field_id('multiple_bg'); ?>">
				Multiple Backgrounds (hex, no #)
				<br>
				<div class="muwraper" style="margin: 0;">
					<input id="muba" class="colors" title="Tag background colors that will be distributed randomly to your cloud content. Enter hex values without #, separated by coma. To use this function type <span class='green'>tag</span> in the <span class='green'>Background</span> field above and switch off <span class='green'>Weight</span> or set <span class='green'>Weight Mode</span> to <span class='green'>size</span>."
					id="<?=$this->get_field_id('multiple_bg'); ?>"
					name="<?=$this->get_field_name('multiple_bg'); ?>" type="text"
					value="<?php echo $multiple_bg; ?>" onblur="multi_colors_check(this, this.value, '#mubadiv')" /> 
					<div id="mubadiv" class="colors multi-wraper">
						<?php
							if($multiple_bg != '') {
								$str = str_replace(' ','',$multiple_bg);
								$mu_bg_array = explode(',',$str);
								for($i=0;$i<=count($mu_bg_array)-1;$i++){
								echo '<span class="multi-colors" style="color: #' . $mu_bg_array[$i] . ';">&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;&#9608;</span>';
								}
							}
						?>
					</div>
				</div>
			</label>
		</div>
	</div>
	<h3><span class="front-title">tags:</span> SIZES</h3>
	<div class="section_content" style="padding: 0 2px 5px;">
		<div style="padding: 5px 0 0; float: left;">
			<label style="width: 85px;" title="Height of the tag text font" for="<?=$this->get_field_id('text_height'); ?>">
				Font Height
				<br>
				<select id="<?=$this->get_field_id('text_height'); ?>" name="<?=$this->get_field_name('text_height'); ?>">	
					<?php for($i=6; $i<31; $i++){echo '<option id="txh_' . $i . '" value="' . $i . '"'; if($text_height==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>	
				</select>px
			</label>
			<label style="width: 85px;" title="Amount of space around text and inside background" for="<?=$this->get_field_id('padding'); ?>">
				Padding
				<br>
				<select id="<?=$this->get_field_id('padding'); ?>" name="<?=$this->get_field_name('padding'); ?>">	
					<?php for($i=1; $i<11; $i++){echo '<option id="pa_' . $i . '" value="' . $i . '"'; if($padding==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>	
				</select>px
			</label>
			<label style="width: 85px;" title="If greater than 0, breaks the tag into multiple lines at word boundaries when the line would be longer than this value. Lines are automatically broken at line break tags." for="<?=$this->get_field_id('split_width'); ?>">
				Split Width
				<br>
				<select id="<?=$this->get_field_id('split_width'); ?>" name="<?=$this->get_field_name('split_width'); ?>">						
					<option id="spw_0" value="0" <?php if( $split_width == "0" ){ echo ' selected'; } ?>>0</option>
					<?php for($i=50; $i<155; $i+=5){echo '<option id="spw_' . $i . '" value="' . $i . '"'; if($split_width==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>					
				</select>px
			</label>
			<label style="width: 80px;" title="Amount to scale images by. Depending on <span class='green'>Content</span> the default of <span class='green'>1.0</span> uses:<br> - avatar size 96x96px (<span class='green'>Authors</span>, <span class='green'>Links</span> & <span class='green'>Menu</span>);<br> - thumbnail size 120x120px (<span class='green'>Pages</span> & <span class='green'>Recent Posts</span>)." for="<?=$this->get_field_id('image_scale'); ?>">
				Image Scale
				<br>
				<select id="<?=$this->get_field_id('image_scale'); ?>" name="<?=$this->get_field_name('image_scale'); ?>">
					<?php for($i=25; $i<1525; $i+=25){echo '<option id="ims_' . $i . '" value="' . $i/1000 . '"'; if($image_scale==$i/1000){echo ' selected';}; echo '>' . $i/1000 . '</option>'; } ?>					
				</select>
			</label>
		</div>
		<div class="thick-spacer"></div>
		<label style="margin: 0 5px 0 0;" title="Thickness of tag border, <span class='green'>0</span> for no border." for="<?=$this->get_field_id('bg_outline_thickness'); ?>">
			Border
			<br>
			<select id="<?=$this->get_field_id('bg_outline_thickness'); ?>" name="<?=$this->get_field_name('bg_outline_thickness'); ?>">						
				<?php for($i=0; $i<11; $i++){echo '<option id="bgt_' . $i . '" value="' . $i . '"'; if($bg_outline_thickness==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>					
			</select>px 
		</label>
		<label style="width: 81px;" title="Radius for rounded corners of tag border" for="<?=$this->get_field_id('bg_radius'); ?>">
			Border Radius
			<br>
			<select id="<?=$this->get_field_id('bg_radius'); ?>" name="<?=$this->get_field_name('bg_radius'); ?>">						
				<?php for($i=0; $i<21; $i++){echo '<option id="bgr_' . $i . '" value="' . $i . '"'; if($bg_radius==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>					
			<select>px
		</label>
		<div style="float: left; margin: 0 4px 0 0; padding: 0 0 2px 2px; border: 1px dotted #aaa; border-radius: 5px;" title="X and Y offset of the tag shadow">
			Shadow Offset [x, y]
			<br>
			<select id="<?=$this->get_field_id('shadow_offset_x'); ?>" name="<?=$this->get_field_name('shadow_offset_x'); ?>">						
				<?php for($i=-5; $i<6; $i++){echo '<option id="sox_' . $i . '" value="' . $i . '"'; if($shadow_offset_x==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>							
			</select>px<select id="<?=$this->get_field_id('shadow_offset_y'); ?>" name="<?=$this->get_field_name('shadow_offset_y'); ?>">						
				<?php for($i=-5; $i<6; $i++){echo '<option id="soy_' . $i . '" value="' . $i . '"'; if($shadow_offset_y==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>							
			</select>px
		</div>
		<label style="float: left; width: 70px;" title="Amount of tag shadow blurring" for="<?=$this->get_field_id('shadow_blur'); ?>">
			Shadow Blur
			<select id="<?=$this->get_field_id('shadow_blur'); ?>" name="<?=$this->get_field_name('shadow_blur'); ?>">	
				<?php for($i=0; $i<6; $i++){echo '<option id="shb_' . $i . '" value="' . $i . '"'; if($shadow_blur==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>												
			</select>px
		</label>	
		<div class="thick-spacer"></div>
		<label style="width: 85px;" title="Thickness of outline when <span class='green'>Outline Method</span> is <span class='green'>outline</span> or <span class='green'>clasic</span>." for="<?=$this->get_field_id('outline_thickness'); ?>">
			<br>
			Outline
			<br>
			<select id="<?=$this->get_field_id('outline_thickness'); ?>" name="<?=$this->get_field_name('outline_thickness'); ?>">
				<?php for($i=0; $i<11; $i++){echo '<option id="out_' . $i . '" value="' . $i . '"'; if($outline_thickness==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>					
			</select>px 
		</label>	
		<label style="width: 85px;" title="Radius for rounded corners on outline box" for="<?=$this->get_field_id('outline_radius'); ?>">
			Outline<br>Radius
			<br>
			<select id="<?=$this->get_field_id('outline_radius'); ?>" name="<?=$this->get_field_name('outline_radius'); ?>">						
				<?php for($i=0; $i<21; $i++){echo '<option id="our_' . $i . '" value="' . $i . '"'; if($outline_radius==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>					
			<select>px
		</label>
		<label style="width: 85px;" title="Distance of outline from text when <span class='green'>Outline Method</span> is <span class='green'>outline</span> or <span class='green'>clasic</span>. This also increases the size of the active area around the tag." for="<?=$this->get_field_id('outline_offset'); ?>">
			Outline<br>Offset
			<br>
			<select id="<?=$this->get_field_id('outline_offset'); ?>" name="<?=$this->get_field_name('outline_offset'); ?>">						
				<?php for($i=0; $i<11; $i++){echo '<option id="ouo_' . $i . '" value="' . $i . '"'; if($outline_offset==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>					
			</select>px 
		</label>	
		<label title="Number of pixels to increase size of tag by for the <span class='green'>size</span> outline method." for="<?=$this->get_field_id('outline_increase'); ?>">
			Outline<br>Increase<br>
			<select id="<?=$this->get_field_id('outline_increase'); ?>" name="<?=$this->get_field_name('outline_increase'); ?>">						
				<?php for($i=0; $i<11; $i++){echo '<option id="oui_' . $i . '" value="' . $i . '"'; if($outline_increase==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>					
			</select>px
		</label>				
	</div>
	<h3><span class="front-title">tags:</span> MIXED IMAGE & TEXT</h3>
	<div class="section_content" style="padding: 5px 1px 0;">
		(for <b>Recent Posts</b>, <b>Pages</b>, <b>Links</b>, <b>Menu</b> & <b>Authors</b>)
		<div style="padding-top: 5px; display: inline-block;">
			<label style="margin: 0 17px 0 0;" title="What to display when tag contains images and text:<br><span class='green'>null</span> - Image if present, otherwise text;<br><span class='green'>image</span> - Image tags only;<br><span class='green'>text</span> - Text tags only;<br><span class='green'>both</span> - Image and text on tag using <span class='green'>Image Position</span>." for="<?=$this->get_field_id('image_mode'); ?>">
				<br>
				Tag Mode
				<br>
				<select id="<?=$this->get_field_id('image_mode'); ?>" name="<?=$this->get_field_name('image_mode'); ?>">
					<option value="" <?php if( $image_mode == "" ){ echo ' selected'; } ?>>null</option>
					<option value="image" <?php if( $image_mode == "image" ){ echo ' selected'; } ?>>image</option>
					<option value="text" <?php if( $image_mode == "text" ){ echo ' selected'; } ?>>text</option>
					<option value="both" <?php if( $image_mode == "both" ){ echo ' selected'; } ?>>both</option>
				</select>
			</label>
			<label style="margin: 0 17px 0 0;" title="Position of image relative to text when using an <span class='green'>Tag Mode</span> of <span class='green'>both</span>." for="<?=$this->get_field_id('image_position'); ?>">
				Image<br>Position
				<br>
				<select id="<?=$this->get_field_id('image_position'); ?>" name="<?=$this->get_field_name('image_position'); ?>">
					<option value="left" <?php if( $image_position == "left" ){ echo ' selected'; } ?>>left</option>
					<option value="right" <?php if( $image_position == "right" ){ echo ' selected'; } ?>>right</option>
					<option value="top" <?php if( $image_position == "top" ){ echo ' selected'; } ?>>top</option>
					<option value="bottom" <?php if( $image_position == "bottom" ){ echo ' selected'; } ?>>bottom</option>
				</select>
			</label>
			<label style="margin: 0 17px 0 0;" title="Distance between image and text when using an <span class='green'>Tag Mode</span> of <span class='green'>both</span>." for="<?=$this->get_field_id('image_padding'); ?>">
				Image<br>Padding
				<br>
				<select id="<?=$this->get_field_id('image_padding'); ?>" name="<?=$this->get_field_name('image_padding'); ?>">	
					<?php for($i=1; $i<6; $i++){echo '<option id="impa_' . $i . '" value="' . $i . '"'; if($image_padding==$i){echo ' selected';}; echo '>' . $i . '</option>'; } ?>	
				</select>px
			</label>
			<div style="float: left; border: 1px dotted #aaa; border-radius: 5px; padding: 0 2px;" title="Amount to scale images by.">For <b>Image Scale</b><br>go to <b>SIZES</b><br>section above.</div>		
		</div>
		<div style="padding-top: 5px; display: inline-block;">
			<label style="margin: 0 20px 5px 0;" title="Horizontal image alignment" for="<?=$this->get_field_id('image_align'); ?>">
				Horizontal<br>Image Align
				<br>
				<select id="<?=$this->get_field_id('image_align'); ?>" name="<?=$this->get_field_name('image_align'); ?>">
					<option value="left" <?php if( $image_align == "left" ){ echo ' selected'; } ?>>left</option>
					<option value="centre" <?php if( $image_align == "centre" ){ echo ' selected'; } ?>>center</option>
					<option value="right" <?php if( $image_align == "right" ){ echo ' selected'; } ?>>right</option>
				</select>
			</label>
			<label style="margin: 0 20px 5px 0;" title="Vertical image alignment" for="<?=$this->get_field_id('image_valign'); ?>">
				Vertical<br>Image Align
				<br>
				<select id="<?=$this->get_field_id('image_valign'); ?>" name="<?=$this->get_field_name('image_valign'); ?>">
					<option value="top" <?php if( $image_valign == "top" ){ echo ' selected'; } ?>>top</option>
					<option value="middle" <?php if( $image_valign == "middle" ){ echo ' selected'; } ?>>middle</option>
					<option value="bottom" <?php if( $image_valign == "bottom" ){ echo ' selected'; } ?>>bottom</option>
				</select>
			</label>
			<label style="margin: 0 20px 5px 0;" title="Horizontal text alignment" for="<?=$this->get_field_id('text_align'); ?>">
				Horizontal<br>Text Align
				<br>
				<select id="<?=$this->get_field_id('text_align'); ?>" name="<?=$this->get_field_name('text_align'); ?>">
					<option value="left" <?php if( $text_align == "left" ){ echo ' selected'; } ?>>left</option>
					<option value="centre" <?php if( $text_align == "centre" ){ echo ' selected'; } ?>>center</option>
					<option value="right" <?php if( $text_align == "right" ){ echo ' selected'; } ?>>right</option>
				</select>
			</label>
			<label style="margin: 0 0 5px;" title="Vertical text alignment" for="<?=$this->get_field_id('text_valign'); ?>">
				Vertical<br>Text Align
				<br>
				<select id="<?=$this->get_field_id('text_valign'); ?>" name="<?=$this->get_field_name('text_valign'); ?>">
					<option value="top" <?php if( $text_valign == "top" ){ echo ' selected'; } ?>>top</option>
					<option value="middle" <?php if( $text_valign == "middle" ){ echo ' selected'; } ?>>middle</option>
					<option value="bottom" <?php if( $text_valign == "bottom" ){ echo ' selected'; } ?>>bottom</option>
				</select>
			</label>				
		</div>
	</div>
	<h3><span class="front-title">tags:</span> FONTS</h3>
	<div class="section_content" style="padding-bottom: 0;">
		<p style="margin: 0; padding: 0 5px 5px; font-size: 12px; text-align: center;">
			<b>N.B.</b> If no font is selected pludin applies <b>Arial</b>.
		</p>
		<label style="margin: 0 5px 0 0;" title="Web Safe Fonts will be distributed randomly on the Cloud <span class='green'>Content</span> if you select more than one. Your choice will be mixed with <span class='green'>Google Fonts</span> if such are selected." for="<?=$this->get_field_id('multiple_fonts'); ?>">
			Web Safe Fonts (48)
			<br>
			<select style="height: 389px!important;" id="<?=$this->get_field_id('multiple_fonts'); ?>" name="<?=$this->get_field_name('multiple_fonts'); ?>[]" multiple>
				<option style="background: #f1f1f1;" title="Sans Serif Family" value="Arial" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Arial" ){ echo ' selected'; }} ?>>Arial</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family"	value="Arial Black" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Arial Black" ){ echo ' selected'; }} ?>>Arial Black</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family"	value="Arial Narrow" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Arial Narrow" ){ echo ' selected'; }} ?>>Arial Narrow</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family"	value="Avant Garde" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Avant Garde" ){ echo ' selected'; }} ?>>Avant Garde</option>										
				<option style="background: #f1f1f1;" title="Sans Serif Family"	value="Calibri" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Calibri" ){ echo ' selected'; }} ?>>Calibri</option>										
				<option style="background: #f1f1f1;" title="Sans Serif Family"	value="Candara" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Candara" ){ echo ' selected'; }} ?>>Candara</option>										
				<option style="background: #f1f1f1;" title="Sans Serif Family"	value="Century Gothic" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Century Gothic" ){ echo ' selected'; }} ?>>Century Gothic</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family"	value="Comic Sans MS" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Comic Sans MS" ){ echo ' selected'; }} ?>>Comic Sans MS</option>										
				<option style="background: #f1f1f1;" title="Sans Serif Family"	value="Franklin Gothic Medium" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Franklin Gothic Medium" ){ echo ' selected'; }} ?>>Franklin Gothic Medium</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family"	value="Futura" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Futura" ){ echo ' selected'; }} ?>>Futura</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family"	value="Geneva" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Geneva" ){ echo ' selected'; }} ?>>Geneva</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family"	value="Gill Sans" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Gill Sans" ){ echo ' selected'; }} ?>>Gill Sans</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family" value="Helvetica" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Helvetica" ){ echo ' selected'; }} ?>>Helvetica</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family" value="Impact" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Impact" ){ echo ' selected'; }} ?>>Impact</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family" value="Lucida Grande" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Lucida Grande" ){ echo ' selected'; }} ?>>Lucida Grande</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family" value="Lucida Sans Unicode" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Lucida Sans Unicode" ){ echo ' selected'; }} ?>>Lucida Sans Unicode</option>												
				<option style="background: #f1f1f1;" title="Sans Serif Family" value="Optima" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Optima" ){ echo ' selected'; }} ?>>Optima</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family" value="Segoe UI" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Segoe UI" ){ echo ' selected'; }} ?>>Segoe UI</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family" value="Tahoma" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Tahoma" ){ echo ' selected'; }} ?>>Tahoma</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family" value="Trebuchet MS" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Trebuchet MS" ){ echo ' selected'; }} ?>>Trebuchet MS</option>
				<option style="background: #f1f1f1;" title="Sans Serif Family" value="Verdana" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Verdana" ){ echo ' selected'; }} ?>>Verdana</option>
				<option title="Serif Family" value="Baskerville" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Baskerville" ){ echo ' selected'; }} ?>>Baskerville</option>
				<option title="Serif Family" value="Big Caslon" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Big Caslon" ){ echo ' selected'; }} ?>>Big Caslon</option>
				<option title="Serif Family" value="Bodoni MT" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Bodoni MT" ){ echo ' selected'; }} ?>>Bodoni MT</option>
				<option title="Serif Family" value="Book Antiqua" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Book Antiqua" ){ echo ' selected'; }} ?>>Book Antiqua</option>
				<option title="Serif Family" value="Calisto MT" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Calisto MT" ){ echo ' selected'; }} ?>>Calisto MT</option>
				<option title="Serif Family" value="Cambria" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Cambria" ){ echo ' selected'; }} ?>>Cambria</option>
				<option title="Serif Family" value="Didot" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Didot" ){ echo ' selected'; }} ?>>Didot</option>
				<option title="Serif Family" value="Garamond" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Garamond" ){ echo ' selected'; }} ?>>Garamond</option>
				<option title="Serif Family" value="Georgia" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Georgia" ){ echo ' selected'; }} ?>>Georgia</option>
				<option title="Serif Family" value="Goudy Old Style" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Goudy Old Style" ){ echo ' selected'; }} ?>>Goudy Old Style</option>
				<option title="Serif Family" value="Hoefler Text" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Hoefler Text" ){ echo ' selected'; }} ?>>Hoefler Text</option>
				<option title="Serif Family" value="Lucida Bright" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Lucida Bright" ){ echo ' selected'; }} ?>>Lucida Bright</option>
				<option title="Serif Family" value="Palatino" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Palatino" ){ echo ' selected'; }} ?>>Palatino</option>
				<option title="Serif Family" value="Palatino Linotype" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Palatino Linotype" ){ echo ' selected'; }} ?>>Palatino Linotype</option>										
				<option title="Serif Family" value="Perpetua" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Perpetua" ){ echo ' selected'; }} ?>>Perpetua</option>
				<option title="Serif Family" value="Rockwell" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Rockwell" ){ echo ' selected'; }} ?>>Rockwell</option>
				<option title="Serif Family" value="Rockwell Extra Bold" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Rockwell Extra Bold" ){ echo ' selected'; }} ?>>Rockwell Extra Bold</option>
				<option title="Serif Family" value="Times New Roman" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Times New Roman" ){ echo ' selected'; }} ?>>Times New Roman</option>
				<option style="background: #f1f1f1;" title="Monospaced Family" value="Andale Mono" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Andale Mono" ){ echo ' selected'; }} ?>>Andale Mono</option>
				<option style="background: #f1f1f1;" title="Monospaced Family" value="Consolas" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Consolas" ){ echo ' selected'; }} ?>>Consolas</option>
				<option style="background: #f1f1f1;" title="Monospaced Family" value="Courier New" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Courier New" ){ echo ' selected'; }} ?>>Courier New</option>
				<option style="background: #f1f1f1;" title="Monospaced Family"	value="Lucida Console" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Lucida Console" ){ echo ' selected'; }} ?>>Lucida Console</option>
				<option style="background: #f1f1f1;" title="Monospaced Family"	value="Lucida Sans Typewriter" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Lucida Sans Typewriter" ){ echo ' selected'; }} ?>>Lucida Sans Typewriter</option>
				<option style="background: #f1f1f1;" title="Monospaced Family"	value="Monaco" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Monaco" ){ echo ' selected'; }} ?>>Monaco</option>
				<option title="Fantasy Family" value="Copperplate" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Copperplate" ){ echo ' selected'; }} ?>>Copperplate</option>
				<option title="Fantasy Family" value="Papyrus" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Papyrus" ){ echo ' selected'; }} ?>>Papyrus</option>
				<option style="background: #f1f1f1;" title="Script Family" value="Brush Script MT" <?php for($i=0; $i <= count($multiple_fonts)-1; $i++){if( $multiple_fonts[$i] == "Brush Script MT" ){ echo ' selected'; }} ?>>Brush Script MT</option>		
			</select>			
		</label>
<?php
				$fontsSeraliazed = file_get_contents('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBlBRwG98Uy3ci9ygxRDxW1CxCDD-2MOPc');
				$obj = json_decode($fontsSeraliazed);
				$items = $obj->{'items'};
?>
		<label style="width: 175px;" title="Google Fonts will be distributed randomly on the Cloud <span class='green'>Content</span> if you select more than one. Your choice will be mixed with <span class='green'>Web Safe Fonts</span> if such are selected." for="<?=$this->get_field_id('multiple_fonts_g'); ?>">
			Google Fonts (<?= count($items) ?>)
			<br>
			<select style="height: 389px!important;" id="<?=$this->get_field_id('multiple_fonts_g'); ?>" name="<?=$this->get_field_name('multiple_fonts_g'); ?>[]" multiple>
<?php
				foreach ($items as $font){
					echo '<option value="'.$font->{'family'}.'"';
					for($i=0; $i <= count($multiple_fonts_g)-1; $i++){				
						if ($multiple_fonts_g[$i] == $font->{'family'}) {echo 'selected'; };
					}
					echo '>'.$font->{'family'}.'</option>';
				}
 ?>
			</select>
		</label>
		<p style="text-align: center; margin: 0;">
			About <a title="Find what is Web Safe Font." style="color: #1e8cbe;" href="http://www.w3schools.com/cssref/css_websafe_fonts.asp" target="_blank">Web Safe Fonts</a> & <a title="Find a Google Font Family." style="color: #1e8cbe;" href="http://www.google.com/fonts/" target="_blank">Google Fonts</a>
		</p>
	</div>
	<h3 class="help"><span class="help-2">help:</span> GUIDE & TIPS</h3>
	<div class="section_content" style="padding: 6px 0 3px;">
		<h3 id="guide" class="ui-guide-icons" style="margin-left: 5px; margin-right: 5px;" onclick="window.open('<?php echo plugins_url( 'help/s.user.guide.htm' , __FILE__ ) ?>')">
			<span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>Guide (opens in a new tab)
		</h3>
		<div id="accordion-3">
			<?php include 'help/s.tips.php'; ?>	
		</div>
	</div>
</div>
<div style="line-height: 12px; font-size: 10px; text-align: center; padding: 0 0 3px 0; background: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
	Check Multiple Clouds plugin variation: <a href="https://wordpress.org/plugins/3d-wp-tag-cloud-m/" target="_blank" style="text-decoration: none; color: #1e8cbe; font-weight: bold;">3D WP Tag Cloud-M</a>
</div>
<style> body {overflow-y: scroll};</style>