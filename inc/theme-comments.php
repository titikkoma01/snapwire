<?php
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own gab_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function gab_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		
		<div id="comment-<?php comment_ID(); ?>">
		
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 30 ); ?>
			<strong><?php printf( __( '%s '), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></strong><br />
			<span class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s - %2$s' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '#' ), ' ' );
				?>
			</span><!-- .comment-meta .commentmetadata -->			
			
			<div class="clear"></div>
		</div><!-- .comment-author .vcard -->
		
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<p class="waiting_approval"><em><?php _e( 'Your comment is awaiting moderation.', 'snapwire' ); ?></em></p>
		<?php endif; ?>

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
		break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'snapwire' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('#'), ' ' ); ?></p>
	<?php
		break;
	endswitch;
}