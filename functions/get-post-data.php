<?php
/**
 * The Get Post Data function
 *
 * @package odyssey
 */

/**
 * Use a post ID to generate an array of easily accessible data.
 *
 * @param int $p_id The post ID.
 */
function get_post_data( $p_id ) {
	$post_data = array();

	$post_data['p_id']            = $p_id;
	$post_data['p_type']          = get_post_type( $p_id );
	$post_data['p_thumbnail_url'] = get_the_post_thumbnail_url( $p_id, 'large' );
	$post_data['p_title']         = get_the_title( $p_id );
	$post_data['p_excerpt']       = get_the_excerpt( $p_id );
	$post_data['p_permalink']     = get_the_permalink( $p_id );
	$post_data['p_category']      = null;

	// Get the right category taxonomy based on the post type.
	switch ( $post_data['p_type'] ) {
		case 'project':
			if ( ! empty( get_the_terms( $p_id, 'project-category' ) ) ) {
				$post_data['p_category'] = get_the_terms( $p_id, 'project-category' )[0]->name;
			}
			break;
		default:
			if ( ! empty( get_the_category( $p_id ) ) ) {
				$post_data['p_category'] = get_the_category( $p_id )[0]->name;
			}
	}

	return $post_data;
}
