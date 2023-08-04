/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';

/**
 * Internal dependencies
 */
import metadata from './block.json';

const Edit = ( { context, attributes } ) => (
	<div { ...useBlockProps() }>
		<ServerSideRender
			block="my-plugin/xyz-block-ssr"
			attributes={ attributes }
			urlQueryArgs={ {
				// Let the render callback knows that this is an editor preview.
				preview: 1,
				// In the preview mode, get_the_ID() does not work (it returns a
				// `false`), hence let's send the post ID.
				post_id: context.postId,
			} }
		/>
	</div>
);

registerBlockType( metadata.name, {
	edit: Edit,
	// We don't return any markup or save anything to the post content because
	// this is a dynamic block.
	save: () => null,
} );
