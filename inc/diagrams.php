<?php
/**
 * Reusable, STATIC section diagrams for guides & blogs. Because every article
 * follows the same 7-part structure (problem -> who -> cost -> what AI can do ->
 * how it works -> how we help -> our steps), each section type has one clean,
 * relatable inline-SVG diagram. No animated canvases = calm, readable articles.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/** Map an H2 heading to a standard section-diagram key (or '' for none). */
function anthropos_match_section( $h ) {
	$h = strtolower( wp_strip_all_tags( (string) $h ) );
	if ( '' === $h ) { return ''; }
	if ( false !== strpos( $h, 'problem' ) ) { return 'problem'; }
	if ( false !== strpos( $h, 'step' ) || false !== strpos( $h, 'process' ) || false !== strpos( $h, 'which way we' ) ) { return 'steps'; }
	if ( false !== strpos( $h, 'help' ) ) { return 'help'; }
	if ( false !== strpos( $h, 'who' ) || false !== strpos( $h, 'involve' ) || false !== strpos( $h, 'people' ) || false !== strpos( $h, 'touch' ) || false !== strpos( $h, 'role' ) ) { return 'people'; }
	if ( false !== strpos( $h, 'cost' ) || false !== strpos( $h, 'productiv' ) || false !== strpos( $h, 'drain' ) || false !== strpos( $h, 'money' ) || false !== strpos( $h, 'expensive' ) ) { return 'cost'; }
	if ( false !== strpos( $h, 'ai' ) && ( false !== strpos( $h, 'what' ) || false !== strpos( $h, 'can' ) ) ) { return 'ai'; }
	if ( false !== strpos( $h, 'how it works' ) || false !== strpos( $h, 'actually work' ) || false !== strpos( $h, 'which way it' ) || false !== strpos( $h, 'how the' ) ) { return 'how'; }
	return '';
}

/** One-line caption per diagram type. */
function anthropos_diagram_caption( $key ) {
	$c = array(
		'problem' => 'Where the work leaks today',
		'people'  => 'Who this touches, day to day',
		'cost'    => 'How it drains time and money',
		'ai'      => 'What AI can quietly take off your plate',
		'how'     => 'How the automation actually works',
		'help'    => 'Built on your own tools, handed to you',
		'steps'   => 'How we get you there, step by step',
	);
	return isset( $c[ $key ] ) ? $c[ $key ] : '';
}

/**
 * Return a finished <figure> with the section's static SVG diagram, or '' if the
 * heading maps to no diagram. $hue is a CSS colour (e.g. 'var(--flow)').
 */
function anthropos_section_diagram( $key, $hue = 'var(--flow)' ) {
	if ( '' === $key ) { return ''; }
	$svg = call_user_func( 'anthropos_dgm_' . $key );
	if ( ! $svg ) { return ''; }
	$cap = anthropos_diagram_caption( $key );
	return '<figure class="asec-viz" style="color:' . esc_attr( $hue ) . '">' . $svg
		. ( $cap ? '<figcaption>' . esc_html( $cap ) . '</figcaption>' : '' ) . '</figure>';
}

/* -- shared SVG helpers ------------------------------------------------------ */
function anthropos_dgm_open() {
	return '<svg viewBox="0 0 680 210" xmlns="http://www.w3.org/2000/svg" role="img" fill="none">'
		. '<style>.dl{stroke:rgba(255,255,255,.22)}.da{stroke:currentColor}.df{fill:#C7D2F0}.dm{fill:rgba(255,255,255,.55)}.dc{fill:currentColor}.dn{fill:#0F1626;stroke:rgba(255,255,255,.14)}.t{font-family:ui-sans-serif,system-ui,sans-serif;font-size:13px}.ts{font-family:ui-monospace,monospace;font-size:11px}</style>';
}
function anthropos_dgm_person( $x, $y, $c = 'currentColor' ) {
	// simple person glyph centred on $x, head at $y
	return '<circle cx="' . $x . '" cy="' . $y . '" r="10" fill="none" stroke="' . $c . '" stroke-width="2"/>'
		. '<path d="M' . ( $x - 16 ) . ' ' . ( $y + 32 ) . ' a16 16 0 0 1 32 0" fill="none" stroke="' . $c . '" stroke-width="2"/>';
}

