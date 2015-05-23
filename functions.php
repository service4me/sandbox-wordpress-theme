<?php
/*
This file is part of sandbox.

sandbox is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or (at your option) any later version.

sandbox is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with sandbox. If not, see http://www.gnu.org/licenses/.
*/

function sandbox_scripts_load(){
	// local jquery load
	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri() . '/includes/initializr/js/vendor/jquery-1.11.0.min.js', false, null, true);
	wp_enqueue_script('jquery');

	wp_deregister_script('modernizr');
	wp_register_script('modernizr', get_template_directory_uri() . '/includes/initializr/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js', false, null, true);
	wp_enqueue_script('modernizr');

	// comments reply script
	if (!is_admin()) {
		if ( is_singular() && comments_open() && (get_option('thread_comments') == 1 ) ) {
			wp_enqueue_script('comment-reply');
		}
	}

  // custom script: edit there for your own needs
	wp_register_script('actions', get_template_directory_uri() . '/js/actions.js', false, null, true);
	wp_enqueue_script('actions');
}

// add custom styles for plugin settings page
function sandbox_admin_styles_load() {
	wp_register_style('ng_admin', get_template_directory_uri() . '/admin/style.css');
	wp_enqueue_style('ng_admin');
}

// For category lists on category archives: Returns other categories except the current one (redundant)
function sandbox_cats_meow($glue) {
	$current_cat = single_cat_title( '', false );
	$separator = "\n";
	$cats = explode( $separator, get_the_category_list($separator) );
	foreach ( $cats as $i => $str ) {
		if ( strstr( $str, ">$current_cat<" ) ) {
			unset($cats[$i]);
			break;
		}
	}
	if ( empty($cats) )
		return false;

	return trim(join( $glue, $cats ));
}

// For tag lists on tag archives: Returns other tags except the current one (redundant)
function sandbox_tag_ur_it($glue) {
	$current_tag = single_tag_title( '', '',  false );
	$separator = "\n";
	$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
	foreach ( $tags as $i => $str ) {
		if ( strstr( $str, ">$current_tag<" ) ) {
			unset($tags[$i]);
			break;
		}
	}
	if ( empty($tags) )
		return false;

	return trim(join( $glue, $tags ));
}

// Widgets plugin: intializes the plugin after the widgets above have passed snuff
function sandbox_sidebars_init() {

	if ( !function_exists('register_sidebar') ) {
		return;
	}

	$sidebars = array('header', 'menu', 'highlight', 'content-before', 'content-after', 'footer');

	foreach ( $sidebars as $sidebar ) {
		register_sidebar(array(
			'name' => $sidebar,
			'id'   => 'sidebar-' . $sidebar,
			'before_widget'  =>   '<div class="widget clearfix">',
			'after_widget'   =>   '</div>',
			'before_title'   =>   '<h3 class="title">',
			'after_title'    =>   '</h3>'
		));
	}

  // Special markup for widget pages
	if ( $sidebar === 'menu' ) {

	  $config['before_widget'] = '<nav class="widget clearfix">';
	  $config['after_widget']  = '</nav>';

	}

}


function sandbox_breadcrumbs() { // http://dimox.net/wordpress-breadcrumbs-without-a-plugin/

	/* === OPTIONS === */
	$text['youarehere'] = __('You are here &raquo;', 'translate'); // 'Sie befinden sich hier &raquo; ';
	$text['home']     = __('Home', 'translate'); // 'Home'; // text for the 'Home' link
	$text['category'] = '%s'; // text for a category page
	$text['search']   = '%s'; // text for a search results page
	$text['tag']      = '%s'; // text for a tag page
	$text['author']   = '%s'; // text for an author page
	$text['404']      = __('Error 404', 'translate'); // 'Error 404'; // text for the 404 page

	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$showOnHome  = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter   = ' &raquo; '; // delimiter between crumbs
	$before      = '<span class="current">'; // tag before the current crumb
	$after       = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$homeLink = get_bloginfo('url') . '/';
	$linkBefore = '<span>';
	$linkAfter = '</span>';
	$link = $linkBefore . '<a href="%1$s">%2$s</a>' . $linkAfter;

	if (is_home() || is_front_page()) {

		if ($showOnHome == 1) echo '<nav class="breadcrumb">' . $text['youarehere'] . '<a href="' . $homeLink . '">' . $before . $text['home'] . $after . '</a></nav>';

	} else {

		echo '<nav class="breadcrumb">' . $text['youarehere'] . sprintf($link, $homeLink, $text['home']) . $delimiter;

		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
			}
			echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $linkBefore . '<a' . $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
				if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $linkBefore . '<a' . $cats);
			$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
				$post_meta = get_post_meta($post->ID);
			if ($showCurrent == 1) echo $before . $post_meta["shorttitle"][0] . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$post_meta = get_post_meta($post->ID);
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
			  $parent_meta = get_post_meta($page->ID);
				$breadcrumbs[] = sprintf($link, get_permalink($page->ID), $parent_meta["shorttitle"][0]);
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo $delimiter;
			}
			if ($showCurrent == 1) echo $delimiter . $before . $post_meta["shorttitle"][0] . $after;

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</nav>';

	}
}

