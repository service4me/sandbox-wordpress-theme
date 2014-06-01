<?php if ( is_active_sidebar( 'header' ) ) { ?>
<aside id="headerBar" class="sidebar clearfix">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('header') ) : // begin primary sidebar widgets ?>
  <?php endif; // end primary sidebar widgets  ?>
</aside>
<?php } else { ?>
<nav id="headerBar" class="sidebar clearfix">
  <?php  wp_nav_menu( array(

    'container'       => 'ul', 
    'container_class' => 'menu {menu slug}', 
    'container_id'    => 'menu-{menu slug}'

  ) ); ?>
  <form id="searchform" class="blog-search" method="get" action="<?php bloginfo('home') ?>">
    <input id="s" name="s" type="text" class="text" title="Suchen..." placeholder="Suchen..." size="10" />
    <input class="button" type="submit" class="button" value="Finden" title="Finden" />
  </form>
</nav>
<?php } ?>

