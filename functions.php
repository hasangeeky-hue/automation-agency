<?php
/**
 * Anthropos Automation OS — theme setup (v4).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'ANTHROPOS_VERSION', '5.9.0' );

require_once get_template_directory() . '/inc/segments.php';
require_once get_template_directory() . '/inc/content-seed.php';
require_once get_template_directory() . '/inc/content-seed-batch2.php';
require_once get_template_directory() . '/inc/content-seed-batch3.php';

/** Service tags (short code => label) — used as WP tags + filter buttons. */
function anthropos_service_tags() {
	return array(
		'web'   => 'Web Design',
		'aeo'   => 'AEO / GEO',
		'lead'  => 'Lead',
		'mkt'   => 'Marketing',
		'soc'   => 'Social',
		'whole' => 'Whole-Business',
	);
}

/** Register the ao_type taxonomy (Guide vs Blog) on posts. */
function anthropos_register_taxonomy() {
	register_taxonomy( 'ao_type', 'post', array(
		'label'        => 'Content Type',
		'public'       => true,
		'hierarchical' => false,
		'show_ui'      => true,
		'rewrite'      => false,
	) );
}
add_action( 'init', 'anthropos_register_taxonomy' );

/** URL of a segment's service page (child of /services/). */
function anthropos_seg_url( $slug ) {
	$p = get_page_by_path( 'services/' . $slug );
	return $p ? get_permalink( $p ) : home_url( '/services/' . $slug . '/' );
}

/** Localize root-relative internal links (href="/...") to full site URLs, so
 *  seeded article copy survives a domain or subdirectory move intact. */
function anthropos_localize_links( $html ) {
	return str_replace( 'href="/', 'href="' . home_url() . '/', $html );
}

/**
 * Canonical FAQ data — server-rendered as real <details> markup (not
 * JS-injected), so both search engines and AI answer engines can read the
 * actual Q&amp;A text without executing JavaScript.
 */
function anthropos_faq_data() {
	return array(
		'general' => array(
			array( 'How fast can you build my system?', 'Most systems go live in 4 weeks — audit &amp; blueprint, website, automation wiring, then connect-test-launch.' ),
			array( 'Do I own everything, or am I locked in?', 'You own it. Systems are built on your tools, handed over, and documented — no dependency on us.' ),
			array( 'What does it cost?', 'It depends on scope. Each service page shows five offers (€ Starter → €€€ A-to-Z); book a call for a fixed quote.' ),
			array( 'Do I need any technical skills?', 'No. We set everything up and hand it over with a simple walkthrough. You approve; the system runs.' ),
			array( 'Which tools do you use?', 'Your website + n8n + your existing CRM/email/calendar. We connect what you have — no rip-and-replace.' ),
			array( 'Will automation feel robotic to my customers?', 'No. It reads as attentive and on-brand — the goal is that it feels like you finally had time, not like a bot.' ),
			array( 'Is my data safe and GDPR-compliant?', 'Yes — EU-hosted, consent-based tools. For medical/therapy we never touch clinical or patient-data systems.' ),
			array( 'What if I only need one thing, like a website?', 'Start with a single offer and add the rest whenever you\'re ready. Mix &amp; match by pain and budget.' ),
			array( 'Do you write the content for me?', 'We launch with your existing info, credentials and proof. Ongoing content help is optional.' ),
			array( 'What happens after launch?', 'A documented handover, reporting on what works, and support options so the system keeps running.' ),
		),
		'gettingStarted' => array(
			array( 'How do we start?', 'Book a free 30-minute consultation. We map one leak live and show you the agent that closes it — no obligation.' ),
			array( 'How long until it\'s live?', 'Four weeks from kickoff for a full system; single offers are faster.' ),
			array( 'What do you need from me?', 'Access to your site/tools, your credentials and proof, and quick approvals along the way.' ),
			array( 'Can you work with my current website?', 'Often yes — we optimise what converts and rebuild only what\'s holding you back.' ),
		),
		'servicesScope' => array(
			array( 'What are the five offers?', 'Website Redesign, Lead &amp; Follow-up Automation, Marketing Automation, Social Media Automation, and full A-to-Z Transformation.' ),
			array( 'Can I combine services?', 'Yes — every service page is a micro-combo. Take one, or the whole system.' ),
			array( 'Do you serve my industry?', 'We serve seven segments: regulated, medical, e-commerce, service-based, freelancers, creators and B2B.' ),
			array( 'Who do you NOT work with?', 'Enterprise, large regulated practices, and anything needing heavy custom or compliance work.' ),
		),
		'automationTools' => array(
			array( 'What is n8n and why do you use it?', 'n8n is a workflow tool that connects your apps. It lets an AI agent move data between inbox, CRM, calendar and more — without brittle custom code.' ),
			array( 'What can an AI agent actually do?', 'Reply in seconds, qualify and route leads, follow up, draft content, and keep your tools in sync — within limits you set.' ),
			array( 'What will you never automate?', 'Anything that should stay human: clinical care, legal advice in writing, and sensitive decisions. Boundaries build trust.' ),
			array( 'Does it integrate with my CRM?', 'Yes — we connect common CRMs, inboxes, calendars and stores rather than replacing them.' ),
		),
		'trustPricing' => array(
			array( 'Is there a contract or lock-in?', 'No lock-in. You own the system; support is optional and month-to-month.' ),
			array( 'How is pricing structured?', 'By scope: € Starter, €€ Core/Growth, €€€ A-to-Z. You get a fixed quote after the consultation.' ),
			array( 'What ROI should I expect?', 'Ranges vary by profession — typically more leads, better conversion, and 10–20 hours/week saved. We show your numbers in the lead report.' ),
		),
	);
}

