var slideout;

(function($){
	App.Widgets = App.Widgets || {};

	
	App.Widgets.Slideout = can.Control.extend(
		{
			pluginName: 'slideout'
		},
		{
			init: function (button, settings) {

				// инициализируем slideout.js
				slideout = new Slideout({
					'panel': document.getElementById(settings.panelID),
					'menu': document.getElementById(settings.menuID),
					'padding': settings.padding,
					'tolerance': settings.tolerance
				});

				// вешаем обработчик на кнопку-сендвич
				button.on('click', function() {
					window.slideout.toggle();
				});

			}
		}
	);

}(jQuery));
