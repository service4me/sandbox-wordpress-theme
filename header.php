<!--[if IE_NEEDS_THIS]><![endif]-->
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie10 lt-ie9 lt-ie8 ie7"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie10 lt-ie9 ie8"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10 ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo('charset') ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php is_front_page() ? bloginfo('description') : wp_title( '');?> - <?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?></title>
  <meta name="description" content="<?php is_front_page() ? bloginfo('description') : is_single() ? wp_specialchars( the_excerpt(), 1) : wp_title( '');?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta property="og:title" content="<?php is_front_page() ? bloginfo('description') : wp_title( '');?> - <?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?>" />
  <meta property="og:type" content="<?php if ( is_single() ) { ?>article<?php } else { ?>Website<?php } ?>" />
  <meta property="og:url" content="<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
  <meta property="og:image" content="<?php if ( is_single() && has_post_thumbnail() ) { 

      echo wp_get_attachment_image_src(get_post_thumbnail_id(),’large’, true);;

    } else {

      echo bloginfo('template_directory'), '/img/logo.jpg';

    } ?>" />
  <meta property="og:description" content="<?php if ( is_front_page() ) {

      bloginfo('description');

    } else {

      if ( is_single() ) {

        echo htmlspecialchars( get_the_excerpt() );

      } else {
        
        wp_title('');

      }

    } ?>" />
  <meta property="og:locale" content="de_AT" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url') ?>" />
  <script src="<?php bloginfo('template_directory') ?>/js/modernizr-2.6.1-respond-1.1.0.min.js" /></script>
  <?php wp_head() // For plugins ?>
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'netzgestaltung' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
</head>
<body <?php body_class() ?>>
  <header>
    <<?php if ( is_front_page() ) { echo 'h1'; } else { echo 'h2'; } ?> id="blog-title">
      <a href="<?php bloginfo('home') ?>/" title="<?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?>" rel="home"><span><?php bloginfo('name') ?> <?php bloginfo('description') ?></span></a>
    </<?php if ( is_front_page() ) { echo 'h1'; } else { echo 'h2'; } ?>>
    <form id="searchform" class="blog-search" method="get" action="<?php bloginfo('home') ?>">
      <input id="s" name="s" type="text" class="text" title="Suchen..." placeholder="Suchen..." size="10" />
      <input class="button" type="submit" class="button" value="Finden" title="Finden" />
    </form>
    <?php get_sidebar('header') ?>
  </header><!--  #header -->
  <div id="mainbody" class="clearfix wrapper">
    <?php get_sidebar('content-first') ?>