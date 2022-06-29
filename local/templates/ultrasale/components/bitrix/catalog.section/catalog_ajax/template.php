<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);
?>
<?php if (count($arResult['ITEMS'])) { ?>
    <?php foreach ($arResult['ITEMS'] as $item) {
        $props = $item['PROPERTIES'];
        $haveOffers = !empty($item['OFFERS']);
        if ($haveOffers) {
            $actualItem = $item['OFFERS'][$item['OFFERS_SELECTED']] ?? reset($item['OFFERS']);
        } else {
            $actualItem = $item;
        }
        if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers) {
            $price = $item['ITEM_START_PRICE'];
            $minOffer = $item['OFFERS'][$item['ITEM_START_PRICE_SELECTED']];
            $measureRatio = $minOffer['ITEM_MEASURE_RATIOS'][$minOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
            $morePhoto = $item['MORE_PHOTO'];
        } else {
            $price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
            $measureRatio = $price['MIN_QUANTITY'];
            $morePhoto = $actualItem['MORE_PHOTO'];
        }
        ?>
        <div class="header__search-product-item"><a class="header__search-product-img"
                                                    href="<?= $item['DETAIL_PAGE_URL'] ?>"><img
                        src="<?= $item['PREVIEW_PICTURE']['SAFE_SRC'] ?>"
                        alt=""></a><a class="header__search-product-title" href="<?= $item['DETAIL_PAGE_URL']
            ?>"><?= $item['NAME'] ?></a>
            <div class="header__search-product-price">
                <div class="header__search-product-price-now"><?= number_format($price['RATIO_PRICE'], 0, '',
                        ' ') ?></div>
                <div class="header__search-product-price-old" <?= ($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '') ?>><?= number_format($price['RATIO_BASE_PRICE'],
                        0, '', ' ') ?></div>
            </div>
        </div>

    <?php } ?>
    <a class="header__search-product-lnk" href="/search/?q=<?=$_REQUEST['q']?>">
        Смотреть все результаты<svg><use xlink:href="#arrow2"></use></svg></a>
<?php } ?>


