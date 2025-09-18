<?php
/**
 * The template for displaying the footer.
 *
 * @package Odyssey
 */

wp_footer();
?>

<footer class="odd-footer">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-2">
				<div class="sig sig-dark footer-sig"></div>
			</div>
			<div class="col-12 col-md-10">

					<div class="navbar-nav">
						<?php
						wp_nav_menu(
							array(
								'menu' => 'secondary-menu',
							)
						);
						?>
					</div>
			</div>
		</div>
	</div>
</footer>
