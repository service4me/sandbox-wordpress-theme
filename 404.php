<?php get_header() ?>

		<article id="post-0" class="post error404 not-found">
			<h2 class="title"><?php _e( 'Not Found', 'sandbox' ) ?></h2>
			<div class="content">
				<p><?php printf(__( 'Apologies, but we were unable to find what you were looking for. Perhaps  searching will help.', 'translate' )); ?></p>
			</div>
			<form id="searchform-404" class="blog-search" method="get" action="<?php bloginfo('home') ?>">
				<div>
					<input id="s-404" name="s" class="text" type="text" value="<?php the_search_query() ?>" size="40" />
					<input class="button" type="submit" value="<?php printf(__e( 'Find', 'translate' )); ?>" />
				</div>
			</form>
		</article><!-- .post -->

<?php get_footer() ?>