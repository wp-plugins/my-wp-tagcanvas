// 3D WP Tag Cloud-S: JS Functions
					
jQuery(function(){    
//----- Time out for loading Google Fonts ----
	setTimeout(function() {
	
//----- Preparing variables for various purposes -----
		var container = ['uni_tags_container_<?= $inst_id; ?>'];
		var content = ['<?= $taxonomy; ?>'];
		var cf_name = '<?= $cf_name; ?>';
		if(cf_name != ''){
			var zoom = false; 
			if(cf_name!='my_cf'){
				cf_name+= <?= $inst_id; ?>;
			};
		}
		else {var zoom = true;};
		var multiple_fonts = '<?= $multiple_fonts; ?>'+','+'<?= $multiple_fonts_g; ?>';
		var mf_array = multiple_fonts.split(',');
		var multiple_colors = '<?= $multiple_colors; ?>';
		multiple_colors = multiple_colors.replace(/ /gi, '');
		var mc_array = multiple_colors.split(',');
		var multiple_bg = '<?= $multiple_bg; ?>';
		multiple_bg = multiple_bg.replace(/ /gi, '');
		var mb_array = multiple_bg.split(',');
				
//----- Weighting Links and Recent Posts according to their order of appearance -----
		for (var i = 0; i < container.length; i++) {
			var taxonomy = content[i];
			var any_type_tags = jQuery('#'+container[i]+' a');		
			if((taxonomy=="links")||(taxonomy=="recent_posts")){
				var bigest = <?= $weight_size; ?>*6;
				var increment = (bigest-6)/any_type_tags.length;
				for (var j = 0; j < any_type_tags.length; j++) { 
					var fsize = Math.round(bigest-increment*j);
					jQuery('#'+container[i]+' a').eq(j).css({'font-size':fsize+'px'});
				}
			}
			
//----- Weighting Archives according to the number of publications in them -----
			if(taxonomy=="archives"){
			var link_span = jQuery('#'+container[i]+' span');
			for (var j = 0; j < link_span.length; j++) { 
				var text_s = jQuery('#'+container[i]+' span').eq(j).text();
				var text_a = jQuery('#'+container[i]+' span a').eq(j).text();
				var weight_value = text_s.substring(text_a.length+2,text_s.length-1);
				jQuery('#'+container[i]+' span a').eq(j).text(text_s);
				jQuery('#'+container[i]+' span a').eq(j).css({'font-size': weight_value+'px'});		
			}
			var clear_links = jQuery('#'+container[i]+' span a').detach();
			jQuery('#'+container[i]+' span').remove();
			jQuery(clear_links).appendTo('#'+container[i]);								
			}
			
//-----  Adding image size attributes for Menu content -----
			if(taxonomy=="menu"){
			var link_img = jQuery('#'+container[i]+' a img');
			for (var j = 0; j < link_img.length; j++) { 
				jQuery('#'+container[i]+' div ul li a img').eq(j).attr({"width":"96","height":"96"});
			}							
			}
			
//----- Distributing multiple fonts on random way -----
			if(multiple_fonts!=''){
				for (var j = 0; j < any_type_tags.length; j++) { 
					jQuery('#'+container[i]+' a').eq(j).css({'font-family':mf_array[Math.floor(Math.random()*mf_array.length)]});
				}
			}

//----- Distributing multiple colors on random way -----
			if(multiple_colors!=''){
				for (var j = 0; j < mc_array.length; j++) {
					mc_array[j] = '#'+ mc_array[j];
				}
				for (var j = 0; j < any_type_tags.length; j++) { 
					jQuery('#'+container[i]+' a').eq(j).css({'color':mc_array[Math.floor(Math.random()*mc_array.length)]});
				}
			}

//----- Distributing multiple backgrounds on random way -----
			if(multiple_bg!=''){
				for (var j = 0; j < mb_array.length; j++) {
					mb_array[j] = '#'+ mb_array[j];
				}
				for (var j = 0; j < any_type_tags.length; j++) { 
					jQuery('#'+container[i]+' a').eq(j).css({'background-color':mb_array[Math.floor(Math.random()*mb_array.length)]});
				}
			}
		}

//----- Variables for Single tag cloud and starting it -----
			var bg_img_url = '<?= $bg_img_url; ?>';
			var text_font = '<?= $text_font; ?>';				
			var google_font = '<?= $google_font; ?>';
			if(google_font!='') {text_font = google_font};
			
			var bg_color = '<?= $bg_color; ?>';			
			if((bg_color!='')&&(bg_color!='null')&&(bg_color!='tag')){bg_color = '#'+bg_color;};
			if((bg_color=='')||(bg_color=='null')) {bg_color = null;}
			else {TagCanvas.bgColour = bg_color;};
			var bg_outline = '<?= $bg_outline; ?>';
			if((bg_outline!='')&&(bg_outline!='null')&&(bg_outline!='tag')){bg_outline = '#'+bg_outline;};
			if((bg_outline=='')||(bg_outline=='null')) {bg_outline = null;} 
			else {TagCanvas.bgOutline = bg_outline;};
			var click_to_front = <?= $click_to_front ?>;
			var text_color = '#<?= $text_color; ?>';
			if(text_color=='#') {text_color = null;};
			var weight_gradient_1 = '<?= $weight_gradient_1; ?>';
			var weight_gradient_2 = '<?= $weight_gradient_2; ?>';
			var weight_gradient_3 = '<?= $weight_gradient_3; ?>';
			var weight_gradient_4 = '<?= $weight_gradient_4; ?>';
			if((weight_gradient_1 == '')||(weight_gradient_2 == '')||(weight_gradient_3 == '')||(weight_gradient_4 == '')){}
			else {var weight_gradient = {0:'#<?= $weight_gradient_1; ?>', 0.33:'#<?= $weight_gradient_2; ?>', 0.67:'#<?= $weight_gradient_3; ?>', 1:'#<?= $weight_gradient_4; ?>'};
			}
		
			var single_cloud_options ={
				activeCursor: '<?= $active_cursor; ?>',						
				animTiming: '<?= $animation_timing; ?>',
				bgColour: bg_color,
				bgOutline: bg_outline,
				bgOutlineThickness: <?= $bg_outline_thickness; ?>,	
				bgRadius: <?= $bg_radius; ?>,
				centreFunc: window[cf_name],
				clickToFront: <?= $click_to_front; ?>,
				decel: <?= $deceleration; ?>,					
				depth: <?= $depth; ?>,
				dragControl: <?= $drag_ctrl; ?>,
				dragThreshold: <?= $drag_threshold; ?>,	
				fadeIn: <?= $fadein; ?>,
				freezeActive: <?= $freeze_active; ?>,
				freezeDecel: <?= $freeze_decel; ?>,	
				frontSelect: <?= $front_select; ?>,
				hideTags: <?= $hide_tags; ?>,		
				imageAlign: '<?= $image_align; ?>',
				imageMode: '<?= $image_mode; ?>',
				imagePadding: <?= $image_padding; ?>,
				imagePosition: '<?= $image_position; ?>',
				imageScale: <?= $image_scale; ?>,
				imageVAlign: '<?= $image_valign; ?>',				
				initial: [<?= $initial_x ?>,<?= $initial_y ?>],							
				interval: <?= $interval; ?>,
				lock: '<?= $lock; ?>',
				maxBrightness: <?= $max_brightness; ?>,
				maxSpeed: <?= $max_speed; ?>,
				minBrightness: <?= $min_brightness; ?>,
				minSpeed: <?= $min_speed; ?>,	
				noMouse: <?= $no_mouse; ?>,
				noSelect: <?= $no_select; ?>,	
				noTagsMessage: <?= $no_tags_msg; ?>,	
				offsetX: <?= $offset_x; ?>,
				offsetY: <?= $offset_y; ?>,					
				outlineColour: '#<?= $outline_color; ?>',					
				outlineIncrease: <?= $outline_increase; ?>,		
				outlineMethod: '<?= $outline_method; ?>',					
				outlineOffset: <?= $outline_offset; ?>,
				outlineRadius: <?= $outline_radius; ?>,						
				outlineThickness: <?= $outline_thickness; ?>,	
				padding: <?= $padding; ?>,	
				pulsateTime: <?= $pulsate_time; ?>,		
				pulsateTo: <?= $pulsate_to; ?>,
				radiusX: <?= $radius_x; ?>,	
				radiusY: <?= $radius_y; ?>,	
				radiusZ: <?= $radius_z; ?>,	
				reverse: <?= $reverse; ?>,	
				shadow: '#<?= $shadow; ?>',	
				shadowBlur: <?= $shadow_blur; ?>,
				shadowOffset: [<?= $shadow_offset_x ?>,<?= $shadow_offset_y ?>],
				shape: '<?= $shape; ?>',	
				shuffleTags: <?= $shuffle_tags; ?>,		
				splitWidth: <?= $split_width; ?>,
				stretchX: <?= $stretch_x; ?>,
				stretchY: <?= $stretch_y; ?>,
				textAlign: '<?= $text_align; ?>',
				textColour: text_color,
				textFont: text_font,	
				textHeight: <?= $text_height; ?>,
				textVAlign: '<?= $text_valign; ?>',
				tooltip: '<?= $tooltip; ?>',
				tooltipClass: '<?= $tooltip_class; ?>',	
				tooltipDelay: <?= $tooltip_delay; ?>,
				txtOpt: <?= $text_optimisation; ?>,
				txtScale: <?= $text_scale; ?>,
				weight: <?= $weight; ?>,
				weightFrom: '<?= $weight_from; ?>',	
				weightGradient: weight_gradient,
				weightMode: '<?= $weight_mode; ?>',
				weightSize: <?= $weight_size; ?>,
				weightSizeMax: <?= $weight_size_max; ?>,
				weightSizeMin: <?= $weight_size_min; ?>,
				wheelZoom: zoom,
				zoom: <?= $zoom; ?>,			
				zoomMax: <?= $zoom_max; ?>,	
				zoomMin: <?= $zoom_min; ?>,
				zoomStep: <?= $zoom_step; ?>
			}
			if(bg_img_url != '') {jQuery('#tag_canvas_<?= $inst_id; ?>').css({'background-image': 'url("'+bg_img_url+'")'}).hide().fadeIn(1000);};
			TagCanvas.Start('tag_canvas_<?=$inst_id; ?>','uni_tags_container_<?= $inst_id; ?>', single_cloud_options);			
		
//----- Freezing animation till loading next page -----
		jQuery('#uni_tags_container_<?= $inst_id; ?> a').click(function(){
				TagCanvas.Pause('tag_canvas_<?=$inst_id; ?>');
		});	
	}, 0);
});