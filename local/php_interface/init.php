<?php
/**
 * Created by PhpStorm.
 * Date: 08.11.2021
 */
global $config;
CModule::IncludeModule('ion');
$config['phoneSanitized'] = Ion\Settings::getSpaceField("UF_PHONE", "MAIN");

$config['phone'] = Ion\Settings::getSpaceField("UF_PHONE", "MAIN");
$config['phone'] = str_replace(" ","",$config['phone']);
$config['phone'] = str_replace("(","",$config['phone']);
$config['phone'] = str_replace(")","",$config['phone']);
$config['phone'] = str_replace("-","",$config['phone']);
$config['phone'] = $config['phone'];

$config['email'] = Ion\Settings::getSpaceField("UF_EMAIL", "MAIN");
$config['work_time'] = Ion\Settings::getSpaceField("UF_WORK_TIME", "MAIN");
$config['address'] = Ion\Settings::getSpaceField("UF_ADDRESS", "MAIN");

/** Соц. сети */
$config['soc_instagram'] = Ion\Settings::getSpaceField("UF_INSTAGRAM", "MAIN");
$config['soc_facebook'] = Ion\Settings::getSpaceField("UF_FACEBOOK", "MAIN");

/** Реквизиты для скачивания */
$config['requisites'] = Ion\Settings::getSpaceField("UF_REQUISITES", "MAIN");
if ((int)$config['requisites'] != 0) {
    $config['requisites'] = CFile::GetPath($config['requisites']);
}

$config['SECTION_TO_CONSULT'] = [
    'chillery-i-fankoyly',
    'oborudovanie-dlya-ventilyatsii',
];
include_once ('helpers.php');
include_once ('events.php');