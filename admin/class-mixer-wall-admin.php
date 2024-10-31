<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       none
 * @since      1.0.0
 *
 * @package    mixer_wall
 * @subpackage mixer_wall/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    mixer_wall
 * @subpackage mixer_wall/admin
 * @author     StreamWeasels <admin@streamweasels.com>
 */
class mixer_wall_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		if (isset($_GET['page']) && $_GET['page'] == 'mixer-wall') {
			wp_enqueue_style( 'mixer-easy-embed-admin-css', plugin_dir_url( __FILE__ ) . 'css/mixer-wall-admin.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'mixer-easy-embed-plugin-css', plugins_url( 'public/css/mixer-wall-public.css', dirname(__FILE__) ), array(), '', 'all' );
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

	}

	/**
	 * Register the JavaScript for the admin area.
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

		if (isset($_GET['page']) && $_GET['page'] == 'mixer-wall') {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mixer-wall-admin.js', array( 'jquery' ), $this->version, false );
		}

	}
    
	public function create_admin_page() {
		add_options_page( 'Mixer Wall', 'Easy Embed for Mixer (WALL)', 'manage_options', 'mixer-wall', 'mixer_ezembed_options_wall' );

		function mixer_ezembed_options_wall() {
		    $twitchOptions = get_option('mixer_ezembed_options_wall');
		    $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'main_options';

		    echo '<div>
		    <h2>Easy Embed for Mixer (Wall)</h2>
			<p>Easily add a customizable mixer.com embedded wall anywhere on your site. Fill in the options below to customize your wall.</p>';
			echo '<h2 style="text-align:center;">Layout Options</h2>';                
            echo '<p style="text-align:center;">Why not try one of our other Easy Embed Twitch TV plugins?</p>';
			echo '<p style="text-align:center;">Or if you\'re a streamer, why not try our FREE WordPress theme, integrated with Twitch, Mixer and YouTube straight out the box - <a href="https://www.streamweasels.com" target="_blank">Broadcast</a></p>';			
			echo '<div class="twitch-plugins-upsell">';
			echo '<div class="twitch-plugins-upsell-item"><img src="'.plugin_dir_url( __FILE__ ).'../admin/img/twitch-rail.png"><span>A customizable Twitch Rail - which shows three streams at a time and lets the users swipe streams left and right.</span><a href="https://en-gb.wordpress.org/plugins/ttv-easy-embed/" target="_blank">Twitch Rail</a></div>';
			echo '<div class="twitch-plugins-upsell-item"><img src="'.plugin_dir_url( __FILE__ ).'../admin/img/twitch-wall.png"><span>A customizable Twitch Wall - which shows many streams, which when clicked - activate the \'featured stream\' at the top. Includes chat.</span><a href="https://en-gb.wordpress.org/plugins/ttv-easy-embed-wall/" target="_blank">Twitch Wall</a></div>';     
			echo '<div class="twitch-plugins-upsell-item"><img src="'.plugin_dir_url( __FILE__ ).'../admin/img/twitch-player.png"><span>A customizable Twitch Player - which shows many streams, when clicked - activate the \'featured stream\' in the middle. Includes offline.</span><a href="https://en-gb.wordpress.org/plugins/ttv-easy-embed-player/" target="_blank">Twitch Player</a></div>';            
			echo '</div>';  				
		    echo '<h2 class="nav-tab-wrapper">
			    <a href="?page=mixer-wall&tab=main_options" class="nav-tab '.  ($active_tab == 'main_options' ? 'nav-tab-active' : '') .'">Main Options</a>
			    <a href="?page=mixer-wall&tab=appearance_options" class="nav-tab '.  ($active_tab == 'appearance_options' ? 'nav-tab-active' : '') .'">Appearance Options</a>';
            echo '<h2 style="text-align:center;">Mixer Wall Preview</h2>';
			echo '<p style="text-align:center;">Shortcode to output the Mixer Wall: [getMixerWall]</p></div>';
            echo '<p style="text-align:center;">Upgrade to <a href="https://www.streamweasels.com/store/plugins/mixer-wall-pro/" target="_blank">Mixer Wall PRO</a> to get advanced shortcode usage, which allows for <strong>multiple walls</strong>.</p>';			
		    include (plugin_dir_path( __FILE__ ) . '/../public/partials/output.php');
		    echo '<form class="twitch-form" action="options.php" method="post">';
		    if( $active_tab == 'main_options' ) {
		    settings_fields('mixer_ezembed_options_wall');
		    do_settings_sections('mixer_wall');
		    } elseif ( $active_tab == 'appearance_options' ) {
		    settings_fields('mixer_ezembed_appearance_options_wall');
		    do_settings_sections('mixer_wall_2');
		    } elseif ( $active_tab == 'license_options' ) {
		    settings_fields('mixer_ezembed_license_options_wall');
		    do_settings_sections('mixer_wall_3');
		    }
		    echo '<input name="Submit" type="submit" value="Save Changes" />
		    </form>';
		}
	}

	function mixer_ezembed_admin_init() {

	include ('partials/fields-output.php');
	include ('partials/sanitize.php');

	register_setting( 'mixer_ezembed_options_wall', 'mixer_ezembed_options_wall', 'mixer_ezembed_options_wall_validate');
	register_setting( 'mixer_ezembed_appearance_options_wall', 'mixer_ezembed_appearance_options_wall', 'mixer_ezembed_options_wall_validate');
	register_setting( 'mixer_ezembed_license_options_wall', 'mixer_ezembed_license_options_wall', 'mixer_ezembed_options_wall_validate');    
	add_settings_section('mixer_main_wall', 'Main Settings', 'mixer_wall_section_text', 'mixer_wall');
	add_settings_section('mixer_appearance_wall', 'Appearance Settings', 'mixer_wall_section_appearance_text', 'mixer_wall_2');
	add_settings_section('mixer_wall_license', 'License Settings', 'mixer_wall_section_license_text', 'mixer_wall_3');    
	add_settings_field('mixer_settings_game', 'Game', 'mixer_wall_settings_game', 'mixer_wall', 'mixer_main_wall');  
	add_settings_field('mixer_settings_channel', 'Channel', 'mixer_wall_settings_channel', 'mixer_wall', 'mixer_main_wall');
	add_settings_field('mixer_settings_team', 'Team', 'mixer_wall_settings_team', 'mixer_wall', 'mixer_main_wall');
	add_settings_field('mixer_settings_limit', 'Limit', 'mixer_wall_settings_limit', 'mixer_wall', 'mixer_main_wall');
	add_settings_field('mixer_appearance_colour_theme', 'Colour Theme', 'mixer_wall_appearance_colour_theme', 'mixer_wall_2', 'mixer_appearance_wall');
	add_settings_field('mixer_wall_settings_show_default', 'Show Featured Stream by default?', 'mixer_wall_settings_show_default', 'mixer_wall', 'mixer_main_wall');        


	function mixer_wall_section_text() {
	echo '<p>Fill in the below fields to hook your Mixer Wall upto mixer.com. Fill in the fields to start pulling streams from mixer!</p>';
	}
	function mixer_wall_section_appearance_text() {
	echo '<p>Fill in the below fields to fully configure the mixer.com wall.</p>';
	}     
}

}
