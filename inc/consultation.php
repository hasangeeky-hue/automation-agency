<?php
/**
 * Consultation questionnaire + secure form handler + WhatsApp button.
 * Self-contained module so it never touches the core theme files.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * WhatsApp number in INTERNATIONAL format, digits only (no +, spaces or dashes).
 * e.g. Germany 491701234567 · US 15551234567. Leave '' to hide the button.
 * >>> SET YOUR WHATSAPP NUMBER ON THE LINE BELOW <<<
 */
function anthropos_whatsapp_number() {
	return apply_filters( 'anthropos_whatsapp_number', '' );
}

/** Business email that consultation requests are sent to (defaults to the WP admin email). */
function anthropos_consult_email() {
	return apply_filters( 'anthropos_consult_email', get_option( 'admin_email' ) );
}

/** 10 tailored questions per customer group, plus a general set. */
function anthropos_consultation_questions() {
	return array(
		'regulated-professionals' => array(
			'label' => 'Law, finance or tax practice',
			'q' => array(
				'What is your practice area or specialty?',
				'How do most new clients find you today?',
				'Roughly how many enquiries do you get in a typical week?',
				'How fast does a new enquiry usually get a first reply?',
				'What happens to enquiries you cannot answer straight away?',
				'Do you have a website, and is it easy to use on a phone?',
				'Your biggest problem: getting found, replying fast, or following up?',
				'Which tools do you use for email, calendar and client records?',
				'Are there compliance rules we should be aware of for your field?',
				'What would a great result look like for you in three months?',
			),
		),
		'medical-professionals' => array(
			'label' => 'Medical, dental or therapy practice',
			'q' => array(
				'What kind of practice do you run (your specialty)?',
				'How do new patients usually find you?',
				'Roughly how many new-patient enquiries do you get a week?',
				'How are enquiries handled while you are with patients?',
				'Do you have a website, and is it mobile-friendly?',
				'How do patients currently book (phone, form, portal)?',
				'Your biggest gap: visibility, reviews, or follow-up?',
				'Which booking or records software do you use? (we never touch clinical data)',
				'Are missed calls or no-shows a problem for you?',
				'What would success look like in three months?',
			),
		),
		'ecommerce-retail' => array(
			'label' => 'E-commerce or retail store',
			'q' => array(
				'What do you sell, and on which platforms (Shopify, Amazon, etc.)?',
				'Roughly how much monthly traffic do you get?',
				'What is your rough checkout conversion rate, if you know it?',
				'What happens to abandoned carts today?',
				'Do you email past customers, and how often?',
				'Do you sell across multiple channels, and how do you manage them?',
				'Your biggest problem: traffic, conversion, or repeat buyers?',
				'Which email or marketing tools do you use?',
				'Do you track competitor prices, and how?',
				'What would a great result look like in three months?',
			),
		),
		'service-professionals' => array(
			'label' => 'Home service, trade or studio',
			'q' => array(
				'What service do you provide?',
				'How do customers usually find and contact you?',
				'What happens to calls you miss while you are working?',
				'Roughly how many enquiries do you get a week?',
				'Do you have a website with photos and reviews?',
				'How do you handle bookings and reminders?',
				'Do you ask customers for reviews, and how?',
				'Your biggest gap: getting found, replying, or repeat business?',
				'Which tools do you use (calendar, invoicing)?',
				'What would success look like in three months?',
			),
		),
		'freelancers-agencies' => array(
			'label' => 'Freelancer or small agency',
			'q' => array(
				'What kind of work do you do (design, development, etc.)?',
				'Where do most of your leads come from?',
				'How many enquiries a week, and how many are a genuine fit?',
				'How do you handle unqualified or tire-kicker enquiries?',
				'What does your onboarding look like (contract, deposit, brief)?',
				'Do you follow up on proposals, and how?',
				'Your biggest problem: lead quality, follow-up, or onboarding?',
				'Which tools do you use (CRM, invoicing, project management)?',
				'Do you have a portfolio site, and is it winning you work?',
				'What would a great three months look like?',
			),
		),
		'creators-coaches' => array(
			'label' => 'Creator, coach or course business',
			'q' => array(
				'What do you create or teach?',
				'Roughly how big is your audience or email list?',
				'How do you currently sell (course, coaching, membership)?',
				'What is your rough free-to-paid or landing-page conversion?',
				'Where do people drop off (signup, mid-course, renewal)?',
				'Do you have a welcome or nurture email sequence?',
				'Your biggest gap: audience, conversion, or retention?',
				'Which platforms and tools do you use?',
				'How consistent is your content or posting?',
				'What would success look like in three months?',
			),
		),
		'b2b-providers' => array(
			'label' => 'B2B service or software provider',
			'q' => array(
				'What do you implement or provide?',
				'How do prospects usually find you?',
				'What is your typical sales-cycle length?',
				'Where do deals usually stall?',
				'How do you follow up after sending a proposal?',
				'What does client onboarding look like?',
				'Your biggest gap: being found, follow-up, or onboarding?',
				'Which CRM and tools do you use?',
				'Do your case studies name real, comparable results?',
				'What would a great three months look like?',
			),
		),
		'general' => array(
			'label' => 'Something else / just starting out',
			'q' => array(
				'Tell us briefly about your business or your idea.',
				'Are you already operating, or just getting started?',
				'What are you hoping automation could help with?',
				'How do customers find and contact you (or how will they)?',
				'What is the most repetitive or time-consuming task in your day?',
				'Do you have a website already?',
				'Which tools do you already use?',
				'Where do you feel you are losing time or leads?',
				'Which market do you serve (US, UK, EU, or elsewhere)?',
				'What would a great result look like in three months?',
			),
		),
	);
}

