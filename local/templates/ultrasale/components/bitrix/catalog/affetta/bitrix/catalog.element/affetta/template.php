<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain                 $APPLICATION
 * @var array                    $arParams
 * @var array                    $arResult
 * @var CatalogSectionComponent  $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 * @var string                   $templateFolder
 */

$this->setFrameMode(true);

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
    'TEMPLATE_THEME'   => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES'       => $currencyList,
    'ITEM'             => array(
        'ID'              => $arResult['ID'],
        'IBLOCK_ID'       => $arResult['IBLOCK_ID'],
        'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
        'JS_OFFERS'       => $arResult['JS_OFFERS'],
    ),
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
    'ID'                    => $mainId,
    'DISCOUNT_PERCENT_ID'   => $mainId . '_dsc_pict',
    'STICKER_ID'            => $mainId . '_sticker',
    'BIG_SLIDER_ID'         => $mainId . '_big_slider',
    'BIG_IMG_CONT_ID'       => $mainId . '_bigimg_cont',
    'SLIDER_CONT_ID'        => $mainId . '_slider_cont',
    'OLD_PRICE_ID'          => $mainId . '_old_price',
    'PRICE_ID'              => $mainId . '_price',
    'DESCRIPTION_ID'        => $mainId . '_description',
    'DISCOUNT_PRICE_ID'     => $mainId . '_price_discount',
    'PRICE_TOTAL'           => $mainId . '_price_total',
    'SLIDER_CONT_OF_ID'     => $mainId . '_slider_cont_',
    'QUANTITY_ID'           => $mainId . '_quantity',
    'QUANTITY_DOWN_ID'      => $mainId . '_quant_down',
    'QUANTITY_UP_ID'        => $mainId . '_quant_up',
    'QUANTITY_MEASURE'      => $mainId . '_quant_measure',
    'QUANTITY_LIMIT'        => $mainId . '_quant_limit',
    'BUY_LINK'              => $mainId . '_buy_link',
    'ADD_BASKET_LINK'       => $mainId . '_add_basket_link',
    'BASKET_ACTIONS_ID'     => $mainId . '_basket_actions',
    'NOT_AVAILABLE_MESS'    => $mainId . '_not_avail',
    'COMPARE_LINK'          => $mainId . '_compare_link',
    'TREE_ID'               => $mainId . '_skudiv',
    'DISPLAY_PROP_DIV'      => $mainId . '_sku_prop',
    'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
    'OFFER_GROUP'           => $mainId . '_set_group_',
    'BASKET_PROP_DIV'       => $mainId . '_basket_prop',
    'SUBSCRIBE_LINK'        => $mainId . '_subscribe',
    'TABS_ID'               => $mainId . '_tabs',
    'TAB_CONTAINERS_ID'     => $mainId . '_tab_containers',
    'SMALL_CARD_PANEL_ID'   => $mainId . '_small_card_panel',
    'TABS_PANEL_ID'         => $mainId . '_tabs_panel',
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
    : $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
    : $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
    : $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers) {
    $actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']])
        ? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]
        : reset($arResult['OFFERS']);
    $showSliderControls = false;

    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['MORE_PHOTO_COUNT'] > 1) {
            $showSliderControls = true;
            break;
        }
    }
} else {
    $actualItem = $arResult;
    $showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y') {
    $skuDescription = false;
    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '') {
            $skuDescription = true;
            break;
        }
    }
    $showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
} else {
    $showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}

$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
    'left'   => 'product-item-label-left',
    'center' => 'product-item-label-center',
    'right'  => 'product-item-label-right',
    'bottom' => 'product-item-label-bottom',
    'middle' => 'product-item-label-middle',
    'top'    => 'product-item-label-top',
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$props = $arResult['DISPLAY_PROPERTIES'];
$props['Brand'] = $arResult['PROPERTIES']['Brand'];
$props['Seria'] = $arResult['PROPERTIES']['Seria'];
$props['SrvInstr'] = $arResult['PROPERTIES']['SrvInstr'];
?>


