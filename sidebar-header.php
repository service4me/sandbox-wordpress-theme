<?php if ( is_active_sidebar( 'header' ) ) { ?>
<aside id="headerBar" class="sidebar region header-bar">
  <div class="inner clearfix">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('header') ) : // begin primary sidebar widgets ?>
  <?php endif; // end primary sidebar widgets  ?>
  </div>
</aside>
<?php } ?>
