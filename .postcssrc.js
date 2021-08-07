/**
 * Add postcss plugins to @wordpress/scripts'
 *
 * @package Password_Form_Block
 */

// this had postcss-custom-properties and autoprefixer but the grid: true
// autoprefixer option was breaking some grid-template-* properties in the build

module.exports = () => ( {
	plugins: [
		require( 'postcss-custom-properties' )(),
		require( 'autoprefixer' )(/*{ grid: true }*/),
		require( 'postcss-custom-media' )( {
			preserve: false,
			importFrom: [ './src/assets/global/_custom-media.css' ],
		} ),
	],
} );
