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

    // $el.data('header')
})
