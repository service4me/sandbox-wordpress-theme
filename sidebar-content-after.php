<?php if ( is_dynamic_sidebar( 'content-after' ) ) : ?>
<aside id="contentAfter">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('content-after') ) : // begin secondary sidebar widgets ?>
  <?php endif; // end primary sidebar widgets  ?>
  <?php if ( is_single() && function_exists('related_entries') ) : ?>
  <div class="widget"><?php related_entries(); ?></div>
  <?php endif; ?>
</aside>
<?php endif; ?>