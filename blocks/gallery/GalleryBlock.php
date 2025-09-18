<?php
/**
 * The class representing the Gallery block.
 *
 * @package Odyssey
 */
class Gallery extends AbstractBlock {
	/**
	 * The number of columns to display the images.
	 *
	 * @var string $g_columns
	 */
	private $g_columns = '';

	/**
	 * The Bootstrap column class layout.
	 *
	 * @var string $g_col_classes
	 */
	private $g_col_classes = '';

	/**
	 * The size of the images - cover or contain.
	 *
	 * @var bool $g_image_size
	 */
	private $g_image_size = false;

	/**
	 * Option to remove the gap between images.
	 *
	 * @var bool $g_remove_gap
	 */
	private $g_remove_gap = false;

	/**
	 * Option to disable the Foobox modal.
	 *
	 * @var bool $g_disable_modal
	 */
	private $g_disable_modal = false;

	/**
	 * The array of gallery images.
	 *
	 * @var array $g_images
	 */
	private $g_images = array();

	/**
	 * Get and store all data from block settings,
	 * set distinguishing block classes.
	 *
	 * @param array $block The WordPress block data array.
	 */
	public function __construct( $block ) {
		parent::__construct( 'gallery', $block );

		$this->g_columns       = get_field( 'g_columns' );
		$this->g_image_size    = get_field( 'g_image_size' );
		$this->g_remove_gap    = get_field( 'g_remove_gap' );
		$this->g_disable_modal = get_field( 'g_disable_modal' );
		$this->g_images        = get_field( 'g_images' );

		$this->add_block_class( $this->g_image_size ? 'image-size-contain' : 'image-size-cover' );
		$this->add_block_class( $this->g_remove_gap ? 'no-gap' : 'has-gap' );
		$this->add_block_class( $this->g_disable_modal ? 'no-modal' : 'has-modal' );

		if ( ! empty( $this->g_columns ) ) {
			$this->add_block_class( 'column-count-' . $this->g_columns );
		}

		if ( ! empty( $this->g_images ) ) {
			$this->add_block_class( 'image-count-' . count( $this->g_images ) );
		}
	}

	/**
	 * Set the block's unique main content area.
	 */
	public function block_content() {
		switch ( $this->g_columns ) {
			case '1':
				$this->g_col_classes = 'col-12';
				break;
			case '2':
				$this->g_col_classes = 'col-12 col-sm-6';
				break;
			case '3':
				$this->g_col_classes = 'col-12 col-md-4';
				break;
			case '4':
				$this->g_col_classes = 'col-12 col-sm-6 col-md-3';
				break;
			case '6':
				$this->g_col_classes = 'col-12 col-sm-6 col-md-4 col-lg-2';
				break;
		}
		?>

		<div class="row <?php echo $this->g_remove_gap ? 'm-0' : ''; ?>">

			<?php
			if ( $this->g_images ) {
				foreach ( $this->g_images as $image ) {
					$image_url = $image['sizes']['large'];
					?>

					<div class="g-col <?php echo esc_attr( $this->g_col_classes ); ?> <?php echo $this->g_remove_gap ? 'p-0' : ''; ?>">
						<div class="g-image-wrapper">

							<?php if ( ! $this->g_disable_modal ) { ?>
								<a href="<?php echo esc_attr( $image_url ); ?>" class="foobox display-block" rel="<?php echo esc_attr( $this->get_block_id() ); ?>-gallery">
							<?php } ?>

								<img class="g-image" src="<?php echo esc_attr( $image_url ); ?>" alt="Gallery image">

							<?php if ( ! $this->g_disable_modal ) { ?>
								</a>
							<?php } ?>

						</div>
					</div>

					<?php
				}
			}
			?>
				
		</div>

		<?php
	}
}
