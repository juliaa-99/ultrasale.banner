<?php
$getiblock = CIBlockSection::GetList(
    Array("SORT"=>"ASC"),
    Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'],'DEPTH_LEVEL' => 1, "ACTIVE" => 'Y'),
    false,
    ['UF_BANNER','UF_DISPLAY_TYPE','UF_REDIRECT_URL'],
    false
);

while($sectionwhile = $getiblock->GetNext())
{
    $arS[] = $sectionwhile;
}

//dump($arResult['ELEMENTS']);

foreach($arS as $arSec)
{
//    dump($arSec);
    if($arSec['UF_DISPLAY_TYPE'] == 6) {$maxCount = 1;} else {$maxCount = 1;}
    $subSectCount = 0;
    foreach($arResult["ITEMS"] as $key=>$arItem)
    {
        if ($subSectCount > $maxCount) break;
        if($arItem['IBLOCK_SECTION_ID'] == $arSec['ID'])
        {
            $arSec['ELEMENTS'][] =  $arItem;
            $subSectCount++;
        }
    }
    $arElementGroups[] = $arSec;
}

//dump($arElementGroups);

$arResult["ITEMS"] = $arElementGroups;
?>