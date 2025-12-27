<?php get_header(); ?>

    <div class="setOvHidden">
        <div class="slick fixedWidth">
            <div class="item">
                <a href="<?php echo esc_url(home_url('/')); ?>reason/">
                    <span class="pc"><img src="../../wp-content/uploads/2017/12/home_v_01.jpg"
                            alt="KISが選ばれる理由"></span>
                    <span class="sp"><img src="../../wp-content/uploads/2017/12/home_v_sp_01.jpg"
                            alt="KISが選ばれる理由"></span>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo esc_url(home_url('/')); ?>products/forwarderpro/">
                    <span class="pc"><img src="../../wp-content/uploads/2020/10/home_v_04.jpg?v=1"
                            alt="通関業・海貸業向けトータルソリューションForwarder-PRO＜Web版＞"></span>
                    <span class="sp"><img src="../../wp-content/uploads/2020/10/home_v_sp_04.jpg?v=1"
                            alt="通関業・海貸業向けトータルソリューションForwarder-PRO＜Web版＞"></span>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo esc_url(home_url('/')); ?>/products/solution/">
                    <span class="pc"><img src="../../wp-content/uploads/2018/01/home_v_05.jpg"
                            alt="各種ソリューション"></span>
                    <span class="sp"><img src="../../wp-content/uploads/2018/01/home_v_sp_05.jpg"
                            alt="各種ソリューション"></span>
                </a>
            </div>
        </div>
    </div>

    <script src="<?php echo get_template_directory_uri(); ?>/dist/js/slick.min.js"></script>
    <script>
        jQuery(function ($) {
            $slick = $('.slick').slick({
                arrows: true,
                infinite: true,
                dots: true,
                autoplay: true,
                responsive: [
                    {
                        breakpoint: 640,
                        settings: {
                            arrows: false
                        }
                    }
                ]
            });
            $slick.on('init', function (event, slick, direction) {
            });
        });
    </script>
    <div class="fixedWidth spPad">
        <section>
            <header class="headerA">
                <h2 class="string">製品ラインアップ</h2>
                <small>PRODUCTS</small>
            </header>
            <ul class="flex flex--col3">
                <li class="flex__item compoCard compoCard--full">
                    <a href="<?php echo esc_url(home_url('/')); ?>products/forwarderpro/" class="resetHover">
                        <div class="compoCard__thumb">
                            <img src="../../wp-content/uploads/2018/03/home_img_01.jpg" alt="">
                        </div>
                        <dl class="compoCard__content">
                            <dt class="compoCard__title">港湾物流業務システム</dt>
                            <dd>
                                <div class="compoCard__img"><img
                                        src="../../wp-content/uploads/2020/10/home_img_02.jpg"
                                        alt="通関業・海貸業向けトータルソリューションForwarder-PRO＜Web版＞"></div>
                                <p class="pc">港湾物流業界トップクラスの実績。海貨業者・保税倉庫業者や混載貨物の物流事業に携るNVOCC業者・ロジスティクス業者向けに提供する業務パッケージソフトウェアです。</p>
                            </dd>
                        </dl>
                    </a>
                </li>
                <li class="flex__item compoCard compoCard--full">
                    <a href="<?php echo esc_url(home_url('/')); ?>products/solution/" class="resetHover">
                        <div class="compoCard__thumb">
                            <img src="../../wp-content/uploads/2017/12/home_img_07.jpg" alt="各種ソリューション">
                        </div>
                        <dl class="compoCard__content">
                            <dt class="compoCard__title"><span>様々な課題解決をサポート</span> <b class="string">各種ソリューション</b></dt>
                            <dd>
                                <p class="pc">提携するITパートナーとの協力体制により、お客様のご要望に合わせたシステム構築サービスをご提案しています。</p>
                            </dd>
                        </dl>
                    </a>
                </li>
            </ul>
        </section>

        <div class="flex flex--col2 wrapCompoRecentPost">
            <section class="compoRecentPost flex__item">
                <header class="compoRecentPost__header">
                    <span class="icon icon--news pc"></span>
                    <h2 class="string">ニュース</h2>
                    <small>NEWS</small>
                </header>
                <ul class="compoRecentPost__items">
                    <?php
                        $args = array(
                            'paged' => $paged,
                            'posts_per_page' => '4',
                            'post_type' => array('post')
                        );
                        $the_query = new WP_Query($args);
                        if ($the_query->have_posts()) :
                            ?>
                            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <li>
                                <time datetime="<?php the_time("Y-m-d"); ?>"><?php the_time("Y/m/d"); ?></time>
                                <?php if (get_field('link_file', $post->ID)) : ?>
                                    <a href="<?php the_field('link_file', $post->ID); ?>"
                                        target="_blank"><?php the_title(); ?></a>
                                <?php else: ?>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <?php endif; ?>
                            </li>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
                <div>
                    <a href="<?php echo esc_url(home_url('/')); ?>news/" class="button button--default">一覧はこちら<span
                            class="icon icon--arrowBk"></span></a>
                </div>
            </section>
            <section class="compoRecentPost flex__item">
                <header class="compoRecentPost__header">
                    <h2 class="string"><span class="icon icon--event pc"></span>イベント</h2>
                    <small>EVENT</small>
                </header>
                <ul class="compoRecentPost__items">
                    <?php
                        $args = array(
                            'paged' => $paged,
                            'posts_per_page' => '4',
                            'post_type' => array('event'),
                            'post__not_in' => array(39),
                            "orderby" => "meta_value",
                            "meta_key" => "event_date",
                            "order" => "DESC",
                        );
                        $the_query = new WP_Query($args);
                        if ($the_query->have_posts()) :
                            ?>
                            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <li class="eventRow<?php the_id(); ?>">
                                <time>
                                    <?php if (get_field('event_date', $post->ID)) : ?>
                                        <?php the_field('event_date', $post->ID); ?>
                                    <?php else: ?>
                                        未定
                                    <?php endif; ?>
                                </time>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
                <div>
                    <a href="<?php echo esc_url(home_url('/')); ?>event/" class="button button--default">一覧はこちら<span
                            class="icon icon--arrowBk"></span></a>
                </div>
            </section>
        </div>
    </div>


    <div class="compoFooterBanner">
        <div class="fixedWidth">
        <?php echo do_shortcode('[alliance_banner displayStyle="grid-multi" alignment="center"]'); ?>
        </div>
    </div>

<?php
    get_footer();