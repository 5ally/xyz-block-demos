/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';

const Edit = ( { context } ) => (
	<div { ...useBlockProps() }>
		<p>[XYZ <b>Block</b> (CSR)] Post ID is <i>{ context.postId }</i>.</p>
	</div>
);

registerBlockType( 'my-plugin/xyz-block-csr', {
	apiVersion: 3,
	title: 'XYZ Block (CSR): context.postId demo',
	icon: 'megaphone',
	category: 'widgets',
	usesContext: [ 'postId' ],
	edit: Edit,
	// We don't return any markup or save anything to the post content because
	// this is a dynamic block.
	save: () => null,
} );
