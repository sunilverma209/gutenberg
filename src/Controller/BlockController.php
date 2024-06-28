<?php
/**
 * Class for loadin Gutenberg blocks.
 *
 * @package DMG\Plugins\DMGReadMore
 */

declare( strict_types=1 );

namespace DMG\Plugins\DMGReadMore\Controller;

use WP_Block_Type_Registry;

/**
 * BlockController class.
 *
 * @package DMG\Plugins\DMGReadMore.
 */
class BlockController {

    private const ASSETS_HANDLE_PREFIX = 'dmg-read-more-';

	/**
	 * Init method for defining hooks.
	 */
	public function init(): void {
		add_action( 'init', [ $this, 'create_gutenburg_blocks' ], 10, 2 );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_assets' ] );
		add_action( 'enqueue_block_assets', [ $this, 'enqueue_assets' ] );
		add_filter( 'block_categories_all', [ $this, 'register_custom_categories' ] );
	}

    /**
	 * Register gutenburg blocks.
	 * This is to add feature if block.json approach blocks we need to use i.e ACF
	 *
	 * @return bool
	 */
	public function create_gutenburg_blocks(): void {

		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

        foreach ( glob( plugin_dir_path(__FILE__) . '../../assets/blocks/*/block.json' ) as $block ) {
            register_block_type( $block );
        }
	}

    /**
	 * Register dmg categories for gutenburg blocks.
	 * 
	 * @param array[] $categories Array of categories.
	 * 
	 * @return array[]
	 */
	public function register_custom_categories( array $categories ): array {
		return array_merge(
			[
				[
					'slug' => 'dmg',
					'title' => 'DMG',
				],
			],
			$categories
		);
	}


	/**
	 * Enqueue assets for the block editor and frontend
	 *
	 * @return void
	 */
	public function enqueue_assets(): void {

		// Enqueue block editor script
		wp_enqueue_script(
			self::ASSETS_HANDLE_PREFIX . 'blocks',
			plugins_url( 'build/block.build.js', dirname( __FILE__, 2 ) ),
			array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-api-fetch' ),
			filemtime( plugin_dir_path(dirname( __FILE__, 2 )) . 'build/block.build.js' )
		);
		
		// Enqueue block editor styles
		wp_enqueue_style(
			self::ASSETS_HANDLE_PREFIX . 'editor-style',
			plugins_url( 'assets/css/editor.css', dirname( __FILE__, 2 ) ),
			array('wp-edit-blocks'),
			filemtime( plugin_dir_path(dirname( __FILE__, 2 )) . 'assets/css/editor.css' )
		);
		
		// Enqueue block frontend styles
		wp_enqueue_style(
			self::ASSETS_HANDLE_PREFIX . 'frontend-style',
			plugins_url( 'assets/css/style.css', dirname( __FILE__, 2 ) ),
			array(),
			filemtime( plugin_dir_path(dirname( __FILE__, 2 )) . 'assets/css/style.css' )
		);
	}
}
