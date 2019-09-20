class CarouselHome{
    constructor(selector){
        console.log('carrosel iniciado.');
        $(selector).slick();
    }
}

window.carouselHome = new CarouselHome("#carrossel-home");