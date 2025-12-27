<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title><?php wp_title(' | ', true, 'right'); ?></title>
    <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url(home_url('/')); ?>apple-touch-icon.png">
    <link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo esc_url(home_url('/')); ?>favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <?php
        $my_domain = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'];
    ?>
    <script src="<?php echo get_template_directory_uri(); ?>/dist/js/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/dist/js/flexibility.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/dist/js/index.js"></script>

    <?php
        if (is_post_type_archive('event')):
            ?>
            <meta name="description"
                content="港湾物流業務や海貨業務向けのパッケージソフト『Forwarder-PRO』や、輸出入の貿易業務向けのパッケージソフト『K-TRADE2』を説明します。奮ってご参加いただければ幸いです。最善のシステムをご提案します。"/>

            <meta name="keywords"
                content="港湾,海貨,フォワーダー,保税倉庫,国際,物流,貿易,輸出,輸入,複合一貫,輸送,NVOCC,ロジスティック,AEO,三国間,グローバル,SCM,設備,工事,原価,ガス,機械,工具,金物,商社,卸,販売,ソフト,システム,ソリューション,パッケージ,ERP,開発,コンプライアンス,内部統制,経営課題,イベント情報,説明会,セミナー"/>

            <link rel="canonical" href="<?php echo $my_domain; ?>/case/"/>
            <meta property="og:title" content="イベント | 関西総合システム"/>
            <meta property="og:type" content="activity"/>
            <meta property="og:url" content="<?php echo $my_domain; ?>/case/"/>
            <meta property="og:image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>
            <meta property="og:site_name" content="関西総合システムWEBサイト"/>
            <meta property="og:description"
                content="港湾物流業務や海貨業務向けのパッケージソフト『Forwarder-PRO』や、輸出入の貿易業務向けのパッケージソフト『K-TRADE2』を説明します。奮ってご参加いただければ幸いです。最善のシステムをご提案します。"/>
            <meta name="twitter:card" content="summary"/>
            <meta name="twitter:title" content="イベント | 関西総合システム"/>
            <meta name="twitter:description"
                content="港湾物流業務や海貨業務向けのパッケージソフト『Forwarder-PRO』や、輸出入の貿易業務向けのパッケージソフト『K-TRADE2』を説明します。奮ってご参加いただければ幸いです。最善のシステムをご提案します。"/>
            <meta name="twitter:image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>
            <meta itemprop="image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>

        <?php
        elseif (get_post_type($post) === 'event' && is_single()):
            ?>
            <meta name="description" content="<?php the_title(); ?>"/>

            <meta name="keywords"
                content="港湾,海貨,フォワーダー,保税倉庫,国際,物流,貿易,輸出,輸入,複合一貫,輸送,NVOCC,ロジスティック,AEO,三国間,グローバル,SCM,設備,工事,原価,ガス,機械,工具,金物,商社,卸,販売,ソフト,システム,ソリューション,パッケージ,ERP,開発,コンプライアンス,内部統制,経営課題,イベント情報,説明会,セミナー"/>

            <link rel="canonical" href="<?php echo get_bloginfo('url') . $_SERVER['REQUEST_URI']; ?>"/>
            <meta property="og:title" content="<?php the_title(); ?> | イベント | 関西総合システム"/>
            <meta property="og:type" content="activity"/>
            <meta property="og:url" content="<?php echo get_bloginfo('url') . $_SERVER['REQUEST_URI']; ?>"/>
            <meta property="og:image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>
            <meta property="og:site_name" content="関西総合システムWEBサイト"/>
            <meta property="og:description" content="<?php the_title(); ?>"/>
            <meta name="twitter:card" content="summary"/>
            <meta name="twitter:title" content="<?php the_title(); ?> | イベント | 関西総合システム"/>
            <meta name="twitter:description" content="<?php the_title(); ?>"/>
            <meta name="twitter:image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>
            <meta itemprop="image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>

        <?php
        endif;
    ?>

    <?php
        if (is_post_type_archive('case')):
            ?>
            <meta name="description"
                content="港湾物流業務や海貨業務、輸出入の貿易業務を中心にシステム開発や導入の事例を紹介しています。当社のソリューションを飛躍させるために実施した海外視察のレポートも掲載しています。是非ご覧ください。"/>

            <meta name="keywords"
                content="港湾,海貨,フォワーダー,保税倉庫,国際,物流,貿易,輸出,輸入,複合一貫,輸送,NVOCC,ロジスティック,AEO,三国間,グローバル,SCM,設備,工事,原価,ガス,機械,工具,金物,商社,卸,販売,ソフト,システム,ソリューション,パッケージ,ERP,開発,コンプライアンス,内部統制,経営課題,導入事例"/>

            <link rel="canonical" href="<?php echo $my_domain; ?>/case/"/>
            <meta property="og:title" content="導入事例 | 関西総合システム"/>
            <meta property="og:type" content="activity"/>
            <meta property="og:url" content="<?php echo $my_domain; ?>/case/"/>
            <meta property="og:image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>
            <meta property="og:site_name" content="関西総合システムWEBサイト"/>
            <meta property="og:description"
                content="港湾物流業務や海貨業務、輸出入の貿易業務を中心にシステム開発や導入の事例を紹介しています。当社のソリューションを飛躍させるために実施した海外視察のレポートも掲載しています。是非ご覧ください。"/>
            <meta name="twitter:card" content="summary"/>
            <meta name="twitter:title" content="導入事例 | 関西総合システム"/>
            <meta name="twitter:description"
                content="港湾物流業務や海貨業務、輸出入の貿易業務を中心にシステム開発や導入の事例を紹介しています。当社のソリューションを飛躍させるために実施した海外視察のレポートも掲載しています。是非ご覧ください。"/>
            <meta name="twitter:image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>
            <meta itemprop="image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>

        <?php
        elseif (get_post_type($post) === 'case' && is_single()):
            ?>
            <meta name="description" content="<?php the_title(); ?>様の導入事例をご紹介しています。"/>

            <meta name="keywords"
                content="港湾,海貨,フォワーダー,保税倉庫,国際,物流,貿易,輸出,輸入,複合一貫,輸送,NVOCC,ロジスティック,AEO,三国間,グローバル,SCM,設備,工事,原価,ガス,機械,工具,金物,商社,卸,販売,ソフト,システム,ソリューション,パッケージ,ERP,開発,コンプライアンス,内部統制,経営課題,導入事例"/>

            <link rel="canonical" href="<?php echo get_bloginfo('url') . $_SERVER['REQUEST_URI']; ?>"/>
            <meta property="og:title" content="<?php the_title(); ?> | 導入事例 | 関西総合システム"/>
            <meta property="og:type" content="activity"/>
            <meta property="og:url" content="<?php echo get_bloginfo('url') . $_SERVER['REQUEST_URI']; ?>"/>
            <meta property="og:image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>
            <meta property="og:site_name" content="関西総合システムWEBサイト"/>
            <meta property="og:description" content="<?php the_title(); ?>様の導入事例をご紹介しています。"/>
            <meta name="twitter:card" content="summary"/>
            <meta name="twitter:title" content="<?php the_title(); ?> | 導入事例 | 関西総合システム"/>
            <meta name="twitter:description" content="<?php the_title(); ?>様の導入事例をご紹介しています。"/>
            <meta name="twitter:image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>
            <meta itemprop="image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>
        <?php
        endif;
    ?>

    <?php
        if (get_post_type($post) === 'post' && is_single()):
            ?>
            <meta name="description" content="<?php the_title(); ?>"/>

            <meta name="keywords"
                content="港湾,海貨,フォワーダー,保税倉庫,国際,物流,貿易,輸出,輸入,複合一貫,輸送,NVOCC,ロジスティック,AEO,三国間,グローバル,SCM,設備,工事,原価,ガス,機械,工具,金物,商社,卸,販売,ソフト,システム,ソリューション,パッケージ,ERP,開発,コンプライアンス,内部統制,経営課題"/>

            <link rel="canonical" href="<?php echo get_bloginfo('url') . $_SERVER['REQUEST_URI']; ?>"/>
            <meta property="og:title" content="<?php the_title(); ?> | ニュース | 関西総合システム"/>
            <meta property="og:type" content="activity"/>
            <meta property="og:url" content="<?php echo get_bloginfo('url') . $_SERVER['REQUEST_URI']; ?>"/>
            <meta property="og:image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>
            <meta property="og:site_name" content="関西総合システムWEBサイト"/>
            <meta property="og:description" content="<?php the_title(); ?>"/>
            <meta name="twitter:card" content="summary"/>
            <meta name="twitter:title" content="<?php the_title(); ?> | ニュース | 関西総合システム"/>
            <meta name="twitter:description" content="<?php the_title(); ?>"/>
            <meta name="twitter:image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>
            <meta itemprop="image" content="<?php echo $my_domain; ?>/wp-content/uploads/2018/01/ogimg.png"/>

        <?php
        endif;
    ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NXLPX6D2');</script>
    <!-- End Google Tag Manager -->
    <!-- Google Search Console -->
    <meta name="google-site-verification" content="aKdhkOJLvnuHg6K68SxeIcMJDQL71nhoMXeSErU7_nc" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-30327234-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-30327234-1');
    </script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXLPX6D2"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="wrapper">
    <div class="siteHeader">
        <div class="fixedWidth col">
            <?php if (is_home()) : ?>
                <header class="box">
                    <h1 class="desc pc">輸出入、港湾物流、海貨、倉庫事業者へ国際物流の確かなソリューションを提供</h1>
                    <div class="logo"><img src="<?php echo get_template_directory_uri(); ?>/dist/assets/logo.svg"
                            alt="<?php bloginfo('name'); ?>"></div>
                </header>
            <?php else : ?>
                <div class="box">
                    <p class="desc pc">輸出入、港湾物流、海貨、倉庫事業者へ国際物流の確かなソリューションを提供</p>
                    <div class="logo"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img
                                src="<?php echo get_template_directory_uri(); ?>/dist/assets/logo.svg"
                                alt="<?php bloginfo('name'); ?>"></a></div>
                </div>
            <?php endif; ?>
            <div class="box--r pc">
                <a href="<?php echo esc_url(home_url('/')); ?>inquiry/" class="button button--a">お問い合わせ・資料請求<span
                        class="icon icon--arrow"></span></a>
                <!-- Begin Yahoo Search Form -->
                <form action="https://search.yahoo.co.jp/search" method="get" target="_blank" class="searchform">
                    <p style="margin:0;padding:0;">
                        <input type="text" name="p" size="28" id="s">
                        <input type="hidden" name="fr" value="yssw">
                        <input type="hidden" name="ei" value="utf-8">
                        <input type="submit" value="検索" id="searchsubmit">
                        <input name="vs" type="hidden" value="<?php echo $my_domain; ?>/" checked="checked">
                    </p>
                </form>
                <img src="https://custom.search.yahoo.co.jp/images/window/006c75a92ba244c6b4cbe2709aa17d7b.gif"
                    width="1" height="1" style="display:block;position:absolute">
                <!-- End Yahoo! Search Form -->
            </div>
        </div>
        <div class="toggleNav sp"><span></span><span></span><span></span></div>
    </div>
    <nav class="navMain">
        <ul class="fixedWidth">
            <li class="navMain__sp"><a href="<?php echo esc_url(home_url('/')); ?>"><span class="label">HOME</span></a>
            </li>
            <li class="firstPc"><a href="<?php echo esc_url(home_url('/')); ?>reason/"><span
                        class="label">KISが選ばれる理由</span></a></li>
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>news/"<?php if (is_singular('post')): ?> class="current"<?php endif; ?>><span
                        class="label">ニュース</span></a></li>
            <li><a href="<?php echo esc_url(home_url('/')); ?>event/"><span class="label">イベント</span></a></li>
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>products/"><span class="label">製品情報</span></a>
                <ul>
                    <li>
                        <a href="<?php echo esc_url(home_url('/')); ?>products/forwarderpro/">
                            <small>港湾物流業務システム</small>
                            <span class="label">Forwarder-PROシリーズ</span>
                        </a>
                    </li>
                    <li class="flex__item flex__item--full compo-card">
                        <a href="<?php echo esc_url(home_url('/')); ?>products/solution/">
                            <small>各種ソリューション</small>
                            <span class="label">各種ソリューション</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li><a href="<?php echo esc_url(home_url('/')); ?>case/"><span class="label">導入事例</span></a></li>
            <li><a href="<?php echo esc_url(home_url('/')); ?>corporate/"><span class="label">会社情報</span></a></li>
            <li><a href="<?php echo esc_url(home_url('/')); ?>recruit/"><span class="label">採用情報</span></a></li>
            <li class="navMain__sp"><a href="<?php echo esc_url(home_url('/')); ?>inquiry/"><span
                        class="label">お問い合わせ・資料請求</span></a></li>
            <li class="navMain__sp"><a href="<?php echo esc_url(home_url('/')); ?>privacy/"><span
                        class="label">個人情報保護方針</span></a></li>
        </ul>
        <div class="navMain__close sp"><a href="#" class="button navMain__closeButton no-scroll">閉じる</a></div>
    </nav>
    <div class="wrapper col">