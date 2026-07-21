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
	<div class="wrap band reveal"><div class="eyebrow" style="color:var(--flow)">Our Story</div><h2>Two dreamers, one question: what should AI do for people?</h2></div>
	<div class="wrap">
		<div class="manifesto reveal" style="--hue:var(--flow)">
			<div>
				<span class="no">HOW IT STARTED</span>
				<h3>2021. The world was locked down, and the ground was shifting under everyone's feet</h3>
				<p>Two friends from Bangladesh watched jobs change, AI arrive, and an old order start to crack. Instead of waiting to see what it would do to us, we decided to go and learn — really learn — what this technology can and cannot do. So we moved to Munich and enrolled at the <b style="color:var(--ink)">Technical University of Munich</b>, one of the best places in the world to understand it.</p>
				<p>Murtuja is an anthropologist by training who came to TUM for an M.Sc. in <b style="color:var(--ink)">Science &amp; Technology Studies</b> — the study of how people and machines shape each other — and earned the <b style="color:var(--ink)">CDTM Digital Changemaker</b> degree (TUM &amp; LMU) and <b style="color:var(--ink)">UnternehmerTUM's Digital Product School</b> along the way. Ahasanul went the other direction, deep into a <b style="color:var(--ink)">data-science Master's</b> and production AI at Adobe. One asks what technology means for humans; the other builds it. Together, that is the whole company.</p>
				<p><b style="color:var(--ink)">"Anthropos" is Greek for human.</b> We chose the name on purpose: the machine serves the person, never the other way around.</p>
				<div class="astats">
					<div class="astat"><b>TUM</b><span>M.Sc. + CDTM, Munich</span></div>
					<div class="astat"><b>10&times;</b><span>ad-spend return, in the real world</span></div>
					<div class="astat"><b>2021</b><span>the year we started preparing</span></div>
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
	<div class="wrap band reveal"><div class="eyebrow" style="color:var(--cta)">Our Team &amp; how we work</div><h2>Real people, a repeatable method</h2></div>
	<div class="wrap">
		<div class="worksteps">
			<div class="glass wstep reveal" style="--hue:var(--flow)"><canvas class="fxcanvas" data-fx="radar" style="--hue:var(--flow)"></canvas><div class="wk">STEP 01 · MAP</div><h4>We find the leak</h4><p>A live audit of where leads, replies and revenue drain out.</p></div>
			<div class="glass wstep reveal" style="--hue:var(--ai)"><canvas class="fxcanvas" data-fx="workflow" style="--hue:var(--ai)"></canvas><div class="wk">STEP 02 · BUILD</div><h4>We wire the agent</h4><p>Website + automation on n8n, connected to your tools.</p></div>
			<div class="glass wstep reveal" style="--hue:var(--g4)"><canvas class="fxcanvas" data-fx="growth" style="--hue:var(--g4)"></canvas><div class="wk">STEP 03 · HAND OVER</div><h4>You own it</h4><p>Documented, reporting, running — no dependency on us.</p></div>
		</div>
		<div class="team" role="list" style="margin-top:16px">
			<div class="glass tm reveal" role="listitem"><div class="av">MH</div><h5>Murtuja Hasan</h5><span>Founder &amp; CEO</span><p>An anthropologist who came to the Technical University of Munich for an M.Sc. in Science &amp; Technology Studies, with the CDTM Digital Changemaker degree and UnternehmerTUM's Digital Product School behind him. By day he leads e-commerce and performance marketing for real businesses — a 7-person team, a €150K+ ad budget, a steady 10× return — and brings that same playbook to your project, personally.</p></div>
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
