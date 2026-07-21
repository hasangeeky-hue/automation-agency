<?php
/**
 * Anthropos Automation OS — theme setup (v4).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'ANTHROPOS_VERSION', '5.43.0' );

require_once get_template_directory() . '/inc/segments.php';
require_once get_template_directory() . '/inc/content-seed.php';
require_once get_template_directory() . '/inc/content-seed-batch2.php';
require_once get_template_directory() . '/inc/content-seed-batch3.php';
require_once get_template_directory() . '/inc/content-seed-batch4.php';
require_once get_template_directory() . '/inc/content-seed-batch5.php';
require_once get_template_directory() . '/inc/content-seed-batch6.php';
require_once get_template_directory() . '/inc/content-seed-batch7.php';
require_once get_template_directory() . '/inc/content-seed-batch8.php';
require_once get_template_directory() . '/inc/content-seed-batch9.php';
 require_once get_template_directory() . '/inc/content-seed-batch10.php';
require_once get_template_directory() . '/inc/content-seed-batch11.php';
require_once get_template_directory() . '/inc/content-seed-batch12.php';
require_once get_template_directory() . '/inc/content-seed-batch13.php';
require_once get_template_directory() . '/inc/content-seed-batch14.php';
require_once get_template_directory() . '/inc/content-seed-batch15.php';
require_once get_template_directory() . '/inc/content-seed-batch16.php';
require_once get_template_directory() . '/inc/content-seed-batch17.php';
require_once get_template_directory() . '/inc/content-seed-batch18.php';
require_once get_template_directory() . '/inc/content-seed-batch19.php';
require_once get_template_directory() . '/inc/content-seed-batch20.php';
require_once get_template_directory() . '/inc/content-seed-batch21.php';
require_once get_template_directory() . '/inc/content-seed-batch22.php';
require_once get_template_directory() . '/inc/consultation.php';
require_once get_template_directory() . '/inc/diagrams.php';

/**
 * Stop WordPress from silently switching to the default theme if it ever thinks
 * this theme is momentarily "broken" — which happens during a Git Updater file
 * swap and was falling the live site back to twentytwentyfive / "Hello world".
 * Our theme is valid; this prevents the false-positive auto-switch.
 */
add_filter( 'validate_current_theme', '__return_false' );

/** Service tags (short code => label) — used as WP tags + filter buttons. */
function anthropos_service_tags() {
	return array(
		'web'   => 'Web Design',
		'aeo'   => 'AEO / GEO',
		'lead'  => 'Lead',
		'mkt'   => 'Marketing',
		'soc'   => 'Social',
		'whole' => 'Whole-Business',
	);
}

/** Register the ao_type taxonomy (Guide vs Blog) on posts. */
function anthropos_register_taxonomy() {
	register_taxonomy( 'ao_type', 'post', array(
		'label'        => 'Content Type',
		'public'       => true,
		'hierarchical' => false,
		'show_ui'      => true,
		'rewrite'      => false,
	) );
}
add_action( 'init', 'anthropos_register_taxonomy' );

/** URL of a segment's service page (child of /services/). */
function anthropos_seg_url( $slug ) {
	$p = get_page_by_path( 'services/' . $slug );
	return $p ? get_permalink( $p ) : home_url( '/services/' . $slug . '/' );
}

/** Localize root-relative internal links (href="/...") to full site URLs, so
 *  seeded article copy survives a domain or subdirectory move intact. */
function anthropos_localize_links( $html ) {
	return str_replace( 'href="/', 'href="' . home_url() . '/', $html );
}

/**
 * Brand mark — the "Network A" logo (an A drawn as a three-node agent network)
 * as inline SVG. $uid keeps the gradient id unique when the mark is rendered
 * more than once on a page (header + footer).
 */
function anthropos_logo_mark( $size = 34, $uid = 'a' ) {
	$s   = (int) $size;
	$uid = preg_replace( '/[^a-z0-9]/i', '', $uid );
	return '<svg class="brandmark" width="' . $s . '" height="' . $s . '" viewBox="0 0 100 100" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">'
		. '<defs><linearGradient id="bm' . $uid . '" x1="26" y1="80" x2="74" y2="26" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#2FE3D2"/><stop offset="1" stop-color="#8B7CFF"/></linearGradient></defs>'
		. '<g class="bm-strokes" fill="none" stroke="url(#bm' . $uid . ')" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"><path d="M50 28 L28 76"/><path d="M50 28 L72 76"/><path d="M38 53 L62 53"/></g>'
		. '<g class="bm-nodes"><circle cx="27" cy="77" r="6.6" fill="#2FE3D2"/><circle cx="73" cy="77" r="6.6" fill="#2FE3D2"/><circle cx="50" cy="53" r="4.6" fill="#8B7CFF"/></g>'
		. '<g class="bm-human"><path d="M41 29 Q41 20.5 50 20.5 Q59 20.5 59 29 Z" fill="#FF5C8A"/><circle cx="50" cy="15.4" r="4.8" fill="#FF5C8A"/></g>'
		. '</svg>';
}

/** SVG favicon (data URI) — the mark on a rounded dark tile so it reads on any browser tab. */
function anthropos_favicon() {
	if ( has_site_icon() ) { return; }
	$svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect width="100" height="100" rx="24" fill="#0F1626"/><g fill="none" stroke="#2FE3D2" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"><path d="M50 32 L30 76"/><path d="M50 32 L70 76"/><path d="M39 56 L61 56"/></g><circle cx="30" cy="77" r="7" fill="#2FE3D2"/><circle cx="70" cy="77" r="7" fill="#2FE3D2"/><circle cx="50" cy="56" r="5" fill="#8B7CFF"/><path d="M40 33 Q40 23.5 50 23.5 Q60 23.5 60 33 Z" fill="#FF5C8A"/><circle cx="50" cy="18" r="5.4" fill="#FF5C8A"/></svg>';
	echo '<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,' . rawurlencode( $svg ) . '">' . "\n";
}
add_action( 'wp_head', 'anthropos_favicon', 1 );

/** A clean ~155-char meta description — prefers the manual excerpt, else the
 *  article's opening (which is the quick-answer paragraph, ideal for AEO/GEO). */
