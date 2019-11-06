<?php
   class elementList() 
   {
		function getList ($esort, $efilter, $eFields)
		{
			$cache_id = md5(serialize($arParams));
			$cache_dir = "/tagged_getlist";
			$obCache = new CPHPCache;
			if($obCache->InitCache(36000, $cache_id, $cache_dir))
			{
			  $arElements = $obCache->GetVars();
			}
			elseif(CModule::IncludeModule("iblock") && $obCache->StartDataCache())
			{
			   $arElements = array();
			   $rsElements = CIBlockElement::GetList($esort, $efilter, false, false, $eFields);
				global $CACHE_MANAGER;
				$CACHE_MANAGER->StartTagCache($cache_dir);
				while($arElement = $rsElements->Fetch())
				{
					$CACHE_MANAGER->RegisterTag("iblock_id_".$arElement["ID"]);
					$arElements[] = $arElement;
				}
				$CACHE_MANAGER->RegisterTag("iblock_id_new");
				$CACHE_MANAGER->EndTagCache();
				$obCache->EndDataCache($arElements);
			}
			else
			{
				$arElements = array();
			}
			 return $arElements;
		}
	   
   }
