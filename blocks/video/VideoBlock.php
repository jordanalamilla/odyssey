<?php
/**
 * The class representing the Video block.
 *
 * @package Odyssey
 */
class Video extends AbstractBlock {

	/**
	 * The video block ID for stop on close functionality.
	 *
	 * @var array $video_block_id
	 */
	private $video_modal_id = 0;

	/**
	 * The video thumbnail image.
	 *
	 * @var array $thumbnail_image
	 */
	private $thumbnail_image = array();

	/**
	 * The video embed code.
	 *
	 * @var string $embed_code
	 */
	private $embed_code = '';

	/**
	 * Get and store all data from block settings,
	 * set distinguishing block classes.
	 *
	 * @param array $block The WordPress block data array.
	 */
	public function __construct( $block ) {
		parent::__construct( 'video', $block );

		$this->video_modal_id  = wp_rand( 999999, 9999999 );
		$this->thumbnail_image = get_field( 'thumbnail_image' );
		$this->embed_code      = get_field( 'embed_code' );
	}

	/**
	 * Set the block's unique main content area.
	 */
	public function block_content() {
		?>
			<div class="row">
				<div class="col-12">

					<!-- Button trigger modal -->
					<button type="button"
						class="video-modal-button"
						data-bs-toggle="modal"
						data-bs-target="#video-modal-id-<?php echo esc_attr( $this->video_modal_id ); ?>">
						
						<div class="video-thumbnail-play-icon"></div>	
						<div class="video-thumbnail-image" style="background-image: url('<?php echo esc_url( $this->thumbnail_image['sizes']['large'] ); ?>');"></div>
					</button>

					<!-- Modal -->
					<div class="modal fade"
						id="video-modal-id-<?php echo esc_attr( $this->video_modal_id ); ?>"
						data-bs-backdrop="static"
						data-bs-keyboard="false"
						tabindex="-1"
						aria-labelledby="video-modal-id-<?php echo esc_attr( $this->video_modal_id ); ?>"
						aria-hidden="true">
						
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<?php
										echo $this->embed_code;
									?>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		<?php
	}
}
