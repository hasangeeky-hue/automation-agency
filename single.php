<?php
/**
 * Single story/guide with reading progress and interlink footer.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
while ( have_posts() ) : the_post();
	$cats = get_the_category();
	$cat_class = $cats ? 'cat-' . $cats[0]->slug : '';
?>
<div class="aa-progress-wrap"><div class="aa-progress" id="aaProgress"></div></div>
<article <?php post_class( 'aa-article ' . $cat_class ); ?>>
	<div class="crumb">
		<?php if ( $cats ) : ?>
		<a href="<?php echo esc_url( get_category_link( $cats[0] ) ); ?>"><?php echo esc_html( $cats[0]->name ); ?></a> ·
		<?php endif; ?>
		<?php echo esc_html( get_the_date() ); ?>
	</div>
	<h1><?php the_title(); ?></h1>
	<div class="aa-byline">
		<span class="aa-ava" aria-hidden="true"></span>
		<span><b><?php the_author(); ?></b> · <?php esc_html_e( 'Anthropos Automation', 'anthropos' ); ?><br>
		<?php esc_html_e( 'Reviewed', 'anthropos' ); ?> <?php echo esc_html( get_the_modified_date() ); ?></span>
	</div>
	<div class="aa-content"><?php the_content(); ?></div>
</article>
<nav class="aa-navlinks" aria-label="<?php esc_attr_e( 'Related reading', 'anthropos' ); ?>">
	<?php
	$prev = get_previous_post( true );
	$next = get_next_post( true );
	if ( $prev ) {
		echo '<a href="' . esc_url( get_permalink( $prev ) ) . '"><span>' . esc_html__( 'Previous in this series', 'anthropos' ) . '</span>' . esc_html( get_the_title( $prev ) ) . '</a>';
	}
	if ( $next ) {
		echo '<a href="' . esc_url( get_permalink( $next ) ) . '"><span>' . esc_html__( 'Next in this series', 'anthropos' ) . '</span>' . esc_html( get_the_title( $next ) ) . '</a>';
	}
	?>
</nav>
<?php endwhile; get_footer(); ?>
