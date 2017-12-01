<?php
/**
 * Post Category Filter
 *
 * Filter post categories and taxonomies live in the WordPress admin area
 *
 * @package   Post_Category_Filter
 * @author    Javier Villanueva <hi@jahvi.com>
 * @license   GPL-2.0+
 * @link      http://www.jahvi.com
 * @copyright 2016 Javier Villanueva
 *
 * @wordpress-plugin
 * Plugin Name:       Post Category Filter
 * Plugin URI:        http://www.jahvi.com
 * Description:       Filter post categories and taxonomies live in the WordPress admin area
 * Version:           1.6.1
 * Author:            Javier Villanueva
 * Author URI:        http://www.jahvi.com
 * Text Domain:       admin-category-filter
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

    require_once( plugin_dir_path( __FILE__ ) . 'class-category-filter.php' );
    add_action( 'plugins_loaded', array( 'Post_Category_Filter', 'get_instance' ) );

}
