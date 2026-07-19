<?php
/**
 * Blog index / archives: the story hub.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$hex = anthropos_group_hex();
$current = is_category() ? get_queried_object()->slug : '';
?>
<section>
	<div class="aa-wrap aa-band">
		<div class="aa-eyebrow"><?php esc_html_e( 'The blog · stories first', 'anthropos' ); ?></div>
		<h2><?php
			if ( is_category() ) {
				single_cat_title();
			} else {
				esc_html_e( 'Every story is a mirror. Find yours.', 'anthropos' );
			}
		?></h2>
		<p class="aa-soft"><?php esc_html_e( 'Seven colors, seven kinds of quiet frustration. Each story ends with one question — does this sound like you? — and the guides that answer it.', 'anthropos' ); ?></p>
		<div class="aa-filters">
			<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="<?php echo $current ? '' : 'on'; ?>"><?php esc_html_e( 'All stories', 'anthropos' ); ?></a>
			<?php foreach ( anthropos_groups() as $slug => $label ) :
				$cat = get_category_by_slug( $slug );
				if ( ! $cat ) { continue; }
				$hue = isset( $hex[ $slug ] ) ? $hex[ $slug ] : '#E8A34C';
			?>
			<a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" style="--hue:<?php echo esc_attr( $hue ); ?>" class="<?php echo ( $current === $slug ) ? 'on' : ''; ?>"><?php echo esc_html( $label ); ?></a>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="aa-wrap" style="padding-bottom:70px">
		<div class="aa-stories">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				$cats = get_the_category();
			?>
			<article class="<?php echo anthropos_story_classes( get_the_ID() ); ?>">
				<div class="aa-story-band"></div>
				<div class="aa-story-in">
					<?php if ( $cats ) : ?><span class="cat"><?php echo esc_html( $cats[0]->name ); ?></span><?php endif; ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="ex"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 26 ) ); ?></div>
					<a class="more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Does this sound like you? →', 'anthropos' ); ?></a>
				</div>
			</article>
			<?php endwhile; else : ?>
			<p><?php esc_html_e( 'No stories yet — import the content package or write the first one.', 'anthropos' ); ?></p>
			<?php endif; ?>
		</div>
		<div style="margin-top:26px"><?php the_posts_pagination(); ?></div>
	</div>
</section>
<?php get_footer(); ?>
