<?php
/**
 * Single post / guide (v4) — article with reading progress + reader-guide styles.
 * Authors can use these classes in content: aa-hl aa-do / aa-stat / aa-res / aa-warn, and .qa.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<div class="progress-wrap"><div class="progress" id="progress"></div></div>
<?php while ( have_posts() ) : the_post(); $cats = get_the_category(); ?>
<div class="wrap-sm" style="padding-top:44px;padding-bottom:70px">
	<article class="art">
		<div class="crumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> /
			<?php if ( $cats ) : ?><a href="<?php echo esc_url( get_category_link( $cats[0] ) ); ?>"><?php echo esc_html( $cats[0]->name ); ?></a> / <?php endif; ?>
			<?php echo esc_html( get_the_date() ); ?>
		</div>
		<h1><?php the_title(); ?></h1>
		<div class="byline"><span class="ava"></span><span><b><?php the_author(); ?></b> · Anthropos Automation<br>Reviewed <?php echo esc_html( get_the_modified_date() ); ?> · <?php echo esc_html( get_the_category() ? get_the_category()[0]->name : 'Guide' ); ?></span></div>
		<div class="aa-content" style="margin-top:22px;color:var(--muted)"><?php the_content(); ?></div>
		<div class="glinks">
			<div class="glh">Where this sits — internal links</div>
			<div class="gl-row">
				<a class="gl" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><b>Up one level</b>Your automation service page</a>
				<a class="gl" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><b>Related reading</b>More field notes on the blog</a>
			</div>
		</div>
	</article>
</div>
<?php endwhile; anthropos_faq_section(); get_footer(); ?>
