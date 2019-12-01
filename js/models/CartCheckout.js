class CartCheckout 
{
    constructor()
    {
        this.btnSubmit = $('button#btn-save');
        this.formEl = $('#form-cadastro');
        this.validator = new GenericValidator($('#form-cadastro'));
        this.initEvents();
    }

    initEvents()
    {
        this.initSubmitEvent();
        this.seedForm();
    }

    seedForm(){
        $("#card-number").val("4556965669773172");
        $("#card-name").val("Michael C. Reis");
        $("#name").val("Michael Costa dos Reis");
        $("#cpf").val("000.000.000-00");
        $("#cep").val("00000-000");
        $("#card-expiration").val("01/1000");
        $("#cvv").val('123');
        $("#address").val('Rua Luiz Michelon');
        $("#neighborhood").val('Cruzeiro');
        $("#city").val('Caxias do Sul');
        $("#uf").find('option:eq(1)').attr('selected','selected');
        $("#complement").val('perto do Bar');
    }

    getModel(){
        return {
            cardNumber : $("#card-number").val(),
            cardName:$("#card-name").val(),
            cardExpiration:$("#card-expiration").val(),
            name: $("#name").val(),
            cep: $("#cep").val(),
            cpf: $("#cpf").val(),
            cvv:$("#cvv").val(),
            address:$("#address").val(),
            neighborhood:$("#neighborhood").val(),
            city:$("#city").val(),
            stateId:$("#uf").val(),
            complement:$("#complement").val()

        };
    }

    initSubmitEvent()
    {
        let _self = this;
        _self.formEl.submit(function() {            
            let validateResponse = _self.validator.validate();
            if (validateResponse.isValid)
            {   
                //dados validos, iremos gravar...  
                _self.btnSubmit.button('loading');
                let formData = _self.getModel();
                $.post('/cart-checkout-post',formData, function(data){ 
                    if (data.success){
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
                    } else {
                        //se deu alguma zica na request mostraremos 
                        //um alert amigavel...
                        alertServerError();
                        _self.btnSubmit.button('reset');
                    }
                });
            }
            return false;
        });
    }
}

window.cartCheckout = new CartCheckout();