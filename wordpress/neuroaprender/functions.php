<?php
/**
 * Theme functions for NeuroAprender.
 *
 * @package NeuroAprender
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function neuroaprender_asset_uri( string $path ): string {
	return get_template_directory_uri() . '/' . ltrim( $path, '/' );
}

function neuroaprender_asset_path( string $path ): string {
	return get_template_directory() . '/' . ltrim( $path, '/' );
}

function neuroaprender_setup(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'script',
			'search-form',
			'style',
		)
	);
}
add_action( 'after_setup_theme', 'neuroaprender_setup' );

function neuroaprender_enqueue_assets(): void {
	$css_path = neuroaprender_asset_path( 'assets/css/neuroaprender.css' );
	$js_path  = neuroaprender_asset_path( 'assets/js/neuroaprender.js' );

	wp_enqueue_style(
		'neuroaprender-fonts',
		'https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'neuroaprender-main',
		neuroaprender_asset_uri( 'assets/css/neuroaprender.css' ),
		array( 'neuroaprender-fonts' ),
		file_exists( $css_path ) ? (string) filemtime( $css_path ) : '1.0.0'
	);

	wp_enqueue_script(
		'neuroaprender-main',
		neuroaprender_asset_uri( 'assets/js/neuroaprender.js' ),
		array(),
		file_exists( $js_path ) ? (string) filemtime( $js_path ) : '1.0.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'neuroaprender_enqueue_assets' );

