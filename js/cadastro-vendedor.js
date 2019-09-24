class CadastroVendedor{
    constructor(){
        this.tipoPessoaEl = $('input[name=tipo-pessoa]');
        this.btnSubmit = $('button#btn-salvar');
        this.iniciarEventos();
    }

    iniciarEventos(){
        let _self = this;
        //console.log(_self);
        //console.log(_self.tipoPessoaEl);

        _self.tipoPessoaEl.change((el) => {
            //console.log($(el.target).val());
            let target = $(el.target).val()
            if ($('input[name=tipo-pessoa]').is(':checked')){
                _self.btnSubmit.removeAttr('disabled');
                $(".pessoa-ct").addClass('hidden');
                $(".pessoa-ct[data-target='"+target+"']").removeClass('hidden');
                $(".pessoa-ct[data-target='camposComum']").removeClass('hidden');
            }
        });

        _self.btnSubmit.submit(() => {
            
        });
    }
}

window.cadastroVendedor = new CadastroVendedor();