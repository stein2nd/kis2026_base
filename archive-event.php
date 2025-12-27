<?php
	get_header();
    remove_filter('the_content', 'wpautop');
?>
<div class="pageContent spPad">
	<div class="fixedWidth breadcrumb">
		<span class="item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a></span>　&gt;　<span class="item"><span>イベント</span></span>
	</div>
	<main class="fixedWidth">
		<header class="pageTitle">
			<h1 class="string">イベント</h1>
			<small>EVENT</small>
		</header>
		<div class="col eventLead">
			<div class="box">
				<p>関西総合システムは、さまざまなインベントやセミナーを開催しています。</p>
				<p>貴社の課題解決に役立ちそうであれば、それぞれの詳細を参照ください。</p>
			</div>
			<!-- div class="box--r" -->
				<!-- <a href="<?php echo esc_url( home_url( '/' ) ); ?>event/form/" class="button button--a">イベントお申込みはこちら<span class="icon icon--arrow"></span></a> -->
			<!-- /div -->
		</div>
		<section>
			<?php
				$args = array(
					'paged' => $paged,
					'posts_per_page' => 1,
					'post_type' => array( 'event' ),
				    'order' => 'DESC',
				    'meta_key'=>'event_date',
				    'orderby'=>'meta_value',
					'post__not_in' => array(39)
				);
				$the_query = new WP_Query( $args );
				if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) : $the_query->the_post();
						$post_year = get_field('event_date', $post->ID);
					endwhile;
				endif;
				wp_reset_postdata();

				$latest_y = intval($post_year);
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
						'post_type' => array( 'event' ),
						'post__not_in' => array(39),
						"orderby"      =>"meta_value",
						"meta_key"     =>"event_date",
						"order"        =>"DESC",
					    'meta_query' => array(
					       'relation' => 'AND',
					       array(
					         'key' => 'event_date',
					         'value'=>array( date("$param_y-01-01"), date("$param_y-12-31") ),
					         'compare'=>'BETWEEN',
					         'type'=>'DATE'
					       )
					    )
						);
					$the_query = new WP_Query( $args2 );
					if ( $the_query->have_posts() ) :
				?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<tr class="eventRow<?php the_id(); ?>">
							<th>
							<?php if( get_field('event_date', $post->ID) ) : ?>
								<?php the_field('event_date', $post->ID); ?>
							<?php else: ?>
							未定
							<?php endif; ?></th>
							<td><a href="<?php the_permalink(); ?>" class="setColorLink"><?php the_title(); ?></a></td>
						</tr>
					<?php endwhile;
				wp_reset_postdata(); ?>
				<?php endif; ?>

			
				<?php if ( !isset($_GET['y']) or $param_y == $latest_y ) : ?>
					<?php
						$args3 = array(
							'posts_per_page' => -1,
							'post_type' => array( 'event' ),
							'post__not_in' => array(39),
							'meta_key' => 'event_date',
							'meta_value' => ' ',
							'meta_compare' => '='
							);
						$the_query_tobe = new WP_Query( $args3 );
						if ( $the_query_tobe->have_posts() ) :
					?>
						<?php while ( $the_query_tobe->have_posts() ) : $the_query_tobe->the_post(); ?>
							<tr class="eventRow<?php the_id(); ?>">
								<th>
								<?php if( get_field('event_date', $post->ID) ) : ?>
									<?php the_field('event_date', $post->ID); ?>
								<?php else: ?>
								未定
								<?php endif; ?></th>
								<td><a href="<?php the_permalink(); ?>" class="setColorLink"><?php the_title(); ?></a></td>
							</tr>
						<?php endwhile;
					wp_reset_postdata(); ?>
						<?php endif; ?>

				<?php endif; ?>

				</tbody>
			</table>
			<div class="yearNav">
			<?php
				$year=NULL;
				$args = array(
					'post_type' => 'event',
					'posts_per_page' => -1 ,
				    'order' => 'DESC',
				    'meta_key'=>'event_date',
				    'orderby'=>'meta_value',
					'post__not_in' => array(39)
				);
				$the_query = new WP_Query($args); if($the_query->have_posts()){
				echo '<ul class="col">';
				while ($the_query->have_posts()): $the_query->the_post();
					$split_date = explode("/", get_field('event_date', $post->ID) );
					$my_year = $split_date[0];

					if ($year != $my_year){
						if($my_year != "") {
							$year = $my_year;
							echo '<li';
							if($param_y == $year ):
							echo ' class="current"';
							endif;
							echo '><a href="./?y='.$year.'" data-y="'.$year.'">'.$year.'年</a>';
							echo '</li>';
						}
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