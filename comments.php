<?php	

	if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) ) {

		die ( 'Please do not load this page directly. Thanks.' );

	}

?>
<section id="comments">
<?php	if ( post_password_required() ) { ?>

	<div class="nopassword"><?php _e( 'This post is protected. Enter the password to view any comments.', 'translate' ) ?></div>
</div><!-- .comments -->
<?php	return; ?>

<?php	} ?>

<?php if ( comments_open() ) { ?>

	<div id="respond">
  	<h3><a class="write" href="#commentform"><?php comment_form_title(__('Post a Comment', 'translate'), __('Reply to %s', 'translate')); ?></a></h3>

  <?php if ( get_option('comment_registration') && !is_user_logged_in() ) { ?>

	  <p id="login-req"><?php printf(__('You must be <a href="%s" title="Log in">logged in</a> to post a comment.', 'translate'), get_bloginfo('wpurl') . '/wp-login.php?redirect_to=' . get_permalink() ) ?></p>

  <?php } else { ?>

		<form id="commentform" action="<?php bloginfo('wpurl') ?>/wp-comments-post.php" method="post">

    <?php if ( is_user_logged_in() ) { ?>

		  <p id="login"><?php printf( __( '<span class=\"loggedin\">Logged in as <a href=\"%1$s\" title=\"Logged in as %2$s\">%2$s</a>.</span> <span class=\"logout\"><a href=\"%3$s\" title=\"Log out of this account\">Log out?</a></span>', 'translate' ), get_bloginfo('wpurl') . '/wp-admin/profile.php', wp_specialchars( $user_identity, 1 ), get_bloginfo('wpurl') . '/wp-login.php?action=logout&amp;redirect_to=' . get_permalink() ) ?></p>

    <?php } else { ?>

      <p id="comment-notes"><?php _e( 'Your email is <em>never</em> published nor shared.', 'translate' ) ?> <?php if ($req) _e( 'Pflichtferder sind mit <span class="required">*</span> markiert', 'translate' ) ?></p>
			<label for="author"><?php _e( 'Name', 'translate' ) ?> <?php if ($req) _e( '<span class="required">*</span>', 'translate' ) ?></label>
			<input id="author" name="author" class="text<?php if ($req) echo ' required'; ?>" type="text" value="<?php echo $comment_author ?>" size="30" maxlength="50" tabindex="3" />
			<label for="email"><?php _e( 'Email', 'translate' ) ?> <?php if ($req) _e( '<span class="required">*</span>', 'translate' ) ?></label>
			<input id="email" name="email" class="text<?php if ($req) echo ' required'; ?>" type="text" value="<?php echo $comment_author_email ?>" size="30" maxlength="50" tabindex="4" />
			<label for="url"><?php _e( 'Website', 'translate' ) ?></label>
			<input id="url" name="url" class="text" type="text" value="<?php echo $comment_author_url ?>" size="30" maxlength="50" tabindex="5" />

    <?php } // REFERENCE: * if ( is_user_logged_in() ) ?>

			<label for="comment"><?php _e( 'Comment', 'translate' ) ?></label>
			<textarea id="comment" name="comment" class="text required" cols="45" rows="8" tabindex="6"></textarea>
			<p><small><strong>HTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>
			<input id="submit" name="submit" class="button" type="submit" value="<?php _e( 'Post Comment', 'translate' ) ?>" tabindex="7" />

			<?php comment_id_fields(); ?>
			<?php do_action('comment_form', $post->ID) ?>

		</form><!-- #commentform -->

  <?php } // REFERENCE: if ( get_option('comment_registration') && !is_user_logged_in() ) ?>

  </div><!-- #respond -->

<?php } // REFERENCE: if ( comments_open() ) ?>

<?php if ( have_comments() ) { ?>

  <section class="comments">

	  <h3><?php comments_number(__('No Comments', 'translate'), __('<span>One</span> Comment', 'translate'), __('<span>%d</span> Comments', 'translate') );?></h3>
    <ol>
      <?php 

        wp_list_comments(array(

        	'avatar_size' => 40,
        	'format' => 'html5'

        )); 

      ?>
    </ol>
  </section><!-- #comments-list .comments -->

<?php } // REFERENCE: if ( have_comments() ) ?>

</section><!-- #comments -->
