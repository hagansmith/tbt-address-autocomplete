<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://theboldtype.com
 * @since      1.0.0
 *
 * @package    Tbtaa
 * @subpackage Tbtaa/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Tbtaa
 * @subpackage Tbtaa/includes
 * @author     Adam Smith <adam@theboldtype.com>
 */
class Tbtaa_Deactivator {

	/**
	 * Function to remove options from DB.
	 *
	 * Removes registered options from DB.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		delete_option('tbtaa_autocomplete_is_enabled');
		delete_option('tbtaa_use_in_woo');
		delete_option('tbtaa_google_api_key');
		delete_option('tbtaa_target_class');
		delete_option('tbtaa_target_id');
		delete_option('tbtaa_target_name');
	}

}
