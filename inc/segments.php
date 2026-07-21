<?php
/**
 * The 7 customer segments, data for the per-segment service pages.
 * Each: label, title, hue (CSS var), sub (hero pains), article (~900 words,
 * AEO-structured with internal + external links), guides[10 titles].
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * The 5 offers shown on every service page, customer chooses by pain & budget.
 * [ fx, hueVar, no, tier, title, best-for, body (~100 words) ]
 */
function anthropos_offers() {
	return array(
		array( 'funnel', 'var(--g2)', 'OFFER 01', 'Foundation', 'Website Redesign',
			'your site is dated or visitors leave without acting.',
			'A modern, fast, mobile-first website engineered around the five-second test: the moment a stranger lands, they should see who you are, what you do, and proof that you\'re good at it. We rebuild your homepage, service pages and contact forms so nothing sits between a visitor and an inquiry, clean navigation, fast load times, and lead-capture forms wired to feed the automation layer from day one. You keep full ownership of the site; nothing here locks you into us.' ),
		array( 'dataflow', 'var(--flow)', 'OFFER 02', 'Most popular', 'Lead &amp; Follow-up Automation',
			'leads slip away from slow or forgotten follow-up.',
			'The single highest-leverage fix we install: every inquiry gets an automatic reply within sixty seconds, carrying your credentials and proof before a human ever has to type a word. If they go quiet, up to three gentle reminders follow on a schedule you set, then the sequence hands the warm lead back to you. Research on lead response is consistent: replying in minutes rather than hours is one of the biggest levers on whether an inquiry ever converts, and it is the single change we see move the needle most.' ),
		array( 'broadcast', 'var(--g3)', 'OFFER 03', 'Growth', 'Marketing Automation',
			'you never run campaigns consistently.',
			'Seasonal offers, newsletters and win-back emails that trigger on a calendar instead of on your memory. We build the segmented sequences once, by interest, by past purchase, by quiet months, and they run every year without you touching them again. This is the layer that turns a contact list sitting idle in your inbox into a second revenue stream, especially during the months your industry goes quiet.' ),
		array( 'social', 'var(--g5)', 'OFFER 04', 'Growth', 'Social Media Automation',
			'posting is inconsistent and eats your time.',
			'An AI agent drafts on-brand posts from the content you already have, case results, guides, testimonials, and queues them across your channels on a steady cadence. You review and approve in minutes, not hours; nothing publishes without your sign-off. Comments and messages route back into the same pipeline as your website inquiries, so social stops being a separate, neglected job.' ),
		array( 'core', 'var(--cta)', 'OFFER 05', 'The full system', 'Full Transformation · AI + n8n',
			'you want the whole system, done for you.',
			'Every layer above, wired together on <a href="https://n8n.io" target="_blank" rel="noopener">n8n</a> into one connected system: website, visibility, lead automation, marketing and social, plus your inbox, CRM, calendar and invoicing talking to each other automatically. This is the option for owners who want to stop being the glue between five different tools. Live in four weeks, fully documented, fully yours at handover.' ),
	);
}

/**
 * Standalone service pages (cross-segment): Marketing &amp; Social Media Automation.
 * Each: label, title, hue, sub, article (~900 words), blocks[5 × ~100-word body], glabel.
 */
