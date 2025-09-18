<?php

/**
 * Enqeue scripts and styles
 */
function odd_enqueues() {
	wp_enqueue_style( 'css-odd', get_stylesheet_directory_uri() . '/style.css', array(), time(), '' );
	wp_enqueue_style( 'css-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '5.3.3', '' );

	wp_enqueue_script( 'js-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array(), '', false );
	wp_enqueue_script( 'js-odd', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ), time(), false );
	wp_enqueue_script( 'js-slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '5.3.3', false );
}
add_action( 'wp_enqueue_scripts', 'odd_enqueues' );

/**
 * Theme Supports
 */
add_theme_support( 'post-thumbnails' );

/**
 * Menus
 */
register_nav_menus(
	array(
		'primary-menu'   => __( 'Primary Menu' ),
		'secondary-menu' => __( 'Secondary Menu' ),
	)
);

/**
 * Include functions
 */
require __DIR__ . '/functions/get-post-data.php';

/**
 * Include block classes
 */
require __DIR__ . '/blocks/AbstractBlock.php';
require __DIR__ . '/blocks/image-content/ImageContentBlock.php';
require __DIR__ . '/blocks/gallery/GalleryBlock.php';
require __DIR__ . '/blocks/content/ContentBlock.php';
require __DIR__ . '/blocks/slider/SliderBlock.php';
require __DIR__ . '/blocks/video/VideoBlock.php';
require __DIR__ . '/blocks/posts/PostBlock.php';
require __DIR__ . '/blocks/image/ImageBlock.php';
require __DIR__ . '/blocks/content-columns/ContentColumnsBlock.php';



/**
 * Register all ACF block files.
 */
function register_acf_blocks() {
	register_block_type( __DIR__ . '/blocks/image-content' );
	register_block_type( __DIR__ . '/blocks/gallery' );
	register_block_type( __DIR__ . '/blocks/content' );
	register_block_type( __DIR__ . '/blocks/slider' );
	register_block_type( __DIR__ . '/blocks/video' );
	register_block_type( __DIR__ . '/blocks/posts' );
	register_block_type( __DIR__ . '/blocks/image' );
	register_block_type( __DIR__ . '/blocks/content-columns' );
}
add_action( 'init', 'register_acf_blocks' );

/**
 * Pre-print
 *
 * @param mixed $data The data to print.
 */
function pp( $data ) {
	echo '<pre>';
	print_r( $data );
	echo '</pre>';
}
