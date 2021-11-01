<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Tbtaa
 * @subpackage Tbtaa/admin
 * @author     Adam Smith <adam@theboldtype.com>
 */
class Tbtaa_Admin {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tbtaa-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tbtaa-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add the autocomplete settings to the admin nav.
	 *
	 * @since    1.0.0
	 */
	function tbtaa_address_autocomplete_admin_nav() {
		add_submenu_page(
			'options-general.php',
			'Address Autocomplete',
			'Address Autocomplete',
			'manage_options',
			'address_autocomplete',
			'tbtaa_address_autocomplete_settings'
		);

		include(plugin_dir_path( __FILE__ ) . 'partials/tbtaa-admin-display.php');
			
	}

}
