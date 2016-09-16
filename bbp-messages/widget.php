<?php

class bbpm_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'bbpm_widget', 
			__('bbPress Messages', 'wordpress'), 
			array( 'description' => __( 'Widget with user welcoming note, messages and archives links and counts, and a logout link', 'wordpress' ), ) 
		);
	}
	public function widget( $args, $instance ) {
		
		if( ! is_user_logged_in() )
			return;

		$user = wp_get_current_user();
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		echo ! empty( $title ) ? $args['before_title'] . $title . $args['after_title'] : '';

		?>
			<div id="bbpm_widget">				
                <p><a href="<?php echo bbpm_messages_base(false, $user->ID); ?>" style="color:#582764;">You have <span style="color:#66c3c9;font-size:18px;"><?php echo bbpm_get_counts($user->ID)->unreads; ?></span> new messages </a></p>
			</div>
		<?php

		echo $args['after_widget'];
		
	}

	public function form( $instance ) {
		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>" style="font-weight:bold;"><?php _e( 'Widget Title:' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
		<?php
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}

}