<?php
// js,cssの読み込み
function my_enqueue_scripts() {
  wp_enqueue_script('jquery');
  wp_enqueue_script('bundle_js', get_template_directory_uri(). '/assets/js/bundle.js', []);
  wp_enqueue_style('my_styles', get_template_directory_uri(). '/assets/css/styles.css', []);
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');

// グローバルメニューとフッターメニューを追加
register_nav_menus([
  'place_gloabal' => 'グローバル',
  'place_footer' => 'フッターナビ',
]);

function get_main_title() {
  if (is_singular( 'post' )) {
    // ニュースリリース詳細の時はカテゴリを取得する
    $category_obj = get_the_category();
    return $category_obj[0]->name;
  } elseif ( is_page() ) {
    // 固定ページの時
    return get_the_title();
  } elseif ( is_category() || is_tax() ) {
    // ニュースリリース一覧でカテゴリ名
    // 地域貢献活動のtaxonomy
    return single_cat_title();
  } elseif ( is_search() ) {
    // 検索結果
    return "サイト内検索結果";
  } elseif ( is_404() ) {
    return "ページが見つかりません";
  } elseif ( is_singular('daily_contribution') ) {
    // 地域貢献活動の詳細ページでどのイベントの種類かを取得する
    global $post;
    $term_obj = get_the_terms($post->ID, 'event');
    return $term_obj[0]->name;
  }
}

// 小ページを取得する関数
function get_child_pages($number = -1, $specified_id = null) {
  if (isset($specified_id)) {
    $parent_id = $specified_id;
  } else {
    $parent_id = get_the_ID();
  }
  $args = [
    'posts_per_page' => $number,
    'post_type' => 'page',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'post_parent' => $parent_id,
  ];
  return new WP_Query( $args );
}

// アイキャッチ画像を利用できるようになる
add_theme_support('post-thumbnails');

// トップページのメイン画像用のサイズ設定
add_image_size('top', 1077, 622, true);
// 地域貢献活動一覧画像用のサイズ設定
add_image_size('contribution', 557, 280, true);
// トップページの地域貢献活動にて使用している画像用のサイズ設定
add_image_size('front-contribution', 255, 189, true);
// 企業情報・店舗情報一覧画像用のサイズ設定
add_image_size('common', 465, 252, true);
// 各ページのメイン画像用のサイズ設定
add_image_size('detail', 1100, 330, true);
// 検索一覧画像用のサイズ設定
add_image_size('search', 168, 168, true);

// 各テンプレートごとのメイン画像を表示
function get_main_image() {
  if ( is_page() || is_singular('daily_contribution') ) {
    // アイキャッチ画像から出したいとき
    // return get_the_post_thumbnail($post->ID, 'detail');
    
    // 固定ページと地域貢献活動詳細はカスタムフィールドから取得
    $attachment_id = get_field('main_image');
    if ( is_front_page() ) {
      // トップページの時は画像を大きく
      return wp_get_attachment_image($attachment_id, 'top');
    } else {
      return wp_get_attachment_image($attachment_id, 'detail');
    }
  } elseif(is_category('news') || is_singular('post')) {
    // ニュースリリース一覧と詳細
    return '<img src="'. get_template_directory_uri(). '/assets/images/bg-page-news.jpg" />';
  } elseif(is_search() || is_404()) {
    // 検索結果ページと404
    return '<img src="'. get_template_directory_uri(). '/assets/images/bg-page-search.jpg" />';
  } elseif ( is_tax('event') ) {
    // 地域貢献活動の2回層目
    $term_obj = get_queried_object();
    $image_id = get_field('event_image', $term_obj->taxonomy.'_'.$term_obj->term_id);
    return wp_get_attachment_image($image_id, 'detail');
  } else {
    return '<img src="'. get_template_directory_uri(). '/assets/images/bg-page-dummy.png" />';
  }
}

// 特定の記事を抽出する関数
function get_specific_posts( $post_type, $taxonomy = null, $term = null, $number = -1) {
  if ( !$term ) {
    // $termが無効な時は設定する
    $term_obj = get_terms('event');
    $term = wp_list_pluck($term_obj, 'slug');
    // var_dump($term);
  }
  $args = [
    'post_type' => $post_type,//post | 'daily_contribution', 
    'tax_query' => [[
      'taxonomy' => $taxonomy,//category | 'event'
      'field' => 'slug',
      'terms' => $term,//news | ['festival','conference','recreation','exhibition']
    ]],
    'posts_per_page' => $number,//-1
  ];
  return new WP_Query( $args );
}

// 切り詰める際の文字列
function cms_excerpt_more() {
  return '...';
}
add_filter('excerpt_more', 'cms_excerpt_more');
// デフォルトで何文字に切り詰めるか
function cms_excerpt_length() {
  return 80;
}
add_filter('excerpt_mblength', 'cms_excerpt_length');

// 固定ページで抜粋機能を使えるようにする
add_post_type_support('page', 'excerpt');

// 指定した文字数に切り詰める関数
function get_flexible_excerpt($number) {
  $value = get_the_excerpt();
  return wp_trim_words($value, $number, '...');
}

function apply_excerpt_br( $value ) {
  return nl2br( $value );
}
// get_the_excerptに処理を差し込む
add_filter('get_the_excerpt', 'apply_excerpt_br');

// ウィジェット機能を有効化する
function theme_widgets_init() {
  register_sidebar([
    'name' => 'サイドバーウィジェットエリア',
    'id' => 'primary_widget_area',
    'description' => '固定ページのサイドバー',
    'before_widget' => '<aside class="side-inner">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="title">',
    'after_title' => '</h4>'
  ]);
}
add_action('widgets_init', 'theme_widgets_init');

// サイドバーウィジェットでショートコードを呼び出す
// add_filter('widget_text', 'do_shortcode');

// 英語タイトルを表示
function get_main_en_title() {
  if( is_category() ) {
    // ニュース一覧のとき
    $term_obj = get_queried_object();
    return get_field('english_title', $term_obj->taxonomy.'_'.$term_obj->term_id);
  } else if ( is_singular('post') ) {
    // ニュース詳細
    $term_obj = get_the_category();
    return get_field('english_title', $term_obj[0]->taxonomy.'_'.$term_obj[0]->term_id);
  } else if ( is_page() || is_singular('daily_contribution') ) {
    // 固定ページと地域貢献活動詳細
    return get_field('english_title');
  } else if ( is_search() ) {
    return 'Search Result';
  } else if ( is_404() ) {
    return '404 Not Found';
  } else if ( is_tax() ) {
    // 地域貢献活動の2階層目
    $term_obj = get_queried_object();
    return get_field('english_title', $term_obj->taxonomy.'_'.$term_obj->term_id);
  }
}