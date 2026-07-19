<?php
/**
 * Theme header (v4) — renders the fixed nav that matches the design system.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$home = home_url( '/' );
$svc  = home_url( '/services/' );
$guides = home_url( '/guides/' );
$blog = get_permalink( get_option( 'page_for_posts' ) );
if ( ! $blog ) { $blog = home_url( '/blog/' ); }
$segs = function_exists( 'anthropos_segments' ) ? anthropos_segments() : array();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="hd">
	<div class="hd-in">
		<a class="logo" href="<?php echo esc_url( $home ); ?>"><canvas class="knot" width="68" height="68" aria-hidden="true"></canvas><span><?php bloginfo( 'name' ); ?><small><?php esc_html_e( 'automation os', 'anthropos' ); ?></small></span></a>
		<ul class="nav">
			<li data-menu><a href="<?php echo esc_url( $home ); ?>#about"><?php esc_html_e( 'About Us', 'anthropos' ); ?></a>
				<ul class="sub">
					<li><a href="<?php echo esc_url( $home ); ?>#about">Our Company</a></li>
					<li><a href="<?php echo esc_url( $home ); ?>#team">Our Team</a></li>
					<li><a href="<?php echo esc_url( $home ); ?>#solve">How We Solve It</a></li>
					<li><a href="<?php echo esc_url( $home ); ?>#about">Our Vision</a></li>
				</ul>
			</li>
			<li data-menu><a href="<?php echo esc_url( $svc ); ?>"><?php esc_html_e( 'Services', 'anthropos' ); ?></a>
				<ul class="sub">
					<?php foreach ( $segs as $slug => $s ) { echo '<li><a href="' . esc_url( anthropos_seg_url( $slug ) ) . '" style="--hue:' . esc_attr( $s['hue'] ) . '"><span class="dot"></span>' . wp_kses_post( $s['title'] ) . '</a></li>'; } ?>
				</ul>
			</li>
			<li><a href="<?php echo esc_url( $guides ); ?>"><?php esc_html_e( 'Guides', 'anthropos' ); ?></a></li>
			<li><a href="<?php echo esc_url( $blog ); ?>"><?php esc_html_e( 'Blog', 'anthropos' ); ?></a></li>
			<li><a href="<?php echo esc_url( $home ); ?>#team"><?php esc_html_e( 'Team', 'anthropos' ); ?></a></li>
		</ul>
		<div class="nav-cta">
			<a class="btn btn-cta" href="#cta"><?php esc_html_e( 'Book a Free Consultation', 'anthropos' ); ?></a>
			<button class="nav-toggle" id="navToggle" aria-label="<?php esc_attr_e( 'Menu', 'anthropos' ); ?>" aria-expanded="false"><span></span><span></span><span></span></button>
		</div>
	</div>
</header>
