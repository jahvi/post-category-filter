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

class Post_Category_Filter {

    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @since   1.0.0
     *
     * @var     string
     */
    const VERSION = '1.3.0';

    /**
     * Unique identifier for your plugin.
     *
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * plugin file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $plugin_slug = 'admin-category-filter';

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      Post_Category_Filter
     */
    protected static $instance = null;

    /**
     * Initialize the plugin by setting localization and loading public scripts
     * and styles.
     *
     * @since     1.0.0
     */
    private function __construct() {
        // Load plugin text domain.
        add_action( 'plugins_loaded', array( $this, 'load_plugin_i18n' ) );

        // Load admin JavaScript.
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    Post_Category_Filter    A single instance of this class.
     */
    public static function get_instance() {
        // If the single instance hasn't been set, set it now.
        if ( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_i18n() {
        load_plugin_textdomain( $this->plugin_slug, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
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
            wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ), self::VERSION, true );
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
            'placeholder' => __( 'Filter Categories', 'admin-category-filter' )
        );
    }

}
