<?php
error_reporting(0);
//*************** Include style.css in Header ********

// Getting Option From DB *****************************	
$acx_widget_si_theme = get_option('acx_widget_si_theme');
$acx_widget_si_credit = get_option('acx_widget_si_credit');
$acx_widget_si_facebook = get_option('acx_widget_si_facebook');
$acx_widget_si_youtube = get_option('acx_widget_si_youtube');
$acx_widget_si_twitter = get_option('acx_widget_si_twitter');
$acx_widget_si_linkedin = get_option('acx_widget_si_linkedin');
$acx_widget_si_gplus = get_option('acx_widget_si_gplus');
$acx_widget_si_pinterest = get_option('acx_widget_si_pinterest');
$acx_widget_si_feed = get_option('acx_widget_si_feed');
$acx_widget_si_icon_size = get_option('acx_widget_si_icon_size');
// *****************************************************
function enqueue_acx_widget_si_style()
{
	wp_enqueue_style ( 'acx-widget-si-style', plugins_url('style.css', __FILE__) );
}	add_action( 'wp_print_styles', 'enqueue_acx_widget_si_style' );

// Check Credit Link
function check_widget_acx_credit($yes,$no)
{ 	$acx_widget_si_credit = get_option('acx_widget_si_credit');
	if($acx_widget_si_credit != "no") { echo $yes; } else { echo $no; } 
}

// Options Value Checker
function acx_widget_option_value_check($option_name,$yes,$no)
{ 	$acx_widget_si_option_set = get_option($option_name);
	if ($acx_widget_si_option_set != "") { echo $yes; } else { echo $no; }
}
function acurax_si_widget_simple($theme)
{

	// Getting Globals *****************************	
	global $acx_widget_si_theme, $acx_widget_si_credit , $acx_widget_si_twitter, $acx_widget_si_facebook, $acx_widget_si_youtube,$acx_widget_si_gplus,
	$acx_widget_si_linkedin, $acx_widget_si_pinterest, $acx_widget_si_feed, $acx_widget_si_icon_size;
	// *****************************************************
	if ($theme == "") { $acx_widget_si_touse_theme = $acx_widget_si_theme; } else { $acx_widget_si_touse_theme = $theme; }
		//******** MAKING EACH BUTTON LINKS ********************
		if	($acx_widget_si_twitter == "") { $twitter_link = ""; } else 
		{
			$twitter_link = "<a href='http://www.twitter.com/". $acx_widget_si_twitter ."' target='_blank'>" . "<img src=" . 
			plugins_url('images/themes/'. $acx_widget_si_touse_theme .'/twitter.png', __FILE__) . " border='0'></a>";
		}
		if	($acx_widget_si_facebook == "") { $facebook_link = ""; } else 
		{
			$facebook_link = "<a href='". $acx_widget_si_facebook ."' target='_blank'>" . "<img src=" . plugins_url('images/themes/'
			. $acx_widget_si_touse_theme .'/facebook.png', __FILE__) . " border='0'></a>";
		}
		if	($acx_widget_si_gplus == "") { $gplus_link = ""; } else 
		{
			$gplus_link = "<a href='". $acx_widget_si_gplus ."' target='_blank'>" . "<img src=" . plugins_url('images/themes/'. 
			$acx_widget_si_touse_theme .'/googleplus.png', __FILE__) . " border='0'></a>";
		}
		if	($acx_widget_si_pinterest == "") { $pinterest_link = ""; } else 
		{
			$pinterest_link = "<a href='". $acx_widget_si_pinterest ."' target='_blank'>" . "<img src=" . plugins_url(
			'images/themes/'. $acx_widget_si_touse_theme .'/pinterest.png', __FILE__) . " border='0'></a>";
		}
		if	($acx_widget_si_youtube == "") { $youtube_link = ""; } else 
		{
			$youtube_link = "<a href='". $acx_widget_si_youtube ."' target='_blank'>" . "<img src=" . plugins_url('images/themes/'. 
			$acx_widget_si_touse_theme .'/youtube.png', __FILE__) . " border='0'></a>";
		}
		if	($acx_widget_si_linkedin == "") { $linkedin_link = ""; } else 
		{
			$linkedin_link = "<a href='". $acx_widget_si_linkedin ."' target='_blank'>" . "<img src=" . plugins_url('images/themes/'
			. $acx_widget_si_touse_theme .'/linkedin.png', __FILE__) . " border='0'></a>";
		}
		if	($acx_widget_si_feed == "") { $feed_link = ""; } else 
		{
			$feed_link = "<a href='". $acx_widget_si_feed ."' target='_blank'>" . "<img src=" . plugins_url('images/themes/'
			. $acx_widget_si_touse_theme .'/feed.png', __FILE__) . " border='0'></a>";
		}
		$social_widget_icon_array_order = get_option('social_widget_icon_array_order');
	$social_widget_icon_array_order = unserialize($social_widget_icon_array_order);
	foreach ($social_widget_icon_array_order as $key => $value)
	{
		if ($value == 0) { echo $twitter_link; } 

		else if ($value == 1) { echo $facebook_link; } 

		else if ($value == 2) { echo $gplus_link; } 

		else if ($value == 3) { echo $pinterest_link; } 

		else if ($value == 4) { echo $youtube_link; } 

		else if ($value == 5) { echo $linkedin_link; } 
		
		else if ($value == 6) { echo $feed_link; }
	}
} //acurax_si_widget_simple()

