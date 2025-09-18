<?php
/**
 * The class representing the Content Columns block.
 *
 * @package Odyssey
 */
class ContentColumns extends AbstractBlock {

	/**
	 * The ACf repater with all column data.
	 *
	 * @var int $cc_count
	 */
	private $cc_data = null;

	/**
	 * The number of columns in one row.
	 *
	 * @var int $cc_count
	 */
	private $cc_count = 1;

	/**
	 * The Bootstrap column classes to use.
	 *
	 * @var int $cc_count
	 */
	private $cc_column_classes = 'col-12';

	/**
	 * Get and store all data from block settings,
	 * set distinguishing block classes.
	 *
	 * @param array $block The WordPress block data array.
	 */
	public function __construct( $block ) {
		parent::__construct( 'content-columns', $block );

		$this->cc_count = get_field( 'cc_count' );
		$this->cc_data  = get_field( 'cc_columns' );

		// Add classes to the block to denote the column layout and column count.
		$this->add_block_class( 'columns-' . $this->cc_count );
		$this->add_block_class( 'column-count-' . count( $this->cc_data ) );
	}

	/**
	 * Set the block's unique main content area.
	 */
	public function block_content() {

		// Display the columns.
		if ( have_rows( 'cc_columns' ) ) {

			// Sort out the column classes based on the column count ACF.
			switch ( $this->cc_count ) {
				case 2:
					$this->cc_column_classes = 'col-12 col-md-6';
					break;
				case 3:
					$this->cc_column_classes = 'col-12 col-md-4';
					break;
				case 4:
					$this->cc_column_classes = 'col-12 col-md-6 col-lg-3';
					break;
				case 5:
					$this->cc_column_classes = 'col-12 col-md-4 col-lg-5';
					break;
				case 6:
					$this->cc_column_classes = 'col-12 col-md-6 col-lg-4 col-xl-2';
					break;
			} ?>

			<div class="row">

				<?php
				while ( have_rows( 'cc_columns' ) ) {
					the_row();
					$cc_image   = get_sub_field( 'cc_image' );
					$cc_content = get_sub_field( 'cc_content' );
					$cc_link    = get_sub_field( 'cc_link' );
					?>

					<div class="cc-col <?php echo esc_attr( $this->cc_column_classes ); ?>">

						<?php
						// Image.
						if ( ! empty( $cc_image ) ) {
							?>
							<div class="cc-image-wrapper">
								<div class="cc-image" style="background-image: url('<?php echo esc_attr( $cc_image['sizes']['large'] ); ?>')"></div>
							</div>
							<?php
						}

						// Content.
						if ( ! empty( $cc_content ) ) {
							?>

							<div class="cc-content-wrapper content-wrapper">
								<?php
									echo wp_kses_post( $cc_content );
								?>
							</div>

							<?php
						}

						// Link.
						if ( $cc_link ) {
							$link_url    = $cc_link['url'];
							$link_title  = $cc_link['title'];
							$link_target = $cc_link['target'] ? $cc_link['target'] : '_self';
							?>
							<a class="cc-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						<?php } ?>

					</div>

				<?php } ?>

			</div>

			<?php
		}
	}
}
