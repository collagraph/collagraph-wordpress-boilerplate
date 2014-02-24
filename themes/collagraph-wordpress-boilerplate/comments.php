<?php if (post_password_required()): ?>
	<div id="comments" class="comments-area">
		<p>This post is password protected. Please sign in to view comments.</p>
	</div><!-- comments-area -->

	<?php return; ?>
<?php endif; //post_password_required() ?>

<div id="comments" class="comments-area">
	<?php if (have_comments()): ?>
		<h2 class="comments-title"><?php comments_number(); ?></h2>

		<ol class="comments-list">
			<?php wp_list_comments('type=comment&callback=collagraph_comments'); ?>
		</ol><!-- comments-list -->
	<?php elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')): ?>
		<p class="no-comments">Comments are closed.</p>
	<?php endif; // !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments') ?>

	<?php comment_form(); ?>
</div><!-- comments-area -->