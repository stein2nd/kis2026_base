<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title><?php wp_title(' | ', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="wrapper">
    <div class="siteHeader">
        <div class="fixedWidth col">
            <?php if (is_home()) : ?>
                <header class="box">
                    <h1 class="desc pc">輸出入、港湾物流、海貨、倉庫事業者へ国際物流の確かなソリューションを提供</h1>
                    <div class="logo">
                        <img src="<?php echo content_url('/uploads/2017/12/logo.png'); ?>" alt="<?php bloginfo('name'); ?>">
                    </div>
                </header>
            <?php else : ?>
                <div class="box">
                    <p class="desc pc">輸出入、港湾物流、海貨、倉庫事業者へ国際物流の確かなソリューションを提供</p>
                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <img src="<?php echo content_url('/uploads/2017/12/logo.png'); ?>" alt="<?php bloginfo('name'); ?>">
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            <div class="box--r pc">
                <a href="<?php echo esc_url(home_url('/')); ?>inquiry/" class="button button--a">お問い合わせ・資料請求<span class="icon icon--arrow"></span></a>
                <!-- Begin Yahoo Search Form -->
                <form action="https://search.yahoo.co.jp/search" method="get" target="_blank" class="searchform">
                    <p style="margin:0;padding:0;">
                        <input type="text" name="p" size="28" id="s">
                        <input type="hidden" name="fr" value="yssw">
                        <input type="hidden" name="ei" value="utf-8">
                        <input type="submit" value="検索" id="searchsubmit">
                        <input name="vs" type="hidden" value="<?php echo esc_attr( kis2026_get_site_origin() ); ?>/" checked="checked">
                    </p>
                </form>
                <img src="https://custom.search.yahoo.co.jp/images/window/006c75a92ba244c6b4cbe2709aa17d7b.gif" width="1" height="1" style="display:block;position:absolute">
                <!-- End Yahoo! Search Form -->
            </div>
        </div>
        <div class="toggleNav sp"><span></span><span></span><span></span></div>
    </div>
    <nav class="navMain">
        <ul class="fixedWidth">
            <li class="navMain__sp">
                <a href="<?php echo esc_url(home_url('/')); ?>"><span class="label">HOME</span></a>
            </li>
            <li class="firstPc">
                <a href="<?php echo esc_url(home_url('/')); ?>reason/"><span class="label">KISが選ばれる理由</span></a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>news/"<?php if (is_singular('post')): ?> class="current"<?php endif; ?>><span class="label">ニュース</span></a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>event/"><span class="label">イベント</span></a>
            </li>
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
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>case/"><span class="label">導入事例</span></a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>corporate/"><span class="label">会社情報</span></a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>recruit/"><span class="label">採用情報</span></a>
            </li>
            <li class="navMain__sp">
                <a href="<?php echo esc_url(home_url('/')); ?>inquiry/"><span class="label">お問い合わせ・資料請求</span></a>
            </li>
            <li class="navMain__sp">
                <a href="<?php echo esc_url(home_url('/')); ?>privacy/"><span class="label">個人情報保護方針</span></a>
            </li>
        </ul>
        <div class="navMain__close sp">
            <a href="#" class="button navMain__closeButton no-scroll">閉じる</a>
        </div>
    </nav>
    <div class="wrapper col">