<?php
/**
 * Analytics: Consent Mode v2 + Google Analytics 4 (loaded directly) + Google
 * Tag Manager, all consent-gated for GDPR.
 *
 * GA4 (G-4EVZC2JPF4) is loaded directly here via gtag so it works with no
 * action needed inside the GTM dashboard. GTM (GTM-MBDCQCMW) is also present
 * for future tag management. IMPORTANT: because GA4 is loaded here directly,
 * do NOT also add a GA4 tag inside GTM, that would double-count.
 *
 * Nothing collects data until the visitor accepts the cookie banner: Consent
 * Mode defaults analytics/ads to 'denied', and only Accept flips
 * analytics_storage to 'granted'.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/** GTM container ID (filterable; '' to disable GTM). */
function anthropos_gtm_id() {
	return apply_filters( 'anthropos_gtm_id', 'GTM-MBDCQCMW' );
}

/** GA4 measurement ID (filterable; '' to disable GA4). */
function anthropos_ga4_id() {
	return apply_filters( 'anthropos_ga4_id', 'G-4EVZC2JPF4' );
}

/** True if any tracking is configured. */
function anthropos_tracking_on() {
	return '' !== trim( (string) anthropos_gtm_id() ) || '' !== trim( (string) anthropos_ga4_id() );
}

/** Consent Mode default + GA4 + GTM loaders, printed high in <head>. */
function anthropos_gtm_head() {
	$gtm = trim( (string) anthropos_gtm_id() );
	$ga4 = trim( (string) anthropos_ga4_id() );
	if ( '' === $gtm && '' === $ga4 ) { return; }
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
<?php if ( '' !== $ga4 ) : ?>
<!-- Google Analytics 4 (consent-gated) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $ga4 ); ?>"></script>
<script>gtag('js', new Date());gtag('config','<?php echo esc_js( $ga4 ); ?>');</script>
<?php endif; ?>
<?php if ( '' !== $gtm ) : ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo esc_js( $gtm ); ?>');</script>
<!-- End Google Tag Manager -->
<?php endif; ?>
	<?php
}
add_action( 'wp_head', 'anthropos_gtm_head', 1 );

/** GTM <noscript> fallback, printed immediately after <body>. */
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
 * Push dataLayer events for conversion tracking: 'consultation_opened' when the
 * questionnaire modal opens (bound in the modal JS), and 'consultation_submitted'
 * on the ?consult=sent success state. GA4 collects these once consent is granted;
 * mark them as key events/conversions in GA4.
 */
function anthropos_gtm_events() {
	if ( ! anthropos_tracking_on() ) { return; }
	if ( isset( $_GET['consult'] ) && 'sent' === $_GET['consult'] ) {
		echo '<script>window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:"consultation_submitted"});</script>' . "\n";
	}
}
add_action( 'wp_footer', 'anthropos_gtm_events', 20 );

/**
 * GDPR cookie-consent banner. Shows until the visitor accepts or declines; on
 * accept it grants Consent Mode analytics_storage so GA4/GTM may run. A "Cookie
 * settings" link (anywhere, via [data-cc-open]) re-opens it so consent can be
 * withdrawn as easily as it was given.
 */
function anthropos_consent_banner() {
	if ( is_admin() || ! anthropos_tracking_on() ) { return; }
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
