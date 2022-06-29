<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<?if($APPLICATION->GetCurPage(false) != '/services/'):?>
    <div class="banner tw">
        <!--    <div class="banner__slider js-banner-slider">-->
        <div class="banner__slider">
            <div class="banner__slider-item">
                <div class="banner__slider-img"
                     style="background-image: url('<?$APPLICATION->ShowProperty('banner_image')?>'); "></div>
                <? if (!empty($arResult['UF_MOBILE_BANNER']['PREVIEW']['src'])) { ?>
                    <!--<div class="banner__slider-img-mob"><img src="<?= $arResult['UF_MOBILE_BANNER']['PREVIEW']['src'] ?>"
                                                         alt=""></div>-->
                <? } ?>
                <div class="container">
                    <div class="banner__slider-inner">
                        <h1 class="banner__slider-title"><?$APPLICATION->ShowProperty('banner_title')?></h1>
                        <div class="banner__slider-tx"><?$APPLICATION->ShowProperty('banner_text')?></div>
                        <a class="button
                button-primary" href="#" data-toggle="modal"
                           data-target="#modalCall"><span>Оставить заявку</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?endif?>
    <div class="container">
    <?if($arParams["USE_RSS"]=="Y"):?>
        <?
        $rss_url = CComponentEngine::makePathFromTemplate($arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss_section"], array_map("urlencode", $arResult["VARIABLES"]));
        if(method_exists($APPLICATION, 'addheadstring'))
            $APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$rss_url.'" href="'.$rss_url.'" />');
        ?>
        <a href="<?=$rss_url?>" title="rss" target="_self"><img alt="RSS" src="<?=$templateFolder?>/images/gif-light/feed-icon-16x16.gif" border="0" align="right" /></a>
    <?endif?>

    <?if($arParams["USE_SEARCH"]=="Y"):?>
        <?=GetMessage("SEARCH_LABEL")?><?$APPLICATION->IncludeComponent(
            "bitrix:search.form",
            "flat",
            Array(
                "PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"]
            ),
            $component
        );?>
        <br />
    <?endif?>
    <?if($arParams["USE_FILTER"]=="Y"):?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.filter",
            "",
            Array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "FILTER_NAME" => $arParams["FILTER_NAME"],
                "FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
                "PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
            ),
            $component
        );
        ?>
        <br />
    <?endif?>
    <?
//        dump($arResult);
        $select = ['UF_DISPLAY_TYPE'];
        $arFilter = ['IBLOCK_ID' => $arParams["IBLOCK_ID"],'CODE' => $arResult["VARIABLES"]["SECTION_CODE"]];
        $rsSect = CIBlockSection::GetList(['left_margin' => 'asc'],$arFilter,false,$select);
        if ($arSect = $rsSect->GetNext())
        {
            $sect_id = ($arSect['ID']);
        }

        $select = ['UF_DISPLAY_TYPE'];
        $arFilter = ['IBLOCK_ID' => $arParams["IBLOCK_ID"],'SECTION_ID' => $sect_id];
        $rsSect = CIBlockSection::GetList(['left_margin' => 'asc'],$arFilter,false,$select);
        while ($arSect = $rsSect->GetNext())
        {
            $sections[] = $arSect;
        }
//         dump($sections);
        ?>

<!--        <div class="object-page__inner">-->
<!--            <div class="row">-->
<!--            --><?//foreach ($sections as $item):
//                $picture = CFile::GetPath($item['PICTURE']);
//                $cols = ($item['UF_DISPLAY_TYPE'] == 5)?'col-xl-3 col-lg-3 col-md-12':'col-xl-6 col-lg-6 col-md-12';
//                ?>
<!--                <div class="--><?//=$cols?><!-- ord"><a class="services__item" href="--><?//=$item['SECTION_PAGE_URL']?><!--"><span class="services__item-inner"><span class="services__item-title">--><?//=$item['NAME']?><!--</span>-->
<!--                <object>-->
<!--                  <ul class="services__item-list">-->
<!--                      --><?//foreach ($item['ELEMENTS'] as $element):?>
<!--                          <li><a href="--><?//=$element['DETAIL_PAGE_URL']?><!--">--><?//=$element['NAME']?><!--</a></li>-->
<!--                      --><?//endforeach;?>
<!--                  </ul>-->
<!--                </object><span class="services__item-icon"><svg><use xlink:href="#arrow2"></use></svg></span><span class="services__item-img"><img src="--><?//=$picture?><!--" alt=""></span></span></a></div>-->
<!--            --><?//endforeach;?>
<!--            </div>-->
<!--        </div>-->

    <div class="about-mont__inner">
        <div class="row">
            <?foreach ($sections as $item):?>
<!--            --><?//dump($item);?>
                <?$image = CFile::GetPath($item["PICTURE"]);;?>
                <div class="col-xl-3 col-lg-4 col-md-6" id="<?=$this->GetEditAreaId($item['ID']);?>">
                    <a class="about-mont__item" href="/<?=$item['LIST_PAGE_URL']?><?=$item['SECTION_PAGE_URL']?>"><span class="about-mont__item-img <?=(empty($image))?'not-image':''?>" style="background-image: url(<?=$image?>)"></span><span class="about-mont__item-tx"><span class="about-mont__item-title"><?=$item['NAME']?></span>
                        <span class="about-mont__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></span></span>
                    </a>
                </div>
            <?endforeach;?>

            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "affetta2",
                Array(
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "NEWS_COUNT" => $arParams["NEWS_COUNT"],
                    "SORT_BY1" => $arParams["SORT_BY1"],
                    "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                    "SORT_BY2" => $arParams["SORT_BY2"],
                    "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                    "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                    "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                    "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                    "SET_TITLE" => $arParams["SET_TITLE"],
                    "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                    "MESSAGE_404" => $arParams["MESSAGE_404"],
                    "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                    "SHOW_404" => $arParams["SHOW_404"],
                    "FILE_404" => $arParams["FILE_404"],
                    "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                    "ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                    "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                    "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                    "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                    "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                    "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                    "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                    "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                    "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                    "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                    "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                    "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                    "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                    "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                    "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                    "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                    "FILTER_NAME" => $arParams["FILTER_NAME"],
                    "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                    "CHECK_DATES" => $arParams["CHECK_DATES"],
                    "STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],

                    "PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
                    "PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                    "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                    "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                    "INCLUDE_SUBSECTIONS" => "N"
                ),
                $component
            );?>
        </div>
    </div>

</div>