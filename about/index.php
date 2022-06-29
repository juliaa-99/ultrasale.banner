<?php
global $APPLICATION;
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("О компании");
?>
<div class="about-page">
    <div class="about-page__inner">
        <div class="container">
          <h1><?=$APPLICATION->GetTitle(true);?></h1>
          <div class="about-page__inf">
            <div class="about-page__inf-title">Компания «Инженерные Системы и Технологии» (ООО « ИСТ»)<br> ведёт свою историю с 2004 года</div>
            <div class="about-page__inf-tx">В то время это была небольшая фирма, специализирующаяся на интернет продажах климатической техники.<br> Постепенно сформировалась монтажная служба, появились проектные и сервисные подразделения.<br> Последние десять лет ООО « ИСТ» является инжиниринговой компанией, оказывающей комплексные услуги по<br> оснащению системами отопления, вентиляции, кондиционирования и холодоснабжения жилых,<br> общественных и производственных зданий (помещений).</div>
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
            <div class="about-page__inf-inner">
              <div class="about-page__inf-left">
                <div class="about-page__inf-left-inner">
                  <div class="about-page__inf-left-title">ООО «ИСТ»</div>
                  <div class="about-page__inf-left-list">
                    <div class="about-page__inf-left-list-item">
                      <div class="about-page__inf-left-list-icon"><img
                              src="<?=SITE_TEMPLATE_PATH?>/assets/images/svg/ab-icon1.svg" alt=""></div>
                      <div class="about-page__inf-left-list-tx"><b>Квалифицированные специалисты</b> – залогом успешной работы служит наличие в штате квалифицированных специалистов, равно как и огромный опыт, накопленный за последние годы. Кроме того, специалисты компании постоянно проходят дополнительное обучение в учебных центрах и на курсах, организуемых ведущими производителями и поставщиками климатической техники.</div>
                      <div class="about-page__inf-left-list-btn"><span class="op">Читать больше</span><span class="cl">Скрыть</span></div>
                    </div>
                    <div class="about-page__inf-left-list-item">
                      <div class="about-page__inf-left-list-icon"><img
                              src="<?=SITE_TEMPLATE_PATH?>/assets/images/svg/ab-icon2.svg" alt=""></div>
                      <div class="about-page__inf-left-list-tx"><b>Огромное количество проектов</b> – за прошедшее время реализовано огромное количество проектов, часть из которых представлена в нашей <b>фотогалерее</b>. Важным показателем качества нашей работы, мы считаем повторные обращения наших клиентов, а также обращения по рекомендациям друзей/знакомых.</div>
                      <div class="about-page__inf-left-list-btn"><span class="op">Читать больше</span><span class="cl">Скрыть</span></div>
                    </div>
                    <div class="about-page__inf-left-list-item">
                      <div class="about-page__inf-left-list-icon"><img
                              src="<?=SITE_TEMPLATE_PATH?>/assets/images/svg/ab-icon3.svg" alt=""></div>
                      <div class="about-page__inf-left-list-tx"><b>Повышение квалификации</b> – клиентоориентированность и постоянная работа над повышением качества оказываемых услуг являются приоритетами компании.</div>
                      <div class="about-page__inf-left-list-btn"><span class="op">Читать больше</span><span class="cl">Скрыть</span></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="about-page__inf-right"><a class="about-page__inf-video" href="https://youtu.be/CI91X5qsk-0"
                                                    data-fancybox style="background-image: url('<?=SITE_TEMPLATE_PATH?>/assets/images/video-img.jpg')"><span
                          class="inner"><span class="title">Видео о компании</span><span class="size">1 мин 13
                              сек</span></span></a></div>
            </div><!-- div.about-page__inf-text
<p>Компания «Инженерные Системы и Технологии» (ООО « ИСТ») ведёт свою историю с 2004 года. В то время это была небольшая фирма, специализирующаяся на интернет продажах климатической техники. Постепенно сформировалась монтажная служба, появились проектные и сервисные подразделения. Последние десять лет ООО « ИСТ» является инжиниринговой компанией, оказывающей комплексные услуги по оснащению системами отопления, вентиляции, кондиционирования и холодоснабжения жилых, общественных и производственных зданий (помещений).--></p>
          </div>
        </div>
      </div>
    </div>
<?php
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "clients",
    array(
        "DISPLAY_DATE"                    => "N",
        "DISPLAY_NAME"                    => "Y",
        "DISPLAY_PICTURE"                 => "Y",
        "DISPLAY_PREVIEW_TEXT"            => "N",
        "AJAX_MODE"                       => "N",
        "IBLOCK_TYPE"                     => "ultrasale",
        "IBLOCK_ID"                       => "7",
        "NEWS_COUNT"                      => "16",
        "SORT_BY1"                        => "SORT",
        "SORT_ORDER1"                     => "DESC",
        "SORT_BY2"                        => "NAME",
        "SORT_ORDER2"                     => "ASC",
        "FILTER_NAME"                     => "",
        "FIELD_CODE"                      => array("ID", 'PREVIEW_PICTURE'),
        "PROPERTY_CODE"                   => array("DESCRIPTION"),
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
        "PAGER_TITLE"                     => "Клиенты",
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
    )
);
?>
<?
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "certificates",
    array(
        "DISPLAY_DATE"                    => "N",
        "DISPLAY_NAME"                    => "Y",
        "DISPLAY_PICTURE"                 => "Y",
        "DISPLAY_PREVIEW_TEXT"            => "N",
        "AJAX_MODE"                       => "N",
        "IBLOCK_TYPE"                     => "ultrasale",
        "IBLOCK_ID"                       => "8",
        "NEWS_COUNT"                      => "30",
        "SORT_BY1"                        => "SORT",
        "SORT_ORDER1"                     => "DESC",
        "SORT_BY2"                        => "NAME",
        "SORT_ORDER2"                     => "ASC",
        "FILTER_NAME"                     => "",
        "FIELD_CODE"                      => array("ID", 'PREVIEW_PICTURE', 'DETAIL_PICTURE'),
        "PROPERTY_CODE"                   => array("DESCRIPTION"),
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
        "PAGER_TITLE"                     => "Сертификаты",
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
<?php
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "client_reply",
    array(
        "DISPLAY_DATE"                    => "N",
        "DISPLAY_NAME"                    => "Y",
        "DISPLAY_PICTURE"                 => "Y",
        "DISPLAY_PREVIEW_TEXT"            => "N",
        "AJAX_MODE"                       => "N",
        "IBLOCK_TYPE"                     => "ultrasale",
        "IBLOCK_ID"                       => "9",
        "NEWS_COUNT"                      => "6",
        "SORT_BY1"                        => "SORT",
        "SORT_ORDER1"                     => "DESC",
        "SORT_BY2"                        => "NAME",
        "SORT_ORDER2"                     => "ASC",
        "FILTER_NAME"                     => "",
        "FIELD_CODE"                      => array("ID", 'PREVIEW_PICTURE', 'DETAIL_PICTURE'),
        "PROPERTY_CODE"                   => array("DESCRIPTION"),
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
        "PAGER_TITLE"                     => "Отзывы",
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