/* -- 1. PROBLEM: work leaking out of a pipe --------------------------------- */
function anthropos_dgm_problem() {
	$o = anthropos_dgm_open();
	$o .= '<text x="40" y="34" class="t ts dm">NEW WORK COMES IN</text>';
	// pipe
	$o .= '<rect x="40" y="60" width="600" height="52" rx="12" class="dl" stroke-width="2"/>';
	// flowing dots
	for ( $i = 0; $i < 5; $i++ ) { $o .= '<circle cx="' . ( 80 + $i * 70 ) . '" cy="86" r="6" class="dc"/>'; }
	// crack + leaking dots
	$o .= '<path d="M360 112 L352 150 M372 112 L380 150" class="da" stroke-width="2" stroke-dasharray="3 4"/>';
	$o .= '<circle cx="356" cy="150" r="5" class="dm"/><circle cx="380" cy="172" r="5" class="dm"/>';
	$o .= '<text x="410" y="168" class="t df">Missed calls, unsent quotes,</text>';
	$o .= '<text x="410" y="186" class="t dm">forgotten follow-ups, lost</text>';
	// won box
	$o .= '<rect x="560" y="66" width="72" height="40" rx="8" class="dn"/><text x="596" y="91" text-anchor="middle" class="t df">Won</text>';
	$o .= '<path d="M642 86 h-6" class="da" stroke-width="2"/>';
	return $o . '</svg>';
}

/* -- 2. PEOPLE: the roles this touches -------------------------------------- */
function anthropos_dgm_people() {
	$o = anthropos_dgm_open();
	$roles = array( 'Owner / partner', 'Front desk', 'Marketing', 'The client' );
	$x = 105;
	foreach ( $roles as $i => $r ) {
		$o .= anthropos_dgm_person( $x, 66 );
		$o .= '<text x="' . $x . '" y="128" text-anchor="middle" class="t df">' . $r . '</text>';
		if ( $i < 3 ) { $o .= '<path d="M' . ( $x + 40 ) . ' 74 h80" class="dl" stroke-width="2" stroke-dasharray="2 5"/>'; }
		$x += 155;
	}
	$o .= '<text x="340" y="176" text-anchor="middle" class="t dm">One dropped hand-off between them is one lost client</text>';
	return $o . '</svg>';
}

/* -- 3. COST: time + money draining ----------------------------------------- */
function anthropos_dgm_cost() {
	$o = anthropos_dgm_open();
	// clock
	$o .= '<circle cx="130" cy="90" r="42" class="dl" stroke-width="2"/><path d="M130 90 V60 M130 90 L152 104" class="da" stroke-width="3" stroke-linecap="round"/>';
	$o .= '<text x="130" y="160" text-anchor="middle" class="t df">Hours on admin</text>';
	// arrow
	$o .= '<path d="M200 90 h70" class="da" stroke-width="2"/><path d="M270 90 l-9 -6 v12 z" class="dc"/>';
	// funnel/drain
	$o .= '<path d="M300 58 h150 l-45 60 v42 h-60 v-42 z" class="dl" stroke-width="2"/>';
	$o .= '<text x="375" y="150" text-anchor="middle" class="t dm">draining out</text>';
	// arrow
	$o .= '<path d="M470 90 h70" class="da" stroke-width="2"/><path d="M540 90 l-9 -6 v12 z" class="dc"/>';
	// money
	$o .= '<circle cx="590" cy="90" r="30" class="dn"/><text x="590" y="97" text-anchor="middle" class="t dc" style="font-size:22px;font-weight:700">&euro;</text>';
	$o .= '<text x="590" y="160" text-anchor="middle" class="t df">Lost revenue</text>';
	return $o . '</svg>';
}

/* -- 4. WHAT AI CAN DO: hub and spokes -------------------------------------- */
function anthropos_dgm_ai() {
	$o = anthropos_dgm_open();
	$o .= '<circle cx="340" cy="105" r="40" class="dn"/><circle cx="340" cy="105" r="40" class="da" stroke-width="2"/><text x="340" y="110" text-anchor="middle" class="t dc" style="font-weight:700">AI</text>';
	$tasks = array(
		array( 120, 55, 'Reply in seconds' ),
		array( 560, 55, 'Sort &amp; qualify' ),
		array( 120, 165, 'Send reminders' ),
		array( 560, 165, 'Chase follow-ups' ),
	);
	foreach ( $tasks as $t ) {
		$o .= '<path d="M340 105 L' . $t[0] . ' ' . $t[1] . '" class="dl" stroke-width="2"/>';
		$o .= '<rect x="' . ( $t[0] - 78 ) . '" y="' . ( $t[1] - 18 ) . '" width="156" height="36" rx="9" class="dn"/>';
		$o .= '<text x="' . $t[0] . '" y="' . ( $t[1] + 5 ) . '" text-anchor="middle" class="t df">' . $t[2] . '</text>';
	}
	return $o . '</svg>';
}

