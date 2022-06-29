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

$amounts = [12, 24, 48];
$this->setFrameMode(true);
?>
<div class="catalog-page__content">
    <h1><?= $arResult['NAME'] ?></h1>
    <div class="catalog-page__content-filter js-filter-mob"><img src="assets/images/svg/filter.svg"
                                                                 alt=""><span>Фильтры (3)</span></div>
    <div class="catalog-page__content-top">
        <div class="catalog-page__content-sorting">
            <div class="catalog-page__content-sorting-title">Сортировать по:</div>
            <ul>
            <?php
            foreach ($arParams['EXT_SORT'] as $key => $item) {

                $class = '';
                $icon = '';
                $order1 = 'asc';
                if ($item['CODE'] == $arParams['ELEMENT_SORT_FIELD']) {
                    $class = 'active';
                    if ($arParams['ELEMENT_SORT_ORDER'] == 'asc,nulls') {
                        $icon = '<svg>
                            <use xlink:href="#sort"></use>
                        </svg>';
                        $order1 = 'desc';
                    } else {
                        $icon = '<svg style="-webkit-transform: rotateX(180deg);transform: rotateX(180deg);">
                            <use xlink:href="#sort"></use>
                        </svg>';
                        $order1 = 'asc';
                    }
                }
                ?><li class="<?=$class?>"><a href="<?=$APPLICATION->GetCurPage(false)
                ?>?sort1=<?=$key?>&order1=<?=$order1?>">
                        <?=$item['NAME']?>
                        <?=$icon?>
                    </a></li>
                <?
            }
            ?>
            </ul>
        </div>
        <div class="catalog-page__content-right">
            <div class="catalog-page__content-vw">
                <div class="catalog-page__content-vw-title">Выводить по:</div>
                <select>
                    <? if (!empty($arParams["PAGE_ELEMENT_COUNT"]) ) {
                        if (!in_array($arParams["PAGE_ELEMENT_COUNT"],$amounts)) {
                            $arParams['PAGE_ELEMENT_COUNT'] = $amounts[0];
                        }
                        foreach ($amounts as $amount) {
                            $selected = '';
                            if ($amount == $arParams['PAGE_ELEMENT_COUNT']) {
                                $selected = ' selected';
                            }
                            ?><option value="<?=$amount?>" <?=$selected?>><?=$amount?></option><?
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="catalog-page__content-view"><a class="catalog-page__content-view-item <?=($arParams['EXT_VIEW_TYPE']=='tile'?'active':'')?>"
                                                       href="<?=$APPLICATION->GetCurPageParam("view_type=tile", array
                                                       ("view_type"));?>">
                    <svg>
                        <use xlink:href="#tile1"></use>
                    </svg>
                </a><a class="catalog-page__content-view-item  <?=($arParams['EXT_VIEW_TYPE']=='list'?'active':'')?>"
                       href="<?=$APPLICATION->GetCurPageParam("view_type=list", array
                       ("view_type"));?>">
                    <svg>
                        <use xlink:href="#tile2"></use>
                    </svg>
                </a></div>
        </div>
    </div>
    <div class="filter__top">
        <div class="filter__top-title">Фильтр (1)</div>
    </div>
    <div class="catalog-page__content-wrapper">
        <?php if (count($arResult['ITEMS'])) { ?>
            <div class="row">
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
                    <div class="<?=($arParams['EXT_VIEW_TYPE']=='tile'?'col-xl-4 col-lg-6 col-md-6 col-sm-6':'col-xl-12 col-lg-12 col-md-6 col-sm-6')?>">
                        <div class="catalog__item <?=($arParams['EXT_VIEW_TYPE']=='list'?'catalog__item-list':'')?>" >
                            <div class="catalog__item-inf">
                                <div class="catalog__item-fav <?=isInFav($item['ID'])?'active':''?>" data-id="<?=$item['ID']?>">
                                    <svg>
                                        <use xlink:href="#fav"></use>
                                    </svg>
                                </div>
                                <div class="catalog__item-stat">
                                    <svg>
                                        <use xlink:href="#stat"></use>
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
                                    <?php if (!empty($props['HIT']['VALUE']))
                                        { ?>
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
                            <a class="catalog__item-img" href="<?= $item['DETAIL_PAGE_URL'] ?>"><img
                                        src="<?= $item['PREVIEW_PICTURE']['SAFE_SRC'] ?>"
                                        alt=""></a>
                            <div class="catalog__item-top">
                                <div class="catalog__item-article">
                                    Арт.<?= $props['ARTICUL']['VALUE'] ?></div>
                                <?php if ($item['CATALOG_AVAILABLE'] == 'Y') { ?>
                                    <div class="catalog__item-stock">В наличии</div>
                                <?php } ?>
                            </div>
                            <div class="catalog__item-tx"><a class="catalog__item-title"
                                                             href="<?= $item['DETAIL_PAGE_URL'] ?>"><?=
                                    $item['NAME'] ?></a>
                                <?php if (!empty($props)) { ?>
                                    <div class="catalog__item-table">
                                        <?php
                                        $counter = 4;
                                        foreach ($props as $key => $prop) {

                                            if (empty($prop['VALUE'])
                                                || in_array($key,
                                                    [
                                                        'ARTICUL',
                                                        'SALE',
                                                        'NEW',
                                                        'HIT',
                                                        'MORE_PHOTO',
                                                    ])) {
                                                continue;
                                            }
                                            if ($counter <= 0) {
                                                break;
                                            }
                                            $counter--;
                                            ?>
                                            <div class="catalog__item-table-row">
                                                <div class="catalog__item-table-cell"
                                                     data-code="<?= $key ?>"><?= $prop['NAME'] ?></div>
                                                <div class="catalog__item-table-cell"><?=
                                                    (is_array($prop['VALUE'])) ? (join(' / ',
                                                        $prop['VALUE'])) : $prop['VALUE'] ?></div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="catalog__item-price">
                                <div
                                        class="catalog__item-price-now"><?= number_format($price['RATIO_PRICE'], 0, '',
                                        ' ') ?></div>
                                <div class="catalog__item-price-old" <?= ($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '') ?>><?= number_format($price['RATIO_BASE_PRICE'],
                                        0, '', ' ') ?></div>
                            </div>
                            <div class="catalog__item-bottom" id="<?= $itemIds['BASKET_ACTIONS'] ?>"><a
                                        class="catalog__item-btn" href="javascript:void(0)" rel="nofollow"
                                        id="<?= $itemIds['BUY_LINK'] ?>"><span>В  корзину</span></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="button-center"><a class="button button-primary" href="#"><span>Показать еще</span></a>
        </div>
        <?= $arResult['NAV_STRING'] ?>
    </div>
    <?php if (!empty($arResult['~DESCRIPTION'])) { ?>
        <div class="catalog__more">
            <?= $arResult['~DESCRIPTION'] ?>
            <div class="catalog__more-btn"><span class="op">Читать больше</span><span class="cl">Скрыть</span>
            </div>
        </div>
    <?php } ?>
</div>