function anthropos_service_pages() {
	return array(
		'marketing-automation' => array(
			'label' => 'Marketing Automation',
			'title' => 'Marketing Automation',
			'hue'   => 'var(--g3)',
			'sub'   => 'You have an audience but never run campaigns consistently. We build the marketing engine, campaigns, newsletters, segmentation, win-backs and reporting, that runs <b>on schedule, without you</b>.',
			'article' => <<<'HTML'
<h2>Why "we'll send an email about that" never happens</h2>
<p>Almost every small business we meet already has an audience: past clients, newsletter subscribers, people who downloaded something once. Almost none of them have a system that reaches that audience on a schedule. The seasonal offer gets remembered in week three of the season, not week one. The win-back email to last year's quiet clients never gets written, because there's always something more urgent. The cost isn't abstract, it's the difference between a contact list that quietly decays and one that pays you every month.</p>
<h2>What marketing automation actually replaces</h2>
<p>Marketing automation is not "more social posts." It's the specific, unglamorous machinery of sending the right message at the right time without a human remembering to do it: a seasonal campaign that fires itself on January 1st, a newsletter nurture sequence that turns a curious reader into a buyer over ten days, and a segmentation layer that knows a retirement-focused reader shouldn't get the same email as someone asking about growth investments. None of this requires a marketing department, it requires the workflow built once, correctly, and left to run.</p>
<h2>The five moving parts</h2>
<ul>
<li><b>Campaign engine</b>, seasonal and launch campaigns that trigger on a calendar, not a memory.</li>
<li><b>Newsletter nurture</b>, a sequenced welcome and warm-up series that does the persuading before you ever get on a call.</li>
<li><b>Smart segmentation</b>, readers split by interest and behaviour, so every email feels written for one person.</li>
<li><b>Win-backs</b>, dormant leads and past clients woken up with a timed, personal nudge instead of a generic blast.</li>
<li><b>Attribution &amp; reporting</b>, a plain-language answer to "which campaign actually made money."</li>
</ul>
<h2>Built to be found, not just to send</h2>
<p>Every sequence we write is structured the same way answer engines and search crawlers prefer: a clear question in the subject or headline, a direct answer in the first two sentences, then the supporting detail. That habit, <a href="https://schema.org/FAQPage" target="_blank" rel="noopener">FAQPage-style structuring</a> applied to your own content, is also what makes your <a href="/blog/" rel="noopener">blog posts</a> and <a href="/guides/" rel="noopener">guides</a> more likely to get pulled into AI-generated answers when someone searches your specialty.</p>
<h2>What changes in the first quarter</h2>
<p>You stop losing the slow months. The campaign that used to depend on someone remembering to write it now exists permanently, improved once and left alone. If you run one of our <a href="/services/" rel="noopener">seven segment-specific services</a> already, marketing automation slots directly on top, the audience segmentation reuses the same contact data your lead automation already captures. If you're starting here, book a consultation and we'll map exactly which campaigns are worth automating first for your business.</p>
HTML,
			'blocks'=> array(
				array( 'broadcast', 'var(--g3)', '01', 'Campaign Engine', 'Seasonal and launch campaigns that trigger themselves on a fixed calendar instead of your memory. We map your business\'s natural cycle, the busy season, the quiet season, the annual offer, and write the sequence once. From then on, the right message reaches your list on the right date automatically, every year, whether or not you remembered it was coming.' ),
				array( 'dataflow', 'var(--flow)', '02', 'Newsletter Nurture', 'A sequenced welcome series that does the persuading before your first call. New subscribers receive value first, proof second, and an invitation last, spaced over ten days so it reads as generous, not pushy. By the time they reply, most of the objections you\'d normally handle live have already been answered in writing.' ),
				array( 'neural', 'var(--ai)', '03', 'Smart Segmentation', 'Not every reader wants the same email. We split your list by what they\'ve clicked, bought or asked about, so a retirement-focused subscriber and a growth-focused one get two different messages from the same campaign. Segmented sends routinely see far higher engagement than one-size-fits-all blasts, because the content finally matches the person reading it.' ),
				array( 'workflow', 'var(--g5)', '04', 'Win-backs &amp; Re-engagement', 'Every business has a list of people who went quiet, old leads, past clients, subscribers who stopped opening. We build a timed, personal-sounding sequence that reaches them after a set number of dormant days, with a reason to come back rather than a generic "we miss you." Small lists recovered this way often outperform new-lead spend.' ),
				array( 'growth', 'var(--g2)', '05', 'Attribution &amp; Reporting', 'You should never have to guess which campaign paid for itself. We wire simple, readable attribution into every sequence so a monthly report shows opens, clicks and, most importantly, which emails led to an actual booked call or sale, so future budget and time go toward what\'s already proven to work.' ),
			),
			'glabel'=> 'marketers',
			'guides'=> array(
				'Where marketers waste the most time',
				'The one metric that actually matters',
				'Seasonal campaigns that wake up on schedule',
				'What to automate first (and what to keep human)',
				'Segmenting a list without a data team',
				'The tools we wire together on n8n',
				'Common mistakes that kill open rates',
				'How to prove campaign ROI to yourself',
				'A 30-day marketing-automation rollout plan',
				'From manual sends to always-on campaigns',
			),
		),
		'social-media-automation' => array(
			'label' => 'Social Media Automation',
			'title' => 'Social Media Automation',
			'hue'   => 'var(--g5)',
			'sub'   => 'Posting is inconsistent and eats your time. An AI agent drafts on-brand content, schedules it across channels, repurposes your best ideas and routes engagement back to your pipeline, <b>you just approve</b>.',
			'article' => <<<'HTML'
<h2>Why "I'll post more consistently" never survives a busy month</h2>
<p>Social media is usually the first thing to slip when a small business gets busy, not because owners don't see its value, but because it competes directly with billable work, and billable work always wins. The result is a feed with a burst of activity, then silence for six weeks, then another burst. Followers notice the silence more than the bursts. The fix isn't posting more; it's removing yourself from the bottleneck of drafting, scheduling and remembering.</p>
<h2>How an AI agent actually helps here</h2>
<p>The agent's job is narrow and specific: turn the content you already produce, a guide, a client result, a short update, into on-brand posts for each channel, queue them on a steady cadence, and hand you a short approval step before anything goes live. It doesn't invent your voice; it drafts from your existing material and your prior approvals, so it gets closer to "sounds like you" every cycle rather than reading as generic AI copy.</p>
<h2>The five moving parts</h2>
<ul>
<li><b>AI content drafting</b>, posts generated from your ideas and existing content, reviewed and approved in minutes.</li>
<li><b>Cross-channel scheduling</b>, a steady, planned cadence across LinkedIn, Instagram and more, instead of feast-or-famine posting.</li>
<li><b>Repurposing engine</b>, one guide or case study becomes a month of channel-native posts.</li>
<li><b>Engagement routing</b>, comments and DMs captured and routed into your lead pipeline, not lost inside an app.</li>
<li><b>Analytics &amp; optimization</b>, a clear read on what actually lands, so the system doubles down on it.</li>
</ul>
<h2>Where this connects to the rest of your system</h2>
<p>Social automation is rarely the first thing worth building, it works best layered on top of a working <a href="/services/" rel="noopener">lead automation</a> foundation, so engagement on a post actually reaches your inbox as a qualified inquiry rather than disappearing into a comments section. If you're already running one of our segment services, this is an add-on; if not, we can scope it standalone. Either way it plugs into the same <a href="https://n8n.io" target="_blank" rel="noopener">n8n</a> workflows powering the rest of your automation.</p>
<h2>What changes in the first month</h2>
<p>Posting stops depending on whether this was a quiet week. Content that used to take an hour to plan, write and schedule becomes a five-minute approval. Read more in our <a href="/guides/" rel="noopener">guide library</a> on repurposing and content automation, or <a href="/faq/" rel="noopener">check the FAQ</a> for how approval and brand-voice control actually work day to day.</p>
HTML,
			'blocks'=> array(
				array( 'social', 'var(--g5)', '01', 'AI Content Drafting', 'The agent drafts on-brand posts directly from your existing content, a recent guide, a client win, a short update, rather than inventing generic filler. You review a short batch, approve or edit in minutes, and only approved posts ever go live. Over time it learns your voice from your edits, so drafts need less correction with every cycle.' ),
				array( 'calendar', 'var(--g4)', '02', 'Cross-channel Scheduling', 'Instead of a burst of posts followed by six weeks of silence, your content publishes on a steady, planned cadence across LinkedIn, Instagram and whichever channels matter to your business. The schedule is set once around your real capacity, so it\'s sustainable rather than another thing that quietly stops after a busy month.' ),
				array( 'ecosystem', 'var(--ai)', '03', 'Repurposing Engine', 'One long-form piece, a guide, a case study, an FAQ answer, becomes a dozen channel-native posts: a carousel, a short quote graphic, a one-line insight, a question. You write once; the system finds the month of content already sitting inside it, so your content output multiplies without multiplying your writing time.' ),
				array( 'workflow', 'var(--flow)', '04', 'Engagement Routing', 'A comment or DM asking about your services shouldn\'t depend on someone noticing it inside an app. We route meaningful engagement into the same pipeline as your website inquiries, so a social question gets the same fast, tracked follow-up as a form submission, instead of sitting unanswered for three days.' ),
				array( 'radar', 'var(--g2)', '05', 'Analytics &amp; Optimization', 'A simple, honest report on what actually lands: which post types get saves and shares, which topics drive profile visits, which posts led to an inquiry. No vanity-metric dashboards, just enough signal to know what to make more of, so your limited posting time goes toward content proven to work for your specific audience.' ),
			),
			'glabel'=> 'social media',
			'guides'=> array(
				'Why posting consistency always breaks first',
				'The one metric that actually matters on social',
				'Turning one guide into a month of content',
				'What to automate first (and what to keep human)',
				'Approval workflows that keep your brand voice',
				'The tools we wire together on n8n',
				'Common mistakes that make AI posts sound robotic',
				'How to prove social ROI to yourself',
				'A 30-day social-automation rollout plan',
				'From inconsistent posting to a steady cadence',
			),
		),
		'business-launch' => array(
			'label' => 'Business Launch',
			'title' => 'Business Launch',
			'hue'   => 'var(--g6)',
			'sub'   => 'You know exactly what business you want to build. You are just stuck at <b>"where do I even start?"</b> We launch it for you, company, website, bank and automation, as one finished thing you own, in the <b>US or UK</b>.',
			'article' => <<<'HTML'
<h2>You have the idea. You are stuck on "where do I even start?"</h2>
<p>You know exactly what business you want to build, the product, the customer, the reason it will work. But between that idea and your first paying customer sits a wall of things nobody ever teaches you: which company to register, in which country, how to get a business bank account that will not reject you, what website makes you look real, how to take a payment on day one. The drive is there. The map is not. And so the idea sits in a notebook for another six months.</p>
<h2>Where first-time founders quietly lose months</h2>
<p>The leak here is not a lack of effort, it is fragmentation. You end up juggling a company-formation agent who only files paperwork, a freelance web designer who does not understand your business, an accountant who speaks a different language, and a bank that keeps asking for one more document. None of them talk to each other, and you become the unpaid project manager of your own launch. Weeks turn into months. Some good businesses never open at all, not because the idea was weak, but because the launch was exhausting.</p>
<h2>The real problem: five separate jobs, and no one owns the whole thing</h2>
<p>Registering the company, building the website, opening the bank account, setting up invoicing, and getting your first leads are five different specialities. Hire five different people and the gaps between them become your problem, the website that does not match the registered name, the bank that will not open without a real address, the invoicing that is not ready when the first customer says yes. What a new founder actually needs is not five vendors. It is one team that owns the entire launch and hands back something finished.</p>
<h2>The fix: one team, one launch, everything wired together</h2>
<p>We run the whole launch as a single project. Here is the path we take you down.</p>
<figure class="diagram">
<svg viewBox="0 0 680 98" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="The launch path: from your idea, we register the company, build the website, set up the business bank and payments, connect operations and automation, and you open for business.">
<defs><marker id="arB" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6.5" markerHeight="6.5" orient="auto"><path d="M2 1 L8 5 L2 9" fill="none" stroke="#5FA8FF" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></marker></defs>
<g font-family="system-ui,sans-serif">
<rect x="6" y="26" width="96" height="46" rx="11" fill="rgba(95,168,255,.10)" stroke="#5FA8FF" stroke-width="1.3"/><text x="54" y="54" text-anchor="middle" fill="#EAF0FF" font-size="13" font-weight="600">Your idea</text>
<rect x="118" y="26" width="96" height="46" rx="11" fill="rgba(95,168,255,.10)" stroke="#5FA8FF" stroke-width="1.3"/><text x="166" y="54" text-anchor="middle" fill="#EAF0FF" font-size="13" font-weight="600">Register</text>
<rect x="230" y="26" width="96" height="46" rx="11" fill="rgba(95,168,255,.10)" stroke="#5FA8FF" stroke-width="1.3"/><text x="278" y="54" text-anchor="middle" fill="#EAF0FF" font-size="13" font-weight="600">Website</text>
<rect x="342" y="26" width="96" height="46" rx="11" fill="rgba(95,168,255,.10)" stroke="#5FA8FF" stroke-width="1.3"/><text x="390" y="54" text-anchor="middle" fill="#EAF0FF" font-size="13" font-weight="600">Bank</text>
<rect x="454" y="26" width="96" height="46" rx="11" fill="rgba(139,124,255,.10)" stroke="#8B7CFF" stroke-width="1.3"/><text x="502" y="54" text-anchor="middle" fill="#EAF0FF" font-size="13" font-weight="600">Automate</text>
<rect x="566" y="26" width="108" height="46" rx="11" fill="rgba(70,224,139,.12)" stroke="#46E08B" stroke-width="1.4"/><text x="620" y="54" text-anchor="middle" fill="#EAF0FF" font-size="13" font-weight="700">Open</text>
<line x1="102" y1="49" x2="116" y2="49" stroke="#5FA8FF" stroke-width="1.6" marker-end="url(#arB)"/>
<line x1="214" y1="49" x2="228" y2="49" stroke="#5FA8FF" stroke-width="1.6" marker-end="url(#arB)"/>
<line x1="326" y1="49" x2="340" y2="49" stroke="#5FA8FF" stroke-width="1.6" marker-end="url(#arB)"/>
<line x1="438" y1="49" x2="452" y2="49" stroke="#5FA8FF" stroke-width="1.6" marker-end="url(#arB)"/>
<line x1="550" y1="49" x2="564" y2="49" stroke="#5FA8FF" stroke-width="1.6" marker-end="url(#arB)"/>
</g>
</svg>
<figcaption>One team takes you from idea to open, and the business is already running when you get there.</figcaption>
</figure>
<p>We form the right company for you in the US or UK, build the website that makes you look established from day one, set up your business bank channel and payments so you can take money immediately, and connect your email, CRM and invoicing so nothing is held together with sticky notes. Then we do the part almost every launch service skips: we switch on the automation that captures and follows up your very first leads, before you have hired a single person. You do not open "a business." You open a business that is already working.</p>
<h2>Why us, and what you walk away with</h2>
<p>Plenty of people will register a company for you. Almost no one hands you a company that is registered, banked, online, compliant and automated, as one finished thing that is entirely yours. That is the whole point of this service, and it is built for founders launching in <b>America and the UK</b>. You keep every account and every asset; we simply do the hard, fragmented middle so you can start selling instead of project-managing. Explore the <a href="/guides/">launch guides</a>, read the <a href="/faq/">FAQ</a>, or book a free consultation and we will map your exact launch path in thirty minutes.</p>
HTML,
			'blocks'=> array(
				array( 'core', 'var(--g6)', '01', 'Company formation &amp; filing', 'We register the right company for you in the US or UK, the correct structure for your goals, not just the cheapest one to file. All the paperwork, the registered address, the filings and the compliance basics are handled and handed to you documented, so you are properly set up from the first day instead of fixing it later.' ),
				array( 'funnel', 'var(--g2)', '02', 'A website that looks established', 'A fast, modern website that makes a brand-new business look like it has been around for years, clear, credible, and built around the five-second test so a stranger trusts you immediately. Lead capture is wired in from day one, ready to feed the automation, so your site is a working tool and not just a brochure.' ),
				array( 'dataflow', 'var(--flow)', '03', 'Business bank &amp; payments', 'The step that stops most founders cold: we help you set up your business bank channel and payment tools so you can actually take money on launch day. No more applications rejected for a missing detail, the account, the invoicing and the payment links are ready before your first customer says yes.' ),
				array( 'workflow', 'var(--ai)', '04', 'Your operations, connected', 'Email, calendar, CRM and invoicing wired together on n8n so your new business runs as one system, not five disconnected apps you have to babysit. From the first enquiry to the first invoice, information flows on its own, which is what lets one founder operate like a small team.' ),
				array( 'growth', 'var(--g4)', '05', 'Automation from day one', 'The part almost every launch service skips. Before you have any staff, the system already answers new enquiries in seconds, qualifies them, and follows up so nothing is lost. You launch with the follow-up muscle of a much bigger company, which is exactly what a new business needs to win its first customers.' ),
			),
			'glabel'=> 'new founders',
			'guides'=> array(
				'Which company structure is right for you, US vs UK, in plain terms',
				'Getting a business bank account approved, without the rejections',
				'The launch-day website checklist for a brand-new business',
				'Company filing, step by step, what actually has to happen',
				'Looking established on day one, even as a team of one',
				'Setting up payments and invoicing before your first sale',
				'The automation a brand-new business should switch on first',
				'US or UK? Where to base your business, and why',
				'From idea to open in 30 days, a realistic launch plan',
				'The five people you would otherwise hire, and why one team is better',
			),
		),
	);
}

