<?php
global $APPLICATION;
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Вакансии");
?>
<div class="vacancies-page">
    <div class="vacancies-page__inner">
        <div class="container">
            <h1><?=$APPLICATION->GetTitle(true);?></h1>
            <div class="statistics statistics-big">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="statistics__item bg1">
                            <div class="statistics__item-tx">Огромный опыт, <br>накопленный за годы</div>
                            <div class="statistics__item-numb">
                                <div class="statistics__item-numb-nb">15</div>
                                <div class="statistics__item-numb-tx">лет на рынке</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="statistics__item bg2">
                            <div class="statistics__item-tx">Клиентоориентированность <br>и повышение уровня качества</div>
                            <div class="statistics__item-numb">
                                <div class="statistics__item-numb-nb">1200</div>
                                <div class="statistics__item-numb-tx">проектов</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="statistics__item bg3">
                            <div class="statistics__item-tx">Квалифицированные <br>специалисты</div>
                            <div class="statistics__item-numb">
                                <div class="statistics__item-numb-nb">45</div>
                                <div class="statistics__item-numb-tx">сотрудников</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vacancies-inf">
                <div class="row">
                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                        <div class="vacancies-about">
                            <div class="vacancies-about__title">Работа у нас</div>
                            <p>Наша компания активно растет и развивается, а значит, у нас появляются новые интересные вакансии! Если Вы энергичны и целеустремленны, уверены в себе, настроены на профессиональное развитие и хотите добиться выдающихся успехов в карьере - будем рады видеть Вас в нашей команде!</p>
                            <ul>
                                <li>Гарантируем достойную оплату и интересную работу.</li>
                                <li>Так же можем рассмотреть кандидатуры выпускников профильных ВУЗов.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                        <div class="vacancies-info">
                            <div class="vacancies-info__item">
                                <div class="vacancies-about__title">Отдел кадров:</div>
                                <p>Напишите нам на почту или договоритесь о беседе с HR менеджером по телефону.</p>
                            </div>
                            <div class="vacancies-info__item">
                                <div class="vacancies-info__title">Свяжитесь с нами</div><a class="vacancies-info__tel" href="tel:+74951207022">+7 (495) 120-70-22</a><a class="vacancies-info__mail" href="mailto:info@ultrasale.ru">info@ultrasale.ru</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "vacancy",
                array(
                    "DISPLAY_DATE"                    => "N",
                    "DISPLAY_NAME"                    => "Y",
                    "DISPLAY_PICTURE"                 => "Y",
                    "DISPLAY_PREVIEW_TEXT"            => "N",
                    "AJAX_MODE"                       => "N",
                    "IBLOCK_TYPE"                     => "ultrasale",
                    "IBLOCK_ID"                       => "10",
                    "NEWS_COUNT"                      => "5",
                    "SORT_BY1"                        => "SORT",
                    "SORT_ORDER1"                     => "DESC",
                    "SORT_BY2"                        => "NAME",
                    "SORT_ORDER2"                     => "ASC",
                    "FILTER_NAME"                     => "",
                    "FIELD_CODE"                      => array("ID", 'CODE', 'NAME'),
                    "PROPERTY_CODE"                   => array("RESPONSIBILITIES","REQUIREMENTS","CONDITIONS"),
                    "CHECK_DATES"                     => "Y",
                    "DETAIL_URL"                      => "",
                    "PREVIEW_TRUNCATE_LEN"            => "",
                    "ACTIVE_DATE_FORMAT"              => "d.m.Y",
                    "SET_TITLE"                       => "N",
                    "SET_BROWSER_TITLE"               => "N",
                    "SET_META_KEYWORDS"               => "N",
                    "SET_META_DESCRIPTION"            => "N",
                    "SET_LAST_MODIFIED"               => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN"       => "N",
                    "ADD_SECTIONS_CHAIN"              => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL"        => "N",
                    "PARENT_SECTION"                  => "",
                    "PARENT_SECTION_CODE"             => "",
                    "INCLUDE_SUBSECTIONS"             => "N",
                    "CACHE_TYPE"                      => "A",
                    "CACHE_TIME"                      => "3600",
                    "CACHE_FILTER"                    => "Y",
                    "CACHE_GROUPS"                    => "Y",
                    "DISPLAY_TOP_PAGER"               => "Y",
                    "DISPLAY_BOTTOM_PAGER"            => "Y",
                    "PAGER_TITLE"                     => "Вакансии",
                    "PAGER_SHOW_ALWAYS"               => "N",
                    "PAGER_TEMPLATE"                  => "",
                    "PAGER_DESC_NUMBERING"            => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL"                  => "N",
                    "PAGER_BASE_LINK_ENABLE"          => "N",
                    "SET_STATUS_404"                  => "N",
                    "SHOW_404"                        => "N",
                    "MESSAGE_404"                     => "",
                    "PAGER_BASE_LINK"                 => "",
                    "PAGER_PARAMS_NAME"               => "arrPager",
                    "AJAX_OPTION_JUMP"                => "N",
                    "AJAX_OPTION_STYLE"               => "N",
                    "AJAX_OPTION_HISTORY"             => "N",
                    "AJAX_OPTION_ADDITIONAL"          => "",
                    "FANCYBOX_ID"                     => "",
                )
            );
            ?>
            <div class="vacancies-dr">
                <div class="vacancies-dr__text">
                    <div class="vacancies-dr__title">Оставьте свое <i>резюме</i></div>
                    <div class="vacancies-dr__tx">Заполните форму и мы с вами обязательно свяжемся</div>
                </div>
                <button class="button button-primary" type="submit" data-toggle="modal" data-target="#modalRv"><span>Откликнуться</span></button>
            </div>
        </div>
    </div>
</div>
<?php
$APPLICATION->IncludeComponent(
    "custom:form",
    "inline_app",
    array(
        'IBLOCK_ID'             => '5',
        'MAIL_EVENT'            => 'FORM_SENDED_2',
        'RECAPTCHA_ENABLED'     => 'Y',
        'RECAPTCHA_PUBLIC_KEY'  => '6LdW0fUcAAAAAOi-UR9ErNn8w1B2snuNI5wPnkrN',
        'RECAPTCHA_PRIVATE_KEY' => '6LdW0fUcAAAAADOwm4n6TrVJeqD7Xjc-IZDfV5p-',
        'ACTIVE'                => 'Y',
        'TOKEN'                 => 'inline_app001',
        'FORM_NAME'             => 'Свяжитесь с нами',
        'PROPS'                 => array(
            'NAME', // type - string
            'PHONE', // type - string
            'EMAIL', // type - string
            'FILE', // type - string
            'MESSAGE,TEXT', // type - html/text
        ),
    )
); ?>
<?php
$APPLICATION->IncludeFile(
    SITE_DIR . "local/include/about_bits.php",
    array(),
    array("MODE" => "html")
); ?>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
