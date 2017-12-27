<?php
/*
Template Name: フロントページ
*/
?>
<?php if(get_post_meta($post->ID, 'frp_header_off', true) == 'true'): ?>
<?php get_header(); ?>
<?php PHP_EOL; ?>
<?php else: ?>
<?php
global $ptname;
$tp = get_stylesheet_directory_uri();
$home = get_bloginfo('url');
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<title><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php bloginfo('description'); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $tp; ?>/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $tp; ?>/css/font-awesome.min.css">
<?php
	wp_enqueue_script("jquery");
	wp_head();
?>
	<link rel="stylesheet" type="text/css" href="<?php echo $tp; ?>/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $tp; ?>/css/customize.css">
	<!-- テーマ用追加アイテム呼び出し -->
<?php if(get_option('add_typekit')): ?>
    <script src="<?php echo get_option('url_typekit'); ?>"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>
<?php endif; ?>	
	<!-- ページ用追加スタイル呼び出し -->
<?php if ( is_singular()):?>
<?php $addcss = get_post_meta(get_the_ID(), 'addcss', true ); ?>
<?php if ( $addcss != '' ): ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $tp; ?>/css/<?php echo $addcss ?>">
<?php endif; ?>
<?php endif; ?>
</head>

<body>
	<div id="view">
		<a name="page_top"></a>
		
		<div id="frp_header">
<?php if(get_post_meta($post->ID, 'eyecatchoff', true) <> 'true'): ?>	
<?php if(has_post_thumbnail()) : ?>
			<div class="ftp_eyecatch">
				<div class="bg">
					<img class="pgs_eyecatch_image" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' )[0]; ?>">
				</div>
<?php if(get_post_meta($post->ID, 'ex-eyecatch', true)): ?>
				<div class="overlay">
<?php echo get_post_meta($post->ID, 'ex-eyecatch', true).PHP_EOL; ?>
				</div>
<?php endif;//!empty($exeycatch) ?>
			</div>
<?php endif;//has_post_thumbnail ?>

<?php endif;//eyecatchoff <> 'true' ?>


		</div>
		<!-- header -->


<?php endif;//'frp_header_off == 'true' ?>
		<div id="container">

			<div id="headline">
				<!-- subLoop -->
<?php $args = array( 'post_type' => 'headline', 'posts_per_page' => 1 ); ?>
<?php $my_query = new WP_Query( $args ); ?>
<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
				<p><?php echo get_the_date(); //投稿日時を表示 ?>&nbsp;<?php the_title(); //記事タイトルを表示 ?></p>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
				<!-- /subLoop -->
				
			</div>

			<!-- mainLoop -->
<?php query_posts('post_type=articles'); ?>
<?php $ptname = 'articles'; ?>
<?php $cnt_articles = 0; ?>
<?php $num_ptn = 0; ?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
			<div id="<?php echo get_post_meta($post->ID, 'element_ID', true) ?>" class="article section<?php echo $cnt_articles ?> ptn<?php echo $num_ptn?>">
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
<?php if( get_post()->post_content !== '' ): ?>
<?php //remove_filter( 'the_content', 'wpautop' ); ?>
<?php remove_filter( 'the_excerpt', 'wpautop' ); ?>
				<div class="acl_container">
					<p class="acl_text">
<?php the_content(続きを読む); //記事本文を表示 ?>
					</p>
				</div>
<?php endif; ?>
				<?php echo apply_filters('the_content', get_post_meta($post->ID, 'insert', true)); //ショートコードでサブループ呼び出し ?>
			</div>
<?php $cnt_articles += 1; ?>
<?php if ( $num_ptn == 3 ): ?>
<?php $num_ptn = 0; ?>
<?php else: ?>
<?php $num_ptn += 1; ?>
<?php endif; ?>
<?php endwhile; endif; ?>
<?php wp_reset_query(); ?>
				<!-- /mainLoop -->

			
				

		</div>
		<!-- container -->
		<?php get_footer(); ?>
		