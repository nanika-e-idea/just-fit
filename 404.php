<?php
global $ptname;
$tp = get_stylesheet_directory_uri();
$home = get_bloginfo('url');

get_header();
?>
<!-- 404 error -->
<div id="container">
	<div id="err_eyecatch">
	    <img  id="img_catch" src="<?php echo $tp; ?>/images/404bgimage.jpg">
		<div class="overlay_catch color_fff">
			<h2>ご指定のページが見つかりませんでした。</h2>
			<p>このページの URL ：<span class="error_msg">http://<?php echo esc_html($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); ?></span></p>
            <p>現在表示する記事がありません。</p>
            <p><a class="err_back" href="<?php echo home_url(); ?>">トップページへ戻る</a></p>
	    </div>
    </div>
</div>
<?php get_footer(); ?>