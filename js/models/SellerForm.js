
/*
* Classe responsável pela edição e criação de usuários.
*/
class UserForm
{
    constructor()
    {
        this.btnSubmit = $('button#btn-salvar');
        this.formEl = $("#formUsuario");
        this.tipoPessoaEl = $('input[name=tipo-pessoa]');
        
        this.initEvents();
        $("#name").focus();
    }
    
    validate()
    {
        let validateResponse = { isValid : true };
        let _self = this;
        _self.formEl.find('*[data-required="true"]').each((index, el) => {
            if ($(el).val() === '')
            {
                $(el).addClass('is-invalid');
                validateResponse.isValid = false;
            }
        });
        return validateResponse;
    }

    getModel()
    {
        let _self = this;
        return {
            userId:_self.formEl.find('#userId').val(),
            login:_self.formEl.find('#login').val(),
            password:_self.formEl.find('#password').val(),
            name:_self.formEl.find('#name').val(),
            role:_self.formEl.find('#role').val()
        };
    }
    mascararCep(){
        $('#cep').mask('00000-000');
    }
    mascararCnpj(){
        $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
    }
    mascararCpf(){
        $('#cpf').mask('000.000.000-00', {reverse: true});
    }
    mascararDataNascimento(){
        $('#dataNascimento').mask('00/00/0000');
    }

    initEvents()
    {
        let _self = this;

        _self.mascararCep();
        _self.mascararCnpj();
        _self.mascararCpf();
        _self.mascararDataNascimento();

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

        _self.formEl.submit(function() {
            let validateResponse = _self.validate();
            let model = _self.getModel();

            if (validateResponse.isValid){   
                //dados validos, iremos gravar...  
                let action = '/admin/usuario/cadastrar-post';

                //se tivermos um id no form sera uma atualização...
                if (model.userId && model.userId !== '')
                    action = '/admin/usuario/editar-post';
                
                $.post(action, model, function(data){
                    if (data.success){
                        //exibindo msg amigavel ao usuario e quando ele confirmar volta para index
                        Swal.fire({
                            title: data.msg,                            
                            showCancelButton: false,
                            type: 'success',
                            confirmButtonText: 'Voltar para lista.',
                            showLoaderOnConfirm: true,                        
                            allowOutsideClick: false

                        }).then((result) => {
                            if (result.value) 
                                document.location = "/admin/usuario";
                        });
                    } else
                        alertError({ text:data.msg });

                }).fail(() => {
                    alertServerError();
                }); 
            }
            return false;
        });
    }
}

window.userForm = new UserForm();