// make the wysiwyg editor moveable
function action_add_meta_boxes() {

  global $_wp_post_type_features;

  foreach ( $_wp_post_type_features as $type => &$features ) {

    if ( isset($features['editor']) && $features['editor'] ) {

      unset($features['editor']);
      add_meta_box('description', __('Content'), 'content_metabox', $type, 'normal', 'high');

    }

  }

}

function content_metabox( $post ) {

  wp_editor($post->post_content, 'content', array('dfw' => true, 'tabindex' => 1) );

}

function the_breadcrumb( $before = null, $sep = ', ', $after = '', $pageTitle = '') {
	if ( null === $before )
		$before = __('Tags: ');

	$pageTitle = ' ' . $sep . ' ' . $pageTitle;
	$tagList = generate_the_tag_list($before, $sep, $after);

	if ( in_category( '5' ) ) {

		$tagList = '<a href="' . get_category_link( '5' ) . '">' . get_the_category_by_ID( '5' ) . '</a>';

	}

	echo $tagList . $pageTitle;

}

function sandbox_get_the_comments_link(){ // use this function only inside the loop.

  $comments_count = get_comments_number();
  $commentsListId = 'comments-list';
  $commentsFormId = 'response';

	if ( $comments_count == 0 ) {

	  $commentLink = '<a href="#' . $commentsFormId . '">' . $comments_count . ' ' . __('Be the first to Comment', 'translate') . '</a>'; // 'Schreib den ersten Kommentar';

	}  else if ( $comments_count > 1 ) {

	  $commentLink = '<a href="#' . $commentsListId . '">' . $comments_count . ' ' . __('Comments', 'translate') . '</a>'; // 'Kommentare';

	} else {

		$commentLink = '<a href="#' . $commentsListId . '">' . $comments_count . ' ' . __('Comment', 'translate') . '</a>'; // 'Kommentar';

	}

	return $commentLink;

}

function sandbox_the_comments_link(){ // use this function only inside the loop.

  echo sandbox_get_the_comments_link();

}

function generate_the_tag_list( $before = '', $sep = '', $after = '' ) {
return apply_filters( 'the_tags', generate_the_term_list( 0, 'post_tag', $before, $sep, $after ), $before, $sep, $after);
}

function generate_the_term_list( $id = 0, $taxonomy, $before = '', $sep = '', $after = '' ) {
	$terms = get_the_terms( $id, $taxonomy );

	if ( is_wp_error( $terms ) )
		return $terms;

	if ( empty( $terms ) )
		return false;

	foreach ( $terms as $term ) {
		$link = get_term_link( $term, $taxonomy );
		if ( is_wp_error( $link ) )
			return $link;
		$term_links[] = '<a href="' . $link . '"property="v:title" rel="v:url">' . $term->name . '</a>';
	}

  if ( strpos($term_links[1], 'Kolumne') !== false ) {
  	array_multisort($term_links, SORT_DESC );
  }
	$term_links = apply_filters( "term_links-$taxonomy", $term_links );

	return $before . join( $sep, $term_links ) . $after;

}

function sandbox_get_the_tag_title(){

	$terms = get_the_terms(0, 'post_tag');

	if ( is_wp_error( $terms ) ){	return $terms; }

	if ( empty( $terms ) ){ return false;	}

	foreach ( $terms as $term ) {

    if ( $term->name != 'Kolumne') {

    	$term_names[] = $term->name;

    }

	}

	return $term_names[0];

}

function sandbox_the_tag_title(){

  echo sandbox_get_the_tag_title();

}

function sandbox_get_the_tag_slug(){

	$terms = get_the_terms(0, 'post_tag');

	if ( is_wp_error( $terms ) ){	return $terms; }

	if ( empty( $terms ) ){ return false;	}

	foreach ( $terms as $term ) {

    if ( $term->slug != 'kolumne') {

    	$term_slugs[] = $term->slug;

    }

	}

	return $term_slugs[0];

}

function sandbox_the_tag_slug(){

  echo sandbox_get_the_tag_slug();

}

