<?php
/**
 * Post Category Filter
 *
 * @package   Post_Category_Filter
 * @author    Javier Villanueva <hi@jahvi.com>
 * @license   GPL-2.0+
 * @link      http://www.jahvi.com
 * @copyright 2014 Javier Villanueva
 */

class Post_Category_Filter_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		/*
		 * Call $plugin_slug from public plugin class.
		 *
		 */
		$plugin = Post_Category_Filter::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {
		$screen = get_current_screen();

		if ( 'post' === $screen->base ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), Post_Category_Filter::VERSION, true );
			wp_localize_script( $this->plugin_slug . '-admin-script', 'fc_plugin', $this->get_language_strings() );
		}
	}

	/**
	 * Get translation strings
	 *
	 * @since     1.0.0
	 *
	 * @return    array    Translatable strings
	 */
	public function get_language_strings() {
		return array(
			'placeholder' => __( 'Filter Categories', $this->plugin_slug )
		);
	}

}
