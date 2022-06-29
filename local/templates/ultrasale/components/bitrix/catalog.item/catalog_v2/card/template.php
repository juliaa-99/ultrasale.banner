<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

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
//dump($item['PROPERTIES']);

$props = $item['DISPLAY_PROPERTIES'];


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
<div class="product-item-container" id="<?= $areaId ?>" data-entity="item">
    <div class="product-item catalog__item <?=($arParams['EXT_VIEW_TYPE']=='list'?'catalog__item-list':'')?>">
        <div class="catalog__item-inf">
            <?
            if (true) {
                ?>
                <div class="catalog__item-stat" title="Добавить к сравнению">
                    <label id="<?= $itemIds['COMPARE_LINK'] ?>" data-prod-id="<?= $item['ID'] ?>" class="add-to-compare jsToggleCompare">
                        <input type="checkbox" data-entity="compare-checkbox">
                        <svg>
                            <use xlink:href="#stat"></use>
                        </svg>
                    </label>
                </div>
            <? } ?>
            <div class="catalog__item-fav <?= isInFav($item['ID']) ? 'active' : '' ?>" data-id="<?= $item['ID'] ?>" title="Добавить в избранное">
                <svg>
                    <use xlink:href="#fav"></use>
                </svg>
            </div>
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
        <? if ($itemHasDetailUrl) { ?>
        <a class="catalog__item-img" href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $imgTitle ?>"
           data-entity="image-wrapper">
            <? } else { ?>
            <span class="catalog__item-img" data-entity="image-wrapper">
        <? } ?>

        <img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="">
        <? if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y') { ?>
            <div class="product-item-label-ring <?= $discountPositionClass ?>" id="<?= $itemIds['DSC_PERC'] ?>"
                <?= ($price['PERCENT'] > 0 ? '' : 'style="display: none;"') ?>>
                <span><?= -$price['PERCENT'] ?>%</span>
            </div>
        <? } ?>

                <? if ($itemHasDetailUrl) { ?>
        </a>
    <? } else { ?>
        </span>
    <? } ?>
        <div class="catalog__item-top">
            <div class="catalog__item-article">Арт.<?= $props['ARTICUL']['VALUE'] ?></div>

            <div class="catalog__item-stock">
            <?php
            if(empty($item['PROPERTIES']['SNIATO_Z_PROZVODSTVA']['VALUE']))
            {
                if ($actualItem['CAN_BUY']) { ?>
                    В наличии
                <?php } else { ?>
                    Предзаказ
                <?php }
            } else {?>
                Снято с производства
            <? } ?>
            </div>

        </div>
        <div class="catalog__item-tx">
            <? if ($itemHasDetailUrl) { ?>
            <a class="catalog__item-title" href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $productTitle ?>">
                <? } ?>
                <?= $productTitle ?>
                <? if ($itemHasDetailUrl) { ?>
            </a>
        <? } ?>
            <?php if (!empty($props)) { ?>
                <div class="catalog__item-table">
                    <?if(!empty($props['Brand'])):?>
                    <div class="catalog__item-table-row">
                        <div class="catalog__item-table-cell" data-code="BRAND">Производитель</div>
                        <div class="catalog__item-table-cell"><a class="" href="<?=$props['Brand']['SRC']?>"><?=$props['Brand']['NAME']?></a></div>
                    </div>
                    <?endif;?>
                    <?if(!empty($props['Seria'])):?>
                        <div class="catalog__item-table-row">
                        <div class="catalog__item-table-cell" data-code="SERIA">Серия</div>
                        <div class="catalog__item-table-cell"><a class="" href="<?=$props['Seria']['SRC']?>"><?=$props['Seria']['NAME']?></a></div>
                    </div>
                    <?endif;?>

                    <?php
                    $counter = 2;
                    foreach ($props as $key => $prop) {

                        if (empty($prop['VALUE'])
                            || in_array($key,
                                [
                                    'BRAND',
                                    'ARTICUL',
                                    'SALE',
                                    'NEW',
                                    'HIT',
                                    'MORE_PHOTO',
                                    'ADVANTAGES',
                                    'SRV_PAY_AVAILABLE',
                                    'DOP_PARAMETRY',
                                    'OSOBENNOSTI',
                                    'SKLAD',
                                ])
                            || strpos($key, 'SRV_') === 0) {
                            continue;
                        }
                        if ($counter <= 0) {
                            break;
                        }
                        $counter--;
                        ?>
                        <?if($prop["ID"]!=84 && $prop["ID"]!=97 && $prop["ID"]!=106) {?>
                            <div class="catalog__item-table-row">
                                <div class="catalog__item-table-cell"
                                     data-code="<?= $key ?>"><?= $prop['NAME'] ?></div>
                                <div class="catalog__item-table-cell"><?=
                                    (is_array($prop['~VALUE'])) ? (join(' / ', $prop['~VALUE'])) : $prop['~VALUE'] ?></div>
                            </div>
                        <?}
                    } ?>
                </div>
            <?php } ?>
        </div>
        <?
        if (!empty($arParams['PRODUCT_BLOCKS_ORDER'])) {
            foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName) {
                switch ($blockName) {
                    case 'price': ?>
                        <div class="product-item-info-container product-item-price-container catalog__item-price"
                             data-entity="price-block">
                            <?if (!empty($price) && $actualItem['CAN_BUY']):?>
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
                            <?else:?>
                                <div class="xxx-price-zaglushka"></div>
                            <?endif;?>
                            <?
                            if ($arParams['SHOW_OLD_PRICE'] === 'Y') {
                                ?>
                                <div class="catalog__item-price-old" id="<?= $itemIds['PRICE_OLD'] ?>"
                                    <?= ($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '') ?>>
                                    <?= number_format($price['RATIO_BASE_PRICE'], 0, '', ' ') ?>
                                </div>
                                <?
                            }
                            /* Вариант с отображением блока старой цены, без цены. Но из-за верстки выводится не так,
                             как надо.
                             * <div class="catalog__item-price-old" id="<?= $itemIds['PRICE_OLD'] ?>">
                                    <?= ($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? "&nbsp;" : number_format($price['RATIO_BASE_PRICE'], 0, '', ' ')) ?>
                                </div>
                             */
                            ?>
                        </div>
                        <?
                        break;


                    case 'buttons':
                        ?>
                        <div data-entity="buttons-block">
                            <?
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
                                    <div class="catalog__item-bottom center">
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
                                        <a class="btn btn-link catalog__item-btn js-modal-query-price"
                                                prodid="<?=$arResult['ITEM']['ID']?>"
                                                href="javascript:void(0)"
                                                rel="nofollow" data-target="#get_price" data-toggle="modal">
                                            <span>Запросить цену</span>
                                        </a>
                                    </div>
                                    <?
                                }
                            } else {
                                if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y') {
                                    ?>
                                    <div class="product-item-button-container">
                                        <?
                                        if ($showSubscribe) {
                                            $APPLICATION->IncludeComponent(
                                                'bitrix:catalog.product.subscribe',
                                                '',
                                                array(
                                                    'PRODUCT_ID'         => $item['ID'],
                                                    'BUTTON_ID'          => $itemIds['SUBSCRIBE_LINK'],
                                                    'BUTTON_CLASS'       => 'btn btn-primary ' . $buttonSizeClass,
                                                    'DEFAULT_DISPLAY'    => !$actualItem['CAN_BUY'],
                                                    'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
                                                ),
                                                $component,
                                                array('HIDE_ICONS' => 'Y')
                                            );
                                        }
                                        ?>
                                        <button class="btn btn-link <?= $buttonSizeClass ?>"
                                                id="<?= $itemIds['NOT_AVAILABLE_MESS'] ?>" href="javascript:void(0)"
                                                rel="nofollow"
                                            <?= ($actualItem['CAN_BUY'] ? 'style="display: none;"' : '') ?>>
                                            <?= $arParams['MESS_NOT_AVAILABLE'] ?>
                                        </button>
                                        <div id="<?= $itemIds['BASKET_ACTIONS'] ?>" <?= ($actualItem['CAN_BUY'] ? '' : 'style="display: none;"') ?>>
                                            <button class="btn btn-primary <?= $buttonSizeClass ?>"
                                                    id="<?= $itemIds['BUY_LINK'] ?>"
                                                    href="javascript:void(0)" rel="nofollow">
                                                <?= ($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET']) ?>
                                            </button>
                                        </div>
                                    </div>
                                    <?
                                } else {
                                    ?>
                                    <div class="product-item-button-container">
                                        <button class="btn btn-primary <?= $buttonSizeClass ?>"
                                                href="<?= $item['DETAIL_PAGE_URL'] ?>">
                                            <?= $arParams['MESS_BTN_DETAIL'] ?>
                                        </button>
                                    </div>
                                    <?
                                }
                            }
                            ?>
                        </div>
                        <?
                        break;


                    case 'sku':
                        if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $haveOffers && !empty($item['OFFERS_PROP'])
                            && false) {
                            ?>
                            <div class="product-item-info-container product-item-hidden"
                                 id="<?= $itemIds['PROP_DIV'] ?>">
                                <?
                                foreach ($arParams['SKU_PROPS'] as $skuProperty) {
                                    $propertyId = $skuProperty['ID'];
                                    $skuProperty['NAME'] = htmlspecialcharsbx($skuProperty['NAME']);
                                    if (!isset($item['SKU_TREE_VALUES'][$propertyId])) {
                                        continue;
                                    }
                                    ?>
                                    <div data-entity="sku-block">
                                        <div class="product-item-scu-container" data-entity="sku-line-block">
                                            <div class="product-item-scu-block-title text-muted"><?= $skuProperty['NAME'] ?></div>
                                            <div class="product-item-scu-block">
                                                <div class="product-item-scu-list">
                                                    <ul class="product-item-scu-item-list">
                                                        <?
                                                        foreach ($skuProperty['VALUES'] as $value) {
                                                            if (!isset($item['SKU_TREE_VALUES'][$propertyId][$value['ID']])) {
                                                                continue;
                                                            }

                                                            $value['NAME'] = htmlspecialcharsbx($value['NAME']);

                                                            if ($skuProperty['SHOW_MODE'] === 'PICT') {
                                                                ?>
                                                                <li class="product-item-scu-item-color-container"
                                                                    title="<?= $value['NAME'] ?>"
                                                                    data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>"
                                                                    data-onevalue="<?= $value['ID'] ?>">
                                                                    <div class="product-item-scu-item-color-block">
                                                                        <div class="product-item-scu-item-color"
                                                                             title="<?= $value['NAME'] ?>"
                                                                             style="background-image: url('<?= $value['PICT']['SRC'] ?>');"></div>
                                                                    </div>
                                                                </li>
                                                                <?
                                                            } else {
                                                                ?>
                                                                <li class="product-item-scu-item-text-container"
                                                                    title="<?= $value['NAME'] ?>"
                                                                    data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>"
                                                                    data-onevalue="<?= $value['ID'] ?>">
                                                                    <div class="product-item-scu-item-text-block">
                                                                        <div class="product-item-scu-item-text"><?= $value['NAME'] ?></div>
                                                                    </div>
                                                                </li>
                                                                <?
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?
                                }
                                ?>
                            </div>
                            <?
                            foreach ($arParams['SKU_PROPS'] as $skuProperty) {
                                if (!isset($item['OFFERS_PROP'][$skuProperty['CODE']])) {
                                    continue;
                                }

                                $skuProps[] = array(
                                    'ID'           => $skuProperty['ID'],
                                    'SHOW_MODE'    => $skuProperty['SHOW_MODE'],
                                    'VALUES'       => $skuProperty['VALUES'],
                                    'VALUES_COUNT' => $skuProperty['VALUES_COUNT'],
                                );
                            }

                            unset($skuProperty, $value);

                            if ($item['OFFERS_PROPS_DISPLAY']) {
                                foreach ($item['JS_OFFERS'] as $keyOffer => $jsOffer) {
                                    $strProps = '';

                                    if (!empty($jsOffer['DISPLAY_PROPERTIES'])) {
                                        foreach ($jsOffer['DISPLAY_PROPERTIES'] as $displayProperty) {
                                            $strProps .= '<dt>' . $displayProperty['NAME'] . '</dt><dd>'
                                                . (is_array($displayProperty['VALUE'])
                                                    ? implode(' / ', $displayProperty['VALUE'])
                                                    : $displayProperty['VALUE'])
                                                . '</dd>';
                                        }
                                    }

                                    $item['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
                                }
                                unset($jsOffer, $strProps);
                            }
                        }

                        break;
                }
            }
        }

        ?>
    </div>
</div>