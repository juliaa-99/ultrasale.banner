<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
?>
<?php
/**
 * Created by PhpStorm.
 * User: Inkoder
 */

if (!defined('FAV_ID')) {
    define('FAV_ID', 2);
}
if (!defined('CATALOG_ID')) {
    define('CATALOG_ID', 13);
}
global $USER;
$aResult = array('status' => 'ERROR', 'payload' => '');
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
if ($request->isAjaxRequest() && check_bitrix_sessid('sessid'))
{
	if ($_POST['action'] == 'add' || $_POST['action'] == 'del' ) {
		if ($_POST['id'] == (int)$_POST['id']) {
			//Подготовка:
			if (CModule::IncludeModule('highloadblock') && CModule::IncludeModule('iblock'))
			{
				$arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(FAV_ID)->fetch();
				$obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
				$strEntityDataClass = $obEntity->getDataClass();

				if ($_POST['action'] == 'add')
				{
					// Действия при add
					// Определить тип записи. По-умолчанию -
					// Проверить, нет ли уже такого элемента в выбранных
					// Есть - ок, просто ок
					// Нет - добавляем
					$arOrder = array('SORT' => 'ASC');
					$arFilter = array('ACTIVE' => 'Y', 'ID'=>$_POST['id']);
					$arSelectFields = array('ID', 'ACTIVE', 'IBLOCK_ID',);
					$rsElements = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelectFields);
					if ($arElement = $rsElements->GetNext()) {
						// Проверяем наличие этой записи у этого юзера
						$arFilter = array('UF_USER_ID' => $USER->GetID(), 'UF_WARE'=>(int)$_POST['id']);

						$rsData = $strEntityDataClass::getList(array(
							'select' => array('ID', 'UF_WARE', 'UF_TYPE'),
							'order'  => array('UF_DATE_ADD' => 'DESC'),
							'filter' => $arFilter,
						));

						if ($arItem = $rsData->Fetch())
						{
							$aResult['status'] = 'OK'; // Запись уже есть. Просто говорим, что всё хорошо, получаем
                            // количество фавов и выходим

                            $aResult['payload'] = countFavs();
							echo json_encode($aResult);
							die;
						}

						// Добавляем
						$result = $strEntityDataClass::add(array('UF_WARE' => (int)$_POST['id'],
						                                         'UF_USER_ID' => $USER->GetID(),
						                                         'UF_TYPE' => 'self',
						                                         'UF_DATE_ADD' => date('d.m.Y H:i:s')
						));
						if ($result->isSuccess()) {
							$aResult['status'] = 'OK'; // Запись добавили. Просто говорим, что всё хорошо, получаем
                            // количество фавов и выходим

                            $aResult['payload'] = countFavs();
                            echo json_encode($aResult);
							die;
						} else {
							$aResult['payload'] = join(',', $result->getErrorMessages());
						}
					} else {
						$aResult['payload'] = 'Элемент не найден';
					}
				} elseif ($_POST['action'] == 'del') {
					// Действия при del
					// Проверяем, есть ли такой элемент в выбранных
					// Есть - удаляем
					// Нет - сообщаем
					// Проверяем наличие этой записи у этого юзера
					$arFilter = array('UF_USER_ID' => $USER->GetID(), 'UF_WARE'=>(int)$_POST['id']);

					$rsData = $strEntityDataClass::getList(array(
						'select' => array('ID', 'UF_WARE', 'UF_TYPE'),
						'order'  => array('UF_DATE_ADD' => 'DESC'),
						'filter' => $arFilter,
					));

					if ($arItem = $rsData->Fetch())
					{
						$result = $strEntityDataClass::delete($arItem['ID']);
						if ($result->isSuccess()) {
							$aResult['status'] = 'OK'; // Запись есть. Удаляем

                            $aResult['payload'] = countFavs();
							echo json_encode($aResult);
							die;
						} else {
							$aResult['payload'] = join(',', $result->getErrorMessages());
						}

					} else {
						$aResult['payload'] = 'Элемент не найден';
					}
				}
			} else {
				$aResult['payload'] = 'Не установлены нужные модули';
			}
		} else {
			$aResult['payload'] = 'Ошибка идентификатора';
		}
	} else {
		$aResult['payload'] = 'Неопознанное действие';
	}
} else {
	$aResult['payload'] = 'Ошибка сессии';
}

echo json_encode($aResult);