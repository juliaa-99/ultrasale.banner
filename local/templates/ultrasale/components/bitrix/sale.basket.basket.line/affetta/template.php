<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * @global string $componentPath
 * @global string $templateName
 * @var CBitrixComponentTemplate $this
 */
$cartStyle = 'bx-basket';
$cartId = "bx_basket".$this->randString();
$arParams['cartId'] = $cartId;

?><script>
var <?=$cartId?> = new BitrixSmallCart;
</script>
<div id="<?=$cartId?>" class="" style="display: inline-block;"><?
	/** @var \Bitrix\Main\Page\FrameBuffered $frame */
    	$frame = $this->createFrame($cartId, false)->begin();
            require(realpath(dirname(__FILE__)).'/ajax_template.php');
        $frame->beginStub();
            $arResult['COMPOSITE_STUB'] = 'Y';

		require(realpath(dirname(__FILE__)).'/top_template.php');
		unset($arResult['COMPOSITE_STUB']);
	$frame->end();
?></div>
<script type="text/javascript">
	<?=$cartId?>.siteId       = '<?=SITE_ID?>';
	<?=$cartId?>.cartId       = '<?=$cartId?>';
	<?=$cartId?>.ajaxPath     = '<?=$componentPath?>/ajax.php';
	<?=$cartId?>.templateName = '<?=$templateName?>';
	<?=$cartId?>.arParams     =  <?=CUtil::PhpToJSObject ($arParams)?>; // TODO \Bitrix\Main\Web\Json::encode
	<?=$cartId?>.activate();
</script>