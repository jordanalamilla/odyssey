<?php
/**
 * The template for displaying the header.
 *
 * @package Odyssey
 */

wp_head();
?>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>
		<?php
		if ( is_archive( 'project' ) ) {
			echo 'Projects - ' . esc_attr( get_bloginfo( 'title' ) );
		} else {
			echo esc_html( get_the_title() ) . ' - ' . esc_attr( get_bloginfo( 'title' ) );
		}
		?>
	</title>
</head>

<header>
	<nav class="navbar navbar-expand-md navbar-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="/">
				<h1 class="h6">
					<?php echo esc_attr( bloginfo( 'title' ) ); ?> °.+
				</h1>
			</a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-nav" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="header-nav">
				<?php
				wp_nav_menu(
					array(
						'menu' => 'primary-menu',
					)
				);
				?>
			</div>

		</div>
	</nav>
</header>

<body <?php body_class(); ?>>
