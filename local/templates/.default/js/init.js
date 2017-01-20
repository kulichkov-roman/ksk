// Главный слайдер
$(function() {
    var interval = Number($('.header-slider').data('interval') || 0);
    var autoplay;
    var $btn = $('.header-slider-content__nav-btn');

    function slide (index) {
        $('.header-slider__item')
            .removeClass('_active')
            .eq(index).addClass('_active');

        $('.header-slider-content__box-item')
            .removeClass('_active')
            .eq(index).addClass('_active');

        $btn
            .removeClass('_active')
            .eq(index).addClass('_active');

        setAutoplay();
    }

    function setAutoplay () {
        clearTimeout(autoplay);
        if (interval) {
            autoplay = setTimeout(function () {
                var maxIndex = $btn.length - 1;
                var activeIndex = $btn.filter('._active').index();
                var nextIndex = activeIndex + 1;

                if (activeIndex == maxIndex) {
                    nextIndex = 0;
                }

                slide(nextIndex);
            }, interval);
        }
    }


    setAutoplay();


    $('.header-slider-content__nav-btn').click(function () {
        slide($(this).index());
    });

});

// Слайдер сертификатов
$(function () {
    $('.rewards-slider__inner')
        .removeClass('_raw')
        .slick({
            infinite: true,
            slidesToShow: 6,
            // dots: true,
            // autoplay: true,
            // autoplaySpeed: this.$('.index-page__slider-inner').data('interval')
        });
});


// Кнопка наверх
$(function () {
    $('.footer__up-btn').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    });
});


$(function () {
    $('._fancybox').fancybox({
        prevEffect		: 'none',
        nextEffect		: 'none',
        // closeBtn		: false,
        helpers		: {
            thumbs: {
                width: 120,
                height: 100
            },
            title	: { type : 'inside' },
            buttons	: {}
        },
        beforeShow: function () {
            var header = this.element.data('header');
            if (header) {
                this.outer.prepend('<h5 class="fancybox-header">' + header +'</h5>')
            }
        }
    });

    $('.feed__photos-btn').click(function () {
        $('.feed__img-link').first().click();
    })

    // $el.data('header')
});


// Каталог. Ездящая свинья
$(function () {
    var modMatcher = /_part-[0-9]+/;
    var $sticker = $('.catalog__sticker');

    if (!$sticker.length) {
        return;
    }

    var offset = $sticker.offset();

    $(window).on('scroll', function() {
        var padding = parseInt($sticker.css('padding-top'), 10)
        var stickerOffet = $('.catalog__sticker-h').offset().top - (padding * 4);
        var scrollTopLimit = $('.catalog').height() + $('.catalog').offset().top - stickerOffet - (padding * 2.8);
        var scrollTop = $(window).scrollTop();

        if (scrollTop > stickerOffet) {
            $sticker.addClass('_sticked');
            $sticker.css({left: offset.left});
        } else {
            $sticker.removeClass('_sticked');
            $sticker.css({left: ''});
        }

        var $activeEl = null;
        $('.catalog-item').each(function (index) {
            var $el = $(this);
            var height = $el.outerHeight();
            var offset = $el.offset().top - (padding * 6);
            var marginBottom = parseInt($el.css('marginBottom'), 10);

            if (
                scrollTop > offset - marginBottom &&
                scrollTop < offset + height
            ) {
                $activeEl = $el;
                $el.addClass('_active');
            } else {
                $el.removeClass('_active');
            }

            // Заставляем свинку не уезжать дальше конца списка
            if (scrollTop > scrollTopLimit) {
                $sticker.css({marginTop: -(scrollTop - scrollTopLimit)});
            } else {
                $sticker.css({marginTop: ''});
            }
        });

        var mod = $sticker.attr('class').match(modMatcher);
        if (mod) {
            $sticker.removeClass(mod[0]);
        }
        if ($activeEl) {
            mod = $activeEl.attr('class').match(modMatcher);
            if (mod) {
                $sticker.addClass(mod[0]);
            }
        }
    });

    $('.catalog-item').click(function (e) {
        var padding = parseInt();
        var $el = $(this);
        var height = $el.outerHeight();
        var offset = $el.offset().top;
        $('body, html').animate({
            scrollTop: offset - (height / 2) - ($sticker.outerHeight() / 2)
        }, 300);
    })
});

