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
		<div class="eyebrow" style="display:inline-block"><?php esc_html_e( 'The only button that matters', 'anthropos' ); ?></div>
		<h2><?php esc_html_e( 'Book a non-binding consultation', 'anthropos' ); ?></h2>
		<p><?php esc_html_e( 'Thirty minutes. We map one leak in your business live and show you the agent that closes it. No pitch, no obligation.', 'anthropos' ); ?></p>
		<a class="btn btn-cta" href="#"><?php esc_html_e( 'Book a Free Consultation', 'anthropos' ); ?></a>
	</div>
</section>
<footer class="ftr">
	<div class="foot">
		<div class="foot-brand">
			<a class="logo" href="<?php echo esc_url( $home ); ?>"><canvas class="knot" width="68" height="68" aria-hidden="true"></canvas><span><?php bloginfo( 'name' ); ?><small><?php esc_html_e( 'automation os', 'anthropos' ); ?></small></span></a>
			<p><?php esc_html_e( 'Web design + AEO/GEO + AI business automation for solo operators and small teams. Live systems in 4 weeks. Munich · EU-hosted.', 'anthropos' ); ?></p>
			<div class="foot-nap">ANTHROPOS AUTOMATION<br>MUNICH, GERMANY · EU-HOSTED<br>HELLO@ANTHROPOS-AUTOMATION.COM</div>
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
			<a href="#cta">Book a Consultation</a><a href="<?php echo esc_url( $home ); ?>#team">Team</a><a href="#">Impressum</a><a href="#">Privacy (GDPR)</a>
		</div>
	</div>
	<div class="foot-base">
		<span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> ANTHROPOS AUTOMATION · MUNICH</span>
		<span>EN / DE · ANTHROPOS-AUTOMATION.COM</span>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
