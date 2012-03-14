<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to gab_comment which is
 * located in the functions.php file.
 */
?>

<div id="comments" class="holder margin_bottom_25">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'snapwire' ); ?></p>
	</div><!-- #comments -->

	<?php
	/* Stop the rest of comments.php from being processed,
	 * but don't kill the script entirely -- we still have
	 * to fully load the template.
	 */
	return;
	endif;

		// You can start editing here -- including this comment!
	?>

	<?php if ( have_comments() ) : ?>
		<h3 id="comments-title">
			<?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'snapwire' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?>
		</h3>

	<?php if ( get_comment_pages_count() > 1 && of_get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<div class="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'snapwire' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'snapwire' ) ); ?></div>
		</div> <!-- /navigation -->
	<?php endif; // check for comment navigation ?>

	<ol class="commentlist">
		<?php
		/* Loop through and list the comments. Tell wp_list_comments()
		 * to use gab_comment() to format the comments.
		 * If you want to overload this in a child theme then you can
		 * define gab_comment() and that will be used instead.
		 * See gab_comment() in includes/theme-comments.php
		 */
		wp_list_comments( array( 'callback' => 'gab_comment' ) );
		?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 && of_get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<div class="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'snapwire' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'snapwire' ) ); ?></div>
		</div> <!-- /navigation -->
	<?php endif; // check for comment navigation ?>

	<?php else : // or, if we don't have comments:

		/* If there are no comments and comments are closed,
		 * let's leave a little note, shall we?
		 */
		if ( ! comments_open() ) :
			/* <p class="nocomments"><?php _e( 'Comments are closed.', 'snapwire' ); ?></p> */
		endif; // end ! comments_open() ?>

	<?php endif; // end have_comments() ?>

	<?php if (of_get_option('comment_registration') && !$user_ID) : ?>
		<p>
			<?php _e('You must be logged in to post a comment' , 'snapwire'); ?> 
			<a href="<?php echo of_get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">
				<?php _e('Login' , 'snapwire'); ?>
			</a>
		</p>
	<?php else : ?>

	<?php comment_form(); ?>

	<?php endif; ?>

</div><!-- #comments -->