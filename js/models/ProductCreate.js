class ProductCreate{
    constructor(){
        
        this.btnSubmit = $('button#btn-salvar');
        this.formEl = $('#form-cadastro');
        this.iniciarEventos();
    }

    iniciarEventos(){
        let _self = this;
        _self.formEl.submit(function() {            
            let validateResponse = _self.validate();
            let model = _self.getModel();
            if (validateResponse.isValid){   
                //dados validos, iremos gravar...  
                let action = '/admin/produto/cadastrar-post';
                if (model.userId && model.userId !== '')
                    action = '/admin/produto/editar-post';
                
                _self.btnSubmit.button('loading');
                $.ajax({
                    type: 'POST',
                    url: action,
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        
                    },
                    success: function(data){ 
                        console.log(data);
                        Swal.fire({
                            title: data.msg,                            
                            showCancelButton: false,
                            type:'success',
                            confirmButtonText: 'Ok, voltar para lista.',
                            showLoaderOnConfirm: true,                        
                            allowOutsideClick: false

                        }).then((result) => {
                            if (result.value) {
                                document.location = "/admin/produto";
                            }
                        });
                    }
                })
            }
            return false;
        });
    }

    validate(){
        let validateResponse = { isValid:true};
        let _self = this;
        _self.formEl.find('*[data-required="true"]').removeClass('is-invalid');
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
            title: _self.formEl.find('#title').val(),
            price: _self.formEl.find('#price').val(),
            sku: _self.formEl.find('#sku').val(),
            description: _self.formEl.find('#description').val(),
            stock: _self.formEl.find('#stock').val(),
            images:_self.formEl.find('#images').val(),
            offer: _self.formEl.find("input[name=offer]:checked").val()
        };
    }
}

window.productCreate = new ProductCreate();