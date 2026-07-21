<?php
/**
 * Content batch 14 — SERVICE professionals (trades, home services, studios),
 * new 7-section pattern (v5.37+). Pains: missed calls on the job, quote
 * follow-up, booking reminders / no-shows, reviews & repeat work. Prose only;
 * template supplies diagrams, CTA and structured internal links.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function anthropos_seed_posts_batch14() {
	return array(

	/* ===== SERVICE #1 — MISSED CALLS ON THE JOB ===== */
	array(
		'title' => 'Hands full, phone ringing: how tradespeople stop losing jobs to missed calls',
		'slug'  => 'guide-service-missed-calls-onsite',
		'cat'   => 'service-professionals', 'tags' => array( 'lead' ), 'type' => 'guide',
		'content' => <<<'HTML'
<div class="qa"><p>When you are under a sink or up a ladder, you cannot answer the phone &mdash; and the person calling for a plumber, electrician or cleaner just rings the next name on the list. For a hands-on trade, the missed call is the single biggest leak. Here is how to catch every one without stopping work.</p></div>
<h2>What is the problem?</h2>
<p>Your best jobs come by phone, and they come while you are already working. You cannot take the call, the caller does not leave a message, and they book the first tradesperson who picks up. You only notice hours later, if at all &mdash; by which point the job is gone.</p>
<h2>Who this touches, day to day</h2>
<p>The <b>owner-operator</b> is the business and the phone line at once, and cannot be both on the tools and on a call. A <b>partner or spouse</b> often fields calls informally and inconsistently. Any <b>office help</b> is part-time at best. The <b>customer</b> with a burst pipe or a dead socket needs an answer now, not tomorrow.</p>
<h2>How it drains productivity and drives up cost</h2>
<p>Every missed call is a booked job that went to a competitor, and for a one-van business a handful a week is a serious slice of income. Stopping work to call people back costs you time on the current job; not calling back costs you the next one. It is a lose-lose that quietly caps how much you can earn.</p>
<h2>What AI can do about it</h2>
<p>An assistant answers the second you cannot &mdash; texting the caller straight back in your name, asking what they need and where, offering your next available slot, and booking it. You get a tidy message with the job details when you down tools. It never pretends to quote a complex job; it captures the lead so you can call back warm, or shows up already booked.</p>
<h2>How it actually works</h2>
<p>A missed call is the <b>trigger</b>. The system <b>texts</b> the caller instantly &mdash; "Sorry I missed you, I am on a job; what do you need and when?" &mdash; <b>captures</b> their answers and location, offers a slot, and books or flags it for you. Every ring becomes a lead in your pocket instead of a lost job you never knew about.</p>
<h2>How we can help</h2>
<p>We set this up on your own mobile number and calendar &mdash; part of our <a href="/services/service-professionals/">automation service for home-service and trade businesses</a> &mdash; and hand it over simple and yours, no lock-in and nothing new to learn. We write the messages in your voice so it sounds like you, not a robot.</p>
<h2>How we do it, step by step</h2>
<ul><li><b>Map</b> &mdash; how many calls you miss in a typical week.</li><li><b>Build</b> &mdash; the instant missed-call text-back and booking flow.</li><li><b>Connect</b> &mdash; to your phone and calendar, tested end to end.</li><li><b>Live</b> &mdash; catching every call, and yours.</li></ul>
<p>Usually live in about a week. See also: <a href="/blog-service-missed-calls-onsite/">the job that rang while you were under the sink</a>.</p>
HTML
	),
	array(
		'title' => 'The job that rang while you were under the sink',
		'slug'  => 'blog-service-missed-calls-onsite',
		'cat'   => 'service-professionals', 'tags' => array( 'lead' ), 'type' => 'blog',
		'content' => <<<'HTML'
<div class="qa"><p>For a hands-on trade, the phone always rings at the worst moment &mdash; and the caller does not wait, they ring the next number. You will never see those lost jobs. A simple instant text-back catches them without you stopping work.</p></div>
<h2>What is the problem?</h2>
<p>Your best jobs come by phone while you are already busy. You cannot answer, no message is left, and the caller books whoever picks up. You find out too late, if ever.</p>
<h2>Who this touches, day to day</h2>
<p>You are the business and the phone line at once. A partner fields calls inconsistently; office help is part-time. The customer with an emergency needs an answer now.</p>
<h2>How it drains productivity and drives up cost</h2>
<p>Each missed call is a job lost to a competitor &mdash; and for a one-van business, a few a week is real money. Stopping to call back costs the current job; not calling back costs the next. It quietly caps your income.</p>
<h2>What AI can do about it</h2>
<p>An assistant texts the caller back the instant you cannot, asks what they need and where, offers your next slot and books it &mdash; then hands you the details when you down tools. The lead is captured, not lost.</p>
<h2>How it actually works</h2>
<p>A missed call triggers an instant, friendly text in your name, captures the job and location, offers a time, and books or flags it. Every ring becomes a lead in your pocket.</p>
<h2>How we can help</h2>
<p>We set it up on your own mobile and calendar and hand it over simple and yours, as part of our <a href="/services/service-professionals/">automation service for home-service and trade businesses</a> &mdash; written in your voice.</p>
<h2>How we do it, step by step</h2>
<p>We map how many calls you miss, build the text-back-and-book flow, connect it to your phone and calendar, and switch it on once tested. Usually live in about a week. Full detail: <a href="/guide-service-missed-calls-onsite/">how tradespeople stop losing jobs to missed calls</a>.</p>
HTML
	),

	/* ===== SERVICE #2 — QUOTE FOLLOW-UP ===== */
	array(
		'title' => 'The quote you never chased: winning more jobs from the estimates you send',
		'slug'  => 'guide-service-quote-follow-up',
		'cat'   => 'service-professionals', 'tags' => array( 'lead' ), 'type' => 'guide',
		'content' => <<<'HTML'
<div class="qa"><p>You visit, you quote, and then&hellip; silence. Not because the customer said no &mdash; because nobody followed up and they got busy. A couple of friendly, automatic nudges turn a real share of unanswered quotes into booked jobs. Here is how.</p></div>
<h2>What is the problem?</h2>
<p>You spend time visiting the site and writing the estimate, send it over, and hear nothing. The customer meant to reply, then forgot, or was waiting to compare. Without a follow-up, the quote just sits there and the job goes to whoever stayed in touch &mdash; often not the best quote, just the most present one.</p>
<h2>Who this touches, day to day</h2>
<p>The <b>owner</b> writes quotes in the evening and has no time to chase them by day. There is rarely anyone whose job is follow-up. The <b>customer</b> genuinely intended to book but needed a small reminder. Warm, ready work quietly goes cold for want of a nudge.</p>
<h2>How it drains productivity and drives up cost</h2>
<p>Quoting is unpaid work &mdash; the site visit, the measuring, the pricing. When a quote goes unanswered, all of that effort is wasted, and you had already done the hardest part of winning the job. Chasing every estimate by hand is impossible when you are on the tools all day, so most simply never get chased.</p>
<h2>What AI can do about it</h2>
<p>An automated follow-up sends a friendly check-in a day or two after your quote, then a gentle final nudge, each easy to reply to &mdash; and stops the moment the customer books or says no. It keeps you in the running without you having to remember, and it never changes your prices or terms; it just makes sure the quote is not forgotten.</p>
<h2>How it actually works</h2>
<p>Sending a quote is the <b>trigger</b>. The system <b>waits</b> a set time, then <b>sends</b> a short reminder &mdash; "Just checking you got my quote; happy to answer any questions" &mdash; followed by one soft final message if needed, stopping instantly when they reply. Warm jobs stop slipping away by accident.</p>
<h2>How we can help</h2>
<p>We build the follow-up on your own phone and email &mdash; part of our <a href="/services/service-professionals/">automation service for home-service and trade businesses</a> &mdash; and hand it over yours, no lock-in. We write the messages with you so they sound like you and stay friendly, never pushy.</p>
<h2>How we do it, step by step</h2>
<ul><li><b>Map</b> &mdash; how many quotes go unanswered now.</li><li><b>Build</b> &mdash; the timed, friendly follow-up sequence.</li><li><b>Connect</b> &mdash; to how you send quotes today, tested.</li><li><b>Live</b> &mdash; chasing every quote for you, and yours.</li></ul>
<p>Usually live in about a week. See also: <a href="/blog-service-quote-follow-up/">most quotes are not rejected, just forgotten</a>.</p>
HTML
	),
	array(
		'title' => 'Most quotes are not rejected, just forgotten',
		'slug'  => 'blog-service-quote-follow-up',
		'cat'   => 'service-professionals', 'tags' => array( 'lead' ), 'type' => 'blog',
		'content' => <<<'HTML'
<div class="qa"><p>The estimate you sent last week probably was not turned down &mdash; it was just never chased, and the customer got busy. One friendly reminder wins a lot of those jobs back, and it can send itself.</p></div>
<h2>What is the problem?</h2>
<p>You visit, quote, and hear nothing. The customer meant to reply and forgot, or was comparing. Without follow-up the quote sits idle and the job goes to whoever stayed in touch.</p>
<h2>Who this touches, day to day</h2>
<p>You write quotes at night and cannot chase them by day. Nobody owns follow-up. The customer just needed a nudge. Ready work goes cold for want of it.</p>
<h2>How it drains productivity and drives up cost</h2>
<p>Quoting is unpaid effort &mdash; the visit, the pricing. An unanswered quote wastes all of it, after you had done the hard part. And chasing by hand never happens when you are on the tools.</p>
<h2>What AI can do about it</h2>
<p>An automated nudge checks in a day or two after your quote, then once more, and stops the second they book or decline. It keeps you in the running without you remembering, and never touches your prices.</p>
<h2>How it actually works</h2>
<p>Sending a quote triggers a short reminder after a set delay, then a soft final message if needed &mdash; stopping when they reply. Warm jobs stop slipping away.</p>
<h2>How we can help</h2>
<p>We build it on your own phone and email and hand it over yours, as part of our <a href="/services/service-professionals/">automation service for home-service and trade businesses</a> &mdash; written to sound like you.</p>
<h2>How we do it, step by step</h2>
<p>We map how many quotes go quiet, build the follow-up, connect it to how you quote today, and switch it on once tested. Usually live in about a week. Full detail: <a href="/guide-service-quote-follow-up/">winning more jobs from the estimates you send</a>.</p>
HTML
	),

	/* ===== SERVICE #3 — BOOKING REMINDERS / NO-SHOWS ===== */
	array(
		'title' => 'Fewer no-shows, fuller diary: automatic booking reminders for service businesses',
		'slug'  => 'guide-service-booking-reminders',
		'cat'   => 'service-professionals', 'tags' => array( 'lead' ), 'type' => 'guide',
		'content' => <<<'HTML'
<div class="qa"><p>Whether you run a salon chair, a studio or a mobile trade, a no-show is a slot you cannot resell &mdash; wasted time you have already set aside. Most are simple forgetfulness. Automatic reminders and easy rescheduling keep your day full without the phone-tag.</p></div>
<h2>What is the problem?</h2>
<p>Customers book, then forget, clash, or cannot make it and have no easy way to tell you &mdash; so they just do not show. You are left with an empty hour you cannot fill at short notice, and a waiting list of people who would have taken it if only they had been asked.</p>
<h2>Who this touches, day to day</h2>
<p>The <b>owner</b> or <b>stylist/technician</b> loses paid time that cannot be recovered. Whoever manages the <b>diary</b> spends time ringing reminders and scrambling to fill gaps. The <b>customer</b> feels bad but simply forgot and had no one-tap way to move it.</p>
<h2>How it drains productivity and drives up cost</h2>
<p>Empty slots are pure lost income against time you have already committed. Manual reminder calls eat the hours you could spend serving customers, and last-minute gaps stay empty because there is no time to work the waitlist. Even a few no-shows a week add up to a meaningful dent in the month.</p>
<h2>What AI can do about it</h2>
<p>AI sends friendly reminders by text at the right times, lets customers confirm or reschedule with one tap, and offers freed-up slots to your waiting list automatically. It keeps your diary full and cuts the reminder phone-tag, running quietly in the background while you work.</p>
<h2>How it actually works</h2>
<p>A booking is the <b>trigger</b>. The system <b>schedules</b> reminders with confirm and reschedule links, and if someone cancels it <b>offers</b> the slot to waitlisted customers and rebooks the first to accept &mdash; then updates your calendar. Fewer gaps, far less chasing.</p>
<h2>How we can help</h2>
<p>We build the reminder-and-waitlist flow on your existing booking system &mdash; part of our <a href="/services/service-professionals/">automation service for home-service and trade businesses</a> &mdash; and hand it over yours, no lock-in. We set the timing and tone with you so it feels friendly and on-brand.</p>
<h2>How we do it, step by step</h2>
<ul><li><b>Map</b> &mdash; your no-show rate and where reminders fall down.</li><li><b>Build</b> &mdash; the reminder, one-tap reschedule and waitlist-fill flow.</li><li><b>Connect</b> &mdash; to your booking tool, tested end to end.</li><li><b>Live</b> &mdash; protecting your diary, and yours.</li></ul>
<p>Usually live in one to two weeks. See also: <a href="/blog-service-booking-reminders/">the empty slot you set aside and could not resell</a>.</p>
HTML
	),
	array(
		'title' => 'The empty slot you set aside and could not resell',
		'slug'  => 'blog-service-booking-reminders',
		'cat'   => 'service-professionals', 'tags' => array( 'lead' ), 'type' => 'blog',
		'content' => <<<'HTML'
<div class="qa"><p>A no-show is time you already committed and can never sell again. Most are just forgetfulness plus a rescheduling process that is too much hassle. Fix those and your diary stays full.</p></div>
<h2>What is the problem?</h2>
<p>Customers book, then forget or clash and have no easy way to tell you, so they do not show. You lose the hour, while a waiting list would gladly have taken it.</p>
<h2>Who this touches, day to day</h2>
<p>You lose unrecoverable paid time. Whoever runs the diary burns time on reminders and filling gaps. The customer simply forgot and had no easy way to rebook.</p>
<h2>How it drains productivity and drives up cost</h2>
<p>Empty slots are lost income against committed time. Manual reminders eat serving hours, and gaps stay empty with no time to work the waitlist. A few a week dents the month.</p>
<h2>What AI can do about it</h2>
<p>AI sends timely text reminders, lets customers confirm or move in one tap, and offers cancelled slots to your waiting list automatically &mdash; keeping the diary full with no phone-tag.</p>
<h2>How it actually works</h2>
<p>A booking triggers reminders with confirm and reschedule links; a cancellation offers the slot to the waitlist and rebooks the first to accept, then updates your calendar. Gaps close themselves.</p>
<h2>How we can help</h2>
<p>We build it on your booking system and hand it over yours, as part of our <a href="/services/service-professionals/">automation service for home-service and trade businesses</a> &mdash; tuned with you to feel friendly.</p>
<h2>How we do it, step by step</h2>
<p>We map your no-show pattern, build the reminder-and-waitlist flow, connect it to your booking tool, and switch it on once tested. Usually live in one to two weeks. Full detail: <a href="/guide-service-booking-reminders/">automatic booking reminders for service businesses</a>.</p>
HTML
	),

	/* ===== SERVICE #4 — REVIEWS & REPEAT ===== */
	array(
		'title' => 'More reviews, more repeat work: the follow-up service businesses skip',
		'slug'  => 'guide-service-reviews-repeat',
		'cat'   => 'service-professionals', 'tags' => array( 'mkt' ), 'type' => 'guide',
		'content' => <<<'HTML'
<div class="qa"><p>For a local service business, online reviews are how new customers choose you, and past customers are your easiest next job. Yet the after-the-job follow-up &mdash; asking for a review, staying in touch &mdash; almost never happens because you are on to the next call. Automating it compounds quietly over time.</p></div>
<h2>What is the problem?</h2>
<p>You finish a job, the customer is happy, and then nothing. You do not ask for the review that would win your next ten customers, and you do not check back when it is time for the service again. A happy customer who would gladly have left five stars and rebooked simply drifts, because no one followed up.</p>
<h2>Who this touches, day to day</h2>
<p>The <b>owner</b> knows reviews and repeat work matter but is always on to the next job. There is no one whose role is follow-up. The <b>customer</b> was delighted and would have left a review or rebooked in a heartbeat &mdash; if asked at the right moment.</p>
<h2>How it drains productivity and drives up cost</h2>
<p>Thin reviews mean you lose new customers to competitors with a stronger reputation, forcing you to spend more on advertising to compete. And every past customer who is never re-engaged is repeat work handed to someone else. Both are cheap wins left on the table simply because the follow-up never gets sent.</p>
<h2>What AI can do about it</h2>
<p>An automated flow sends a friendly review request at the perfect moment &mdash; just after a completed job &mdash; with a one-tap link to your review page, and later a gentle "time for a service again?" reminder. It builds your reputation and your repeat business in the background, without you having to remember or ask awkwardly.</p>
<h2>How it actually works</h2>
<p>A completed job is the <b>trigger</b>. The system <b>sends</b> a thank-you and a one-tap review request while the job is fresh, then <b>schedules</b> a re-engagement message when the customer is likely due again &mdash; each easy to act on. Your reviews grow and past customers come back, automatically.</p>
<h2>How we can help</h2>
<p>We build the review-and-repeat flow on your own tools and review profiles &mdash; part of our <a href="/services/service-professionals/">automation service for home-service and trade businesses</a> &mdash; and hand it over yours, no lock-in. We write the messages with you so they feel personal and genuine, never spammy.</p>
<h2>How we do it, step by step</h2>
<ul><li><b>Map</b> &mdash; your current review flow and repeat cycle.</li><li><b>Build</b> &mdash; the post-job review request and re-engagement flow.</li><li><b>Connect</b> &mdash; to your review profile and contacts, tested.</li><li><b>Live</b> &mdash; growing reputation and repeat work, and yours.</li></ul>
<p>Usually live in about a week. See also: <a href="/blog-service-reviews-repeat/">the five-star review you never asked for</a>.</p>
HTML
	),
	array(
		'title' => 'The five-star review you never asked for',
		'slug'  => 'blog-service-reviews-repeat',
		'cat'   => 'service-professionals', 'tags' => array( 'mkt' ), 'type' => 'blog',
		'content' => <<<'HTML'
<div class="qa"><p>Your happiest customers would leave a glowing review and book you again &mdash; if you asked at the right moment. Most service businesses never do, because they are on to the next job. Automating that one follow-up compounds quietly into reputation and repeat work.</p></div>
<h2>What is the problem?</h2>
<p>You finish a job, the customer is happy, and then silence. No review request, no check-back when the service is due again. A delighted customer just drifts, unasked.</p>
<h2>Who this touches, day to day</h2>
<p>You know reviews and repeat work matter but are always on the next job. No one owns follow-up. The customer would have left five stars and rebooked &mdash; if asked at the right time.</p>
<h2>How it drains productivity and drives up cost</h2>
<p>Thin reviews lose you new customers and push up your ad costs. Every un-re-engaged past customer is repeat work handed to a rival. Both are cheap wins left on the table.</p>
<h2>What AI can do about it</h2>
<p>An automated flow sends a friendly review request just after the job, with a one-tap link, then a gentle "time again?" reminder later &mdash; building reputation and repeat business without you having to ask awkwardly.</p>
<h2>How it actually works</h2>
<p>A completed job triggers a thank-you and one-tap review request while it is fresh, then a re-engagement message when the customer is likely due &mdash; each easy to act on. Reviews grow and customers return, automatically.</p>
<h2>How we can help</h2>
<p>We build it on your own tools and review profiles and hand it over yours, as part of our <a href="/services/service-professionals/">automation service for home-service and trade businesses</a> &mdash; written to feel personal.</p>
<h2>How we do it, step by step</h2>
<p>We map your review and repeat cycle, build the post-job flow, connect it to your review profile and contacts, and switch it on once tested. Usually live in about a week. Full detail: <a href="/guide-service-reviews-repeat/">the follow-up service businesses skip</a>.</p>
HTML
	),

	);
}
