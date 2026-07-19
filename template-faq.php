<?php
/**
 * Template Name: FAQ Page
 * Master FAQ, segmented into topic groups (JS fills [data-faq]).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$groups = array(
	array( 'Getting Started', 'gettingStarted', 'var(--flow)' ),
	array( 'Services &amp; Scope', 'servicesScope', 'var(--g2)' ),
	array( 'Automation &amp; Tools', 'automationTools', 'var(--ai)' ),
	array( 'Trust &amp; Pricing', 'trustPricing', 'var(--cta)' ),
);
?>
<section class="hero" style="--hue:var(--flow)">
	<canvas class="fx" data-net data-nodes="80" data-pulses="55" aria-hidden="true"></canvas>
	<div class="hero-in">
		<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> / FAQ</div>
		<h1>Straight answers, <span class="grad">no jargon</span></h1>
		<p class="sub">Everything you'd ask before booking a call — grouped so you can jump to what matters. Still unsure? <b>The consultation is free and non-binding.</b></p>
		<div class="hero-ctas"><a class="btn btn-cta" href="#cta">Book a non-binding consultation</a><a class="btn btn-glass" href="#groups">Read the FAQ ↓</a></div>
	</div>
</section>
<section id="groups">
	<div class="wrap band reveal"><div class="eyebrow">FAQ · segmented by topic</div><h2>Find your question, fast</h2></div>
	<div class="wrap"><div class="faq-groups">
		<?php foreach ( $groups as $g ) { echo '<div class="faq-group reveal" style="--hue:' . esc_attr( $g[2] ) . '"><div class="fgh"><span class="fgd"></span>' . wp_kses_post( $g[0] ) . '</div><div class="faqwrap" data-faq="' . esc_attr( $g[1] ) . '"></div></div>'; } ?>
	</div></div>
</section>
<?php
get_footer();
