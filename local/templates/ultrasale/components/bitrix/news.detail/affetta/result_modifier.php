<?php
$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'],'ID' => $arParams['ELEMENT_ID']);
$select = [];
$rsSect = CIBlockElement::GetList(array('left_margin' => 'asc'),$arFilter,false,$select);
while ($arSect = $rsSect->GetNext())
{
$sect = $arSect;
}

$pict = CFile::GetPath($sect['DETAIL_PICTURE']);

$APPLICATION->SetPageProperty('banner_title', $sect['NAME']);
$APPLICATION->SetPageProperty('banner_text', $sect['PREVIEW_TEXT']);
$APPLICATION->SetPageProperty('banner_image', $pict);
?>