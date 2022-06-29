<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
    return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()

if( $APPLICATION->GetCurPage(false) == '/vacancy/' ||
    $APPLICATION->GetCurPage(false) == '/manufacturer/' ||
    $APPLICATION->GetCurPage(false) == '/guide/' ||
    $APPLICATION->GetCurPage(false) == '/faq/' ||
    $APPLICATION->GetCurPage(false) == '/about/' ||
    $APPLICATION->GetCurPage(false) == '/delivery/'
)
    $white = 'style="background:white;"';


$strReturn .= '<div class="breadcrumb-block" '.$white.'>';
$strReturn .= '<div class="container">';
$strReturn .= '<ol class="breadcrumb">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{

    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);

    if(preg_match("/collection/",$arResult[$index]["LINK"]))continue;

    if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
    {
        $strReturn .= '<li class="breadcrumb-item"><a href="'.$arResult[$index]["LINK"].'">'.$title.'</a></li>';
    }
    else
    {
        $strReturn .= '<li class="breadcrumb-item active" aria-current="page">'.$title.'</li>';
    }
}

$strReturn .= '</ol>';
$strReturn .= '</div>';
$strReturn .= '</div>';

return $strReturn;

