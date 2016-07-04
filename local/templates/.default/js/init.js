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
// Кнопка наверх
$(function () {
    var modMatcher = /_part-[0-9]+/;
    var $sticker = $('.catalog__sticker');

    if (!$sticker.length) {
        return;
    }

    $(window).on('scroll', function() {
        var padding = parseInt($sticker.css('padding-top'), 10)
        var stickerOffet = $('.catalog__sticker-h').offset().top - (padding * 4);
        var scrollTop = $('body').scrollTop();

        if (scrollTop > stickerOffet) {
            $sticker.addClass('_sticked');
        } else {
            $sticker.removeClass('_sticked');
        }

        var $activeEl = null;
        $('.catalog-item').each(function () {
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


$(function () {
    var $magnifier = $('.contacts-map-magnifier');
    if (!$magnifier.length) {
        return
    }

    var dragged = false;
    var multiplier = 2;
    var edges = {
        top: {
            min: 17,
            max: 98
        },
        left: {
            min: 332,
            max: 410
        }
    }
    var zeroPoint = $magnifier.position();
    var $map = $('.contacts-map-magnifier__map');

    $('body').on('mouseup', function (e) {
        if (e.button === 0) {
            dragged = false;
        }
    });

    $magnifier
        .on('mousedown', function (e) {
            if (e.button === 0) {
                var position = $magnifier.position();
                dragged = {
                    top: -e.pageY + position.top,
                    left: -e.pageX + position.left
                };
            }
        })
        .on('mouseleave', function (e) {
            // dragged = false;
        })
        .on('mousemove', function (e) {
            if (dragged) {
                var diff = {
                    top: dragged.top + e.pageY,
                    left: dragged.left + e.pageX
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
                }

                $map.css({
                    top: mapPos.top,
                    left: mapPos.left
                })
            }
        });
})
