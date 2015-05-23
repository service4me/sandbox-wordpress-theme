<footer id="siteFooter" class="region container clearfix site-footer">
  <div class="inner wrapper">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer') ) : // begin secondary sidebar widgets ?>
    <div class="content"><p><?php echo date('Y'); ?> by <a href="http://www.service4me.at">service4me</a> and <a href="http://www.netzgestaltung.at" target="_blank">Netzgestaltung</a> under <a href="https://github.com/service4me/sandbox-drupal7-theme/blob/master/LICENSE" target="_blank">GPLv3</a></p></div>
    <?php endif; // end primary sidebar widgets  ?>
  </div>
</footer>
