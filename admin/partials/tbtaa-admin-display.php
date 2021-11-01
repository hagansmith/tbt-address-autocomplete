<?php

/**
 * Provide an admin area view for the plugin
 *
 *
 * @link       https://theboldtype.com
 * @since      1.0.0
 *
 * @package    Tbtaa
 * @subpackage Tbtaa/admin/partials
 */

function tbtaa_address_autocomplete_settings(){
	if(isset($_POST['tbtaa_settings'])){
		
		update_option('tbtaa_use_in_woo', '0');

		foreach ($_POST as $key=>$value) {

			if ( $key === 'tbtaa_settings' ) {
				continue;

			} elseif ( $key === 'tbtaa_google_api_key' ||  $key === 'tbtaa_use_in_woo') {
				update_option($key, esc_attr(str_replace(' ','', $value)));	
				continue;

			} else {
				$prepared_selectors = [];

				//break the provided selectors apart to append the 
				//syntactically correct jquery selection notation
				foreach( explode(',', $value) as $field ) {
					
					if ( empty($field) ) {
						continue;
					}

					$prepared_field = esc_attr(str_replace([' ', '#', '.', '[name="', '"]'], '', $field));

					switch ($key) {
						case 'tbtaa_target_name':
							$prepared_selectors[] = '[name="' . $prepared_field . '"]';
							break;
						case 'tbtaa_target_class':
							$prepared_selectors[] = "." . $prepared_field;
							break;
						case 'tbtaa_target_id':
							$prepared_selectors[] = "#" . $prepared_field;
							break;	
					}
				}

				update_option( $key, implode(',', $prepared_selectors));

			}
		}
	}
?>

    <div>
    	<h2>Address Autocomplete Settings</h2>
        <h3>Google Places API</h3>
    	<form method="post">
            <table>
                <tbody>
                <tr>
            		<th scope="row"><label for="tbtaa_google_api_key">Google Places API Key</label></th>
            		<td><input type="text" class="large-text code" name="tbtaa_google_api_key" id="tbtaa_google_api_key" value="<?php echo get_option('tbtaa_google_api_key');?>"/>
						For information on obtaining a Google Places API key <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Get API Key</a>
					</td>
                </tr>
				<?php if ( is_plugin_active('woocommerce/woocommerce.php') ) { ?>
				<tr>
					<th scope="row">Woo Commerce</th>
					<td><input type="checkbox" id="tbtaa_use_in_woo" name="tbtaa_use_in_woo" value="use_in_woo" <?php echo get_option('tbtaa_use_in_woo') === '0' ? '' : 'checked' ?> >
						<label for="tbtaa_use_in_woo">Use Autocomplete in WooCommerce Address Fields</label>
					</td>
				</tr>
				<?php } ?>
            	<tr>
					<th>Custom address inputs</th>
				</tr>
				<tr>
					<th></th>
					<td><p> For autocomplete to correctly fill your form, the address form that you are placing the autocomplete on needs field id's formatted with a uniqe prefix followed by the identifiers below (id="[unique]_address_1").
						<br/>_address_1 | _address_2 | _postcode | _city | _country | _state</p>
					</ul></td>
				</tr>
				<tr>
    		        <th scope="row"><label for="tbtaa_target_id">Field ID(s)</label></th> 
            		<td><textarea name="tbtaa_target_id" class="large-text code" id="tbtaa_target_id"><?php echo str_replace('#', '',stripslashes(get_option('tbtaa_target_id')));?></textarea><br>
            			The id of _address_1 input from your form &lt;input type="text" id="<b>unique_address_1</b>" /> and enter them in above field as comma separated. e.g. field1, field2 etc.
            		</td>
				</tr>
				<tr>
            		<th scope="row"><label for="tbtaa_target_class">Field Class(es)</label></th>
                    <td><textarea name="tbtaa_target_class" class="large-text code" id="tbtaa_target_class" ><?php echo str_replace('.', '',stripslashes(get_option('tbtaa_target_class')));?></textarea><br>
                        The class of textbox from markup &lt;input type="text" class="<b>field1</b>" /> and enter them in above field as comma separated. e.g. field1, field2 etc.
                    </td>
				</tr>
                <tr>
	                <th scope="row"><label for="tbtaa_target_name">Field Name(s)</label></th>
                	<td><textarea name="tbtaa_target_name" class="large-text code" id="tbtaa_target_name" ><?php echo str_replace(['[name="', '"]'], '',stripslashes(get_option('tbtaa_target_name')));?></textarea><br>
                        The name of textbox from markup &lt;input type="text" name="<b>field1</b>" /> and enter them in above field as comma separated. e.g. field1, field2 etc.
                	</td>
                </tr>
            </table>
			<button id="tbtaa_submit_admin" class="button button-primary button-large" type="submit" name="tbtaa_settings" value="Save"/>Save Settings</button>
    	</form>
    </div>

<?php
}
?>
