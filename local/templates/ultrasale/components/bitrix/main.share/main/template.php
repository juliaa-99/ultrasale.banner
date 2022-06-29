<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if ($arResult["PAGE_URL"]): ?>
<div class="soc">
    <ul>
			<? if (is_array($arResult["BOOKMARKS"]) && count($arResult["BOOKMARKS"]) > 0) : ?>
				<? foreach (array_reverse($arResult["BOOKMARKS"]) as $name => $arBookmark) : ?>
					<?= $arBookmark["ICON"] ?>
				<? endforeach; ?>
			<? endif; ?>
        </ul>
    <div class="soc-title">поделиться</div>
</div>
<? else: ?>
	<?= GetMessage("SHARE_ERROR_EMPTY_SERVER") ?>
<? endif; ?>

