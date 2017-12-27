<?php
/* Template Name: Blog */

$obj = get_post_type_object('post');

get_header();

$postTitle = mb_substr($post->post_title, 0, 20, 'UTF-8');
if(mb_strlen($post->post_title, 'UTF-8')>20){
	$postTitle= $postTitle.'…';
}
?>
<!-- template single -->
<!-- headerNavエリア -->
<div id="container">
	
	<p class="breadcrumb">
		<a href="<?php echo $home ?>"><i class="fa fa-home"></i>トップ</a>
		&nbsp;>&nbsp;<a href="<?php echo get_post_type_archive_link( get_post_type()); ?>"><i class="fa fa-folder-open"></i><?php echo $obj->labels->singular_name; ?></a>
		&nbsp;>
	</p>

	
	<div id="main">
		<h1><?php the_title(); ?></h1>
		<?php if(has_post_thumbnail()): ?>
		<div class="acl_eyecatch">
					<img class="acl_eyecatch_image" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id() , 'full' )[0] ?>">
		</div>

	<?php endif; ?>
		<?php the_content(); ?>
	</div>
	<div class="neighbors"></div>
	<div class="recomends"></div>
	<div id="sub">
		<ul class="sub_blocks">
			<li id="sblock_1" class="sblock"><?php dynamic_sidebar('sub_widget_1');?></li>
			<li id="sblock_2" class="sblock"><?php dynamic_sidebar('sub_widget_2');?></li>
			<li id="sblock_3" class="sblock"><?php dynamic_sidebar('sub_widget_3');?></li>
			<li id="sblock_4" class="sblock"><?php dynamic_sidebar('sub_widget_4');?></li>
		</ul>
	</div>
</div><!-- /container -->

<?php get_footer(); ?>