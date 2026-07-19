<?php
/**
 * Single post / guide (v3) — reading progress + reader-guide styles.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
while ( have_posts() ) : the_post();
	$cats = get_the_category();
?>
<div class="aa-progress-wrap"><div class="aa-progress" id="aaProgress"></div></div>
<article <?php post_class( 'aa-article' ); ?>>
	<div class="crumb">
		<?php if ( $cats ) : ?><a href="<?php echo esc_url( get_category_link( $cats[0] ) ); ?>"><?php echo esc_html( $cats[0]->name ); ?></a> · <?php endif; ?>
		<?php echo esc_html( get_the_date() ); ?>
	</div>
	<h1><?php the_title(); ?></h1>
	<div class="aa-content"><?php the_content(); ?></div>
</article>
<nav class="wrap" style="padding-bottom:60px;display:grid;grid-template-columns:1fr 1fr;gap:10px" aria-label="<?php esc_attr_e( 'Related', 'anthropos' ); ?>">
	<?php
	$prev = get_previous_post(); $next = get_next_post();
	if ( $prev ) { echo '<a class="glass" style="padding:14px 16px;font-size:13px" href="' . esc_url( get_permalink( $prev ) ) . '">← ' . esc_html( get_the_title( $prev ) ) . '</a>'; }
	if ( $next ) { echo '<a class="glass" style="padding:14px 16px;font-size:13px;text-align:right" href="' . esc_url( get_permalink( $next ) ) . '">' . esc_html( get_the_title( $next ) ) . ' →</a>'; }
	?>
</nav>
<?php endwhile; get_footer(); ?>