function anthropos_meta_description( $post = null ) {
	$post = get_post( $post );
	if ( ! $post ) { return get_bloginfo( 'description' ); }
	if ( has_excerpt( $post ) ) {
		$d = get_the_excerpt( $post );
	} else {
		$d = wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
	}
	$d = trim( preg_replace( '/\s+/', ' ', $d ) );
	if ( function_exists( 'mb_strlen' ) && mb_strlen( $d ) > 158 ) {
		$d = rtrim( mb_substr( $d, 0, 155 ) ) . '…';
	}
	return $d;
}

/** Meta description, canonical, Open Graph & Twitter tags for AEO/SEO/GEO. */
function anthropos_seo_head() {
	if ( is_singular() ) {
		$post  = get_queried_object();
		$desc  = anthropos_meta_description( $post );
		$url   = get_permalink( $post );
		$title = wp_strip_all_tags( get_the_title( $post ) );
		$type  = is_singular( 'post' ) ? 'article' : 'website';
	} elseif ( is_front_page() || is_home() ) {
		$desc  = get_bloginfo( 'description' );
		$url   = home_url( '/' );
		$title = wp_strip_all_tags( get_bloginfo( 'name' ) );
		$type  = 'website';
	} else {
		return;
	}
	$site = wp_strip_all_tags( get_bloginfo( 'name' ) );
	echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
	echo '<meta property="og:type" content="' . esc_attr( $type ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $site ) . '">' . "\n";
	echo '<meta name="twitter:card" content="summary">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
}
add_action( 'wp_head', 'anthropos_seo_head', 2 );

/**
 * Canonical FAQ data — server-rendered as real <details> markup (not
 * JS-injected), so both search engines and AI answer engines can read the
 * actual Q&amp;A text without executing JavaScript.
 */