function acx_widget_theme_check_wp_head() {
	$template_directory = get_template_directory();
	// If header.php exists in the current theme, scan for "wp_head"
	$file = $template_directory . '/header.php';
	if (is_file($file)) {
		$search_string = "wp_head";
		$file_lines = @file($file);
		
		foreach ($file_lines as $line) {
			$searchCount = substr_count($line, $search_string);
			if ($searchCount > 0) {
				return true;
			}
		}
		
		// wp_head() not found:
		echo "<div class=\"highlight\" style=\"width: 99%; margin-top: 10px; margin-bottom: 10px; border: 1px solid darkred;\">" . "Your theme needs to be fixed for plugins to work. To fix your theme, use the <a href=\"theme-editor.php\">Theme Editor</a> to insert <code>&lt;?php wp_head(); ?&gt;</code> just before the <code>&lt;/head&gt;</code> line of your theme's <code>header.php</code> file." . "</div>";
	}
} // theme check 
add_action('admin_notices', 'acx_widget_theme_check_wp_head');


function acurax_widget_icons()
{
	global $acx_widget_si_theme, $acx_widget_si_credit, $acx_widget_si_twitter, $acx_widget_si_facebook, $acx_widget_si_youtube, 		
	$acx_widget_si_linkedin, $acx_widget_si_gplus, $acx_widget_si_pinterest, $acx_widget_si_feed, $acx_widget_si_icon_size;
			
	if($acx_widget_si_twitter != "" || $acx_widget_si_facebook != "" || $acx_widget_si_youtube != "" || $acx_widget_si_linkedin != ""  || 
	$acx_widget_si_pinterest != "" || $acx_widget_si_gplus != "" || $acx_widget_si_feed != "")
	{
	//*********************** STARTED DISPLAYING THE ICONS ***********************
		echo "\n\n\n<!-- Starting Icon Display Code For Social Media Icon From Acurax International www.acurax.com -->\n";
		echo "<div id='acx_social_widget' align='center'>";
		acurax_si_widget_simple();		
		echo "</div>\n";
		echo "<!-- Ending Icon Display Code For Social Media Icon From Acurax International www.acurax.com -->\n\n\n";
	//*****************************************************************************
	} // Chking null fields
	
} // Ending acurax_widget_icons();

