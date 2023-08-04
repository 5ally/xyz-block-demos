/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import metadata from './block.json';

const Edit = ( { context } ) => (
	<div { ...useBlockProps() }>
		<p>[XYZ <b>Block</b> (CSR)] Post ID is <i>{ context.postId }</i>.</p>
	</div>
);

registerBlockType( metadata.name, {
	edit: Edit,
	// We don't return any markup or save anything to the post content because
	// this is a dynamic block.
	save: () => null,
} );
