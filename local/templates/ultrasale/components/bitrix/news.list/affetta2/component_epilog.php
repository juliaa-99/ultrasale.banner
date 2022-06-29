<?php
//dump($arResult);
//if (count($arResult['ELEMENTS']) == 1){
//    $arSelect = array("ID", "DETAIL_PAGE_URL");
//    $arFilter = array("IBLOCK_ID" => 19, "ID" => $arResult['ELEMENTS'][0]);
//    $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 1), $arSelect);
//    if ($ob = $res->GetNextElement())
//    {
//        $arFields = $ob->GetFields();
////        echo $arFields['DETAIL_PAGE_URL'];
//        header('Location: https://'.$_SERVER['HTTP_HOST'].$arFields['DETAIL_PAGE_URL']);
////        dump($_SERVER);
//        exit();
//    }
//}

$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'],'ID' => $arParams['PARENT_SECTION']);
// $select = ['UF_BANNER_CAPTION','UF_BANNER_TEXT'];
$select = ['UF_BANNER_TEXT'];
$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter,false,$select);
while ($arSect = $rsSect->GetNext())
{
    $sect = $arSect;
}

// dump($arParams);

$section_name = end($arResult['SECTION']['PATH'])['NAME'];

$pict = CFile::GetPath($sect['DETAIL_PICTURE']);

$APPLICATION->SetPageProperty('banner_title', $section_name);
$APPLICATION->SetPageProperty('banner_text', $sect['UF_BANNER_TEXT']);
$APPLICATION->SetPageProperty('banner_image', $pict);
//$APPLICATION->SetTitle($sect['DESCRIPTION']);
?>