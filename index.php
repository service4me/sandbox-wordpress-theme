<?php get_header() ?>

	<? if ( have_posts() ) { ?>
	
	<section class="articles">

    <?php while ( have_posts() ) : the_post() ?>

		<article id="post-<?php the_ID() ?>" class="<?php post_class() ?> clearfix">
			<<?php if ( is_front_page() ) { echo 'h2'; } else { echo 'h1'; } ?> class="title">
			  <a href="<?php the_permalink() ?>" title="<?php printf( __('Permalink to %s', 'translate'), the_title_attribute('echo=0') ) ?>" rel="bookmark"><?php the_title() ?></a>
			</<?php if ( is_front_page() ) { echo 'h2'; } else { echo 'h1'; } ?>>

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

	<?php } ?>

<?php get_footer() ?>