// Контакты (лупа)
$(function () {
    var $magnifier = $('.contacts-map-magnifier');
    if (!$magnifier.length) {
        return
    }

    var $box = $('.contacts-map');
    var $viewport = $('.contacts-map-magnifier__viewport');
    var $map = $('.contacts-map-magnifier__map');
    var dragged = false;
    var multiplier = 2;
    var edges = {
        top: {
            min: parseInt($magnifier.css('top')),
            max: null
        },
        left: {
            min: parseInt($magnifier.css('left')),
            max: null
        }
    }
    edges.top.max = edges.top.min + ($map.outerHeight() - $viewport.outerHeight()) / multiplier;
    edges.top.range = edges.top.max - edges.top.min;
    edges.left.max = edges.left.min + ($map.outerWidth() - $viewport.outerWidth()) / multiplier;
    edges.left.range = edges.left.max - edges.left.min;
    var zeroPoint = $magnifier.position();
    var boxSize = {
        width: $box.outerWidth(),
        height: $box.outerHeight()
    };
    var boxOffset = $box.offset();

    $box.on('mousemove', function (e) {
        var mouseOffset = {
            x: (e.pageX - boxOffset.left),
            y: (e.pageY - boxOffset.top)
        }
        var progress = {
            x: 100 / boxSize.width * mouseOffset.x,
            y: 100 / boxSize.height * mouseOffset.y
        };

        // Движение вне карты (за счёт вылезающей за пределы лупы)
        if (mouseOffset.y > boxSize.height) {
            return;
        }

        var diff = {
            top: edges.top.min + (edges.top.range / 100 * progress.y),
            left: edges.left.min + (edges.left.range / 100 * progress.x)
        };

        if (diff.top > edges.top.max) {
            diff.top = edges.top.max;
        }
        if (diff.top < edges.top.min) {
            diff.top = edges.top.min;
        }
        if (diff.left > edges.left.max) {
            diff.left = edges.left.max;
        }
        if (diff.left < edges.left.min) {
            diff.left = edges.left.min;
        }

        $magnifier.css({
            top: diff.top,
            left: diff.left
        });

        var mapPos = {
            top: -(diff.top - zeroPoint.top) * multiplier,
            left: -(diff.left - zeroPoint.left) * multiplier
        };

        $map.css({
            top: mapPos.top,
            left: mapPos.left
        });
    });
});


// Новости
$(function() {
    function getInvisible () {
        var step = 5;
        var counter = 0;
        return $('.news-list-item').filter(':hidden').filter(function () {
            if (counter === 5) {
                return false;
            }
            counter++;
            return true;
        });
    }

    if (!getInvisible().length) {
        $('.news-list__show-more').hide();
    }
    $('.news-list__show-more').click(function () {
        var $filtered = getInvisible();
        $filtered.show();
        if (!getInvisible().length) {
            $('.news-list__show-more').hide();
        }
    });
});

// SEO-ссылки
$(function () {
    var $seoBlock = $('.seo-block');
    if (!$seoBlock.length) {
        return;
    }

    $('.seo-block__toggle').click(function () {
        var $content = $('.seo-block__content');

        if ($content.is(':hidden')) {
            $content.show();
            var height = $content.outerHeight();
            $seoBlock.css('marginBottom', -height);
            $('.seo-block__toggle-text._expand').hide();
            $('.seo-block__toggle-text._minimize').show();


            var heightRequired = $seoBlock.offset().top + $seoBlock.outerHeight();
            var heightAvailable = $('body').outerHeight();

            if (heightRequired > heightAvailable) {
                $('.wrapper').css('padding-bottom', heightRequired - heightAvailable);
            }
        } else {
            $content.hide();
            $seoBlock.css('marginBottom', '');
            $('.seo-block__toggle-text._expand').show();
            $('.seo-block__toggle-text._minimize').hide();
            $('.wrapper').css('padding-bottom', '');
        }
    })
});



