<?php
/**
 * Template Name: Automation Service Page
 * A per-segment service page: hero + 6 automation blocks + 10 guides + siblings.
 * Placeholder content; edit per segment. Assign this template to a page under /services/.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$guides = home_url( '/guides/' );
$svc    = home_url( '/services/' );
$title  = get_the_title();
if ( ! $title ) { $title = 'Automation Service for Regulated Professionals'; }
?>
<section class="hero" style="--hue:var(--g1)">
	<canvas class="fx" data-net data-nodes="70" data-pulses="46" aria-hidden="true"></canvas>
	<div class="hero-in">
		<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> / <a href="<?php echo esc_url( $svc ); ?>">Services</a></div>
		<h1><?php echo esc_html( $title ); ?></h1>
		<p class="sub">We install the website, the visibility and the <b>AI agents on n8n</b> that capture and nurture every inquiry — end to end. <em>[Placeholder — edit per segment.]</em></p>
		<div class="hero-ctas"><a class="btn btn-cta" href="#cta">Book a non-binding consultation</a><a class="btn btn-glass" href="#blocks">See what's included ↓</a></div>
		<div class="hero-tags"><span class="tag" style="--hue:var(--g2)">Web Design</span><span class="tag" style="--hue:var(--ai)">AEO / GEO</span><span class="tag" style="--hue:var(--flow)">Lead Automation</span><span class="tag" style="--hue:var(--g3)">Marketing Automation</span><span class="tag" style="--hue:var(--g5)">Social Media Automation</span><span class="tag" style="--hue:var(--cta)">AI + n8n</span></div>
	</div>
</section>

<section id="blocks">
	<div class="wrap band reveal"><div class="eyebrow">The micro-combo · 6 automation services in one page</div><h2>Everything this business needs, automated end to end</h2><p class="soft">Six services, one connected system. Each block is a live automation object showing how that piece works.</p></div>
	<div class="wrap">
		<div class="glass sp-block reveal" style="--hue:var(--g2)"><div class="sp-fx"><canvas data-fx="pipeline" style="--hue:var(--g2)"></canvas></div><div class="sp-body"><span class="no">01 · CONVERSION WEB DESIGN</span><h3>A site that earns trust in five seconds</h3><p>Credentials and proof above the fold, and forms that feed the automation. Fast, mobile-first.</p><a class="bcta" href="#cta">Get this →</a></div></div>
		<div class="glass sp-block reveal" style="--hue:var(--ai)"><div class="sp-fx"><canvas data-fx="mesh" style="--hue:var(--ai)"></canvas></div><div class="sp-body"><span class="no">02 · AEO / GEO / SEO</span><h3>Found when someone searches for help</h3><p>Structured so Google's local pack and AI answer engines surface you — built to be quoted.</p><a class="bcta" href="#cta">Get this →</a></div></div>
		<div class="glass sp-block reveal" style="--hue:var(--flow)"><div class="sp-fx"><canvas data-fx="branch" style="--hue:var(--flow)"></canvas></div><div class="sp-body"><span class="no">03 · LEAD AUTOMATION</span><h3>The 60-second reply that closes</h3><p>Every inquiry confirmed instantly, nurtured, chased three times if quiet — then handed to you.</p><a class="bcta" href="#cta">Get this →</a></div></div>
		<div class="glass sp-block reveal" style="--hue:var(--g3)"><div class="sp-fx"><canvas data-fx="hub" style="--hue:var(--g3)"></canvas></div><div class="sp-body"><span class="no">04 · MARKETING AUTOMATION</span><h3>Campaigns that run themselves</h3><p>Seasonal campaigns, newsletter nurture, win-backs and segmented sequences — on schedule.</p><a class="bcta" href="#cta">Get this →</a></div></div>
		<div class="glass sp-block reveal" style="--hue:var(--g5)"><div class="sp-fx"><canvas data-fx="agent" style="--hue:var(--g5)"></canvas></div><div class="sp-body"><span class="no">05 · SOCIAL MEDIA AUTOMATION</span><h3>On-brand posts, on autopilot</h3><p>An AI agent drafts, schedules and repurposes content — you approve, it publishes.</p><a class="bcta" href="#cta">Get this →</a></div></div>
		<div class="glass sp-block reveal" style="--hue:var(--cta)"><div class="sp-fx"><canvas data-fx="core" style="--hue:var(--cta)"></canvas></div><div class="sp-body"><span class="no">06 · WHOLE-BUSINESS AUTOMATION · AI + n8n</span><h3>Every tool, one nervous system</h3><p>n8n workflows connect inbox, CRM, calendar, invoicing and reporting — no manual glue.</p><a class="bcta" href="#cta">Get this →</a></div></div>
		<div class="glass combo-strip reveal"><b>Your micro-combo:</b><span><i>+</i> Web Design</span><span><i>+</i> AEO / GEO</span><span><i>+</i> Lead Automation</span><span><i>+</i> Marketing Automation</span><span><i>+</i> Social Media Automation</span><span><i>+</i> Whole-Business Automation</span></div>
	</div>
</section>

<section id="guides">
	<div class="wrap band reveal"><div class="eyebrow">10 guides for this segment · problem → solution → CTA</div><h2>Research-grade guides</h2><p class="soft">Read free, apply free — or have us build the whole system.</p></div>
	<div class="wrap"><div class="guides" style="--hue:var(--g1)">
		<?php
		$gt = array(
			'Why you lose leads you already earned', 'The AEO answer box that gets you cited', 'Local + AI visibility, step by step',
			'The 60-second reply that doubles bookings', 'Mapping your funnel into n8n stages', 'The 5 workflows to automate first',
			'Marketing automation without the bloat', 'Social posts on autopilot, on-brand', 'Reading your lead report, honestly',
			'From pilot to always-on automation',
		);
		foreach ( $gt as $i => $t ) { echo '<a class="glass gcard" href="' . esc_url( $guides ) . '"><div class="gi">G' . ( $i < 9 ? '0' : '' ) . ( $i + 1 ) . '</div><h5>' . esc_html( $t ) . '</h5><div class="ga">problem → solution → CTA</div></a>'; }
		?>
	</div></div>
</section>

<section id="siblings">
	<div class="wrap band reveal"><div class="eyebrow">Not your world? Jump to yours</div><h2>The other automation service pages</h2></div>
	<div class="wrap"><div class="siblings">
		<?php
		$sib = array(
			array( 'Medical Professionals', 'Doctors · Dentists · Therapists', 'var(--g2)' ),
			array( 'E-Commerce &amp; Retail', 'Shopify · Multi-channel', 'var(--g3)' ),
			array( 'Service-Based Professionals', 'Home services · Trainers · Consultants', 'var(--g4)' ),
			array( 'Freelancers &amp; Micro-Agencies', 'Designers · Devs · Agencies', 'var(--g7)' ),
			array( 'Creators &amp; Coaches', 'Courses · Newsletters', 'var(--g5)' ),
			array( 'B2B Service Providers', 'SaaS implementation · Training', 'var(--g6)' ),
		);
		foreach ( $sib as $s ) { echo '<a class="glass sib reveal" href="' . esc_url( $svc ) . '" style="--hue:' . esc_attr( $s[2] ) . '"><span class="sd"></span><span><b>' . wp_kses_post( $s[0] ) . '</b><span>' . wp_kses_post( $s[1] ) . '</span></span></a>'; }
		?>
	</div></div>
</section>
<?php
get_footer();