function extra_style_acx_widget_icon()
{
	global $acx_widget_si_icon_size;
		echo "\n\n\n<!-- Starting Styles For Social Media Icon From Acurax International www.acurax.com -->\n<style type='text/css'>\n";
		echo "#acx_social_widget img \n{\n";
		echo "width: " . $acx_widget_si_icon_size . "px; \n}\n";
				echo "#acx_social_widget \n{\n";
				echo "min-width:0px; \n";
				echo "position: static; \n}\n";			
		echo "</style>\n<!-- Ending Styles For Social Media Icon From Acurax International www.acurax.com -->\n\n\n\n";
}	add_action('admin_head', 'extra_style_acx_widget_icon'); // ADMIN
	add_action('wp_head', 'extra_style_acx_widget_icon'); // PUBLIC 

function acx_widget_si_admin_style()  // Adding Style For Admin
{
	echo '<link rel="stylesheet" type="text/css" href="' .plugins_url('style_admin.css', __FILE__). '">';
}	add_action('admin_head', 'acx_widget_si_admin_style'); // ADMIN


$acx_widget_si_sc_id = 0; // Defined to assign shortcode unique id
function DISPLAY_WIDGET_acurax_widget_icons_SC($atts)
{
	global $acx_widget_si_icon_size, $acx_widget_si_sc_id;
	extract(shortcode_atts(array(
	"theme" => '',
	"size" => $acx_widget_si_icon_size,
	"autostart" => 'false'
	), $atts));
	if ($theme > ACX_SOCIALMEDIA_WIDGET_TOTAL_THEMES) { $theme = ""; }
	if (!is_numeric($theme)) { $theme = ""; }
	if ($size > 55) { $size = $acx_widget_si_icon_size; }
	if (!is_numeric($size)) { $size = $acx_widget_si_icon_size; }
		$acx_widget_si_sc_id = $acx_widget_si_sc_id + 1;
		ob_start();
		echo "<style>\n";
		echo "#short_code_si_icon img \n {";
		echo "width:" . $size . "px; \n}\n";
		echo ".scid-" . $acx_widget_si_sc_id . " img \n{\n";
		echo "width:" . $size . "px !important; \n}\n";
		echo "</style>";
		echo "<div id='short_code_si_icon' align='center' class='scid-" . $acx_widget_si_sc_id . "'>";
		acurax_si_widget_simple($theme);
		echo "</div>";
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
} // DISPLAY_WIDGET_acurax_widget_icons_SC

			


function acx_widget_si_custom_admin_js()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
}	add_action( 'admin_enqueue_scripts', 'acx_widget_si_custom_admin_js' );



// wp-admin Notices >> Finish Upgrade
function acx_widget_si_pluign_upgrade_not_finished()
{
    echo '<div class="error">
		  <p><b>Thanks for updating Acurax Social Media Widget plugin... You need to visit <a href="admin.php?page=Acurax-Social-Widget-Settings">Plugin\'s Settings Page</a> to Complete the Updation Process - <a href="admin.php?page=Acurax-Social-Widget-Settings">Click Here Visit Social Icon Plugin Settings</a></b></p>
		  </div>';
}
$total_arrays = 7; // Number Of Services
$social_widget_icon_array_order = get_option('social_widget_icon_array_order');
$social_widget_icon_array_order = unserialize($social_widget_icon_array_order);
$social_widget_icon_array_count = count($social_widget_icon_array_order); 
if ($social_widget_icon_array_count < $total_arrays) 
{
	add_action('admin_notices', 'acx_widget_si_pluign_upgrade_not_finished',1);
}

// wp-admin Notices >> Plugin not configured
function acx_widget_si_pluign_not_configured()
{
    echo '<div class="error">
	<p><b>Acurax Social Media Widget Plugin is not configured. You need to configure your social media profile URL\'s 
		  to start showing the Acurax Social Media Widgets - <a href="admin.php?page=Acurax-Social-Widget-Settings">Click 
		  here to configure</a></b></p>
		  </div>';
}
if ($social_widget_icon_array_count == $total_arrays) 
{
if ($acx_widget_si_twitter == "" && $acx_widget_si_facebook == "" && $acx_widget_si_youtube == "" && $acx_widget_si_linkedin == ""  && $acx_widget_si_pinterest == "" && $acx_widget_si_gplus == "" && $acx_widget_si_feed == "")
{
	add_action('admin_notices', 'acx_widget_si_pluign_not_configured',1);
} // Chking If Plugin Not Configured
} // Chking $social_widget_icon_array_count == $total_arrays

