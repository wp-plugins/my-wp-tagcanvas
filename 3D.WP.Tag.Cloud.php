<?php 
/*
Plugin Name: 3D WP Tag Cloud
Plugin URI: http://peter.bg/archives/7373
Description: This plugin creates multiple instances widget that draws and animates a HTML5 canvas based tag cloud. In addition to Post Tags and Post Categories now clouds may rotate Recent Posts, External Links and Menu items. Full variety of fonts from Google Font Library is available. The plugin allows creating clouds of images. It gives the option to put images and/or text in the center of the cloud. The Number of tags in the cloud is adjustable. 3D WP Tag Cloud uses Graham Breach's Javascript class TagCanvas v. 2.5 and includes all its 70+ options in the Control Panel settings. Supports following shapes: sphere, hcylinder for a cylinder that starts off horizontal, vcylinder for a cylinder that starts off vertical, hring for a horizontal circle and vring for a vertical circle.
Version: 2.0.1
Author: Peter Petrov
Author URI: http://peter.bg
Update Server: http://peter.bg/
License: LGPL v3
*/

class wpTagCanvasWidget extends WP_Widget {
    function wpTagCanvasWidget () {
        parent::__construct(
        'wpTagCanvasWidget', // Base ID
			__('3D WP Tag Cloud', 'text_domain'), // Name
			array( 'description' => __( 'Draws & Animates HTML5 tag clouds.', 'text_domain' ), ) // Args
        );
    }