function anthropos_segments() {
	return array(
		'regulated-professionals' => array(
			'label' => 'Regulated Professionals',
			'title' => 'Automation Service for Regulated Professionals',
			'hue'   => 'var(--g1)',
			'sub'   => 'Lawyers, financial advisors &amp; tax consultants: referral-dependent, slow to follow up, invisible online. We install the website, visibility and <b>AI agents on n8n</b> that capture and nurture every inquiry, compliantly.',
			'article' => <<<'HTML'
<h2>Why do referral-dependent practices go quiet without warning?</h2>
<p>Solo lawyers, independent financial advisors and tax consultants share the same structural risk: when referrals are your only lead source, one slow quarter from your referral partners becomes one slow quarter for you, with no other door for new clients to walk through. We see this constantly across practice areas from family law to wealth management to seasonal tax work, and it isn't a marketing problem so much as a missing-system problem. A website from 2010 that no mobile visitor can read costs firms 30-50% of the prospects who searched online before ever calling. Add a slow or forgotten follow-up on top, and inquiries that should convert at 40-60% instead convert at 20-30%.</p>
<h2>What actually changes with a modern website</h2>
<p>The fix starts with a site built around what a stressed, deadline-driven client decides in the first five seconds: is this professional current, credible, and easy to reach? For lawyers that means clear practice-area pages and a case-evaluation form; for financial advisors it means a visible investment philosophy and transparent fee structure instead of vague reassurance; for tax consultants it means a site that explains savings, not just services, with a seasonal blog readers actually search for. All three share the same underlying architecture, credentials and proof above the fold, a lead-capture form that feeds directly into automation, and a Google Business Profile set up properly so <a href="https://www.google.com/business/" target="_blank" rel="noopener">local search</a> finally works in your favour.</p>
<h2>The automation layer that never sleeps</h2>
<p>The single biggest lever in this whole system is speed of first reply. A potential client contacting a regulated professional is almost always contacting two or three at once, the firm that responds within minutes, not hours, wins the psychological edge before a word of advice is ever given. We install an automatic confirmation within sixty seconds of every inquiry, carrying your credentials and testimonials, followed by up to three gentle reminders if the prospect goes quiet. After a consultation, a summary and next steps go out automatically. Inquiries from six months ago that never converted get a respectful win-back offer instead of being written off. None of this touches legal advice, financial recommendations, or anything requiring a professional judgment call in writing, the system handles the reassurance and logistics; you handle the expertise.</p>
<h2>Built to be found by search and by AI</h2>
<p>Every page we build follows a simple rule: answer the question a prospect is actually typing before they finish typing it. Practice-area pages open with the direct answer to "do I need a lawyer for X," styled so both Google and AI answer engines can extract it cleanly, the same <a href="https://schema.org/FAQPage" target="_blank" rel="noopener">structured FAQ approach</a> search engines already reward. Our <a href="/guides/" rel="noopener">guide library</a> goes deeper on each topic, and our <a href="/blog/" rel="noopener">blog</a> covers the seasonal and local-visibility questions your specific practice area gets asked most.</p>
<h2>What changes and what stays yours</h2>
<p>Firms running this system report a professional first impression that lifts conversion by roughly half, a 30-40% improvement in close rate purely from automated follow-up, and, for the first time, visibility into which channel actually produces clients instead of guessing where marketing budget should go. You own everything at handover: the website, the sequences, the reporting. If your world sounds more like one of our other six segments, <a href="/services/medical-professionals/" rel="noopener">medical</a>, <a href="/services/service-professionals/" rel="noopener">service-based</a>, or <a href="/services/" rel="noopener">the full list</a>, the same underlying system adapts to your pains instead. <a href="/faq/" rel="noopener">See the FAQ</a> for pricing and timeline, or book a free consultation and we'll map your specific leak in thirty minutes.</p>
HTML,
			'guides'=> array(
				'Why your referrals went quiet, and the system that replaces them',
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
			'sub'   => 'Doctors, dentists &amp; therapists: excellent in the room, invisible in search. We make you findable, trusted in five seconds, and every inquiry answered in sixty, while <b>booking and records stay entirely in your system</b>.',
			'article' => <<<'HTML'
<h2>Why is a half-empty waiting room so common among excellent practitioners?</h2>
<p>Clinical skill and online findability are two entirely different disciplines, and almost nobody trains for both. A doctor, dentist or therapist can be genuinely excellent in the room and still be invisible the moment a prospective patient searches "[specialty] near me", because that search is decided by Google Business Profile completeness, review volume, and a website that loads fast on a phone, none of which reflect clinical quality. The cost is not abstract: practices with an outdated or missing website lose 40-50% of prospective patients who searched online before ever calling, and low local visibility alone quietly costs a practice a steady stream of new patients every month, people who searched, did not find you, and booked with whoever they found instead.</p>
<h2>What we build, and the boundary we never cross</h2>
<p>The website layer is built around the three questions a nervous new patient answers in the first five seconds: is this practitioner qualified, do other patients like them, and how do I book. That means credential pages, visible testimonials and reviews, clear service descriptions, and a mobile-first build, since roughly 95% of these searches happen on a phone. We set up your <a href="https://www.google.com/business/" target="_blank" rel="noopener">Google Business Profile</a> properly and keep NAP details consistent sitewide, which is the single biggest lever for the local map pack. <b>The boundary matters as much as the build:</b> we provide the marketing website and new-patient lead generation only. We never touch patient portals, appointment booking systems, intake forms, patient records, or anything resembling a HIPAA-covered system, booking and clinical data stay entirely inside your existing practice software. Our job ends at the front door; the patient relationship is yours alone.</p>
<h2>The automation layer, built around trust</h2>
<p>Every new-patient inquiry is confirmed automatically within sixty seconds, carrying your credentials and testimonials and clear instructions on how to book through your own system. If someone doesn't follow up within five days, one respectful reminder goes out. After a visit, an automatic review request is the single highest-leverage action available, it typically adds 0.5 to 1.0 stars within months, which compounds directly into search ranking. Patients overdue for a checkup get a gentle, automatic win-back. None of this ever asks for or stores clinical information; it is purely the marketing and communication layer sitting in front of your practice.</p>
<h2>Findable by patients and by AI health searches</h2>
<p>We structure every service page and blog post to answer the exact question a patient types, styled so it can be extracted cleanly by both Google's featured snippets and AI answer engines, the same logic behind <a href="https://schema.org/FAQPage" target="_blank" rel="noopener">structured FAQ markup</a>. Our <a href="/guides/" rel="noopener">guide library</a> covers local visibility, review generation and trust-building in depth, and the <a href="/blog/" rel="noopener">blog</a> answers the specific questions your patient base is already searching.</p>
<h2>What changes</h2>
<p>Practices running this system typically see 20-40% more new patients within two quarters, a meaningfully higher inquiry-to-appointment rate once trust signals are visible, and measurably more five-star reviews driving better local ranking. If your work looks more like one of our other segments, <a href="/services/service-professionals/" rel="noopener">home services</a>, <a href="/services/regulated-professionals/" rel="noopener">regulated professionals</a>, or <a href="/services/" rel="noopener">the full list</a>, the same model adapts. Questions about the HIPAA boundary or timeline are answered in our <a href="/faq/" rel="noopener">FAQ</a>, or book a free, non-binding consultation and we'll show you exactly what your practice is currently losing to low visibility.</p>
HTML,
			'guides'=> array(
				'Why your waiting room is half-empty when you\'re excellent',
				'Local visibility for “[specialty] near me”',
				'Google Business Profile + reviews that lift ranking',
				'The 60-second reply to a new-patient inquiry',
				'Turning inquiries into booked appointments (booking stays yours)',
				'Trust in five seconds: what a nervous patient decides',
				'Review requests that add 0.5-1.0 stars',
				'Win-backs: “overdue for your checkup”',
				'The boundary: what we automate and never touch (no HIPAA)',
				'From word-of-mouth to a full schedule',
			),
		),
		'ecommerce-retail' => array(
			'label' => 'E-Commerce &amp; Retail',
			'title' => 'Automation Service for E-Commerce &amp; Retail',
			'hue'   => 'var(--g3)',
			'sub'   => 'Shopify &amp; multi-channel sellers: good traffic, vanishing carts, no repeat buyers. We recover carts, grow your list, and turn one-time orders into <b>lifetime value</b>, on autopilot.',
			'article' => <<<'HTML'
<h2>Why do 70-80% of ready-to-buy carts leave without a word?</h2>
<p>Most Shopify and multi-channel store owners we meet have solved traffic, visitors are arriving, but not the leak that happens right after: a shopper adds an item, gets distracted, and never comes back. That's not a pricing problem or a product problem; it's a follow-up problem, identical in shape to the one every other segment in this business faces, just measured in checkout percentage instead of consultations. Stores stuck at 1-2% checkout conversion are quietly losing a large share of the revenue their traffic already paid for. Add a slow site, 50% of mobile visitors bounce before a page loads in five-plus seconds, and the leak compounds before a customer even reaches the cart.</p>
<h2>The website layer: speed and trust, not a redesign for its own sake</h2>
<p>We start with the boring, high-leverage fixes: getting load time under three seconds, making checkout fewer steps with visible trust signals, and adding the social proof, reviews, ratings, clear shipping policy, that turns a first-time visitor into a first-time buyer. For sellers running multiple channels (Amazon, eBay, Shopify, TikTok Shop), we also build a single storefront that acts as the unified brand home all those channels point back to, with a lead magnet that captures an email address you actually own instead of renting attention from a marketplace.</p>
<h2>The automation layer: recovering carts, building lifetime value</h2>
<p>The highest-leverage single sequence in e-commerce is the abandoned-cart recovery: a reminder at six hours, one at twenty-four, and a final nudge with a small incentive at forty-eight. Stores running this consistently recover a meaningful share of the carts that were already halfway to a sale. Layered on top: a welcome sequence for new customers, a post-purchase flow that requests reviews and suggests a complementary product, and a sixty-day re-engagement email for anyone who's gone quiet. For multi-channel sellers specifically, we add a unified inbox across every platform, inventory sync alerts so you never oversell the same unit twice, and a weekly profitability report showing which channel is actually worth your time.</p>
<h2>Product pages built to be found and to be quoted</h2>
<p>We structure product and category pages to answer buyer questions directly and clearly, the same pattern that helps both traditional search and AI shopping assistants surface your store, following the logic behind <a href="https://schema.org/Product" target="_blank" rel="noopener">structured product data</a>. Our <a href="/guides/" rel="noopener">guide library</a> covers cart recovery copy, email-list growth and channel profitability in detail, and the <a href="/blog/" rel="noopener">blog</a> answers the specific operational questions sellers in your category search most.</p>
<h2>What changes</h2>
<p>Stores running this system recover a meaningful share of abandoned carts, see more repeat purchases, and, for multi-channel sellers, respond far faster to customers, with overselling eliminated entirely. If your business looks more like one of our other segments, <a href="/services/creators-coaches/" rel="noopener">creators</a>, <a href="/services/freelancers-agencies/" rel="noopener">freelancers</a>, or <a href="/services/" rel="noopener">the full list</a>, the same core system adapts. <a href="/faq/" rel="noopener">Read the FAQ</a> for scope and timeline, or book a free consultation and we'll show you exactly what your current cart-abandonment rate is costing you.</p>
HTML,
			'guides'=> array(
				'What cart abandonment really costs your store',
				'The 6h / 24h / 48h cart-recovery sequence, with copy',
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
			'sub'   => 'Home services, trainers &amp; consultants: booked one week, empty the next, missing calls while you work. We fill the calendar, confirm bookings, and <b>cut no-shows</b>, automatically.',
			'article' => <<<'HTML'
<h2>Why does a fully booked week get followed by an empty one?</h2>
<p>Electricians, plumbers, personal trainers and independent consultants share a structural problem that has nothing to do with the quality of their work: referrals plus occasional Google traffic is fundamentally unpredictable, and there's no system smoothing the gaps. A tradesperson under a sink can't answer the phone, so that lead calls the next name on the list. A trainer's class stays half-full because reminders are a manual text sent whenever there's a spare minute. A consultant's pipeline runs dry every few months because there's no automated nurture between "interested" and "signed." Each of these looks like a different problem; all three are the same missing layer.</p>
<h2>What the website layer fixes</h2>
<p>For home-service businesses, that means a site with a clear service area, a before/after gallery of completed jobs, visible licensing, and a booking form that feeds directly into automation, plus a properly configured <a href="https://www.google.com/business/" target="_blank" rel="noopener">Google Business Profile</a>, since "[service] near me" is how most of these jobs get found. For trainers, it means a site showing real client transformations and a clear path to book a free consultation. For consultants, it means case studies with measurable results instead of vague claims of expertise, the single biggest lever for justifying a higher fee.</p>
<h2>What the automation layer fixes</h2>
<p>Every inquiry is confirmed automatically with a quick quote and relevant testimonials; if a booking is left unconfirmed, a reminder follows. Once a job or session is booked, an automatic confirmation goes out with directions and, for trades, the technician's name and photo, a small detail that measurably cuts cancellations. After the job, an automatic invoice, review request and referral ask go out without you lifting a finger, and no-shows drop by up to 70% once confirmations and reminders are running consistently. For consultants specifically, we add a proposal follow-up sequence at day five, since roughly half of "lost" proposals were never actually rejected, they were simply never followed up.</p>
<h2>Built to be found by search and by AI assistants</h2>
<p>We write every service page to answer the specific question a local customer types before they even finish typing it, structured the way <a href="https://schema.org/LocalBusiness" target="_blank" rel="noopener">local business search</a> and AI answer engines both prefer. Our <a href="/guides/" rel="noopener">guide library</a> goes deeper on booking automation and local visibility, and the <a href="/blog/" rel="noopener">blog</a> covers the seasonal and operational questions your specific trade gets asked most.</p>
<h2>What changes</h2>
<p>Businesses running this system typically see 30-60% more new job inquiries, a 70% drop in no-shows, and, for consultants, a meaningfully shorter sales cycle once proposal follow-up runs automatically instead of depending on memory. If your work looks more like one of our other segments, <a href="/services/freelancers-agencies/" rel="noopener">freelancers</a>, <a href="/services/b2b-providers/" rel="noopener">B2B providers</a>, or <a href="/services/" rel="noopener">the full list</a>, the same underlying system adapts. <a href="/faq/" rel="noopener">See the FAQ</a> for scope and pricing, or book a free consultation and we'll map exactly where your calendar is leaking.</p>
HTML,
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
			'article' => <<<'HTML'
<h2>Why does a full inbox not mean a full pipeline?</h2>
<p>Freelance designers, developers and small agencies rarely have a lead-volume problem, inquiries usually keep coming. The problem is composition: roughly 70% of those inquiries are tire-kickers looking for free work or an impossible budget, which quietly eats hours every month better spent on billable work or genuine prospects. Meanwhile the good proposals, the ones actually worth chasing, die of silence, because a solo operator sending a proposal has no system reminding them to follow up five days later. Roughly half of all "lost" proposals were never rejected; they were simply never followed up.</p>
<h2>What the website layer fixes</h2>
<p>A portfolio's job is to pre-sell you before the first call, which means showing your best 10-15 projects with real case-study structure, the challenge, the decision, the measurable result, rather than a plain gallery. Small agencies additionally need a clear statement of who you work best with, since "we do everything for everyone" is precisely what makes a website forgettable. Every portfolio and case-study page we build ends in a pre-qualifying inquiry form, so budget mismatches surface before a call gets booked, not during it.</p>
<h2>What the automation layer fixes</h2>
<p>Every serious inquiry receives your portfolio, relevant case studies and testimonials automatically, along with a discovery-call booking link, tire-kickers self-select out simply because the form asks a real budget question upfront. After a discovery call, notes and a scoped proposal go out automatically; if that proposal sits unanswered for five days, a polite, non-desperate follow-up goes out on your behalf, which alone typically lifts proposal close rate by 35-50%. After a project ends, an automatic testimonial and referral request goes out, and past clients hear from you again with a "ready for more work?" nudge instead of falling silent forever.</p>
<h2>Positioned to be found, and to be trusted</h2>
<p>We write your case studies and services pages around outcome-first language rather than "we do X," which both converts better and matches how <a href="https://schema.org/CreativeWork" target="_blank" rel="noopener">structured portfolio content</a> gets surfaced by search and AI tools evaluating who to recommend. Our <a href="/guides/" rel="noopener">guide library</a> covers pre-qualification and proposal follow-up in depth, and the <a href="/blog/" rel="noopener">blog</a> answers the pricing and positioning questions freelancers in your field search most.</p>
<h2>What changes</h2>
<p>Freelancers and small agencies running this system typically see 50-80% more inbound inquiries with meaningfully better lead quality, a 35-50% lift in proposal close rate, and roughly half the time previously spent on unpaid admin. If your business looks more like one of our other segments, <a href="/services/creators-coaches/" rel="noopener">creators</a>, <a href="/services/b2b-providers/" rel="noopener">B2B providers</a>, or <a href="/services/" rel="noopener">the full list</a>, the same system adapts. <a href="/faq/" rel="noopener">Check the FAQ</a> for scope and pricing, or book a free consultation and we'll show you exactly where your pipeline is leaking time.</p>
HTML,
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
			'sub'   => 'Course creators &amp; newsletter writers: low landing conversion, students who drift, free readers who never pay. We lift conversion, completion and upgrades, with <b>sequences that feel human</b>.',
			'article' => <<<'HTML'
<h2>Why do launches spike and then flatten immediately?</h2>
<p>Course creators and newsletter writers face a specific version of the same leak every other segment in this business deals with: attention arrives, then quietly leaks away before it converts into revenue. A landing page pulling a thousand monthly visitors but converting only 10-20 of them into buyers is running at 1-2% when 5-10% is realistic with the right structure. Worse, of the students who do enroll, a large share complete only 40% of the course before disappearing, taking their potential reviews, referrals and future purchases with them. Newsletter writers see the mirror image: a healthy free list where only 2-3% ever upgrade to paid, because every reader gets the identical generic email regardless of what they actually came for.</p>
<h2>What the website layer fixes</h2>
<p>A course sales page needs to sell the outcome, not the curriculum, what will the buyer be able to do afterward, not how many modules exist. We rebuild landing pages around proof (real transformations, real reviews) and a clear lead magnet that captures an email before asking for a sale. For newsletters, the fix is a landing page and archive that states a specific angle clearly enough that a stranger knows in ten seconds whether this newsletter is for them, vague positioning is the single biggest reason free-to-paid conversion stays low.</p>
<h2>What the automation layer fixes</h2>
<p>A lead magnet triggers an immediate delivery plus a five-email welcome sequence over ten days that builds credibility and handles objections before a sales conversation ever happens. Once enrolled, students receive progress-based nurture, encouragement and a roadmap the moment they stall, which measurably lifts completion, because finished students are the ones who leave reviews and refer others. For newsletters, free readers get segmented by what they actually click, then a thirty-day upgrade sequence with real paid-subscriber testimonials does the persuading automatically, and inactive paid subscribers get a "here's what you're missing" nudge before they quietly churn.</p>
<h2>Content built to be found and to convert</h2>
<p>We structure your sales pages, FAQ and objection-handling content the way <a href="https://schema.org/FAQPage" target="_blank" rel="noopener">answer engines prefer to extract information</a>, so the exact question a hesitant buyer is searching gets answered directly. Our <a href="/guides/" rel="noopener">guide library</a> goes deeper on completion sequences and free-to-paid conversion, and the <a href="/blog/" rel="noopener">blog</a> covers the audience-growth questions creators in your niche search most.</p>
<h2>What changes</h2>
<p>Creators running this system typically see landing-page conversion lift by 50-150%, course completion improve 25-40%, and, for newsletter writers, free-to-paid conversion improve by 100-300% once segmentation and a proper upgrade sequence are running. If your work looks more like one of our other segments, <a href="/services/freelancers-agencies/" rel="noopener">freelancers</a>, <a href="/services/ecommerce-retail/" rel="noopener">e-commerce</a>, or <a href="/services/" rel="noopener">the full list</a>, the same system adapts. <a href="/faq/" rel="noopener">Read the FAQ</a> for scope and timeline, or book a free consultation and we'll map exactly where your funnel is leaking.</p>
HTML,
			'guides'=> array(
				'Why students drift away at lesson four',
				'Landing pages that convert at 5-10%, not 1-2%',
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
			'sub'   => 'SaaS implementation &amp; training providers: six-month cycles, price pressure, hard to differentiate. Case-study-led positioning + <b>AI follow-up that keeps every deal warm</b>, automatically.',
			'article' => <<<'HTML'
<h2>Why does "I implement Salesforce" invite a price war?</h2>
<p>SaaS implementation consultants and training providers face a specific structural disadvantage: the service itself sounds commoditized the moment it's described generically, because a thousand other consultants can say the same sentence. That single positioning failure, "I implement X" instead of a specific, provable outcome, is what invites prospects to compare purely on price and haggle margins down 20-30%. Layer on a genuinely long B2B sales cycle of three to six months with no automated nurture in between, and it's easy to see why inconsistent project flow feels permanent rather than fixable.</p>
<h2>What the website layer fixes</h2>
<p>The fix is specificity: an expertise page stating exactly which tools you implement and how many times, case studies naming company size, timeline and measurable impact rather than vague success stories, and visible certifications or partnerships that procurement teams actually check before shortlisting a vendor. This is also where <a href="https://schema.org/FAQPage" target="_blank" rel="noopener">structured, specific content</a> pays off twice, it reads as more credible to a human evaluator and it's more likely to be the answer an AI research assistant surfaces when a buyer asks it to shortlist implementation partners.</p>
<h2>What the automation layer fixes</h2>
<p>Every inquiry receives your case studies, testimonials and a clear implementation roadmap automatically, with a strategy-call booking link attached. If that call isn't booked, a reminder follows with one additional case study rather than a generic nudge. After the call, notes and a proposed timeline go out automatically; if the proposal sits unanswered, a day-five follow-up handles the exact moment most B2B deals quietly die, not from rejection, but from nobody following up. During implementation, regular transparent progress updates build the trust that turns a one-off project into a referral source, and once the engagement ends, an automatic request for a testimonial or case-study permission compounds your proof library for the next prospect.</p>
<h2>Mapped onto real workflow stages</h2>
<p>We map your specific six-month cycle into concrete stages inside <a href="https://n8n.io" target="_blank" rel="noopener">n8n</a>, inquiry, strategy call, proposal, implementation, delivery, upsell, so nothing depends on memory at any single stage. Our <a href="/guides/" rel="noopener">guide library</a> covers stakeholder routing and case-study structure in depth, and the <a href="/blog/" rel="noopener">blog</a> answers the positioning and pipeline questions B2B providers in your space search most.</p>
<h2>What changes</h2>
<p>B2B providers running this system typically see 50-80% more inbound inquiries, a 20-30% shorter sales cycle once nurture and follow-up run automatically, and a meaningfully higher average project fee once case-study-led positioning replaces generic service descriptions. If your work looks more like one of our other segments, <a href="/services/freelancers-agencies/" rel="noopener">freelancers</a>, <a href="/services/service-professionals/" rel="noopener">service-based professionals</a>, or <a href="/services/" rel="noopener">the full list</a>, the same system adapts. <a href="/faq/" rel="noopener">See the FAQ</a> for scope and pricing, or book a free consultation and we'll map exactly where your pipeline is stalling.</p>
HTML,
			'guides'=> array(
				'Escaping the “I implement X, so do 1,000 others” trap',
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
