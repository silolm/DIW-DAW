<?php
/**
 * The Template for displaying all single posts
 *
 * @package Higher_Education
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php
					/**
					 * higher_education_after_post hook
					 *
					 * @hooked higher_education_post_navigation - 10
					 */
					do_action( 'higher_education_after_post' );

					/**
					 * higher_education_comment_section hook
					 *
					 * @hooked higher_education_get_comment_section - 10
					 */
					do_action( 'higher_education_comment_section' );
				?>
			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>