    function widget($args, $instance) {  
        extract($args);


        $inst_id = mt_rand(0,999999);
        
        wp_register_script('jq-tagcloud', plugin_dir_url( __FILE__ ) . '3D.WP.Tag.Cloud/jquery.tagcanvas.js', array('jquery'), '1.0',true);
        wp_enqueue_script('jq-tagcloud');
		wp_register_script('jq-CF', plugin_dir_url( __FILE__ ) . '3D.WP.Tag.Cloud/CF.js', array('jquery'), '1.0',true);
        wp_enqueue_script('jq-CF');
		wp_register_script('jq-demo', plugin_dir_url( __FILE__ ) . '3D.WP.Tag.Cloud/demo.js', array('jquery'), '1.0',true);
        wp_enqueue_script('jq-demo');
		
		$tooltip_status = attribute_escape($instance['tooltip_status']);		
		$title = attribute_escape($instance['title']);
		$width = attribute_escape($instance['width']);
		$height = attribute_escape($instance['height']);		
		$taxonomy = attribute_escape($instance['taxonomy']);
		$tags = attribute_escape($instance['tags']);
		$links_category_id = attribute_escape($instance['links_category_id']);
		$links = attribute_escape($instance['links']);
		$rp_category_id = attribute_escape($instance['rp_category_id']);
		$recent_posts = attribute_escape($instance['recent_posts']);
		$menu = attribute_escape($instance['menu']);
		
		$active_cursor = attribute_escape($instance['active_cursor']);	
		$animation_timing = attribute_escape($instance['animation_timing']);		
		$bg_color = attribute_escape($instance['bg_color']);
		$bg_outline = attribute_escape($instance['bg_outline']);	
		$bg_outline_thickness = attribute_escape($instance['bg_outline_thickness']);
		$bg_radius = attribute_escape($instance['bg_radius']);
		$center_function = attribute_escape($instance['center_function']);	
		$click_to_front = attribute_escape($instance['click_to_front']);
		$deceleration = attribute_escape($instance['deceleration']);		
		$depth = attribute_escape($instance['depth']);
		$drag_ctrl = attribute_escape($instance['drag_ctrl']);
		$drag_threshold = attribute_escape($instance['drag_threshold']);		
		$fadein = attribute_escape($instance['fadein']);
		$freeze_active = attribute_escape($instance['freeze_active']);
		$freeze_decel = attribute_escape($instance['freeze_decel']);
		$front_select = attribute_escape($instance['front_select']);
		$hide_tags = attribute_escape($instance['hide_tags']);
		$image_scale = attribute_escape($instance['image_scale']);
		$initial = attribute_escape($instance['initial']);		
		$interval = attribute_escape($instance['interval']);	
		$lock = attribute_escape($instance['lock']);
		$max_brightness = attribute_escape($instance['max_brightness']);
		$max_speed = attribute_escape($instance['max_speed']);		
		$min_brightness = attribute_escape($instance['min_brightness']);
		$min_speed = attribute_escape($instance['min_speed']);
		$no_mouse = attribute_escape($instance['no_mouse']);
		$no_select = attribute_escape($instance['no_select']);
		$offset_x = attribute_escape($instance['offset_x']);
		$offset_y = attribute_escape($instance['offset_y']);
		$outline_color = attribute_escape($instance['outline_color']);
		$outline_increase = attribute_escape($instance['outline_increase']);
		$outline_method = attribute_escape($instance['outline_method']);
		$outline_offset = attribute_escape($instance['outline_offset']);		
		$outline_radius = attribute_escape($instance['outline_radius']);
		$outline_thickness = attribute_escape($instance['outline_thickness']);		
		$padding = attribute_escape($instance['padding']);
		$pulsate_time = attribute_escape($instance['pulsate_time']);
		$pulsate_to = attribute_escape($instance['pulsate_to']);
		$radius_x = attribute_escape($instance['radius_x']);
		$radius_y = attribute_escape($instance['radius_y']);
		$radius_z = attribute_escape($instance['radius_z']);
		$reverse = attribute_escape($instance['reverse']);			
		$shadow = attribute_escape($instance['shadow']);
		$shadow_blur = attribute_escape($instance['shadow_blur']);
		$shadow_offset = attribute_escape($instance['shadow_offset']);		
		$shape = attribute_escape($instance['shape']);		
		$shuffle_tags = attribute_escape($instance['shuffle_tags']);	
		$split_width = attribute_escape($instance['split_width']);
		$stretch_x = attribute_escape($instance['stretch_x']);
		$stretch_y = attribute_escape($instance['stretch_y']);		
		$text_color = attribute_escape($instance['text_color']);	
		$text_font = attribute_escape($instance['text_font']);	
		$text_height = attribute_escape($instance['text_height']);	
		$text_optimisation = attribute_escape($instance['text_optimisation']);		
		$text_scale = attribute_escape($instance['text_scale']);
		$tooltip = attribute_escape($instance['tooltip']);
		$tooltip_class = attribute_escape($instance['tooltip_class']);
		$tooltip_delay = attribute_escape($instance['tooltip_delay']);
		$weight_from = attribute_escape($instance['weight_from']);
		$weight_gradient = attribute_escape($instance['weight_gradient']);
			$wcolor_1=sprintf("%06x",((base_convert($text_color,16,10)-base_convert($weight_gradient,16,10))/3)+base_convert($weight_gradient,16,10));
			$wcolor_2=sprintf("%06x",((base_convert($text_color,16,10)-base_convert($weight_gradient,16,10))*2/3)+base_convert($weight_gradient,16,10));
		$weight_mode = attribute_escape($instance['weight_mode']);
		$weight_size = attribute_escape($instance['weight_size']);
		$weight_size_max = attribute_escape($instance['weight_size_max']);
		$weight_size_min = attribute_escape($instance['weight_size_min']);
		$wheel_zoom = attribute_escape($instance['wheel_zoom']);			
		$zoom = attribute_escape($instance['zoom']);
		$zoom_max = attribute_escape($instance['zoom_max']);
		$zoom_min = attribute_escape($instance['zoom_min']);
		$zoom_step = attribute_escape($instance['zoom_step']);

    	echo $before_widget;
		
    	?>

		<script src="//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
		
        <?php		
		if( $title ) {
		    echo $before_title . $title . $after_title;
		}
		?>
            <div id="tag_html5_<?= $inst_id; ?>" width="<?= $width;?>"
            	height="<?= $height;?>" hidden>
		<?php 
			if( $taxonomy == "both" ){ $args = array ('number' => $tags, 'taxonomy' => array('post_tag','category')); wp_tag_cloud($args);}
			else { if( $taxonomy == "links" ) {$args = array ('category' => $links_category_id, 'hide_invisible' => 0, 'limit' => $links, 'categorize' => 0, 'title_li' => 0, 'before' => '', 'after' => ''); wp_list_bookmarks($args);}
				else { if ($taxonomy == "menu" ) {$args = array ('menu' => $menu); wp_nav_menu($args);}
					else { if ($taxonomy == "recent_posts") {
								$recent_posts = abs($recent_posts);
								$count=0; 
								$bigest=$weight_size*3; 
								if($recent_posts>0){$increment=($bigest-3)/$recent_posts;};
								$args= array ('numberposts' => $recent_posts, 'category' => $rp_category_id); $recent_posts = wp_get_recent_posts($args); 
								foreach( $recent_posts as $recent ){
									$count=$count+1; $font_size=round($bigest-$increment*$count); 
									if($weight_mode != "none") echo '<a href="' . get_permalink($recent["ID"]) . '" style="font-size: ' . $font_size . 'px;" title="Look '.esc_attr($recent["post_title"]).'" >' . $recent["post_title"].'</a> ';	
									else echo '<a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' . $recent["post_title"].'</a> ';
								};
							} 
						else {$args = array ('number' => $tags, 'taxonomy' => $taxonomy); wp_tag_cloud($args);}
						}
				} 
				}
		?>

				
        </div>
        <canvas width="<?= $width;?>" height="<?= $height;?>" id="tag_canvas_<?= $inst_id; ?>"></canvas>
			
    	<script type="text/javascript">
			WebFont.load({google: {families: ['<? echo $text_font; ?>']}})
		
		    $(document).ready(function(){
					
				var taxonomy = '<?= $taxonomy; ?>';
				var wm = '<?= $weight_mode; ?>';
				if((taxonomy=="links")&(wm!='none')){
					var links= $('#tag_html5_<?= $inst_id; ?> a');							
					var bigest = <?= $weight_size; ?>*3;
					var increment = (bigest-3)/links.length;
					for (var i = 0; i < links.length; i++) { 
						var fsize = Math.round(bigest-increment*i);
						$('#tag_html5_<?= $inst_id; ?> a').eq(i).css('font-size',fsize+'px');
					}
				}
					
				var active_cursor = '<?= $active_cursor; ?>';			
				var animation_timing = '<?= $animation_timing; ?>';
				var bg_color = '<?= $bg_color; ?>';			
				if(bg_color!=''){bg_color = '#'+bg_color;};
				var bg_outline = '<?= $bg_outline; ?>';
				if(bg_outline!=''){bg_outline = '#'+bg_outline;};
				var bg_outline_thickness = <?= $bg_outline_thickness; ?>;
				var bg_radius = <?= $bg_radius; ?>;					
				var center_function = '<?= $center_function; ?>';
				var click_to_front = <?= $click_to_front; ?>;
				var deceleration = <?= $deceleration; ?>;
				var depth = <?= $depth; ?>;
				var drag_ctrl = <?= $drag_ctrl; ?>;
				var drag_threshold = <?= $drag_threshold; ?>;	
				var fadein = <?= $fadein; ?>;
				var freeze_active = <?= $freeze_active; ?>;
				var freeze_decel = <?= $freeze_decel; ?>;
				var front_select = <?= $front_select; ?>;
				var hide_tags = <?= $hide_tags; ?>;		
				var image_scale = <?= $image_scale; ?>;	
				var initial = <?= $initial; ?>;					
				var interval = <?= $interval; ?>;
				var lock = '<?= $lock; ?>';
				var max_brightness = <?= $max_brightness; ?>;
				var max_speed = <?= $max_speed; ?>;
				var min_brightness = <?= $min_brightness; ?>;
				var min_speed = <?= $min_speed; ?>;					
				var no_mouse = <?= $no_mouse; ?>;
				var no_select = <?= $no_select; ?>;
				var offset_x = <?= $offset_x; ?>;
				var offset_y = <?= $offset_y; ?>;	
				var outline_color = '#<?= $outline_color; ?>';	
				var outline_increase = <?= $outline_increase; ?>;	
				var outline_method = '<?= $outline_method; ?>';	
				var outline_offset= <?= $outline_offset; ?>;
				var outline_radius = <?= $outline_radius; ?>;		
				var outline_thickness = <?= $outline_thickness; ?>;
				var padding = <?= $padding; ?>;		
				var pulsate_time = <?= $pulsate_time; ?>;
				var pulsate_to= <?= $pulsate_to; ?>;		
				var radius_x = <?= $radius_x; ?>;			
				var radius_y = <?= $radius_y; ?>;			
				var radius_z = <?= $radius_z; ?>;
				var reverse = <?= $reverse; ?>;		
				var shadow = '#<?= $shadow; ?>';			
				var shadow_blur = <?= $shadow_blur; ?>;
				var shadow_offset = <?= $shadow_offset; ?>;					
				var shape = '<?= $shape; ?>';						
				var shuffle_tags = <?= $shuffle_tags; ?>;	
				var split_width = <?= $split_width; ?>;
				var stretch_x = <?= $stretch_x; ?>;
				var stretch_y = <?= $stretch_y; ?>;
				var text_color = '#<?= $text_color; ?>';	
				var text_font = '<?= $text_font; ?>';	
				var text_height = <?= $text_height; ?>;			
				var text_optimisation = <?= $text_optimisation; ?>;					
				var text_scale= <?= $text_scale; ?>;		
				var tooltip = '<?= $tooltip; ?>';	
				var tooltip_class = '<?= $tooltip_class; ?>';	
				var tooltip_delay = <?= $tooltip_delay; ?>;
				var wcolor = '#<?= $weight_gradient; ?>';		
				var weight_from = '<?= $weight_from; ?>';					
			    var weight_gradient = {0:'#<?= $weight_gradient; ?>', 0.33:'#<?= $wcolor_2; ?>',0.66:'#<?= $wcolor_1; ?>', 1:'#<?= $text_color; ?>'};									
				var weight_mode = '<?= $weight_mode; ?>';
				var weight_size = <?= $weight_size; ?>;
				var weight_size_max = <?= $weight_size_max; ?>;			
				var weight_size_min = <?= $weight_size_min; ?>;					
				var wheel_zoom = <?= $wheel_zoom; ?>;
				var zoom = <?= $zoom; ?>;
				var zoom_max = <?= $zoom_max; ?>;				
				var zoom_min = <?= $zoom_min; ?>;			
				var zoom_step = <?= $zoom_step; ?>;

				TagCanvas.activeCursor = active_cursor; 					
				TagCanvas.animTiming = animation_timing;
				TagCanvas.bgColour = bg_color; 
				TagCanvas.bgOutline = bg_outline;
				TagCanvas.bgOutlineThickness = bg_outline_thickness;		
				TagCanvas.bgRadius = bg_radius;		
				TagCanvas.clickToFront = click_to_front;
				TagCanvas.decel = deceleration; 					
				TagCanvas.depth = depth;
				TagCanvas.dragControl = drag_ctrl;	
				TagCanvas.dragThreshold = drag_threshold;
				TagCanvas.fadeIn = fadein;
				TagCanvas.freezeActive = freeze_active;
				TagCanvas.freezeDecel = freeze_decel;		
				TagCanvas.frontSelect = front_select;
				TagCanvas.hideTags = hide_tags; 
				TagCanvas.imageScale = image_scale;				
				TagCanvas.initial = initial; 					
				TagCanvas.interval = interval;	
				TagCanvas.lock = lock; 
				TagCanvas.maxBrightness = max_brightness;	
				TagCanvas.maxSpeed = max_speed; 
				TagCanvas.minBrightness = min_brightness;
				TagCanvas.minSpeed = min_speed;	
				TagCanvas.noMouse = no_mouse;
				TagCanvas.noSelect = no_select;		
				TagCanvas.offsetX = offset_x;
				TagCanvas.offsetY = offset_y;		
				TagCanvas.outlineColour = outline_color; 					
				TagCanvas.outlineIncrease = outline_increase;		
				TagCanvas.outlineMethod = outline_method;					
				TagCanvas.outlineOffset = outline_offset;	
				TagCanvas.outlineRadius = outline_radius;					
				TagCanvas.outlineThickness = outline_thickness;	
				TagCanvas.padding = padding;
				TagCanvas.pulsateTime = pulsate_time;		
				TagCanvas.pulsateTo = pulsate_to;
				TagCanvas.radiusX = radius_x;
				TagCanvas.radiusY = radius_y;
				TagCanvas.radiusZ = radius_z;		
				TagCanvas.reverse = reverse;			
				TagCanvas.shadow = shadow;
				TagCanvas.shadowBlur = shadow_blur;		
				TagCanvas.shadowOffset = shadow_offset;	
				TagCanvas.shape = shape;
				TagCanvas.shuffleTags = shuffle_tags;		
				TagCanvas.splitWidth = split_width;
				TagCanvas.stretchX = stretch_x;
				TagCanvas.stretchY = stretch_y;					
				TagCanvas.textColour = text_color;
				TagCanvas.textFont = text_font;
				TagCanvas.textHeight = text_height;
				TagCanvas.tooltip = tooltip;
				TagCanvas.tooltipClass = tooltip_class;
				TagCanvas.tooltipDelay = tooltip_delay;
				TagCanvas.txtOpt = text_optimisation;
				TagCanvas.txtScale = text_scale;
				if((weight_mode=="size")||(weight_mode=="colour")||(weight_mode=="both")||(weight_mode=="bgcolour")||(weight_mode=="bgoutline")){
					TagCanvas.weight = true; 
					TagCanvas.weightFrom = weight_from;						
					TagCanvas.weightGradient = weight_gradient;
					TagCanvas.weightMode = weight_mode;
					TagCanvas.weightSize = weight_size;
					TagCanvas.weightSizeMax = weight_size_max;
					TagCanvas.weightSizeMin = weight_size_min;
				}				
				TagCanvas.wheelZoom = wheel_zoom;	
				TagCanvas.zoom = zoom;					
				TagCanvas.zoomMax = zoom_max;
				TagCanvas.zoomMin = zoom_min;
				TagCanvas.zoomStep = zoom_step;	

				TagCanvas.Start('tag_canvas_<?=$inst_id; ?>','tag_html5_<?=$inst_id; ?>', { centreFunc: CF_<?php echo $center_function; ?> });
			});
		</script>
		<?php
		echo $after_widget;
    }
	
