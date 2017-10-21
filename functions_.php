<?php
/** 親テーマのスタイル呼び出し **/
//add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
//function theme_enqueue_styles() {
//    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
//}

global $wp_rewrite;
$wp_rewrite->flush_rules();

/** カスタムヘッダ画像、ロゴ関連 **/
add_action( 'after_setup_theme', 'fit_costomize_ontions' );
function fit_costomize_ontions() {
	// カスタムヘッダ画像有効化
	add_theme_support( 'custom-header', array(
		'height' => 773,
		'width'  => 1200,
	) );

	// カスタムロゴ有効化
	add_theme_support( 'custom-logo', array(
		'height'      => 120,
		'width'       => 250,
		'flex-height' => true,
	) );
}
// カスタムヘッダ呼び出し
function the_header_image( $blog_id = 0) {
	echo get_header_image( $blog_id );
}

/** 記事アイキャッチ画像を有効にする。 **/
add_theme_support('post-thumbnails'); 

/**カスタム投稿タイプ追加**/
//headline
add_action( 'init', 'cpt_mainacl' );
function cpt_mainacl() {
	$labels = array(
		'name'               => _x( 'メインコンテンツ', 'post type general name' ),
		'singular_name'      => _x( 'メインコンテンツ', 'post type singular name' ),
		'menu_name'          => _x( 'メインコンテンツ', 'admin menu' ),
		'add_new'            => _x('新規作成', 'articles'),
		'add_new_item'       => __('新規作成'),
		'edit_item'          => __('編集'),
		'new_item'           => __('新しいアイテム'),
		'view_item'          => __('view'),
		'search_items'       => __('search'),
		'parent_item_colon'  => '',
		'not_found'          =>  __('Nothing found.'),
		'not_found_in_trash' => __('Nothing found in Trash.')
	);
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'articles' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' )
	);
	register_post_type( 'articles', $args );
	flush_rewrite_rules( false );
}
add_action( 'init', 'cpt_headline' );
function cpt_headline() {
	$labels = array(
		'name'               => _x( 'ヘッドライン', 'post type general name' ),
		'singular_name'      => _x( 'ヘッドライン', 'post type singular name' ),
		'menu_name'          => _x( 'ヘッドライン', 'admin menu' ),
		'add_new'            => _x('新しく記事を書く', 'headline'),
		'add_new_item'       => __('新規作成'),
		'edit_item'          => __('編集'),
		'new_item'           => __('新しいアイテム'),
		'view_item'          => __('view'),
		'search_items'       => __('search'),
		'parent_item_colon'  => '',
		'not_found'          =>  __('Nothing found.'),
		'not_found_in_trash' => __('Nothing found in Trash.')
	);	
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'headlines' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
	);
	register_post_type( 'headline', $args );
	flush_rewrite_rules( false );
}

//checkpoints
add_action( 'init', 'cpt_checkpoints' );
function cpt_checkpoints() {
	$labels = array(
		'name'               => _x( 'チェックポイント', 'post type general name' ),
		'singular_name'      => _x( 'チェックポイント', 'post type singular name' ),
		'menu_name'          => _x( 'チェックポイント', 'admin menu' ),
		'add_new'            => _x('新規作成', 'checkpoints'),
		'add_new_item'       => __('新規作成'),
		'edit_item'          => __('編集'),
		'new_item'           => __('新しいアイテム'),
		'view_item'          => __('view'),
		'search_items'       => __('search'),
		'parent_item_colon'  => '',
		'not_found'          =>  __('Nothing found.'),
		'not_found_in_trash' => __('Nothing found in Trash.')
	);	
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'checkpoints' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' )
	);
	register_post_type( 'checkpoints', $args );
	flush_rewrite_rules( false );
}

//showcase
add_action( 'init', 'cpt_showcase' );
function cpt_showcase() {
	$labels = array(
		'name'               => _x( '商品・サービス', 'post type general name' ),
		'singular_name'      => _x( '商品・サービス', 'post type singular name' ),
		'menu_name'          => _x( '商品・サービス', 'admin menu' ),
		'add_new'            => _x('新規作成', 'showcase'),
		'add_new_item'       => __('新規作成'),
		'edit_item'          => __('編集'),
		'new_item'           => __('新しいアイテム'),
		'view_item'          => __('view'),
		'search_items'       => __('search'),
		'parent_item_colon'  => '',
		'not_found'          =>  __('Nothing found.'),
		'not_found_in_trash' => __('Nothing found in Trash.')
	);	
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'showcase' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' )
	);
	register_post_type( 'showcase', $args );
	register_taxonomy(
        'showcase-tag', 
        'showcase', 
        array(
          'hierarchical'          => false, 
          'update_count_callback' => '_update_post_term_count',
          'label'                 => '商品・サービスのタグ',
          'singular_label'        => '商品・サービスのタグ',
          'public'                => false,
          'show_ui'               => true
        )
    );
	flush_rewrite_rules( false );
	/**
	register_taxonomy(
    　　'introduction-cat', 
    　　'indroducion', 
    　　array(
    　　  'hierarchical' => true, 
    　　  'update_count_callback' => '_update_post_term_count',
    　　  'label' => 'サービス概要のカテゴリー',
    　　  'singular_label' => 'サービス概要のカテゴリー',
    　　  'public' => true,
    　　  'show_ui' => true
    　　)
  　);
   **/
}