function anthropos_faq_data() {
	return array(
		'general' => array(
			array( "How fast can you build my complete automation system?", "Most complete systems go live in about four weeks, and a single piece — just a website, or just lead-and-follow-up automation — can be live in one to two. The four weeks break into clear stages: a discovery week where we map exactly where your leads and revenue leak; a build week for the website and its content; a wiring week where the automation is connected on n8n to the tools you already use; and a launch week where every workflow is tested end to end before it ever touches a real customer. You review and approve at each stage, so nothing goes live that you haven't seen first. After the initial call you get an exact timeline for your specific setup, never a vague it-depends." ),
			array( "Do I own everything, or am I locked into your platform?", "You own all of it, permanently. Every website, workflow, email sequence and automation is built inside your own accounts — your domain, your n8n instance, your CRM, your email platform — then handed over with full documentation at the end. There is no proprietary system you have to keep paying us to access, and no contract that traps you: if you ever want to move the work in-house or to another provider, everything goes with you. Ongoing support and new automations are available if you want them, but they are always optional and month-to-month, never a lock-in." ),
			array( "What does it cost to work with you?", "Every business is different, so we do not publish fixed prices that would be wrong for half the people reading them. Instead, we look at your actual situation on a free consultation, agree the exact scope with you, and walk you through precisely what is involved — no hourly meter, no surprise invoices, and no pressure to decide on the spot. If you are weighing it up, the fastest way to a real answer is to book that free call and talk it through with an expert. You will leave knowing exactly what your business needs, with zero obligation." ),
			array( "Do I need any technical skills to run the system?", "No — the whole point is that you do not become the IT department. We set everything up, connect it to your existing tools, and hand it over with a short plain-language walkthrough and written documentation. Day to day, your only real job is to approve things: a drafted social post, a new lead that arrived, a monthly report. The AI agents and n8n workflows quietly move data between your inbox, calendar, CRM and website in the background, and whenever you want to change something, we show you exactly where to click." ),
			array( "Which tools do you connect, and will I have to replace mine?", "We connect the tools you already pay for rather than forcing a rip-and-replace, because migration is where most automation projects stall. In practice that means your website, n8n as the connective layer, and whatever you already use for email, CRM, calendar, booking, invoicing or your store — Shopify, HubSpot, Klaviyo, Google Calendar, common inboxes and many others. If a tool can send or receive data, it can almost always be wired in. On the rare occasion something genuinely cannot connect, we tell you before any work starts, along with the simplest alternative." ),
			array( "Will the automation feel robotic or impersonal to my customers?", "It should not, and if it does then we have built it wrong. The goal is that a customer feels attended to faster than before — an instant, on-brand reply that carries your credentials and answers their actual question — not that they are obviously talking to a bot. Anything an AI agent drafts (a reply, a social post, a follow-up) can run through an approval step until its voice consistently matches yours, and the sensitive human moments always stay human. Done well, customers simply notice that you got back to them quickly and that nothing slipped through the cracks." ),
			array( "Is my data safe, and is everything GDPR-compliant?", "Yes. We build on EU-hosted, consent-based tools and only move the data a workflow actually needs, rather than copying everything everywhere. Marketing consent, unsubscribe handling and data retention are set up correctly from the start, and you keep full ownership and control of every account. For medical, therapy and other regulated work there is a hard boundary we never cross: we build the marketing and new-enquiry layer only, and never touch patient portals, booking systems, intake forms or any records that fall under HIPAA-style or clinical-data rules — those stay entirely inside your own practice software." ),
			array( "What if I only need one thing, like a new website?", "That is completely fine, and often the smartest way to start. Each of the five offers stands on its own, so you can take just the website redesign, just the lead-and-follow-up automation, or just the social layer, and add the others whenever you are ready. Because every piece is built to plug into the same system, nothing has to be rebuilt later — the website you buy today already has lead-capture wired to feed automation you might add next year. We will recommend the single highest-impact starting point for your situation, but the choice and the pace are always yours." ),
			array( "Do you write the content, or do I have to supply it?", "We launch using the information, credentials, testimonials and proof you already have, and we structure and write the site copy, sequences and pages around it so it reads well and gets found. What we do not do is invent facts, fake reviews or unverifiable statistics on your behalf — your real proof is what builds trust, and that is what we work with. Ongoing content help (new guides, campaigns, social posts) is available as an option if you would rather not write it yourself, but it is never required to get the system live and working." ),
			array( "What happens after the system launches?", "Launch is a handover, not an exit. You receive documentation for every workflow, a walkthrough of how it runs, and reporting that shows in plain language what is actually working — which channel produces enquiries, how fast leads are answered, what converted. From there you can run it entirely yourself, or keep us on an optional month-to-month basis for monitoring, tweaks and new automations as the business grows. Because you own everything, you are never stuck: support is there if you want it and gone the moment you do not." ),
		),
		'gettingStarted' => array(
			array( "How do we start, and what happens on the first call?", "You book a free thirty-minute consultation, and it is a working session, not a sales pitch. On the call we map where your business is actually losing leads or revenue — the missed calls, the slow follow-up, the invisible-in-search problem — and show you the specific automation that would close the biggest gap. You leave with a clear picture of what a system would do for you and a concrete next step to consider. There is no obligation and no pressure to decide on the spot." ),
			array( "How long until my system is live?", "A full connected system is typically live four weeks from kickoff, and individual pieces are faster — a focused website or a single automation can be running in one to two weeks. The timeline is staged and predictable: map, build, wire, then test and launch, with your approval at each step. If your setup involves several tools or unusual requirements, we say so up front and give you the real number rather than promising four weeks and quietly slipping. You always know where the project stands." ),
			array( "What do you need from me to begin?", "Three things: access to the tools and accounts we will be connecting, the raw material that proves you are good — credentials, testimonials, past results, service details — and quick approvals as we go. You do not need to prepare polished copy, a design brief or a technical spec; drawing that out is our job. The more responsive you are on approvals, the faster the four weeks move, but we never need you to do technical work yourself. Most of the effort is ours, not yours." ),
			array( "Can you work with my current website, or do you rebuild from scratch?", "Often we can work with what you have — if your current site is fundamentally sound, we optimise what converts and wire in lead-capture rather than starting over. We only recommend a rebuild when the existing site is genuinely holding you back: too slow on mobile, impossible for a stranger to act on in the first five seconds, or built on something that cannot be extended. Either way you get an honest assessment on the first call, not an automatic push toward the most expensive option. We would rather save you money on the parts that already work." ),
			array( "What size and stage of business is this built for?", "This is built for solo operators and small teams — the kind of business that is genuinely excellent at what it does but losing work to slow follow-up, weak visibility or a dated website. It is deliberately not built for enterprise, large regulated practices, or anyone needing heavy custom software and formal compliance work, because those are better served by specialists. If you are a lawyer, clinician, tradesperson, shop owner, freelancer, coach or B2B provider feeling stretched between doing the work and chasing the next job, you are exactly who this is for." ),
			array( "Do you work in English, and with businesses outside Germany?", "Yes. We are based in Munich and work extensively with German small businesses, but the entire system — websites, automation, content and support — is delivered in English and works for businesses in other markets too. The underlying tools (n8n, common CRMs, email and store platforms) are international, and the answer-engine structuring that helps you get found works in any language. If you operate across borders or serve an English-speaking market, that is well within scope." ),
		),
		'servicesScope' => array(
			array( "What are the five offers, and how do they differ?", "The five offers move from a single focused fix to the whole connected system. Website Redesign rebuilds a fast, mobile-first site engineered around the five-second test. Lead &amp; Follow-up Automation is the highest-leverage layer — instant replies, nurture and win-backs so no enquiry ever slips away. Marketing Automation runs seasonal campaigns, newsletters and segmentation on a calendar instead of your memory, and Social Media Automation drafts, schedules and repurposes on-brand content for your approval. Full Transformation wires all of it together on n8n with your inbox, CRM, calendar and invoicing, so you stop being the glue between separate tools. Not sure which fits you? Book a free consultation and an expert will help you choose." ),
			array( "Can I combine services, or do I have to buy the whole thing?", "You can combine them freely, and most businesses start with just one. Each service page is really a micro-combo built for a specific type of business, and you can take a single offer, two of them, or the complete A-to-Z system. Because everything sits on the same foundation, adding a layer later never means rebuilding what you already have — the pieces are designed to click together. We help you sequence it sensibly, so you can start small and grow the system as it proves itself, rather than committing to everything at once." ),
			array( "Which industries and customer types do you serve?", "We focus on seven segments, each with its own tailored service page: regulated professionals (lawyers, financial advisors, tax consultants), medical professionals (doctors, dentists, therapists), e-commerce and retail, service-based professionals (home services, trainers, studios), freelancers and micro-agencies, creators and coaches, and B2B service providers. We segment because a dentist's missing-patients problem and an online store's vanishing-carts problem need different systems even though the underlying automation is the same. If your business does not fit neatly into one, the closest segment's system adapts, and we will tell you honestly on the call whether you are a good fit." ),
			array( "Who do you deliberately NOT work with?", "We turn down enterprise clients, large regulated practices, and any project whose core need is heavy custom software development or formal compliance consulting — those genuinely belong with specialist firms, not us. We also will not take on work that depends on fabricating proof, spamming, or automating something that should stay human, like clinical decisions or legal advice in writing. Saying no to the wrong-fit work is how we keep quality high for the small businesses we are actually built for. If we are not right for you, we say so early and, where we can, point you somewhere better." ),
			array( "What exactly is whole-business automation?", "It is the A-to-Z option where every layer works as one connected nervous system rather than five disconnected tools. In practice, a new enquiry can hit your website, get an instant reply, land in your CRM, book into your calendar, trigger an invoice when the job is done, and drop the customer into a review-request and win-back sequence — all without you re-typing anything between apps. n8n is the layer that moves the data between those tools, and AI agents handle the drafting and qualifying inside it. The result is that being busy stops causing dropped balls, because the system remembers and follows through even when you cannot." ),
			array( "Do you handle ongoing marketing, or just the initial setup?", "The core engagement is the build — we design, wire and launch the system, then hand it over documented and fully yours. Ongoing marketing (writing new campaigns, publishing guides, running social content, tuning sequences) is available as an optional month-to-month layer for owners who would rather approve than create. Many clients run the system themselves after handover and only bring us back for a specific new automation. Either way, you are never obligated to a retainer just to keep what you already own working." ),
		),
		'automationTools' => array(
			array( "What is n8n, and why do you build on it?", "n8n is a workflow-automation platform that connects your apps and moves data between them on rules you set — think of it as the wiring that lets your website, inbox, CRM, calendar and store talk to each other automatically. We build on it because it runs on your own infrastructure (so you own it), connects to hundreds of tools without brittle custom code, and lets an AI agent act inside real workflows rather than in a silo. That combination is what makes a system you fully own, instead of a subscription to someone else's black box. It is also why adding a new automation later is quick rather than a rebuild." ),
			array( "What can an AI agent actually do for my business?", "Within limits you define, an AI agent can read an incoming enquiry and reply in seconds with a relevant, on-brand answer; qualify and route leads so the good ones reach you fast; follow up on a schedule until someone responds; draft social posts and emails from your existing content; and keep information in sync across your tools. It is not magic and it is not left to run wild — it works inside the n8n workflows we build, does the repetitive judgment-light work, and hands anything sensitive to you. The practical effect is that the tasks you never get around to — the second follow-up, the review request, the win-back — actually happen, every single time." ),
			array( "What will you never automate?", "Anything where the human moment is the value. We never automate clinical care, medical or legal advice in writing, or genuinely sensitive decisions — those stay with you, always. We also will not automate deception: no fake reviews, no pretending a bot is a person when it matters, no spammy blasting. The boundary is deliberate, because trust is the asset automation is supposed to protect, not spend. The rule of thumb is simple: we automate the logistics and the reminders so you have more time for the conversations that genuinely need you." ),
			array( "Does it integrate with my CRM, booking or invoicing tools?", "In almost every case, yes — we connect common CRMs, inboxes, calendars, booking tools, invoicing systems and online stores rather than replacing them. If a tool can send or receive data through an API or a standard connector, and most modern ones can, it can be wired into the system. We confirm every integration you need on the first call, before any work begins, so there are no surprises halfway through. On the rare occasion a tool genuinely cannot connect, we tell you and recommend the simplest workaround or alternative." ),
			array( "What happens if a workflow breaks or something goes wrong?", "Workflows are built with error handling, so a failure is caught and flagged rather than silently swallowed — you find out, not your customer. Because everything runs on your own n8n instance with documentation, issues are traceable and fixable rather than locked inside a vendor's system. During any optional support period we monitor and repair as part of the arrangement; after handover, the documentation shows you or any developer exactly how each piece works. Automation dramatically reduces dropped balls, and the honest truth is that we design for the day something does go wrong, not only the day it works." ),
			array( "Will I have to pay for extra software or subscriptions?", "You will generally keep paying for the tools you already use — your email platform, CRM, store or calendar — and n8n itself is inexpensive to run, often far less than the all-in-one platforms it replaces. We are explicit about any third-party costs before the build starts, so your monthly running cost is clear and there are no hidden subscriptions bolted on. Because we connect your existing stack rather than adding a new proprietary platform, most clients find their total tool spend stays flat or even drops. You will never discover a surprise line item after launch." ),
		),
		'trustPricing' => array(
			array( "Is there a contract or lock-in?", "No lock-in of any kind. You own every account, workflow and asset, and no long-term contract is required to keep them running. Optional support is month-to-month, so you can pause or stop whenever it stops being worth it to you. The entire model is built so that staying with us is a choice you keep making because it is useful, not a trap you cannot leave." ),
			array( "How do I know what my project will involve?", "We keep it simple and human: rather than a rigid price list, we scope the work to exactly what your business needs and then walk you through what is included. That happens on a free, no-obligation consultation — you talk it through with an expert, we agree what is in and what is not, and there is never pressure to decide on the call. The clearest possible answer for your specific situation is one short conversation away. Book a consultation and we will map it out with you." ),
			array( "What return should I realistically expect?", "Honestly, it varies by business, and anyone promising a guaranteed number is guessing with your money. What we can say is where the return comes from: faster lead response and consistent follow-up convert more of the enquiries you already get, better visibility brings more of them in, and automation gives back hours you currently lose to repetitive admin. Rather than sell you a modelled percentage, we build reporting that shows your real numbers after launch — enquiries in, response time, conversion — so you can see the return instead of taking it on faith. That reporting is deliberately part of the system for exactly this reason." ),
			array( "Why should I trust a newer studio over an established agency?", "It is a fair question, and the honest answer is to judge us on the specifics, not the logo. The team combines real, verifiable experience — performance marketing at scale, production AI and data engineering, cybersecurity, and full-stack development — and we deliberately serve the small businesses that large agencies overlook or overcharge. Crucially, our model removes the usual risk of a newer provider: you own everything, there is no lock-in, and the work is documented and portable, so if we ever fall short you keep the whole system and walk away. We would rather earn trust with a clear scope and a free first call than with claims you cannot check." ),
			array( "What if it does not work for my business?", "First, we try hard not to take on work that will not work — the free consultation exists partly so we can tell you honestly whether your situation is a good fit before anyone commits. If we build a system and something is not performing, the reporting makes that visible quickly, and fixing it is part of the job rather than an upsell. And because you own every asset with no lock-in, the downside is capped: worst case, you keep a modern website and working automations that any provider can maintain. We would always rather scope carefully up front than over-promise and disappoint you later." ),
			array( "Do you offer a guarantee?", "We do not offer magic-number guarantees like a promised 10x in leads, because anyone who does is guessing with your money. What we do guarantee is concrete: the system is built to the scope we agreed, it is tested before launch, it is fully documented, and you own all of it outright with no lock-in. We also guarantee honesty — if we do not believe a piece will earn its cost for your business, we tell you before you commit to it. That combination of ownership, transparency and no contract is a stronger protection than a slogan you cannot enforce." ),
		),
	);
}

