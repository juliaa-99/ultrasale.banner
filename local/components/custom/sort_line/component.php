<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * */

$arResult['SORTS'] = $arParams['SORTS'];

//SORTS
foreach ($arResult['SORTS'] as $key => $sort_field) {
    //    find cur cort field
    if ($sort_field['CODE'] == $arParams['ELEMENT_SORT_FIELD'])
    {
        $arResult['SORTS'][$key]['STATE'] = 'active';

        if ($arParams['ELEMENT_SORT_ORDER'] == 'ASC')
        {
            $arResult['SORTS'][$key]['ORDER'] = 'DESC';
        } else
        {
            $arResult['SORTS'][$key]['ORDER'] = 'ASC';
        }
    }
}


//VIEW COUNT
$arResult['AMOUNTS'] = [
    ['VALUE' => 12, 'STATE'=>'selected'],
    ['VALUE' => 24, 'STATE'=>''],
    ['VALUE' => 48, 'STATE'=>'']
];

if (!empty($arParams["PAGE_ELEMENT_COUNT"]) )
{
    foreach ($arResult['AMOUNTS'] as $key => $amount)
    {
        if ($arResult['AMOUNTS'][$key]['VALUE'] == $arParams["PAGE_ELEMENT_COUNT"])
            $arResult['AMOUNTS'][$key]['STATE'] = 'selected';
        else
            $arResult['AMOUNTS'][$key]['STATE'] = '';
    }
}


// product available filter
$arResult['AVAILABLE'] = [
    ['NAME' => 'Все', 'STATE'=>'selected'],
    ['NAME' => 'В наличии', 'STATE'=>''],
    ['NAME' => 'Предзаказ', 'STATE'=>''],
    ['NAME' => 'Снято с производства', 'STATE'=>''],
];

if (!empty($arParams["AVAILABLE_TYPE"]) )
{
    foreach ($arResult['AVAILABLE'] as $key => $val)
    {
        if ($key == $arParams["AVAILABLE_TYPE"])
            $arResult['AVAILABLE'][$key]['STATE'] = 'selected';
        else
            $arResult['AVAILABLE'][$key]['STATE'] = '';
    }
}


//VIEW TYPE
if (!in_array($arParams['EXT_VIEW_TYPE'], $arParams['VIEW_TYPES'])) {
    $arParams['EXT_VIEW_TYPE'] = $arParams['VIEW_TYPES'][0];
    $_COOKIE['catalog_view_type'] = $arParams['VIEW_TYPES'][0];
}


//dump($arResult['AMOUNTS']);
$this->includeComponentTemplate();
