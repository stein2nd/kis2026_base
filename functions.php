<?php
/**
 * Theme Functions
 * 
 * @package kis2026_base
 */

// ACF WYSIWYG プラグインを読み込む
include_once('acf-wp-wysiwyg/acf-wp_wysiwyg.php');

// テーマの初期設定を実行
add_action('after_setup_theme', 'kis2026_theme_setup');

// デフォルトのアクションを削除
add_action('init', 'kis2026_remove_default_actions');

// カスタム投稿タイプとタクソノミーを登録
add_action('init', 'kis2026_register_post_types_and_taxonomies');

// デフォルトのフィルターを削除
add_action('init', 'kis2026_remove_default_filters');

// カスタムフィルターを登録
add_action('init', 'kis2026_register_filters');

// ショートコードを登録
add_action('init', 'kis2026_register_shortcodes');

// 管理画面用のフックを登録
add_action('init', 'kis2026_register_admin_hooks');


/**
 * 【action フック「after_setup_theme」】
 * テーマの初期設定
 *
 * @return void
 */
function kis2026_theme_setup() {
    // サムネイルを有効
    add_theme_support('post-thumbnails');
}

/**
 * 【action フック「init」】
 * デフォルトのアクションを削除
 *
 * @return void
 */
function kis2026_remove_default_actions() {
    // バージョン情報
    remove_action('wp_head', 'wp_generator');

    // 前と後の記事の URL
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

    // RSS フィードの URL
    remove_action('wp_head', 'feed_links_extra', 3);
}

/**
 * 【action フック「init」】
 * カスタム投稿タイプとタクソノミーを登録
 *
 * @return void
 */
function kis2026_register_post_types_and_taxonomies() {
    // タクソノミー「カテゴリー」を追加
    register_taxonomy(
        'case_cat',
        'case',
        array(
            'hierarchical' => true,
            'update_count_callback' => '_update_post_term_count',
            'label' => 'カテゴリー',
            'singular_label' => 'カテゴリー',
            'public' => true,
            'show_ui' => true
        )
    );

    // カスタム投稿タイプ「イベント」を追加
    my_custom_post_type();

    // カスタム投稿タイプ「導入事例」を追加
    case_post_type();
}

/**
 * 【action フック「init」】
 * デフォルトのフィルターを削除
 *
 * @return void
 */
function kis2026_remove_default_filters() {
    // 記事の改行を無効化
    remove_filter('the_content', 'wptexturize');

    // 記事の自動整形を無効化
    remove_filter('the_content', 'wpautop');

    // 抜粋の自動整形を無効化
    remove_filter('the_excerpt', 'wpautop');
}

/**
 * 【action フック「init」】
 * カスタムフィルターを登録
 *
 * @return void
 */
function kis2026_register_filters() {
    // 管理画面で作成したフォームの場合、フック名の後のフォーム識別子は「mw-wp-form-xxx」
    // フォームの値を設定
    add_filter('mwform_value_mw-wp-form-71', 'my_mwform_value', 10, 2);

    // フォームのデフォルト・コンテンツを設定
    add_filter('mwform_default_content', 'my_mwform_default_content');

    // タイトルを設定
    add_filter('wp_title', 'my_wp_title', 10, 2);

    // TinyMCE のオプションをオーバーライド
    add_filter('tiny_mce_before_init', 'override_mce_options');

    // フロントエンドで管理画面用の CSS を読み込まないようにする
    //add_filter('body_class', 'remove_admin_body_classes', 999);
    //add_filter('style_loader_tag', 'remove_admin_style_tags', 999, 2);
}

/**
 * 【action フック「init」】
 * ショートコードを登録
 *
 * @return void
 */
function kis2026_register_shortcodes() {
    // テンプレートを読み込む
    add_shortcode('myinclude', 'Include_my_php');

    // テンプレート・ディレクトリの URL を取得
    add_shortcode("templatedir", "getUrlCode");

    // ルート URL を取得
    add_shortcode("root", "getUrlCode2");
}

/**
 * 【action フック「init」】
 * 管理画面用のフックを登録
 *
 * @return void
 */
function kis2026_register_admin_hooks() {
    // 管理画面のメニューを編集
    add_action('admin_menu', 'edit_admin_menus');

    // フロントエンドで管理画面用の CSS を読み込まないようにする
    //add_action('wp_enqueue_scripts', 'remove_admin_styles_from_frontend', 999);
}

