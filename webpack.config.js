const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const path = require('path');

module.exports = {
    ...defaultConfig,
    entry: './assets/js/block.js',
    output: {
        path: path.resolve(__dirname, 'build'),
        filename: 'block.build.js',
    },
};
