<?php
 $obj = get_post_type_object( get_post_type() );
?>
<?php get_header(); ?>
<!-- template single-sc -->
<div id="container">
<?php breadcrumb(); ?>

<?php 
	if (have_posts()) :
	while (have_posts()) :
	the_post(); ?>
	
	<div id="<?php echo get_post_meta($post->ID, 'element_ID', true) ?>" class="article section<?php echo $cnt_articles ?>">

<?php if(has_post_thumbnail()): ?>
		<div class="pgs_eyecatch">
			<img class="pgs_eyecatch_image" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id() , 'full' )[0] ?>">
<?php if(apply_filters('the_content', get_post_meta($post->ID, 'ex-eyecatch', true)) == true): ?>
			<div class="overlay_item">
<?php //remove_filter('the_content', 'wpautop'); ?>
			<?php echo apply_filters('the_content', get_post_meta($post->ID, 'ex-eyecatch', true)); ?>
			</div>
<?php endif; ?>
		</div>
		<div class="overlay_item"><h1 class="acl_title"><?php the_title(); //記事タイトルを表示 ?></h1></div>
<?php endif; ?>

		
<?php if( get_post()->post_content !== '' ):
		remove_filter( 'the_excerpt', 'wpautop' ); 
		remove_filter( 'the_content', 'wpautop' ); ?>
		<div class="acl_container">
			<span class="acl_text">
<?php the_content(続きを読む); //記事本文を表示 ?>
			</span>
		</div>
<?php endif; ?>
<?php echo apply_filters('the_content', get_post_meta($post->ID, 'insert', true)); //ショートコードでサブループ呼び出し ?>
	</div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>