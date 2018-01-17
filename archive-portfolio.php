<?php
global $ptname;
$tp = get_stylesheet_directory_uri();
$home = get_bloginfo('url');
$page = get_the_permalink();
$obj = get_post_type_object( get_post_type() );

get_header();
?>

<!-- template archive_portfolio -->
<div id="container">
	<?php breadcrumb(); ?>
	<h2 class="acl_title"><?php echo $obj->labels->singular_name; ?></h2><?php echo do_shortcode('[inspf]'); ?>

<?php get_footer(); ?>