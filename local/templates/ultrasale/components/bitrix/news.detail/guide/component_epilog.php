<?php
//dump($arResult['IBLOCK_SECTION_ID']);
//dump($arParams);

$res = CIBlockSection::GetByID($arResult['IBLOCK_SECTION_ID']);
if ($ar_res = $res->GetNext()) $sect = $ar_res['IBLOCK_SECTION_ID'];

$res = CIBlockSection::GetByID($sect);
if ($ar_res = $res->GetNext()) $sect = $ar_res['IBLOCK_SECTION_ID'];

$res = CIBlockSection::GetByID($sect);
if ($ar_res = $res->GetNext()) $sect = $ar_res;

$APPLICATION->AddChainItem($sect['NAME'], '/guide/'.$sect['CODE'].'/');