/** Render a group's Q&amp;A as real, server-side &lt;details&gt; markup — no JS required to read it. */
function anthropos_faq_render( $group = 'general' ) {
	$data  = anthropos_faq_data();
	$items = isset( $data[ $group ] ) ? $data[ $group ] : $data['general'];
	foreach ( $items as $i => $item ) {
		echo '<details' . ( 0 === $i ? ' open' : '' ) . '><summary>' . wp_kses_post( $item[0] ) . '</summary><p>' . wp_kses_post( $item[1] ) . '</p></details>';
	}
}

/** Emit FAQPage JSON-LD for a group, generated from the same data anthropos_faq_render() uses. */
function anthropos_faq_schema( $group = 'general' ) {
	$data  = anthropos_faq_data();
	$items = isset( $data[ $group ] ) ? $data[ $group ] : $data['general'];
	$entities = array();
	foreach ( $items as $item ) {
		$entities[] = array(
			'@type'          => 'Question',
			'name'           => wp_strip_all_tags( $item[0] ),
			'acceptedAnswer' => array( '@type' => 'Answer', 'text' => wp_strip_all_tags( $item[1] ) ),
		);
	}
	echo '<script type="application/ld+json">' . wp_json_encode( array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $entities,
	) ) . '</script>' . "\n";
}

