<?if (!empty($arResult)):?>
    <?php
    $APPLICATION->IncludeFile(
        SITE_DIR . "local/include/about_bits.php",
        array(),
        array("MODE" => "html")
    ); ?>
    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?><!--<br />-->
    <?endif;?>
    <div class="about-mont__inner">
        <div class="row">
            <?foreach ($arResult['ITEMS'] as $item):?>
                <?
                $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <?php
                    $image = $item['PREVIEW_PICTURE']['SRC'];
//                    if (empty($image)) $image = SITE_TEMPLATE_PATH.'/assets/images/services-img1.jpg';
                ?>
                <div class="col-xl-3 col-lg-4 col-md-6" id="<?=$this->GetEditAreaId($item['ID']);?>">
                    <a class="about-mont__item" href="<?=$item['DETAIL_PAGE_URL']?>">
                        <span class="about-mont__item-img <?=(empty($image))?'not-image':''?>" style="background-image: url(<?=$image?>)">
                            <p class="about-mont__item-top-title"><?=$item['NAME']?></p>
                        </span>
                        <span class="about-mont__item-tx">
                            <span class="about-mont__item-title"><?=$item['PREVIEW_TEXT']?></span>
                            <span class="about-mont__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></span>
                        </span>
                    </a>
                </div>
            <?endforeach;?>
    </div>
</div>
<?endif?>
<?
    $res = CIBlockSection::GetByID($arParams['PARENT_SECTION']);
    $ar_res=$res->GetNext();
?>
<h2><?=$ar_res['DESCRIPTION']?></h2>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <!--<br />--><?=$arResult["NAV_STRING"]?>
<?endif;?>