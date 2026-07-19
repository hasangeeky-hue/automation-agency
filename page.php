<?php
/**
 * Generic page (v4).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
while ( have_posts() ) : the_post();
?>
<div class="wrap-sm" style="padding-top:44px;padding-bottom:70px">
	<article class="art">
		<h1><?php the_title(); ?></h1>
		<div class="aa-content" style="margin-top:20px;color:var(--muted)"><?php the_content(); ?></div>
	</article>
</div>
<?php endwhile; get_footer(); ?>
