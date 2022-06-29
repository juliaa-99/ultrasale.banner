<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @var $APPLICATION
 */
?>
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="footer-top__inner"><a class="footer-top__lnk" href="#top">
                    <svg>
                        <use xlink:href="#arrow2"></use>
                    </svg>
                </a>
                <div class="footer-top__item">
                    <div class="footer-top__title"><a class="title" href="/services/">Услуги</a><span
                                class="arrow"><svg><use xlink:href="#arrow"></use></svg></span></div>
                    <?php
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "bottom",
                        array(
                            "ROOT_MENU_TYPE"        => "services",
                            "MENU_CACHE_TYPE"       => "A",
                            "MENU_CACHE_TIME"       => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS"   => "",
                            "MAX_LEVEL"             => "1",
                            "CHILD_MENU_TYPE"       => "services",
                            "USE_EXT"               => "Y",
                            "DELAY"                 => "N",
                            "ALLOW_MULTI_SELECT"    => "N",
                        )
                    );
                    ?>
                </div>
                <div class="footer-top__item">
                    <div class="footer-top__title"><a class="title" href="/catalog/">Каталог товаров</a><span
                                class="arrow"><svg><use xlink:href="#arrow"></use></svg></span></div>
                    <?php
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "bottom",
                        array(
                            "ROOT_MENU_TYPE"        => "catalog",
                            "MENU_CACHE_TYPE"       => "A",
                            "MENU_CACHE_TIME"       => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS"   => "",
                            "MAX_LEVEL"             => "1",
                            "CHILD_MENU_TYPE"       => "catalog",
                            "USE_EXT"               => "Y",
                            "DELAY"                 => "N",
                            "ALLOW_MULTI_SELECT"    => "N",
                        )
                    );
                    ?>
                </div>
                <div class="footer-top__item">
                    <div class="footer-top__title"><span class="title">Покупателю</span><span class="arrow"><svg><use
                                        xlink:href="#arrow"></use></svg></span></div>
                    <?php
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "bottom",
                        array(
                            "ROOT_MENU_TYPE"        => "customer",
                            "MENU_CACHE_TYPE"       => "A",
                            "MENU_CACHE_TIME"       => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS"   => "",
                            "MAX_LEVEL"             => "1",
                            "CHILD_MENU_TYPE"       => "customer",
                            "USE_EXT"               => "Y",
                            "DELAY"                 => "N",
                            "ALLOW_MULTI_SELECT"    => "N",
                        )
                    );
                    ?>

                </div>
                <div class="footer-top__item">
                    <div class="footer-top__title"><a class="title" href="/contacts/">Контакты</a><span
                                class="arrow"><svg><use xlink:href="#arrow"></use></svg></span></div>
                    <ul class="footer-top__list th">
                        <li><?=$GLOBALS['config']['address']?></li>
                        <li><a href="tel:<?=$GLOBALS['config']['phone']?>"><svg><use xlink:href="#tel"></use></svg><?=$GLOBALS['config']['phoneSanitized']?></a></li>
                        <li><a href="mailto:<?=$GLOBALS['config']['email']?>"><svg><use xlink:href="#mail"></use></svg><?=$GLOBALS['config']['email']?></a></li>
                        <li><?=$GLOBALS['config']['work_time']?></li>
                    </ul>
                    <ul class="footer-top__soc">
                        <li><a href="<?=$GLOBALS['config']['soc_instagram']?>" target="_blank">
                                <svg>
                                    <use xlink:href="#inst"></use>
                                </svg>
                            </a></li>
                        <li><a href="<?=$GLOBALS['config']['soc_facebook']?>" target="_blank">
                                <svg>
                                    <use xlink:href="#fb"></use>
                                </svg>
                            </a></li>
                    </ul>
                    <div class="footer-top__item mob">
                        <div class="footer-top__title"><span class="title">Принимаем к оплате</span><span class="arrow"><svg><use
                                            xlink:href="#arrow"></use></svg></span></div>
                        <ul class="footer-top__list tw">
                            <li><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/pay1.png" alt=""></li>
                            <li><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/pay2.png" alt=""></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-top__item all"><a class="footer-top__logo" href="#"><img
                                src="<?= SITE_TEMPLATE_PATH ?>/assets/images/svg/logo-footer.svg" alt=""></a>
                    <ul class="footer-top__list">
                        <li><?=$GLOBALS['config']['address']?></li>
                        <li><a href="#mailto:<?=$GLOBALS['config']['email']?>"><?=$GLOBALS['config']['email']?></a></li>
                        <li class="tel"><a href="tel:<?=$GLOBALS['config']['phone']?>"><?=$GLOBALS['config']['phoneSanitized']?></a></li>
                    </ul>
                    <ul class="footer-top__list in">
                        <li><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/pay1.png" alt=""></li>
                        <li><img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/pay2.png" alt=""></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom__inner">
                <div class="footer-bottom__copyright">Copyright© 2003 - <?=date('Y');?> ООО "ИСТ" - Инженерные
                    системы и технологии - <br> проектирование, поставка, монтаж климатических систем - Россия, Москва и Московская область.
                </div>
                <div class="footer-bottom__links"><a href="/policy/">Политика конфиденциальности</a><a
                            href="https://www.affetta.ru"
                    target="_blank">Создание - Affetta.ru</a></div>
            </div>
        </div>
    </div>
