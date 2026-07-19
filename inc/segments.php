<?php
/**
 * The 7 customer segments — data for the per-segment service pages.
 * Each: label, title, hue (CSS var), sub (hero pains), guides[10].
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * The 5 offers shown on every service page — customer chooses by pain & budget.
 * [ fx, hueVar, no, tier, title, best-for, body ]
 */
function anthropos_offers() {
	return array(
		array( 'funnel', 'var(--g2)', 'OFFER 01', '€ · Starter', 'Website Redesign', 'your site is dated or visitors leave without acting.', 'A modern, fast, mobile-first site that earns trust in five seconds — with lead-capture forms ready to plug into automation later.' ),
		array( 'dataflow', 'var(--flow)', 'OFFER 02', '€€ · Core', 'Lead &amp; Follow-up Automation', 'leads slip away from slow or forgotten follow-up.', '60-second replies, nurture sequences, reminders and win-backs — every inquiry captured and chased, then handed to you warm.' ),
		array( 'broadcast', 'var(--g3)', 'OFFER 03', '€€ · Growth', 'Marketing Automation', 'you never run campaigns consistently.', 'Seasonal campaigns, newsletters and segmented sequences — the right message to the right person at the right moment, on schedule.' ),
		array( 'social', 'var(--g5)', 'OFFER 04', '€€ · Growth', 'Social Media Automation', 'posting is inconsistent and eats your time.', 'An AI agent drafts, schedules and repurposes on-brand content — you approve, it publishes, engagement flows back to your pipeline.' ),
		array( 'core', 'var(--cta)', 'OFFER 05', '€€€ · A-to-Z', 'Full Transformation · AI + n8n', 'you want the whole system, done for you.', 'Website + AEO/GEO + all automation wired on n8n — inbox, CRM, invoicing and reporting connected into one nervous system. Live in 4 weeks.' ),
	);
}

/**
 * Standalone service pages (cross-segment): Marketing &amp; Social Media Automation.
 * Each: label, title, hue, sub, blocks[ [fx,hueVar,no,h3,body] ], glabel.
 */
function anthropos_service_pages() {
	return array(
		'marketing-automation' => array(
			'label' => 'Marketing Automation',
			'title' => 'Marketing Automation',
			'hue'   => 'var(--g3)',
			'sub'   => 'You have an audience but never run campaigns consistently. We build the marketing engine — campaigns, newsletters, segmentation, win-backs and reporting — that runs <b>on schedule, without you</b>.',
			'blocks'=> array(
				array( 'broadcast', 'var(--g3)', '01', 'Campaign Engine', 'Seasonal &amp; launch campaigns that trigger themselves — the right offer at the right moment, every time.' ),
				array( 'dataflow', 'var(--flow)', '02', 'Newsletter Nurture', 'Turn readers into buyers with sequenced value that warms them up long before you ask.' ),
				array( 'neural', 'var(--ai)', '03', 'Smart Segmentation', 'The right message to the right person automatically — by interest, behaviour and value.' ),
				array( 'workflow', 'var(--g5)', '04', 'Win-backs &amp; Re-engagement', 'Wake dormant leads and past clients with timed, personal sequences.' ),
				array( 'growth', 'var(--g2)', '05', 'Attribution &amp; Reporting', 'Know which campaign actually made money — and pour budget where it works.' ),
			),
			'glabel'=> 'marketers',
		),
		'social-media-automation' => array(
			'label' => 'Social Media Automation',
			'title' => 'Social Media Automation',
			'hue'   => 'var(--g5)',
			'sub'   => 'Posting is inconsistent and eats your time. An AI agent drafts on-brand content, schedules it across channels, repurposes your best ideas and routes engagement back to your pipeline — <b>you just approve</b>.',
			'blocks'=> array(
				array( 'social', 'var(--g5)', '01', 'AI Content Drafting', 'An agent drafts on-brand posts from your ideas and content — you review and approve in minutes.' ),
				array( 'calendar', 'var(--g4)', '02', 'Cross-channel Scheduling', 'Publish across LinkedIn, Instagram and more on a steady, planned cadence.' ),
				array( 'ecosystem', 'var(--ai)', '03', 'Repurposing Engine', 'One idea becomes many channel-native posts — a guide turns into a month of content.' ),
				array( 'workflow', 'var(--flow)', '04', 'Engagement Routing', 'Comments and DMs captured and routed to your pipeline, not lost in an app.' ),
				array( 'radar', 'var(--g2)', '05', 'Analytics &amp; Optimization', 'See what lands, and let the system double down on what works.' ),
			),
			'glabel'=> 'social media',
		),
	);
}

