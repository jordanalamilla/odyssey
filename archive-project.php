<?php
get_header();

// Banner.
get_template_part( 'template-parts/banner' );


// Display latest posts.
$args = array(
	'post_type' => 'project',
	'status'    => 'published',
);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) {
	?>
	<div class="archive-posts-container">
		<div class="container">
			<div class="row">

				<?php
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$p_id      = get_the_ID();
					$post_data = get_post_data( $p_id );
					?>

					<div class="col-12 col-md-4 col-post">
						<?php
						// Post card template.
						get_template_part( 'template-parts/card', 'project', $post_data );
						?>
					</div>

					<?php
					wp_reset_postdata();
				}
				?>

			</div>
		</div>
	</div>

	<?php
} else {
	// No posts error message.
	esc_html_e( 'Sorry, no posts matched your criteria.' );
}

get_footer();
