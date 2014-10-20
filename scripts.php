<?php 

if( !function_exists ('rescue_animals_scripts') ) :

	function rescue_animals_scripts() {

		wp_enqueue_script( 'jquery' );

		wp_enqueue_script('migrate-js', '//code.jquery.com/jquery-migrate-1.2.1.min.js', array ( 'jquery' ), '1.2.1', true );
		wp_enqueue_script('slick-js', plugin_dir_url( __FILE__ ) . 'inc/slick/slick.min.js', array ( 'jquery' ), '1.3.11', true );

		wp_enqueue_style('slick-slider', plugin_dir_url( __FILE__ ) . 'inc/slick/slick.css' );
		wp_enqueue_style('font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css' );
		wp_enqueue_style('animal-style', plugin_dir_url( __FILE__ ) . 'css/style.css' );

	}
	add_action('wp_enqueue_scripts', 'rescue_animals_scripts');

endif;

if ( ! function_exists( 'slick_footer' ) ) :

	/* Initialize Slick Slider in Footer */
	function slick_footer(){
	    ?>
	    <script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('.single-item').slick({
					// dots: true
				});
			});
	    </script>
	    <?php
	}

endif; // slick_footer
add_filter('wp_footer','slick_footer'); 

?>