(function($){
	App.Widgets = App.Widgets || {};
	
	App.Widgets.Menu = can.Control.extend(
		{
			pluginName: 'menu'
		},
		{
			init: function (item) {

				// вешаем обработчик на кнопку-сендвич
				item.on('click', function(event) {
					event.preventDefault();

					// если это ссылка в меню slideout, то сначала закрываем панель
					if ($(this).hasClass('js-menu-scroll--slideout')) {
						window.slideout.toggle();
					}

					// скроллим до анкора
					var href = $(this).attr('href');
					href = href.replace('#', '');
					var anchor = $('a[name=' + href + ']');
					if (anchor.length) {
						$('html, body').animate({
							scrollTop: anchor.eq(0).offset().top - $('.header').height()
						}, 500);
					}
				});

			},
		}
	);

}(jQuery));
