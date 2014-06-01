<?php if ( is_active_sidebar( 'content-before' ) ) : ?>
<aside id="contentBefore">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('content-before') ) : // begin secondary sidebar widgets ?>
  <?php endif; // end primary sidebar widgets  ?>
</aside>
<?php endif; ?>