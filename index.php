<?php
/**
 * Blog index / archive (v6) — 5 content-pillar blocks + categorised post grid.
 * Shows real posts tagged ao_type=blog; falls back to demo cards if none exist yet.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$svckeys = anthropos_service_tags();
$segs    = function_exists( 'anthropos_segments' ) ? anthropos_segments() : array();
$pillars = array(
	array( 'holo', 'var(--ai)', 'Pillar 01', 'Get Found', 'AEO / GEO / local search — be the answer AI engines surface.', 'aeo' ),
	array( 'funnel', 'var(--g2)', 'Pillar 02', 'Convert Visitors', 'Web design &amp; the 5-second test — turn traffic into inquiries.', 'web' ),
	array( 'dataflow', 'var(--flow)', 'Pillar 03', 'Never Lose a Lead', '60-second replies, nurture &amp; win-backs.', 'lead' ),
	array( 'broadcast', 'var(--g3)', 'Pillar 04', 'Grow with Campaigns', 'Marketing &amp; social automation — reach that runs itself.', 'mkt' ),
	array( 'core', 'var(--cta)', 'Pillar 05', 'Automate Everything', 'AI agents on n8n — the whole business as one system.', 'whole' ),
);
$demo = array(
	array( 'regulated-professionals lead', 'var(--g1)', 'dataflow', 'Regulated · Lead', 'The 60-second reply that doubles consultations' ),
	array( 'medical-professionals aeo', 'var(--g2)', 'holo', 'Medical · AEO', 'Local visibility for “[specialty] near me”' ),
	array( 'ecommerce-retail lead', 'var(--g3)', 'funnel', 'E-Commerce · Lead', 'The cart-recovery sequence that pays for itself' ),
	array( 'service-professionals whole', 'var(--g4)', 'calendar', 'Service-Based · Whole-Business', 'The booking confirmation that cuts no-shows 70%' ),
	array( 'creators-coaches mkt', 'var(--g5)', 'broadcast', 'Creators · Marketing', 'Free-to-paid: the 30-day upgrade sequence' ),
	array( 'b2b-providers aeo', 'var(--g6)', 'neural', 'B2B · AEO', 'Get surfaced when buyers &amp; AI assistants research' ),
	array( 'freelancers-agencies web', 'var(--g7)', 'funnel', 'Freelancers · Web', 'A portfolio that pre-sells you' ),
	array( 'creators-coaches soc', 'var(--g5)', 'social', 'Creators · Social', 'Turn one guide into a month of content' ),
	array( 'b2b-providers whole', 'var(--g6)', 'core', 'B2B · Whole-Business', 'Mapping a 6-month cycle into n8n stages' ),
);
$blog_q = new WP_Query( array(
	'post_type'      => 'post',
	'posts_per_page' => 12,
	'tax_query'      => array( array( 'taxonomy' => 'ao_type', 'field' => 'slug', 'terms' => 'blog' ) ),
) );
?>
<section class="hero" style="--hue:var(--ai)">
	<canvas class="fx" data-net data-nodes="70" data-pulses="46" aria-hidden="true"></canvas>
	<div class="hero-in">
		<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> / Blog</div>
		<h1>Automation, <span class="grad">in plain language</span></h1>
		<p class="sub">Field notes on AI agents, n8n workflows, web design and answer-engine visibility — organised by <b>your business</b> and by <b>the service</b> you need.</p>
	</div>
</section>
<section id="pillars">
	<div class="wrap band reveal"><div class="eyebrow">Start here · five reading paths</div><h2>Pick the outcome you're chasing</h2></div>
	<div class="wrap"><div class="grid-3">
		<?php foreach ( $pillars as $p ) { echo '<a class="glass card reveal tilt" href="#grid" data-jump="' . esc_attr( $p[5] ) . '" style="--hue:' . esc_attr( $p[1] ) . '"><canvas class="fxcanvas" data-fx="' . esc_attr( $p[0] ) . '" style="--hue:' . esc_attr( $p[1] ) . '"></canvas><div class="card-b"><span class="lbl">' . esc_html( $p[2] ) . '</span><h4>' . esc_html( $p[3] ) . '</h4><p>' . wp_kses_post( $p[4] ) . '</p><span class="go">Read →</span></div></a>'; } ?>
		<a class="glass card reveal tilt" href="#cta" style="--hue:var(--ok)"><canvas class="fxcanvas" data-fx="crystal" style="--hue:var(--ok)"></canvas><div class="card-b"><span class="lbl">Prefer it done?</span><h4>Book a non-binding call</h4><p>We map your biggest leak in 30 minutes.</p><span class="go">Talk to a human →</span></div></a>
	</div></div>
</section>
<section id="grid">
	<div class="wrap band reveal"><div class="eyebrow">Filter by customer &amp; service segment</div><h2>Every post, categorised two ways</h2></div>
	<div class="wrap">
		<div class="filters" data-group="business"><span class="flabel">By business:</span><button class="fbtn on" data-f="all">All</button><?php foreach ( $segs as $slug => $seg ) { echo '<button class="fbtn" data-f="' . esc_attr( $slug ) . '" style="--hue:' . esc_attr( $seg['hue'] ) . '">' . wp_kses_post( $seg['label'] ) . '</button>'; } ?></div>
		<div class="filters" data-group="service" style="margin-top:8px"><span class="flabel">By service:</span><button class="fbtn on" data-f="all">All</button><?php foreach ( $svckeys as $k => $label ) { echo '<button class="fbtn" data-f="' . esc_attr( $k ) . '">' . esc_html( $label ) . '</button>'; } ?></div>
		<div class="grid-3" style="margin-top:22px">
			<?php
			if ( $blog_q->have_posts() ) :
				$i = 0; $fx = array( 'neural', 'dataflow', 'funnel', 'broadcast', 'social', 'core', 'holo', 'pulse', 'calendar' );
				while ( $blog_q->have_posts() ) : $blog_q->the_post();
					$cat = get_the_category(); $tags = get_the_tags();
					$cats = array(); if ( $cat ) foreach ( $cat as $c ) { $cats[] = $c->slug; } if ( $tags ) foreach ( $tags as $tg ) { $cats[] = $tg->slug; } ?>
					<a class="glass post reveal tilt" data-cats="<?php echo esc_attr( implode( ' ', $cats ) ); ?>" style="--hue:var(--ai)" href="<?php the_permalink(); ?>"><canvas class="fxcanvas" data-fx="<?php echo esc_attr( $fx[ $i % 9 ] ); ?>" style="--hue:var(--ai)"></canvas><div class="post-b"><span class="pc"><?php echo $cat ? esc_html( $cat[0]->name ) : 'Insights'; ?></span><h4><?php the_title(); ?></h4><p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p><span class="pr">Read →</span></div></a>
				<?php $i++; endwhile; wp_reset_postdata();
			else :
				foreach ( $demo as $d ) { echo '<a class="glass post reveal tilt" data-cats="' . esc_attr( $d[0] ) . '" style="--hue:' . esc_attr( $d[1] ) . '" href="#"><canvas class="fxcanvas" data-fx="' . esc_attr( $d[2] ) . '" style="--hue:' . esc_attr( $d[1] ) . '"></canvas><div class="post-b"><span class="pc">' . esc_html( $d[3] ) . '</span><h4>' . wp_kses_post( $d[4] ) . '</h4><p>[Placeholder excerpt — real content queued next batch.]</p><span class="pr">Read →</span></div></a>'; }
			endif;
			?>
		</div>
		<p class="spec-note">Posts carry a customer-segment category + a service tag; the two filter rows read both.</p>
	</div>
</section>
<script>document.querySelectorAll('[data-jump]').forEach(function(a){a.addEventListener('click',function(){var f=a.dataset.jump;var b=document.querySelector('.filters[data-group="service"] .fbtn[data-f="'+f+'"]');if(b)setTimeout(function(){b.click();},400);});});</script>
<?php anthropos_faq_section(); get_footer(); ?>
