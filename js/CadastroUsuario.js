class CadastroUsuario{
    constructor(){
        this.condicaoEl = $('#condicao');
        this.btnSubmit = $('button#btn-salvar');
        this.formEl = $("#formUsuario");
        this.iniciarEventos();
    }

    iniciarEventos(){
        let _self = this;
        _self.formEl.submit(function() {
            let isValid = true;
            _self.formEl.find('*[data-required="true"]').each((index,el) => {
                if ($(el).val() === ''){
                    $(el).addClass('is-invalid');
                    isValid =false;
                }
            });
            let model = {
                login:_self.formEl.find('#login').val(),
                password:_self.formEl.find('#password').val(),
                name:_self.formEl.find('#name').val()
            }
            if (isValid){
                
                $.post('/admin/cadastrar-usuario-post',model,function(data){
                    if (data.success){
                        alert(data.msg)
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            footer: '<a href>Why do I have this issue?</a>'
                        });
                    }
                })
            }
            return false;
        });
    }
}

window.cadastroProduto = new CadastroUsuario();