/** Render a group's Q&amp;A as real, server-side &lt;details&gt; markup — no JS required to read it. */
function anthropos_faq_render( $group = 'general' ) {
	$data  = anthropos_faq_data();
	$items = isset( $data[ $group ] ) ? $data[ $group ] : $data['general'];
	foreach ( $items as $i => $item ) {
		echo '<details' . ( 0 === $i ? ' open' : '' ) . '><summary>' . wp_kses_post( $item[0] ) . '</summary><p>' . wp_kses_post( $item[1] ) . '</p></details>';
	}
}

/** Emit FAQPage JSON-LD for a group, generated from the same data anthropos_faq_render() uses. */
function anthropos_faq_schema( $group = 'general' ) {
	$data  = anthropos_faq_data();
	$items = isset( $data[ $group ] ) ? $data[ $group ] : $data['general'];
	$entities = array();
	foreach ( $items as $item ) {
		$entities[] = array(
			'@type'          => 'Question',
			'name'           => wp_strip_all_tags( $item[0] ),
			'acceptedAnswer' => array( '@type' => 'Answer', 'text' => wp_strip_all_tags( $item[1] ) ),
		);
	}
	echo '<script type="application/ld+json">' . wp_json_encode( array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $entities,
	) ) . '</script>' . "\n";
}

/** Reusable FAQ section: server-rendered Q&amp;A + matching FAQPage schema. */
function anthropos_faq_section( $group = 'general' ) {
	$faq_pg = get_page_by_path( 'faq' );
	$faq_url = $faq_pg ? get_permalink( $faq_pg ) : home_url( '/faq/' );
	?>
	<section id="faq">
		<div class="wrap band reveal"><div class="eyebrow">FAQ · straight answers</div><h2>Questions we hear every week</h2><p class="soft">Ten honest answers before you book. Want more? See the <a href="<?php echo esc_url( $faq_url ); ?>" style="color:var(--flow)">full FAQ</a>.</p></div>
		<div class="wrap"><div class="faqwrap"><?php anthropos_faq_render( $group ); ?></div></div>
	</section>
	<?php anthropos_faq_schema( $group );
}

