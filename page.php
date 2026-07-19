<?php
/**
 * Generic page (v3).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
while ( have_posts() ) : the_post();
?>
<main class="aa-page">
	<h1><?php the_title(); ?></h1>
	<div class="aa-content"><?php the_content(); ?></div>
</main>
<?php endwhile; get_footer(); ?>