// wp-admin Notices >> Plugin not configured
function acx_widget_si_pluign_promotion()
{
    echo '<div id="acx_td" class="error" style="background: none repeat scroll 0pt 0pt infobackground; border: 1px solid inactivecaption; padding: 5px;line-height:16px;">
	<p>It looks like you have been enjoying using Acurax Social Media Widget plugin from <a href="http://www.acurax.com?utm_source=plugin&utm_medium=thirtyday&utm_campaign=thirtyday" title="Acurax Web Designing Company" target="_blank">Acurax</a> for atleast 30 days.Would you consider upgrading to <a href="admin.php?page=Acurax-Social-Widget-Premium" title="Premium Acurax Social Media Widget" target="_blank">premium version</a> to enjoy more features and help support continued development of the plugin? - You can also support us by giving us a website design, redesign, social media project or by spreading the world about this plugin. Thank you for using the plugin</p>
	<p>
	<a href="http://wordpress.org/extend/plugins/acurax-social-media-widget/" class="button" style="color:black;text-decoration:none;padding:5px;margin-right:4px;" target="_blank">Rate it 5★\'s on wordpress</a>
	<a href="admin.php?page=Acurax-Social-Widget-Premium" class="button" style="color:black;text-decoration:none;padding:5px;margin-right:4px;" target="_blank">Order Premium Version</a>
	<a href="admin.php?page=Acurax-Social-Widget-Premium&td=hide" class="button" style="color:black;text-decoration:none;padding:5px;margin-right:4px;margin-left:20px;">Don\'t Show This Again</a>
</p>
		  
		  </div>';
}
$acx_widget_si_installed_date = get_option('acx_widget_si_installed_date');
if ($acx_widget_si_installed_date=="") { $acx_widget_si_installed_date = time();}
if($acx_widget_si_installed_date < ( time() - 2952000 ))
{
if (get_option('acx_widget_si_td') != "hide")
{
add_action('admin_notices', 'acx_widget_si_pluign_promotion',1);
}
}


