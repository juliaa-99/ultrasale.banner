<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * */
?>
<div class="catalog-page__content-top">

<!--    sort fields-->
    <div class="catalog-page__content-sorting">
        <div class="catalog-page__content-sorting-title">Сортировать по:</div>
        <ul>
            <?php foreach ($arResult['SORTS'] as $key => $field):?>
            <li class="<?=$field['STATE']?>">
                <a class="js-catalog-sort" sort1="<?=$field['CODE']?>" order1="<?=$field['ORDER']?>" onclick="javascript:void(0)">
                    <?=$field['NAME']?>
                    <svg <?=($field['ORDER'] == 'ASC')?'style="-webkit-transform: rotateX(180deg);transform: rotateX(180deg);"':''?>>
                        <use xlink:href="#sort"></use>
                    </svg>
                </a>
            </li>
            <?endforeach;?>

<!--            product available filter-->
<!--            <li class="--><?//=($arParams["HIDE_NOT_AVAILABLE"] == 'Y')?'active':''?><!--">-->
<!--                <a href="#"-->
<!--                   active="--><?//=($arParams["HIDE_NOT_AVAILABLE"] == 'Y')?'':'Y'?><!--"-->
<!--                   class="js-catalog_product_quantity"-->
<!--                   onclick="javascript:void(0)">В наличии</a>-->
<!--            </li>-->

        </ul>
    </div>

    <div class="catalog-page__content-right">
<!--       product available filter2 -->
        <div class="catalog-page__content-vw">
<!--            <div class="catalog-page__content-vw-title">Выводить по:</div>-->
            <select class="js-catalog-available" style="opacity: 0">
                <? foreach ($arResult['AVAILABLE'] as $key => $val):?>
                    <option value="<?=$key?>" <?=$val['STATE']?> > <?=$val['NAME']?></option>
                <? endforeach; ?>
            </select>
        </div>

        <!--    view-count-->
        <div class="catalog-page__content-vw custom-selectric">
            <div class="catalog-page__content-vw-title">Выводить по:</div>
            <select class="js-catalog-count-to-view" style="opacity: 0">
                <? foreach ($arResult['AMOUNTS'] as $amount):?>
                <option value="<?=$amount['VALUE']?>" <?=$amount['STATE']?> ><?=$amount['VALUE']?> </option>
                <? endforeach; ?>
            </select>
        </div>

<!--        card view type-->
        <div class="catalog-page__content-view">
            <a class="catalog-page__content-view-item js-catalog-view-type <?=($arParams['EXT_VIEW_TYPE']==$arParams['VIEW_TYPES'][0]?'active':'')?>" type="<?=$arParams['VIEW_TYPES'][0]?>">
                <svg>
                    <use xlink:href="#tile1"></use>
                </svg>
            </a>
            <a class="catalog-page__content-view-item js-catalog-view-type <?=($arParams['EXT_VIEW_TYPE']==$arParams['VIEW_TYPES'][1]?'active':'')?>" type="<?=$arParams['VIEW_TYPES'][1]?>">
                <svg>
                    <use xlink:href="#tile2"></use>
                </svg>
            </a></div>
    </div>
</div>