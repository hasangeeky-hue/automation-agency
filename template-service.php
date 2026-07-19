<?php
/**
 * Template Name: Automation Service Page
 * Renders: (a) a segment page (hero + 5 offers + 10 guides + siblings),
 *          (b) a service page — Marketing / Social Media Automation,
 *          (c) the /services/ overview listing.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$guides_url = home_url( '/guides/' );
$svc        = home_url( '/services/' );
$segs       = function_exists( 'anthropos_segments' ) ? anthropos_segments() : array();
$svcpages   = function_exists( 'anthropos_service_pages' ) ? anthropos_service_pages() : array();
$slug       = get_post_field( 'post_name', get_queried_object_id() );

/** Real post URL by slug, or null if not published yet. */
function anthropos_find_post_url( $slug ) {
	$posts = get_posts( array( 'name' => $slug, 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 1 ) );
	return $posts ? get_permalink( $posts[0] ) : null;
}

/** One real, published flagship guide per page (index => post slug). The rest
 *  of each page's 10 guide titles are queued and link to the guides library. */
function anthropos_flagship_guides() {
	return array(
		'regulated-professionals' => array( 3, 'guide-60-second-reply-regulated' ),
		'medical-professionals'   => array( 3, 'guide-60-second-reply-medical' ),
		'ecommerce-retail'        => array( 1, 'guide-cart-recovery-sequence' ),
		'service-professionals'   => array( 3, 'guide-booking-confirmation-noshows' ),
		'freelancers-agencies'    => array( 4, 'guide-proposal-followup-day5' ),
		'creators-coaches'        => array( 5, 'guide-free-to-paid-30-day' ),
		'b2b-providers'           => array( 4, 'guide-day5-followup-stakeholder-routing' ),
		'marketing-automation'    => array( 2, 'guide-seasonal-campaigns-schedule' ),
		'social-media-automation' => array( 2, 'guide-repurposing-one-guide-into-month' ),
	);
}

/** Render a 10-card guide grid; the page's flagship guide (if published) links
 *  to its real article, the rest link to the guides library — queued, not dead. */
function anthropos_guide_grid( $titles, $hue, $url, $page_slug = '' ) {
	$flagships = anthropos_flagship_guides();
	$flag_i = -1; $flag_url = null;
	if ( $page_slug && isset( $flagships[ $page_slug ] ) ) {
		$flag_i   = $flagships[ $page_slug ][0];
		$flag_url = anthropos_find_post_url( $flagships[ $page_slug ][1] );
	}
	echo '<div class="wrap"><div class="guides" style="--hue:' . esc_attr( $hue ) . '">';
	foreach ( $titles as $i => $t ) {
		$is_flag = ( $i === $flag_i && $flag_url );
		$href    = $is_flag ? $flag_url : $url;
		$tag     = $is_flag ? 'Read the full guide →' : 'problem → solution → CTA';
		echo '<a class="glass gcard" href="' . esc_url( $href ) . '" style="--hue:' . esc_attr( $hue ) . '"><div class="gi">G' . ( $i < 9 ? '0' : '' ) . ( $i + 1 ) . '</div><h5>' . wp_kses_post( $t ) . '</h5><div class="ga">' . esc_html( $tag ) . '</div></a>';
	}
	echo '</div></div>';
}

