<?php
/**
 * Template Name: ニュース一覧
 *
 */
	get_header();
    remove_filter('the_content', 'wpautop');
?>
<div class="pageContent spPad">
	<div class="fixedWidth breadcrumb">
		<span class="item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a></span>　&gt;　<span class="item"><span>ニュース</span></span>
	</div>
	<main class="fixedWidth">
		<header class="pageTitle">
			<h1 class="string">ニュース</h1>
			<small>NEWS</small>
		</header>
		<section>
			<?php
				$args = array(
					'paged' => $paged,
					'posts_per_page' => 1,
					'post_type' => array( 'post' )
					);
				$the_query = new WP_Query( $args );
				if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) : $the_query->the_post();
						$post_year = get_the_date('Y');
					endwhile;
				endif;
				wp_reset_postdata();

				$param_y = isset($_GET['y']) ? htmlspecialchars($_GET['y'], ENT_QUOTES) : $post_year;
				$param_y = intval($param_y);
				if($param_y < 1900) {
					$param_y = $post_year;
				}
			?>
			<script>
				$('.breadcrumb span:last-child span').append('　<?php echo $param_y; ?>年')
			</script>
			<header class="headerB">
				<h2 class="string"><?php echo $param_y; ?>年</h2>
			</header>
			<table class="tableDefault tableResponsive">
				<tbody>
				<?php
					$args2 = array(
						'posts_per_page' => -1,
						'post_type' => array( 'post' ),
						'date_query' => array(
							array(
								'year' => $param_y
							),
						),
						);
					$the_query = new WP_Query( $args2 );
					if ( $the_query->have_posts() ) :
				?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<tr>
							<th><time datetime="<?php the_time("Y-m-d"); ?>"><?php the_time("Y/m/d"); ?></time></th>
							<td>
							<?php if( get_field('link_file', $post->ID) ) : ?>
								<a href="<?php the_field('link_file', $post->ID); ?>" target="_blank"><?php the_title(); ?></a>
							<?php else: ?>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<?php endif; ?></td>
						</tr>
					<?php endwhile; ?>
				<?php endif; ?>
				</tbody>
			</table>
			<div class="yearNav">
			<?php
				$year=NULL;
				$args = array(
					'post_type' => 'post',
					'orderby' => 'date',
					'posts_per_page' => -1 
				);
				$the_query = new WP_Query($args); if($the_query->have_posts()){
				echo '<ul class="col">';
				while ($the_query->have_posts()): $the_query->the_post();
					if ($year != get_the_date('Y')){
						$year = get_the_date('Y');

						echo '<li';
						if($param_y == $year ):
						echo ' class="current"';
						endif;
						echo '><a href="./?y='.$year.'" data-y="'.$year.'">'.$year.'年</a>';
						echo '</li>';
					}
				endwhile; // ループの終了
				echo '</ul>';
				wp_reset_postdata();
				}
			?>
			<script>
				var cy = Number($('.yearNav .current a').attr('data-y'))
				if( $('.yearNav .current').prev().length > 0 ) {
					var prev = cy + 1;
					$('.yearNav ul').prepend('<li class="button button--prev pc"><a href="./?y='+prev+'"><span class="icon icon--arrowLBLPrev"></span><i>'+prev+'年</i></a></li>')
				}
				if( $('.yearNav .current').next().length > 0 ) {
					var next = cy - 1;
					$('.yearNav ul').append('<li class="button button--next pc"><a href="./?y='+next+'"><span class="icon icon--arrowLBL"></span><i>'+next+'年</i></a></li>')
				}
			</script>
			</div>
		</section>
	</main>
</div>
<?php
get_footer();
