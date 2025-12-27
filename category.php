<?php get_header(); ?>
<div class="col">
	<div class="main">
		<?php if ( have_posts() ) : ?>
		<header>
			<h1 class="archive-title"><?php printf( __( 'カテゴリーアーカイブ: %s' ), single_cat_title( '', false ) ); ?></h1>
			<?php
				$term_description = term_description();
				if ( ! empty( $term_description ) ) :
					printf( '<div class="taxonomy-description">%s</div>', $term_description );
				endif;
			?>
		</header>
		<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;
				twentyfourteen_paging_nav();
			else :
				get_template_part( 'content', 'none' );
			endif;
		?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