<?
if ($arParams['DISPLAY_NAME'] === 'Y') {
    ?><h1><?= $name ?></h1><?
}
?>
    <div class="cart-product__in">
        <div class="cart-product__in-right">
            <div class="cart-product__holder" id="<?= $itemIds['ID'] ?>">
                <div class="cart-product__info">
                    <div class="cart-product__slider">
                        <?php
                        if (!empty($arResult['DISPLAY_PROPERTIES']['HIT']['VALUE']) || !empty($arResult['DISPLAY_PROPERTIES']['NEW']['VALUE']) || !empty($arResult['DISPLAY_PROPERTIES']['SALE']['VALUE'])) { ?>
                            <div class="cart-product__labels">
                                <?php if (!empty($arResult['DISPLAY_PROPERTIES']['HIT']['VALUE'])) { ?>
                                    <div class="cart-product__labels-item">ХИТ</div>
                                <? } ?>
                                <?php if (!empty($arResult['DISPLAY_PROPERTIES']['NEW']['VALUE'])) { ?>
                                    <div class="cart-product__labels-item new">New</div>
                                <? } ?>
                                <?php if (!empty($arResult['DISPLAY_PROPERTIES']['SALE']['VALUE'])) { ?>
                                    <div class="cart-product__labels-item sale">Sale</div>
                                <? } ?>
                            </div>
                        <? } ?>
                        <div class="catalog__item-inf">
                            <?
                            if ($arParams['DISPLAY_COMPARE'] && (!$haveOffers || $arParams['PRODUCT_DISPLAY_MODE'] === 'Y')) {
                                ?>
                                <div class="catalog__item-stat">
                                    <label class="jsToggleCompare" id="<?= $itemIds['COMPARE_LINK'] ?>" data-prod-id="<?= $arResult['ID'] ?>">
                                        <input type="checkbox" data-entity="compare-checkbox">
                                        <svg>
                                            <use xlink:href="#stat"></use>
                                        </svg>
                                    </label>
                                </div>
                            <? } ?>
                            <div class="catalog__item-fav <?= isInFav($arResult['ID']) ? 'active' : '' ?>"
                                 data-id="<?= $arResult['ID'] ?>">
                                <svg>
                                    <use xlink:href="#fav"></use>
                                </svg>
                            </div>
                        </div>
                        <?php if (!empty($arResult['MorePhotoPrev'])) { ?>
                            <div class="cart-product__slider-nav slider-nav slick-slider">
                                <?
                                foreach ($arResult['MorePhotoPrev'] as $photo) {
                                    ?>
                                    <div class="cart-product__slider-nav-item">
                                        <div class="cart-product__slider-nav-item-inner"><img src="<?= $photo['src'] ?>"
                                                                                              alt="<?= $photo['alt'] ?>">
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        <? } ?>
                        <?php if (!empty($arResult['MorePhotoMain'])) { ?>
                            <div class="cart-product__slider-for slider-for slick-slider">
                                <?
                                foreach ($arResult['MorePhotoMain'] as $idx => $photo) {
                                    ?>
                                    <div class="cart-product__slider-for-item"><a class="img"
                                                                                  href="<?= $arResult['MorePhotoFull'][$idx]['src'] ?>"
                                                                                  data-fancybox="gallery"><img
                                                    src="<?= $photo['src'] ?>"
                                                    alt="<?= $photo['alt'] ?>"
                                                    title="<?= $photo['title'] ?>"
                                            ></a></div>
                                <? } ?>
                            </div>
                        <? } ?>
                    </div>
                    <div class="cart-product__description-title-mob"> <?= $name ?></div>
                    <div class="cart-product__description">
                        <div class="cart-product__description-info">
                            <div class="cart-product__description-info-item">Артикул:
                                <?= $props['ARTICUL']['VALUE'] ?></div>

                            <div class="cart-product__description-info-item stock">
                                <?php
                                if(empty($arResult['PROPERTIES']['SNIATO_Z_PROZVODSTVA']['VALUE']))
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
                        <?php if (!empty($props)) { ?>
                            <div class="cart-product__description-tx">
                                <div class="cart-product__description-tx-table">
                                    <?if(!empty($props['Brand'])):?>
                                    <div class="cart-product__description-tx-table-row">
                                        <div class="cart-product__description-tx-table-cell">Производитель</div>
                                        <a class="cart-product__description-tx-table-cell"
                                           href="<?=$props['Brand']['SRC']?>"><?=$props['Brand']['NAME']?></a>
                                    </div>
                                    <?endif;?>
                                    <?if(!empty($props['Seria'])):?>
                                    <div class="cart-product__description-tx-table-row">
                                        <div class="cart-product__description-tx-table-cell">Серия</div>
                                        <a class="cart-product__description-tx-table-cell"
                                           href="<?=$props['Seria']['SRC']?>"><?=$props['Seria']['NAME']?></a>
                                    </div>
                                    <?
                                    endif;

                                    $counter = 5;
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
                                                ])
                                            || strpos($key, 'SRV_') === 0) {
                                            continue;
                                        }
                                        if ($counter <= 0) {
                                            break;
                                        }
                                        $counter--;
                                        ?>
