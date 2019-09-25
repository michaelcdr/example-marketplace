class Home{
    constructor(){
        this.animateSections();

        console.log($("#pesquisa"))
    }

    animateSections(){
        //dando uma animada na bagaça...
        setTimeout(() => {
            $('.card').addClass('in');
            setTimeout(() => {
                $('#linhas').addClass('in');
            },300);
        },300);        
    }
}