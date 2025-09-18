<section class="banner banner-page">
	<div class="container">
		<div class="row">
			<div class="col-12">
				
				<!-- Title -->
				<h1 class="title page-title">
					<?php
					if ( is_archive( 'project' ) ) {
						echo 'Projects';
					} else {
						echo esc_html( get_the_title() );
					}
					?>
				</h1>
			</div>
		</div>
	</div>
</section>