// Карточка товара - begin
var UtilChangeValue = function($field, dir) {
	var value = parseInt($field.val(), 10);
	var type = $field.data('type') || 'item';
	var step = $field.data('step') || 1;
	var min = $field.data('min') || 0;
	var quantity;

	if (isNaN(value)) {
		value = min;
	}

	if (dir == 'minus') {
		if (type === 'weight') {
			if (value > step && value > min) {
				value -= step;
			}
			// else {
			// 	value = 0;
			// }
		}

		if (type === 'item') {
			if (value > 1 && value > min) {
				value -= 1;
			}
			//  else {
			// 	value = 0;
			// }
		}
	}

	if (dir == 'plus') {
		if (type === 'weight') {
			if (value < 99999) {
				value += step;
			}
		}

		if (type === 'item') {
			if (value < 99999) {
				value += 1;
			}
		}
	}

	if (type === 'weight') {
		quantity = value / step
	} else if (type === 'item') {
		quantity = value;
	}

	$field.val(value);

	return quantity;
};

var UtilBindIterate = function($el, $field, direction, cbIterate, cdFinish) {
	var iterate = function() {
		var quantity = UtilChangeValue($field, direction);
		if (cbIterate) {
			cbIterate.call($field[0], quantity);
		}
	}

	$el.on('mousedown', function(e) {
		if (e.button !== 0 || $el.data('iterator')) {
			return;
		}
		var begin = setTimeout(function(argument) {
			iterate();
			$el.data('iterator', setInterval(iterate, 200));
			$el.data('beginFired', true);
		}, 350);

		$el.data('begin', begin);
	});
	$el.on('mouseup mouseleave', function(e) {
		if (e.button !== 0 || !$el.data('begin')) {
			return;
		}
		if (!$el.data('beginFired')) {
			iterate();
		}

		clearTimeout($el.data('begin'))
		clearInterval($el.data('iterator'));

		$el.data('begin', null);
		$el.data('beginFired', null);
		$el.data('iterator', null);

		if (cdFinish) {
			cdFinish.call($field[0]);
		}
	});
};

var ComponentSendForm = {
    template: '#sendForm-tpl',

    props: ['offerQuantity'],

    components: {
        field: {
            template: '#sendFormField-tpl',
            props: ['field', 'validateField'],

            mounted: function () {
                var self = this;
                if (this.field.name === 'phone') {
                    // $(this.$refs.input).inputmask('+7 999 999-99-99');
                }

                $(this.$refs.input).change(function () {
                    self.field.value = $(self.$refs.input).val();
                    self.validateField(self.field);
                });
            }
        }
    },

    computed: {
        isFormSuccess: function () {
            var success = true;
            this.form.forEach(function (field) {
                if (!field.success) {
                    success = false;
                }
            });

            return success;
        }
    },

    data: function () {
        return {
            form: [
                {
                    name: 'name',
                    required: true,
                    // label: 'Ваше имя',
                    // name: 'NAME',
                    placeholder: 'Ваше имя',
                    value: '',
                    error: false,
                    success: false,
                },
                {
                    name: 'phone',
                    required: true,
                    // label: 'Контактный телефон',
                    // name: '217',
                    placeholder: 'Телефон',
                    value: '',
                    error: false,
                    success: false,
                    validate: function (value) {
                        return /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/.test(value);
                    },
                    message: {
                        invalid: 'Укажите номер в формате +7 XXX XXX XX XX'
                    }
                },
                {
                    name: 'email',
                    required: true,
                    // label: 'Ваш e-mail',
                    // name: '218',
                    placeholder: 'Эл. почта',
                    value: '',
                    error: false,
                    success: false,
                    validate: function (value) {
                        return /^.+@.+\..+$/.test(value);
                    },
                    message: {
                        invalid: 'Поле «Эл. почта», заполнено неверно!'
                    }
                }
            ]
        }
    },

    methods: {
        onFormSubmit: function (event) {
            var hasErrors = false;
            this.form.forEach(function (item) {
                if (!this.validateField(item)) {
                    hasErrors = true;
                }
            }.bind(this));

            if (!hasErrors) {
                var resultData = {};
                this.form.forEach(function (item) {
                    resultData[item.name] = item.value;
                }.bind(this));
                this.$emit('success', resultData);
            } else {
                event.preventDefault();
            }
        },

        validateField: function (field) {
            if (field.required) {
                if (!field.value) {
                    field.error = 'required';
                    field.success = false;
                    return false;
                } else {
                    field.error = false;
                    field.success = true;
                }
            }

            if (field.validate) {
                if (!field.validate(field.value)) {
                    field.error = 'invalid';
                    field.success = false;
                    return false;
                } else {
                    field.error = false;
                    field.success = true;
                }
            }

            return true;
        },

        getFieldName (name, obj) {
            return obj[name];
        }
    }
};

