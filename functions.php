<?php
/**
 * Anthropos Automation theme setup.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'ANTHROPOS_VERSION', '1.0.0' );

function anthropos_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'anthropos' ),
	) );
}
add_action( 'after_setup_theme', 'anthropos_setup' );

function anthropos_assets() {
	wp_enqueue_style(
		'anthropos-fonts',
		'https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,700;12..96,800&family=Fraunces:ital,opsz,wght@1,9..144,400;1,9..144,500&family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=JetBrains+Mono:wght@400;500&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'anthropos-style', get_stylesheet_uri(), array( 'anthropos-fonts' ), ANTHROPOS_VERSION );
	wp_enqueue_script( 'threejs', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), 'r128', true );
	wp_enqueue_script( 'anthropos-main', get_template_directory_uri() . '/assets/js/main.js', array( 'threejs' ), ANTHROPOS_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'anthropos_assets' );

/**
 * Map audience category slug -> hue class on story cards.
 */
function anthropos_story_classes( $post_id ) {
	$classes = array( 'aa-story' );
	$cats    = get_the_category( $post_id );
	if ( $cats ) {
		$classes[] = 'cat-' . $cats[0]->slug;
	}
	return implode( ' ', array_map( 'esc_attr', $classes ) );
}

/**
 * Fallback primary menu when none is assigned.
 */
function anthropos_fallback_menu() {
	$blog = get_permalink( get_option( 'page_for_posts' ) );
	if ( ! $blog ) { $blog = home_url( '/stories/' ); }
	echo '<ul class="aa-menu">';
	echo '<li><a href="' . esc_url( $blog ) . '">' . esc_html__( 'Stories', 'anthropos' ) . '</a><ul class="sub-menu">';
	foreach ( get_categories( array( 'hide_empty' => false ) ) as $cat ) {
		echo '<li><a href="' . esc_url( get_category_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
	}
	echo '</ul></li>';
	$links = array(
		'guides'       => __( 'Guide Library', 'anthropos' ),
		'what-we-do'   => __( 'What We Do', 'anthropos' ),
		'how-it-works' => __( 'How It Works', 'anthropos' ),
		'results'      => __( 'Results', 'anthropos' ),
	);
	foreach ( $links as $slug => $label ) {
		$page = get_page_by_path( $slug );
		if ( $page ) {
			echo '<li><a href="' . esc_url( get_permalink( $page ) ) . '">' . esc_html( $label ) . '</a></li>';
		}
	}
	echo '</ul>';
}

/**
 * Audience groups used by footer + filters (slug => label).
 */
function anthropos_groups() {
	return array(
		'regulated-professionals' => 'Regulated Professionals',
		'medical-professionals'   => 'Medical Professionals',
		'ecommerce-retail'        => 'E-Commerce & Retail',
		'service-professionals'   => 'Service Professionals',
		'freelancers-agencies'    => 'Freelancers & Agencies',
		'creators-coaches'        => 'Creators & Coaches',
		'b2b-providers'           => 'B2B Providers',
	);
}

function anthropos_group_hex() {
	return array(
		'regulated-professionals' => '#5B54C7',
		'medical-professionals'   => '#2E9C8F',
		'ecommerce-retail'        => '#E07A3F',
		'service-professionals'   => '#4C9E5F',
		'freelancers-agencies'    => '#CC5B8B',
		'creators-coaches'        => '#9061C9',
		'b2b-providers'           => '#3E8FA8',
	);
}
