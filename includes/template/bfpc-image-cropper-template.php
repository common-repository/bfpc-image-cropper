<?php
/**
* Template Name: Burglar Floor Planner Page
*
* [wpwc_bfpc_floor_planner_editor] 
*/
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="profile" href="https://gmpg.org/xfn/11" />
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>

		<?php echo do_shortcode('[wpwc_bfpc_floor_planner_editor] '); ?>

		<?php wp_footer(); ?>

	</body>
</html>
