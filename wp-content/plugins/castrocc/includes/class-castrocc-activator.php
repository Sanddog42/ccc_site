	<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.castrocountryclub.org
 * @since      1.0.0
 *
 * @package    CastroCC
 * @subpackage CastroCC/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    CastroCC
 * @subpackage CastroCC/includes
 * @author     Mario Hernandez <mario.hernandez@gmail.com>
 */
class CastroCC_Activator {



	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		require_once plugin_dir_path( __FILE__ ) . 'class-castrocc-data.php';

		$activator = new CastroCC_Data();
		$activator->createTables();

	}




}
