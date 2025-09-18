<?php
/**
 * The class representing the Slider block.
 *
 * @package Odyssey
 */
class Slider extends AbstractBlock {
	/**
	 * Storage for all slider data.
	 *
	 * @var array $slides
	 */
	private $slides = array();

	/**
	 * Get and store all data from block settings,
	 * set distinguishing block classes.
	 *
	 * @param array $block The WordPress block data array.
	 */
	public function __construct( $block ) {
		parent::__construct( 'slider', $block );

		$this->slides = get_field( 's_slides' );
	}

	/**
	 * Set the block's unique main content area.
	 */
	public function block_content() {
		$sd = $this->get_slide_data( $this->slides );

		if ( ! empty( $sd ) ) {
			?>

				<div class="row">
					<div class="col-12">
						<div class="slider">

							<?php
							foreach ( $sd as $s ) {
								$s_image   = $s['slide_image'];
								$s_title   = $s['slide_title'];
								$s_content = $s['slide_content'];
								$s_link    = $s['slide_link'];
								?>

								<div class="slide">
									<div class="slide-wrapper" style="background-image: url('<?php echo esc_url( $s_image ); ?>');">
										<div class="overlay"></div>

										<div class="slide-content">
											<?php
											// Post type badge.
											if ( ! empty( $s['slide_post_type'] ) ) {
												?>
												<div class="slide-post-type badge bg-light">
													<?php echo esc_attr( $s['slide_post_type'] ); ?>
												</div>
												<?php
											}

											// Title.
											if ( ! empty( $s_title ) ) {
												?>
												<h1 class="slide-title">
													<?php echo esc_attr( $s_title ); ?>
												</h1>
												<?php
											}

											// Content.
											if ( ! empty( $s_content ) ) {
												?>
												<div class="slide-content">
													<?php echo wp_kses_post( $s_content ); ?>
												</div>
												<?php
											}

											// Link.
											if ( $s_link ) {
												$link_url    = $s_link['url'];
												$link_title  = $s_link['title'];
												$link_target = $s_link['target'] ? $s_link['target'] : '_self';
												?>
												<a class="slide-link btn btn-primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
													<?php echo esc_html( $link_title ); ?>
												</a>
											<?php } ?>

										</div>
									</div>
								</div>

							<?php } ?>

						</div>
					</div>
				</div>

			<?php
		}
	}

	/**
	 * Process the slider repeater data and present it into an associative array
	 * that can be used whether the data comes from ACF or a post.
	 *
	 * @param array $slides The raw slide data array.
	 */
	private function get_slide_data( $slides ) {
		$slides_data = array();

		if ( have_rows( 'slides' ) ) {
			while ( have_rows( 'slides' ) ) {
				the_row();
				$slide_data                 = array();
				$slide_data['content_type'] = get_sub_field( 's_s_content_type' ) ? 'post' : 'manual';

				// Manually entered content.
				if ( 'manual' === $slide_data['content_type'] ) {
					$slide_data['slide_image']   = get_sub_field( 's_s_image' );
					$slide_data['slide_title']   = get_sub_field( 's_s_title' );
					$slide_data['slide_content'] = get_sub_field( 's_s_content' );
					$slide_data['slide_link']    = get_sub_field( 's_s_link' );
				} else {
					// Post content.
					$slide_post_id   = get_sub_field( 's_s_post' );
					$slide_post_type = get_post_type( $slide_post_id );

					$slide_data['slide_post_type'] = $slide_post_type;
					$slide_data['slide_image']     = get_the_post_thumbnail_url( $slide_post_id );
					$slide_data['slide_title']     = ! empty( get_sub_field( 's_s_title' ) ) ? get_sub_field( 's_s_title' ) : get_the_title( $slide_post_id );
					$slide_data['slide_content']   = get_the_excerpt( $slide_post_id );

					$slide_data['slide_link']['title']  = 'View this ' . $slide_post_type;
					$slide_data['slide_link']['url']    = get_the_permalink( $slide_post_id );
					$slide_data['slide_link']['target'] = '_self';
				}

				$slides_data[] = $slide_data;
			}
		}

		return $slides_data;
	}
}
