<?php
/**
 * The template for displaying answer submit form
 *
 * @package DW Question & Answer
 * @since DW Question & Answer 1.4.3
 */
?>
<?php if(dwqa_question_status() !== 'closed' and dwqa_question_status() !== 'resolved'): ?>
<a name="answer-form"></a>
<div class="dwqa-answer-form">
	<?php do_action( 'dwqa_before_answer_submit_form' ); ?>
	<div class="dwqa-answer-form-title"><?php _e( 'Your Answer', 'dwqa' ) ?></div>
	<form name="dwqa-answer-form" id="dwqa-answer-form" method="post" enctype="multipart/form-data">
		<?php dwqa_print_notices(); ?>
		<?php $content = isset( $_POST['answer-content'] ) ? sanitize_text_field( $_POST['answer-content'] ) : ''; ?>
		<?php dwqa_custom_tinymce_editor( array( 'content' => $content, 'textarea_name' => 'answer-content', 'id' => 'dwqa-answer-content' ) ) ?>
		<?php dwqa_load_template( 'captcha', 'form' ); ?>

		<?php if ( dwqa_current_user_can( 'post_answer' ) && !is_user_logged_in() ) : ?>
		<p class="hidden">
			<label for="user-email"><?php _e( 'Your Email', 'dwqa' ) ?></label>
			<?php $email = isset( $_POST['user-email'] ) ? sanitize_email( $_POST['user-email'] ) : ''; ?>
			<input type="email" class="" name="user-email" value="<?php echo 'dummy@dummyaddress.info' ?>" >
		</p>
		<p>
			<label for="user-name"><?php _e( 'Your Name', 'dwqa' ) ?></label>
			<?php $name = isset( $_POST['user-name'] ) ? esc_html( $_POST['user-name'] ) : ''; ?>
			<input type="text" class="" name="user-name" value="<?php echo $name ?>" >
		</p>
		<?php endif; ?>

		<select class="dwqa-select" name="dwqa-status">
			<optgroup label="<?php _e( 'Who can see this?', 'dwqa' ) ?>">
				<option value="publish"><?php _e( 'Public', 'dwqa' ) ?></option>
				<option value="private"><?php _e( 'Only Me &amp; Admin', 'dwqa' ) ?></option>
			</optgroup>
		</select>
		<?php do_action('dwqa_before_answer_submit_button'); ?>
		<input type="submit" name="submit-answer" class="dwqa-btn dwqa-btn-primary" value="<?php _e( 'Submit', 'dwqa' ) ?>">
		<input type="hidden" name="question_id" value="<?php the_ID(); ?>">
		<input type="hidden" name="dwqa-action" value="add-answer">
		<?php wp_nonce_field( '_dwqa_add_new_answer' ) ?>
	</form>
	<?php do_action( 'dwqa_after_answer_submit_form' ); ?>
</div>
<?php endif; ?>
