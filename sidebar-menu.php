<?php if ( is_active_sidebar( 'menu' ) ) { ?>
<section id="menuBar" class="menu-bar container sidebar region">
  <div class="inner wrapper clearfix">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('menu') ) : // begin primary sidebar widgets ?>
  <?php endif; // end primary sidebar widgets  ?>
  </div>
</aside>
<?php } else { ?>
<nav id="menuBar" class="menu-bar container sidebar clearfix">
  <div class="inner wrapper clearfix">
  <?php  wp_nav_menu( array(

    'container'       => 'ul',
    'container_class' => 'menu {menu slug}',
    'container_id'    => 'menu-{menu slug}'

  ) ); ?>
  </div>
</nav>
<?php } ?>
