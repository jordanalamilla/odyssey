<?php
/**
 * The template for displaying all pages.
 *
 * @package Odyssey
 */

get_header();
get_template_part( 'template-parts/banner', 'project' );
the_content();
get_footer();