</footer><!-- Modal -->
<div class="modal fade" id="modalAddCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <svg>
                    <use xlink:href="#close"></use>
                </svg>
            </button>
            <div class="modal__text">
                <div class="modal__text-title">Товар добавлен в корзину</div>
                <p>Вы можете продолжить покупки или перейти в корзину</p>
                <div class="button-group"><a class="button button-bord" href="javascript:void()" data-dismiss="modal">Вернуться в
                        каталог</a><a
                            class="button button-primary" href="/personal/cart/"><span>Перейти в
                            корзину</span></a></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalThanks" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <svg>
                    <use xlink:href="#close"></use>
                </svg>
            </button>
            <div class="modal__text">
                <div class="modal__text-title">Спасибо!</div>
                <p>В ближайшее время мы свяжемся с Вами!</p>
            </div>
        </div>
    </div>
</div>

<?php
$APPLICATION->IncludeComponent(
    "custom:form",
    "modal_make_relation_with_us",
    array(
        'IBLOCK_ID'             => '5',
        'MAIL_EVENT'            => 'FORM_SENDED_1',
        'RECAPTCHA_ENABLED'     => 'Y',
        'RECAPTCHA_PUBLIC_KEY'  => '6LdW0fUcAAAAAOi-UR9ErNn8w1B2snuNI5wPnkrN',
        'RECAPTCHA_PRIVATE_KEY' => '6LdW0fUcAAAAADOwm4n6TrVJeqD7Xjc-IZDfV5p-',
        'ACTIVE'                => 'Y',
        'TOKEN'                 => 'modal_make_relation_with_us001',
        'FORM_NAME'             => 'Модальная свяжитесь с нами',
        'PROPS'                 => array(
            'NAME', // type - string
            'PHONE', // type - string
            'EMAIL', // type - string
            'FILE', // type - string
            'MESSAGE,TEXT', // type - html/text
        ),
    )
);
?>

<?php
$APPLICATION->IncludeComponent(
    "custom:form",
    "need_mounting",
    array(
        'IBLOCK_ID'             => '5',
        'MAIL_EVENT'            => 'FORM_SENDED_1',
        'RECAPTCHA_ENABLED'     => 'Y',
        'RECAPTCHA_PUBLIC_KEY'  => '6LdW0fUcAAAAAOi-UR9ErNn8w1B2snuNI5wPnkrN',
        'RECAPTCHA_PRIVATE_KEY' => '6LdW0fUcAAAAADOwm4n6TrVJeqD7Xjc-IZDfV5p-',
        'ACTIVE'                => 'Y',
        'TOKEN'                 => 'need_mounting001',
        'FORM_NAME'             => 'Модальная нужен монтаж',
        'PRODUCT_ID'            => $GLOBALS['CATALOG_CURRENT_ELEMENT_ID'],
        'PROPS'                 => array(
            'NAME', // type - string
            'PHONE', // type - string
            'EMAIL', // type - string
            'PRODUCT_ID'
        ),
    )
);?>