/** Reusable FAQ section: server-rendered Q&amp;A + matching FAQPage schema. */
function anthropos_faq_section( $group = 'general' ) {
	$faq_pg = get_page_by_path( 'faq' );
	$faq_url = $faq_pg ? get_permalink( $faq_pg ) : home_url( '/faq/' );
	?>
	<section id="faq">
		<div class="wrap band reveal"><div class="eyebrow">FAQ · straight answers</div><h2>Questions we hear every week</h2><p class="soft">Ten honest answers before you book. Want more? See the <a href="<?php echo esc_url( $faq_url ); ?>" style="color:var(--flow)">full FAQ</a>.</p></div>
		<div class="wrap"><div class="faqwrap"><?php anthropos_faq_render( $group ); ?></div></div>
	</section>
	<?php anthropos_faq_schema( $group );
}

/** Meta description, canonical URL, and Open Graph / Twitter Card tags. */
function anthropos_document_meta() {
	$post_obj = get_queried_object();
	$desc = get_bloginfo( 'description' );
	if ( is_singular( 'post' ) ) {
		$excerpt = get_the_excerpt();
		$desc = $excerpt ? $excerpt : wp_trim_words( wp_strip_all_tags( get_the_content() ), 30 );
	} elseif ( is_page() && $post_obj instanceof WP_Post ) {
		$tmpl = get_page_template_slug( $post_obj );
		$pslug = $post_obj->post_name;
		if ( 'template-service.php' === $tmpl ) {
			$segs = function_exists( 'anthropos_segments' ) ? anthropos_segments() : array();
			$sps  = function_exists( 'anthropos_service_pages' ) ? anthropos_service_pages() : array();
			if ( isset( $segs[ $pslug ] ) ) {
				$desc = wp_strip_all_tags( $segs[ $pslug ]['sub'] );
			} elseif ( isset( $sps[ $pslug ] ) ) {
				$desc = wp_strip_all_tags( $sps[ $pslug ]['sub'] );
			} else {
				$desc = 'Automation service pages for seven customer segments plus marketing and social media automation — pick the page built for your business.';
			}
		} elseif ( 'template-about.php' === $tmpl ) {
			$desc = 'Meet the team behind Anthropos Automation OS and how we build AI-run automation systems for small businesses.';
		} elseif ( 'template-faq.php' === $tmpl ) {
			$desc = 'Straight answers on timelines, tools and what we actually automate — before you book a free consultation.';
		} elseif ( 'template-guides.php' === $tmpl ) {
			$desc = 'Free, practical guides for turning leads into revenue with AI automation — filter by your business type or the service you need.';
		}
	} elseif ( is_home() || is_front_page() ) {
		$tagline = get_bloginfo( 'description' );
		$desc = $tagline ? $tagline : 'AI + n8n business automation: a converting website, answer-engine visibility, and AI agents that capture, qualify and follow up every lead.';
	} elseif ( is_category() || is_tag() ) {
		$desc = single_term_title( '', false ) . ' — automation guides and field notes from Anthropos Automation OS.';
	}
	$desc = wp_trim_words( wp_strip_all_tags( $desc ), 30, '…' );
	$url  = is_singular() ? get_permalink() : ( is_front_page() ? home_url( '/' ) : home_url( add_query_arg( array() ) ) );
	$title = wp_get_document_title();
	?>
<meta name="description" content="<?php echo esc_attr( $desc ); ?>">
<link rel="canonical" href="<?php echo esc_url( $url ); ?>">
<meta property="og:type" content="<?php echo is_singular( 'post' ) ? 'article' : 'website'; ?>">
<meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
<meta property="og:description" content="<?php echo esc_attr( $desc ); ?>">
<meta property="og:url" content="<?php echo esc_url( $url ); ?>">
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
<meta name="twitter:description" content="<?php echo esc_attr( $desc ); ?>">
	<?php
}
add_action( 'wp_head', 'anthropos_document_meta', 1 );

/** Sitewide Organization schema — one JSON-LD block per page. */
function anthropos_schema_organization() {
	$data = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Organization',
		'name'        => get_bloginfo( 'name' ),
		'url'         => home_url( '/' ),
		'description' => 'AI and n8n business-automation studio: converting websites, AEO/GEO answer-engine visibility, and AI agents that capture, qualify and follow up every lead.',
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data ) . '</script>' . "\n";
}
add_action( 'wp_head', 'anthropos_schema_organization', 2 );

/** Add the sitemap line to robots.txt (WP core still serves the default file). */
function anthropos_robots_txt( $output, $public ) {
	if ( '1' !== (string) $public ) { return $output; }
	$output .= "Sitemap: " . home_url( '/wp-sitemap.xml' ) . "\n";
	return $output;
}
add_filter( 'robots_txt', 'anthropos_robots_txt', 10, 2 );

/** Preconnect hints for the two third-party origins the theme depends on. */
function anthropos_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.googleapis.com', 'crossorigin' );
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
		$urls[] = array( 'href' => 'https://cdnjs.cloudflare.com', 'crossorigin' );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'anthropos_resource_hints', 10, 2 );

function anthropos_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	register_nav_menus( array( 'primary' => __( 'Primary Menu', 'anthropos' ) ) );
}
add_action( 'after_setup_theme', 'anthropos_setup' );

function anthropos_assets() {
	wp_enqueue_style(
		'anthropos-fonts',
		'https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=JetBrains+Mono:wght@400;500;600&display=swap',
		array(), null
	);
	wp_enqueue_style( 'anthropos-style', get_stylesheet_uri(), array( 'anthropos-fonts' ), ANTHROPOS_VERSION );
	wp_enqueue_script( 'threejs', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), 'r128', true );
	wp_enqueue_script( 'anthropos-main', get_template_directory_uri() . '/assets/js/main.js', array( 'threejs' ), ANTHROPOS_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'anthropos_assets' );

