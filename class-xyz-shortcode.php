<?php
/**
 * A sample class which implements the 1st workaround listed in my answer, i.e.
 * a shortcode function which returns a special tag like %xyz_shortcode%, and
 * uses the render_block filter to replace that tag with the "real" content.
 */
class XYZ_Shortcode {
	/**
	 * Array of %xyz-shortcode-<MD5 hash>% tags and attributes parsed from the
	 * shortcode. I.e. $tag => $atts
	 *
	 * @var array
	 */
	private $instances = array();

	/**
	 * Array of block type names, where blocks of these types will be searched
	 * for the above tags.
	 *
	 * @var array
	 */
	const ALLOWED_BLOCKS = array(
		'core/shortcode', // Shortcode block.
		'core/paragraph', // Paragraph block.
		'core/html',      // Custom HTML block.
	);

	/**
	 * Constructor.
	 */
	public function __construct() {
		/*
		 * In normal situations, we would otherwise use:
		 * `add_shortcode( 'xyz-shortcode', array( $this, 'shortcode' ) );`
		 */
		add_shortcode( 'xyz-shortcode', array( $this, 'add_shortcode_instance' ) );

		add_filter( 'render_block', array( $this, 'replace_shortcode_tags' ), 10, 2 );
	}

	/**
	 * @param array|string $atts Shortcode attributes array or empty string.
	 * @return string      $tag
	 */
	public function add_shortcode_instance( $atts ) {
		$hash = md5( http_build_query( (array) $atts ) );

		$this->instances[ $hash ] = $atts;

		return "%xyz-shortcode-$hash%";
	}

	/**
	 * @param string $block_content The block content.
	 * @param array  $block         The full block, including name and attributes.
	 * @return string $block_content The maybe-filtered block content.
	 */
	public function replace_shortcode_tags( $block_content, $block ) {
		if ( ! in_array( $block['blockName'], self::ALLOWED_BLOCKS ) ) {
			return $block_content;
		}

		foreach ( $this->instances as $hash => $atts ) {
			$block_content = str_replace(
				"%xyz-shortcode-$hash%",
				$this->shortcode( $atts ),
				$block_content
			);
		}

		return $block_content;
	}

	/**
	 * @param array|string $atts Shortcode attributes array or empty string.
	 * @return string      $content
	 */
	public function shortcode( $atts ) {
		return sprintf(
			'<b>[XYZ Shortcode] Post ID is <i>%d</i>.</b>',
			get_the_ID()
		);
	}
}

return new XYZ_Shortcode();
