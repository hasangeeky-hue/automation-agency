<?php
/**
 * Blog index / archive (v4) — featured + filters + post grid with automation objects.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$fx = array( 'mesh', 'branch', 'pipeline', 'agent', 'hub', 'core' );
$hu = array( 'var(--ai)', 'var(--flow)', 'var(--g2)', 'var(--g5)', 'var(--g3)', 'var(--g6)' );
?>
<div class="wrap band reveal">
	<div class="eyebrow">Blog · field notes on AI automation</div>
	<h2><?php if ( is_category() || is_archive() ) { the_archive_title(); } else { esc_html_e( 'Automation, in plain language', 'anthropos' ); } ?></h2>
	<p class="soft"><?php esc_html_e( 'Playbooks on AI agents, n8n workflows, web design and answer-engine visibility — for people who run the business.', 'anthropos' ); ?></p>
</div>

<?php
$cats = get_categories( array( 'hide_empty' => true, 'number' => 6 ) );
if ( $cats ) : ?>
<div class="wrap"><div class="filters">
	<a class="fbtn on" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>">All</a>
	<?php $ci = 0; foreach ( $cats as $c ) { echo '<a class="fbtn" style="--hue:' . esc_attr( $hu[ $ci % 6 ] ) . '" href="' . esc_url( get_category_link( $c ) ) . '">' . esc_html( $c->name ) . '</a>'; $ci++; } ?>
</div></div>
<?php endif; ?>

<div class="wrap" style="padding-bottom:20px">
	<div class="grid-3" style="margin-top:26px">
		<?php if ( have_posts() ) : $i = 0;
			while ( have_posts() ) : the_post(); $c = get_the_category(); ?>
			<a class="glass post reveal tilt" href="<?php the_permalink(); ?>" style="--hue:<?php echo esc_attr( $hu[ $i % 6 ] ); ?>"><canvas class="fxcanvas" data-fx="<?php echo esc_attr( $fx[ $i % 6 ] ); ?>" style="--hue:<?php echo esc_attr( $hu[ $i % 6 ] ); ?>"></canvas><div class="post-b"><span class="pc"><?php echo $c ? esc_html( $c[0]->name ) : 'Insights'; ?></span><h4><?php the_title(); ?></h4><p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p><span class="pr">Read →</span></div></a>
			<?php $i++; endwhile;
		else : ?>
			<p style="color:var(--muted)"><?php esc_html_e( 'No posts yet — write your first field note.', 'anthropos' ); ?></p>
		<?php endif; ?>
	</div>
	<div style="margin-top:30px"><?php the_posts_pagination(); ?></div>
</div>
<?php get_footer(); ?>
