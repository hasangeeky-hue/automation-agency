<?php
/**
 * Anthropos Automation OS — theme setup (v4).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'ANTHROPOS_VERSION', '5.2.0' );

require_once get_template_directory() . '/inc/segments.php';

/** URL of a segment's service page (child of /services/). */
function anthropos_seg_url( $slug ) {
	$p = get_page_by_path( 'services/' . $slug );
	return $p ? get_permalink( $p ) : home_url( '/services/' . $slug . '/' );
}

/** Reusable 10-item FAQ section (JS fills [data-faq] from the shared FAQ set). */
function anthropos_faq_section() {
	$faq_pg = get_page_by_path( 'faq' );
	$faq_url = $faq_pg ? get_permalink( $faq_pg ) : home_url( '/faq/' );
	?>
	<section id="faq">
		<div class="wrap band reveal"><div class="eyebrow">FAQ · straight answers</div><h2>Questions we hear every week</h2><p class="soft">Ten honest answers before you book. Want more? See the <a href="<?php echo esc_url( $faq_url ); ?>" style="color:var(--flow)">full FAQ</a>.</p></div>
		<div class="wrap"><div class="faqwrap" data-faq="general"></div></div>
	</section>
	<?php
}

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
 * One-time bootstrap: create the Services / Guides / Blog pages the menu links to,
 * and set a static front page. Runs once in admin; guarded by an option flag so it
 * fires the first time an admin loads the dashboard after this version deploys.
 */
function anthropos_bootstrap_pages() {
	if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) { return; }
	if ( get_option( 'anthropos_bootstrapped_v53' ) ) { return; }

	// Parent "Services" page (overview listing) using the service template.
	$svc = get_page_by_path( 'services' );
	if ( ! $svc ) {
		$svc_id = wp_insert_post( array(
			'post_title'  => 'Services',
			'post_name'   => 'services',
			'post_status' => 'publish',
			'post_type'   => 'page',
			'post_content'=> '',
		) );
		if ( $svc_id && ! is_wp_error( $svc_id ) ) { update_post_meta( $svc_id, '_wp_page_template', 'template-service.php' ); }
	} else {
		$svc_id = $svc->ID;
	}
	// One child page per segment: /services/{slug}/ named "Automation Service for {Segment}".
	if ( $svc_id && ! is_wp_error( $svc_id ) && function_exists( 'anthropos_segments' ) ) {
		foreach ( anthropos_segments() as $slug => $seg ) {
			if ( get_page_by_path( 'services/' . $slug ) ) { continue; }
			$cid = wp_insert_post( array(
				'post_title'  => wp_specialchars_decode( $seg['title'] ),
				'post_name'   => $slug,
				'post_status' => 'publish',
				'post_type'   => 'page',
				'post_parent' => $svc_id,
				'post_content'=> '',
			) );
			if ( $cid && ! is_wp_error( $cid ) ) { update_post_meta( $cid, '_wp_page_template', 'template-service.php' ); }
		}
	}
	// Standalone service pages: Marketing Automation &amp; Social Media Automation.
	if ( function_exists( 'anthropos_service_pages' ) ) {
		foreach ( anthropos_service_pages() as $sslug => $sp ) {
			if ( get_page_by_path( $sslug ) ) { continue; }
			$spid = wp_insert_post( array(
				'post_title'  => wp_specialchars_decode( $sp['title'] ),
				'post_name'   => $sslug,
				'post_status' => 'publish',
				'post_type'   => 'page',
				'post_content'=> '',
			) );
			if ( $spid && ! is_wp_error( $spid ) ) { update_post_meta( $spid, '_wp_page_template', 'template-service.php' ); }
		}
	}
	// About page (Our Company / Vision / Team, designed with 3D).
	if ( ! get_page_by_path( 'about' ) ) {
		$aid = wp_insert_post( array( 'post_title' => 'About Us', 'post_name' => 'about', 'post_status' => 'publish', 'post_type' => 'page', 'post_content' => '' ) );
		if ( $aid && ! is_wp_error( $aid ) ) { update_post_meta( $aid, '_wp_page_template', 'template-about.php' ); }
	}
	// FAQ page (segmented master FAQ).
	if ( ! get_page_by_path( 'faq' ) ) {
		$fid = wp_insert_post( array( 'post_title' => 'FAQ', 'post_name' => 'faq', 'post_status' => 'publish', 'post_type' => 'page', 'post_content' => '' ) );
		if ( $fid && ! is_wp_error( $fid ) ) { update_post_meta( $fid, '_wp_page_template', 'template-faq.php' ); }
	}
	// Guides library landing (linked from inside service pages, not the header).
	$gpg = get_page_by_path( 'guides' );
	if ( ! $gpg ) {
		$gid = wp_insert_post( array( 'post_title' => 'Guides', 'post_name' => 'guides', 'post_status' => 'publish', 'post_type' => 'page', 'post_content' => '' ) );
	} else {
		$gid = $gpg->ID;
	}
	if ( $gid && ! is_wp_error( $gid ) ) { update_post_meta( $gid, '_wp_page_template', 'template-guides.php' ); }
	// Blog page (posts page).
	$blog = get_page_by_path( 'blog' );
	if ( ! $blog ) {
		$blog_id = wp_insert_post( array( 'post_title' => 'Blog', 'post_name' => 'blog', 'post_status' => 'publish', 'post_type' => 'page', 'post_content' => '' ) );
	} else {
		$blog_id = $blog->ID;
	}
	// Home page + static front.
	$home = get_page_by_path( 'home' );
	if ( ! $home ) {
		$home_id = wp_insert_post( array( 'post_title' => 'Home', 'post_name' => 'home', 'post_status' => 'publish', 'post_type' => 'page', 'post_content' => '' ) );
	} else {
		$home_id = $home->ID;
	}
	if ( $home_id && ! is_wp_error( $home_id ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
	}
	if ( $blog_id && ! is_wp_error( $blog_id ) ) {
		update_option( 'page_for_posts', $blog_id );
	}
	// Flush permalinks so the new /services/{slug}/ URLs resolve.
	flush_rewrite_rules();
	update_option( 'anthropos_bootstrapped_v53', 1 );
}
add_action( 'admin_init', 'anthropos_bootstrap_pages' );

/**
 * The 7 customer segments (slug => [label, hex]) — for reference/reuse.
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
