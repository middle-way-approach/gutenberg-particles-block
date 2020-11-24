<?php
/**
 * Blocks Initializer
 *
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function particles_render_callback($attributes) {
	$height = $attributes['height'];
	return sprintf('<div style="min-height: 100px" class="particles" data-options="%1$s"></div>',
		htmlspecialchars(json_encode($attributes))
	);
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function particles_block_cgb_block_assets() { // phpcs:ignore

	// Register block editor script for backend.
	wp_register_script(
		'particles_block-cgb-block-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	wp_register_script(
		'particles', // Handle.
		plugins_url( '/vendor/canvas-nest.umd.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		null,
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	// WP Localized globals. Use dynamic PHP stuff in JavaScript via `cgbGlobal` object.
	wp_localize_script(
		'particles_block-cgb-block-js',
		'cgbGlobal', // Array containing dynamic data for a JS Global.
		[
			'pluginDirPath' => plugin_dir_path( __DIR__ ),
			'pluginDirUrl'  => plugin_dir_url( __DIR__ ),
			// Add more data here that you want to access from `cgbGlobal` object.
		]
	);


	wp_register_script(
		'frontend-js', // Handle.
		plugins_url( '/dist/frontend.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		null,
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	/**
	 * Register Gutenberg block on server-side.
	 *
	 * Register the block on server-side to ensure that the block
	 * scripts and styles for both frontend and backend are
	 * enqueued when the editor loads.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
	 * @since 1.16.0
	 */
	register_block_type(
		'cgb/block-particles-block', array(
			// Frontend scripts
			'script' =>	array('particles', 'frontend-js'),
			// Editor scripts
			'editor_script' => array('particles_block-cgb-block-js'),
			// The callback for rendering on server side.
			'render_callback' 	=> 'particles_render_callback'

		)
	);
}

// Hook: Block assets.
add_action( 'init', 'particles_block_cgb_block_assets' );
