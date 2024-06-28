<?php

declare(strict_types=1);

namespace DMG\Plugins\DMGReadMore\Command;

use WP_CLI;
use WP_Query;

/**
 * Class ReadMoreCommand
 *
 * @package DMG\Plugins\DMGReadMore\Command
 */
class ReadMoreCommand {
    /**
     * Search for posts containing the DMG Read More Gutenberg block within a specified date range.
     *
     * @param array $args Arguments for the command.
     * @param array $assoc_args Associative arguments for the command.
     */
    public static function search( array $args, array $assoc_args ): void {
        $date_before = $assoc_args[ 'date-before' ] ?? date( 'Y-m-d', strtotime( 'now' ) );
        $date_after = $assoc_args[ 'date-after' ] ?? date( 'Y-m-d', strtotime( '-30 days' ) );

        $query_args = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'date_query'     => [
                'after'     => $date_after,
                'before'    => $date_before,
                'inclusive' => true,
            ],
            'meta_query'     => [
                [
                    'key'     => '_wp_blocks',
                    'value'   => 'dmg/read-more',
                    'compare' => 'LIKE',
                ],
            ],
            'fields'         => 'ids',
            'posts_per_page' => -1,
        ];

        $query = new WP_Query( $query_args );

        if ( $query->have_posts() ) {
            foreach ( $query->posts as $post_id ) {
                WP_CLI::log( $post_id );
            }
        } else {
            WP_CLI::log( 'No posts found within the specified date range containing the DMG Read More block.' );
        }
    }
}