/** Meta description, canonical URL, and Open Graph / Twitter Card tags. */
function anthropos_document_meta() {
	$post_obj = get_queried_object();
	$desc = get_bloginfo( 'description' );
	if ( is_singular( 'post' ) ) {
		$excerpt = get_the_excerpt();
		$desc = $excerpt ? $excerpt : wp_trim_words( wp_strip_all_tags( get_the_content() ), 30 );
	} elseif ( is_page() && $post_obj instanceof WP_Post ) {
		$tmpl = get_page_template_slug( $post_obj );
		$pslug = $post_obj->post_name;
		if ( 'template-service.php' === $tmpl ) {
			$segs = function_exists( 'anthropos_segments' ) ? anthropos_segments() : array();
			$sps  = function_exists( 'anthropos_service_pages' ) ? anthropos_service_pages() : array();
			if ( isset( $segs[ $pslug ] ) ) {
				$desc = wp_strip_all_tags( $segs[ $pslug ]['sub'] );
			} elseif ( isset( $sps[ $pslug ] ) ) {
				$desc = wp_strip_all_tags( $sps[ $pslug ]['sub'] );
			} else {
				$desc = 'Automation service pages for seven customer segments plus marketing and social media automation — pick the page built for your business.';
			}
		} elseif ( 'template-about.php' === $tmpl ) {
			$desc = 'Meet the team behind Anthropos Automation OS and how we build AI-run automation systems for small businesses.';
		} elseif ( 'template-faq.php' === $tmpl ) {
			$desc = 'Straight answers on pricing, timelines, tools and what we automate — before you book a call.';
		} elseif ( 'template-guides.php' === $tmpl ) {
			$desc = 'Free, practical guides for turning leads into revenue with AI automation — filter by your business type or the service you need.';
		}
	} elseif ( is_home() || is_front_page() ) {
		$tagline = get_bloginfo( 'description' );
		$desc = $tagline ? $tagline : 'AI + n8n business automation: a converting website, answer-engine visibility, and AI agents that capture, qualify and follow up every lead.';
	} elseif ( is_category() || is_tag() ) {
		$desc = single_term_title( '', false ) . ' — automation guides and field notes from Anthropos Automation OS.';
	}
	$desc = wp_trim_words( wp_strip_all_tags( $desc ), 30, '…' );
	$url  = is_singular() ? get_permalink() : ( is_front_page() ? home_url( '/' ) : home_url( add_query_arg( array() ) ) );
	$title = wp_get_document_title();
	?>
<meta name="description" content="<?php echo esc_attr( $desc ); ?>">
<link rel="canonical" href="<?php echo esc_url( $url ); ?>">
<meta property="og:type" content="<?php echo is_singular( 'post' ) ? 'article' : 'website'; ?>">
<meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
<meta property="og:description" content="<?php echo esc_attr( $desc ); ?>">
<meta property="og:url" content="<?php echo esc_url( $url ); ?>">
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
<meta name="twitter:description" content="<?php echo esc_attr( $desc ); ?>">
	<?php
}
add_action( 'wp_head', 'anthropos_document_meta', 1 );

/** Sitewide Organization schema — one JSON-LD block per page. */
function anthropos_schema_organization() {
	$data = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Organization',
		'name'        => get_bloginfo( 'name' ),
		'url'         => home_url( '/' ),
		'description' => 'AI and n8n business-automation studio: converting websites, AEO/GEO answer-engine visibility, and AI agents that capture, qualify and follow up every lead.',
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data ) . '</script>' . "\n";
}
add_action( 'wp_head', 'anthropos_schema_organization', 2 );

/** Add the sitemap line to robots.txt (WP core still serves the default file). */
function anthropos_robots_txt( $output, $public ) {
	if ( '1' !== (string) $public ) { return $output; }
	$output .= "Sitemap: " . home_url( '/wp-sitemap.xml' ) . "\n";
	return $output;
}
add_filter( 'robots_txt', 'anthropos_robots_txt', 10, 2 );

