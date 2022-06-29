<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
use Bitrix\Main\Application;
use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

// // redirects
// $link = Application::getInstance()->getContext()->getRequest()->getRequestedPage();
$link = $_SERVER['REQUEST_URI'];

$hlblock = HL\HighloadBlockTable::getById(3)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$rsData = $entity_data_class::getList(array(
    "select" => array("*"),
    "order" => array("ID" => "ASC"),
    "filter" => array("UF_OLD_URL" => $link)
));

if($arData = $rsData->Fetch()){

    // echo '<pre>';
    // var_dump($arData);
    // echo '</pre>';die;

    if(!empty($arData['UF_PRODUCT_ID']))
    {
        $arSelect = array("ID", "DETAIL_PAGE_URL");
        $arFilter = array("ID" => $arData['UF_PRODUCT_ID']);
        $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 1), $arSelect);
        if ($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
        //    dump($arFields['DETAIL_PAGE_URL']);
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$arFields['DETAIL_PAGE_URL']);
            exit();
        }
    }

    if(!empty($arData['UF_SECTION_ID']))
    {
        $arFilter = Array('ID' => $arData['UF_SECTION_ID']);
        $res = CIBlockSection::GetList(array(), $arFilter, false);
        if ($ob = $res->GetNext())
        {
            // dump($ob);
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$ob['SECTION_PAGE_URL']);
            exit();
        }
    }

    if(!empty($arData['UF_NEW_LINK']))
    {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$arData['UF_NEW_LINK']);
        exit();
    }

}
// /redirects


CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
    <div class="https404">
        <div class="container">
            <div class="https404__inner">
                <div class="https404__img"><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/img404.png" alt=""></div>
                <div class="https404__title">К сожалению страница не найдена</div>
                <p>Возможно она была удалена или находится на доработке</p><a class="button button-primary" href="<?=SITE_DIR?>"><span>Вернуться на главную страницу</span></a>
            </div>
        </div>
    </div>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>