//faq
add_action( 'init', 'cpt_faq' );
function cpt_faq() {
	$labels = array(
		'name' => _x( 'よくある質問', 'post type general name' ),
		'singular_name'      => _x( 'よくある質問', 'post type singular name' ),
		'menu_name'          => _x( 'よくある質問', 'admin menu' ),
		'add_new'            => _x('新規作成', 'faq'),
		'add_new_item'       => __('新規作成'),
		'edit_item'          => __('編集'),
		'new_item'           => __('新しいアイテム'),
		'view_item'          => __('view'),
		'search_items'       => __('search'),
		'parent_item_colon'  => '',
		'not_found'          =>  __('Nothing found.'),
		'not_found_in_trash' => __('Nothing found in Trash.')
	);	
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'faq' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' )
	);
	register_post_type( 'faq', $args );
	flush_rewrite_rules( false );
}
/** portfolio **/
add_action( 'init', 'cpt_portfolio' );
function cpt_portfolio() {
	$labels = array(
		'name'               => _x( '事例紹介', 'post type general name' ),
		'singular_name'      => _x( '事例紹介', 'post type singular name' ),
		'menu_name'          => _x( '事例紹介', 'admin menu' ),
		'add_new'            => _x('新規作成', 'footer_items'),
		'add_new_item'       => __('新規作成'),
		'edit_item'          => __('編集'),
		'new_item'           => __('新しいアイテム'),
		'view_item'          => __('view'),
		'search_items'       => __('search'),
		'parent_item_colon'  => '',
		'not_found'          =>  __('Nothing found.'),
		'not_found_in_trash' => __('Nothing found in Trash.')
	);	
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'portfolio' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' )
	);
	register_post_type( 'portfolio', $args );
	flush_rewrite_rules( false );
}
/** footer **/
add_action( 'init', 'cpt_footer');
function cpt_footer() {
	$labels = array(
		'name'               => _x( 'フッターアイテム', 'post type general name' ),
		'singular_name'      => _x( 'フッターアイテム', 'post type singular name' ),
		'menu_name'          => _x( 'フッターアイテム', 'admin menu' ),
		'add_new'            => _x('新規作成', 'footer_items'),
		'add_new_item'       => __('新規作成'),
		'edit_item'          => __('編集'),
		'new_item'           => __('新しいアイテム'),
		'view_item'          => __('view'),
		'search_items'       => __('search'),
		'parent_item_colon'  => '',
		'not_found'          =>  __('Nothing found.'),
		'not_found_in_trash' => __('Nothing found in Trash.')
	);	
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'footer_items' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' )
	);
	register_post_type( 'footer_items', $args );
	flush_rewrite_rules( false );
};


add_filter( 'post_type_link', 'cpt_post_type_link', 1, 2 );
function cpt_post_type_link( $link, $post ) {
	if( 'faq' === $post->post_type ) {
		return home_url( '/faq/' .$post->ID .'.html' );
	} else if( 'showcase' === $post->post_type ) {
		return home_url( '/showcase/' .$post->ID .'.html' );
	} else if( 'portfolio' === $post->post_type ) {
		return home_url( '/portfolio/' .$post->ID .'.html' );
	} else {
		return $link;
	}
};

add_filter( 'rewrite_rules_array', 'my_rewrite_rules_array' );
function my_rewrite_rules_array( $rules ) {
  $new_rules = array( 
    'showcase/([0-9]+)/?.html$' => 'index.php?post_type=showcase&p=$matches[1]',
    'portfolio/([0-9]+)/?.html$' => 'index.php?post_type=portfolio&p=$matches[1]',
  );
 
  return $new_rules + $rules;
}


