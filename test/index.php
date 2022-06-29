<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>
<?

//Парсер карточки товара
/*function renameQuot(&$arFields){
	if($arFields['NAME']!="") $arFields['NAME'] = unhtmlentities($arFields['NAME']);
}

global $break;
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "goodParse");
function goodParse($arFields){
	global $break;
	if($break) return false;

	$break = true;	

	$els = CIBlockElement::GetById($arFields['ID']);
	$goodObj = new CIBlockElement;
	while($el = $els->GetNext()){
		$id = $el['ID'];
		$adr = 'http://www.digitalyou.ru'.$el['XML_ID'];
		$base = file_get_contents($adr);
	
		$description = take('<div class="fade in tab-pane active" id="tab-1">', '<div class="fade tab-pane" id="tab-2">', $base);
		$description = trim($description);
		$description = substr($description, 0, strlen($description)-6);
		$goodObj->Update($id,Array("DETAIL_TEXT"=>$description, "DETAIL_TEXT_TYPE"=>"html"));
	
		$imgs = take('<div class="thumbs clearfix"', '<!--  ==========  -->', $base);
		preg_match_all('#src="([^"]+)"#', $imgs, $match);
		$imgs = $match[1];
		$imgArr = Array();
		foreach($imgs as $n=>$img){
			$file = $_SERVER['DOCUMENT_ROOT'].'/upload/'.$n.'.jpg';
			copy($img, $file);
	
			$img = CFile::MakeFileArray($file);
			$img['del'] = "Y";
			if($n==0){
	
				$goodObj->Update($id,Array("PREVIEW_PICTURE"=>$img));
				$goodObj->Update($id,Array("DETAIL_PICTURE"=>$img));
			}else{
				$imgArr[] = $img;							
			}
		}
		$arFile["MODULE_ID"] = "iblock";
		$arFile["del"] = "Y";
		$propvals_todel = CIBlockElement::GetProperty(4, $id, Array(), Array("CODE"=>"photo"));
		while($propval_todel = $propvals_todel->GetNext()){
			$vid = $propval_todel['PROPERTY_VALUE_ID'];
	
			$PROPERTY_VALUE[$propval_todel['ID']][$vid] = $arFile; 
			CIBlockElement::SetPropertyValueCode($id, "photo", Array ($vid => Array("VALUE"=>$arFile) ) );
		}
		if(sizeof($imgArr) > 0){
			CIBlockElement::SetPropertyValues($id,4,$imgArr,"photo");
		}
	
	
	}
	
	$break = false;	

}
*/
$goodObj = new CIBlockElement;
$arSelect = Array("ID", "NAME","DETAIL_TEXT","CODE");
$arFilter = Array("IBLOCK_ID"=>3);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNext())
{

// $str = str_ireplace('.html', '', $ob["~CODE"]);
//  $goodObj->Update($ob["ID"],Array("CODE"=>$str));


$str = str_ireplace('/category/', '/product/', $ob["~DETAIL_TEXT"]);
?><pre><? var_dump($str) ?></pre><?

$goodObj->Update($ob["ID"],Array("DETAIL_TEXT"=>$str, "DETAIL_TEXT_TYPE"=>"html"));
// $str = str_ireplace('/catalog/', '/product/', $ob["~DETAIL_TEXT"]);
//  $goodObj->Update($ob["ID"],Array("DETAIL_TEXT"=>$str, "DETAIL_TEXT_TYPE"=>"html"));

	// preg_match_all('/src=\"(.*?)\"/', $ob["~DETAIL_TEXT"], $array); // выбираем из переменной $content все src
	// foreach ($array[1] as $item){
	// var_dump($str); // выводим чистые ссылки картинок
	// }


}


// if (!mkdir($_SERVER['DOCUMENT_ROOT'].'/upload/sites/default/files/inline-images/', 0777, true)) {
//     $as = copy('https://ultrasale.ru/sites/default/files/inline-images/10_01_0.jpg', $_SERVER['DOCUMENT_ROOT'].'/upload/sites/default/files/inline-images/10_01_0.jpg');
// } else {
// 	$as = copy('https://ultrasale.ru/sites/default/files/inline-images/10_01_0.jpg', $_SERVER['DOCUMENT_ROOT'].'/upload/sites/default/files/inline-images/10_01_0.jpg');
// }

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>