//evitando que o dropzonejs fique procurando uma instancia...
Dropzone.autoDiscover = false;

class ProductEdit
{
    constructor()
    {
        this.btnSubmit = $('button#btn-salvar');
        this.formEl = $('#form-cadastro');
        this.uploadEl = $('#upload-container');
        this.dropzoneInstance = null;
        this.imagesEl = $("#images")
        this.iniciarEventos();
    }
    
    iniciarEventos()
    {
        let _self = this;
        
        _self.initDropzoneJs();
        _self.initImgRemoveEvent();
        _self.initSubmitEvent();
    }
    
    updateImagesInputHiddenValue()
    {
        let arrayNames = [];
        $("#product-img-cards-container .card").each(function(){
            let fileName= $(this).data('name');
            arrayNames.push(fileName);
        })
        this.imagesEl.val(arrayNames.join('$$'));
    }

    initSubmitEvent()
    {
        let _self = this;
        _self.formEl.submit(function() {            
            let validateResponse = _self.validate();
            let model = _self.getModel();
            if (validateResponse.isValid)
            {   
                //dados validos, iremos gravar...  
                let action = '/admin/produto/editar-post';
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
                        if (data.success){
                            Swal.fire({
                                title: data.msg,                            
                                showCancelButton: false,
                                type:'success',
                                confirmButtonText: 'Voltar para lista.',
                                showLoaderOnConfirm: true,                        
                                allowOutsideClick: false

                            }).then((result) => {
                                if (result.value) {
                                    document.location = "/admin/produto";
                                }
                            });
                        } else {
                            //se deu alguma zica na request mostraremos um alert amigavel...
                            alertServerError();
                            _self.btnSubmit.button('reset');
                        }
                    }
                })
            }
            return false;
        });
    }

    initImgRemoveEvent()
    {
        let _self = this;
        $("#product-img-cards-container button.btn").unbind('click');
        $("#product-img-cards-container button.btn").click(function(){
            let el = $(this);
            let callback = function(){
                el.parent().parent().fadeOut(500, function(){
                    
                    el.parent().parent().remove();
                    _self.updateImagesInputHiddenValue();
                });
            };
            alertConfirm({
                title: "Atenção", 
                text: "Deseja remover a imagem?"
            }, callback);
        });
    }

    initDropzoneJs()
    {
        let _self = this;

        _self.dropzoneInstance = new Dropzone("div#upload-container", {
            url: "/admin/produto/upload",
            paramName: "images", 
            dictDefaultMessage: "Arraste seus arquivos para cá!",
            init: function() {
                this.on("complete",function(data){
                    console.log(data)
                    //removendo elemento do conainer de uploads
                    let el = $("#upload-container .dz-preview");
                    el.fadeOut(300, function(){
                        el.remove();
                        console.log(el.length)
                        
                        setTimeout(function(){
                            if (el.length === 0)
                            $("#upload-container").removeClass("dz-started");
                        },300)
                        

                        _self.updateImagesInputHiddenValue();
                    });
                });
                this.on("success", function(file) { 
                    //finalizou o upload
                    alertSuccess({
                        title:"Sucesso", 
                        text: "Sua imagem foi enviada para o servidor com sucesso."
                    });
                    
                    //adicionando arquivo adicionado no DOM...
                    $("#product-img-cards-container").append(
                        productImageCard.build({
                            fileName: file.name,
                            productId: $('#form-cadastro #productId').val(),
                            productImageId: null
                        })
                    );
                    
                    //reaplicando eventos de remoção de imagem...
                    _self.initImgRemoveEvent();
                });
            }
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
            productId : _self.formEl.find('#productId').val(),
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

class ProductImageCard
{
    constructor()
    {

    }

    remove(fileName)
    {
        let el = $(`#product-img-cards-container .card[data-name="${fileName}"]`);

        el.fadeOut(300,() => {
            el.remove();
        });
    }

    build(fileObj)
    {
        return `<div class="card text-center" data-name="${fileObj.fileName}">
            <div class="text-center p-2">
                <img src="/img/products/${fileObj.fileName}" 
                    style="max-width:100px; max-height:100px;"
                    class="img-fluid ">
            </div>
            <div class="card-footer p-2">
                <button type="button" class="btn btn-danger btn-sm" 
                    data-name="${fileObj.fileName}"
                    data-product-id="${fileObj.productId}" 
                    data-id="${fileObj.productImageId}" 
                    title="Remover imagem">
                    <i class="fa fa-trash"></i> Remover
                </button>
            </div>
        </div>`;
    }
}

window.productImageCard = new ProductImageCard();
window.productEdit = new ProductEdit();