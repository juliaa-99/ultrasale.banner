<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @global array  $arParams
 * @global CUser  $USER
 * @global CMain  $APPLICATION
 * @global string $cartId
 * @global array  $arResult
 */
?>

<?php
if (!$arResult["DISABLE_USE_BASKET"]) {
    ?>
    <div class="header__mob-top-right">
    <a class="header__cart" href="<?= $arParams['PATH_TO_BASKET'] ?>"><span class="header__cart-icon"><svg><use
                        xlink:href="#cart"></use></svg></span>
        <?php
            if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y')) { ?>
                <span class="header__cart-numb"><?= $arResult['NUM_PRODUCTS'] ?></span>
            <?php }
        ?>
    </a>
        <div class="header__mob-toggler"><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/svg/toggler.svg" alt=""></div>
    </div>
    <?php
}