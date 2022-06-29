<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
//dump($arResult['ITEM']['DISPLAY_PROPERTIES']);
use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain                $APPLICATION
 * @var array                   $arParams
 * @var array                   $item
 * @var array                   $actualItem
 * @var array                   $minOffer
 * @var array                   $itemIds
 * @var array                   $price
 * @var array                   $measureRatio
 * @var bool                    $haveOffers
 * @var bool                    $showSubscribe
 * @var array                   $morePhoto
 * @var bool                    $showSlider
 * @var bool                    $itemHasDetailUrl
 * @var string                  $imgTitle
 * @var string                  $productTitle
 * @var string                  $buttonSizeClass
 * @var CatalogSectionComponent $component
 * @var array                   $arResult
 * @var string                  $areaId
 */
?>
<?php

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
<div class="product-item catalog__item" id="<?= $areaId ?>" data-entity="item">
    <div class="catalog__item-inf">
        <div class="catalog__item-fav <?=isInFav($item['ID'])?'active':''?>" data-id="<?=$item['ID']?>">
            <svg>
                <use xlink:href="#fav"></use>
            </svg>
        </div>
        <?
        if ($arParams['DISPLAY_COMPARE'] && (!$haveOffers || $arParams['PRODUCT_DISPLAY_MODE'] === 'Y')) {
            ?>
            <div class="catalog__item-stat">
                <label id="<?= $itemIds['COMPARE_LINK'] ?>" data-prod-id="<?=$item['ID']?>" class="mb-0">
                    <input type="checkbox" data-entity="compare-checkbox">
                    <svg>
                        <use xlink:href="#close"></use>
                    </svg>
                </label>
            </div>
        <? } ?>
    </div>
    <?php if (!empty($item['PROPERTIES']['HIT']['VALUE'])
        || !empty
        ($item['PROPERTIES']['NEW']['VALUE'])
        || !empty($item['PROPERTIES']['SALE']['VALUE'])
    ) {
        ?>
        <div class="catalog__item-labels">
            <?php if (!empty($props['HIT']['VALUE'])) { ?>
                <div class="catalog__item-labels-item">Хит</div>
            <?php } ?>
            <?php if (!empty($props['NEW']['VALUE'])) { ?>
                <div class="catalog__item-labels-item new">New</div>
            <?php } ?>
            <?php if (!empty($props['SALE']['VALUE'])) { ?>
                <div class="catalog__item-labels-item sale">Sale</div>
            <?php } ?>
        </div>
    <?php } ?>
    <a class="catalog__item-img" href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $imgTitle ?>"
       data-entity="image-wrapper"><img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt=""></a>

    <div class="catalog__item-top">
        <div class="catalog__item-article">Арт.<?= $props['ARTICUL']['VALUE'] ?></div>
        <?php if ($item['CATALOG_AVAILABLE'] == 'Y') { ?>
            <div class="catalog__item-stock">В наличии</div>
        <?php } ?>
    </div>
    <div class="catalog__item-tx">
        <a class="catalog__item-title" href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $productTitle ?>"><?= $productTitle ?></a>
    </div>
    <?
    if (!empty($arParams['PRODUCT_BLOCKS_ORDER'])) {
        foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName) {
            switch ($blockName) {
                case 'price':
                    if (!empty($price)) {
                    ?>
                    <div class="product-item-info-container product-item-price-container catalog__item-price"
                         data-entity="price-block">
                        <div class="catalog__item-price-now" id="<?= $itemIds['PRICE'] ?>">
                            <?
                                if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers) {
                                    echo Loc::getMessage(
                                        'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
                                        array(
                                            '#PRICE#' => $price['PRINT_RATIO_PRICE'],
                                            '#VALUE#' => $measureRatio,
                                            '#UNIT#'  => $minOffer['ITEM_MEASURE']['TITLE'],
                                        )
                                    );
                                } else {
                                    echo number_format($price['RATIO_PRICE'], 0, '', ' ');
                                }
                            ?>
                        </div>
                        <?
                        if ($arParams['SHOW_OLD_PRICE'] === 'Y') {
                            ?>
                            <div class="catalog__item-price-old" id="<?= $itemIds['PRICE_OLD'] ?>"
                                <?= ($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '') ?>>
                                <?= number_format($price['RATIO_BASE_PRICE'], 0, '', ' ') ?>
                            </div>&nbsp;
                            <?
                        }
                        ?>
                    </div>
                    <?
                    }
                    break;


                case 'buttons':
                    break;
                    if (!$haveOffers) {
                        if ($actualItem['CAN_BUY']) {
                            ?>
                            <div class="catalog__item-bottom" id="<?= $itemIds['BASKET_ACTIONS'] ?>">
                                <a class="btn btn-link catalog__item-btn" href="javascript:void(0)"
                                   rel="nofollow" id="<?= $itemIds['BUY_LINK'] ?>"><span>В  корзину</span></a>
                            </div>
                            <?
                        } else {
                            ?>
                            <div class="product-item-button-container">
                                <?
                                if ($showSubscribe) {
                                    $APPLICATION->IncludeComponent(
                                        'bitrix:catalog.product.subscribe',
                                        '',
                                        array(
                                            'PRODUCT_ID'         => $actualItem['ID'],
                                            'BUTTON_ID'          => $itemIds['SUBSCRIBE_LINK'],
                                            'BUTTON_CLASS'       => 'btn btn-primary ' . $buttonSizeClass,
                                            'DEFAULT_DISPLAY'    => true,
                                            'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
                                        ),
                                        $component,
                                        array('HIDE_ICONS' => 'Y')
                                    );
                                }
                                ?>
                                <button class="btn btn-link <?= $buttonSizeClass ?>"
                                        id="<?= $itemIds['NOT_AVAILABLE_MESS'] ?>" href="javascript:void(0)"
                                        rel="nofollow">
                                    <?= $arParams['MESS_NOT_AVAILABLE'] ?>
                                </button>
                            </div>
                            <?
                        }
                    }
                    ?>
                    <?
                    break;
            }
        }
    }

    ?>
    <?php if (!empty($arParams["Props"])) { ?>
        <div class="catalog__item-tbl">
            <?php
            foreach ($arParams["Props"] as $prop) {
                if (
                    in_array($prop['CODE'],
                        [
                            'ARTICUL',
                            'SALE',
                            'NEW',
                            'HIT',
                            'MORE_PHOTO',
                            'ADVANTAGES',
                            'SRV_PAY_AVAILABLE',
                            'DOP_PARAMETRY',
                            'SKLAD',
                        ])
                    || strpos($prop['CODE'], 'SRV_') === 0) {
                    continue;
                }

                if (empty($props[$prop['CODE']]['VALUE'])) {?>
                    <div class="catalog__item-tbl-item">&#151;</div>
                <? } else {
                    ?>
                    <div class="catalog__item-tbl-item"><?=
                        (is_array($props[$prop['CODE']]['VALUE'])) ? (join(' / ',
                            $props[$prop['CODE']]['~VALUE'])) : $props[$prop['CODE']]['~VALUE'] ?></div>
                <? } ?>
            <?php } ?>
        </div>
    <?php } ?>
</div>