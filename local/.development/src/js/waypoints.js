(function($){
	App.Widgets = App.Widgets || {};

	App.Widgets.Waypoints = can.Control.extend(
		{
			pluginName: 'waypoints'
		},
		{
			init: function (menu) {

				var links = menu.find('.header-menu__item'),
					widget = this;

				links.each(function() {
					var link = $(this),
						href = link.attr('href'),
						name = '';
					if (href[0] === '#') {
						name = href.replace('#', '');
						anchor = $('a[name=' + name + ']');
						anchor.waypoint({
							handler: function(direction) {
								if (direction === 'down') {
									widget.changeActive(href);
								}
							},
							offset: $('.header').height() + 1
						});
						anchor.waypoint({
							handler: function(direction) {
								if (direction === 'up') {
									widget.changeActive(href);
								}
							},
							offset: $('.header').height() - 1
						});
					}
				});

			},

			changeActive: function (href) {
				$(['header-menu__item', 'footer-menu__item', 'left-menu__item']).each(
					function() {
						var links = $('.' + this),
							activeClass = this + '--active';

						links.removeClass(activeClass);
						links.filter('[href=' + href + ']').addClass(activeClass);
					}
				);
			}
		}
	);

}(jQuery));
