<?php
/**
 * Template Name: タイトルなし
 *
 */
	get_header();
    remove_filter('the_content', 'wpautop');
?>
<div class="pageContent pageContent--noTitle">
	<div class="fixedWidth spPad breadcrumb breadcrumb--inNoneTitlePage">
		<?php breadcrumb($post); ?>
	</div>
	<div>
		<header class="screen-reader-text">
			<h1 class="string"><?php the_title(); ?></h1>
			<?php if( get_field('en_title', $post->ID) ) : ?>
				<small><?php the_field('en_title', $post->ID); ?></small>
			<?php endif; ?>
		</header>

		<?php
			while ( have_posts() ) : the_post();
				the_content();
			endwhile;
		?>
	</div>
</div>
<?php
get_footer();
