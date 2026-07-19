<?php
/**
 * Template Name: Guides Library
 * 5 series-pillar blocks (3D + CTA) + categorised guide grid (segment + service).
 * Shows real posts tagged ao_type=guide; falls back to demo cards if none exist yet.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$segs    = function_exists( 'anthropos_segments' ) ? anthropos_segments() : array();
$svckeys = anthropos_service_tags();
$pillars = array(
	array( 'holo', 'var(--ai)', 'Series A', 'Get Found', 'Local search, GBP, what your clients type, attribution.', 'aeo' ),
	array( 'funnel', 'var(--g2)', 'Series B', 'Earn Trust', 'The 5-second test, credentials, proof, safe forms.', 'web' ),
	array( 'dataflow', 'var(--flow)', 'Series C', 'Never Lose a Lead', '60-second replies, sequences, reminders, win-backs.', 'lead' ),
	array( 'broadcast', 'var(--g3)', 'Series D', 'Grow with Campaigns', 'Seasonal campaigns, segmentation, social &amp; reporting.', 'mkt' ),
	array( 'core', 'var(--cta)', 'Series E', 'Automate Everything', 'AI agents on n8n, the roadmap, always-on systems.', 'whole' ),
);
$demo = array(
	array( 'regulated-professionals lead', 'var(--g1)', 'REGULATED · C', 'The 60-second reply that doubles consultations' ),
	array( 'medical-professionals aeo', 'var(--g2)', 'MEDICAL · A', 'Local visibility for “[specialty] near me”' ),
	array( 'ecommerce-retail lead', 'var(--g3)', 'E-COMMERCE · C', 'The cart-recovery sequence that pays for itself' ),
	array( 'service-professionals whole', 'var(--g4)', 'SERVICE · E', 'The booking confirmation that cuts no-shows 70%' ),
	array( 'creators-coaches mkt', 'var(--g5)', 'CREATORS · D', 'Free-to-paid: the 30-day upgrade sequence' ),
	array( 'b2b-providers aeo', 'var(--g6)', 'B2B · A', 'Get surfaced when buyers &amp; AI assistants research' ),
	array( 'freelancers-agencies web', 'var(--g7)', 'FREELANCE · B', 'A portfolio that pre-sells you' ),
	array( 'creators-coaches soc', 'var(--g5)', 'CREATORS · D', 'Turn one guide into a month of content' ),
	array( 'service-professionals mkt', 'var(--g4)', 'SERVICE · D', 'Seasonal campaigns that wake up on schedule' ),
	array( 'b2b-providers whole', 'var(--g6)', 'B2B · E', 'Mapping a 6-month cycle into n8n stages' ),
);
$guide_q = new WP_Query( array(
	'post_type'      => 'post',
	'posts_per_page' => 40,
	'tax_query'      => array( array( 'taxonomy' => 'ao_type', 'field' => 'slug', 'terms' => 'guide' ) ),
) );
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
	<div class="wrap"><div class="grid-3" role="list">
		<?php foreach ( $pillars as $p ) { echo '<a class="glass card reveal tilt" role="listitem" href="#grid" data-jump="' . esc_attr( $p[5] ) . '" style="--hue:' . esc_attr( $p[1] ) . '"><canvas class="fxcanvas" data-fx="' . esc_attr( $p[0] ) . '" style="--hue:' . esc_attr( $p[1] ) . '"></canvas><div class="card-b"><span class="lbl">' . esc_html( $p[2] ) . '</span><h4>' . esc_html( $p[3] ) . '</h4><p>' . wp_kses_post( $p[4] ) . '</p><span class="go">Browse →</span></div></a>'; } ?>
		<a class="glass card reveal tilt" role="listitem" href="#cta" style="--hue:var(--ok)"><canvas class="fxcanvas" data-fx="crystal" style="--hue:var(--ok)"></canvas><div class="card-b"><span class="lbl">Prefer it done?</span><h4>Book a non-binding call</h4><p>We build the whole system in 4 weeks.</p><span class="go">Talk to a human →</span></div></a>
	</div></div>
</section>
<section id="grid">
	<div class="wrap band reveal"><div class="eyebrow">Filter by customer &amp; service segment</div><h2>Every guide, categorised two ways</h2></div>
	<div class="wrap">
		<div class="filters" data-group="business"><span class="flabel">By business:</span><button class="fbtn on" data-f="all">All</button><?php foreach ( $segs as $slug => $seg ) { echo '<button class="fbtn" data-f="' . esc_attr( $slug ) . '" style="--hue:' . esc_attr( $seg['hue'] ) . '">' . wp_kses_post( $seg['label'] ) . '</button>'; } ?></div>
		<div class="filters" data-group="service" style="margin-top:8px"><span class="flabel">By service:</span><button class="fbtn on" data-f="all">All</button><?php foreach ( $svckeys as $k => $label ) { echo '<button class="fbtn" data-f="' . esc_attr( $k ) . '">' . esc_html( $label ) . '</button>'; } ?></div>
		<div class="grid-4" role="list" style="margin-top:22px">
			<?php
			if ( $guide_q->have_posts() ) :
				while ( $guide_q->have_posts() ) : $guide_q->the_post();
					$cat = get_the_category(); $tags = get_the_tags();
					$cats = array(); if ( $cat ) foreach ( $cat as $c ) { $cats[] = $c->slug; } if ( $tags ) foreach ( $tags as $tg ) { $cats[] = $tg->slug; }
					$label = $cat ? strtoupper( $cat[0]->name ) : 'GUIDE'; ?>
					<a class="glass gcard" role="listitem" data-cats="<?php echo esc_attr( implode( ' ', $cats ) ); ?>" style="--hue:var(--g1)" href="<?php the_permalink(); ?>"><div class="gi"><?php echo esc_html( $label ); ?></div><h5><?php the_title(); ?></h5><div class="ga">problem → solution → CTA</div></a>
				<?php endwhile; wp_reset_postdata();
			else :
				foreach ( $demo as $g ) { echo '<a class="glass gcard" role="listitem" data-cats="' . esc_attr( $g[0] ) . '" style="--hue:' . esc_attr( $g[1] ) . '" href="#"><div class="gi">' . esc_html( $g[2] ) . '</div><h5>' . wp_kses_post( $g[3] ) . '</h5><div class="ga">problem → solution → CTA · queued next batch</div></a>'; }
			endif;
			?>
		</div>
		<p class="spec-note">WordPress: guides carry a customer-segment category + a service tag; the two filter rows read both. 90 real guides across all 9 service pages, plus 9 field-note posts on the blog.</p>
	</div>
</section>
<script>document.querySelectorAll('[data-jump]').forEach(function(a){a.addEventListener('click',function(){var f=a.dataset.jump;var b=document.querySelector('.filters[data-group="service"] .fbtn[data-f="'+f+'"]');if(b)setTimeout(function(){b.click();},400);});});</script>
<?php
anthropos_faq_section();
get_footer();
