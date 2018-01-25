<?php
/*
Template Name: Ｑ＆Ａ
*/
//パラメータが空なら'?filter=open'追加
$permalink = get_the_permalink();
$directry = explode('/', $permalink);
$seek = end($directry);
$seek = prev($directry);
$url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$urlarray = explode('?', $url);
if(strpos($seek,'question') !== false){
	if(empty($urlarray[1])){
		$redurl = $urlarray[0].'?filter=opening';
		header("Location: {$redurl}");
    	exit;
	}
	
}

$tp = get_stylesheet_directory_uri();
$obj = get_post_type_object('post');

get_header();

wp_enqueue_style('dwqa-custom', $tp.'/css/dwqa-style.css');
wp_enqueue_script('dwqa-custom', $tp.'/js/dwqa-list-vote.js');

$postTitle = mb_substr($post->post_title, 0, 20, 'UTF-8');
if(mb_strlen($post->post_title, 'UTF-8')>20){
	$postTitle= $postTitle.'…';
}
?>
<!-- template single-questions -->
<!-- Page URL - <?php echo $url; ?> -->
<!-- headerNavエリア -->
<div id="container">
	<?php
	$str ='';
    if(!is_home()&&!is_admin()){
        $str .= '<div id="breadcrumb" class="breadcrumb"><div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" style="display:table-cell;">';
        $str .= '<a href="'. home_url() .'" itemprop="url"><span itemprop="title"><i class="fa fa-home"></i>ホーム</span></a> &gt;&#160;</div>';
        if(is_category()) {
            $cat = get_queried_object();
			
            if($cat -> parent != 0){
                $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
                foreach($ancestors as $ancestor){
					if(get_cat_name($ancestor)){
					$str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" style="display:table-cell;"><a href="'. get_category_link($ancestor) .'" itemprop="url"><span itemprop="title">'. get_cat_name($ancestor) .'</span></a> &gt;&#160;</div>';
					}
                }
            }
			if($cat-> cat_name){
				$str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" style="display:table-cell;"><a href="'. get_category_link($cat -> term_id). '" itemprop="url"><span itemprop="title"><i class="fa fa-folder-open"></i>'. $cat-> cat_name . '</span></a> &gt;&#160;</div>';
			}
        } elseif(is_page()){
            if($post -> post_parent != 0 ){
                $ancestors = array_reverse(get_post_ancestors( $post->ID ));
				if($ancestors){
                	foreach($ancestors as $ancestor){
                	    $str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" style="display:table-cell;"><a href="'. get_permalink($ancestor).'" itemprop="url"><span itemprop="title"><i class="fa fa-folder-open"></i>'. get_the_title($ancestor) .'</span></a> &gt;&#160;</div>';
                	}
				}
            }
        } elseif(is_single()){
				
            $categories = get_the_category($post->ID);
            $cat = $categories[0];
			if($cat){
            	if($cat -> parent != 0){
            	    $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
            	    foreach($ancestors as $ancestor){
            	        $str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" style="display:table-cell;"><a href="'. get_category_link($ancestor).'" itemprop="url"><span itemprop="title"><i class="fa fa-folder-open"></i>'. get_cat_name($ancestor). '</span></a>→</div>';
            	    }
            	}
				$str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" style="display:table-cell;"><a href="'. get_category_link($cat -> term_id). '" itemprop="url"><span itemprop="title"><i class="fa fa-folder-open"></i>'. $cat-> cat_name . '</span></a> &gt;&#160;</div>';
			}
            
        } else{
			//$str .= 'case4_';
            $str.='<div>'. wp_title('', false) .'</div>';
        }
        $str.= add_dwqa_breadcrumb().'</div>';
    }
    echo $str;
	?>
	<div id="main">
		<div id="<?php echo get_post_meta($post->ID, 'element_ID', true) ?>" class="article section<?php echo $cnt_articles ?>">
		<h1><?php the_title(); ?></h1>
		<?php if(has_post_thumbnail()): ?>
		<div class="acl_eyecatch">
					<img class="acl_eyecatch_image" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id() , 'full' )[0] ?>">
		</div>

	<?php endif; ?>
		
		<?php the_content(); ?>
		</div>
		<!-- end of the_content() -->
		<ul class="neighbors">
			<li class="neighbor_next">
				<?php if (get_next_post()):?>
				<a href="<?php echo get_permalink(get_next_post()); ?>">
					<div class="neibor">
					<div class="neighbor-sign">
						<i class="fa fa-angle-left"></i>
					</div>
					<div class="neighbor-label">
						<span>next</span>
						<h4><?php echo get_the_title(get_next_post()); ?></h4>
					</div>
					</div>
				</a>
				<?php endif; ?>
			</li>
			<li class="neighbor_prev">
				<?php if (get_previous_post()):?>
				<a href="<?php echo get_permalink( get_previous_post()); ?>">
					<div class="neibor">
					<div class="neighbor-sign">
						<i class="fa fa-angle-right"></i>
					</div>
					<div class="neighbor-label">
						<span>prev</span>
						<h4><?php echo get_the_title(get_previous_post()); ?></h4>
					</div>
					</div>
				</a>
				<?php endif; ?>
			</li>
		</ul>
		<div class="recomends">
			<?php wp_related_posts(); ?>
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
</div><!-- /container -->

<?php get_footer(); ?>