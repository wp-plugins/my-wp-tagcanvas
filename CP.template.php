<?php 
/*
3D Tag Canvas (HTML Control Panel Template)
*/
?>
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<link rel="stylesheet" href="<?php echo plugins_url( 'css/3D.WP.Tag.Cloud.css' , __FILE__ ) ?>">
	<script src="<?php echo plugins_url( 'js/jquery-ui.min.js' , __FILE__ ) ?>"></script>
	<style>.widget-inside {padding:0!important; border-radius: 4px;};</style>
	<script type="text/javascript">
		$(document).tooltip({content: function() {var element = $( this ); var html_text=element.attr('title'); return html_text;}, position: {  my: 'left top+20',  at: 'left bottom'}}); 
		$(function() {$( "#accordion" ).accordion({heightStyle: "content", collapsible: true, active: 0});});
	</script>
	
<div id="tabs" style="-webkit-text-size-adjust: 100%; padding: 0; border: 0;">
	<ul style=" margin-bottom: 10px; font-size: 12px; text-align: center!important; border-bottom-right-radius: 0; border-bottom-left-radius: 0;">
		<li><a href="#fragment-1">General<br>Settings</a></li>
		<li><a href="#fragment-2">Tag<br>Properties</a></li>
		<li><a href="#fragment-3">Action<br>Settings</a></li>
		<li><a href="#fragment-4">Help<br>&nbsp;</a></li>
		<div style="font-size: 11px; font-weight: normal; padding: 8px 0;" for="<?=$this->get_field_id('tooltip_status'); ?>">Settings Tooltips<br>
					
						<input style="margin: 0;" title="Turns on Settings Tooltips." class="radio" id="<?=$this->get_field_id('tooltip_status'); ?>"
						name="<?=$this->get_field_name('tooltip_status'); ?>" type="radio" value="on" 
						<?php if( $tooltip_status == "on" ){ echo ' checked="checked"'; } ?> onclick="$(document).tooltip({content: function() {var element = $( this ); var html_text=element.attr('title'); return html_text;}, position: {  my: 'left top+20',  at: 'left bottom'}}); ">on
						
						<input style="margin: 0;" title="Turns off settings' tooltips." class="radio" id="<?=$this->get_field_id('tooltip_status'); ?>"						name="<?=$this->get_field_name('tooltip_status'); ?>" type="radio" value="off"
						<?php if( $tooltip_status == "off" ){ echo ' checked="checked"'; } ?> onclick="$(document).tooltip({position: { my: 'left-300 top', at: 'left bottom',  of: 'body'}});">off
					
		</div>
	</ul>

	<div id="fragment-1">
		<table>
			<thead>
				<tr>
					<th colspan="3">WIDGET
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="padding-bottom: 5px;">
						<label title="Title of the widget instance" for="<?=$this->get_field_id('title'); ?>">
							<span>Title</span> 
							<input style="width: 200px;"
							class="widefat" id="<?=$this->get_field_id('title'); ?>"
							name="<?=$this->get_field_name('title'); ?>" type="text"
							value="<?php echo $title; ?>" />
						</label>
					</td>
					<td style="padding-bottom: 5px;">
						<label title="Widget's width (in pixels). Defaults to 260." for="<?=$this->get_field_id('width'); ?>" style="width: 65px;">
							<span>Width</span> 
							<input
							class="widefat" id="<?=$this->get_field_id('width'); ?>"
							name="<?=$this->get_field_name('width'); ?>" type="text"
							value="<?php echo $width; ?>" />px
						</label>
					</td style="padding-bottom: 5px;">
					<td style="padding-bottom: 5px;">
						<label title="Widget's height (in pixels). Defaults to 260." for="<?=$this->get_field_id('height'); ?>" style="width: 65px;">
							<span>Height</span> 
							<input
							class="widefat" id="<?=$this->get_field_id('height'); ?>"
							name="<?=$this->get_field_name('height'); ?>" type="text"
							value="<?php echo $height; ?>" style="width: 45px" />px
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table style="margin: 0 1px 1px;">
			<thead>
				<tr>
					<th colspan="2">CLOUD
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="2" style="border-bottom: 1px solid #aaa; padding-bottom: 5px;">
						<div title="The shape of the cloud">
							<span>Shape</span>
						</div>
						<div style="float: left;">
							<input style="margin: 0;" title="Sphere [Default]" class="radio" id="<?=$this->get_field_id('shape'); ?>"
							name="<?=$this->get_field_name('shape'); ?>" type="radio" value="sphere"   
							<?php if( $shape == "sphere" ){ echo ' checked="checked"'; } ?>>sphere
							
							<input style="margin: 0 0 0 3px;" title="Cylinder that starts off horizontal" class="radio" id="<?=$this->get_field_id('shape'); ?>"
							name="<?=$this->get_field_name('shape'); ?>" type="radio" value="hcylinder"
							<?php if( $shape == "hcylinder" ){ echo ' checked="checked"'; } ?>>hcylinder
							
							<input style="margin: 0 0 0 3px;" title="Cylinder that starts off vertical" class="radio" id="<?=$this->get_field_id('shape'); ?>"
							name="<?=$this->get_field_name('shape'); ?>" type="radio" value="vcylinder"
							<?php if( $shape == "vcylinder" ){ echo ' checked="checked"'; } ?>>vcylinder
							
							<input style="margin: 0 0 0 3px;" title="Horizontal circle" class="radio" id="<?=$this->get_field_id('shape'); ?>"
							name="<?=$this->get_field_name('shape'); ?>" type="radio" value="hring"
							<?php if( $shape == "hring" ){ echo ' checked="checked"'; } ?>>hring
							
							<input style="margin: 0 0 0 3px;" title="Vertical circle" class="radio" id="<?=$this->get_field_id('shape'); ?>"
							name="<?=$this->get_field_name('shape'); ?>" type="radio" value="vring"
							<?php if( $shape == "vring" ){ echo ' checked="checked"'; } ?>>vring
						</div>
					</td>
				</tr>
				<tr>
					<td style="width: 111px; border-bottom: 1px solid #aaa; padding: 0 5px 5px 0;">
						<label for="<?=$this->get_field_id('taxonomy'); ?>">
							<span>Content</span>
							<div><div>
								<input  class="radio" style="margin: 0 5px 0 1px;" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays most recent posts. Font Size weighting is provided for all <span style='font-weight: bold; color: #063;'>Weight Mode</span> options except for <span style='font-weight: bold; color: #063;'>none</span>. As older a post is, as smaller its title font is."
								name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="recent_posts"
								<?php if( $taxonomy == "recent_posts" ){ echo ' checked="checked"'; } ?>>recent posts
								<span style="font-size: 18px; line-height: 12px; float: right; padding: 0 1px 0 0;">&#8594;</span>
								<br>
							
								<input  class="radio" style="margin: 15px 5px 15px 1px;" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays bookmarks found in the WP Admin Panel: <span style='font-weight: bold; color: #063;'>Links</span>. Font Size weighting is provided for all  <span style='font-weight: bold; color: #063;'>Weight Mode</span> options except for <span style='font-weight: bold; color: #063;'>none</span>. Font size of the Links is calculated in accordance with their position in the list: The last in it has the smallest font size."
								name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="links"									
								<?php if( $taxonomy == "links" ){ echo ' checked="checked"'; } ?>>links
								<span style="font-size: 18px; line-height: 12px; float: right; padding: 12px 1px 0 0;">&#8594;</span>
								<br>
								
								<input style="margin: 0 5px 0 0;" class="radio" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays a navigation menu created via WP Admin Panel:  <span style='font-weight: bold; color: #063;'>Appearance</span> <span style='font-size: 18px;'>&#8594;</span>  <span style='font-weight: bold; color: #063;'>Menus</span>. <span style='font-weight: bold; color: #063;'>Weight Mode</span> is not applicable to this option."
								name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="menu"
								<?php if( $taxonomy == "menu" ){ echo ' checked="checked"'; } ?>>menu
								<span style="font-size: 18px; line-height: 12px; float: right; padding: 0 1px 0 0;">&#8594;</span>
								<br>
								</div>
								<div style="border: 1px dotted #aaa; border-radius: 5px; padding-right: 1px; display: block; margin: 14px 0">									
									<input style="margin: 0;" class="radio" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays a list of post tags."
									name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="post_tag"
									<?php if( $taxonomy == "post_tag" ){ echo ' checked="checked"'; } ?>>post tags<span style="font-size: 18px; float: right; line-height: 12px; padding-top: 1px;">&#8594;</span>
									<br>
								
									<input style="margin: 15px 5px 15px 0;" class="radio" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays a list of categories created in the WP Admin Panel: <span style='font-weight: bold; color: #063;'>Posts</span> <span style='font-size: 18px;'>&#8594;</span>  <span style='font-weight: bold; color: #063;'>Categories</span>."
									name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="category"
									<?php if( $taxonomy == "category" ){ echo ' checked="checked"'; } ?>>categories
									<br>
									
									<input class="radio" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays a list of post tags & categories."
									name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="both"
									<?php if( $taxonomy == "both" ){ echo ' checked="checked"'; } ?>>both
								</div>
								
									<input style="margin: 0 5px 0 1px;" class="radio" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays a list of archives."
									name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="archives"
									<?php if( $taxonomy == "archives" ){ echo ' checked="checked"'; } ?>>archives
									<span style="font-size: 18px; line-height: 12px; float: right; padding: 0 1px 0 0;">&#8594;</span>
									<br>
									<input style="margin: 15px 0 15px 1px;" class="radio" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays a list of authors."
									name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="authors"
									<?php if( $taxonomy == "authors" ){ echo ' checked="checked"'; } ?>>authors
									<span style="font-size: 18px; line-height: 12px;  float: right; padding: 12px 1px 0 0;">&#8594;</span>
									<br>								
									<input style="margin: 0 5px 0 1px;" class="radio" id="<?=$this->get_field_id('taxonomy'); ?>" title="Displays a list of pages. <span style='font-weight: bold; color: #063;'>Weight Mode</span> is not applicable to this option."
									name="<?=$this->get_field_name('taxonomy'); ?>" type="radio" value="pages"
									<?php if( $taxonomy == "pages" ){ echo ' checked="checked"'; } ?>>pages
							</div>
						</label>
					</td >
					<td style="border-bottom: 1px solid #aaa; vertical-align: top;">
						<div>
							<label title="Comma separated list of Posts Category IDs to be displayed. If none is specified, the most recent posts from all Categories are shown." for="<?=$this->get_field_id('rp_category_id'); ?>" style="width: 120px; margin: 0 5px 0 0; line-height: 13px;">
								<span>Posts&#039; Categories</span> 
								<input style="width: 120px;"
								class="widefat" style="padding: 2px" id="<?=$this->get_field_id('rp_category_id'); ?>"
								name="<?=$this->get_field_name('rp_category_id'); ?>" type="text"
								value="<?php echo $rp_category_id; ?>" />
							</label>
							<label title="Number of recent posts to display. Defaults to 10. Negative numbers are taken by their absolute value. 0 returns the default number without weighting." for="<?=$this->get_field_id('recent_posts'); ?>" style="display: block; float: none; line-height: 13px; margin-top: 2px;">
								<span>Number of Posts</span> 
								<input
								class="widefat" id="<?=$this->get_field_id('recent_posts'); ?>"
								name="<?=$this->get_field_name('recent_posts'); ?>" type="text"
								value="<?php echo $recent_posts; ?>" />
							</label>
							<label title="Comma separated list of Links Category IDs to be displayed. If none is specified, all Categories with bookmarks are shown." for="<?=$this->get_field_id('links_category_id'); ?>" style="width: 120px; margin: 0 5px 0 0; line-height: 13px;">
								<span>Links&#039; Categories</span> 
								<input style="width: 120px;"
								class="widefat" style="padding: 2px" id="<?=$this->get_field_id('links_category_id'); ?>"
								name="<?=$this->get_field_name('links_category_id'); ?>" type="text"
								value="<?php echo $links_category_id; ?>" />
							</label>
							<label title="Number of links to display. The default value (-1) loads all." for="<?=$this->get_field_id('links'); ?>" style="display: block; float: none; line-height: 13px;">
								<span>Number of Links</span> 
								<input
								class="widefat" id="<?=$this->get_field_id('links'); ?>"
								name="<?=$this->get_field_name('links'); ?>" type="text"
								value="<?php echo $links; ?>" />
							</label>
							<label title="The menu that is desired. Accepts (matching in order) id, slug, name. If not specified Primary Menu is shown." for="<?=$this->get_field_id('menu'); ?>" style="clear: both; width: 45px; line-height: 13px;">
								<span>Menu</span> 
								<input
								class="widefat" style="padding: 2px" id="<?=$this->get_field_id('menu'); ?>"
								name="<?=$this->get_field_name('menu'); ?>" type="text"
								value="<?php echo $menu; ?>" />
							</label>
							<br style="clear: both" />
						</div>
						<label title="Number of tags to display. Defaults to 45." for="<?=$this->get_field_id('tags'); ?>" style="width: 140px; line-height: 13px;">
							<span style="margin-right: 5px;">Number of Post Tags</span> 
							<input
							class="widefat" id="<?=$this->get_field_id('tags'); ?>"
							name="<?=$this->get_field_name('tags'); ?>" type="text"
							value="<?php echo $tags; ?>" />
						</label>
						<label title="Number of archives to get. Empty (Default) for no limit." for="<?=$this->get_field_id('archives_limit'); ?>" style="width: 140px; line-height: 13px; margin-top: 48px;">
							<span style="margin-right: 5px;">Number of Archives</span> 
							<input
							class="widefat" id="<?=$this->get_field_id('archives_limit'); ?>"
							name="<?=$this->get_field_name('archives_limit'); ?>" type="text"
							value="<?php echo $archives_limit; ?>" />
						</label>
						<label title="Number of authors to get. Empty (Default) for no limit." for="<?=$this->get_field_id('authors_limit'); ?>" style="width: 120px; line-height: 13px;">
							<span style="margin-right: 5px;">Number of Authors</span> 
							<input
							class="widefat" id="<?=$this->get_field_id('authors_limit'); ?>"
							name="<?=$this->get_field_name('authors_limit'); ?>" type="text"
							value="<?php echo $authors_limit; ?>" />
						</label>
						<div title="Exclude Administrators from Authors List." style="float: left;">
							<div>
								<span>Exclude Admins</span>
							</div>
							<div  style="float: left; line-height: 13px;">
								<input style="margin: 0;" class="radio" id="<?=$this->get_field_id('exclude_admin'); ?>"
								name="<?=$this->get_field_name('exclude_admin'); ?>" type="radio" value="false"
								<?php if( $exclude_admin == "false" ){ echo ' checked="checked"'; } ?>>false
									
								<input style="margin: 0 0 0 5px;" class="radio" id="<?=$this->get_field_id('exclude_admin'); ?>"
								name="<?=$this->get_field_name('exclude_admin'); ?>" type="radio" value="true"
								<?php if( $exclude_admin == "true" ){ echo ' checked="checked"'; } ?>>true 
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td style="border-right: 1px solid #aaa; padding-bottom: 2px;";>
						<label for="<?=$this->get_field_id('outline_method'); ?>" title="Type of highlight to use">
							<span>Outline Method</span>
							<div>
								<input title="An outline at the same depth as the active tag" class="radio" id="<?=$this->get_field_id('outline_method'); ?>"
								name="<?=$this->get_field_name('outline_method'); ?>" type="radio" value="outline"
								<?php if( $outline_method == "outline" ){ echo ' checked="checked"'; } ?>>outline
								<br> 								
								
								<input title="Old-style outline on top of all tags" class="radio" id="<?=$this->get_field_id('outline_method'); ?>"
								name="<?=$this->get_field_name('outline_method'); ?>" type="radio" value="classic"
								<?php if( $outline_method == "classic" ){ echo ' checked="checked"'; } ?>>classic
								<br> 
								
								<input title="Solid block of colour around the active tag" class="radio" id="<?=$this->get_field_id('outline_method'); ?>"
								name="<?=$this->get_field_name('outline_method'); ?>" type="radio" value="block"
								<?php if( $outline_method == "block" ){ echo ' checked="checked"'; } ?>>block
								<br>
								
								<input title="Changes the colour of the text or image of the current tag to the <span style='font-weight: bold; color: #063;'>outlineColour</span> value." class="radio" id="<?=$this->get_field_id('outline_method'); ?>"
								name="<?=$this->get_field_name('outline_method'); ?>" type="radio" value="colour"
								<?php if( $outline_method == "colour" ){ echo ' checked="checked"'; } ?>>colour
								<br>
								
								<input title="Increases the size of the tag, using the <span style='font-weight: bold; color: #063;'>outlineIncrease</span> option for the amount." class="radio" id="<?=$this->get_field_id('outline_method'); ?>"
								name="<?=$this->get_field_name('outline_method'); ?>" type="radio" value="size"	
								<?php if( $outline_method == "size" ){ echo ' checked="checked"'; } ?>>size
								<br/ > 
								
								<input title="No highlighting at all" class="radio" id="<?=$this->get_field_id('outline_method'); ?>"
								name="<?=$this->get_field_name('outline_method'); ?>" type="radio" value="none"
								<?php if( $outline_method == "none" ){ echo ' checked="checked"'; } ?>>none
							</div>
						</label>
					</td>
					<td style="vertical-align: top;">
						<table style="width: 100%; border: 0; margin: 0;">
							<tr>
								<td style="padding-right: 20px;">
									<label for="<?=$this->get_field_id('weight_mode'); ?>" title="Method to use for displaying tag weights">
										<span>Weight Mode</span>
										<div style="border: 1px dotted #aaa; border-radius: 5px;">
											<input title="Display more significant tags in a larger font size." class="radio" id="<?=$this->get_field_id('weight_mode'); ?>"
											name="<?=$this->get_field_name('weight_mode'); ?>" type="radio" value="size"
											<?php if( $weight_mode == "size" ){ echo ' checked="checked"'; } ?>>size
											<br> 
											
											<input title="Display tags using colour values from an automatically calculated gradient based on <span style='color: #063;'>Popular tag</span> color." class="radio" id="<?=$this->get_field_id('weight_mode'); ?>"
											name="<?=$this->get_field_name('weight_mode'); ?>" type="radio" value="colour"
											<?php if( $weight_mode == "colour" ){ echo ' checked="checked"'; } ?>>color
											<br> 
											
											<input title="Use both <span style='font-weight: bold; color: #063;'>size</span> and <span style='font-weight: bold; color: #063;'>colour</span> to visualise weights." class="radio" id="<?=$this->get_field_id('weight_mode'); ?>"
											name="<?=$this->get_field_name('weight_mode'); ?>" type="radio" value="both"
											<?php if( $weight_mode == "both" ){ echo ' checked="checked"'; } ?>>both
										</div>
										
										<input title="Use <span style='color: #063;'>Gradient Colors</span> to set the tag background colour." class="radio" id="<?=$this->get_field_id('weight_mode'); ?>"
										name="<?=$this->get_field_name('weight_mode'); ?>" type="radio" value="bgcolour"											
										<?php if( $weight_mode == "bgcolour" ){ echo ' checked="checked"'; } ?>>bgcolor
										<br> 
										
										<input title="Use a <span style='color: #063;'>Gradient Colors</span> to set the tag background outline colour. Tag background outlines must be enabled using the <span style='font-weight: bold; color: #063;'>Bg Outline Thickness</span> option." class="radio" id="<?=$this->get_field_id('weight_mode'); ?>"
										name="<?=$this->get_field_name('weight_mode'); ?>" type="radio" value="bgoutline"
										<?php if( $weight_mode == "bgoutline" ){ echo ' checked="checked"'; } ?>>bgoutline
										<br>
										
										<input title="Use this option to turn off weighting of tags. It can be used also for weighting of links and recent posts." class="radio" id="<?=$this->get_field_id('weight_mode'); ?>"
										name="<?=$this->get_field_name('weight_mode'); ?>" type="radio" value="none"
										<?php if( $weight_mode == "none" ){ echo ' checked="checked"'; } ?>>none
									</label>							
								</td>
								<td style="width: 116px; vertical-align: top;">
									<label style="width: 70px;" for="<?=$this->get_field_id('weight_size'); ?>">
										<span>Size Weight</span>
										<input style="margin-bottom: 10px;" title="Multiplier for adjusting the size of tags when using a weight mode of <span style='font-weight: bold; color: #063;'>size</span> or <span style='font-weight: bold; color: #063;'>both</span>." class="widefat" id="<?=$this->get_field_id('weight_size'); ?>"
										name="<?=$this->get_field_name('weight_size'); ?>" type="text"
										value="<?php echo $weight_size; ?>" /> 
									</label>
									<label for="<?=$this->get_field_id('weight_from'); ?>">
										<span>Weight from...</span>
										<input style="width: 110px;" title="The link attribute to take the tag weight from. If this option is empty the weight will be taken from the calculated link font size." class="widefat" id="<?=$this->get_field_id('weight_from'); ?>"
										name="<?=$this->get_field_name('weight_from'); ?>" type="text"
										value="<?php echo $weight_from; ?>" /> 
									</label>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		<table  style="margin: 10px 1px 1px;">
			<thead>
				<tr>
					<th colspan="3">CLOUD ATTRIBUTES & PROPERETIES
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="3" style="border-bottom: 1px solid #aaa; padding-bottom: 5px;">
						<div title="The CSS cursor type to use when the mouse is over a tag." style="font-weight: bold;">Cursor</div>
						<div style="float: left; margin-right: 16px;">
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
						<div style="float: left; margin-right: 16px;">
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
						<div style="float: left; margin-right: 16px;">
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
					</td>
				</tr>
				<tr>
					<td style="width: 150px; vertical-align: top;">
						<div style="float: left;">
							<label for="<?=$this->get_field_id('tooltip'); ?>" title="Sets tooltip display method.">
								<span>Tooltip</span>
								<div>
									<input style="margin: 0;" title="No tooltips" class="radio" id="<?=$this->get_field_id('tooltip'); ?>"
									name="<?=$this->get_field_name('tooltip'); ?>" type="radio" value=""
									<?php if( $tooltip == "" ){ echo ' checked="checked"'; } ?>>none
									
									<input style="margin: 0 0 0 5px;" title="Operating system tooltips" class="radio" id="<?=$this->get_field_id('tooltip'); ?>"
									name="<?=$this->get_field_name('tooltip'); ?>" type="radio" value="native"
									<?php if( $tooltip == "native" ){ echo ' checked="checked"'; } ?>>native
									
									<input style="margin: 0 0 0 5px;" title="div-based tooltips" class="radio" id="<?=$this->get_field_id('tooltip'); ?>"
									name="<?=$this->get_field_name('tooltip'); ?>" type="radio" value="div"
									<?php if( $tooltip == "div" ){ echo ' checked="checked"'; } ?>>div
								</div>
							</label>
						</div>
					</td>
					<td style="width: 86px; padding: 0 10px 5px 0;">
						<div style="float: left;">
							<label title="Class of tooltip div." for="<?=$this->get_field_id('tooltip_class'); ?>">
								<span>Tooltip Class</span> 
								<div>
									<input style="width: 86px;" class="widefat" id="<?=$this->get_field_id('tooltip_class'); ?>"
									name="<?=$this->get_field_name('tooltip_class'); ?>" type="text"
									value="<?php echo $tooltip_class; ?>" />
								</div> 
							</label>
						</div>
					</td>
					<td style="padding: 0 0 5px 0; width: 96px">
						<div style="float: left;">
							<label title="Time to pause while mouse is not moving before displaying tooltip div, in milliseconds." for="<?=$this->get_field_id('tooltip_delay'); ?>">
								<span>Tooltip Delay</span> 
								<div>
									<input class="widefat" id="<?=$this->get_field_id('tooltip_delay'); ?>"
									name="<?=$this->get_field_name('tooltip_delay'); ?>" type="text"
									value="<?php echo $tooltip_delay; ?>" /> msec
								</div> 
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3" style="border-top: 1px solid #aaa; padding-bottom: 5px;">
						<div title="Function for drawing in the center of the cloud. It is passed in following parameters in order: canvas 2D context; canvas width; canvas height; center X; center Y. If you want to use this option you have create a function in advance. The widget comes with one, made for demonstration purpose only." style="width: 100%; float: left"><span style="font-weight: bold;">Center Function</span></div>
						<label title="The name of your <span style='color: #063;'>Central Function</span>. Insert <span style='color: #063;'>CF_demo</span> to see a demo function." for="<?=$this->get_field_id('cf_name'); ?>" style="float: left; width: 80px; margin: 0 5px 0 0;">
							Name
							<input style="width: 100%;"
							class="widefat" id="<?=$this->get_field_id('cf_name'); ?>"
							name="<?=$this->get_field_name('cf_name'); ?>" type="text"
							value="<?php echo $cf_name; ?>" /> 
						</label>
						<label title="URL of a js file containing your <span style='color: #063;'>Central Function</span>. For example:<br>http://your-domain.com/your-js-directory/your-file.js<br>Insert <span style='color: #063;'>js/demo.js</span> to see a demo function." for="<?=$this->get_field_id('cf_url'); ?>" style="float: left; width: 257px;">
							URL 
							<input style="width: 100%;"
							class="widefat" id="<?=$this->get_field_id('cf_url'); ?>"
							name="<?=$this->get_field_name('cf_url'); ?>" type="text"
							value="<?php echo $cf_url; ?>" /> 

					</td>
				</tr>
				<tr>
					<td colspan="3" style="padding-bottom: 5px; border-top: 1px solid #aaa;">
						<label title="Initial size of cloud from centre to sides." for="<?=$this->get_field_id('radius_x'); ?>" style="width: 86px;">
							<span>Radius X</span> 
							<input
							class="widefat" id="<?=$this->get_field_id('radius_x'); ?>"
							name="<?=$this->get_field_name('radius_x'); ?>" type="text"
							value="<?php echo $radius_x; ?>" /> 
						</label>				
						<label title="Initial size of cloud from centre to top and bottom." for="<?=$this->get_field_id('radius_y'); ?>" style="width: 86px;">
							<span>Radius Y</span> 
							<input
							class="widefat" id="<?=$this->get_field_id('radius_y'); ?>"
							name="<?=$this->get_field_name('radius_y'); ?>" type="text"
							value="<?php echo $radius_y; ?>" /> 
						</label>				
						<label title="Initial size of cloud from centre to front and back." for="<?=$this->get_field_id('radius_z'); ?>" style="width: 86px;">
							<span>Radius Z</span> 
							<input
							class="widefat" id="<?=$this->get_field_id('radius_z'); ?>"
							name="<?=$this->get_field_name('radius_z'); ?>" type="text"
							value="<?php echo $radius_z; ?>" />
						</label> 
						<label title="Controls the perspective. Range: 0.0-1.0" style="width: 70px;" for="<?=$this->get_field_id('depth'); ?>">
							<span>Depth</span> 
							<input
							class="widefat" id="<?=$this->get_field_id('depth'); ?>"
							name="<?=$this->get_field_name('depth'); ?>" type="text"
							value="<?php echo $depth; ?>" /> 
						</label>
						<br style="clear: both;"/>
						<label title="Offsets the centre of the cloud vertically (measured in pixels)" for="<?=$this->get_field_id('offset_y'); ?>" style="width: 86px;">
							<span>Offset Y</span> 
							<input
							class="widefat" id="<?=$this->get_field_id('offset_y'); ?>"
							name="<?=$this->get_field_name('offset_y'); ?>" type="text"
							value="<?php echo $offset_y; ?>" /> 
						</label>
						<label title="Offsets the centre of the cloud horizontally (measured in pixels)" for="<?=$this->get_field_id('offset_x'); ?>" style="width: 86px;">
							<span>Offset X</span> 
							<input
							class="widefat" id="<?=$this->get_field_id('offset_x'); ?>"
							name="<?=$this->get_field_name('offset_x'); ?>" type="text"
							value="<?php echo $offset_x; ?>" /> 
						</label>
						<label title="Stretch or compress the cloud horizontally." for="<?=$this->get_field_id('stretch_x'); ?>" style="width: 86px;">
							<span>Stretch X</span> 
							<input
								class="widefat" id="<?=$this->get_field_id('stretch_x'); ?>"
								name="<?=$this->get_field_name('stretch_x'); ?>" type="text"
								value="<?php echo $stretch_x; ?>" /> 
							</label>
						<label title="Stretch or compress the cloud vertically." for="<?=$this->get_field_id('stretch_y'); ?>" style="width: 70px;">
							<span>Stretch Y</span> 
							<input
							class="widefat" id="<?=$this->get_field_id('stretch_y'); ?>"
							name="<?=$this->get_field_name('stretch_y'); ?>" type="text"
							value="<?php echo $stretch_y; ?>" /> 
						</label> 
						<br style="clear: both;" />
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div id="fragment-2">
		<table style="margin: 0 1px 1px;">  
			<thead>
				<tr>
					<th colspan="3">TAG PROPERTIES
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="border-bottom: 1px solid #aaa; padding-bottom: 5px;">
						<label><span style="padding-bottom: 5px;">COLORS</span>
							<div style="padding-top: 10px;">
								<label title="Colour of the tag text - empty string to use the colour of the original link" for="<?=$this->get_field_id('text_color'); ?>">
									<span>Tags</span>
									<br>
									#<input style="width: 55px; margin: 0 5px 0 0;"
									class="widefat" id="<?=$this->get_field_id('text_color'); ?>"
									name="<?=$this->get_field_name('text_color'); ?>" type="text"
									value="<?php echo $text_color; ?>" />
								</label>
								<label title="Background color of tags - empty option means no background. The string <span style='color: #063;'>'tag'</span> means use the original link background colour." for="<?=$this->get_field_id('bg_color'); ?>">
									<span>Background</span>
									<br>
									#<input style="width: 55px; margin: 0 5px 0 0;"
									class="widefat" id="<?=$this->get_field_id('bg_color'); ?>"
									name="<?=$this->get_field_name('bg_color'); ?>" type="text"
									value="<?php echo $bg_color; ?>" /> 
								</label>
								<label title="Colour of the shadow behind each tag" for="<?=$this->get_field_id('shadow'); ?>">
									<span>Shadow</span>
									<br>
									#<input style="width: 55px; margin: 0 5px 0 0;"
									class="widefat" id="<?=$this->get_field_id('shadow'); ?>"
									name="<?=$this->get_field_name('shadow'); ?>" type="text"
									value="<?php echo $shadow; ?>" /> 
								</label>								
								<label title="Colour of the active tag highlight" for="<?=$this->get_field_id('outline_color'); ?>">
									<span>Outline</span>
									<br>
									#<input style="width: 55px; margin: 0 5px 0 0;"
									class="widefat" id="<?=$this->get_field_id('outline_color'); ?>"
									name="<?=$this->get_field_name('outline_color'); ?>" type="text"
									value="<?php echo $outline_color; ?>" /> 
								</label>
								<label title="Colour of tag background outline. Use empty option for the same as the text colour, use <span style='color: #063;'>'tag'</span> for the original link text colour." for="<?=$this->get_field_id('bg_outline'); ?>">
									<span>Bg Outline</span>
									<br>
									#<input style="width: 55px;"
									class="widefat" id="<?=$this->get_field_id('bg_outline'); ?>"
									name="<?=$this->get_field_name('bg_outline'); ?>" type="text"
									value="<?php echo $bg_outline; ?>" /> 
								</label>
								<div>	
									<label title="The colour gradient applied for colouring tags when using a <span style='color: #063;'>Weight Mode</span> of <span style='color: #063;'>colour</span> or <span style='color: #063;'>both</span>. Start with the colour for the &#34;heaviest&#34; tag at 0, and ending at 1 with the least weighty tag colour." for="<?=$this->get_field_id('weight_gradient_1'); ?>" style="padding-top: 10px;">
										<span>Gradient<br>Color: 0</span>
										<br>
										#<input style="width: 55px; margin: 0 5px 0 0;" 
										class="widefat" id="<?=$this->get_field_id('weight_gradient_1'); ?>"
										name="<?=$this->get_field_name('weight_gradient_1'); ?>" type="text"
										value="<?php echo $weight_gradient_1 ?>" /> 
									</label>
									<label title="The colour gradient applied for colouring tags when using a <span style='color: #063;'>Weight Mode</span> of <span style='color: #063;'>colour</span> or <span style='color: #063;'>both</span>. Start with the colour for the &#34;heaviest&#34; tag at 0, and ending at 1 with the least weighty tag colour." for="<?=$this->get_field_id('weight_gradient_2'); ?>" style="padding-top: 10px;">
										<span>Gradient<br>Color: 0.33</span>
										<br>
										#<input style="width: 55px; margin: 0 5px 0 0;" 
										class="widefat" id="<?=$this->get_field_id('weight_gradient_2'); ?>"
										name="<?=$this->get_field_name('weight_gradient_2'); ?>" type="text"
										value="<?php echo $weight_gradient_2 ?>" /> 
									</label>
									<label title="The colour gradient applied for colouring tags when using a <span style='color: #063;'>Weight Mode</span> of <span style='color: #063;'>colour</span> or <span style='color: #063;'>both</span>. Start with the colour for the &#34;heaviest&#34; tag at 0, and ending at 1 with the least weighty tag colour." for="<?=$this->get_field_id('weight_gradient_3'); ?>" style="padding-top: 10px;">
										<span>Gradient<br>Color: 0.67</span>
										<br>
										#<input style="width: 55px; margin: 0 5px 0 0;" 
										class="widefat" id="<?=$this->get_field_id('weight_gradient_3'); ?>"
										name="<?=$this->get_field_name('weight_gradient_3'); ?>" type="text"
										value="<?php echo $weight_gradient_3 ?>" /> 
									</label>
									<label title="The colour gradient applied for colouring tags when using a <span style='color: #063;'>Weight Mode</span> of <span style='color: #063;'>colour</span> or <span style='color: #063;'>both</span>. Start with the colour for the &#34;heaviest&#34; tag at 0, and ending at 1 with the least weighty tag colour." for="<?=$this->get_field_id('weight_gradient_4'); ?>" style="padding-top: 10px;">
										<span>Gradient<br>Color: 1</span>
										<br>
										#<input style="width: 55px; margin: 0;" 
										class="widefat" id="<?=$this->get_field_id('weight_gradient_4'); ?>"
										name="<?=$this->get_field_name('weight_gradient_4'); ?>" type="text"
										value="<?php echo $weight_gradient_4 ?>" /> 
									</label>
								</div>
								<label style="padding: 25px 0 0 10px;">
										<a style="color:#1e8cbe; font-weight: bold;" href="http://www.goat1000.com/tagcanvas-weighted.php" target="_blank">Gradient<br>Examples</a>
								</label>
								<div>
								<label title="Colors that will be spread in a random way to your cloud content. Insert hex values without #, separated by coma. To use this function you have to empty the above <span style='color: #063;'>Tags</span> field and switch <span style='color: #063;'>Weight Mode</span> to <span style='color: #063;'>size</span> or <span style='color: #063;'>none</span>." style="margin-top: 10px; width: 342px;" for="<?=$this->get_field_id('multiple_colors'); ?>">
									<span>Multiple Colors (hex, no #)</span>
									<input style="width: 100%;"
									class="widefat" id="<?=$this->get_field_id('multiple_colors'); ?>"
									name="<?=$this->get_field_name('multiple_colors'); ?>" type="text"
									value="<?php echo $multiple_colors; ?>" /> 
								</label>
							</div>
							<div>
								<label title="Tag background colors that will be spread in a random way to your cloud content. Insert hex values without #, separated by coma. To use this function type <span style='color: #063;'>tag</span> in the <span style='color: #063;'>Background</span> field above and switch <span style='color: #063;'>Weight Mode</span> to <span style='color: #063;'>size</span> or <span style='color: #063;'>none</span>." style="margin-top: 10px; width: 342px;" for="<?=$this->get_field_id('multiple_bg'); ?>">
									<span>Multiple Backgrounds (hex, no #)</span>
									<input style="width: 100%;"
									class="widefat" id="<?=$this->get_field_id('multiple_bg'); ?>"
									name="<?=$this->get_field_name('multiple_bg'); ?>" type="text"
									value="<?php echo $multiple_bg; ?>" /> 
								</label>
							</div>
							</div>

						</label>		
					</td>
				</tr>
				<tr>
					<td>
						<label><span>SIZES</span>
							<div style="padding-top: 10px;">
								<label title="Height of the tag text font" style="width: 25%;" for="<?=$this->get_field_id('text_height'); ?>">
									<span>Tag Height</span>
									<input
									class="widefat" id="<?=$this->get_field_id('text_height'); ?>"
									name="<?=$this->get_field_name('text_height'); ?>" type="text"
									value="<?php echo $text_height; ?>" />px 
								</label>
								<label title="Amount of space around text and inside background" style="width: 25%; padding-bottom: 10px;" for="<?=$this->get_field_id('padding'); ?>">
									<span>Padding</span>
									<input
									class="widefat" id="<?=$this->get_field_id('padding'); ?>"
									name="<?=$this->get_field_name('padding'); ?>" type="text"
									value="<?php echo $padding; ?>" />px 
								</label>
								<label title="Amount of tag shadow blurring" style="width: 25%; padding-bottom: 10px;" for="<?=$this->get_field_id('shadow_blur'); ?>">
									<span>Shadow Blur</span>
									<input
									class="widefat" id="<?=$this->get_field_id('shadow_blur'); ?>"
									name="<?=$this->get_field_name('shadow_blur'); ?>" type="text"
									value="<?php echo $shadow_blur; ?>" />px 
								</label>	
								<label title="X and Y offset of the tag shadow" style="width: 25%; padding-bottom: 10px;" for="<?=$this->get_field_id('shadow_offset'); ?>">
									<span>Shadow Offset</span>
									<input
									class="widefat" id="<?=$this->get_field_id('shadow_offset'); ?>"
									name="<?=$this->get_field_name('shadow_offset'); ?>" type="text"
									value="<?php echo $shadow_offset; ?>" />px, px 
								</label>
							</div>
						</label>
					</td>
				</tr>
				<tr>
					<td style="border-bottom: 1px solid #aaa;">
						<label title="Radius for rounded corners of background" for="<?=$this->get_field_id('bg_radius'); ?>" style="width: 25%; margin-bottom: 10px;">
							<span><br>Bg Radius</span>
							<input class="widefat" id="<?=$this->get_field_id('bg_radius'); ?>"
							name="<?=$this->get_field_name('bg_radius'); ?>" type="text"
							value="<?php echo $bg_radius; ?>" />px 
						</label>
						<label title="Thickness of tag background outline in pixels, 0 for no outline." for="<?=$this->get_field_id('bg_outline_thickness'); ?>" style="width: 25%; margin-bottom: 10px;">
							<span>Bg Outline Thickness</span>
							<input
							class="widefat" id="<?=$this->get_field_id('bg_outline_thickness'); ?>"
							name="<?=$this->get_field_name('bg_outline_thickness'); ?>" type="text"
							value="<?php echo $bg_outline_thickness; ?>" />px 
						</label>
						<label title="Radius for rounded corners on outline box" style="width: 25%; margin-bottom: 10px" for="<?=$this->get_field_id('outline_radius'); ?>">
							<span>Outline<br>Radius</span>
							<br>
							<input
							class="widefat" id="<?=$this->get_field_id('outline_radius'); ?>"
							name="<?=$this->get_field_name('outline_radius'); ?>" type="text"
							value="<?php echo $outline_radius; ?>" />px 
						</label>
						<label title="Thickness of outline" style="width: 25%; margin-bottom: 10px;" for="<?=$this->get_field_id('outline_thickness'); ?>">
							<span>Outline Thickness</span>
							<input class="widefat" id="<?=$this->get_field_id('outline_thickness'); ?>"
							name="<?=$this->get_field_name('outline_thickness'); ?>" type="text"
							value="<?php echo $outline_thickness; ?>" />px 
						</label>	
						<label title="Number of pixels to increase size of tag by for the &#34;size&#34; outline method. Negative values are supported for decreasing the size." for="<?=$this->get_field_id('outline_increase'); ?>" style="width: 86px; margin-bottom: 10px;">
							<span>Outline Increase</span>
							<input
							class="widefat" id="<?=$this->get_field_id('outline_increase'); ?>"
							name="<?=$this->get_field_name('outline_increase'); ?>" type="text"
							value="<?php echo $outline_increase; ?>" />px
						</label>
						<label title="Distance of outline from text, in pixels. This also increases the size of the active area around the tag." for="<?=$this->get_field_id('outline_offset'); ?>" style="width: 86px; margin-bottom: 10px;">
							<span>Outline<br>Offset</span>
							<br>
							<input
							class="widefat" id="<?=$this->get_field_id('outline_offset'); ?>"
							name="<?=$this->get_field_name('outline_offset'); ?>" type="text"
							value="<?php echo $outline_offset; ?>" />px
						</label>		
						<label title="Maximal font size when weighted sizing is enabled." for="<?=$this->get_field_id('weight_size_max'); ?>" style=" width: 86px; margin-bottom: 10px;">
							<span>Weight<br>Size Max</span>
							<br>
							<input
							class="widefat" id="<?=$this->get_field_id('weight_size_max'); ?>"
							name="<?=$this->get_field_name('weight_size_max'); ?>" type="text"
							value="<?php echo $weight_size_max; ?>" />px
						</label>
						<label title="Minimal font size when weighted sizing is enabled." for="<?=$this->get_field_id('weight_size_min'); ?>" style="margin-bottom: 10px; width: 80px; ">
							<span>Weight<br>Size Min</span>
							<br>
							<input
							class="widefat" id="<?=$this->get_field_id('weight_size_min'); ?>"
							name="<?=$this->get_field_name('weight_size_min'); ?>" type="text"
							value="<?php echo $weight_size_min; ?>" />px
						</label>	
						<label title="If greater than 0, breaks the tag into multiple lines at word boundaries when the line would be longer than this value. Lines are automatically broken at line break tags." for="<?=$this->get_field_id('split_width'); ?>" style="width: 25%; margin-bottom: 5px;">
							<span>Split Width</span>
							<input
							class="widefat" id="<?=$this->get_field_id('split_width'); ?>"
							name="<?=$this->get_field_name('split_width'); ?>" type="text"
							value="<?php echo $split_width; ?>" />px
						</label>
					</td>
				</tr>					
				<tr>
					<td style="border-bottom: 1px solid #aaa;">
						<label style="padding-bottom: 5px;"><span>FONTS</span>	
							<p style="margin: 0; padding: 0 5px; font-size: 12px;">The plugin is connected to Google Font Library, so besides <a title="Find what is Web Safe Font." style="color: #1e8cbe;" href="http://www.w3schools.com/cssref/css_websafe_fonts.asp" target="_blank">Web Safe Fonts</a> you can use the full diversity of <a title="Find a Google Font Family." style="color: #1e8cbe;" href="http://www.google.com/fonts/" target="_blank">Google Fonts.</a>
							</p>
							<div style="position: relative; top: 10px;">
								<label title="Web Safe Font family for the tag text." style="float: left; width: 174px; margin-right: 5px;" for="<?=$this->get_field_id('text_font'); ?>">
									<span>Web Safe Font</span>
									<select class="widefat" id="<?=$this->get_field_id('text_font'); ?>" name="<?=$this->get_field_name('text_font'); ?>">
										<option value="" <?php if( $text_font == "" ){ echo ' selected'; } ?>>Font of the original link</option>
										<option style="background-color: #ddd;" title="Generic Font Family" value="Sans Serif" <?php if( $text_font == "Sans Serif" ){ echo ' selected'; } ?>>SANS SERIF</option>
										<option value="Arial" <?php if( $text_font == "Arial" ){ echo ' selected'; } ?>>Arial</option>
										<option	value="Arial Black" <?php if( $text_font == "Arial Black" ){ echo ' selected'; } ?>>Arial Black</option>
										<option	value="Arial Narrow" <?php if( $text_font == "Arial Narrow" ){ echo ' selected'; } ?>>Arial Narrow</option>
										<option	value="Avant Garde" <?php if( $text_font == "Avant Garde" ){ echo ' selected'; } ?>>Avant Garde</option>										
										<option	value="Calibri" <?php if( $text_font == "Calibri" ){ echo ' selected'; } ?>>Calibri</option>										
										<option	value="Candara" <?php if( $text_font == "Candara" ){ echo ' selected'; } ?>>Candara</option>										
										<option	value="Century Gothic" <?php if( $text_font == "Century Gothic" ){ echo ' selected'; } ?>>Century Gothic</option>
										<option	value="Comic Sans MS" <?php if( $text_font == "Comic Sans MS" ){ echo ' selected'; } ?>>Comic Sans MS</option>										
										<option	value="Franklin Gothic Medium" <?php if( $text_font == "Franklin Gothic Medium" ){ echo ' selected'; } ?>>Franklin Gothic Medium</option>
										<option	value="Futura" <?php if( $text_font == "Futura" ){ echo ' selected'; } ?>>Futura</option>
										<option	value="Geneva" <?php if( $text_font == "Geneva" ){ echo ' selected'; } ?>>Geneva</option>
										<option	value="Gill Sans" <?php if( $text_font == "Gill Sans" ){ echo ' selected'; } ?>>Gill Sans</option>
										<option value="Helvetica" <?php if( $text_font == "Helvetica" ){ echo ' selected'; } ?>>Helvetica</option>
										<option value="Impact" <?php if( $text_font == "Impact" ){ echo ' selected'; } ?>>Impact</option>
										<option value="Lucida Grande" <?php if( $text_font == "Lucida Grande" ){ echo ' selected'; } ?>>Lucida Grande</option>
										<option value="Lucida Sans Unicode" <?php if( $text_font == "Lucida Sans Unicode" ){ echo ' selected'; } ?>>Lucida Sans Unicode</option>												
										<option value="Optima" <?php if( $text_font == "Optima" ){ echo ' selected'; } ?>>Optima</option>
										<option value="Segoe UI" <?php if( $text_font == "Segoe UI" ){ echo ' selected'; } ?>>Segoe UI</option>
										<option value="Tahoma" <?php if( $text_font == "Tahoma" ){ echo ' selected'; } ?>>Tahoma</option>
										<option value="Trebuchet MS" <?php if( $text_font == "Trebuchet MS" ){ echo ' selected'; } ?>>Trebuchet MS</option>
										<option value="Verdana" <?php if( $text_font == "Verdana" ){ echo ' selected'; } ?>>Verdana</option>
										<option style="background-color: #ddd;" title="Generic Font Family" value="Serif" <?php if( $text_font == "Serif" ){ echo ' selected'; } ?>>SERIF</option>										
										<option	value="Baskerville" <?php if( $text_font == "Baskerville" ){ echo ' selected'; } ?>>Baskerville</option>
										<option	value="Big Caslon" <?php if( $text_font == "Big Caslon" ){ echo ' selected'; } ?>>Big Caslon</option>
										<option	value="Bodoni MT" <?php if( $text_font == "Bodoni MT" ){ echo ' selected'; } ?>>Bodoni MT</option>
										<option	value="Book Antiqua" <?php if( $text_font == "Book Antiqua" ){ echo ' selected'; } ?>>Book Antiqua</option>
										<option	value="Calisto MT" <?php if( $text_font == "Calisto MT" ){ echo ' selected'; } ?>>Calisto MT</option>
										<option	value="Cambria" <?php if( $text_font == "Cambria" ){ echo ' selected'; } ?>>Cambria</option>
										<option	value="Didot" <?php if( $text_font == "Didot" ){ echo ' selected'; } ?>>Didot</option>
										<option	value="Garamond" <?php if( $text_font == "Garamond" ){ echo ' selected'; } ?>>Garamond</option>
										<option	value="Georgia" <?php if( $text_font == "Georgia" ){ echo ' selected'; } ?>>Georgia</option>
										<option	value="Goudy Old Style" <?php if( $text_font == "Goudy Old Style" ){ echo ' selected'; } ?>>Goudy Old Style</option>
										<option	value="Hoefler Text" <?php if( $text_font == "Hoefler Text" ){ echo ' selected'; } ?>>Hoefler Text</option>
										<option	value="Lucida Bright" <?php if( $text_font == "Lucida Bright" ){ echo ' selected'; } ?>>Lucida Bright</option>
										<option	value="Palatino" <?php if( $text_font == "Palatino" ){ echo ' selected'; } ?>>Palatino</option>
										<option	value="Palatino Linotype" <?php if( $text_font == "Palatino Linotype" ){ echo ' selected'; } ?>>Palatino Linotype</option>										
										<option	value="Perpetua" <?php if( $text_font == "Perpetua" ){ echo ' selected'; } ?>>Perpetua</option>
										<option	value="Rockwell" <?php if( $text_font == "Rockwell" ){ echo ' selected'; } ?>>Rockwell</option>
										<option	value="Rockwell Extra Bold" <?php if( $text_font == "Rockwell Extra Bold" ){ echo ' selected'; } ?>>Rockwell Extra Bold</option>
										<option	value="Times New Roman" <?php if( $text_font == "Times New Roman" ){ echo ' selected'; } ?>>Times New Roman</option>
										<option style="background-color: #ddd;" title="Generic Font Family" value="Monospaced" <?php if( $text_font == "Monospaced" ){ echo ' selected'; } ?>>MONOSPACED</option>
										<option value="Andale Mono" <?php if( $text_font == "Andale Mono" ){ echo ' selected'; } ?>>Andale Mono</option>
										<option value="Consolas" <?php if( $text_font == "Consolas" ){ echo ' selected'; } ?>>Consolas</option>
										<option value="Courier New" <?php if( $text_font == "Courier New" ){ echo ' selected'; } ?>>Courier New</option>
										<option	value="Lucida Console" <?php if( $text_font == "Lucida Console" ){ echo ' selected'; } ?>>Lucida Console</option>
										<option	value="Lucida Sans Typewriter" <?php if( $text_font == "Lucida Sans Typewriter" ){ echo ' selected'; } ?>>Lucida Sans Typewriter</option>
										<option	value="Monaco" <?php if( $text_font == "Monaco" ){ echo ' selected'; } ?>>Monaco</option>
										<option style="background-color: #ddd;" title="Generic Font Family" value="Fantasy" <?php if( $text_font == "Fantasy" ){ echo ' selected'; } ?>>FANTASY</option>
										<option value="Copperplate" <?php if( $text_font == "Copperplate" ){ echo ' selected'; } ?>>Copperplate</option>
										<option value="Papyrus" <?php if( $text_font == "Papyrus" ){ echo ' selected'; } ?>>Papyrus</option>
										<option style="background-color: #ddd;" title="Generic Font Family" value="Script" <?php if( $text_font == "Script" ){ echo ' selected'; } ?>>SCRIPT</option>
										<option value="Brush Script MT" <?php if( $text_font == "Brush Script MT" ){ echo ' selected'; } ?>>Brush Script MT</option>		
									</select>
								</label>
								<label title="Uses a Google Font for Cloud Tags. If filled up this option overrides <span style='color: #063;'>Web Safe Font</span>." for="<?=$this->get_field_id('google_font'); ?>" style="width: 163px; margin-bottom: 5px;">
									<span>Google Font</span>
									<input style="width: 163px;"
									class="widefat" id="<?=$this->get_field_id('google_font'); ?>"
									name="<?=$this->get_field_name('google_font'); ?>" type="text"
									value="<?php echo $google_font; ?>" /> 
								</label>
							</div>
							<div>
								<label title="Fonts, separated by coma, to use in a random way on your Cloud <span style='color: #063;'>Content</span>. To apply this function:<br> 1. Choose <span style='color: #063;'>Font of the original link</span> for <span style='color: #063;'>Web Safe Font</span> and<br>2. Empty <span style='color: #063;'>Google Font</span> field." style="margin-top: 10px; width: 342px;" for="<?=$this->get_field_id('multiple_fonts'); ?>">
									<span>Multiple Fonts</span>
									<input style="width: 100%;"
									class="widefat" id="<?=$this->get_field_id('multiple_fonts'); ?>"
									name="<?=$this->get_field_name('multiple_fonts'); ?>" type="text"
									value="<?php echo $multiple_fonts; ?>" /> 
								</label>
							</div>
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<label style="padding-bottom: 5px;"><span>MISCELANEOUS</span>
							<div style="padding-top: 10px;">
								<label title="Minimal brightness (opacity) of tags at back of cloud (0.0-1.0)." for="<?=$this->get_field_id('min_brightness'); ?>" style="width: 115px;">
									<span>Min Brightness</span>
									<input
									class="widefat" id="<?=$this->get_field_id('min_brightness'); ?>"
									name="<?=$this->get_field_name('min_brightness'); ?>" type="text"
									value="<?php echo $min_brightness; ?>" />
								</label>
								<label title="Maximal brightness (opacity) of tags at front of cloud (0.0-1.0)." for="<?=$this->get_field_id('max_brightness'); ?>" style="width: 115px;">
									<span>Max Brightness</span>
									<input
									class="widefat" id="<?=$this->get_field_id('max_brightness'); ?>"
									name="<?=$this->get_field_name('max_brightness'); ?>" type="text"
									value="<?php echo $max_brightness; ?>" />
								</label>					
								<label title="Amount to scale images by. The default of 1 uses the size they appear on the page. For no scaling (use the actual image size) leave empty." style="width: 90px;" for="<?=$this->get_field_id('image_scale'); ?>">
									<span>Image Scale</span>
									<input
									class="widefat" id="<?=$this->get_field_id('image_scale'); ?>"
									name="<?=$this->get_field_name('image_scale'); ?>" type="text"
									value="<?php echo $image_scale; ?>" /> 
								</label>
							</div>
						</label>
					</td>
				</tr>
			</tbody>
		</table>		
	</div>
	<div id="fragment-3">
		<table>  
			<thead>
				<tr>
					<th>ZOOMING
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<div style="padding-top: 10px;">
							<label title="Minimal zoom value." style="width: 67px;" for="<?=$this->get_field_id('zoom_min'); ?>">
								<span>Zoom Min</span>
								<input class="widefat" id="<?=$this->get_field_id('zoom_min'); ?>"
								name="<?=$this->get_field_name('zoom_min'); ?>" type="text"
								value="<?php echo $zoom_min; ?>" /> 
							</label>  
							<label title="Maximal zoom value." style="width: 67px;" for="<?=$this->get_field_id('zoom_max'); ?>">
								<span>Zoom Max</span>
								<input class="widefat" id="<?=$this->get_field_id('zoom_max'); ?>"
								name="<?=$this->get_field_name('zoom_max'); ?>" type="text"
								value="<?php echo $zoom_max; ?>" />
							</label>
							<label title="The amount that the zoom is changed by with each movement of the mouse wheel." style="width: 67px;" for="<?=$this->get_field_id('zoom_step'); ?>">
								<span>Zoom Step</span>
								<input class="widefat" id="<?=$this->get_field_id('zoom_step'); ?>"
								name="<?=$this->get_field_name('zoom_step'); ?>" type="text"
								value="<?php echo $zoom_step; ?>" /> 
							</label>
							<label title="Adjusts the relative size of the tag cloud in the canvas. Larger values will zoom into the cloud, smaller values will zoom out." style="width: 45px;" for="<?=$this->get_field_id('zoom'); ?>">
								<span>Zoom</span>
								<input class="widefat" id="<?=$this->get_field_id('zoom'); ?>"
								name="<?=$this->get_field_name('zoom'); ?>" type="text"
								value="<?php echo $zoom; ?>" /> 
							</label>
							<div title="Enables zooming the cloud in and out using the mouse wheel or scroll gesture." style="float: left; margin: 0 0 0 5px;">
								<div>
									<span>Wheel Zoom</span>
								</div>
								<div  style="float: left;">
									<input style="margin: 0;" class="radio" id="<?=$this->get_field_id('wheel_zoom'); ?>"
									name="<?=$this->get_field_name('wheel_zoom'); ?>" type="radio" value="false"
									<?php if( $wheel_zoom == "false" ){ echo ' checked="checked"'; } ?>>false
										
									<input style="margin: 0 0 0 5px;" class="radio" id="<?=$this->get_field_id('wheel_zoom'); ?>"
									name="<?=$this->get_field_name('wheel_zoom'); ?>" type="radio" value="true"
									<?php if( $wheel_zoom == "true" ){ echo ' checked="checked"'; } ?>>true 
								</div>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<table>
			<thead>
				<tr>
					<th>MOOVING
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>	
						<div style="padding-top: 10px;">
							<label title="Starting rotation speed, with horizontal and vertical values as an array, e.g. <span style='color: #063;'>[0.8,-0.3]</span>. Values are multiplied by <span style='color: #063;'>maxSpeed</span>." style="width: 90px;" for="<?=$this->get_field_id('initial'); ?>">
								<span>Initial Speed</span>
								<input style="width: 75px;"
								class="widefat" style="border-right: 0;" id="<?=$this->get_field_id('initial'); ?>"
								name="<?=$this->get_field_name('initial'); ?>" type="text"
								value="<?php echo $initial; ?>" /> 
							</label>
							<label title="Minimal speed of rotation when mouse leaves canvas." for="<?=$this->get_field_id('min_speed'); ?>" style="width: 85px;">
								<span>Min Speed</span>
								<input
								class="widefat" id="<?=$this->get_field_id('min_speed'); ?>"
								name="<?=$this->get_field_name('min_speed'); ?>" type="text"
								value="<?php echo $min_speed; ?>" /> 
							</label>	
							<label title="Maximum speed of rotation" style="width: 90px;" for="<?=$this->get_field_id('max_speed'); ?>">
								<span>Max Speed</span>
								<input
								class="widefat" style="border-right: 0;" id="<?=$this->get_field_id('max_speed'); ?>"
								name="<?=$this->get_field_name('max_speed'); ?>" type="text"
								value="<?php echo $max_speed; ?>" /> 
							</label>
							<label title="Deceleration rate when mouse leaves canvas" style="width: 75px;" for="<?=$this->get_field_id('deceleration'); ?>">
								<span>Deceleration</span>
								<input
								class="widefat" style="border-right: 0;" id="<?=$this->get_field_id('deceleration'); ?>"
								name="<?=$this->get_field_name('deceleration'); ?>" type="text"
								value="<?php echo $deceleration; ?>" /> 
							</label>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<table>
			<thead>
				<tr>
					<th>TIMES
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<div style="padding-top: 10px;">
							<label title="Time to fade in tags at start" style="width: 115px; margin: 0 0 10px 0;" for="<?=$this->get_field_id('fadein'); ?>">
								<span>FadeIn Time</span>
								<br>
								<input class="widefat" id="<?=$this->get_field_id('fadein'); ?>"
								name="<?=$this->get_field_name('fadein'); ?>" type="text"
								value="<?php echo $fadein; ?>" />msec 
							</label>	
							<label title="Interval between animation frames" for="<?=$this->get_field_id('interval'); ?>" style="width: 115px; margin-bottom: 10px;">
								<span>Frame Interval</span>
								<br>
								<input
								class="widefat" id="<?=$this->get_field_id('interval'); ?>"
								name="<?=$this->get_field_name('interval'); ?>" type="text"
								value="<?php echo $interval; ?>" />msec 
							</label>
							<label title="If set to a number, the selected tag will move to the front in this many milliseconds before activating. By default the field is empty." style="width: 110px; margin-bottom: 10px;" for="<?=$this->get_field_id('click_to_front'); ?>">
								<span>Click to Front Time</span>
								<br>
								<input
								class="widefat" id="<?=$this->get_field_id('click_to_front'); ?>"
								name="<?=$this->get_field_name('click_to_front'); ?>" type="text"
								value="<?php echo $click_to_front; ?>" />msec 
							</label>
							<div style="height: 38px;">
								<label title="Pulse rate (in seconds per beat)" style="width: 100px; margin: 0 0 5px 230px;" for="<?=$this->get_field_id('pulsate_time'); ?>"><span>Pulsate Time</span>
									<br>
									<input class="widefat" id="<?=$this->get_field_id('pulsate_time'); ?>"
									name="<?=$this->get_field_name('pulsate_time'); ?>" type="text"
									value="<?php echo $pulsate_time; ?>" />sec/beat
								</label>
								<span style="font-size: 10px; position: relative; left: -77px; top: 35px;">|</span>
								<span style="font-size: 10px; position: relative; left: -83px; top: 44px;">|</span>
								<span style="font-size: 10px; position: relative; left: -77px; top: 34px;">|</span>
								<span style="font-size: 18px; position: relative; left: -80px; top: 23px;">&#8595;</span>
							</div>
						</div>	
					</td>
				</tr>
			<tbody>
		</table>
		<table style="margin-bottom: 1px;">
			<thead>
				<tr>
					<th>MISCELANEOUS
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<div>	
							<div title="Set to true to randomize the order of the tags." style="float: left; margin: 20px 0 0 0;">
								<div>
									<span>Shuffle Tags</span>
								</div>
								<div  style="float: left;">
									<input style="margin: 0;" class="radio" id="<?=$this->get_field_id('shuffle_tags'); ?>"
									name="<?=$this->get_field_name('shuffle_tags'); ?>" type="radio" value="false"
									<?php if( $shuffle_tags == "false" ){ echo ' checked="checked"'; } ?>>false
									
									<input style="margin: 0 0 0 10px" class="radio" id="<?=$this->get_field_id('shuffle_tags'); ?>"
									name="<?=$this->get_field_name('shuffle_tags'); ?>" type="radio" value="true"
									<?php if( $shuffle_tags == "true" ){ echo ' checked="checked"'; } ?>>true 
								</div>
							</div>			
							<div style="float: left; margin: 20px 25px 0;" title="Set to <span style='color: #063;'>true</span> to automatically hide the list of cloud elements if TagCanvas is started successfully.">
								<div style="font-weight: bold;">Hide List</div>
								<div>
									<input style="margin: 0;" class="radio" id="<?=$this->get_field_id('hide_tags'); ?>"
									name="<?=$this->get_field_name('hide_tags'); ?>" type="radio" value="false"
									<?php if( $hide_tags == "false" ){ echo ' checked="checked"'; } ?>>false
									
									<input style="margin: 0 0 0 10px" class="radio" id="<?=$this->get_field_id('hide_tags'); ?>"
									name="<?=$this->get_field_name('hide_tags'); ?>" type="radio" value="true"
									<?php if( $hide_tags == "true" ){ echo ' checked="checked"'; } ?>>true 
								</div>
							</div>
							<label title="Pulsate outline to this opacity. Range: 0.0-1.0" style="width: 60px; margin-bottom: 10px;" for="<?=$this->get_field_id('pulsate_to'); ?>">
								<span>Pulsate to<br>Opacity</span>
								<input	class="widefat" id="<?=$this->get_field_id('pulsate_to'); ?>"
								name="<?=$this->get_field_name('pulsate_to'); ?>" type="text"
								value="<?php echo $pulsate_to; ?>" /> 
							</label>
							<div style="width: 60px; float: left;">
								<span>Reverse</span>
								<div title="Set to <span style='color: #063;'>true</span> to reverse direction of movement relative to mouse position.">
									<input style="margin-right: 0;" class="radio" id="<?=$this->get_field_id('reverse'); ?>"
									name="<?=$this->get_field_name('reverse'); ?>" type="radio" value="false"
									<?php if( $reverse == "false" ){ echo ' checked="checked"'; } ?>>false
									<br>
									<input style="margin-right: 0;" class="radio" id="<?=$this->get_field_id('reverse'); ?>"
									name="<?=$this->get_field_name('reverse'); ?>" type="radio" value="true"
									<?php if( $reverse == "true" ){ echo ' checked="checked"'; } ?>>true
								</div> 
							</div>
							<div style="width: 80px; float: left;">
								<span>Front Select</span>
								<div title="Set to <span style='color: #063;'>true</span> to prevent selection of tags at back of cloud.">
									<input class="radio" id="<?=$this->get_field_id('front_select'); ?>"
									name="<?=$this->get_field_name('front_select'); ?>" type="radio" value="false"
									<?php if( $front_select == "false" ){ echo ' checked="checked"'; } ?>>false
									<br>
									
									<input class="radio" id="<?=$this->get_field_id('front_select'); ?>"
									name="<?=$this->get_field_name('front_select'); ?>" type="radio" value="true"
									<?php if( $front_select == "true" ){ echo ' checked="checked"'; } ?>>true 
								</div>
							</div>
							<div style="width: 85px; float: left;">
								<span>Freeze Active</span>
								<div title="Set to true to pause movement when a tag is highlighted.">
									<input class="radio" id="<?=$this->get_field_id('freeze_active'); ?>"
									name="<?=$this->get_field_name('freeze_active'); ?>" type="radio" value="false"
									<?php if( $freeze_active == "false" ){ echo ' checked="checked"'; } ?>>false
									<br>
									
									<input class="radio" id="<?=$this->get_field_id('freeze_active'); ?>"
									name="<?=$this->get_field_name('freeze_active'); ?>" type="radio" value="true"
									<?php if( $freeze_active == "true" ){ echo ' checked="checked"'; } ?>>true 
								</div>
							</div>		
							<div style="width: 114px; float: left;">
								<span>Freeze Deceleration</span>
								<div title="Set to true to decelerate when highlighted tags freeze instead of stopping suddenly.">
									<input class="radio" id="<?=$this->get_field_id('freeze_decel'); ?>"
									name="<?=$this->get_field_name('freeze_decel'); ?>" type="radio" value="false"
									<?php if( $freeze_decel == "false" ){ echo ' checked="checked"'; } ?>>false
									<br>
								
									<input class="radio" id="<?=$this->get_field_id('freeze_decel'); ?>"
									name="<?=$this->get_field_name('freeze_decel'); ?>" type="radio" value="true"
									<?php if( $freeze_decel == "true" ){ echo ' checked="checked"'; } ?>>true 
								</div>
							</div>			
							<div style="float: left; width: 130px; margin: 10px 0 0;">	
								<label title="When enabled, cloud moves when dragged instead of based on mouse position.">
									<span>Drag Control</span>
									<div>
										<input style="margin: 0;" class="radio" id="<?=$this->get_field_id('drag_ctrl'); ?>"
										name="<?=$this->get_field_name('drag_ctrl'); ?>" type="radio" value="false"
										<?php if( $drag_ctrl == "false" ){ echo ' checked="checked"'; } ?>>false
										
										<input style="margin: 0 0 0 5px;" class="radio" id="<?=$this->get_field_id('drag_ctrl'); ?>"
										name="<?=$this->get_field_name('drag_ctrl'); ?>" type="radio" value="true"
										<?php if( $drag_ctrl == "true" ){ echo ' checked="checked"'; } ?>>true <span style="font-size: 18px;">&#8594;</span>
									</div>
								</label>
							</div>
							<label title="The number of pixels that the cursor must move to count as a drag instead of a click." for="<?=$this->get_field_id('drag_threshold'); ?>" style="width: 110px; margin: 10px 70px 0 0;">
								<span>Drag Threshold</span>
								<input style="width: 45px" class="widefat" id="<?=$this->get_field_id('drag_threshold'); ?>"
								name="<?=$this->get_field_name('drag_threshold'); ?>" type="text"
								value="<?php echo $drag_threshold; ?>" />px
							</label>	
						</div>	
						<div style="margin-top: 10px; float: left;">
							<div style="float: left; width: 130px;">
								<label title="Text optimisation, converts text tags to images for better performance.">
									<span>Text Optimisation</span>
									<div>
										<input style="margin: 0;" class="radio" id="<?=$this->get_field_id('text_optimisation'); ?>"
										name="<?=$this->get_field_name('text_optimisation'); ?>" type="radio" value="false"
										<?php if( $text_optimisation == "false" ){ echo ' checked="checked"'; } ?>>false
								
										<input style="margin: 0 0 0 5px;" class="radio" id="<?=$this->get_field_id('text_optimisation'); ?>"
										name="<?=$this->get_field_name('text_optimisation'); ?>" type="radio" value="true"
										<?php if( $text_optimisation == "true" ){ echo ' checked="checked"'; } ?>>true <span style="font-size: 18px;">&#8594;</span>
									</div>
								</label>
							</div>
							<div style="float: left;">
								<label title="Scaling factor of text when converting to image in <span style='color: #063;'>txtOpt</span> mode." style="width: 60px; margin: 0 70px 10px 0;" for="<?=$this->get_field_id('text_scale'); ?>">
									<span>Text Scale</span>
									<input class="widefat" style="margin-bottom: 5px;" id="<?=$this->get_field_id('text_scale'); ?>"
									name="<?=$this->get_field_name('text_scale'); ?>" type="text"
									value="<?php echo $text_scale; ?>" /> 
								</label>
							</div>
						</div>
						<div style="margin-bottom: 5px; float: left;">
							<div style="float: left;">
								<label for="<?=$this->get_field_id('lock'); ?>" title="Limits rotation of the cloud using the mouse. ">
									<span style="margin: 0 0 10px 0;">Lock the Cloud</span>
									<div>
										<input style="margin: 0;" title="Limits rotation to the x-axis" class="radio" id="<?=$this->get_field_id('lock'); ?>"
										name="<?=$this->get_field_name('lock'); ?>" type="radio" value="x"
										<?php if( $lock == "x" ){ echo ' checked="checked"'; } ?>>x
									
										<input style="margin: 0 0 0 3px;" title="Limits rotation to the y-axis." class="radio" id="<?=$this->get_field_id('lock'); ?>"
										name="<?=$this->get_field_name('lock'); ?>" type="radio" value="y"
										<?php if( $lock == "y" ){ echo ' checked="checked"'; } ?>>y
									
										<input style="margin: 0 0 0 3px;" title="Prevents the cloud rotating in response to the mouse - the cloud will only move if the <span style='color: #063;'>initial</span> option is used to give it a starting speed." class="radio" id="<?=$this->get_field_id('lock'); ?>"
										name="<?=$this->get_field_name('lock'); ?>" type="radio" value="xy"
										<?php if( $lock == "xy" ){ echo ' checked="checked"'; } ?>>xy
								
										<input style="margin: 0 0 0 3px;" title="Leaves the cloud unlocked." class="radio" id="<?=$this->get_field_id('lock'); ?>"
										name="<?=$this->get_field_name('lock'); ?>" type="radio" value=""
										<?php if( $lock == "" ){ echo ' checked="checked"'; } ?>>none
									</div>
								</label>
							</div>
							<div title="Set to true to prevent any mouse interaction. The initial option must be used to animate the cloud, otherwise it will be motionless." style="float: left; margin: 0 15px;">
								<div>
									<span>No Mouse</span>
								</div>
								<div  style="float: left;">
									<input style="margin: 0" class="radio" id="<?=$this->get_field_id('no_mouse'); ?>"
									name="<?=$this->get_field_name('no_mouse'); ?>" type="radio" value="false"
									<?php if( $no_mouse == "false" ){ echo ' checked="checked"'; } ?>>false 
						
									<input style="margin: 0 0 0 3px;" class="radio" id="<?=$this->get_field_id('no_mouse'); ?>"
									name="<?=$this->get_field_name('no_mouse'); ?>" type="radio" value="true"
									<?php if( $no_mouse == "true" ){ echo ' checked="checked"'; } ?>>true 
								</div>
							</div>	
							<div style="float: left;" title="Set to true to prevent the selection of tags.">
								<div>
								<span>No Select</span>
								</div>
								<div style="float: left;">
									<input style="margin: 0;" class="radio" id="<?=$this->get_field_id('no_select'); ?>"
									name="<?=$this->get_field_name('no_select'); ?>" type="radio" value="false"
									<?php if( $no_select == "false" ){ echo ' checked="checked"'; } ?>>false 
							
									<input style="margin: 0 0 0 3px;" class="radio" id="<?=$this->get_field_id('no_select'); ?>"
									name="<?=$this->get_field_name('no_select'); ?>" type="radio" value="true"
									<?php if( $no_select == "true" ){ echo ' checked="checked"'; } ?>>true 
								</div>
							</div>  	
<!-- Not Applicable option in WP Plugin -->
							<span style="display: none;">
								<div style="width: 110px; float: left; margin-top: 10px;">
									<span>Animation Timing</span>
									<div title="The animation timing function for use with the <span style='color: #063;'>RotateTag</span> and <span style='color: #063;'>TagToFront</span> functions.">
										<input style="width: 45px" class="radio" id="<?=$this->get_field_id('animation_timing'); ?>"
										name="<?=$this->get_field_name('animation_timing'); ?>" type="radio" value="Smooth" 
										<?php if( $animation_timing == "Smooth" ){ echo ' checked="checked"'; } ?>>Smooth
										
										<input class="radio" id="<?=$this->get_field_id('animation_timing'); ?>"
										name="<?=$this->get_field_name('animation_timing'); ?>" type="radio" value="Linear"
										<?php if( $animation_timing == "Linear" ){ echo ' checked="checked"'; } ?>>Linear
									</div>
								</div>
							</span>
<!-- ********************************** --> 
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
    <div id="fragment-4">
		<table style="margin: 0 1px 1px;">
			<tbody>
				<tr>
					<td>	
						<div id="accordion">
							<h3>General Tips</h3>
								<div>
									<?php include 'tips/general.tips.html'; ?> 
								</div>
								<h3>Cloud Content Tips</h3>
								<div>
									<?php include 'tips/cloud.content.tips.html'; ?>
								</div>
							<h3>Coloring Tips</h3>
								<div>
									<?php include 'tips/coloring.tips.html'; ?>
								</div>
							<h3>Sizing Tips</h3>
								<div>
									<?php include 'tips/sizing.tips.html'; ?>
								</div>
							<h3>Speed Tips</h3>
								<div>
									<?php include 'tips/speed.tips.html'; ?>
								</div>
							<h3>How to... Tips</h3>
								<div>
									<?php include 'tips/how.to.tips.html'; ?>
								</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>