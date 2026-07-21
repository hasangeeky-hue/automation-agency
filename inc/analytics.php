<?php
/**
 * Google Tag Manager + a lead-conversion dataLayer event.
 *
 * GTM is the single container; GA4 (G-4EVZC2JPF4) should be added as a tag
 * INSIDE GTM (GA4 Configuration tag), not hardcoded here — that avoids
 * double-counting. The head snippet loads as early as possible in <head>,
 * and the <noscript> fallback renders right after <body> via wp_body_open.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/** Your GTM container ID. Filterable; return '' to switch tracking off. */
function anthropos_gtm_id() {
	return apply_filters( 'anthropos_gtm_id', 'GTM-MBDCQCMW' );
}

/** GTM loader — printed high in the <head>. */
function anthropos_gtm_head() {
	$id = trim( (string) anthropos_gtm_id() );
	if ( '' === $id ) { return; }
	?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo esc_js( $id ); ?>');</script>
<!-- End Google Tag Manager -->
	<?php
}
add_action( 'wp_head', 'anthropos_gtm_head', 1 );

/** GTM <noscript> fallback — printed immediately after <body>. */
function anthropos_gtm_body() {
	$id = trim( (string) anthropos_gtm_id() );
	if ( '' === $id ) { return; }
	?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr( $id ); ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<?php
}
add_action( 'wp_body_open', 'anthropos_gtm_body' );

/**
 * Push a dataLayer event when a visitor lands on the consultation success
 * state (?consult=sent), so GTM can mark it a GA4 conversion. Also fires a
 * lighter 'consultation_opened' event when the modal is opened (bound in JS).
 */
function anthropos_gtm_events() {
	if ( '' === trim( (string) anthropos_gtm_id() ) ) { return; }
	if ( isset( $_GET['consult'] ) && 'sent' === $_GET['consult'] ) {
		echo '<script>window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:"consultation_submitted"});</script>' . "\n";
	}
}
add_action( 'wp_footer', 'anthropos_gtm_events', 20 );