/**
 * One-time bootstrap: create the Services / Guides / Blog pages the menu links to,
 * and set a static front page. Runs once in admin; guarded by an option flag so it
 * fires the first time an admin loads the dashboard after this version deploys.
 */
function anthropos_bootstrap_pages() {
	if ( get_option( 'anthropos_bootstrapped_v56' ) ) { return; }
	if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) { return; }

	// Parent "Services" page (overview listing) using the service template.
	$svc = get_page_by_path( 'services' );
	if ( ! $svc ) {
		$svc_id = wp_insert_post( array(
			'post_title'  => 'Services',
			'post_name'   => 'services',
			'post_status' => 'publish',
			'post_type'   => 'page',
			'post_content'=> '',
		) );
		if ( $svc_id && ! is_wp_error( $svc_id ) ) { update_post_meta( $svc_id, '_wp_page_template', 'template-service.php' ); }
	} else {
		$svc_id = $svc->ID;
	}
	// One child page per segment: /services/{slug}/ named "Automation Service for {Segment}".
	if ( $svc_id && ! is_wp_error( $svc_id ) && function_exists( 'anthropos_segments' ) ) {
		foreach ( anthropos_segments() as $slug => $seg ) {
			if ( get_page_by_path( 'services/' . $slug ) ) { continue; }
			$cid = wp_insert_post( array(
				'post_title'  => wp_specialchars_decode( $seg['title'] ),
				'post_name'   => $slug,
				'post_status' => 'publish',
				'post_type'   => 'page',
				'post_parent' => $svc_id,
				'post_content'=> '',
			) );
			if ( $cid && ! is_wp_error( $cid ) ) { update_post_meta( $cid, '_wp_page_template', 'template-service.php' ); }
		}
	}
	// Standalone service pages: Marketing Automation &amp; Social Media Automation.
	if ( function_exists( 'anthropos_service_pages' ) ) {
		foreach ( anthropos_service_pages() as $sslug => $sp ) {
			if ( get_page_by_path( $sslug ) ) { continue; }
			$spid = wp_insert_post( array(
				'post_title'  => wp_specialchars_decode( $sp['title'] ),
				'post_name'   => $sslug,
				'post_status' => 'publish',
				'post_type'   => 'page',
				'post_content'=> '',
			) );
			if ( $spid && ! is_wp_error( $spid ) ) { update_post_meta( $spid, '_wp_page_template', 'template-service.php' ); }
		}
	}
	// About page (Our Company / Vision / Team, designed with 3D).
	if ( ! get_page_by_path( 'about' ) ) {
		$aid = wp_insert_post( array( 'post_title' => 'About Us', 'post_name' => 'about', 'post_status' => 'publish', 'post_type' => 'page', 'post_content' => '' ) );
		if ( $aid && ! is_wp_error( $aid ) ) { update_post_meta( $aid, '_wp_page_template', 'template-about.php' ); }
	}
	// FAQ page (segmented master FAQ).
	if ( ! get_page_by_path( 'faq' ) ) {
		$fid = wp_insert_post( array( 'post_title' => 'FAQ', 'post_name' => 'faq', 'post_status' => 'publish', 'post_type' => 'page', 'post_content' => '' ) );
		if ( $fid && ! is_wp_error( $fid ) ) { update_post_meta( $fid, '_wp_page_template', 'template-faq.php' ); }
	}
	// Legal / policy pages. Launch-quality copy; only the bracketed [ ] legal-identity
	// fields need completing by the founder. Existing pages are UPDATED, not skipped.
	$legal = array(
		'privacy-policy' => array(
			'Privacy Policy',
			'<p><i>Last updated: July 2026. The bracketed [ ] details below must be completed with your final legal information before public launch.</i></p>'
			. '<p>Anthropos Automation Service ("we", "us", "our") is committed to protecting your personal data. This policy explains what we collect, why, how we keep it safe, and the rights you have under the EU General Data Protection Regulation (GDPR).</p>'
			. '<h2>1. Who is responsible</h2><p>The controller responsible for your data is:<br>[Registered name]<br>[Street and number]<br>[Postal code, city, country]<br>Email: hello@anthropos-automation.com</p><p>Full legal and contact details are in our <a href="/imprint/">Imprint</a>.</p>'
			. '<h2>2. What we collect and why</h2>'
			. '<p><b>Consultation form.</b> When you book a consultation you give us your name, email address, phone number (optional), business name (optional), your multiple-choice answers, any notes you add, and an optional file (JPEG or PDF, up to 2&nbsp;MB). We use this only to understand your enquiry, prepare for our conversation and reply to you.</p>'
			. '<p><b>Booking &amp; scheduling.</b> When you choose a time slot, our scheduling provider processes your name, email and timezone to create the appointment and send confirmations. It detects your timezone automatically so times appear in your own local time.</p>'
			. '<p><b>Server logs.</b> Our EU-based hosting automatically records technical data such as your IP address, browser type and the time of your visit, to keep the site secure and running.</p>'
			. '<p><b>WhatsApp.</b> If you choose to message us on WhatsApp, your message and number are processed by WhatsApp / Meta under their own terms.</p>'
			. '<h2>3. Legal basis</h2><p>We process consultation data on the basis of your consent and to take steps at your request before entering into a contract (Art. 6(1)(a) and (b) GDPR). We process server logs on the basis of our legitimate interest in a secure, functioning website (Art. 6(1)(f) GDPR).</p>'
			. '<h2>4. Cookies</h2><p>This website uses only the cookies strictly necessary for it to function. We do not use advertising or tracking cookies.</p>'
			. '<h2>5. Who we share it with</h2><p>We never sell your data. We share it only with the providers that help us operate &mdash; our EU hosting provider, our email provider and our scheduling provider &mdash; and only as far as needed to reply to you. Where a provider is based outside the EU, the transfer is covered by appropriate safeguards such as the EU Standard Contractual Clauses.</p>'
			. '<h2>6. How long we keep it</h2><p>We keep your enquiry only as long as we need it to deal with your request and for any period required by law, after which it is deleted. You can ask us to delete it sooner at any time.</p>'
			. '<h2>7. Your rights</h2><p>You have the right to access, correct, delete, restrict or port your data, to object to processing, and to withdraw consent at any time. To exercise any of these, email hello@anthropos-automation.com. You also have the right to lodge a complaint with a data-protection supervisory authority.</p>'
			. '<h2>8. Changes</h2><p>We may update this policy as our services grow. The current version always appears on this page.</p>',
		),
		'terms' => array(
			'Terms of Service',
			'<p><i>Last updated: July 2026. Please complete the bracketed [ ] details before public launch.</i></p>'
			. '<p>These terms govern your use of this website and any free consultation you book with Anthropos Automation Service. By using this site, you agree to them.</p>'
			. '<h2>1. The consultation</h2><p>Booking a consultation is free and places you under no obligation. It is a conversation about your business, not a binding order. Any work we go on to do for you is agreed separately, in writing, before it begins.</p>'
			. '<h2>2. Engagements and ownership</h2><p>If you decide to work with us, the scope, timeline and terms are set out in a separate written agreement. Any website, workflow or automation we build for you is built on your own accounts and handed over to you, so you own it in full.</p>'
			. '<h2>3. No professional advice</h2><p>The articles, guides and other information on this website are provided for general guidance only. They are not legal, financial, medical or other professional advice, and should not be relied on as a substitute for advice from a qualified professional.</p>'
			. '<h2>4. Intellectual property</h2><p>The content, design and code of this website belong to Anthropos Automation Service unless stated otherwise. You may not copy or reuse them without our permission.</p>'
			. '<h2>5. External links</h2><p>Where we link to other websites, we are not responsible for their content or their privacy practices.</p>'
			. '<h2>6. Liability</h2><p>To the extent permitted by law, we are not liable for any loss arising from your use of this website. Nothing in these terms limits any liability that cannot be limited by law.</p>'
			. '<h2>7. Governing law</h2><p>These terms are governed by the laws of [Germany / your country], and the courts of [your city] have jurisdiction, unless mandatory consumer law provides otherwise.</p>'
			. '<h2>8. Contact</h2><p>Questions about these terms? Email hello@anthropos-automation.com.</p>',
		),
		'imprint' => array(
			'Imprint',
			'<p><i>Please replace every bracketed [ ] field with your final legal details before public launch. This structure follows the information required for a German imprint (&sect;&nbsp;5 DDG, &sect;&nbsp;18 MStV).</i></p>'
			. '<h2>Information pursuant to &sect;&nbsp;5 DDG</h2><p>[Registered name of the business or sole trader]<br>[Street and number]<br>[Postal code and city]<br>[Country]</p>'
			. '<h2>Represented by</h2><p>[Full name of the owner or managing director]</p>'
			. '<h2>Contact</h2><p>Email: hello@anthropos-automation.com<br>Phone: [phone number]</p>'
			. '<h2>VAT identification number</h2><p>VAT ID pursuant to &sect;&nbsp;27a of the German VAT Act (UStG): [DE&hellip; or "not yet issued"]</p>'
			. '<h2>Entry in the commercial register</h2><p>[If registered: register court and register number. If you operate as a sole trader (Einzelunternehmen / Kleinunternehmer), state that here instead.]</p>'
			. '<h2>Responsible for content pursuant to &sect;&nbsp;18(2) MStV</h2><p>[Name and address of the person responsible for content &mdash; usually the same as above]</p>'
			. '<h2>EU dispute resolution</h2><p>The European Commission provides a platform for online dispute resolution: <a href="https://ec.europa.eu/consumers/odr/" target="_blank" rel="noopener">https://ec.europa.eu/consumers/odr/</a>. We are not obliged, and not willing, to take part in dispute-resolution proceedings before a consumer arbitration board.</p>'
			. '<h2>Liability for content and links</h2><p>We take great care with the content of this website but cannot guarantee it is always accurate or complete. We are not responsible for the content of external websites we link to; responsibility lies with their operators.</p>',
		),
	);
	foreach ( $legal as $lslug => $ldata ) {
		$existing = get_page_by_path( $lslug );
		if ( $existing ) {
			wp_update_post( array( 'ID' => $existing->ID, 'post_title' => $ldata[0], 'post_content' => $ldata[1] ) );
		} else {
			wp_insert_post( array( 'post_title' => $ldata[0], 'post_name' => $lslug, 'post_status' => 'publish', 'post_type' => 'page', 'post_content' => $ldata[1] ) );
		}
	}
	// Guides library landing (linked from inside service pages, not the header).
	$gpg = get_page_by_path( 'guides' );
	if ( ! $gpg ) {
		$gid = wp_insert_post( array( 'post_title' => 'Guides', 'post_name' => 'guides', 'post_status' => 'publish', 'post_type' => 'page', 'post_content' => '' ) );
	} else {
		$gid = $gpg->ID;
	}
	if ( $gid && ! is_wp_error( $gid ) ) { update_post_meta( $gid, '_wp_page_template', 'template-guides.php' ); }
	// Blog page (posts page).
	$blog = get_page_by_path( 'blog' );
	if ( ! $blog ) {
		$blog_id = wp_insert_post( array( 'post_title' => 'Blog', 'post_name' => 'blog', 'post_status' => 'publish', 'post_type' => 'page', 'post_content' => '' ) );
	} else {
		$blog_id = $blog->ID;
	}
	// Home page + static front.
	$home = get_page_by_path( 'home' );
	if ( ! $home ) {
		$home_id = wp_insert_post( array( 'post_title' => 'Home', 'post_name' => 'home', 'post_status' => 'publish', 'post_type' => 'page', 'post_content' => '' ) );
	} else {
		$home_id = $home->ID;
	}
	if ( $home_id && ! is_wp_error( $home_id ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
	}
	if ( $blog_id && ! is_wp_error( $blog_id ) ) {
		update_option( 'page_for_posts', $blog_id );
	}
	// Flush permalinks so the new /services/{slug}/ URLs resolve.
	flush_rewrite_rules();
	update_option( 'anthropos_bootstrapped_v56', 1 );
}
add_action( 'admin_init', 'anthropos_bootstrap_pages' );

