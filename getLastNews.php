<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!CModule::IncludeModule("iblock")) return;
$arRes = CIBlockRSS::GetNewsEx("lenta.ru", 80, "/rss", "");
$arRes = CIBlockRSS::FormatArray($arRes);
?>
<?foreach($arRes['item'] as $index=>$item):?>
<?if($index > 4) break;?>
<p><?=$item['title']?></p>
<p><?=$item['link']?></p>
<textarea cols='120' rows='5'><?=$item['description']?></textarea>
<?endforeach?>