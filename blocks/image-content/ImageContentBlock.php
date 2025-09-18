<?php
/**
 * The class representing the Image Content block.
 *
 * @package Odyssey
 */
class ImageContent extends AbstractBlock {
	/**
	 * The URL of the image.
	 *
	 * @var string $ic_image
	 */
	private $ic_image = '';

	/**
	 * The content.
	 *
	 * @var string $ic_content
	 */
	private $ic_content = '';

	/**
	 * Vertical alignment of the text content.
	 *
	 * @var string $ic_vertical_alignment
	 */
	private $ic_vertical_alignment = '';

	/**
	 * Get and store all data from block settings,
	 * set distinguishing block classes.
	 *
	 * @param array $block The WordPress block data array.
	 */
	public function __construct( $block ) {
		parent::__construct( 'image-content', $block );

		$this->ic_image              = get_field( 'ic_image' );
		$this->ic_content            = get_field( 'ic_content' );
		$this->ic_vertical_alignment = get_field( 'ic_vertical_alignment' );

		$this->add_block_class( 'vertical-align-' . $this->ic_vertical_alignment );

		if ( ! empty( $this->ic_image ) ) {
			$this->add_block_class( 'has-ic-image' );
		}

		if ( ! empty( $this->ic_content ) ) {
			$this->add_block_class( 'has-ic-content' );
		}
	}

	/**
	 * Set the block's unique main content area.
	 */
	public function block_content() {
		?>

		<div class="row">

			<?php
			// Image.
			if ( ! empty( $this->ic_image ) ) {
				?>
				<div class="col-12 col-lg-6 col-image">
					<div class="image-wrapper">
						<img src="<?php echo esc_attr( $this->ic_image['sizes']['large'] ); ?>"
							alt="<?php echo esc_attr( $this->ic_image['alt'] ); ?>">
					</div>
				</div>
				<?php
			}

			// Content.
			if ( ! empty( $this->ic_content ) ) {
				?>
				<div class="col-12 col-lg-6 col-content">
					<div class="content-wrapper">
						<?php
							echo wp_kses_post( $this->ic_content );
						?>
					</div>
				</div>
			<?php } ?>

		</div>

		<?php
	}
}
