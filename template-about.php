<?php
/**
 * Template Name: About Page
 * Three distinct section layouts, each with its own 3D: Company (manifesto),
 * Vision (immersive band), Team (how-we-work steps + grid).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<section class="hero" style="--hue:var(--ai)">
	<canvas class="fx" data-net data-nodes="90" data-pulses="60" aria-hidden="true"></canvas>
	<div class="hero-in">
		<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> / About Us</div>
		<h1>The humans behind <span class="grad">the machines</span></h1>
		<p class="sub">We build automation that feels human — because humans design it. Here's who we are, where we're headed, and the team that wires it together.</p>
		<div class="hero-ctas"><a class="btn btn-cta" href="#cta">Book a non-binding consultation</a><a class="btn btn-glass" href="#company">Read our story ↓</a></div>
	</div>
</section>

<section id="company">
	<div class="wrap band reveal"><div class="eyebrow" style="color:var(--flow)">Our Story</div><h2>Our name is our whole argument: keep the human at the centre</h2></div>
	<div class="wrap">
		<div class="manifesto reveal" style="--hue:var(--flow)">
			<div>
				<span class="no">WHY WE EXIST</span>
				<h3>&ldquo;Anthropos&rdquo; is Greek for the human being. That is not a name &mdash; it is a belief</h3>
				<p>We do not think AI is an alien mind arriving to replace us. We think it is a <b style="color:var(--ink)">mirror</b>. It learns from people and reflects them back: carelessness trained into it returns as carelessness; judgement and care trained into it return as judgement and care. So the real question was never <i>what can the machine do</i>. It was <b style="color:var(--ink)">who is holding the reins</b>.</p>
				<p>That is why we do not install AI like a plugin &mdash; we <b style="color:var(--ink)">train</b> it. We raise an automation the way you train a good horse: patiently, understanding its nature, with care and precision, until it can be trusted to carry real weight without bolting. It takes an eye for the human on both sides &mdash; the person it serves, and the person it reflects.</p>
				<p>It began in 2021, mid-lockdown, when two friends from Bangladesh watched the world of work crack open and refused to just wait and see what AI would do to us. Murtuja is an <b style="color:var(--ink)">anthropologist</b> &mdash; he studied human beings for years &mdash; who then came to the Technical University of Munich to study how people and machines shape each other; Ahasanul went deep into the data science that makes the machines work. One keeps asking what technology means for people; the other builds it so it does. Together, that is the whole company &mdash; and the whole promise: we help professionals meet the new world of work with a partner that reflects their <b style="color:var(--ink)">own best judgement</b> back at them, never a replacement for it.</p>
				<div class="astats">
					<div class="astat"><b>Human</b><span>what &ldquo;Anthropos&rdquo; means &mdash; and who AI must serve</span></div>
					<div class="astat"><b>Trained</b><span>like a horse: with care &amp; precision, not installed</span></div>
					<div class="astat"><b>Mirror</b><span>AI reflects the people who guide it</span></div>
				</div>
			</div>
			<div class="glass mfx"><canvas data-fx="crystal" style="--hue:var(--flow)"></canvas></div>
		</div>
	</div>
</section>

<section id="vision" class="visionband reveal">
	<canvas class="vfx" data-net data-nodes="70" data-pulses="46" aria-hidden="true"></canvas>
	<div class="visionband-in">
		<div class="veyebrow">Our Vision</div>
		<h2>We help professionals thrive in the new world of work</h2>
		<p class="vlead">Work is changing faster than most people can keep up with. Our job is to help professionals <b>meet that change with confidence — not to replace them.</b> We believe AI is a mirror: it reflects the people who build and guide it, for better or worse. So we build it carefully. We treat an AI system the way you would train a good horse — patiently, with real understanding, with care and precision — until it can be trusted to carry real work. That is how we keep it safe, human, and genuinely on your side.</p>
		<span class="pill2">◆ We make AI safe, human, and worth trusting</span>
	</div>
</section>

<section id="team">
	<div class="wrap band reveal"><div class="eyebrow" style="color:var(--cta)">Our Team &amp; how we work</div><h2>A small team of senior hands &mdash; you talk to the people who build it</h2><p class="soft">No account managers, no hand-offs to strangers. The people below are the ones who map your leak, train your automation and hand it over. Between them: anthropology, data science, cybersecurity, performance marketing and full-stack engineering &mdash; pointed at one thing, keeping the human at the centre.</p></div>
	<div class="wrap">
		<div class="worksteps">
			<div class="glass wstep reveal" style="--hue:var(--flow)"><canvas class="fxcanvas" data-fx="radar" style="--hue:var(--flow)"></canvas><div class="wk">STEP 01 · MAP</div><h4>We find the leak</h4><p>A live audit of where leads, replies and revenue drain out.</p></div>
			<div class="glass wstep reveal" style="--hue:var(--ai)"><canvas class="fxcanvas" data-fx="workflow" style="--hue:var(--ai)"></canvas><div class="wk">STEP 02 · BUILD</div><h4>We wire the agent</h4><p>Website + automation on n8n, connected to your tools.</p></div>
			<div class="glass wstep reveal" style="--hue:var(--g4)"><canvas class="fxcanvas" data-fx="growth" style="--hue:var(--g4)"></canvas><div class="wk">STEP 03 · HAND OVER</div><h4>You own it</h4><p>Documented, reporting, running — no dependency on us.</p></div>
		</div>
		<div class="team" role="list" style="margin-top:16px">
			<div class="glass tm reveal" role="listitem"><div class="av">MH</div><h5>Murtuja Hasan</h5><span>Founder &amp; CEO</span><em class="tm-spec">The anthropologist who runs the numbers</em><p>Murtuja studies people for a living &mdash; degrees in anthropology, an M.Sc. in Science &amp; Technology Studies from TUM, the CDTM Digital Changemaker and Digital Product School. By day he runs e-commerce and marketing for real businesses: a 7-person team, a &euro;150K+ budget, a steady 10&times; return. He started Anthropos because he kept watching good people drown in admin a well-trained machine should be doing for them.</p></div>
			<div class="glass tm reveal" role="listitem"><div class="av">AH</div><h5>Ahasanul Haque</h5><span>CTO</span><em class="tm-spec">Teaches the machines their manners</em><p>Ahasanul is the one who actually trains the AI. A data scientist with a Master's and production experience at Adobe, he turns &ldquo;it should just handle this&rdquo; into models and workflows that quietly do exactly that &mdash; and he is happiest when the clever part is invisible and the thing simply works.</p></div>
			<div class="glass tm reveal" role="listitem"><div class="av">SK</div><h5>Sina Khouei</h5><span>Team Lead, Cybersecurity &amp; Applied AI</span><em class="tm-spec">Guards the doors before anyone knocks</em><p>Before anything you build touches a real customer, it goes past Sina. A computer scientist from the University of Bonn, he treats your data and your automations as if they were his own &mdash; so &ldquo;safe&rdquo; is not a promise on a page, it is something already done.</p></div>
			<div class="glass tm reveal" role="listitem"><div class="av">AI</div><h5>Ariful Islam</h5><span>Media Buyer &amp; Ads Automation Strategist</span><em class="tm-spec">Turns budget into booked calls</em><p>Ariful makes sure the traffic actually shows up. He runs Google and Meta campaigns at returns most agencies quietly envy, then automates the tracking so you can see, to the euro, what your marketing brought back &mdash; no vanity metrics, no guessing.</p></div>
			<div class="glass tm reveal" role="listitem"><div class="av">AR</div><h5><a href="https://www.razzakabdur.com/" target="_blank" rel="noopener">Abdur Razak</a></h5><span>Head of Web Development</span><em class="tm-spec">Builds it so you can own it</em><p>Abdur builds the websites and the behind-the-scenes tools your system runs on. A full-stack developer who cares as much about the documentation as the code &mdash; he makes things you can actually own and hand to the next person, not a black box only he understands.</p></div>
		</div>
	</div>
</section>
<?php
anthropos_faq_section();
get_footer();
