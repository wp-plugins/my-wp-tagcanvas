<?php 
/*
Plugin Name: 3D WP Tag Cloud-S
Plugin URI: http://peter.bg/archives/7373
Description: This is the Single Cloud variation of 3D WP Tag Cloud. It creates multiple instances widget that draws and animates a HTML5 canvas based tag cloud. Plugin may rotate Pages, Recent Posts, External Links (blogroll), Menus, Blog Archives, List of Authors and of course Post Tags and Post Categories. Option values are preset and don't have to be typed but selected. Multiple fonts, multiple colors and multiple backgrounds can be applied to the cloud content. Full variety of fonts from Google Font Library is available. The plugin allows creating clouds of images. In case of Recent posts, Pages, Menus, List of Authors and External Links (blogroll) tags may consist of both image and text. It gives an option to put images and/or text in the center of the cloud. It accepts background images as well. The Number of tags in the cloud is adjustable. The plugin automatically includes WP Links panel for users who started using WP since v 3.5, when Links Manager and blogroll were made hidden by default. 3D WP Tag Cloud uses Graham Breach's Javascript class TagCanvas v. 2.6 and includes all its 80+ options in the Control Panel settings. Supports following shapes: sphere, hcylinder for a cylinder that starts off horizontal, vcylinder for a cylinder that starts off vertical, hring for a horizontal circle and vring for a vertical circle.
Version: 3.2.1
Author: Peter Petrov
Author URI: http://peter.bg
Update Server: http://peter.bg/
License: LGPL v3
*/
// Enabling link manager for users of WP 3.5+
	add_filter( 'pre_option_link_manager_enabled', '__return_true' );
