<?php
/**
 * Blog index / archive (v3) — glass post cards with automation objects.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<section>
	<div class="wrap band">
		<div class="eyebrow"><?php esc_html_e( 'Blog · field notes', 'anthropos' ); ?></div>
		<h2><?php if ( is_category() || is_archive() ) { the_archive_title(); } else { esc_html_e( 'AI automation for small business', 'anthropos' ); } ?></h2>
	</div>
	<div class="wrap" style="padding-bottom:70px">
		<div class="blog">
			<?php if ( have_posts() ) :
				$fx = array( 'mesh', 'branch', 'pipeline', 'hub', 'agent', 'core' );
				$hu = array( 'var(--ai)', 'var(--flow)', 'var(--g2)', 'var(--cta)', 'var(--g6)', 'var(--g4)' ); $i = 0;
				while ( have_posts() ) : the_post(); $cat = get_the_category(); ?>
				<a class="glass post" href="<?php the_permalink(); ?>"><canvas class="fxcanvas" data-fx="<?php echo esc_attr( $fx[ $i % 6 ] ); ?>" style="--hue:<?php echo esc_attr( $hu[ $i % 6 ] ); ?>"></canvas><div class="post-b"><span class="pc"><?php echo $cat ? esc_html( $cat[0]->name ) : esc_html__( 'Insights', 'anthropos' ); ?></span><h4><?php the_title(); ?></h4><p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p><span class="pr">Read →</span></div></a>
				<?php $i++; endwhile;
			else : ?>
				<p style="color:var(--muted)"><?php esc_html_e( 'No posts yet — write your first field note.', 'anthropos' ); ?></p>
			<?php endif; ?>
		</div>
		<div style="margin-top:26px"><?php the_posts_pagination(); ?></div>
	</div>
</section>
<?php get_footer(); ?>