function anthropos_segments() {
	return array(
		'regulated-professionals' => array(
			'label' => 'Regulated Professionals',
			'title' => 'Automation Service for Regulated Professionals',
			'hue'   => 'var(--g1)',
			'sub'   => 'Lawyers, financial advisors &amp; tax consultants: referral-dependent, slow to follow up, invisible online. We install the website, visibility and <b>AI agents on n8n</b> that capture and nurture every inquiry — compliantly.',
			'guides'=> array(
				'Why your referrals went quiet — and the system that replaces them',
				'Local SEO for solo firms: ranking for “[practice] near me”',
				'Google Business Profile for regulated professionals, reviewed',
				'The 60-second reply that doubles consultations',
				'The 5-email inquiry sequence, with templates',
				'Case results &amp; testimonials within professional rules',
				'The case-evaluation form that feels safe to fill',
				'Seasonal &amp; win-back campaigns for quiet months',
				'Reading your lead report: which marketing is wasted',
				'From referral-only to a steady pipeline',
			),
		),
		'medical-professionals' => array(
			'label' => 'Medical Professionals',
			'title' => 'Automation Service for Medical Professionals',
			'hue'   => 'var(--g2)',
			'sub'   => 'Doctors, dentists &amp; therapists: excellent in the room, invisible in search. We make you findable, trusted in five seconds, and every inquiry answered in sixty — while <b>booking and records stay entirely in your system</b>.',
			'guides'=> array(
				'Why your waiting room is half-empty when you\'re excellent',
				'Local visibility for “[specialty] near me”',
				'Google Business Profile + reviews that lift ranking',
				'The 60-second reply to a new-patient inquiry',
				'Turning inquiries into booked appointments (booking stays yours)',
				'Trust in five seconds: what a nervous patient decides',
				'Review requests that add 0.5–1.0 stars',
				'Win-backs: “overdue for your checkup”',
				'The boundary: what we automate and never touch (no HIPAA)',
				'From word-of-mouth to a full schedule',
			),
		),
		'ecommerce-retail' => array(
			'label' => 'E-Commerce &amp; Retail',
			'title' => 'Automation Service for E-Commerce &amp; Retail',
			'hue'   => 'var(--g3)',
			'sub'   => 'Shopify &amp; multi-channel sellers: good traffic, vanishing carts, no repeat buyers. We recover carts, grow your list, and turn one-time orders into <b>lifetime value</b> — on autopilot.',
			'guides'=> array(
				'What cart abandonment really costs your store',
				'The 6h / 24h / 48h recovery sequence, with copy',
				'Post-purchase flows that create repeat buyers',
				'Building an email list you actually own',
				'Speed: the 3-second rule for mobile shoppers',
				'Unified inbox across Amazon, eBay &amp; Shopify',
				'Stopping oversell with inventory sync alerts',
				'Cross-channel promotion &amp; VIP segmentation',
				'Which channel is actually profitable?',
				'From one-time buyers to lifetime value',
			),
		),
		'service-professionals' => array(
			'label' => 'Service-Based Professionals',
			'title' => 'Automation Service for Service-Based Professionals',
			'hue'   => 'var(--g4)',
			'sub'   => 'Home services, trainers &amp; consultants: booked one week, empty the next, missing calls while you work. We fill the calendar, confirm bookings, and <b>cut no-shows</b> — automatically.',
			'guides'=> array(
				'Why great weeks are followed by empty ones',
				'Getting found for “[service] near me”',
				'Google Business Profile for local trades &amp; studios',
				'The booking confirmation that cuts no-shows 70%',
				'The 2pm problem: never miss a lead while working',
				'Before/after galleries &amp; reviews that convert',
				'Job-completion: invoice, review &amp; referral, automatic',
				'Re-engagement: seasonal maintenance &amp; win-backs',
				'Which jobs are actually profitable?',
				'From feast-or-famine to a steady calendar',
			),
		),
		'freelancers-agencies' => array(
			'label' => 'Freelancers &amp; Micro-Agencies',
			'title' => 'Automation Service for Freelancers &amp; Micro-Agencies',
			'hue'   => 'var(--g7)',
			'sub'   => 'Designers, developers &amp; small agencies: tire-kickers in the inbox, best proposals dying of silence. We <b>pre-qualify leads and follow up for you</b>, so you make more and chase less.',
			'guides'=> array(
				'Stop chasing: pre-qualify before the call',
				'A portfolio that pre-sells you',
				'Case studies that prove business impact',
				'The discovery-call sequence, with templates',
				'Proposal follow-up on day 5 (without the awkward email)',
				'Outcome-first positioning vs “we do X”',
				'Testimonial &amp; referral automation',
				'Nurturing your content readers into clients',
				'Reading your lead report: kill the low-value channels',
				'From referral roulette to a predictable pipeline',
			),
		),
		'creators-coaches' => array(
			'label' => 'Creators &amp; Coaches',
			'title' => 'Automation Service for Creators &amp; Coaches',
			'hue'   => 'var(--g5)',
			'sub'   => 'Course creators &amp; newsletter writers: low landing conversion, students who drift, free readers who never pay. We lift conversion, completion and upgrades — with <b>sequences that feel human</b>.',
			'guides'=> array(
				'Why students drift away at lesson four',
				'Landing pages that convert at 5–10%, not 1–2%',
				'The lead magnet + 5-email welcome that fills courses',
				'Progress-based nurture that lifts completion',
				'Upsell &amp; cross-sell without being pushy',
				'Free-to-paid: the 30-day upgrade sequence',
				'Interest segmentation for newsletters',
				'Churn prevention for members &amp; subscribers',
				'Proof &amp; testimonials that beat skepticism',
				'From launch spikes to steady enrollment',
			),
		),
		'b2b-providers' => array(
			'label' => 'B2B Service Providers',
			'title' => 'Automation Service for B2B Service Providers',
			'hue'   => 'var(--g6)',
			'sub'   => 'SaaS implementation &amp; training providers: six-month cycles, price pressure, hard to differentiate. Case-study-led positioning + <b>AI follow-up that keeps every deal warm</b> — automatically.',
			'guides'=> array(
				'Escaping the “I implement X — so do 1,000 others” trap',
				'Getting surfaced when buyers &amp; AI assistants research',
				'Case studies procurement actually trusts',
				'The strategy-call sequence with roadmap',
				'Day-5 proposal follow-up &amp; stakeholder routing',
				'Mapping a 6-month cycle into n8n stages',
				'Implementation-progress updates that build trust',
				'Post-implementation: testimonials &amp; upsell',
				'Reading your pipeline: where deals stall',
				'From referral-dependent to always-on demand',
			),
		),
	);
}
