<div id="contentSecondBar" class="sidebar">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(3) ) : // begin secondary sidebar widgets ?>
  <?php endif; // end primary sidebar widgets  ?>
  <?php if ( is_single() && function_exists('related_entries') ) : ?>
  <div class="widget"><?php related_entries(); ?></div>
  <?php endif; ?>
</div>