/* -- 5. HOW IT WORKS: trigger -> decide -> act ------------------------------ */
function anthropos_dgm_how() {
	$o = anthropos_dgm_open();
	$steps = array(
		array( 110, 'Trigger', 'a call, form or email' ),
		array( 340, 'AI decides', 'reads it, tags it' ),
		array( 570, 'Action', 'reply, book, log' ),
	);
	foreach ( $steps as $i => $s ) {
		$x = $s[0];
		$o .= '<rect x="' . ( $x - 90 ) . '" y="66" width="180" height="72" rx="12" class="dn"/>';
		$o .= '<text x="' . $x . '" y="98" text-anchor="middle" class="t dc" style="font-weight:700">' . $s[1] . '</text>';
		$o .= '<text x="' . $x . '" y="120" text-anchor="middle" class="t dm">' . $s[2] . '</text>';
		if ( $i < 2 ) { $o .= '<path d="M' . ( $x + 90 ) . ' 102 h50" class="da" stroke-width="2"/><path d="M' . ( $x + 140 ) . ' 102 l-9 -6 v12 z" class="dc"/>'; }
	}
	return $o . '</svg>';
}

/* -- 6. HOW WE HELP: your tools -> one system, yours ------------------------ */
function anthropos_dgm_help() {
	$o = anthropos_dgm_open();
	$tools = array( 'Your website', 'Email &amp; calendar', 'Your CRM' );
	foreach ( $tools as $i => $t ) {
		$y = 50 + $i * 45;
		$o .= '<rect x="40" y="' . ( $y - 16 ) . '" width="150" height="34" rx="9" class="dn"/><text x="115" y="' . ( $y + 5 ) . '" text-anchor="middle" class="t df">' . $t . '</text>';
		$o .= '<path d="M190 ' . $y . ' C 250 ' . $y . ', 260 105, 320 105" class="dl" stroke-width="2"/>';
	}
	$o .= '<rect x="320" y="72" width="180" height="66" rx="12" class="dn"/><rect x="320" y="72" width="180" height="66" rx="12" class="da" stroke-width="2"/>';
	$o .= '<text x="410" y="100" text-anchor="middle" class="t dc" style="font-weight:700">One connected system</text><text x="410" y="122" text-anchor="middle" class="t dm">on n8n, 100% yours</text>';
	$o .= '<path d="M500 105 h40" class="da" stroke-width="2"/><circle cx="562" cy="105" r="22" class="dn"/><path d="M552 105 l7 7 12 -15" class="da" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>';
	return $o . '</svg>';
}

/* -- 7. STEPS: the 4-step delivery graph ------------------------------------ */
function anthropos_dgm_steps() {
	$o = anthropos_dgm_open();
	$steps = array( array( 'Map', 'find the leak' ), array( 'Build', 'site + workflow' ), array( 'Connect', 'to your tools' ), array( 'Live', 'tested &amp; yours' ) );
	$x = 95;
	foreach ( $steps as $i => $s ) {
		$o .= '<circle cx="' . $x . '" cy="80" r="30" class="dn"/><circle cx="' . $x . '" cy="80" r="30" class="da" stroke-width="2"/>';
		$o .= '<text x="' . $x . '" y="86" text-anchor="middle" class="t dc" style="font-weight:700;font-size:15px">' . sprintf( '%02d', $i + 1 ) . '</text>';
		$o .= '<text x="' . $x . '" y="138" text-anchor="middle" class="t df" style="font-weight:600">' . $s[0] . '</text>';
		$o .= '<text x="' . $x . '" y="158" text-anchor="middle" class="t dm">' . $s[1] . '</text>';
		if ( $i < 3 ) { $o .= '<path d="M' . ( $x + 34 ) . ' 80 h94" class="da" stroke-width="2"/><path d="M' . ( $x + 128 ) . ' 80 l-9 -6 v12 z" class="dc"/>'; }
		$x += 162;
	}
	return $o . '</svg>';
}
