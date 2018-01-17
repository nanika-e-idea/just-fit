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
		'name'               => _x( 'トップページ', 'post type general name' ),
		'singular_name'      => _x( 'トップページ', 'post type singular name' ),
		'menu_name'          => _x( 'トップページ', 'admin menu' ),
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
};

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
};

//外部リンク
add_action( 'init', 'cpt_outerlinks' );
function cpt_outerlinks() {
	$labels = array(
		'name'               => _x( '外部リンク', 'post type general name' ),
		'singular_name'      => _x( '外部リンク', 'post type singular name' ),
		'menu_name'          => _x( '外部リンク', 'admin menu' ),
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
		'rewrite'            => array( 'slug' => 'outerlinks' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' )
	);
	register_post_type( 'outerlinks', $args );
	flush_rewrite_rules( false );
};

/** checkpoints チェックポイント
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
};
**/

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
		'has_archive'        => false,
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
          'label'                 => 'タグ',
          'singular_label'        => 'タグ',
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
/** member メンバーリスト
add_action( 'init', 'cpt_mb' );
function cpt_mb() {
	$labels = array(
		'name' => _x( 'メンバーリスト', 'post type general name' ),
		'singular_name'      => _x( 'メンバーリスト', 'post type singular name' ),
		'menu_name'          => _x( 'メンバーリスト', 'admin menu' ),
		'add_new'            => _x('新規作成', 'members'),
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
		'rewrite'            => array( 'slug' => 'members' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' )
	);
	register_post_type( 'members', $args );
	flush_rewrite_rules( false );
};
**/

/** faq よくある質問
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
};
**/

/** portfolio 事例紹介
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
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' )
	);
	register_post_type( 'portfolio', $args );
	flush_rewrite_rules( false );
	//タグ型タクソノミー
	$args = array(
		'label' => 'タグ',
		'public' => true,
		'show_ui' => true,
		'hierarchial' => false
	);
	register_taxonomy('portfolio-tag', 'portfolio', $args );   
};
**/
add_filter( 'post_type_link', 'cpt_post_type_link', 1, 2 );
function cpt_post_type_link( $link, $post ) {
	if( 'faq' === $post->post_type ) {
		return home_url( '/faq/' .$post->ID );
	} else if( 'showcase' === $post->post_type ) {
		return home_url( '/showcase/' .$post->ID .'.html');
	} else if( 'portfolio' === $post->post_type ) {
		return home_url( '/portfolio/' .$post->ID );
	} else {
		return $link;
	}
};

add_filter( 'rewrite_rules_array', 'my_rewrite_rules_array' );
function my_rewrite_rules_array( $rules ) {
  $new_rules = array( 
    'showcase/([0-9]+)/?$' => 'index.php?post_type=showcase&p=$matches[1]',
    'showcase/([0-9]+).html/?$' => 'index.php?post_type=showcase&p=$matches[1]',
    'portfolio/([0-9]+)/?$' => 'index.php?post_type=portfolio&p=$matches[1]',
    'portfolio/([0-9]+).html/?$' => 'index.php?post_type=portfolio&p=$matches[1]',
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
function ins_showcase( $atts, $content = null ) {
	if ( $content == null ){
		$args = array(
			'post_type' => 'showcase',
		);
	}else{
		$tmparray = explode(',', $content);
		$i = 0;
		$j = 0;
		foreach($tmparray as $value){
		    if($j < 2){
			    $namearray[$j] = $tmparray[$j];
		    }else{
				$termarray[$i] = $tmparray[$j];
				$i ++;
			}
			$j ++;
		}
		if($namearray[1] == null){
			$args = array(
			    'post_type' => $namearray[0],
			);
		}else if($termarray == null){
			$args = array(
			    'post_type' => $namearray[0],
			);
		}else{
		    $args = array(
		    	'post_type' => $namearray[0],
		    	'tax_query' => array(
		    		'relation' => 'OR',
                	array(
                    	'taxonomy' => $namearray[1],
                    	'field' => 'name',
                    	'terms' => $termarray,
                    ),
		    		array(
                    	'taxonomy' => $namearray[1],
                    	'field' => 'slug',
                    	'terms' => $termarray,
                    ),
                ),
		    );
		}
	}
	$my_query = new WP_Query( $args );
	$showcase = '<ul class="tile_view">'.PHP_EOL;
	while ( $my_query->have_posts() ) : $my_query->the_post();
	
	$subtitle = get_post_meta( get_the_ID(), 'subtitle', true );
	remove_filter( 'the_content', 'wpautop' );
	$href = apply_filters( 'the_content', get_post_meta( get_the_ID(), 'href', true ) );
	$slug = get_post_meta( get_the_ID(), 'slug', true );
	
	$showcase .= "\t\t\t\t\t".'<li id="'.get_post_meta(get_the_ID(), 'element_ID', true).'" class="tile_item highlight_bg">'.PHP_EOL;
	if ( !empty( $slug ) ):
	$showcase .= "\t\t\t\t\t\t".'<a class="nav_tile" href="'.get_bloginfo('url').'/'.$slug.'/">'.PHP_EOL;
	elseif ( !empty( $href ) ):
	$showcase .= "\t\t\t\t\t\t".'<a class="nav_tile" href="'.$href.'">'.PHP_EOL;
	endif;
	$showcase .= "\t\t\t\t\t\t\t".'<h3 class="tile_label">'.get_the_title();
	if ( !empty( $subtitle ) ):
	$showcase .= '<br/><span class="small">'.$subtitle.'</span>';
	endif;
	$showcase .= '</h3>'.PHP_EOL;
	if (has_post_thumbnail()) :
		$showcase .= "\t\t\t\t\t\t\t".'<img class="tile_image" src="'.wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' )[0].'">'.PHP_EOL;
	else:
		$showcase .= "\t\t\t\t\t\t\t".'<span class="item_label">no image</span>'.PHP_EOL;
	endif;
	$showcase .= "\t\t\t\t\t\t\t".'<div class="tile_textbox">'.PHP_EOL;
	if ( !empty( $slug ) ):
	$splitcontent = explode( '<!--more-->', get_post( get_page_by_path( $slug )->ID )->post_content);
	$showcase .= "\t\t\t\t\t\t\t\t".$splitcontent[0].PHP_EOL;
	else:
	$showcase .= "\t\t\t\t\t\t\t\t".get_the_content().PHP_EOL;
	endif;
	$showcase .= "\t\t\t\t\t\t\t".'</div>'.PHP_EOL;
	if ( !empty( $href ) or !empty( $slug ) ):
	$showcase .= "\t\t\t\t\t\t".'</a>'.PHP_EOL;
	endif;
	$showcase .= "\t\t\t\t\t".'</li>'.PHP_EOL;

	endwhile;
	wp_reset_postdata();
	$showcase .= "\t\t\t\t\t".'</ul>'.PHP_EOL;
	
	return $showcase;
}

//事例紹介
add_shortcode( 'inspf', 'ins_portfolio' );
function ins_portfolio( $atts, $content = null ) {
	$txfilter = false;
	if ( $content == null ){
		$args = array(
			'post_type' => 'portfolio',
		);
	}else{
		$tmparray = explode(',', $content);
		$i = 0;
		$j = 0;
		foreach($tmparray as $value){
		    if($j < 2){
			    $namearray[$j] = $tmparray[$j];
		    }else{
				$termarray[$i] = $tmparray[$j];
				$i ++;
			}
			$j ++;
		}
		if($j < 3){
			$args = array(
			    'post_type' => $namearray[0],
			);
		}else{
			$txfilter = true;
		    $args = array(
		    	'post_type' => $namearray[0],
		    	'tax_query' => array(
		    		'relation' => 'OR',
                	array(
                    	'taxonomy' => $namearray[1],
                    	'field' => 'name',
                    	'terms' => $termarray,
                    ),
		    		array(
                    	'taxonomy' => $namearray[1],
                    	'field' => 'slug',
                    	'terms' => $termarray,
                    ),
                ),
		    );
		}
	}
	$my_query = new WP_Query( $args );
	$idx = 0;
	while ( $my_query->have_posts() ) : $my_query->the_post();
	$idx += 1;
	endwhile;
	$countidx = ($idx) % 4;
	$portfolio = '<div class="portfolio">'.PHP_EOL;
	$slider = "\t\t\t\t\t".'<ul class="pf_slider">'.PHP_EOL;
	$index = "\t\t\t\t\t".'<ul class="pf_index">'.PHP_EOL;
	$count = 1;
	
	while ( $my_query->have_posts() ) : $my_query->the_post();
	$tagarray = get_the_taxonomies();
	
	$slider .= "\t\t\t\t\t\t".'<li class="pfSlide" id="slide_'.get_the_id().'">'.PHP_EOL;
	$slider .= "\t\t\t\t\t\t\t".'<div class="pfImage"><img src="'.wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' )[0].'"></div>'.PHP_EOL;
	$slider .= "\t\t\t\t\t\t\t".'<div class="pfArticle"><h3>'.get_the_title().'</h3><hr>'.PHP_EOL;
	$slider .= "\t\t\t\t\t\t\t".get_the_content().'<hr>'.PHP_EOL;
	if($txfilter == true){
		$slider .= "\t\t\t\t\t\t\t".'<span>'.get_taxonomy_labels(get_taxonomy($tmparray[1]))->name.': ';
	}
	if ($terms = get_the_terms($post->ID, $tmparray[1])) {
    	foreach ( $terms as $term ) {
        	$slider .= '<span class="iblock">'.esc_html($term->name) . ',</span>';
		}
	}
	$slider .= '</span>'.PHP_EOL;
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
	$index .= '<a id="index_'.get_the_id().'"><div class="tile_label"><h4>'.get_the_title().'</h4></div>'.PHP_EOL;
	$index .= "\t\t\t\t\t\t\t".'<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' )[0].'"></a>'.PHP_EOL;
	$index .= "\t\t\t\t\t\t".'</li>'.PHP_EOL;
	
	$count += 1;
	endwhile;
	wp_reset_postdata();
	$slider .="\t\t\t\t\t".'<div id="slide_fader" class="faderOff"></div>'.PHP_EOL;
	if($count > 2){
		$slider .="\t\t\t\t\t".'<a class="prv_slide"><i class="fa fa-chevron-left"></i></a>'.PHP_EOL;
		$slider .="\t\t\t\t\t".'<a class="nxt_slide"><i class="fa fa-chevron-right"></i></a>'.PHP_EOL;
	}
	$slider .="\t\t\t\t\t".'</ul><!--pf_slider-->'.PHP_EOL;
	$index .= "\t\t\t\t\t".'</ul><!--pf_index-->'.PHP_EOL;

	$portfolio .= $slider;
	$portfolio .= $index;
	$portfolio .= "\t\t\t\t".'</div><!--portfolio-->'.PHP_EOL;

	return $portfolio;
}

//メンバー紹介
add_shortcode('insmb','ins_member');
function ins_member(){
	$args = array(
		'post_type' => 'members',
	);
	$members = PHP_EOL."\t\t\t\t\t\t\t".'<ul class="memberlist">'.PHP_EOL;
	$my_query = new WP_Query( $args );
	while ( $my_query->have_posts() ) : $my_query->the_post();
	
	$members .= "\t\t\t\t\t\t\t\t".'<li class="listitem_box">'.PHP_EOL;
	$members .= "\t\t\t\t\t\t\t\t\t".'<div class="memberface">'.PHP_EOL;
	$members .= "\t\t\t\t\t\t\t\t\t\t".'<img src="'.wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' )[0].'">'.PHP_EOL;
	$members .= "\t\t\t\t\t\t\t\t\t".'</div>'.PHP_EOL;
	$members .= "\t\t\t\t\t\t\t\t\t".'<div class="memberinfo hidden">'.PHP_EOL;
	$members .= "\t\t\t\t\t\t\t\t\t\t".'<span class="member_title">'.get_post_meta(get_the_ID(), 'member_title', true).'</span>'.PHP_EOL;
	$members .= "\t\t\t\t\t\t\t\t\t\t".'<span class="member_name">'.get_post_meta(get_the_ID(), 'member_name', true).'</span>'.PHP_EOL;
	$members .= "\t\t\t\t\t\t\t\t\t\t".'<div class="member_link">'.get_post_meta(get_the_ID(), 'member_link', true).'</div>'.PHP_EOL;
	$membars .= "\t\t\t\t\t\t\t\t\t\t".'<span>'.'</span>'.PHP_EOL;
	$members .= "\t\t\t\t\t\t\t\t\t".'</div>'.PHP_EOL;
	$members .= "\t\t\t\t\t\t\t\t".'</li>'.PHP_EOL;
	
	endwhile;;
	wp_reset_postdata();
	$members .= "\t\t\t\t\t\t\t".'</ul>'.PHP_EOL;
	return $members;
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

//Light-BOX生成
//[inslbox]posttype,taxonomy,tarm,tarm,tarm...[/inslbox]
add_shortcode( 'inslbox', 'ins_Lightbox' );
function ins_lightbox($atts, $content = null) {
	
	$flgNav = false;
	$lboxNav = "\t".'<ul class="lbox_nav">'.PHP_EOL;
	$lboxNav .= "\t\t".'<li class="lbox_nav_item here">全てのアイテム<input type="hidden" value="all"></li>'.PHP_EOL;
	
	if(isset($content)) {		
		$paramarray = explode(',', $content);
		$i = 0;
		$j = 0;
		foreach((array)$paramarray as $value){
		    if($j >= 2){
				$termarray[$i] = $paramarray[$j];
				$i += 1;
			}
			$j += 1;
		}
		
		if($temparray[1] == null){
			$args = array(
			    'post_type' => $paramarray[0],
				'nopaging' => 1,
			);
		}else if($termarray == null){
			$args = array(
			    'post_type' => $paramarray[0],
				'nopaging' => 1,
			);
		}else{
		    $args = array(
		    	'post_type' => $paramarray[0],
		    	'tax_query' => array(
		    		'relation' => 'OR',
    	           	array(
    	               	'taxonomy' => $paramarray[1],
    	               	'field' => 'name',
    	               	'terms' => $termarray,
    	            ),
		    		array(
    	               	'taxonomy' => $paramarray[1],
    	               	'field' => 'slug',
    	               	'terms' => $termarray,
    	            ),
    	        ),
				'nopaging' => 1,
		    );
		}
	}else{
		$args = array(
			'post_type' => 'portfolio',
			'nopaging' => 1,
		);
		$termarray = get_terms('portfolio-tag');
		$paramarray[0] = 'portfolio';
		$paramarray[1] = 'portfolio-tag';
	}
	
	$i = 0;
	$term;
	if( count( $termarray ) < 2 ){
		$flgNav = false;
	}else{
		$flgNav = true;
		foreach ( (array)$termarray as $value ){
			//term名を取得して絞り込みメニュー作成
			if( get_term_by('slug', $termarray[$i], $paramarray[1] ) <> false ) {
				$term = get_term_by('slug', $termarray[$i], $paramarray[1] );
			}else if( get_term_by('name', $termarray[$i], $paramarray[1] ) <> false ) {
				$term = get_term_by('name', $termarray[$i], $paramarray[1] );
			}else{
				continue;
			};
			//記事数0のtermは除外
			if($term->count <> 0){
				$lboxNav .= "\t\t".'<li class="lbox_nav_item">'.$term->name.'<input type="hidden" value="'.$term->slug.'"></li>'.PHP_EOL;
			}
			$i += 1;
		};
	};
	$lboxNav .= "\t".'</ul>'.PHP_EOL;
	
	$itemcount = 0;
	$sizeclass = '';
	
	$lboxThumbnail = "\t".'<div class="lbox_thumbs">'.PHP_EOL;
	$lboxThumbnail .= "\t\t".'<div class="grid-sizer"></div>'.PHP_EOL;
	$lboxView = "\t".'<div class="lbox_view hidden">'.PHP_EOL;
	$lboxView .= "\t\t".'<ul class="lbox_view_box">'.PHP_EOL;
	$cntterm = count($termarray);
	
	$my_query = new WP_Query( $args );
	//query_posts('post_per_page=all');
	while( $my_query->have_posts() ) : $my_query->the_post();
	
	$term = wp_get_object_terms( get_the_ID(), $paramarray[1] );
	$itemsize = get_post_meta(get_the_ID(), 'item_size', true );
	
	$lboxThumbnail .= "\t\t".'<div class="lbox_thumbs_item '.$term[0]->slug;
	if($itemsize == 'L'){
		$lboxThumbnail .= ' size_L';
	}elseif($itemsize == 'S'){
		$lboxThumbnail .= ' size_S';
	}else{
		$lboxThumbnail .= ' size_M';
	};
	$lboxThumbnail .= '">'.PHP_EOL;
	$lboxThumbnail .= "\t\t\t".'<input type="hidden" value="'.get_the_id().'">'.PHP_EOL;
	$lboxThumbnail .= "\t\t\t".'<span class="lbox_thumbs_item_label">'.get_the_title().'</span>'.PHP_EOL;
	
	$lboxView .= "\t\t".'<li class="lbox_view_box_item hidden" id="'.get_the_id().'">'.PHP_EOL;
	$lboxView .= "\t\t\t".'<div class="btn_close"><i class="fa fa-times"></i></div>'.PHP_EOL;
	$lboxView .= "\t\t\t".'<h3 class="lbox_view_box_item_title">'.get_the_title().'</h3>'.PHP_EOL;
	
	if ( has_post_thumbnail() ){
		$lboxThumbnail .= "\t\t\t".'<img class="lbox_thumbs_item_image" src="'.wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' )[0].'">'.PHP_EOL;
		$lboxView .= "\t\t\t".'<img class="lbox_view_box_item_image" src="'.wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' )[0].'">'.PHP_EOL;	
	};
	
	
	$lboxThumbnail .="\t\t".'</div>'.PHP_EOL;
	
	
	$lboxView .= "\t\t\t".get_the_content().PHP_EOL;
	$lboxView .= "\t\t".'</li>'.PHP_EOL;
	endwhile;
	
	
	$lboxThumbnail .= "\t".'</div>'.PHP_EOL;
	$lboxThumbnail .= "\t".'<div class="lbox_thumbs_hidden hidden">'.PHP_EOL;
	$lboxThumbnail .= "\t".'</div>'.PHP_EOL;
	
	$lboxView .= "\t\t".'</ul>'.PHP_EOL;
	$lboxView .= "\t".'</div>'.PHP_EOL;
	
	$lbox = '<div class="lbox" id="lbox-'.$paramarray[0].'">'.PHP_EOL;//'lbox-(posttype)'でid生成
	if( $flgNav == true){ 
		$lbox .= $lboxNav; 
	};
	$lbox .= $lboxThumbnail;
	$lbox .= $lboxView;
	$lbox .= '</div>'.PHP_EOL;
	
	return $lbox;
};
/** 帯状Thumbnail作成 **/
/* 使用方法：[instile]psottype,taxonomy,term,term...[/instile] */
function ins_tileboard($atts, $content = null){
	$tileboard = '';
	if(isset($content)) {		
		$paramarray = explode(',', $content);
		$i = 0;
		$j = 0;
		foreach((array)$paramarray as $value){
		    if($j >= 2){
				$termarray[$i] = $paramarray[$j];
				$i += 1;
			}
			$j += 1;
		}
		
		if($temparray[1] == null){
			$args = array(
			    'post_type' => $paramarray[0],
			);
		}else if($termarray == null){
			$args = array(
			    'post_type' => $paramarray[0],
			);
		}else{
		    $args = array(
		    	'post_type' => $paramarray[0],
		    	'tax_query' => array(
		    		'relation' => 'OR',
    	           	array(
    	               	'taxonomy' => $paramarray[1],
    	               	'field' => 'name',
    	               	'terms' => $termarray,
    	               ),
		    		array(
    	               	'taxonomy' => $paramarray[1],
    	               	'field' => 'slug',
    	               	'terms' => $termarray,
    	               ),
    	           ),
		    );
		};
		$tileboard = '<ul>'.PHP_EOL;
		$my_query = new WP_Query( $args );
		while( $my_query->have_posts() ) : $my_query->the_post();
		endwhile;
		$tileboard .= '</ul>'.PHP_EOL;
		
	};
	return $tileboard;
};
/** 任意のposttypeからマルチメディアボード作成 **/
/* 使用方法：[insmmb]posttype[/insmmb] */
add_shortcode( 'insmmb' , 'ins_mmboard' );
function ins_mmboard($atts, $content = null){
	$mmboard = "";
	if(isset($content)) {		
		$paramarray = explode(',', $content);
		$posttype = $paramarray[0];
		$mmboard .= '<div class="mmboard grid">'.PHP_EOL;
		$mmboard .= "\t".'<div class="grid-sizer"></div>'.PHP_EOL;
		$args = array(
			'post_type' => $posttype,
		);
		$my_query = new WP_Query( $args );
		$itemcount = 0;
		$sizeclass = '';
		while( $my_query->have_posts() ) : $my_query->the_post();
			$itemsize = get_post_meta(get_the_ID(), 'item_size', true );
			if($itemsize == 'L'){
				$sizeclass = 'grid-item--width3';
			}elseif($itemsize == 'M'){
				$sizeclass = 'grid-item--width2';
			}else{
				$sizeclass = '';
			}
			$mmboard .= "\t".'<div class="grid-item '.$sizeclass.'">'.PHP_EOL;
			if( get_the_title() <> false){
				$mmboard .= "\t\t".'<h4>～ '.get_the_title().' ～</h4>'.PHP_EOL;
			}else{
				$mmboard .= "\t\t".'<hr class="mm_spacer">'.PHP_EOL;
			};
			$mmboard .= "\t\t".do_shortcode(get_the_content()).PHP_EOL;
			$mmboard .= "\t".'</div>'.PHP_EOL;
			$itemcount += 1;
		endwhile;
		wp_reset_postdata();
		$mmboard .= '</div>'.PHP_EOL;
		
	}else{
		$mmboard ="表示するコンテンツがありません";
	}
	return $mmboard;
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

/**
 * ウィジェット絡みの設定
 * Register our sidebars and widgetized areas.
 **/
//ウィジェット有効化
function footer_widgets() {
	register_sidebar( array(
		'name' => 'crown_widget',
		'id' => 'crown_widget',
		'before_widget' => '<!-- crown_widget_1 -->',
		'after_widget' => '<!-- /crown_widget_1 -->',
		'before_title' => '<!-- ',
		'after_title' => ' -->',
	) );
	register_sidebar( array(
		'name' => 'header_Nav',
		'id' => 'header_nav',
		'before_widget' => '<!-- header_widget_1 -->',
		'after_widget' => '<!-- /header_widget_1 -->',
		'before_title' => '<!-- ',
		'after_title' => ' -->',
	) );
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
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => 'footer_widget_3',
		'id' => 'footer_3',
		'before_widget' => '<!-- footer_widget_3 -->',
		'after_widget' => '<!-- /footer_widget_3 -->',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => 'sub_widget_1',
		'id' => 'sub_1',
		'before_widget' => '<!-- sub_widget_1 -->',
		'after_widget' => '<!-- /sub_widget_1 -->',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => 'sub_widget_2',
		'id' => 'sub_2',
		'before_widget' => '<!-- sub_widget_2 -->',
		'after_widget' => '<!-- /sub_widget_2 -->',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => 'sub_widget_3',
		'id' => 'sub_3',
		'before_widget' => '<!-- sub_widget_3 -->',
		'after_widget' => '<!-- /sub_widget_3 -->',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => 'sub_widget_4',
		'id' => 'sub_4',
		'before_widget' => '<!-- sub_widget_4 -->',
		'after_widget' => '<!-- /sub_widget_4 -->',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
}
add_action( 'widgets_init', 'footer_widgets' );
add_filter('widget_text', 'do_shortcode');
add_theme_support( 'menu' );
add_filter('walker_nav_menu_start_el', 'description_in_nav_menu', 10, 4);
function description_in_nav_menu($item_output, $item){
	return preg_replace('/(<a.*?>[^<]*?)</', '$1' . "<br /><span>{$item->attr_title}</span><", $item_output);
}
/** Crown_Nav生成 **/
function ins_crown_nav(){
	$args = array( 'post_type' => 'outerlinks', );
	$my_query = new WP_Query( $args );
	if( !empty( $my_query ) ):
		$cnavCaptions = "\t\t\t\t".'<ul class="cnav_caption_group">'.PHP_EOL;
		$cnavItems = "\t\t\t\t".'<ul class="cnav_item_group">'.PHP_EOL;
		while ( $my_query->have_posts() ) : $my_query->the_post();
			$cnavCaptions .= "\t\t\t\t\t".'<li class="cnav_caption hidden">'.get_the_title().'</li>'.PHP_EOL;
			$cnavItems .= "\t\t\t\t\t".'<li class="cnav_item"><a class="'.get_post_meta(get_the_ID(), 'colorClass', true ).'" href="'.get_post_meta(get_the_ID(), 'href', true ).'" target="_blank">'.get_the_content().'</a></li>'.PHP_EOL;
		endwhile;
		wp_reset_postdata();
	
		$cnavCaptions .= "\t\t\t\t".'</ul>'.PHP_EOL;
		$cnavItems .= "\t\t\t\t".'</ul>'.PHP_EOL;
	
		$crown_nav = "\t\t\t".'<div id="crown_nav">'.PHP_EOL;
		$crown_nav .= $cnavCaptions.$cnavItems;
		$crown_nav .= "\t\t\t".'</div>'.PHP_EOL;
	
	endif;
	echo $crown_nav;
};

//任意のポストタイプへのアーカイブ＋アンカーリンク生成ショートコード
add_shortcode( 'inscptnav', 'ins_cptnav' );
function ins_cptnav($atts, $content = null) {
	
	$cptnav = '';
	if(isset($content)) {
		$paramarray = explode(',', $content);
		$args = array(
			'post_type' => $paramarray[0],
		);
	}else{
		$args = array(
			'post_type' => 'showcase',
		);
	}
	$my_query = new WP_Query( $args );
	$hrefid = '#hrefid';
	$itemcount = 0;
	$cptnav = "\t\t\t\t\t".'<!-- [inscptnav] -->'.PHP_EOL;
	$cptnav .= "\t\t\t\t\t".'<ul class="footer-nav">'.PHP_EOL;
	while( $my_query->have_posts() ) : $my_query->the_post();
		//$hrefid = '#'.get_post_meta(get_the_ID(), 'element_ID', true);
	    $hrefid = get_the_ID();
		//$cptnav .= "\t\t\t\t\t\t".'<li><a href="'.get_bloginfo('url').'/'.get_post_type().'/'.$hrefid.'">'.get_the_title().'</a></li>'.PHP_EOL;
	    $cptnav .= "\t\t\t\t\t\t".'<li><a href="'.get_post_permalink().'">'.get_the_title().'</a></li>'.PHP_EOL;
	$itemcount += 1;
	endwhile;
	if( $itemcount == 0 ){
		$cptnav .= "\t\t\t\t\t\t".'<li>No any item...</li>'.PHP_EOL;
	};
	$cptnav .= "\t\t\t\t\t".'</ul>'.PHP_EOL;
	wp_reset_postdata();
	$cptnav .= "\t\t\t\t\t".'<!-- [/inscptnav] -->';
	return $cptnav;
}
/** スライダー
* metaslider等のプラグイン利用を推奨
**/
global $num_slider;
$num_slider = 0 ;
add_shortcode( 'insslider', 'insert_slider');
function insert_slider( $atts, $content = null ) {
	global $num_slider;
	$num = $num_slider;
	$slider = '<ul id="slider_'.$num.'" class="slider">';
	$slidearray = explode( ',', $content );
	for ($i = 0; $i < count( $slidearray ); $i++){
		$slider .= '<li class="slide_item">'.$slidearray[$i].'<input type="hidden" value="'.$i.'"></li>'.PHP_EOL;
	};
	$slider .= '</ul>'.PHP_EOL;
	$num_slider ++;
	return $slider;
}
/** タクソノミー別事例カウンタ
* 仕様方法：[inscnt]post_type,taxonomy,term,term,term...[/inscnt]
**/
add_shortcode( 'inscnt', 'insert_counter');
function insert_counter( $atts, $content = null) {
	$countarray = array();
	$namearray = explode(',', $content);
	$i = 2;
	$j = 0;
	$counter = PHP_EOL."\t\t\t\t\t\t".'<ul class="counter">'.PHP_EOL;
	
	foreach($namearray as $value){
		if($j < $i){
			$j ++;
			continue;
		}
	    $countarray[$i] = 0;
		$args = array(
		    'post_type' => $namearray[0],
			'tax_query' => array(
			    array(
			        'taxonomy' => $namearray[1],
			        'field'    => 'name',
			        'terms'    => $namearray[$i],
		        ),
		    ),
		);
		$my_query = new WP_Query( $args );
		while ( $my_query->have_posts() ) : $my_query->the_post();
		$countarray[$i] ++;
		endwhile;
		if(intval($countarray[$i]) < 10){
			$countarray[$i] = '0'.$countarray[$i];
		}
		wp_reset_postdata();
		$counter .= "\t\t\t\t\t\t\t".'<li>'.PHP_EOL;
		$counter .= "\t\t\t\t\t\t\t\t".'<span class="counter_num">'.$countarray[$i].'</span>'.PHP_EOL;
		$counter .= "\t\t\t\t\t\t\t\t".'<span class="counter_label">'.$namearray[$i].'</span>'.PHP_EOL;
		$counter .= "\t\t\t\t\t\t\t".'</li>'.PHP_EOL;
		$i ++;
		$j ++;
	}
	$counter .= "\t\t\t\t\t\t".'</ul>'.PHP_EOL;
	
	return $counter;
}

/** タクソノミー別事例一覧
* ※編集中
* 使用方法：　[inspfitem]post_type,taxonomy,term,term,term...[/inspfitem]
**/
add_shortcode( 'inspfitem', 'insert_pfitem' );
function insert_pfitem( $atts, $content = null) {
	$namearray = explode(',', $content);
	$i = 2;
	$j = 0;
	$content = PHP_EOL."\t\t\t\t\t\t".'<ul class="counter">'.PHP_EOL;
	
	foreach($namearray as $value){
		if($j < $i){
				$j ++;
				continue;
		}
		$countarray[$i] = 0;
		$args = array(
		    'post_type' => $namearray[0],
			'tax_query' => array(
			    array(
			        'taxonomy' => $namearray[1],
			        'field'    => 'name',
			        'terms'    => $namearray[$i],
		        ),
		    ),
		);
		$my_query = new WP_Query( $args );
		$content .= "\t\t\t\t\t\t\t".'<h3>'.$namearray[$i].'</h3>'.PHP_EOL;
		$content .= "\t\t\t\t\t\t\t".'<ul>'.PHP_EOL;
		while ( $my_query->have_posts() ) : $my_query->the_post();
		$content .= "\t\t\t\t\t\t\t\t".'<li>'.get_the_title().'</li>'.PHP_EOL;
		endwhile;
		$content .= "\t\t\t\t\t\t\t".'</ul>'.PHP_EOL;
		$i ++;
		$j ++;
	}
    $content .= PHP_EOL."\t\t\t\t\t\t".'</ul>'.PHP_EOL;
	
	return $content;
}
/** リンクボタン作成ショートコード
使用方法： [insbtn]link,label,class[/insbtn] **/
add_shortcode( 'insbtn', 'ins_button');
function ins_button( $atts, $content = null) {
	$link = "";
	$label = "ボタンサンプル";
	$class = "";
	if($content <> null){
		$tmparray = explode(',', $content);
		$link = $tmparray[0];
		$label = $tmparray[1];
		$class = $tmparray[2];
	};
	$button = '<a href="'.$link.'" target="_blank"><button class="btn '.$class.'">'.$label.'</button></a>'; 
	return $button;
};
/** その他関数、ショートコード **/
add_shortcode( 'sitetop','call_sitetop' );
function call_sitetop() {
	return get_bloginfo('url');
}

add_shortcode( 'themeurl','call_themeurl' );
function call_themeurl() {
	return get_stylesheet_directory_uri();
}

add_action( 'wp_footer', 'my_load_script' );
function my_load_script(){
	wp_enqueue_script('base', get_stylesheet_directory_uri().'/js/base.js');
};


/** 「投稿」のラベルを「バックヤード」に変更 **/
function set_post_menu_label(){
	global $menu;
	global $submenu;
	$menu[5][0] = 'バックヤード';
	$submenu['edit.php'][5][0] = '記事一覧';
	$submenu['edit.php'][10][0] = '新しい記事';	
}
function set_post_obj_label(){
	global $wp_post_types;
	$labels= &$wp_post_types['post']->labels;
	$labels->name = 'バックヤード';
	$labels->singular_name = 'バックヤード';
	$labels->name_admin_bar = 'バックヤード';
	$labels->add_new = _x('追加', '記事');
	$labels->add_new_item = '記事を追加';
	$labels->edit_item = '記事の編集';
	$labels->new_item = '新規記事';
	$labels->view_item = '記事を表示';
	$labels->search_items = '記事を検索';
	$labels->not_found = '記事が見つかりませんでした';
	$labels->not_found_in_trash = 'ゴミ箱に記事は見つかりませんでした';
}
add_action( 'init', 'set_post_obj_label' );
add_action( 'admin_menu', 'set_post_menu_label' );


/*テーマカスタマイズ画面へheadアイテム追加*/
add_action( 'customize_register', 'add_exhead' ); 
 
function add_exhead($wp_customize){
	$wp_customize->add_section( 'ex_theme_item', array( 
        'title' => 'justFITテーマ向け追加アイテム', 
        'priority' => 1, 
        'description' => 'コピーライト表示やWebフォントの設定など',
    ));
    $wp_customize->add_setting('add_typekit', array( 
        'type'  => 'option', 
    ));
    $wp_customize->add_control( 'add_typekit', array( 
        'section' => 'ex_theme_item', 
        'settings' => 'add_typekit', 
        'label' => 'typekitを使用する', 
        'type' => 'checkbox'
    ));
    $wp_customize->add_setting('url_typekit', array( 
        'type'  => 'option', 
    ));
    $wp_customize->add_control( 'url_typekit', array( 
        'section' => 'ex_theme_item', 
        'settings' => 'url_typekit', 
        'label' => 'typekit参照URL”https://use.typekit.net/～”', 
        'type' => 'text'
    ));
	$wp_customize->add_setting('add_copyright', array( 
        'type'  => 'option', 
    ));
    $wp_customize->add_control( 'add_copyright', array( 
        'section' => 'ex_theme_item', 
        'settings' => 'add_copyright', 
        'label' => 'copyright表記を変更する', 
        'type' => 'checkbox'
    ));
    $wp_customize->add_setting('txt_copyright', array( 
        'type'  => 'option', 
    ));
    $wp_customize->add_control( 'txt_copyright', array( 
        'section' => 'ex_theme_item', 
        'settings' => 'txt_copyright', 
        'label' => 'コピーライトに表示したい権利者名', 
        'type' => 'text'
    ));
	
}

/** 画像挿入のコード変更 **/
add_shortcode('caption', 'my_img_caption_shortcode');

function my_img_caption_shortcode($attr, $content = null) {
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>s*)?<img [^>]+>(?:s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}

	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr, 'caption'));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '">' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
add_filter( 'image_send_to_editor', 'remove_image_attribute', 10 );
add_filter( 'post_thumbnail_html', 'remove_image_attribute', 10 );

function remove_image_attribute( $html ){
	$html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
	//$html = preg_replace( '/class=[\'"]([^\'"]+)[\'"]/i', '', $html );
	return $html;
}

add_action( 'wp_enqueue_scripts', 'callmasonry');
function callmasonry(){
	wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/masonry.min.js', array( 'jquery' ), '20170830', true );
}
add_action( 'wp_enqueue_scripts', 'callimageloaded');
function callimageloaded(){
	wp_enqueue_script( 'imageloaded', get_template_directory_uri() . '/js/imageloaded.js', array( 'jquery' ), '20170830', true );
}
add_action( 'wp_enqueue_scripts', 'callexactions');
function callexactions(){
	wp_enqueue_script( 'extra-action', get_template_directory_uri() . '/js/extractions.js', array( 'imageloaded' ), '20170830', true );
}
//現在のページ数の取得
function crt_show_page_num() {
    global $wp_query;

    $crt_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
    return $crt_page;  
}
//総ページ数の取得
function all_show_page_num() {
    global $wp_query;

    $max_page = $wp_query->max_num_pages;
    return $max_page; 
}
//パンくずリスト取得
function breadcrumb(){
    global $post;
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
        $str.='</div>';
    }
    echo $str;
}

/* DW Question & Answer のパーマリンクをpost_IDに差し替え */
add_filter('wp_unique_post_slug', 'change_post_slug', 10, 4);
function change_post_slug($slug, $post_ID, $post_status, $post_type){
  $postTypeArr = array(
      'dwqa-question'
  );
  if(in_array($post_type, $postTypeArr)){
    $slug = $post_ID;
  }
  return $slug;
}

?>
