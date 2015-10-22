<?php

/*-----------------------------------------------------------------------------------*/
/*	Registering Custom Widget
/*-----------------------------------------------------------------------------------*/

function ms_portfolio_cats_widgets() {
	register_widget( 'MS_Portfolio_Cats_Widget' );
}
add_action( 'widgets_init', 'ms_portfolio_cats_widgets' );



/*-----------------------------------------------------------------------------------*/
/*	Extending WordPress Widget Class
/*-----------------------------------------------------------------------------------*/

class MS_Portfolio_Cats_Widget extends WP_Widget {

		

	/*-----------------------------------------------------------------------------------*/
	/*	Register widget with WordPress.
	/*-----------------------------------------------------------------------------------*/

	function __construct() {

		$args = array(
			'description' => esc_html__('A widget that displays your Portfolio categories.', 'mstrends')
		);
		
	    parent::__construct( 'ms_portfolio_cats_widget', esc_html__('Portfolio Categories', 'mstrends' ), $args );

	}


	/*-----------------------------------------------------------------------------------*/
	/*	Front-end display of widget.
	/*-----------------------------------------------------------------------------------*/

	/**
	* @see WP_Widget::widget()
	*
	* @param array $args     Widget arguments.
	* @param array $instance Saved values from database.
	*/

	public function widget( $args, $instance ) {

		extract( $args );

		echo wp_kses_post( $before_widget );

		if ($instance['title'] )
			echo wp_kses_post( $before_title . apply_filters('widget_title', $instance['title'] ) . $after_title );

		// widget specific variables
		$terms = get_terms('portfolio_category');
		$portfolio_url = get_theme_mod('ms_portfolio_page_id') ? get_permalink( get_theme_mod('ms_portfolio_page_id') ) : '#no-portfolio-defined';

		?>

		<ul>

			<li><a href="<?php echo esc_url( $portfolio_url ); ?>" data-filter="*"><?php _e('All', 'mstrends'); ?></a></li>

			<?php foreach( $terms as $term ) { ?>

				<li><a href="<?php echo esc_url( get_term_link( $term ) ); ?>" data-filter=".<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
			
			<?php } ?>

		</ul>


		<?php

		echo wp_kses_post( $after_widget );
		
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Back-end widget form.
	/*-----------------------------------------------------------------------------------*/

	/**
	* @see WP_Widget::form()
	*
	* @param array $instance Previously saved values from database.
	*/	

	public function form( $instance ) {

		$defaults = array(
			'title' => 'Filter',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'mstrends') ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" type="text" />
		</p>
		
	<?php
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Sanitize widget form values as they are saved.
	/*-----------------------------------------------------------------------------------*/

	/**
	* @see WP_Widget::update()
	*
	* @param array $new_instance Values just sent to be saved.
	* @param array $old_instance Previously saved values from database.
	*
	* @return array Updated safe values to be saved.
	*/

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;

	}


}