// Starting Widget Code
class acx_social_widget_icons_Widget extends WP_Widget
{
    // Register the widget
    function acx_social_widget_icons_Widget() 
	{
        // Set some widget options
        $widget_options = array( 'description' => 'Allow users to show Social Media Icons via Acurax Social Media Widget 
		Plugin', 'classname' => 'acx-social-icons-desc' );
        // Set some control options (width, height etc)
        $control_options = array( 'width' => 300 );
        // Actually create the widget (widget id, widget name, options...)
        $this->WP_Widget( 'acx-social-icons-widget', 'Acurax Social Media Widget', $widget_options, $control_options );
    }

    // Output the content of the widget
    function widget($args, $instance) 
	{
        extract( $args ); // Don't worry about this

        // Get our variables
        $title = apply_filters( 'widget_title', $instance['title'] );
		$icon_size = $instance['icon_size'];
		$icon_theme = $instance['icon_theme'];
		$icon_align = $instance['icon_align'];

        // This is defined when you register a sidebar
        echo $before_widget;

        // If our title isn't empty then show it
        if ( $title ) 
		{
            echo $before_title . $title . $after_title;
        }
		echo "<style>\n";
		echo "." . $this->get_field_id('widget') . " img \n{\n";
		echo "width:" . $icon_size . "px; \n } \n";
		echo "</style>";
		echo "<div id='acurax_si_widget_simple' class='" . $this->get_field_id('widget') . "'";
		if($icon_align != "") { echo " align='" . $icon_align . "'>"; } else { echo " align='center'>"; }
		acurax_si_widget_simple($icon_theme);
		echo "</div>";
        // This is defined when you register a sidebar
        echo $after_widget;
    }

	// Output the admin options form
	function form($instance) 
	{
		$total_themes = ACX_SOCIALMEDIA_WIDGET_TOTAL_THEMES;
		$total_themes = $total_themes + 1;
		// These are our default values
		$defaults = array( 'title' => 'Social Media Icons','icon_size' => '32' );
		// This overwrites any default values with saved values
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
				value="<?php echo $instance['title']; ?>" type="text" class="widefat" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_size'); ?>"><?php _e('Icon Size:'); ?></label>
				<select class="widefat" name="<?php echo $this->get_field_name('icon_size'); ?>" id="<?php echo $this
				->get_field_id('icon_size'); ?>">
				<option value="16"<?php if ($instance['icon_size'] == "16") { echo 'selected="selected"'; } ?>>16px X 16px </
				option>
				<option value="25"<?php if ($instance['icon_size'] == "25") { echo 'selected="selected"'; } ?>>25px X 25px </
				option>
				<option value="32"<?php if ($instance['icon_size'] == "32") { echo 'selected="selected"'; } ?>>32px X 32px </
				option>
				<option value="40"<?php if ($instance['icon_size'] == "40") { echo 'selected="selected"'; } ?>>40px X 40px </
				option>
				<option value="48"<?php if ($instance['icon_size'] == "48") { echo 'selected="selected"'; } ?>>48px X 48px </
				option>
				<option value="55"<?php if ($instance['icon_size'] == "55") { echo 'selected="selected"'; } ?>>55px X 55px </
				option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_theme'); ?>"><?php _e('Icon Theme:'); ?></label>
				<select class="widefat" name="<?php echo $this->get_field_name('icon_theme'); ?>" id="<?php echo $this
				->get_field_id('icon_theme'); ?>">
				<option value=""<?php if ($instance['icon_theme'] == "") { echo 
				'selected="selected"'; } ?>>Default Theme Design</option>
				<?php
				for ($i=1; $i < $total_themes; $i++)
				{
					?>
					<option value="<?php echo $i; ?>"<?php if ($instance['icon_theme'] == $i) { echo 
					'selected="selected"'; } ?>>Theme Design <?php echo $i; ?> </option>
					<?php
				}	?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_align'); ?>"><?php _e('Icon Align:'); ?></label>
				<select class="widefat" name="<?php echo $this->get_field_name('icon_align'); ?>" id="<?php echo $this
				->get_field_id('icon_align'); ?>">
				<option value=""<?php if ($instance['icon_align'] == "") { echo 'selected="selected"'; } ?>>Default </
				option>
				<option value="left"<?php if ($instance['icon_align'] == "left") { echo 'selected="selected"'; } ?>>Left </
				option>
				<option value="center"<?php if ($instance['icon_align'] == "center") { echo 'selected="selected"'; } ?>>Center </
				option>
				<option value="right"<?php if ($instance['icon_align'] == "right") { echo 'selected="selected"'; } ?>>Right </
				option>
				</select>
			</p>
		<?php
	}

	// Processes the admin options form when saved
	function update($new_instance, $old_instance) 
	{
		// Get the old values
		$instance = $old_instance;

		// Update with any new values (and sanitise input)
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['icon_size'] = strip_tags( $new_instance['icon_size'] );
		$instance['icon_theme'] = strip_tags( $new_instance['icon_theme'] );
		$instance['icon_align'] = strip_tags( $new_instance['icon_align'] );
		return $instance;
	}
} add_action('widgets_init', create_function('', 'return register_widget("acx_social_widget_icons_Widget");'));
// Ending Widget Codes
function socialicons_widget_comparison($ad=2)
{
$ad_1 = '
</hr>
<div align="center">
<br>
<p><b>This Plugin is the basic widget version of floating social media icon wordpress plugin. This plugin only support the icon pack and the widget. Premium Version of This plugin includes all the features of floating social media icon and a lot more. Premium version is same as the premium version of floating social media icon wordpress plugin.</b></p>
<h1>Free and Premium Comparison:</h2>
<table id="comparison" cellspacing="0" style="margin-right:auto;margin-left:auto;">
<tr class="title">
<td class="label">Features</td>
<td class="feature_free">Free</td>
<td class="feature_paid" style="border-right:0px;">Premium</td>
</tr>

<tr>
<td class="label">Automatic/Manual Integration</td>
<td class="feature_free"><div id="c_tick"></div> <!-- c_tick --></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label">Option to select/define icon design</td>
<td class="feature_free"><div id="c_tick"></div> <!-- c_tick --></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label">Option to select/define icon size</td>
<td class="feature_free"><div id="c_tick"></div> <!-- c_tick --></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label">Seperate Icon Style/Size for each Shortcode</td>
<td class="feature_free"><div id="c_tick"></div> <!-- c_tick --></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label">Seperate Icon Style/Size for each Widget</td>
<td class="feature_free"><div id="c_tick"></div> <!-- c_tick --></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label">Reorder Icons</td>
<td class="feature_free"><div id="c_tick"></div> <!-- c_tick --></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label">Widget Support</td>
<td class="feature_free"><div id="c_tick"></div> <!-- c_tick --></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label">Multiple Widget Support</td>
<td class="feature_free"><div id="c_tick"></div> <!-- c_tick --></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label">Shortcode Support</td>
<td class="feature_free"><div id="c_tick"></div> <!-- c_tick --></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label">Multiple Shortcode Instance Support</td>
<td class="feature_free"><div id="c_tick"></div> <!-- c_tick --></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">More Sharp Quality Icons</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Multiple Floating Animation</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Configure Animation Repeat Interval</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Animation Repeat Interval Based On Time</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Animation Repeat Interval Based on Page Views</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Animation Repeat Interval Based On Page Views and Time (both)</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Ajax Based Settings Page</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Set whether the icons to link profile/share</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Easy to configure</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Icon Placement Width Setting (allows to configure how many icons in 1 row)</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Seperate Icon function for each Widget</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Advanced PHP Code Support</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Advanced Shortcode Support</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Seperate Icon function for each Shortcode</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Can Configure Floating Start Position</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="">Can Configure Floating End Position</td>
<td class="feature_free"><div id="c_cross"></div></td>
<td class="feature_paid" style="border-right:0px;"><div id="c_tick"></div> <!-- c_tick --></td>
</tr>

<tr>
<td class="label" style="border-right:0px;padding-right:0px;">Download free version of plugin at wordpress </td>
<td class="feature_free" style="padding-left:0px;width: 161px;">plugin directory</td>
<td class="feature_paid" style="border-right:0px;"><a href="http://clients.acurax.com/floating-socialmedia.php?utm_source=widget_plugin&utm_medium=premium&utm_campaign=premium" target="_blank"><img src="' . plugins_url("images/orange_buynow.png", __FILE__) . '" border="0"></a></div> <!-- c_tick --></td>
</tr>

</table><br>
<div id="ad_fsmi_2_button_order">
<a href="http://clients.acurax.com/floating-socialmedia.php?utm_source=widget_plugin&utm_medium=premium&utm_campaign=premium" target="_blank"><div id="ad_fsmi_2_button_order_link"></div></a></div> <!-- ad_fsmi_2_button_order --> 
<br></div -->';
$ad_2='<div id="ad_fsmi_2"> <a href="http://clients.acurax.com/floating-socialmedia.php?utm_source=widget_plugin&utm_medium=premium&utm_campaign=premium" target="_blank"><div id="ad_fsmi_2_button"></div></a> </div> <!-- ad_fsmi_2 --><br>
<div id="ad_fsmi_2_button_order">
<a href="http://clients.acurax.com/floating-socialmedia.php?utm_source=widget_plugin&utm_medium=premium&utm_campaign=premium" target="_blank"><div id="ad_fsmi_2_button_order_link"></div></a></div> <!-- ad_fsmi_2_button_order --> ';
if($ad=="") { echo $ad_2; } else if ($ad == 1) { echo $ad_1; } else if ($ad == 2) { echo $ad_2; } 
}

?>