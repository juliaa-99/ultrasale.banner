<?php
/**
 *
 */
/** @var array $arResult */

$this->setFrameMode(true);
?>
<div class="news-item">
    <div class="news-item__holder">
        <div class="container">
            <div class="news-item__inner">
                <div class="news-item__text">
                    <h1><?= $arResult['NAME'] ?></h1>
                    <div class="news-item__instruction">
                        <? if (!empty($arResult['PROPERTIES']['BRAND2']['VALUE'])) {?>
                            <?
                                $arSelect = array("ID", "DETAIL_PAGE_URL", "NAME");
                                $arFilter = array("IBLOCK_ID" => 14, 'ID' => $arResult['PROPERTIES']['BRAND2']['VALUE']);
                                $res = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter, false, array("nPageSize" => 1, 'iNumPage' => 1), $arSelect);
                                if ($ob = $res->GetNextElement())
                                {
                                    $arFields = $ob->GetFields();
                                    echo "<p><b>Бренд:</b>  <a href=\"".$arFields['DETAIL_PAGE_URL']."\">".$arFields['NAME']."</a>";
                                }
                            ?>
                        <? } else {?>
                            <? if (!empty($arResult['PROPERTIES']['BRAND']['VALUE'])) {?>
                                <p><b>Бренд:</b> <?=$arResult['PROPERTIES']['BRAND']['VALUE']?></p>
                            <? } ?>
                        <? } ?>
                        <? if (!empty($arResult['PROPERTIES']['INSTRUCTION_CATEGORY']['VALUE'])) {?>
                            <p><b>Категория для инструкций:</b> <?=$arResult['PROPERTIES']['INSTRUCTION_CATEGORY']['~VALUE']?></p>
                        <? } ?>
                        <? if (!empty($arResult['PROPERTIES']['ALPHABET']['VALUE'])) {?>
                            <p><b>Алфавит (англ.):</b> <?=$arResult['PROPERTIES']['ALPHABET']['~VALUE']?></p>
                        <? } ?>
                        <? if (!empty($arResult['PROPERTIES']['DESCRIPTION']['VALUE'])) {?>
                            <p><b>Описание:</b> <?=$arResult['PROPERTIES']['DESCRIPTION']['VALUE']?></p>
                        <? } ?>
                        <? if (!empty($arResult['PROPERTIES']['INSTRUCTION_FILE']['FILE_SIZE'])) {?>
                            <p><b>Размер файла:</b> <?=$arResult['PROPERTIES']['INSTRUCTION_FILE']['FILE_SIZE']?>
                                байт</p><a
                                    class="news-item__instruction-link" href="<?=$arResult['PROPERTIES']['INSTRUCTION_FILE']['SRC']?>">
                                <?=$arResult['PROPERTIES']['INSTRUCTION_FILE']['DESCRIPTION']?><svg><use
                                            xlink:href="#down"></use></svg></a><img src="<?=$arResult['PROPERTIES']['COVER_PHOTO']['SRC']?>" alt="">
                        <? } ?>
                    </div>
                </div>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.share",
                    "main",
                    array(
                        "HANDLERS" => array(
                            "telegram",
                            "wa",
                            "facebook",
                            "vk",
                        ),
                        "PAGE_URL" => $APPLICATION->GetCurPage(),
                        "PAGE_TITLE" => $APPLICATION->GetTitle(),
                    ),
                    $component
                );
                ?>
            </div>
        </div>
    </div>
</div>