/** Render the consultation questionnaire form. */
function anthropos_consultation_form() {
	$groups = anthropos_consultation_questions();
	$sent   = isset( $_GET['consult'] ) && 'sent' === $_GET['consult'];
	$err    = isset( $_GET['consult'] ) && 'error' === $_GET['consult'];
	?>
	<div class="consult">
		<?php if ( $sent ) : ?>
			<div class="cf-note cf-ok"><b>Thank you — your request is on its way.</b> We read every one personally and will get back to you within one business day. No pitch, no obligation.</div>
		<?php else : ?>
			<?php if ( $err ) : ?><div class="cf-note cf-err">Something went wrong, or a required field was missing. Please check your name, email and consent, and try again.</div><?php endif; ?>
			<form class="consult-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" enctype="multipart/form-data">
				<input type="hidden" name="action" value="anthropos_consult">
				<?php wp_nonce_field( 'anthropos_consult', 'anthropos_consult_nonce' ); ?>
				<div class="cf-hp" aria-hidden="true"><label>Leave this empty<input type="text" name="cf_website" tabindex="-1" autocomplete="off"></label></div>

				<div class="cf-grid">
					<div class="cf-field"><label for="cf_name">Your name <span>*</span></label><input id="cf_name" type="text" name="cf_name" required></div>
					<div class="cf-field"><label for="cf_email">Email <span>*</span></label><input id="cf_email" type="email" name="cf_email" required></div>
					<div class="cf-field"><label for="cf_phone">Phone / WhatsApp</label><input id="cf_phone" type="text" name="cf_phone"></div>
					<div class="cf-field"><label for="cf_seg">Your business type <span>*</span></label>
						<select id="cf_seg" name="cf_seg" required>
							<option value="">Choose one…</option>
							<?php foreach ( $groups as $key => $g ) { echo '<option value="' . esc_attr( $key ) . '">' . esc_html( $g['label'] ) . '</option>'; } ?>
						</select>
					</div>
				</div>

				<?php foreach ( $groups as $key => $g ) : ?>
				<fieldset class="cf-seg" data-seg="<?php echo esc_attr( $key ); ?>" hidden>
					<legend>A few questions about your <?php echo esc_html( strtolower( $g['label'] ) ); ?></legend>
					<?php foreach ( $g['q'] as $i => $question ) : ?>
						<div class="cf-q"><label for="q_<?php echo esc_attr( $key . '_' . $i ); ?>"><?php echo esc_html( ( $i + 1 ) . '. ' . $question ); ?></label><textarea id="q_<?php echo esc_attr( $key . '_' . $i ); ?>" name="cf_q[<?php echo esc_attr( $key ); ?>][<?php echo (int) $i; ?>]" rows="2"></textarea></div>
					<?php endforeach; ?>
				</fieldset>
				<?php endforeach; ?>

				<div class="cf-field cf-file">
					<label for="cf_file">Attach a file if it helps (JPEG or PDF, max 2 MB)</label>
					<input id="cf_file" type="file" name="cf_file" accept=".jpg,.jpeg,.pdf,image/jpeg,application/pdf">
					<small>Optional — e.g. a screenshot of your site or a document.</small>
				</div>

				<label class="cf-consent"><input type="checkbox" name="cf_consent" value="1" required> <span>I agree to be contacted about my enquiry, and I have read the <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">privacy policy</a>. <span class="cf-star">*</span></span></label>

				<button class="btn btn-cta cf-submit" type="submit">Send my request →</button>
			</form>
		<?php endif; ?>
	</div>
	<script>
	(function(){
		var f=document.querySelector('.consult-form'); if(!f) return;
		var sel=f.querySelector('#cf_seg'), segs=f.querySelectorAll('.cf-seg');
		function show(){ segs.forEach(function(s){ s.hidden = (s.getAttribute('data-seg')!==sel.value); }); }
		sel.addEventListener('change', show); show();
		var file=f.querySelector('#cf_file');
		file.addEventListener('change', function(){
			if(file.files[0] && file.files[0].size > 2*1024*1024){ alert('That file is over 2 MB. Please choose a smaller JPEG or PDF.'); file.value=''; }
		});
	})();
	</script>
	<?php
}

