<?php
/**
 * Generic page template (profession pages, hubs, What We Do, etc.).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
while ( have_posts() ) : the_post();
?>
<main class="aa-page">
	<?php if ( ! is_front_page() ) : ?><h1><?php the_title(); ?></h1><?php endif; ?>
	<div class="aa-content"><?php the_content(); ?></div>
</main>
<?php endwhile; get_footer(); ?>
