<?php
/**
 * Theme footer.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$audit = get_page_by_path( 'free-audit' );
$audit_url = $audit ? get_permalink( $audit ) : home_url( '/free-audit/' );
?>
<div class="aa-cta-band">
	<p class="q">&ldquo;<?php esc_html_e( 'Read your story. Name your leak.', 'anthropos' ); ?> <b><?php esc_html_e( 'Then decide — fix it yourself with the guides, or have it built in four weeks.', 'anthropos' ); ?></b>&rdquo;</p>
	<a class="aa-btn" href="<?php echo esc_url( $audit_url ); ?>"><?php esc_html_e( 'Get Free Website Audit', 'anthropos' ); ?></a>
</div>
<footer class="aa-footer">
	<div class="aa-foot-grid">
		<div class="aa-foot-brand">
			<a class="aa-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<canvas class="aa-knot" width="68" height="68" aria-hidden="true"></canvas>
				<span><?php bloginfo( 'name' ); ?><small><?php esc_html_e( 'automation', 'anthropos' ); ?></small></span>
			</a>
			<p><?php esc_html_e( 'Website redesign + lead automation for solo operators and small teams (€50k–€500k). Live in 4 weeks. Templated, honest, human.', 'anthropos' ); ?></p>
			<div class="aa-nap">ANTHROPOS AUTOMATION<br>MUNICH, GERMANY · EU-HOSTED<br>HELLO@ANTHROPOS-AUTOMATION.COM</div>
		</div>
		<div>
			<h4><?php esc_html_e( 'Stories', 'anthropos' ); ?></h4>
			<?php
			$hex = anthropos_group_hex();
			foreach ( anthropos_groups() as $slug => $label ) {
				$cat = get_category_by_slug( $slug );
				$url = $cat ? get_category_link( $cat ) : home_url( '/category/' . $slug . '/' );
				$dot = isset( $hex[ $slug ] ) ? $hex[ $slug ] : '#E8A34C';
				echo '<a href="' . esc_url( $url ) . '"><span class="gd" style="background:' . esc_attr( $dot ) . '"></span>' . esc_html( $label ) . '</a>';
			}
			?>
		</div>
		<div>
			<h4><?php esc_html_e( 'Guide series', 'anthropos' ); ?></h4>
			<?php $guides = get_page_by_path( 'guides' ); $gurl = $guides ? get_permalink( $guides ) : home_url( '/guides/' ); ?>
			<a href="<?php echo esc_url( $gurl ); ?>">A · Get Found</a>
			<a href="<?php echo esc_url( $gurl ); ?>">B · Earn Trust</a>
			<a href="<?php echo esc_url( $gurl ); ?>">C · Never Lose a Lead</a>
			<a href="<?php echo esc_url( $gurl ); ?>">D · Grow Calmly</a>
		</div>
		<div>
			<h4><?php esc_html_e( 'Company', 'anthropos' ); ?></h4>
			<?php
			$pages = array(
				'what-we-do'   => __( 'What We Do', 'anthropos' ),
				'how-it-works' => __( 'How It Works — 4 weeks', 'anthropos' ),
				'results'      => __( 'Results', 'anthropos' ),
				'free-audit'   => __( 'Free Website Audit', 'anthropos' ),
			);
			foreach ( $pages as $slug => $label ) {
				$p = get_page_by_path( $slug );
				if ( $p ) {
					echo '<a href="' . esc_url( get_permalink( $p ) ) . '">' . esc_html( $label ) . '</a>';
				}
			}
			?>
		</div>
	</div>
	<div class="aa-foot-base">
		<span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> ANTHROPOS AUTOMATION · MUNICH</span>
		<span>EN / DE · ANTHROPOS-AUTOMATION.COM</span>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
