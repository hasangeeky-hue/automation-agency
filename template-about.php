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
	<div class="wrap band reveal"><div class="eyebrow" style="color:var(--flow)">Our Company</div><h2>One promise: every lead answered, nothing forgotten</h2></div>
	<div class="wrap">
		<div class="manifesto reveal" style="--hue:var(--flow)">
			<div>
				<span class="no">WHO WE ARE</span>
				<h3>Website, visibility and AI automation — built as one system</h3>
					<p>We help solo operators and small teams stop leaking revenue between the cracks — the missed call while you're with a client, the quote you meant to send on Tuesday, the past customer nobody followed up with. One connected system on n8n catches all of it, so being busy stops costing you the next job.</p>
				<p><b style="color:var(--ink)">We don't do</b> enterprise, custom consulting, or anything that keeps you dependent on us.</p>
				<div class="astats">
					<div class="astat"><b>4 wk</b><span>from start to live system</span></div>
					<div class="astat"><b>100%</b><span>yours at handover</span></div>
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
		<p class="vlead">Big companies win because their tools think and talk to each other. We want every plumber, therapist and shop owner to have the same advantage — <b>an AI-run layer that captures every inquiry and never forgets a name.</b> Not another app to check at 9pm; the system does the chasing, so your evenings are yours again.</p>
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
		<div class="team" role="list" style="margin-top:16px">
			<div class="glass tm reveal" role="listitem"><div class="av">MH</div><h5>Murtuja Hasan</h5><span>Founder &amp; CEO</span><p>Murtuja has spent years growing e-commerce and marketing for real businesses — leading a team, running serious ad budgets, and delivering a steady 10x return. He brings that same hard-won playbook to your project, personally.</p></div>
			<div class="glass tm reveal" role="listitem"><div class="av">AH</div><h5>Ahasanul Haque</h5><span>CTO</span><p>Ahasan builds the AI that runs quietly under the hood. With a data-science Master's from TU Munich and production experience at Adobe, he makes sure the clever stuff actually works — every single time.</p></div>
			<div class="glass tm reveal" role="listitem"><div class="av">SK</div><h5>Sina Khouei</h5><span>Team Lead, Cybersecurity &amp; Applied AI</span><p>Sina keeps your data and your automations safe. A computer scientist from the University of Bonn, he hardens every system before it ever touches a real customer, so security is never an afterthought.</p></div>
			<div class="glass tm reveal" role="listitem"><div class="av">AI</div><h5>Ariful Islam</h5><span>Media Buyer &amp; Ads Automation Strategist</span><p>Ariful turns ad budget into booked customers. He runs Google and Meta campaigns at exceptional returns and automates the tracking, so every euro you spend is accountable.</p></div>
			<div class="glass tm reveal" role="listitem"><div class="av">AR</div><h5><a href="https://www.razzakabdur.com/" target="_blank" rel="noopener">Abdur Razak</a></h5><span>Head of Web Development</span><p>Abdur builds the websites and the behind-the-scenes tools your system runs on — a full-stack developer who cares as much about clear documentation as he does about clean code.</p></div>
		</div>
	</div>
</section>
<?php
anthropos_faq_section();
get_footer();
