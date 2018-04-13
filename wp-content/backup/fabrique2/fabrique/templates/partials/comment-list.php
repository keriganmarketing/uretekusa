<?php
/**
 * Partial template file
 *
 * @package fabrique/templates/partials
 * @version 1.0.0
 */
?>

<?php $opts = fabrique_template_args( 'comment-list' ); ?>

<li <?php echo comment_class( null, null, null, false ); ?> id="comment-<?php echo get_comment_ID(); ?>" itemprop="review" itemscope="itemscope" itemtype="http://schema.org/Review">
	<div class="comment-article fbq-p-border-border">
		<?php if ( 'pingback' === $opts['comment']->comment_type || 'trackback' === $opts['comment']->comment_type ) : ?>
			<div class="comment-body">
				<div class="fbq-s-text-color">
					<?php esc_html_e( 'Pingback : ', 'fabrique' ); ?>
					<?php echo get_comment_author_link(); ?>
				</div>
				<div class="comment-content">
					<?php echo get_comment_text(); ?>
				</div>
			</div>
		<?php else : ?>
			<?php do_action( 'before_each_comment_body', $opts['comment'] ); ?>
			<div class="comment-avatar">
				<?php echo get_avatar( $opts['comment'], 60 ); ?>
			</div>
			<div class="comment-body">
				<div class="comment-meta">
					<div itemprop="author" class="comment-author fbq-secondary-font fbq-s-text-color">
						<?php echo get_comment_author_link(); ?>
					</div>
					<div class="comment-time">
						<time itemprop="datePublished" datetime="<?php echo get_comment_time( 'c' ); ?>">
							<?php echo get_comment_date() . ' ' . esc_html__( 'at', 'fabrique' ) . ' ' . get_comment_time(); ?>
						</time>
					</div>
				</div>
				<?php if ( '0' == $opts['comment']->comment_approved ) : ?>
					<p class="comment-await-moderation">
						<?php esc_html_e( 'Your comment is awaiting moderation.', 'fabrique' ); ?>
					</p>
				<?php endif; ?>
				<div class="comment-content" itemprop="description">
					<?php echo get_comment_text(); ?>
				</div>
				<?php if ( $opts['comment_open'] || !empty( $opts['edit_comment_link'] ) ) : ?>
				<div class="comment-footer fbq-p-brand-color">
					<?php $reply_link = get_comment_reply_link( $opts['comment_reply_args'] ); ?>
					<?php if ( $opts['comment_open'] && !empty( $reply_link ) ) : ?>
						<div class="comment-reply"><?php echo fabrique_escape_content( $reply_link ); ?></div>
					<?php endif; ?>
					<?php if ( !empty( $opts['edit_comment_link'] ) ) : ?>
						<p class="edit-link">
							<?php if ( $opts['comment_open'] && !empty( $reply_link ) ) { echo '&nbsp;|&nbsp;'; } ?>
							<a href="<?php echo esc_url( $opts['edit_comment_link'] ); ?>">
								<?php esc_html_e( 'Edit', 'fabrique' ); ?>
							</a>
						</p>
					<?php endif; ?>
				</div><?php // close comment footer ?>
				<?php endif; ?>
			</div><?php // close comment body ?>
		<?php endif; ?>
		<?php do_action( 'after_each_comment_body', $opts['comment'] ); ?>
	</div>
