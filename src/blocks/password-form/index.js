/**
 * Password form block
 *
 * @since 1.0.0
 */

import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { lock as icon } from '@wordpress/icons';

import edit from './edit';

registerBlockType( 'password-form-block/password-form', {
	apiVersion: 2,
	title: __( 'Password Form', 'ajax-posts-block' ),
	description: __(
		'Display the current post/page password form. Blocks before the form will be displayed without password validation.',
		'password-form-block'
	),
	icon,
	category: 'widgets',
	keywords: [ __( 'password' ), __( 'form' ), __( 'password form' ) ],

	edit,
	save: () => null,
} );
