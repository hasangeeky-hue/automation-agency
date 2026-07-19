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

/** Batch-resolve real post URLs for a set of slugs in ONE query — avoids
 *  running a separate get_posts() per guide card (was up to 10 per page). */
function anthropos_resolve_post_urls( $slugs ) {
	static $cache = array();
	$need = array_diff( array_unique( $slugs ), array_keys( $cache ) );
	if ( $need ) {
		$posts = get_posts( array( 'post_name__in' => array_values( $need ), 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => count( $need ) ) );
		foreach ( $posts as $post ) { $cache[ $post->post_name ] = get_permalink( $post ); }
		foreach ( $need as $s ) { if ( ! array_key_exists( $s, $cache ) ) { $cache[ $s ] = null; } }
	}
	$out = array();
	foreach ( $slugs as $s ) { $out[ $s ] = isset( $cache[ $s ] ) ? $cache[ $s ] : null; }
	return $out;
}

/** Map of page slug => [ guide-index => real post slug ]. Every guide listed
 *  here is a real, published article; any index not listed for a page is
 *  queued and links to the guides library instead of a dead single page. */
function anthropos_written_guides() {
	return array(
		'regulated-professionals' => array(
			0 => 'guide-why-referrals-went-quiet',
			1 => 'guide-local-seo-solo-firms',
			2 => 'guide-gbp-regulated-professionals',
			3 => 'guide-60-second-reply-regulated',
			4 => 'guide-5-email-inquiry-sequence',
			5 => 'guide-case-results-testimonials-rules',
			6 => 'guide-case-evaluation-form',
			7 => 'guide-seasonal-winback-quiet-months-regulated',
			8 => 'guide-reading-lead-report-regulated',
			9 => 'guide-referral-only-to-steady-pipeline',
		),
		'medical-professionals' => array(
			0 => 'guide-why-waiting-room-half-empty',
			1 => 'guide-local-visibility-specialty-near-me',
			2 => 'guide-gbp-reviews-lift-ranking',
			3 => 'guide-60-second-reply-medical',
			4 => 'guide-turning-inquiries-into-bookings',
			5 => 'guide-trust-in-five-seconds',
			6 => 'guide-review-requests-05-10-stars',
			7 => 'guide-winback-overdue-checkup',
			8 => 'guide-boundary-no-hipaa',
			9 => 'guide-word-of-mouth-to-full-schedule',
		),
		'ecommerce-retail' => array(
			0 => 'guide-ec-cart-abandonment-cost',
			1 => 'guide-cart-recovery-sequence',
			2 => 'guide-ec-post-purchase-flows',
			3 => 'guide-ec-email-list-you-own',
			4 => 'guide-ec-3-second-rule-mobile',
			5 => 'guide-ec-unified-inbox-multichannel',
			6 => 'guide-ec-inventory-sync-alerts',
			7 => 'guide-ec-cross-channel-vip-segmentation',
			8 => 'guide-ec-which-channel-profitable',
			9 => 'guide-ec-one-time-to-lifetime-value',
		),
		'service-professionals' => array(
			0 => 'guide-sp-empty-weeks-after-full-ones',
			1 => 'guide-sp-getting-found-service-near-me',
			2 => 'guide-sp-gbp-local-trades-studios',
			3 => 'guide-booking-confirmation-noshows',
			4 => 'guide-sp-2pm-problem-missed-leads',
			5 => 'guide-sp-before-after-galleries-reviews',
			6 => 'guide-sp-job-completion-automation',
			7 => 'guide-sp-reengagement-seasonal-winbacks',
			8 => 'guide-sp-which-jobs-profitable',
			9 => 'guide-sp-feast-famine-to-steady-calendar',
		),
		'freelancers-agencies' => array(
			0 => 'guide-fa-prequalify-before-call',
			1 => 'guide-fa-portfolio-presells-you',
			2 => 'guide-fa-case-studies-business-impact',
			3 => 'guide-fa-discovery-call-sequence',
			4 => 'guide-proposal-followup-day5',
			5 => 'guide-fa-outcome-first-positioning',
			6 => 'guide-fa-testimonial-referral-automation',
			7 => 'guide-fa-nurture-content-readers',
			8 => 'guide-fa-lead-report-kill-low-value',
			9 => 'guide-fa-referral-roulette-to-pipeline',
		),
		'creators-coaches' => array(
			0 => 'guide-cc-students-drift-lesson-four',
			1 => 'guide-cc-landing-pages-5-10-percent',
			2 => 'guide-cc-lead-magnet-5-email-welcome',
			3 => 'guide-cc-progress-based-nurture',
			4 => 'guide-cc-upsell-cross-sell-not-pushy',
			5 => 'guide-free-to-paid-30-day',
			6 => 'guide-cc-interest-segmentation-newsletters',
			7 => 'guide-cc-churn-prevention-members',
			8 => 'guide-cc-proof-testimonials-skepticism',
			9 => 'guide-cc-launch-spikes-to-steady-enrollment',
		),
		'b2b-providers' => array(
			0 => 'guide-b2b-escaping-generic-implementer-trap',
			1 => 'guide-b2b-surfaced-by-buyers-ai',
			2 => 'guide-b2b-case-studies-procurement-trusts',
			3 => 'guide-b2b-strategy-call-sequence-roadmap',
			4 => 'guide-day5-followup-stakeholder-routing',
			5 => 'guide-b2b-mapping-cycle-into-n8n-stages',
			6 => 'guide-b2b-implementation-progress-updates',
			7 => 'guide-b2b-post-implementation-testimonials-upsell',
			8 => 'guide-b2b-reading-pipeline-where-deals-stall',
			9 => 'guide-b2b-referral-dependent-to-always-on',
		),
		'marketing-automation' => array(
			0 => 'guide-mkt-where-marketers-waste-time',
			1 => 'guide-mkt-one-metric-that-matters',
			2 => 'guide-seasonal-campaigns-schedule',
			3 => 'guide-mkt-what-to-automate-first',
			4 => 'guide-mkt-segmenting-without-data-team',
			5 => 'guide-mkt-tools-wired-on-n8n',
			6 => 'guide-mkt-mistakes-that-kill-open-rates',
			7 => 'guide-mkt-prove-campaign-roi',
			8 => 'guide-mkt-30-day-rollout-plan',
			9 => 'guide-mkt-manual-sends-to-always-on',
		),
		'social-media-automation' => array(
			0 => 'guide-soc-why-posting-consistency-breaks',
			1 => 'guide-soc-one-metric-that-matters-social',
			2 => 'guide-repurposing-one-guide-into-month',
			3 => 'guide-soc-what-to-automate-first',
			4 => 'guide-soc-approval-workflows-brand-voice',
			5 => 'guide-soc-tools-wired-on-n8n',
			6 => 'guide-soc-mistakes-that-sound-robotic',
			7 => 'guide-soc-prove-social-roi',
			8 => 'guide-soc-30-day-rollout-plan',
			9 => 'guide-soc-inconsistent-to-steady-cadence',
		),
	);
}

