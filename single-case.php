<?php get_header(); ?>
<div class="pageContent spPad">
	<div class="fixedWidth breadcrumb">
		<span class="item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a></span>　&gt;　<span class="item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>case/">導入事例</a>　&gt;　<span class="item"><span><?php the_title(); ?></span></span>
	</div>
	<div class="fixedWidth">
		<div class="pageTitle">
			<h1 class="string">導入事例</h1>
			<small>CASE STUDY</small>
		</div>
		<?php
			while ( have_posts() ) : the_post();
		?>
			<article class="compoCaseArticle">
				<div class="compoCaseArticle__first">
					<div class="cell item__headers">
						<?php if( get_field('case_logo', $post->ID) ) : ?>
							<div class="item__logo"><img src="<?php echo $url = get_field('case_logo')['url']; ?>" alt=""></div>
						<?php endif; ?>
						<div class="cell item__photo sp">
							<?php if ( has_post_thumbnail() ) :
									$image_id = get_post_thumbnail_id();
									$image_url = wp_get_attachment_image_src($image_id, true);
							?>
							<img src="<?php echo $image_url[0]; ?>" alt="">
							<?php endif; ?>
						</div>
						<div class="compoCaseArticle__box">
							<header class="compoCaseArticle__header flex">
								<h1 class="string flex__item"><?php the_title(); ?></h1>
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
						</div>
					</div>
					<div class="cell item__photo pc">
						<?php if ( has_post_thumbnail() ) :
								$image_id = get_post_thumbnail_id();
								$image_url = wp_get_attachment_image_src($image_id, true);
						?>
						<img src="<?php echo $image_url[0]; ?>" alt="">
						<?php endif; ?>
					</div>
				</div>
				<div class="compoCaseArticle__body">

					<?php if( get_field('case_c1_content', $post->ID) ) : ?>
						<section class="col">
							<div class="box--r compoCaseArticle__body__main">
								<div>
									<?php the_field('case_c1_content', $post->ID); ?>
								</div>
							</div>
							<div class="box compoCaseArticle__body__photo">
								<?php if( get_field('case_c1_photo_1', $post->ID) ) : ?>
									<figure><img src="<?php echo $url = get_field('case_c1_photo_1')['url']; ?>" alt="" class="setWFull"></figure>
								<?php endif; ?>
								<?php if( get_field('case_c1_photo_2', $post->ID) ) : ?>
									<figure><img src="<?php echo $url = get_field('case_c1_photo_2')['url']; ?>" alt="" class="setWFull"></figure>
								<?php endif; ?>
							</div>
						</section>
					<?php endif; ?>
					
					<?php if( get_field('case_c2_content', $post->ID) ) : ?>
						<section class="col">
							<div class="box--r compoCaseArticle__body__main">
								<div>
									<?php the_field('case_c2_content', $post->ID); ?>
								</div>
							</div>
							<div class="box compoCaseArticle__body__photo">
								<?php if( get_field('case_c2_photo_1', $post->ID) ) : ?>
									<figure><img src="<?php echo $url = get_field('case_c2_photo_1')['url']; ?>" alt="" class="setWFull"></figure>
								<?php endif; ?>
								<?php if( get_field('case_c2_photo_2', $post->ID) ) : ?>
									<figure><img src="<?php echo $url = get_field('case_c2_photo_2')['url']; ?>" alt="" class="setWFull"></figure>
								<?php endif; ?>
							</div>
						</section>
					<?php endif; ?>
					
					<?php if( get_field('case_c3_content', $post->ID) ) : ?>
						<section class="col">
							<div class="box--r compoCaseArticle__body__main">
								<div>
									<?php the_field('case_c3_content', $post->ID); ?>
								</div>
							</div>
							<div class="box compoCaseArticle__body__photo">
								<?php if( get_field('case_c3_photo_1', $post->ID) ) : ?>
									<figure><img src="<?php echo $url = get_field('case_c3_photo_1')['url']; ?>" alt="" class="setWFull"></figure>
								<?php endif; ?>
								<?php if( get_field('case_c3_photo_2', $post->ID) ) : ?>
									<figure><img src="<?php echo $url = get_field('case_c3_photo_2')['url']; ?>" alt="" class="setWFull"></figure>
								<?php endif; ?>
							</div>
						</section>
					<?php endif; ?>
					
					<?php if( get_field('case_c4_content', $post->ID) ) : ?>
						<section class="col">
							<div class="box--r compoCaseArticle__body__main">
								<div>
									<?php the_field('case_c4_content', $post->ID); ?>
								</div>
							</div>
							<div class="box compoCaseArticle__body__photo">
								<?php if( get_field('case_c4_photo_1', $post->ID) ) : ?>
									<figure><img src="<?php echo $url = get_field('case_c4_photo_1')['url']; ?>" alt="" class="setWFull"></figure>
								<?php endif; ?>
								<?php if( get_field('case_c4_photo_2', $post->ID) ) : ?>
									<figure><img src="<?php echo $url = get_field('case_c4_photo_2')['url']; ?>" alt="" class="setWFull"></figure>
								<?php endif; ?>
							</div>
						</section>
					<?php endif; ?>

					<?php if( get_field('case_c5_content', $post->ID) ) : ?>
						<section class="col">
							<div class="box--r compoCaseArticle__body__main">
								<div>
									<?php the_field('case_c5_content', $post->ID); ?>
								</div>
							</div>
							<div class="box compoCaseArticle__body__photo">
								<?php if( get_field('case_c5_photo_1', $post->ID) ) : ?>
									<figure><img src="<?php echo $url = get_field('case_c5_photo_1')['url']; ?>" alt="" class="setWFull"></figure>
								<?php endif; ?>
								<?php if( get_field('case_c5_photo_2', $post->ID) ) : ?>
									<figure><img src="<?php echo $url = get_field('case_c5_photo_2')['url']; ?>" alt="" class="setWFull"></figure>
								<?php endif; ?>
							</div>
						</section>
					<?php endif; ?>

				</div>
			</article>
			<div class="wrapBackButton">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>case/" class="button button--e">一覧へ戻る<span class="icon icon--arrowGry"></span></a>
			</div>
		<?php
			endwhile;
		?>
	</div>
</div>
<?php
get_footer();
