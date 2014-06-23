<footer id="siteFooter" class="region container clearfix site-footer">
  <div class="inner wrapper">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer') ) : // begin secondary sidebar widgets ?>
    <div class="content"><p>&copy; <?php echo date('Y'); ?> - Netzgestaltung.at - Web Services &amp; IT-Dienstleistungen</p></div>
    <?php endif; // end primary sidebar widgets  ?>
  </div>
</footer>