/**
 * Seed real content: 7 segment categories + 6 service tags + ao_type terms
 * (guide/blog), then 18 real posts (9 guides + 9 blog articles) from
 * inc/content-seed.php. Guarded independently of page bootstrap so future
 * content batches can bump this flag without re-running page creation.
 */
function anthropos_seed_content() {
	if ( get_option( 'anthropos_content_seeded_v20' ) ) { return; }
	if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) { return; }
	if ( ! function_exists( 'anthropos_seed_posts' ) ) { return; }

	// Segment categories — slugs match anthropos_segments() keys exactly.
	if ( function_exists( 'anthropos_segments' ) ) {
		foreach ( anthropos_segments() as $slug => $seg ) {
			if ( ! term_exists( $slug, 'category' ) ) {
				wp_insert_term( wp_specialchars_decode( $seg['label'] ), 'category', array( 'slug' => $slug ) );
			}
		}
	}
	// Business Launch is a standalone service (not one of the 7 segments) but still
	// needs a category so its guides/blogs file and filter correctly.
	if ( ! term_exists( 'business-launch', 'category' ) ) {
		wp_insert_term( 'Business Launch', 'category', array( 'slug' => 'business-launch' ) );
	}
	// Service tags — slugs match anthropos_service_tags() keys exactly.
	foreach ( anthropos_service_tags() as $slug => $label ) {
		if ( ! term_exists( $slug, 'post_tag' ) ) {
			wp_insert_term( $label, 'post_tag', array( 'slug' => $slug ) );
		}
	}
	// ao_type terms.
	foreach ( array( 'guide' => 'Guide', 'blog' => 'Blog' ) as $slug => $label ) {
		if ( ! term_exists( $slug, 'ao_type' ) ) {
			wp_insert_term( $label, 'ao_type', array( 'slug' => $slug ) );
		}
	}

	$seed_posts = anthropos_seed_posts();
	if ( function_exists( 'anthropos_seed_posts_batch2' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch2() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch3' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch3() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch4' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch4() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch5' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch5() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch6' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch6() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch7' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch7() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch8' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch8() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch9' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch9() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch10' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch10() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch11' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch11() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch12' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch12() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch13' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch13() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch14' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch14() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch15' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch15() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch16' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch16() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch17' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch17() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch18' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch18() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch19' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch19() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch20' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch20() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch21' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch21() );
	}
	if ( function_exists( 'anthropos_seed_posts_batch22' ) ) {
		$seed_posts = array_merge( $seed_posts, anthropos_seed_posts_batch22() );
	}
	$inserted = 0;
	foreach ( $seed_posts as $p ) {
		if ( $inserted >= 25 ) { return; } // chunk: continue on the next admin load so no single request is too heavy
		if ( get_page_by_path( $p['slug'], OBJECT, 'post' ) ) { continue; }
		$pid = wp_insert_post( array(
			'post_title'   => $p['title'],
			'post_name'    => $p['slug'],
			'post_status'  => 'publish',
			'post_type'    => 'post',
			'post_content' => anthropos_localize_links( $p['content'] ),
		) );
		if ( ! $pid || is_wp_error( $pid ) ) { continue; }
		$inserted++;
		if ( ! empty( $p['cat'] ) ) {
			$cat_term = get_term_by( 'slug', $p['cat'], 'category' );
			if ( $cat_term ) { wp_set_post_categories( $pid, array( $cat_term->term_id ) ); }
		}
		if ( ! empty( $p['tags'] ) ) {
			$tag_ids = array();
			foreach ( $p['tags'] as $tag_slug ) {
				$tag_term = get_term_by( 'slug', $tag_slug, 'post_tag' );
				if ( $tag_term ) { $tag_ids[] = $tag_term->term_id; }
			}
			if ( $tag_ids ) { wp_set_post_terms( $pid, $tag_ids, 'post_tag' ); }
		}
		wp_set_object_terms( $pid, $p['type'], 'ao_type' );
	}
	update_option( 'anthropos_content_seeded_v20', 1 );
}
add_action( 'admin_init', 'anthropos_seed_content', 20 );

