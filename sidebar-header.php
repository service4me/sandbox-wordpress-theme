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
</nav>
<?php } ?>

