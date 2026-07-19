<?php
/**
 * Template Name: About Page
 * Our Company · Our Vision · Our Team — each designed with 3D.
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
	<div class="wrap band reveal"><div class="eyebrow">Our Company</div><h2>A small studio for a single, honest promise</h2></div>
	<div class="wrap">
		<div class="glass sp-block reveal" style="--hue:var(--flow)"><div class="sp-fx"><canvas data-fx="crystal" style="--hue:var(--flow)"></canvas></div><div class="sp-body"><span class="no">WHO WE ARE</span><h3>Web design + AEO/GEO + AI automation, in one place</h3><p>We help solo operators and small teams (€50k–€500k) turn a good service into a self-running system: a website that converts, visibility that gets you found, and AI agents on n8n that follow up for you.</p><p class="bestfor"><b>We don't do:</b> enterprise, custom consulting, or anything that keeps you dependent on us.</p></div></div>
		<div class="grid-3" style="margin-top:16px">
			<div class="glass card reveal tilt" style="--hue:var(--g2)"><canvas class="fxcanvas" data-fx="growth" style="--hue:var(--g2)"></canvas><div class="card-b"><span class="lbl">Fast</span><h4>Live in 4 weeks</h4><p>Templated, repeatable, not open-ended consulting.</p></div></div>
			<div class="glass card reveal tilt" style="--hue:var(--flow)"><canvas class="fxcanvas" data-fx="dataflow" style="--hue:var(--flow)"></canvas><div class="card-b"><span class="lbl">Honest</span><h4>Systems you own</h4><p>Built on your tools, handed over, documented.</p></div></div>
			<div class="glass card reveal tilt" style="--hue:var(--cta)"><canvas class="fxcanvas" data-fx="core" style="--hue:var(--cta)"></canvas><div class="card-b"><span class="lbl">Focused</span><h4>One clear problem</h4><p>Leads captured, nurtured, and booked — 24/7.</p></div></div>
		</div>
	</div>
</section>

<section id="vision">
	<div class="wrap band reveal"><div class="eyebrow">Our Vision</div><h2>An automation OS for every small business</h2></div>
	<div class="wrap">
		<div class="glass sp-block reveal" style="--hue:var(--ai)"><div class="sp-fx"><canvas data-fx="orbit" style="--hue:var(--ai)"></canvas></div><div class="sp-body"><span class="no">WHERE WE'RE HEADED</span><h3>The big-company advantage, made small &amp; affordable</h3><p>Large companies win because their tools think and talk to each other. We want every plumber, therapist and shop owner to have the same nervous system — an AI-run operating layer that captures demand and never forgets a name.</p><p>Not more software to manage. Fewer decisions to make.</p></div></div>
		<div class="glass offer-note reveal"><b>The strangest part?</b> <span class="pill">Human by design</span> Nothing we build feels automated to <em>your</em> customer — it just feels like you finally had time.</div>
	</div>
</section>

<section id="team">
	<div class="wrap band reveal"><div class="eyebrow">Our Team</div><h2>Real people building the machines</h2><p class="soft">Automation feels human when humans design it. <b>[Placeholder bios — real content later.]</b></p></div>
	<div class="wrap"><div class="team">
		<div class="glass tm reveal"><div class="av"></div><h5>Founder Name</h5><span>Automation Strategy</span><p>Maps the leak, designs the agent system.</p></div>
		<div class="glass tm reveal"><div class="av"></div><h5>Team Member</h5><span>n8n Engineer</span><p>Wires the workflows across your stack.</p></div>
		<div class="glass tm reveal"><div class="av"></div><h5>Team Member</h5><span>Web &amp; AEO</span><p>Builds the site and the visibility layer.</p></div>
		<div class="glass tm reveal"><div class="av"></div><h5>Team Member</h5><span>Client Success</span><p>Keeps every system running and reporting.</p></div>
	</div></div>
</section>
<?php
get_footer();
