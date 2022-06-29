<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
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

$isAjax = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isAjax = (
        (isset($_POST['ajax_action']) && $_POST['ajax_action'] == 'Y')
        || (isset($_POST['compare_result_reload']) && $_POST['compare_result_reload'] == 'Y')
    );
}

?>
<div class="results-page">
    <div class="container">
        <h1><?= $APPLICATION->ShowTitle(true) ?></h1>
        <?
        if ($isAjax) {
            $APPLICATION->RestartBuffer();
        }
        ?>
        <div class="comparison">
            <div class="comparison__inner">
                <div class="comparison__descr">
                    <a class="comparison__descr-back" href="/catalog/">
                        Вернуться в каталог
                        <svg>
                            <use xlink:href="#arrow"></use>
                        </svg>
                    </a>
                    <? /* TODO INKODER Выяснить, как выводить раздел */ ?>
                    <a class="comparison__descr-category" href="#">
                        Электронагреватели
                        <svg>
                            <use xlink:href="#arrow"></use>
                        </svg>
                    </a>
                    <div class="comparison__tbl">
                        <? if (!empty($arResult["SHOW_FIELDS"])) {
                            foreach ($arResult["SHOW_FIELDS"] as $code => $arProp) {
                                if ($code == 'NAME') {continue;}
                                $showRow = true;
                                if ((!isset($arResult['FIELDS_REQUIRED'][$code]) || $arResult['DIFFERENT']) && count($arResult["ITEMS"]) > 1) {
                                    $arCompare = array();
                                    foreach ($arResult["ITEMS"] as $arElement) {
                                        $arPropertyValue = $arElement["FIELDS"][$code];
                                        if (is_array($arPropertyValue)) {
                                            sort($arPropertyValue);
                                            $arPropertyValue = implode(" / ", $arPropertyValue);
                                        }
                                        $arCompare[] = $arPropertyValue;
                                    }
                                    unset($arElement);
                                    $showRow = (count(array_unique($arCompare)) > 1);
                                }
                                if ($showRow) {
                                    ?>
                                    <div class="comparison__tbl-item">
                                        <?= GetMessage("IBLOCK_FIELD_" . $code) ?>
                                    </div>
                                    <?
                                }
                            }
                        } ?>
                        <? if (!empty($arResult["SHOW_PROPERTIES"])) {
                            foreach ($arResult["SHOW_PROPERTIES"] as $code => $arProperty) {
                                $showRow = true;
                                if ($arResult['DIFFERENT']) {
                                    $arCompare = array();
                                    foreach ($arResult["ITEMS"] as $arElement) {
                                        $arPropertyValue = $arElement["DISPLAY_PROPERTIES"][$code]["VALUE"];
                                        if (is_array($arPropertyValue)) {
                                            sort($arPropertyValue);
                                            $arPropertyValue = implode(" / ", $arPropertyValue);
                                        }
                                        $arCompare[] = $arPropertyValue;
                                    }
                                    unset($arElement);
                                    $showRow = (count(array_unique($arCompare)) > 1);
                                }

                                if ($showRow) {
                                    ?>
                                    <div class="comparison__tbl-item"><?= $arProperty["NAME"] ?></div>
                                    <?
                                }
                            }
                        } ?>
                        <?
                        if (!empty($arResult["SHOW_OFFER_PROPERTIES"])) {
                            foreach ($arResult["SHOW_OFFER_PROPERTIES"] as $code => $arProperty) {
                                $showRow = true;
                                if ($arResult['DIFFERENT']) {
                                    $arCompare = array();
                                    foreach ($arResult["ITEMS"] as $arElement) {
                                        $arPropertyValue = $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["VALUE"];
                                        if (is_array($arPropertyValue)) {
                                            sort($arPropertyValue);
                                            $arPropertyValue = implode(" / ", $arPropertyValue);
                                        }
                                        $arCompare[] = $arPropertyValue;
                                    }
                                    unset($arElement);
                                    $showRow = (count(array_unique($arCompare)) > 1);
                                }
                                if ($showRow) {
                                    ?>
                                    <div class="comparison__tbl-item"><?= $arProperty["NAME"] ?></div>
                                    <?
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            <div class="comparison__slider">
            <? foreach ($arResult["ITEMS"] as $arElement) {
                $mainId = $this->GetEditAreaId($arElement['ID']);
                $itemIds = array(
                    'ID' => $mainId,
                    'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
                    'STICKER_ID' => $mainId.'_sticker',
                    'BIG_SLIDER_ID' => $mainId.'_big_slider',
                    'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
                    'SLIDER_CONT_ID' => $mainId.'_slider_cont',
                    'OLD_PRICE_ID' => $mainId.'_old_price',
                    'PRICE_ID' => $mainId.'_price',
                    'DESCRIPTION_ID' => $mainId.'_description',
                    'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
                    'PRICE_TOTAL' => $mainId.'_price_total',
                    'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
                    'QUANTITY_ID' => $mainId.'_quantity',
                    'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
                    'QUANTITY_UP_ID' => $mainId.'_quant_up',
                    'QUANTITY_MEASURE' => $mainId.'_quant_measure',
                    'QUANTITY_LIMIT' => $mainId.'_quant_limit',
                    'BUY_LINK' => $mainId.'_buy_link',
                    'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
                    'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
                    'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
                    'COMPARE_LINK' => $mainId.'_compare_link',
                    'TREE_ID' => $mainId.'_skudiv',
                    'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
                    'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
                    'OFFER_GROUP' => $mainId.'_set_group_',
                    'BASKET_PROP_DIV' => $mainId.'_basket_prop',
                    'SUBSCRIBE_LINK' => $mainId.'_subscribe',
                    'TABS_ID' => $mainId.'_tabs',
                    'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
                    'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
                    'TABS_PANEL_ID' => $mainId.'_tabs_panel'
                );
                $haveOffers = !empty($arElement['OFFERS']);
                if ($haveOffers)
                {
                    $actualItem = isset($arElement['OFFERS'][$arElement['OFFERS_SELECTED']])
                        ? $arElement['OFFERS'][$arElement['OFFERS_SELECTED']]
                        : reset($arElement['OFFERS']);
                    $showSliderControls = false;

                    foreach ($arElement['OFFERS'] as $offer)
                    {
                        if ($offer['MORE_PHOTO_COUNT'] > 1)
                        {
                            $showSliderControls = true;
                            break;
                        }
                    }
                }
                else
                {
                    $actualItem = $arElement;
                    $showSliderControls = $arElement['MORE_PHOTO_COUNT'] > 1;
                }

                $skuProps = array();
                // dump($arElement);
                // $price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
                $price['RATIO_PRICE'] = $actualItem['CATALOG_PRICE_1'];
                $measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
                $showDiscount = $price['PERCENT'] > 0;
                ?>
                <div class="catalog__item">
                    <div class="catalog__item-inf">
                        <div class="catalog__item-fav <?=isInFav($arElement['ID'])?'active':''?>" data-id="<?=$arElement['ID']?>"><svg><use
                        xlink:href="#fav"></use></svg></div>
                        <div class="catalog__item-stat"><svg><use xlink:href="#close"></use></svg></div>
                    </div>
                    <?php if (!empty($arElement['PROPERTIES']['HIT']['VALUE'])
                        || !empty
                        ($arElement['PROPERTIES']['NEW']['VALUE'])
                        || !empty($arElement['PROPERTIES']['SALE']['VALUE'])
                    ) {
                        ?>
                        <div class="catalog__item-labels">
                            <?php if (!empty($arElement['PROPERTIES']['HIT']['VALUE'])) { ?>
                                <div class="catalog__item-labels-item">Хит</div>
                            <?php } ?>
                            <?php if (!empty($arElement['PROPERTIES']['NEW']['VALUE'])) { ?>
                                <div class="catalog__item-labels-item new">New</div>
                            <?php } ?>
                            <?php if (!empty($arElement['PROPERTIES']['SALE']['VALUE'])) { ?>
                                <div class="catalog__item-labels-item sale">Sale</div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <a class="catalog__item-img" href="<?= $arElement["DETAIL_PAGE_URL"] ?>"><img
                                border="0"
                                src="<?= $arElement['PREVIEW_PICTURE']["SRC"] ?>"
                                alt="<?= $arElement['PREVIEW_PICTURE']["ALT"] ?>"
                                title="<?= $arElement['PREVIEW_PICTURE']["TITLE"] ?>"
                        /></a>
                    <div class="catalog__item-top">
                        <div class="catalog__item-article">Арт.<?=$arElement['PROPERTIES']['ARTICUL']['VALUE']?></div>
                        <?php if ($arElement['CATALOG_AVAILABLE'] == 'Y') { ?>
                            <div class="catalog__item-stock">В наличии</div>
                        <?php } ?>
                    </div>
                    <div class="catalog__item-tx"><a class="catalog__item-title" href="<?= $arElement["DETAIL_PAGE_URL"] ?>"><?=$arElement['NAME']?></a></div>
                    <div class="catalog__item-price">
                        <div class="cart-product__description-price-now" id="<?= $itemIds['PRICE_ID'] ?>"><?= number_format($price['RATIO_PRICE'], 0, '', ' ') ?></div>
                        <div class="cart-product__description-price-old" id="<?= $itemIds['OLD_PRICE_ID'] ?>" <?= ($price['RATIO_PRICE'] >=
                        $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '') ?>><?= number_format($price['RATIO_BASE_PRICE'],
                                0, '', ' ') ?></div>
                    </div>
                    <div class="catalog__item-bottom" style="display: <?= ($actualItem['CAN_BUY'] ? '' : 'none') ?>;"
                         data-entity="panel-buy-button"  id="<?= $itemIds['BASKET_ACTIONS_ID'] ?>">
                        <a class="catalog__item-btn" href="javascript:void(0)" rel="nofollow"
                           id="<?=$itemIds['ADD_BASKET_LINK']?>"><span>Добавить в корзину</span></a>
                    </div>
                    <div class="catalog__item-tbl">
                        <? if (!empty($arResult["SHOW_FIELDS"])) {
                            foreach ($arResult["SHOW_FIELDS"] as $code => $arProp) {
                                if ($code == 'NAME') {continue;}
                                $showRow = true;
                                if ((!isset($arResult['FIELDS_REQUIRED'][$code]) || $arResult['DIFFERENT']) && count($arResult["ITEMS"]) > 1) {
                                    $arCompare = array();
                                    foreach ($arResult["ITEMS"] as $arElementEx) {
                                        $arPropertyValue = $arElementEx["FIELDS"][$code];
                                        if (is_array($arPropertyValue)) {
                                            sort($arPropertyValue);
                                            $arPropertyValue = implode(" / ", $arPropertyValue);
                                        }
                                        $arCompare[] = $arPropertyValue;
                                    }
                                    unset($arElementEx);
                                    $showRow = (count(array_unique($arCompare)) > 1);
                                }
                                if ($showRow) {
                                    ?>
                                    <div class="catalog__item-tbl-item">
                                        <?= $arElementEx["FIELDS"][$code]; ?>
                                    </div>
                                    <?
                                }
                            }
                        } ?>
                        <?
                        if (!empty($arResult["SHOW_OFFER_FIELDS"])) {
                            foreach ($arResult["SHOW_OFFER_FIELDS"] as $code => $arProp) {
                                $showRow = true;
                                if ($arResult['DIFFERENT']) {
                                    $arCompare = array();
                                    foreach ($arResult["ITEMS"] as $arElementEx) {
                                        $Value = $arElementEx["OFFER_FIELDS"][$code];
                                        if (is_array($Value)) {
                                            sort($Value);
                                            $Value = implode(" / ", $Value);
                                        }
                                        $arCompare[] = $Value;
                                    }
                                    unset($arElementEx);
                                    $showRow = (count(array_unique($arCompare)) > 1);
                                }
                                if ($showRow) {
                                    ?>
                                    <div class="catalog__item-tbl-item">
                                        <?= (is_array($arElementEx["OFFER_FIELDS"][$code]) ? implode("/ ", $arElementEx["OFFER_FIELDS"][$code]) : $arElementEx["OFFER_FIELDS"][$code]);?>
                                    </div>
                                <? }
                            }
                        }
                        ?>
                        <? if (!empty($arResult["SHOW_PROPERTIES"])) {
                            foreach ($arResult["SHOW_PROPERTIES"] as $code => $arProperty) {
                                $showRow = true;
                                if ($arResult['DIFFERENT']) {
                                    $arCompare = array();
                                        $arPropertyValue = $arElement["DISPLAY_PROPERTIES"][$code]["VALUE"];
                                        if (is_array($arPropertyValue)) {
                                            sort($arPropertyValue);
                                            $arPropertyValue = implode(" / ", $arPropertyValue);
                                        }
                                        $arCompare[] = $arPropertyValue;
                                    $showRow = (count(array_unique($arCompare)) > 1);
                                }

                                if ($showRow) {
                                    ?>
                                    <div class="catalog__item-tbl-item">
                                            <?= (is_array($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) ? implode("/ ",
                                                    $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) :
                                                $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) ?>
                                            <?
                                        ?>
                                    </div>
                                    <?
                                }
                            }
                        } ?>
                        <?
                        if (!empty($arResult["SHOW_OFFER_PROPERTIES"])) {
                            foreach ($arResult["SHOW_OFFER_PROPERTIES"] as $code => $arProperty) {
                                $showRow = true;
                                if ($arResult['DIFFERENT']) {
                                    $arCompare = array();
                                        $arPropertyValue = $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["VALUE"];
                                        if (is_array($arPropertyValue)) {
                                            sort($arPropertyValue);
                                            $arPropertyValue = implode(" / ", $arPropertyValue);
                                        }
                                        $arCompare[] = $arPropertyValue;
                                    $showRow = (count(array_unique($arCompare)) > 1);
                                }
                                if ($showRow) {
                                    ?>
                                    <div class="catalog__item-tbl-item">
                                     <?= (is_array($arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) ? implode("/ ",
                                                $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) : $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) ?>
                                    </div>
                                    <?
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <?
                unset($arElement);
            }
            unset($arElement);
            ?>
            </div>
            </div>
        </div>
    </div>
</div>
<?
if ($isAjax) {
    die();
}
?>
<script type="text/javascript">
    var CatalogCompareObj = new BX.Iblock.Catalog.CompareClass("bx_catalog_compare_block", '<?=CUtil::JSEscape($arResult['~COMPARE_URL_TEMPLATE']); ?>');
</script>