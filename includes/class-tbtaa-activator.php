<?php

/**
 * Fired during plugin activation
 *
 * @link       https://theboldtype.com
 * @since      1.0.0
 *
 * @package    Tbtaa
 * @subpackage Tbtaa/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Tbtaa
 * @subpackage Tbtaa/includes
 * @author     Adam Smith <adam@theboldtype.com>
 */
class Tbtaa_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_option('tbtaa_autocomplete_is_enabled', '0');
		add_option('tbtaa_use_in_woo', '0');
		add_option('tbtaa_google_api_key', '');
		add_option('tbtaa_target_class', '');
		add_option('tbtaa_target_id', '');
		add_option('tbtaa_target_name', '');
	}

}
