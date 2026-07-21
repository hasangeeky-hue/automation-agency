<?php
/**
 * Consultation questionnaire (multiple-choice, segmentation-first) + secure
 * handler + booking step + WhatsApp button. Rendered as a POPUP MODAL so it is
 * hidden until a "Book a consultation" button is clicked. Self-contained module.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * WhatsApp number in INTERNATIONAL format, digits only (no +, spaces or dashes).
 * e.g. Germany 491701234567 . US 15551234567. Leave '' to hide the button.
 * >>> SET YOUR WHATSAPP NUMBER ON THE LINE BELOW <<<
 */
function anthropos_whatsapp_number() {
	return apply_filters( 'anthropos_whatsapp_number', '' );
}

/** Business email that consultation requests are sent to (defaults to the WP admin email). */
function anthropos_consult_email() {
	return apply_filters( 'anthropos_consult_email', get_option( 'admin_email' ) );
}

/**
 * Your online booking / scheduling link (Calendly, Cal.com, Google Appointment
 * Schedule, etc.). Customers reach it AFTER answering the questionnaire. The
 * scheduler auto-detects each visitor's timezone, so the customer books in
 * their own local time and the slot lands in YOUR Koeln calendar. Leave '' and
 * customers are told you will email them time options instead.
 * >>> PASTE YOUR BOOKING LINK BETWEEN THE QUOTES BELOW <<<
 */
function anthropos_booking_url() {
	return apply_filters( 'anthropos_booking_url', '' );
}

/** Your business timezone label, shown next to the customer's own timezone. */
function anthropos_business_tz() {
	return apply_filters( 'anthropos_business_tz', 'Koeln, Central European Time' );
}

/**
 * The qualification questions. All multiple-choice so nobody gets bored and
 * every answer is a clean, filterable value we can segment on. One free-text
 * box at the end for anything else. 'type' is radio (pick one) or checkbox
 * (pick any); 'req' marks a required field.
 */
function anthropos_consultation_fields() {
	return array(
		array( 'key' => 'segment', 'type' => 'radio', 'req' => true,
			'label' => 'Which best describes your business?',
			'opts'  => array(
				'Law, finance or tax practice',
				'Medical, dental or therapy practice',
				'E-commerce or retail store',
				'Home service, trade or studio',
				'Freelancer or small agency',
				'Creator, coach or course business',
				'B2B service or software provider',
				'Just starting out / something else',
			),
		),
		array( 'key' => 'size', 'type' => 'radio',
			'label' => 'How big is your business today?',
			'opts'  => array( 'Just me', '2 to 5 people', '6 to 20 people', 'More than 20 people' ),
		),
		array( 'key' => 'pain', 'type' => 'radio', 'req' => true,
			'label' => 'What is your single biggest problem right now?',
			'opts'  => array(
				'Not enough people find me (low traffic / visibility)',
				'People visit but do not buy or enquire (weak conversion)',
				'I miss leads or reply too slowly (lost enquiries)',
				'I waste hours on repetitive admin and follow-up',
				'Customers do not come back (weak retention)',
				'I am starting out and do not know where to begin',
			),
		),
		array( 'key' => 'goal', 'type' => 'radio', 'req' => true,
			'label' => 'What would you most like us to build first?',
			'opts'  => array(
				'A website that turns visitors into customers',
				'Getting found on Google and AI search (SEO / AEO)',
				'Automatic lead capture and follow-up',
				'Marketing and content automation',
				'Social media automation',
				'A complete A-to-Z system',
				'Help launching my business from scratch',
			),
		),
		array( 'key' => 'leads', 'type' => 'radio',
			'label' => 'How many new enquiries do you get in a typical week?',
			'opts'  => array( '0 to 5', '6 to 20', '21 to 50', 'More than 50', 'Not sure' ),
		),
		array( 'key' => 'reply', 'type' => 'radio',
			'label' => 'How fast does a new enquiry usually get a first reply?',
			'opts'  => array( 'Within minutes', 'Within a few hours', 'Same or next day', 'Sometimes days, or they slip through' ),
		),
		array( 'key' => 'website', 'type' => 'radio',
			'label' => 'Do you already have a website?',
			'opts'  => array( 'Yes, and it works well', 'Yes, but it needs work', 'Yes, but it brings me no customers', 'No website yet' ),
		),
		array( 'key' => 'tools', 'type' => 'checkbox',
			'label' => 'Which tools do you already use? (tick any that apply)',
			'opts'  => array(
				'Google / Gmail',
				'Microsoft / Outlook',
				'A CRM (HubSpot, Salesforce, etc.)',
				'An online store (Shopify, WooCommerce, etc.)',
				'A booking or calendar tool',
				'Mostly WhatsApp, phone or paper',
			),
		),
		array( 'key' => 'budget', 'type' => 'radio',
			'label' => 'What kind of investment are you ready to make to fix this?',
			'opts'  => array(
				'I want the smallest first step that works',
				'I have a real budget for the right solution',
				'I want the complete system, whatever it takes',
				'I need to understand the options first',
			),
		),
		array( 'key' => 'urgency', 'type' => 'radio', 'req' => true,
			'label' => 'How soon do you want this solved?',
			'opts'  => array( 'As soon as possible, it is costing me now', 'In the next 1 to 3 months', 'Just exploring for now' ),
		),
		array( 'key' => 'market', 'type' => 'radio',
			'label' => 'Which market do you serve?',
			'opts'  => array( 'Germany / EU', 'United Kingdom', 'United States', 'Global / multiple' ),
		),
	);
}

