<?php
if ( !class_exists( 'TotallyTabular_Options' ) ) {
    class TotallyTabular_Options
    {
		function __construct() {
			$this->init();
		}

        public function init() {
            add_action('admin_menu', [$this,'ttabular_create_theme_options_page']);

            add_action('admin_init', [$this,'ttabular_register_and_build_fields']);
        }
 

		public function ttabular_create_theme_options_page(){
			add_options_page('Totally Tabular', 'Totally Tabular', 'administrator', __FILE__, [$this,'ttabular_build_options_page']);
		}

		public function ttabular_build_options_page() { ?> 
			<div id="theme-options-wrap">
   
				<h2>
					<span class="dashicons dashicons-palmtree"></span> 
					Totally Tabular Settings 
				</h2>
				
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

		// Define ttabular_rotator_section_cb() to avoid function undefined error
		// function ttabular_rotator_section_cb() {} 

		public function ttabular_register_and_build_fields() { 
			register_setting('ttabular_settings', 'ttabular_settings', [$this,'validate_setting']);

			// Sections
			// add_settings_section('rotator_section', 'Rotator Settings', 'ttabular_rotator_section_cb', __FILE__);
			add_settings_section('rotator_section', 'Rotator Settings', [$this,'ttabular_rotator_section_cb'], __FILE__);

			//Fields
			add_settings_field('rotator_speed', 'Rotator Speed : <br />(milliseconds, default 5000)', [$this,'rotator_speed_settings'], __FILE__, 'rotator_section');
			add_settings_field('layout_type', 'Layout Type : <br />(horizontal or vertical)', [$this,'layout_type_settings'], __FILE__, 'rotator_section');
			/*add_settings_field('style_choice', 'Style Choice :', 'style_settings', __FILE__, 'rotator_section');
			*/
		}

		// Sanitize
		public function validate_setting($ttabular_settings) {
			return $ttabular_settings;
		}
		// Define ttabular_rotator_section_cb()
		public function ttabular_rotator_section_cb() {} 

		//Field Output
		public function rotator_speed_settings() {
			$options = get_option('ttabular_settings'); 
			echo "<input name='ttabular_settings[rotator_speed]' type='text' value='{$options['rotator_speed']}' />";
		}

		public function layout_type_settings() {
			$layout_options = ['horizontal','vertical'];
			$options = get_option('ttabular_settings'); 
			echo "<select name='ttabular_settings[layout_type]'>";
			foreach ($layout_options as $key) {
				echo "<option value='".$key."' ";
				echo ( $key == $options['layout_type'] ? "selected='selected'" : '');
				echo " >".$key."</option>";
				# code...
			}
			echo "</select>";
		}

    }
 
    $TotallyTabular_Options = new TotallyTabular_Options;

}