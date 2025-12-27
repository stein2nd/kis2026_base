<?php
/**
 * Template Name: 採用に関するお問い合わせ
 *
 */
	get_header();
    remove_filter('the_content', 'wpautop');
?>
<div class="pageContent">
	<div class="fixedWidth spPad breadcrumb">
		<?php breadcrumb($post); ?>
	</div>
	<div>
		<div class="pageTitle fixedWidth">
			<p class="string">採用情報</p>
			<?php if( get_field('en_title', $post->ID) ) : ?>
				<small><?php the_field('en_title', $post->ID); ?></small>
			<?php endif; ?>
		</div>
		<?php
			while ( have_posts() ) : the_post();
				the_content();
			endwhile;
		?>
	</div>
</div>
<?php
get_footer();
