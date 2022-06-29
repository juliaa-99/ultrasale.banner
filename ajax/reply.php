<?php
/**
 * Created by PhpStorm.
 * For: ultrasale
 * User: Sergey Akulov (sergey.a.akulov@gmail.com)
 */
/**
 * @var $APPLICATION
 */

if (!defined('REPLY_IBLOCK')) {
    define('REPLY_IBLOCK', 16);
}

include_once $_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/main/include/prolog_before.php';
$result = [
    'status' => 'ERROR',
    'text' => '',
];

use Bitrix\Main\Loader;

Loader::includeModule("iblock");

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
if ($request->isAjaxRequest()) {
    if ($request->getPost('sessid') && check_bitrix_sessid('sessid')) {
        if ($request->getPost('name') && $request->getPost('comment') && $request->getPost('rate')) {
            if (!empty($request->getPost('ware'))) {
                $element = new CIBlockElement();
                $properties = ['RATE'=>$request->getPost('rate'),'WARE'=>$request->getPost('ware')];
                $elementData = [
                    'NAME'              =>  $request->getPost('name'),
                    'IBLOCK_ID'         =>  REPLY_IBLOCK,
                    'PREVIEW_TEXT'      =>  $request->getPost('comment'),
                    'ACTIVE'            =>  'N',
                    'IBLOCK_SECTION_ID' =>  false,
                    'PROPERTY_VALUES'   => $properties
                ];
                if ($id = $element->Add($elementData)) {
                    $result['status'] = 'OK';
                    $result['text'] = '';
                } else {
                    $result['status'] = 'ERROR';
                    $result['text'] = 'Ошибка базы данных!';
                }
            } else {
                $result['status'] = 'ERROR';
                $result['text'] = 'Не указан товар';
            }
        } else {
            $result['status'] = 'ERROR';
            $result['text'] = 'Необходимо заполнить все поля';
        }
    } else {
        $result['status'] = 'ERROR';
        $result['text'] = 'Ошибка сессии';
    }
} else {
    $result['status'] = 'ERROR';
    $result['text'] = 'Неверный тип запроса';
}

echo json_encode($result);