<?php
/* Template Name: Blog */

$obj = get_post_type_object('post');

get_header();

?>
<!-- template blog -->
<!-- headerNavエリア -->
<div id="container">
	<?php
	$no_bread = get_post_meta($post->ID, 'no_bread', true);
	if(empty($no_bread)):
	?>
	<p class="breadcrumb">
		<a href="<?php echo $home ?>">トップページ</a>
		&nbsp;/&nbsp;<a href="<?php echo get_post_type_archive_link( get_post_type()); ?>"><?php echo $obj->labels->singular_name; ?></a>
	</p>
	<?php endif; ?>
	<?php if(!is_paged()): ?>
	<?php the_content(); ?>
	<?php endif; ?>
	<div id="main">
		<?php if(!is_paged()): ?>
		<h2 class="blg_index"><span class="lined">Pick Up</span></h2>
		<ul class="itemList">
<?php
	$sticky = get_option( 'sticky_posts' );
	$args = array(
		'post_per_page' => 2,
		'post__in' => $sticky,
		'post_type' => 'post',
	);
	$query = new WP_Query($args);
	if ($query->have_posts()) :
	while ($query->have_posts()) : $query->the_post();
?>
			<li class="itemBlock block_L">
				<a class="blg_eyecatch" href="<?php echo get_post_permalink(); ?>">
					
					
					<?php if(has_post_thumbnail()): ?>
					<img class="itemImage" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id() , 'full' )[0] ?>">
					<?php else: ?>
					<img class="itemImage" src="<?php echo get_stylesheet_directory_uri( ); ?>/images/imagenotfound.jpg">
					<?php endif; ?>
					
					
				</a>
				<a class="itemTitle_block" href="<?php echo get_post_permalink(); ?>">
						<?php
						$postTitle = mb_substr($post->post_title, 0, 24, 'UTF-8');
						if(mb_strlen($post->post_title, 'UTF-8')>24){
							$postTitle= $postTitle.'…';
						}
						?>
						<h3 class="itemTitle"><?php echo $postTitle; ?></h3>
						<span class="itemDate"><?php the_date(); ?></span>
					</a>
				<div class="itemCat"><?php the_category(); ?></div>
			</li>
<?php endwhile; endif; wp_reset_query(); ?>
		</ul>
		
		<?php endif; ?>
		<h2 class="blg_index"><span class="lined">Stories</span></h2>
		<ul class="itemList">

<?php
	$count = 1;
	
	$args = array(
		'paged'     => get_query_var('paged') ?intval(get_query_var('paged')) : 1,
		'post__not_in' => $sticky,
		'post_type' => 'post'
	);
	$query = new WP_Query($args);
	$current_page = get_query_var('page', 1);
	$count_page = $query->max_num_pages;
	if ($query->have_posts()) :
	while ($query->have_posts()) : $query->the_post();
	$val_feature = 2;
?>
			<?php if($count < $val_feature + 1): ?>
			<li class="itemBlock block_L">
			<?php else: ?>
			<li class="itemBlock block_S">
			<?php endif; ?>
				<a class="blg_eyecatch" href="<?php echo get_post_permalink(); ?>">
					
					
					<?php if(has_post_thumbnail()): ?>
					<img class="itemImage" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id() , 'full' )[0] ?>">
					<?php else: ?>
					<img class="itemImage" src="<?php echo get_stylesheet_directory_uri( ); ?>/images/imagenotfound.jpg">
					<?php endif; ?>
					
					
				</a>
				<div class="itemTitle_block">
						<?php
						$postTitle = mb_substr($post->post_title, 0, 24, 'UTF-8');
						if(mb_strlen($post->post_title, 'UTF-8')>24){
							$postTitle= $postTitle.'…';
						}
						?>
						<h3 class="itemTitle"><?php echo $postTitle; ?></h3>
						<span class="itemDate"><?php the_date(); ?></span>
					</div>
				<div class="itemCat"><?php the_category(); ?></div>
			</li>
<?php $count += 1;?>
<?php endwhile; endif; wp_reset_query();?>
<?php $page = get_the_permalink();?>
		</ul>
		<div class=pagination-container>
			<ul class='pagination'>
				<?php if($current_page == 1): ?>
				<li><a class="inactive"><i class="fa fa-angle-left"></i></a></li>
				<?php else: ?>
				<li><a class="standby" href="<?php echo $page; ?>page/<?php echo $current_page - 1; ?>/"><i class="fa fa-angle-left"></i></a></li>
				<?php endif; ?>
				
				<?php for($i=1; $i<$count_page+1; $i++):
				if(($current_page <= 4 and $i <= 7) or ($count_page > 7 and $current_page > 4 and $current_page <= $count_page - 4 and $i > $current_page - 4 and $i < $current_page + 4) or ($current_page > $count_page - 4 and $i >= $count_page - 7)):
				?>
				<li><a href="<?php echo $page; ?>page/<?php echo $i; ?>/" class="<?php if($i == $current_page){echo 'active';}else{echo 'standby';} ?>"><?php echo $i; ?></a></li>
				<?php endif; ?>
				<?php endfor; ?>
				
				<?php if($current_page == $count_page): ?>
				<li><a class="inactive"><i class="fa fa-angle-right"></i></a></li>
				<?php else: ?>
				<li><a class="standby" href="<?php echo $page; ?>page/<?php echo $current_page + 1; ?>/"><i class="fa fa-angle-right"></i></a></li>
				<?php endif; ?>
			</ul>
		</div>
		
	</div>
	<div id="sub">
		<ul class="sub_blocks">
			<li id="sblock_1" class="sblock"><?php dynamic_sidebar('sub_widget_1');?></li>
			<li id="sblock_2" class="sblock"><?php dynamic_sidebar('sub_widget_2');?></li>
			<li id="sblock_3" class="sblock"><?php dynamic_sidebar('sub_widget_3');?></li>
			<li id="sblock_4" class="sblock"><?php dynamic_sidebar('sub_widget_4');?></li>
		</ul>
	</div>
<?php wp_reset_query(); ?>
</div><!-- /container -->

<?php get_footer(); ?>