// ===
// Creating Widget
	class wpTagCanvasWidget extends WP_Widget {
		function wpTagCanvasWidget () {
			parent::__construct(
			'wpTagCanvasWidget', // Base ID
				__('3D WP Tag Cloud-S', 'text_domain'), // Name
				array( 'description' => __( 'Draws & Animates single 3D tag cloud.', 'text_domain' ), ) // Args
			);
		}
// ===
		function widget($args, $instance) {  
			extract($args);
			$inst_id = mt_rand(0,999999);
//  Registration of TagCanvas.js & including an external file	
			wp_register_script('jq-tagcloud', plugin_dir_url( __FILE__ ) . 'js/jquery.tagcanvas.js', array('jquery'), '2.6.1',true);
			wp_enqueue_script('jq-tagcloud');
			include 's.variables.php';			
			echo $before_widget;
// ===
?>
<!-- Loading Google Fonts -->
			<script src="//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
			<script type="text/javascript">
				var goof = '<?= $google_font; ?>';
				WebFont.load({google: {families: [<? for ($i=0;$i<count($multiple_fonts_g);$i++){echo "'" . $multiple_fonts_g[$i] . "',";} ?>]}});
				WebFont.load({google: {families: ['<?= $google_font; ?>']}});
				WebFont.load({google: {families: ['<?= $font_cf; ?>']}});
			</script>
<!-- Loading User's Center Function file -->
			<script type="text/javascript" src="<?= $cf_url; ?>"></script>
<?php		

	if( $title ) {
		echo $before_title . $title . $after_title;
	}	
?>
<!-- HTML Cloud Template -->
        <div id="uni_tags_container_<?= $inst_id; ?>" hidden>
			<?php 
				if( $taxonomy == "links" ) {
					$lin_args = array ('category' => $links_category_id, 'hide_invisible' => 0, 'limit' => $links); 
					$bookmarks = get_bookmarks($lin_args);
					foreach( $bookmarks as $bookmark ){
						echo '<a href="' . $bookmark->link_url . '">';
						if ($bookmark->link_image) { echo '<img src="' .$bookmark->link_image . '" width="96" height="96">';}
						echo  $bookmark->link_name . '</a>';
					}
				}
				else { if ($taxonomy == "menu" ) {$args = array ('menu' => $menu); wp_nav_menu($args);}
					else { if ($taxonomy == "recent_posts") {
								$recent_posts = abs($recent_posts);
								$count=0; 
								$bigest=$weight_size*3; 
								if($recent_posts>0){$increment=($bigest-3)/$recent_posts;};
								$args= array ('numberposts' => $recent_posts, 'category' => $rp_category_id); $recent_posts = wp_get_recent_posts($args); 
								foreach( $recent_posts as $recent ){
									$count=$count+1; $font_size=round($bigest-$increment*$count); 
									if($weight_mode != "none") {echo '<a href="' . get_permalink($recent["ID"]) . '" style="font-size: ' . $font_size . 'px;">' . get_the_post_thumbnail( $recent["ID"], 'thumbnail' ), $recent["post_title"].'</a> ';}	
									else {echo '<a href="' . get_permalink($recent["ID"]) . '">' . get_the_post_thumbnail( $recent["ID"], 'thumbnail' ), $recent["post_title"].'</a> ';};
								};
							} 
						else { if ($taxonomy == "archives" ) { $args = array ('type' => 'monthly', 'limit' => $archives_limit, 'format' => 'custom', 'before' => '<span>', 'after' => '</span>', 'show_post_count' => true); wp_get_archives( $args ); }
							else { if ($taxonomy == "authors" ) { 
								$args = array('number' => $authors_limit, 'exclude' => $exclude);
								$users = get_users($args);
								foreach( $users as $user ){ 
									$userAvatar = get_avatar($user->ID);
									$userFName = $user->first_name;
									$userLName = $user->last_name;
									$userPosts = count_user_posts($user->ID);
									$userPostsURL = get_author_posts_url($user->ID);
									echo '<a href="'.$userPostsURL.'" style="font-size: '.$userPosts.'px">'.$userAvatar, $userFName.'<br>'.$userLName.'<br>('.$userPosts.')</a>';
								};	
							 }
								else { if ($taxonomy == "pages" ) { $args = array('number' => $pages_limit); $pages = get_pages($args);
									foreach( $pages as $page ){
										echo '<a href="' . get_page_link( $page->ID ) . '">' . get_the_post_thumbnail( $page->ID, 'thumbnail' ), $page->post_title . '</a>';
									}
								}
									else { if ($taxonomy == "pp_links") {$pp_links = get_the_ID();}
										else {$args = array ('number' => $tags, 'taxonomy' => $taxonomy); wp_tag_cloud($args);}
									}
								}
							}
						}
					}	 
				}
			?>	
        </div>	
        <canvas title="<?php if($tooltip != ''){ echo $canvas_tooltip;} ?>" id="tag_canvas_<?= $inst_id; ?>" width="<?= $width;?>" height="<?= $height;?>"></canvas>	
		<script type="text/javascript">
			<?php include 'js/s.functions.js'; ?>
			<?php include 'js/s.cf.js'; ?>
		</script>		
<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$tag_option = array();
		
// Basic new instance variables
		$tag_option['archives_limit'] = $new_instance['archives_limit'];
		$tag_option['authors_limit'] = $new_instance['authors_limit'];
		$tag_option['bg_colour_cf'] = $new_instance['bg_colour_cf'];	
		$tag_option['bg_img_url'] = $new_instance['bg_img_url'];
		$tag_option['border_cf'] = $new_instance['border_cf'];			
		$tag_option['canvas_tooltip'] = $new_instance['canvas_tooltip'];
		$tag_option['cf_image_loc'] = $new_instance['cf_image_loc'];		
		$tag_option['cf_name'] = $new_instance['cf_name'];
		$tag_option['cf_opacity'] = $new_instance['cf_opacity'];
		$tag_option['cf_rotation'] = $new_instance['cf_rotation'];			
		$tag_option['cf_url'] = $new_instance['cf_url'];
		$tag_option['cont_border'] = $new_instance['cont_border'];			
		$tag_option['exclude'] = $new_instance['exclude'];	
		$tag_option['font_cf'] = $new_instance['font_cf'];	
		$tag_option['font_h'] = $new_instance['font_h'];
		$tag_option['font_w'] = $new_instance['font_w'];	
		$tag_option['google_font'] = $new_instance['google_font'];
		$tag_option['height'] = $new_instance['height'];		
		$tag_option['img_reduction'] = $new_instance['img_reduction'];		
		$tag_option['links'] = $new_instance['links'];
		$tag_option['links_category_id'] = $new_instance['links_category_id'];
		$tag_option['menu'] = $new_instance['menu'];
		$tag_option['multiple_bg'] = $new_instance['multiple_bg'];		
		$tag_option['multiple_colors'] = $new_instance['multiple_colors'];
		$tag_option['multiple_fonts'] = $new_instance['multiple_fonts'];
		$tag_option['multiple_fonts_g'] = $new_instance['multiple_fonts_g'];
		$tag_option['pages_limit'] = $new_instance['pages_limit'];
		$tag_option['rp_category_id'] = $new_instance['rp_category_id'];		
		$tag_option['recent_posts'] = $new_instance['recent_posts'];
		$tag_option['tags'] = $new_instance['tags'];
		$tag_option['taxonomy'] = $new_instance['taxonomy'];
		$tag_option['text_color_cf'] = $new_instance['text_color_cf'];	
		$tag_option['text_line_1'] = $new_instance['text_line_1'];	
		$tag_option['text_line_2'] = $new_instance['text_line_2'];	
		$tag_option['text_line_3'] = $new_instance['text_line_3'];	
		$tag_option['text_line_4'] = $new_instance['text_line_4'];
		$tag_option['text_line_5'] = $new_instance['text_line_5'];
		$tag_option['text_cont'] = $new_instance['text_cont'];	
		$tag_option['text_zoom'] = $new_instance['text_zoom'];			
		$tag_option['title'] = $new_instance['title'];
		$tag_option['tooltip_status'] = $new_instance['tooltip_status'];
		$tag_option['width'] = $new_instance['width'];
		
		$tag_option['active_cursor'] = $new_instance['active_cursor'];		
		$tag_option['animation_timing'] = $new_instance['animation_timing'];		
		$tag_option['bg_color'] = $new_instance['bg_color'];
		$tag_option['bg_outline'] = $new_instance['bg_outline'];	
		$tag_option['bg_outline_thickness'] = $new_instance['bg_outline_thickness'];
		$tag_option['bg_radius'] = $new_instance['bg_radius'];
		$tag_option['click_to_front'] = $new_instance['click_to_front'];
		$tag_option['deceleration'] = $new_instance['deceleration'];		
		$tag_option['depth'] = $new_instance['depth'];		
		$tag_option['drag_ctrl'] = $new_instance['drag_ctrl'];		
		$tag_option['drag_threshold'] = $new_instance['drag_threshold'];		
		$tag_option['fadein'] = $new_instance['fadein'];	
		$tag_option['freeze_active'] = $new_instance['freeze_active']; 
		$tag_option['freeze_decel'] = $new_instance['freeze_decel']; 
		$tag_option['front_select'] = $new_instance['front_select'];
		$tag_option['hide_tags'] = $new_instance['hide_tags'];			
		$tag_option['image_align'] = $new_instance['image_align'];
		$tag_option['image_mode'] = $new_instance['image_mode'];
		$tag_option['image_padding'] = $new_instance['image_padding'];
		$tag_option['image_position'] = $new_instance['image_position'];
		$tag_option['image_scale'] = $new_instance['image_scale'];
		$tag_option['image_valign'] = $new_instance['image_valign'];
		$tag_option['initial_x'] = $new_instance['initial_x'];	
		$tag_option['initial_y'] = $new_instance['initial_y'];	
		$tag_option['interval'] = $new_instance['interval']; 	
		$tag_option['lock'] = $new_instance['lock'];	
		$tag_option['max_brightness'] = $new_instance['max_brightness'];	
		$tag_option['max_speed'] = $new_instance['max_speed'];		
		$tag_option['min_brightness'] = $new_instance['min_brightness'];
		$tag_option['min_speed'] = $new_instance['min_speed']; 
		$tag_option['no_mouse'] = $new_instance['no_mouse'];
		$tag_option['no_select'] = $new_instance['no_select']; 
		$tag_option['no_tags_msg'] = $new_instance['no_tags_msg']; 
		$tag_option['offset_x'] = $new_instance['offset_x'];
		$tag_option['offset_y'] = $new_instance['offset_y']; 		
		$tag_option['outline_color'] = $new_instance['outline_color'];
		$tag_option['outline_increase'] = $new_instance['outline_increase']; 			
		$tag_option['outline_method'] = $new_instance['outline_method'];
		$tag_option['outline_offset'] = $new_instance['outline_offset']; 
		$tag_option['outline_radius'] = $new_instance['outline_radius'];
		$tag_option['outline_thickness'] = $new_instance['outline_thickness'];		
		$tag_option['padding'] = $new_instance['padding'];
		$tag_option['pulsate_time'] = $new_instance['pulsate_time'];
		$tag_option['pulsate_to'] = $new_instance['pulsate_to'];	
		$tag_option['radius_x'] = $new_instance['radius_x']; 
		$tag_option['radius_y'] = $new_instance['radius_y']; 
		$tag_option['radius_z'] = $new_instance['radius_z'];	
		$tag_option['reverse'] = $new_instance['reverse'];	
		$tag_option['shadow'] = $new_instance['shadow'];
		$tag_option['shadow_blur'] = $new_instance['shadow_blur'];	
		$tag_option['shadow_offset_x'] = $new_instance['shadow_offset_x'];	
		$tag_option['shadow_offset_y'] = $new_instance['shadow_offset_y'];	
		$tag_option['shape'] = $new_instance['shape'];		
		$tag_option['split_width'] = $new_instance['split_width'];
		$tag_option['stretch_x'] = $new_instance['stretch_x'];
		$tag_option['stretch_y'] = $new_instance['stretch_y'];
		$tag_option['shuffle_tags'] = $new_instance['shuffle_tags'];
		$tag_option['text_align'] = $new_instance['text_align'];
		$tag_option['text_color'] = $new_instance['text_color'];
		$tag_option['text_font'] = $new_instance['text_font'];
		$tag_option['text_height'] = $new_instance['text_height'];
		$tag_option['text_scale'] = $new_instance['text_scale'];
		$tag_option['text_optimisation'] = $new_instance['text_optimisation'];
		$tag_option['text_valign'] = $new_instance['text_valign'];
		$tag_option['tooltip'] = $new_instance['tooltip'];
		$tag_option['tooltip_class'] = $new_instance['tooltip_class'];
		$tag_option['tooltip_delay'] = $new_instance['tooltip_delay'];
		$tag_option['weight'] = $new_instance['weight'];
		$tag_option['weight_from'] = $new_instance['weight_from'];
		$tag_option['weight_gradient_1'] = $new_instance['weight_gradient_1'];
		$tag_option['weight_gradient_2'] = $new_instance['weight_gradient_2'];		
		$tag_option['weight_gradient_3'] = $new_instance['weight_gradient_3'];	
		$tag_option['weight_gradient_4'] = $new_instance['weight_gradient_4'];			
		$tag_option['weight_mode'] = $new_instance['weight_mode'];
		$tag_option['weight_size'] = $new_instance['weight_size'];
		$tag_option['weight_size_max'] = $new_instance['weight_size_max'];
		$tag_option['weight_size_min'] = $new_instance['weight_size_min'];
		$tag_option['wheel_zoom'] = $new_instance['wheel_zoom'];
		$tag_option['zoom'] = $new_instance['zoom'];
		$tag_option['zoom_max'] = $new_instance['zoom_max'];
		$tag_option['zoom_min'] = $new_instance['zoom_min'];
		$tag_option['zoom_step'] = $new_instance['zoom_step'];

		return $tag_option;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array(
		
// Basic Options
			'archives_limit' => '',
			'authors_limit' => '',		
			'bg_colour_cf' => 'fff',		
			'bg_img_url' => '',
			'border_cf' => '000',		
			'canvas_tooltip' => '',
			'cf_image_loc' => 'http://peter.bg/cube.png',
			'cf_name' => '',
			'cf_opacity' => '1',			
			'cf_rotation' => '0',				
			'cf_url' => '',		
			'cont_border' => '0',		
			'exclude' => '',
			'font_cf' => 'Special Elite',		
			'font_h' => '16',		
			'font_w' => 'normal',		
			'google_font' => '',
			'height' => '260',
			'img_reduction' => '0.25',
			'links' => '-1',
			'links_category_id' => '',
			'menu' => '',
			'multiple_bg' => 'ff4500, daa520, 9acd32, 6b8e23, 2f4f4f',
			'multiple_colors' => '280000, 003333, 00008b, 000066, 000000',
			'multiple_fonts' => 'Arial',
			'multiple_fonts_g' => '',
			'pages_limit' => '',
			'recent_posts' => '10',
			'rp_category_id' => '',
			'tags' => '45',
			'taxonomy' => 'post_tag',
			'text_color_cf' => '000',		
			'text_line_1' => 'Fill up',		
			'text_line_2' => 'these lines',		
			'text_line_3' => 'with your',		
			'text_line_4' => 'text or',		
			'text_line_5' => 'leave empty.',		
			'text_cont' => 'square',		
			'text_zoom' => '1.2',		
			'title' => 'My 3D WP Tag Cloud',			
			'tooltip_status' => 'on',			
			'width' => '260',			

			'active_cursor' => 'pointer',
			'animation_timing' => 'Smooth',
			'bg_color' => '',
			'bg_outline' => '',
			'bg_outline_thickness' => '0',
			'bg_radius' => '10',
			'click_to_front' => '1000',
			'deceleration' => '0.98',
			'depth' => '0.5',
			'drag_ctrl' => 'false',
			'drag_threshold' => '4',
			'fadein' => '3000',
			'freeze_active' => 'false',
			'freeze_decel' => 'false',
			'front_select' => 'false',
			'hide_tags' => 'true',
			'image_align' => 'centre',
			'image_mode' => '',
			'image_padding' => '2',
			'image_position' => 'left',
			'image_scale' => '1.0',
			'image_valign' => 'middle',
			'initial_x' => '0',
			'initial_y' => '0',
			'interval' => '20',
			'lock' => 'none',
			'max_brightness' => '1',
			'max_speed' => '0.05',
			'min_brightness' => '0.1',
			'min_speed' => '0',
			'no_mouse' => 'false',
			'no_select' => 'false',
			'no_tags_msg' => 'true',
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
			'pulsate_to' => '0',
			'radius_x' => '1',
			'radius_y' => '1',
			'radius_z' => '1',
			'reverse' => 'true',
			'shadow' => '000000',
			'shadow_blur' => '0',
			'shadow_offset_x' => '1',
			'shadow_offset_y' => '1',
			'shape' => 'sphere',
			'shuffle_tags' => 'false',
			'split_width' => '120',
			'stretch_x' => '1',
			'stretch_y' => '1',
			'text_align' => 'centre',
			'text_color' => '666666',
			'text_font' => '',
			'text_height' => '15',
			'text_optimisation' => 'true',
			'text_scale' => '2',
			'text_valign' => 'middle',
			'tooltip' => '',
			'tooltip_class' => 'tctooltip',
			'tooltip_delay' => '300',
			'weight_from' => '',
			'weight' => 'false',
			'weight_gradient_1' => 'f00',
			'weight_gradient_2' => 'ff0',
			'weight_gradient_3' => '0f0',
			'weight_gradient_4' => '00f',
			'weight_mode' => 'both',
			'weight_size' => '1',
			'weight_size_max' => '20',
			'weight_size_min' => '6',
			'wheel_zoom' => 'true',
			'zoom' => '1',
			'zoom_max' => '3',
			'zoom_min' => '0.3',
			'zoom_step' => '0.05'
		));

		include 's.variables.php';		
		include 's.CP.php'; 
 ?>
		<script type="text/javascript">
		
//------- Initialisation of jQuery widgets for WP Widget's page
        jQuery(window).load(function() {
			var inout = '<?= $check_widget_1; ?>';
			if (inout == '') {
				jQuery( document ).tooltip( 'option', 'disabled', true );
			} 
			else {
				jQuery(function(){
					setTimeout(function() {
						jQuery(".widget-inside").css("border", "1px solid #bbb");
						jQuery("#accordion-1, #wihead").css("visibility", "visible");	
						var tooltip_status = '<?= $tooltip_status; ?>';
						if (tooltip_status == 'on'){
							jQuery('#accordion-1, #wihead').tooltip( {show: {effect: 'fade', duration: 300}, hide: {effect: 'fade', duration: 50}, tooltipClass: 'custom-tooltip-styling'});
						}
						else {jQuery('#accordion-1, #wihead').tooltip( {show: {effect: 'fade', duration: 300}, hide: {effect: 'fade', duration: 50}, tooltipClass: 'custom-tooltip-styling', position: { my: 'left-300 top',  at: 'left bottom',  of: 'body'}});};			
					}, 250)
				});
			}
        });	
		</script>
<?php
	}
}
// Registering Widget
function wpTagCanvasLoad() {
    register_widget( 'wpTagCanvasWidget' );    
}
add_action('widgets_init', 'wpTagCanvasLoad');