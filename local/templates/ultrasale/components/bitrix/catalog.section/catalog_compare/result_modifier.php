<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();


/**
 * INKODER LOGIC
 * Получаем все разделы, товары из которых добавлены в избранное.
 * Получаем активный раздел. Если нет такого, то активным становится первый.
 * Получаем свойства активного раздела.
 */

$sections = [];
(intval($_REQUEST['category']) !== 0)?$first = intval($_REQUEST['category']): $first = null;

if (!empty($_SESSION['CATALOG_COMPARE_LIST'][CATALOG_IBLOCK]["ITEMS"])) {
    foreach ($_SESSION['CATALOG_COMPARE_LIST'][CATALOG_IBLOCK]["ITEMS"] as $item) {
        if (count($item['SECTIONS_LIST'])) {
            foreach ($item['SECTIONS_LIST'] as $item_section) {

                $item_section = findFirstParentSection($item_section)['ID'];

                if (!isset($sections[$item_section])) {
                    $res = CIBlockSection::GetByID($item_section);
                    $tmp = $res->Fetch();

                    $tmp['Current'] = false;
                    $sections[$item_section] = $tmp;
                    if ($first == null) {
                        $first = $item_section;
                    }
                }
            }
        }
    }
}
$sections[$first]['Current'] = true;
$arResult['Sections'] = $sections;
$arResult['CurrentSection'] = $sections[$first];

$props = getPropertiesForSection($first);
$arResult['Props'] = $props;
