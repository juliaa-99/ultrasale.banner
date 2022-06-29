<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$name = "wa";
$icon_url_template = "
<li><a 
	target=\"_blank\" 
	href=\"https://api.whatsapp.com/send?text=#PAGE_URL_ENCODED#&title=#PAGE_TITLE_UTF_ENCODED#\"
	data-action=\"share/whatsapp/share\"
	onclick=\"window . open(this . href, '', 'toolbar=0,status=0,width=626,height=436');return false;\">
                                    <svg><use xlink:href=\"#soc-i2\"></use></svg>
 </a></li>
";
$sort = 300;