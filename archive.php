<?php get_header(); ?>
<div class="col">
	<div class="main">
		<header>
			<h1 class="page-title">
				<?php
					if ( is_day() ) :
						printf( __( '日間アーカイブ: %s' ), get_the_date() );
					elseif ( is_month() ) :
						printf( __( '月間アーカイブ: %s' ), get_the_date('Y年n月') );
					elseif ( is_year() ) :
						printf( __( '年間アーカイブ: %s' ), get_the_date('Y年n月') );
					else :
						_e( 'アーカイブ' );
					endif;
				?>
			</h1>
		</header>
		<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;
			wp_paging_nav();
		?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
