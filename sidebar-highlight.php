<?php if ( is_active_sidebar( 'highlight' ) ) : ?>
<aside id="highlightBar" class="sidebar clearfix">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('highlight') ) : // begin secondary sidebar widgets ?>
  <?php endif; // end primary sidebar widgets  ?>
</aside>
<?php endif; ?>