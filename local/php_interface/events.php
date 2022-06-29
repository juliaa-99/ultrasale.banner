<?php

AddEventHandler("sale", "OnOrderNewSendEmail", "bxModifySaleMails");
function bxModifySaleMails($orderID, &$eventName, &$arFields)
{
  $arOrder = CSaleOrder::GetByID($orderID);

    // AddMessage2Log(print_r($arOrder, true), "post_event");  

  $order_props = CSaleOrderPropsValue::GetOrderProps($orderID);
  while ($arProps = $order_props->Fetch()){   

    // телефон
    if ($arProps['ORDER_PROPS_ID']==2){
       if($arProps['VALUE']){
            $arFields["PHONE"] = $arProps['VALUE'];
       }
    }

    // адрес
    if ($arProps['ORDER_PROPS_ID']==4){
       if($arProps['VALUE']){
            $arFields["ADDRESS"] = $arProps['VALUE'];
       }
    }

    // доставка
    $arDeliv = CSaleDelivery::GetByID($arOrder["DELIVERY_ID"]);
    if ($arDeliv)
    {
        $arFields["DELIVERY"] = $arDeliv["NAME"]; 
    }


    // оплата
    $arPaySystem = CSalePaySystem::GetByID($arOrder["PAY_SYSTEM_ID"]);
    if ($arPaySystem)
    {
        $arFields["PAY"] = $arPaySystem["NAME"];
    }

  }
}


// namespace Affetta;

// use Bitrix\Main\Loader;

// if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
//     die();
// }


/**
 * Created by PhpStorm.
 * For: ultrasale
 * User: Sergey Akulov (sergey.a.akulov@gmail.com)
 */
// if (!defined('CATALOG_IBLOCK')) {
//     define('CATALOG_IBLOCK', 13);
// }

// Loader::includeModule('iblock');

// use CIBlockElement;

// \Bitrix\Main\EventManager::getInstance()->addEventHandler(
//     'sale',
//     'OnSaleOrderSaved',
//     '\Affetta\SaleOrder::onSaleOrderSaved'
// );

// class SaleOrder
// {

//     /**
//      * @throws \Bitrix\Main\NotImplementedException
//      * @throws \Bitrix\Main\ArgumentNullException
//      * @throws \Bitrix\Main\ArgumentOutOfRangeException
//      * @throws \Bitrix\Main\ArgumentException
//      */
//     function onSaleOrderSaved(\Bitrix\Main\Event $event)
//     {
//         if (!$event->getParameter("IS_NEW")) {
//             return;
//         }

//         $item = false;
//         $allowPay = true;

//         /** @var \Bitrix\Sale\Order $order */
//         $order = $event->getParameter("ENTITY");

//         $orderStatusesAllow = \Bitrix\Sale\OrderStatus::getAllowPayStatusList();
//         $orderStatusesReject = \Bitrix\Sale\OrderStatus::getDisallowPayStatusList();


//         $basket = \Bitrix\Sale\Order::load($order->getId())->getBasket();
//         $basketItems = $basket->getBasketItems();
//         foreach ($basketItems as $basketItem) {
//             $item[] = $basketItem->getProductId();
//         }

//         $arOrder = array('SORT' => 'ASC');
//         $arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => CATALOG_IBLOCK, 'ID' => $item);
//         $arSelectFields = array('ID', 'PROPERTY_SRV_PAY_AVAILABLE');
//         $rsElements = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelectFields);
//         while ($arElement = $rsElements->GetNext()) {
//             $allowPay = $allowPay && $arElement['PROPERTY_SRV_PAY_AVAILABLE_VALUE'] == 'Да';
//         }

//         if ($allowPay) {
//             $order->setField('STATUS_ID', $orderStatusesAllow[0]);
//         } else {
//             $order->setField('STATUS_ID', $orderStatusesReject[1]);
//         }

//         $order->save();
//         $event->addResult(
//             new \Bitrix\Main\EventResult(
//                 \Bitrix\Main\EventResult::SUCCESS, $order
//             )
//         );
//     }

// }