/**
 * 【action フック「admin_menu」】
 * 管理画面のメニューを編集
 *
 * @return void
 */
function edit_admin_menus() {
  global $menu;
  $menu[5][0] = 'ニュース・お知らせ';// 投稿
}

/**
 * 【action フック「init」】
 * カスタム投稿タイプ「イベント」を追加
 *
 * @return void
 */
function my_custom_post_type() {
    $labels = array(
        'name' => 'イベント',
        'add_new_item' => '新規イベントを追加',
        'not_found' =>  __('イベントは見つかりませんでした'), 
        'new_item' => __('新しいイベント'),
        'view_item' => __('イベントを表示')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'rewrite' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail')
    );
    register_post_type('event',$args);
}

/**
 * 【action フック「init」】
 * カスタム投稿タイプ「導入事例」を追加
 *
 * @return void カスタム投稿タイプ「導入事例」を追加
 */
function case_post_type() {
    $labels = array(
        'name' => '導入事例',
        'add_new_item' => '新規導入事例を追加',
        'not_found' =>  __('導入事例は見つかりませんでした'), 
        'new_item' => __('新しい導入事例'),
        'view_item' => __('導入事例を表示')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'rewrite' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'has_archive' => true,
        'supports' => array('title', 'thumbnail')
    );
    register_post_type('case',$args);
}

/**
 * 【filter フック「mwform_value_mw-wp-form-71」】
 * フォームの値を設定
 *
 * @param [type] $value フォームの値
 * @param [type] $name フォームの名前
 * @return string フォームの値
 */
function my_mwform_value( $value, $name ) {

    if ( $name === 'iq_content') {
        if (!empty( $_GET['type'] ) && !is_array( $_GET['type'] ) ) {
            return 'その他お問い合わせ';
        } else {
            return '資料請求';
        }
    }
    return $value;
}

/**
 * 【filter フック「mwform_default_content」】
 * フォームのデフォルト・コンテンツを設定
 *
 * @param [type] $content フォームのデフォルト・コンテンツ
 * @return string フォームのデフォルト・コンテンツ
 */
function my_mwform_default_content( $content ) {
    // テーマファイルに置いたフォーム内容用のテンプレートを使用する例
    ob_start();
    get_template_part( 'inc/mw-wp-form-default-content' );

    return ob_get_clean();
}

/**
 * 【filter フック「wp_title」】
 * タイトルを設定
 *
 * @param string $title タイトル
 * @param string $sep セパレータ
 * @return string タイトル
 */
function my_wp_title( $title, $sep ) {
	global $paged, $page, $post;

	if ( is_feed() ) {
		return $title;
	}

    if ( get_post_type($post) === 'event' && is_single() ) {
        $title .= "イベント $sep ";
    }
    elseif ( get_post_type($post) === 'case' && is_single() ) {
        $title .= "導入事例 $sep ";
    }
    elseif ( get_post_type($post) === 'post' && is_single() ) {
        $title .= "ニュース $sep ";
    }

	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', '' ), max( $paged, $page ) );
	}

	return $title;
}

/**
 * 【filter フック「tiny_mce_before_init」】
 * TinyMCE のオプションをオーバーライド
 *
 * @param array $init_array TinyMCE のオプション
 * @return array TinyMCE のオプション
 */
function override_mce_options( $init_array ) {
    $init_array['indent']  = true;
    $init_array['wpautop'] = false;

    return $init_array;
}

/**
 * 【shortcode「myinclude」】
 * テンプレートを読み込む
 *
 * @param array $params パラメータ
 * @return string テンプレートの内容
 */
function Include_my_php($params = array()) {
    extract(shortcode_atts(array(
        'file' => 'default'
    ), $params));
    ob_start();
    include(get_theme_root() . '/' . get_template() . "/$file.php");

    return ob_get_clean();
}

/**
 * 【shortcode「templatedir」】
 * テンプレート・ディレクトリの URL を取得
 *
 * @return string テンプレート・ディレクトリの URL
 */
function getUrlCode() {
    return esc_html( get_template_directory_uri() );
}

/**
 * 【shortcode「root」】
 * ルート URL を取得
 *
 * @return string テンプレート・ディレクトリの URL
 */
function getUrlCode2() {
    return esc_url( home_url() );
}


/**
 * 【archive.php、archive-case.php】
 * ページネーション
 *
 * @param WP_Query $query クエリオブジェクト
 * @return void ページネーション
 */
