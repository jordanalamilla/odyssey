<?php
/**
 * The class representing the Image block.
 *
 * @package Odyssey
 */
class Image extends AbstractBlock {
	/**
	 * The URL of the image.
	 *
	 * @var string $ic_image
	 */
	private $i_image = '';

	/**
	 * Get and store all data from block settings,
	 * set distinguishing block classes.
	 *
	 * @param array $block The WordPress block data array.
	 */
	public function __construct( $block ) {
		parent::__construct( 'image', $block );

		$this->i_image = get_field( 'i_image' );

		if ( ! empty( $this->i_image ) ) {
			$this->add_block_class( 'has-image' );
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
			if ( ! empty( $this->i_image ) ) {
				?>
				<div class="col-12 col-image">
					<div class="image-wrapper">
						<img src="<?php echo esc_attr( $this->i_image['url'] ); ?>"
							alt="<?php echo esc_attr( $this->i_image['alt'] ); ?>">
					</div>
				</div>
				<?php
			}
			?>

		</div>

		<?php
	}
}