<!--                                        --><?//if($prop['~VALUE']!=""):?>
<!--                                            <div class="cart-product__description-tx-table-row">-->
<!--                                                <div class="cart-product__description-tx-table-cell">--><?//= $prop['NAME'] ?><!--</div>-->
<!--                                                <div class="cart-product__description-tx-table-cell">--><?//=strip_tags($prop['~VALUE'])?><!--</div>-->
<!--                                            </div>-->
<!--                                        --><?//endif;?>

                                        <? if(is_array($prop['~VALUE']) && isset($prop['~VALUE']['TEXT'])){ ?>
                                            <div class="xxx-field-artem">
                                                <div class="cart-product__description-tx-table-cell"><?= $prop['NAME'] ?></div>
                                                <br>
                                                <div class="cart-product__description-tx-table-cell"><?=$prop['~VALUE']['TEXT']?></div>
                                            </div>

                                            <?
                                        } elseif(is_array($prop['~VALUE'])){
                                            ?>
                                            <div class="cart-product__description-tx-table-row">
                                                <div class="cart-product__description-tx-table-cell"><?= $prop['NAME'] ?></div>
                                                <div class="cart-product__description-tx-table-cell"><?=join(' / ', $prop['~VALUE'])?></div>
                                            </div>
                                            <?
                                        } else {
                                            ?>
                                            <div class="cart-product__description-tx-table-row">
                                                <div class="cart-product__description-tx-table-cell"><?= $prop['NAME'] ?></div>
                                                <div class="cart-product__description-tx-table-cell"><?=strip_tags($prop['~VALUE'])?></div>
                                            </div>
                                        <? } ?>
                                    <? } ?>

                                </div>
                                <a class="cart-product__description-tx-table-link js-scrol-to-pay-tab">Подробнее</a>
                            </div>
                        <? } ?>
                        <div class="cart-product__description-top">

                            <?if($arResult['CATALOG_AVAILABLE'] == 'Y') {?>
                                <div class="cart-product__description-price">
                                    <div class="cart-product__description-price-now"
                                         id="<?= $itemIds['PRICE_ID'] ?>">
                                        <?= number_format($price['RATIO_PRICE'], 0, '', ' ') ?>
                                    </div>
                                    <div class="cart-product__description-price-old"
                                         id="<?= $itemIds['OLD_PRICE_ID'] ?>">
                                        <?= number_format($price['RATIO_BASE_PRICE'], 0, '', ' ') ?>
                                    </div>
                                </div>
                            <? }?>

                            <?if ( !preg_match("/efirnye-masla/", $APPLICATION->GetCurPage(false)) ) {?>
                                <a class="button button-primary mr-3 mb-3 mb-sm-0" href="#" data-target="<?=$arResult['MiscButton']['modal']?>" data-toggle="modal">
                                    <span><?=$arResult['MiscButton']['text']?></span>
                                </a>
                            <? } ?>

                            <?if ( $arResult['CATALOG_AVAILABLE'] != 'Y') {?>
                                <a class="button button-primary mb-3 mb-sm-0" href="#" data-target="#get_price" data-toggle="modal">
                                    <span>Запросить цену</span>
                                </a>
                            <? } ?>

                        </div>
                        <div class="cart-product__description-bt"
                             <?= ($arResult['CATALOG_AVAILABLE'] == 'Y'  ? '' : 'style="display:none') ?>;"
                        data-entity="panel-buy-button" id="<?= $itemIds['BASKET_ACTIONS_ID'] ?>">
                        <a class="button button-primary mr-3" href="javascript:void(0)" rel="nofollow"
                           id="<?= $itemIds['ADD_BASKET_LINK'] ?>"><span>Добавить в корзину</span></a>
                        <a class="button button-bord" href="#" data-toggle="modal" data-target="#modalClick"
                           data-id="<?= $arResult['ID'] ?>">Купить в 1 клик</a>
                    </div>
                </div>
            </div>
            <div class="cart-product__content">
                <div class="cart-product__content-tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#pay" id="pay-tab" data-toggle="tab" role="tab" aria-controls="pay" aria-selected="true">Характеристики</a>
                        </li>
                        <?if (!empty($props['ADVANTAGES']['~VALUE']['TEXT'])):?>
                            <li class="nav-item">
                                <a class="nav-link" href="#about" id="about-tab" data-toggle="tab" role="tab" aria-controls="about" aria-selected="true">Преимущества</a>
                            </li>
                        <?endif;?>
                        <?if (!empty($arResult['PROPERTIES']['OSOBENNOSTI']['~VALUE']['TEXT']) || !empty($arResult['~DETAIL_TEXT'])):?>
                            <li class="nav-item">
                                <a class="nav-link" href="#delivery" id="delivery-tab" data-toggle="tab" role="tab" aria-controls="delivery" aria-selected="true">Описание</a>
                            </li>
                        <?endif?>
                        <? if (count($props['SrvInstr'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#rev" id="rev-tab" data-toggle="tab" role="tab" aria-controls="rev" aria-selected="true">Инструкции</a>
                            </li>
                        <?endif?>
                        <li class="nav-item">
                            <a class="nav-link" href="#rev2" id="rev-tab" data-toggle="tab" role="tab" aria-controls="rev2" aria-selected="true">Отзывы</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="pay" role="tabpanel" aria-labelledby="pay-tab">
                            <div class="cart-product__content-inner">
                                <div class="cart-product__description-tx-table">
                                    <?if(!empty($props['Brand'])):?>
                                    <div class="cart-product__description-tx-table-row">
                                        <div class="cart-product__description-tx-table-cell">Производитель</div>
                                        <a class="cart-product__description-tx-table-cell" href="<?=$props['Brand']['SRC']?>"><?=$props['Brand']['NAME']?></a>
                                    </div>
                                    <?endif;?>
                                    <?if(!empty($props['Seria'])):?>
                                    <div class="cart-product__description-tx-table-row">
                                        <div class="cart-product__description-tx-table-cell">Серия</div>
                                        <a class="cart-product__description-tx-table-cell" href="<?=$props['Seria']['SRC']?>"><?=$props['Seria']['NAME']?></a>
                                    </div>
                                    <?
                                    endif;

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
                                                ])
                                            || strpos($key, 'SRV_') === 0) {
                                            continue;
                                        }

                                        if(is_array($prop['~VALUE']) && isset($prop['~VALUE']['TEXT'])){
                                            ?>
                                            <div class="xxx-field-artem">
                                                <div class="cart-product__description-tx-table-cell"><?= $prop['NAME'] ?></div>
                                                <br>
                                                <div class="cart-product__description-tx-table-cell"><?=$prop['~VALUE']['TEXT']?></div>
                                            </div>

                                            <?
                                        } elseif(is_array($prop['~VALUE'])){
                                            ?>
                                            <div class="cart-product__description-tx-table-row">
                                                <div class="cart-product__description-tx-table-cell"><?= $prop['NAME'] ?></div>
                                                <div class="cart-product__description-tx-table-cell"><?=join(' / ', $prop['~VALUE'])?></div>
                                            </div>
                                            <?
                                        } else {
                                            ?>
                                            <div class="cart-product__description-tx-table-row">
                                                <div class="cart-product__description-tx-table-cell"><?= $prop['NAME'] ?></div>
                                                <div class="cart-product__description-tx-table-cell"><?=strip_tags($prop['~VALUE'])?></div>
                                            </div>
                                        <? } ?>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="about" role="tabpanel"
                             aria-labelledby="about-tab">
                            <div class="cart-product__content-inner">
                                <?
                                if (!empty($props['ADVANTAGES']['~VALUE']['TEXT'])) {
                                    echo $props['ADVANTAGES']['~VALUE']['TEXT'];
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
                            <div class="cart-product__content-inner">
                                <?= $arResult['~DETAIL_TEXT'] ?>
                                <?
                                if (!empty($arResult['PROPERTIES']['OSOBENNOSTI']['~VALUE']['TEXT'])) {
                                    echo $arResult['PROPERTIES']['OSOBENNOSTI']['~VALUE']['TEXT'];
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="rev" role="tabpanel" aria-labelledby="rev-tab">
                            <div class="cart-product__content-inner">
                                <?php
                                if (count($props['SrvInstr'])) { ?>
                                    <div class="cart-product__content-instruction">
                                        <?
                                        foreach ($props['SrvInstr'] as $instr) { ?>
                                            <a class="cart-product__content-instruction-item"
                                               href="<?= $instr['SRC'] ?>">
                                <span class="cart-product__content-instruction-inner"><span
                                            class="cart-product__content-instruction-icon"><img
                                                src="<?= SITE_TEMPLATE_PATH ?>/assets/images/svg/down2.svg"
                                                alt=""></span><span
                                            class="cart-product__content-instruction-title"><?= $instr['CAPTION'] ?></span><span
                                            class="cart-product__content-instruction-size"><?= $instr['HumanReadableSize'] ?></span></span></a>
                                        <? } ?>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="rev2" role="tabpanel" aria-labelledby="rev2-tab">
                            <div class="cart-product__content-inner th">
                                <?php
                                $GLOBALS['arrFilterReply'] = ['PROPERTY_WARE' => $arResult['ID'], 'ACTIVE' => 'Y'];
                                $APPLICATION->IncludeComponent(
                                    "bitrix:news.list",
                                    "ware_reply",
                                    array(
                                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "ADD_SECTIONS_CHAIN" => "N",
                                        "AJAX_MODE" => "N",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "Y",
                                        "CACHE_FILTER" => "N",
                                        "CACHE_GROUPS" => "Y",
                                        "CACHE_TIME" => "36000000",
                                        "CACHE_TYPE" => "A",
                                        "CHECK_DATES" => "Y",
                                        "DETAIL_URL" => "",
                                        "DISPLAY_BOTTOM_PAGER" => "N",
                                        "DISPLAY_DATE" => "Y",
                                        "DISPLAY_NAME" => "Y",
                                        "DISPLAY_PICTURE" => "Y",
                                        "DISPLAY_PREVIEW_TEXT" => "Y",
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "FILTER_NAME" => "arrFilterReply",
                                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                        "IBLOCK_ID" => "16",
                                        "IBLOCK_TYPE" => "-",
                                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                        "INCLUDE_SUBSECTIONS" => "N",
                                        "MESSAGE_404" => "",
                                        "NEWS_COUNT" => "20",
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "N",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_TEMPLATE" => ".default",
                                        "PAGER_TITLE" => "Новости",
                                        "PARENT_SECTION" => "",
                                        "PARENT_SECTION_CODE" => "",
                                        "PREVIEW_TRUNCATE_LEN" => "",
                                        "PROPERTY_CODE" => array(
                                            0 => "RATE",
                                            1 => "PHOTO",
                                        ),
                                        "SET_BROWSER_TITLE" => "N",
                                        "SET_LAST_MODIFIED" => "N",
                                        "SET_META_DESCRIPTION" => "N",
                                        "SET_META_KEYWORDS" => "N",
                                        "SET_STATUS_404" => "N",
                                        "SET_TITLE" => "N",
                                        "SHOW_404" => "N",
                                        "SORT_BY1" => "TIMESTAMP_X",
                                        "SORT_BY2" => "SORT",
                                        "SORT_ORDER1" => "DESC",
                                        "SORT_ORDER2" => "ASC",
                                        "STRICT_SECTION_CHECK" => "N",
                                        "COMPONENT_TEMPLATE" => "ware_reply"
                                    ),
                                    false
                                );
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="catalog-min">
            <h2>Похожие товары</h2>
            <?
            $APPLICATION->IncludeComponent(
                'bitrix:catalog.section',
                'affetta',
                array(
                    "EXT_VIEW_TYPE" => 'tile4',
                    "HIDE_NOT_AVAILABLE" => 'Y',
                    'IBLOCK_TYPE'               => $arParams['IBLOCK_TYPE'],
                    'IBLOCK_ID'                 => $arParams['IBLOCK_ID'],
                    'SECTION_ID'                => $arResult['IBLOCK_SECTION_ID'],
                    'SECTION_CODE'              => $arResult['VARIABLES']['SECTION_CODE'],
                    'ELEMENT_SORT_FIELD'        => 'shows',
                    'ELEMENT_SORT_ORDER'        => 'desc',
                    'ELEMENT_SORT_FIELD2'       => 'sort',
                    'ELEMENT_SORT_ORDER2'       => 'asc',
                    'PROPERTY_CODE'             => (isset($arParams['LIST_PROPERTY_CODE']) ? $arParams['LIST_PROPERTY_CODE'] : []),
                    'PROPERTY_CODE_MOBILE'      => $arParams['LIST_PROPERTY_CODE_MOBILE'],
                    'INCLUDE_SUBSECTIONS'       => $arParams['INCLUDE_SUBSECTIONS'],
                    'BASKET_URL'                => $arParams['BASKET_URL'],
                    'ACTION_VARIABLE'           => $arParams['ACTION_VARIABLE'],
                    'PRODUCT_ID_VARIABLE'       => $arParams['PRODUCT_ID_VARIABLE'],
                    'SECTION_ID_VARIABLE'       => $arParams['SECTION_ID_VARIABLE'],
                    'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                    'PRODUCT_PROPS_VARIABLE'    => $arParams['PRODUCT_PROPS_VARIABLE'],
                    'CACHE_TYPE'                => $arParams['CACHE_TYPE'],
                    'CACHE_TIME'                => $arParams['CACHE_TIME'],
                    'CACHE_FILTER'              => $arParams['CACHE_FILTER'],
                    'CACHE_GROUPS'              => $arParams['CACHE_GROUPS'],
                    'DISPLAY_COMPARE'           => $arParams['USE_COMPARE'],
                    'PRICE_CODE'                => $arParams['~PRICE_CODE'],
                    'USE_PRICE_COUNT'           => $arParams['USE_PRICE_COUNT'],
                    'SHOW_PRICE_COUNT'          => $arParams['SHOW_PRICE_COUNT'],
                    'PAGE_ELEMENT_COUNT'        => 4,
                    'FILTER_IDS'                => array($elementId),

                    "SET_TITLE"            => "N",
                    "SET_BROWSER_TITLE"    => "N",
                    "SET_META_KEYWORDS"    => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_LAST_MODIFIED"    => "N",
                    "ADD_SECTIONS_CHAIN"   => "N",

                    'PRICE_VAT_INCLUDE'          => $arParams['PRICE_VAT_INCLUDE'],
                    'USE_PRODUCT_QUANTITY'       => $arParams['USE_PRODUCT_QUANTITY'],
                    'ADD_PROPERTIES_TO_BASKET'   => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
                    'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
                    'PRODUCT_PROPERTIES'         => (isset($arParams['PRODUCT_PROPERTIES']) ? $arParams['PRODUCT_PROPERTIES'] : []),

                    'OFFERS_CART_PROPERTIES' => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
                    'OFFERS_FIELD_CODE'      => $arParams['LIST_OFFERS_FIELD_CODE'],
                    'OFFERS_PROPERTY_CODE'   => (isset($arParams['LIST_OFFERS_PROPERTY_CODE']) ? $arParams['LIST_OFFERS_PROPERTY_CODE'] : []),
                    'OFFERS_SORT_FIELD'      => $arParams['OFFERS_SORT_FIELD'],
                    'OFFERS_SORT_ORDER'      => $arParams['OFFERS_SORT_ORDER'],
                    'OFFERS_SORT_FIELD2'     => $arParams['OFFERS_SORT_FIELD2'],
                    'OFFERS_SORT_ORDER2'     => $arParams['OFFERS_SORT_ORDER2'],
                    'OFFERS_LIMIT'           => (isset($arParams['LIST_OFFERS_LIMIT']) ? $arParams['LIST_OFFERS_LIMIT'] : 0),

                    'SECTION_URL'               => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['section'],
                    'DETAIL_URL'                => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['element'],
                    'USE_MAIN_ELEMENT_SECTION'  => $arParams['USE_MAIN_ELEMENT_SECTION'],
                    'CONVERT_CURRENCY'          => $arParams['CONVERT_CURRENCY'],
                    'CURRENCY_ID'               => $arParams['CURRENCY_ID'],
                    'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

                    'LABEL_PROP'           => $arParams['LABEL_PROP'],
                    'LABEL_PROP_MOBILE'    => $arParams['LABEL_PROP_MOBILE'],
                    'LABEL_PROP_POSITION'  => $arParams['LABEL_PROP_POSITION'],
                    'ADD_PICT_PROP'        => $arParams['ADD_PICT_PROP'],
                    'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                    'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                    'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':false}]",
                    'ENLARGE_PRODUCT'      => $arParams['LIST_ENLARGE_PRODUCT'],
                    'ENLARGE_PROP'         => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                    'SHOW_SLIDER'          => $arParams['LIST_SHOW_SLIDER'],
                    'SLIDER_INTERVAL'      => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                    'SLIDER_PROGRESS'      => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                    'DISPLAY_TOP_PAGER'        => 'N',
                    'DISPLAY_BOTTOM_PAGER'     => 'N',
                    'HIDE_SECTION_DESCRIPTION' => 'Y',

                    'RCM_TYPE'          => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
                    'RCM_PROD_ID'       => $elementId,
                    'SHOW_FROM_SECTION' => 'Y',

                    'OFFER_ADD_PICT_PROP'         => $arParams['OFFER_ADD_PICT_PROP'],
                    'OFFER_TREE_PROPS'            => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
                    'PRODUCT_SUBSCRIPTION'        => $arParams['PRODUCT_SUBSCRIPTION'],
                    'SHOW_DISCOUNT_PERCENT'       => $arParams['SHOW_DISCOUNT_PERCENT'],
                    'DISCOUNT_PERCENT_POSITION'   => $arParams['DISCOUNT_PERCENT_POSITION'],
                    'SHOW_OLD_PRICE'              => $arParams['SHOW_OLD_PRICE'],
                    'SHOW_MAX_QUANTITY'           => $arParams['SHOW_MAX_QUANTITY'],
                    'MESS_SHOW_MAX_QUANTITY'      => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                    'RELATIVE_QUANTITY_FACTOR'    => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                    'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                    'MESS_RELATIVE_QUANTITY_FEW'  => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                    'MESS_BTN_BUY'                => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                    'MESS_BTN_ADD_TO_BASKET'      => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                    'MESS_BTN_SUBSCRIBE'          => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                    'MESS_BTN_DETAIL'             => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                    'MESS_NOT_AVAILABLE'          => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
                    'MESS_BTN_COMPARE'            => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                    'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                    'DATA_LAYER_NAME'        => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                    'BRAND_PROPERTY'         => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                    'TEMPLATE_THEME'               => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                    'ADD_TO_BASKET_ACTION'         => $basketAction,
                    'SHOW_CLOSE_POPUP'             => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                    'COMPARE_PATH'                 => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
                    'COMPARE_NAME'                 => $arParams['COMPARE_NAME'],
                    'USE_COMPARE_LIST'             => 'Y',
                    'BACKGROUND_IMAGE'             => '',
                    'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
                ),
                $component
            );
            ?>
            <? /*
                <h2>Похожие товары</h2>
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                        <div class="catalog__item">
                            <div class="catalog__item-inf">
                                <div class="catalog__item-fav"><svg><use xlink:href="#fav"></use></svg></div>
                                <div class="catalog__item-stat"><svg><use xlink:href="#stat"></use></svg></div>
                            </div>
                            <div class="catalog__item-labels">
                                <div class="catalog__item-labels-item">Хит</div>
                            </div><a class="catalog__item-img" href="#"><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/catalog-img1.jpg" alt=""></a>
                            <div class="catalog__item-top">
                                <div class="catalog__item-article">Арт.42502223</div>
                                <div class="catalog__item-stock">В наличии</div>
                            </div>
                            <div class="catalog__item-tx"><a class="catalog__item-title" href="#">Проточный электроводонагреватель Electrolux SMARTFIX 2.0 TS (5,5 kW) - кран+душ</a>
                                <div class="catalog__item-table">
                                    <div class="catalog__item-table-row">
                                        <div class="catalog__item-table-cell">Площадь</div>
                                        <div class="catalog__item-table-cell">35</div>
                                    </div>
                                    <div class="catalog__item-table-row">
                                        <div class="catalog__item-table-cell">Инвертор</div>
                                        <div class="catalog__item-table-cell">Electrolux</div>
                                    </div>
                                    <div class="catalog__item-table-row">
                                        <div class="catalog__item-table-cell">Мощность охлаждения</div>
                                        <div class="catalog__item-table-cell">21</div>
                                    </div>
                                    <div class="catalog__item-table-row">
                                        <div class="catalog__item-table-cell">Мощность охлаждения</div>
                                        <div class="catalog__item-table-cell">21</div>
                                    </div>
                                </div>
                            </div>
                            <div class="catalog__item-price">
                                <div class="catalog__item-price-now">18 200</div>
                                <div class="catalog__item-price-old">19 200</div>
                            </div>
                            <div class="catalog__item-bottom"><a class="catalog__item-btn" href="#"><span>В  корзину</span></a></div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                        <div class="catalog__item">
                            <div class="catalog__item-inf">
                                <div class="catalog__item-fav active"><svg><use xlink:href="#fav"></use></svg></div>
                                <div class="catalog__item-stat"><svg><use xlink:href="#stat"></use></svg></div>
                            </div>
                            <div class="catalog__item-labels">
                                <div class="catalog__item-labels-item new">New</div>
                                <div class="catalog__item-labels-item sale">Sale</div>
                            </div><a class="catalog__item-img" href="#"><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/catalog-img2.jpg" alt=""></a>
                            <div class="catalog__item-top">
                                <div class="catalog__item-article">Арт.42502223</div>
                                <div class="catalog__item-stock">В наличии</div>
                            </div>
                            <div class="catalog__item-tx"><a class="catalog__item-title" href="#">Проточный электроводонагреватель Electrolux SMARTFIX 2.0 TS (5,5 kW) - кран+душ</a>
                                <div class="catalog__item-table">
                                    <div class="catalog__item-table-row">
                                        <div class="catalog__item-table-cell">Площадь</div>
                                        <div class="catalog__item-table-cell">35</div>
                                    </div>
                                    <div class="catalog__item-table-row">
                                        <div class="catalog__item-table-cell">Инвертор</div>
                                        <div class="catalog__item-table-cell">Electrolux</div>
                                    </div>
                                    <div class="catalog__item-table-row">
                                        <div class="catalog__item-table-cell">Мощность охлаждения</div>
                                        <div class="catalog__item-table-cell">21</div>
                                    </div>
                                    <div class="catalog__item-table-row">
                                        <div class="catalog__item-table-cell">Мощность охлаждения</div>
                                        <div class="catalog__item-table-cell">21</div>
                                    </div>
                                </div>
                            </div>
                            <div class="catalog__item-price">
                                <div class="catalog__item-price-now">18 200</div>
                                <div class="catalog__item-price-old">19 200</div>
                            </div>
                            <div class="catalog__item-bottom"><a class="catalog__item-btn" href="#"><span>В  корзину</span></a></div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                        <div class="catalog__item">
                            <div class="catalog__item-inf">
                                <div class="catalog__item-fav"><svg><use xlink:href="#fav"></use></svg></div>
                                <div class="catalog__item-stat active"><svg><use xlink:href="#stat"></use></svg></div>
                            </div>
                            <div class="catalog__item-labels">
                                <div class="catalog__item-labels-item">Хит</div>
                                <div class="catalog__item-labels-item new">New</div>
                                <div class="catalog__item-labels-item sale">Sale</div>
                            </div><a class="catalog__item-img" href="#"><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/catalog-img3.jpg" alt=""></a>
                            <div class="catalog__item-top">
                                <div class="catalog__item-article">Арт.42502223</div>
                                <div class="catalog__item-stock">В наличии</div>
                            </div>
                            <div class="catalog__item-tx"><a class="catalog__item-title" href="#">Проточный электроводонагреватель Electrolux SMARTFIX 2.0 TS (5,5 kW) - кран+душ</a>
                                <div class="catalog__item-table">
                                    <div class="catalog__item-table-row">
                                        <div class="catalog__item-table-cell">Площадь</div>
                                        <div class="catalog__item-table-cell">35</div>
                                    </div>
                                    <div class="catalog__item-table-row">
                                        <div class="catalog__item-table-cell">Инвертор</div>
                                        <div class="catalog__item-table-cell">Electrolux</div>
                                    </div>
                                    <div class="catalog__item-table-row">
                                        <div class="catalog__item-table-cell">Мощность охлаждения</div>
                                        <div class="catalog__item-table-cell">21</div>
                                    </div>
                                    <div class="catalog__item-table-row">
                                        <div class="catalog__item-table-cell">Мощность охлаждения</div>
                                        <div class="catalog__item-table-cell">21</div>
                                    </div>
                                </div>
                            </div>
                            <div class="catalog__item-price">
                                <div class="catalog__item-price-now">18 200</div>
                                <div class="catalog__item-price-old">19 200</div>
                            </div>
                            <div class="catalog__item-bottom"><a class="catalog__item-btn" href="#"><span>В  корзину</span></a></div>
                        </div>
                    </div>
                </div>
 */ ?>
        </div>
    </div>
    </div>

<?
if ($haveOffers) {
    $offerIds = array();
    $offerCodes = array();

    $useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

    foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer) {
        $offerIds[] = (int)$jsOffer['ID'];
        $offerCodes[] = $jsOffer['CODE'];

        $fullOffer = $arResult['OFFERS'][$ind];
        $measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

        $strAllProps = '';
        $strMainProps = '';
        $strPriceRangesRatio = '';
        $strPriceRanges = '';

        if ($arResult['SHOW_OFFERS_PROPS']) {
            if (!empty($jsOffer['DISPLAY_PROPERTIES'])) {
                foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property) {
                    $current = '<dt>' . $property['NAME'] . '</dt><dd>' . (
                        is_array($property['VALUE'])
                            ? implode(' / ', $property['VALUE'])
                            : $property['VALUE']
                        ) . '</dd>';
                    $strAllProps .= $current;

                    if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']])) {
                        $strMainProps .= $current;
                    }
                }

                unset($current);
            }
        }

        if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1) {
            $strPriceRangesRatio = '(' . Loc::getMessage(
                    'CT_BCE_CATALOG_RATIO_PRICE',
                    array(
                        '#RATIO#' => ($useRatio
                                ? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
                                : '1'
                            ) . ' ' . $measureName,
                    )
                ) . ')';

            foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range) {
                if ($range['HASH'] !== 'ZERO-INF') {
                    $itemPrice = false;

                    foreach ($jsOffer['ITEM_PRICES'] as $itemPrice) {
                        if ($itemPrice['QUANTITY_HASH'] === $range['HASH']) {
                            break;
                        }
                    }

                    if ($itemPrice) {
                        $strPriceRanges .= '<dt>' . Loc::getMessage(
                                'CT_BCE_CATALOG_RANGE_FROM',
                                array('#FROM#' => $range['SORT_FROM'] . ' ' . $measureName)
                            ) . ' ';

                        if (is_infinite($range['SORT_TO'])) {
                            $strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
                        } else {
                            $strPriceRanges .= Loc::getMessage(
                                'CT_BCE_CATALOG_RANGE_TO',
                                array('#TO#' => $range['SORT_TO'] . ' ' . $measureName)
                            );
                        }

                        $strPriceRanges .= '</dt><dd>' . ($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']) . '</dd>';
                    }
                }
            }

            unset($range, $itemPrice);
        }

        $jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
        $jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
        $jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
        $jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
    }

    $templateData['OFFER_IDS'] = $offerIds;
    $templateData['OFFER_CODES'] = $offerCodes;
    unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

    $jsParams = array(
        'CONFIG'          => array(
            'USE_CATALOG'               => $arResult['CATALOG'],
            'SHOW_QUANTITY'             => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE'                => true,
            'SHOW_DISCOUNT_PERCENT'     => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
            'SHOW_OLD_PRICE'            => $arParams['SHOW_OLD_PRICE'] === 'Y',
            'USE_PRICE_COUNT'           => $arParams['USE_PRICE_COUNT'],
            'DISPLAY_COMPARE'           => $arParams['DISPLAY_COMPARE'],
            'SHOW_SKU_PROPS'            => $arResult['SHOW_OFFERS_PROPS'],
            'OFFER_GROUP'               => $arResult['OFFER_GROUP'],
            'MAIN_PICTURE_MODE'         => $arParams['DETAIL_PICTURE_MODE'],
            'ADD_TO_BASKET_ACTION'      => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP'          => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
            'SHOW_MAX_QUANTITY'         => $arParams['SHOW_MAX_QUANTITY'],
            'RELATIVE_QUANTITY_FACTOR'  => $arParams['RELATIVE_QUANTITY_FACTOR'],
            'TEMPLATE_THEME'            => $arParams['TEMPLATE_THEME'],
            'USE_STICKERS'              => true,
            'USE_SUBSCRIBE'             => $showSubscribe,
            'SHOW_SLIDER'               => $arParams['SHOW_SLIDER'],
            'SLIDER_INTERVAL'           => $arParams['SLIDER_INTERVAL'],
            'ALT'                       => $alt,
            'TITLE'                     => $title,
            'MAGNIFIER_ZOOM_PERCENT'    => 200,
            'USE_ENHANCED_ECOMMERCE'    => $arParams['USE_ENHANCED_ECOMMERCE'],
            'DATA_LAYER_NAME'           => $arParams['DATA_LAYER_NAME'],
            'BRAND_PROPERTY'            => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
                ? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
                : null,
            'SHOW_SKU_DESCRIPTION'      => $arParams['SHOW_SKU_DESCRIPTION'],
            'DISPLAY_PREVIEW_TEXT_MODE' => $arParams['DISPLAY_PREVIEW_TEXT_MODE'],
        ),
        'PRODUCT_TYPE'    => $arResult['PRODUCT']['TYPE'],
        'VISUAL'          => $itemIds,
        'DEFAULT_PICTURE' => array(
            'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
            'DETAIL_PICTURE'  => $arResult['DEFAULT_PICTURE'],
        ),
        'PRODUCT'         => array(
            'ID'                => $arResult['ID'],
            'ACTIVE'            => $arResult['ACTIVE'],
            'NAME'              => $arResult['~NAME'],
            'CATEGORY'          => $arResult['CATEGORY_PATH'],
            'DETAIL_TEXT'       => $arResult['DETAIL_TEXT'],
            'DETAIL_TEXT_TYPE'  => $arResult['DETAIL_TEXT_TYPE'],
            'PREVIEW_TEXT'      => $arResult['PREVIEW_TEXT'],
            'PREVIEW_TEXT_TYPE' => $arResult['PREVIEW_TEXT_TYPE'],
        ),
        'BASKET'          => array(
            'QUANTITY'         => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'BASKET_URL'       => $arParams['BASKET_URL'],
            'SKU_PROPS'        => $arResult['OFFERS_PROP_CODES'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
        ),
        'OFFERS'          => $arResult['JS_OFFERS'],
        'OFFER_SELECTED'  => $arResult['OFFERS_SELECTED'],
        'TREE_PROPS'      => $skuProps,
    );
} else {
    $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
    if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties) {
        ?>
        <div id="<?= $itemIds['BASKET_PROP_DIV'] ?>" style="display: none;">
            <?
            if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
                foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo) {
                    ?>
                    <input type="hidden" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]"
                           value="<?= htmlspecialcharsbx($propInfo['ID']) ?>">
                    <?
                    unset($arResult['PRODUCT_PROPERTIES'][$propId]);
                }
            }

            $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
            if (!$emptyProductProperties) {
                ?>
                <table>
                    <?
                    foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo) {
                        ?>
                        <tr>
                            <td><?= $arResult['PROPERTIES'][$propId]['NAME'] ?></td>
                            <td>
                                <?
                                if (
                                    $arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
                                    && $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
                                ) {
                                    foreach ($propInfo['VALUES'] as $valueId => $value) {
                                        ?>
                                        <label>
                                            <input type="radio"
                                                   name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]"
                                                   value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"checked"' : '') ?>>
                                            <?= $value ?>
                                        </label>
                                        <br>
                                        <?
                                    }
                                } else {
                                    ?>
                                    <select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]">
                                        <?
                                        foreach ($propInfo['VALUES'] as $valueId => $value) {
                                            ?>
                                            <option value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"selected"' : '') ?>>
                                                <?= $value ?>
                                            </option>
                                            <?
                                        }
                                        ?>
                                    </select>
                                    <?
                                }
                                ?>
                            </td>
                        </tr>
                        <?
                    }
                    ?>
                </table>
                <?
            }
            ?>
        </div>
        <?
    }

    $jsParams = array(
        'CONFIG'       => array(
            'USE_CATALOG'              => $arResult['CATALOG'],
            'SHOW_QUANTITY'            => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE'               => !empty($arResult['ITEM_PRICES']),
            'SHOW_DISCOUNT_PERCENT'    => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
            'SHOW_OLD_PRICE'           => $arParams['SHOW_OLD_PRICE'] === 'Y',
            'USE_PRICE_COUNT'          => $arParams['USE_PRICE_COUNT'],
            'DISPLAY_COMPARE'          => $arParams['DISPLAY_COMPARE'],
            'MAIN_PICTURE_MODE'        => $arParams['DETAIL_PICTURE_MODE'],
            'ADD_TO_BASKET_ACTION'     => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP'         => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
            'SHOW_MAX_QUANTITY'        => $arParams['SHOW_MAX_QUANTITY'],
            'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
            'TEMPLATE_THEME'           => $arParams['TEMPLATE_THEME'],
            'USE_STICKERS'             => true,
            'USE_SUBSCRIBE'            => $showSubscribe,
            'SHOW_SLIDER'              => $arParams['SHOW_SLIDER'],
            'SLIDER_INTERVAL'          => $arParams['SLIDER_INTERVAL'],
            'ALT'                      => $alt,
            'TITLE'                    => $title,
            'MAGNIFIER_ZOOM_PERCENT'   => 200,
            'USE_ENHANCED_ECOMMERCE'   => $arParams['USE_ENHANCED_ECOMMERCE'],
            'DATA_LAYER_NAME'          => $arParams['DATA_LAYER_NAME'],
            'BRAND_PROPERTY'           => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
                ? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
                : null,
        ),
        'VISUAL'       => $itemIds,
        'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
        'PRODUCT'      => array(
            'ID'                           => $arResult['ID'],
            'ACTIVE'                       => $arResult['ACTIVE'],
            'PICT'                         => reset($arResult['MORE_PHOTO']),
            'NAME'                         => $arResult['~NAME'],
            'SUBSCRIPTION'                 => true,
            'ITEM_PRICE_MODE'              => $arResult['ITEM_PRICE_MODE'],
            'ITEM_PRICES'                  => $arResult['ITEM_PRICES'],
            'ITEM_PRICE_SELECTED'          => $arResult['ITEM_PRICE_SELECTED'],
            'ITEM_QUANTITY_RANGES'         => $arResult['ITEM_QUANTITY_RANGES'],
            'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
            'ITEM_MEASURE_RATIOS'          => $arResult['ITEM_MEASURE_RATIOS'],
            'ITEM_MEASURE_RATIO_SELECTED'  => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
            'SLIDER_COUNT'                 => $arResult['MORE_PHOTO_COUNT'],
            'SLIDER'                       => $arResult['MORE_PHOTO'],
            'CAN_BUY'                      => $arResult['CAN_BUY'],
            'CHECK_QUANTITY'               => $arResult['CHECK_QUANTITY'],
            'QUANTITY_FLOAT'               => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
            'MAX_QUANTITY'                 => $arResult['PRODUCT']['QUANTITY'],
            'STEP_QUANTITY'                => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
            'CATEGORY'                     => $arResult['CATEGORY_PATH'],
        ),
        'BASKET'       => array(
            'ADD_PROPS'        => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
            'QUANTITY'         => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'PROPS'            => $arParams['PRODUCT_PROPS_VARIABLE'],
            'EMPTY_PROPS'      => $emptyProductProperties,
            'BASKET_URL'       => $arParams['BASKET_URL'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
        ),
    );
    unset($emptyProductProperties);
}

if ($arParams['DISPLAY_COMPARE']) {
    $jsParams['COMPARE'] = array(
        'COMPARE_URL_TEMPLATE'        => $arResult['~COMPARE_URL_TEMPLATE'],
        'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
        'COMPARE_PATH'                => $arParams['COMPARE_PATH'],
    );
}
//echo '<pre>';
//var_dump($arParams);
//echo '</pre>';
?>
    <script>
        BX.message({
            ECONOMY_INFO_MESSAGE: '<?=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>',
            TITLE_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>',
            TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>',
            BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>',
            BTN_SEND_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>',
            BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
            BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>',
            BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
            TITLE_SUCCESSFUL: '<?=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>',
            COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK')?>',
            COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
            COMPARE_TITLE: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE')?>',
            BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
            PRODUCT_GIFT_LABEL: '<?=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>',
            PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>',
            RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
            RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
            SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
        });

        var <?=$obName?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
    </script>
<?
unset($actualItem, $itemIds, $jsParams);