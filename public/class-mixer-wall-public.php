<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       none
 * @since      1.0.0
 *
 * @package    mixer_wall
 * @subpackage mixer_wall/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    mixer_wall
 * @subpackage mixer_wall/public
 * @author     StreamWeasels <admin@streamweasels.com>
 */
class mixer_wall_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in mixer_wall_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The mixer_wall_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mixer-wall-public.css', array(), '', 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in mixer_wall_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The mixer_wall_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'mixer-easy-embed-wall-js', plugins_url( '/public/js/mixer-wall-public.js', dirname( __FILE__ ) ), array('jquery'), $this->version, false );            
		$mixerWallVars = array(
			'id'            => 0,
			'mixerGames'    => sanitize_text_field(get_option('mixer_ezembed_options_wall')['mixer_settings_game']),               
			'mixerNames'    => str_replace(array(' ', ','), array('',';'), sanitize_text_field(get_option('mixer_ezembed_options_wall')['mixer_settings_channel'])),
			'mixerTeam'     => strtolower(sanitize_text_field(get_option('mixer_ezembed_options_wall')['mixer_settings_team'])),
			'limit'         => sanitize_text_field(get_option('mixer_ezembed_options_wall')['mixer_settings_limit']),                
			'theme'         => sanitize_text_field(get_option('mixer_ezembed_appearance_options_wall')['mixer_appearance_colour_theme']),
			'play'          => plugins_url("../templates/assets/play.svg", __FILE__),

		);            
		wp_localize_script( 'mixer-easy-embed-wall-js', 'mixer_wall_vars', $mixerWallVars);			
	}
    
    public function getTwitchOutput($args){
        include ('partials/output.php');
    }
    
	public function getMixerWallShortcode() {
		add_shortcode('getMixerWall',  array( $this, 'getMixerWall_content'));
	}
    
	public function getMixerWall_content($args, $content=''){
        ob_start();
        $this->getTwitchOutput($args);
        return ob_get_clean();
	}   
    
}

