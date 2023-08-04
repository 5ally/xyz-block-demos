<?php
/**
 * Plugin Name: XYZ Block SSR
 * Plugin URI: https://wordpress.stackexchange.com/a/417841/137402
 * Version: 1.0.0
 * Author: Sally CJ
 */

/**
 * Renders the `my-plugin/xyz-block-ssr` block on the server.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 *
 * @return string
 */
function xyz_block_ssr_render_callback( $attributes, $content, $block ) {
	// Note: $block->context['postId'] is null in preview mode.
	if ( ! empty( $_GET['preview'] ) ) {
		$post_id = filter_input( INPUT_GET, 'post_id', FILTER_SANITIZE_NUMBER_INT );
		$post    = $post_id ? get_post( $post_id ) : null;

		return sprintf(
			'<p>[XYZ <b>Block</b> (SSR)] Post ID is <i>%d</i>%s.</p>',
			$post ? $post_id : "Invalid post ID - $post_id",
			$post ? ' ("' . get_the_title( $post ) . '")' : ''
		);
	} else {
		return sprintf(
			'<p>[XYZ <b>Block</b> (SSR)] Post ID is <i>%d</i> ("%s").</p>',
			get_the_ID(),
			get_the_title()
		);
	}
}

/**
 * Registers the `my-plugin/xyz-block-ssr` block on the server.
 */
function xyz_block_ssr() {
	register_block_type(
		__DIR__,
		array( 'render_callback' => 'xyz_block_ssr_render_callback' )
	);

}
add_action( 'init', 'xyz_block_ssr' );