/**
 * Render the consultation form OR, once submitted, the timezone-aware booking
 * step. Called inside the modal dialog.
 */
function anthropos_consultation_form() {
	$fields = anthropos_consultation_fields();
	$sent   = isset( $_GET['consult'] ) && 'sent' === $_GET['consult'];
	$err    = isset( $_GET['consult'] ) && 'error' === $_GET['consult'];
	?>
	<div class="consult">
		<?php if ( $sent ) : ?>
			<?php $book = trim( (string) anthropos_booking_url() ); ?>
			<div class="cf-note cf-ok"><b>Got it &mdash; your answers are on their way to us.</b> Now pick a time that suits you and we will be ready with everything you have told us. No pitch, no obligation.</div>
			<div class="cf-book">
				<div class="cf-tz" data-biz-tz="<?php echo esc_attr( anthropos_business_tz() ); ?>">Times are shown in <b class="cf-yourtz">your local timezone</b>. We are based in <b><?php echo esc_html( anthropos_business_tz() ); ?></b> and will see your slot in your time too.</div>
				<?php if ( '' !== $book ) : ?>
					<div class="cf-embed">
						<iframe src="<?php echo esc_url( $book ); ?>" title="Book a consultation" loading="lazy" width="100%" height="720" frameborder="0" style="border:0;min-width:100%"></iframe>
					</div>
					<p class="cf-book-alt">Trouble with the calendar above? <a href="<?php echo esc_url( $book ); ?>" target="_blank" rel="noopener">Open the booking page in a new tab.</a></p>
				<?php else : ?>
					<div class="cf-note cf-soft">We will email you within one business day with a couple of time options in your timezone, so you can pick whatever works.</div>
				<?php endif; ?>
			</div>
		<?php else : ?>
			<div class="cf-intro">
				<h3>Book a free consultation</h3>
				<p>A quick, tick-box questionnaire &mdash; about two minutes. <b>To hold a real consultation slot, please answer these first</b> so the call is genuinely worth your time. Then you pick a time in your own timezone.</p>
			</div>
			<?php if ( $err ) : ?><div class="cf-note cf-err">Something was missing. Please check your name, email, the required questions and consent, then try again.</div><?php endif; ?>
			<form class="consult-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" enctype="multipart/form-data">
				<input type="hidden" name="action" value="anthropos_consult">
				<?php wp_nonce_field( 'anthropos_consult', 'anthropos_consult_nonce' ); ?>
				<div class="cf-hp" aria-hidden="true"><label>Leave this empty<input type="text" name="cf_website" tabindex="-1" autocomplete="off"></label></div>

				<div class="cf-grid">
					<div class="cf-field"><label for="cf_name">Your name <span>*</span></label><input id="cf_name" type="text" name="cf_name" required></div>
					<div class="cf-field"><label for="cf_email">Email <span>*</span></label><input id="cf_email" type="email" name="cf_email" required></div>
					<div class="cf-field"><label for="cf_phone">Phone / WhatsApp</label><input id="cf_phone" type="text" name="cf_phone"></div>
					<div class="cf-field"><label for="cf_biz">Business name</label><input id="cf_biz" type="text" name="cf_biz"></div>
				</div>

				<?php $n = 0; foreach ( $fields as $f ) : $n++; $name = 'cf_q_' . $f['key']; $req = ! empty( $f['req'] ); ?>
				<fieldset class="cf-mc<?php echo $req ? ' is-req' : ''; ?>">
					<legend><span class="cf-num"><?php echo (int) $n; ?></span> <?php echo esc_html( $f['label'] ); ?><?php echo $req ? ' <span class="cf-star">*</span>' : ''; ?></legend>
					<div class="cf-opts">
						<?php foreach ( $f['opts'] as $oi => $opt ) :
							$id = $name . '_' . $oi;
							if ( 'checkbox' === $f['type'] ) { ?>
								<label class="cf-opt" for="<?php echo esc_attr( $id ); ?>"><input id="<?php echo esc_attr( $id ); ?>" type="checkbox" name="<?php echo esc_attr( $name ); ?>[]" value="<?php echo esc_attr( $opt ); ?>"><span><?php echo esc_html( $opt ); ?></span></label>
							<?php } else { ?>
								<label class="cf-opt" for="<?php echo esc_attr( $id ); ?>"><input id="<?php echo esc_attr( $id ); ?>" type="radio" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $opt ); ?>"<?php echo $req ? ' required' : ''; ?>><span><?php echo esc_html( $opt ); ?></span></label>
							<?php } ?>
						<?php endforeach; ?>
					</div>
				</fieldset>
				<?php endforeach; ?>

				<div class="cf-field cf-note-field">
					<label for="cf_notes">Anything else you would like us to know? <span class="cf-opt-tag">optional</span></label>
					<textarea id="cf_notes" name="cf_notes" rows="3" placeholder="A link, a goal, a deadline, a frustration &mdash; whatever helps us prepare."></textarea>
				</div>

				<div class="cf-field cf-file">
					<label for="cf_file">Attach a file if it helps (JPEG or PDF, max 2 MB) <span class="cf-opt-tag">optional</span></label>
					<input id="cf_file" type="file" name="cf_file" accept=".jpg,.jpeg,.pdf,image/jpeg,application/pdf">
					<small>e.g. a screenshot of your site or a short brief.</small>
				</div>

				<label class="cf-consent"><input type="checkbox" name="cf_consent" value="1" required> <span>I agree to be contacted about my enquiry, and I have read the <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" target="_blank" rel="noopener">privacy policy</a>. <span class="cf-star">*</span></span></label>

				<button class="btn btn-cta cf-submit" type="submit">Send answers &amp; pick a time &rarr;</button>
				<p class="cf-book-hint">Next you will choose a time slot, shown in your own timezone.</p>
			</form>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * The modal shell. Rendered once in the footer; hidden until a "Book a
 * consultation" button (any link to #cta, or [data-open-consult]) is clicked.
 * Auto-opens on the booking step after a submission.
 */