/* =================== SERVICE PAGE (marketing / social) =================== */
if ( isset( $svcpages[ $slug ] ) ) :
	$s = $svcpages[ $slug ];
	?>
	<section class="hero" style="--hue:<?php echo esc_attr( $s['hue'] ); ?>">
		<canvas class="fx" data-net data-nodes="70" data-pulses="46" aria-hidden="true"></canvas>
		<div class="hero-in">
			<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> / <a href="<?php echo esc_url( $svc ); ?>">Services</a> / <?php echo wp_kses_post( $s['label'] ); ?></div>
			<h1><span class="grad"><?php echo wp_kses_post( $s['title'] ); ?></span></h1>
			<p class="sub"><?php echo wp_kses_post( $s['sub'] ); ?></p>
			<div class="hero-ctas"><a class="btn btn-cta" href="#cta">Book a non-binding consultation</a><a class="btn btn-glass" href="#blocks">What's inside ↓</a></div>
		</div>
	</section>
	<section id="blocks">
		<div class="wrap band reveal"><div class="eyebrow">What's inside · five moving parts</div><h2>How <?php echo wp_kses_post( $s['label'] ); ?> works</h2></div>
		<div class="wrap">
			<?php foreach ( $s['blocks'] as $b ) {
				echo '<div class="glass sp-block reveal" style="--hue:' . esc_attr( $b[1] ) . '"><div class="sp-fx"><canvas data-fx="' . esc_attr( $b[0] ) . '" style="--hue:' . esc_attr( $b[1] ) . '"></canvas></div><div class="sp-body"><span class="no">' . esc_html( $b[2] ) . '</span><h3>' . wp_kses_post( $b[3] ) . '</h3><p>' . wp_kses_post( $b[4] ) . '</p><a class="bcta" href="#cta">Book a call about this →</a></div></div>';
			} ?>
		</div>
	</section>
	<section id="article">
		<div class="wrap band reveal"><div class="eyebrow">Why this, and how it works</div><h2>The full picture</h2></div>
		<div class="wrap"><div class="glass" style="padding:32px 36px"><div class="aa-content"><?php echo wp_kses_post( $s['article'] ); ?></div></div></div>
	</section>
	<section id="guides">
		<div class="wrap band reveal"><div class="eyebrow">10 guides · problem → solution → CTA</div><h2>Guides for <?php echo wp_kses_post( $s['label'] ); ?></h2></div>
		<?php anthropos_guide_grid( isset( $s['guides'] ) ? $s['guides'] : array(), $s['hue'], $guides_url, $slug ); ?>
	</section>
	<section id="siblings">
		<div class="wrap band reveal"><div class="eyebrow">Need it for a specific business?</div><h2>See it inside your automation service page</h2></div>
		<div class="wrap"><div class="siblings">
			<?php foreach ( $segs as $sslug => $seg ) { echo '<a class="glass sib reveal" href="' . esc_url( anthropos_seg_url( $sslug ) ) . '" style="--hue:' . esc_attr( $seg['hue'] ) . '"><span class="sd"></span><span><b>' . wp_kses_post( $seg['label'] ) . '</b></span></a>'; } ?>
		</div></div>
	</section>
	<?php
	anthropos_faq_section();
	get_footer();
	return;
endif;

/* =================== OVERVIEW /services/ =================== */
if ( ! isset( $segs[ $slug ] ) ) :
	?>
	<section class="hero" style="--hue:var(--flow)">
		<canvas class="fx" data-net data-nodes="80" data-pulses="55" aria-hidden="true"></canvas>
		<div class="hero-in">
			<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> / Services</div>
			<h1>Automation, <span class="grad">shaped to your business</span></h1>
			<p class="sub">Pick your business type for a page tailored to your pains and offers — or go straight to a specific service.</p>
		</div>
	</section>
	<section id="all">
		<div class="wrap band reveal"><div class="eyebrow">By business type · one page each</div><h2>The seven automation service pages</h2></div>
		<div class="wrap"><div class="grid-4">
			<?php foreach ( $segs as $sslug => $seg ) { echo '<a class="glass card reveal tilt" href="' . esc_url( anthropos_seg_url( $sslug ) ) . '" style="--hue:' . esc_attr( $seg['hue'] ) . '"><div class="card-b"><span class="lbl">' . wp_kses_post( $seg['label'] ) . '</span><h4>' . wp_kses_post( $seg['title'] ) . '</h4><span class="go">Open →</span></div></a>'; } ?>
		</div></div>
	</section>
	<section id="svcpages">
		<div class="wrap band reveal"><div class="eyebrow">By service · standalone</div><h2>Marketing &amp; Social Media Automation</h2></div>
		<div class="wrap"><div class="grid-3">
			<?php foreach ( $svcpages as $sslug => $sp ) { $u = get_page_by_path( $sslug ); $uu = $u ? get_permalink( $u ) : home_url( '/' . $sslug . '/' ); echo '<a class="glass card reveal tilt" href="' . esc_url( $uu ) . '" style="--hue:' . esc_attr( $sp['hue'] ) . '"><div class="card-b"><span class="lbl">Service</span><h4>' . wp_kses_post( $sp['title'] ) . '</h4><span class="go">Open →</span></div></a>'; } ?>
		</div></div>
	</section>
	<?php
	anthropos_faq_section();
	get_footer();
	return;
