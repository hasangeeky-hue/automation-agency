<?php
/**
 * Theme footer (v3): CTA band + footer.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<section class="ctaband" id="cta">
	<canvas id="ctaFx" aria-hidden="true"></canvas>
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
			<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><canvas class="knot" width="68" height="68" aria-hidden="true"></canvas><span><?php bloginfo( 'name' ); ?><small><?php esc_html_e( 'automation os', 'anthropos' ); ?></small></span></a>
			<p><?php esc_html_e( 'Web design + AEO/GEO + AI business automation for solo operators and small teams. Live systems in 4 weeks. Munich · EU-hosted.', 'anthropos' ); ?></p>
			<div class="foot-nap">ANTHROPOS AUTOMATION<br>MUNICH, GERMANY · EU-HOSTED<br>HELLO@ANTHROPOS-AUTOMATION.COM</div>
		</div>
		<div>
			<h6><?php esc_html_e( 'About Us', 'anthropos' ); ?></h6>
			<a href="#about"><?php esc_html_e( 'Our Company', 'anthropos' ); ?></a>
			<a href="#team"><?php esc_html_e( 'Our Team', 'anthropos' ); ?></a>
			<a href="#solve"><?php esc_html_e( 'How We Solve It', 'anthropos' ); ?></a>
			<a href="#about"><?php esc_html_e( 'Our Vision', 'anthropos' ); ?></a>
		</div>
		<div>
			<h6><?php esc_html_e( 'Services', 'anthropos' ); ?></h6>
			<a href="#services"><?php esc_html_e( 'Conversion Web Design', 'anthropos' ); ?></a>
			<a href="#services"><?php esc_html_e( 'AEO / GEO / SEO', 'anthropos' ); ?></a>
			<a href="#services"><?php esc_html_e( 'Lead Automation', 'anthropos' ); ?></a>
			<a href="#services"><?php esc_html_e( 'AI Agents · n8n', 'anthropos' ); ?></a>
		</div>
		<div>
			<h6><?php esc_html_e( 'Industries', 'anthropos' ); ?></h6>
			<?php foreach ( anthropos_groups() as $g ) { echo '<a href="#industries"><span class="gd" style="background:' . esc_attr( $g[1] ) . '"></span>' . wp_kses_post( $g[0] ) . '</a>'; } ?>
		</div>
		<div>
			<h6><?php esc_html_e( 'Company', 'anthropos' ); ?></h6>
			<?php $blog = get_permalink( get_option( 'page_for_posts' ) ); ?>
			<a href="<?php echo esc_url( $blog ? $blog : home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Blog', 'anthropos' ); ?></a>
			<a href="#servicepage"><?php esc_html_e( 'Guides', 'anthropos' ); ?></a>
			<a href="#cta"><?php esc_html_e( 'Book a Consultation', 'anthropos' ); ?></a>
			<a href="#"><?php esc_html_e( 'Impressum', 'anthropos' ); ?></a>
			<a href="#"><?php esc_html_e( 'Privacy (GDPR)', 'anthropos' ); ?></a>
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
