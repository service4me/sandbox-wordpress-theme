<?php if ( is_active_sidebar( 'content-before' ) ) : ?>
<aside id="contentBefore">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('content-before') ) : // begin secondary sidebar widgets ?>
  <form id="searchform" class="blog-search" method="get" action="<?php bloginfo('home') ?>">
    <input id="s" name="s" type="text" class="text" title="Suchen..." placeholder="Suchen..." size="10" />
    <input class="button" type="submit" class="button" value="Finden" title="Finden" />
  </form>
  <?php endif; // end primary sidebar widgets  ?>
</aside>
<?php endif; ?>