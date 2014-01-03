<?php

add_action('admin_menu', 'create_theme_options_page');
function create_theme_options_page(){  add_options_page('Totally Tabular', 'Totally Tabular', 'administrator', __FILE__, 'build_options_page');}

function build_options_page() {?> 
	<div id="theme-options-wrap"><style>input{padding:3px 1px;width:120px;}.form-table{width:98%;}.form-table tr{width:80%;max-width:400px;float:left;display:block;min-height:60px;padding:0}.form-table td{padding:0 2px}.form-table th{padding:6px 6px 0 2px;text-align:right}</style>
		<div class="icon32" id="icon-tools"> <br /> </div>    
		<h2>Totally Tabular Settings</h2>
		
		<br style="clear:both" />
		<form method="post" action="options.php" enctype="multipart/form-data">
			<?php settings_fields('ttabular_settings'); ?>  
			<?php do_settings_sections(__FILE__); ?>
			<p class="submit">
				<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
			</p>
		</form>
	</div>
<?php }
add_action('admin_init', 'register_and_build_fields');
function register_and_build_fields() {  register_setting('ttabular_settings', 'ttabular_settings', 'validate_setting');

// Sections
add_settings_section('rotator_section', 'Rotator Settings', 'section_cb', __FILE__);

//Fields
add_settings_field('rotator_speed', 'Rotator Speed (ms, default 5000) :', 'rotator_speed_settings', __FILE__, 'rotator_section');
/*add_settings_field('style_choice', 'Style Choice :', 'style_settings', __FILE__, 'rotator_section');
*/
}

// Sanitize
function validate_setting($ttabular_settings) {return $ttabular_settings;}
// Define section_cb() to avoid function undefined error
function section_cb() {} 

//Field Output
function rotator_speed_settings() {$options = get_option('ttabular_settings'); echo "<input name='ttabular_settings[rotator_speed]' type='text' value='{$options['rotator_speed']}' />";}
/*
function style_settings() {$options = get_option('ttabular_settings'); echo "<select name='ttabular_settings[style_choice]' type='text' default='{$options['style_choice']}'><option>a</option><option>b</option></select>";}

// Retrieves the option using get_option(); and assigns it to a variable.
$[VARIABLE] = get_option('[NAME]');
    // Checks to see if variable is empty. Ex: not yet defined by the users.
	if(empty($[VARIABLE])){
        // If it is empty assign it your default value true or false.
		$[VARIABLE] = "[FALSE/TRUE]";
	}
	*/
?>

?>