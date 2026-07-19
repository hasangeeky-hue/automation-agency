<?php
/**
 * Single post / guide (v5) — article with 3D cover, reading progress,
 * reader-guide styles, and contextual internal linking (related guides in the
 * same segment, the specific parent service page, and prev/next).
 * Reader-guide classes usable in content: .qa, .hl.hl-do/.hl-stat/.hl-res/.hl-warn.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<div class="progress-wrap"><div class="progress" id="progress"></div></div>
<?php
while ( have_posts() ) : the_post();
	$cats = get_the_category();
	$tags = get_the_tags();
	$cat  = $cats ? $cats[0] : null;

	// Resolve the specific parent service page for this article.
	$svc_url = ''; $svc_label = '';
	if ( $cat ) {
		$svc_url   = home_url( '/services/' . $cat->slug . '/' );
		$svc_label = $cat->name;
	} elseif ( $tags ) {
		foreach ( $tags as $t ) {
			if ( 'mkt' === $t->slug ) { $svc_url = home_url( '/marketing-automation/' ); $svc_label = 'Marketing Automation'; break; }
			if ( 'soc' === $t->slug ) { $svc_url = home_url( '/social-media-automation/' ); $svc_label = 'Social Media Automation'; break; }
		}
	}
	if ( ! $svc_url ) { $svc_url = home_url( '/services/' ); $svc_label = 'our services'; }

	// Related guides — other posts in the same segment (falls back to recent).
	$related_args = array(
		'post_type'           => 'post',
		'posts_per_page'      => 3,
		'post__not_in'        => array( get_the_ID() ),
		'ignore_sticky_posts' => true,
		'orderby'             => 'rand',
	);
	if ( $cat ) { $related_args['category__in'] = array( $cat->term_id ); }
	$related = get_posts( $related_args );

	$prev = get_previous_post();
	$next = get_next_post();
	$ptype = get_the_terms( get_the_ID(), 'ao_type' );
	$ptype_label = ( $ptype && ! is_wp_error( $ptype ) ) ? ucfirst( $ptype[0]->slug ) : 'Guide';
	?>
<script type="application/ld+json"><?php echo wp_json_encode( array(
	'@context'         => 'https://schema.org',
	'@type'            => 'Article',
	'headline'         => get_the_title(),
	'datePublished'    => get_the_date( 'c' ),
	'dateModified'     => get_the_modified_date( 'c' ),
	'author'           => array( '@type' => 'Organization', 'name' => get_bloginfo( 'name' ) ),
	'publisher'        => array( '@type' => 'Organization', 'name' => get_bloginfo( 'name' ) ),
	'mainEntityOfPage' => get_permalink(),
) ); ?></script>
<div class="wrap-sm" style="padding-top:34px;padding-bottom:70px">
	<article class="art">
		<div class="art-cover">
			<canvas class="fx" data-net data-nodes="42" data-pulses="30" data-z="18" aria-hidden="true"></canvas>
			<span class="acv-tag"><?php echo esc_html( $ptype_label . ( $cat ? ' · ' . $cat->name : '' ) ); ?></span>
		</div>
		<div class="crumb" style="margin-top:18px">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> /
			<?php if ( $cat ) : ?><a href="<?php echo esc_url( $svc_url ); ?>"><?php echo esc_html( $cat->name ); ?></a> / <?php endif; ?>
			<?php echo esc_html( get_the_date() ); ?>
		</div>
		<h1><?php the_title(); ?></h1>
		<div class="byline"><span class="ava">A</span><span><b><?php the_author(); ?></b> · Anthropos Automation<br>Reviewed <?php echo esc_html( get_the_modified_date() ); ?> · <?php echo esc_html( $cat ? $cat->name : $ptype_label ); ?></span></div>
		<div class="aa-content" style="margin-top:22px;color:var(--muted)"><?php the_content(); ?></div>

		<?php if ( $related ) : ?>
		<div class="related">
			<div class="glh">Related guides <?php echo $cat ? 'for ' . esc_html( $cat->name ) : ''; ?></div>
			<div class="rel-grid">
				<?php foreach ( $related as $r ) :
					$rc = get_the_category( $r->ID ); ?>
					<a class="rel-card" href="<?php echo esc_url( get_permalink( $r ) ); ?>">
						<span class="rc-k"><?php echo esc_html( $rc ? $rc[0]->name : 'Guide' ); ?></span>
						<h6><?php echo esc_html( get_the_title( $r ) ); ?></h6>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>

		<div class="glinks">
			<div class="glh">Where this sits</div>
			<div class="gl-row">
				<a class="gl" href="<?php echo esc_url( $svc_url ); ?>"><b>Your service page</b>Automation Service for <?php echo esc_html( $svc_label ); ?> — see the full system</a>
				<a class="gl" href="<?php echo esc_url( home_url( '/guides/' ) ); ?>"><b>The guide library</b>Every guide, filterable by business &amp; service</a>
			</div>
		</div>

		<?php if ( $prev || $next ) : ?>
		<div class="prevnext">
			<?php if ( $prev ) : ?><a href="<?php echo esc_url( get_permalink( $prev ) ); ?>"><span class="pn-k">← Previous</span><?php echo esc_html( get_the_title( $prev ) ); ?></a><?php else : ?><span></span><?php endif; ?>
			<?php if ( $next ) : ?><a class="nx" href="<?php echo esc_url( get_permalink( $next ) ); ?>"><span class="pn-k">Next →</span><?php echo esc_html( get_the_title( $next ) ); ?></a><?php else : ?><span></span><?php endif; ?>
		</div>
		<?php endif; ?>

		<div style="margin-top:26px;text-align:center">
			<a class="btn btn-cta" href="<?php echo esc_url( $svc_url ); ?>">See how we build this for you →</a>
		</div>
	</article>
</div>
<?php endwhile; anthropos_faq_section(); get_footer(); ?>
