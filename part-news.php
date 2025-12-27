<?php
	$slug_name = basename(get_permalink());
	$args = array(
		'posts_per_page' => 2,
		'post_type' => array( 'post' ),
		'category_name' => $slug_name,
		);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
?>
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<tr>
			<th><time datetime="<?php the_time("Y-m-d"); ?>"><?php the_time("Y/m/d"); ?></time></th>
			<td><a href="<?php the_permalink(); ?>" class="setColorLink"><?php the_title(); ?></a></td>
		</tr>
	<?php endwhile; ?>
<?php endif; ?>