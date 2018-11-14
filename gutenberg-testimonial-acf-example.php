<?php
/**
 * Plugin Name: Gutenberg Testimonial ACF Example
 */

/**
 * Register the block once ACF has initialized
 */
add_action( 'acf/init', 'my_acf_init' );
function my_acf_init() {

	// check function exists
	if ( function_exists( 'acf_register_block' ) ) {

		acf_register_block( [
			'name'            => 'acf-testimonial',
			'title'           => __( 'Testimonial - ACF' ),
			'description'     => __( 'A custom testimonial block, using Advanced Custom Fields Pro.' ),
			'render_callback' => 'acf_testimonial_callback',
			'category'        => 'formatting',
			'icon'            => 'admin-comments',
			'keywords'        => [ 'testimonial', 'quote', 'acf' ],
		] );
	}

}

/**
 * Render Callback for the block. This is what is output in the Theme AND
 * in the preview within Gutenberg
 *
 * @param $block
 */
function acf_testimonial_callback( $block ) {
	?>
	<h2><?php echo $block['name']; ?></h2>
	<?php
}