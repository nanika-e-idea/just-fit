<?php //固定ページ用のパンくずリスト ?>
<div id="pgs_breadcrumb" class="breadcrumb">
	<?php $count = 0;
	$per_ids = array_reverse(get_post_ancestors($post->ID)); ?>
	<div itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">
		<a href="<?php echo home_url(); ?>" itemprop="url"><span itemprop="title">トップページ</span></a>
		&nbsp;&gt;&nbsp;
	</div>
	<?php foreach ( $per_ids as $par_id ){
    $count += 1;?>
    <div itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">
		<a href="<?php echo get_page_link( $par_id );?>" itemprop="url"><span itemprop="title"><?php echo get_page($par_id)->post_title; ?></span></a>
		&nbsp;&gt;&nbsp;
	</div>
	<?php } ?>
	<div><?php the_title() ?></div>
</div><!-- /#breadcrumb -->