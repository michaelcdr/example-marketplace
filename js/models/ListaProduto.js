class ListaProduto{
    constructor(){
        this.iniciarEventos();
    }

    iniciarEventos(){
        setTimeout(() => {
            $('.card').addClass('in')
        },300)
    }
}

window.listaProduto = new ListaProduto();