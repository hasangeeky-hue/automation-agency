<?php
/**
 * Front page — AI Automation OS. Warm, solution-first homepage.
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
		<p class="sub">Slow replies, a dated website, follow-up nobody has time for — that's where the work you've already earned quietly slips away. We build the website, the visibility and the <b>AI agents on n8n</b> that answer, qualify and follow up on every enquiry for you — so being busy stops costing you customers.</p>
		<div class="hero-ctas"><a class="btn btn-cta" href="#cta">Book a free consultation</a><a class="btn btn-glass" href="#services">See what we do ↓</a></div>
		<div class="hero-tags"><span class="tag">Web Design</span><span class="tag" style="--hue:var(--ai)">AEO / GEO</span><span class="tag">Lead Automation</span><span class="tag" style="--hue:var(--g3)">Marketing Automation</span><span class="tag" style="--hue:var(--g5)">Social Media Automation</span><span class="tag" style="--hue:var(--cta)">AI + n8n</span></div>
	</div>
</section>

<section id="solve">
	<div class="wrap band reveal"><div class="eyebrow">How it works</div><h2>Three steps to a business that runs itself</h2><p class="soft">You're brilliant at the work — you're just stretched too thin to chase every lead, post every week and follow up on time. So we take that off your plate, quietly in the background, and hand you back the hours.</p></div>
	<div class="wrap"><div class="grid-3" role="list">
		<div class="glass reveal tilt" role="listitem" style="--hue:var(--flow)"><canvas class="fxcanvas" data-fx="radar" style="--hue:var(--flow)"></canvas><div class="card-b"><span class="lbl">01 · WE LISTEN</span><h4>We find what's slipping</h4><p>A friendly audit of where enquiries, replies and repeat business are quietly falling through the cracks.</p></div></div>
		<div class="glass reveal tilt" role="listitem" style="--hue:var(--ai)"><canvas class="fxcanvas" data-fx="workflow" style="--hue:var(--ai)"></canvas><div class="card-b"><span class="lbl">02 · WE BUILD</span><h4>We set up your system</h4><p>A modern website and AI helpers on n8n that answer, follow up and post for you — wired to the tools you already use.</p></div></div>
		<div class="glass reveal tilt" role="listitem" style="--hue:var(--cta)"><canvas class="fxcanvas" data-fx="growth" style="--hue:var(--cta)"></canvas><div class="card-b"><span class="lbl">03 · YOU GROW</span><h4>You get your time back</h4><p>It runs in the background, turning enquiries into booked jobs, while you focus on the work you actually love.</p></div></div>
	</div></div>
</section>

<section id="services">
	<div class="wrap band reveal"><div class="eyebrow">What we can take off your plate</div><h2>Six ways we help you grow</h2><p class="soft">Take one, or the whole system. Every business-type page below combines the ones that matter most for you.</p></div>
	<div class="wrap"><div class="grid-3" role="list">
		<a class="glass card reveal tilt" role="listitem" href="<?php echo esc_url( $svc ); ?>" style="--hue:var(--g2)"><canvas class="fxcanvas" data-fx="funnel" style="--hue:var(--g2)"></canvas><div class="card-b"><span class="lbl">Service 01</span><h4>Conversion Web Design</h4><p>A site that loads fast and earns trust in five seconds — so visitors reach out instead of leaving.</p><span class="go">Explore →</span></div></a>
		<a class="glass card reveal tilt" role="listitem" href="<?php echo esc_url( $svc ); ?>" style="--hue:var(--ai)"><canvas class="fxcanvas" data-fx="neural" style="--hue:var(--ai)"></canvas><div class="card-b"><span class="lbl">Service 02</span><h4>AEO / GEO / SEO</h4><p>Show up the moment someone searches for what you do — in Google and in AI answers.</p><span class="go">Explore →</span></div></a>
		<a class="glass card reveal tilt" role="listitem" href="<?php echo esc_url( $svc ); ?>" style="--hue:var(--flow)"><canvas class="fxcanvas" data-fx="dataflow" style="--hue:var(--flow)"></canvas><div class="card-b"><span class="lbl">Service 03</span><h4>Lead Automation</h4><p>Every enquiry answered in seconds and followed up until they book — even while you're on the job.</p><span class="go">Explore →</span></div></a>
		<a class="glass card reveal tilt" role="listitem" href="<?php echo esc_url( home_url( '/marketing-automation/' ) ); ?>" style="--hue:var(--g3)"><canvas class="fxcanvas" data-fx="broadcast" style="--hue:var(--g3)"></canvas><div class="card-b"><span class="lbl">Service 04</span><h4>Marketing Automation</h4><p>Campaigns and newsletters that go out on time, every time, without you remembering to send them.</p><span class="go">Explore →</span></div></a>
		<a class="glass card reveal tilt" role="listitem" href="<?php echo esc_url( home_url( '/social-media-automation/' ) ); ?>" style="--hue:var(--g5)"><canvas class="fxcanvas" data-fx="social" style="--hue:var(--g5)"></canvas><div class="card-b"><span class="lbl">Service 05</span><h4>Social Media Automation</h4><p>An AI helper drafts and schedules on-brand posts; you just approve, and your feed stays alive.</p><span class="go">Explore →</span></div></a>
		<a class="glass card reveal tilt" role="listitem" href="<?php echo esc_url( $svc ); ?>" style="--hue:var(--cta)"><canvas class="fxcanvas" data-fx="core" style="--hue:var(--cta)"></canvas><div class="card-b"><span class="lbl">Service 06</span><h4>Whole-Business Automation · AI + n8n</h4><p>Inbox, CRM, invoicing and reporting all talking to each other, so nothing falls through the cracks.</p><span class="go">Explore →</span></div></a>
	</div></div>
</section>

<section id="servicepages">
	<div class="wrap band reveal"><div class="eyebrow">Pick your business</div><h2>Built for your line of work</h2><p class="soft">Choose your business type for a page built around your world — your customers, your pains, and the guides that help most.</p></div>
	<div class="wrap"><div class="grid-4" role="list">
		<?php foreach ( $segs as $slug => $seg ) { echo '<a class="glass card reveal tilt" role="listitem" href="' . esc_url( anthropos_seg_url( $slug ) ) . '" style="--hue:' . esc_attr( $seg['hue'] ) . '"><div class="card-b"><span class="lbl">' . wp_kses_post( $seg['label'] ) . '</span><h4>' . wp_kses_post( $seg['title'] ) . '</h4><p>' . wp_kses_post( isset( $blurbs[ $slug ] ) ? $blurbs[ $slug ] : '' ) . '</p><span class="go">Open →</span></div></a>'; } ?>
			<a class="glass card reveal tilt" role="listitem" href="<?php echo esc_url( home_url( '/business-launch/' ) ); ?>" style="--hue:var(--g6)"><div class="card-b"><span class="lbl">Just starting out?</span><h4>Business Launch</h4><p>Know your idea but not how to launch it? Company, website, bank &amp; automation — done together, US/UK.</p><span class="go">Open →</span></div></a>
		<a class="glass card reveal tilt" role="listitem" href="#cta" style="--hue:var(--cta)"><div class="card-b"><span class="lbl">Not sure?</span><h4>Let's talk it through</h4><p>We'll show you where you're losing work — in 30 minutes, free.</p><span class="go">Talk to a human →</span></div></a>
	</div></div>
</section>

<section id="team">
	<div class="wrap band reveal"><div class="eyebrow">The people behind it</div><h2>A small, senior team — and you work with us directly</h2><p class="soft">No account managers, no hand-offs. The people who build your system are the ones who answer when you call. <a href="<?php echo esc_url( $about ); ?>#team" style="color:var(--flow)">Meet the team →</a></p></div>
	<div class="wrap"><div class="team" role="list">
		<div class="glass tm reveal" role="listitem"><div class="av">MH</div><h5>Murtuja Hasan</h5><span>Founder &amp; CEO</span><p>Grows real businesses with the exact automation-and-marketing playbook he'll build for you.</p></div>
		<div class="glass tm reveal" role="listitem"><div class="av">AH</div><h5>Ahasanul Haque</h5><span>CTO</span><p>Builds the AI under the hood and makes sure the clever stuff just works — every time.</p></div>
		<div class="glass tm reveal" role="listitem"><div class="av">SK</div><h5>Sina Khouei</h5><span>Cybersecurity &amp; Applied AI</span><p>Keeps your data and your automations locked down, so you never have to think about it.</p></div>
		<div class="glass tm reveal" role="listitem"><div class="av">AI</div><h5>Ariful Islam</h5><span>Media Buyer &amp; Ads Automation</span><p>Turns ad budget into booked customers, not wasted clicks.</p></div>
		<div class="glass tm reveal" role="listitem"><div class="av">AR</div><h5><a href="https://www.razzakabdur.com/" target="_blank" rel="noopener">Abdur Razak</a></h5><span>Head of Web Development</span><p>Builds the websites and behind-the-scenes tools your whole system runs on.</p></div>
	</div></div>
</section>

<section id="blog">
	<div class="wrap band reveal"><div class="eyebrow">From the blog</div><h2>Straight talk on automation</h2></div>
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
