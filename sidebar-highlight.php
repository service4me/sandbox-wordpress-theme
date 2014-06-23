<?php if ( is_active_sidebar( 'highlight' ) ) : ?>
<aside id="highlightBar" class="container sidebar clearfix highlights region">
  <div class="inner wrapper">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('highlight') ) : // begin secondary sidebar widgets ?>
  <?php endif; // end primary sidebar widgets  ?>
  </div>
</aside>
<?php endif; ?>
