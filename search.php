<?php
global $ptname;
$tp = get_stylesheet_directory_uri();
$home = get_bloginfo('url');
$page = get_the_permalink();
get_header();
?>

<!-- template index -->
<div id="container">
<p class="breadcrumb">
	<a href="<?php echo $home ?>"><i class="fa fa-home"></i>トップ</a>
	
	&nbsp;>&nbsp;<i class="fa fa-search"></i><?php echo get_search_query(); ?>
</p>
	<h2 class="acl_title">検索結果：<?php echo get_search_query(); ?></h2>
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
				<h3 class="itemTitle"><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></h3>
				<?php if(has_post_thumbnail()): ?>
				<img class="itemImage" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id() , 'full' )[0] ?>">
				<?php endif; ?>
				<?php the_content(); ?>
			</li>

<?php $count += 1;?>
<?php endwhile; endif; ?>
<?php wp_reset_query(); ?>
		</ul>

<?php get_footer(); ?>