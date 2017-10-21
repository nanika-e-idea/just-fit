<?php
global $ptname;
$tp = get_stylesheet_directory_uri();
$home = get_bloginfo('url');
$page = get_the_permalink();
$obj = get_post_type_object( get_post_type() );

get_header();
?>

<!-- template archive_faq-->
<div id="container">
<p class="breadcrumb">
	<a href="<?php echo $home ?>"><i class="fa fa-home"></i>トップ</a>
	&nbsp;>&nbsp;<a href="<?php echo get_post_type_archive_link( get_post_type()); ?>"><i class="fa fa-folder-open"></i><?php echo $obj->labels->singular_name; ?></a>
</p>
<h2 class="acl_title"><?php echo $obj->labels->singular_name; ?></h2>
<?php echo do_shortcode('[insfaq]'); ?>

<?php get_footer(); ?>