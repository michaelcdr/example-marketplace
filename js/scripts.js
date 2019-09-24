class CarouselHome{
    constructor(selector){
        //console.log('carrosel iniciado.');
        $(selector).slick({
            fade:true,
            autoplay:true,
            arrows:true,
            dots:true
        });

        setTimeout(() => {
            $('.card').addClass('in');
        },300);
    }
}

window.carouselHome = new CarouselHome("#carrossel-home");