/** Preconnect hints for the two third-party origins the theme depends on. */
function anthropos_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.googleapis.com', 'crossorigin' );
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
		$urls[] = array( 'href' => 'https://cdnjs.cloudflare.com', 'crossorigin' );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'anthropos_resource_hints', 10, 2 );

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
 * Seed real content: 7 segment categories + 6 service tags + ao_type terms
 * (guide/blog), then 18 real posts (9 guides + 9 blog articles) from
 * inc/content-seed.php. Guarded independently of page bootstrap so future
 * content batches can bump this flag without re-running page creation.
 */
function anthropos_seed_content() {
	if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) { return; }
	if ( get_option( 'anthropos_content_seeded_v3' ) ) { return; }
	if ( ! function_exists( 'anthropos_seed_posts' ) ) { return; }

	// Segment categories — slugs match anthropos_segments() keys exactly.
	if ( function_exists( 'anthropos_segments' ) ) {
		foreach ( anthropos_segments() as $slug => $seg ) {
			if ( ! term_exists( $slug, 'category' ) ) {
				wp_insert_term( wp_specialchars_decode( $seg['label'] ), 'category', array( 'slug' => $slug ) );
			}
		}
	}
	// Service tags — slugs match anthropos_service_tags() keys exactly.
	foreach ( anthropos_service_tags() as $slug => $label ) {
		if ( ! term_exists( $slug, 'post_tag' ) ) {
			wp_insert_term( $label, 'post_tag', array( 'slug' => $slug ) );
		}
	}
	// ao_type terms.
	foreach ( array( 'guide' => 'Guide', 'blog' => 'Blog' ) as $slug => $label ) {
		if ( ! term_exists( $slug, 'ao_type' ) ) {
			wp_insert_term( $label, 'ao_type', array( 'slug' => $slug ) );
		}
	}

	$seed_posts = anthropos_seed_posts();
	if ( function_exists( 'anthropos_seed_posts_batch2' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch2() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch3' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch3() );
	}
	foreach ( $seed_posts as $p ) {
		if ( get_page_by_path( $p['slug'], OBJECT, 'post' ) ) { continue; }
		$pid = wp_insert_post( array(
			'post_title'   => $p['title'],
			'post_name'    => $p['slug'],
			'post_status'  => 'publish',
			'post_type'    => 'post',
			'post_content' => anthropos_localize_links( $p['content'] ),
		) );
		if ( ! $pid || is_wp_error( $pid ) ) { continue; }
		if ( ! empty( $p['cat'] ) ) {
			$cat_term = get_term_by( 'slug', $p['cat'], 'category' );
			if ( $cat_term ) { wp_set_post_categories( $pid, array( $cat_term->term_id ) ); }
		}
		if ( ! empty( $p['tags'] ) ) {
			$tag_ids = array();
			foreach ( $p['tags'] as $tag_slug ) {
				$tag_term = get_term_by( 'slug', $tag_slug, 'post_tag' );
				if ( $tag_term ) { $tag_ids[] = $tag_term->term_id; }
			}
			if ( $tag_ids ) { wp_set_post_terms( $pid, $tag_ids, 'post_tag' ); }
		}
		wp_set_object_terms( $pid, $p['type'], 'ao_type' );
	}
	update_option( 'anthropos_content_seeded_v3', 1 );
}
add_action( 'admin_init', 'anthropos_seed_content', 20 );

/**
 * One-time migration: localize root-relative links in posts seeded before
 * anthropos_localize_links() existed, so already-published articles get the
 * same fix as newly-seeded ones without re-running the whole seed process.
 */
function anthropos_migrate_localize_links() {
	if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) { return; }
	if ( get_option( 'anthropos_links_localized_v1' ) ) { return; }
	$posts = get_posts( array( 'post_type' => 'post', 'posts_per_page' => -1, 'post_status' => 'publish' ) );
	foreach ( $posts as $post ) {
		if ( false === strpos( $post->post_content, 'href="/' ) ) { continue; }
		wp_update_post( array( 'ID' => $post->ID, 'post_content' => anthropos_localize_links( $post->post_content ) ) );
	}
	update_option( 'anthropos_links_localized_v1', 1 );
}
add_action( 'admin_init', 'anthropos_migrate_localize_links', 21 );
