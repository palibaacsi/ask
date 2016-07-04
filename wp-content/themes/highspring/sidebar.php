<?php
/**
 * The sidebar template.
 * @package highwind
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php highwind_sidebar_before(); ?>

<aside class="sidebar" role="complementary">

	<?php highwind_sidebar_top();

	if ( ! is_front_page() ) {
		dynamic_sidebar( 'primary-sidebar' );
	}

	highwind_sidebar_bottom(); ?>

</aside>

<?php highwind_sidebar_after();
