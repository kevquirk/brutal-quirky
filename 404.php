<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

	<div <?php generate_do_attr( 'content' ); ?>>
		<main <?php generate_do_attr( 'main' ); ?>>
			<h1>Page not found! 🫤</h1>
			<p><b>It looks like nothing was found at this location. Sorry about that.</b></p>
			
			<p>From time to time I will delete the odd post from this site. Problem is, I can't delete the corresponding post from the Fediverse, so that's why you might have ended up visiting a bloken link. Sorry about that.</p>

			<a class="brutal-shadow" href="/">← Back to homepage</a>
		</main>
	</div>

	<?php
	/**
	 * generate_after_primary_content_area hook.
	 *
	 * @since 2.0
	 */
	do_action( 'generate_after_primary_content_area' );

	generate_construct_sidebars();

	get_footer();