<?php
$APPLICATION->IncludeComponent(
    "custom:form",
    "get_price",
    array(
        'IBLOCK_ID'             => '5',
        'MAIL_EVENT'            => 'FORM_SENDED_1',
        'RECAPTCHA_ENABLED'     => 'Y',
        'RECAPTCHA_PUBLIC_KEY'  => '6LdW0fUcAAAAAOi-UR9ErNn8w1B2snuNI5wPnkrN',
        'RECAPTCHA_PRIVATE_KEY' => '6LdW0fUcAAAAADOwm4n6TrVJeqD7Xjc-IZDfV5p-',
        'ACTIVE'                => 'Y',
        'TOKEN'                 => 'get_price001',
        'FORM_NAME'             => 'Модальная запросить цену',
        'PRODUCT_ID'            => $GLOBALS['CATALOG_CURRENT_ELEMENT_ID'],
        'PROPS'                 => array(
            'NAME', // type - string
            'PHONE', // type - string
            'EMAIL', // type - string
            'PRODUCT_ID'
        ),
    )
);?>

<?php
$APPLICATION->IncludeComponent(
    "custom:form",
    "consult",
    array(
        'IBLOCK_ID'             => '5',
        'MAIL_EVENT'            => 'FORM_SENDED_1',
        'RECAPTCHA_ENABLED'     => 'Y',
        'RECAPTCHA_PUBLIC_KEY'  => '6LdW0fUcAAAAAOi-UR9ErNn8w1B2snuNI5wPnkrN',
        'RECAPTCHA_PRIVATE_KEY' => '6LdW0fUcAAAAADOwm4n6TrVJeqD7Xjc-IZDfV5p-',
        'ACTIVE'                => 'Y',
        'TOKEN'                 => 'consult001',
        'FORM_NAME'             => 'Модальная заказать консультацию',
        'PRODUCT_ID'            => $GLOBALS['CATALOG_CURRENT_ELEMENT_ID'],
        'PROPS'                 => array(
            'NAME', // type - string
            'PHONE', // type - string
            'EMAIL', // type - string
            'PRODUCT_ID'
        ),
    )
);?>

<?php
$APPLICATION->IncludeComponent(
    "custom:form",
    "modal_call",
    array(
        'IBLOCK_ID'             => '5',
        'MAIL_EVENT'            => 'FORM_SENDED_1',
        'RECAPTCHA_ENABLED'     => 'Y',
        'RECAPTCHA_PUBLIC_KEY'  => '6LdW0fUcAAAAAOi-UR9ErNn8w1B2snuNI5wPnkrN',
        'RECAPTCHA_PRIVATE_KEY' => '6LdW0fUcAAAAADOwm4n6TrVJeqD7Xjc-IZDfV5p-',
        'ACTIVE'                => 'Y',
        'TOKEN'                 => 'modal_call001',
        'FORM_NAME'             => 'Модальная обратный звонок',
        'PROPS'                 => array(
            'NAME', // type - string
            'PHONE', // type - string
        ),
    )
);?>

