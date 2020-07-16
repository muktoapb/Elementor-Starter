
(function($) {
    var OwlCarousel = function ($scope, $) {
        var $carousel = $scope.find('.slider_wrapper');
        var $sliderDynamicId = '#' + $carousel.attr('id');
        var $countSlide = $carousel.data('countslide');

        if( $countSlide > 1 ){
            $($sliderDynamicId).each( function() {
                $carousel.owlCarousel({
                    dots : $carousel.data("dots"),
                    nav : $carousel.data("nav"),
                    loop : $carousel.data("loop"),
                    autoplay : $carousel.data("autoplay"),
                    autoplayTimeout : $carousel.data("autoplay-timeout"),
                    mouseDrag : $carousel.data("mouse-drag"),
                    touchDrag : $carousel.data("touch-drag"),
                    items: 1,
                    autoplayHoverPause: true,
                    navText: ['<img src="https://i.ibb.co/PMkMLLc/next.png" alt="next" border="0">','<img src="https://i.ibb.co/swk0pGG/prev.png" alt="prev" border="0">']
                });
            });
        }
        
        
    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/slider.default', OwlCarousel);
    });



    
})(jQuery);