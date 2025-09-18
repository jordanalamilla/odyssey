<?php
/**
 * The card template.
 * Display a post preview in a Bootstrap card layout.
 *
 * @package odyssey
 */

// The data array passed into this template representing the post to be displayed.
$post_data = $args;

$p_id            = $post_data['p_id'];
$p_type          = $post_data['p_type'];
$p_thumbnail_url = $post_data['p_thumbnail_url'];
$p_title         = $post_data['p_title'];
$p_excerpt       = $post_data['p_excerpt'];
$p_permalink     = $post_data['p_permalink'];
$p_category      = $post_data['p_category'];
?>

<div class="card">

	<?php
	// Category badge.
	if ( ! empty( $p_category ) ) {
		?>
		<div class="badge post-category bg-dark">
			<?php echo esc_html( $p_category ); ?>
		</div>
	<?php } ?>

	<?php
	// Image.
	if ( ! empty( $p_thumbnail_url ) ) {
		?>
		<div class="card-img" style="background-image: url('<?php echo esc_url( $p_thumbnail_url ); ?>');"></div>
	<?php } ?>

	<div class="card-body">

		<?php
		// Title.
		if ( ! empty( $p_title ) ) {
			?>
			<h2 class="card-title h6">
				<?php echo esc_html( $p_title ); ?>
			</h2>
		<?php } ?>

		<p class="card-text">
			<?php echo esc_html( $p_excerpt ); ?>
		</p>

		<?php
		// Button.
		if ( ! empty( $p_permalink ) ) {
			?>
			<div class="card-button-wrapper">
				<a href="<?php echo esc_url( $p_permalink ); ?>">
					View <?php echo esc_html( $p_type ); ?>    
				</a>
			</div>
		<?php } ?>
	</div>
  
</div>
