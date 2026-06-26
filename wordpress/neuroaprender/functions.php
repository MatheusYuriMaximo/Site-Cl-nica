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
	$path = ltrim( $path, '/' );

	if ( file_exists( neuroaprender_asset_path( $path ) ) ) {
		return get_stylesheet_directory_uri() . '/' . $path;
	}

	return 'https://matheusyurimaximo.github.io/Site-Cl-nica/' . $path;
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
	$css_path = get_stylesheet_directory() . '/style.css';

	wp_enqueue_style(
		'neuroaprender-fonts',
		'https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'neuroaprender-main',
		get_stylesheet_uri(),
		array( 'neuroaprender-fonts' ),
		file_exists( $css_path ) ? (string) filemtime( $css_path ) : '1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'neuroaprender_enqueue_assets' );

function neuroaprender_site_icon_tags(): void {
	$icon_uri = neuroaprender_asset_uri( 'assets/site-icon-neuroaprender.png' );
	?>
	<link rel="icon" href="<?php echo esc_url( $icon_uri ); ?>" sizes="512x512" type="image/png">
	<link rel="apple-touch-icon" href="<?php echo esc_url( $icon_uri ); ?>">
	<?php
}
add_action( 'wp_head', 'neuroaprender_site_icon_tags', 1 );
add_action( 'admin_head', 'neuroaprender_site_icon_tags', 1 );
add_action( 'login_head', 'neuroaprender_site_icon_tags', 1 );
