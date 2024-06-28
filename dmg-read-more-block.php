<?php
/**
 * Plugin Name: DMG Read More Block
 * Description: A custom Gutenberg block to add a "Read More" link to a selected post.
 * Version: 1.0.0
 * Author: DMG
 * Text Domain: dmg
 */

namespace DMG\Plugins\DMGReadMore;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Autoload dependencies
require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

use DMG\Plugins\DMGReadMore\Controller\BlockController;
use DMG\Plugins\DMGReadMore\Command\ReadMoreCommand;
use WP_CLI;

/**
 * BlockController Class
 * 
 * @var BlockController $blockController
 */
$blockController = new BlockController();
$blockController->init();

if ( defined( 'WP_CLI' ) && WP_CLI ) {
    WP_CLI::add_command( 'dmg-read-more search', [ ReadMoreCommand::class, 'search' ] );
}
