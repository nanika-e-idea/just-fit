<?php get_header(); ?>
<?php PHP_EOL; ?>
<!-- template page -->
<div id="container">
<?php breadcrumb(); ?>
	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php $exeycatch = get_post_meta($post->ID, 'ex_eyecatch', true); ?>
	<?php if(empty($exeycatch)): ?>
	<?php if(apply_filters('the_content', get_post_meta($post->ID, 'eyecatchoff', true)) == false): ?>
	<?php if(has_post_thumbnail()) : ?>
	<div class="pgs_eyecatch">
		<img class="pgs_eyecatch_image" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' )[0]; ?>">
	</div>
	<?php endif; ?>
	<?php endif; ?>
	<?php else: ?>
	<?php echo apply_filters('the_content', $exeycatch); ?>
	<?php endif; ?>
	<div id="<?php echo get_post_meta($post->ID, 'element_ID', true) ?>" class="article section<?php echo $cnt_articles ?>">
		<h2 class="acl_title"><?php the_title(); //記事タイトルを表示 ?></h2>
<?php if( get_post()->post_content !== '' ):
		//remove_filter( 'the_content', 'wpautop' );
		//remove_filter( 'the_excerpt', 'wpautop' ); ?>
		<div class="acl_container">
			<p class="acl_text">
<?php the_content(続きを読む); //記事本文を表示 ?>
			</p>
		</div>
<?php endif; ?>
<?php echo apply_filters('the_content', get_post_meta($post->ID, 'insert', true)); //ショートコードでサブループ呼び出し ?>
	</div>
<?php endwhile; endif; ?>

<?php get_footer(); ?> 