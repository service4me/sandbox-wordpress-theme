<div class="footer-container">
  <footer class="sidebar wrapper clearfix site-footer">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer') ) : // begin secondary sidebar widgets ?>
    <div class="content"><p>&copy; <?php echo date('Y'); ?> - Netzgestaltung.at - Web Services &amp; IT-Dienstleistungen</p></div>
    <?php endif; // end primary sidebar widgets  ?>
  </footer>
</div>