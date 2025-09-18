<?php
/**
 * The class representing the Content block.
 *
 * @package Odyssey
 */
class Content extends AbstractBlock {

	/**
	 * Option to reduce the width of the content.
	 *
	 * @var string $c_smaller_width
	 */
	private $c_smaller_width = '';

	/**
	 * .
	 *
	 * @var string $c_content
	 */
	private $c_content = '';

	/**
	 * Get and store all data from block settings,
	 * set distinguishing block classes.
	 *
	 * @param array $block The WordPress block data array.
	 */
	public function __construct( $block ) {
		parent::__construct( 'content', $block );

		$this->c_content       = get_field( 'c_content' );
		$this->c_smaller_width = get_field( 'c_smaller_width' );

		if ( $this->c_smaller_width ) {
			$this->add_block_class( 'has-smaller-width' );
		}
	}

	/**
	 * Set the block's unique main content area.
	 */
	public function block_content() {
		?>

		<div class="row">
			<div class="col-12 col-content content-wrapper">
				<?php echo $this->c_content // phpcs:ignore; ?>
			</div>
		</div>

		<?php
	}
}
