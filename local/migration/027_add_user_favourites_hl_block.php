<?php
/**
 * Created by PhpStorm.
 * User: Inkoder
 */
/**
 * Миграция добавляет Highload инфоблок USER_FAVOURITES и таблицу b_hl_user_favs
 * USER_TYPE_ID:
hlblock - привязка к элементам highload-блоков
SETTINGS:
HLBLOCK_ID => id-хайлоад блока
HLFIELD_ID => id поля связи. В данном случае ID;
enumeration - Список
double - Число
integer - Целое число
boolean - Да/Нет
string - Строка
file - Файл
video - Видео
datetime - Дата/Время
iblock_section - Привязка к разделам инф. блоков
iblock_element - Привязка к элементам инф. блоков
string_formatted - Шаблон
crm - Привязка к элементам CRM
crm_status - Привязка к справочникам CRM
 */
define('BX_BUFFER_USED', true);
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_STATISTIC', true);
define('STOP_STATISTICS', true);
define('SITE_ID', 's1');

$_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/../../');

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

error_reporting(E_ALL);
ini_set('display_errors', 0);
set_time_limit(0);
ignore_user_abort(true);

while (ob_get_level()) {
	ob_end_flush();
}

\Bitrix\Main\Loader::includeModule('highloadblock');

use Bitrix\Highloadblock as HL;


$sIblockName = 'UserFavourite';
$sIblockTableName = 'b_hl_user_fav';

$iblockType = 'ultrasale';
$iblockId = 13;

/**
 * Делаем проверку на существование такого инфоблока
 */
$mResult = HL\HighloadBlockTable::getList(array('filter'=>array('NAME'=>$sIblockName)))->fetch();
if ($mResult) {
    $iId = $mResult['ID'];
	echo sprintf('Highload-инфоблок %s уже существует. Его идентификатор "%u"<br />' . PHP_EOL, $sIblockName, $iId);
	die();
}

/**
 * Такого инфоблока нет. Продолжаем.
 */

/** Параметры инфоблока */
$arFields = array(
	'NAME'                  => $sIblockName,
	'TABLE_NAME'            => $sIblockTableName,
);


/**
 * Поехали, добавляем
 */
$result = HL\HighloadBlockTable::add($arFields);
if (!$result->isSuccess()) {
	echo sprintf('Не удалось добавить Highload-инфоблок %s.<br >'.PHP_EOL.' Ошибка %s',$arFields['NAME'], join('<br />'.PHP_EOL,$result->getErrorMessages()));
} else {
	$iId = $result->getId();
	echo sprintf('Highload-инфоблок %s успешно добавлен. <br><b>Не забудь добавить идентификатор "%u" в конфиг</b><br />' . PHP_EOL, $arFields['NAME'], $iId);
}

