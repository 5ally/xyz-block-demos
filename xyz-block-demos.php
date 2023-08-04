<?php
/**
 * Plugin Name: XYZ Block demos
 * Plugin URI: https://wordpress.stackexchange.com/a/417841/137402
 * Version: 1.0.0
 * Author: Sally CJ
 */

// Registers our "special" shortcode, xyz-shortcode.
require_once __DIR__ . '/class-xyz-shortcode.php';

// Registers the `my-plugin/xyz-block-csr` block.
require_once __DIR__ . '/blocks/xyz-block-csr/xyz-block-csr.php';

// Registers the `my-plugin/xyz-block-ssr` block.
require_once __DIR__ . '/blocks/xyz-block-ssr/xyz-block-ssr.php';
