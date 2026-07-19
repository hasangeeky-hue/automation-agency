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
	<div class="wrap band reveal"><div class="eyebrow" style="color:var(--flow)">Our Company</div><h2>A small studio for a single, honest promise</h2></div>
	<div class="wrap">
		<div class="manifesto reveal" style="--hue:var(--flow)">
			<div>
				<span class="no">WHO WE ARE</span>
				<h3>Web design + AEO/GEO + AI automation, in one place</h3>
				<p>We help solo operators and small teams turn a good service into a self-running system: a website that converts, visibility that gets you found, and AI agents on n8n that follow up for you.</p>
				<p><b style="color:var(--ink)">We don't do</b> enterprise, custom consulting, or anything that keeps you dependent on us.</p>
				<div class="astats">
					<div class="astat"><b>4 wk</b><span>from start to live system</span></div>
					<div class="astat"><b>€50–500k</b><span>revenue we serve</span></div>
					<div class="astat"><b>7</b><span>customer segments</span></div>
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
		<h2>An automation OS for every small business</h2>
		<p class="vlead">Large companies win because their tools think and talk to each other. We want every plumber, therapist and shop owner to have the same nervous system — <b>an AI-run operating layer that captures demand and never forgets a name.</b> Not more software to manage. Fewer decisions to make.</p>
		<span class="pill2">◆ Human by design — it just feels like you finally had time</span>
	</div>
</section>

<section id="team">
	<div class="wrap band reveal"><div class="eyebrow" style="color:var(--cta)">Our Team &amp; how we work</div><h2>Real people, a repeatable method</h2></div>
	<div class="wrap">
		<div class="worksteps">
			<div class="glass wstep reveal" style="--hue:var(--flow)"><canvas class="fxcanvas" data-fx="radar" style="--hue:var(--flow)"></canvas><div class="wk">STEP 01 · MAP</div><h4>We find the leak</h4><p>A live audit of where leads, replies and revenue drain out.</p></div>
			<div class="glass wstep reveal" style="--hue:var(--ai)"><canvas class="fxcanvas" data-fx="workflow" style="--hue:var(--ai)"></canvas><div class="wk">STEP 02 · BUILD</div><h4>We wire the agent</h4><p>Website + automation on n8n, connected to your tools.</p></div>
			<div class="glass wstep reveal" style="--hue:var(--g4)"><canvas class="fxcanvas" data-fx="growth" style="--hue:var(--g4)"></canvas><div class="wk">STEP 03 · HAND OVER</div><h4>You own it</h4><p>Documented, reporting, running — no dependency on us.</p></div>
		</div>
		<div class="team" style="margin-top:16px">
			<div class="glass tm reveal"><div class="av"></div><h5>Founder Name</h5><span>Automation Strategy</span><p>Maps the leak, designs the agent system.</p></div>
			<div class="glass tm reveal"><div class="av"></div><h5>Team Member</h5><span>n8n Engineer</span><p>Wires the workflows across your stack.</p></div>
			<div class="glass tm reveal"><div class="av"></div><h5>Team Member</h5><span>Web &amp; AEO</span><p>Builds the site and the visibility layer.</p></div>
			<div class="glass tm reveal"><div class="av"></div><h5>Team Member</h5><span>Client Success</span><p>Keeps every system running and reporting.</p></div>
		</div>
	</div>
</section>
<?php
anthropos_faq_section();
get_footer();
