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
		<p class="sub">We build automation that feels human, because humans design it. Here's who we are, where we're headed, and the team that wires it together.</p>
		<div class="hero-ctas"><a class="btn btn-cta" href="#cta">Book a non-binding consultation</a><a class="btn btn-glass" href="#company">Read our story ↓</a></div>
	</div>
</section>

<section id="company">
	<div class="wrap band reveal"><div class="eyebrow" style="color:var(--flow)">Our Story</div><h2>Two friends who studied AI together, and built a company on one idea</h2></div>
	<div class="wrap">
		<div class="manifesto reveal" style="--hue:var(--flow)">
			<div>
				<span class="no">WHO WE ARE</span>
				<h3>&ldquo;Anthropos&rdquo; is Greek for the human being. That is not a name, it is the whole idea</h3>
				<p><b style="color:var(--ink)">Murtuja and Ahasanul</b> are two friends from Bangladesh who met and studied together at the <b style="color:var(--ink)">Technical University of Munich</b>. We came for the same reason: to understand, properly, what AI was about to do to the way we all work, and to make sure it worked <b style="color:var(--ink)">for</b> people, not against them. We started Anthropos together, as equal partners, out of that one conviction.</p>
				<p>We come at it from two sides that need each other. <b style="color:var(--ink)">Murtuja</b> comes from the human side, an anthropologist by training who lives in marketing and growth, always asking what a tool actually does to the person using it. <b style="color:var(--ink)">Ahasanul</b> comes from the machine side, a data scientist who designs and builds the models and makes them genuinely work. One keeps asking <i>what does this mean for people</i>; the other makes it real. Neither half is the company on its own, together, they are.</p>
				<p>We do not treat AI as software to install. We <b style="color:var(--ink)">train</b> it, the way you train a good horse: patiently, with care and precision, until it can be trusted with real work. And we named the company <b style="color:var(--ink)">Anthropos</b>, the human, to remind ourselves, on every build, who it is really for.</p>
				<div class="astats">
					<div class="astat"><b>Two</b><span>co-founders, two sides of one problem</span></div>
					<div class="astat"><b>TUM</b><span>where we met &amp; studied AI together</span></div>
					<div class="astat"><b>Human</b><span>what &ldquo;Anthropos&rdquo; means, and who it serves</span></div>
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
		<p class="vlead">Work is changing faster than most people can keep up with. Our job is to help professionals <b>meet that change with confidence, not to replace them.</b> We believe AI is a mirror: it reflects the people who build and guide it, for better or worse. So we build it carefully. We treat an AI system the way you would train a good horse, patiently, with real understanding, with care and precision, until it can be trusted to carry real work. That is how we keep it safe, human, and genuinely on your side.</p>
		<span class="pill2">◆ We make AI safe, human, and worth trusting</span>
	</div>
</section>

<section id="team">
	<div class="wrap band reveal"><div class="eyebrow" style="color:var(--cta)">Our Team &amp; how we work</div><h2>A small team of senior hands, you talk to the people who build it</h2><p class="soft">No account managers, no hand-offs to strangers. The people below are the ones who map your leak, train your automation and hand it over. Between them: anthropology, data science, cybersecurity, performance marketing and full-stack engineering, pointed at one thing, keeping the human at the centre.</p></div>
	<div class="wrap">
		<div class="worksteps">
			<div class="glass wstep reveal" style="--hue:var(--flow)"><canvas class="fxcanvas" data-fx="radar" style="--hue:var(--flow)"></canvas><div class="wk">STEP 01 · MAP</div><h4>We find the leak</h4><p>A live audit of where leads, replies and revenue drain out.</p></div>
			<div class="glass wstep reveal" style="--hue:var(--ai)"><canvas class="fxcanvas" data-fx="workflow" style="--hue:var(--ai)"></canvas><div class="wk">STEP 02 · BUILD</div><h4>We wire the agent</h4><p>Website + automation on n8n, connected to your tools.</p></div>
			<div class="glass wstep reveal" style="--hue:var(--g4)"><canvas class="fxcanvas" data-fx="growth" style="--hue:var(--g4)"></canvas><div class="wk">STEP 03 · HAND OVER</div><h4>You own it</h4><p>Documented, reporting, running, no dependency on us.</p></div>
		</div>
		<div class="team" role="list" style="margin-top:16px">
			<article class="glass tm reveal" role="listitem" style="--tmhue:var(--ai)"><div class="tm-photo"><img src="https://anthropos-automation.com/wp-content/uploads/2026/07/Hasan.jpg" alt="Murtuja Hasan" loading="lazy"></div><div class="tm-body"><h5>Murtuja Hasan</h5><span class="tm-role">Co-founder &amp; CEO</span><p>The human side of Anthropos. An anthropologist by training who leads strategy, brand and growth, and keeps every build focused on the person actually using it.</p></div></article>
			<article class="glass tm reveal" role="listitem" style="--tmhue:var(--flow)"><div class="tm-photo"><img src="https://anthropos-automation.com/wp-content/uploads/2026/07/Ahsan.jpeg" alt="Ahasanul Haque" loading="lazy"></div><div class="tm-body"><h5>Ahasanul Haque</h5><span class="tm-role">Co-founder &amp; CTO</span><p>The machine side of Anthropos. A data scientist who designs and builds the AI and automation, and makes sure the clever part quietly just works.</p></div></article>
			<article class="glass tm reveal" role="listitem" style="--tmhue:var(--cta)"><div class="tm-photo"><img src="https://anthropos-automation.com/wp-content/uploads/2026/07/sina.jpeg" alt="Sina Khouei" loading="lazy"></div><div class="tm-body"><h5>Sina Khouei</h5><span class="tm-role">Cybersecurity &amp; Applied AI</span><p>A computer scientist from the University of Bonn who hardens every system before it goes live, so your data and your automations stay secure.</p></div></article>
			<article class="glass tm reveal" role="listitem" style="--tmhue:var(--g6)"><div class="tm-photo"><img src="https://anthropos-automation.com/wp-content/uploads/2026/07/ariful.jpeg" alt="Ariful Islam" loading="lazy"></div><div class="tm-body"><h5>Ariful Islam</h5><span class="tm-role">Media Buying &amp; Ads Automation</span><p>Plans and runs Google and Meta campaigns and automates the tracking behind them, so you can see what your marketing spend brings back.</p></div></article>
			<article class="glass tm reveal" role="listitem" style="--tmhue:var(--g5)"><div class="tm-photo"><img src="https://anthropos-automation.com/wp-content/uploads/2026/07/Razzyak.jpeg" alt="Abdur Razak" loading="lazy"></div><div class="tm-body"><h5><a href="https://www.razzakabdur.com/" target="_blank" rel="noopener">Abdur Razak</a></h5><span class="tm-role">Head of Web Development</span><p>A full-stack developer who builds the websites and tools your system runs on, and documents his work so you can own and maintain it.</p></div></article>
		</div>
	</div>
</section>
<?php
anthropos_faq_section();
get_footer();