function wp_paging_nav($query) {
    if ( $query->max_num_pages < 2 ) {
        return;
    }

    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );
    $pages = '';

    if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
    }
    if($pages == '') {
        $pages = $query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }   

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
    $total   = $query->max_num_pages;

    // Set up paginated links.
    $links = paginate_links( array(
        'base'     => $pagenum_link,
        'format'   => $format,
        'total'    => $total,
        'current'  => $paged,
        'mid_size' => 1,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => __( '&lt;' ),
        'next_text' => __( '&gt;' ),
    ) );

    if ( $links ) :

    ?>
    <div class="pager">
        <div class="pager__inner">
        <?php echo $links; ?>
        </div>
    </div><!-- .navigation -->
    <?php
    endif;
}

/**
 * 【404.php、page.php、page-none-title.php、page-recruit-form.php】
 * パンくずリスト
 *
 * @param [type] $post 投稿
 * @return void
 */
function breadcrumb($post) {
    $html = '<div class="breadcrumb__items"><span class="item"><a href="'.esc_url( home_url( '/' )).'">TOP</a></span>　&gt;　';
    if (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $parent_title = get_post($parent_id)->post_title;
        $parent_url =  get_page_link($post->post_parent);
        $html .= '<span class="item"><a href="'.$parent_url.'">'.$parent_title.'</a></span>　&gt;　';
    }
    $html .= '<span class="item"><span>'.get_the_title().'</span></span></div>';
    echo $html;
}

/**
 * バナーの日付を表示
 *
 * @param string $field_date バナーの日付
 * @return void バナーの日付
 */
function formatBannerDate($field_date) {
    $date_arr = preg_split('/\//', $field_date);

    $timestamp = mktime(0, 0, 0, $date_arr[1], $date_arr[2], $date_arr[0]);
    $week_label = array( '(日)', '(月)', '(火)', '(水)', '(木)', '(金)', '(土)' );
    $weekno = date('w', $timestamp);

    echo (int)$date_arr[1] . '<span>月</span>' . (int)$date_arr[2] . '<span>日</span>' . '<span>' . $week_label[$weekno] . '</span>';

    return 1;
}

/**
 * 【action フック「wp_enqueue_scripts」】
 * フロントエンドで管理画面用の CSS（common.min.css）を読み込まないようにする
 * Admin バー用の CSS は残す
 *
 * @return void
 */
function remove_admin_styles_from_frontend() {
    if (!is_admin()) {
        // common.min.css のみを無効化（Admin バー用の CSS は残す）
        global $wp_styles;
        if (isset($wp_styles->registered)) {
            foreach ($wp_styles->registered as $handle => $style) {
                // common.min.css のみを無効化（admin-bar は除外）
                if (isset($style->src) && 
                    strpos($style->src, 'common.min.css') !== false &&
                    strpos($style->src, 'admin-bar') === false) {
                    wp_dequeue_style($handle);
                    wp_deregister_style($handle);
                }
            }
        }
    }
}

/**
 * 【filter フック「body_class」】
 * body タグから管理画面用のクラスを削除する（admin-bar は残す）
 *
 * @param array $classes body タグに付与されるクラス
 * @return array body タグに付与されるクラス
 */
function remove_admin_body_classes($classes) {
    if (!is_admin()) {
        // 管理画面用のクラスを削除（admin-bar は残す）
        $admin_classes = array(
            'wp-admin',
            'no-customize-support',
        );

        // wp-admin 関連のクラスを削除（admin-bar は除外）
        foreach ($classes as $key => $class) {
            if (in_array($class, $admin_classes) || 
                (strpos($class, 'wp-admin') !== false && $class !== 'admin-bar')) {
                unset($classes[$key]);
            }
        }
    }
    return $classes;
}

/**
 * 【filter フック「style_loader_tag」】
 * 出力される CSS リンクタグから common.min.css を削除する（Admin バー用の CSS は残す）
 *
 * @param string $tag 出力される CSS リンクタグ
 * @param string $handle スタイルシートのハンドル名
 * @return string 出力される CSS リンクタグ
 */
function remove_admin_style_tags($tag, $handle) {
    if (!is_admin()) {
        // common.min.css のみを削除（admin-bar は除外）
        if (strpos($tag, 'common.min.css') !== false && 
            strpos($tag, 'admin-bar') === false) {
            return '';
        }
    }
    return $tag;
}

?>