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

    $(window).on('scroll', () => {
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
            var height = $el.height();
            var offset = $el.offset().top - (padding * 6);

            if (
                scrollTop > offset - (padding * 0.625) &&
                scrollTop < offset + height + (padding * 0.625)
            ) {
                $activeEl = $el;
                $el.addClass('_active');
            } else {
                $el.removeClass('_active');
            }
        });

        var mod
        if ($activeEl) {
            mod = $activeEl.attr('class').match(modMatcher);
            if (mod) {
                $sticker.addClass(mod[0]);
            }
        } else {
            mod = $sticker.attr('class').match(modMatcher);
            if (mod) {
                $sticker.removeClass(mod[0]);
            }
        }
    });


});
