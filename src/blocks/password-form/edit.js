/**
 * Password form block edit
 *
 * @since 1.0.0
 */

import { useBlockProps } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';

export default function Edit( { attributes } ) {
	return (
		<div { ...useBlockProps() }>
			<ServerSideRender
				block="password-form-block/password-form"
				attributes={ attributes }
			/>
		</div>
	);
}
