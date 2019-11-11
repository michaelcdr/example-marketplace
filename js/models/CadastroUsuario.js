class CadastroUsuario{
    constructor()
    {
        this.btnSubmit = $('button#btn-salvar');
        this.formEl = $("#formUsuario");
        this.initEvents();
        $("#name").focus();
    }
    
    validate(){
        let validateResponse = { isValid:true};
        let _self = this;
        _self.formEl.find('*[data-required="true"]').each((index,el) => {
            if ($(el).val() === ''){
                $(el).addClass('is-invalid');
                validateResponse.isValid = false;
            }
        });
        return validateResponse;
    }

    getModel(){
        let _self = this;
        return {
            userId:_self.formEl.find('#userId').val(),
            login:_self.formEl.find('#login').val(),
            password:_self.formEl.find('#password').val(),
            name:_self.formEl.find('#name').val()
        };
    }

    initEvents(){
        let _self = this;

        _self.formEl.submit(function() {
            let validateResponse = _self.validate();
            let model = _self.getModel();

            if (validateResponse.isValid){   
                //dados validos, iremos gravar...  
                let action = '/admin/cadastrar-usuario-post';
                if (model.userId && model.userId !== '')
                    action = '/admin/editar-usuario-post';
                
                $.post(action, model, function(data){
                    if (data.success){
                        //exibindo msg amigavel ao usuario e quando ele confirmar volta para index
                        Swal.fire({
                            title: data.msg,                            
                            showCancelButton: false,
                            type:'success',
                            confirmButtonText: 'Ok, voltar para lista.',
                            showLoaderOnConfirm: true,                        
                            allowOutsideClick: () => !Swal.isLoading()

                        }).then((result) => {
                            if (result.value) {
                                document.location = "/admin/lista-usuarios";
                            }
                        });
                    } else
                        alertError({ text:data.msg });

                }).fail(() =>{
                    alertServerError();
                }); 
            }
            return false;
        });
    }
}

window.cadastroUsuario = new CadastroUsuario();