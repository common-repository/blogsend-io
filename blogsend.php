<?php
/*
Plugin Name:  Blogsend.io
Plugin URI:   https://blogsend.io
Description:  This helps speed up integration with Wordpress + Blogsend.io
Version:      1.0.0
Author:       fiiv
License:      MIT
License URI:  https://github.com/blogsend/wordpress-plugin/blob/master/LICENSE
*/

// Stop file from being run directly
defined( 'ABSPATH' ) or die( 'No direct access to this file permitted.' );

class Blogsend_Widget extends WP_Widget {

  public function __construct() {
    $widget_ops = array(
      'classname'     =>  'blogsend_widget',
      'description'   =>  'This helps speed up integration with Wordpress + Blogsend.io'
    );

    parent::__construct( 'blogsend_widget', 'Blogsend.io', $widget_ops );
  }

  public function widget( $args, $instance ) {
    if (empty( $instance['api_key'] )) {
      echo '';
      return;
    }

    ?>
      <iframe name="blogsend" id="blogsend" src="https://blogsend.io/s/embed/<?php echo $instance['api_key']; ?>" style="width: 100%; height: 141px;" marginheight="0" marginwidth="0" scrolling="no" frameborder="0" allowtransparency="true"></iframe>
    <?php
  }

  public function form( $instance ) {
    $api_key = ! empty( $instance['api_key'] ) ? $instance['api_key'] : esc_html__( 'Your API Key', 'text_domain' );
		?>
    <p>
      To comlete setting up this site to use Blogsend.io, you just need to go to <a href="https://blogsend.io/?ref=wordpress_widget_panel">login to Blogsend.io</a> and grab your API key. Then paste it below!
    </p>
    <p>
		  <label for="<?php echo esc_attr( $this->get_field_id( 'api_key' ) ); ?>"><?php esc_attr_e( 'API Key:', 'text_domain' ); ?></label>
		  <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'api_key' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'api_key' ) ); ?>" type="text" value="<?php echo esc_attr( $api_key ); ?>">
		</p>
		<?php
  }

  public function update ( $new_instance, $old_instance ) {
    $instance = array();
		$instance['api_key'] = ( ! empty( $new_instance['api_key'] ) ) ? sanitize_text_field( $new_instance['api_key'] ) : '';

		return $instance;
  }

}

add_action( 'widgets_init', function() {
  register_widget( 'Blogsend_Widget' );
});
