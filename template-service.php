<?php
/**
 * Template Name: Automation Service Page
 * Renders a per-segment service page (hero + 6 blocks + 10 guides + siblings).
 * The parent /services/ page renders an overview listing of all 7 segments.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$guides_url = home_url( '/guides/' );
$svc        = home_url( '/services/' );
$segs       = function_exists( 'anthropos_segments' ) ? anthropos_segments() : array();
$slug       = get_post_field( 'post_name', get_queried_object_id() );

if ( ! isset( $segs[ $slug ] ) ) :
	/* -------- OVERVIEW: the parent /services/ page lists all 7 -------- */
	?>
	<section class="hero" style="--hue:var(--flow)">
		<canvas class="fx" data-net data-nodes="80" data-pulses="55" aria-hidden="true"></canvas>
		<div class="hero-in">
			<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> / Services</div>
			<h1>Automation services, <span class="grad">one page per business type</span></h1>
			<p class="sub">Each service page combines all six automation services into a micro-combo for that business, with tailored blocks and 10 guides. Pick yours.</p>
		</div>
	</section>
	<section id="all">
		<div class="wrap band reveal"><div class="eyebrow">Neuro-navigation · pick your business</div><h2>The seven automation service pages</h2></div>
		<div class="wrap"><div class="grid-4">
			<?php foreach ( $segs as $sslug => $seg ) {
				echo '<a class="glass card reveal tilt" href="' . esc_url( anthropos_seg_url( $sslug ) ) . '" style="--hue:' . esc_attr( $seg['hue'] ) . '"><div class="card-b"><span class="lbl">' . wp_kses_post( $seg['label'] ) . '</span><h4>' . wp_kses_post( $seg['title'] ) . '</h4><p>' . wp_kses_post( wp_trim_words( wp_strip_all_tags( $seg['sub'] ), 14 ) ) . '</p><span class="go">Open →</span></div></a>';
			} ?>
			<a class="glass card reveal tilt" href="#cta" style="--hue:var(--cta)"><div class="card-b"><span class="lbl">Not sure?</span><h4>Book a non-binding call</h4><p>We map your leak in 30 minutes.</p><span class="go">Talk to a human →</span></div></a>
		</div></div>
	</section>
	<?php
	get_footer();
	return;
endif;

/* -------- SEGMENT PAGE -------- */
$seg  = $segs[ $slug ];
$hue  = $seg['hue'];
$blocks = array(
	array( 'g2', 'pipeline', '01 · CONVERSION WEB DESIGN', 'A site that earns trust in five seconds', 'Credentials and proof above the fold, and forms that feed the automation. Fast, mobile-first.' ),
	array( 'ai', 'mesh', '02 · AEO / GEO / SEO', 'Found when someone searches for help', 'Structured so Google\'s local pack and AI answer engines surface you — built to be quoted.' ),
	array( 'flow', 'branch', '03 · LEAD AUTOMATION', 'The 60-second reply that closes', 'Every inquiry confirmed instantly, nurtured, chased three times if quiet — then handed to you.' ),
	array( 'g3', 'hub', '04 · MARKETING AUTOMATION', 'Campaigns that run themselves', 'Seasonal campaigns, newsletter nurture, win-backs and segmented sequences — on schedule.' ),
	array( 'g5', 'agent', '05 · SOCIAL MEDIA AUTOMATION', 'On-brand posts, on autopilot', 'An AI agent drafts, schedules and repurposes content — you approve, it publishes.' ),
	array( 'cta', 'core', '06 · WHOLE-BUSINESS AUTOMATION · AI + n8n', 'Every tool, one nervous system', 'n8n workflows connect inbox, CRM, calendar, invoicing and reporting — no manual glue.' ),
);
?>
<section class="hero" style="--hue:<?php echo esc_attr( $hue ); ?>">
	<canvas class="fx" data-net data-nodes="70" data-pulses="46" aria-hidden="true"></canvas>
	<div class="hero-in">
		<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> / <a href="<?php echo esc_url( $svc ); ?>">Services</a> / <?php echo wp_kses_post( $seg['label'] ); ?></div>
		<h1><?php echo wp_kses_post( str_replace( $seg['label'], '<span class="grad">' . $seg['label'] . '</span>', $seg['title'] ) ); ?></h1>
		<p class="sub"><?php echo wp_kses_post( $seg['sub'] ); ?></p>
		<div class="hero-ctas"><a class="btn btn-cta" href="#cta">Book a non-binding consultation</a><a class="btn btn-glass" href="#blocks">See what's included ↓</a></div>
		<div class="hero-tags"><span class="tag" style="--hue:var(--g2)">Web Design</span><span class="tag" style="--hue:var(--ai)">AEO / GEO</span><span class="tag" style="--hue:var(--flow)">Lead Automation</span><span class="tag" style="--hue:var(--g3)">Marketing Automation</span><span class="tag" style="--hue:var(--g5)">Social Media Automation</span><span class="tag" style="--hue:var(--cta)">AI + n8n</span></div>
	</div>
