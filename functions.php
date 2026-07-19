<?php
/**
 * Anthropos Automation OS — theme setup (v3).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'ANTHROPOS_VERSION', '3.0.2' );

function anthropos_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	register_nav_menus( array( 'primary' => __( 'Primary Menu', 'anthropos' ) ) );
}
add_action( 'after_setup_theme', 'anthropos_setup' );

function anthropos_assets() {
	wp_enqueue_style(
		'anthropos-fonts',
		'https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=JetBrains+Mono:wght@400;500;600&display=swap',
		array(), null
	);
	wp_enqueue_style( 'anthropos-style', get_stylesheet_uri(), array( 'anthropos-fonts' ), ANTHROPOS_VERSION );
	wp_enqueue_script( 'threejs', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), 'r128', true );
	wp_enqueue_script( 'anthropos-main', get_template_directory_uri() . '/assets/js/main.js', array( 'threejs' ), ANTHROPOS_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'anthropos_assets' );

/**
 * Fallback primary menu (used until the user assigns one).
 */
function anthropos_fallback_menu() {
	echo '<ul class="nav">';
	echo '<li><a href="#about">About Us</a><ul class="sub-menu">';
	echo '<li><a href="#about">Our Company</a></li><li><a href="#team">Our Team</a></li><li><a href="#solve">How We Solve It</a></li><li><a href="#about">Our Vision</a></li>';
	echo '</ul></li>';
	echo '<li><a href="#services">Services</a><ul class="sub-menu">';
	echo '<li><a href="#services">Conversion Web Design</a></li><li><a href="#services">AEO / GEO / SEO</a></li><li><a href="#services">Lead &amp; Marketing Automation</a></li><li><a href="#services">Whole-Business Automation</a></li>';
	echo '</ul></li>';
	$blog = get_permalink( get_option( 'page_for_posts' ) );
	echo '<li><a href="' . esc_url( $blog ? $blog : home_url( '/blog/' ) ) . '">Blog</a></li>';
	echo '<li><a href="#team">Team</a></li>';
	echo '</ul>';
}

/**
 * Customer segments (slug => [label, hex]) — the 7 groups from the business
 * model. Shared by the industries section, the Services menu, and the footer.
 */
function anthropos_groups() {
	return array(
		'regulated-professionals' => array( 'Regulated Professionals', '#7C86FF' ),
		'medical-professionals'   => array( 'Medical Professionals', '#2FE3D2' ),
		'ecommerce-retail'        => array( 'E-Commerce &amp; Retail', '#FF8A5C' ),
		'service-professionals'   => array( 'Service-Based Professionals', '#46E08B' ),
		'freelancers-agencies'    => array( 'Freelancers &amp; Micro-Agencies', '#FFC24B' ),
		'creators-coaches'        => array( 'Creators &amp; Coaches', '#E56BFF' ),
		'b2b-providers'           => array( 'B2B Service Providers', '#5FA8FF' ),
	);
}