<?php
$APPLICATION->IncludeComponent(
    "custom:form",
    "but_one_click",
    array(
        'IBLOCK_ID'             => '5',
        'MAIL_EVENT'            => 'FORM_SENDED_1',
        'RECAPTCHA_ENABLED'     => 'Y',
        'RECAPTCHA_PUBLIC_KEY'  => '6LdW0fUcAAAAAOi-UR9ErNn8w1B2snuNI5wPnkrN',
        'RECAPTCHA_PRIVATE_KEY' => '6LdW0fUcAAAAADOwm4n6TrVJeqD7Xjc-IZDfV5p-',
        'ACTIVE'                => 'Y',
        'TOKEN'                 => 'but_one_click001',
        'FORM_NAME'             => 'купить в один клик',
        'PROPS'                 => array(
            'NAME', // type - string
            'PHONE', // type - string
            "PRODUCT_ID",            
        ),
    )
);?>

<?php
$APPLICATION->IncludeComponent(
    "custom:form_review",
    "review",
    array(
        'IBLOCK_ID'             => '16',
        'MAIL_EVENT'            => 'FORM_SENDED_1',
        'RECAPTCHA_ENABLED'     => 'Y',
        'RECAPTCHA_PUBLIC_KEY'  => '6LdW0fUcAAAAAOi-UR9ErNn8w1B2snuNI5wPnkrN',
        'RECAPTCHA_PRIVATE_KEY' => '6LdW0fUcAAAAADOwm4n6TrVJeqD7Xjc-IZDfV5p-',
        'ACTIVE'                => 'N',
        'TOKEN'                 => 'review001',
        'FORM_NAME'             => 'оставить отзыв',
        'PROPS'                 => array(
            'NAME', // type - string
            'PREVIEW_TEXT', // type - string
            'RATE', // type - string// type - string
            "WARE",
        ),
    )
);?>

<?php
$APPLICATION->IncludeComponent(
    "custom:form",
    "summary",
    array(
        'IBLOCK_ID'             => '5',
        'MAIL_EVENT'            => 'FORM_SENDED_1',
        'RECAPTCHA_ENABLED'     => 'Y',
        'RECAPTCHA_PUBLIC_KEY'  => '6LdW0fUcAAAAAOi-UR9ErNn8w1B2snuNI5wPnkrN',
        'RECAPTCHA_PRIVATE_KEY' => '6LdW0fUcAAAAADOwm4n6TrVJeqD7Xjc-IZDfV5p-',
        'ACTIVE'                => 'Y',
        'TOKEN'                 => 'summary001',
        'FORM_NAME'             => 'оставить резюме',
        'PROPS'                 => array(
            'NAME', // type - string
            'PHONE', // type - string
            'EMAIL', // type - string
            'POSITION', // type - string
            'FILE', // type - string
        ),
    )
);?>

<?php
$APPLICATION->IncludeComponent(
    "custom:form",
    "modal_app",
    array(
        'IBLOCK_ID'             => '5',
        'MAIL_EVENT'            => 'FORM_SENDED_1',
        'RECAPTCHA_ENABLED'     => 'Y',
        'RECAPTCHA_PUBLIC_KEY'  => '6LdW0fUcAAAAAOi-UR9ErNn8w1B2snuNI5wPnkrN',
        'RECAPTCHA_PRIVATE_KEY' => '6LdW0fUcAAAAADOwm4n6TrVJeqD7Xjc-IZDfV5p-',
        'ACTIVE'                => 'Y',
        'TOKEN'                 => 'modal_app001',
        'FORM_NAME'             => 'Модальная запись оставить заявку',
        'PROPS'                 => array(
            'NAME', // type - string
            'PHONE', // type - string
            'EMAIL', // type - string
            'FILE', // type - string
            'MESSAGE,TEXT', // type - html/text
        ),
    )
);


$asset = \Bitrix\Main\Page\Asset::getInstance();
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/vendors/jquery/dist/jquery.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/vendors/bootstrap/dist/js/bootstrap.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/vendors/jquery-ui/jquery-ui.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/vendors/jquery.airStickyBlock.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/vendors/fileupload.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/vendors/slick/slick.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/vendors/jquery.mCustomScrollbar.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/vendors/jquery.selectric.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/app.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/vendors/jquery.maskedinput/dist/jquery.maskedinput.min.js');
$asset->addJs('https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', true);
?>
</body>
</html>

