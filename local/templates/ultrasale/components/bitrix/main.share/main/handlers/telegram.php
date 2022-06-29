<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$name = "telegram";
$icon_url_template = "
<li><a 
	target=\"_blank\" 
	href=\"https://t.me/share/url?url=#PAGE_URL_ENCODED#&text=#PAGE_TITLE_UTF_ENCODED#\"
	onclick=\"window . open(this . href, '', 'toolbar=0,status=0,width=626,height=436');return false;\">
	<svg><use xlink:href=\"#soc-i1\">
 </a></li>
";
$sort = 400;