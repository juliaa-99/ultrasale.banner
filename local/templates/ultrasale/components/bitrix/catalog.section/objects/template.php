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

if (!empty($arResult['NAV_RESULT']))
{
    $navParams =  array(
        'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
        'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
        'NavNum' => $arResult['NAV_RESULT']->NavNum
    );
}
else
{
    $navParams = array(
        'NavPageCount' => 1,
        'NavPageNomer' => 1,
        'NavNum' => $this->randString()
    );
}
$showTopPager = false;
$showBottomPager = false;
$showLazyLoad = false;
if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1)
{
    $showTopPager = $arParams['DISPLAY_TOP_PAGER'];
    $showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
    $showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}
?>

<div class="news-page">
    <div class="object-page__holder">
        <div class="container">
            <div class="title-main">
                <h1><?= $arResult['NAME'] ?></h1><a class="button button-primary" href="#" data-toggle="modal"
                                                    data-target="#modalApp"><span>Оставить заявку</span></a>
            </div>
            <div class="object-page__inner">
                <div class="row">
                    <? foreach ($arResult['ITEMS'] as $arItem):
                    // $URL = CFile::GetPath($arItem['PROPERTIES']['MORE_PHOTO']['VALUE'][0]); ?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="col-lg-6 col-md-12" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><a class="object-page__item" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><span
                                        class="object-page__item-img"
                                        style="background-image: url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>')
                                                "></span><span
                                        class="object-page__item-list"><span class="object-page__item-title"><?= $arItem['~NAME'] ?></span><span
                                            class="object-page__item-tx">Тип объекта:
                                        <?=$arItem["PROPERTIES"]['OBJECT_TYPE']['VALUE']?></span><span
                                            class="object-page__item-tx">Площадь: <?=$arItem["PROPERTIES"]['AREA']['VALUE']?></span><span
                                            class="object-page__item-tx">Работы: <?=$arItem["PROPERTIES"]['JOBS_DONE']['VALUE']['TEXT']?></span><span
                                            class="object-page__item-tx">Оборудование: <?=$arItem["PROPERTIES"]['EQUIPMENT']['VALUE']['TEXT']?></span><span
                                            class="object-page__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></span></span></a>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
            <!--        --><? //= $arResult['NAV_STRING'] ?>
        </div>
    </div>
</div>
<?
if ($showBottomPager)
{
    ?>
    <div data-pagination-num="<?=$navParams['NavNum']?>">
        <!-- pagination-container -->
        <?=$arResult['NAV_STRING']?>
        <!-- pagination-container -->
    </div>
    <?
}