<?php
$proj_availability = get_field( 'proj_availability' );
$proj_price        = get_field( 'proj_price' );
$proj_date_created = get_field( 'proj_date_created' );
$proj_media        = get_field( 'proj_media' );
$proj_size         = get_field( 'proj_size' );
$proj_categories   = get_the_terms( get_the_ID(), 'project-category' );
?>

<section class="banner banner-project">
	<div class="container">
		<div class="row">

			<div class="col-12 col-md-8 col-title">

				<!-- Signature -->
				<div class="sig sig-dark"></div>
				
				<!-- Title -->
				<h1 class="title project-title"><?php the_title(); ?></h1>
			</div>

			<!-- Info section -->
			<div class="col-12 col-md-4 col-info">
				<div class="info-wrapper project-info">

				<?php
				// Availability.
				if ( $proj_availability ) {
					?>

					<div class="badge availability bg-success">
						<?php echo ! empty( $proj_price ) ? 'Available:  ' . esc_html( $proj_price ) : 'Available'; ?>
					</div>

				<?php } else { ?>

					<div class="badge availability bg-danger">
						Sold
					</div>

					<?php
				}

				// Categories.
				if ( ! empty( $proj_categories ) ) {
					?>
						<div class="categories-wrapper">
							
						<?php foreach ( $proj_categories as $proj_category ) { ?>
								<div class="badge category bg-primary">
									<?php echo esc_html( $proj_category->name ); ?>
								</div>
							<?php } ?>

						</div>
						<?php
				}

					// Date created.
				if ( ! empty( $proj_date_created ) ) {
					?>

						<div class="info date-created">
						Created <?php echo esc_html( $proj_date_created ); ?>
						</div>

						<?php
				}

					// Media.
				if ( ! empty( $proj_media ) ) {
					?>

						<div class="info media">
						<?php echo esc_html( $proj_media ); ?>
						</div>

						<?php
				}

					// Size.
				if ( ! empty( $proj_size ) ) {
					?>

						<div class="info size">
						<?php echo esc_html( $proj_size ); ?>
						</div>

						<?php
				}
				?>

				</div>
			</div>
		</div>
	</div>
</section>
