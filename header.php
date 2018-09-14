<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<link href='http://fonts.googleapis.com/css?family=Julius+Sans+One' rel='stylesheet' type='text/css'>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2TonSn0rjKa9eLkmJZveZnqx6Ni2tBPg"></script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- New Bellaworks Server -->
 <div id="header-cont">
    <div id="header">
    	 <?php if(is_home()) { ?>
            <h1 class="logo"><a href="<?php bloginfo('url'); ?>">LeanAgileTraining</a></h1>
        <?php } else { ?>
            <div class="logo"><a href="<?php bloginfo('url'); ?>">LeanAgileTraining</a></div>
        <?php } ?>
        
        
        <div id="sociallinks">
           	<ul>
            		
                  <li class="twitter">
                  	<a href="https://twitter.com/jhlittle" target="_blank">Follow Lean AgileTraining on Twitter</a>
                  </li>
                  <li class="linkedin">
                  	<a href="http://www.linkedin.com/in/joelittle" target="_blank">Join Lean AgileTraining on LinkedIn</a>
                  </li>
                  
            	</ul>
                <div class="otherinfo"><a href='mailt&#111;&#58;inf&#111;&#64;l&#101;anag&#105;le%7&#52;raini&#110;&#103;&#46;%&#54;3o&#37;&#54;D'>inf&#111;&#64;&#108;eana&#103;&#105;&#108;etra&#105;n&#105;ng&#46;com</a> | <!-- 704.376.8881 -->(800) 209-1280</div>
                
                
                
           </div><!-- sociallinks -->
           
           
          <?php get_template_part('inc/websignup'); ?>
           
           
           </div><!-- websignupform -->
           
        
    </div><!-- header -->
 </div><!-- header-cont --> 
    
		
       <div id="nav">
       <div id="nav-cont"> 

       <header id="masthead" class="site-header" role="banner">
        <nav id="site-navigation" class="main-navigation" role="navigation">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'MENU', 'acstarter' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->
    </header>

        </div>
        </div>

	

<div id="main" class="wrapper">
	