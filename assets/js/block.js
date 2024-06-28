import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import Edit from './edit';
import Save from './save';

registerBlockType('dmg/read-more', {
    apiVersion: 2,
    title: __('DMG Read More', 'dmg'),
    description: __( 'A DMG Gutenberg block to add a "Read More" link to a selected post.', 'dmg' ),
    category: 'dmg',
    icon: 'admin-links',
    supports: {
        html: false,
    },
    attributes: {
        postID: {
            type: 'number',
            default: null,
        },
        postTitle: {
            type: 'string',
            default: '',
        },
        postURL: {
            type: 'string',
            default: '',
        },
    },
    edit: Edit,
    save: Save,
});
