<?php
	get_header();
    remove_filter('the_content', 'wpautop');
?>
<div class="pageContent spPad">
	<div class="fixedWidth breadcrumb">
		<span class="item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a></span>　&gt;　<span class="item"><span>導入事例</span></span>
	</div>
	<main class="fixedWidth">
		<header class="pageTitle">
			<h1 class="string">導入事例</h1>
			<small>CASE STUDY</small>
		</header>

		<div class="flex compoArticleItems">
		<?php
			while ( have_posts() ) : the_post();
		?>
			<section class="flex__item item">
				<a href="<?php the_permalink(); ?>">
					<?php if( get_field('case_logo', $post->ID) ) : ?>
						<div class="item__logo"><img src="<?php echo $url = get_field('case_logo')['url']; ?>" alt=""></div>
					<?php endif; ?>
					<div class="item__photo">
						<?php if ( has_post_thumbnail() ) :
								$image_id = get_post_thumbnail_id();
								$image_url = wp_get_attachment_image_src($image_id, true);
						?><div style="background-image: url(<?php echo $image_url[0]; ?>);"></div>
						<?php endif; ?>
					</div>
					<header class="item__header">
						<h2 class="string"><?php the_title(); ?></h2>
						<ul class="item__cat">
						<?php 
							$product_terms = wp_get_object_terms( $post->ID, 'case_cat' );
							if(!empty($product_terms)){
							  if(!is_wp_error( $product_terms )){
							    foreach($product_terms as $term){
							      echo '<li class="icon icon--tag">'.$term->name.'</li>'; 
							    }
							  }
							}
						?>
						</ul>
					</header>
					<div class="item__props">
						<table>
							<tbody>
								<?php if( get_field('case_desc', $post->ID) ) : ?>
									<tr>
										<th>事業内容：</th>
										<td><?php the_field('case_desc', $post->ID); ?></td>
									</tr>
								<?php endif; ?>
								<?php if( get_field('case_product', $post->ID) ) : ?>
									<tr>
										<th>導入製品：</th>
										<td><?php the_field('case_product', $post->ID); ?></td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
					<div class="button button--h setWFull">詳しく見る<div class="icon icon--arrow"></div></div>
				</a>
			</section>
		<?php
			endwhile;
		?>
		</div>
		<?php
			wp_paging_nav($wp_query)
		?>
	</main>
</div>
<?php
get_footer();