/**
 * One-time: retire the old generic guide/blog library (batches 1-3) by moving
 * those posts to draft, so only the new-style content (batches 4-9) is shown.
 * Reversible — nothing is deleted. Service-page guide cards fall back to the
 * guides library automatically for any slug that is no longer published.
 */
function anthropos_retire_old_content() {
	if ( get_option( 'anthropos_old_retired_v1' ) ) { return; }
	if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) { return; }
	$old = array();
	if ( function_exists( 'anthropos_seed_posts' ) )        { $old = array_merge( $old, anthropos_seed_posts() ); }
	if ( function_exists( 'anthropos_seed_posts_batch2' ) ) { $old = array_merge( $old, anthropos_seed_posts_batch2() ); }
	if ( function_exists( 'anthropos_seed_posts_batch3' ) ) { $old = array_merge( $old, anthropos_seed_posts_batch3() ); }
	if ( ! $old ) { return; }
	$done = 0;
	foreach ( $old as $p ) {
		if ( $done >= 25 ) { return; } // chunk: continue on the next admin load so no single request is too heavy
		if ( empty( $p['slug'] ) ) { continue; }
		$post = get_page_by_path( $p['slug'], OBJECT, 'post' );
		if ( $post && 'publish' === $post->post_status ) {
			wp_update_post( array( 'ID' => $post->ID, 'post_status' => 'draft' ) );
			$done++;
		}
	}
	update_option( 'anthropos_old_retired_v1', 1 );
}
add_action( 'admin_init', 'anthropos_retire_old_content', 22 );

/**
 * One-time migration: localize root-relative links in posts seeded before
 * anthropos_localize_links() existed, so already-published articles get the
 * same fix as newly-seeded ones without re-running the whole seed process.
 */
function anthropos_migrate_localize_links() {
	if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) { return; }
	if ( get_option( 'anthropos_links_localized_v1' ) ) { return; }
	$posts = get_posts( array( 'post_type' => 'post', 'posts_per_page' => -1, 'post_status' => 'publish' ) );
	foreach ( $posts as $post ) {
		if ( false === strpos( $post->post_content, 'href="/' ) ) { continue; }
		wp_update_post( array( 'ID' => $post->ID, 'post_content' => anthropos_localize_links( $post->post_content ) ) );
	}
	update_option( 'anthropos_links_localized_v1', 1 );
}
add_action( 'admin_init', 'anthropos_migrate_localize_links', 21 );
