<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */

CJSCore::Init(array('fx', 'popup'));

//33 - brand
$GLOBALS['tags'] = $arResult['ITEMS'][33];
foreach ($GLOBALS['tags']['VALUES'] as $val){
    if($val['CHECKED'] == true) {
        $GLOBALS['brand'] = $val;
        break;
    }
}

//$GLOBALS['filter_count'] = 0;
//foreach($arResult['ITEMS'] as $item){
//    if($item['DISPLAY_EXPANDED'] == 'Y'){
//        $GLOBALS['filter_count']++;
//    }
//}
?>