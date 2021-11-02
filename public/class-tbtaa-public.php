<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://theboldtype.com
 * @since      1.0.0
 *
 * @package    Tbtaa
 * @subpackage Tbtaa/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tbtaa
 * @subpackage Tbtaa/public
 * @author     Adam Smith <adam@theboldtype.com>
 */
class Tbtaa_Public {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tbtaa-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		$autocomplete_is_enabled = get_option('tbtaa_autocomplete_is_enabled');
		$google_api_key = get_option('tbtaa_google_api_key');

		if ( empty($autocomplete_is_enabled) || empty($google_api_key) ) {
			return;
		}

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tbtaa-public.js', array( 'jquery' ), $this->version );
		wp_enqueue_script( 'googleMaps', "https://maps.googleapis.com/maps/api/js?key=".(!empty($google_api_key) ? $google_api_key : '')."&libraries=places&channel=GMPSB_addressselection_v1_cAC", false, true);
	}

	function tbtaa_set_google_autocomplete(){

		$auto_fields = array();
		$tbtaa_selectors = ['name', 'class', 'id'];

		foreach ( $tbtaa_selectors as $selector ) {

			$option = get_option('tbtaa_target_' . $selector);

			if ( !empty($option) ) {
				$auto_fields[] = $option;
			}
		}

		if (get_option('tbtaa_use_in_woo')) {

			$auto_fields[] = '#billing_address_1';
			$auto_fields[] = '#shipping_address_1';

		}

	?>
	
	<script>
		var tbtaa_fields = '<?php echo implode(',' , $auto_fields);?>';
	</script>
	
	<?php }

}
