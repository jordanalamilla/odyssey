<?php
/**
 * The class representing the Posts block.
 *
 * @package Odyssey
 */
class Posts extends AbstractBlock {

	/**
	 * The choice to select posts or show latest posts.
	 *
	 * @var bool $p_posts_to_show
	 */
	private $p_posts_to_show = false;

	/**
	 * The selected posts.
	 *
	 * @var object $p_posts
	 */
	private $p_posts = array();

	/**
	 * The chosen post type for latest posts.
	 *
	 * @var string $p_post_type
	 */
	private $p_post_type = '';

	/**
	 * Get and store all data from block settings,
	 * set distinguishing block classes.
	 *
	 * @param array $block The WordPress block data array.
	 */
	public function __construct( $block ) {
		parent::__construct( 'posts', $block );

		$this->p_posts_to_show = get_field( 'p_posts_to_show' );
		$this->p_posts         = get_field( 'p_posts' );
		$this->p_post_type     = get_field( 'p_post_type' );

		// Posts to show.
		if ( $this->p_posts_to_show ) {
			$this->add_block_class( 'has-selected-posts' );
		} else {
			$this->add_block_class( 'has-latest-posts' );
		}

		// Posts.
		if ( ! empty( $this->p_posts ) ) {
			$this->add_block_class( 'has-posts' );
		}

		// Post type.
		if ( ! empty( $this->p_post_type ) ) {
			$this->add_block_class( 'post-type-' . $this->p_post_type );
		}
	}

	/**
	 * Set the block's unique main content area.
	 */
	public function block_content() {

		// Display selected posts.
		if ( $this->p_posts_to_show ) { ?>

			<div class="row">

				<?php
				foreach ( $this->p_posts as $p_id ) {
					$post_data = get_post_data( $p_id );
					?>
						<div class="col-12 col-md-4 col-post">
							<?php
							// Post card template.
							get_template_part( 'template-parts/card', $post_data['p_type'], $post_data );
							?>
						</div>
					<?php
				}
				?>

			</div>

			<?php
		} else {

			// Display latest posts.
			$args = array(
				'post_type' => $this->p_post_type,
				'status'    => 'published',
			);

			$the_query = new WP_Query( $args );

			if ( $the_query->have_posts() ) {
				?>

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
							get_template_part( 'template-parts/card', null, $post_data );
							?>
						</div>

					<?php } ?>

				</div>

				<?php
			} else {
				// No posts error message.
				esc_html_e( 'Sorry, no posts matched your criteria.' );
			}

			wp_reset_postdata();
		}
	}
}
