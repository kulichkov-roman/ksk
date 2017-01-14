/**
 * Виджет для реализации скролла модального окна ui-dialog через общий скроллбар окна
 *
 * v0.93 @ 21.10.2014
 *
 * @author Andrey Solodovnikov
 */
(function ($) {
	'use strict';

	$.widget('ui.dialogBodyScroll', {
		options: {
			buttonpaneFixed: false,
			buttonpaneFixedClass: '_fixed',
			buttonpane: '.ui-dialog-buttonpane',
			buttonpaneOffset: 0,
			smartIndent: {
				top: 0
			},
			addIndentToBody: true
		},

		buttonpaneFixedInited: false,

		widgetPaddingBottom: '',

		/**
		 *  Конструктор
		 */
		_create: function () {
			var that = this;

			// Задаем виджет
			that.$widget = that.element.dialog('widget');

			// Проверяем, инициализирован ли плагин
			if (!that.$widget.is('.ui-dialog')) {
				throw new Error('dialogBodyScroll:: initialize ui.dialog first');
				return that.element;
			}

			// Проверяем, проведен ли вызов в нужный момент
			if (that.element.dialog('option', 'autoOpen')) {
				console.log('dialogBodyScroll:: to use the plugin you need to set option .dialog({autoOpen: false}) and open dialog manualy after the plugin initialize');
				throw new Error('dialogBodyScroll:: autoOpen is true. The plugin have to be initialized before opening the dialog');
				return that.element;
			}

			that.$html = $('html');
			that.$body = that.$html.find('body');
			that.$window = $(window);

			// Узнаём ширину скроллбара в браузере
			that._getScrollbarWidth();

			// Создаем обертку
			that.$wrapper = $('<div class="ui-dialog-wrapper"></div>').css({
				'position': 'fixed',
				'left': 0,
				'top': 0,
				'right': 0,
				'bottom': 0,
				'overflow': 'auto'
			})
				.on('click', function (e) {
					if (!$(e.target).closest('.ui-dialog').length) {
						that.$wrapper.data('overlay').trigger('click');
					}
				});


			// Конфигурируем Dialog
			that.element.dialog('option', {
				'modal': true,
				'draggable': false
			})
			.on('dialogopen.dialogNiceScroll', function () {
				// Показываем скролбар у body для правильного подсчёта позиции left
				// При наличии ещё одного открытого модального окна
				that._showBodyScrollbar();

				// that.scrollTop = that.$html.scrollTop();
				if (that.options.buttonpane) {
					that.$buttonpane = that.$widget.find(that.options.buttonpane);

					if (!that.$buttonpane.length) {
						that.$buttonpane = undefined;
						console.log('dialogBodyScroll:: can not find buttonpane element');
					}
				}

				// Задаем стили для диалога и обертки
				that.$widget.css({
					'position': 'relative'
				});

				var $overlay = $('.ui-widget-overlay').last();

				// Задаем css для overlay для корректного отображения затемнения
				$overlay.css({
					'position': 'fixed',
					'width': 'auto',
					'height': 'auto',
					'top': 0,
					'right': 0,
					'bottom': 0,
					'left': 0
				});

				that.$wrapper.data('overlay', $overlay);

				// показываем обертку
				that.$widget.after(that.$wrapper);
				that.$wrapper.append(that.$widget);
				that.$widget.parent().css('z-index', that.$widget.css('z-index'));

				// Настраиваем размеры и положение окна
				that._calculateDialogSizes();

				// Для пересчета размеров
				that.$window.on('resize.dialogNiceScroll', function () {
					that._resize(that.width, that.height);
				})
				// Исправляем глюк с хаотичным проскролом body в chrome
				.on('mousewheel.dialogNiceScroll', function () {
					// Хрен его знает, почему Хрому нужно, чтобы висело ДАЖЕ ПУСТОЕ событие для адекватного поведения
					// Но это работает
				});

				// Отключаем дефолтный скроллбар окна
				// Задаем отпуступ вместо убранного скроллбара
				that._hideBodyScrollbar();

				setTimeout(function() {
					that.$wrapper.scrollTop(0);
				}, 0)
			})
			.on('dialogclose.dialogNiceScroll', function () {
				that.$window.off('resize.dialogNiceScroll mousewheel.dialogNiceScroll');

				that._revertButtonpane();

				// Прячем обертку
				that.$wrapper.after(that.$wrapper.children()).detach();

				// Если это единственное модально окно
				if (!$('.ui-dialog-wrapper').length) {
					// Включаем дефолтный скроллбар окна
					// Возвращаем отпустп на место
					that._showBodyScrollbar();
				}
			})
			.on('dialogDestroyWrapper', function () {
				that.$wrapper.remove();
			})

			.on('dialogScrollRefresh', function () {
				that._calculateDialogSizes();
			});

			return that;

		},

		/**
		 * Вычисление вертикального положения диалога
		 */
		_resize: function (width, height, first) {
			var that = this;

			// высота окна
			var wHeight = that.$window.height(),
				wWidth = that.$window.width(),
				left = (wWidth - width) / 2,
				top;

			if (width > wWidth) {
				left = 0;
			}

			if (height < wHeight) {
				if (that.dialogInScroll == 'start' || first) {

					that._revertButtonpane();

					// ScrollStop Event trigger
					that.element.trigger('dialogScrollStop');
				}

				that.dialogInScroll = 'stop';
				top = (wHeight - height) / 2;
			} else {

				if (that.dialogInScroll == 'stop' || first) {

					// Buttonpane Fixed start
					if (that.options.buttonpaneFixed && that.$buttonpane) {

						var css = that.$buttonpane.css(['paddingLeft', 'paddingRight']),
							bpHeight = that.$buttonpane.outerHeight();
							that.widgetPaddingBottom = that.$widget.css('paddingBottom');

						that.$buttonpane
							.css({
								position: 'fixed',
								bottom: 0,
								width: width - (parseInt(css.paddingLeft, 10) + parseInt(css.paddingRight, 10)),
								transform: 'translateZ(0)'
							})
							.addClass(that.options.buttonpaneFixedClass);

						that.$widget.css('padding-bottom', bpHeight + that.options.buttonpaneOffset);
					}

					// ScrollStart Event trigger
					that.element.trigger('dialogScrollStart');
				}

				that.dialogInScroll = 'start';
				top = 0;
			}

			top += that.options.smartIndent.top;

			that.$widget.css({
				'top': top,
				'left': left
			});

			// Buttonpane positioning
			if (that.options.buttonpaneFixed && that.$buttonpane) {
				that.$buttonpane.css({
					'left': left
				});
			}
		},

		/**
		 * Вычисление ширины скроллбара
		 */
		_getScrollbarWidth: function () {
			var that = this;

			if (!that.options.addIndentToBody) {
				return;
			}

			if (!that.$body.data('scrollbar-width')) {

				// Элемент, у котого мы будем проверять размеры скроллбара
				var $el = $('<div style="width:50px; height: 50px; overflow-y:scroll"></div>');

				that.$body.append($el);

				// Вычисляем разница между внутренней и внешней шириной элемента
				that.scrollWidth = $el[0].offsetWidth - $el[0].clientWidth;

				that.$body.data('scrollbar-width', that.scrollWidth);

				$el.remove();

			} else {
				that.scrollWidth = that.$body.data('scrollbar-width');
			}

		},

		_calculateDialogSizes: function() {
			var that = this;

			that.height =
				that.$widget.height() +
				parseInt(that.$widget.css('margin-top'), 10) +
				parseInt(that.$widget.css('margin-bottom'), 10) +
				(that.options.smartIndent.top * 2);


			that.width = that.$widget.width();


			// Настраиваем положение диалога в пространстве
			that._resize(that.width, that.height, true);
		},


		_hideBodyScrollbar: function() {
			if (!this.scrollWidth || this.$body.height() < this.$window.height()) return;

			this.$body.css({
				'overflow': 'hidden',
				'margin-right': this.scrollWidth
			});
		},

		_showBodyScrollbar: function() {
			if (!this.scrollWidth) return;

			this.$body.css({
				'overflow': '',
				'margin-right': ''
			});
		},


		_revertButtonpane: function() {
			var that = this;
			// Buttonpane Fixed stop
			if (that.options.buttonpaneFixed && that.$buttonpane) {

				that.$buttonpane.removeAttr('style').removeClass(that.options.buttonpaneFixedClass);
				that.$widget.css('paddingBottom', that.widgetPaddingBottom);
			}
		},


		/**
		 * Деструктор виджета
		 */
		destroy: function () {
			$.Widget.prototype.destroy.call(this);
		}
	});

})(jQuery);
