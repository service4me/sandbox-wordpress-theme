<?php
  header("Content-type: text/css; charset: UTF-8");

echo var_dump(blah());
  /**
   * Color variables
   * ===============
   * set by admin settings page
   */
  $bg                = get_theme_option('color_scheme_bg');
  $titleslogan       = get_theme_option('color_scheme_titleslogan');
  $text              = get_theme_option('color_scheme_text');
  $link              = get_theme_option('color_scheme_link');
  $first_background  = get_theme_option('color_scheme_first_background');
  $first_text        = get_theme_option('color_scheme_first_text');
  $second_background = get_theme_option('color_scheme_second_background');
  $second_text       = get_theme_option('color_scheme_second_text');
  $second_border     = get_theme_option('color_scheme_second_border');
?>
body{
  background:<?php echo $bg; ?>;
  color:<?php echo $text; ?>;
}
a:link,
a:visited{
  color:<?php echo $link; ?>;
}
.name-slogan,
.name-slogan a,
.main .title,
.main .title a {
  color:<?php echo $titleslogan; ?>;
}
.menu-bar > .inner,
.menu-bar .block-menu ul ul,
.menu-bar .main-menu ul,
.menu-bar .menu ul ul{
  background:<?php echo $first_background; ?>;
  color:<?php echo $first_text; ?>;
}
.menu-bar a:link,
.menu-bar a:visited{
  color:<?php echo $first_text; ?>;
}
.header-bar .menu,
.header-bar .sub-menu,
.main aside .block,
.main aside .widget{
  background:<?php echo $second_background; ?>;
  color:<?php echo $second_text; ?>;
}
.header-bar a,
.main aside a{
  color:<?php echo $second_text; ?>;
}
.main aside li + li{
  border-top:1px solid;
  border-color:<?php echo $second_border; ?>;
}
