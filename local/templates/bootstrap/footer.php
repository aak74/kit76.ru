<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
						</div>
					</div>
					
					<div id="sidebar" class="col-md-3 col-lg-3">
						<div id="sidebar-inner">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								".default",
								Array(
									"AREA_FILE_SHOW" => "page", 
									"AREA_FILE_SUFFIX" => "inc", 
									"AREA_FILE_RECURSIVE" => "N", 
									"EDIT_MODE" => "html", 
									"EDIT_TEMPLATE" => "page_inc.php" 
									)
							);?><?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								".default",
								Array(
									"AREA_FILE_SHOW" => "sect", 
									"AREA_FILE_SUFFIX" => "inc", 
									"AREA_FILE_RECURSIVE" => "Y", 
									"EDIT_MODE" => "html", 
									"EDIT_TEMPLATE" => "sect_inc.php" 
								)
							);?>
						</div>
					</div>
				</div>
				<div id="footer" class="container">
					<div id="copyright">
						<?$APPLICATION->IncludeFile(
								SITE_DIR."include/copyright.php",
								Array(),
								Array("MODE"=>"html")
							);?>
					</div>
					<div id="counters">
						<?$APPLICATION->IncludeFile(
							SITE_DIR."include/counter.php",
							Array(),
							Array("MODE"=>"html")
						);?>
					</div>
					<div id="bottom-menu">			
						<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", array(
							"ROOT_MENU_TYPE" => "bottom",
							"MENU_CACHE_TYPE" => "Y",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MAX_LEVEL" => "1",
							"CHILD_MENU_TYPE" => "bottom",
							"USE_EXT" => "N",
							"ALLOW_MULTI_SELECT" => "N"
							),
							false
						);?>
						<div class="text-right">
							<p class="text-muted text-right">
								<small>
									<?$APPLICATION->IncludeFile(
										SITE_DIR."include/denialOffer.php",
										Array(),
										Array("MODE"=>"html")
									);?>
								</small>
							</p>
						</div>

					</div>
				</div>
			</div>
		</div>	
	</div>	
<?//include($_SERVER["DOCUMENT_ROOT"]."/include/counter.php");?>
</body>
</html>