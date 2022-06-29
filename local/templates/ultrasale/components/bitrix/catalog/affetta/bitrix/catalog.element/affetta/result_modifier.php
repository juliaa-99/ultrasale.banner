<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 * @var $arResult
 */

//if (!defined('BRANDS_IBLOCK')) {
//    /**
//     * Инфоблок брендов
//     */
//    define ('BRANDS_IBLOCK', 14);
//}


$arSize['PREVIEW'] = ['width'=>76, 'height'=>48];
$arSize['MAIN'] = ['width'=>480, 'height'=>418];
$arSize['FULL'] = ['width'=>1920, 'height'=>1920];
$arResult['MorePhotoPrev'] = [];
$arResult['MorePhotoMain'] = [];
$arResult['MorePhotoFull'] = [];
$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
if (!empty($arResult['DETAIL_PICTURE'])) {
    $aTmp = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], $arSize['PREVIEW']);
    $aTmp['alt'] = $arResult['DETAIL_PICTURE']['ALT'];
    $aTmp['title'] = $arResult['DETAIL_PICTURE']['TITLE'];
    $arResult['MorePhotoPrev'][] = $aTmp;
    unset($aTmp);
    $aTmp = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], $arSize['MAIN']);
    $aTmp['alt'] = $arResult['DETAIL_PICTURE']['ALT'];
    $aTmp['title'] = $arResult['DETAIL_PICTURE']['TITLE'];
    $arResult['MorePhotoMain'][] = $aTmp;
    unset($aTmp);
    $aTmp = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], $arSize['FULL']);
    $aTmp['alt'] = $arResult['DETAIL_PICTURE']['ALT'];
    $aTmp['title'] = $arResult['DETAIL_PICTURE']['TITLE'];
    $arResult['MorePhotoFull'][] = $aTmp;
    unset($aTmp);

}
foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key=>$photo) {
    $aTmp = CFile::ResizeImageGet($photo, $arSize['PREVIEW']);
    $aTmp['alt'] = $arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key];
    $aTmp['title'] = $arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key];
    $arResult['MorePhotoPrev'][] = $aTmp;
    unset($aTmp);
    $aTmp = CFile::ResizeImageGet($photo, $arSize['MAIN']);
    $aTmp['alt'] = $arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key];
    $aTmp['title'] = $arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key];
    $arResult['MorePhotoMain'][] = $aTmp;
    unset($aTmp);
    $aTmp = CFile::ResizeImageGet($photo, $arSize['FULL']);
    $aTmp['alt'] = $arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key];
    $aTmp['title'] = $arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key];
    $arResult['MorePhotoFull'][] = $aTmp;
    unset($aTmp);
}

foreach ($arResult['PROPERTIES']['SRV_INSTR']['VALUE'] as $element) {

    $arOrder = array('SORT' => 'ASC');
    $arFilter = array('ACTIVE'=>'Y','IBLOCK_ID'=>$arResult['PROPERTIES']['SRV_INSTR']['LINK_IBLOCK_ID'], 'ID'=>$element);
    $arSelectFields = array('ID', 'ACTIVE', 'NAME', 'PROPERTY_INSTRUCTION_FILE');
    $rsElements = CIBlockElement::GetList($arOrder, $arFilter, FALSE, FALSE, $arSelectFields);
    if ($arElement = $rsElements->GetNext())
    {
        $tmp = CFile::GetFileArray($arElement['PROPERTY_INSTRUCTION_FILE_VALUE']);
        $tmp['CAPTION'] = $arElement['PROPERTY_INSTRUCTION_FILE_DESCRIPTION'];
        $tmp['HumanReadableSize'] = CFile::FormatSize($tmp['FILE_SIZE']);
        $arResult['PROPERTIES']['SrvInstr'][] = $tmp;
    }
}

/* Обрабатываем бренды */
if(!empty($arResult['PROPERTIES']['BRAND']['VALUE'])) {
    $arOrder = array('SORT' => 'ASC');
    $arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => BRANDS_IBLOCK, 'ID' => $arResult['PROPERTIES']['BRAND']['VALUE']);
    $arSelectFields = array('ID', 'ACTIVE', 'NAME', 'DETAIL_PAGE_URL');
    $rsElements = CIBlockElement::GetList($arOrder, $arFilter, FALSE, FALSE, $arSelectFields);
    if ($arElement = $rsElements->GetNext()) {
        $arResult['PROPERTIES']['Brand']['NAME'] = $arElement['NAME'];
        $arResult['PROPERTIES']['Brand']['SRC'] = $arElement['DETAIL_PAGE_URL'];
    }
}

/* Обрабатываем серии */
if(!empty($arResult['PROPERTIES']['SERIAS3']['VALUE'])) {
    $arOrder = array('SORT' => 'ASC');
    $arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => SERIAS_IBLOCK, 'ID' => $arResult['PROPERTIES']['SERIAS3']['VALUE']);
    $arSelectFields = array('ID', 'ACTIVE', 'NAME', 'DETAIL_PAGE_URL');
    $rsElements = CIBlockElement::GetList($arOrder, $arFilter, FALSE, FALSE, $arSelectFields);

    if ($arElement = $rsElements->GetNext()) {
        $arResult['PROPERTIES']['Seria']['NAME'] = $arElement['NAME'];
        $arResult['PROPERTIES']['Seria']['SRC'] = $arElement['DETAIL_PAGE_URL'];
    }
}

/*Доп кнопка*/
$arResult['MiscButton']['text'] = 'Нужен монтаж?';
$arResult['MiscButton']['modal'] = '#need_mounting';
if (in_array($arResult['ORIGINAL_PARAMETERS']['SECTION_CODE'], $GLOBALS['config']['SECTION_TO_CONSULT'])) {
    $arResult['MiscButton']['text'] = 'Заказать консультацию';
    $arResult['MiscButton']['modal'] = '#consult';
}