$(function() {
    var photos = [];

    $('.product-page-photo-thumbs__img').each(function () {
        photos.push({
            href: $(this).data('full'),
            title: $(this).data('title')
        });
    });

    $('.product-page-photo-main').click(function () {
        $.fancybox.open(photos, {
            prevEffect: 'none',
            nextEffect: 'none',
            index: $('.product-page-photo-main__img').data('index'),
            helpers		: {
                thumbs: {
                    width: 100,
                    height: 100
                },
                // title	: { type : 'inside' },
                // buttons	: {}
            },
        });
    });


    // Слайдер на главной
    $('.product-page-photo-thumbs__item').first().addClass('_active');
    $('.product-page-photo-thumbs')
        .on('click', '.product-page-photo-thumbs__img', function () {
            var big = $(this).data('big');
            var index = $(this).data('index');

            $('.product-page-photo-main__img')
                .attr('src', big)
                .data('index', index);

            $('.product-page-photo-thumbs__item').removeClass('_active')
            $(this).closest('.product-page-photo-thumbs__item').addClass('_active');
        })
        .removeClass('_raw')
        .slick({
            centerMode: true,
            speed: 250,
            // slidesToShow: 4
            // infinite: false,
            variableWidth: true,
            dots: false,
            autoplay: false
        });

    var $field = $('.product-page-buy-count__field');
    UtilBindIterate(
        $('.product-page-buy-count__less'),
        $field,
        'minus',
        function(quantity) {
            console.log('minus', quantity);
        }
    );

    UtilBindIterate(
        $('.product-page-buy-count__more'),
        $field,
        'plus',
        function(quantity) {
            console.log('plus', quantity);
        }
    );

    $('.product-page-buy__button').click(function () {
        const el = document.createElement('div');
        el.style.display = 'none';
        document.body.appendChild(el);

        var $dialog = $(el);

        $dialog
            .dialog({
                autoOpen: false,
                resizable: false,
                draggable: false,
                modal: true,
                height: 'auto',
                width: (440 / 16.5) + 'vw',
                title: 'Ваши данные'
            })
            .on('dialogopen', () => {
                $('.ui-widget-overlay')
                    .off('click.dialogClose')
                    .on('click.dialogClose', () => {
                        $dialog.dialog('close');
                    });
            })
            .on('dialogclose', () => {
                $dialog.dialog('destroy');
                $dialog.remove();
            })
            .dialogBodyScroll();

        var Comp = Vue.extend(ComponentSendForm);
        new Comp({
            el: el,
            propsData: {
                offerQuantity: $('.product-page-buy-count__field').val()
            }
        });

        $dialog.dialog('open');

    })
});
// Карточка товара - end
