<?php get_header(); ?>
<div class="pageContent spPad">
	<div class="fixedWidth breadcrumb">
		<span class="item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a></span>　&gt;　<span class="item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>news/">ニュース</a></span>　&gt;　<span class="item"><span><?php the_title(); ?></span></span>
	</div>
	<div class="fixedWidth">
		<div class="pageTitle">
			<p class="string">ニュース</p>
			<small>NEWS</small>
		</div>
		<?php
			while ( have_posts() ) : the_post();
		?>
			<article class="compoArticle">
				<header class="compoArticle__header">
					<time datetime="<?php the_time("Y-m-d"); ?>"><?php the_time("Y/m/d"); ?></time>
					<h1 class="string"><?php the_title(); ?></h1>
				</header>
				<div class="compoArticle__body">
					<?php the_content(); ?>
					<div class="compoArticle__photos">
						<div class="col">
							<?php if( get_field('photo_1', $post->ID) ) : ?>
								<figure class="item"><img src="<?php the_field('photo_1', $post->ID); ?>" alt=""></figure>
							<?php endif; ?>
							<?php if( get_field('photo_2', $post->ID) ) : ?>
								<figure class="item"><img src="<?php the_field('photo_2', $post->ID); ?>" alt=""></figure>
							<?php endif; ?>
							<?php if( get_field('photo_3', $post->ID) ) : ?>
								<figure class="item"><img src="<?php the_field('photo_3', $post->ID); ?>" alt=""></figure>
							<?php endif; ?>
							<?php if( get_field('photo_4', $post->ID) ) : ?>
								<figure class="item"><img src="<?php the_field('photo_4', $post->ID); ?>" alt=""></figure>
							<?php endif; ?>
							<?php if( get_field('photo_5', $post->ID) ) : ?>
								<figure class="item"><img src="<?php the_field('photo_5', $post->ID); ?>" alt=""></figure>
							<?php endif; ?>
							<?php if( get_field('photo_6', $post->ID) ) : ?>
								<figure class="item"><img src="<?php the_field('photo_6', $post->ID); ?>" alt=""></figure>
							<?php endif; ?>
							<?php if( get_field('photo_7', $post->ID) ) : ?>
								<figure class="item"><img src="<?php the_field('photo_7', $post->ID); ?>" alt=""></figure>
							<?php endif; ?>
							<?php if( get_field('photo_8', $post->ID) ) : ?>
								<figure class="item"><img src="<?php the_field('photo_8', $post->ID); ?>" alt=""></figure>
							<?php endif; ?>
							<?php if( get_field('photo_9', $post->ID) ) : ?>
								<figure class="item"><img src="<?php the_field('photo_9', $post->ID); ?>" alt=""></figure>
							<?php endif; ?>
							<?php if( get_field('photo_10', $post->ID) ) : ?>
								<figure class="item"><img src="<?php the_field('photo_10', $post->ID); ?>" alt=""></figure>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</article>
			<div class="wrapBackButton">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>news/?y=<?php the_time("Y"); ?>" class="button button--e">一覧へ戻る<span class="icon icon--arrowGry"></span></a>
			</div>
		<?php
			endwhile;
		?>
	</div>
</div>
<?php
get_footer();
