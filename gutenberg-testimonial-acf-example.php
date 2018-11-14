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

	if ( function_exists( 'acf_add_local_field_group' ) ) {

		acf_add_local_field_group( [
			'key'      => 'group_5bec5e04859ef',
			'title'    => 'ACF Avatar Block',
			'fields'   => [
				[
					'key'          => 'field_5bec5e12675e1',
					'label'        => 'Testimonial',
					'name'         => 'testimonial',
					'type'         => 'textarea',
					'instructions' => 'Enter the testimonial text',
					'required'     => 1,
				],
				[
					'key'          => 'field_5bec5f940015c',
					'label'        => 'Avatar',
					'name'         => 'avatar',
					'type'         => 'image',
					'instructions' => 'Select the image to use as the Avatar for the testimonial',
				],
				[
					'key'          => 'field_5bec5fb10015d',
					'label'        => 'Name',
					'name'         => 'name',
					'type'         => 'text',
					'instructions' => 'Enter the name to cite',
				],
				[
					'key'          => 'field_5bec5fb100166',
					'label'        => 'Background Color',
					'name'         => 'background_color',
					'type'         => 'color_picker',
					'instructions' => 'Set the Background Color',
				],
				[
					'key'          => 'field_5bec5fb100199',
					'label'        => 'Text Color',
					'name'         => 'text_color',
					'type'         => 'color_picker',
					'instructions' => 'Set the Font Color',
				],
				[
					'key'          => 'field_5bec5fcf0015e',
					'label'        => 'Alignment',
					'name'         => 'alignment',
					'type'         => 'select',
					'instructions' => 'Select the alignment',
					'choices'      => [
						'right' => 'Right',
						'left'  => 'Left',
					],
				],
			],
			'location' => [
				[
					[
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/acf-testimonial',
					],
				],
			],
			'active'   => 1,
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
	$block_id         = $block['id'];
	$testimonial      = get_field( 'testimonial' );
	$alignment        = get_field( 'alignment' );
	$avatar           = get_field( 'avatar' );
	$avatar_url       = ! empty( $avatar['url'] ) ? $avatar['url'] : 'https://placehold.it/100x100';
	$name             = get_field( 'name' );
	$text_color       = get_field( 'text_color' );
	$background_color = get_field( 'background_color' );
	?>
	<div id="<?php echo 'acf-testimonial-' . esc_attr( $block_id ); ?>" class="acf-testimonial">
		<div class="acf-testimonial-text">
			<?php echo esc_html( $testimonial ); ?>
		</div>
		<div class="acf-testimonial-info <?php echo esc_attr( $alignment ); ?>">
			<div class="acf-testimonial-avatar-wrap">
				<img src="<?php echo esc_url( $avatar_url ); ?>"/>
			</div>
			<h2 class="acf-testimonial-avatar-name">
				<?php echo esc_html( $name ); ?>
			</h2>
		</div>
	</div>
	<style>
		#<?php echo 'acf-testimonial-' . $block_id; ?>{
			background-color: <?php echo $background_color; ?>;
			color: <?php echo $text_color; ?>;
			padding: 30px;
		}
		#<?php echo 'acf-testimonial-' . $block_id; ?> h2 {
			color: <?php echo $text_color; ?>;
		}

		.acf-testimonial-info {
			position: relative;
			display: inline-block;
			width: 100%;
			margin-top: 15px;
			min-height: 55px;
			padding-top: 5px;
			line-height: 1.4;
			text-align: left;
		}

		.acf-testimonial-info.right {
			text-align: right;
		}

		.acf-testimonial-avatar-wrap {
			position: absolute;
			left: 0;
			top: 0;
		}

		.acf-testimonial-info.right .acf-testimonial-avatar-wrap {
			right: 0;
		}

		.acf-testimonial-avatar-wrap img {
			max-width: 55px;
		}

		.acf-testimonial-avatar-name {
			color: #ffffff;
			margin-right: 81px;
			margin-left: 81px;
			padding-left: 0;
			left: 0;
		}
	</style>
	<?php
}