	function update($new_instance, $old_instance) {
        $tag_option = array();
		
		$tag_option['tooltip_status'] =strip_tags(stripslashes($new_instance["tooltip_status"]));
		$tag_option['title'] =strip_tags(stripslashes($new_instance["title"]));
		$tag_option['width'] =strip_tags(stripslashes($new_instance["width"]));
		$tag_option['height'] =strip_tags(stripslashes($new_instance["height"]));
		$tag_option['taxonomy'] =strip_tags(stripslashes($new_instance["taxonomy"]));
		$tag_option['tags'] =strip_tags(stripslashes($new_instance["tags"]));
		$tag_option['links_category_id'] =strip_tags(stripslashes($new_instance["links_category_id"]));
		$tag_option['links'] =strip_tags(stripslashes($new_instance["links"]));
		$tag_option['rp_category_id'] =strip_tags(stripslashes($new_instance["rp_category_id"]));		
		$tag_option['recent_posts'] =strip_tags(stripslashes($new_instance["recent_posts"]));
		$tag_option['menu'] =strip_tags(stripslashes($new_instance["menu"]));

		$tag_option['active_cursor'] =strip_tags(stripslashes($new_instance["active_cursor"]));		
		$tag_option['animation_timing'] =strip_tags(stripslashes($new_instance["animation_timing"]));		
		$tag_option['bg_color'] =strip_tags(stripslashes($new_instance["bg_color"]));
		$tag_option['bg_outline'] =strip_tags(stripslashes($new_instance["bg_outline"]));	
		$tag_option['bg_outline_thickness'] =strip_tags(stripslashes($new_instance["bg_outline_thickness"]));
		$tag_option['bg_radius'] =strip_tags(stripslashes($new_instance["bg_radius"]));
		$tag_option['center_function'] =strip_tags(stripslashes($new_instance["center_function"])); 
		$tag_option['click_to_front'] =strip_tags(stripslashes($new_instance["click_to_front"]));
		$tag_option['deceleration'] =strip_tags(stripslashes($new_instance["deceleration"]));		
		$tag_option['depth'] =strip_tags(stripslashes($new_instance["depth"]));		
		$tag_option['drag_ctrl'] =strip_tags(stripslashes($new_instance["drag_ctrl"]));		
		$tag_option['drag_threshold'] =strip_tags(stripslashes($new_instance["drag_threshold"]));		
		$tag_option['fadein'] =strip_tags(stripslashes($new_instance["fadein"]));	
		$tag_option['freeze_active'] =strip_tags(stripslashes($new_instance["freeze_active"])); 
		$tag_option['freeze_decel'] =strip_tags(stripslashes($new_instance["freeze_decel"])); 
		$tag_option['front_select'] =strip_tags(stripslashes($new_instance["front_select"]));
		$tag_option['hide_tags'] =strip_tags(stripslashes($new_instance["hide_tags"]));			
		$tag_option['image_scale'] =strip_tags(stripslashes($new_instance["image_scale"]));
		$tag_option['initial'] =strip_tags(stripslashes($new_instance["initial"]));	
		$tag_option['interval'] =strip_tags(stripslashes($new_instance["interval"])); 	
		$tag_option['lock'] =strip_tags(stripslashes($new_instance["lock"]));	
		$tag_option['max_brightness'] =strip_tags(stripslashes($new_instance["max_brightness"]));	
		$tag_option['max_speed'] =strip_tags(stripslashes($new_instance["max_speed"]));		
		$tag_option['min_brightness'] =strip_tags(stripslashes($new_instance["min_brightness"]));
		$tag_option['min_speed'] =strip_tags(stripslashes($new_instance["min_speed"])); 
		$tag_option['no_mouse'] =strip_tags(stripslashes($new_instance["no_mouse"]));
		$tag_option['no_select'] =strip_tags(stripslashes($new_instance["no_select"])); 
		$tag_option['offset_x'] =strip_tags(stripslashes($new_instance["offset_x"]));
		$tag_option['offset_y'] =strip_tags(stripslashes($new_instance["offset_y"])); 		
		$tag_option['outline_color'] =strip_tags(stripslashes($new_instance["outline_color"]));
		$tag_option['outline_increase'] =strip_tags(stripslashes($new_instance["outline_increase"])); 			
		$tag_option['outline_method'] =strip_tags(stripslashes($new_instance["outline_method"]));
		$tag_option['outline_offset'] =strip_tags(stripslashes($new_instance["outline_offset"])); 
		$tag_option['outline_radius'] =strip_tags(stripslashes($new_instance["outline_radius"]));
		$tag_option['outline_thickness'] =strip_tags(stripslashes($new_instance["outline_thickness"]));		
		$tag_option['padding'] =strip_tags(stripslashes($new_instance["padding"]));
		$tag_option['pulsate_time'] =strip_tags(stripslashes($new_instance["pulsate_time"]));
		$tag_option['pulsate_to'] =strip_tags(stripslashes($new_instance["pulsate_to"]));	
		$tag_option['radius_x'] =strip_tags(stripslashes($new_instance["radius_x"])); 
		$tag_option['radius_y'] =strip_tags(stripslashes($new_instance["radius_y"])); 
		$tag_option['radius_z'] =strip_tags(stripslashes($new_instance["radius_z"]));	
		$tag_option['reverse'] =strip_tags(stripslashes($new_instance["reverse"]));	
		$tag_option['shadow'] =strip_tags(stripslashes($new_instance["shadow"]));
		$tag_option['shadow_blur'] =strip_tags(stripslashes($new_instance["shadow_blur"]));	
		$tag_option['shadow_offset'] =strip_tags(stripslashes($new_instance["shadow_offset"]));	
		$tag_option['shape'] =strip_tags(stripslashes($new_instance["shape"]));		
		$tag_option['split_width'] =strip_tags(stripslashes($new_instance["split_width"]));
		$tag_option['stretch_x'] =strip_tags(stripslashes($new_instance["stretch_x"]));
		$tag_option['stretch_y'] =strip_tags(stripslashes($new_instance["stretch_y"]));
		$tag_option['shuffle_tags'] =strip_tags(stripslashes($new_instance["shuffle_tags"]));
		$tag_option['text_color'] =strip_tags(stripslashes($new_instance["text_color"]));
		$tag_option['text_font'] =strip_tags(stripslashes($new_instance["text_font"]));
		$tag_option['text_height'] =strip_tags(stripslashes($new_instance["text_height"]));
		$tag_option['text_scale'] =strip_tags(stripslashes($new_instance["text_scale"]));
		$tag_option['text_optimisation'] =strip_tags(stripslashes($new_instance["text_optimisation"]));
		$tag_option['tooltip'] =strip_tags(stripslashes($new_instance["tooltip"]));
		$tag_option['tooltip_class'] =strip_tags(stripslashes($new_instance["tooltip_class"]));
		$tag_option['tooltip_delay'] =strip_tags(stripslashes($new_instance["tooltip_delay"]));
		$tag_option['weight_from'] =strip_tags(stripslashes($new_instance["weight_from"]));
		$tag_option['weight_gradient'] =strip_tags(stripslashes($new_instance["weight_gradient"]));		
		$tag_option['weight_mode'] =strip_tags(stripslashes($new_instance["weight_mode"]));
		$tag_option['weight_size'] =strip_tags(stripslashes($new_instance["weight_size"]));
		$tag_option['weight_size_max'] =strip_tags(stripslashes($new_instance["weight_size_max"]));
		$tag_option['weight_size_min'] =strip_tags(stripslashes($new_instance["weight_size_min"]));
		$tag_option['wheel_zoom'] =strip_tags(stripslashes($new_instance["wheel_zoom"]));
		$tag_option['zoom'] =strip_tags(stripslashes($new_instance["zoom"]));
		$tag_option['zoom_max'] =strip_tags(stripslashes($new_instance["zoom_max"]));
		$tag_option['zoom_min'] =strip_tags(stripslashes($new_instance["zoom_min"]));
		$tag_option['zoom_step'] =strip_tags(stripslashes($new_instance["zoom_step"]));

		return $tag_option;
    }
	
