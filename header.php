<?php
/**
 * Theme header.
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
<header class="aa-header">
	<div class="aa-nav">
		<a class="aa-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<canvas class="aa-knot" width="68" height="68" aria-hidden="true"></canvas>
			<span><?php bloginfo( 'name' ); ?><small><?php esc_html_e( 'automation', 'anthropos' ); ?></small></span>
		</a>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'menu_class'     => 'aa-menu',
			'container'      => false,
			'fallback_cb'    => 'anthropos_fallback_menu',
		) );
		?>
		<div class="aa-nav-cta">
			<?php $audit = get_page_by_path( 'free-audit' ); ?>
			<a class="aa-btn" href="<?php echo esc_url( $audit ? get_permalink( $audit ) : home_url( '/free-audit/' ) ); ?>"><?php esc_html_e( 'Get Free Website Audit', 'anthropos' ); ?></a>
		</div>
	</div>
</header>
