window.carouselHome = new Carousel("#carrossel-home");
window.home = new Home();


window.alertSuccess(dataObj){
    Swal.fire({
        type: 'success',
        title: data.title,
        text: data.text
    });
}

window.alertError(dataObj){
    Swal.fire({
        title: 'Ops, algo deu errado',
        type: 'error',
        text: data.text
    });
}