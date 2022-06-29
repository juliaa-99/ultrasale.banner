<?php
/**
 * Created by PhpStorm.
 * For: ultrasale
 * User: Sergey Akulov (sergey.a.akulov@gmail.com)
 * Date: 18.12.2021
 *

 */

namespace Custom;

use Bitrix\Main\Application,
    Bitrix\Main\Loader,
    Bitrix\Main\Mail\Event,
    CBitrixComponent,
    CFile,
    CIBlockElement;

class CustomList extends CBitrixComponent
{
    public function executeComponent()
    {

        global $APPLICATION;
        $request = Application::getInstance()->getContext()->getRequest();

        if (empty($this->arParams['IBLOCK_TYPE'])) {
            echo "Не указан тип инфоблока!";

            return;
        }
        if (empty($this->arParams['IBLOCK_ID'])) {
            echo "Не указан инфоблок!";

            return;
        }
        $arOrder = array('SORT' => 'ASC');
        $arFilter = array(
            'ACTIVE'      => 'Y',
            'IBLOCK_TYPE' => $this->arParams['IBLOCK_TYPE'],
            'IBLOCK_ID'   => (int)$this->arParams['IBLOCK_ID'],
        );
        if (is_iterable($GLOBALS[$this->arParams['FILTER_NAME']]) && $GLOBALS[$this->arParams['FILTER_NAME']] != null) {
            $arFilter = array_merge($arFilter, $GLOBALS[$this->arParams['FILTER_NAME']]);
        }
        $arSelectFields = array('ID', 'DETAIL_PAGE_URL', 'SECTION_PAGE_URL');
        if (is_iterable($this->arParams['SELECT_FIELDS']) && $this->arParams['SELECT_FIELDS'] != null) {
            $arSelectFields = array_merge($arSelectFields, $this->arParams['SELECT_FIELDS']);
        }

        $rsElements = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelectFields);
        while ($arElement = $rsElements->GetNext()) {

            if (ord(substr($arElement['NAME'], 0, 1)) >= 48 && ord(substr($arElement['NAME'], 0, 1)) <= 57) {
                $this->arResult['ItemsByLetter']['dgt'][] = $arElement;
            } elseif (ord(substr($arElement['NAME'], 0, 1)) > 90) {
                $this->arResult['ItemsByLetter']['cyr'][] = $arElement;
            } else {
                $this->arResult['ItemsByLetter'][chr(ord(substr($arElement['NAME'], 0, 1)))][] = $arElement;
            }
        }

        $rsElementsEx = CIBlockElement::GetList($arOrder, [
            'ACTIVE'      => 'Y',
            'IBLOCK_TYPE' => $this->arParams['IBLOCK_TYPE'],
            'IBLOCK_ID'   => (int)$this->arParams['IBLOCK_ID'],
        ], false, false, $arSelectFields);
        while ($arElementEx = $rsElementsEx->GetNext()) {

            if (ord(substr($arElementEx['NAME'], 0, 1)) >= 48 && ord(substr($arElementEx['NAME'], 0, 1)) <= 57) {
                $this->arResult['ItemsByLetterEx']['dgt'][] = $arElementEx;
            } elseif (ord(substr($arElementEx['NAME'], 0, 1)) > 90) {
                $this->arResult['ItemsByLetterEx']['cyr'][] = $arElementEx;
            } else {
                $this->arResult['ItemsByLetterEx'][chr(ord(substr($arElementEx['NAME'], 0, 1)))][] = $arElementEx;
            }
        }

        $this->arResult['Toc'] = [];
        $this->arResult['Toc'][] = ['value' => 'Все', 'link' => 'all'];
        $this->arResult['Toc'][] = ['value' => '0-9', 'link' => 'dgt'];
        for ($int = ord('A'); $int <= ord('Z'); $int++) {
            $this->arResult['Toc'][] = ['value' => chr($int), 'link' => chr($int)];
        }
        $this->arResult['Toc'][] = ['value' => 'А-Я', 'link' => 'cyr'];

        $this->includeComponentTemplate();
    }
}