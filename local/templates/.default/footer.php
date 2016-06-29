<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

$isMain = CSite::InDir(SITE_DIR.'index.php');
$isContacts = CSite::InDir(SITE_DIR.'contacts/');
?>
				</div><!--content__content-->
			</div><!--content__inner-->
		</section><!--content-->
		<?if($isMain) {
			$APPLICATION->IncludeComponent('bitrix:main.include', '',
				Array(
					'AREA_FILE_SHOW' => 'file',
					'PATH' => '/local/include/site_templates/hd_rewards_main.php',
					'EDIT_TEMPLATE' => ''
				),
				false,
				Array('HIDE_ICONS' => 'Y')
			);
		}
		?>
		<footer class="footer">
			<div class="footer__inner">
				<?if(!$isContacts){?>
					<button type="button" class="footer__up-btn">Вернуться наверх</button>
					<section class="footer-content">
						<div class="footer-content__col">
							<div class="footer-phones">
								<?
								$APPLICATION->IncludeComponent("bitrix:main.include", "",
									Array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => "/local/include/site_templates/ft_phones.php",
										"EDIT_TEMPLATE" => ""
									),
									false,
									Array('HIDE_ICONS' => 'Y')
								);
								?>
								<div class="footer-phones__note">
									<?
									$APPLICATION->IncludeComponent("bitrix:main.include", "",
										Array(
											"AREA_FILE_SHOW" => "file",
											"PATH" => "/local/include/site_templates/ft_time_to_call.php",
											"EDIT_TEMPLATE" => ""
										),
										false
									);
									?>
								</div>
							</div>
						</div>
						<div class="footer-content__col">
							<ul class="footer-contacts">
								<li class="footer-contacts__item _location">
									<?
									$APPLICATION->IncludeComponent("bitrix:main.include", "",
										Array(
											"AREA_FILE_SHOW" => "file",
											"PATH" => "/local/include/site_templates/ft_contacts_location.php",
											"EDIT_TEMPLATE" => ""
										),
										false
									);
									?>
								</li>
								<li class="footer-contacts__item _email">
									<?
									$APPLICATION->IncludeComponent("bitrix:main.include", "",
										Array(
											"AREA_FILE_SHOW" => "file",
											"PATH" => "/local/include/site_templates/ft_contacts_email.php",
											"EDIT_TEMPLATE" => ""
										),
										false
									);
									?>
								</li>
							</ul>
						</div>
					</section>
				<?}?>
				<div class="footer__copyrights">
					<?
					$APPLICATION->IncludeComponent("bitrix:main.include", "",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/local/include/site_templates/ft_copyrights.php",
							"EDIT_TEMPLATE" => ""
						),
						false
					);
					?>
				</div>
				<div class="footer__developers">
					<?
					$APPLICATION->IncludeComponent("bitrix:main.include", "",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/local/include/site_templates/ft_developers.php",
							"EDIT_TEMPLATE" => ""
						),
						false,
						Array('HIDE_ICONS' => 'Y')
					);
					?>
				</div>
			</div>
		</footer>
	</div>
</body>