<?php
/**
 * The class representing the abstract block.
 *
 * @package Odyssey
 */
class AbstractBlock {

	/**
	 * The WordPress block data array.
	 *
	 * @var array $block_data
	 */
	public $block_data = array();

	/**
	 * The block name used for class identification.
	 *
	 * @var string $block_name
	 */
	public $block_name = '';

	/**
	 * Storage for any distinguishing classes depending on block settings / attributes.
	 *
	 * @var array $block_classes
	 */
	public $block_classes = array();

	/**
	 * Storage for any inline styles.
	 *
	 * @var array $block_styles
	 */
	public $block_styles = array();

	/**
	 * WYSIWYG content to display above the block.
	 *
	 * @var string $block_intro_content
	 */
	private $block_intro_content = '';

	/**
	 * The block's background colour.
	 *
	 * @var string $block_background_colour
	 */
	private $block_background_color = '';

	/**
	 * The URL of the block's background image.
	 *
	 * @var string $block_background_image
	 */
	private $block_background_image = '';

	/**
	 * The toggle to enable the full width block container.
	 *
	 * @var string $block_container
	 */
	private $block_container = '';

	/**
	 * The block's anchor link.
	 *
	 * @var string $block_anchor_link
	 */
	private $block_anchor_link = '';

	/**
	 * The block's action link.
	 *
	 * @var array $block_action_link
	 */
	private $block_action_link = array();

	/**
	 * The block's constructor.
	 *
	 * @param string $name The name of the block.
	 * @param array  $block The WordPress block data array.
	 */
	public function __construct( $name, $block ) {
		$this->block_name = $name . '-block';
		$this->block_data = $block;

		$this->hydrate();
	}

	/**
	 * Add a class to the block's class array.
	 *
	 * @param string $class_name The class to add to the block.
	 */
	public function add_block_class( $class_name ) {
		$this->block_classes[] = $class_name;
	}

	/**
	 * Add an inline style to the block's style array.
	 *
	 * @param string $inline_style The class to add to the block.
	 */
	public function add_block_style( $inline_style ) {
		$this->block_styles[] = $inline_style;
	}

	/**
	 * Get the ID of the ACF block.
	 */
	public function get_block_id() {
		return $this->block_data['id'];
	}

	/**
	 * Get the block's opening structure and elements.
	 */
	private function get_block_header() {
		if ( ! empty( $this->block_intro_content ) ) {
			?>

			<div class="block-header">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="intro-content-wrapper content-wrapper">
								<?php echo $this->block_intro_content; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php
		}
	}

	/**
	 * Get the block's closing structure and elements.
	 */
	private function get_block_footer() {
		if ( ! empty( $this->block_action_link ) ) {
			$link_url    = $this->block_action_link['url'];
			$link_title  = $this->block_action_link['title'];
			$link_target = $this->block_action_link['target'] ? $this->block_action_link['target'] : '_self';
			?>

			<div class="block-footer">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="block-btn-wrapper">
								<a class="block-btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
									<?php echo esc_html( $link_title ); ?>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<?php
		}
	}

	/**
	 * Set the block's unique main content area.
	 * Will be overwritten in each block class.
	 */
	public function block_content() {
		?>

		<h4>This block has no content.</h4>

		<?php
	}

	/**
	 * Get and store all data from block settings,
	 * set distinguishing block classes.
	 */
	private function hydrate() {
		$this->block_background_color = get_field( 'block_background_color' );
		$this->block_intro_content    = get_field( 'block_intro_content' );
		$this->block_background_image = get_field( 'block_background_image' );
		$this->block_container        = get_field( 'full_width_block' ) ? 'container-fluid' : 'container';
		$this->block_anchor_link      = get_field( 'block_anchor_link' );
		$this->block_action_link      = get_field( 'block_action_link' );

		// Set the block width class.
		$this->add_block_class( 'width-' . $this->block_container );

		// Set the block name class.
		$this->add_block_class( $this->block_name );

		// Set the background colour classes.
		$this->add_block_class( $this->block_background_color );

		// Set the background image class.
		if ( ! empty( $this->block_background_image ) ) {
			$this->add_block_class( 'has-background-image' );
		}

		// Set the anchor link class.
		if ( ! empty( $this->block_anchor_link ) ) {
			$this->add_block_class( 'has-anchor-link' );
		}

		// Set the action link class.
		if ( ! empty( $this->block_action_link ) ) {
			$this->add_block_class( 'has-action-link' );
		}

		// Set the background image style.
		if ( ! empty( $this->block_background_image ) ) {
			$this->add_block_style( 'background-image: url("' . $this->block_background_image['sizes']['large'] . '");' );
		}

		// Set the block's alignment.
		if ( ! empty( $this->block_data['align'] ) ) {
			$this->add_block_class( 'align-' . $this->block_data['align'] );
		}
	}

	/**
	 * Assemble all block sections and display on the front end.
	 */
	public function render() {
		$anchor_link_id = ! empty( $this->block_anchor_link ) ? 'id=' . $this->block_anchor_link : '';
		?>

		<section <?php echo esc_attr( $anchor_link_id ); ?>
				class="odd-block <?php echo esc_attr( implode( ' ', $this->block_classes ) ); ?>"
				style="<?php echo esc_attr( implode( ' ', $this->block_styles ) ); ?>">
			<?php
			// Header.
			echo esc_attr( $this->get_block_header() );
			?>

			<div class="<?php echo esc_attr( $this->block_container ); ?>">
				<?php
				// Content.
				echo esc_attr( $this->block_content() );
				?>
			</div>

			<?php
			// Footer.
			echo esc_attr( $this->get_block_footer() );
			?>
		</section>

		<?php
	}
}
