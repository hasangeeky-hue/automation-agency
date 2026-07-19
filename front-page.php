<?php
/**
 * Front page (v4) — AI Automation OS.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$svc  = home_url( '/services/' );
$blog = get_permalink( get_option( 'page_for_posts' ) );
if ( ! $blog ) { $blog = home_url( '/blog/' ); }
$segs = function_exists( 'anthropos_segments' ) ? anthropos_segments() : array();
$about_pg = get_page_by_path( 'about' ); $about = $about_pg ? get_permalink( $about_pg ) : home_url( '/about/' );
$blurbs = array(
	'regulated-professionals' => 'Lawyers, financial advisors &amp; tax consultants.',
	'medical-professionals'   => 'Doctors, dentists &amp; therapists.',
	'ecommerce-retail'        => 'Shopify &amp; multi-channel sellers.',
	'service-professionals'   => 'Home services, trainers &amp; consultants.',
	'freelancers-agencies'    => 'Designers, developers &amp; small agencies.',
	'creators-coaches'        => 'Course creators &amp; newsletter writers.',
	'b2b-providers'           => 'SaaS implementation &amp; training providers.',
);
?>
<section class="hero">
	<canvas class="fx" data-net data-nodes="100" data-pulses="70" data-z="20" aria-hidden="true"></canvas>
	<div class="hero-in">
		<div class="eyebrow">Anthropos Automation OS · web + AEO/GEO + AI automation</div>
		<h1>The leads are coming in. <span class="grad">You're just losing them.</span></h1>
		<p class="sub">Slow replies, a dated website, follow-up nobody has time for — that's where the inquiries you already paid to earn quietly disappear. We build the website, the answer-engine visibility and the <b>AI agents on n8n</b> that capture, qualify and chase every lead for you, automatically. Six services, one page per business type.</p>
		<div class="hero-ctas"><a class="btn btn-cta" href="#cta">Book a non-binding consultation</a><a class="btn btn-glass" href="#services">See the 6 services ↓</a></div>
		<div class="hero-tags"><span class="tag">Web Design</span><span class="tag" style="--hue:var(--ai)">AEO / GEO</span><span class="tag">Lead Automation</span><span class="tag" style="--hue:var(--g3)">Marketing Automation</span><span class="tag" style="--hue:var(--g5)">Social Media Automation</span><span class="tag" style="--hue:var(--cta)">AI + n8n</span></div>
	</div>
</section>

<section id="solve">
	<div class="wrap band reveal"><div class="eyebrow">How we solve the problem</div><h2>Problem → Agent → Outcome</h2><p class="soft">You don't need more tools — you need them <b>connected and thinking.</b> We map the leak, deploy the agent that closes it, and wire the workflow so it runs without you.</p></div>
	<div class="wrap"><div class="grid-3" role="list">
		<div class="glass reveal tilt" role="listitem" style="--hue:var(--flow)"><canvas class="fxcanvas" data-fx="radar" style="--hue:var(--flow)"></canvas><div class="card-b"><span class="lbl">01 · MAP</span><h4>Find the leak</h4><p>We trace where leads, replies and revenue drain out — visibility, trust, or follow-up.</p></div></div>
		<div class="glass reveal tilt" role="listitem" style="--hue:var(--ai)"><canvas class="fxcanvas" data-fx="workflow" style="--hue:var(--ai)"></canvas><div class="card-b"><span class="lbl">02 · DEPLOY</span><h4>Build the agent</h4><p>An AI agent + n8n workflow takes over: replies in seconds, qualifies, routes, follows up.</p></div></div>
		<div class="glass reveal tilt" role="listitem" style="--hue:var(--cta)"><canvas class="fxcanvas" data-fx="growth" style="--hue:var(--cta)"></canvas><div class="card-b"><span class="lbl">03 · COMPOUND</span><h4>Watch it run</h4><p>Connected once, working forever — leads flow to booked calls while it reports what works.</p></div></div>
	</div></div>
</section>

<section id="services">
	<div class="wrap band reveal"><div class="eyebrow">What we automate · six services, one system</div><h2>The six automation services</h2><p class="soft">Every service page combines all six for one business type. Each has its own live automation object.</p></div>
	<div class="wrap"><div class="grid-3" role="list">
		<a class="glass card reveal tilt" role="listitem" href="<?php echo esc_url( $svc ); ?>" style="--hue:var(--g2)"><canvas class="fxcanvas" data-fx="funnel" style="--hue:var(--g2)"></canvas><div class="card-b"><span class="lbl">Service 01</span><h4>Conversion Web Design</h4><p>Fast, mobile-first, trust in five seconds — built to turn visitors into inquiries.</p><span class="go">Explore →</span></div></a>
		<a class="glass card reveal tilt" role="listitem" href="<?php echo esc_url( $svc ); ?>" style="--hue:var(--ai)"><canvas class="fxcanvas" data-fx="neural" style="--hue:var(--ai)"></canvas><div class="card-b"><span class="lbl">Service 02</span><h4>AEO / GEO / SEO</h4><p>Quoted by AI engines, ranked locally — found the moment they search.</p><span class="go">Explore →</span></div></a>
		<a class="glass card reveal tilt" role="listitem" href="<?php echo esc_url( $svc ); ?>" style="--hue:var(--flow)"><canvas class="fxcanvas" data-fx="dataflow" style="--hue:var(--flow)"></canvas><div class="card-b"><span class="lbl">Service 03</span><h4>Lead Automation</h4><p>60-second replies, nurture, win-backs — the follow-up that closes.</p><span class="go">Explore →</span></div></a>
		<a class="glass card reveal tilt" role="listitem" href="<?php echo esc_url( home_url( '/marketing-automation/' ) ); ?>" style="--hue:var(--g3)"><canvas class="fxcanvas" data-fx="broadcast" style="--hue:var(--g3)"></canvas><div class="card-b"><span class="lbl">Service 04</span><h4>Marketing Automation</h4><p>Seasonal campaigns, newsletters, segmented sequences — on schedule, on autopilot.</p><span class="go">Explore →</span></div></a>
		<a class="glass card reveal tilt" role="listitem" href="<?php echo esc_url( home_url( '/social-media-automation/' ) ); ?>" style="--hue:var(--g5)"><canvas class="fxcanvas" data-fx="social" style="--hue:var(--g5)"></canvas><div class="card-b"><span class="lbl">Service 05</span><h4>Social Media Automation</h4><p>An AI agent drafts, schedules and repurposes on-brand content — you approve, it posts.</p><span class="go">Explore →</span></div></a>
		<a class="glass card reveal tilt" role="listitem" href="<?php echo esc_url( $svc ); ?>" style="--hue:var(--cta)"><canvas class="fxcanvas" data-fx="core" style="--hue:var(--cta)"></canvas><div class="card-b"><span class="lbl">Service 06</span><h4>Whole-Business Automation · AI + n8n</h4><p>Inbox, CRM, invoicing, reporting — every tool connected into one nervous system.</p><span class="go">Explore →</span></div></a>
	</div></div>
</section>

<section id="servicepages">
	<div class="wrap band reveal"><div class="eyebrow">Neuro-navigation · pick your business</div><h2>Automation service pages — one per business type</h2><p class="soft">Each page combines the six services into a micro-combo for that business, with blocks and 10 guides.</p></div>
	<div class="wrap"><div class="grid-4" role="list">
		<?php foreach ( $segs as $slug => $seg ) { echo '<a class="glass card reveal tilt" role="listitem" href="' . esc_url( anthropos_seg_url( $slug ) ) . '" style="--hue:' . esc_attr( $seg['hue'] ) . '"><div class="card-b"><span class="lbl">' . wp_kses_post( $seg['label'] ) . '</span><h4>' . wp_kses_post( $seg['title'] ) . '</h4><p>' . wp_kses_post( isset( $blurbs[ $slug ] ) ? $blurbs[ $slug ] : '' ) . '</p><span class="go">Open →</span></div></a>'; } ?>
		<a class="glass card reveal tilt" role="listitem" href="#cta" style="--hue:var(--cta)"><div class="card-b"><span class="lbl">Not sure?</span><h4>Book a non-binding call</h4><p>We map your leak in 30 minutes.</p><span class="go">Talk to a human →</span></div></a>
	</div></div>
</section>

<section id="team">
	<div class="wrap band reveal"><div class="eyebrow">Our team · on top</div><h2>Real people building the machines</h2><p class="soft">Automation feels human when humans design it. <a href="<?php echo esc_url( $about ); ?>#team" style="color:var(--flow)">Meet the full team →</a></p></div>
	<div class="wrap"><div class="team" role="list">
		<div class="glass tm reveal" role="listitem"><div class="av">MH</div><h5>Murtuja Hasan</h5><span>Founder &amp; CEO</span><p>E-commerce &amp; performance-marketing lead running a 7-person team at a consistent 10x return on ad spend.</p></div>
		<div class="glass tm reveal" role="listitem"><div class="av">AH</div><h5>Ahasanul Haque</h5><span>CTO</span><p>AI engineer and data scientist (M.Sc., TU Munich) with ML experience at Adobe and NewNow.</p></div>
		<div class="glass tm reveal" role="listitem"><div class="av">SK</div><h5>Sina Khouei</h5><span>Cybersecurity &amp; Applied AI</span><p>M.Sc. Computer Science, University of Bonn — hardens every agent before it touches client data.</p></div>
		<div class="glass tm reveal" role="listitem"><div class="av">AI</div><h5>Ariful Islam</h5><span>Media Buyer &amp; Ads Automation</span><p>Runs Google &amp; Meta ad accounts at 1,300%+ ROAS for e-commerce brands.</p></div>
		<div class="glass tm reveal" role="listitem"><div class="av">AR</div><h5><a href="https://www.razzakabdur.com/" target="_blank" rel="noopener">Abdur Razak</a></h5><span>Head of Web Development</span><p>Full-stack developer (Drupal, full-stack web) and documentation specialist — ships the client sites plus the custom Excel/VBA tools and process systems operations run on.</p></div>
	</div></div>
</section>

<section id="blog">
	<div class="wrap band reveal"><div class="eyebrow">Blog · in the header</div><h2>Field notes on AI automation</h2></div>
	<div class="wrap"><div class="grid-3" role="list">
		<?php
		$q = new WP_Query( array( 'posts_per_page' => 3, 'ignore_sticky_posts' => true ) );
		if ( $q->have_posts() ) :
			$fx = array( 'neural', 'dataflow', 'social' ); $hu = array( 'var(--ai)', 'var(--flow)', 'var(--g5)' ); $i = 0;
			while ( $q->have_posts() ) : $q->the_post(); $c = get_the_category(); ?>
			<a class="glass post reveal tilt" role="listitem" href="<?php the_permalink(); ?>" style="--hue:<?php echo esc_attr( $hu[ $i % 3 ] ); ?>"><canvas class="fxcanvas" data-fx="<?php echo esc_attr( $fx[ $i % 3 ] ); ?>" style="--hue:<?php echo esc_attr( $hu[ $i % 3 ] ); ?>"></canvas><div class="post-b"><span class="pc"><?php echo $c ? esc_html( $c[0]->name ) : 'Insights'; ?></span><h4><?php the_title(); ?></h4><p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p><span class="pr">Read →</span></div></a>
			<?php $i++; endwhile; wp_reset_postdata();
		else : ?>
			<a class="glass post reveal tilt" role="listitem" href="<?php echo esc_url( $blog ); ?>" style="--hue:var(--ai)"><canvas class="fxcanvas" data-fx="neural" style="--hue:var(--ai)"></canvas><div class="post-b"><span class="pc">AI Agents</span><h4>What an AI agent actually does in a small business</h4><p>Triggers, tools and memory in plain language.</p><span class="pr">Read →</span></div></a>
			<a class="glass post reveal tilt" role="listitem" href="<?php echo esc_url( $blog ); ?>" style="--hue:var(--flow)"><canvas class="fxcanvas" data-fx="dataflow" style="--hue:var(--flow)"></canvas><div class="post-b"><span class="pc">n8n Workflows</span><h4>The 5 workflows every service business should automate first</h4><p>Inbound, follow-up, booking, invoicing, reviews.</p><span class="pr">Read →</span></div></a>
			<a class="glass post reveal tilt" role="listitem" href="<?php echo esc_url( $blog ); ?>" style="--hue:var(--g5)"><canvas class="fxcanvas" data-fx="social" style="--hue:var(--g5)"></canvas><div class="post-b"><span class="pc">Social &amp; Marketing</span><h4>Social media automation that doesn't sound like a robot</h4><p>Draft, approve, schedule, repurpose.</p><span class="pr">Read →</span></div></a>
		<?php endif; ?>
	</div></div>
</section>
<?php
anthropos_faq_section();
get_footer();