/** サブループを呼び出すショートコード作成 **/
//チェックポイント
add_shortcode( 'insckpt', 'ins_checkpoint' );
function ins_checkpoint() {
	$args = array(
		'post_type' => 'checkpoints',
	);
	$my_query = new WP_Query( $args );
	$count = 0;
	$numpost = $my_query->found_posts;
	echo '<ul class="launcher">',PHP_EOL;
	while ( $my_query->have_posts() ) : $my_query->the_post();
	if(($count % 2) == 0 and ($count - ($count % 2)) == ($numpost - ($numpost % 2))){
		echo "\t\t\t\t\t",'<li class="markx2 markx2_',$numpost % 2,'">&nbsp;</li>',PHP_EOL;
	};
	if(($count % 4) == 0 and ($count - ($count % 4)) == ($numpost - ($numpost % 4))){
		echo "\t\t\t\t\t",'<li class="markx4 markx4_',$numpost % 4,'">&nbsp;</li>',PHP_EOL;
	};
	echo "\t\t\t\t\t",'<li class="launcher_item">',PHP_EOL,
	"\t\t\t\t\t\t",'<a class="item_block highlight_bg" href="',
	get_post_meta(get_the_ID(), 'href', true ),
	'">',PHP_EOL,
	"\t\t\t\t\t\t\t",'<span class="item_label">',
	the_content(続きを読む),
	"\t\t\t\t\t\t\t",'</span>',PHP_EOL,
	"\t\t\t\t\t\t",'</a>',PHP_EOL,
	"\t\t\t\t\t",'</li>',PHP_EOL;		
	$count += 1;
	endwhile;
	echo "\t\t\t\t",'</ul>',PHP_EOL;
	
	wp_reset_postdata(); 
}
//商品・サービス
add_shortcode( 'insswcs', 'ins_showcase' );
function ins_showcase() {
	$args = array(
		'post_type' => 'showcase',
	);
	$my_query = new WP_Query( $args );
	echo '<ul class="tile_view">';
	while ( $my_query->have_posts() ) : $my_query->the_post();
	
	echo '<li class="tile_item highlight_bg">',PHP_EOL;
	echo '<h3 class="tile_label">',the_title(),'</h3>',PHP_EOL;
	if (has_post_thumbnail()) :
		echo '<img class="tile_image" src="',wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' )[0],'">',PHP_EOL;
	else:
		echo '<span class="item_label">no image</span>',PHP_EOL;
	endif;
	echo '<div class="tile_textbox">',PHP_EOL,
	the_content(),PHP_EOL,
	'</div>',PHP_EOL,
	'</li>',PHP_EOL;

	endwhile;
	wp_reset_postdata();
	echo '</ul>',PHP_EOL;
}

//事例紹介
add_shortcode( 'inspf', 'ins_portfolio' );
function ins_portfolio() {
	$args = array(
		'post_type' => 'portfolio',
	);
	$my_query = new WP_Query( $args );
	$idx = wp_count_posts( 'portfolio', 'readable') ->publish;
	$countidx = ($idx) % 4;
	$portfolio = '<div class="portfolio">'.PHP_EOL;

	$slider = "\t\t\t\t\t".'<ul class="pf_slider">'.PHP_EOL;
	$index = "\t\t\t\t\t".'<ul class="pf_index">'.PHP_EOL;
	$count = 1;
	
	while ( $my_query->have_posts() ) : $my_query->the_post();
	$slider .= "\t\t\t\t\t\t".'<li class="pfSlide" id="slide_'.get_the_id().'">'.PHP_EOL;
	$slider .= "\t\t\t\t\t\t\t".'<div class="pfImage"><img src="'.wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' )[0].'"></div>'.PHP_EOL;
	$slider .= "\t\t\t\t\t\t\t".'<div class="pfArticle"><h3>'.get_the_title().'</h3><hr>'.get_the_content().'</div>'.PHP_EOL;
	$slider .= "\t\t\t\t\t\t".'</li>'.PHP_EOL;
	$slider .= ''.PHP_EOL;
	if($count == 1){
		if($countidx == 3){
			$index .= "\t\t\t\t\t\t".'<li class="pfIndex x2idx idx1-'.$idx.'">'.PHP_EOL;
		} else if($countidx == 2){
			$index .= "\t\t\t\t\t\t".'<li class="pfIndex x3idx idx1-'.$idx.'">'.PHP_EOL;
		} else if($countidx == 1){
			$index .= "\t\t\t\t\t\t".'<li class="pfIndex x4idx idx1-'.$idx.'">'.PHP_EOL;
		} else {
			$index .= "\t\t\t\t\t\t".'<li class="pfIndex idx1-'.$idx.'">'.PHP_EOL;
		};
	} else {
		$index .= "\t\t\t\t\t\t".'<li class="pfIndex">'.PHP_EOL;
	};
	$index .= "\t\t\t\t\t\t\t".'<a id="index_'.get_the_id().'"><img src="'.wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' )[0].'"></a>'.PHP_EOL;
	$index .= "\t\t\t\t\t\t".'</li>'.PHP_EOL;
	
	$count += 1;
	
	endwhile;
	wp_reset_postdata();
	$slider .="\t\t\t\t\t".'<div id="slide_fader" class="faderOff"></div>'.PHP_EOL;
	$slider .="\t\t\t\t\t".'<a class="prv_slide"><i class="fa fa-chevron-left"></i></a>'.PHP_EOL;
	$slider .="\t\t\t\t\t".'<a class="nxt_slide"><i class="fa fa-chevron-right"></i></a>'.PHP_EOL;
	$slider .="\t\t\t\t\t".'</ul><!--pf_slider-->'.PHP_EOL;
	$index .= "\t\t\t\t\t".'</ul><!--pf_index-->'.PHP_EOL;

	
	$portfolio .= $slider;
	$portfolio .= $index;
	$portfolio .= "\t\t\t\t".'</div><!--portfolio-->'.PHP_EOL;

	return $portfolio;
}

