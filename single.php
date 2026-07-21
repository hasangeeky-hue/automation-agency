<?php
/**
 * Single post / guide (v7) — service-page-style layout: 3D cover, the article
 * rendered as alternating blocks (each with its own 3D visual), reading time,
 * related guides, contextual service link, prev/next, CTA.
 * Reader-guide classes usable in content: .qa, .hl.hl-do/.hl-stat/.hl-res/.hl-warn.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$segs = function_exists( 'anthropos_segments' ) ? anthropos_segments() : array();
?>
<div class="progress-wrap"><div class="progress" id="progress"></div></div>
<?php
while ( have_posts() ) : the_post();
	$cats = get_the_category();
	$tags = get_the_tags();
	$cat  = $cats ? $cats[0] : null;
	$hue  = ( $cat && isset( $segs[ $cat->slug ] ) ) ? $segs[ $cat->slug ]['hue'] : 'var(--flow)';

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

	// Split the article into blocks: intro (before first H2), then one per H2 section.
	$raw   = get_the_content();
	$html  = apply_filters( 'the_content', $raw );
	$parts = preg_split( '/(?=<h2)/i', $html );
	$blocks = array();
	$intro  = trim( $parts[0] );
	if ( '' !== $intro ) { $blocks[] = array( 't' => 'The short version', 'b' => $intro ); }
	for ( $i = 1; $i < count( $parts ); $i++ ) {
		if ( preg_match( '/^<h2[^>]*>(.*?)<\/h2>(.*)$/is', $parts[ $i ], $m ) ) {
			$blocks[] = array( 't' => trim( wp_strip_all_tags( $m[1] ) ), 'b' => trim( $m[2] ) );
		} else {
			$blocks[] = array( 't' => '', 'b' => trim( $parts[ $i ] ) );
		}
	}
	$mins = max( 1, (int) round( str_word_count( wp_strip_all_tags( $raw ) ) / 200 ) );

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
	$bfx = array( 'radar', 'dataflow', 'workflow', 'growth', 'broadcast', 'funnel', 'holo', 'pulse', 'neural', 'core' );
	?>
<script type="application/ld+json"><?php echo wp_json_encode( array(
	'@context'         => 'https://schema.org',
	'@type'            => 'Article',
	'headline'         => get_the_title(),
	'description'      => function_exists( 'anthropos_meta_description' ) ? anthropos_meta_description( get_the_ID() ) : '',
	'datePublished'    => get_the_date( 'c' ),
	'dateModified'     => get_the_modified_date( 'c' ),
	'author'           => array( '@type' => 'Organization', 'name' => get_bloginfo( 'name' ) ),
	'publisher'        => array( '@type' => 'Organization', 'name' => get_bloginfo( 'name' ) ),
	'mainEntityOfPage' => get_permalink(),
) ); ?></script>
<?php
// Breadcrumb structured data (SEO).
$crumbs = array( array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ) );
$cpos = 2;
if ( $cat ) { $crumbs[] = array( '@type' => 'ListItem', 'position' => $cpos, 'name' => $cat->name, 'item' => $svc_url ); $cpos++; }
$crumbs[] = array( '@type' => 'ListItem', 'position' => $cpos, 'name' => wp_strip_all_tags( get_the_title() ), 'item' => get_permalink() );
echo '<script type="application/ld+json">' . wp_json_encode( array( '@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $crumbs ) ) . '</script>';

// FAQ / Q&A structured data from the question-headed sections (AEO / GEO).
$faq_items = array();
foreach ( $blocks as $bl ) {
	$q = trim( $bl['t'] );
	if ( '' === $q || 'The short version' === $q ) { continue; }
	if ( preg_match( '/^(what|who|how|why|when|which|do |does |is |are |can |should )/i', $q ) || '?' === substr( $q, -1 ) ) {
		$a = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $bl['b'] ) ) );
		if ( '' !== $a ) {
			$faq_items[] = array( '@type' => 'Question', 'name' => $q, 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $a ) );
		}
	}
}
if ( count( $faq_items ) >= 2 ) {
	echo '<script type="application/ld+json">' . wp_json_encode( array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $faq_items ) ) . '</script>';
}
?>
<div class="wrap" style="padding-top:34px;padding-bottom:66px">
	<div class="art art-head">
		<div class="art-cover">
			<canvas class="fx" data-net data-nodes="42" data-pulses="30" data-z="18" aria-hidden="true"></canvas>
			<span class="acv-tag"><?php echo esc_html( $ptype_label . ( $cat ? ' · ' . $cat->name : '' ) ); ?></span>
		</div>
		<div class="crumb" style="margin-top:18px">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> /
			<?php if ( $cat ) : ?><a href="<?php echo esc_url( $svc_url ); ?>"><?php echo esc_html( $cat->name ); ?></a> / <?php endif; ?>
			<?php echo esc_html( get_the_date() ); ?> · <?php echo (int) $mins; ?> min read
		</div>
		<h1><?php the_title(); ?></h1>
		<div class="byline"><span class="ava">A</span><span><b>Anthropos Automation</b> · Editorial team<br>Reviewed <?php echo esc_html( get_the_modified_date() ); ?> · <?php echo esc_html( $cat ? $cat->name : $ptype_label ); ?></span></div>
	</div>

	<?php if ( $blocks ) : ?>
	<article class="aart" style="--hue:<?php echo esc_attr( $hue ); ?>">
		<?php foreach ( $blocks as $bi => $bl ) :
			$is_lead = ( 'The short version' === $bl['t'] );
			$dgm     = ( function_exists( 'anthropos_match_section' ) && '' !== $bl['t'] && ! $is_lead )
				? anthropos_section_diagram( anthropos_match_section( $bl['t'] ), $hue ) : '';
			?>
			<?php if ( $is_lead ) : ?>
				<div class="aart-lead aa-content"><?php echo $bl['b']; // phpcs:ignore WordPress.Security.EscapeOutput -- post content ?></div>
			<?php else : ?>
				<section class="asec reveal">
					<?php if ( '' !== $bl['t'] ) : ?><h2><?php echo esc_html( $bl['t'] ); ?></h2><?php endif; ?>
					<?php echo $dgm; // phpcs:ignore WordPress.Security.EscapeOutput -- trusted static SVG ?>
					<div class="aa-content"><?php echo $bl['b']; // phpcs:ignore WordPress.Security.EscapeOutput -- post content ?></div>
				</section>
			<?php endif; ?>
		<?php endforeach; ?>
	</article>
	<?php else : ?>
	<div class="art art-head"><div class="aa-content"><?php echo $html; // phpcs:ignore ?></div></div>
	<?php endif; ?>

	<div class="art art-foot">
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

		<div class="art-cta">
			<h3>Want this working in your <?php echo esc_html( $cat ? $cat->name : 'business' ); ?>?</h3>
			<p>Book a free, no-obligation consultation — answer a few quick questions and we map exactly where you are losing clients, then show you the fix.</p>
			<div class="art-cta-row">
				<button type="button" class="btn btn-cta" data-open-consult>Book a free consultation →</button>
				<a class="btn btn-glass" href="<?php echo esc_url( $svc_url ); ?>">See the full system for <?php echo esc_html( $svc_label ); ?> →</a>
			</div>
		</div>
	</div>
</div>
<?php endwhile; anthropos_faq_section(); get_footer(); ?>
