<?php
/**
 * Newsletter subscription box (shown under the CTA on every blog/guide).
 * Self-contained: submits to admin-post.php, emails the new subscriber to the
 * business, and optionally forwards to a webhook (n8n / Mailchimp / Brevo) so a
 * real double-opt-in provider can be connected later. No external dependency.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/** Where new-subscriber notifications are sent. */
function anthropos_newsletter_email() {
	return apply_filters( 'anthropos_newsletter_email', get_option( 'admin_email' ) );
}

/** Optional webhook — paste an n8n / Mailchimp / Brevo endpoint to push each
 *  subscriber automatically (for real double-opt-in). Empty = email only. */
function anthropos_newsletter_webhook_url() {
	return apply_filters( 'anthropos_newsletter_webhook_url', '' );
}

/** Render the newsletter box. */
function anthropos_newsletter_form() {
	$ok  = isset( $_GET['nl'] ) && 'ok' === $_GET['nl'];
	$err = isset( $_GET['nl'] ) && 'error' === $_GET['nl'];
	?>
	<div class="art-news" id="news">
		<h4>Get the next guide in your inbox</h4>
		<?php if ( $ok ) : ?>
			<p class="art-news-ok"><b>You're subscribed &mdash; thank you.</b> Practical automation guides, straight to your inbox.</p>
		<?php else : ?>
			<p>Plain-language automation guides for busy business owners. No spam, unsubscribe any time.</p>
			<?php if ( $err ) : ?><p class="art-news-err">Please enter a valid email address and try again.</p><?php endif; ?>
			<form class="art-news-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="anthropos_newsletter">
				<?php wp_nonce_field( 'anthropos_newsletter', 'anthropos_nl_nonce' ); ?>
				<span class="cf-hp" aria-hidden="true"><label>Leave this empty<input type="text" name="nl_hp" tabindex="-1" autocomplete="off"></label></span>
				<input type="email" name="nl_email" placeholder="you@yourbusiness.com" aria-label="Your email address" required>
				<button class="btn btn-cta" type="submit">Subscribe &rarr;</button>
			</form>
			<small>By subscribing you agree to our <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">privacy policy</a>. Unsubscribe any time.</small>
		<?php endif; ?>
	</div>
	<?php
}

/** Handle a subscription securely. */
function anthropos_handle_newsletter() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	if ( ! isset( $_POST['anthropos_nl_nonce'] ) || ! wp_verify_nonce( $_POST['anthropos_nl_nonce'], 'anthropos_newsletter' ) ) {
		wp_safe_redirect( add_query_arg( 'nl', 'error', $back ) . '#news' );
		exit;
	}
	// Honeypot: silently accept bots.
	if ( ! empty( $_POST['nl_hp'] ) ) {
		wp_safe_redirect( add_query_arg( 'nl', 'ok', $back ) . '#news' );
		exit;
	}
	$email = isset( $_POST['nl_email'] ) ? sanitize_email( wp_unslash( $_POST['nl_email'] ) ) : '';
	if ( ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'nl', 'error', $back ) . '#news' );
		exit;
	}

	wp_mail( anthropos_newsletter_email(), 'New newsletter subscriber', "New subscriber: " . $email . "\nFrom page: " . $back . "\nAt: " . current_time( 'mysql' ) . "\n" );

	$hook = trim( (string) anthropos_newsletter_webhook_url() );
	if ( '' !== $hook ) {
		wp_remote_post( $hook, array(
			'timeout'  => 8,
			'blocking' => false,
			'headers'  => array( 'Content-Type' => 'application/json' ),
			'body'     => wp_json_encode( array( 'email' => $email, 'source' => $back, 'received' => current_time( 'mysql' ) ) ),
		) );
	}

	wp_safe_redirect( add_query_arg( 'nl', 'ok', $back ) . '#news' );
	exit;
}
add_action( 'admin_post_nopriv_anthropos_newsletter', 'anthropos_handle_newsletter' );
add_action( 'admin_post_anthropos_newsletter', 'anthropos_handle_newsletter' );