//よくある質問
add_shortcode( 'insfaq', 'ins_faq' );
function ins_faq() {
	$args = array(
		'post_type' => 'faq',
	);
	$my_query = new WP_Query( $args );
	echo '<ul class="faq">',PHP_EOL;
	while ( $my_query->have_posts() ) : $my_query->the_post();
	
	echo "\t\t\t\t\t",'<li class="acl_container">',PHP_EOL,
	"\t\t\t\t\t\t",'<span class="faq_mark highlight_tx">Ｑ</span><h3>',
	the_title(),'</h3>',PHP_EOL,
	"\t\t\t\t\t\t",'<hr class="acl_spacer">',PHP_EOL,
	"\t\t\t\t\t\t",'<span class="faq_mark highlight_tx">Ａ</span>',
	the_content(),PHP_EOL,
	"\t\t\t\t\t\t",'<hr class="acl_spacer">',PHP_EOL,
	"\t\t\t\t\t",'</li>',PHP_EOL;
	
	endwhile;
	wp_reset_postdata();
	echo "\t\t\t\t",'</ul>',PHP_EOL;
}
//ページ内コンテンツナビ
add_shortcode( 'inspgnav', 'ins_pagenav' );
function ins_pagenav() {
	global $ptname;
	$args = array(
		'post_type' => $ptname,
	);
	$my_query = new WP_Query( $args );
	$hrefid = '#hrefid';
	$itemcount = 0;
	$pagenav = "\t\t\t\t\t".'<!-- [inspgnav] -->'.PHP_EOL;
	$pagenav .= "\t\t\t\t\t".'<ul class="footer-nav">'.PHP_EOL;
	while( $my_query->have_posts() ) : $my_query->the_post();
		$hrefid = '#'.get_post_meta(get_the_ID(), 'element_ID', true);
		$pagenav .= "\t\t\t\t\t\t".'<li><a href="'.$hrefid.'">'.get_the_title().'</a></li>'.PHP_EOL;
	$itemcount += 1;
	endwhile;
	if( $itemcount == 0 ){
		$pagenav .= "\t\t\t\t\t\t".'<li>No any item...</li>'.PHP_EOL;
	};
	$pagenav .= "\t\t\t\t\t".'</ul>'.PHP_EOL;
	wp_reset_postdata();
	$pagenav .= "\t\t\t\t\t".'<!-- [/inspgnav] -->';
	return $pagenav;
}

/** ウィジェット絡みの設定 **/
/**
 * Register our sidebars and widgetized areas.
 *
 */
function footer_widgets() {
	register_sidebar( array(
		'name' => 'footer_widget_1',
		'id' => 'footer_1',
		'before_widget' => '<!-- footer_widget_1 -->',
		'after_widget' => '<!-- /footer_widget_1 -->',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => 'footer_widget_2',
		'id' => 'footer_2',
		'before_widget' => '<!-- footer_widget_2 -->',
		'after_widget' => '<!-- /footer_widget_2 -->',
		'before_title' => '<h4>',
		'after_title' => '</h4>',footer_widget_1
	) );
	register_sidebar( array(
		'name' => 'footer_widget_3',
		'id' => 'footer_3',
		'before_widget' => '<!-- footer_widget_3 -->',
		'after_widget' => '<!-- /footer_widget_3 -->',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
}
add_action( 'widgets_init', 'footer_widgets' );
/** その他関数 **/
add_shortcode( 'sitetop','call_sitetop');
function call_sitetop() {
	return get_bloginfo('url');
}
?>