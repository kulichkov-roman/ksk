(function($){
	window.App = window.App || {};
	App.Widgets = App.Widgets || {};
	App.Objects = App.Objects || {};
	App.Helpers = App.Helpers || {};
	App.Locale = App.Locale || {};
	App.User = App.User || {};

	/**
	 * Основной класс приложения
	 * Все методы, начинающиеся с "init" запускаются автоматически при полной загрузке страницы
	 */
	var Application = can.Control.extend(
		{
			init: function () {
			},

			bootstrap: function () {
				var method;

				for (method in this) {
					if (method.length > 4 && method.substr(0, 4) === 'init') {
						this[method]();
					}
				}

				can.route.ready();
			},

			/**
			 * Навешивает контроллер на DOM элемент и возвращает его instance
			 * @param selector
			 * @param controllerName
			 * @param settings
			 * @returns {*}
			 */
			installController: function (selector, controllerName, settings) {
				settings = settings || {};
				return this.element.find(selector)[controllerName](settings).control(controllerName);
			},

			/**
			 * Инициализация кастомных компонент вроде селектов, чекбоксов и прочего
			 */
			initCustomComponents: function () {

				// Карусель в блоке "наши клиенты"
				$('.js-hero-owl-carousel').owlCarousel({
					items: 1,
					nav: true,
					dots: true,
					autoplay: true,
					loop: true
				});

				// Слайдер в блоке hero
				$('.js-clients-owl-carousel').owlCarousel({
					items: 1,
					nav: true,
					dots: false,
					responsive: {
						768: {
							items: 2,
						},
						1170: {
							items: 3,
						}
					}
				});

				// Попап для формы "связаться с нами"
				$('.js-contacts__box-button').fancybox({
					padding: 0,
					maxWidth: 330,
					helpers: {
						overlay: {
							locked: false
						}
					}
				});

				// фиксируем шапку
				$('.header').hcSticky();

			},

			initWidgets: function () {

				// slideout
				this.installController(
					'.js-slideout-toggle-button',
					'slideout',
					{
						panelID: 'js-slideout-panel',
						menuID: 'js-slideout-menu',
						padding: 256,
						tolerance: 70
					}
				);
				this.installController('.js-menu-scroll', 'menu');

				// переключаем пукнты меню по скроллу
				this.installController('.header-menu', 'waypoints');

			}
		}
	);

	$(function(){
		window.application = new Application('body');
		window.application.bootstrap();
	});

}(jQuery));