if (isset($iId) && $iId>0) {

// Объявляю массив добавляемых пользовательских свойств
	$aUserFields = array(

		array(
			'ENTITY_ID'         => 'HLBLOCK_' . $iId,
			'FIELD_NAME'        => 'UF_USER_ID',
			'USER_TYPE_ID'      => 'integer',
			'XML_ID'            => 'UF_USER_ID',
			'SORT'              => 50,
			'MULTIPLE'          => 'N',
			'MANDATORY'         => 'Y',
			'SHOW_FILTER'       => 'N',
			'SHOW_IN_LIST'      => 'Y',
			'EDIT_IN_LIST'      => 'Y',
			'IS_SEARCHABLE'     => 'N',
			'EDIT_FORM_LABEL'   => array(
				'ru' => 'Пользователь',
				'en' => 'User',
			),
			'LIST_COLUMN_LABEL' => array(
				'ru' => 'Пользователь',
				'en' => 'User',
			),
			'LIST_FILTER_LABEL' => array(
				'ru' => 'Пользователь',
				'en' => 'User',
			),
			'HELP_MESSAGE'      => array(
				'ru' => '',
				'en' => '',
			),
		),
		array(
			'ENTITY_ID'         => 'HLBLOCK_' . $iId,
			'FIELD_NAME'        => 'UF_TYPE',
			'USER_TYPE_ID'      => 'string',
			'XML_ID'            => 'UF_TYPE',
			'SORT'              => 100,
			'MULTIPLE'          => 'N',
			'MANDATORY'         => 'Y',
			'SHOW_FILTER'       => 'N',
			'SHOW_IN_LIST'      => 'Y',
			'EDIT_IN_LIST'      => 'Y',
			'IS_SEARCHABLE'     => 'N',
			'SETTINGS'          => array(
				'DEFAULT_VALUE' => 'self',
			),
			'EDIT_FORM_LABEL'   => array(
				'ru' => 'Способ добавления',
				'en' => 'Added by',
			),
			'LIST_COLUMN_LABEL' => array(
				'ru' => 'Способ добавления',
				'en' => 'Added by',
			),
			'LIST_FILTER_LABEL' => array(
				'ru' => 'Способ добавления',
				'en' => 'Added by',
			),
			'HELP_MESSAGE'      => array(
				'ru' => 'self,auto',
				'en' => 'self,auto',
			),
		),
		array(
			'ENTITY_ID'         => 'HLBLOCK_' . $iId,
			'FIELD_NAME'        => 'UF_DATE_ADD',
			'USER_TYPE_ID'      => 'datetime',
			'XML_ID'            => 'UF_DATE_ADD',
			'SORT'              => 150,
			'MULTIPLE'          => 'N',
			'MANDATORY'         => 'N',
			'SHOW_FILTER'       => 'N',
			'SHOW_IN_LIST'      => 'Y',
			'EDIT_IN_LIST'      => 'Y',
			'IS_SEARCHABLE'     => 'N',
			'SETTINGS'          => array(
				'DEFAULT_VALUE' => 'NOW',
			),
			'EDIT_FORM_LABEL'   => array(
				'ru' => 'Дата, время',
				'en' => 'Date time',
			),
			'LIST_COLUMN_LABEL' => array(
				'ru' => 'Дата, время',
				'en' => 'Date time',
			),
			'LIST_FILTER_LABEL' => array(
				'ru' => 'Дата, время',
				'en' => 'Date time',
			),
			'HELP_MESSAGE'      => array(
				'ru' => '',
				'en' => '',
			),
		),
		array(
			'ENTITY_ID'         => 'HLBLOCK_' . $iId,
			'FIELD_NAME'        => 'UF_WARE',
			'USER_TYPE_ID'      => 'iblock_element',
			'XML_ID'            => 'UF_WARE',
			'SORT'              => 250,
			'MULTIPLE'          => 'N',
			'MANDATORY'         => 'N',
			'SHOW_FILTER'       => 'N',
			'SHOW_IN_LIST'      => 'Y',
			'EDIT_IN_LIST'      => 'Y',
			'IS_SEARCHABLE'     => 'N',
			'SETTINGS'          => array(
				'IBLOCK_TYPE_ID' => $iblockType,
				'IBLOCK_ID'		=> $iblockId,
				'ACTIVE_FILTER'	=> 'Y',
			),
			'EDIT_FORM_LABEL'   => array(
				'ru' => 'Товар',
				'en' => 'Ware',
			),
			'LIST_COLUMN_LABEL' => array(
                'ru' => 'Товар',
                'en' => 'Ware',
			),
			'LIST_FILTER_LABEL' => array(
                'ru' => 'Товар',
                'en' => 'Ware',
			),
			'HELP_MESSAGE'      => array(
				'ru' => '',
				'en' => '',
			),
		),

	);


	/**
	 * Добавление пользовательского свойства
	 */
//Класс для работы с пользовательскими свойствами
	$oUserTypeEntity = new CUserTypeEntity();
	foreach ($aUserFields as $aUserField) {
		/**
		 * Проверяем наличие этого свойства
		 */
		if (!($arRes = CUserTypeEntity::GetList(array('sort' => 'asc'), array(
			"ENTITY_ID"  => $aUserField['ENTITY_ID'],
			'FIELD_NAME' => $aUserField['FIELD_NAME'],
		))->Fetch())
		) {
			$iUserFieldId = $oUserTypeEntity->Add($aUserField);
			if ($iUserFieldId) {
				echo sprintf('Свойство "%s" успешно добавлено. Идентфикатор %u <br>' . PHP_EOL,
					$aUserField['FIELD_NAME'],
					$iUserFieldId);
			} else {
				echo sprintf('Ошибка, пользовательское поле "%s" не добавлено <br>' . PHP_EOL,
					$aUserField['FIELD_NAME']
				);
			}


		} else {
			echo sprintf('Свойство "%s" уже существует. Идентификатор "%u" <br >' . PHP_EOL,
				$aUserField['FIELD_NAME'],
				$arRes['ID']
			);
		}
	}

} else {

	echo sprintf('Не удалось добавить Highload-инфоблок %s.<br >'.PHP_EOL.' Ошибка %s',$arFields['NAME'], join('<br />'.PHP_EOL,$result->getErrorMessages()));
}

