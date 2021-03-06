<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Gambit
 */

?>
	<section id="secondary" class="main-sidebar widget-area clearfix" role="complementary">

		<?php // Check if Sidebar has widgets.
		if ( is_active_sidebar( 'sidebar' ) ) :

			dynamic_sidebar( 'sidebar' );

			// Show hint where to add widgets.
		else : ?>

			<aside class="widget clearfix">
				<div class="widget-header"><h3 class="widget-title"><?php esc_html_e( 'Main Sidebar', 'gambit' ); ?></h3></div>
				<div class="textwidget">
					<p><?php esc_html_e( 'Please go to Appearance &#8594; Widgets and add some widgets to your sidebar.', 'gambit' ); ?></p>
				</div>
			</aside>

	<?php endif; ?>

	</section><!-- #secondary -->
