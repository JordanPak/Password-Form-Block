<?php
/**
 * Plugin Name: Password Form Block
 * Plugin URI: https://wordpress.org/plugins/password-form-block
 * Description: Editor block that displays the current post's password form and any blocks before it without a password.
 * Author: JordanPak
 * Author URI: https://jordanpak.com
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: password-form-block
 *
 * @package Password_Form_Block
 */

namespace Password_Form_Block;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PASSWORD_FORM_BLOCK_VERSION', '1.0.0' );
define( 'PASSWORD_FORM_BLOCK_DIR', plugin_dir_path( __FILE__ ) );
define( 'PASSWORD_FORM_BLOCK_URL', plugin_dir_url( __FILE__ ) );

// Get autoloader and helper functions.
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/functions.php';

/**
 * Plugin wrapper
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * The single instance of this class
	 *
	 * @since 1.0.0
	 * @var   Plugin
	 */
	protected static $instance;

	/**
	 * Blocks handler
	 *
	 * @since 1.0.0
	 * @var   Blocks
	 */
	public $blocks;

	/**
	 * Password handler
	 *
	 * @since 1.0.0
	 * @var   Password_Handler
	 */
	public $password_handler;

	/**
	 * Get main plugin instance.
	 *
	 * @since 1.0.0
	 * @see   instance()
	 *
	 * @return Plugin
	 */
	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Hook plugin in
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
		add_action( 'password_form_block_activate', [ $this, 'init' ], 5 );
	}

	/**
	 * Do block and asset registration
	 *
	 * @since 1.0.0
	 */
	public function init() {
		$this->blocks           = new Blocks();
		$this->password_handler = new Password_Handler();

		/**
		 * Hook: password_form_block_loaded
		 */
		do_action( 'password_form_block_loaded' );
	}

	/**
	 * Handle activation tasks
	 *
	 * @since 1.0.0
	 */
	public function do_activate() {
		/**
		 * Hook: password_form_block_activate
		 *
		 * @hooked password_form_block\init - 5
		 */
		do_action( 'password_form_block_activate' );
	}

	/**
	 * Handle deactivation tasks
	 *
	 * @since 1.0.0
	 */
	public function do_deactivate() {
		/**
		 * Hook: password_form_block_deactivate
		 */
		do_action( 'password_form_block_deactivate' );
	}
}

/**
 * Get instance of main plugin class
 *
 * @since 1.0.0
 *
 * @return Plugin
 */
function instance() {
	return Plugin::instance();
}

// Instantiate plugin wrapper class.
$password_form_block_plugin = instance();

// Register activation/deactivation stuff.
register_activation_hook( __FILE__, [ $password_form_block_plugin, 'do_activate' ] );
register_deactivation_hook( __FILE__, [ $password_form_block_plugin, 'do_deactivate' ] );