</section>

<section id="blocks">
	<div class="wrap band reveal"><div class="eyebrow">The micro-combo · 6 automation services in one page</div><h2>Everything this business needs, automated end to end</h2><p class="soft">Six services, one connected system. Each block is a live automation object showing how that piece works.</p></div>
	<div class="wrap">
		<?php foreach ( $blocks as $b ) {
			echo '<div class="glass sp-block reveal" style="--hue:var(--' . esc_attr( $b[0] ) . ')"><div class="sp-fx"><canvas data-fx="' . esc_attr( $b[1] ) . '" style="--hue:var(--' . esc_attr( $b[0] ) . ')"></canvas></div><div class="sp-body"><span class="no">' . esc_html( $b[2] ) . '</span><h3>' . esc_html( $b[3] ) . '</h3><p>' . esc_html( $b[4] ) . '</p><a class="bcta" href="#cta">Get this →</a></div></div>';
		} ?>
		<div class="glass combo-strip reveal"><b>Your micro-combo:</b><span><i>+</i> Web Design</span><span><i>+</i> AEO / GEO</span><span><i>+</i> Lead Automation</span><span><i>+</i> Marketing Automation</span><span><i>+</i> Social Media Automation</span><span><i>+</i> Whole-Business Automation</span></div>
	</div>
</section>

<section id="guides">
	<div class="wrap band reveal"><div class="eyebrow">10 guides for this segment · problem → solution → CTA</div><h2>Research-grade guides for <?php echo wp_kses_post( $seg['label'] ); ?></h2><p class="soft">Read free, apply free — or have us build the whole system.</p></div>
	<div class="wrap"><div class="guides" style="--hue:<?php echo esc_attr( $hue ); ?>">
		<?php foreach ( $seg['guides'] as $i => $t ) {
			echo '<a class="glass gcard" href="' . esc_url( $guides_url ) . '" style="--hue:' . esc_attr( $hue ) . '"><div class="gi">G' . ( $i < 9 ? '0' : '' ) . ( $i + 1 ) . '</div><h5>' . wp_kses_post( $t ) . '</h5><div class="ga">problem → solution → CTA</div></a>';
		} ?>
	</div></div>
</section>

<section id="siblings">
	<div class="wrap band reveal"><div class="eyebrow">Not your world? Jump to yours</div><h2>The other automation service pages</h2></div>
	<div class="wrap"><div class="siblings">
		<?php foreach ( $segs as $sslug => $s ) {
			if ( $sslug === $slug ) { continue; }
			echo '<a class="glass sib reveal" href="' . esc_url( anthropos_seg_url( $sslug ) ) . '" style="--hue:' . esc_attr( $s['hue'] ) . '"><span class="sd"></span><span><b>' . wp_kses_post( $s['label'] ) . '</b></span></a>';
		} ?>
	</div></div>
</section>
<?php
get_footer();
