<?php
/**
 * Facebook Likebox Widget
 *
 * Display the latest posts from a selected category in a boxed layout.
 *
 * @package ThemeZee Widget Bundle
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Facebook Like Widget Class
 */
class TZWB_Facebook_Likebox_Widget extends WP_Widget {

	/**
	 * Widget Constructor
	 *
	 * @uses WP_Widget::__construct() Create Widget
	 * @return void
	 */
	function __construct() {

		parent::__construct(
			'tzwb-facebook-likebox', // ID.
			esc_html__( 'Facebook Like Box (ThemeZee)', 'themezee-widget-bundle' ), // Name.
			array(
				'classname' => 'tzwb-facebook-likebox',
				'description' => esc_html__( 'Displays a Like Box for your Facebook Page.', 'themezee-widget-bundle' ),
			) // Args.
		);
	}

	/**
	 * Set default settings of the widget
	 *
	 * @return array Default widget settings.
	 */
	private function default_settings() {

		$defaults = array(
			'title'        => '',
			'facebook_url' => '',
			'height'       => 500,
			'small_header' => false,
			'cover_photo'  => false,
			'faces'        => true,
			'streams'      => true,
		);

		return $defaults;
	}

	/**
	 * Main Function to display the widget
	 *
	 * @param array $args / Parameters from widget area created with register_sidebar().
	 * @param array $instance / Settings for this widget instance.
	 * @return void
	 */
	function widget( $args, $instance ) {

		// Get Widget Settings.
		$settings = wp_parse_args( $instance, $this->default_settings() );

		// Add Widget Title Filter.
		$widget_title = apply_filters( 'widget_title', $settings['title'], $settings, $this->id_base );

		// Validate Facebook URL.
		$facebook_href = $this->validate_facebook_url( $settings['facebook_url'] );

		// Display Notice if Facebook URL is empty or invalid.
		if ( '' == $facebook_href ) :
			echo '<!-- Invalid Facebook Page URL -->';
			if ( current_user_can( 'edit_theme_options' ) ) :
				echo $args['before_widget'];
				if ( ! empty( $widget_title ) ) { echo $args['before_title'] . esc_html( $widget_title ) . $args['after_title']; };
				echo '<p>' . sprintf( __( 'It looks like your Facebook URL is empty or invalid. Please check it in your <a href="%s">widget settings</a>.', 'themezee-widget-bundle' ), admin_url( 'widgets.php' ) ) . '</p>';
				echo $args['after_widget'];
			endif;
			return;
		endif;

		// Normalize Checkboxes.
		$settings['small_header'] = (bool) $settings['small_header'] ? 'true'  : 'false';
		$settings['cover_photo'] = (bool) $settings['cover_photo'] ? 'true'  : 'false';
		$settings['faces'] = (bool) $settings['faces'] ? 'true'  : 'false';
		$settings['streams'] = (bool) $settings['streams'] ? 'true'  : 'false';

		// Output.
		echo $args['before_widget'];

		// Display Title.
		if ( ! empty( $widget_title ) ) { echo $args['before_title'] . esc_html( $widget_title ) . $args['after_title']; }; ?>

		<div class="tzwb-content tzwb-clearfix">

			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/<?php echo esc_html( get_locale() ); ?>/sdk.js#xfbml=1&version=v2.4";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>

			<div class="fb-page" data-href="<?php echo esc_url( $facebook_href ); ?>" data-height="<?php echo intval( $settings['height'] ); ?>" data-small-header="<?php echo esc_attr( $settings['small_header'] ); ?>" data-adapt-container-width="true" data-hide-cover="<?php echo esc_attr( $settings['cover_photo'] ); ?>" data-show-facepile="<?php echo esc_attr( $settings['faces'] ); ?>" data-show-posts="<?php echo esc_attr( $settings['streams'] ); ?>">
				<div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo esc_url( $facebook_href ); ?>"><a href="<?php echo esc_url( $facebook_href ); ?>"><?php echo esc_html( $widget_title ); ?></a></blockquote></div>
			</div>

		</div>

		<?php
		echo $args['after_widget'];
	}

	/**
	 * Validate the Facebook Page URL
	 *
	 * @param string $facebook_url URL of Facebook Page.
	 * @return string $valid_url Valid URL of Facebook Page
	 */
	function validate_facebook_url( $facebook_url ) {

		if ( false !== strpos( $facebook_url, 'facebook.com' ) ) :

			$temp = explode( '?', $facebook_url );
			$valid_url = str_replace( array( 'http://facebook.com', 'https://facebook.com' ), array( 'http://www.facebook.com', 'https://www.facebook.com' ), $temp[0] );

		else :

			$valid_url = '';

		endif;

		return $valid_url;
	}

	/**
	 * Update Widget Settings
	 *
	 * @param array $new_instance Form Input for this widget instance.
	 * @param array $old_instance Old Settings for this widget instance.
	 * @return array $instance New Settings for this widget instance
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = esc_attr( $new_instance['title'] );
		$instance['facebook_url'] = esc_url( $new_instance['facebook_url'] );
		$instance['height'] = (int) $new_instance['height'];
		$instance['small_header'] = ! empty( $new_instance['small_header'] );
		$instance['cover_photo'] = ! empty( $new_instance['cover_photo'] );
		$instance['faces'] = ! empty( $new_instance['faces'] );
		$instance['streams'] = ! empty( $new_instance['streams'] );

		// Validate Facebook URL.
		$instance['facebook_url'] = $this->validate_facebook_url( $instance['facebook_url'] );

		return $instance;
	}

	/**
	 * Display Widget Settings Form in the Backend
	 *
	 * @param array $instance Settings for this widget instance.
	 * @return void
	 */
	function form( $instance ) {

		// Get Widget Settings.
		$settings = wp_parse_args( $instance, $this->default_settings() );

		// Validate Facebook URL.
		$settings['facebook_url'] = $this->validate_facebook_url( $settings['facebook_url'] );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'themezee-widget-bundle' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $settings['title'] ); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'facebook_url' ); ?>"><?php esc_html_e( 'Facebook Page URL:', 'themezee-widget-bundle' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'facebook_url' ); ?>" name="<?php echo $this->get_field_name( 'facebook_url' ); ?>" type="text" value="<?php echo esc_url( $settings['facebook_url'] ); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php esc_html_e( 'Height in pixels:', 'themezee-widget-bundle' ); ?>
				<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo absint( $settings['height'] ); ?>" size="6" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'small_header' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['small_header'] ); ?> id="<?php echo $this->get_field_id( 'small_header' ); ?>" name="<?php echo $this->get_field_name( 'small_header' ); ?>" />
				<?php esc_html_e( 'Use Small Header', 'themezee-widget-bundle' ); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'cover_photo' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['cover_photo'] ); ?> id="<?php echo $this->get_field_id( 'cover_photo' ); ?>" name="<?php echo $this->get_field_name( 'cover_photo' ); ?>" />
				<?php esc_html_e( 'Hide Cover Photo', 'themezee-widget-bundle' ); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'faces' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['faces'] ); ?> id="<?php echo $this->get_field_id( 'faces' ); ?>" name="<?php echo $this->get_field_name( 'faces' ); ?>" />
				<?php esc_html_e( 'Show Faces', 'themezee-widget-bundle' ); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'streams' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['streams'] ); ?> id="<?php echo $this->get_field_id( 'streams' ); ?>" name="<?php echo $this->get_field_name( 'streams' ); ?>" />
				<?php esc_html_e( 'Show Page Posts', 'themezee-widget-bundle' ); ?>
			</label>
		</p>

		<?php
	}
}
