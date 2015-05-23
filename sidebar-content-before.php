<?php if ( is_active_sidebar( 'content-before' ) ) : ?>
<aside id="contentBefore" class="wrapper sidebar content-before region container">
  <div class="inner">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('content-before') ) : // begin secondary sidebar widgets ?>
  <?php endif; // end primary sidebar widgets  ?>
  </div>
</aside>
<?php endif; ?>
