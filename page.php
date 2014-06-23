<?php get_header() ?>

<?php the_post() ?>

  <article id="content" class="<?php post_class(array('wrapper', 'container', 'clearfix')) ?>">
    <div class="inner">
      <h1 class="title"><?php the_title() ?></h1>
      <aside class="meta">

        <?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail'); } ?>

        <ul<?php if ( !has_post_thumbnail() ) { ?> class="nothumb"<?php } ?>>
          <li class="date"><?php the_date(); ?></li>
          <li class="author"><?php the_author_posts_link(); ?></li>

        <?php if ( has_tag() ) { ?>
          <li class="tag"><?php the_tags('',', ', ''); ?></li>
        <?php } ?>

        <?php if ( has_category() ) { ?>
          <li class="category"><?php the_category(' '); ?></li>
        <?php }  ?>

          <li class="comments"><?php comments_popup_link( __( 'Comments (0)', 'translate' ), __( 'Comments (1)', 'translate' ), __( 'Comments (%)', 'translate' ) ) ?></li>
        </ul>
      </aside>
      <div class="content">

        <?php the_content() ?>
        <?php wp_link_pages('before=<div class="page-link">' . __('Pages:', 'translate') . '&after=</div>') ?>

      </div>

      <?php if ( comments_open() ) { comments_template(); } ?>

    </div>
  </article><!-- .post -->

<?php get_footer() ?>
