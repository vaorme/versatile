<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php
while ( have_posts() ) : the_post();
	?>

	<main <?php post_class( 'main' ); ?>>
		<?php if ( apply_filters( 'versatile_page_title', true ) ) : ?>
			<header class="page-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>
		<?php endif; ?>
		<div class="contenido-pagina">
			<?php the_content(); ?>
			<div class="post-tags">
				<?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'versatile' ), null, '</span>' ); ?>
			</div>
			<?php wp_link_pages(); ?>
		</div>

		<?php comments_template(); ?>
	</main>

	<?php
endwhile;