<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
/**
 * @var $APPLICATION
 * @var $USER
 * @const SITE_TEMPLATE_PATH
 *
 */

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php $APPLICATION->ShowHead(); ?>
    <title><?php $APPLICATION->ShowTitle(false); ?></title>
    <?php
    $asset = \Bitrix\Main\Page\Asset::getInstance();
    $asset->addString('<meta http-equiv="Content-Type" content="text/html;charset=utf-8">');
    $asset->addString(' <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">');
    $asset->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">');
    $asset->addString('<meta name="HandheldFriendly" content="true">');
    $asset->addString('<meta http-equiv="cleartype" content="on">');
    $asset->addString('<meta http-equiv="msthemecompatible" content="no">');
    $asset->addString('<meta name="format-detection" content="telephone=no">');
    $asset->addString('<link rel="shortcut icon" type="image/x-icon" href="'.SITE_TEMPLATE_PATH .'/assets/images/svg/favicon.svg">');
    $asset->addString('<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=PT+Sans:ital@0;1&amp;display=swap&quot; rel=&quot;stylesheet">');
    $asset->addString(' <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">');
    $asset->addCss(SITE_TEMPLATE_PATH . '/assets/vendors/bootstrap/dist/css/bootstrap.min.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/assets/vendors/jquery.mCustomScrollbar.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/assets/vendors/slick/slick.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/assets/vendors/selectric.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/assets/css/app.css');
 ?>
</head>
<body id="<?=$APPLICATION->GetDirProperty('body_id')?>" data-session_id="<?=bitrix_sessid()?>" data-is_authorized="<?=($USER->IsAuthorized())?'true':'false'?>">

<div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>

<?php $APPLICATION->IncludeFile(
    SITE_DIR."local/include/svg.php",
    array(),
    array("MODE"=>"php")
);?>

<div id="top"></div>
<div class="header__mob">
    <div class="container">
        <div class="header__mob-top"><a class="header__logo" href="<?=SITE_DIR?>"><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/svg/logo.svg" alt=""></a>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:sale.basket.basket.line",
                "affetta_mob",
                array(
                    // region Основные параметры
                    "PATH_TO_BASKET"      =>  "/personal/cart/",
                    "SHOW_NUM_PRODUCTS"   =>  "Y",
                    "SHOW_TOTAL_PRICE"    =>  "N",
                    // товарам
                    "SHOW_EMPTY_VALUES"   =>  "Y",
                    // endregion
                    // region Персональный раздел
                    "SHOW_PERSONAL_LINK"  =>  "N",
                    "PATH_TO_PERSONAL"    =>  "/personal/",
                    // endregion
                    // region Авторизация
                    "SHOW_AUTHOR"         =>  "N",
                    "PATH_TO_REGISTER"    =>  "/login/",
                    "PATH_TO_PROFILE"     =>  "/personal/",
                    // endregion
                    // region Список товаров
                    "SHOW_PRODUCTS"       =>  "N",
                    // endregion
                    // region Внешний вид
                    "POSITION_FIXED"      =>  "N",
                    // endregion
                )
            );
            ?>
        </div>
        <div class="header__mob-bottom"><a class="header__mob-tel" href="tel:<?=$GLOBALS['config']['phone']?>"><img
                        src="<?=SITE_TEMPLATE_PATH?>/assets/images/svg/phone.svg" alt=""><span><?=$GLOBALS['config']['phoneSanitized']?></span></a><a class="header__mob-mail" href="mailto:<?=$GLOBALS['config']['email']?>"><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/svg/mail.svg" alt=""><span><?=$GLOBALS['config']['email']?></span></a>
            <div class="header__mob-time"><?=$GLOBALS['config']['work_time']?></div>
        </div>
    </div>
