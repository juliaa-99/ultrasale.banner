<?if (!empty($arResult)):?>
<?php //dump($arResult);?>
    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?><!--<br />-->
    <?endif;?>

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
                    <a class="about-mont__item" href="<?=$item['DETAIL_PAGE_URL']?>"><span class="about-mont__item-img <?=(empty($image))?'not-image':''?>" style="background-image: url(<?=$image?>)"></span><span class="about-mont__item-tx"><span class="about-mont__item-title"><?=$item['NAME']?></span>
                            <span class="about-mont__item-arrow"><svg><use xlink:href="#arrow2"></use></svg></span></span>
                    </a>
                </div>
            <?endforeach;?>

<?endif?>
<?
    $res = CIBlockSection::GetByID($arParams['PARENT_SECTION']);
    $ar_res=$res->GetNext();
?>
<div class="xxx-section-description"><?=$ar_res['DESCRIPTION']?></div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <!--<br />--><?=$arResult["NAV_STRING"]?>
<?endif;?>