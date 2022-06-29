<?php
global $APPLICATION;
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Контакты");
?>
    <div class="contacts-page">
    <div class="contacts-page__inner">
        <div class="container">
            <h1><?= $APPLICATION->GetTitle(true); ?></h1>
            <div class="contacts-page__holder">
                <div class="contacts-page__info">
                    <a class="contacts-page__tel" href="tel:+7 (495) 120-70-22">+7 (495) 120-70-22</a><a
                            class="contacts-page__tel" href="tel:+7 (495) 969-16-23">+7 (495) 969-16-23</a>
                    <div class="contacts-page__tx">
                        г. Москва, Озерковская набережная, д.50, стр. 1
                    </div>
                    <div class="contacts-page__tx">
                        пн-пт с 9:00 - 18:00
                    </div>
                    <a class="contacts-page__mail" href="mailto:info@ultrasale.ru">info@ultrasale.ru</a>
                    <div class="contacts-page__title">
                        Техническая поддержка
                    </div>
                    <a class="contacts-page__tel" href="tel:+7 (495) 120-70-22">+7 (495) 120-70-22</a>
                    <div class="contacts-page__tx">
                        пн-вс 8:00 - 17:00
                    </div>
                    <a class="contacts-page__mail" href="mailto:ny@ultrasale.ru">ny@ultrasale.ru</a>
                    <div class="contacts-page__tx min">
                        Консультации, подбор оборудования,<br>
                        подбор технических решений
                    </div>
                </div>
                <div class="contacts-page__map">
                    <div id="map">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:map.yandex.view",
                            "",
                            array(
                                "COMPONENT_TEMPLATE" => "affetta",
                                "INIT_MAP_TYPE"      => "MAP",
                                "MAP_DATA"           => "a:4:{s:10:\"yandex_lat\";d:55.73498299998773;s:10:\"yandex_lon\";d:37.640182999999986;s:12:\"yandex_scale\";i:16;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.640183;s:3:\"LAT\";d:55.734952732628;s:4:\"TEXT\";s:161:\"ИСТ - Инженерные системы и технологии.###RN###Москва, Озерковская набережная, д. 50 строение 1\";}}}",
                                "MAP_WIDTH"          => "100%",
                                "MAP_HEIGHT"         => "400",
                                "CONTROLS"           => array(
                                    0 => "ZOOM",
                                    1 => "MINIMAP",
                                    2 => "TYPECONTROL",
                                    3 => "SCALELINE",
                                ),
                                "OPTIONS"            => array(
                                    0 => "ENABLE_SCROLL_ZOOM",
                                    1 => "ENABLE_DBLCLICK_ZOOM",
                                    2 => "ENABLE_DRAGGING",
                                ),
                                "MAP_ID"             => "contact_map1",
                                "API_KEY"            => "9baf28b5-51f8-4059-b89e-ec44944a2795",
                            ),
                            false
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<? $APPLICATION->IncludeComponent(
    "custom:form",
    "inline_app",
    array(
        "ACTIVE"                => "Y",
        "FORM_NAME"             => "Свяжитесь с нами",
        "IBLOCK_ID"             => "5",
        "MAIL_EVENT"            => "FORM_SENDED_2",
        "PROPS"                 => array('NAME', 'PHONE', 'EMAIL', 'FILE', 'MESSAGE,TEXT',),
        "RECAPTCHA_ENABLED"     => "Y",
        "RECAPTCHA_PRIVATE_KEY" => "6LdW0fUcAAAAADOwm4n6TrVJeqD7Xjc-IZDfV5p-",
        "RECAPTCHA_PUBLIC_KEY"  => "6LdW0fUcAAAAAOi-UR9ErNn8w1B2snuNI5wPnkrN",
        "TOKEN"                 => "inline_app001",
    )
); ?>
<?php
$APPLICATION->IncludeFile(
    SITE_DIR . "local/include/about_bits.php",
    array(),
    array("MODE" => "html")
); ?>
<?php
$APPLICATION->IncludeFile(
    SITE_DIR . "local/include/company_details.php",
    array(),
    array("MODE" => "html")
); ?>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
