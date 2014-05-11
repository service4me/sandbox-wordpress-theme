<?php get_header() ?>

	<? if ( have_posts() ) { ?>
	
	<section class="articles">
		<h1 class="title"><?php printf(__( 'Search Results for:', 'translate' )); ?> <strong><?php the_search_query(); ?></strong></h1>

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
	    
    <?php } ?>

	</section>

	<?php } else { ?>

		<article id="post-0" class="post no-results not-found">
			<h2 class="title"><?php printf(__( 'Not Found', 'translate' )); ?>  :-(</h2>
			<div class="content">
				<p><?php printf(__('Apologies, but we were unable to find what you were looking for. Perhaps  searching will help.', 'translate')); ?></p>
				<p><a href="<?php bloginfo('home'); ?>"><?php printf(__('Go to the homepage', 'translate')); // 'zur Startseite gehen' ?></a></p>
			</div>
			<form id="searchform-no-results" class="blog-search" method="get" action="<?php bloginfo('home'); ?>">
				<input id="s-no-results" name="s" class="text" type="text" value="<?php the_search_query() ?>" size="40" />
				<input class="button" type="submit" value="<?php printf(__('Find', 'translate')); ?>" />
  		</form>
		</article><!-- .post -->

	<?php } ?>

<?php get_footer() ?>