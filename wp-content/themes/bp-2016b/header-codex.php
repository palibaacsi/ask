<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '' ); ?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/inc/css/behave.css" media="screen" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/inc/css/code-guide.css" media="screen" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/inc/css/core-wordpress.css" media="screen" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/inc/css/custom.css" media="screen" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/inc/css/font-awesome.css" media="screen" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/inc/css/global.css" media="screen" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/inc/css/prism.css" media="screen" type="text/css" />

<?php wp_head(); 
/*

<link rel="stylesheet" href="<?php get_stylesheet_directory_uri(); ?>/inc/css/behave.css" media="screen" type="text/css" />
<link rel="stylesheet" href="<?php get_stylesheet_directory_uri(); ?>/inc/css/custom.css" media="screen" type="text/css" />

*/

?>
</head>
<body <?php body_class(); ?>>

<?php /* if (is_page( 87 )) {
	peta_branding_bar();
} */ ?>


<div id="top"></div>
<a href="#top" id="up"><i class="fa fa-angle-up fa-3x"></i></a>
<header class="masthead">
		<div class="status-board-button">Show Site Statuses</div>
		<div class="status-board">
		<table cellspacing="0" cellpadding="0">
		<?php /*
			$rows = get_field('sites', 267);
			foreach($rows as $row){
				$site_name = $row['site_name'];
				$site_status = $row['site_status'];
				if($site_status == 'green'){
					$site_status = '<span style="color:green;">•</span>';
				}
				else if($site_status == 'yellow'){
					$site_status = '<span style="color:yellow;">•</span>';
				}
				else{
					$site_status = '<span style="color:red;">•</span>';
				}
				$hold = $row['reason_for_hold'];
				?>
				<tr><td class="site-status"><?php echo $site_status; ?></td><td class="site-name"><?php echo $site_name; ?></td><td class="hold"><?php if(!empty($hold)){echo $hold;} ?></td></tr>
		<?php
			} */
		?>
		</table>
		</div>
    <div class="container">
        <a href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo( 'name' ); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/inc/images/logo-peta-codex.png" alt="<?php bloginfo( 'name' ); ?>" width="" height="" /></a>
        <h1><?php //bloginfo( 'name' ); ?></h1>
        <p class="lead"><?php bloginfo( 'description' ); ?></p>
        <?php get_search_form(); ?>
    </div>
</header>
<div class="main_menu">

    <div class="mobile_nav_btn"><i class="fa fa-angle-double-down fa-2x"></i></div>
    <?php wp_nav_menu( array( 'theme_location' => 'top-navigation' ) ); ?>
</div>