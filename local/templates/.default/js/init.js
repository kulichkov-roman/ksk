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
        e.preventDefault();
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
