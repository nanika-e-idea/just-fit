<?php
global $ptname;
$tp = get_stylesheet_directory_uri();
$home = get_bloginfo('url');
$page = get_the_permalink();
get_header();
?>

<!-- template index -->
<div id="container">
	<?php breadcrumb(); ?>

	
	<?php if (have_posts()) : ?>
<?php global $ptname; ?>
<?php $ptname = $post_type; ?>
<?php $cnt_articles = 0; ?>
<?php while (have_posts()) : the_post(); ?>
	<div id="<?php echo get_post_meta($post->ID, 'element_ID', true) ?>" class="article section<?php echo $cnt_articles ?>">

		<h2 class="acl_title"><a href="<?php $page ?>"><?php the_title(); //記事タイトルを表示 ?></a></h2>
<?php if( get_post()->post_content !== '' ): ?>
		<div class="acl_container">
<?php if(has_post_thumbnail()) : ?>
<?php echo '<img class="acl_image" src="',wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' )[0],'">',PHP_EOL; ?>
<?php endif; ?>
<?php the_content(続きを読む); //記事本文を表示 ?>
		</div>
<?php endif; ?>
<?php echo apply_filters('the_content', get_post_meta($post->ID, 'insert', true)); //ショートコードでサブループ呼び出し ?>
	</div>
	<hr class="acl_spacer">
<?php $cnt_articles += 1; ?>
<?php endwhile; endif; ?>

<?php get_footer(); ?>