endif;

/* =================== SEGMENT PAGE — 5 offers =================== */
$seg = $segs[ $slug ];
$hue = $seg['hue'];
$offers = function_exists( 'anthropos_offers' ) ? anthropos_offers() : array();
?>
<section class="hero" style="--hue:<?php echo esc_attr( $hue ); ?>">
	<canvas class="fx" data-net data-nodes="70" data-pulses="46" aria-hidden="true"></canvas>
	<div class="hero-in">
		<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> / <a href="<?php echo esc_url( $svc ); ?>">Services</a> / <?php echo wp_kses_post( $seg['label'] ); ?></div>
		<h1><?php echo wp_kses_post( str_replace( $seg['label'], '<span class="grad">' . $seg['label'] . '</span>', $seg['title'] ) ); ?></h1>
		<p class="sub"><?php echo wp_kses_post( $seg['sub'] ); ?></p>
		<div class="hero-ctas"><a class="btn btn-cta" href="#cta">Book a non-binding consultation</a><a class="btn btn-glass" href="#blocks">See the 5 offers ↓</a></div>
	</div>
</section>

<section id="blocks">
	<div class="wrap band reveal"><div class="eyebrow">Choose your scope · 5 offers, by your pain &amp; budget</div><h2>Start with what hurts most — or transform everything at once</h2><p class="soft">Five ways to work with us. Pick the one that matches your biggest leak and your budget; add the rest whenever you're ready.</p></div>
	<div class="wrap">
		<?php foreach ( $offers as $o ) {
			echo '<div class="glass sp-block reveal" style="--hue:' . esc_attr( $o[1] ) . '"><div class="sp-fx"><canvas data-fx="' . esc_attr( $o[0] ) . '" style="--hue:' . esc_attr( $o[1] ) . '"></canvas></div><div class="sp-body"><div class="sp-head"><span class="no">' . esc_html( $o[2] ) . '</span><span class="tier">' . esc_html( $o[3] ) . '</span></div><h3>' . wp_kses_post( $o[4] ) . '</h3><p class="bestfor"><b>Best if:</b> ' . wp_kses_post( $o[5] ) . '</p><p>' . wp_kses_post( $o[6] ) . '</p><a class="bcta" href="#cta">Book a call about this →</a></div></div>';
		} ?>
		<div class="glass offer-note reveal"><b>Not sure which?</b> <span class="pill">Mix &amp; match</span> Start with one, add the rest as you grow — or book a call and we'll map your biggest leak first. <a class="bcta" href="#cta" style="--hue:var(--flow)">Book a non-binding call →</a></div>
	</div>
</section>

<section id="article">
	<div class="wrap band reveal"><div class="eyebrow">Why this, and how it works</div><h2>The full picture for <?php echo wp_kses_post( $seg['label'] ); ?></h2></div>
	<div class="wrap"><div class="glass" style="padding:32px 36px"><div class="aa-content"><?php echo wp_kses_post( $seg['article'] ); ?></div></div></div>
</section>

<section id="guides">
	<div class="wrap band reveal"><div class="eyebrow">10 guides for this business · problem → solution → CTA</div><h2>Research-grade guides for <?php echo wp_kses_post( $seg['label'] ); ?></h2><p class="soft">Read free, apply free — or have us build the whole system.</p></div>
	<?php anthropos_guide_grid( $seg['guides'], $hue, $guides_url, $slug ); ?>
</section>

<section id="siblings">
	<div class="wrap band reveal"><div class="eyebrow">Not your world? Jump to yours</div><h2>The other automation service pages</h2></div>
	<div class="wrap"><div class="siblings">
		<?php foreach ( $segs as $sslug => $s2 ) { if ( $sslug === $slug ) { continue; } echo '<a class="glass sib reveal" href="' . esc_url( anthropos_seg_url( $sslug ) ) . '" style="--hue:' . esc_attr( $s2['hue'] ) . '"><span class="sd"></span><span><b>' . wp_kses_post( $s2['label'] ) . '</b></span></a>'; } ?>
	</div></div>
</section>
<?php
anthropos_faq_section();
get_footer();
