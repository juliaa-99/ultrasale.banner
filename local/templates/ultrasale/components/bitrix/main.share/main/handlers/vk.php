<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$name = "vk";
$icon_url_template = "
<li><a  class=\"advertising__list-item advertising__list-item-color1\"
	target=\"_blank\" 
	href=\"http://vkontakte.ru/share.php?url=#PAGE_URL_ENCODED#&title=#PAGE_TITLE_UTF_ENCODED#\" 
	onclick=\"window.open(this.href,'','toolbar=0,status=0,width=626,height=436');return false;\">
	<svg><use xlink:href=\"#soc-i4\">
</a></li>";
$sort = 100;