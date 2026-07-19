<?php
/**
 * Theme header (v3).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
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
		<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<canvas class="knot" width="68" height="68" aria-hidden="true"></canvas>
			<span><?php bloginfo( 'name' ); ?><small><?php esc_html_e( 'automation os', 'anthropos' ); ?></small></span>
		</a>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'menu_class'     => 'nav',
			'container'      => false,
			'fallback_cb'    => 'anthropos_fallback_menu',
		) );
		?>
		<div class="nav-cta">
			<div class="team-mini" aria-hidden="true"><i></i><i></i><i></i><span><?php esc_html_e( 'meet the team', 'anthropos' ); ?></span></div>
			<a class="btn btn-cta" href="#cta"><?php esc_html_e( 'Book a Free Consultation', 'anthropos' ); ?></a>
			<button class="nav-toggle" id="navToggle" aria-label="<?php esc_attr_e( 'Open menu', 'anthropos' ); ?>" aria-expanded="false"><span></span><span></span><span></span></button>
		</div>
	</div>
</header>