function sandbox_get_the_tag_id(){

	$terms = get_the_terms(0, 'post_tag');

	if ( is_wp_error( $terms ) )
		return $terms;

	if ( empty( $terms ) )
		return false;

	foreach ( $terms as $term ) {

  	$term_ids[] = $term->term_id;

	}

	return $term_ids[0];

}

function sandbox_the_tag_id(){

  echo sandbox_get_the_tag_id();

}

function sandbox_get_the_coauthor_meta( $field, $authorId ){

	$coauthors = get_coauthors();

	foreach( $coauthors as $coauthor) {

    if ( $coauthor->id == $authorId ) {

			$meta = $coauthor->$field;

		}

	}

	return $meta;

}

function sandbox_the_coauthor_meta( $field, $authorId ){

	echo sandbox_get_the_coauthor_meta( $field, $authorId );

}
/**
 * Admin Settings page
 * ===================
 */
function themename_customize_preview() {
    ?>
    <script type="text/javascript">
    ( function( $ ){
    wp.customize('blogname',function( value ) {
        value.bind(function(to) {
            $('#site-title a').html(to);
        });
    });
    wp.customize('blogdescription',function( value ) {
        value.bind(function(to) {
            $('#site-description').html(to);
        });
    });
    wp.customize( 'header_textcolor', function( value ) {
        value.bind( function( to ) {
            $('#site-title a, #site-description').css('color', to ? to : '' );
        });
    });
    } )( jQuery )
    </script>
    <?php
}

function sandbox_customize_register($wp_customize) {

  $wp_customize->add_section( 'sandbox_logo_section' , array(
    'title'       => __( 'Logo', 'sandbox' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description in the header',
  ) );
	$wp_customize->add_section( 'sandbox_color_scheme', array(
    'title'          => __( 'Color Scheme', 'sandbox' ),
    'priority'       => 35,
	) );

  $wp_customize->add_setting( 'sandbox_logo' );

	$wp_customize->add_setting( 'sandbox_theme_options[color_scheme_primary_color]', array(
    'default'        => '#FBC242',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
	) );
	$wp_customize->add_setting( 'sandbox_theme_options[color_scheme_secondary_color]', array(
    'default'        => '#FFE80F',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
	) );
	$wp_customize->add_setting( 'sandbox_theme_options[color_scheme_font_color]', array(
    'default'        => '#222222',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
	) );

  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sandbox_logo', array(
    'label'    => __( 'Logo', 'sandbox' ),
    'section'  => 'sandbox_logo_section',
    'settings' => 'sandbox_logo',
  ) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_scheme_primary_color', array(
    'label'   => __( 'Primary Color', 'sandbox' ),
    'section' => 'sandbox_color_scheme',
    'settings'   => 'sandbox_theme_options[color_scheme_primary_color]',
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_scheme_secondary_color', array(
    'label'   => __( 'Secondary Color', 'sandbox' ),
    'section' => 'sandbox_color_scheme',
    'settings'   => 'sandbox_theme_options[color_scheme_secondary_color]',
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_scheme_font_color', array(
    'label'   => __( 'Font Color', 'sandbox' ),
    'section' => 'sandbox_color_scheme',
    'settings'   => 'sandbox_theme_options[color_scheme_font_color]',
	) ) );

	if ( $wp_customize->is_preview() && ! is_admin() ) {
    add_action( 'wp_footer', 'themename_customize_preview', 21);
	}
	$wp_customize->get_setting('blogname')->transport='postMessage';
	$wp_customize->get_setting('blogdescription')->transport='postMessage';
	$wp_customize->get_setting('header_textcolor')->transport='postMessage';
}


add_theme_support('post-thumbnails');
add_theme_support('custom-background');
add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption') );
add_theme_support('custom-header');


// Translate, if applicable
load_theme_textdomain('translate', get_template_directory() . '/translations');

// Runs our code at the end to check that everything needed has loaded
add_action( 'init', 'sandbox_sidebars_init' );

// lets customize the theme
add_action( 'customize_register', 'sandbox_customize_register' );

// load scripts
add_action('wp_enqueue_scripts', 'sandbox_scripts_load');

// moveable content editor
add_action( 'add_meta_boxes', 'action_add_meta_boxes', 0 );

// add shortcodes to widgets
add_filter('widget_text', 'do_shortcode');
add_filter('widget_title', 'do_shortcode');

// Adds filters for the description/meta content in archives.php
add_filter( 'archive_meta', 'wptexturize' );
add_filter( 'archive_meta', 'convert_smilies' );
add_filter( 'archive_meta', 'convert_chars' );
add_filter( 'archive_meta', 'wpautop' );

// Remember: the sandbox is for play.
?>
