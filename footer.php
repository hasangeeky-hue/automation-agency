<?php
/**
 * Theme footer (v4): CTA band + footer.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$home = home_url( '/' );
$svc  = home_url( '/services/' );
$blog = get_permalink( get_option( 'page_for_posts' ) );
if ( ! $blog ) { $blog = home_url( '/blog/' ); }
?>
<section class="ctaband" id="cta">
	<canvas class="fx" data-net data-nodes="55" data-pulses="36" aria-hidden="true"></canvas>
	<div class="ctaband-in">
		<div class="eyebrow" style="display:inline-block"><?php esc_html_e( 'Tell us where you are stuck', 'anthropos' ); ?></div>
		<h2><?php esc_html_e( 'Book a free consultation', 'anthropos' ); ?></h2>
		<p><?php esc_html_e( 'It starts with a quick, tick-box questionnaire, about two minutes. That is how we make sure the call is genuinely worth your time. Then you pick a slot in your own timezone.', 'anthropos' ); ?></p>
		<div class="hero-ctas" style="justify-content:center">
			<button type="button" class="btn btn-cta" data-open-consult><?php esc_html_e( 'Answer a few questions & book →', 'anthropos' ); ?></button>
		</div>
	</div>
</section>
<footer class="ftr">
	<div class="foot">
		<div class="foot-brand">
			<a class="logo" href="<?php echo esc_url( $home ); ?>"><?php echo anthropos_logo_mark( 40, 'ft' ); // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG ?><span><?php esc_html_e( 'Anthropos Automation', 'anthropos' ); ?><small><?php esc_html_e( 'service', 'anthropos' ); ?></small></span></a>
			<p><?php esc_html_e( 'We turn small businesses into self-running systems.', 'anthropos' ); ?></p>
			<div class="foot-nap">ANTHROPOS AUTOMATION SERVICE LLC<br>1309 COFFEEN AVENUE STE 1200<br>SHERIDAN, WYOMING 82801, USA<br><a href="mailto:contact@anthropos-automation.com">CONTACT@ANTHROPOS-AUTOMATION.COM</a></div>
		</div>
		<div>
			<h6><?php esc_html_e( 'About Us', 'anthropos' ); ?></h6>
			<a href="<?php echo esc_url( $home ); ?>#about">Our Company</a><a href="<?php echo esc_url( $home ); ?>#team">Our Team</a><a href="<?php echo esc_url( $home ); ?>#solve">How We Solve It</a><a href="<?php echo esc_url( $home ); ?>#about">Our Vision</a>
		</div>
		<div>
			<h6><?php esc_html_e( 'Services', 'anthropos' ); ?></h6>
			<a href="<?php echo esc_url( $svc ); ?>">Regulated Professionals</a><a href="<?php echo esc_url( $svc ); ?>">Medical Professionals</a><a href="<?php echo esc_url( $svc ); ?>">E-Commerce &amp; Retail</a><a href="<?php echo esc_url( $svc ); ?>">B2B Service Providers</a>
		</div>
		<div>
			<h6><?php esc_html_e( 'Learn', 'anthropos' ); ?></h6>
			<a href="<?php echo esc_url( $blog ); ?>">Blog</a><a href="<?php echo esc_url( home_url( '/guides/' ) ); ?>">Guides</a><a href="<?php echo esc_url( $home ); ?>#solve">How We Solve It</a>
		</div>
		<div>
			<h6><?php esc_html_e( 'Company', 'anthropos' ); ?></h6>
			<a href="#cta">Book a Consultation</a><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a><a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">Terms</a><a href="<?php echo esc_url( home_url( '/imprint/' ) ); ?>">Imprint</a><a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>">Cookie Policy</a><a href="#" data-cc-open>Cookie Settings</a>
		</div>
	</div>
	<div class="foot-base">
		<span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> ANTHROPOS AUTOMATION SERVICE LLC</span>
		<span>ANTHROPOS-AUTOMATION.COM · US · UK · EU</span>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
