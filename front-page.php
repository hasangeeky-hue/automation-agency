<?php
/**
 * Front page: hero + journey + latest stories + guide series.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$audit = get_page_by_path( 'free-audit' );
$audit_url = $audit ? get_permalink( $audit ) : home_url( '/free-audit/' );
$blog_url = get_permalink( get_option( 'page_for_posts' ) );
if ( ! $blog_url ) { $blog_url = home_url( '/stories/' ); }
?>
<section class="aa-hero">
	<canvas id="aaRiver" aria-hidden="true"></canvas>
	<div class="aa-hero-in">
		<div class="aa-eyebrow"><?php esc_html_e( 'Anthropos · read your story · find your fix', 'anthropos' ); ?></div>
		<h1><?php esc_html_e( 'Somewhere below is a story that sounds exactly like your week.', 'anthropos' ); ?></h1>
		<p class="aa-whisper"><?php esc_html_e( 'Start there. It will name the leak, show what it costs, and hand you the guide that closes it.', 'anthropos' ); ?> <b><?php esc_html_e( 'Read free, fix free — or ask us to build it in 4 weeks.', 'anthropos' ); ?></b></p>
		<div class="aa-hero-ctas">
			<a class="aa-btn" href="<?php echo esc_url( $blog_url ); ?>"><?php esc_html_e( 'Find my story', 'anthropos' ); ?></a>
			<a class="aa-btn aa-btn-ghost-l" href="<?php echo esc_url( $audit_url ); ?>"><?php esc_html_e( 'Get Free Website Audit', 'anthropos' ); ?></a>
		</div>
		<div class="aa-stats">
			<div><strong>30–100%</strong><?php esc_html_e( 'more leads, by profession', 'anthropos' ); ?></div>
			<div><strong>30–50%</strong><?php esc_html_e( 'better conversion via automation + proof', 'anthropos' ); ?></div>
			<div><strong>10–20 h</strong><?php esc_html_e( 'saved weekly — no manual follow-up', 'anthropos' ); ?></div>
			<div><strong>€2k–20k</strong><?php esc_html_e( 'more monthly revenue in 6–12 months', 'anthropos' ); ?></div>
		</div>
	</div>
</section>

<div class="aa-journey">
	<div class="aa-j"><div class="k">STEP 1 · READ</div><h3><?php esc_html_e( 'You recognise yourself', 'anthropos' ); ?></h3><p><?php esc_html_e( 'A short story about someone with your job and your quiet frustration. “That’s me” is the whole point.', 'anthropos' ); ?></p></div>
	<div class="aa-j"><div class="k">STEP 2 · IDENTIFY</div><h3><?php esc_html_e( 'The guide names the leak', 'anthropos' ); ?></h3><p><?php esc_html_e( 'Research-grade guides name the exact problem, what it costs monthly, and the fix — step by step.', 'anthropos' ); ?></p></div>
	<div class="aa-j"><div class="k">STEP 3 · CONVERT</div><h3><?php esc_html_e( 'Fix it — or have it built', 'anthropos' ); ?></h3><p><?php esc_html_e( 'Do it yourself with the checklist, or take the free 12-point audit and we build the system in 4 weeks.', 'anthropos' ); ?></p></div>
</div>

<section>
	<div class="aa-wrap aa-band">
		<div class="aa-eyebrow"><?php esc_html_e( 'The blog · stories first', 'anthropos' ); ?></div>
		<h2><?php esc_html_e( 'Every story is a mirror. Find yours.', 'anthropos' ); ?></h2>
	</div>
	<div class="aa-wrap">
		<div class="aa-stories">
			<?php
			$q = new WP_Query( array( 'posts_per_page' => 6, 'ignore_sticky_posts' => true ) );
			while ( $q->have_posts() ) : $q->the_post();
				$cats = get_the_category();
			?>
			<article class="<?php echo anthropos_story_classes( get_the_ID() ); ?>">
				<div class="aa-story-band"></div>
				<div class="aa-story-in">
					<?php if ( $cats ) : ?><span class="cat"><?php echo esc_html( $cats[0]->name ); ?></span><?php endif; ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="ex"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></div>
					<a class="more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Does this sound like you? →', 'anthropos' ); ?></a>
				</div>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>

<section>
	<div class="aa-wrap aa-band">
		<div class="aa-eyebrow"><?php esc_html_e( 'The guide library', 'anthropos' ); ?></div>
		<h2><?php esc_html_e( 'Four series, twenty guides per profession', 'anthropos' ); ?></h2>
		<p class="aa-soft"><?php esc_html_e( 'Get Found → Earn Trust → Never Lose a Lead → Grow Calmly. Sixteen professions, twenty guides each — every guide linked to its story, its series, and its siblings.', 'anthropos' ); ?></p>
		<?php $guides = get_page_by_path( 'guides' ); if ( $guides ) : ?>
		<p style="margin-top:18px"><a class="aa-btn aa-btn-ghost" href="<?php echo esc_url( get_permalink( $guides ) ); ?>"><?php esc_html_e( 'Browse the Guide Library', 'anthropos' ); ?></a></p>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
