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

/** Consent Mode default (deny until accepted) + GTM loader — printed high in <head>. */
function anthropos_gtm_head() {
	$id = trim( (string) anthropos_gtm_id() );
	if ( '' === $id ) { return; }
	?>
<!-- Consent Mode v2: deny analytics/ads until the visitor consents (GDPR) -->
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('consent','default',{
  ad_storage:'denied', ad_user_data:'denied', ad_personalization:'denied',
  analytics_storage:'denied', wait_for_update:500
});
try{ if(localStorage.getItem('aa_consent')==='granted'){ gtag('consent','update',{analytics_storage:'granted'}); } }catch(e){}
</script>
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

/**
 * GDPR cookie-consent banner. Shows until the visitor accepts or declines;
 * on accept it grants Consent Mode analytics_storage so GTM/GA4 may run. A
 * "Cookie settings" link (anywhere, via [data-cc-open]) re-opens it so consent
 * can be withdrawn as easily as it was given.
 */
function anthropos_consent_banner() {
	if ( is_admin() || '' === trim( (string) anthropos_gtm_id() ) ) { return; }
	$privacy = home_url( '/privacy-policy/' );
	?>
	<div class="cc-banner" id="ccBanner" hidden role="dialog" aria-live="polite" aria-label="Cookie consent">
		<div class="cc-in">
			<p>We use cookies to run this site and, <b>only with your consent</b>, Google Analytics to see how it is used so we can improve it. You can change your mind any time. See our <a href="<?php echo esc_url( $privacy ); ?>">Privacy Policy</a>.</p>
			<div class="cc-btns">
				<button type="button" class="btn btn-glass" data-cc="decline">Decline</button>
				<button type="button" class="btn btn-cta" data-cc="accept">Accept analytics</button>
			</div>
		</div>
	</div>
	<script>
	(function(){
		var b=document.getElementById('ccBanner'); if(!b) return;
		function get(){ try{ return localStorage.getItem('aa_consent'); }catch(e){ return null; } }
		function set(v){ try{ localStorage.setItem('aa_consent',v); }catch(e){} }
		if(!get()){ b.hidden=false; }
		document.addEventListener('click', function(e){
			var t=e.target.closest('[data-cc]');
			if(t){
				var v=t.getAttribute('data-cc');
				if(v==='accept'){ set('granted'); try{ if(window.gtag){ gtag('consent','update',{analytics_storage:'granted'}); } }catch(err){} }
				else { set('denied'); }
				b.hidden=true;
			}
			if(e.target.closest('[data-cc-open]')){ e.preventDefault(); b.hidden=false; }
		});
	})();
	</script>
	<?php
}
add_action( 'wp_footer', 'anthropos_consent_banner', 7 );
