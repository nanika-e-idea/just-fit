<?php
/**
 * The template for displaying single questions
 *
 * @package DW Question & Answer
 * @since DW Question & Answer 1.4.3
 */
?>

<?php do_action( 'dwqa_before_single_question_content' ); ?>
<div class="dwqa-question-item">
	<div class="dwqa-question-meta">
		<?php $user_id = get_post_field( 'post_author', get_the_ID() ) ? get_post_field( 'post_author', get_the_ID() ) : false ?>
		<?php printf( __( '<span><a href="%s">%s%s</a> %s asked %s ago</span>', 'dwqa' ), dwqa_get_author_link( $user_id ), get_avatar( $user_id, 48 ), get_the_author(),  dwqa_print_user_badge( $user_id ), human_time_diff( get_post_time( 'U', true ) ) ) ?>
		<span class="dwqa-question-actions"><?php dwqa_question_button_action() ?></span>
	</div>
	<div class="dwqa-question-title"><?php the_title(); ?></div>
	<div class="dwqa-question-content"><?php the_content(); ?></div>
	<?php do_action('dwqa_after_show_content_question', get_the_ID()); ?>
	<div class="dwqa-question-footer">
		<div class="dwqa-question-meta">
			<?php echo get_the_term_list( get_the_ID(), 'dwqa-question_tag', '<span class="dwqa-question-tag">' . __( 'Question Tags: ', 'dwqa' ), ', ', '</span>' ); ?>
			<?php if ( dwqa_current_user_can( 'edit_question', get_the_ID() ) ) : ?>
				<?php if ( dwqa_is_enable_status() ) : ?>
				<span class="dwqa-question-status">
					<?php _e( 'This question is:', 'dwqa' ) ?>
					<select id="dwqa-question-status" data-nonce="<?php echo wp_create_nonce( '_dwqa_update_privacy_nonce' ) ?>" data-post="<?php the_ID(); ?>">
						<optgroup label="<?php _e( 'Status', 'dwqa' ); ?>">
							<option <?php selected( dwqa_question_status(), 'open' ) ?> value="open"><?php _e( 'Open', 'dwqa' ) ?></option>
							<option <?php selected( dwqa_question_status(), 'closed' ) ?> value="close"><?php _e( 'Closed', 'dwqa' ) ?></option>
							<option <?php selected( dwqa_question_status(), 'resolved' ) ?> value="resolved"><?php _e( 'Resolved', 'dwqa' ) ?></option>
						</optgroup>
					</select>
					</span>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="dwqa-question-vote" data-nonce="<?php echo wp_create_nonce( '_dwqa_question_vote_nonce' ) ?>" data-post="<?php the_ID(); ?>">
		<a class="dwqa-vote dwqa-vote-1up" href="#">
			<span class="dwqa-vote-label">知りたい<span class="dwqa-vote-count"><?php echo dwqa_vote_count() ?></span></span>
		</a>
	</div>
	<?php //if(is_user_logged_in()): ?>
	<?php if(dwqa_question_status() !== 'closed' and dwqa_question_status() !== 'resolved'): ?>
	<a class="ankerlink" href="#answer-form">回答する</a>
	<?php endif; ?>
	<?php //endif; ?>
	<?php do_action( 'dwqa_before_single_question_comment' ) ?>
	<?php comments_template(); ?>
	<?php do_action( 'dwqa_after_single_question_comment' ) ?>
</div>
<?php do_action( 'dwqa_after_single_question_content' ); ?>
