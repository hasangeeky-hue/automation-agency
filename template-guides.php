<?php
/**
 * Template Name: Guides Library
 * 5 series-pillar blocks (3D + CTA) + categorised guide grid (segment + service).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$segkeys = array( 'reg' => array( 'Regulated', 'var(--g1)' ), 'med' => array( 'Medical', 'var(--g2)' ), 'ecom' => array( 'E-Commerce', 'var(--g3)' ), 'svc' => array( 'Service-Based', 'var(--g4)' ), 'free' => array( 'Freelancers', 'var(--g7)' ), 'cre' => array( 'Creators', 'var(--g5)' ), 'b2b' => array( 'B2B', 'var(--g6)' ) );
$svckeys = array( 'web' => array( 'Web Design', 'var(--g2)' ), 'aeo' => array( 'AEO / GEO', 'var(--ai)' ), 'lead' => array( 'Lead', 'var(--flow)' ), 'mkt' => array( 'Marketing', 'var(--g3)' ), 'soc' => array( 'Social', 'var(--g5)' ), 'whole' => array( 'Whole-Business', 'var(--cta)' ) );
$pillars = array(
	array( 'holo', 'var(--ai)', 'Series A', 'Get Found', 'Local search, GBP, what your clients type, attribution.', 'aeo' ),
	array( 'funnel', 'var(--g2)', 'Series B', 'Earn Trust', 'The 5-second test, credentials, proof, safe forms.', 'web' ),
	array( 'dataflow', 'var(--flow)', 'Series C', 'Never Lose a Lead', '60-second replies, sequences, reminders, win-backs.', 'lead' ),
	array( 'broadcast', 'var(--g3)', 'Series D', 'Grow with Campaigns', 'Seasonal campaigns, segmentation, social &amp; reporting.', 'mkt' ),
	array( 'core', 'var(--cta)', 'Series E', 'Automate Everything', 'AI agents on n8n, the roadmap, always-on systems.', 'whole' ),
);
$guides = array(
	array( 'reg lead', 'var(--g1)', 'REGULATED · C', 'The 60-second reply that doubles consultations' ),
	array( 'med aeo', 'var(--g2)', 'MEDICAL · A', 'Local visibility for “[specialty] near me”' ),
	array( 'ecom lead', 'var(--g3)', 'E-COMMERCE · C', 'The cart-recovery sequence that pays for itself' ),
	array( 'svc whole', 'var(--g4)', 'SERVICE · E', 'The booking confirmation that cuts no-shows 70%' ),
	array( 'cre mkt', 'var(--g5)', 'CREATORS · D', 'Free-to-paid: the 30-day upgrade sequence' ),
	array( 'b2b aeo', 'var(--g6)', 'B2B · A', 'Get surfaced when buyers &amp; AI assistants research' ),
	array( 'free web', 'var(--g7)', 'FREELANCE · B', 'A portfolio that pre-sells you' ),
	array( 'cre soc', 'var(--g5)', 'CREATORS · D', 'Turn one guide into a month of content' ),
	array( 'svc mkt', 'var(--g4)', 'SERVICE · D', 'Seasonal campaigns that wake up on schedule' ),
	array( 'b2b whole', 'var(--g6)', 'B2B · E', 'Mapping a 6-month cycle into n8n stages' ),
	array( 'reg web', 'var(--g1)', 'REGULATED · B', 'Practice-area pages that convert' ),
	array( 'med soc', 'var(--g2)', 'MEDICAL · D', 'Review requests that add 0.5–1.0 stars' ),
);
?>
<section class="hero" style="--hue:var(--g2)">
	<canvas class="fx" data-net data-nodes="70" data-pulses="46" aria-hidden="true"></canvas>
	<div class="hero-in">
		<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> / Guides</div>
		<h1>Research-grade guides, <span class="grad">organised for you</span></h1>
		<p class="sub">Every guide names one problem, its cost, and the fix — with sources. Browse by <b>series</b>, or filter by <b>your business</b> and the <b>service</b> you need.</p>
	</div>
</section>
<section id="pillars">
	<div class="wrap band reveal"><div class="eyebrow">Five series · the whole curriculum</div><h2>Learn it in order, or jump to your leak</h2></div>
	<div class="wrap"><div class="grid-3">
		<?php foreach ( $pillars as $p ) { echo '<a class="glass card reveal tilt" href="#grid" data-jump="' . esc_attr( $p[5] ) . '" style="--hue:' . esc_attr( $p[1] ) . '"><canvas class="fxcanvas" data-fx="' . esc_attr( $p[0] ) . '" style="--hue:' . esc_attr( $p[1] ) . '"></canvas><div class="card-b"><span class="lbl">' . esc_html( $p[2] ) . '</span><h4>' . esc_html( $p[3] ) . '</h4><p>' . wp_kses_post( $p[4] ) . '</p><span class="go">Browse →</span></div></a>'; } ?>
		<a class="glass card reveal tilt" href="#cta" style="--hue:var(--ok)"><canvas class="fxcanvas" data-fx="crystal" style="--hue:var(--ok)"></canvas><div class="card-b"><span class="lbl">Prefer it done?</span><h4>Book a non-binding call</h4><p>We build the whole system in 4 weeks.</p><span class="go">Talk to a human →</span></div></a>
	</div></div>
</section>
<section id="grid">
	<div class="wrap band reveal"><div class="eyebrow">Filter by customer &amp; service segment</div><h2>Every guide, categorised two ways</h2></div>
	<div class="wrap">
		<div class="filters" data-group="business"><span class="fbtn" style="pointer-events:none;opacity:.6">By business:</span><button class="fbtn on" data-f="all">All</button><?php foreach ( $segkeys as $k => $v ) { echo '<button class="fbtn" data-f="' . esc_attr( $k ) . '" style="--hue:' . esc_attr( $v[1] ) . '">' . esc_html( $v[0] ) . '</button>'; } ?></div>
		<div class="filters" data-group="service" style="margin-top:8px"><span class="fbtn" style="pointer-events:none;opacity:.6">By service:</span><button class="fbtn on" data-f="all">All</button><?php foreach ( $svckeys as $k => $v ) { echo '<button class="fbtn" data-f="' . esc_attr( $k ) . '" style="--hue:' . esc_attr( $v[1] ) . '">' . esc_html( $v[0] ) . '</button>'; } ?></div>
		<div class="grid-4" style="margin-top:22px">
			<?php foreach ( $guides as $g ) { echo '<a class="glass gcard" data-cats="' . esc_attr( $g[0] ) . '" style="--hue:' . esc_attr( $g[1] ) . '" href="#"><div class="gi">' . esc_html( $g[2] ) . '</div><h5>' . wp_kses_post( $g[3] ) . '</h5><div class="ga">problem → solution → CTA</div></a>'; } ?>
		</div>
	</div>
</section>
<script>document.querySelectorAll('[data-jump]').forEach(function(a){a.addEventListener('click',function(){var f=a.dataset.jump;var b=document.querySelector('.filters[data-group="service"] .fbtn[data-f="'+f+'"]');if(b)setTimeout(function(){b.click();},400);});});</script>
<?php
get_footer();