	function form($instance) {
        $instance = wp_parse_args( (array) $instance, array(
		
			'tooltip_status' => 'on',
			'title' => 'My 3D WP Tag Cloud',
			'height' => '260',
			'width' => '260',
			'taxonomy' => 'post_tag',
			'tags' => '45',
			'links' => '-1',
			'links_category_id' => '',
			'recent_posts' => '10',
			'rp_category_id' => '',
			'menu' => '',

			'active_cursor' => 'pointer',
			'animation_timing' => 'Smooth',
			'bg_color' => '',
			'bg_outline' => '',
			'bg_outline_thickness' => '0',
			'bg_radius' => '10',
			'center_function' => '1',
			'click_to_front' => 'null',
			'deceleration' => '0.98',
			'depth' => '0.5',
			'drag_ctrl' => 'false',
			'drag_threshold' => '4',
			'fadein' => '6000',
			'freeze_active' => 'false',
			'freeze_decel' => 'false',
			'front_select' => 'false',
			'hide_tags' => 'true',
			'image_scale' => '1',
			'initial' => '[0.0, 0.0]',
			'interval' => '20',
			'lock' => '',
			'max_brightness' => '1.0',
			'max_speed' => '0.05',
			'min_brightness' => '0.1',
			'min_speed' => '0.0',
			'no_mouse' => 'false',
			'no_select' => 'false',
			'offset_x' => '0',
			'offset_y' => '0',
			'outline_color' => '369d88',
			'outline_increase' => '4',
			'outline_method' => 'block',
			'outline_offset' => '5',
			'outline_radius' => '10',
			'outline_thickness' => '2',
			'padding' => '5',
			'pulsate_time' => '1',
			'pulsate_to' => '0.1',
			'radius_x' => '1',
			'radius_y' => '1',
			'radius_z' => '1',
			'reverse' => 'true',
			'shadow' => '000000',
			'shadow_blur' => '0',
			'shadow_offset' => '[1, 1]',
			'shape' => 'sphere',
			'shuffle_tags' => 'false',
			'split_width' => '120',
			'stretch_x' => '1',
			'stretch_y' => '1',
			'text_color' => '666666',
			'text_font' => 'Arial',
			'text_height' => '15',
			'tooltip' => '',
			'tooltip_class' => 'tctooltip',
			'tooltip_delay' => '300',
			'text_optimisation' => 'true',
			'text_scale' => '2',
			'weight_from' => '',
			'weight_gradient' => 'cccccc',
			'weight_mode' => 'both',
			'weight_size' => '1.0',
			'weight_size_max' => 'null',
			'weight_size_min' => 'null',
			'wheel_zoom' => 'true',
			'zoom' => '1.0',
			'zoom_max' => '3.0',
			'zoom_min' => '0.3',
			'zoom_step' => '0.05',

        ));
		
		$tooltip_status = attribute_escape($instance['tooltip_status']);
		$title = attribute_escape($instance['title']);
		$width = attribute_escape($instance['width']);
		$height = attribute_escape($instance['height']);
		$taxonomy = attribute_escape($instance['taxonomy']);
		$tags = attribute_escape($instance['tags']);
		$links = attribute_escape($instance['links']);
		$links_category_id = attribute_escape($instance['links_category_id']);
		$recent_posts = attribute_escape($instance['recent_posts']);
		$rp_category_id = attribute_escape($instance['rp_category_id']);
		$menu = attribute_escape($instance['menu']);
		
		$active_cursor = attribute_escape($instance['active_cursor']);		
		$animation_timing = attribute_escape($instance['animation_timing']);
		$bg_color = attribute_escape($instance['bg_color']);
		$bg_outline = attribute_escape($instance['bg_outline']);		
		$bg_outline_thickness = attribute_escape($instance['bg_outline_thickness']);	
		$bg_radius = attribute_escape($instance['bg_radius']);		
		$center_function = attribute_escape($instance['center_function']);		
		$click_to_front = attribute_escape($instance['click_to_front']);
		$deceleration = attribute_escape($instance['deceleration']);		
		$depth = attribute_escape($instance['depth']);		
		$drag_ctrl = attribute_escape($instance['drag_ctrl']);		
		$drag_threshold = attribute_escape($instance['drag_threshold']);	
		$fadein = attribute_escape($instance['fadein']);		
		$freeze_active = attribute_escape($instance['freeze_active']);
		$freeze_decel = attribute_escape($instance['freeze_decel']);
		$front_select = attribute_escape($instance['front_select']);	
		$hide_tags = attribute_escape($instance['hide_tags']);		
		$image_scale = attribute_escape($instance['image_scale']);		
		$initial = attribute_escape($instance['initial']);	
		$interval = attribute_escape($instance['interval']);
		$lock = attribute_escape($instance['lock']);	
		$max_brightness = attribute_escape($instance['max_brightness']);
		$max_speed = attribute_escape($instance['max_speed']);
		$min_brightness = attribute_escape($instance['min_brightness']);
		$min_speed = attribute_escape($instance['min_speed']);
		$no_mouse = attribute_escape($instance['no_mouse']);
		$no_select = attribute_escape($instance['no_select']);
		$offset_x = attribute_escape($instance['offset_x']);
		$offset_y = attribute_escape($instance['offset_y']);
		$outline_color = attribute_escape($instance['outline_color']);		
		$outline_increase = attribute_escape($instance['outline_increase']);
		$outline_method = attribute_escape($instance['outline_method']);
		$outline_offset = attribute_escape($instance['outline_offset']);
		$outline_radius = attribute_escape($instance['outline_radius']);	
		$outline_thickness = attribute_escape($instance['outline_thickness']);		
		$padding = attribute_escape($instance['padding']);	
		$pulsate_time = attribute_escape($instance['pulsate_time']);
		$pulsate_to = attribute_escape($instance['pulsate_to']);	
		$radius_x = attribute_escape($instance['radius_x']);
		$radius_y = attribute_escape($instance['radius_y']);
		$radius_z = attribute_escape($instance['radius_z']);
		$reverse = attribute_escape($instance['reverse']);		
		$shadow = attribute_escape($instance['shadow']);		
		$shadow_blur = attribute_escape($instance['shadow_blur']);	
		$shadow_offset = attribute_escape($instance['shadow_offset']);	
		$shape = attribute_escape($instance['shape']);		
		$shuffle_tags = attribute_escape($instance['shuffle_tags']);
		$split_width = attribute_escape($instance['split_width']);
		$stretch_x = attribute_escape($instance['stretch_x']);
		$stretch_y = attribute_escape($instance['stretch_y']);
		$text_color = attribute_escape($instance['text_color']);	
		$text_font = attribute_escape($instance['text_font']);		
		$text_height = attribute_escape($instance['text_height']);	
		$text_optimisation = attribute_escape($instance['text_optimisation']);		
		$text_scale = attribute_escape($instance['text_scale']);
		$tooltip = attribute_escape($instance['tooltip']);
		$tooltip_class = attribute_escape($instance['tooltip_class']);
		$tooltip_delay = attribute_escape($instance['tooltip_delay']);
		$weight_from = attribute_escape($instance['weight_from']);	
		$weight_gradient = attribute_escape($instance['weight_gradient']);
		$weight_mode = attribute_escape($instance['weight_mode']);
		$weight_size = attribute_escape($instance['weight_size']);
		$weight_size_max = attribute_escape($instance['weight_size_max']);
		$weight_size_min = attribute_escape($instance['weight_size_min']);
		$wheel_zoom = attribute_escape($instance['wheel_zoom']);
		$zoom = attribute_escape($instance['zoom']);
		$zoom_max = attribute_escape($instance['zoom_max']);
		$zoom_min = attribute_escape($instance['zoom_min']);
		$zoom_step = attribute_escape($instance['zoom_step']);
																																			
		include '3D.WP.Tag.Cloud/CPtemplate.php'; 
 
 ?>

		<script type="text/javascript">
			$( "#tabs" ).tabs({show: { effect: "blind", duration: 800 }, hide:{effect: "blind", duration: 350}});

			<?php if( $tooltip_status == "on" ){ echo "$( document ).tooltip( {show: {effect: 'fade', duration: 300}, hide: {effect: 'fade', duration: 100}, tooltipClass: 'custom-tooltip-styling'});";} 
				else { echo "$( document ).tooltip( {show: {effect: 'fade', duration: 300}, hide: {effect: 'fade', duration: 80}, tooltipClass: 'custom-tooltip-styling', position: { my: 'left-300 top',  at: 'left bottom',  of: 'body'}});";}
			?>
		</script>

<?php
	}
}

function wpTagCanvasLoad() {
    register_widget( 'wpTagCanvasWidget' );    
}

add_action('widgets_init', 'wpTagCanvasLoad');