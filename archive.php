<?php
global $ptname;
$tp = get_stylesheet_directory_uri();
$home = get_bloginfo('url');
$page = get_the_permalink();
get_header();
?>

<!-- template archive -->
<div id="container">
<p class="breadcrumb">
	<a href="<?php echo $home ?>"><i class="fa fa-home"></i>トップ</a>
	&nbsp;>&nbsp;<a href="<?php echo get_post_type_archive_link( get_post_type()); ?>"><i class="fa fa-folder-open"></i><?php echo $obj->labels->singular_name; ?></a>
	&nbsp;>&nbsp;<i class="fa fa-file"></i><?php echo get_the_title(); ?>
</p>

<?php 
	if (have_posts()) :
	while (have_posts()) :
	the_post(); ?>
	
	<div id="<?php echo get_post_meta($post->ID, 'element_ID', true) ?>" class="article section<?php echo $cnt_articles ?>">

<?php if(has_post_thumbnail()): ?>
		<div class="acl_eyecatch">
			<img class="acl_eyecatch_image" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id() , 'full' )[0] ?>">
<?php if(apply_filters('the_content', get_post_meta($post->ID, 'ex-eyecatch', true)) == true): ?>
			<div class="overlay_item">
<?php remove_filter('the_content', 'wpautop'); ?>
			<?php echo apply_filters('the_content', get_post_meta($post->ID, 'ex-eyecatch', true)); ?>
			</div>
<?php endif; ?>
		</div>
<?php endif; ?>

		<h2 class="acl_title"><?php the_title(); //記事タイトルを表示 ?></h2>
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