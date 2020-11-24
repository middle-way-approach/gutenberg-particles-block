<?php
/**
 * Plugin Name: particles-block
 * Plugin URI: https://github.com/middle-way-approach/gutenberg-particles-block
 * Description: A Gutenberg block to create a particle animation.
 * Author: middle-way-approach
 * Author URI: https://github.com/middle-way-approach
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';