function anthropos_consultation_modal() {
	if ( is_admin() ) { return; }
	?>
	<div class="consult-modal" id="consultModal" hidden>
		<div class="cm-overlay" data-close-consult></div>
		<div class="cm-dialog" role="dialog" aria-modal="true" aria-label="Book a free consultation">
			<button type="button" class="cm-x" data-close-consult aria-label="Close">&times;</button>
			<?php anthropos_consultation_form(); ?>
		</div>
	</div>
	<script>
	(function(){
		var modal=document.getElementById('consultModal');
		if(!modal) return;
		function open(){ modal.hidden=false; document.body.style.overflow='hidden';
			var first=modal.querySelector('input,select,textarea,button'); if(first){ try{first.focus();}catch(e){} } }
		function close(){ modal.hidden=true; document.body.style.overflow=''; }
		// Open from any "Book a consultation" trigger: [data-open-consult] or any link to #cta.
		document.addEventListener('click', function(e){
			var t=e.target.closest('[data-open-consult], a[href="#cta"], a[href$="#cta"]');
			if(t){ e.preventDefault(); open(); }
			if(e.target.closest('[data-close-consult]')){ e.preventDefault(); close(); }
		});
		document.addEventListener('keydown', function(e){ if(e.key==='Escape' && !modal.hidden){ close(); } });
		// After a submission we land on ?consult=sent (or error) - open straight away.
		try{
			var p=new URLSearchParams(window.location.search).get('consult');
			if(p==='sent'||p==='error'){ open(); }
		}catch(e){}
		// Show the visitor their own timezone on the booking step.
		var tzEl=modal.querySelector('.cf-yourtz');
		if(tzEl){ try{ var tz=Intl.DateTimeFormat().resolvedOptions().timeZone; if(tz){ tzEl.textContent='your timezone ('+tz.replace(/_/g,' ')+')'; } }catch(e){} }
		// Client-side 2 MB file guard.
		var file=modal.querySelector('#cf_file');
		if(file){ file.addEventListener('change', function(){
			if(file.files[0] && file.files[0].size > 2*1024*1024){ alert('That file is over 2 MB. Please choose a smaller JPEG or PDF.'); file.value=''; }
		}); }
	})();
	</script>
	<?php
}
add_action( 'wp_footer', 'anthropos_consultation_modal', 6 );

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
	$biz   = isset( $_POST['cf_biz'] ) ? sanitize_text_field( wp_unslash( $_POST['cf_biz'] ) ) : '';
	$notes = isset( $_POST['cf_notes'] ) ? sanitize_textarea_field( wp_unslash( $_POST['cf_notes'] ) ) : '';
	if ( '' === $name || ! is_email( $email ) || empty( $_POST['cf_consent'] ) ) {
		wp_safe_redirect( add_query_arg( 'consult', 'error', $back ) . '#cta' );
		exit;
	}

	$fields = anthropos_consultation_fields();
	// Pull the key triage answers to the very top of the email.
	$pick = function( $key ) {
		$v = isset( $_POST[ 'cf_q_' . $key ] ) ? wp_unslash( $_POST[ 'cf_q_' . $key ] ) : '';
		if ( is_array( $v ) ) { $v = implode( ', ', array_map( 'sanitize_text_field', $v ) ); }
		else { $v = sanitize_text_field( $v ); }
		return '' !== $v ? $v : '-';
	};

	$lines = array(
		'NEW CONSULTATION REQUEST',
		'========================',
		'',
		'>> QUICK TRIAGE',
		'   Segment : ' . $pick( 'segment' ),
		'   Pain    : ' . $pick( 'pain' ),
		'   Wants   : ' . $pick( 'goal' ),
		'   Budget  : ' . $pick( 'budget' ),
		'   Urgency : ' . $pick( 'urgency' ),
		'',
		'>> CONTACT',
		'   Name    : ' . $name,
		'   Business: ' . ( '' !== $biz ? $biz : '-' ),
		'   Email   : ' . $email,
		'   Phone   : ' . ( '' !== $phone ? $phone : '-' ),
		'',
		'>> ALL ANSWERS',
	);
	foreach ( $fields as $f ) {
		$lines[] = '   ' . $f['label'];
		$lines[] = '     -> ' . $pick( $f['key'] );
	}
	if ( '' !== $notes ) {
		$lines[] = '';
		$lines[] = '>> NOTES';
		$lines[] = '   ' . $notes;
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
	$subject = 'Consultation: ' . $pick( 'segment' ) . ' / ' . $pick( 'pain' ) . ' (' . $name . ')';
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
