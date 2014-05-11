<?php get_header() ?>
	
	<section class="articles">

	<?php if ( is_tag()  || is_category() || is_author() ) : ?>

		<?php if ( is_tag() ) : $taxonomyDesc = tag_description(); ?>
		<h1 class="title"><?php single_tag_title() ?></h1>

		<?php elseif ( is_category() ) : $taxonomyDesc = category_description(); ?>
		<h1 class="title"><?php single_cat_title() ?></h1>

		<?php elseif ( is_author() ) : 

			$curauth = get_query_var('author_name') ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author');
			$taxonomyDesc = get_the_author_meta('description', $curauth->ID);
			$taxonomyImage = get_avatar( get_the_author_meta('ID', $curauth->ID), 200 );

		?>
		<h1 class="title"><?php the_author(); ?></h1>

		<?php endif; ?>


		<?php if ( !empty($taxonomyDesc) || !empty($taxonomieImage) ) : ?>

		<aside class="meta">

			<?php if ( !empty($taxonomyDesc) ) : ?>

			<p><?php echo $taxonomyDesc; ?></p>

			<?php endif; ?>

			<?php if ( !empty($taxonomyImage) ) : ?>

			<?php echo $taxonomyImage; ?>

			<?php endif; ?>

		</aside>

		<?php endif; ?>

	<?php elseif ( is_date() ) : ?>

	  <?php if ( is_day() ) : ?>
		<h1 class="title"><?php printf( __('Daily Archives: <span>%s</span>', 'translate'), get_the_time(get_option('date_format')) ) ?></h1>
	  <?php elseif ( is_month() ) : ?>
		<h1 class="title"><?php printf( __('Monthly Archives: <span>%s</span>', 'translate'), get_the_time('F Y') ) ?></h1>
	  <?php elseif ( is_year() ) : ?>
		<h1 class="title"><?php printf( __('Yearly Archives: <span>%s</span>', 'translate'), get_the_time('Y') ) ?></h1>
	  <?php elseif ( is_paged() ) : ?>
		<h1 class="title"><?php _e( 'Blog Archives', 'translate' ) ?></h1>
	  <?php endif; ?>

	  <?php rewind_posts() ?>

	<?php endif; ?>

  <? if ( have_posts() ) { ?>

    <?php while ( have_posts() ) : the_post() ?>

		<article id="post-<?php the_ID() ?>" class="<?php post_class() ?> clearfix">
			<h2 class="title"><a href="<?php the_permalink() ?>" title="<?php printf( __('Permalink to %s', 'translate'), the_title_attribute('echo=0') ) ?>" rel="bookmark"><?php the_title() ?></a></h2>

			<?php if ( has_post_thumbnail() ) { ?>

			<aside class="meta">
				<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
			</aside>

			<?php } ?>

			<div class="content">

			<?php if ( has_excerpt() ) { ?>

				<?php the_excerpt(); ?>
				<a class="more" href="<?php echo get_permalink(); ?>"><?php printf( __('Read More <span class="meta-nav">&raquo;</span>', 'translate') ); ?></a>

			<?php } else { ?>

				<?php the_content(__('Read More <span class="meta-nav">&raquo;</span>', 'translate')); ?>

			<?php } ?>

			  <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'translate' ) . '&after=</div>'); ?>

			</div>
		</article><!-- .post -->

    <?php endwhile; ?>

		<?php if ( is_paged() ) { ?>

	    <?php if ( function_exists('wp_pagenavi') ) { 

	    	wp_pagenavi(); // http://wordpress.org/plugins/wp-pagenavi/

	    } else { 

	    ?>		
	    
			<nav id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older results', 'translate' ) ) ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer results <span class="meta-nav">&raquo;</span>', 'translate' ) ) ?></div>
			</nav>

	    <?php } ?>

	<?php } else { ?>

		<article id="post-0" class="post no-results not-found">
			<h2 class="title"><?php printf(__( 'Not Found', 'translate' )); ?>  :-(</h2>
			<div class="content">
				<p><?php 

				  if ( is_tag() ) {

						printf(__('No posts written tagged with', 'translate') . ' ' . single_tag_title(false));

				  } elseif is_category() ) {

						printf(__('No posts written in', 'translate') . ' ' . single_cat_title(false));

				  } elseif ( is_author() ) {

				  	printf(get_the_author() . ' ' . __("didn't wrote a post yet.", 'translate')); // 'hat noch keine Artikel verfasst.'

				  } else { 

				  	printf(__('Apologies, but we were unable to find what you were looking for. Perhaps  searching will help.', 'translate')); 

				  } 

				?></p>
  		  <a href="<?php bloginfo('home'); ?>"><?php printf(__('Go to the homepage', 'translate')); // 'zur Startseite gehen' ?></a></p>
			</div>
			<form id="searchform-no-results" class="blog-search" method="get" action="<?php bloginfo('home'); ?>">
				<input id="s-no-results" name="s" class="text" type="text" value="<?php the_search_query() ?>" size="40" />
				<input class="button" type="submit" value="<?php printf(__('Find', 'translate')); ?>" />
  		</form>
		</article><!-- .post -->

	<?php } ?>

	</section>

<?php get_footer() ?>