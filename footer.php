<?php
global $ptname;
global $post_type;
$tp = get_stylesheet_directory_uri();
$home = get_bloginfo('url');
?>
		<div id="footer">
			<div class="fblock_wide">

			</div>
			<ul id="footer_blocks">
				<li id="fblock_1" class="fblock"><?php dynamic_sidebar('footer_widget_1') ?></li>
				<li id="fblock_2" class="fblock"><?php dynamic_sidebar('footer_widget_2') ?></li>
				<li id="fblock_3" class="fblock"><?php dynamic_sidebar('footer_widget_3') ?></li>
			</ul>
			<div class="fblock_wide">
				<hr class="acl_spacer">
				<p><?php bloginfo('description'); ?></p>
				<hr class="acl_spacer">
<?php if(get_option('txt_copyright')): ?>
				<span class="footer_end">&copy; <?php echo get_option('txt_copyright'); ?></span>
<?php else: ?>
				<span class="footer_end">&copy; <?php bloginfo('name'); ?></span>
<?php endif; ?>
			</div>
		</div>
		<!-- footer -->
	</div>
<!-- add js in post type <?php echo $ptname; ?> -->
<?php if( $cnt_articles !== 0 ): ?>
<?php $args = array( 'post_type' => $ptname ); ?>
<?php $my_query = new WP_Query( $args ); ?>
<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
<?php echo get_post_meta(get_the_ID(), 'addjs', true ); //addjsの値を表示 ?>
<?php endwhile; endif; ?>
<?php wp_reset_postdata(); ?>
<!-- /add js -->
<?php wp_footer(); ?>
</body>

</html>