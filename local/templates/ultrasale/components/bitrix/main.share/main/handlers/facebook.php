<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$name = "facebook";
$icon_url_template = "
<li><a class=\"advertising__list-item advertising__list-item-color2\"
	target=\"_blank\" 
	onclick=\"window.open(this.href,'','toolbar=0,status=0,width=611,height=231');return false;\" 
	href=\"http://www.facebook.com/share.php?u=#PAGE_URL_ENCODED#&t=#PAGE_TITLE_UTF_ENCODED#\">
	<svg><use xlink:href=\"#soc-i3\">
</a></li>
";
$sort = 200;