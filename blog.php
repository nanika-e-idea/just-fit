<?php
/* Template Name: Blog */

$obj = get_post_type_object('post');

get_header();
?>
<!-- template blog -->
<!-- headerNavエリア -->
<div id="container">
	<p class="breadcrumb">
		<a href="<?php echo $home ?>">トップページ</a>
		&nbsp;/&nbsp;<a href="<?php echo get_post_type_archive_link( get_post_type()); ?>"><?php echo $obj->labels->singular_name; ?></a>
	</p>
	<div id="main">
		<ul class="itemList">
<?php //query_posts('post_type=showcase'); 
	  query_posts('post');?>

<?php
	$count = 1;
	if (have_posts()) :
	while (have_posts()) :
	the_post();
	$buffer = wp_count_posts() % 2;
?>
			<?php if($count > $buffer + 1):?>
			<li class="itemBlock block_S">
			<?php else:?>
			<li class="itemBlock block_L">
			<?php endif;?>
				<h3 class="itemTitle"><?php the_title(); ?></h3>
				<?php if(has_post_thumbnail()): ?>
				<img class="itemImage" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id() , 'full' )[0] ?>">
				<?php endif; ?>
				<?php the_content(); ?>
			</li>

<?php $count += 1;?>
<?php endwhile; endif; ?>
<?php wp_reset_query(); ?>
		</ul>
	</div>
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