/** Handle the consultation submission securely, then email it to the business. */
function anthropos_handle_consultation() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );

	if ( ! isset( $_POST['anthropos_consult_nonce'] ) || ! wp_verify_nonce( $_POST['anthropos_consult_nonce'], 'anthropos_consult' ) ) {
		wp_safe_redirect( add_query_arg( 'consult', 'error', $back ) . '#cta' );
		exit;
	}
	// Honeypot: silently accept bots without sending.
	if ( ! empty( $_POST['cf_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'consult', 'sent', $back ) . '#cta' );
		exit;
	}
	$name  = isset( $_POST['cf_name'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_name'] ) ) : '';
	$email = isset( $_POST['cf_email'] ) ? sanitize_email( wp_unslash( $_POST['cf_email'] ) ) : '';
	$phone = isset( $_POST['cf_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_phone'] ) ) : '';
	$seg   = isset( $_POST['cf_seg'] ) ? sanitize_key( $_POST['cf_seg'] ) : '';
	if ( '' === $name || ! is_email( $email ) || empty( $_POST['cf_consent'] ) ) {
		wp_safe_redirect( add_query_arg( 'consult', 'error', $back ) . '#cta' );
		exit;
	}

	$groups = anthropos_consultation_questions();
	$lines  = array( 'New consultation request', '========================', 'Name:  ' . $name, 'Email: ' . $email, 'Phone: ' . ( $phone ? $phone : '—' ), 'Type:  ' . ( isset( $groups[ $seg ] ) ? $groups[ $seg ]['label'] : $seg ), '' );
	if ( isset( $groups[ $seg ] ) && isset( $_POST['cf_q'][ $seg ] ) && is_array( $_POST['cf_q'][ $seg ] ) ) {
		foreach ( $groups[ $seg ]['q'] as $i => $question ) {
			$ans = isset( $_POST['cf_q'][ $seg ][ $i ] ) ? sanitize_textarea_field( wp_unslash( $_POST['cf_q'][ $seg ][ $i ] ) ) : '';
			$lines[] = ( $i + 1 ) . '. ' . $question;
			$lines[] = '   ' . ( '' !== $ans ? $ans : '—' );
		}
	}

	// Handle an optional JPEG/PDF upload, capped at 2 MB.
	$attachments = array();
	if ( ! empty( $_FILES['cf_file']['name'] ) && empty( $_FILES['cf_file']['error'] ) ) {
		if ( (int) $_FILES['cf_file']['size'] <= 2 * 1024 * 1024 ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
			$upload = wp_handle_upload(
				$_FILES['cf_file'],
				array( 'test_form' => false, 'mimes' => array( 'jpg|jpeg' => 'image/jpeg', 'pdf' => 'application/pdf' ) )
			);
			if ( is_array( $upload ) && empty( $upload['error'] ) && ! empty( $upload['file'] ) ) {
				$attachments[] = $upload['file'];
				$lines[]       = "\nAttachment: " . $upload['url'];
			}
		} else {
			$lines[] = "\n(Attachment was over 2 MB and was not accepted.)";
		}
	}

	$to      = anthropos_consult_email();
	$subject = 'Consultation request from ' . $name;
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
	wp_mail( $to, $subject, implode( "\n", $lines ), $headers, $attachments );

	wp_safe_redirect( add_query_arg( 'consult', 'sent', $back ) . '#cta' );
	exit;
}
add_action( 'admin_post_nopriv_anthropos_consult', 'anthropos_handle_consultation' );
add_action( 'admin_post_anthropos_consult', 'anthropos_handle_consultation' );

/** Floating WhatsApp button (only shown once a number is configured). */
function anthropos_whatsapp_float() {
	$num = preg_replace( '/\D/', '', (string) anthropos_whatsapp_number() );
	if ( '' === $num ) { return; }
	$text = rawurlencode( 'Hi Anthropos, I would like to talk about automating my business.' );
	?>
	<a class="wa-float" href="https://wa.me/<?php echo esc_attr( $num ); ?>?text=<?php echo esc_attr( $text ); ?>" target="_blank" rel="noopener" aria-label="Chat with us on WhatsApp">
		<svg viewBox="0 0 32 32" width="28" height="28" aria-hidden="true"><path fill="#fff" d="M16 3C9.4 3 4 8.4 4 15c0 2.1.6 4.1 1.6 5.9L4 29l8.3-1.6c1.7.9 3.6 1.4 5.7 1.4 6.6 0 12-5.4 12-12S22.6 3 16 3zm0 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7.7.7-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.3 0-5.4 4.4-9.8 9.8-9.8s9.8 4.4 9.8 9.8-4.4 9.8-9.8 9.8zm5.4-7.3c-.3-.1-1.7-.9-2-1-.3-.1-.5-.1-.7.1s-.8 1-.9 1.2c-.2.2-.3.2-.6.1-.3-.1-1.2-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.1-.2.2-.3.3-.5.1-.2 0-.4 0-.5s-.7-1.6-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.3 5.2 4.6 2.9 1.1 2.9.8 3.5.7.5-.1 1.7-.7 1.9-1.4.2-.7.2-1.2.2-1.4-.1-.1-.3-.2-.5-.3z"/></svg>
		<span>Chat on WhatsApp</span>
	</a>
	<?php
}
add_action( 'wp_footer', 'anthropos_whatsapp_float', 5 );