/** Render a 10-card guide grid; any guide with a real published article links
 *  to it, the rest link to the guides library — queued, not dead. */
function anthropos_guide_grid( $titles, $hue, $url, $page_slug = '' ) {
	$written = ( $page_slug && isset( anthropos_written_guides()[ $page_slug ] ) ) ? anthropos_written_guides()[ $page_slug ] : array();
	$urls    = $written ? anthropos_resolve_post_urls( array_values( $written ) ) : array();
	$fx      = array( 'radar', 'dataflow', 'holo', 'workflow', 'neural', 'broadcast', 'growth', 'social', 'pulse', 'core' );
	echo '<div class="wrap"><div class="guides" role="list" style="--hue:' . esc_attr( $hue ) . '">';
	foreach ( $titles as $i => $t ) {
		$real_url = ( isset( $written[ $i ] ) && ! empty( $urls[ $written[ $i ] ] ) ) ? $urls[ $written[ $i ] ] : null;
		$href     = $real_url ? $real_url : $url;
		$tag      = $real_url ? 'Read the full guide →' : 'problem → solution → CTA';
		echo '<a class="glass gcard" role="listitem" href="' . esc_url( $href ) . '" style="--hue:' . esc_attr( $hue ) . '"><canvas class="gfx" data-fx="' . esc_attr( $fx[ $i % 10 ] ) . '" style="--hue:' . esc_attr( $hue ) . '"></canvas><div class="gi">G' . ( $i < 9 ? '0' : '' ) . ( $i + 1 ) . '</div><h5>' . wp_kses_post( $t ) . '</h5><div class="ga">' . esc_html( $tag ) . '</div></a>';
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
		<div class="wrap"><div class="glass" style="padding:32px 36px"><div class="aa-content"><?php echo wp_kses_post( anthropos_localize_links( $s['article'] ) ); ?></div></div></div>
	</section>
	<section id="guides">
		<div class="wrap band reveal"><div class="eyebrow">10 guides · problem → solution → CTA</div><h2>Guides for <?php echo wp_kses_post( $s['label'] ); ?></h2></div>
		<?php anthropos_guide_grid( isset( $s['guides'] ) ? $s['guides'] : array(), $s['hue'], $guides_url, $slug ); ?>
	</section>
	<section id="siblings">
		<div class="wrap band reveal"><div class="eyebrow">Need it for a specific business?</div><h2>See it inside your automation service page</h2></div>
		<div class="wrap"><div class="siblings" role="list">
			<?php foreach ( $segs as $sslug => $seg ) { echo '<a class="glass sib reveal" role="listitem" href="' . esc_url( anthropos_seg_url( $sslug ) ) . '" style="--hue:' . esc_attr( $seg['hue'] ) . '"><span class="sd"></span><span><b>' . wp_kses_post( $seg['label'] ) . '</b></span></a>'; } ?>
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
		<div class="wrap"><div class="grid-4" role="list">
			<?php foreach ( $segs as $sslug => $seg ) { echo '<a class="glass card reveal tilt" role="listitem" href="' . esc_url( anthropos_seg_url( $sslug ) ) . '" style="--hue:' . esc_attr( $seg['hue'] ) . '"><div class="card-b"><span class="lbl">' . wp_kses_post( $seg['label'] ) . '</span><h4>' . wp_kses_post( $seg['title'] ) . '</h4><span class="go">Open →</span></div></a>'; } ?>
		</div></div>
	</section>
	<section id="svcpages">
		<div class="wrap band reveal"><div class="eyebrow">By service · standalone</div><h2>Marketing &amp; Social Media Automation</h2></div>
		<div class="wrap"><div class="grid-3" role="list">
			<?php foreach ( $svcpages as $sslug => $sp ) { $u = get_page_by_path( $sslug ); $uu = $u ? get_permalink( $u ) : home_url( '/' . $sslug . '/' ); echo '<a class="glass card reveal tilt" role="listitem" href="' . esc_url( $uu ) . '" style="--hue:' . esc_attr( $sp['hue'] ) . '"><div class="card-b"><span class="lbl">Service</span><h4>' . wp_kses_post( $sp['title'] ) . '</h4><span class="go">Open →</span></div></a>'; } ?>
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
	<div class="wrap"><div class="glass" style="padding:32px 36px"><div class="aa-content"><?php echo wp_kses_post( anthropos_localize_links( $seg['article'] ) ); ?></div></div></div>
</section>

<section id="guides">
	<div class="wrap band reveal"><div class="eyebrow">10 guides for this business · problem → solution → CTA</div><h2>Research-grade guides for <?php echo wp_kses_post( $seg['label'] ); ?></h2><p class="soft">Read free, apply free — or have us build the whole system.</p></div>
	<?php anthropos_guide_grid( $seg['guides'], $hue, $guides_url, $slug ); ?>
</section>

<section id="siblings">
	<div class="wrap band reveal"><div class="eyebrow">Not your world? Jump to yours</div><h2>The other automation service pages</h2></div>
	<div class="wrap"><div class="siblings" role="list">
		<?php foreach ( $segs as $sslug => $s2 ) { if ( $sslug === $slug ) { continue; } echo '<a class="glass sib reveal" role="listitem" href="' . esc_url( anthropos_seg_url( $sslug ) ) . '" style="--hue:' . esc_attr( $s2['hue'] ) . '"><span class="sd"></span><span><b>' . wp_kses_post( $s2['label'] ) . '</b></span></a>'; } ?>
	</div></div>
</section>
<?php
anthropos_faq_section();
get_footer();
