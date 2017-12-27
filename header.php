<?php
global $ptname, $tp, $home;
$ptname = get_post_type();
$tp = get_stylesheet_directory_uri();
$home = get_bloginfo('url');
$page = get_the_permalink();

//if (! is_user_logged_in() && ! ( preg_match ('/^(signup|activation|lostpassword|profiles|login)/', basename ( $_SERVER[ 'REQUEST_URI' ] ) ) ) && ! (defined('DOING_AJAX') && DOING_AJAX )  && ! ( defined ( 'DOING_CRON' ) && DOING_CRON ) ) {
//	header ( "Location: {$home}" );
//	exit();
//};
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<title>
<?php
	global $page, $paged;
	if (is_search()) : 
	wp_title('', true, 'left');
	echo '&nbsp;|&nbsp;';
	else :
	wp_title('|', true, 'right');
	endif;
	bloginfo('name');
	if ($paged >= 2 || $page >= 2) : 
	echo ' | ' . sprintf('%sページ', max($paged, $page));
	endif;
?>&nbsp;|&nbsp;<?php bloginfo('description'); ?>
	</title>
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
	<!-- Page URL - <?php echo $page; ?> -->
	<div id="view">
		<a name="page_top"></a>
		<div id="scroll_page_top" class="hidden"><i class="fa fa-angle-double-up"></i></div>
		<div id="pgs_header">
<?php ins_crown_nav() ?>
			<div id="pgs_header_namearea">
				<div id="pgs_header_logo"><?php the_custom_logo(); ?></div>
				<div id="pgs_header_logoside">
					<span id="pgs_header_sitename" class="font_cp">	
						<?php bloginfo('description'); ?><br/>
						<?php bloginfo('name');
							//if ($paged >= 2 || $page >= 2) : 
							//echo ' | ' . sprintf('%sページ', max($paged, $page));
							//endif;
						?>
					</span>
				</div>
			</div>
			<hr class="header_spacer"/>
			<?php dynamic_sidebar('header_Nav'); ?>
		</div>
		
		<hr class="header_end">
		