</div>
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-top__inner"><a class="header__logo" href="<?=SITE_DIR?>"><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/svg/logo.svg" alt=""></a>
                <?php
                $APPLICATION->IncludeComponent(
                	"bitrix:menu",
                	"top",
                	array(
                		"ROOT_MENU_TYPE"         =>  "top",
                		"MENU_CACHE_TYPE"        =>  "A",
                		"MENU_CACHE_TIME"        =>  "3600",
                		"MENU_CACHE_USE_GROUPS"  =>  "Y",
                		"MENU_CACHE_GET_VARS"    =>  "",
                		"MAX_LEVEL"              =>  "1",
                		"CHILD_MENU_TYPE"        =>  "top",
                		"USE_EXT"                =>  "N",
                		"DELAY"                  =>  "N",
                		"ALLOW_MULTI_SELECT"     =>  "N",
                	)
                );
                ?>
                <div class="header-top__right">
                    <div class="header-top__inf"><a class="header-top__tel" href="mailto:<?=$GLOBALS['config']['email']?>"><?=$GLOBALS['config']['email']?></a>
                        <div class="header-top__inf-time"><?=$GLOBALS['config']['work_time']?></div>
                    </div>
                    <div class="header-top__inf">
                        <a class="header-top__tel" href="tel:<?=$GLOBALS['config']['phone']?>"><?=$GLOBALS['config']['phoneSanitized']?></a>
                        <a class="header-top__inf-link" href="#" data-toggle="modal" data-target="#modalCall2">Обратный звонок</a>
                    </div>
                    <a class="header__stat" href="/compare/"><span class="header__cart-icon"><svg><use
                                        xlink:href="#stat"></use></svg></span></a>
                    <a class="header__fav" href="/fav/"><span class="header__cart-icon"><svg><use
                                        xlink:href="#fav"></use></svg></span><span
                                class="header__cart-numb"><?=countFavs();?></span></a>
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:sale.basket.basket.line",
                        "affetta",
                        array(
                            // region Основные параметры
                            "PATH_TO_BASKET"      =>  "/personal/cart/",
                            "SHOW_NUM_PRODUCTS"   =>  "Y",
                            "SHOW_TOTAL_PRICE"    =>  "N",
                            // товарам
                            "SHOW_EMPTY_VALUES"   =>  "Y",
                            // endregion
                            // region Персональный раздел
                            "SHOW_PERSONAL_LINK"  =>  "N",
                            "PATH_TO_PERSONAL"    =>  "/personal/",
                            // endregion
                            // region Авторизация
                            "SHOW_AUTHOR"         =>  "N",
                            "PATH_TO_REGISTER"    =>  "/login/",
                            "PATH_TO_PROFILE"     =>  "/personal/",
                            // endregion
                            // region Список товаров
                            "SHOW_PRODUCTS"       =>  "N",
                            // endregion
                            // region Внешний вид
                            "POSITION_FIXED"      =>  "N",
                            // endregion
                        )
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div style="display: flex;justify-content: space-between;align-items: center;">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "affetta_top",
                    Array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "2",
                        "MENU_CACHE_GET_VARS" => array(""),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "top",
                        "USE_EXT" => "Y"
                    )
                );?>
                <div class="header__search">
                    <div class="header__search-lnk"><svg><use xlink:href="#search"></use></svg><span>Поиск по сайту</span></div>
                    <div class="header__search-in">
                        <form method="get" action="/search/">
                            <input name='q' type="search" placeholder="Поиск" data-session="<?=bitrix_sessid()?>">
                            <div class="header__search-product">
                            </div>
                            <button class="button header__search-close" type="button"><svg><use xlink:href="#close"></use></svg></button>
                            <button class="button header__search-btn s" type="button"><svg><use xlink:href="#search"></use></svg></button>
                        </form>
                    </div>
                </div>
                <?php
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "top",
                    array(
                        "ROOT_MENU_TYPE"         =>  "top",
                        "MENU_CACHE_TYPE"        =>  "A",
                        "MENU_CACHE_TIME"        =>  "3600",
                        "MENU_CACHE_USE_GROUPS"  =>  "Y",
                        "MENU_CACHE_GET_VARS"    =>  "",
                        "MAX_LEVEL"              =>  "1",
                        "CHILD_MENU_TYPE"        =>  "top",
                        "USE_EXT"                =>  "N",
                        "DELAY"                  =>  "N",
                        "ALLOW_MULTI_SELECT"     =>  "N",
                    )
                );
                ?>
                <div class="header-top__inf"><a class="header-top__tel" href="tel:<?=$GLOBALS['config']['phone']?>"><?=$GLOBALS['config']['phoneSanitized']?></a><a class="header-top__inf-link" href="#" data-toggle="modal" data-target="#modalApp">Отправить заявку</a></div>
            </div>
        </div>
    </div>

    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "",
        array("START_FROM" => "0")
    );
    ?>
</header>
