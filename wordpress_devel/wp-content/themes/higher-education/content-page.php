<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Higher_Education
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * higher_education_before_page_container hook
	 *
	 * @hooked higher_education_single_content_image - 10
	 */
	do_action( 'higher_education_before_page_container' ); ?>
	<div class="entry-container">
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>

			<p class="entry-meta">
				<?php edit_post_link( esc_html__( 'Edit', 'higher-education' ), '<span class="edit-link">', '</span>' ); ?>
			</p><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links"><span class="pages">' . esc_html__( 'Pages:', 'higher-education' ) . '</span>',
					'after'  => '</div>',
					'link_before' 	=> '<span>',
                    'link_after'   	=> '</span>',
				) );
			?>
		</div><!-- .entry-content -->
	</div><!-- .entry-container -->
</article><!-- #post-## -->